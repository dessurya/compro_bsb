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
        <div class="img fullWidth" style="background-image: url('{{ url($banner) }}');"></div>
    </div>
    <div class="section">
        <h1 class="title-section-reverse mb-5 text-center">{!! App\Http\Controllers\Main\HomeController::buildTitle($title_page) !!}</h1>
        <div id="news-list" class="container">
            <div class="row mb-5">
                @foreach($NewsInfo as $row)
                <div class="col-md-4 col-12 text-center mb-4">
                    @if($row->flag_img_thumbnail == 'Y' AND !empty($row->img_thumbnail))
                    <div class="img mb-3" style="background-image: url('{{ url($row->img_thumbnail) }}');"></div>
                    {{-- <img class="mb-2" src="{{ url($row->img_thumbnail) }}" alt="{{ $row->title }}"> --}}
                    @endif
                    <h3 class="title-section mb-4">{{ $row->title }}</h3>
                    <div class="mb-4">
                        {{ Str::words(strip_tags($row->content), ' ...', 35) }}
                    </div>
                    <a class="btn btn-cstm-one" href="{{ route('main.news-info.detail', ['slug'=>$row->slug]) }}">Read More</a>
                </div>
                @endforeach
            </div>
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