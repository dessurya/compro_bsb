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
        color: #008a3c !important;
    }
    .title-section{
        color: rgb(19 169 229);
        font-weight: 300;
    }
    #ourclient{
        margin-top:190px;
    }
    #ourclient img{
        max-width: 90%;
    }
    @media (max-width: 568px){
        #ourclient{
            margin-top:65px;
        }

    }
</style>
@endpush

@section('content')
<div id="ourclient" class="fullWidth">
    <div class="section">
        <h1 class="title-section-reverse mb-5 text-center">{!! App\Http\Controllers\Main\HomeController::buildTitle($title_page) !!}</h1>
        <div class="container text-center">
            <p>{{ $page_data['content'] }}</p>
            <div class="text-center mt-5"><img src="{{ $page_data['img'] }}" alt="maps"></div>
        </div>
    </div>
</div>
@endsection

@push('script')
@foreach($js as $data)
<script src="{{ $data }}"></script>
@endforeach
@endpush