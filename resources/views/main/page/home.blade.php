@extends('main._struct.base')

@push('meta')
<meta name="author" content="">
<meta name="title" content="">
<meta name="description" content="">
<meta name="keywords" content="">
@endpush

@push('link')
@foreach($css as $data)
<link rel="stylesheet" href="{{ $data }}">
@endforeach
<style>
    /* public */
        .section{
            position: relative;
            width:100vw;
            padding: 4.4em 0;
            position: relative;
            margin: 0 auto;
        }
    /* public */

    /* #banner */
        #banner{
            position: relative;
            z-index: 100;
        }
        #banner h3{
            font-weight: 700;
            font-size: 26pt; 
        }
        #banner .background .img{
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        #banner .background .img .content{
            padding:0 4em;
        }
        #banner .background .img .content h2{
            font-weight: 800;
            font-size: 68pt;
        }
        #banner .row div{
            color: white;
            padding: 1.8em 0;
        }
        #banner #chev-down{
            cursor: pointer;
            width:45px;
        }
        #banner .vertical-line{
            width:0;
            height:20vh;
            border: solid white 1px;
            margin: 2em auto;
        }
        #banner .icon{
            cursor: pointer;
            font-size: 12pt;
            vertical-align: middle;
            padding: .5em .8em;
            border: solid 1px white;
            border-radius: 100%;
        }
    /* #banner */

    /* #quotes */
        #quotes{
            color: rgba(1,160,228,1);
        }
        #quotes #img-show .flex-column .img{
            height:245px;
            width:255px;
            margin: 5px;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        #quotes #img-show .flex-column {
            max-width: 260px;
        }
        #quotes #content{
            padding:0 3.6em;
        }
        #quotes #content .dis-tab,
        #quotes #content .dis-tab .dis-tab-row,
        #quotes #content .dis-tab .dis-tab-row .dis-tab-cell{
            width:100%;
            height:460px;
            line-height: 1.1;
        }
        #quotes #frase-0 img{
            height:160px;
        }
        #quotes #frase-1 p{
            font-weight: 300;
            font-size: 30pt;
            font-style: italic;
            margin:0;
            padding:0;
            padding-left:.2em;
        }
        #quotes #frase-2{
            font-weight: 700;
            font-size: 26pt;
            font-style: italic;
        }
    /* #quotes */

    /* #product */
        #product h1{
            color: rgba(1,160,228,1);
            padding-top: 1em;
            padding-bottom: 2em;
        }
        #product h3{
            margin-bottom: .8em;
            font-weight: 700;
            color: rgba(1,160,228,1);
        }
        #product p {
            line-height: 1.8em;
        }
        #product img{
            margin-bottom: 1.4em;
            width:200px;
        }
        #product .text{
            width:85%;
            margin: 0 auto;
        }
    /* #product */
    
    /* #teksture */
        #teksture{
            position: relative;
            background-image: linear-gradient(rgb(217, 234, 224), rgb(217, 234, 224), rgb(217, 234, 224), rgb(255,255,255));
            background-color:rgb(217, 234, 224);
        }
        #teksture #bc-white{
            top:0;
            width: 100vw;
            background-color:white;
            height:122vh;
            border-radius: 0 0 0 59%;
        }
        #teksture #bc-dark{
            top:-565px;
            height:1225px;
            width:1225px;
            right: -142.5px;
            background-color:rgb(216 236 225);
            border-radius: 100%;
        }
        #teksture #bc-light{
            top:-500px;
            height:1050px;
            width:1050px;
            right: -55px;
            background-color:rgb(229 240 234);
            border-radius: 100%;
            box-shadow: -2px 5px 8px rgba(111,111,111,.4);
        }
    /* #teksture */

    /* #client */
        #client{
            color: white;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        #client h1{
            padding-top: 0;
            padding-bottom: 1.6em;
        }
        #client h1 span:nth-child(odd){
            font-weight: 300;
        }
        #client h1 span:nth-child(even){
            font-weight: 700;
        }
        #client img{
            width:100%;
        }
    /* #client */

    /* #sustainability */
        #sustainability h1{
            padding: 4em 0 4em;
            font-weight: 700;
            color: rgba(1,160,228,1);
        }
        #sustainability img#img{
            position: absolute;
            top:0;
            left:0;
            width:100%;
        }
        #sustainability #content .img{
            height:240px;
            width:240px;
            margin: 0 auto;
            border-radius: 100%;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        #sustainability #content h3{
            color: rgba(1,160,228,1);
        }
        #sustainability #content p{
            border-bottom: double 4px;
            border-color: rgba(1,160,228,1);
        }
    /* #sustainability */

    /* #news_info */
        #news_info h1,
        #news_info h3{
            color: rgba(1,160,228,1);
        }
        #news_info img {
            max-width: 85%;
        }
        #news_info #owlNav img{
            width: 58px;
            cursor: pointer;
        }
    /* #news_info */
</style>
@endpush

@section('content')
<div id="banner" class="fullScrenn">
    <div id="owl" class="owl-carousel owl-theme fullScrenn">
        @foreach($banner as $data)
        <div class="item background fullScrenn">
            <div class="img fullScrenn" style="background-image: url('{{ $data }}');">
                <div class="content container-fluid fullScrenn dis-tab">
                    <div class="row dis-tab-row">
                        <div class="col-6 dis-tab-cell valg-bot">
                            <div class="row">
                                <div class="col-6">
                                    <h3>Pearl</h3>
                                    <p>Budi daya Mutiara PT. Bima Sakti Bahari merupakan satu-satunya budi daya mutiara terbesar</p>
                                    <a class="btn btn-cstm-one" href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 dis-tab-cell valg-mid text-right">
                            <h2>EXPLORE MORE</h2>
                            <a href="#teksture"><img id="chev-down" src="{{ url('pict_content_asset/_default/scrol.png') }}" alt="scroll-down"></a>
                        </div>
                        <div class="col-1 dis-tab-cell valg-mid text-center">
                            <div class="vertical-line"></div>
                            <span class="icon"><i class="fab fa-instagram" aria-hidden="true"></i></span>
                            <br><br>
                            <span class="icon"><i class="fab fa-facebook-f" aria-hidden="true"></i></span>
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
        <div class="container-fluid">
            <div class="d-flex flex-row flex-wrap">
                <div id="img-show" class="d-flex flex-column">
                    <div class="d-flex flex-row flex-wrap justify-content-center">
                        @foreach($quotes_img as $data)
                            @if($loop->iteration % 2 != 0) <div class="d-flex flex-column"> @endif
                            <div class="img" style="background-image: url('{{ $data['img'] }}');"></div>
                            @if($loop->iteration % 2 == 0) </div> @endif
                        @endforeach
                    </div>
                </div>
                <div id="content" class="d-flex flex-column">
                    <div class="dis-tab">
                        <div class="dis-tab-row">
                            <div class="dis-tab-cell valg-mid">
                                <div class="d-flex">
                                    <div id="frase-0" class="p-0"><img src="{{ url('pict_content_asset/_default/kutip.png') }}" alt="-"></div>
                                    <div id="frase-1" class="mt-auto"><p>Kami tidak hanya mengejar keuntungan</p></div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <p id="frase-2">Tetapi reputasi yang layak dibanggakan bangsa dan negara</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="product" class="section text-center">
        <h1 class="title-section">{!! App\Http\Controllers\Main\HomeController::buildTitle('OUR PRODUCT') !!}</h1>
        <div class="container-fluid">
            <div class="row">
                @foreach($product as $data)
                <div class="col">
                    <img src="{{ $data['img'] }}" alt="{{ $data['title'] }}">
                    <h3>{{ $data['title'] }}</h3>
                    <div class="text">
                        <p>{{ $data['desc'] }}</p>
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
    <h1 class="title-section-reverse text-center">{!! App\Http\Controllers\Main\HomeController::buildTitle('SUSTAINABILITY') !!}</h1>
    <div id="content" class="container">
        <div class="row">
            @foreach($sustainability as $data)
            <div class="col">
                <div class="img" style="background-image: url('{{ $data['img'] }}');"></div>
                <br>
                <h3 class="p-2">{{ $data['title'] }}</h3>
                <p class="p-2">{{ $data['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div id="client" class="section fullWidth text-center" style="background-image: url('{{ url('pict_content_asset/_default/gambar 5.jpg') }}');">
    <h1 class="title-section">{!! App\Http\Controllers\Main\HomeController::buildTitle('OUR CLIENT') !!}</h1>
    <div class="container">
        <img src="{{ url('pict_content_asset/_default/peta pin.png') }}" alt="">
    </div>
</div>

<div id="news_info" class="section">
    <div class="container">
        <div class="row p-3">
            <div class="col"></div>
            <div class="col">
                <h1 class="title-section-reverse text-center">{!! App\Http\Controllers\Main\HomeController::buildTitle('NEWS & INFO') !!}</h1>
            </div>
        </div>
        <div id="owl" class="owl-carousel owl-theme p-3">
            @foreach($product as $data)
            <div class="item row">
                <div class="col text-center"><img src="{{ $data['img'] }}" alt=""></div>
                <div class="col">
                    <h3>{{ $data['title'] }}</h3>
                    <p>{{ $data['desc'] }}</p>
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