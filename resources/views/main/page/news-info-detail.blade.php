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
    nav#header{
        background-color: rgba(0,0,0,0);
    }
    nav#header.change{
        background-color: rgba(0,0,0,0);
    }
    nav#header .btn-menu-toggle .line{
        stroke: #01a0e4;
    }
    .title-section{
        color: rgb(19 169 229);
        font-weight: 300;
    }
    #banner{
        margin-top:0px;
        height: 95vh;
    }
    #banner .img{
        height: 95vh;
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
    #news img{
        float: left;
        margin: 0em 3em 2em 3em;
        max-width: 450px;
    }
    @media (max-width: 568px){
        #banner{
            margin-top:0px;
        }
        #news img{
            max-width: 65%;
        }
    }
</style>
@endpush

@section('content')
<div class="fullWidth">
    <div id="gradient"></div>
    <div id="banner" class="background fullWidth">
        @if($NewsInfo->flag_img_banner == 'Y' AND !empty($NewsInfo->img_banner))
        <div class="img fullWidth" style="background-image: url('{{ url($NewsInfo->img_banner) }}');"></div>
        @endif
    </div>
    <div id="news" class="section">
        <h1 class="title-section mb-5 text-center">{!! App\Http\Controllers\Main\HomeController::buildTitle($NewsInfo->title) !!}</h1>
        <div class="container">
            @if($NewsInfo->flag_img_thumbnail == 'Y' AND !empty($NewsInfo->img_thumbnail))
            <img src="{{ url($NewsInfo->img_thumbnail) }}" alt="{{ $NewsInfo->title }}">
            @endif
            {!! $NewsInfo->content !!}

        </div>
        <div class="clearboth"></div>
        <div class="container">
            <div class="row">
                @foreach ($NewsInfo->getImg as $row)
                <div class="col-12 col-md-4 text-center">
                    <img src="{{ url($row->img) }}" width="100%">
                </div>
                @endforeach
            </div>
        </div>
        <div class="clearboth"></div>
    </div>
</div>
@endsection

@push('script')
@foreach($js as $data)
<script src="{{ $data }}"></script>
@endforeach
@endpush