<script>
    ///////////////////////////////// edit /////////////////////////////////
    $(document).on("click" , "#example1 tr .edit" ,function(){
        const res_id = $(this).attr("res_id");
        $(".modal form #res_id").val(res_id);

        $.ajax({
            url: `{{ url($pageNameEn) }}/edit/${res_id}`,
            type: 'GET',
            dataType: 'json',
            beforeSend: function(){
                $(".dataInput").val('');
                $(`form #sub_category option`).remove();
            },
            success: function(res)
            {
                if(res.notAuth){
                    alertify.dialog('alert')
                        .set({transition:'slide',message: `
                            <div style="text-align: center;">
                                <p style="color: #e67e22; font-size: 18px; margin-bottom: 10px;">
                                    صلاحية غير متوفرة 🔐⚠️
                                </p>
                                <p>${res.notAuth}</p>
                            </div>
                        `, 'basic': true})
                        .show();  
                    $(".modal").modal('hide');  

                }else{
                    alertify.set('notifier','delay', 3);
                    alertify.success("تم استرجاع بيانات السلعة/الخدمة بنجاح");
                    
                    if (res.countBigThanOne) {
                        alertify.set('notifier', 'position', 'top-center');
                        alertify.set('notifier', 'delay', 8);
                        alertify.warning(res.message);
    
                        $('#firstPeriodCountSection :input').prop('readonly', true);
                        $('#small_unit_numbers_section :input').prop('readonly', true);
                        
                    } else {
                        $('#firstPeriodCountSection :input').prop('readonly', false);
                        $('#small_unit_numbers_section :input').prop('readonly', false);
                    }

                    alertify.set('notifier','position', 'top-center');
                    
                    if(res.main_and_sub_category){
                        $.each(res.main_and_sub_category, function(indexSub, valueSub){
                            $(`form #sub_category`).append(`
                                <option value="${valueSub.id}">${valueSub.name_sub_category}</option>
                            `);
                        });
                    }
                    
                    $('.modal form #type').val(res.product.productType);
                    $('.modal form #sub_category').val(res.product.sub_category);
                    $('.modal form #shortCode').val(res.product.shortCode);
                    $('.modal form #category').val(res.product.category);
                    $('.modal form #natCode').val(res.product.natCode);
                    $('.modal form #nameAr').val(res.product.nameAr);
                    $('.modal form #nameEn').val(res.product.nameEn);
                    $('.modal form #stockAlert').val(res.product.stockAlert ? display_number_js(res.product.stockAlert) : '');
                    $('.modal form #discountPercentage').val(res.product.discount ? display_number_js(res.product.discount) : '');
                    $('.modal form #type_tax').val(res.product.type_tax);
                    $('.modal form #tax').val(res.product.tax ? display_number_js(res.product.tax) : '');
                    $('.modal form #firstPeriodCount').val( res.product.firstPeriodCount ? display_number_js(res.product.firstPeriodCount) : '');
                    $('.modal form #small_unit_numbers').val( res.product.small_unit_numbers ? display_number_js(res.product.small_unit_numbers) : '');
                    $('.modal form #sell_price_small_unit').val( res.product.sell_price_small_unit ? display_number_js(res.product.sell_price_small_unit) : '');
                    $('.modal form #last_cost_price_small_unit').val( res.product.last_cost_price_small_unit ? display_number_js(res.product.last_cost_price_small_unit) : '');
                    $('.modal form #max_sale_quantity').val( res.product.max_sale_quantity ? display_number_js(res.product.max_sale_quantity) : '');
                    $('.modal form #status').val(res.product.status);
                    $('.modal form #desc').val(res.product.desc);
                    $('.modal form #offerDiscountStatus').val(res.product.offerDiscountStatus);
                    $('.modal form #offerDiscountPercentage').val( res.product.offerDiscountPercentage ? display_number_js(res.product.offerDiscountPercentage) : '');
                    $('.modal form #offerStart').val(res.product.offerStart);
                    $('.modal form #offerEnd').val(res.product.offerEnd);
                    $('.modal form #image_hidden').val(res.product.image);
                    $('.modal form #res_id').val(res.product.product_id);
    
                    const storeSelectize = $('#store')[0].selectize;
                    storeSelectize.setValue(res.product.store);
                    
                    const companySelectize = $('#company')[0].selectize;
                    companySelectize.setValue(res.product.company);
                    
                    const bigUnitSelectize = $('#bigUnit')[0].selectize;
                    bigUnitSelectize.setValue(res.product.bigUnit);
                    
                    const smallUnitSelectize = $('#smallUnit')[0].selectize;
                    smallUnitSelectize.setValue(res.product.smallUnit);
                }
            }
        });
    });


    


    ///////////////////////////////// update /////////////////////////////////
    $(".modal #update").click(function(e){
        e.preventDefault();
        document.querySelector('.modal #update').disabled = true;        
        document.querySelector('.spinner_request2').setAttribute("style", "display: inline-block;");


        const res_id = $(".modal form #res_id").val();
        $.ajax({
            url: `{{ url($pageNameEn) }}/update/${res_id}`,
            type: 'POST',
            processData: false,
            contentType: false,
            data: new FormData($('.modal #form')[0]),
            beforeSend:function () {
                $('form [id^=errors]').text('');
            },
            error: function(res){
                $.each(res.responseJSON.errors, function (index , value) {
                    $(`form #errors-${index}`).css('display' , 'block').text(value);
                });               
                
                $('.dataInput:first').select().focus();
                document.querySelector('.modal #update').disabled = false;
                document.querySelector('.spinner_request2').style.display = 'none';                

                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 3);
                alertify.error("عذرًا، حدث خطأ أثناء العملية ⚠️ يُرجى المحاولة مرة أخرى 🔄");
            },
            success: function(res){
                $('#example1').DataTable().ajax.reload( null, false );
                $(".modal form bold[class=text-danger]").css('display', 'none');
        
                $(".dataInput").val('');
                $(".modal").modal('hide');

                document.querySelector('.modal #update').disabled = false;
                document.querySelector('.spinner_request2').style.display = 'none';

                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 3);
                alertify.success("تم التعديل بنجاح");
            }
        });
    });
</script>