<x-layouts.master>
    <x-slot:title>
        מסמכים MY-SAFE
    </x-slot:title>

    <x-slot:styles>
        <style>

            body {
                background-color: #ebf6ff !important;
            }
        </style>
    </x-slot:styles>

    <x-slot:body>

        <nav class="" style="direction: rtl;">
            <div class="flex items-center justify-center flex- sm:items-center">
                <div class="flex items-start flex-shrink-0 sm:items-center">
                    <img class="block w-auto h-20 sm:align-middle"
                         src="{{ \Illuminate\Support\Facades\Storage::url('/') .  $data['user']->logo_url}}"
                         alt="Your Company">
                </div>
            </div>
        </nav>
        <div class="pt-0">
            {{-- create formal form of memory of things --}}
            {{-- title --}}
            <div class="mx-auto md:max-w-7xl sm:px-0 lg:px-6 lg:px-8" style="direction: rtl;">
                <div class="mx-auto md:max-w-7xl sm:px-0 lg:px-6 lg:px-8" style="direction: rtl;">
                    <div class="max-w-2xl mx-auto text-center">
                        <h2 class="text-2xl font-semibold leading-7 text-indigo-600">{{ $data['contract']->title }}</h2>
                    </div>
                </div>
            </div>

            {{-- subtitle on the right--}}
            <div class="flex flex-col items-start justify-between sm:flex-row sm:items-center">
                <div class="text-left">
                    <h2 class="text-2xl font-semibold leading-7 text-indigo-600">
                        שנערך ונחתם בעיר {{ $data['contract']->contracts_content['memory_of_things_car_content']['customer_address'] }}
                        בתאריך {{ \Carbon\Carbon::now(new \DateTimeZone('Asia/Jerusalem'))->format('d/m/Y') }}
                    </h2>
                </div>
            </div>

            {{-- name of the seller and customer on the right. the template is: between br seller name, br uid, br address --}}
            {{-- lines on the right --}}
            <div class="flex flex-col items-start justify-between sm:flex-row sm:items-center">
                {{-- word between in new line--}}
                <div class="text-left">
                    <h2 class="text-2xl font-semibold leading-7 text-indigo-600">
                        ביו:
                        <br>
                        שם המוכר:
                        {{ $data['user']->name }}
                        <br>
                        תעודת זהות:
                        {{ $data['user']->uid }}
                        <br>
                        כתובת:
                        {{ $data['user']->comp_address }}
                    </h2>

                    <h2 class="font-semibold leading-7 text-indigo-600 text 2xl">
                        לבין:
                        <br>
                        שם הלקוח:
                        {{ $data['contract']->contracts_content['memory_of_things_car_content']['customer_name'] }}
                        <br>
                        תעודת זהות:
                        {{ $data['contract']->contracts_content['memory_of_things_car_content']['customer_uid'] }}
                        <br>
                        כתובת:
                        {{ $data['contract']->contracts_content['memory_of_things_car_content']['customer_address'] }}
                    </h2>
                </div>
            </div>

            {{-- Some preliminary sections --}}

            <div class="pt-0 mx-auto md:max-w-7xl sm:px-0 lg:px-6 lg:px-8">
                <ul>
                    <li>
                        הואיל : והמוכר מצהיר בזאת כי הוא הבעלים והמחזיק החוקי ברכב מסוג ______ דגם ____ שנת
                        ייצור ______ מס' רישוי _______ מד אוץ _______ מס' שלדה _________ מס' מנוע
                        _____ יד _______;
                    </li>
                    <li>
                        והואיל : והמוכר מצהיר בזאת כי אין כל מניעה חוקית למכור את הרכב לקונה;
                    </li>
                    <li>
                        והואיל : והקונה לאחר שבדק את הרכב  וכן ניתנה לו האפשרות לקחת את הרכב למכון בדיקה
                        מורשה, מצא אותו מתאים לצרכיו ובכפוף להצהרות המוכר מוותר בזאת על כל טענת מום
                        נסתר ברכב,  ומעוניין לקנות אותו מהמוכר, והמוכר מעוניין למכור אותו לקונה, הכל
                        בהתאם לתנאים המפורטים בהסכם זה;
                    </li>
                </ul>

                <h2>
                    לפיכך הוצהר בין הוסכם והותנה בין הצדדים כדלקמן :
                </h2>

                <ol>
                    <li>
                        המבוא להסכם זה מהווה חלק בלתי נפרד הימנו.
                    </li>
                    <li>הוסכם כי הקונה ירכוש את הרכב מהמוכר בהתאם למחיר המסוכם בסע' 3 להלן.</li>
                    <li>התמורה בגין רכישת הרכב היא __________ ₪ ( במילים ______________)</li>
                    <li>המוכר מתחייב להעביר את הבעלות על שם הקונה כשהרכב נקי מכל עיקול / שעבוד/ קנסות/ משכון/ כל מניעה אחרת.</li>
                    <li>ככל ובעתיד יתברר כי על הרכב רובצים חובות בגין קנסות ו/או מכל סיבה שהיא שנוצרו בתקופה שהרכב היה בבעלות המוכר מתחייב המוכר לסלקם מיידית. החל מיום העברת הבעלות כל הדוחות / קנסות / אגרות/ תשלומים שוטפים יחולו על הקונה.</li>
                    <li>ככל ובזמן שיחלוף בין חתימת הסכם זה ועד העברת הבעלות ישתנה מצבו של הרכב עקב תאונה ו/או תקלה ו/או מכל סיבה שהיא, יהא הקונה זכאי לבטל הסכם זה והתמורה ששולמה בסע' 3.א תוחזר לו.</li>
                    <li>תשלום העברת הבעלות יחול על הקונה / מוכר .</li>
                    <li>הקונה מצהיר כי ידוע לו שהביטוח שהיה על הרכב מבוטל החל מרגע העברת הבעלות והאחריות לרכישת ביטוח מרגע העברת הבעלות על שמו היא על הקונה .</li>
                    <li>המוכר מצהיר כי לא נעשתה ברכב תאונה אשר גרמה לרכב לירידת ערך.
                    </li>
                </ol>

            </div>





            <div class="flex items-center justify-between">
                <div class="flex items-center">


                </div>

                <div class="mx-auto md:max-w-7xl sm:px-0 lg:px-6 lg:px-8" style="direction: rtl;">
                    <div class="max-w-2xl p-2 mx-auto lg:text-right"
                         style="background-color: {{ $data['user']->contract_color }}; border: 1px solid gray">
                        <div class="flex justify-between">
                            <div class="flex flex-col items-center">
                                <strong class="underline">
                                    {{ $data['contract']->type === 3 ? 'פרטי השולח' : 'פרטי הספק' }}
                                </strong>
                                <strong>
                                    {{ $data['user']->comp_name }}
                                </strong>
                                <span>
                            @if($data['user']->licensed_dealer)
                                        ח.פ &nbsp; {{ $data['user']->comp_id }}
                                    @else
                                        ע.פ &nbsp; {{ $data['user']->comp_id }}
                                    @endif
                        </span>
                                <span>
                            <p>{{ $data['user']->comp_address }}</p>
                        </span>
                                <span>
                            <a href="mailto:{{$data['user']->comp_email}}"> {{ $data['user']->comp_email }}</a>
                        </span>
                                <span>
                            <a href="tel:{{$data['user']->comp_phone}}"> {{ $data['user']->comp_phone }}</a>
                        </span>
                            </div>

                            <div class="flex flex-col items-center">
                                <strong class="underline">
                                    {{ $data['contract']->type === 3 ? 'פרטי המקבל' : 'פרטי הלקוח' }}
                                </strong>
                                <strong><span>{{ $data['customer']-> fullName }}</span></strong>
                                <span>{{ $data['customer']->uid }}</span>
                                <span>{{ $data['customer']->phone }}</span>
                                @if($data['contract']->type === 3 || $data['contract']->type === 4)
                                    <span>{{ $data['contract']->email }}</span>
                                @else
                                    <span>{{ $data['customer']->address . ', ' . $data['customer']-> city }}</span>
                                @endif

                            </div>
                        </div>
                        <br>
                        @if($data['contract']->type === 1 || $data['contract']->type === 2 || $data['contract']->type === 4)
                            <table class="w-full text-center border border-collapse table-auto border-slate-600">
                                <thead class="text-center text-white bg-black">
                                <tr>
                                    <th>פירוט</th>
                                    <th>מחיר ליחידה</th>
                                    <th>כמות</th>
                                    <th>סה"כ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data['contract']->items as $item)
                                    <tr>
                                        <td class="pr-2 text-right border border-slate-600">{{ $item['name'] }}</td>
                                        <td class="border border-slate-600">{{ $item['price'] }}</td>
                                        <td class="border border-slate-600">{{ $item['count'] }}</td>
                                        <td class="border border-slate-600">{{ $item['price'] * $item['count']}} ₪</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="pl-1 text-left">סה"כ {{ $data['contract']->getTotalPriceAttribute() }}
                                        ₪
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="pl-1 font-bold text-left">סה"כ לתשלום <span
                                            class='pl-1 pr-1 text-2xl text-white bg-black/50'>{{ $data['contract']->getTotalPriceAttribute() }} ₪ </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        @elseif($data['contract']->type === 3)

                        @endif

                        @if($data['contract']->type === 1 || $data['contract']->type === 2 || $data['contract']->type === 4)
                            <div class="pr-1 mx-auto max-w-7xl">
                                <div class="max-w-2xl mx-auto ">
                                    <h2 class="font-semibold text-right text-black-600">הערות נוספות</h2>
                                    @if(! is_string($data['contract']->contracts_content))
                                        {!! $data['contract']->contracts_content !!}
                                    @else
                                        {!!  $data['contract']->contracts_content ?? '' !!}
                                        {!!  $data['contract']->contracts_content['contracts_content'] ?? ''!!}
                                    @endif

                                </div>
                            </div>
                            <br>
                            @if($data['user']->custom_text != null && $data['user']->custom_text !== '')
                                <div class="pr-1 mx-auto max-w-7xl">
                                    <div class="max-w-2xl mx-auto ">
                                        <h2 class="font-semibold text-right text-black-600">תנאים והגבלות</h2>
                                        {!! $data['user']->custom_text !!}
                                    </div>
                                </div>
                            @endif
                            <br>
                            <div class="flex items-end justify-start columns-2">
                                <div class="w-full text-right">
                                    <div>
                                        <strong>מאשר {{ $data['contract']->type === 1 ? 'הצעת המחיר' : 'חוזה' }}
                                            :</strong>
                                        {{ $data['user']-> name}}
                                    </div>
                                    <div style="display: flex; justify-content: right; align-items: end">
                                        <strong>חתימה : </strong>
                                        <img class="border-b border-b-2 border-black" style="height: 50px;"
                                             src="{{ $data['user']-> signature}}" alt="">
                                    </div>
                                </div>
                                <div class="w-full text-left">
                                    <div>
                                        <strong>חתימת לקוח:</strong>
                                        {{ $data['customer']-> fullName}}
                                    </div>
                                    <div style="display: flex; justify-content: left; align-items: end">
                                        <strong>חתימה : </strong>
                                        @if($data['contract']-> signed_url !== null && $data['contract']-> signed_url !== '' && $data['contract']-> signed_url ?? '' !== '')
                                            <img class="border-b border-b-2 border-black"
                                                 style="height: 50px; background-color: rgba(0,254,255,0)"
                                                 src="{{ \Illuminate\Support\Facades\Storage::url('/'). 'signatures/' .$data['contract']-> signed_url}}"
                                                 alt="">
                                        @else
                                            <div class="text-center border-b border-b-2 border-black" id="no-signed">
                                                עדיין לא נחתם
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        @elseif($data['contract']->type === 3)
                            <h2 class="m-auto text-3xl text-center">{{ $data['contract']->title }}</h2>
                            <div class="m-auto border-2 border-black">
                                @if($data['height'] > 0)
                                    {{-- for loop untile data['numberOfPages'] --}}
                                    @for($i = 1; $i < $data['numberOfPages']; $i++)
                                        <img class="w-full m-auto" id="contracts_content"
                                             src="{{ \Illuminate\Support\Facades\Storage::url('/') . $data['pathToImage'] . '/' . $i . '.jpg' }}"
                                             alt="">
                                    @endfor

                                @else
                                    <img class="w-full m-auto" id="contracts_content"
                                         src="{{ \Illuminate\Support\Facades\Storage::url('/') . $data['contract']->contracts_content }}"
                                         alt="">
                                @endif
                            </div>

                            <br>
                            @if($data['contract']->type === 2 && $data['user']->custom_text != null && $data['user']->custom_text !== '')
                                <div class="pr-1 mx-auto max-w-7xl">
                                    <div class="max-w-2xl mx-auto ">
                                        <h2 class="font-semibold text-right text-black-600">תנאים והגבלות</h2>
                                        {!! $data['user']->custom_text !!}
                                    </div>
                                </div>
                            @endif
                            <br>
                            <div class="flex items-end justify-start columns-2">
                                <div class="w-full text-right">
                                    <div>
                                        <strong>מאשר המסמך:</strong>
                                        {{ $data['user']-> name}}
                                    </div>
                                    <div style="display: flex; justify-content: right; align-items: end">
                                        <strong>חתימה : </strong>
                                        <img class="border-b border-b-2 border-black" style="height: 50px;"
                                             src="{{ $data['user']-> signature}}" alt="">
                                    </div>
                                </div>
                                <div class="w-full text-left">
                                    <div>
                                        <strong>חתימה:</strong>
                                        {{ $data['customer']-> fullName}}
                                    </div>
                                    <div style="display: flex; justify-content: left; align-items: end">
                                        <strong>חתימה : </strong>
                                        @if($data['contract']->signed_url !== null && $data['contract']->signed_url !== '')
                                            <img class="border-b border-b-2 border-black"
                                                 style="height: 50px; background-color: rgba(0,254,255,0)"
                                                 src="{{ \Illuminate\Support\Facades\Storage::url('/'). 'signatures/' .$data['contract']-> signed_url}}"
                                                 alt="">
                                        @else
                                            <div class="text-center border-b border-b-2 border-black" id="no-signed">
                                                עדיין לא נחתם
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif


                    </div>
                    <div class="flex flex-col items-center justify-center digital-holder">
                        <img id="digital"
                             src="{{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/digitalsi.png' }}"
                             alt="digital signatures">
                    </div>
                    {{--Signature Start--}}

                    @if($data['contract']->signed === 0)
                        <div class="text-2xl text-center" id="after"></div>
                        <div x-data="{ modelOpen: false }" id="before">
                            <button @click="modelOpen =!modelOpen"
                                    class="flex items-center justify-center px-3 py-2 mt-2 mb-2 ml-auto mr-auto space-x-2 text-2xl tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                </svg>
                                <span>&nbsp; לחתימה דיגיטלית</span>
                            </button>

                            <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto"
                                 aria-labelledby="modal-title"
                                 role="dialog" aria-modal="true">
                                <div
                                    class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                                    <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                                         x-transition:enter="transition ease-out duration-300 transform"
                                         x-transition:enter-start="opacity-0"
                                         x-transition:enter-end="opacity-100"
                                         x-transition:leave="transition ease-in duration-200 transform"
                                         x-transition:leave-start="opacity-100"
                                         x-transition:leave-end="opacity-0"
                                         class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40"
                                         aria-hidden="true"
                                    ></div>

                                    <div x-cloak x-show="modelOpen"
                                         x-transition:enter="transition ease-out duration-300 transform"
                                         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                         x-transition:leave="transition ease-in duration-200 transform"
                                         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                         class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                                    >
                                        <div class="flex items-center justify-between space-x-4">
                                            <button @click="modelOpen = false"
                                                    class="text-gray-600 focus:outline-none hover:text-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </button>
                                        </div>

                                        <p class="mt-2 text-center text-gray-500 ">
                                            נא לחתום במרכז המשטח
                                        </p>

                                        <form @submit.prevent="()=>{send_signature()}" class="mt-5">
                                            <div>
                                                <canvas class="ml-auto mr-auto bg-white border-2" id="signature"
                                                        name="signature"></canvas>
                                            </div>

                                            <div class="mt-4">


                                                <div class="flex justify-center mt-6">
                                                    <button type="submit"
                                                            class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                                        שלח חתימה
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="flex flex-row-reverse items-center justify-center pb-4 sm:items-center">
                    <div class="flex items-start flex-shrink-0 sm:items-center">
                        <img class="block w-auto h-14 sm:align-middle"
                             src="{{ \Illuminate\Support\Facades\Storage::url('/') .  $data['system_data']->logo_url}}"
                             alt="Your Company">
                    </div>
                    <div class=" sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="{{ url('/') }}" class="px-3 py-2 text-2xl font-bold text-black rounded-md "
                               {{--                                   aria-current="page">MY-SAFE - מערכת לשליחת הצעות מחיר וחתימה דיגיטאלית</a>--}}
                               aria-current="page"><p style="direction: rtl"
                                                      class="mt-2 font-bold tracking-tight text-gray-900 md:text-sm sm:text-sm ">
                                    מסמך זה
                                    נוצר על ידי
                                    מערכת MY-SAFE לשליחת הצעות מחיר וחתימה דיגיטאלית</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="max-w-2xl p-1 mx-auto text-right rtl bg-gray-400/100">
                    <p class="mt-2 tracking-tight text-center text-white" style="direction: rtl;">
                        בכל מקרה של שאלה או בעיה אפשר לפנות למייל
                        <a
                            style="color: #0d83dd;"
                            href={{'mailto:' . 'mysafe.events@gmail.com'}}>{{ ' - ' . 'mysafe.events@gmail.com' }}</a>
                    </p>
                    <div class="flex justify-center pt-2 space-x-4 text-right">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a style="direction: rtl" href="{{ url('/') }}" class="tracking-tight"
                           aria-current="page">כל הזכויות שמורות ל- MY-SAFE - מערכת חכמה לשליחת חוזים והצעות מחיר לכל
                            העסקים</a>
                    </div>
                </div>


                <style>
                    .digital-holder {
                        margin-top: -60px;
                    }

                    #digital {
                        width: 200px;
                    }

                    @media (max-width: 750px) {
                        body {

                        }


                        .digital-holder {
                            margin-top: -7px;
                            margin-bottom: -12px;
                        }

                        #digital {
                            width: 120px;
                        }
                    }

                    body {
                        --tw-bg-opacity: 1;
                        background-color: rgb(243 244 246 / var(--tw-bg-opacity));
                    }

                    ol {
                        list-style: decimal;
                        padding-right: 1.2rem;
                    }

                    ul {
                        list-style: disc;
                        padding-right: 1.2rem;
                    }

                    .flex.flex-col a {
                        color: #0d83dd;
                    }
                </style>
                <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
                        integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
                        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script>

                    const canvas = document.querySelector("#signature");
                    const signaturePad = new SignaturePad(canvas, {
                        minWidth: 1,
                        maxWidth: 2,
                        penColor: "rgb(0,0,0)",
                    });

                    function send_signature() {
                        let image = signaturePad.toDataURL();
                        axios.post('{{ route('contract.update', ['contract' => $data['contract']->id]) }}', {
                            data: image
                        }).then(function (response) {
                            document.getElementById('before').textContent = 'החתימה נשלחה בהצלחה';
                            document.getElementById('before').style.textAlign = 'center';
                            document.getElementById('before').style.fontSize = '1.5rem';
                            document.location.reload();
                        })
                            .catch(function (response) {
                                console.log(response);
                            })
                    }

                    /*window.onload = function () {

@if(!$data['contract']->signed === 0)
                    html2canvas(document.querySelector("body")).then(canvas => {
                        axios.post('{{ route('contract.uploadImage', ['contract' => $data['contract']->id]) }}', {
                        data: canvas.toDataURL()
                    }).then(function (response) {
                        console.log(response);
                    })
                        .catch(function (response) {
                            console.log(response);
                        })
                });
                @endif
                    }*/

                    function send_image() {
                        html2canvas(document.querySelector("body")).then(canvas => {
                            axios.post('{{ route('contract.uploadImage', ['contract' => $data['contract']->id]) }}', {
                                data: canvas.toDataURL()
                            }).then(function (response) {
                                console.log(response);
                            })
                                .catch(function (response) {
                                    console.log(response);
                                })
                        });
                    }

                </script>
                <style>
                    body {
                        background-color: white;
                    }
                </style>

    </x-slot:body>

    <style></style>
    <script>

    </script>
</x-layouts.master>
