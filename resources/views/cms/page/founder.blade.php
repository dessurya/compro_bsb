@extends('cms.layout.base')

@section('title')
Founder
@endsection

@push('link')
@endpush

@push('content')
<div class="container">
    
    <div class="row">
        <div class="col-12">
            <div id="formFounder" style="display:none;">
                <form onsubmit="return submitFormFounder()"  enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>Form Founder <b></b></h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                </div>
                                <div class="col form-group">
                                    <label for="position">Position</label>
                                    <input type="number" class="form-control" id="position" name="position" min="1" max="99" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="job_title_en">Job Title En</label>
                                    <input type="text" class="form-control" id="job_title_en" name="job_title_en" required>
                                </div>
                                <div class="col form-group">
                                    <label for="job_title_id">Job Title Id</label>
                                    <input type="text" class="form-control" id="job_title_id" name="job_title_id" required>
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
                                    <button type="reset" onclick="closeFormFounder()" class="btn btn-sm btn-block btn-outline-danger">Cancel</button>
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
    let indentity_form_information = '#formFounder'
    table_index_config = JSON.parse(atob(table_index_config))
    $( document ).ready(function() {
        refreshTable()
    });

    getConditionTableIndex = (identity) => {
        let condition = {}
        condition['name'] = $('#'+identity+' [name=search_name]').val()
        condition['job_title_en'] = $('#'+identity+' [name=search_job_title_en]').val()
        condition['job_title_id'] = $('#'+identity+' [name=search_job_title_id]').val()
        condition['position'] = $('#'+identity+' [name=search_position]').val()
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
                        render_row += '<td><button class="btn btn-info btn-sm" onclick="openFounder('+row.id+')">Open</button></td>'
                    }else{
                        render_row += '<td>'+row[c_coll.field]+'</td>'
                    }
                })
                render_row += '</tr>'
                $('#'+identity+' table tbody').append(render_row)
            })
        }
    }

    publishFounder = () => {
        const ids = getSelectedId()
        if (ids.length == 0) {
            showPNotify('Info','Not found data select','danger')
            return false
        }
        loadingScreen(true)
        excuteSelectedAction(ids,'{{ $http_req['store-flag-publish'] }}')
    }

    deleteFounder = () => {
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

    closeFormFounder = () => {
        $(indentity_form_information+' .card-title h3 b').html('')
        $(indentity_form_information+' input').val(null)
        $(indentity_form_information+' #imgDisplay .col').html('').fadeOut()
        $(indentity_form_information).fadeOut()
    }

    addFounder = () => {
        closeFormFounder()
        $(indentity_form_information).fadeIn()
        $(indentity_form_information+' input[name=name]').focus()
    }

    submitFormFounder = () => {
        loadingScreen(true)
        submitFormFounderExe(indentity_form_information)
        return false
    }

    submitFormFounderExe = async (identity) => {
        const FounderStore = await storeFounder(identity)
        if (FounderStore.response == true) {
            let pictures = $(identity+' [name=img]').prop('files')
            await storeFounderImg(pictures,FounderStore.id)
            if (pictures.length == 0) {
                await openFounder(FounderStore.id)
                await refreshTable()
            }
        }
        loadingScreen(false)
    }

    storeFounder = async (identity) => {
        let param = {}
        param['name'] = $(identity+' [name=name]').val()
        param['job_title_en'] = $(identity+' [name=job_title_en]').val()
        param['job_title_id'] = $(identity+' [name=job_title_id]').val()
        param['position'] = $(identity+' [name=position]').val()
        param['id'] = $(identity+' [name=old_data]').val()
        let result_data = await httpRequest('{{ $http_req['store'] }}','post',param).then(function(result){ return result })
        showPNotify('Info',result_data.msg,result_data.notif_type)
        return result_data
    }

    storeFounderImg = async (pictures, ni_id) => {
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
                    openFounder(img.set_id)
                    refreshTable()
                })
            };
        })
    }

    openFounder = async (id) => {
        loadingScreen(true)
        addFounder()
        let result = await httpRequest('{{ $http_req['open'] }}','post',{id}).then(function(result){ return result.data })
        $(indentity_form_information+' [name=old_data]').val(result.id)
        $(indentity_form_information+' [name=name]').val(result.name)
        $(indentity_form_information+' [name=position]').val(result.position)
        $(indentity_form_information+' [name=job_title_en]').val(result.job_title_en)
        $(indentity_form_information+' [name=job_title_id]').val(result.job_title_id)
        if (result.img != '' && result.img != null) {
            $(indentity_form_information+' #imgDisplay .col').html('<img src="../'+result.img+'" class="img-fluid pad">').fadeIn()
        }
        loadingScreen(false)
    }
</script>
@endpush