@extends('layouts.admin')
@section('content')
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf">
            <strong class="am-text-primary am-text-lg">会员管理</strong> / <small>会员列表</small>
        </div>
    </div>

    @include('layouts._message')

    <div class="am-g">

    </div>

    <div class="am-g">
        <div class="am-u-sm-12">
            <form class="am-form">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                        <tr>
                            <th>编号</th>
                            <th>头像</th>
                            <th>昵称</th>
                            <th>openid</th>
                            <th>性别</th>
                            <th class="am-hide-sm-only">关注时间</th>
                            <th class="table-set">操作</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td class="brand_logo"><img src="{{ $user->headimgurl }}" alt="" class="am-radius" style="max-width: 50px;"/></td>
                            <td>{{ $user->nickname }}</td>
                            <td>{{ $user->openid }}</td>

                            <td class="am-hide-sm-only">
                                @if($user->sex == 1)
                                    <span class="am-icon-male"></span>
                                @else
                                    <span class="am-icon-female"></span>
                                @endif
                            </td>
                            <td>{{ $user->created_at }}</td>

                            <td>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="{{ route('admin.user.edit', $user->id) }}">
                                            <span class="am-icon-list-alt"></span> 查看订单
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
                        {!! $users->render() !!}
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>
@stop

@section('js')
<script type="text/javascript">

</script>
@stop
