@extends('layouts.font-bootstrap')

@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="page-item first disabled" aria-disabled="true">
                    <span class="page-link"><i class="tf-icon bx bx-chevrons-left"></i></span>
                </li>
                <li class="page-item prev disabled" aria-disabled="true">
                    <span class="page-link"><i class="tf-icon bx bx-chevron-left"></i></span>
                </li>
            @else
                <li class="page-item first">
                    <a class="page-link" href="{{ $paginator->url(1) }}"><i class="tf-icon bx bx-chevrons-left"></i></a>
                </li>
                <li class="page-item prev">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="tf-icon bx bx-chevron-left"></i></a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item next">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="tf-icon bx bx-right-arrow-alt"></i></a>
                </li>
                <li class="page-item last">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}"><i class="tf-icon bx bx-chevrons-right"></i></a>
                </li>
            @else
                <li class="page-item next disabled" aria-disabled="true">
                    <span class="page-link"><i class="tf-icon bx bx-right-arrow-alt"></i></span>
                </li>
                <li class="page-item last disabled" aria-disabled="true">
                    <span class="page-link"><i class="tf-icon bx bxs-chevrons-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif