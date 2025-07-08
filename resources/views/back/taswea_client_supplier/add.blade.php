<script>
    $(document).ready(function () {
        $(".modal #save").click(function(e){
            e.preventDefault();
            document.querySelector('.modal #save').disabled = true;        
            document.querySelector('.spinner_request').setAttribute("style", "display: inline-block;");

            
            const new_remaining_money = $("#new_remaining_money").val();
            const client_supplier_id = $("#client_supplier_id").val();

            if(!new_remaining_money || !client_supplier_id){
                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 5);
                alertify.error("👤 من فضلك اختر عميل أو مورد أولاً، ثم قم بتحديد الرصيد الجديد لة بعد التسوية 💰");

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
                        alertify.error("عذرًا، حدث خطأ أثناء العملية ⚠️ يُرجى المحاولة مرة أخرى 🔄");
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
                            $(".modal form bold[class=text-danger]").css('display', 'none');
                            $(".dataInput").val('');
    
                            location.reload();
                            $('#save').hide();
                            
                            alertify.set('notifier','position', 'top-center');
                            alertify.set('notifier','delay', 3);
                            alertify.success("✅ تمت تسوية رصيد الجهة بنجاح 💼💰");
                        }
                        
                        document.querySelector('.modal #save').disabled = false;
                        document.querySelector('.spinner_request').style.display = 'none';
                    }
                });
            }
        });
    });

</script>