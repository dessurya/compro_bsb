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
<style>
    body{
        color: rgb(109 109 109);
        font-weight: 500;
    }
    nav#header a{
        color: rgb(19 169 229) !important;
    }
    nav#header a:hover{
        color: #008a3c !important;
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
        margin-top:190px;
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
    #investor h3{
        font-weight: 700;
        margin-bottom: 2rem;
    }
    @media (max-width: 568px){
        #banner{
            margin-top:65px;
        }

        #investor img{
            width: 75%;
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