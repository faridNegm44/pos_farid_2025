<script>
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
                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 4);
                alertify.error("هناك شيئ ما خطأ");

                document.querySelector('.modal #save').disabled = false;
                document.querySelector('.spinner_request').style.display = 'none';                

                $.each(res.responseJSON.errors, function (index , value) {
                    $(`form #errors-${index}`).css('display' , 'block').text(value);
                });
            },
            success: function(res){
                $('#example1').DataTable().ajax.reload( null, false );
                $(".modal form bold[class=text-danger]").css('display', 'none');
        
                $(".dataInput").val('');
                $('.dataInput:first').select().focus();

                document.querySelector('.modal #save').disabled = false;
                document.querySelector('.spinner_request').style.display = 'none';

                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 4);
                alertify.success("تمت الإضافة بنجاح");

            }
        });
    });



</script>