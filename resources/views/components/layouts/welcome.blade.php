<x-layouts.master>
    <x-slot name="title">
        home
    </x-slot>

    <x-slot:body>
        <img class="background-img desktop absolute h-screen right-0 w-full"
             src="{{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/desktop/background010623.png' }}"
             alt="">
        <img class="background-img mobile absolute h-screen right-0 w-full"
             src="{{ \Illuminate\Support\Facades\Storage::url('/') . 'layout/mobile/backgroundbombile010623.png' }}"
             alt="">
        <div class="base-form w-full flex">
            <div class="text-center form-container">

                @livewire('welcome')
            </div>
        </div>

        <style>

            html {
                max-width: 100vw;
                max-height: 100vh;
                overflow: hidden;
            }

            .base-form{
                position: absolute;
                bottom: 115px;
                left: 35px;
            }

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
                height: auto;
                width: 36vw;
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
                height: 4vi;
                width: 30vi;
                border-radius: 20px;
                box-shadow: 0px 11px 9px 0px #888888a8;
                border: 1px solid #ccc;
                padding: 0.5em;
                font-size: 2rem;
                background-color: #F3F4F6;
                color: black;
            }

            .form-container form {
                min-height: 40%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                position: inherit;
            }

            .base-form .button{
                width: 185px;
                max-width: 10vi;
                height: 85px;
                background-color: #8447FF;
                color: #fff;
                border: none;
                border-radius: 17px;
                box-shadow: 0px 11px 9px 0px #888888a8;
                cursor: pointer;
                font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                font-weight: bold;
                font-size: 30px;
            }

            @media (max-width: 650px) {

                .base-form .button {
                    font-size: inherit;
                    height: 21px;
                    width: 83px;
                    max-width: 83px;
                }

                .form-container form {
                    min-height: 40%;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    position: absolute;
                    bottom: 0%;
                    left: -60px;
                    right: 0;
                }

                .input{
                    height: 24px;
                    width: 249px;
                    border-radius: 20px;
                    font-size: inherit;
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
                    height: 24px;
                    width: 249px;
                    border-radius: 20px;
                }

                .button {
                    width: 87px;
                    max-width: none;
                    height: 21px;
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
