<ol class="breadcrumb">
    @foreach ($breadcrumbs as $index => $breadcrumb)
        <li class="breadcrumb-item {{ ($index+1)== count((array)$breadcrumbs) ? 'active' : '' }}">
            @if($index==0)
                <a href="{{ $breadcrumb->url }}">
                    <i class="fa fa-dashboard"></i> {{ $breadcrumb->title }}
                </a>
            @else
                <a href="{{ $breadcrumb->url }}">
                    {{ $breadcrumb->title }}
                </a>
            @endif
        </li>
    @endforeach
</ol>