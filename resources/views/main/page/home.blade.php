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
<div id="banner" class="fullScrenn">
    <div id="owl" class="owl-carousel owl-theme fullScrenn">
        @foreach($banner as $data)
        <div class="item background fullScrenn">
            <div class="img fullScrenn" style="background-image: url('{{ url($data->img) }}');">
                <div class="content container-fluid fullScrenn dis-tab">
                    <div class="row dis-tab-row">
                        <div class="content-item col-md-6 col-2 dis-tab-cell valg-bot">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-6 col-12">
                                    <h3>{{ $data->title }}</h3>
                                    <p>{{ $data->description }}</p>
                                    @if(!empty($data->link))
                                    <a class="btn btn-cstm-one" href="{{ $data->link }}">Read More</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="line-teks col-md-5 col-8 dis-tab-cell valg-mid text-right">
                            <h2>{{ $data->text }}</h2>
                            <a href="#teksture"><img id="chev-down" src="{{ url('pict_content_asset/_default/scrol.png') }}" alt="scroll-down"></a>
                        </div>
                        <div class="col-2 dis-tab-cell valg-mid text-center">
                            <div class="vertical-line"></div>
                            @foreach($configMedsos as $img)
                            <a href="{{ $img['url'] }}" target="_blank" rel="noopener noreferrer">
                                <img class="icon" src="{{ $img['img_light'] }}" alt="{{ $img['identity'] }}">
                            </a>
                            @endforeach
                            <div class="vertical-line"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div id="teksture" class="fullWidth">
    <div id="bc-white" class="pos-abs"></div>
    <div id="bc-dark" class="pos-abs"></div>
    <div id="bc-light" class="pos-abs"></div>
    <div id="quotes" class="section">
        <div class="container">
            <div class="row">
                <div id="img-show" class="col-md-6 col-sm-12">
                    <div class="d-flex flex-row flex-wrap justify-content-center">
                        @foreach($quotes_img as $data)
                            @if($loop->iteration % 2 != 0) <div class="d-flex flex-column"> @endif
                            @if($data['img'] != null) <div class="img" style="background-image: url('{{ $data['img'] }}');"></div>@endif
                            @if($loop->iteration % 2 == 0) </div> @endif
                        @endforeach
                    </div>
                </div>
                <div id="content" class="col-md-6 col-sm-12">
                    <div class="dis-tab">
                        <div class="dis-tab-row">
                            <div class="dis-tab-cell valg-mid text-center">
                                <img src="{{ url('pict_content_asset/_default/kutip.png') }}" alt="-">
                                <p>{{ $quotes[1] }}</p>
                                <p>{{ $quotes[2] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="product" class="section text-center">
        <h1 class="title-section-reverse">{!! App\Http\Controllers\Main\HomeController::buildTitle($pageConfig['Our Product']) !!}</h1>
        <div class="container">
            <div class="row">
                @foreach($product as $data)
                <div class="col">
                    <img src="{{ url($data->img_thumnail) }}" alt="{{ $data->title }}">
                    <h3>{{ $data->title }}</h3>
                    <div class="text">
                        <p>{{ $data->content_shoert }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="clearboth"></div>
</div>

<div id="sustainability" class="section">
    <img id="img" src="{{ url('pict_content_asset/_default/lengkung 3.png') }}">
    <h1 class="title-section-reverse text-center">{!! App\Http\Controllers\Main\HomeController::buildTitle($pageConfig['Sustainability']) !!}</h1>
    <div id="content" class="container">
        <div class="row">
            @foreach($sustainability as $data)
            <div class="col">
                <div class="img" style="background-image: url('{{ url($data->img_thumnail) }}');"></div>
                <br>
                <h3 class="p-2">{{ $data->title }}</h3>
                <p class="p-2">{{ $data->content_shoert }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div id="client" class="section fullWidth text-center" style="background-image: url('{{ url($our_client['background']) }}');">
    <h1 class="title-section">{!! App\Http\Controllers\Main\HomeController::buildTitle($pageConfig['Our Client']) !!}</h1>
    <div class="container">
        <img src="{{ url($our_client['img']) }}" alt="">
    </div>
</div>

<div id="news_info" class="section">
    <div class="container">
        <div class="row p-3">
            <div class="col-md"></div>
            <div class="col-md col-12">
                <h1 class="title-section-reverse text-center">{!! App\Http\Controllers\Main\HomeController::buildTitle($pageConfig['News & Info']) !!}</h1>
            </div>
        </div>
        <div id="owl" class="owl-carousel owl-theme p-3">
            @foreach($news as $data)
            <div class="item row">
                <div class="col-md col-12 text-center">
                    @if($data->flag_img_thumbnail == 'Y' AND !empty($data->img_thumbnail))
                    <img src="{{ url($data->img_thumbnail) }}" alt="{{ $data->title }}">
                    @endif
                </div>
                <div class="col-md col-12">
                    <h3>{{ $data->title }}</h3>
                    <p>{{ Str::words(strip_tags($data->content), 35, ' ...') }}</p>
                    <a class="btn btn-cstm-one" href="#">Read More</a>
                </div>
            </div>
            @endforeach
        </div>
        <div id="owlNav" class="row">
            <div class="col p-5 text-right"><img onclick="owlNavigate('#news_info #owl','owl.next')" src="{{ url('pict_content_asset/_default/kri.png') }}" alt=""></div>
            <div class="col p-5 text-left"><img onclick="owlNavigate('#news_info #owl','owl.prev')" src="{{ url('pict_content_asset/_default/kanan.png') }}" alt=""></div>
        </div>
    </div>
</div>
@endsection

@push('script')
@foreach($js as $data)
<script src="{{ $data }}"></script>
@endforeach
<script>
    $(document).ready(function(){ 
        const owlBanner = {
            items:1, singleItem:true, slideSpeed:450, paginationSpeed:1050, autoPlay:7500, pagination: false,
            transitionStyle : "fadeUp"
        }
        $("#banner #owl").owlCarousel(owlBanner) 
        let owlNewsInfo = owlBanner
        owlNewsInfo.autoPlay = false
        owlNewsInfo.transitionStyle = 'backSlide'
        $("#news_info #owl").owlCarousel(owlNewsInfo) 
    })
    owlNavigate = (owlContent, action) => {
        $(owlContent).trigger(action)
    }
</script>
@endpush