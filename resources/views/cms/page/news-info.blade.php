@extends('cms.layout.base')

@section('title')
News & Info
@endsection

@push('link')
<link rel="stylesheet" href="{{ asset('vendors/summernote/summernote.min.css') }}">
@endpush

@push('content')
<div class="container">
    
    <div class="row">
        <div class="col-12">
            <div id="formNewsInfo" style="display:none;">
                <form onsubmit="return submitFormNewsInfo()"  enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>Form News & Info <b></b></h3>
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
                                <div class="col form-group">
                                    <label for="flag_publish">Publish</label>
                                    <input type="text" class="form-control" id="flag_publish" name="flag_publish" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="img">Image</label>
                                    <input type="file" class="form-control" id="img" name="img" accept="image/*">
                                </div>
                                <div class="col form-group">
                                    <label for="flag_img">Show Image</label>
                                    <select class="form-control" id="flag_img" name="flag_img">
                                        <option value="N">No</option>
                                        <option value="Y">Yes</option>
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="publish_date">Publish Date</label>
                                    <input type="date" class="form-control" id="publish_date" name="publish_date" placeholder="Publish date" min="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="content">Content</label>
                                    <textarea id="content" name="content"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <button type="reset" onclick="closeFormNewsInfo()" class="btn btn-sm btn-block btn-outline-danger">Cancel</button>
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
    let indentity_form_news_info = '#formNewsInfo'
    table_index_config = JSON.parse(atob(table_index_config))
    $( document ).ready(function() {
        rebuildTableIndex(table_index_config.table_url,table_index_config.table_id,1)
    });

    getConditionTableIndex = (identity) => {
        let condition = {}
        condition['title'] = $('#'+identity+' [name=search_title]').val()
        condition['language'] = $('#'+identity+' [name=search_language]').val()
        condition['created_by'] = $('#'+identity+' [name=search_created_by]').val()
        condition['flag_publish'] = $('#'+identity+' [name=search_flag_publish]').val()
        condition['publish_date_from'] = $('#'+identity+' [name=search_from_publish_date]').val()
        condition['publish_date_to'] = $('#'+identity+' [name=search_to_publish_date]').val()
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

    closeFormNewsInfo = () => {
        $(indentity_form_news_info+' #content').summernote('destroy')
        $(indentity_form_news_info+' .card-title h3 b').html('')
        $(indentity_form_news_info+' input').val(null)
        $(indentity_form_news_info).fadeOut()
    }

    addNewsInfo = () => {
        closeFormNewsInfo()
        $(indentity_form_news_info).fadeIn()
        $(indentity_form_news_info+' input[name=title]').focus()
        $(indentity_form_news_info+' #content').summernote()
    }

    submitFormNewsInfo = () => {
        loadingScreen(true)
        submitFormNewsInfoExe(indentity_form_news_info)
        return false
    }

    submitFormNewsInfoExe = async (identity) => {
        const newsInfoStore = await storeNewsInfoPartOne(identity)
        if (newsInfoStore.response == true) {
            await storeNewsInfoImg(identity,newsInfoStore.id)
        }
        loadingScreen(false)
    }

    storeNewsInfoPartOne = async (identity) => {
        let param = {}
        param['title'] = $(identity+' [name=title]').val()
        param['publish_date'] = $(identity+' [name=publish_date]').val()
        param['language'] = $(identity+' [name=language]').val()
        param['flag_img'] = $(identity+' [name=flag_img]').val()
        param['id'] = null

        let old_data = $(identity+' input[name=old_data]').val()
        if (old_data != null && old_data != undefined && old_data != '' ) {
            old_data = JSON.parse(atob(old_data))
            param['id'] = old_data.id
        }
        let result_data = await httpRequest('{{ $http_req['store-part-one'] }}','post',param).then(function(result){ return result })
        showPNotify('Info',result_data.msg,result_data.notif_type)
        return result_data
    }

    storeNewsInfoImg = async (identity, ni_id) => {
        let param = {}
        param['title'] = $(identity+' [name=title]').val()
        param['publish_date'] = $(identity+' [name=publish_date]').val()
        param['language'] = $(identity+' [name=language]').val()
        param['flag_img'] = $(identity+' [name=flag_img]').val()
        param['id'] = null

        let result_data = await httpRequest('{{ $http_req['store-img'] }}','post',param).then(function(result){ return result })
        showPNotify('Info',result_data.msg,result_data.notif_type)
        return result_data
    }
</script>
@endpush