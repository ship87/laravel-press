<div class="breadcrumbs"><a href="{{ url('/') }}">Главная</a> → '.$model->cs.'</div>
<br>

@if (count($breadcrumbs))
    <div class="breadcrumbs">
        @foreach ($breadcrumbs as $breadcrumb)
            <li>
                @if ($breadcrumb->url)
                    <a class="breadcrumbs__item" href="{{ $breadcrumb->url }}" role="link">{{ $breadcrumb->title }}</a>
                @else
                    <span class="breadcrumbs__item">{{ $breadcrumb->title }}</span>
                @endif
            </li>
        @endforeach
    </div>
@endif