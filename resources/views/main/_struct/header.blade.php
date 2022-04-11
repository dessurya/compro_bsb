<nav id="header" class="fixed-top p-4">
    <a id="lang" href="{{ route('main.language.change') }}"><div></div><img src="{!! App\Http\Controllers\Main\HomeController::getLangIcon($lang) !!}"></a>
    <div class="d-flex flex-row flex-wrap justify-content-between">
        <div class="dis-tab">
            <div class="dis-tab-row">
                <div class="dis-tab-cell valg-mid">
                    <a class="navbar-brand" href="{{ route('main.home') }}"><img src="{{ $icon }}" alt="bsb" class="d-inline-block"></a>
                </div>
            </div>
        </div>
        <div class="dis-tab">
            <div class="dis-tab-row">
                <div class="dis-tab-cell valg-mid">
                    <div class="d-flex flex-row flex-wrap justify-content-end">
                        @foreach($menu as $data)
                        <a class="p-3" href="{{ $data['route'] }}">{{ $data['label'] }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>