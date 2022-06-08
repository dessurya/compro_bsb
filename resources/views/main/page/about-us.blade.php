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
    .title-section span{
        font-weight: 700;
    }
    h2{
        font-size: 32pt;
    }
    #hvm{
        padding-bottom: 10vh;
        position: relative;
        background-image: linear-gradient(rgb(217, 234, 224), rgb(217, 234, 224), rgb(217, 234, 224), rgb(217, 234, 224), rgb(217, 234, 224), rgb(255,255,255));
        background-color:rgb(217, 234, 224);
    }
    #hvm #white-loops{
        top:0;
        width: 100vw;
        background-color:white;
        height:158vh;
        border-radius: 0 0 72% 0;
    }
    #hvm #mom_title{
        padding-top: 10vh;
    }
    #hvm #conten{
        padding-top: 17.25vh;
    }
    #hvm #conten #history{
        margin-bottom: 12.5vh;
    }
    #hvm #conten #misi .poin{
        margin-bottom: 2.5em;
    }
    #hvm #loops-dark{
        top:-130px;
        left:-350px;
        transform: rotate(39deg);
        width: 800px;
        height: 600px;
        border-radius: 100%;
        background-color: rgb(217,234,224);
    }
    #hvm #loops-light{
        top:-105px;
        left:-325px;
        transform: rotate(39deg);
        width: 720px;
        height: 530px;
        border-radius: 100%;
        background-color: rgb(229,240,234);
        box-shadow: 0px 0px 10px grey;
    }
    #hvm img{
        width:90%;
        margin-top: 0.8rem;
    }

    .round-poin{
        width:18px;
        height:18px;
        margin-top: .8rem;
        margin-left: .6rem;
        background-color: rgb(19 169 229);
        border-radius:100%;
    }
    /* mom */
        #mom{
            position: relative;
            top: -15vh;
            padding-bottom:10vh;
        }
        #mom #person{
            margin: 0 auto;
            width: 62.5vw;
        }

        #mom #person img{
            width: 60%;
        }
        #mom #person h3{
            font-weight: 700;
        }
        #mom #person h2{
            font-style: italic;
        }
        #mom #person h3,
        #mom #person h2{
            color: rgb(19 169 229);
        }
        #mom #person #msg{
            font-size:12pt;
        }
        #mom #management img{
            border-radius: 100%;
            width: 240px;
            height: 230px;
        }
        #mom #management h3{
            color: rgb(19 169 229);
            font-weight: 600;
        }
        #mom #staff h3{
            color: rgb(19 169 229);
            font-weight: 500;
        }
        #mom #staff img{
            border-radius: 100%;
            width: 200px;
            height: 190px;
        }
    /* mom */

    @media (max-width: 568px){
        #hvm #mom_title{
            font-size:28pt;
        }
        #mom #management h3,
        #mom #person h3, #mom #person h2{
            font-size:18pt;
        }
        #hvm {
            overflow-x: hidden;
        }
        #hvm img{
            width:100%;
            margin-top: unset;
        }
    }
</style>
@endpush


@section('content')
<div id="hvm" class="fullWidth">
    <div id="white-loops" class="pos-abs"></div>
    <div id="loops-dark" class="pos-abs"></div>
    <div id="loops-light" class="pos-abs"></div>
    <div class="section">
        <div id="conten" class="container">
            <div class="row">
                <div class="col-md-6">@if(!empty($history_img))<img src="{{ url($history_img) }}" alt="">@endif</div>
                <div class="col-md-6">
                    <div id="history">
                        <h2 class="title-section"><span>{{$title_page['intruduction']['bold']}}</span>{{$title_page['intruduction']['light']}}</h2>
                        {!! $history !!}
                    </div>
                    <div id="visi">
                        <h2 class="title-section mb-4"><span>{{$title_page['visi']}}</span></h2>
                        {!! $visi !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="misi">
                        <h2 class="title-section mb-4"><span>{{$title_page['misi']}}</span></h2>
                        <div class="row">
                        @foreach($misi as $row)
                        <div class="col-md-6 poin">
                            <div class="row">
                                <div class="col-md-1 col-2">
                                    <div class="round-poin"></div>
                                </div>
                                <div class="col">{{ $row }}</div>
                            </div>
                        </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <h2 id="mom_title" class="title-section text-center">{!! App\Http\Controllers\Main\HomeController::buildTitle($management_title) !!}</h2>
        </div>
    </div>
</div>
<div id="mom" class="fullWidth">
    <div id="top" class="text-center">
        <div id="person" class="mb-5">
            @if(count($management['founder']) > 0)
            @if($management['founder'][0]['img'] != null)
            <img src="{{ $management['founder'][0]['img'] }}" alt="{{ $management['founder'][0]['name'] }}">
            @endif
            <h3>{{ $management['founder'][0]['name'] }}</h3>
            <h6>{{ $management['founder'][0]['title'] }}</h6>
            <h2 class="mb-3">{!! $management['founder'][0]['quotes'] !!}</h2>
            <div id="msg">{!! $management['founder'][0]['msg'] !!}</div>
            @endif
        </div>
        <div class="container">
            <div id="management" class="text-left mb-5">
                @foreach($management['management'] as $idx => $data)
                <div class="row mb-5">
                    <div class="col-md-4 text-center">
                        @if($data['img'] != null)
                        <img src="{{ $data['img'] }}" alt="{{ $data['name'] }}">
                        @endif
                    </div>
                    <div class="col">
                        <h3>{{ $data['name'] }}</h3>
                        <h6>{{ $data['title'] }}</h6>
                        <div id="msg">{!! $data['msg'] !!}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="container">
            <div id="staff" class="mb-5">
                <div class="row row-cols-4">
                    @foreach($management['staff'] as $idx => $data)
                    <div class="col text-center align-self-center">
                        @if($data['img'] != null)
                        <img src="{{ $data['img'] }}" alt="{{ $data['name'] }}">
                        @endif
                        <h4>{{ $data['name'] }}</h4>
                        <h6>{{ $data['title'] }}</h6>
                    </div>
                    @endforeach
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