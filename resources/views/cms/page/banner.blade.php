@extends('cms.layout.base')

@section('title')
Banner
@endsection

@push('link')
@endpush

@push('content')
<div class="container">
    
    <div class="row">
        <div class="col-12">
            <div id="formBanner" style="display:none;">
                <form onsubmit="return submitFormBanner()"  enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>Banner Founder <b></b></h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col form-group">
                                    <label for="text">Big Text</label>
                                    <input type="text" class="form-control" id="text" name="text" placeholder="Big Text" maxlength="50">
                                </div>
                                <div class="col form-group">
                                    <label for="queues">Queues</label>
                                    <input type="number" class="form-control" id="queues" name="queues" min="1" max="99" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" maxlength="50">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" maxlength="125">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="link">Link</label>
                                    <input type="text" class="form-control" id="link" name="link" max="250">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="img">Image</label>
                                    <input type="file" class="form-control" id="img" name="img" accept="image/*">
                                </div>
                            </div>
                            <div id="imgDisplay" class="row">
                                <div class="col" style="display:none"></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <button type="reset" onclick="closeFormBanner()" class="btn btn-sm btn-block btn-outline-danger">Cancel</button>
                                </div>
                                <div class="col">
                                    <input type="hidden" name="old_data">
                                    <button type="submit" class="btn btn-sm btn-block btn-outline-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12">
            @include('cms.component.table-index-template', ['table_config' => $table_config])
        </div>
    </div>
</div>
@endpush

@push('script')
<script src="{{ asset('asset/cms/table-index.js') }}"></script>
<script>
    let table_index_config = '{{ base64_encode(json_encode($table_config)) }}'
    let indentity_form_Banner = '#formBanner'
    table_index_config = JSON.parse(atob(table_index_config))
    $( document ).ready(function() {
        refreshTable()
    });

    getConditionTableIndex = (identity) => {
        let condition = {}
        condition['text'] = $('#'+identity+' [name=search_text]').val()
        condition['queues'] = $('#'+identity+' [name=search_queues]').val()
        condition['title'] = $('#'+identity+' [name=search_title]').val()
        condition['link'] = $('#'+identity+' [name=search_link]').val()
        condition['created_by'] = $('#'+identity+' [name=search_created_by]').val()
        condition['flag_publish'] = $('#'+identity+' [name=search_flag_publish]').val()
        return condition
    }

    renderedTableIndex = (identity,data) => {
        let t_config = table_index_config
        $('#'+identity+' table tbody').html('')
        if (data.length == 0) {
            $('#'+identity+' table tbody').html('<tr><td class="text-center" colspan="'+t_config.data_field_count+'">-- No Data Found --</td></tr>')
        }else{
            $.each(data, function(idx,row){
                let render_row = '<tr id="row_data_'+row.id+'" ondblclick="selectedRowData(\'row_data_'+row.id+'\')">'
                $.each(t_config.data_set, function(c_idx,c_coll){
                    if (c_coll.field == 'tools') {
                        render_row += '<td><button class="btn btn-info btn-sm" onclick="openBanner('+row.id+')">Open</button></td>'
                    }else{
                        render_row += '<td>'+row[c_coll.field]+'</td>'
                    }
                })
                render_row += '</tr>'
                $('#'+identity+' table tbody').append(render_row)
            })
        }
    }

    publishBanner = () => {
        const ids = getSelectedId()
        if (ids.length == 0) {
            showPNotify('Info','Not found data select','danger')
            return false
        }
        loadingScreen(true)
        excuteSelectedAction(ids,'{{ $http_req['store-flag-publish'] }}')
    }

    deleteBanner = () => {
        const ids = getSelectedId()
        if (ids.length == 0) {
            showPNotify('Info','Not found data select','danger')
            return false
        }
        loadingScreen(true)
        excuteSelectedAction(ids,'{{ $http_req['delete'] }}')
    }

    excuteSelectedAction = async (ids,urlPost) => {
        const param = {ids}
        const result_data = await httpRequest(urlPost,'post',param).then(function(result){ return result })
        showPNotify('Info','Success','info')
        refreshTable()
        loadingScreen(false)
    }

    closeFormBanner = () => {
        $(indentity_form_Banner+' .card-title h3 b').html('')
        $(indentity_form_Banner+' input').val(null)
        $(indentity_form_Banner+' #imgDisplay .col').html('').fadeOut()
        $(indentity_form_Banner).fadeOut()
    }

    addBanner = (summer=true) => {
        closeFormBanner()
        $(indentity_form_Banner).fadeIn()
        $(indentity_form_Banner+' input[name=text]').focus()
    }

    submitFormBanner = () => {
        loadingScreen(true)
        submitFormBannerExe(indentity_form_Banner)
        return false
    }

    submitFormBannerExe = async (identity) => {
        const BannerStore = await storeBanner(identity)
        if (BannerStore.response == true) {
            let pictures = $(identity+' [name=img]').prop('files')
            await storeBannerImg(pictures,BannerStore.id)
            if (pictures.length == 0) {
                await openBanner(BannerStore.id)
                await refreshTable()
            }
        }
    }

    storeBanner = async (identity) => {
        let param = {}
        param['text'] = $(identity+' [name=text]').val()
        param['title'] = $(identity+' [name=title]').val()
        param['description'] = $(identity+' [name=description]').val()
        param['link'] = $(identity+' [name=link]').val()
        param['queues'] = $(identity+' [name=queues]').val()
        param['id'] = $(identity+' [name=old_data]').val()
        let result_data = await httpRequest('{{ $http_req['store'] }}','post',param).then(function(result){ return result })
        showPNotify('Info',result_data.msg,result_data.notif_type)
        return result_data
    }

    storeBannerImg = async (pictures, ni_id) => {
        $.each(pictures, async function(idx,img){
            img['set_id'] = ni_id
            var reader = new FileReader();
            reader.readAsArrayBuffer(img);
            reader.onloadend = async function(oFREvent) {
                var byteArray = new Uint8Array(oFREvent.target.result)
                var len = byteArray.byteLength
                var binary = ''
                for (var i = 0; i < len; i++) { binary += String.fromCharCode(byteArray[i]) }
                byteArray = window.btoa(binary)
                let param =  {
                    'name':img.name,
                    'set_id':img.set_id,
                    'type':img.type,
                    'encode':byteArray
                }
                httpRequest('{{ $http_req['store-img'] }}','post',param).then(function(result){ 
                    console.log(result)
                    openBanner(img.set_id)
                    refreshTable()
                })
            };
        })
    }

    openBanner = async (id) => {
        loadingScreen(true)
        addBanner(false)
        let result = await httpRequest('{{ $http_req['open'] }}','post',{id}).then(function(result){ return result.data })
        $(indentity_form_Banner+' [name=old_data]').val(result.id)
        $(indentity_form_Banner+' [name=text]').val(result.text)
        $(indentity_form_Banner+' [name=queues]').val(result.queues)
        $(indentity_form_Banner+' [name=title]').val(result.title)
        $(indentity_form_Banner+' [name=description]').val(result.description)
        $(indentity_form_Banner+' [name=link]').val(result.link)
        if (result.img != '' && result.img != null) {
            $(indentity_form_Banner+' #imgDisplay .col').html('<img src="../'+result.img+'" class="img-fluid pad">').fadeIn()
        }
        loadingScreen(false)
    }
</script>
@endpush