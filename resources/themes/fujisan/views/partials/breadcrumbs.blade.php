@unless ($breadcrumbs->isEmpty())
    <ul class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)

            @if (!is_null($breadcrumb->url) && !$loop->last)
                <li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="current"><a href="#">{{ $breadcrumb->title }}</a></li>
            @endif

        @endforeach
    </ul>
@endunless