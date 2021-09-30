@extends('cms.layout.base')

@section('title')
User Management
@endsection

@push('content')
<div class="container">
    
    <div class="row">
        <div class="col-12">
            <div id="formUser" style="display:none;">
                <form onsubmit="return submitFormUser()"  enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>Form User <b></b></h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                                </div>
                                <div class="col form-group">
                                    <label for="form_name">Name</label>
                                    <input type="text" class="form-control" id="form_name" name="form_name" placeholder="Your Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <button type="reset" onclick="closeFormUser()" class="btn btn-sm btn-block btn-outline-danger">Cancel</button>
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
    table_index_config = JSON.parse(atob(table_index_config))
    $( document ).ready(function() {
        rebuildTableIndex(table_index_config.table_url,table_index_config.table_id,1)
    });

    getConditionTableIndex = (identity) => {
        let condition = {}
        condition['name'] = $('#'+identity+' [name=search_name]').val()
        condition['email'] = $('#'+identity+' [name=search_email]').val()
        condition['flag_active'] = $('#'+identity+' [name=search_flag_active]').val()
        return condition
    }

    renderedTableIndex = (identity,data) => {
        let t_config = table_index_config
        $('#'+identity+' table tbody').html('')
        if (data.length == 0) {
            $('#'+identity+' table tbody').html('<tr><td class="text-center" colspan="'+t_config.data_field_count+'"></td></tr>')
        }else{
            $.each(data, function(idx,row){
                let encode_id = row.id
                let render_row = '<tr id="'+encode_id+'" ondblclick="toogleClass(\'selected\', \'#'+identity+' table tbody tr#'+encode_id+'\')">'
                $.each(t_config.data_set, function(c_idx,c_coll){
                    if (c_coll.field == 'tools') {
                        let encode_data = btoa(JSON.stringify(row))
                        render_row += '<td><button class="btn btn-info btn-sm" onclick="modifyData(\''+encode_data+'\')">Modify</button></td>'
                    }else{
                        render_row += '<td>'+row[c_coll.field]+'</td>'
                    }
                })
                render_row += '</tr>'
                $('#'+identity+' table tbody').append(render_row)
            })
        }
    }

    closeFormUser = () => {
        $('#formUser .card-title h3 b').html('')
        $('#formUser input').val(null)
        $('#formUser').fadeOut()
    }

    addUser = () => {
        closeFormUser()
        $('#formUser').fadeIn()
        $('#formUser input[name=email]').focus()
    }

    modifyData = (encode_data) => {
        let decode_data = JSON.parse(atob(encode_data))
        addUser()
        $('#formUser h3 b').html('Update '+decode_data.email)
        $('#formUser input[name=email]').val(decode_data.email)
        $('#formUser input[name=form_name]').val(decode_data.name)
        $('#formUser input[name=old_data]').val(encode_data)
    }

    submitFormUser = () => {
        loadingScreen(true)
        let confirm_act = confirm('Confirmation Needed! Are you sure submit this data?')
        if (confirm_act == false) {
            loadingScreen(false)
            return false
        }
        let old_data_id = null
        let old_data = $('#formUser input[name=old_data]').val()
        if (old_data != null && old_data != undefined && old_data != '' ) {
            old_data = JSON.parse(atob(old_data))
            old_data_id = old_data.id
        }
        let input = {}
        input['email'] = $('#formUser input[name=email]').val()
        input['name'] = $('#formUser input[name=form_name]').val()
        input['id'] = old_data_id
        let target = '{{ $http_req["submit-user"] }}'
        submitFormUserExecute({input,target})
        return false
    }
    
    submitFormUserExecute = async (param) => {
        let result_data = await httpRequest(param.target,'post',param.input).then(function(result){ return result })
        console.log(result_data)
        showPNotify('Info',result_data.msg,result_data.notif_type)
        if (result_data.response == true) {
            closeFormUser()
            let t_config = table_index_config
            rebuildTableIndex(t_config.table_url,t_config.table_id,1)
        }
        else{ $.each(result_data.invalid, function(key,err_data){ showPNotify('Invalid '+key,err_data[0],'error') }) }
        loadingScreen(false)
    }

    getSelectedRow = () => {
        let target = '#list_user table tbody tr.selected'
        let ids = []
        $(target).each(function() { ids.push($(this).attr('id')) })
        if (ids.length == 0) {
            showPNotify('Invalid','No Data Selected!','error')
            loadingScreen(false)
            throw('exit')
        }
        return ids
    }

    flagActiveUser = () => {
        loadingScreen(true)
        let ids = getSelectedRow()
        let target = '{{ $http_req["flag-active"] }}'
        toolsUserExe({ids,target})
        return false
    }

    flagNotifInboxUser = () => {
        loadingScreen(true)
        let ids = getSelectedRow()
        let target = '{{ $http_req["flag-notif-inbox"] }}'
        toolsUserExe({ids,target})
        return false
    }

    resetPasswordUser = () => {
        loadingScreen(true)
        let ids = getSelectedRow()
        let target = '{{ $http_req["reset-password"] }}'
        toolsUserExe({ids,target})
        return false
    }
    
    toolsUserExe = async (param) => {
        let t_config = table_index_config
        let result_data = await httpRequest(param.target,'post',param).then(function(result){ return result })
        showPNotify('Info',result_data.msg,'success')
        rebuildTableIndex(t_config.table_url,t_config.table_id,1)
        loadingScreen(false)
    }
</script>
@endpush