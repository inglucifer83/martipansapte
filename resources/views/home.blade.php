<x-html lang="{{ app()->getLocale() }}">
    <x-slot:head>
        <title>Home - MyShop</title>
        <meta name="keywords" content="ecommerce, storefront, featured products">
        <meta property="og:title" content="Home - MyShop">
        <meta name="description"
            content="Discover featured products, promotions and highlighted categories at MyShop — a clean, conversion-focused storefront.">
        <meta property="og:description"
            content="Discover featured products, promotions and highlighted categories at MyShop — a clean, conversion-focused storefront.">
        <link rel="canonical" href="{{ url('') }}" />
        <meta property="og:site_name" content="PrettyShop">
        <meta property="og:url" content="{{ url('') }}">
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
            <main class="d-flex flex-column justify-content-start align-items-stretch ">
                <section style="padding-top: 2rem; padding-bottom: 2rem"
                    class="d-flex flex-column justify-content-start align-items-stretch ">
                    <div class="d-flex flex-column justify-content-start align-items-stretch container">
                        <h1>
                            {{ __('home.WELCOME_TO_MYSHOP') }}
                        </h1>
                        <p>
                            {{ __('home.HOME_1') }}
                        </p>
                        <div class="d-flex justify-content-start align-items-center ">
                            <a id="a-9" href="{{ route('products.index') }}" class=" btn btn-ht-primary">
                                {{ __('home.SHOP_NOW') }}
                            </a>
                        </div>
                    </div>
                </section>
                <section style="padding-top: 1.5rem; padding-bottom: 1.5rem"
                    class="d-flex flex-column justify-content-start align-items-stretch ">
                    <div class="d-flex flex-column justify-content-start align-items-stretch container">
                        <h2>
                            {{ __('home.FEATURED_PRODUCTS') }}
                        </h2>
                        <div style="flex-wrap: wrap" class="d-flex justify-content-center ">
                            @foreach ($featuredProducts as $product)
                                <article
                                    style="padding-top: 1rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(0,0,0,0.05)"
                                    class="d-flex justify-content-start align-items-start ">
                                    <img style="min-height: 6rem; min-width: 6rem; max-width: 6rem; object-fit: cover; margin-right: 1rem"
                                        src="{{ $product->featured_image }}" alt="{{ $product->name }}">
                                    <div class="d-flex flex-column justify-content-start align-items-stretch ">
                                        <h3>
                                            {{ $product->name }}
                                        </h3>
                                        <p>
                                            {{ $product->short_description }}
                                        </p>
                                        <div class="d-flex justify-content-start align-items-center ">
                                            <span>
                                                {{ __("$") }}
                                            </span>
                                            <span>
                                                {{ $product->price }}
                                            </span>
                                            <a id="a-10" href="{{ route('products.show', [$product->id]) }}"
                                                class=" btn btn-ht-primary">
                                                {{ __('labels.VIEW') }}
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>
                <section style="padding-top: 1.5rem; padding-bottom: 2rem"
                    class="d-flex flex-column justify-content-start align-items-stretch ">
                    <div class="d-flex flex-column justify-content-start align-items-stretch container">
                        <h2>
                            {{ __('home.SHOP_BY_CATEGORY') }}
                        </h2>
                        <div class="d-flex justify-content-start align-items-start ">
                            <div style="flex-wrap: wrap" class="d-flex justify-content-center ">
                                @foreach ($categories as $category)
                                    <a id="a-11" href="{{ route('products.index') }}" class=" btn">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
        <footer style="padding: 0.5vw 1vw; background-color: var(--primary)"
            class="d-flex justify-content-center align-items-center ">
            <nav class="d-flex justify-content-center align-items-center ">
                <a id="a-12" href="{{ route('about') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--background)">
                    {{ __('labels.ABOUT') }}
                </a>
                <a id="a-13" href="{{ route('contact') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--background)">
                    {{ __('labels.CONTACT') }}
                </a>
                <a id="a-14" href="{{ route('products.index') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--background)">
                    {{ __('labels.SHOP') }}
                </a>
                <a id="a-15" href="{{ route('orders.index') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--background)">
                    {{ __('labels.ORDERS') }}
                </a>
            </nav>
            <form id="form-1" action="{{ url('/') }}" method="GET">
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
                <a id="a-16" href="{{ route('privacy') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--primary)">
                    {{ __('labels.PRIVACY_POLICY') }}
                </a>
                <a id="a-17" href="{{ route('terms') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--primary)">
                    {{ __('labels.TERMS_OF_SERVICE') }}
                </a>
                <a id="a-18" href="{{ route('cookies') }}"
                    style="margin-left: 1vw; margin-right: 1vw; text-decoration: none; color: var(--primary)">
                    {{ __('labels.COOKIE_POLICY') }}
                </a>
            </nav>
            <div style="flex: 0.5" class="d-flex justify-content-end align-items-center ">
                <a id="a-19" href="{{ url('/lang/it') }}" style="text-decoration: none; margin: 0 0.5vw">
                    {{ __('labels.🇮🇹') }}
                </a>
                <a id="a-20" href="{{ url('/lang/en') }}" style="text-decoration: none; margin: 0 0.5vw">
                    {{ __('labels.🇬🇧') }}
                </a>
            </div>
        </footer>
    </div>


</x-html>
