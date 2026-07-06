@if ($paginator->hasPages())
    <nav aria-label="Pagination">
        <ul class="pagination-list">

            {{-- Previous Page --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-item disabled">
                    <span class="pagination-btn">&lsaquo;</span>
                </li>
            @else
                <li class="pagination-item">
                    <a href="{{ $paginator->previousPageUrl() }}" class="pagination-btn" rel="prev">&lsaquo;</a>
                </li>
            @endif

            {{-- Page Links --}}
            @foreach ($elements as $element)

                {{-- Dots --}}
                @if (is_string($element))
                    <li class="pagination-item">
                        <span class="pagination-btn dots">{{ $element }}</span>
                    </li>
                @endif

                {{-- Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination-item">
                                <span class="pagination-btn active">{{ $page }}</span>
                            </li>
                        @else
                            <li class="pagination-item">
                                <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif

            @endforeach

            {{-- Next Page --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="pagination-btn" rel="next">&rsaquo;</a>
                </li>
            @else
                <li class="pagination-item disabled">
                    <span class="pagination-btn">&rsaquo;</span>
                </li>
            @endif

        </ul>
    </nav>

    <style>
        .pagination-list {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .pagination-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            color: #6b7280;
            background-color: #f3f4f6;
            text-decoration: none;
            transition: background-color 0.15s ease, color 0.15s ease, box-shadow 0.15s ease;
            cursor: pointer;
            user-select: none;
        }

        .pagination-btn:hover:not(.active):not(.dots) {
            background-color: #e5e7eb;
            color: #374151;
        }

        .pagination-btn.active {
            background-color: #3b82f6;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
            cursor: default;
        }

        .pagination-btn.dots {
            background-color: transparent;
            color: #9ca3af;
            cursor: default;
            width: 32px;
        }

        .pagination-item.disabled .pagination-btn {
            color: #d1d5db;
            cursor: not-allowed;
            background-color: #f9fafb;
        }
    </style>
@endif
