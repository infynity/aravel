@extends('layouts.admin')

@section('content')
    <div class="admin-content">
        <div class="am-cf am-padding">
            <div class="am-fl am-cf">
                <strong class="am-text-primary am-text-lg">微信管理</strong> /
                <small>自定义菜单</small>
            </div>
        </div>

        @include('layouts._message')
        <form action="/admin/wechat/set_menu" method="post" class="am-form">
            {!! csrf_field() !!}
            {!! method_field('put') !!}

            <div class="am-tabs am-margin" data-am-tabs>
                <ul class="am-tabs-nav am-nav am-nav-tabs">
                    <li class="am-active"><a href="#tab0">菜单一</a></li>
                    <li><a href="#tab1">菜单二</a></li>
                    <li><a href="#tab2">菜单三</a></li>
                </ul>

                <div class="am-tabs-bd">

                    @foreach($menus as $key=>$menu)
                    <div class="am-tab-panel am-fade @if($key==0) am-in am-active  @endif" id="tab{{$key}}">
                        <table class="am-table am-table-hover">
                            <thead>
                            <tr>
                                <th>级别</th>
                                <th>类型</th>
                                <th>名称</th>
                                <th>值</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>一级菜单：</td>
                                <td>
                                    <select class="form-control am-form-field am-radius" name="menus[{{$key}}][type]">
                                        <option value="">click</option>
                                        <option value="">view</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="menus[{{$key}}][name]" value="{{$menu['name']}}" class="am-form-field am-radius">
                                </td>
                                <td>
                                    <input type="text" name="menus[{{$key}}][key]" value="" class="am-form-field am-radius">
                                </td>
                            </tr>
                            @foreach($menu['sub_button'] as $k=>$button)
                                <tr>
                                    <td>二级菜单：{{$k+1}}</td>
                                    <td>
                                        <select class="am-form-field am-radius" name="menus[{{$key}}][buttons][{{$k}}][type]">
                                            <option value="click" @if($button['type']=='click') selected @endif>
                                                click
                                            </option>
                                            <option value="view" @if($button['type']=='view') selected @endif>
                                                view
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="menus[{{$key}}][buttons][{{$k}}][name]" value="{{$button['name']}}" class="am-form-field am-radius">
                                    </td>
                                    <td>
                                        <input type="text" name="menus[{{$key}}][buttons][{{$k}}][key]" value="{{$button['url'] or $button['key']}}" class="am-form-field am-radius">
                                    </td>
                                </tr>
                            @endforeach

                            @if(4-$k > 0)
                                @for($i=0;$i<4-$k; $i++)
                                    <tr>
                                        <td>二级菜单：{{$k+$i+2}}</td>
                                        <td>
                                            <select class="am-form-field am-radius" name="menus[{{$key}}][buttons][{{$k+$i+1}}][type]">
                                                <option value="click">click</option>
                                                <option value="view">view</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="menus[{{$key}}][buttons][{{$k+$i+1}}][name]" value="" class="am-form-field am-radius">
                                        </td>
                                        <td>
                                            <input type="text" name="menus[{{$key}}][buttons][{{$k+$i+1}}][key]" value="" class="am-form-field am-radius">
                                        </td>
                                    </tr>
                                @endfor
                            @endif

                            </tbody>
                        </table>

                    </div>
                    @endforeach

                </div>
            </div>

            <div class="am-margin">
                <button type="submit" class="am-btn am-btn-primary am-btn-xs">保存</button>
            </div>

        </form>
    </div>

@stop
