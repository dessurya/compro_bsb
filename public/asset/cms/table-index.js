// JSON.stringify
selectAllRowTable = (target, param) => {
    var selection = $("#"+target+" table tbody tr");
    if (param == true) { selection.addClass("selected") }
    else if (param == false) { selection.removeClass("selected") }
}

rebuildTableIndex = async (target, identity, page) => {
    loadingScreen(true)
    let param = {}
    param['show'] = $('#'+identity+' [name=show]').val()
    param['order_key'] = $('#'+identity+' [name=order_key]').val()
    param['order_val'] = $('#'+identity+' [name=order_val]').val()
    param['page'] = page
    if (page == null) {
        param['page'] = $('#'+identity+' [name=page]').val()
    }
    param['condition'] = getConditionTableIndex(identity)
    let result_data = await httpRequest(target,'post',param).then(function(result){
        loadingScreen(false)
        return result
    })
    
    $('#'+identity+' .tabel-info #from').html(result_data.data.from);
    $('#'+identity+' .tabel-info #to').html(result_data.data.to);
    $('#'+identity+' .tabel-info #total').html(result_data.data.total);
    $('#'+identity+' .tabel-info #last_page').html(result_data.data.last_page);
    $('#'+identity+' .tabel-info input[name=page]').attr('max', result_data.data.last_page);
    $('#'+identity+' .tabel-info input[name=page]').val(result_data.data.current_page);

    renderedTableIndex(identity,result_data.data.data)
}