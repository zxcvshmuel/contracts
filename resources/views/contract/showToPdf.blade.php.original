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
            {{--<div class="pt-4 mx-auto lg:max-w-2xl sm:w-full sm:pr-1">
                <div class="relative flex items-center justify-between h-16">
                    <div class="flex items-center justify-center flex- sm:items-center">
                        <div class="flex items-start flex-shrink-0 sm:items-center">
                            <img class="block w-auto h-14 sm:align-middle"
                                 src="{{ \Illuminate\Support\Facades\Storage::url('/') .  $data['system_data']->logo_url}}"
                                 alt="Your Company">
                        </div>
                        <div class=" sm:ml-6 sm:block">
                            <div class="flex space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <a href="{{ url('/') }}" class="px-3 py-2 text-2xl font-bold text-black rounded-md "
                                   --}}{{--                                   aria-current="page">MY-SAFE - מערכת לשליחת הצעות מחיר וחתימה דיגיטאלית</a>--}}{{--
                                   aria-current="page"><p style="direction: rtl"
                                                          class="mt-2 font-bold tracking-tight text-gray-900 md:text-sm sm:text-sm ">
                                        מסמך זה
                                        נוצר על ידי
                                        מערכת MY-SAFE לשליחת הצעות מחיר וחתימה דיגיטאלית</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}
            <div class="flex items-center justify-center flex- sm:items-center">
                <div class="flex items-start flex-shrink-0 sm:items-center">
                    <img class="block w-auto h-20 sm:align-middle"
                         src="{{ \Illuminate\Support\Facades\Storage::url('/') .  $data['user']->logo_url}}"
                         alt="Your Company">
                </div>
            </div>
        </nav>
        <div class="pt-0">
            <div class="px-6 mx-auto max-w-7xl lg:px-8">
                <div class="max-w-2xl mx-auto text-center">
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

                    @elseif($data['contract']->type === 2)
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
                    @elseif($data['contract']->type === 3)
                        <h2 class="text-2xl font-semibold leading-7 text-indigo-600">מסמך לחתימה</h2>
                        <div class="flex flex-row justify-center">
                            <a class="px-2"
                               href="https://wa.me/?text=כנס ללינק המצורף כדי לראות את המסמך שלי - {{ urldecode('https://my-safe.co.il/contract/' . $data['contract']->id .  '/view') }}">
                                <img style="height: 50px;"
                                     src="{{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/whatsapp.png' }}"
                                     alt="">
                            </a>
                            <a class="px-2"
                               href="mailto:?subject=אני רוצה לשתף אתך את המסמך שלי &amp;body= כנס ללינק המצורף כדי לראות את המסמך - {{ urldecode('https://my-safe.co.il/contract/' . $data['contract']->id .  '/view') }}">
                                <img style="height: 50px;"
                                     src="{{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/gmail.png' }}"
                                     alt="">
                            </a>
                        </div>
                        <div class="flex flex-col items-end">
                            <span>{{ date('d/m/Y') }}</span>
                            <strong><span>{{ 'לכבוד: ' . $data['customer']-> fullName }}</span></strong>
                            <span>
                                    <strong>מספר מסמך
                                        - {{$data['contract']->id}}</strong>
                        </span>
                        </div>
                        <p class="mt-2 text-lg leading-8 text-gray-600">עיין בפרטים וחתום דיגיטלית בתחתית
                            המסמך</p>
                    @elseif($data['contract']->type === 4)
                        <h2 class="text-2xl font-semibold leading-7 text-indigo-600">חוזה לחתימה</h2>
                        <div class="flex flex-row justify-center">
                            <a class="px-2"
                               href="https://wa.me/?text=כנס ללינק המצורף כדי לראות את החוזה שלי - {{ urldecode('https://my-safe.co.il/contract/' . $data['contract']->id .  '/view') }}">
                                <img style="height: 50px;"
                                     src="{{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/whatsapp.png' }}"
                                     alt="">
                            </a>
                            <a class="px-2"
                               href="mailto:?subject=אני רוצה לשתף אתך את החוזה שלי &amp;body= כנס ללינק המצורף כדי לראות את החוזה - {{ urldecode('https://my-safe.co.il/contract/' . $data['contract']->id .  '/view') }}">
                                <img style="height: 50px;"
                                     src="{{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/gmail.png' }}"
                                     alt="">
                            </a>
                        </div>
                        <div class="flex flex-col items-end">
                            <span>{{ date('d/m/Y') }}</span>
                            <strong><span>{{ 'לכבוד: ' . $data['customer']-> fullName }}</span></strong>
                            <span>
                                    <strong>מספר חוזה
                                        - {{$data['contract']->id}}</strong>
                        </span>
                        </div>
                        <p class="mt-2 text-lg leading-8 text-gray-600">עיין בפרטים וחתום דיגיטלית בתחתית
                            החוזה</p>
                    @endif
                    {{--                    <h2 class="text-base font-semibold leading-7 text-indigo-600">הצעת מחיר / חוזה לחתימה</h2>--}}
                    {{--<p style="direction: rtl"
                       class="mt-2 font-bold tracking-tight text-gray-900 md:text-2xl sm:text-1xl "> מסמך זה
                        נוצר על ידי
                        מערכת MY-SAFE לשליחת הצעות מחיר וחתימה דיגיטאלית</p>--}}
                </div>
            </div>
        </div>

        <div class="mx-auto md:max-w-7xl sm:px-0 lg:px-6 lg:px-8" style="direction: rtl;">

            <div class="max-w-2xl p-2 mx-auto lg:text-right"
                 style="background-color: {{ $data['user']->contract_color }}; border: 1px solid gray">
                 <div class="flex justify-center w-full" style="text-align: center;">
                    <h2 class="text-3xl font-semibold leading-7 text-black-600">{{ $data['contract']->title }}</h2>
                </div>
                <div class="flex justify-center w-full" style="text-align: center;">
                    <h2 class="text-lg leading-8 text-gray-600 fomt-2">{{ $data['contract']->description }}</h2>
                </div>
                <div class="">

                    <div style="float: right;width: fit-content" class="">
                        <strong style="text-decoration: underline; text-align: center; font-weight: bold"
                                class="underline">
                            {{ $data['contract']->type === 3 ? 'פרטי השולח' : 'פרטי הספק' }}                        </strong>
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
                        <img class="w-1/4 h-auto"
                             src="{{ \Illuminate\Support\Facades\Storage::url('/') .  $data['user']->logo_url}}"
                             alt="">
                    </div>--}}
                    <div style="float: left; text-align: left;" class="flex flex-col items-center">
                        <strong style="text-decoration: underline; text-align: center; font-weight: bold"
                                class="underline">
                            {{ $data['contract']->type === 3 ? 'פרטי המקבל' : 'פרטי הלקוח' }}                        </strong>
                        <br>
                        <strong><span>{{ $data['customer']->fullName }}</span></strong>
                        @if($data['contract']->type === 3 || $data['contract']->type === 4)
                            <br>
                            <span>{{ $data['customer']->uid ?? ''}}</span>
                            <br>
                            <span>{{ $data['customer']->phone ?? '' }}</span>
                            <br>
                            <span>{{ $data['contract']->email }}</span>
                        @else
                            <br>
                            <span>{{ $data['customer']->uid ?? ''}}</span>
                            <br>
                            <span>{{ $data['customer']->phone ?? '' }}</span>
                            <br>
                            <span>{{ $data['customer']->address . ' ' . $data['customer']-> city }}</span>
                        @endif
                    </div>
                </div>
                <br>
                @if($data['contract']->type === 1 || $data['contract']->type === 2 || $data['contract']->type === 4)
                    <table style="border: 1px solid #1a1a1a"
                           class="table w-full text-center border border-collapse table-auto border-slate-600">
                        <thead style="color: white; text-align: center; background-color: black"
                               class="text-center text-white bg-black">
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
                                <td style="border: 1px solid black"
                                    class="pr-2 text-right border border-slate-600">{{ $item['name'] }}</td>
                                <td style="border: 1px solid black"
                                    class="border border-slate-600">{{ $item['price'] }}</td>
                                <td style="border: 1px solid black"
                                    class="border border-slate-600">{{ $item['count'] }}</td>
                                <td style="border: 1px solid black"
                                    class="border border-slate-600">{{ $item['price'] * $item['count']}} ₪
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="border: 1px solid black" class="pl-1 text-left">
                                סה"כ {{ $data['contract']->getTotalPriceAttribute() }} ₪
                            </td>
                        </tr>
                        @if ($data['user']->licensed_dealer && $data['contract']->created_at > '2024-03-11)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="pl-1 text-left">מע"מ {{ $data['contract']->getTotalPriceAttribute() * 0.17 }} ₪</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="pl-1 font-bold text-left">סה"כ לתשלום <span
                                    class='pl-1 pr-1 text-2xl text-white bg-black/50'>{{ $data['contract']->getTotalPriceAttribute() + $data['contract']->getTotalPriceAttribute() * 0.17 }} ₪ </span>
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="pl-1 font-bold text-left">סה"כ לתשלום <span
                                    class='pl-1 pr-1 text-2xl text-white bg-black/50'>{{ $data['contract']->getTotalPriceAttribute() }} ₪ </span>
                            </td>
                        </tr>
                        @endif
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

                    <br>
                    <div class="flex items-end justify-start columns-2">
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


            <div style="text-align:center; margin-top: -60px;">
                <div style="float:right;">
                    <img id="digital" style="width: 200px; margin-top: -60px;"
                         src="{{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/digitalsi.png' }}"
                         alt="digital signatures">
                </div>
            </div>

            {{--Signature Start--}}


        </div>
        <div style="text-align:center; margin-top: 3rem">
            <div style="float:right;">
                <img class="h-14"
                     src="{{ \Illuminate\Support\Facades\Storage::url('/') .  $data['system_data']->logo_url}}"
                     alt="Your Company">
            </div>
            <div style="float:left;">
                <a href="{{ url('/') }}" class="px-3 py-2 text-2xl font-bold text-black rounded-md "
                   aria-current="page">
                    <p style="direction: rtl" class="mt-2 font-bold tracking-tight text-gray-900 md:text-sm sm:text-sm">
                        מסמך זה
                        נוצר על ידי
                        מערכת MY-SAFE לשליחת הצעות מחיר וחתימה דיגיטאלית
                    </p>
                </a>
            </div>
        </div>


        {{--<div class="flex flex-row-reverse items-center justify-center pb-4 sm:items-center">
            <div style="direction: rtl; width: fit-content" class="sm:ml-3 sm:block ">
                <img class="block w-auto h-14 sm:align-middle"
                     src="{{ \Illuminate\Support\Facades\Storage::url('/') .  $data['system_data']->logo_url}}"
                     alt="Your Company">
            </div>
            <div class=" sm:ml-6 sm:block">
                <div class="flex space-x-4">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                    <a href="{{ url('/') }}" class="px-3 py-2 text-2xl font-bold text-black rounded-md "
                       --}}{{--                                   aria-current="page">MY-SAFE - מערכת לשליחת הצעות מחיר וחתימה דיגיטאלית</a>--}}{{--
                       aria-current="page"><p style="direction: rtl"
                                              class="mt-2 font-bold tracking-tight text-gray-900 md:text-sm sm:text-sm ">
                            מסמך זה
                            נוצר על ידי
                            מערכת MY-SAFE לשליחת הצעות מחיר וחתימה דיגיטאלית</p>
                    </a>
                </div>
            </div>
        </div>--}}
        <div class="max-w-2xl p-1 mx-auto text-right rtl bg-gray-400/100">
            <p class="mt-2 tracking-tight text-center text-white" style="direction: rtl;">
                בכל מקרה של שאלה או בעיה אפשר לפנות למייל
                <a
                    style="color: #0d83dd;"
                    href={{'mailto:' . 'mysafe.events@gmail.com'}}>{{ ' - ' . 'mysafe.events@gmail.com' }}</a>
            </p>
            <div class="flex justify-center pt-2 space-x-4 text-center">
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
