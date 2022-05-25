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
    #gradient{
        margin-top:190px;
        background-color: rgb(217,234,224);
        background-image: linear-gradient(rgb(217,234,224),rgb(217,234,224),rgb(217,234,224),rgb(217,234,224),rgb(217,234,224),rgb(255,255,255));
    }
    #gradient .container{
        padding-top: 2rem;
        padding-bottom: 1rem;
    }
    @media (max-width: 568px){
        #gradient{
            margin-top:65px;
        }
    }
</style>
@endpush

@section('content')
<div class="fullWidth">
    <div id="gradient" class="fullWidth">
        <div class="container">
            <div class="row">
                <div class="col">
                    <iframe src="{{ $page_data['location']['embed'] }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col">
                    <h1 class="title-section mb-5 text-center">{!! App\Http\Controllers\Main\HomeController::buildTitle($page_data['location']['title']) !!}</h1>
                    <p class="mb-5">{{ $page_data['location']['content'] }}</p>
                    <a class="btn btn-cstm-one" href="{{ $page_data['location']['link'] }}">GET DIRECTION</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="section">
        <div class="container">
        </div>
    </div>
</div>
@endsection

@push('script')
@foreach($js as $data)
<script src="{{ $data }}"></script>
@endforeach
@endpush