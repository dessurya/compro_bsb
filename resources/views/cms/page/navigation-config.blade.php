@extends('cms.layout.base')

@section('title')
Navigasi Config
@endsection

@push('content')
<div class="container">
    
    <div class="row">
        <div class="col-12">
            <div id="ConfigPageShow" style="display:none;">
                <form onsubmit="return submitFormConfigPage()"  enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>Config Page Form <b></b></h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col form-group">
                                    <input type="hidden" id="id" name="id">
                                    <label for="identity">Identity</label>
                                    <input type="text" class="form-control" id="identity" name="identity" placeholder="identity" disabled>
                                </div>
                                <div class="col form-group">
                                    <label for="meta_author">Meta Author</label>
                                    <input type="text" class="form-control" id="meta_author" name="meta_author" placeholder="meta_author" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="name_en">Name En</label>
                                    <input type="text" class="form-control" id="name_en" name="name_en" required>
                                </div>
                                <div class="col form-group">
                                    <label for="name_id">Name Id</label>
                                    <input type="text" class="form-control" id="name_id" name="name_id" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="meta_title_en">Meta Title En</label>
                                    <input type="text" class="form-control" id="meta_title_en" name="meta_title_en" max="250">
                                </div>
                                <div class="col form-group">
                                    <label for="meta_title_id">Meta Title Id</label>
                                    <input type="text" class="form-control" id="meta_title_id" name="meta_title_id" max="250">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="meta_keywords_en">Meta Keywords En</label>
                                    <input type="text" class="form-control" id="meta_keywords_en" name="meta_keywords_en" max="250">
                                </div>
                                <div class="col form-group">
                                    <label for="meta_keywords_id">Meta Keywords Id</label>
                                    <input type="text" class="form-control" id="meta_keywords_id" name="meta_keywords_id" max="250">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="meta_description_en">Meta Description En</label>
                                    <textarea class="form-control" id="meta_description_en" name="meta_description_en"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="meta_description_id">Meta Description Id</label>
                                    <textarea class="form-control" id="meta_description_id" name="meta_description_id"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <button type="reset" onclick="closeData()" class="btn btn-sm btn-block btn-outline-danger">Cancel</button>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-sm btn-block btn-outline-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12">
            <div id="nav-conf-list">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h3>List Data</h3>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <button class="btn btn-info" onclick="return refreshTable()">Refresh</button>
                                            <button class="btn btn-info" onclick="return selectAllRowTable(true)">Selected All</button>
                                            <button class="btn btn-info" onclick="return selectAllRowTable(false)">Unselected All</button>
                                            <button class="btn btn-info" onclick="return triggerShowHideNavPage()">Show/Hide Navigation & Page</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col text-right"><span>*double click for selected row data</span></div>
                            </div>
                        </li>
                    </ul>
                    <div class="card-body table-responsive p-0">
                        <table id="nav-conf-list" class="table table-head-fixed text-nowrap selected-table">
                            <thead>
                                <tr role="row">
                                    <th>Identity</th>
                                    <th>Name</th>
                                    <th>Meta Title</th>
                                    <th>Meta Keywords</th>
                                    <th>Show</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endpush

@push('script')
<script>
    $( document ).ready(function() {
        refreshTable()
    });

    selectAllRowTable = (param) => {
        var selection = $("#nav-conf-list table tbody tr");
        if (param == true) { selection.addClass("selected") }
        else if (param == false) { selection.removeClass("selected") }
    }

    selectedRowData = (identity) => {
        $('table tbody #'+identity).toggleClass('selected')
    }

    getSelectedId = () => {
        let ids = []
        $.each($('table tbody tr.selected'), function(){
            const attr_id = $(this).attr('id')
            ids.push(attr_id.replace("row_data_", ""))
        })
        return ids
    }

    refreshTable = () => {
        rebuildTableIndex()
    }

    rebuildTableIndex = async () => {
        loadingScreen(true)
        await httpRequest('{{ route("cms.navigation-config.list") }}','post',null).then(function(result){
            renderedTableIndex('nav-conf-list',result.data)
            loadingScreen(false)
        })
    }

    renderedTableIndex = (identity,data) => {
        $('#'+identity+' table tbody').html('')
        $.each(data, function(idx,row){
            let encode_data = btoa(JSON.stringify(row))
            let render_row = '<tr id="row_data_'+row.id+'" onclick="selectedRowData(\'row_data_'+row.id+'\')">'
            render_row += '<td>'+row.identity+'</td>'
            render_row += '<td>'+row.name+'</td>'
            render_row += '<td>'+row.meta_title+'</td>'
            render_row += '<td>'+row.meta_keywords+'</td>'
            render_row += '<td>'+row.flag_show+'</td>'
            render_row += '<td><button class="btn btn-info btn-sm" onclick="openData(\''+encode_data+'\')">Open</button></td>'
            render_row += '</tr>'
            $('#'+identity+' table tbody').append(render_row)
        })
        loadingScreen(false)
    }

    closeData = () => {
        $('#ConfigPageShow').fadeOut("slow")
    }

    openData = (encode_data) => {
        let decode_data = JSON.parse(atob(encode_data))
        $('#ConfigPageShow').fadeIn("slow")
        $('#ConfigPageShow .card-body #identity').html(decode_data.identity)
        $('#ConfigPageShow .card-body #meta_author').html(decode_data.meta_author)

        let name = JSON.parse(decode_data.name)
        $('#ConfigPageShow .card-body #name_id').html(decode_data.name.id)
        $('#ConfigPageShow .card-body #name_en').html(decode_data.name.en)

        if (decode_data.meta_description != null && decode_data.meta_description != '') {
            let meta_description = JSON.parse(decode_data.meta_description)
            $('#ConfigPageShow .card-body #meta_description_id').html(decode_data.meta_description.id)
            $('#ConfigPageShow .card-body #meta_description_en').html(decode_data.meta_description.en)
        }
        if (decode_data.meta_keywords != null && decode_data.meta_keywords != '') {
            let meta_keywords = JSON.parse(decode_data.meta_keywords)
            $('#ConfigPageShow .card-body #meta_keywords_id').html(decode_data.meta_keywords.id)
            $('#ConfigPageShow .card-body #meta_keywords_en').html(decode_data.meta_keywords.en)
        }
        if (decode_data.meta_title != null && decode_data.meta_title != '') {
            let meta_title = JSON.parse(decode_data.meta_title)
            $('#ConfigPageShow .card-body #meta_title_id').html(decode_data.meta_title.id)
            $('#ConfigPageShow .card-body #meta_title_en').html(decode_data.meta_title.en)
        }
    }

    submitFormConfigPage = () => {
        let param = {}
        param.id = $('#ConfigPageShow .card-body [name=id]').val()
        param.identity = $('#ConfigPageShow .card-body [name=identity]').val()
        param.meta_author = $('#ConfigPageShow .card-body [name=meta_author]').val()
        param.name = {}
        param.name.id = $('#ConfigPageShow .card-body [name=name_id]').val()
        param.name.en = $('#ConfigPageShow .card-body [name=name_en]').val()
        param.meta_description = {}
        param.meta_description.id = $('#ConfigPageShow .card-body [name=meta_description_id]').val()
        param.meta_description.en = $('#ConfigPageShow .card-body [name=meta_description_en]').val()
        param.meta_keywords = {}
        param.meta_keywords.id = $('#ConfigPageShow .card-body [name=meta_keywords_id]').val()
        param.meta_keywords.en = $('#ConfigPageShow .card-body [name=meta_keywords_en]').val()
        param.meta_title = {}
        param.meta_title.id = $('#ConfigPageShow .card-body [name=meta_title_id]').val()
        param.meta_title.en = $('#ConfigPageShow .card-body [name=meta_title_en]').val()
        await httpRequest('{{ route("cms.navigation-config.store") }}','post',param).then(function(result){ return result })
        await refreshTable()
        showPNotify('Info','Success')
    }
    
    updateFlagShow = async (id) => {
        const ids = getSelectedId()
        if (ids.length == 0) {
            showPNotify('Info','Not found data select','danger')
            return false
        }
        loadingScreen(true)
        await httpRequest('{{ route("cms.navigation-config.store-flag-show") }}','post',{id}).then(function(result){ console.log(result) })
        await refreshTable()
    }
</script>
@endpush