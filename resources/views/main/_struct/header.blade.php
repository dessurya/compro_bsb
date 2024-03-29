<nav id="header" class="fixed-top">
    <div id="float-toggle-menu" class="d-flex flex-row-reverse close">
        <div id="list" class="fullHeight p-3">
            <div class="fullHeight dis-tab">
                <div class="fullHeight dis-tab-row">
                    <div class="fullHeight dis-tab-cell valg-mid">
                        <ul class="list-group">
                            @foreach($menu as $data)
                            <li class="list-group-item"><a class="p-3" href="{{ $data['route'] }}">{{ $data['label'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="space" class="fullHeight bd-highlight"></div>
    </div>
    <div id="tools" class="d-flex flex-row flex-wrap justify-content-between">
        <div class="dis-tab">
            <div class="dis-tab-row">
                <div class="dis-tab-cell valg-mid">
                    <a class="navbar-brand" href="{{ route('main.home') }}"><img src="{{ $icon }}" alt="bsb" class="d-inline-block"></a>
                </div>
            </div>
        </div>
        <div id="menu" class="dis-tab">
            <div class="dis-tab-row">
                <div class="dis-tab-cell valg-mid">
                    <div id="menu-list" class="d-flex flex-row flex-wrap justify-content-end align-items-center">
                        <a id="lang" href="{{ route('main.language.change') }}"><div></div><img src="{!! App\Http\Controllers\Main\HomeController::getLangIcon(Route::currentRouteName(),$lang) !!}"></a>
                        <div id="wrapper-btn-menu-toggle">
                            <button class="btn-menu-toggle" onclick="$('nav#header #float-toggle-menu').toggleClass('close');this.classList.toggle('opened');this.setAttribute('aria-expanded', this.classList.contains('opened'))" aria-label="Main Menu">
                                <svg width="60" height="60" viewBox="0 0 100 100">
                                    <path class="line line1" d="M 20,38.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
                                    <path class="line line2" d="M 20,50 H 80" />
                                    <path class="line line3" d="M 20,60.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>