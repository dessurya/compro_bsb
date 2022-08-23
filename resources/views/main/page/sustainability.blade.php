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
<div class="fullWidth">
    <div id="gradient"></div>
    <div id="banner" class="background fullWidth">
        <div class="img fullWidth" style="background-image: url('{{ url($banner) }}');">
            <div class="container">
                <div class="dis-tab">
                    <div class="dis-tab-row">
                        <div class="dis-tab-cell valg-mid">
                            <h1 class="title-section-reverse">{!! App\Http\Controllers\Main\HomeController::buildTitle($title_page) !!}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div id="investor" class="container mt-5">
            @foreach($Sustainability as $row)
            <div class="row">
                @if($loop->iteration % 2 == 0)
                <div class="col text-center">
                    <img src="{{ $row->img_thumnail }}" alt="{{ $row->title }}">
                </div>
                <div class="col text-right">
                    <h3 class="title-section">{{ $row->title }}</h3>
                    {!! $row->content_shoert !!}
                </div>
                @else
                <div class="col text-left">
                    <h3 class="title-section">{{ $row->title }}</h3>
                    {!! $row->content_shoert !!}
                </div>
                <div class="col text-center">
                    <img src="{{ $row->img_thumnail }}" alt="{{ $row->title }}">
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="fullWidth">
    <div id="certificate" class="background fullWidth">
        <div class="img fullWidth" style="background-image: url('{{ url($banner) }}');">
            <div class="container">
                <div class="dis-tab">
                    <div class="dis-tab-row">
                        <div class="dis-tab-cell valg-mid text-center">
                            <h1 class="title-section-reverse">Certificate</h1>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia natus provident fugit, neque, reiciendis rem aliquid inventore, sequi quos iste sunt! Nostrum laboriosam est veritatis doloremque illum deleniti pariatur excepturi!
                            </p>
                            <a class="btn btn-cstm-one" href="/">DOWNLOAD</a>
                        </div>
                    </div>
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