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

                    document.querySelector('.modal #save').disabled = false;
                    document.querySelector('.spinner_request').style.display = 'none';

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
                        if(res.error){
                            alertify.set('notifier','position', 'top-center');
                            alertify.set('notifier','delay', 6);
                            alertify.warning(`مبلغ المصروف اكبر من المبلغ الموجود بالخزينة`);
    
                        }else{                    
                            $(".modal").modal('hide');
                            location.reload();
    
                            alertify.set('notifier','position', 'top-center');
                            alertify.set('notifier','delay', 3);
                            alertify.success("تمت الإضافة بنجاح");
                        }
                    }

                }
            });
        });

    });

</script>