<script>
    ///////////////////////////////// show /////////////////////////////////
    $(document).on("click" , "#example1 tr .show" ,function(){
        const res_id = $(this).attr("res_id");

        $.ajax({
            url: `{{ url($pageNameEn) }}/show/${res_id}`,
            type: 'GET',
            dataType: 'json',
            beforeSend: function(){
                $(".header_span").text('');
                $("#showProductsModal #content tbody tr").remove();
                $(`#showProductsModal .print`).attr('res_id', '');
            },
            success: function(res){
                $('#showProductsModal .modal-body').slideDown();

                $.each(res[0] , function(index, value){                    
                    $(`#showProductsModal #header #${index}`).text(value);
                });
                
                $(`#showProductsModal #header #count_items`).text( display_number_js(res[0].count_items) );
                $(`#showProductsModal .print`).attr('res_id', res[0].id);
                
                $(`#showProductsModal #header #remaining_money`).text(  
                    res[0].remaining_money > 0 ? 
                        'علية ' + display_number_js(res[0].remaining_money) : 
                        'لة ' + display_number_js(res[0].remaining_money) 
                );
                

                // start loop to bill products
                let totalBillBefore = 0;
                let totalBillAfter = 0;
                $.each(res, function(index2, value2){
                    $('#showProductsModal #content tbody').append(`
                        <tr>
                            <td>${value2.product_id}</td>
                            <td>${value2.productNameAr}</td>
                            <td>
                                ${display_number_js( value2.bigUnitName ? value2.product_bill_quantity / value2.small_unit_numbers : value2.product_bill_quantity )} 
                                ${value2.bigUnitName ? value2.bigUnitName : value2.smallUnitName}
                            </td>
                            <td>${display_number_js( value2.product_bill_quantity )} ${value2.smallUnitName}</td>
                            <td>${display_number_js( value2.last_cost_price_small_unit )}</td>
                            <td>${display_number_js( value2.sell_price_small_unit )}</td>
                            <td>${display_number_js( value2.tax )}</td>
                            <td>${display_number_js( value2.discount )}</td>
                            <td>${display_number_js( value2.total_before )}</td>
                            <td>${display_number_js( value2.total_after )}</td>
                        </tr>
                    `);

                    totalBillBefore += parseFloat(value2.total_before);
                    totalBillAfter += parseFloat(value2.total_after);
                });

                $(`#showProductsModal #header #total_bill_before`).text( display_number_js(totalBillBefore) );
                $(`#showProductsModal #header #total_bill_after`).text( display_number_js(totalBillAfter) );
                // end loop to bill products

                
                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 3);
                alertify.success("تم استرجاع بيانات الفاتورة بنجاح");
            }
        });

    });
</script>