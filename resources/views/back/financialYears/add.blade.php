<script>
    $(document).ready(function () {
        $(".modal #save").click(function(e){
            e.preventDefault();
            document.querySelector('.modal #save').disabled = true;        
            document.querySelector('.spinner_request').setAttribute("style", "display: inline-block;");

            
            $.ajax({
                url: "{{ url($pageNameEn) }}/store",
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
                    document.querySelector('.modal #save').disabled = false;
                    document.querySelector('.spinner_request').style.display = 'none';                

                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 3);
                    alertify.error("هناك شيئ ما خطأ");
                },
                success: function(res){
                    if(res.notAuth){
                        alertify.dialog('alert')
                            .set({transition:'slide',message: `
                                <div style="text-align: center;font-weight: bold;">
                                    <p style="color: #e67e22; font-size: 18px; margin-bottom: 10px;">
                                        صلاحية غير متوفرة 🔐⚠️
                                    </p>
                                    <p>${res.notAuth}</p>
                                </div>
                            `, 'basic': true})
                            .show();  
                        $(".modal").modal('hide');  

                    }else{
                        if(res.foundedActiveFinYear){
                            alertify.set('notifier','position', 'top-center');
                            alertify.set('notifier','delay', 5);
                            alertify.warning("خطأ: هناك سنة مالية لم تقفل بعد");
                        }else{
                            
                            $('#example1').DataTable().ajax.reload( null, false );
                            $(".modal form bold[class=text-danger]").css('display', 'none');
                    
                            $(".dataInput").val('');
                            $(".modal").modal('hide');
    
                            alertify.set('notifier','position', 'top-center');
                            alertify.set('notifier','delay', 3);
                            alertify.success("تمت الإضافة بنجاح");
                        }
                    }

                    document.querySelector('.modal #save').disabled = false;
                    document.querySelector('.spinner_request').style.display = 'none';
                }
            });
        });

    });

</script>