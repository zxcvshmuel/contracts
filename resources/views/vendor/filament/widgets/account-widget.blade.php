<?php

use Carbon\Carbon;
use App\Filament\Resources\FastContractResource;

?>

<x-filament::widget class="filament-account-widget">

    <x-filament::card>
        @php
            $user = \Filament\Facades\Filament::auth()->user();
            $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'https://boi.org.il/PublicApi/GetExchangeRates');
    if ($response->getStatusCode() == 200) {
        $response =json_decode($response->getBody()->getContents(), true);
    } else {
        $response = [];
    }
    $dollarChangeDirection = $response['exchangeRates'][0]['currentChange'] > 0 ? true : false;
    $euroChangeDirection = $response['exchangeRates'][3]['currentChange'] > 0 ? true : false;
        @endphp
            <!-- component -->

        <div class="z-0 p-3 space-y-4" dir="ltr">


            <div
                class="mr-auto"
                id="widget"
            >
                <!-- Widget -->
                <div class="w-full p-6 text-right text-gray-700 bg-white rounded-xl lg:w-1/3 lg:ml-auto">

                    <div class="flex w-full text-sm" dir="rtl">
                        <div class="flex items-center w-6/12 mt-5 space-x-2">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-8 p-1 m-1 duration-300 transform rounded-md hover:rotate-12"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 235.517 235.517"
                                xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <path style="fill:#4CAF50;"
                                              d="M118.1,235.517c7.898,0,14.31-6.032,14.31-13.483c0-7.441,0-13.473,0-13.473 c39.069-3.579,64.932-24.215,64.932-57.785v-0.549c0-34.119-22.012-49.8-65.758-59.977V58.334c6.298,1.539,12.82,3.72,19.194,6.549 c10.258,4.547,22.724,1.697,28.952-8.485c6.233-10.176,2.866-24.47-8.681-29.654c-11.498-5.156-24.117-8.708-38.095-10.236V8.251 c0-4.552-6.402-8.251-14.305-8.251c-7.903,0-14.31,3.514-14.31,7.832c0,4.335,0,7.843,0,7.843 c-42.104,3.03-65.764,25.591-65.764,58.057v0.555c0,34.114,22.561,49.256,66.862,59.427v33.021 c-10.628-1.713-21.033-5.243-31.623-10.65c-11.281-5.755-25.101-3.72-31.938,6.385c-6.842,10.1-4.079,24.449,7.294,30.029 c16.709,8.208,35.593,13.57,54.614,15.518v13.755C103.79,229.36,110.197,235.517,118.1,235.517z M131.301,138.12 c14.316,4.123,18.438,8.257,18.438,15.681v0.555c0,7.979-5.776,12.651-18.438,14.033V138.12z M86.999,70.153v-0.549 c0-7.152,5.232-12.657,18.71-13.755v29.719C90.856,81.439,86.999,77.305,86.999,70.153z"></path>
                                    </g>
                                </g></svg>
                            <div>דולר (USD)</div>
                        </div>
                        <div
                            class="flex items-center w-3/12 mt-5 space-x-2 font-extrabold duration-200 transform hover:scale-105"
                        >
                            {{  number_format($response['exchangeRates'][0]['currentExchangeRate'], 2, '.', ',') }}
                        </div>

                        @if($dollarChangeDirection)

                            <div
                                class="flex items-center w-3/12 mt-5 space-x-2 font-extrabold text-green-500 duration-200 transform hover:scale-105"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5"
                                    width="28"
                                    height="28"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    fill="none"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path
                                        stroke="none"
                                        d="M0 0h24v24H0z"
                                        fill="none"
                                    ></path>
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="18" y1="11" x2="12" y2="5"></line>
                                    <line x1="6" y1="11" x2="12" y2="5"></line>
                                </svg>
                                <span><span>{{  number_format($response['exchangeRates'][0]['currentChange'], 2, '.', ',') }}%</span></span>
                            </div>
                        @else

                            <div
                                class="flex items-center w-3/12 mt-5 space-x-2 font-extrabold text-red-500 duration-200 transform hover:scale-105"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    fill="none"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path
                                        stroke="none"
                                        d="M0 0h24v24H0z"
                                        fill="none"
                                    ></path>
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="18" y1="13" x2="12" y2="19"></line>
                                    <line x1="6" y1="13" x2="12" y2="19"></line>
                                </svg>
                                <span>{{  number_format($response['exchangeRates'][0]['currentChange'], 2, '.', ',') }}%</span>
                            </div>
                    </div>
                    @endif
                </div>

                <div class="flex w-full text-sm" dir="rtl">
                    <div class="flex items-center w-6/12 mt-5 space-x-2">
                        <svg
                            class="w-8 p-1 m-1 duration-300 transform rounded-md hover:rotate-12"
                            xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#"
                            xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                            xmlns:svg="http://www.w3.org/2000/svg"
                            xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                            xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" sodipodi:docname="gbp.svg"
                            inkscape:version="0.48.4 r9939" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1200 1200"
                            enable-background="new 0 0 1200 1200" xml:space="preserve" fill="#486bea" stroke="#486bea"><g
                                id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <sodipodi:namedview inkscape:cy="786.21617" inkscape:cx="-864.61571"
                                                    inkscape:zoom="0.175" showgrid="false" id="base" borderopacity="1.0"
                                                    bordercolor="#666666" pagecolor="#ffffff"
                                                    inkscape:current-layer="layer1" inkscape:window-maximized="1"
                                                    inkscape:window-y="24" inkscape:window-height="876"
                                                    inkscape:window-width="1535" inkscape:pageshadow="2"
                                                    inkscape:pageopacity="0.0" inkscape:window-x="65"
                                                    inkscape:document-units="px"></sodipodi:namedview>
                                <g id="layer1" transform="translate(0,147.63782)" inkscape:label="Layer 1"
                                   inkscape:groupmode="layer">
                                    <g id="text2989">
                                        <path id="path3042"
                                              d="M754.722,51.692c-65.372,0.001-119.224,19.023-161.554,57.066c-42.331,37.509-69.658,92.164-81.982,163.965 h323.912v141.461H499.129l-1.607,28.131v37.776l1.607,26.523h285.332v143.067H512.793 c27.327,130.208,113.328,195.312,258.004,195.312c76.624,0.001,150.301-15.271,221.031-45.813v205.761 c-62.157,31.614-140.656,47.421-235.498,47.421c-131.28,0-239.251-35.633-323.912-106.898 c-84.662-71.266-137.978-169.859-159.946-295.78H162.357V506.615H257.2c-2.144-12.323-3.215-28.935-3.215-49.832l1.607-42.599 h-93.235V272.724h106.899c19.825-129.67,73.141-232.015,159.946-307.032c86.805-75.552,195.311-113.328,325.519-113.329 c100.736,0.001,195.043,21.97,282.921,65.908l-78.768,186.47C921.901,88.13,887.34,75.27,855.19,66.16 C823.04,56.516,789.551,51.693,754.722,51.692"></path>
                                    </g>
                                </g>
                            </g></svg>
                        <div>יורו (EUR)</div>
                    </div>
                    <div
                        class="flex items-center w-3/12 mt-5 space-x-2 font-extrabold duration-200 transform hover:scale-105"
                    >
                        <span>{{  number_format($response['exchangeRates'][3]['currentExchangeRate'], 2, '.', ',') }}
                    </div>
                    @if($euroChangeDirection)

                        <div
                            class="flex items-center w-3/12 mt-5 space-x-2 font-extrabold text-green-500 duration-200 transform hover:scale-105"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5"
                                width="28"
                                height="28"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path
                                    stroke="none"
                                    d="M0 0h24v24H0z"
                                    fill="none"
                                ></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="18" y1="11" x2="12" y2="5"></line>
                                <line x1="6" y1="11" x2="12" y2="5"></line>
                            </svg>
                            <span><span>{{  number_format($response['exchangeRates'][3]['currentChange'], 2, '.', ',') }}%</span></span>
                        </div>
                    @else

                        <div
                            class="flex items-center w-3/12 mt-5 space-x-2 font-extrabold text-red-500 duration-200 transform hover:scale-105"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path
                                    stroke="none"
                                    d="M0 0h24v24H0z"
                                    fill="none"
                                ></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="18" y1="13" x2="12" y2="19"></line>
                                <line x1="6" y1="13" x2="12" y2="19"></line>
                            </svg>
                            <span>{{  number_format($response['exchangeRates'][3]['currentChange'], 2, '.', ',') }}%</span>
                        </div>
                </div>
                @endif
            </div>
        </div>


        <!-- first row -->
        <div class="flex items-center justify-around pb-6 space-x-3 overflow-y-scroll text-gray-500 border-b-2">
            <div


                class="flex flex-col items-center justify-center w-20 h-10 p-1 mb-2 transition duration-300 ease-in bg-pink-200 shadow cursor-pointer text-black-600 rounded-2xl bg-pink hover:shadow-md">
                <div class="relative text-sm top-3"> {{ auth()->user()->packages()->first()->name }} </div>
                <p class="relative mt-1 text-md top-1/2">שם-החבילה</p>
            </div>
            <div
                class="flex flex-col items-center justify-center w-20 h-10 p-1 mb-2 transition duration-300 ease-in bg-orange-200 shadow cursor-pointer text-black-600 bg-orange rounded-2xl hover:shadow-md">
                <div
                    class="relative text-sm top-3"> {{ Carbon::createFromDate(auth()->user()->active_until)->format('d-m-y') }} </div>
                <p class="relative mt-1 text-md top-1/2">תוקף-המינוי</p>
            </div>

            <div
                class="flex flex-col items-center justify-center w-20 h-10 p-1 mb-2 transition duration-300 ease-in bg-red-200 shadow cursor-pointer text-black-600 bg-red rounded-2xl hover:shadow-md">
                <div class="relative text-sm top-3"> {{ auth()->user()->contracts()->count() }} </div>
                <p class="relative mt-1 text-md top-1/2">מסמכים-שנוצרו</p>
            </div>
        </div>

        <!-- second row -->

        <div class="flex items-center justify-around pb-6 space-x-3 overflow-y-scroll text-gray-500">
            <div
                onclick="routeto('/admin/fast-work-order')"
                class="flex flex-col items-center justify-center w-20 h-20 p-1 mb-2 text-green-600 transition duration-300 ease-in bg-green-200 rounded-full shadow cursor-pointer bg-green hover:shadow-md hover:bg-green-400">
                <i class="relative text-4xl fa fa-person-digging top-3"></i>
                <p class="relative mt-1 text-md top-1/2">הזמנת-עבודה</p>
            </div>
            <div
                onclick="routeto('/admin/price-offers')"
                class="flex flex-col items-center justify-center w-20 h-20 p-1 mb-2 text-yellow-600 transition duration-300 ease-in bg-yellow-200 rounded-full shadow cursor-pointer hover:shadow-md hover:bg-yellow-400">
                <i class="relative text-4xl top-3 fa fa-hand-holding-dollar"></i>
                <p class="relative mt-1 text-md top-1/2">הצעת-מחיר</p>
            </div>

            <div
                onclick="routeto('/admin/fast-contract')"
                class="flex flex-col items-center justify-center w-20 h-20 p-1 mb-2 text-indigo-500 transition duration-300 ease-in bg-indigo-200 rounded-full shadow cursor-pointer hover:shadow-md hover:bg-indigo-400">
                <i class="relative text-4xl fa fa-file top-3"></i>
                <p class="relative mt-1 text-md top-1/2">חוזה-מהיר</p>
            </div>
        </div>

        <!-- third row -->

        <div class="flex items-center justify-around pb-6 space-x-3 overflow-y-scroll text-gray-500 border-b-2">
            <div
                onclick="routeto('/admin/fast-contract')"
                class="flex flex-col items-center justify-center w-20 h-20 p-1 mb-2 text-gray-600 transition duration-300 ease-in bg-gray-200 rounded-full shadow cursor-pointer bg-gray hover:shadow-md hover:bg-gray-400">
                <i class="relative text-4xl fa fa-file-signature top-3"></i>
                <p class="relative mt-1 text-md top-1/2">חתימת-מסמך</p>
            </div>
            <div
                onclick="routeto('/admin/fast-memory-of-things-car')"
                class="flex flex-col items-center justify-center w-20 h-20 p-1 mb-2 text-pink-600 transition duration-300 ease-in bg-pink-200 rounded-full shadow cursor-pointer bg-pink hover:shadow-md hover:bg-pink-400">
                <i class="relative text-4xl top-3 fa fa-car"></i>
                <p class="relative mt-1 text-md top-1/2">זכרון-לרכב</p>
            </div>

            <div
                onclick="routeto('/admin/fast-memory-of-things-home-rental')"
                class="flex flex-col items-center justify-center w-20 h-20 p-1 mb-2 transition duration-300 ease-in rounded-full shadow cursor-pointer text-emerald-500 bg-emerald-200 hover:shadow-md hover:bg-emerald-400">
                <i class="relative text-4xl fa fa-home top-3"></i>
                <p class="relative mt-1 text-md top-1/2">זכרון-לדירה</p>
            </div>
        </div>

        <div class="flex items-center justify-around pb-6 space-x-3 overflow-y-scroll text-gray-500 cursor-pointer">
            <div
                onclick="routeto('/admin/expenses')"
                class="flex flex-col items-center justify-center w-20 h-20 p-1 mb-2 text-red-600 transition duration-300 ease-in bg-red-200 rounded-full shadow cursor-pointer bg-red hover:shadow-md hover:bg-red-400">
                <i class="relative text-4xl fa fa-credit-card top-3"></i>
                <p class="relative mt-1 text-md top-1/2">הוצאות</p>
            </div>
            <div
                onclick="routeto('/admin/my-profile')"
                class="flex flex-col items-center justify-center w-20 h-20 p-1 mb-2 text-yellow-600 transition duration-300 ease-in bg-yellow-200 rounded-full shadow cursor-pointer hover:shadow-md hover:bg-yellow-400">
                <i class="relative text-4xl fa fa-user top-3"></i>
                <p class="relative mt-1 text-md top-1/2">הפרופיל-שלי</p>
            </div>
            <div
                onclick="routeto('/admin/incomes')"
                class="flex flex-col items-center justify-center w-20 h-20 p-1 mb-2 text-blue-600 transition duration-300 ease-in bg-blue-200 rounded-full shadow cursor-pointer bg-blue hover:shadow-md hover:bg-blue-400">
                <i class="relative text-4xl top-3 fa fa-cash-register"></i>
                <p class="relative mt-1 text-md top-1/2">הכנסות</p>
            </div>
        </div>


        <style>
            ::-webkit-scrollbar {
                width: 0;
            }

            ::-webkit-scrollbar-track {
                -webkit-box-shadow: inset 0 0 0px rgba(0, 0, 0, 0.3);
            }

            ::-webkit-scrollbar-thumb {
                background-color: transparent;
                outline: 1px solid transparent;
            }


            @media (max-width: 750px) {
                #fullCalendarVideo {
                    top: 184% !important;
                }
            }
        </style>

        <script>
            function routeto(route) {
                window.location.href = window.location.origin + route;
            }
        </script>

        <!-- <div class="flex items-center justify-center h-12">
        <h2 class="text-lg font-bold tracking-tight text-center sm:text-xl">
                    {{ __('filament::widgets/account-widget.welcome', ['user' => \Filament\Facades\Filament::getUserName($user)]) }}
        </h2>
    </div>
</div>
<div class="flex justify-around pb-6">
    <div class="flex flex-col items-center justify-center w-1/4 pt-1 bg-red-200 bg-no-repeat border border-red-300 flex-column rounded-xl min-h-[80px]">
                <div class="mb-1 text-sm">שם המסלול</div>
                <div class="text-sm">{{ auth()->user()->packages()->first()->name }}</div>
            </div>

            <div class="flex flex-col items-center justify-center w-1/4 pt-1 bg-blue-200 bg-no-repeat border border-blue-300 flex-column rounded-xl">
                <div class="mb-1 text-sm">תוקף המינוי</div>
                <div class="text-sm">{{ Carbon::createFromDate(auth()->user()->active_until)->format('d-m-y') }}</div>
            </div>

            <div class="flex flex-col items-center justify-center w-1/4 pt-1 bg-green-200 bg-no-repeat border border-green-300 flex-column rounded-xl">
                <div class="mb-1 text-sm">מסמכים שנוצרו</div>
                <div class="text-sm">{{ auth()->user()->contracts()->count() }}</div>
            </div>
            </div> -->
    </x-filament::card>
</x-filament::widget>
