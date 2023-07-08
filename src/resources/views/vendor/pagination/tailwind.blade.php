@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="page-nav">
        <div class="page-link">
            @if ($paginator->onFirstPage())
                <span class="page page-preview page-invalid">
                    <
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="page page-preview">
                    <
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span aria-disabled="true">
                        <span class="page pagi-invalid">{{ $element }}</span>
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page">
                                <span class="page current-page">{{ $page }}</span>
                            </span>
                        @else
                            <a href="{{ $url }}" class="page page-number__link" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="page page-nextview">
                    >
                </a>
            @else
                <span class="page page-nextview page-invalid">
                    >
                </span>
            @endif
        </div>
    </nav>
@endif
