<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>فاتورة</title>
  <style>
    body {
      /*font-family: 'Tahoma', sans-serif;*/
      /*font-family: 'Courier New', monospace;*/
      margin: 20px;
      margin-bottom: 35px;
      color: #000;
      font-weight: bold;

    }

    /*td:nth-child(3),
    td:nth-child(4),
    td:nth-child(5),
    th:nth-child(3),
    th:nth-child(4),
    th:nth-child(5) {
        font-family: 'Roboto Mono', monospace;
    }*/

    .header, .customer_info, .invoice_info {
      margin-bottom: 10px;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 2px solid #000;
      padding-bottom: 3px;
    }

    .header .logo img{
      width: 50px;
      height: 50px;
      background-color: #ddd;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 14px;
    }

    .header .place_info {
      flex: 1;
      text-align: center;
      margin: 0 5px;
    }

    .place_info h2 {
      margin: 0;
      font-size: 18px;
      text-decoration: underline;
      margin-bottom: 4px;
    }

    .place_info p {
      margin: 1px 0;
      font-size: 11px;
    }

    .customer_info, .invoice_info {
      font-size: 12px;
      /*border: 1px dashed #000;*/
      padding: 0 8px;
    }

    .invoice_info {
      display: flex;
      justify-content: space-between;
      font-weight: bold;
      border: 1px dashed #000;
      border-radius: 5px;
      padding: 4px 8px;
    }
    
    .date_info {
      font-weight: bold;
      font-size: 9px;
      text-align: center;
      padding-top: 5px;
      font-family: 'Roboto Mono', monospace;
    }

    .table_info table,
    .table_info th,
    .table_info td {
      border: 1px solid #000;
      border-collapse: collapse;
      text-align: center;
      font-size: 11px;
      padding: 1px 3px;
    }

    .table_info thead th {
      background-color: #dee2e6;
    }

    .totals_section {
      margin-top: 15px;
      font-size: 14px;
    }

    .totals_section table {
      width: 100%;
      /*border-collapse: collapse;*/
    }

    .totals_section td {
      /*padding: 4px 8px;*/
      border: 1px solid #000;
      text-align: right;
    }

    .totals_section td.label {
      font-weight: bold;
      font-size: 11px;
    }

    .totals_section td.value {
      font-size: 13px;
      font-weight: bold;
    }

    .policy_section {
      margin-top: 15px;
      border: 1px dashed #000;
      border-radius: 8px;
      padding: 0 8px;
      font-size: 11.5px;
      line-height: 1.5;
    }
    
    .footer_section {
        text-align: center;
        margin-top: 10px;
        /*border: 1px dashed #000;*/
        /*padding: 0 8px;*/
        font-size: 12px;
    }

    .company_info {
      margin-top: 15px;
      text-align: center;
      font-size: 8px;
      border-top: 2px solid #000;
      border-bottom: 1px solid #ccc;
      padding: 4px 0 7px;
    }

    .table_info thead th {
        background-color: #a5a5a5 !important;
    }

    .totals_section .final_total {
    background-color: #a5a5a5 !important;
    }
    
    @media print {
      body {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }

      .table_info thead th {
        background-color: #a5a5a5 !important;
      }

      .totals_section .final_total {
        background-color: #a5a5a5 !important;
      }

      .header {
        page-break-before: avoid;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="header">
    {{--<div class="logo">
        @if (GeneralSettingsInfo()->fav_icon)
            <img src="{{ url('back/images/settings/'.GeneralSettingsInfo()->fav_icon) }}" />
        @endif
    </div>--}}
    <div class="place_info">
      <h2>{{ GeneralSettingsInfo()->app_name }}</h2>
      <p>{{ GeneralSettingsInfo()->address }}</p>
      <p>{{ GeneralSettingsInfo()->phone1 }} - {{ GeneralSettingsInfo()->phone2 ?? GeneralSettingsInfo()->phone1 }}</p>
    </div>
  </div>

  <!-- Customer Info -->
  <div class="customer_info">
    <span>اسم العميل: أحمد محمد</span>
    <br />
    <span>عنوان العميل: الجيزة - شارع النيل</span>
    <br />
    <span>تليفون العميل: 0100-555-6666 | 0100-777-8888</span>
    <br />
  </div>

  <!-- Invoice Info -->
  <div class="invoice_info">
    <div>رقم الفاتورة: 1023</div>
    <div>عدد الأصناف: 15</div>
  </div>

  <!-- Table -->
  <div class="table_info">
    <table style="width: 100%;">
        <thead>
          <tr>
            <th>الصنف</th>
            <th>الوحدة</th>
            <th>الكمية</th>
            <th>السعر</th>
            <th>الإجمالي</th>
          </tr>
        </thead>
        <tbody>
          <tr><td>عبوة زيت نباتي نقية ممتازة</td><td>علبة</td><td>2</td><td>120</td><td>240</td></tr>
          <tr><td>كرتونة مسحوق غسيل مركز فعال</td><td>كرتونة</td><td>1</td><td>180</td><td>180</td></tr>
          <tr><td>زجاجة عصير طبيعي بدون مواد حافظة</td><td>كرتونة</td><td>1</td><td>70</td><td>70</td></tr>
          <tr><td>علبة بسكويت بالشوكولاتة للأطفال</td><td>علبة</td><td>5</td><td>30</td><td>150.00</td></tr>
          <tr><td>كيس مكرونة إيطالية عالية الجودة</td><td>علبة</td><td>1</td><td>45</td><td>45</td></tr>
          <tr><td>كرتونة لبن بودرة كامل الدسم</td><td>كرتونة</td><td>2</td><td>90.00</td><td>180</td></tr>
          <tr><td>علبة شاي أخضر طبيعي للتخسيس</td><td>علبة</td><td>3</td><td>40</td><td>120</td></tr>
          <tr><td>كرتونة مياه معدنية نقية باردة</td><td>كرتونة</td><td>4</td><td>65</td><td>260</td></tr>
          <tr><td>كرتونة عصير تفاح طبيعي مركز</td><td>كرتونة</td><td>2</td><td>45</td><td>90</td></tr>
          <tr><td>علبة تمر فاخر معبأ يدويًا</td><td>علبة</td><td>6</td><td>35</td><td>210</td></tr>
          <tr><td>كرتونة صابون طبي معطر للبشرة</td><td>كرتونة</td><td>1</td><td>55</td><td>55</td></tr>
          <tr><td>علبة كاكاو ناعم للتحلية الساخنة</td><td>علبة</td><td>2</td><td>30</td><td>60</td></tr>
          <tr><td>كرتونة دقيق أبيض نقي مخبوز</td><td>كرتونة</td><td>3</td><td>40</td><td>120</td></tr>
          <tr><td>علبة فول سوداني مملح محمص</td><td>علبة</td><td>2</td><td>45</td><td>90</td></tr>
          <tr><td>كرتونة عسل نحل طبيعي أصلي</td><td>كرتونة</td><td>1</td><td>50</td><td>50</td></tr>
        </tbody>
      </table>      
  </div>

  <!-- Totals -->
  <div class="totals_section">
    <table>
      <tr>
        <td class="label">الإجمالي قبل الخصم</td>
        <td class="value">1,320</td>
      </tr>
      <tr>
        <td class="label">قيمة الخصم</td>
        <td class="value">100</td>
      </tr>
      <tr>
        <td class="label">الضريبة</td>
        <td class="value">122</td>
      </tr>
      <tr>
        <td class="label final_total" style="font-size: 14px;">الإجمالي بعد الخصم والضريبة</td>
        <td class="value" style="font-size: 18px;font-weight: bold;">50,000</td>
      </tr>
    </table>
  </div>

  <div class="date_info">
    <div>تاريخ الفاتورة: {{ date('Y-m-d h:m:s a') }}</div>
    <div>تاريخ الطباعة: {{ date('Y-m-d h:m:s a') }}</div>
  </div>

  <!-- Policy -->
  @if(GeneralSettingsInfo()->policy)
    <div class="policy_section">
        {!! GeneralSettingsInfo()->policy !!}
    </div>
  @endif
  
  @if(GeneralSettingsInfo()->footer_text)
    <div class="footer_section">
        {{ GeneralSettingsInfo()->footer_text }}
    </div>
  @endif

  <!-- Company Info -->
  <div class="company_info">
    كيوبكس تك للبرمجيات
    <strong>01117903055 - 01012775704</strong>
  </div>

</body>
</html>
