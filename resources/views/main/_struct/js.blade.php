<script src="{{ url('vendors\jquery\jquery.min.js') }}"></script>
<script src="{{ url('vendors\bootstrap\js\bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.2/js/all.min.js" integrity="sha512-+e0KSTWAD/BlzmKXfdpTZzWram63eaW8RPLQkuQqRkH4tzjxLS2qIEXRvi6PAmdAfGJkNVf2poOEQip2ix9bfQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).scroll(function() {
        var y = $(this).scrollTop()
        if (y > 450) { $('nav#header').addClass('change')}
        else { $('nav#header').removeClass('change') }
    })
</script>