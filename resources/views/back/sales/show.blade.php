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

                let bill_status = res[0].status;
                if(bill_status == 'فاتورة ملغاة'){
                    bill_status = `<span class="text-danger">${bill_status}</span>`;
                }else if(bill_status == 'فاتورة نشطة'){
                    bill_status = `<span class="text-success">${bill_status}</span>`;
                }else{
                    bill_status = `<span class="text-warning">${bill_status}</span>`;
                }
                
                $("#showProductsModal #exampleModalLongTitle").html(`
                    عرض فاتورة مبيعات رقم 
                    ( ${res[0].id} ) - 
                    ( ${res[0].clientName} ) - 
                    ${bill_status}
                     
                `);

                //console.log(display_number_js( res[0].total_bill_after ));

                $.each(res[0] , function(index, value){                    
                    $(`#showProductsModal #header #${index}`).text(value);
                });
                
                $(`#showProductsModal #header #count_items`).text( display_number_js(res[0].count_items) );
                $(`#showProductsModal .print`).attr('res_id', res[0].id);
                
                //$(`#showProductsModal #header #remaining_money`).text(  
                //    res[0].remaining_money >= 0 ? 
                //        'علية ' + display_number_js(res[0].remaining_money) : 
                //        'لة ' + display_number_js(res[0].remaining_money) 
                //);



                $(`#showProductsModal #header #treasury_type`).text( res[0].treasury_type != res[0].bill_type ? res[0].treasury_type : 'لم يتم صرف مستحقات' );
                $(`#showProductsModal #header #bill_type`).text( res[0].bill_type );
                $(`#showProductsModal #header #bill_discount`).text( res[0].bill_discount ? display_number_js(res[0].bill_discount) : 0 );
                $(`#showProductsModal #header #extra_money`).text( res[0].extra_money ? display_number_js(res[0].extra_money) : 0 );
                $(`#showProductsModal #header #treasury_money_after`).text(display_number_js( res[0].treasury_money_after ));
                $(`#showProductsModal #header #amount_money`).text( res[0].amount_money ? display_number_js(res[0].amount_money) : 'لم يتم صرف مستحقات' );
                $(`#showProductsModal #header #treasuryName`).text( res[0].treasuryName ?? 'لم يتم صرف مستحقات' );
                $(`#showProductsModal #header #count_items`).text( display_number_js(res[0].count_items) );
                $(`#showProductsModal #header #total_bill_before`).text( display_number_js(res[0].total_bill_before) );
                $(`#showProductsModal #header #total_bill_after`).text( display_number_js(res[0].total_bill_after) );

                
                // start loop to bill products
                $.each(res, function(index2, value2){

                    if(@json(userPermissions()->cost_price_view)){
                        var cost_price_permission  = `
                            <td>${display_number_js( value2.last_cost_price_small_unit )}</td>
                        `;
                    }else{
                        var cost_price_permission  = '';
                    }

                    let rowClass = '';
                    const checkBillStatus = value2.status;

                    if(checkBillStatus == 'فاتورة ملغاة'){
                        rowClass = 'bg bg-danger-transparent';

                    }else if(checkBillStatus == 'فاتورة نشطة'){                        
                        rowClass = 'bg bg-success-transparent';

                    }else if(checkBillStatus == 'فاتورة معدلة'){
                        rowClass = 'bg bg-warning-transparent';
                
                    }else{
                        rowClass = 'bg bg-info-transparent';
                    }

                    $('#showProductsModal #content tbody').append(`
                        <tr class="${rowClass}">
                            <td>${value2.product_id}</td>
                            <td>${value2.productNameAr}</td>
                            <td>
                                ${display_number_js( value2.bigUnitName ? (value2.product_bill_quantity / value2.small_unit_numbers).toFixed(2) : value2.product_bill_quantity )} 
                                ${value2.bigUnitName ? value2.bigUnitName : value2.smallUnitName}
                            </td>
                            <td>${ display_number_js( value2.product_bill_quantity )} ${value2.smallUnitName}</td>
                            ${cost_price_permission}
                            <td>
                                ${
                                    value2.sell_price_small_unit == value2.current_sell_price_in_sale_bill 
                                    ? display_number_js(value2.sell_price_small_unit) 
                                    : `
                                        <span class="text-danger" style="margin: 0px 3px;font-size: 12px !important;">
                                            (${display_number_js(value2.sell_price_small_unit)})
                                        </span>

                                        ${display_number_js(value2.current_sell_price_in_sale_bill)} 
                                    `
                                }

                            </td>
                            <td>${display_number_js( value2.discount )}</td>
                            <td>${display_number_js( value2.tax )}</td>
                            <td>${display_number_js( value2.total_before )}</td>
                            <td>${display_number_js( value2.total_after )}</td>
                        </tr>
                    `);
                });
                // end loop to bill products

                
                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 3);
                alertify.success("تم استرجاع بيانات الفاتورة بنجاح");
            }
        });

    });
</script>