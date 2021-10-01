<script type="text/javascript" src="{{ asset('vendors/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/adminlte-dist/js/adminlte.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/pnotify/pnotify.custom.min.js') }}"></script>


<script type="text/javascript">
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    const inbox_check_url = '{{ route("cms.inbox.check") }}'
    $( document ).ready(function() {
        loadingScreen(false)
        getNotifyInbox(inbox_check_url)
    });
</script>

<script type="text/javascript" src="{{ asset('asset/cms/public_script.js') }}"></script>
