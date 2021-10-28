<div id="{{ $table_config['table_id'] }}">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>{{ $table_config['table_title'] }}</h3>
            </div>
            
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-append">
                                <button class="btn btn-info" onclick="return refreshTable()" title="refresh table"><i class="fas fa-sync-alt"></i></button>
                                <button class="btn btn-info" onclick="toogleClass('hide', '#{{ $table_config['table_id'] }} thead input')" title="search"><i class="fas fa-search"></i></button>
                                <button type="button" class="btn btn-info dropdown-toggle dropdown-icon other-tools" data-toggle="dropdown" aria-expanded="true" title="tools"><span class="sr-only">Toggle Dropdown</span></button>
                                <div class="dropdown-menu other-tools" role="menu" style="">
                                    @foreach($table_config['tools'] as $list)
                                    <a class="dropdown-item action-item" onclick="return {{ $list['function'] }}" style="cursor:pointer">{{$list['label']}}</a>
                                    @endforeach
                                    <div class="dropdown-divider"></div>
                                    <a style="cursor:pointer" onclick="return selectAllRowTable('{{ $table_config['table_id'] }}', true)"; class="dropdown-item selected-trigger">Selected All</a>
                                    <a style="cursor:pointer" onclick="return selectAllRowTable('{{ $table_config['table_id'] }}', false)"; class="dropdown-item selected-trigger">Unselected All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col text-right">
                        <label class="tabel-info">Show <select name="show" onchange="return refreshTable()">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select> entries || Order By <select name="order_key" onchange="return refreshTable()">
                            @foreach($table_config['data_set'] as $list)
                            @if($list['order'] == true)
                            <option {{ $table_config['data_order']['field'] == $list['field'] ? 'selected' : '' }} value="{{$list['field']}}">{{ $list['label'] }}</option>
                            @endif
                            @endforeach
                        </select> : <select name="order_val" onchange="return refreshTable()">
                            <option {{ $table_config['data_order']['value'] == 'asc' ? 'selected' : '' }} value="asc">ASC</option>
                            <option {{ $table_config['data_order']['value'] == 'desc' ? 'selected' : '' }} value="desc">DESC</option>
                        </select></label>
                    </div>
                </div>
            </li>
            @if(!empty($table_config['table_info']))
            <li class="list-group-item">{!! $table_config['table_info'] !!}</li>
            @endif
        </ul>
        <div class="card-body table-responsive p-0" style="height: auto; max-height: 480px;">
            <table id="{{ $table_config['table_id'] }}" class="table table-head-fixed text-nowrap selected-table">
                <thead>
                    <tr role="row">
                        <form>
                        @foreach($table_config['data_set'] as $list)
                        <th>
                            {{ $list['label'] }}
                            @if($list['search'] == true)
                            @if($list['search_type'] == 'date')
                            <input 
                                type="date" 
                                name="search_from_{{$list['field']}}" 
                                class="form-control-sm hide" 
                                placeholder="From Date"
                                onchange="return refreshTable()">
                            <input 
                                type="date" 
                                name="search_to_{{$list['field']}}" 
                                class="form-control-sm hide" 
                                placeholder="To Date"
                                onchange="return refreshTable()">
                            @elseif($list['search_type'] == 'text')
                            <input 
                                type="text" 
                                name="search_{{$list['field']}}" 
                                class="form-control-sm hide" 
                                placeholder="Search {{ $list['label'] }}"
                                onchange="return refreshTable()">
                            @endif
                            @endif
                        </th>
                        @endforeach
                        </form>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <span class="tabel-info">
                        Showing <strong id="from"></strong> to <strong id="to"></strong> of <strong id="total"></strong> entries
                    </span>
                </div>
                <div class="col tabel-info text-right">
                    <label>Pages <input type="number" name="page" onchange="return rebuildTableIndex('{{ $table_config['table_url'] }}','{{ $table_config['table_id'] }}',null)" min="1"> from <strong id="last_page"></strong></label>
                </div>
            </div>
        </div>
    </div>
</div>