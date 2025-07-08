<div class="row" style="margin-bottom: 10px;margin-bottom: 15px;">
    <div class="col-xs-6 text-left">
        <img src="{{ asset('back/images/settings/'.GeneralSettingsInfo()->fav_icon) }}" alt="" style="width: 150px;height: 60px;margin-top: -12px; margin-bottom: 7px;">
        <div>
            <span>{{ GeneralSettingsInfo()->phone1  }}</span> 
            <span style="margin: 0 10px;">{{ GeneralSettingsInfo()->phone2 ?? '' }}</span>
        </div>
    </div>

    <div class="col-xs-6 text-right">
        <div style="padding-top: 10px;">
            <div>المستخدم: {{ auth()->user()->name  }}</div>
            تاريخ الطباعة: {{ date('Y-m-d') }} <span style="font-size: 16px;font-weight: bold;">{{ date('h:i a') }}</span>
            <div>العنوان: {{ GeneralSettingsInfo()->address  }}</div>            
        </div>
    </div>
    
</div>