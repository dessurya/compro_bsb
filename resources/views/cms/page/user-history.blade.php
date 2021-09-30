@extends('cms.layout.base')

@section('title')
User History
@endsection

@push('content')
<div class="container">
    
    <div class="row">
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
        $('#'+table_index_config.table_id+' .other-tools').remove()
    });

    getConditionTableIndex = (identity) => {
        let condition = {}
        condition['name'] = $('#'+identity+' [name=search_name]').val()
        condition['email'] = $('#'+identity+' [name=search_email]').val()
        condition['module'] = $('#'+identity+' [name=search_module]').val()
        condition['activity'] = $('#'+identity+' [name=search_activity]').val()
        return condition
    }

    renderedTableIndex = (identity,data) => {
        let t_config = table_index_config
        $('#'+identity+' table tbody').html('')
        if (data.length == 0) {
            $('#'+identity+' table tbody').html('<tr><td class="text-center" colspan="'+t_config.data_field_count+'"></td></tr>')
        }else{
            $.each(data, function(idx,row){
                let render_row = '<tr>'
                $.each(t_config.data_set, function(c_idx,c_coll){ render_row += '<td>'+row[c_coll.field]+'</td>' })
                render_row += '</tr>'
                $('#'+identity+' table tbody').append(render_row)
            })
        }
    }
</script>
@endpush