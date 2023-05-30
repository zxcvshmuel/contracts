<x-filament::page>
    <div x-data="{popup : {{$popup}} }">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                תוכניות
            </h2>
        </x-slot>

        <x-filament::card>
            <div class="grid">
                @php
                    $count = 0;
                    $class = ['basic', 'standard', 'premium'];
                    $duration = '';
                @endphp
                @foreach ($this->data['packages'] as $package)
                    <div style="padding: 10px 0 10px 0;" class="mycard {{ $class[$count]}}">
                        <div class="title">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            <h2>{{ $package->name }}</h2>
                        </div>
                        <div class="price">
                            <h4 style="font-size: 32px;"><sup>₪</sup>{{ $package->price }}</h4>
                        </div>
                        <div class="option">
                            <ul>
                                <li><i class="fa fa-check" aria-hidden="true"></i>{{ $package->description }}</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i> ניהול לקוחות ואירועים</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i> שליחת חוזים והצעות מחיר</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i> חתימה דיגיטלית מאובטחת און-ליין</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i> חיווי על קריאה וחתימה</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i> ניהול הוצאות והכנסות</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i> יומן עם סנכרון לגוגל</li>
                            </ul>
                        </div>
                        <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                wire:click="packageClick({{ $package->id }})"
                                class="package-btn bg-blue-700 hover:bg-blue-700 text-white font-bold my-6 py-2 px-4 border border-blue-700 rounded">
                            המשך
                        </button>
                    </div>
                    @php
                        $count++;
                        if ($count == 3) {
                            $count = 0;
                        }
                    @endphp
                @endforeach
            </div>

        </x-filament::card>
        <div x-show="popup">
            <div id="popup-modal" tabindex="-1"
                 class="fixed top-0 left-0 right-0 z-50 p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative m-auto w-full max-w-md max-h-full">
                    <div class="relative m-auto bg-white rounded-lg shadow dark:bg-gray-700">
                        <button x-on:click=" open = false" type="button"
                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                data-modal-hide="popup-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">סגור</span>
                        </button>
                        <div class="p-8 text-center">
                            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white border-b rounded-t">פרטי העסקה</h3>

                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Connect with one of our available wallet providers or create a new one.</p>
                            <ul class="my-4 space-y-3">
                                <li>
                                    <a href="#" class="flex flex-row-reverse items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                        <span class="flex-1 ml-3 whitespace-nowrap">{{ $this->dataToPay['name'] ?? '' }}</span>
                                        <span class="items-center justify-center px-2 py-0.5 ml-3 text-md font-medium text-gray-500
                                        rounded dark:bg-gray-700 dark:text-gray-400">שם</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex flex-row-reverse items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                        <span class="flex-1 ml-3 whitespace-nowrap">{{ $this->dataToPay['duration'] ?? '' }}</span>
                                        <span class=" items-center justify-center px-2 py-0.5 ml-3 text-md font-medium text-gray-500
                                        rounded dark:bg-gray-700 dark:text-gray-400">משך</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex flex-row-reverse items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                        <span class="flex-1 ml-3 whitespace-nowrap">{{ $dataToPay['price'] ?? '' }}</span>
                                        <span class=" items-center justify-center px-2 py-0.5 ml-3 text-md font-medium text-gray-500
                                        rounded dark:bg-gray-700 dark:text-gray-400">מחיר</span>
                                    </a>
                                </li>
                            </ul>


                            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">בחר אמצעי תשלום</h3>
                            <form class="space-y-8" >
                                <input type="hidden" name="package-id" value="{{ $dataToPay['id'] ?? 0 }}">
                                <ul class="flex-column">
                                    <li  class="pb-5" id="li-paypal">
                                        <input type="radio" id="payment-type-paypal" name="payment" value="paypal"
                                               class="hidden peer" required>
                                        <label checked x-on:click="open = true" for="payment-type-paypal"
                                               class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="">
                                                <div style="font-size: 24px;" class="w-full text-lg font-semibold">
                                                    פייפל
                                                </div>
                                            </div>
                                            <img style="height: 50px;"
                                                 src="{{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/payPal.png' }}"
                                                 alt="">
                                        </label>
                                    </li>
                                    <li id="li-visa">
                                        <input type="radio" id="payment-type-visa" name="payment" value="visa"
                                               class="hidden peer" required>
                                        <label x-on:click="open = true" for="payment-type-visa"
                                               class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="">
                                                <div style="font-size: 24px;" class="w-full text-lg font-semibold">
                                                    אשראי
                                                </div>
                                            </div>
                                            <img style="height: 50px;"
                                                 src="{{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/credit.png' }}"
                                                 alt="">
                                        </label>
                                    </li>
                                </ul>
                                <div class="flex justify-end" x-show="open" x-transition>
                                    <button wire:click="redirectToPay({{$dataToPay['id']}})" type="submit"  id="popup-true"
                                            class="text-white-500 focus:ring-4 focus:outline-none focus:ring-green-300 rounded-lg border border-gray-200 text-sm-center w-50 font-medium text-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:focus:ring-green-800 dark:hover:bg-green-600 inline-flex items-center  text-center mr-2">
                                        המשך לתשלום
                                    </button>

                                    {{--<button x-on:click="open = false" id="popup-false" data-modal-hide="popup-modal" type="button"
                                            class="text-white-500  focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg border border-gray-200 text-sm-center w-50 font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-600 inline-flex items-center  text-center mr-2">
                                        חזור לחבילות
                                    </button>--}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto:300');

        #popup-true {
            background-color: #4CAF50;
        }

        #popup-true:hover {
            background-color: #1cd020;
        }

        #popup-true:focus {
            --tw-ring-color: rgb(199, 255, 199);
        }

        #popup-false {
            background-color: #c41616;
            color: white;
        }

        #popup-false:hover {
            background-color: #f60f0f;
            color: white;
        }

        #popup-false:focus {
            background-color: #f60f0f;
            color: white;
            --tw-ring-color: rgba(255, 170, 170, 0.6);
        }


        .package-btn:hover {
            background-color: rgb(112, 232, 133);
        }

        .filament-main-content {
            padding: 0;
        }

        body {
            background: #262626;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif !important;
            height: 100vh;
            display: flex;
            justify-content: center;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            grid-gap: 30px;
            align-items: stretch;
            width: 100%;
            margin: auto 0;
        }

        @media (min-width: 576px) and (max-width: 767.98px) {
            .grid {
                width: 540px;
            }
        }

        @media (min-width: 768px) and (max-width: 991.98px) {
            .grid {
                width: 720px;
            }
        }

        @media (min-width: 992px) {
            .grid {
                width: 960px;
            }
        }

        @media (min-width: 1200px) {
            .grid {
                width: 1140px;
            }
        }

        .mycard {
            text-align: center;
            position: relative;
            border-radius: 15px;
            padding: 40px 20px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
            transition: .5s;
            overflow: hidden;
        }

        .mycard:hover {
            transform: scale(1.1);
        }

        .basic,
        .basic .title .fa {
            background: linear-gradient(-45deg, #f403d1, #64b5f6);
        }

        .standard,
        .standard .title .fa {
            background: linear-gradient(-45deg, #ffec61, #f321d7);
        }

        .premium,
        .premium .title .fa {
            background: linear-gradient(-45deg, #24ff72, #9a4eff);
        }

        .mycard::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 40%;
            background: rgba(255, 255, 255, 0.1);
            z-index: -1;
            transform: skewY(-5deg) scale(1.5);
        }

        .title .fa {
            color: #fff;
            font-size: 60px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            text-align: center;
            line-height: 100px;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.20);
        }

        .title h2 {
            position: relative;
            margin: 20px 0 0;
            color: #fff;
            font-size: 28px;
            z-index: 2;
        }

        .price {
            position: relative;
            z-index: 2;
        }

        .price h4 {
            margin: 0;
            padding: 20px 0;
            color: #fff;
            font-size: 60px;
        }

        .option {
            position: relative;
            z-index: 2;
        }

        .option ul {
            margin: 0;
            padding: 0;
        }

        .option ul li {
            margin: 0 0 10px;
            padding: 0;
            list-style: none;
            color: #fff;
            font-size: 16px;
        }

        .mycard button {
            position: relative;
            z-index: 2;
            border-radius: 8px;
            margin: 30px auto 8px;
            text-decoration: none;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.20);
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-weight: bold;
            background-color: #7979e8;
            border: #7979e8;
        }

    </style>
    @push('scripts')
        <script>
            window.addEventListener('showPayModal', function (event, data) {
                console.log(event.detail);
            })
        </script>
    @endpush
</x-filament::page>
