<script>
    $(document).ready(function () {
        $(".modal #save").click(function(e){
            e.preventDefault();
            document.querySelector('.modal #save').disabled = true;        
            document.querySelector('.spinner_request').setAttribute("style", "display: inline-block;");

            
            const quantity = $("#quantity").val();
            const products_selectize = $("#products_selectize").val();

            if(!quantity || !products_selectize){
                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 4);
                alertify.error("يجب أولاً اختيار المنتج وتحديد الكمية الجديدة له بعد التسوية.");

                document.querySelector('.modal #save').disabled = false;
                document.querySelector('.spinner_request').style.display = 'none';               

            }else{
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
                        
                        document.querySelector('.modal #save').disabled = false;
                        document.querySelector('.spinner_request').style.display = 'none';                
    
                        alertify.set('notifier','position', 'top-center');
                        alertify.set('notifier','delay', 3);
                        alertify.error("هناك شيئ ما خطأ");
                    },
                    success: function(res){
                        $('#example1').DataTable().ajax.reload( null, false );
                        $(".modal form bold[class=text-danger]").css('display', 'none');

                        $(".dataInput").val('');
    
                        location.reload();
                        $('#save').hide();
                        
                        document.querySelector('.modal #save').disabled = false;
                        document.querySelector('.spinner_request').style.display = 'none';
    
                        alertify.set('notifier','position', 'top-center');
                        alertify.set('notifier','delay', 3);
                        alertify.success("تمت تسوية المنتج بنجاح");
                    }
                });
            }
        });
    });

</script>