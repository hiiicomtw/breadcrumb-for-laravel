@if ($breadcrumbs)
        <ol class="breadcrumb_pagetag">
                @foreach ($breadcrumbs as $index => $breadcrumb)
                        <li>
                                @if ($breadcrumb->url)
                                        <a href="{{ $breadcrumb->url }}" title="{{ $breadcrumb->title }}">
                                                {{ $breadcrumb->title }}
                                        </a>
                                @else
                                        {{ $breadcrumb->title }}
                                @endif
                        </li>
                @endforeach
        </ol>
@endif
