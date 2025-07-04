<script>
    ///////////////////////////////// edit /////////////////////////////////
    $(document).on("click" , "#example1 tr .edit" ,function(){
        const res_id = $(this).attr("res_id");

        $.ajax({
            url: `{{ url($pageNameEn) }}/edit/${res_id}`,
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
                    $(".modal").modal('hide');  

                }else{
                    document.querySelector("#res_id").value = res_id;

                    $.each(res , function(index, value){                    
                        $(`.modal form #${index}`).val(value);
                    });
                    
                    $(`.modal form #code`).val(res.code);
                    $("#debtor_value").css('display', 'none');
                    $("#creditor_value").css('display', 'none');
                    $("#hide_cash").toggle(res.type_payment === 'آجل');

                    $(`#image_preview_form`).attr('src', `{{ url('back/images/clients') }}/${res.image}`);
                    document.querySelector("#image_preview_form").src = `{{ url('back/images/clients') }}/${res.image}`;
                    document.querySelector("#image_hidden").value = res.image;

                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 2);
                    alertify.success("تم استرجاع البيانات بنجاح");
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
                alertify.error("هناك شيئ ما خطأ");
            },
            success: function(res){
                document.querySelector('.modal #update').disabled = false;
                document.querySelector('.spinner_request2').style.display = 'none';

                if(res.errorChangeTypePayment){
                    alert(res.errorChangeTypePayment);
                }else{
                    $('#example1').DataTable().ajax.reload( null, false );
                    $(".modal form bold[class=text-danger]").css('display', 'none');
            
                    $(".dataInput").val('');
                    $(".modal").modal('hide');
    
                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 3);
                    alertify.success("تم التعديل بنجاح");
                }
            }
        });
    });
</script>