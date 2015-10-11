@if (count($errors) > 0)
<div class="am-panel am-panel-default">
    <div class="am-panel-bd">
        <div class="am-alert am-alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif
