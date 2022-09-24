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
        #lelang .table-info tbody+tbody,
        #lelang .table-info td,
        #lelang .table-info th,
        #lelang .table-i{
            padding:1.6em 1.8em;
        }
    </style>
@endpush

@section('content')
<div class="fullWidth">
    <div id="gradient" class="fullWidth">
        <div class="container mb-3">
            <div class="row">
                <div class="col-md mb-3">
                    <iframe src="{{ $page_data['location']['embed'] }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div id="contain" class="col-md mb-3">
                    <h1 class="title-section-reverse mb-5 text-left">{!! App\Http\Controllers\Main\HomeController::buildTitle($page_data['location']['title']) !!}</h1>
                    <p class="mb-5 text-justify">{{ $page_data['location']['content'] }}</p>
                    <a class="btn btn-cstm-one" href="{{ $page_data['location']['link'] }}">GET DIRECTION</a>
                </div>
            </div>
        </div>
        @if($page_data['lelang']['count'] > 0)
        <div id="lelang" class="container">
            <h1 class="title-section-reverse mb-5 text-center">{!! App\Http\Controllers\Main\HomeController::buildTitle($page_data['lelang']['title']) !!}</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-info" style="border-radius:35px; border: solid white 2px;">
                    <thead class="text-center" style="color:white; background-color:rgb(19,169,229);">
                        <tr>
                            <th style="max-width: 45vw;">LOKASI</th>
                            <th>HARI/TANGGAL</th>
                            <th>JAM</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($page_data['lelang']['data'] as $idx => $row )
                            <tr>
                                <td style="max-width: 45vw;">{{$row['lokasi']}}</td>
                                <td>{{$row['tanggal']}}</td>
                                <td>{{$row['jam']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
    
    <div class="fullWidth background">
        <div class="img fullWidth" style="background-image: url('{{ $page_data['message']['img'] }}');">
            <div class="container">
                <div class="msg">
                    <form action="{{ route('main.contact.store') }}" method="post">
                        <h1 class="title-section mb-5 text-left">{!! App\Http\Controllers\Main\HomeController::buildTitle('Message') !!}</h1>
                        @if(Session::has('message'))
                            <p class="alert alert-info mt-5 mb-5">{{ Session::get('message') }}</p>
                            @endif
                        @csrf
                        <input max="150" type="text" class="mb-3 form-control" id="name" name="name" placeholder="Name" required>
                        <input max="25" type="text" class="mb-3 form-control" id="phone" name="phone" placeholder="Handphone" required>
                        <input max="150" type="email" class="mb-3 form-control" id="email" name="email" placeholder="Email" required>
                        <input max="150" type="text" class="mb-3 form-control" id="subject" name="subject" placeholder="Subject" required>
                        <textarea max="450" class="mb-5 form-control" name="message" id="message" rows="5" placeholder="Message"></textarea>
                        <div class="text-center">
                            <button type="submit" class="mt-3 btn btn-cstm-one">SUBMIT</button>
                        </div>
                    </form>
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