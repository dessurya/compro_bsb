@extends('main._struct.base')

@push('meta')
<meta name="author" content="">
<meta name="title" content="Bima Sakti Bahari - {{ $title_page }}">
<meta name="description" content="">
<meta name="keywords" content="">
@endpush

@push('link')
@foreach($css as $data)
<link rel="stylesheet" href="{{ $data }}">
@endforeach
<style>
    body{
        color: rgb(109 109 109);
        font-weight: 500;
    }
    nav#header a{
        color: rgb(19 169 229) !important;
    }
    nav#header a:hover{
        color: white !important;
    }
    .title-section{
        color: rgb(19 169 229);
        font-weight: 300;
    }
    #product-list h4{
        font-weight: 700;
    }
    #banner .img{
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    #gradient{
        position: absolute;
        top:0;
        left:0;
        width:100vw;
        height:115vh;
        background-color: rgb(217,234,224);
        background-image: linear-gradient(rgb(217,234,224),rgb(217,234,224),rgb(217,234,224),rgb(217,234,224),rgb(217,234,224),rgb(255,255,255));
    }
</style>
@endpush

@section('content')
<div class="fullWidth">
    <div id="gradient"></div>
    <div id="banner" class="background fullScrenn mb-3">
        <div class="img fullScrenn" style="background-image: url('{{ url($banner) }}');"></div>
    </div>
    <div class="section">
        <h1 class="title-section mb-5 text-center">{!! App\Http\Controllers\Main\HomeController::buildTitle($title_page) !!}</h1>
        <div id="product-list" class="container">
            @foreach($products as $row)
            <div class="row mb-5">
                @if($loop->iteration % 2 == 0)
                <div class="col text-center">
                    <img src="{{ url($row->img_thumnail) }}" alt="{{ $row->title }}">
                </div>
                <div class="col text-right">
                    <h4 class="title-section">{{ $row->title }}</h4>
                    {!! $row->content !!}
                </div>
                @else
                <div class="col text-left">
                    <h4 class="title-section">{{ $row->title }}</h4>
                    {!! $row->content !!}
                </div>
                <div class="col text-center">
                    <img src="{{ url($row->img_thumnail) }}" alt="{{ $row->title }}">
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