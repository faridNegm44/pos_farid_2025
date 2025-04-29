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
            },
            success: function(res){
                if (res.countBigThanOne) {
                    alertify.set('notifier', 'position', 'top-center');
                    alertify.set('notifier', 'delay', 8);
                    alertify.warning(res.message);

                    $('#firstPeriodCountSection').fadeOut();
                    $('#small_unit_numbers_section').fadeOut();

                } else {
                    $('#firstPeriodCountSection').fadeIn();
                    $('#small_unit_numbers_section').fadeIn();
                }
                
                const store = $('#store')[0].selectize;
                const company = $('#company')[0].selectize;
                const category = $('#category')[0].selectize;
                const bigUnit = $('#bigUnit')[0].selectize;
                const smallUnit = $('#smallUnit')[0].selectize;
                const status = $('#status')[0].selectize;
                
                store.setValue(res.product.store);
                company.setValue(res.product.company);
                category.setValue(res.product.category);
                bigUnit.setValue(res.product.bigUnit);
                smallUnit.setValue(res.product.smallUnit);
                status.setValue(res.product.status);
                
                $('.modal form #shortCode').val(res.product.shortCode);
                $('.modal form #natCode').val(res.product.natCode);
                $('.modal form #nameAr').val(res.product.nameAr);
                $('.modal form #nameEn').val(res.product.nameEn);
                $('.modal form #stockAlert').val(display_number_js(res.product.stockAlert));
                $('.modal form #discountPercentage').val(display_number_js(res.product.discountPercentage));
                $('.modal form #tax').val(display_number_js(res.product.tax));
                $('.modal form #firstPeriodCount').val(display_number_js(res.product.firstPeriodCount));
                $('.modal form #small_unit_numbers').val(display_number_js(res.product.small_unit_numbers));
                $('.modal form #sell_price_small_unit').val(display_number_js(res.product.sell_price_small_unit));
                $('.modal form #last_cost_price_small_unit').val(display_number_js(res.product.last_cost_price_small_unit));
                $('.modal form #max_sale_quantity').val(display_number_js(res.product.max_sale_quantity));
                $('.modal form #desc').val(res.product.desc);
                $('.modal form #offerDiscountStatus').val(res.product.offerDiscountStatus);
                $('.modal form #offerDiscountPercentage').val(display_number_js(res.product.offerDiscountPercentage));
                $('.modal form #offerStart').val(res.product.offerStart);
                $('.modal form #offerEnd').val(res.product.offerEnd);
                $('.modal form #image_hidden').val(res.product.image);
                $('.modal form #res_id').val(res.product.id);


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
                alertify.error("هناك شيئ ما خطأ");
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