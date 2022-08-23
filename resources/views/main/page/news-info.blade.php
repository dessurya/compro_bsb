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
        transition: all 51s;
        background-color: white;
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
    #news-list h3{
        font-weight: 700;
    }
    #news-list img{
        max-width: 100%;
    }
    #pagination-container{
        float:right;
    }
    #pagination-container .page-link{
        color: rgba(1,160,228,1) !important;
    }
    #pagination-container .page-item.active .page-link{
        color: #fff !important;
        background-color: rgba(1,160,228,1) !important;
        border-color: rgba(1,160,228,1) !important;
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
        <div id="news-list" class="container">
            @foreach($NewsInfo as $row)
            <div class="row mb-5">
                <div class="col text-center">
                    @if($row->flag_img_thumbnail == 'Y' AND !empty($row->img_thumbnail))
                    <img src="{{ url($row->img_thumbnail) }}" alt="{{ $row->title }}">
                    @endif
                </div>
                <div class="col text-left">
                    <h3 class="title-section">{{ $row->title }}</h3>
                    <div class="mb-4">
                        {{ Str::words(strip_tags($row->content), ' ...', 50) }}
                    </div>
                    <a class="btn btn-cstm-one" href="{{ route('main.news-info.detail', ['slug'=>$row->slug]) }}">Read More</a>
                </div>
            </div>
            @endforeach

            <div id="pagination-container">
                {!! $NewsInfo->links() !!}
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