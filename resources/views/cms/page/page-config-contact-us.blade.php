@extends('cms.layout.base')

@section('title')
Contact Us Page Config
@endsection

@push('link')
@endpush

@push('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div id="PublicConfig">
                <form onsubmit="return submitPageConfig()"  enctype="multipart/form-data" class="mb-3">
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
                                    <input type="text" class="form-control" id="title_id" name="title_id" value="{{ $arrConf['location']['title']['id'] }}" required>
                                </div>
                                <div class="col form-group">
                                    <label for="title_en">Titles English</label>
                                    <input type="text" class="form-control" id="title_en" name="title_en" value="{{ $arrConf['location']['title']['en'] }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="description_id">Descriptions Indonesia</label>
                                    <input type="text" class="form-control" id="description_id" name="description_id" value="{{ $arrConf['location']['content']['id'] }}">
                                </div>
                                <div class="col form-group">
                                    <label for="description_en">Descriptions English</label>
                                    <input type="text" class="form-control" id="description_en" name="description_en" value="{{ $arrConf['location']['content']['en'] }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="link">Maps Links</label>
                                    <input type="url" class="form-control" id="link" name="link" value="{{ $arrConf['location']['link'] }}">
                                </div>
                                <div class="col form-group">
                                    <label for="embed">Maps Embed Url</label>
                                    <input type="url" class="form-control" id="embed" name="embed" value="{{ $arrConf['location']['embed'] }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="message">Background Img @if(isset($arrConf['message']['img']) and $arrConf['message']['img'] != null and $arrConf['message']['img'] != '')<a href="{{ url($arrConf['message']['img']) }}" target="_blank" rel="noopener noreferrer">show</a>@endif</label>
                                    <input type="file" class="form-control" id="message" name="message" accept="image/*">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="title_lelang_id">Titles Lelang Indonesia</label>
                                    <input type="text" class="form-control" id="title_lelang_id" name="title_lelang_id" value="{{ $arrConf['lelang_config']['title']['id'] }}" required>
                                </div>
                                <div class="col form-group">
                                    <label for="title_lelang_en">Titles Lelang English</label>
                                    <input type="text" class="form-control" id="title_lelang_en" name="title_lelang_en" value="{{ $arrConf['lelang_config']['title']['en'] }}" required>
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

                <div class="card">
                    <div class="card-header">
                        Jadwal Lelang <span onclick="formAddLelang()" class="btn btn-sm btn-outline-info">Add</span>
                    </div>
                    <div class="card-body p-0">
                        
                        <form id="formLelang" onsubmit="return submitLelang()" style="display:none;">
                            <div class="card">
                                <div class="card-header">
                                    Form Jadwal Lelang
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="lokasi">Lokasi</label>
                                            <textarea class="form-control" id="lokasi" name="lokasi" required></textarea>
                                        </div>
                                        <div class="col form-group">
                                            <label for="tanggal">Hari/Tanggal</label>
                                            <input type="text" class="form-control" id="tanggal" name="tanggal" required>
                                        </div>
                                        <div class="col form-group">
                                            <label for="jam">Jam</label>
                                            <input type="text" class="form-control" id="jam" name="jam" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <input type="hidden" name="id">
                                        <div class="col"><button type="reset" onclick="closeLelang()" class="btn btn-sm btn-block btn-outline-danger">Close</button></div>
                                        <div class="col"><button type="submit" class="btn btn-sm btn-block btn-outline-success">Submit</button></div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="lelang-wrapper">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Lokasi</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($arrConf['lelang'] as $idx => $data)
                                    <tr>
                                        <td>
                                            <button onclick="removeLelang('{{$idx}}')" class="btn btn-sm btn-outline-danger">Delete</button>
                                            <button onclick="openLelang('{{$idx}}','{{base64_encode(json_encode($data))}}')" class="btn btn-sm btn-outline-info">Update</button>
                                        </td>
                                        <td>{{ $data['lokasi'] }}</td>
                                        <td>{{ $data['tanggal'] }}</td>
                                        <td>{{ $data['jam'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endpush

@push('script')
<script>
    closeLelang = () => {
        $('form#formLelang [name=id]').val(null)
        $('form#formLelang').fadeOut()
    }

    formAddLelang = () => {
        $('form#formLelang button[type=reset]').click()
        $('form#formLelang').fadeIn()
    }

    openLelang = (idx,data) => {
        formAddLelang()
        data = JSON.parse(atob(data))
        $('form#formLelang [name=id]').val(idx)
        $('form#formLelang [name=lokasi]').val(data.lokasi)
        $('form#formLelang [name=tanggal]').val(data.tanggal)
        $('form#formLelang [name=jam]').val(data.jam)
    }

    removeLelang = async (idx) => {
        loadingScreen(true)
        closeLelang()
        let param = {}
        param.type = 'remove_lelang'
        param.idx = idx
        await httpRequest('{{ route("cms.page-config.contact-us.store") }}','post',param).then(function(result){
            loadingScreen(false)
            location.reload()
        })
    }

    submitLelang = async () => {
        loadingScreen(true)
        let param = {}
        param.type = 'lelang'
        param.lokasi = $('form#formLelang [name=lokasi]').val()
        param.tanggal = $('form#formLelang [name=tanggal]').val()
        param.jam = $('form#formLelang [name=jam]').val()
        param.id = $('form#formLelang [name=id]').val()

        await httpRequest('{{ route("cms.page-config.contact-us.store") }}','post',param).then(function(result){ 
            loadingScreen(false)
            location.reload()
        })
        return false
    }

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
        param.title_lelang_id = $('[name=title_lelang_id]').val()
        param.title_lelang_en = $('[name=title_lelang_en]').val()
        param.description_id = $('[name=description_id]').val()
        param.description_en = $('[name=description_en]').val()
        param.link = $('[name=link]').val()
        param.embed = $('[name=embed]').val()
        const resStore = await httpRequest('{{ route("cms.page-config.contact-us.store") }}','post',param).then(function(result){ return result })
        return true
    }
    storeImg = async () => {
        let pictures = $('[name=message]').prop('files')
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
                        'for':'message'
                    }
                    httpRequest('{{ route("cms.page-config.contact-us.store") }}','post',param).then(function(result){ 
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