<header class="page-header">
    <div class="container text-center">
        @if($badge)
        <span class="badge bg-warning text-dark mb-2">
            {{ $badge }}
        </span>
        @endif

        <h1 class="fw-bold display-4 text-white">
            {{ $title }}
        </h1>

        @if($subtitle)
        <p class="lead text-white-50">
            {{ $subtitle }}
        </p>
        @endif

    </div>
</header>

