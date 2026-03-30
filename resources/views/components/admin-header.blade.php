<div class="d-flex align-items-stretch admin-header" style="background-color: #2563EB; height: 16vh;">
    <div class="d-flex align-items-center header-back-button">
        @if (isset($back) && $back)
            <a href="{{ $back }}">
                <svg style="width: 40px; height: 40px;" fill="#14B8A6">
                    <use xlink:href="{{ asset('/storage/sprites/solid.svg#chevron-left') }}"></use>
                </svg>
            </a>
        @endif
    </div>
    <div class="d-flex flex-column justify-content-center align-items-stretch" style="flex: 1; padding: 1vw;">
        <p style="text-align: center; font-size: 3.5rem; font-weight: bold; margin: 0; color: #14B8A6">
            @isset($title)
                {{ $title }}
            @endisset
        </p>
        @isset($subtitle)
            <p style="text-align: center; font-size: 1.5rem; margin: 0; color: #14B8A6">{{ $subtitle }}</p>
        @endisset
    </div>
    <div class="d-flex justify-content-center header-right-slot">
        @isset($headerRight)
            {{ $headerRight }}
        @endisset
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button class="btn btn-sm btn-outline-danger mt-3" type="submit" style="align-self: flex-start">
                <svg style="width: 20px; height: 20px;" fill="currentColor">
                    <use xlink:href="{{ asset('/storage/sprites/solid.svg#arrow-right-from-bracket') }}"></use>
                </svg>
            </button>
        </form>
    </div>
</div>
