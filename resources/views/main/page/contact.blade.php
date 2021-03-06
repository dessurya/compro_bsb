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
    #gradient{
        margin-top:190px;
        background-color: rgb(217,234,224);
        background-image: linear-gradient(rgb(217,234,224),rgb(217,234,224),rgb(217,234,224),rgb(255,255,255),rgb(255,255,255));
    }
    #gradient .container{
        padding-top: 6rem;
        padding-bottom: 5rem;
    }
    .background .img{
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        padding: 5rem;
    }
    .background .img .msg{
        width: 100%;
        background-color: rgba(255,255,255,.8);
        padding: 3rem 5rem;
    }
    form input,
    form textarea{
        background-color: rgba(0,0,0,0) !important;
        border: 0 !important;
        border-bottom: 1px solid black !important;
        border-radius: 0 !important;
    }
    #gradient #contain{
        padding-left: 4.5rem;
    }
    @media (max-width: 568px){
        #gradient{
            margin-top:65px;
        }
        #gradient #contain{
            padding-left: unset;
        }
        .background .img{
            padding: 2.5rem 0;
        }
        .background .img .msg{
            padding: 2.5rem 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="fullWidth">
    <div id="gradient" class="fullWidth">
        <div class="container">
            <div class="row">
                <div class="col-md mb-3">
                    <iframe src="{{ $page_data['location']['embed'] }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div id="contain" class="col-md mb-3">
                    <h1 class="title-section-reverse mb-5 text-left">{!! App\Http\Controllers\Main\HomeController::buildTitle($page_data['location']['title']) !!}</h1>
                    <p class="mb-5 text-justify">{{ $page_data['location']['content'] }}</p>
                    <a class="btn btn-cstm-one" href="{{ $page_data['location']['link'] }}">GET DIRECTION</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="fullWidth background">
        <div class="img fullWidth" style="background-image: url('{{ $page_data['message']['img'] }}');">
            <div class="container">
                <div class="msg">
                    <form action="{{ route('main.contact.store') }}" method="post">
                        <h1 class="title-section mb-5 text-left">{!! App\Http\Controllers\Main\HomeController::buildTitle('Message') !!}</h1>
                        @if(Session::has('message'))
                            <p class="alert alert-info mt-5 mb-5">{{ Session::get('message') }}</p>
                            @endif
                        @csrf
                        <input max="150" type="text" class="mb-3 form-control" id="name" name="name" placeholder="Name" required>
                        <input max="25" type="text" class="mb-3 form-control" id="phone" name="phone" placeholder="Handphone" required>
                        <input max="150" type="email" class="mb-3 form-control" id="email" name="email" placeholder="Email" required>
                        <input max="150" type="text" class="mb-3 form-control" id="subject" name="subject" placeholder="Subject" required>
                        <textarea max="450" class="mb-5 form-control" name="message" id="message" rows="5" placeholder="Message"></textarea>
                        <div class="text-center">
                            <button type="submit" class="mt-3 btn btn-cstm-one">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
@foreach($js as $data)
<script src="{{ $data }}"></script>
@endforeach
@endpush