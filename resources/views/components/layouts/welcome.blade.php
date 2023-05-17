<x-layouts.master>
    <x-slot name="title">
        home
    </x-slot>

    <x-slot:body>
        <img class="background-img desktop absolute h-screen right-0 w-full"
             src="{{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/desktop/background.png' }}"
             alt="">
        <img class="background-img mobile absolute h-screen right-0 w-full"
             src="{{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/mobile/background.png' }}"
             alt="">
        <div class="base-form w-full flex">
            <div class="text-center form-container">
                <img class="m-auto logo"
                     src="{{ \Illuminate\Support\Facades\Storage::url('') . '/layout/desktop/logo.png' }}"
                     alt="">

                @livewire('welcome')
            </div>
        </div>

        <style>
            .background-img {
                z-index: -1;
            }

            .background-img.mobile {
                display: none;
            }

            .background-img.desktop {
                display: block;
            }

            .form-container {
                height: 95vh;
                width: 34vw;
                margin-left: 2vw;
                margin-top: 2.5vh;
                background-size: 100% 100%;
                background-image: url({{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/desktop/Rectangle2.png' }});
                background-repeat: no-repeat;
            }

            .logo {
                height: 15vi;
                margin-top: 2vi;
            }

            h2 {
                direction: rtl;
                font-weight: bold;
                color: #8447FF;
                font-size: 1.8vi;
                line-height: 100px;
            }

            .input {
                direction: rtl;
                height: 3vi;
                width: 20vi;
                border-radius: 20px;
                box-shadow: 0px 11px 9px 0px #888888a8;
                border: 1px solid #ccc;
                padding: 0.5em;
                font-size: 1rem;
                background-color: #F3F4F6;
            }

            .form-container form {
                min-height: 40%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                position: inherit;
            }

            @media (max-width: 650px) {
                .form-container form {
                    min-height: 40%;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    position: absolute;
                    bottom: 0px;
                    left: 0;
                    right: 0;
                }
            }

            .button {
                width: 100%;
                max-width: 10vi;
                height: 3vi;
                background-color: #8447FF;
                color: #fff;
                border: none;
                border-radius: 20px;
                box-shadow: 0px 11px 9px 0px #888888a8;
                cursor: pointer;
                font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                font-weight: bold;
                font-size: larger;
            }

            .button:hover {
                background-color: #8447FF;
            }

            .button:hover {
                background-color: #8447FF;
            }

            .button:focus {
                outline: none;
                box-shadow: 0px 0px 0px 3px rgba(0, 123, 255, 0.4);
            }

            /* Media queries for mobile */
            @media screen and (max-width: 768px) {
                .background-img.desktop {
                    z-index: -1;
                    display: none;
                }

                .background-img.mobile {
                    display: block;
                }

                h2 {
                    display: none;
                }


                .form-container {
                    height: auto;
                    width: 100%;
                    margin-left: 0;
                    margin-top: 0;
                    background-size: cover;
                    background-position: center;
                    padding: 2rem;
                    background-image: none;
                }


                .logo {
                    height: 7vw;
                    margin-top: 1vw;
                    margin-bottom: 1vw;
                    display: none;
                }

                h2 {
                    font-size: 1rem;
                    margin-top: 1vw;
                    margin-bottom: 2vw;
                }

                .input {
                    height: 2.5rem;
                    width: 100%;
                    border-radius: 10px;
                }

                .button {
                    width: 65%;
                    max-width: none;
                    height: 2.2rem;
                    font-size: 0.9rem;
                    border-radius: 10px;
                }

                .base-form {
                    position: absolute;
                    bottom: 0;
                }

                form {
                    padding-left: 3rem;
                    padding-right: 3rem;
                    padding-bottom: 2rem;

                }

                .mb-6 {
                    margin-bottom: calc(1.5rem / 2);
                }
            }
        </style>
    </x-slot:body>
</x-layouts.master>
