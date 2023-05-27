<x-filament::page>
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
                @if ($package->price > 0)
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
                        <a  wire:click="packageClick({{ $package->id }})" class="package-btn bg-blue-600 hover:bg-blue-700 text-white font-bold my-6 py-2 px-4 border border-blue-700 rounded">המשך</a>
                    </div>
        @endif
        @php
            $count++;
            if ($count == 3) {
                $count = 0;
            }
        @endphp
        @endforeach
    </x-filament::card>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto:300');

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
            z-index: 1;
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

        .mycard a {
            position: relative;
            z-index: 2;
            border-radius: 8px;
            margin: 30px auto 8px;
            text-decoration: none;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.20);
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-weight: bold;
        }

    </style>
</x-filament::page>
