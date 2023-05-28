<?php

namespace App;

use App\Models\User;
use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Helpers
{
    public static function getGoogleClient(): Google_Client
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

    /**
     * @param User $user
     * @return mixed|string
     */
    public static function getGoogleToken(User $user)
    {
        $client = self::getGoogleClient();
        Session::put('user', $user->id);

        if ($user->two_factor_secret == null) {
            return self::createUrlForGoogleToken();
        } else {
            $client->setAccessToken($user->two_factor_secret);
            if ($client->isAccessTokenExpired()) {
                $client->fetchAccessTokenWithRefreshToken($user->two_factor_secret);
                $user->update(['two_factor_secret' => $client->getAccessToken()]);
            }

            return $user->two_factor_secret;
        }
    }

    public static function createUrlForGoogleToken(): string
    {
        Session::put('user', auth()->user()->id);
        $client = self::getGoogleClient();

        return $client->createAuthUrl();
    }

    public static function googleCodeCallback(User $user, Request $request): void
    {
        $client = self::getGoogleClient();
        $accessToken = $client->fetchAccessTokenWithAuthCode($request->code);
        $user->update(['two_factor_secret' => $accessToken]);
    }

    public static function getCalendarData(User $user): array
    {
        $client = self::getGoogleClient();
        $accessToken = self::getGoogleToken($user);
        $client->setAccessToken($accessToken);

        $service = new Google_Service_Calendar($client);
        /*$primaryCalendarId = self::getPrimaryCalendarId($user);

        if (empty($primaryCalendarId)) {
            return ['primary']; // Primary calendar ID not found
        }*/

        $startDate = Carbon::today()->subDays(30)->format('Y-m-d\TH:i:s.000\Z');
        $endDate = Carbon::today()->addDays(150)->format('Y-m-d\TH:i:s.000\Z');

        /*$eventsResponse = $service->events->listEvents($primaryCalendarId, [
            'timeMin' => $startDate,
            'timeMax' => $endDate,
        ]);*/

        $eventsResponse = $service->events->listEvents('primary', [
            'timeMin' => $startDate,
            'timeMax' => $endDate,
        ]);

        $events = $eventsResponse->getItems();

        return $events;
    }


    public static function getPrimaryCalendarId(User $user): string
    {
        $client = self::getGoogleClient();
        $accessToken = self::getGoogleToken($user);
        $client->setAccessToken($accessToken);

        $service = new Google_Service_Calendar($client);
        $calendarList = $service->calendarList->listCalendarList();

        foreach ($calendarList->getItems() as $calendar) {
            if ($calendar->getPrimary()) {
                return $calendar->getId();
            }
        }

        return ''; // Primary calendar ID not found
    }

    public static function createEvent(User $user, $data): \Google\Service\Calendar\Event|bool
    {
        if ($user->two_factor_secret === null || $user->two_factor_secret === '') {
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
                'dateTime' => Carbon::make($data['start'])->format('Y-m-d\TH:i:s.000\Z'),
                'timeZone' => 'America/Los_Angeles',
            ],
            'end' => [
                'dateTime' => Carbon::make($data['end'])->format('Y-m-d\TH:i:s.000\Z'),
                'timeZone' => 'America/Los_Angeles',
            ],
        ]);

        $calendarId = self::getPrimaryCalendarId($user);

        if (empty($calendarId)) {
            return false; // Primary calendar ID not found
        }

        $event = $service->events->insert($calendarId, $event);

        return $event;
    }

    public static function editEvent(User $user, $eventId, $data)
    {
        if ($user->two_factor_secret === null || $user->two_factor_secret === '') {
            return false;
        }

        $client = self::getGoogleClient();
        $accessToken = self::getGoogleToken($user);
        $client->setAccessToken($accessToken);

        $service = new Google_Service_Calendar($client);

        $calendarId = self::getPrimaryCalendarId($user);

        if (empty($calendarId)) {
            return false; // Primary calendar ID not found
        }

        $event = $service->events->get($calendarId, $eventId);

        // Update the event properties
        $event->setSummary($data['title']);
        $event->setLocation('');
        $event->setDescription('');
        $event->getStart()->setDateTime(Carbon::make($data['start'])->format('Y-m-d\TH:i:s.000\Z'));
        $event->getStart()->setTimeZone('America/Los_Angeles');
        $event->getEnd()->setDateTime(Carbon::make($data['end'])->format('Y-m-d\TH:i:s.000\Z'));
        $event->getEnd()->setTimeZone('America/Los_Angeles');

        $updatedEvent = $service->events->update($calendarId, $event->getId(), $event);

        return $updatedEvent;
    }



}
