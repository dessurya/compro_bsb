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
@endpush


@section('content')
<div id="hvm" class="fullWidth">
    <div id="white-loops" class="pos-abs"></div>
    <div id="loops-dark" class="pos-abs"></div>
    <div id="loops-light" class="pos-abs"></div>
    <div class="section">
        <div id="conten" class="container">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <h2 class="title-section">{{$title_page['intruduction']['bold']}}{{$title_page['intruduction']['light']}}</h2>
                </div>
                <div class="col-md-6">@if(!empty($history_img))<img id="img_intro" class="mb-3" src="{{ url($history_img) }}" alt="">@endif</div>
                <div class="col-md-6">
                    <div id="history">
                        {!! $history !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="visi" class="text-center mb-5">
                        <h2 class="title-section mb-4"><span>{{$title_page['visi']}}</span></h2>
                        <p>{!! $visi !!}</p>
                    </div>
                    <div id="misi">
                        <h2 class="title-section mb-4 text-center"><span>{{$title_page['misi']}}</span></h2>
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
            <h2 id="mom_title" class="title-section text-center">{!! App\Http\Controllers\Main\HomeController::buildTitle($title_section['founder']) !!}</h2>
        </div>
    </div>
</div>
<div id="mom" class="fullWidth">
    <div id="top" class="container text-center">
        <div id="person" class="mb-5">
            @if(count($management['founder']) > 0)
            @if($management['founder'][0]['img'] != null)
            <img src="{{ $management['founder'][0]['img'] }}" alt="{{ $management['founder'][0]['name'] }}">
            @endif
            <h3>{{ $management['founder'][0]['name'] }}</h3>
            <h5>{{ $management['founder'][0]['title'] }}</h5>
            <h2 class="mb-4">{!! $management['founder'][0]['quotes'] !!}</h2>
            <div id="msg">{!! $management['founder'][0]['msg'] !!}</div>
            @endif
        </div>
        <div class="container">
            <div id="management" class="text-left mb-5">
                <h2 class="title-section text-center">{!! App\Http\Controllers\Main\HomeController::buildTitle($title_section['management']) !!}</h2>
                @foreach($management['management'] as $idx => $data)
                <div class="row mb-5">
                    <div class="col-md-4 text-center">
                        @if($data['img'] != null)
                        <div class="img" style="background-image: url('{{ $data['img'] }}');"></div>
                        <!-- <img src="{{ $data['img'] }}" alt="{{ $data['name'] }}"> -->
                        @endif
                    </div>
                    <div class="col">
                        <h3>{{ $data['name'] }}</h3>
                        <h5>{{ $data['title'] }}</h5>
                        <div id="msg">{!! $data['msg'] !!}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="container">
            <div id="staff" class="mb-5">
                <h2 class="title-section text-center mb-5">{!! App\Http\Controllers\Main\HomeController::buildTitle($title_section['staff']) !!}</h2>
                <div class="row">
                    @foreach($management['staff'] as $idx => $data)
                    @if($loop->index%3 == 0)</div><div class="row mb-4">@endif
                    <div class="col text-center align-self-center mb-4">
                        @if($data['img'] != null)
                        <div class="img mb-3" style="background-image: url('{{ $data['img'] }}');"></div>
                        <!-- <img src="{{ $data['img'] }}" alt="{{ $data['name'] }}"> -->
                        @endif
                        <h4>{{ $data['name'] }}</h4>
                        <h5>{{ $data['title'] }}</h5>
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