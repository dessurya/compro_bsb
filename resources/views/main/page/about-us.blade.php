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

    .round-poin{
        width:18px;
        height:18px;
        margin-top: .8rem;
        margin-left: .6rem;
        background-color: rgb(19 169 229);
        border-radius:100%;
    }

    #mom{
        padding-bottom:10vh;
    }
    #mom #person{
        margin: 0 auto;
        width: 62.5vw;
        padding-top: 10vh;
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
    #mom #other img{
        width: 80%;
    }
    #mom #other h3{
        color: rgb(19 169 229);
        font-weight: 600;
    }
</style>
@endpush


@section('content')
<div id="hvm" class="fullWidth">
    <div class="section">
        <div id="conten" class="container">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div id="history">
                        <h2 class="title-section"><span>HI</span>STORY</h2>
                        {!! $history !!}
                    </div>
                    <div id="visi">
                        <h2 class="title-section mb-4"><span>VISI</span></h2>
                        {!! $visi !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="com-md-12">
                    <div id="misi">
                        <h2 class="title-section mb-4"><span>MISI</span></h2>
                        <div class="row">
                        @foreach($misi as $row)
                        <div class="col-md-6 poin">
                            <div class="row">
                                <div class="col-md-1">
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
        </div>
    </div>
</div>
<div id="mom" class="fullWidth">
    <div id="top" class="text-center">
        <h2 class="title-section"><span>MEET</span> OUR MANAGEMENT</h2>
        <div id="person" class="mb-5">
            @if($management[0]['img'] != null)
            <img src="{{ $management[0]['img'] }}" alt="{{ $management[0]['name'] }}">
            @endif
            <h3>{{ $management[0]['name'] }}</h3>
            <h6>{{ $management[0]['title'] }}</h6>
            <h2 class="mb-3">{!! $management[0]['quotes'] !!}</h2>
            <div id="msg">{!! $management[0]['msg'] !!}</div>
        </div>
        <div class="container">
            <div id="other" class="text-left">
                @foreach($management as $idx => $data)
                @if($idx > 0)
                <div class="row">
                    <div class="col-md-3 text-center">
                        @if($data['img'] != null)
                        <img src="{{ $data['img'] }}" alt="{{ $data['name'] }}">
                        @endif
                    </div>
                    <div class="col-md-9">
                        <h3>{{ $data['name'] }}</h3>
                        <h6>{{ $data['title'] }}</h6>
                        <div id="msg">{!! $data['msg'] !!}</div>
                    </div>
                </div>
                @endif
                @endforeach
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