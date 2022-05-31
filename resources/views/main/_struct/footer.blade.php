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
                                {!! $arr['email'] !!}
                            </div>
                        </div>
                        <div class="m-2"></div>
                        <div class="dis-tab-row">
                            <div class="dis-tab-cell valg-mid"><i class="fas fa-envelope" aria-hidden="true"></i></div>
                            <div class="dis-tab-cell valg-mid">
                                {!! $arr['phone'] !!}
                            </div>
                        </div>
                        <div class="m-2"></div>
                        <div class="dis-tab-row">
                            <div class="dis-tab-cell valg-mid"><i class="fas fa-map-marker-alt" aria-hidden="true"></i></div>
                            <div class="dis-tab-cell valg-mid">
                                {!! $arr['address'] !!}
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