@extends('cms.layout.base')

@section('title')
Public Config
@endsection

@push('link')
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
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="web_icon">Web Icon @if(isset($arrConf['web']['icon']) and $arrConf['web']['icon'] != null and $arrConf['web']['icon'] != '')<a href="{{ $arrConf['web']['icon'] }}" target="_blank" rel="noopener noreferrer">show</a>@endif</label>
                                    <input type="file" class="form-control" id="web_icon" name="web_icon" accept="image/*">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="navigasi_icon">Navigasi Icon @if(isset($arrConf['navigasi']['icon']) and $arrConf['navigasi']['icon'] != null and $arrConf['navigasi']['icon'] != '')<a href="{{ $arrConf['web']['icon'] }}" target="_blank" rel="noopener noreferrer">show</a>@endif</label>
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
            </div>
        </div>
    </div>
</div>
@endpush

@push('script')
<script>
    submitPublicConfig = () => {
        loadingScreen(true)
        submitPublicConfigExe()
        return false
    }
    submitPublicConfigExe = async () =>{
        const storeString = await submitPublicConfigExeSend()
        if (storeString == true) {
            const storeImgWebIcon = await storeImgWebIcon()
            if (storeImgWebIcon == true) {
                const storeImgNavigasiIcon = await storeImgNavigasiIcon()
                if (storeImgNavigasiIcon == true) {
                    showPNotify('Info','Success','info')
                    loadingScreen(false)
                    location.reload()
                }
            }
        }
    }
    submitPublicConfigExeSend = async () =>{
        let param = {}
        param.type = 'string'
        param.web_name = $('[name=web_name]').val()
        const resStore = await httpRequest('{{ route("cms.public-config.store") }}','post',param).then(function(result){ return result })
        return true
    }
    storeImgWebIcon = async () => {
        let pictures = $('[name=web_icon]').prop('files')
        let count_img = pictures.length
        if (count_img == 0) {
            return true
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
                        return true
                    })
                };
            })
        }
    }
    storeImgNavigasiIcon = async () => {
        let pictures = $('[name=navigasi_icon]').prop('files')
        let count_img = pictures.length
        if (count_img == 0) {
            return true
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
                        return true
                    })
                };
            })
        }
    }
</script>
@endpush