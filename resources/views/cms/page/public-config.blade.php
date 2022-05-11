@extends('cms.layout.base')

@section('title')
Public Config
@endsection

@push('link')
<link rel="stylesheet" href="{{ asset('vendors/summernote/summernote.min.css') }}">
@endpush

@push('content')
<div class="container">
    
    <div class="row">
        <div class="col-12">
            <div id="PublicConfig">
                <form onsubmit="return submitPublicConfig()"  enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>Form <b></b></h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col form-group">
                                    <label for="web_name">Web Name</label>
                                    <input type="text" class="form-control" id="web_name" name="web_name" placeholder="web_name" value="{{ $arrConf['web']['name'] }}" required>
                                </div>
                                <div class="col form-group">
                                    <label for="web_icon">Web Icon @if(isset($arrConf['web']['icon']) and $arrConf['web']['icon'] != null and $arrConf['web']['icon'] != '')<a href="{{ url($arrConf['web']['icon']) }}" target="_blank" rel="noopener noreferrer">show</a>@endif</label>
                                    <input type="file" class="form-control" id="web_icon" name="web_icon" accept="image/*">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="email">Email</label>
                                    <textarea id="email" name="email">{{ $arrConf['email'] }}</textarea>
                                </div>
                                <div class="col form-group">
                                    <label for="phone">Phone</label>
                                    <textarea id="phone" name="phone">{{ $arrConf['phone'] }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="address">Address</label>
                                    <textarea id="address" name="address">{{ $arrConf['address'] }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="navigasi_icon">Navigasi Icon @if(isset($arrConf['navigasi']['icon']) and $arrConf['navigasi']['icon'] != null and $arrConf['navigasi']['icon'] != '')<a href="{{ url($arrConf['navigasi']['icon']) }}" target="_blank" rel="noopener noreferrer">show</a>@endif</label>
                                    <input type="file" class="form-control" id="navigasi_icon" name="navigasi_icon" accept="image/*">
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
<script src="{{ asset('vendors/summernote/summernote.min.js') }}"></script>
<script>
    $( document ).ready(function() {
        $('[name=address]').summernote()
        $('[name=email]').summernote()
        $('[name=phone]').summernote()
    });

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
        httpRequest('{{ route("cms.public-config.store") }}','post',param).then(function(result){
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
        await httpRequest('{{ route("cms.public-config.store") }}','post',param).then(function(result){ 
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
                await httpRequest('{{ route("cms.public-config.store") }}','post',param).then(function(result){ 
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
                await httpRequest('{{ route("cms.public-config.store") }}','post',param).then(function(result){ 
                    showPNotify('Info','Success','info')
                    loadingScreen(false)
                    location.reload()
                })
            };
        })
    }

    submitPublicConfig = () => {
        loadingScreen(true)
        submitPublicConfigExe()
        return false
    }
    submitPublicConfigExe = async () =>{
        const storeString = await submitPublicConfigExeSend()
        if (storeString == true) { await storeImgWebIcon() }
    }
    submitPublicConfigExeSend = async () =>{
        let param = {}
        param.type = 'string'
        param.web_name = $('[name=web_name]').val()
        param.address = $('[name=address]').summernote('code')
        param.phone = $('[name=phone]').summernote('code')
        param.email = $('[name=email]').summernote('code')
        const resStore = await httpRequest('{{ route("cms.public-config.store") }}','post',param).then(function(result){ return result })
        return true
    }
    storeImgWebIcon = async () => {
        let pictures = $('[name=web_icon]').prop('files')
        let count_img = pictures.length
        if (count_img == 0) {
            storeImgNavigasiIcon()
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
                        'key':'icon',
                        'for':'web'
                    }
                    httpRequest('{{ route("cms.public-config.store") }}','post',param).then(function(result){ 
                        storeImgNavigasiIcon()
                    })
                };
            })
        }
    }
    storeImgNavigasiIcon = async () => {
        let pictures = $('[name=navigasi_icon]').prop('files')
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
                        'key':'icon',
                        'for':'navigasi'
                    }
                    httpRequest('{{ route("cms.public-config.store") }}','post',param).then(function(result){ 
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