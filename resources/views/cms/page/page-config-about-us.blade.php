@extends('cms.layout.base')

@section('title')
About Us Page Config
@endsection

@push('link')
<link rel="stylesheet" href="{{ asset('vendors/summernote/summernote.min.css') }}">
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
                                    <label for="intruduction_id_title">Introduction Title Indonesia</label>
                                    <input type="text" class="form-control" id="intruduction_id_title" name="intruduction_id_title" value="{{ $arrConf['intruduction']['id']['title'] }}" required>
                                </div>
                                <div class="col form-group">
                                    <label for="intruduction_en_title">Introduction Title English</label>
                                    <input type="text" class="form-control" id="intruduction_en_title" name="intruduction_en_title" value="{{ $arrConf['intruduction']['en']['title'] }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="intruduction_id_content">Introduction Content Indonesia</label>
                                    <textarea id="intruduction_id_content" name="intruduction_id_content">{{ $arrConf['intruduction']['id']['content'] }}</textarea>
                                </div>
                                <div class="col form-group">
                                    <label for="intruduction_en_content">Introduction Content Indonesia</label>
                                    <textarea id="intruduction_en_content" name="intruduction_en_content">{{ $arrConf['intruduction']['en']['content'] }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="intruduction_img">Introduction Img @if(isset($arrConf['intruduction']['img']) and $arrConf['intruduction']['img'] != null and $arrConf['intruduction']['img'] != '')<a href="{{ url($arrConf['intruduction']['img']) }}" target="_blank" rel="noopener noreferrer">show</a>@endif</label>
                                    <input type="file" class="form-control" id="intruduction_img" name="intruduction_img" accept="image/*">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="visi_id">Visis Indonesia</label>
                                    <input type="text" class="form-control" id="visi_id" name="visi_id" value="{{ $arrConf['visi']['id'] }}" required>
                                </div>
                                <div class="col form-group">
                                    <label for="visi_en">Visis English</label>
                                    <input type="text" class="form-control" id="visi_en" name="visi_en" value="{{ $arrConf['visi']['en'] }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div id="misi_id" class="card">
                                        <div class="card-header">
                                            <div class="card-title">
                                                Misi Indonesia <span onclick="addMisi('#misi_id .card-body','id')" class="btn btn-sm btn-block btn-outline-info">Add</span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @foreach($arrConf['misi']['id'] as $idx => $data)
                                            <div id="row_misi_id_{{ $idx }}" class="input-group input-group-sm mb-2">
                                                <input type="text" class="form-control misi_id" requred value="{{$data}}">
                                                <span class="input-group-append">
                                                    <span onclick="removeMisi('row_misi_id_{{ $idx }}')" class="btn btn-danger btn-flat">delete</span>
                                                </span>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div id="misi_en" class="card">
                                        <div class="card-header">
                                            <div class="card-title">
                                                Misi English  <span onclick="addMisi('#misi_en .card-body', 'en')" class="btn btn-sm btn-block btn-outline-info">Add</span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @foreach($arrConf['misi']['en'] as $idx => $data)
                                            <div id="row_misi_en_{{ $idx }}" class="input-group input-group-sm mb-2">
                                                <input type="text" class="form-control misi_en" requred value="{{$data}}">
                                                <span class="input-group-append">
                                                    <span onclick="removeMisi('row_misi_en_{{ $idx }}')" class="btn btn-danger btn-flat">delete</span>
                                                </span>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
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
<script src="{{ asset('vendors/summernote/summernote.min.js') }}"></script>
<script>
    $( document ).ready(function() {
        $('[name=intruduction_id_content]').summernote()
        $('[name=intruduction_en_content]').summernote()
    });

    addMisi = (append_to, type) => {
        let renderd = ''
        let temp_id = Math.floor(Math.random() * 10000)
        renderd += '<div id="row_misi_'+type+'_'+temp_id+'" class="input-group input-group-sm mb-2">'
        renderd += '<input type="text" class="form-control misi_'+type+'" requred value="">'
        renderd += '<span class="input-group-append">'
        renderd += '<span onclick="removeMisi(\'row_misi_'+type+'_'+temp_id+'\')" class="btn btn-danger btn-flat">delete</span>'
        renderd += '</span>'
        renderd += '</div>'
        $(append_to).append(renderd)
    }

    removeMisi = (target) => { $('#'+target).remove() }

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
        param.intruduction_id_title = $('[name=intruduction_id_title]').val()
        param.intruduction_en_title = $('[name=intruduction_en_title]').val()
        param.intruduction_id_content = $('[name=intruduction_id_content]').summernote('code')
        param.intruduction_en_content = $('[name=intruduction_en_content]').summernote('code')
        const resStore = await httpRequest('{{ route("cms.page-config.home.store") }}','post',param).then(function(result){ return result })
        return true
    }
    storeImg = async () => {
        let pictures = $('[name=intruduction_img]').prop('files')
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
                        'for':'intruduction'
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