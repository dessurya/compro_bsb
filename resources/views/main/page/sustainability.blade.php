@extends('main._struct.base')

@push('meta')
<meta name="author" content="{{ $meta['author'] }}">
<meta name="title" content="{{ $meta['title'] }}">
<meta name="description" content="{{ $meta['description'] }}">
<meta name="keywords" content="{{ $meta['keywords'] }}">
@endpush

@push('link')
    @foreach($css as $data)
    <link rel="stylesheet" href="{{ $data }}">
    @endforeach
@endpush

@section('content')
<div class="fullWidth">
    <div id="gradient"></div>
    <div id="banner" class="background fullWidth">
        <div class="img fullWidth" style="background-image: url('{{ url($banner) }}');"></div>
    </div>
    <div class="section">
        <h1 class="title-section-reverse mb-5 text-center">{!! App\Http\Controllers\Main\HomeController::buildTitle($title_page) !!}</h1>
        <div id="investor" class="container mt-5">
            @foreach($Sustainability as $row)
            <div class="row">
                @if($loop->iteration % 2 == 0)
                <div class="col text-center">
                    <img src="{{ $row->img_thumnail }}" alt="{{ $row->title }}">
                </div>
                <div class="col text-right">
                    <h3 class="title-section">{{ $row->title }}</h3>
                    {!! $row->content_shoert !!}
                </div>
                @else
                <div class="col text-left">
                    <h3 class="title-section">{{ $row->title }}</h3>
                    {!! $row->content_shoert !!}
                </div>
                <div class="col text-center">
                    <img src="{{ $row->img_thumnail }}" alt="{{ $row->title }}">
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('script')
@foreach($js as $data)
<script src="{{ $data }}"></script>
@endforeach
@endpush