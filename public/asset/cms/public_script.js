loadingScreen = (show) => {
    if (show == true) { $('#loading-page').fadeIn() }
    else { $('#loading-page').fadeOut() }
}

showPNotify = (v_title,v_text,v_type) => {
    new PNotify({ title: v_title, text: v_text, type: v_type, delay: 3000 })
}

toogleClass = (param, target) => {
    $(target).toggleClass(param)
}

getNotifyInbox = async (target) => {
    getNotifyInboxExecute(target)
    window.setTimeout(function() { 
        getNotifyInbox(target);
    }, 30000); // 30 detik
}

getNotifyInboxExecute = async (target) => {
    let data = await httpRequest(target,'post',{}).then(function(result){
        return result
    })
    renderNotifyInbox(data)
}

renderNotifyInbox = (param) => {
    let inboxTemp = sessionStorage.getItem('inboxTemp')
    if (inboxTemp != null && inboxTemp != undefined && inboxTemp == '') {
        inboxTemp = JSON.parse(inboxTemp)
    }
    if (inboxTemp == param.id) {
        return false
    }
    sessionStorage.setItem('inboxTemp', JSON.stringify(param.id))
    $('#inbox-notif-wrapper .dropdown-menu #appendInbox').html('');
    $('#inbox-notif-wrapper a.nav-link span').remove();
    if (param.id.length > 0) {
        $('#inbox-notif-wrapper a.nav-link').append('<span class="badge badge-danger navbar-badge">'+param.id.length+'</span>');
        $.each(param.data, function (idx, val) {
            var msg = '<h3 class="dropdown-item-title">'+val.name+' - '+val.email+'</h3>';
            msg += '<small>'
            msg += '<p class="text-sm text-justify"><strong>'+val.subject+' : </strong>'+val.message+'</p>';
            msg += '<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>'+val.created_at+'</p>';
            msg += '</small>'
            $('#inbox-notif-wrapper .dropdown-menu #appendInbox').append('<div class="dropdown-item"><div class="media"><div class="media-body">'+msg+'</div></div></div><div class="dropdown-divider"></div>');
        });
    }
}

httpRequest = (target, method, param) => {
    return new Promise(function(resolve, reject) {
        $.ajax({
            url: target,
            type: method,
            data: param,
            dataType: 'json',
            success : function(result) { resolve(result) },
            error : function(err) { reject(err) }
        })
    })
}

