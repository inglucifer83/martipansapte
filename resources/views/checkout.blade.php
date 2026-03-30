<x-html lang="{{ app()->getLocale() }}">
    <x-slot:head>
        <title>Checkout - MyShop</title>
        <meta name="keywords" content="checkout, payment, shipping">
        <meta property="og:title" content="Checkout - MyShop">
        <meta name="description"
            content="Multi-step checkout for authenticated users with shipping, payment and order summary to minimize friction.">
        <meta property="og:description"
            content="Multi-step checkout for authenticated users with shipping, payment and order summary to minimize friction.">
        <link rel="canonical" href="{{ url('checkout') }}" />
        <meta property="og:site_name" content="PrettyShop">
        <meta property="og:url" content="{{ url('checkout') }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
    </x-slot>
    <div style="width: 100vw; min-height: 100vh" class="d-flex flex-column ">
        <header style="padding: 0.5vw 1vw; background-color: var(--background)"
            class="d-flex justify-content-between align-items-center ">
            <picture>
                <source srcset="{{ iasset('storage/logo_dark.webp') }}" media="(prefers-color-scheme: dark)">
                <source srcset="{{ iasset('storage/logo.png') }}">
                <source srcset="{{ iasset('storage/logo_dark.png') }}" media="(prefers-color-scheme: dark)">
                <img src="{{ iasset('storage/logo.webp') }}" style="width: 4rem; height: 4rem; object-fit: contain">
            </picture>
            <nav style="flex: 1" class="d-flex justify-content-center align-items-center ">
                <a id="a-0" href="{{ route('home') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--primary)">
                    {{ __('labels.HOME') }}
                </a>
                <a id="a-1" href="{{ route('products.index') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--primary)">
                    {{ __('labels.SHOP') }}
                </a>
                <a id="a-2" href="{{ route('about') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--primary)">
                    {{ __('labels.ABOUT') }}
                </a>
                <a id="a-3" href="{{ route('contact') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--primary)">
                    {{ __('labels.CONTACT') }}
                </a>
                <a id="a-4" href="{{ route('orders.index') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--primary)">
                    {{ __('labels.ORDERS') }}
                </a>
                <a id="a-5" href="{{ route('account.show') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--primary)">
                    {{ __('labels.ACCOUNT') }}
                </a>
                <a id="a-6" href="{{ route('cart.show') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--primary)">
                    {{ __('labels.CART') }}
                </a>
            </nav>
            <input style="flex: 1" class=" form-control" type="search">
            @if (Route::has('login'))
                <div class="justify-content-end align-items-center ">
                    <div>
                        <button style="margin-left: 0.5vw" class=" btn btn-danger" form="form-0" type="submit">
                            {{ __('labels.LOGOUT') }}
                        </button>
                        <form id="form-0" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf</form>
                    </div>
                    <div>
                        <a id="a-7" href="{{ route('login') }}"
                            style="margin-right: 0.5vw; text-decoration: none; color: var(--primary)">
                            {{ __('labels.LOGIN') }}
                        </a>
                        <a id="a-8" href="{{ route('register') }}"
                            style="margin-left: 0.5vw; text-decoration: none; color: var(--primary)">
                            {{ __('labels.REGISTER') }}
                        </a>
                    </div>
                </div>
            @endif
        </header>
        <div style="flex: 1; min-height: 100vh; background-color: var(--background); padding: 2vw 4vw"
            class="d-flex flex-column justify-content-start align-items-stretch ">
            <main class="d-flex flex-column justify-content-start align-items-stretch container">
                <h1>
                    {{ __('checkout.CHECKOUT') }}
                </h1>
                <section class="d-flex flex-column justify-content-start align-items-stretch ">
                    <h2>
                        {{ __('checkout.SHIPPING_ADDRESS') }}
                    </h2>
                    <div style="flex-wrap: wrap" class="d-flex justify-content-center ">
                        @foreach ($addresses as $address)
                            <label class="d-flex flex-column justify-content-start align-items-stretch ">
                                <input type="radio" name="shipping_address_id" value="{{ $address->id }}">
                                <div class="d-flex flex-column justify-content-start align-items-stretch ">
                                    <strong>
                                        {{ $address->full_name }}
                                    </strong>
                                    <p>
                                        {{ $address->street }}
                                    </p>
                                    <p>
                                        {{ $address->city }}
                                    </p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </section>
                <section style="padding-top: 1rem"
                    class="d-flex flex-column justify-content-start align-items-stretch ">
                    <h2>
                        {{ __('checkout.ORDER_SUMMARY') }}
                    </h2>
                    <div class="d-flex flex-column justify-content-start align-items-stretch ">
                        <div class="d-flex justify-content-between align-items-center ">
                            <span>
                                {{ __('labels.TOTAL') }}
                            </span>
                            <div class="d-flex justify-content-start align-items-center ">
                                <span>
                                    {{ __("$") }}
                                </span>
                                <span>
                                    {{ $cart->total_amount }}
                                </span>
                            </div>
                        </div>
                        <form id="form-1" action="{{ route('checkout.store') }}" method="POST"
                            class="d-flex flex-column justify-content-start align-items-stretch " method="post">
                            @csrf
                            @method('post')
                            <button class=" btn btn-ht-primary" type="submit">
                                {{ __('checkout.PLACE_ORDER') }}
                            </button>
                        </form>
                    </div>
                </section>
            </main>
        </div>
        <footer style="padding: 0.5vw 1vw; background-color: var(--primary)"
            class="d-flex justify-content-center align-items-center ">
            <nav class="d-flex justify-content-center align-items-center ">
                <a id="a-9" href="{{ route('about') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--background)">
                    {{ __('labels.ABOUT') }}
                </a>
                <a id="a-10" href="{{ route('contact') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--background)">
                    {{ __('labels.CONTACT') }}
                </a>
                <a id="a-11" href="{{ route('products.index') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--background)">
                    {{ __('labels.SHOP') }}
                </a>
                <a id="a-12" href="{{ route('orders.index') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--background)">
                    {{ __('labels.ORDERS') }}
                </a>
            </nav>
            <form id="form-2" action="{{ url('/') }}" method="GET">
                <span style="margin: 0 0.5vw">
                    {{ __('labels.JOIN_OUR_NEWSLETTER') }}
                </span>
                <input class=" form-control" type="email">
            </form>
        </footer>
        <footer style="padding: 0.5vw 1vw; background-color: var(--background)"
            class="d-flex justify-content-center align-items-center ">
            <div style="flex: 0.5" class="d-flex justify-content-start align-items-center ">
                <span>
                    {{ __('labels.MYSHOP') }}
                </span>
                <span style="margin-left: 0.5vw">
                    {{ __('labels.HOME_2') }}
                </span>
            </div>
            <nav style="flex: 1" class="d-flex justify-content-center align-items-center ">
                <a id="a-13" href="{{ route('privacy') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--primary)">
                    {{ __('labels.PRIVACY_POLICY') }}
                </a>
                <a id="a-14" href="{{ route('terms') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--primary)">
                    {{ __('labels.TERMS_OF_SERVICE') }}
                </a>
                <a id="a-15" href="{{ route('cookies') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--primary)">
                    {{ __('labels.COOKIE_POLICY') }}
                </a>
            </nav>
            <div style="flex: 0.5" class="d-flex justify-content-end align-items-center ">
                <a id="a-16" href="{{ url('/lang/it') }}" style="text-decoration: none; margin: 0 0.5vw">
                    {{ __('labels.🇮🇹') }}
                </a>
                <a id="a-17" href="{{ url('/lang/en') }}" style="text-decoration: none; margin: 0 0.5vw">
                    {{ __('labels.🇬🇧') }}
                </a>
            </div>
        </footer>
    </div>


</x-html>
