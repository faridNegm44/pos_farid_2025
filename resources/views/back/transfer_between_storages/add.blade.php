<script>
    $(document).ready(function () {
        $(".modal #save").click(function(e){

            alertify.confirm('انتبه <i class="fas fa-exclamation-triangle text-danger" style="margin: 0px 3px;font-size: 25px;"></i>', '<p class="text-danger text-center" style="font-weight: bold;line-height: 2;"> هل أنت متأكد من عملية التحويل بين الخزنتين</p>', 
                function(){
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

                            $(".modal").modal('hide');
                            
                            alertify.set('notifier','position', 'top-center');
                            alertify.set('notifier','delay', 6);
                            alertify.success(`تم التحويل بنجاح`);
                            
                            location.reload();
                        }
                    });
                },function(){
                    alertify.set('notifier','position', 'bottom-center');
                    alertify.set('notifier','delay', 4);
                    alertify.error("تم الإلغاء");
                }).set({
                    labels:{
                        ok:"نعم <i class='fas fa-check text-success' style='margin: 0px 3px;'></i>",
                        cancel: "لاء <i class='fa fa-times text-light' style='margin: 0px 3px;'></i>"
                    }
            });
        });

    });

</script>