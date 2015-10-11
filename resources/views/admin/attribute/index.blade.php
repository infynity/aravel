@extends('layouts.admin')
@section('content')
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">商品管理</strong> / <small>商品属性</small></div>
    </div>
    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <a class="am-btn am-btn-default" href="{{ route('admin.type.{type_id}.attribute.create', $type_id) }}">
                        <span class="am-icon-plus"></span> 新增
                    </a>
                    <button type="button" class="am-btn am-btn-default" id="del_all">
                        <span class="am-icon-trash-o"></span> 删除
                    </button>
                </div>
            </div>
        </div>

        <div class="am-u-sm-12 am-u-md-3">
            <div class="am-form-group">
                <select data-am-selected="{btnSize: 'sm'}" id="change_type">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}"
                        @if($type_id == $type->id)
                        selected @endif>
                        {{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="am-g">
        <div class="am-u-sm-12">
            <form class="am-form" action="{{ route('admin.type.{type_id}.attribute.del_all', $type_id) }}" method="post">
                {!! csrf_field() !!}
                {!! method_field('delete') !!}
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                        <tr>
                            <th class="table-check"><input type="checkbox" id="check_all"/></th>
                            <th class="table-id">编号</th>
                            <th class="table-title">属性名称</th>
                            <th class="table-type">商品类型</th>
                            <th class="table-author am-hide-sm-only">属性值的录入方式</th>
                            <th class="table-date am-hide-sm-only">可选值列表</th>
                            <th class="table-date am-hide-sm-only">排序</th>
                            <th class="table-set">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attributes as $attribute)
                        <tr>
                            <td><input type="checkbox" name="del_all[]" value="{{ $attribute->id }}" class="del_all"/></td>
                            <td>{{ $attribute->id }}</td>
                            <td>{{ $attribute->name }}</td>
                            <td>{{ $attribute->type->name }}</td>
                            <td>
                                @if ($attribute->input_type == 0)
                                    手工录入
                                @elseif ($attribute->input_type == 1)
                                    从列表中选择
                                @else
                                    多行文本框
                                @endif
                            </td>
                            <td>
                                {{ $attribute->value }}


                            </td>
                            <td class="am-hide-sm-only">{{ $attribute->sort_order }}</td>

                            <td>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="{{ route('admin.type.{type_id}.attribute.edit', [$type_id, $attribute->id]) }}">
                                            <span class="am-icon-pencil-square-o"></span> 编辑
                                        </a>
                                        <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" href="{{ route('admin.type.{type_id}.attribute.destroy', [$type_id, $attribute->id]) }}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="确定删除吗？">
                                            <span class="am-icon-trash-o"></span> 删除
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="am-cf">
                    <div class="am-fr">
                        {!! $attributes->render() !!}
                    </div>
                </div>
            <input type="submit" value="多选删除" class="am-btn am-btn-danger"/>

            </form>
        </div>
    </div>

</div>
@stop

@section('js')
<script type="text/javascript">
    $(function(){
        //下拉列表选择别的商品类型
        $("#change_type").change(function(){
            var type_id = $(this).val();
            var url = '/admin/type/'+type_id+'/attribute';
            location.href = url;
        })

        //全选
        $("#check_all").click(function(){
            $(':checkbox').prop("checked", this.checked );
        })

        //多选删除
        $("#del_all").click(function(){
            var del_all = $(".am-form").serialize();
            $.ajax({
                type: "DELETE",
                url: "/admin/type/{{$type_id}}/del_all ",
                data : del_all,
                dataType: "json",
                /////////////////dataType:"html"   不用return
                success : function(data){
                     console.log(21);
                   location.href=location.href;

                }
            });
            return false;
        })
    })
</script>
@stop
