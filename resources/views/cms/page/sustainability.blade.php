@extends('cms.layout.base')

@section('title')
Sustainability
@endsection

@push('link')
@endpush

@push('content')
<div class="container">
    
    <div class="row">
        <div class="col-12">
            <div id="formSustainability" style="display:none;">
                <form onsubmit="return submitFormSustainability()"  enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>Form Sustainability <b></b></h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                                </div>
                                <div class="col form-group">
                                    <label for="language">Language</label>
                                    <select type="text" class="form-control" id="language" name="language">
                                        <option value="en">English</option>
                                        <option value="id">Indonesia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="position">Position</label>
                                    <input type="number" class="form-control" id="position" name="position" min="1" max="99" required>
                                </div>
                                <div class="col form-group">
                                    <label for="content_shoert">Content</label>
                                    <input type="text" class="form-control" id="content_shoert" name="content_shoert" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="imgThumnail">Image</label>
                                    <input type="file" class="form-control" id="imgThumnail" name="imgThumnail" accept="image/*">
                                </div>
                            </div>
                            <div id="imgThumnailDisplay" class="row">
                                <div class="col" style="display:none"></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <button type="reset" onclick="closeFormSustainability()" class="btn btn-sm btn-block btn-outline-danger">Cancel</button>
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
    let indentity_form_information = '#formSustainability'
    table_index_config = JSON.parse(atob(table_index_config))
    $( document ).ready(function() {
        refreshTable()
    });

    getConditionTableIndex = (identity) => {
        let condition = {}
        condition['title'] = $('#'+identity+' [name=search_title]').val()
        condition['content_shoert'] = $('#'+identity+' [name=search_content_shoert]').val()
        condition['position'] = $('#'+identity+' [name=search_position]').val()
        condition['language'] = $('#'+identity+' [name=search_language]').val()
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
                        render_row += '<td><button class="btn btn-info btn-sm" onclick="openSustainability('+row.id+')">Open</button></td>'
                    }else{
                        render_row += '<td>'+row[c_coll.field]+'</td>'
                    }
                })
                render_row += '</tr>'
                $('#'+identity+' table tbody').append(render_row)
            })
        }
    }

    publishSustainability = () => {
        const ids = getSelectedId()
        if (ids.length == 0) {
            showPNotify('Info','Not found data select','danger')
            return false
        }
        loadingScreen(true)
        excuteSelectedAction(ids,'{{ $http_req['store-flag-publish'] }}')
    }

    deleteSustainability = () => {
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

    closeFormSustainability = () => {
        $(indentity_form_information+' .card-title h3 b').html('')
        $(indentity_form_information+' input').val(null)
        $(indentity_form_information+' #imgThumnailDisplay .col').html('').fadeOut()
        $(indentity_form_information).fadeOut()
    }

    addSustainability = () => {
        closeFormSustainability()
        $(indentity_form_information).fadeIn()
        $(indentity_form_information+' input[name=title]').focus()
    }

    submitFormSustainability = () => {
        loadingScreen(true)
        submitFormSustainabilityExe(indentity_form_information)
        return false
    }

    submitFormSustainabilityExe = async (identity) => {
        const SustainabilityStore = await storeSustainability(identity)
        if (SustainabilityStore.response == true) {
            let pictures = $(identity+' [name=imgThumnail]').prop('files')
            await storeSustainabilityImg(pictures,SustainabilityStore.id)
            if (pictures.length == 0) {
                await openSustainability(SustainabilityStore.id)
                await refreshTable()
            }
        }
        loadingScreen(false)
    }

    storeSustainability = async (identity) => {
        let param = {}
        param['title'] = $(identity+' [name=title]').val()
        param['language'] = $(identity+' [name=language]').val()
        param['position'] = $(identity+' [name=position]').val()
        param['content_shoert'] = $(identity+' [name=content_shoert]').val()
        param['id'] = $(identity+' [name=old_data]').val()
        let result_data = await httpRequest('{{ $http_req['store'] }}','post',param).then(function(result){ return result })
        showPNotify('Info',result_data.msg,result_data.notif_type)
        return result_data
    }

    storeSustainabilityImg = async (pictures, ni_id) => {
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
                    'encode':byteArray,
                    'name':img.name,
                    'type':img.type,
                    'set_id':img.set_id
                }
                httpRequest('{{ $http_req['store-img'] }}','post',param).then(function(result){ 
                    console.log(result)
                    openSustainability(img.set_id)
                    refreshTable()
                })
            };
        })
    }

    openSustainability = async (id) => {
        loadingScreen(true)
        addSustainability()
        let result = await httpRequest('{{ $http_req['open'] }}','post',{id}).then(function(result){ return result.data })
        $(indentity_form_information+' [name=old_data]').val(result.id)
        $(indentity_form_information+' [name=title]').val(result.title)
        $(indentity_form_information+' [name=language]').val(result.language)
        $(indentity_form_information+' [name=position]').val(result.position)
        $(indentity_form_information+' [name=content_shoert]').val(result.content_shoert)
        if (result.img_thumnail != '' && result.img_thumnail != null) {
            $(indentity_form_information+' #imgThumnailDisplay .col').html('<img src="../'+result.img_thumnail+'" class="img-fluid pad">').fadeIn()
        }
        loadingScreen(false)
    }
</script>
@endpush