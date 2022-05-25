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
    #ourclient{
        margin-top:190px;
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
            <div class="text-center"><img src="{{ $page_data['img'] }}" alt="maps"></div>
        </div>
    </div>
</div>
@endsection

@push('script')
@foreach($js as $data)
<script src="{{ $data }}"></script>
@endforeach
@endpush