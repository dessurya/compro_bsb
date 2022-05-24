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
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="flag_publish">Publish</label>
                                    <input type="text" class="form-control" id="flag_publish" name="flag_publish" disabled>
                                </div>
                                <div class="col form-group">
                                    <label for="publish_date">Publish Date</label>
                                    <input type="date" class="form-control" id="publish_date" name="publish_date" placeholder="Publish date" min="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="img_thumbnail">Image Thumbnail</label>
                                    <input type="file" class="form-control" id="img_thumbnail" name="img_thumbnail" accept="image/*">
                                </div>
                                <div class="col form-group">
                                    <label for="flag_img_thumbnail">Show Image Thumbnail</label>
                                    <select class="form-control" id="flag_img_thumbnail" name="flag_img_thumbnail">
                                        <option value="N">No</option>
                                        <option value="Y">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div id="imgThumbnailDisplay" class="row">
                                <div class="col" style="display:none"></div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="img_banner">Image Banner</label>
                                    <input type="file" class="form-control" id="img_banner" name="img_banner" accept="image/*">
                                </div>
                                <div class="col form-group">
                                    <label for="flag_img_banner">Show Image Banner</label>
                                    <select class="form-control" id="flag_img_banner" name="flag_img_banner">
                                        <option value="N">No</option>
                                        <option value="Y">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div id="imgBannerDisplay" class="row">
                                <div class="col" style="display:none"></div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="content">Content</label>
                                    <textarea id="content" name="content"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta Title" max="250">
                                </div>
                                <div class="col form-group">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" placeholder="Meta Keyword" max="250">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Meta Description" max="250">
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
        refreshTable()
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
                let render_row = '<tr id="row_data_'+row.id+'" ondblclick="selectedRowData(\'row_data_'+row.id+'\')">'
                $.each(t_config.data_set, function(c_idx,c_coll){
                    if (c_coll.field == 'tools') {
                        render_row += '<td><button class="btn btn-info btn-sm" onclick="openNewsInfo('+row.id+')">Open</button></td>'
                    }else{
                        render_row += '<td>'+row[c_coll.field]+'</td>'
                    }
                })
                render_row += '</tr>'
                $('#'+identity+' table tbody').append(render_row)
            })
        }
    }

    publishNewsInfo = () => {
        const ids = getSelectedId()
        if (ids.length == 0) {
            showPNotify('Info','Not found data select','danger')
            return false
        }
        loadingScreen(true)
        updatePublishStatus(ids,'Y')
    }

    backToDraftNewsInfo = () => {
        const ids = getSelectedId()
        if (ids.length == 0) {
            showPNotify('Info','Not found data select','danger')
            return false
        }
        loadingScreen(true)
        updatePublishStatus(ids,'N')
    }

    updatePublishStatus = async (ids,status) => {
        const param = {ids,status}
        const result_data = await httpRequest('{{ $http_req['store-flag-publish'] }}','post',param).then(function(result){ return result })
        showPNotify('Info','Success','info')
        refreshTable()
        loadingScreen(false)
    }

    closeFormNewsInfo = () => {
        $(indentity_form_news_info+' #content').summernote('destroy')
        $(indentity_form_news_info+' .card-title h3 b').html('')
        $(indentity_form_news_info+' input').val(null)
        $(indentity_form_news_info+' #imgThumbnailDisplay .col').html('').fadeOut()
        $(indentity_form_news_info+' #imgBannerDisplay .col').html('').fadeOut()
        $(indentity_form_news_info+' #content').val(null)
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
        const newsInfoStore = await storeNewsInfo(identity)
        if (newsInfoStore.response == true) {
            const newsInfoStoreImgBanner = await storeNewsInfoImgBanner(identity,newsInfoStore.id)
            const newsInfoStoreImgThumbnail = await storeNewsInfoImgThumbnail(identity,newsInfoStore.id,newsInfoStoreImgBanner)
            if (newsInfoStoreImgBanner == 0 && newsInfoStoreImgThumbnail == 0) {
                await openNewsInfo(newsInfoStore.id)
                await refreshTable()
            }
        }
        loadingScreen(false)
    }

    storeNewsInfo = async (identity) => {
        let param = {}
        param['title'] = $(identity+' [name=title]').val()
        param['meta_title'] = $(identity+' [name=meta_title]').val()
        param['meta_keyword'] = $(identity+' [name=meta_keyword]').val()
        param['meta_description'] = $(identity+' [name=meta_description]').val()
        param['publish_date'] = $(identity+' [name=publish_date]').val()
        param['language'] = $(identity+' [name=language]').val()
        param['flag_img_thumbnail'] = $(identity+' [name=flag_img_thumbnail]').val()
        param['flag_img_banner'] = $(identity+' [name=flag_img_banner]').val()
        param['content'] = $(identity+' [name=content]').summernote('code')
        param['id'] = $(identity+' [name=old_data]').val()
        let result_data = await httpRequest('{{ $http_req['store'] }}','post',param).then(function(result){ return result })
        showPNotify('Info',result_data.msg,result_data.notif_type)
        return result_data
    }

    storeNewsInfoImgBanner = async (identity, ni_id) => {
        let pictures = $(identity+' [name=img_banner]').prop('files')
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
                    'for':'banner',
                    'set_id':img.set_id
                }
                httpRequest('{{ $http_req['store-img'] }}','post',param).then(function(result){ 
                    console.log(result)
                })
            };
        })
        return pictures.length
    }

    storeNewsInfoImgThumbnail = async (identity, ni_id, newsInfoStoreImgBanner) => {
        let pictures = $(identity+' [name=img_thumbnail]').prop('files')
        $.each(pictures, async function(idx,img){
            img['set_id'] = ni_id
            img['newsInfoStoreImgBanner'] = newsInfoStoreImgBanner
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
                    'for':'thumbnail',
                    'set_id':img.set_id
                }
                httpRequest('{{ $http_req['store-img'] }}','post',param).then(function(result){ 
                    console.log(result)
                    openNewsInfo(img.set_id)
                    refreshTable()
                })
            };
        })
        if (pictures.length == 0 && newsInfoStoreImgBanner > 0) {
            openNewsInfo(ni_id)
            refreshTable()
        }
        return pictures.length
    }

    openNewsInfo = async (id) => {
        loadingScreen(true)
        addNewsInfo()
        let result = await httpRequest('{{ $http_req['open'] }}','post',{id}).then(function(result){ return result.data })
        $(indentity_form_news_info+' [name=old_data]').val(result.id)
        $(indentity_form_news_info+' [name=title]').val(result.title)
        $(indentity_form_news_info+' [name=meta_description]').val(result.meta_description)
        $(indentity_form_news_info+' [name=meta_keyword]').val(result.meta_keyword)
        $(indentity_form_news_info+' [name=meta_title]').val(result.meta_title)
        $(indentity_form_news_info+' [name=publish_date]').val(result.publish_date)
        $(indentity_form_news_info+' [name=language]').val(result.language)
        $(indentity_form_news_info+' [name=flag_img_thumbnail]').val(result.flag_img_thumbnail)
        $(indentity_form_news_info+' [name=flag_img_banner]').val(result.flag_img_banner)
        if (result.content != '' && result.content != null) {
            $(indentity_form_news_info+' [name=content]').summernote('code', result.content)
        }else{
            $(indentity_form_news_info+' [name=content]').summernote()
        }
        if (result.img_thumbnail != '' && result.img_thumbnail != null) {
            $(indentity_form_news_info+' #imgThumbnailDisplay .col').html('<img src="../'+result.img_thumbnail+'" class="img-fluid pad">').fadeIn()
        }
        if (result.img_banner != '' && result.img_banner != null) {
            $(indentity_form_news_info+' #imgBannerDisplay .col').html('<img src="../'+result.img_banner+'" class="img-fluid pad">').fadeIn()
        }
        loadingScreen(false)
    }
</script>
@endpush