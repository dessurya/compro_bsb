<div id="footer">
    <div id="section-one">
        <div class="container">
            <div class="row">
                <div id="info" class="col-8">
                    <h3>Information</h3>
                    <div class="dis-tab">
                        <div class="dis-tab-row">
                            <div class="dis-tab-cell valg-mid"><i class="fas fa-phone" aria-hidden="true"></i></div>
                            <div class="dis-tab-cell valg-mid">
                                <p>021 83796375</p>
                                <p>021 83796375</p>
                            </div>
                        </div>
                        <div class="m-2"></div>
                        <div class="dis-tab-row">
                            <div class="dis-tab-cell valg-mid"><i class="fas fa-envelope" aria-hidden="true"></i></div>
                            <div class="dis-tab-cell valg-mid">
                                <p>info.bsb@arseri.co.id</p>
                            </div>
                        </div>
                        <div class="m-2"></div>
                        <div class="dis-tab-row">
                            <div class="dis-tab-cell valg-mid"><i class="fas fa-map-marker-alt" aria-hidden="true"></i></div>
                            <div class="dis-tab-cell valg-mid">
                                <p>Perkantoran Crown Place Block B 02-03</p>
                                <p>Jl. Prof. Dr Soepomo no 231</p>
                                <p>Jakarta 12870 - Indonesia</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="find" class="col-4 text-right">
                    <h3>Find Us</h3>
                    @foreach($arr['find'] as $img)
                    <img src="{{ $img }}" alt="">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div id="section-two" class="text-center p-3">
        Copyright {{ $arr['copyright'] }} All Rights Reserved
    </div>
</div>