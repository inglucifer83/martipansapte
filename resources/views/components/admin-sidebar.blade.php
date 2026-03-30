<div id="admin-sidebar-container" class="admin-sidebar"
    style="background-color: #2563EB; width: 15vw; height: 100vh; overflow-y: scroll;">
    <div id="sidebar-logo-container" class="d-flex justify-content-center align-items-center"
        style="margin-bottom: 5vh; margin-top: 2vh;">
        <img id="sidebar-logo" style="height: 16vh;" src="{{ asset('storage/logo.webp') }}" />
    </div>
    <div class="list-group list-group-flush sidebar" style="max-height: 80vw; overflow-y: scroll; padding-bottom: 4vw;">
        <a href="{{ route('admin.dashboard') }}" title="Dashboard"
            class="d-flex list-group-item align-items-center{{ request()->is('admin/dashboard*') ? ' selected' : '' }}"
            style="padding: 1vw;"><svg
                style="width: 20px; height: 20px; margin-right: 0.5vw; fill: currentcolor; pointer-events: none;">
                <use href="{{ asset('/storage/sprites/solid.svg#gauge') }}"></use>
            </svg>
            <p style="margin: 0; font-size: 1.2rem">Dashboard</p>
        </a>
        <ul class="list-group-item sidebar-ul">
            <div class="d-flex align-items-center" style="pointer-events: none;">
                <svg style="width: 20px; height: 20px; margin-right: 0.5vw;">
                    <use href="{{ asset('/storage/sprites/solid.svg#house-user') }}"></use>
                </svg>
                <span style="flex: 1;">Contents</span>
                <svg class="sidebar-ul-chevron" style="width: 15px; height: 15px; margin-right: 0.5vw;"
                    fill="currentColor">
                    <use xlink:href="{{ asset('/storage/sprites/solid.svg#chevron-down') }}"></use>
                </svg>
            </div>
            <li class="sidebar-menu-child">
                <a href="{{ route('admin.users') }}" title="Users"
                    class="d-flex list-group-item align-items-center{{ request()->is('admin/users*') ? ' selected' : '' }}"
                    style="padding: 1vw;"><svg
                        style="width: 20px; height: 20px; margin-right: 0.5vw; pointer-events: none;"
                        fill="currentColor">
                        <use href="{{ asset('/storage/sprites/solid.svg#user') }}"></use>
                    </svg>
                    <p style="margin: 0; font-size: 1.2rem">Users</p>
                </a>
            </li>
        </ul>
        <ul class="list-group-item open sidebar-ul">
            <div class="d-flex align-items-center" style="pointer-events: none;">
                <svg style="width: 20px; height: 20px; margin-right: 0.5vw;">
                    <use href="{{ asset('/storage/sprites/solid.svg#database') }}"></use>
                </svg>
                <span style="flex: 1;">Contents</span>
                <svg class="sidebar-ul-chevron" style="width: 15px; height: 15px; margin-right: 0.5vw;"
                    fill="currentColor">
                    <use xlink:href="{{ asset('/storage/sprites/solid.svg#chevron-down') }}"></use>
                </svg>
            </div>
            <li class="sidebar-menu-child">
                <a href="{{ route('admin.products') }}" title="Products"
                    class="d-flex list-group-item align-items-center{{ request()->is('admin/products*') ? ' selected' : '' }}"
                    style="padding: 1vw;"><svg
                        style="width: 20px; height: 20px; margin-right: 0.5vw; pointer-events: none;"
                        fill="currentColor">
                        <use href="{{ asset('/storage/sprites/solid.svg#box-open') }}"></use>
                    </svg>
                    <p style="margin: 0; font-size: 1.2rem">Products</p>
                </a>
            </li>
            <li class="sidebar-menu-child">
                <a href="{{ route('admin.categories') }}" title="Categories"
                    class="d-flex list-group-item align-items-center{{ request()->is('admin/categories*') ? ' selected' : '' }}"
                    style="padding: 1vw;"><svg
                        style="width: 20px; height: 20px; margin-right: 0.5vw; pointer-events: none;"
                        fill="currentColor">
                        <use href="{{ asset('/storage/sprites/solid.svg#layer-group') }}"></use>
                    </svg>
                    <p style="margin: 0; font-size: 1.2rem">Categories</p>
                </a>
            </li>
            <li class="sidebar-menu-child">
                <a href="{{ route('admin.tags') }}" title="Tags"
                    class="d-flex list-group-item align-items-center{{ request()->is('admin/tags*') ? ' selected' : '' }}"
                    style="padding: 1vw;"><svg
                        style="width: 20px; height: 20px; margin-right: 0.5vw; pointer-events: none;"
                        fill="currentColor">
                        <use href="{{ asset('/storage/sprites/solid.svg#tag') }}"></use>
                    </svg>
                    <p style="margin: 0; font-size: 1.2rem">Tags</p>
                </a>
            </li>
            <li class="sidebar-menu-child">
                <a href="{{ route('admin.images') }}" title="Images"
                    class="d-flex list-group-item align-items-center{{ request()->is('admin/images*') ? ' selected' : '' }}"
                    style="padding: 1vw;"><svg
                        style="width: 20px; height: 20px; margin-right: 0.5vw; pointer-events: none;"
                        fill="currentColor">
                        <use href="{{ asset('/storage/sprites/solid.svg#image') }}"></use>
                    </svg>
                    <p style="margin: 0; font-size: 1.2rem">Images</p>
                </a>
            </li>
            <li class="sidebar-menu-child">
                <a href="{{ route('admin.variants') }}" title="Variants"
                    class="d-flex list-group-item align-items-center{{ request()->is('admin/variants*') ? ' selected' : '' }}"
                    style="padding: 1vw;"><svg
                        style="width: 20px; height: 20px; margin-right: 0.5vw; pointer-events: none;"
                        fill="currentColor">
                        <use href="{{ asset('/storage/sprites/solid.svg#tags') }}"></use>
                    </svg>
                    <p style="margin: 0; font-size: 1.2rem">Variants</p>
                </a>
            </li>
            <li class="sidebar-menu-child">
                <a href="{{ route('admin.carts') }}" title="Carts"
                    class="d-flex list-group-item align-items-center{{ request()->is('admin/carts*') ? ' selected' : '' }}"
                    style="padding: 1vw;"><svg
                        style="width: 20px; height: 20px; margin-right: 0.5vw; pointer-events: none;"
                        fill="currentColor">
                        <use href="{{ asset('/storage/sprites/solid.svg#shopping-cart') }}"></use>
                    </svg>
                    <p style="margin: 0; font-size: 1.2rem">Carts</p>
                </a>
            </li>
            <li class="sidebar-menu-child">
                <a href="{{ route('admin.cart_items') }}" title="CartItems"
                    class="d-flex list-group-item align-items-center{{ request()->is('admin/cart_items*') ? ' selected' : '' }}"
                    style="padding: 1vw;"><svg
                        style="width: 20px; height: 20px; margin-right: 0.5vw; pointer-events: none;"
                        fill="currentColor">
                        <use href="{{ asset('/storage/sprites/solid.svg#shopping-basket') }}"></use>
                    </svg>
                    <p style="margin: 0; font-size: 1.2rem">CartItems</p>
                </a>
            </li>
            <li class="sidebar-menu-child">
                <a href="{{ route('admin.orders') }}" title="Orders"
                    class="d-flex list-group-item align-items-center{{ request()->is('admin/orders*') ? ' selected' : '' }}"
                    style="padding: 1vw;"><svg
                        style="width: 20px; height: 20px; margin-right: 0.5vw; pointer-events: none;"
                        fill="currentColor">
                        <use href="{{ asset('/storage/sprites/solid.svg#receipt') }}"></use>
                    </svg>
                    <p style="margin: 0; font-size: 1.2rem">Orders</p>
                </a>
            </li>
            <li class="sidebar-menu-child">
                <a href="{{ route('admin.order_items') }}" title="OrderItems"
                    class="d-flex list-group-item align-items-center{{ request()->is('admin/order_items*') ? ' selected' : '' }}"
                    style="padding: 1vw;"><svg
                        style="width: 20px; height: 20px; margin-right: 0.5vw; pointer-events: none;"
                        fill="currentColor">
                        <use href="{{ asset('/storage/sprites/solid.svg#box') }}"></use>
                    </svg>
                    <p style="margin: 0; font-size: 1.2rem">OrderItems</p>
                </a>
            </li>
            <li class="sidebar-menu-child">
                <a href="{{ route('admin.payments') }}" title="Payments"
                    class="d-flex list-group-item align-items-center{{ request()->is('admin/payments*') ? ' selected' : '' }}"
                    style="padding: 1vw;"><svg
                        style="width: 20px; height: 20px; margin-right: 0.5vw; pointer-events: none;"
                        fill="currentColor">
                        <use href="{{ asset('/storage/sprites/solid.svg#credit-card') }}"></use>
                    </svg>
                    <p style="margin: 0; font-size: 1.2rem">Payments</p>
                </a>
            </li>
            <li class="sidebar-menu-child"> <a href="{{ route('admin.reviews') }}" title="Reviews"
                    class="d-flex list-group-item align-items-center{{ request()->is('admin/reviews*') ? ' selected' : '' }}"
                    style="padding: 1vw;"><svg
                        style="width: 20px; height: 20px; margin-right: 0.5vw; pointer-events: none;"
                        fill="currentColor">
                        <use href="{{ asset('/storage/sprites/solid.svg#star') }}"></use>
                    </svg>
                    <p style="margin: 0; font-size: 1.2rem">Reviews</p>
                </a> </li>
            <li class="sidebar-menu-child"> <a href="{{ route('admin.addresses') }}" title="Addresses"
                    class="d-flex list-group-item align-items-center{{ request()->is('admin/addresses*') ? ' selected' : '' }}"
                    style="padding: 1vw;"><svg
                        style="width: 20px; height: 20px; margin-right: 0.5vw; pointer-events: none;"
                        fill="currentColor">
                        <use href="{{ asset('/storage/sprites/solid.svg#map-marker') }}"></use>
                    </svg>
                    <p style="margin: 0; font-size: 1.2rem">Addresses</p>
                </a> </li>
        </ul>
    </div>
</div>
