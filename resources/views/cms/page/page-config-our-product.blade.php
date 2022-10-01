@extends('cms.layout.base')

@section('title')
Our Product Page Config
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
                                    <label for="title_id">Titles Indonesia</label>
                                    <input type="text" class="form-control" id="title_id" name="title_id" value="{{ $arrConf['title']['id'] }}" required>
                                </div>
                                <div class="col form-group">
                                    <label for="title_en">Titles English</label>
                                    <input type="text" class="form-control" id="title_en" name="title_en" value="{{ $arrConf['title']['en'] }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="banner">Banner Img @if(isset($arrConf['banner']['img']) and $arrConf['banner']['img'] != null and $arrConf['banner']['img'] != '')<a href="{{ url($arrConf['banner']['img']) }}" target="_blank" rel="noopener noreferrer">show</a>@endif</label>
                                    <input type="file" class="form-control" id="banner" name="banner" accept="image/*">
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
    submitPageConfig = () => {
        loadingScreen(true)
        submitPageConfigExe()
        return false
    }
    submitPageConfigExe = async () =>{
        const storeString = await submitPageConfigExeSend()
        if (storeString == true) { await storeImg() }
    }
    submitPageConfigExeSend = async () =>{
        let param = {}
        param.type = 'string'
        param.title_id = $('[name=title_id]').val()
        param.title_en = $('[name=title_en]').val()
        const resStore = await httpRequest('{{ route("cms.page-config.our-product.store") }}','post',param).then(function(result){ return result })
        return true
    }
    storeImg = async () => {
        let pictures = $('[name=banner]').prop('files')
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
                        'key':'img',
                        'for':'banner'
                    }
                    httpRequest('{{ route("cms.page-config.our-product.store") }}','post',param).then(function(result){ 
                        showPNotify('Info','Success','info')
                        loadingScreen(false)
                        location.reload()
                    })
                };
            })
        }
    }
</script>
@include('cms.component.validate-max-file')
@endpush