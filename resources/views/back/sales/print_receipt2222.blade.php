<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>{{ $pageNameAr }} {{ $saleBill[0]->id }} - {{ $saleBill[0]->clientName }} - {{ $saleBill[0]->created_at }}</title>
  <style>
    body {
      /*font-family: 'Tahoma', sans-serif;*/
      /*font-family: 'Courier New', monospace;*/
      margin: 20px;
      margin-bottom: 35px;
      color: #000;
      

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
      
      border: 1px dashed #000;
      border-radius: 5px;
      padding: 4px 8px;
    }
    
    .date_info {
      
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
      
      font-size: 11px;
    }

    .totals_section td.value {
      font-size: 13px;
      
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
      padding: 4px 0;
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

      @page {
        margin: 5px;
      }

    body {
      margin: 5px !important;
      padding: 5px !important;
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
    <span>اسم العميل: {{ $saleBill[0]->clientName }}</span>
    <br />
    <span>عنوان العميل: {{ $saleBill[0]->clientAddress }}</span>
    <br />
    <span>تليفون العميل: {{ $saleBill[0]->clientPhone }}</span>
    <br />
  </div>

  <!-- Invoice Info -->
  <div class="invoice_info">
    <div>رقم الفاتورة: {{ $saleBill[0]->id }}</div>
    <div>عدد السلع والخدمات: {{ display_number( $saleBill[0]->count_items ) }}</div>
  </div>

  <!-- Table -->
  <div class="table_info">
    <table style="width: 100%;">
      <thead class="bg bg-black-5">
          <tr>
            <th>السلعة/الخدمة</th>
            <th>الوحدة</th>
            <th>الكمية</th>
            <th>السعر</th>
            <th>الإجمالي</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($saleBill as $product)
            <tr>
              <td>{{ $product->productName }}</td>
              <td>{{ $product->unitName }}</td>
              <td>{{ display_number( $product->product_bill_quantity ) }}</td>
              <td>
                @if ($product->sell_price_small_unit == $product->current_sell_price_in_sale_bill)
                  {{ display_number( $product->sell_price_small_unit ) }}
                  @else
                  {{ display_number( $product->current_sell_price_in_sale_bill ) }}
                  @endif
              </td>
              <td>{{ display_number( $product->productTotalAfter ) }}</td>
            </tr>  
          @endforeach
          
        </tbody>
      </table>      
  </div>

  <!-- Totals -->
  <div class="totals_section">
    <table>
      <tr>
        <td class="label">الإجمالي قبل</td>
        <td class="value">{{ display_number( $saleBill[0]->total_bill_before ) }} جنية</td>
      </tr>
      @if ($saleBill[0]->extra_money)
        <tr>
          <td class="label">مصاريف اضافية</td>
          <td class="value">{{ display_number( $saleBill[0]->extra_money ) }} جنية</td>
        </tr>
      @endif
      @if ($saleBill[0]->total_bill_before != $saleBill[0]->total_bill_after)
        <tr>
          <td class="label">قيمة الخصم</td>
          <td class="value">{{ display_number( $saleBill[0]->total_bill_before - $saleBill[0]->total_bill_after ) }} جنية</td>
        </tr>
      @endif
      <tr>
        <td class="label final_total" style="font-size: 14px;">الإجمالي بعد</td>
        <td class="value" style="font-size: 18px;">{{ display_number( $saleBill[0]->total_bill_after ) }} جنية</td>
      </tr>
    </table>
  </div>

  <div class="date_info">
    <div>تاريخ الفاتورة: {{ \Carbon\Carbon::parse($saleBill[0]->created_at)->format('Y-m-d h:i:s a') }}</div>
    <div>تاريخ الطباعة: {{ date('Y-m-d h:i:s a') }}</div>
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
