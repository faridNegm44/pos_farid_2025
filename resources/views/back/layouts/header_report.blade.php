<div class="row" style="margin-bottom: 20px; border-bottom: 2px solid #ccc; padding-bottom: 10px;">
    <div class="col-xs-6 text-left">
        <img src="{{ asset('back/images/settings/'.GeneralSettingsInfo()->fav_icon) }}" alt="Logo"
             style="height: 60px;">
        <div><strong>📞 هاتف:</strong> {{ GeneralSettingsInfo()->phone1 }} {{ GeneralSettingsInfo()->phone2 ? ' - ' . GeneralSettingsInfo()->phone2 : '' }}</div>
    </div>

    <div class="col-xs-6 text-right" style="padding-top: 10px;">
        <div><strong>👤 المستخدم:</strong> {{ auth()->user()->name }}</div>
        <div><strong>🗓️ تاريخ الطباعة:</strong> {{ date('Y-m-d') }} <span style="font-weight: bold;">{{ date('h:i A') }}</span></div>
        <div><strong>📍 العنوان:</strong> {{ GeneralSettingsInfo()->address }}</div>
    </div>
</div>
