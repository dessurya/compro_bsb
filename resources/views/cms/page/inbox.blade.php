@extends('cms.layout.base')

@section('title')
Inbox
@endsection

@push('content')
<div class="container">
    
    <div class="row">
        <div class="col-12">
            <div id="inboxShow" style="display:none;">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h3>Inbox Show <b></b></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr><th>Email</th><td id="email"></td><th>Name</th><td id="name"></td><th>Phone</th><td id="phone"></td></tr>
                            <tr><th>Inbox Date</th><td id="date"></td><th>Subject</th><td id="subject" colspan="3"></td></tr>
                            <tr><th colspan="6">Message</th></tr>
                            <tr><td id="message" colspan="6"></td></tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col">
                                <span onclick="closeData()" class="btn btn-sm btn-block btn-outline-danger">Close</span>
                            </div>
                            <div class="col">
                                <a class="btn btn-sm btn-block btn-outline-success" href="#">Send Mail</a>
                            </div>
                        </div>
                    </div>
                </div>
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
        $('#'+table_index_config.table_id+' .selected-trigger').remove()
    });

    exportInbox = () => {
        loadingScreen(true)
        let identity = table_index_config.table_id
        let condition = getConditionTableIndex(identity)
        if (condition.created_at_from == null || condition.created_at_from == '' || condition.created_at_to == null || condition.created_at_to == '') {
            showPNotify('Invalid','Inbox date must be set start date and end date','error')
            loadingScreen(false)
            return false
        }
        time_start = new Date(condition.created_at_from)
        time_end = new Date(condition.created_at_to)
        if (time_start > time_end) {
            showPNotify('Invalid','Start date cannot be higher than to end date','error')
            loadingScreen(false)
            return false
        }
        var countdate = Math.round((time_end-time_start)/(1000*60*60*24))
        if (countdate > 100) {
            showPNotify('Invalid','Range of inbox date cannot higher than 100 days','error')
            loadingScreen(false)
            return false
        }
        let confirm_act = confirm('Confirmation Needed! Are you sure export this table data?')
        if (confirm_act == false) {
            loadingScreen(false)
            return false
        }
        let target = '{{ route("cms.inbox.export") }}'
        exportInboxExe({condition,target})
    }
    
    exportInboxExe = async (param) => {
        let result = await httpRequest(param.target,'post',param.condition).then(function(result){ return result })
        showPNotify('Success','Download excel file','success')
        if (result.response == true) {
            let link_file = "data:application/vnd.ms-excel;base64,"+result.encode_file
            var a = document.createElement("a")
            a.href = link_file
            a.download = result.file_name
            a.click()
            a.remove()
        }
        loadingScreen(false)
    }

    getConditionTableIndex = (identity) => {
        let condition = {}
        condition['name'] = $('#'+identity+' [name=search_name]').val()
        condition['email'] = $('#'+identity+' [name=search_email]').val()
        condition['phone'] = $('#'+identity+' [name=search_phone]').val()
        condition['subject'] = $('#'+identity+' [name=search_subject]').val()
        condition['flag_read'] = $('#'+identity+' [name=search_flag_read]').val()
        condition['created_at_from'] = $('#'+identity+' [name=search_from_created_at]').val()
        condition['created_at_to'] = $('#'+identity+' [name=search_to_created_at]').val()
        return condition
    }

    renderedTableIndex = (identity,data) => {
        let t_config = table_index_config
        $('#'+identity+' table tbody').html('')
        if (data.length == 0) {
            $('#'+identity+' table tbody').html('<tr><td class="text-center" colspan="'+t_config.data_field_count+'">-- No Data Found --</td></tr>')
        }else{
            $.each(data, function(idx,row){
                let render_row = '<tr>'
                $.each(t_config.data_set, function(c_idx,c_coll){
                    if (c_coll.field == 'tools') {
                        let encode_data = btoa(JSON.stringify(row))
                        render_row += '<td><button class="btn btn-info btn-sm" onclick="openData(\''+encode_data+'\')">Open</button></td>'
                    }else{
                        render_row += '<td>'+row[c_coll.field]+'</td>'
                    }
                })
                render_row += '</tr>'
                $('#'+identity+' table tbody').append(render_row)
            })
        }
    }

    closeData = () => {
        $('#inboxShow').fadeOut("slow")
    }

    openData = (encode_data) => {
        let decode_data = JSON.parse(atob(encode_data))
        $('#inboxShow').fadeIn("slow")
        $('#inboxShow .card-body #email').html(decode_data.email)
        $('#inboxShow .card-body #name').html(decode_data.name)
        $('#inboxShow .card-body #phone').html(decode_data.phone)
        $('#inboxShow .card-body #subject').html(decode_data.subject)
        $('#inboxShow .card-body #date').html(decode_data.created_at)
        $('#inboxShow .card-body #message').html(decode_data.message)
        let mail_to = 'mailto:'+decode_data.name+'?subject='+encodeURIComponent('Replace : '+decode_data.subject)
        $('#inboxShow .card-footer a').attr('href',mail_to)
        if (decode_data.flag_read == 'N') {
            updateFlagRead(decode_data.id)
        }
    }
    
    updateFlagRead = async (id) => {
        await httpRequest('{{ route("cms.inbox.flag-read") }}','post',{id}).then(function(result){ console.log(result) })
        await rebuildTableIndex(table_index_config.table_url,table_index_config.table_id,1)
        getNotifyInbox(inbox_check_url)
    }
</script>
@endpush