<div class="row" style="margin-bottom: 10px;">
    <div class="col-xs-6 text-left">
        <img src="{{ asset('back/images/settings/'.GeneralSettingsInfo()->logo) }}" alt="" style="width: 150px;height: 50px;margin-top: -12px; margin-bottom: 7px;">
        <div>
            <span>{{ GeneralSettingsInfo()->phone1  }}</span> 
            <span style="margin: 0 10px;">{{ GeneralSettingsInfo()->phone2 ?? '' }}</span>
        </div>
    </div>

    <div class="col-xs-6 text-right">
        <div style="padding-top: 10px;">
            <div>{{ GeneralSettingsInfo()->address  }}</div>
            
            <div>المستخدم: {{ auth()->user()->name  }}</div>
            {{ date('d-m-Y') }} <span style="font-size: 16px;">{{ date('h:i a') }}</span>
        </div>
    </div>
    
</div>