@extends('cms.layout.base')

@section('title')
Home Page Config
@endsection

@push('link')
@endpush

@push('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div id="PublicConfig">
                <form onsubmit="return submitPageConfig()"  enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>Form <b></b></h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col form-group">
                                    <label for="banner_max_item">Banner Max Item</label>
                                    <input type="number" class="form-control" id="banner_max_item" name="banner_max_item" min="3" max="6" value="{{ $arrConf['banner']['max_item'] }}" required>
                                </div>
                                <div class="col form-group">
                                    <label for="news_info_max_item">News & Info Max Item</label>
                                    <input type="number" class="form-control" id="news_info_max_item" name="news_info_max_item" min="3" max="6" value="{{ $arrConf['news_info']['max_item'] }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="our_client_img">Our Client Img @if(isset($arrConf['our_client']['img']) and $arrConf['our_client']['img'] != null and $arrConf['our_client']['img'] != '')<a href="{{ url($arrConf['our_client']['img']) }}" target="_blank" rel="noopener noreferrer">show</a>@endif</label>
                                    <input type="file" class="form-control" id="our_client_img" name="our_client_img" accept="image/*">
                                </div>
                                <div class="col form-group">
                                    <label for="our_client_background">Our Client Img @if(isset($arrConf['our_client']['background']) and $arrConf['our_client']['background'] != null and $arrConf['our_client']['background'] != '')<a href="{{ url($arrConf['our_client']['background']) }}" target="_blank" rel="noopener noreferrer">show</a>@endif</label>
                                    <input type="file" class="form-control" id="our_client_background" name="our_client_background" accept="image/*">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="quotes_line_1">Quotes Line 1</label>
                                    <input type="text" class="form-control" id="quotes_line_1" name="quotes_line_1" value="{{ $arrConf['quotes']['line_1'] }}" required>
                                </div>
                                <div class="col form-group">
                                    <label for="quotes_line_2">Quotes Line 2</label>
                                    <input type="text" class="form-control" id="quotes_line_2" name="quotes_line_2" value="{{ $arrConf['quotes']['line_2'] }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-sm btn-block btn-outline-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div id="mediaSocialWrapp" class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Social Media <span onclick="addMediaSocial()" class="btn btn-sm btn-block btn-outline-info">Add</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form onsubmit="return submitMediaSocial()"  enctype="multipart/form-data" style="display:none">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        Add Media Social
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="identity">Media Sosial Name</label>
                                            <input type="text" class="form-control" id="identity" name="identity" placeholder="Media Sosial Name" required>
                                        </div>
                                        <div class="col form-group">
                                            <label for="url">Media Sosial Url</label>
                                            <input type="url" class="form-control" id="url" name="url" placeholder="Media Sosial Url" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="img_dark">Img Dark</label>
                                            <input type="file" class="form-control" id="img_dark" name="img_dark" accept="image/*" required>
                                        </div>
                                        <div class="col form-group">
                                            <label for="img_light">Img Light</label>
                                            <input type="file" class="form-control" id="img_light" name="img_light" accept="image/*" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col"><button type="reset" onclick="closeMediaSocial()" class="btn btn-sm btn-block btn-outline-danger">Close</button></div>
                                        <div class="col"><button type="submit" class="btn btn-sm btn-block btn-outline-success">Submit</button></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table class="table">
                            <thead>
                                <th>Media Sosial Name</th>
                                <th>Media Sosial Url</th>
                                <th>Img Dark</th>
                                <th>Img Light</th>
                                <th>-</th>
                            </thead>
                            <tbody>
                                @foreach($arrConf['media_social'] as $idx => $data)
                                @if(isset($data['identity']))
                                <tr id="ms_{{$idx}}">
                                    <td>{{$data['identity']}}</td>
                                    <td><a href="{{$data['url']}}" target="_blank" rel="noopener noreferrer">{{$data['url']}}</a></td>
                                    <td><a href="{{url($data['img_dark'])}}" target="_blank" rel="noopener noreferrer">show</a></td>
                                    <td><a href="{{url($data['img_light'])}}" target="_blank" rel="noopener noreferrer">show</a></td>
                                    <td><button onclick="removeMediaSocial('{{$idx}}')" class="btn btn-sm btn-block btn-outline-danger">Delete</button></td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endpush

@push('script')
<script>
    closeMediaSocial = () => {
        $('#mediaSocialWrapp form').fadeOut()
    }
    addMediaSocial = () => {
        $('#mediaSocialWrapp form button[type=reset]').click()
        $('#mediaSocialWrapp form').fadeIn()
    }

    removeMediaSocial = (idx) => {
        loadingScreen(true)
        let param = {}
        param.type = 'remove_media_social'
        param.idx = idx
        httpRequest('{{ route("cms.page-config.home.store") }}','post',param).then(function(result){
            loadingScreen(false)
            location.reload()
        })
    }

    submitMediaSocial = () => {
        loadingScreen(true)
        submitMediaSocialExe()
        return false
    }

    submitMediaSocialExe = async () => {
        let param = {}
        param.type = 'string_media_social'
        param.identity = $('#mediaSocialWrapp form [name=identity]').val()
        param.url = $('#mediaSocialWrapp form [name=url]').val()
        await httpRequest('{{ route("cms.page-config.home.store") }}','post',param).then(function(result){ 
            storeImgDarkMediaSocial(result.idx)
        })
    }

    storeImgDarkMediaSocial = async (id_idx) => {
        let pictures = $('#mediaSocialWrapp form [name=img_dark]').prop('files')
        $.each(pictures, async function(idx,img){
            img.idx = id_idx
            var reader = new FileReader();
            reader.readAsArrayBuffer(img);
            reader.onloadend = async function(oFREvent) {
                var byteArray = new Uint8Array(oFREvent.target.result)
                var len = byteArray.byteLength
                var binary = ''
                for (var i = 0; i < len; i++) { binary += String.fromCharCode(byteArray[i]) }
                byteArray = window.btoa(binary)
                let param =  {
                    'img_encode':byteArray,
                    'img_name':img.name,
                    'img_type':img.type,
                    'type':'img_media_social',
                    'key' : 'dark',
                    'idx':img.idx
                }
                await httpRequest('{{ route("cms.page-config.home.store") }}','post',param).then(function(result){ 
                    storeImgLightMediaSocial(result.idx)
                })
            };
        })
    }

    storeImgLightMediaSocial = async (id_idx) => {
        let pictures = $('#mediaSocialWrapp form [name=img_light]').prop('files')
        $.each(pictures, async function(idx,img){
            img.idx = id_idx
            var reader = new FileReader();
            reader.readAsArrayBuffer(img);
            reader.onloadend = async function(oFREvent) {
                var byteArray = new Uint8Array(oFREvent.target.result)
                var len = byteArray.byteLength
                var binary = ''
                for (var i = 0; i < len; i++) { binary += String.fromCharCode(byteArray[i]) }
                byteArray = window.btoa(binary)
                let param =  {
                    'img_encode':byteArray,
                    'img_name':img.name,
                    'img_type':img.type,
                    'type':'img_media_social',
                    'key' : 'light',
                    'idx':img.idx
                }
                await httpRequest('{{ route("cms.page-config.home.store") }}','post',param).then(function(result){ 
                    showPNotify('Info','Success','info')
                    loadingScreen(false)
                    location.reload()
                })
            };
        })
    }

    submitPageConfig = () => {
        loadingScreen(true)
        submitPageConfigExe()
        return false
    }
    submitPageConfigExe = async () =>{
        const storeString = await submitPageConfigExeSend()
        if (storeString == true) { await storeImgOurClient() }
    }
    submitPageConfigExeSend = async () =>{
        let param = {}
        param.type = 'string'
        param.banner_max_item = $('[name=banner_max_item]').val()
        param.news_info_max_item = $('[name=news_info_max_item]').val()
        param.quotes_line_1 = $('[name=quotes_line_1]').val()
        param.quotes_line_2 = $('[name=quotes_line_2]').val()
        const resStore = await httpRequest('{{ route("cms.page-config.home.store") }}','post',param).then(function(result){ return result })
        return true
    }
    storeImgOurClient = async () => {
        let pictures = $('[name=our_client_img]').prop('files')
        let count_img = pictures.length
        if (count_img == 0) {
            storeImgBackgroundOurClient()
        }else{
            $.each(pictures, async function(idx,img){
                var reader = new FileReader();
                reader.readAsArrayBuffer(img);
                reader.onloadend = async function(oFREvent) {
                    var byteArray = new Uint8Array(oFREvent.target.result)
                    var len = byteArray.byteLength
                    var binary = ''
                    for (var i = 0; i < len; i++) { binary += String.fromCharCode(byteArray[i]) }
                    byteArray = window.btoa(binary)
                    let param =  {
                        'img_encode':byteArray,
                        'img_name':img.name,
                        'img_type':img.type,
                        'type':'img',
                        'key':'img',
                        'for':'our_client'
                    }
                    httpRequest('{{ route("cms.page-config.home.store") }}','post',param).then(function(result){ 
                        storeImgBackgroundOurClient()
                    })
                };
            })
        }
    }
    storeImgBackgroundOurClient = async () => {
        let pictures = $('[name=our_client_background]').prop('files')
        let count_img = pictures.length
        if (count_img == 0) {
            showPNotify('Info','Success','info')
            loadingScreen(false)
            location.reload()
        }else{
            $.each(pictures, async function(idx,img){
                var reader = new FileReader();
                reader.readAsArrayBuffer(img);
                reader.onloadend = async function(oFREvent) {
                    var byteArray = new Uint8Array(oFREvent.target.result)
                    var len = byteArray.byteLength
                    var binary = ''
                    for (var i = 0; i < len; i++) { binary += String.fromCharCode(byteArray[i]) }
                    byteArray = window.btoa(binary)
                    let param =  {
                        'img_encode':byteArray,
                        'img_name':img.name,
                        'img_type':img.type,
                        'type':'img',
                        'key':'background',
                        'for':'our_client'
                    }
                    httpRequest('{{ route("cms.page-config.home.store") }}','post',param).then(function(result){ 
                        showPNotify('Info','Success','info')
                        loadingScreen(false)
                        location.reload()
                    })
                };
            })
        }
    }
</script>
@endpush