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
    nav#header a{
        color: rgb(19 169 229) !important;
    }
    nav#header a:hover{
        color: white !important;
    }
</style>
@endpush

@section('content')
<div class="fullWidth">
    <div class="background fullScrenn mb-3">
        <div class="img fullScrenn" style="background-image: url('{{ url($banner) }}');"></div>
    </div>
    <div class="section">
        <h1 class="title-section text-center">{!! App\Http\Controllers\Main\HomeController::buildTitle($title_page) !!}</h1>
        <div class="container">
            @foreach($products as $row)
            <div class="row">
                @if($loop->iteration % 2 == 0)
                <div class="col">
                    <img src="{{ url($row->img_thumnail) }}" alt="{{ $row->title }}">
                </div>
                <div class="col">
                    <h4>{{ $row->title }}</h4>
                    {!! $row->content !!}
                </div>
                @else
                <div class="col">
                    <h4>{{ $row->title }}</h4>
                    {!! $row->content !!}
                </div>
                <div class="col">
                    <img src="{{ url($row->img_thumnail) }}" alt="{{ $row->title }}">
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('script')
@foreach($js as $data)
<script src="{{ $data }}"></script>
@endforeach
@endpush