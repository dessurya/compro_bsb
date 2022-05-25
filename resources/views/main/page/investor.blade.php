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
    #product-list img{
        max-width: 100%;
    }
    #banner{
        margin-top:135px;
    }
    #banner .img{
        height: 80vh;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        border-bottom-left-radius: 70% 100%;
    }
    #gradient{
        position: absolute;
        z-index: -1;
        top:0;
        left:0;
        width:100vw;
        height:155vh;
        background-color: rgb(217,234,224);
        background-image: linear-gradient(rgb(217,234,224),rgb(217,234,224),rgb(217,234,224),rgb(217,234,224),rgb(217,234,224),rgb(255,255,255));
    }
    #investor img{
        width: 100%;
    }
    @media (max-width: 568px){
        #banner{
            margin-top:65px;
        }
    }
</style>
@endpush

@section('content')
<div class="fullWidth">
    <div id="gradient"></div>
    <div id="banner" class="background fullWidth">
        <div class="img fullWidth" style="background-image: url('{{ url($banner) }}');"></div>
    </div>
    <div class="section">
        <h1 class="title-section mb-5 text-center">{!! App\Http\Controllers\Main\HomeController::buildTitle($title_page) !!}</h1>
        <div id="investor" class="container">
            @foreach($investor as $row)
            <div class="row">
                <div class="col">
                    <h3 class="title-section">{{ $row['name'] }}</h3>
                    {!! $row['content'] !!}
                </div>
                <div class="col">
                    <img src="{{ $row['img'] }}" alt="{{ $row['name'] }}">
                </div>
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