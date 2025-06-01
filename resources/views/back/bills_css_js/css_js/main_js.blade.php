<script>
    $(document).ready(function(){
        // start focus products_selectize when page load
        setTimeout(function(){
            $("#page_purchases #products_selectize")[0].selectize.focus();
        }, 100);
        // end focus products_selectize when page load
        
        // start focus products_selectize when page load
        setTimeout(function(){
            $("#page_sales #clients")[0].selectize.focus();
        }, 100);
        // end focus products_selectize when page load


        // selectize
        $('.selectize').selectize({
            hideSelected: true
        });
    });
        
    

    // start focus product input search when click altKey + ctrlKey
    $(document).bind('keydown', function(event) {
        if( event.altKey  && event.ctrlKey) {
            $("#products_selectize")[0].selectize.focus();
        }
    });
    // end focus product input search when click altKey + ctrlKey



    $(document).on('input' , '.numValidate', function (e) {
        $(this).val($(this).val().replace(/[^0-9.]/g, ''));

        if (($(this).val().split('.').length - 1) > 1)
            $(this).val($(this).val().substring(0, $(this).val().length - 1));
    });


    // start focus the input[type="number"]
    $(document).on('focus', 'input[type="number"], .focused, .focus_input', function() {
        $(this).select();
    });
    // end focus the input[type="number"]


    // start valid if input[type="number"].val < 1
        //$(document).on('input', 'input[type="number"]', function() {
        //    if ($(this).val() < 1) {
        //        $(this).val(1);
        //    }
        //});
    // end valid if input[type="number"].val < 1

    // start cancel enter button 
        $(document).keypress(function (e) {
            if(e.which == 13){
                e.preventDefault(); 
            }
        });
    // end cancel enter button 
    


    // start get current full date and time
    function showDate() {
        const now = new Date();
        const options = {
            weekday: 'long',
            day: 'numeric',
            month: 'numeric',
            year: 'numeric',
            locale: 'ar' 
        };
        const formattedDateTime = now.toLocaleString('ar-EG', options);
        document.getElementById('date').textContent = formattedDateTime;
    }
    setInterval(showDate, 1000);


    function showTime() {
        const now = new Date();
        const options = {
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric',
            locale: 'ar' 
        };
        const formattedDateTime = now.toLocaleString('ar-EG', options);
        document.getElementById('time').textContent = formattedDateTime;
    }
    setInterval(showTime, 1000);
    // end get current full date and time


    
    // start count table tr
    function countTableTr(){ return $('#products_table tbody tr').length; }
    // end count table tr

    
    // start remove This Tr on table
    function removeThisTr() {
        $(document).on('click', '#products_table tbody tr .remove_this_tr', function (e) { 
            $(this).closest('tr').fadeOut(100, function(){
                $(this).remove();
                $("#countTableTr span").text(countTableTr());

                calcTotal();

                if(countTableTr() < 1){
                    $("#save_bill").fadeOut();
                }
            });    
        });
    }
    // end remove This Tr on table


    // start check if founded val in discount_bill_percentage and static_discount_bill
    $("#discount_bill, #static_discount_bill").on('input', function(){
        const discount_bill = $('#discount_bill');
        const static_discount_bill = $('#static_discount_bill');

        if(countTableTr() > 0){

            if(+discount_bill.val() && +static_discount_bill.val()){
                discount_bill.val('');
                static_discount_bill.val('');

                alertify.set('notifier', 'position', 'bottom-center');
                alertify.set('notifier', 'delay', 4);
                alertify.error("اختر نوعاً واحداً من الخصم على الفاتورة، إما خصماً كنسبة مئوية أو خصماً نقدياً.");
            }
        }else{
            discount_bill.val('');
            static_discount_bill.val('');
            
            alertify.set('notifier', 'position', 'bottom-center');
            alertify.set('notifier', 'delay', 4);
            alertify.error("قم بإضافة أصناف أولا إلي الفاتورة."); 
        }
        
    });
    // end check if founded val in discount_bill_percentage and static_discount_bill
    

    // start open modal calc when click button when click ctrl+/
    $(document).bind('keydown', function(event) {
        if( event.which === 191 && event.ctrlKey ) {
            $('.calc').modal('show');
        }
    });
    // end open modal calc when click button when click ctrl+/


    // start check if product quantity is big zero
    $(document).on('input', '#products_table tbody .product_new_qty', function(){
        const thisVal = $(this);
        if(thisVal.val() < 1){
            thisVal.val(1);
            backgroundRedToSelectError(thisVal);

            alertify.set('notifier','position', 'bottom-center');
            alertify.set('notifier','delay', 3);
            alertify.error("خطأ في كمية المنتج");
        }
    });
    // end check if product quantity is big zero

    
    // start function to add style to inputs error 
    function backgroundRedToSelectError(selector){
        selector.css('background', 'orange');
        setTimeout(() => {
            selector.css('background', 'transparent');
        }, 1500);
    }
    // end function to add style to inputs error 
    
    
    // start function to add style to inputs error 
    function backgroundRedToSelectError2(selector){
        selector.css('background', 'orange');
    }
    // end function to add style to inputs error 
    

    // start when change سعر البيع وربطه بسعر التكلفة
    $(document).on('blur', '.sellPrice', function(){
        const row = $(this).closest('tr');
        const sellPrice = row.find('.sellPrice');
        const last_cost_price = parseFloat( row.find('.last_cost_price_small_unit').val() );
        const avg_cost_price = parseFloat( row.find('.avg_cost_price_small_unit').val() );

        if(sellPrice.val() < last_cost_price){        
            alertify.set('notifier', 'position', 'bottom-center');
            alertify.set('notifier', 'delay', 4);
            alertify.error("خطأ: سعر بيع المنتج أقل من سعر التكلفة");
            
            backgroundRedToSelectError2(sellPrice);
        }else{
            sellPrice.css('background', 'transparent');
        }
    });
    // end when change سعر البيع وربطه بسعر التكلفة


    // start when change sale quantity to check لو الكميه المباعه اكبر من الكميه الموجودة بالمخزن
    // $(document).on('input', '#page_sales .sale_quantity', function(){
    //    const row = $(this).closest('tr');
    //    const sale_quantity = row.find('.sale_quantity');
    //    const quantity_all = row.find('.quantity_all');
        
    //    if(sale_quantity.val() > quantity_all.val()){
    //        sale_quantity.val(1);
    //        backgroundRedToSelectError(sale_quantity);

    //        alertify.set('notifier','position', 'bottom-center');
    //        alertify.set('notifier','delay', 3);
    //        alertify.error("كمية المنتج المباعة أكبر من المتوفرة  في المخزن");
    //    }
    //});
    // end when change sale quantity to check لو الكميه المباعه اكبر من الكميه الموجودة بالمخزن


    // start when change amount_paid
    $('#page_sales .amount_paid').on('input', function(){
        const total_bill_after  = parseFloat($('.total_bill_after').text());
        const amount_paid  = parseFloat($(this).val());

        $('#total_paid').text(`${amount_paid} جنية`);
        $('#remaining').text( (total_bill_after - amount_paid) + ' جنية' );
    });
    // end when change amount_paid


    // start when change prod_units
    $(document).on('input', '.prod_units', function(){
        const selectedOption = $(this).find('option:selected');
        const selectedClass = selectedOption.attr('class');
        
        const small_unit_numbers = $(this).closest('tr').find('.small_unit_numbers').val();
        const quantity_small_unit = $(this).closest('tr').find('.quantity_all');

        const last_cost_price_small_unit = $(this).closest('tr').find('.last_cost_price_small_unit').val();
        const avg_cost_price_small_unit = $(this).closest('tr').find('.avg_cost_price_small_unit');
        const purchasePrice = $(this).closest('tr').find('.purchasePrice');
        const sellPrice = $(this).closest('tr').find('.sellPrice');
        
        
        //$(this).closest('tr').find('.sale_quantity').val('');
        //$(this).closest('tr').find('.product_new_qty').val('');
        
        // check if class selected == big_or_small class
        if(selectedClass == 'big_unit_class'){
            quantity_small_unit.val( parseFloat(quantity_small_unit.val()) / parseFloat(small_unit_numbers) );
            purchasePrice.val( parseFloat(small_unit_numbers) * parseFloat(purchasePrice.val()) );
            sellPrice.val( parseFloat(small_unit_numbers) * parseFloat(sellPrice.val()) );

            calcTotal();
        }else{
            quantity_small_unit.val( parseFloat(quantity_small_unit.val()) * parseFloat(small_unit_numbers) );
            purchasePrice.val( parseFloat(purchasePrice.val()) / parseFloat(small_unit_numbers) );
            sellPrice.val( parseFloat(sellPrice.val()) / parseFloat(small_unit_numbers) );

            calcTotal();
        }
    });
    // end when change prod_units


    // start cancel enter form
    $('form').submit(function(e){
        e.preventDefault();
    });
    // end cancel enter form


    // start check Purchase Price not big than sell price && purchase or sell price not = 0 or null
    //$(document).on('input' , 'tbody tr .purchasePrice, tbody tr .sellPrice' , function () {
    //    const purchasePrice = parseFloat($(this).closest('tr').find('.purchasePrice').val());
    //    const sellPrice = parseFloat($(this).closest('tr').find('.sellPrice').val());

    //    if(!purchasePrice || purchasePrice < 1){
    //        $(this).closest('tr').find('.purchasePrice').addClass('reqInputAddClass');

    //    }else if(!sellPrice || sellPrice < 1){
    //        $(this).closest('tr').find('.sellPrice').addClass('reqInputAddClass');

    //    }else if(purchasePrice > sellPrice){
    //        $(this).closest('tr').find('.purchasePrice').addClass('reqInputAddClass');
    //        $(this).closest('tr').find('.sellPrice').addClass('reqInputAddClass');

    //    }
    //    else{
    //        $(this).closest('tr').find('.purchasePrice').removeClass('reqInputAddClass');
    //        $(this).closest('tr').find('.sellPrice').removeClass('reqInputAddClass');
    //    }

    //    if($(".reqInputAddClass").length > 0){
    //        $('#finally_save_bill_btn').fadeOut();
    //        $('#finally_save_bill_and_print_btn').fadeOut();
    //        $('#modal_save_bill_footer h3').show();
    //    }else{
    //        $('#finally_save_bill_btn').fadeIn();
    //        $('#finally_save_bill_and_print_btn').fadeIn();
    //        $('#modal_save_bill_footer h3').hide();
    //    }
    //});
    // end check Purchase Price not big than sell price && purchase or sell price not = 0 or null

</script>