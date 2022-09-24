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
                                    <label for="quotes_line_id_1">Quotes Indonesia Line 1</label>
                                    <input type="text" class="form-control" id="quotes_line_id_1" name="quotes_line_id_1" value="{{ $arrConf['quotes']['line']['id'][1] }}" required>
                                </div>
                                <div class="col form-group">
                                    <label for="quotes_line_id_2">Quotes Indonesia Line 2</label>
                                    <input type="text" class="form-control" id="quotes_line_id_2" name="quotes_line_id_2" value="{{ $arrConf['quotes']['line']['id'][2] }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="quotes_line_en_1">Quotes English Line 1</label>
                                    <input type="text" class="form-control" id="quotes_line_en_1" name="quotes_line_en_1" value="{{ $arrConf['quotes']['line']['en'][1] }}" required>
                                </div>
                                <div class="col form-group">
                                    <label for="quotes_line_en_2">Quotes English Line 2</label>
                                    <input type="text" class="form-control" id="quotes_line_en_2" name="quotes_line_en_2" value="{{ $arrConf['quotes']['line']['en'][2] }}" required>
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
                            Quotes Img
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-center">
                                <h5>Quotes Img 1</h5>
                                @if($arrConf['quotes']['imgs_1'] != null and $arrConf['quotes']['imgs_1'] != '')
                                <a href="{{ url($arrConf['quotes']['imgs_1']) }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ url($arrConf['quotes']['imgs_1']) }}" alt="" style="height:125px;margin:auto;">
                                </a>
                                @endif
                                <label for="quotes_imgs_1" class="btn btn-sm btn-block btn-outline-info">Upload</label>
                                <input onchange="uploadQuotesImg(1)" type="file" class="form-control" id="quotes_imgs_1" name="quotes_imgs_1" accept="image/*" style="display:none;">
                            </div>
                            <div class="col text-center">
                                <h5>Quotes Img 2</h5>
                                @if($arrConf['quotes']['imgs_2'] != null and $arrConf['quotes']['imgs_2'] != '')
                                <a href="{{ url($arrConf['quotes']['imgs_2']) }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ url($arrConf['quotes']['imgs_2']) }}" alt="" style="height:125px;margin:auto;">
                                </a>
                                @endif
                                <label for="quotes_imgs_2" class="btn btn-sm btn-block btn-outline-info">Upload</label>
                                <input onchange="uploadQuotesImg(2)" type="file" class="form-control" id="quotes_imgs_2" name="quotes_imgs_2" accept="image/*" style="display:none;">
                            </div>
                            <div class="col text-center">
                                <h5>Quotes Img 3</h5>
                                @if($arrConf['quotes']['imgs_3'] != null and $arrConf['quotes']['imgs_3'] != '')
                                <a href="{{ url($arrConf['quotes']['imgs_3']) }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ url($arrConf['quotes']['imgs_3']) }}" alt="" style="height:125px;margin:auto;">
                                </a>
                                @endif
                                <label for="quotes_imgs_3" class="btn btn-sm btn-block btn-outline-info">Upload</label>
                                <input onchange="uploadQuotesImg(3)" type="file" class="form-control" id="quotes_imgs_3" name="quotes_imgs_3" accept="image/*" style="display:none;">
                            </div>
                            <div class="col text-center">
                                <h5>Quotes Img 4</h5>
                                @if($arrConf['quotes']['imgs_4'] != null and $arrConf['quotes']['imgs_4'] != '')
                                <a href="{{ url($arrConf['quotes']['imgs_4']) }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ url($arrConf['quotes']['imgs_4']) }}" alt="" style="height:125px;margin:auto;">
                                </a>
                                @endif
                                <label for="quotes_imgs_4" class="btn btn-sm btn-block btn-outline-info">Upload</label>
                                <input onchange="uploadQuotesImg(4)" type="file" class="form-control" id="quotes_imgs_4" name="quotes_imgs_4" accept="image/*" style="display:none;">
                            </div>
                        </div>
                    </div>
                </div>

                <div id="ourClientWrapp" class="card">
                    <div class="card-header">
                        Our Client <span onclick="formAddClient()" class="btn btn-sm btn-outline-info">Add</span>
                    </div>
                    <div class="card-body p-0">
                        
                        <form id="formClient" onsubmit="return submitClient()" style="display:none;">
                            <div class="card">
                                <div class="card-header">
                                    Form Our Client
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="urutan">Queue</label>
                                            <input type="number" class="form-control" id="urutan" name="urutan" required min="1" max="100">
                                        </div>
                                        <div class="col form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="img">Img</label>
                                            <input type="file" class="form-control" id="img" name="img" accept="image/*" required>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="background">Background</label>
                                            <input type="file" class="form-control" id="background" name="background" accept="image/*" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <input type="hidden" name="id">
                                        <div class="col"><button type="reset" onclick="closeClient()" class="btn btn-sm btn-block btn-outline-danger">Close</button></div>
                                        <div class="col"><button type="submit" class="btn btn-sm btn-block btn-outline-success">Submit</button></div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="Client-wrapper">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Queue</th>
                                        <th>Name</th>
                                        <th>Img & Background</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($arrConf['our_client'] as $idx => $data)
                                    <tr>
                                        <td>
                                            <button onclick="removeClient('{{$idx}}')" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </td>
                                        <td>{{ $data['urutan'] }}</td>
                                        <td>{{ $data['name'] }}</td>
                                        <td>
                                            <a href="{{ url($data['img']) }}" target="_blank" rel="noopener noreferrer">img</a>
                                            &nbsp;
                                            <a href="{{ url($data['background']) }}" target="_blank" rel="noopener noreferrer">background</a>
                                        </td>
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
    closeClient = () => {
        $('form#formClient [name=id]').val(null)
        $('form#formClient').fadeOut()
    }

    formAddClient = () => {
        $('form#formClient button[type=reset]').click()
        $('form#formClient').fadeIn()
    }

    openClient = (idx,data) => {
        formAddClient()
        data = JSON.parse(atob(data))
        $('form#formClient [name=id]').val(idx)
        $('form#formClient [name=lokasi]').val(data.lokasi)
        $('form#formClient [name=tanggal]').val(data.tanggal)
        $('form#formClient [name=jam]').val(data.jam)
    }

    removeClient = async (idx) => {
        loadingScreen(true)
        closeClient()
        let param = {}
        param.type = 'remove_ourclient'
        param.idx = idx
        await httpRequest('{{ route("cms.page-config.home.store") }}','post',param).then(function(result){
            loadingScreen(false)
            location.reload()
        })
    }

    submitClient = () => {
        loadingScreen(true)
        let param = {}
        param.type = 'store_ourclient'
        param.urutan = $('form#formClient [name=urutan]').val()
        param.name = $('form#formClient [name=name]').val()
        param.id = $('form#formClient [name=id]').val()

        httpRequest('{{ route("cms.page-config.home.store") }}','post',param).then(function(result){ 
            submitClientStoreImg(result.idx)
            return false
        })
        return false
    }

    submitClientStoreImg = (arr_id) => {
        let pictures = $('form#formClient [name=img]').prop('files')
        let count_img = pictures.length
        if (count_img == 0) { 
            submitClientStoreBackground(arr_id)
        } else if (count_img > 0) {
            loadingScreen(true)
            $.each(pictures, async function(idx,img){
                img.arr_id = arr_id
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
                        'idx': img.arr_id,
                        'type':'store_ourclient_img',
                        'key':'img',
                        'for':'our_client'
                    }
                    httpRequest('{{ route("cms.page-config.home.store") }}','post',param).then(function(result){ 
                        submitClientStoreBackground(param.idx)
                    })
                };
            })
        }
        return false
    }

    submitClientStoreBackground = (arr_id) => {
        let pictures = $('form#formClient [name=background]').prop('files')
        let count_img = pictures.length
        if (count_img == 0) { 
            loadingScreen(false)
            location.reload()
        } else if (count_img > 0) {
            loadingScreen(true)
            $.each(pictures, async function(idx,img){
                img.arr_id = arr_id
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
                        'idx': img.arr_id,
                        'type':'store_ourclient_img',
                        'key':'background',
                        'for':'our_client'
                    }
                    httpRequest('{{ route("cms.page-config.home.store") }}','post',param).then(function(result){ 
                        loadingScreen(false)
                        location.reload()
                    })
                };
            })
        }
        return false
    }
</script>
<script>
    uploadQuotesImg = (queue) => {
        let pictures = $('[name=quotes_imgs_'+queue+']').prop('files')
        let count_img = pictures.length
        if (count_img == 0) { return false }
        loadingScreen(true)
        $.each(pictures, async function(idx,img){
            img.queue = queue
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
                    'key':'imgs_'+img.queue,
                    'for':'quotes'
                }
                httpRequest('{{ route("cms.page-config.home.store") }}','post',param).then(function(result){ 
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
    }
    submitPageConfigExeSend = async () =>{
        let param = {}
        param.type = 'string'
        param.banner_max_item = $('[name=banner_max_item]').val()
        param.news_info_max_item = $('[name=news_info_max_item]').val()
        param.quotes_line_id_1 = $('[name=quotes_line_id_1]').val()
        param.quotes_line_id_2 = $('[name=quotes_line_id_2]').val()
        param.quotes_line_en_1 = $('[name=quotes_line_en_1]').val()
        param.quotes_line_en_2 = $('[name=quotes_line_en_2]').val()
        const resStore = await httpRequest('{{ route("cms.page-config.home.store") }}','post',param).then(function(result){ return result })
        loadingScreen(false)
        location.reload()
    }
</script>
@endpush