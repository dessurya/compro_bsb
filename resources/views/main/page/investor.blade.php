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
            @foreach($investor as $row)
            <div class="row mb-5">
                @if($loop->iteration % 2 == 0)
                <div class="col text-center">
                    <img src="{{ $row->img }}" alt="{{ $row->name }}">
                </div>
                <div class="col">
                    <h3 class="title-section">{{ $row->name }}</h3>
                    {!! $row->content !!}
                </div>
                @else
                <div class="col">
                    <h3 class="title-section">{{ $row->name }}</h3>
                    {!! $row->content !!}
                </div>
                <div class="col text-center">
                    <img src="{{ $row->img }}" alt="{{ $row->name }}">
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