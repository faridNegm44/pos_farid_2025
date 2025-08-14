<script>
    ///////////////////////////////// edit /////////////////////////////////
    $(document).on("click" , "#example1 tr .add_extra_money" ,function(){
        const res_id = $(this).attr("res_id");

        $.ajax({
            url: `{{ url($pageNameEn) }}/get_extra_money/${res_id}`,
            type: 'GET',
            dataType: 'json',
            beforeSend: function(){
                $(".dataInput").val('');
            },
            success: function(res){
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
                    $("#addExtraMoney").modal('hide');  

                }else{
                    
                    $(`#addExtraMoney #extra_money_type`).val(res.extra_expense.extra_money_type);
                    $(`#addExtraMoney #extra_money`).val( res.extra_expense.extra_money ? display_number_js(res.extra_expense.extra_money) : '' );
    
                    document.querySelector("#addExtraMoney form #res_id_extra_money").value = res_id;
                    
                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 4);
                    alertify.success("تم استرجاع بيانات المصروف الإضافي المسجّل مسبقًا لهذه الفاتورة بنجاح ✅ ان وجد");
                }
            }
        });

    });


    


    ///////////////////////////////// update /////////////////////////////////
    $("#addExtraMoney #update").click(function(e){
        e.preventDefault();
        document.querySelector('#addExtraMoney #update').disabled = true;        
        document.querySelector('.spinner_request').setAttribute("style", "display: inline-block;");

        const res_id = $("#addExtraMoney #res_id_extra_money").val();
        
        $.ajax({
            url: `{{ url($pageNameEn) }}/update_extra_money/${res_id}`,
            type: 'POST',
            processData: false,
            contentType: false,
            data: new FormData($('#addExtraMoney #form')[0]),
            beforeSend:function () {
                $('form [id^=errors]').text('');
            },
            error: function(res){
                $.each(res.responseJSON.errors, function (index , value) {
                    $(`form #errors-${index}`).css('display' , 'block').text(value);
                });               
                
                $('.dataInput:first').select().focus();
                document.querySelector('#addExtraMoney #update').disabled = false;
                document.querySelector('.spinner_request').style.display = 'none';                

                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 3);
                alertify.error("عذرًا، حدث خطأ أثناء العملية ⚠️ يُرجى المحاولة مرة أخرى 🔄");
            },
            success: function(res){
                $('#example1').DataTable().ajax.reload( null, false );
                $("#addExtraMoney form bold[class=text-danger]").css('display', 'none');
        
                $(".dataInput").val('');
                $("#addExtraMoney").modal('hide');

                document.querySelector('#addExtraMoney #update').disabled = false;
                document.querySelector('.spinner_request').style.display = 'none';

                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 3);
                alertify.success("تم تعديل المصروف الإضافي بنجاح 💰");
            }
        });
    });
</script>