@extends('cms.layout.base')

@section('title')
Investor
@endsection

@push('link')
<link rel="stylesheet" href="{{ asset('vendors/summernote/summernote.min.css') }}">
@endpush

@push('content')
<div class="container">
    
    <div class="row">
        <div class="col-12">
            <div id="formInvestor" style="display:none;">
                <form onsubmit="return submitFormInvestor()"  enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>Investor <b></b></h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="content_en">Content En</label>
                                    <textarea class="form-control" id="content_en" name="content_en"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="content_id">Content Id</label>
                                    <textarea class="form-control" id="content_id" name="content_id"></textarea>
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
                                    <button type="reset" onclick="closeFormInvestor()" class="btn btn-sm btn-block btn-outline-danger">Cancel</button>
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
<script src="{{ asset('vendors/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('asset/cms/table-index.js') }}"></script>
<script>
    let table_index_config = '{{ base64_encode(json_encode($table_config)) }}'
    let indentity_form = '#formInvestor'
    table_index_config = JSON.parse(atob(table_index_config))
    $( document ).ready(function() {
        refreshTable()
    });

    getConditionTableIndex = (identity) => {
        let condition = {}
        condition['name'] = $('#'+identity+' [name=search_name]').val()
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
                        render_row += '<td><button class="btn btn-info btn-sm" onclick="openInvstor('+row.id+')">Open</button></td>'
                    }else{
                        render_row += '<td>'+row[c_coll.field]+'</td>'
                    }
                })
                render_row += '</tr>'
                $('#'+identity+' table tbody').append(render_row)
            })
        }
    }

    publishInvestor = () => {
        const ids = getSelectedId()
        if (ids.length == 0) {
            showPNotify('Info','Not found data select','danger')
            return false
        }
        loadingScreen(true)
        excuteSelectedAction(ids,'{{ $http_req['store-flag-publish'] }}')
    }

    deleteInvestor = () => {
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

    closeFormInvestor = () => {
        $(indentity_form+' #content_en').summernote('destroy')
        $(indentity_form+' #content_id').summernote('destroy')
        $(indentity_form+' .card-title h3 b').html('')
        $(indentity_form+' input').val(null)
        $(indentity_form+' textarea').val(null)
        $(indentity_form+' #imgDisplay .col').html('').fadeOut()
        $(indentity_form).fadeOut()
    }

    addInvestor = (summer=true) => {
        closeFormInvestor()
        $(indentity_form).fadeIn()
        $(indentity_form+' input[name=name]').focus()
        if (summer == true) {
            $(indentity_form+' #content_en').summernote()
            $(indentity_form+' #content_id').summernote()
        }
    }

    submitFormInvestor = () => {
        loadingScreen(true)
        submitFormInvestorExe(indentity_form)
        return false
    }

    submitFormInvestorExe = async (identity) => {
        const InvestorStore = await storeInvestor(identity)
        if (InvestorStore.response == true) {
            let pictures = $(identity+' [name=img]').prop('files')
            await storeInvestorImg(pictures,InvestorStore.id)
            if (pictures.length == 0) {
                await openInvstor(InvestorStore.id)
                await refreshTable()
            }
        }
    }

    storeInvestor = async (identity) => {
        let param = {}
        param['name'] = $(identity+' [name=name]').val()
        param['content_en'] = $(identity+' [name=content_en]').summernote('code')
        param['content_id'] = $(identity+' [name=content_id]').summernote('code')
        param['id'] = $(identity+' [name=old_data]').val()
        let result_data = await httpRequest('{{ $http_req['store'] }}','post',param).then(function(result){ return result })
        showPNotify('Info',result_data.msg,result_data.notif_type)
        return result_data
    }

    storeInvestorImg = async (pictures, ni_id) => {
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
                    openInvstor(img.set_id)
                    refreshTable()
                })
            };
        })
    }

    openInvstor = async (id) => {
        loadingScreen(true)
        addInvestor(false)
        let result = await httpRequest('{{ $http_req['open'] }}','post',{id}).then(function(result){ return result.data })
        $(indentity_form+' [name=old_data]').val(result.id)
        $(indentity_form+' [name=name]').val(result.name)
        $(indentity_form+' [name=quotes_id]').val(result.quotes_id)
        if (result.content_en != '' && result.content_en != null) {
            $(indentity_form+' [name=content_en]').summernote('code', result.content_en)
        }else{
            $(indentity_form+' [name=content_en]').summernote()
        }
        if (result.content_id != '' && result.content_id != null) {
            $(indentity_form+' [name=content_id]').summernote('code', result.content_id)
        }else{
            $(indentity_form+' [name=content_id]').summernote()
        }

        if (result.img != '' && result.img != null) {
            $(indentity_form+' #imgDisplay .col').html('<img src="../'+result.img+'" class="img-fluid pad">').fadeIn()
        }
        loadingScreen(false)
    }
</script>
@include('cms.component.validate-max-file')
@endpush