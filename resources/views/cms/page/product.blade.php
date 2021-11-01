@extends('cms.layout.base')

@section('title')
Product
@endsection

@push('link')
<link rel="stylesheet" href="{{ asset('vendors/summernote/summernote.min.css') }}">
@endpush

@push('content')
<div class="container">
    
    <div class="row">
        <div class="col-12">
            <div id="formProduct" style="display:none;">
                <form onsubmit="return submitFormProduct()"  enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>Form Product <b></b></h3>
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
                                    <label for="content_shoert">Short Content</label>
                                    <input type="text" class="form-control" id="content_shoert" name="content_shoert" placeholder="Short Content">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="content">Content</label>
                                    <textarea id="content" name="content"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="img_thumnail">Image Thumbnail</label>
                                    <input type="file" class="form-control" id="img_thumnail" name="img_thumnail" accept="image/*">
                                </div>
                            </div>
                            <div id="imgThumbnailDisplay" class="row"><div class="col" style="display:none"></div></div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="img_banner">Image Banner</label>
                                    <input type="file" class="form-control" id="img_banner" name="img_banner" accept="image/*">
                                </div>
                            </div>
                            <div id="imgBannerDisplay" class="row"><div class="col" style="display:none"></div></div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <button type="reset" onclick="closeFormProduct()" class="btn btn-sm btn-block btn-outline-danger">Cancel</button>
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
    let indentity_form_news_info = '#formProduct'
    table_index_config = JSON.parse(atob(table_index_config))
    $( document ).ready(function() {
        refreshTable()
    });

    getConditionTableIndex = (identity) => {
        let condition = {}
        condition['title'] = $('#'+identity+' [name=search_title]').val()
        condition['language'] = $('#'+identity+' [name=search_language]').val()
        condition['created_by'] = $('#'+identity+' [name=search_created_by]').val()
        condition['position'] = $('#'+identity+' [name=search_position]').val()
        condition['flag_publish'] = $('#'+identity+' [name=search_flag_publish]').val()
        condition['created_by'] = $('#'+identity+' [name=search_created_by]').val()
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
                        render_row += '<td><button class="btn btn-info btn-sm" onclick="openProduct('+row.id+')">Open</button></td>'
                    }else{
                        render_row += '<td>'+row[c_coll.field]+'</td>'
                    }
                })
                render_row += '</tr>'
                $('#'+identity+' table tbody').append(render_row)
            })
        }
    }

    publishProduct = () => {
        const ids = getSelectedId()
        if (ids.length == 0) {
            showPNotify('Info','Not found data select','danger')
            return false
        }
        loadingScreen(true)
        updatePublishStatus(ids,'Y')
    }

    draftProduct = () => {
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

    closeFormProduct = () => {
        $(indentity_form_news_info+' #content').summernote('destroy')
        $(indentity_form_news_info+' .card-title h3 b').html('')
        $(indentity_form_news_info+' input').val(null)
        $(indentity_form_news_info+' #imgThumbnailDisplay .col').html('').fadeOut()
        $(indentity_form_news_info+' #imgBannerDisplay .col').html('').fadeOut()
        $(indentity_form_news_info+' #content').val(null)
        $(indentity_form_news_info).fadeOut()
    }

    addProduct = () => {
        closeFormProduct()
        $(indentity_form_news_info).fadeIn()
        $(indentity_form_news_info+' input[name=title]').focus()
        $(indentity_form_news_info+' #content').summernote()
    }

    submitFormProduct = () => {
        loadingScreen(true)
        submitFormProductExe(indentity_form_news_info)
        return false
    }

    submitFormProductExe = async (identity) => {
        const newsInfoStore = await storeNewsInfo(identity)
        if (newsInfoStore.response == true) {
            let pictures_banner = $(identity+' [name=img_banner]').prop('files')
            let pictures_thumbnail = $(identity+' [name=img_thumnail]').prop('files')
            const newsInfoStoreImgBanner = await storeNewsInfoImgBanner(pictures_banner,newsInfoStore.id)
            const newsInfoStoreImgThumbnail = await storeNewsInfoImgThumbnail(pictures_thumbnail,newsInfoStore.id,pictures_banner.length)
            if (pictures_banner.length == 0 && pictures_thumbnail.length == 0) {
                await openProduct(newsInfoStore.id)
                await refreshTable()
            }
        }
        loadingScreen(false)
    }

    storeNewsInfo = async (identity) => {
        let param = {}
        param['title'] = $(identity+' [name=title]').val()
        param['position'] = $(identity+' [name=position]').val()
        param['language'] = $(identity+' [name=language]').val()
        param['content_shoert'] = $(identity+' [name=content_shoert]').val()
        param['content'] = $(identity+' [name=content]').summernote('code')
        param['id'] = $(identity+' [name=old_data]').val()
        let result_data = await httpRequest('{{ $http_req['store'] }}','post',param).then(function(result){ return result })
        showPNotify('Info',result_data.msg,result_data.notif_type)
        return result_data
    }

    storeNewsInfoImgBanner = async (pictures, ni_id) => {
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
    }

    storeNewsInfoImgThumbnail = async (pictures, ni_id, newsInfoStoreImgBanner) => {
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
                    openProduct(img.set_id)
                    refreshTable()
                })
            };
        })
        if (pictures.length == 0 && newsInfoStoreImgBanner > 0) {
            openProduct(ni_id)
            refreshTable()
        }
        return pictures.length
    }

    openProduct = async (id) => {
        loadingScreen(true)
        addProduct()
        let result = await httpRequest('{{ $http_req['open'] }}','post',{id}).then(function(result){ return result.data })
        $(indentity_form_news_info+' [name=old_data]').val(result.id)
        $(indentity_form_news_info+' [name=title]').val(result.title)
        $(indentity_form_news_info+' [name=position]').val(result.position)
        $(indentity_form_news_info+' [name=language]').val(result.language)
        $(indentity_form_news_info+' [name=content_shoert]').val(result.content_shoert)
        if (result.content != '' && result.content != null) {
            $(indentity_form_news_info+' [name=content]').summernote('code', result.content)
        }else{
            $(indentity_form_news_info+' [name=content]').summernote()
        }
        if (result.img_thumnail != '' && result.img_thumnail != null) {
            $(indentity_form_news_info+' #imgThumbnailDisplay .col').html('<img src="../'+result.img_thumnail+'" class="img-fluid pad">').fadeIn()
        }
        if (result.img_banner != '' && result.img_banner != null) {
            $(indentity_form_news_info+' #imgBannerDisplay .col').html('<img src="../'+result.img_banner+'" class="img-fluid pad">').fadeIn()
        }
        loadingScreen(false)
    }
</script>
@endpush