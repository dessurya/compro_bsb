<script>
    $('input[type=file]').on('change',function(){
        const file = this.files[0]
        if (file.size > 2807684) {
            alert('Max file size 2MB')
            $(this).val(null)
        }
    })
</script>