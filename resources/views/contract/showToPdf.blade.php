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
            {{--<div class="mx-auto lg:max-w-2xl sm:w-full pt-4 sm:pr-1">
                <div class="relative flex h-16 items-center justify-between">
                    <div class="flex flex- items-center justify-center sm:items-center">
                        <div class="flex flex-shrink-0 items-start sm:items-center">
                            <img class="block h-14 w-auto sm:align-middle"
                                 src="{{ \Illuminate\Support\Facades\Storage::url('/') .  $data['system_data']->logo_url}}"
                                 alt="Your Company">
                        </div>
                        <div class=" sm:ml-6 sm:block">
                            <div class="flex space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <a href="{{ url('/') }}" class=" text-black font-bold text-2xl rounded-md px-3 py-2"
                                   --}}{{--                                   aria-current="page">MY-SAFE - מערכת לשליחת הצעות מחיר וחתימה דיגיטאלית</a>--}}{{--
                                   aria-current="page"><p style="direction: rtl"
                                                          class="mt-2 md:text-sm sm:text-sm font-bold tracking-tight text-gray-900 ">
                                        מסמך זה
                                        נוצר על ידי
                                        מערכת MY-SAFE לשליחת הצעות מחיר וחתימה דיגיטאלית</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}
            <div class="flex flex- items-center justify-center sm:items-center">
                <div class="flex flex-shrink-0 items-start sm:items-center">
                    <img class="block h-20 w-auto sm:align-middle"
                         src="{{ \Illuminate\Support\Facades\Storage::url('/') .  $data['user']->logo_url}}"
                         alt="Your Company">
                </div>
            </div>
        </nav>
        <div class="pt-0">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    @if($data['contract']->type === 1)
                        <h2 class="text-2xl font-semibold leading-7 text-indigo-600">הצעת מחיר בין ספק ללקוח</h2>
                        {{--<div class="flex flex-row justify-center">
                            <a class="px-2" href="https://wa.me/?text=כנס ללינק המצורף כדי לראות את החוזה שלי - {{ urldecode('https://my-safe.co.il/contract/' . $data['contract']->id .  '/view') }}">
                                <img style="height: 50px;" src="{{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/whatsapp.png' }}" alt="">
                            </a>
                            <a class="px-2" href="mailto:?subject=אני רוצה לשתף אתך את החוזה שלי &amp;body= כנס ללינק המצורף כדי לראות את החוזה - {{ urldecode('https://my-safe.co.il/contract/' . $data['contract']->id .  '/view') }}">
                                <img style="height: 50px;" src="{{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/gmail.png' }}" alt="">
                            </a>
                        </div>--}}
                        <div class="flex flex-col items-end">
                            <span>{{ date('d/m/Y') }}</span>
                            <strong><span>{{ 'לכבוד: ' . $data['customer']-> fullName }}</span></strong>
                            <span>
                            <strong>מספר {{ $data['contract']->type === 1 ? 'הצעת מחיר' : 'חוזה' }}
                            - {{$data['contract']->id}}</strong>
                        </span>
                        </div>

                    @else
                        <h2 class="text-2xl font-semibold leading-7 text-indigo-600">חוזה עבודה בין ספק ללקוח</h2>
                        {{--<div class="flex flex-row justify-center">
                            <a class="px-2" href="https://wa.me/?text=כנס ללינק המצורף כדי לראות את החוזה שלי - {{ urldecode('https://my-safe.co.il/contract/' . $data['contract']->id .  '/view') }}">
                                <img style="height: 50px;" src="{{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/whatsapp.png' }}" alt="">
                            </a>
                            <a class="px-2" href="mailto:?subject=אני רוצה לשתף אתך את החוזה שלי &amp;body= כנס ללינק המצורף כדי לראות את החוזה - {{ urldecode('https://my-safe.co.il/contract/' . $data['contract']->id .  '/view') }}">
                                <img style="height: 50px;" src="{{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/gmail.png' }}" alt="">
                            </a>
                        </div>--}}
                        <div class="flex flex-col items-end">
                            <span>{{ date('d/m/Y') }}</span>
                            <strong><span>{{ 'לכבוד: ' . $data['customer']-> fullName }}</span></strong>
                            <span>
                            <strong>מספר {{ $data['contract']->type === 1 ? 'הצעת מחיר' : 'חוזה' }}
                            - {{$data['contract']->id}}</strong>
                        </span>
                        </div>

                    @endif
                    {{--                    <h2 class="text-base font-semibold leading-7 text-indigo-600">הצעת מחיר / חוזה לחתימה</h2>--}}
                    {{--<p style="direction: rtl"
                       class="mt-2 md:text-2xl sm:text-1xl font-bold tracking-tight text-gray-900 "> מסמך זה
                        נוצר על ידי
                        מערכת MY-SAFE לשליחת הצעות מחיר וחתימה דיגיטאלית</p>--}}
                </div>
            </div>
        </div>

        <div class="mx-auto md:max-w-7xl sm:px-0  lg:px-6 lg:px-8" style="direction: rtl;">
            <div class="mx-auto max-w-2xl lg:text-right p-2"
                 style="background-color: rgba(44,180,243,0.3); border: 1px solid gray">
                <div class="">
                    <div style="float: right;width: fit-content" class="">
                        <strong style="text-decoration: underline; text-align: center; font-weight: bold" class="underline">
                            פרטי הספק
                        </strong>
                        <br>
                        <strong>
                            {{ $data['user']->comp_name }}
                        </strong>
                        <br>
                        <span>
                            @if($data['user']->licensed_dealer)
                                ח.פ &nbsp; {{ $data['user']->comp_id }}
                            @else
                                ע.פ &nbsp; {{ $data['user']->comp_id }}
                            @endif
                        </span>
                        <br>
                        <span>
                            <p>{{ $data['user']->comp_address }}</p>
                        </span>
                        <span>
                             {{ $data['user']->comp_email }}
                        </span>
                        <br>
                        <span>
                             {{ $data['user']->comp_phone }}
                        </span>
                    </div>
                    {{--<div class="flex flex-col items-center">
                        <span>{{ date('d/m/Y') }}</span>
                        <span>
                            <strong>מספר {{ $data['contract']->type === 1 ? 'הצעת מחיר' : 'חוזה' }}
                            - {{$data['contract']->id}}</strong>
                        </span>
                        <img class="h-auto w-1/4"
                             src="{{ \Illuminate\Support\Facades\Storage::url('/') .  $data['user']->logo_url}}"
                             alt="">
                    </div>--}}
                    <div style="float: left; text-align: left;" class="flex flex-col items-center">
                        <strong style="text-decoration: underline; text-align: center; font-weight: bold" class="underline">פרטי הלקוח</strong>
                        <br>
                        <strong><span>{{ $data['customer']-> fullName }}</span></strong>
                        <br>
                        <span>{{ $data['customer']-> uid }}</span>
                        <br>
                        <span>{{ $data['customer']-> phone }}</span>
                        <br>
                        <span>{{ $data['customer']-> address . ', ' . $data['customer']-> city }}</span>
                    </div>
                </div>
                <br>
                <table style="border: 1px solid #1a1a1a"  class="table table-auto border-collapse border border-slate-600 text-center w-full">
                    <thead style="color: white; text-align: center; background-color: black" class="text-white text-center bg-black">
                    <tr>
                        <th style="color: white; text-align: center; background-color: black">פירוט</th>
                        <th style="color: white; text-align: center; background-color: black">מחיר ליחידה</th>
                        <th style="color: white; text-align: center; background-color: black">כמות</th>
                        <th style="color: white; text-align: center; background-color: black">סה"כ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['contract']->items as $item)
                        <tr>
                            <td style="border: 1px solid black" class="text-right pr-2 border border-slate-600">{{ $item['name'] }}</td>
                            <td style="border: 1px solid black" class="border border-slate-600">{{ $item['price'] }}</td>
                            <td style="border: 1px solid black" class="border border-slate-600">{{ $item['count'] }}</td>
                            <td style="border: 1px solid black" class="border border-slate-600">{{ $item['price'] * $item['count']}} ₪</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="border: 1px solid black" class="text-left pl-1">סה"כ {{ $data['contract']->getTotalPriceAttribute() }} ₪</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="border: 1px solid black; font-weight: bold" class="text-left pl-1 font-bold">סה"כ לתשלום <span
                                class='pr-1 pl-1 bg-black/50 text-white text-2xl'>{{ $data['contract']->getTotalPriceAttribute() }} ₪ </span>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="mx-auto max-w-7xl pr-1">
                    <div class="mx-auto max-w-2xl ">
                        <h2 class="text-right font-semibold text-black-600">הערות נוספות</h2>
                        {!! $data['contract']->contracts_content !!}
                    </div>
                </div>
                <br>
                <div class="columns-2 flex items-end justify-start">
                    <div style="width: fit-content; float: right;" class="w-full text-right">
                        <div>
                            <strong>מאשר {{ $data['contract']->type === 1 ? 'הצעת המחיר' : 'חוזה' }}:</strong>
                            {{ $data['user']-> name}}
                        </div>
                        <div style="display: flex; justify-content: right; align-items: end">
                            <strong>חתימה : </strong>
                            <img class="border-b border-b-2 border-black" style="height: 50px;"
                                 src="{{ $data['user']-> signature}}" alt="">
                        </div>
                    </div>
                    <div style="width: fit-content; float: left;" class="w-full text-left">
                        <div>
                            <strong>חתימת לקוח:</strong>
                            {{ $data['customer']-> fullName}}
                        </div>
                        <div style="display: flex; justify-content: left; align-items: end">
                            <strong>חתימה : </strong>
                            @if($data['contract']-> signed_url !== null && $data['contract']-> signed_url !== '')
                                <img class="border-b border-b-2 border-black"
                                     style="height: 50px; background-color: rgba(0,254,255,0)"
                                     src="{{ \Illuminate\Support\Facades\Storage::url('/'). 'signatures/' .$data['contract']-> signed_url}}"
                                     alt="">
                            @else
                                <div class="border-b border-b-2 border-black text-center" id="no-signed">
                                    עדיין לא נחתם
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>


            <div style="text-align:center; margin-top: -60px;">
                <div style="float:right;">
                    <img id="digital" style="width: 150px; margin-top: -60px;"
                         src="{{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/digitalsi.png' }}"
                         alt="digital signatures">
                </div>
            </div>

            {{--Signature Start--}}


        </div>
        <div style="text-align:center; margin-top: 3rem">
            <div style="float:right;">
                <img class="h-14" src="{{ \Illuminate\Support\Facades\Storage::url('/') .  $data['system_data']->logo_url}}" alt="Your Company">
            </div>
            <div style="float:left;">
                <a href="{{ url('/') }}" class=" text-black font-bold text-2xl rounded-md px-3 py-2" aria-current="page">
                    <p style="direction: rtl" class="mt-2 md:text-sm sm:text-sm font-bold tracking-tight text-gray-900">
                        מסמך זה
                        נוצר על ידי
                        מערכת MY-SAFE לשליחת הצעות מחיר וחתימה דיגיטאלית
                    </p>
                </a>
            </div>
        </div>


        {{--<div class="flex flex-row-reverse items-center justify-center sm:items-center pb-4">
            <div style="direction: rtl; width: fit-content" class="sm:ml-3 sm:block  ">
                <img class="block h-14 w-auto sm:align-middle"
                     src="{{ \Illuminate\Support\Facades\Storage::url('/') .  $data['system_data']->logo_url}}"
                     alt="Your Company">
            </div>
            <div class=" sm:ml-6 sm:block">
                <div class="flex space-x-4">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                    <a href="{{ url('/') }}" class=" text-black font-bold text-2xl rounded-md px-3 py-2"
                       --}}{{--                                   aria-current="page">MY-SAFE - מערכת לשליחת הצעות מחיר וחתימה דיגיטאלית</a>--}}{{--
                       aria-current="page"><p style="direction: rtl"
                                              class="mt-2 md:text-sm sm:text-sm font-bold tracking-tight text-gray-900 ">
                            מסמך זה
                            נוצר על ידי
                            מערכת MY-SAFE לשליחת הצעות מחיר וחתימה דיגיטאלית</p>
                    </a>
                </div>
            </div>
        </div>--}}
        <div class="mx-auto max-w-2xl text-right rtl bg-gray-400/100 p-1">
            <p class="mt-2 text-white text-center tracking-tight" style="direction: rtl;">
                בכל מקרה של שאלה או בעיה אפשר לפנות למייל
                <a
                    style="color: #0d83dd;"
                    href={{'mailto:' . 'mysafe.events@gmail.com'}}>{{ ' - ' . 'mysafe.events@gmail.com' }}</a>
            </p>
            <div class="flex justify-center space-x-4 pt-2 text-center">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a style="direction: rtl" href="{{ url('/') }}" class="tracking-tight"
                   aria-current="page">כל הזכויות שמורות ל- MY-SAFE - מערכת חכמה לשליחת חוזים והצעות מחיר לכל העסקים</a>
            </div>
        </div>


        <style>
            @media (max-width: 750px) {
                body {

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
                background-color: #eaf6fe00;
            }
        </style>
    </x-slot:body>

    <style></style>
</x-layouts.master>
