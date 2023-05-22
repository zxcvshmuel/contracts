<?php

namespace App;

use App\Models\User;
use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class helpers {

    static function getGoogleClient(): Google_Client
    {
        $client = new Google_Client();
        $client->setApplicationName('mysafe');
        $client->setClientId('554572064566-v7spbrpnnaf5ntkjt31tp5uenqmiphmr.apps.googleusercontent.com');
        $client->setClientSecret('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');
        $client->setRedirectUri('https://my-safe.co.il/oauth2callback');
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        $client->setIncludeGrantedScopes(true);

        return $client;
    }

    /***
     * @param User $user
     */
    static function getGoogleToken(User $user): Mixed
    {
        $client = self::getGoogleClient();
        Session::put('user', $user->id);

        if ($user->two_factor_secret == null)
        {
            return self::createUrlForGoogleToken();
        }else{
            $client->setAccessToken($user->two_factor_secret);
            if ($client->isAccessTokenExpired())
            {
                $client->fetchAccessTokenWithRefreshToken($user->two_factor_secret);
                $user->update(['two_factor_secret' => $client->getAccessToken()]);
            }

            return $user->two_factor_secret;
        }
    }

    static function createUrlForGoogleToken(): string
    {
        Session::put('user', auth()->user()->id);
        $client = self::getGoogleClient();

        return $client->createAuthUrl();
    }

    static function googleCodeCallback(User $user, Request $request): void
    {
        $client = self::getGoogleClient();
        $accessToken = $client->fetchAccessTokenWithAuthCode($request->code);
        $user->update(['two_factor_secret' => $accessToken]);
    }

    static function getCalendarData(User $user): array
    {
        $client = self::getGoogleClient();
        $accessToken = self::getGoogleToken($user);
        $client->setAccessToken($accessToken);


        $service = new Google_Service_Calendar($client);
        $calendarList = $service->calendarList->listCalendarList();
        $events = array();

        $startDate = Carbon::make('today -30')->format('Y-m-d\Th:m:s.000\Z');
        $endDate = '2050-12-31T23:59:59.999Z'; // format: YYYY-MM-DDTHH:mm:ss.sssZ
        foreach ($calendarList->getItems() as $calendar) {
            $eventsResponse = $service->events->listEvents($calendar->id, array(
                'timeMin' => $startDate,
                'timeMax' => $endDate,
            ));
            $events = array_merge($events, $eventsResponse->getItems());
        }

        return $events;
    }

    static function createEvent(User $user, $data){

        if ($user->two_factor_secret === null || $user->two_factor_secret === '')
        {
            return false;
        }

        $client = self::getGoogleClient();
        $accessToken = self::getGoogleToken($user);
        $client->setAccessToken($accessToken);

        $service = new Google_Service_Calendar($client);
        $event = new Google_Service_Calendar_Event([
            'summary' => $data['title'],
            'location' => '',
            'description' => '',
            'start' => [
                'dateTime' => Carbon::make($data['start'])->format('Y-m-d\Th:m:s.000\Z'),
                'timeZone' => 'America/Los_Angeles',
            ],
            'end' => [
                'dateTime' => Carbon::make($data['end'])->format('Y-m-d\Th:m:s.000\Z'),
                'timeZone' => 'America/Los_Angeles',
            ],
        ]);


        $calendarId = 'primary'; // replace with the user's calendar ID
        $event = $service->events->insert($calendarId, $event);

        return $event;
    }


}
