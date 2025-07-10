<script>
    $(document).ready(function () {
        $(".exampleModalCenter #save").click(function(e){
            e.preventDefault();
            document.querySelector('.exampleModalCenter #save').disabled = true;        
            document.querySelector('.spinner_request').setAttribute("style", "display: inline-block;");

            
            const amount = $("#amount").val();
            const current_remaining_money = $("#current_remaining_money").val();
            const payer_id = $("#payer_id").val();

            if(!amount || !payer_id){
                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 5);
                alertify.error("اختر الجهة أولاً، ثم 💵 أدخل مبلغ المطالبة أو الدفعة");

                document.querySelector('.exampleModalCenter #save').disabled = false;
                document.querySelector('.spinner_request').style.display = 'none';               

            }else{

                if(current_remaining_money < amount){

                    if (confirm("⚠️ انتبه!\nمبلغ المطالبة 💵 أكبر من الرصيد المستحق على الجهة 🚫\n\nهل تريد المتابعة؟")) {
                        $.ajax({
                            url: "{{ url($pageNameEn) }}/store",
                            type: 'POST',
                            processData: false,
                            contentType: false,
                            data: new FormData($('.exampleModalCenter #form')[0]),
                            beforeSend:function () {
                                $('form [id^=errors]').text('');
                            },
                            error: function(res){
                                $.each(res.responseJSON.errors, function (index , value) {
                                    $(`form #errors-${index}`).css('display' , 'block').text(value);
                                });               
                                
                                document.querySelector('.exampleModalCenter #save').disabled = false;
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
                                    $(".exampleModalCenter").exampleModalCenter('hide');  
        
                                }else{
                                    $(".exampleModalCenter form bold[class=text-danger]").css('display', 'none');
                                    $(".dataInput").val('');
            
                                    location.reload();
                                    $('#save').hide();
                                    
                                    alertify.set('notifier','position', 'top-center');
                                    alertify.set('notifier','delay', 3);
                                    alertify.success("✅ تمت تسوية رصيد الجهة بنجاح 💼💰");
                                }
                                
                                document.querySelector('.exampleModalCenter #save').disabled = false;
                                document.querySelector('.spinner_request').style.display = 'none';
                            }
                        });
                    } else {
                        document.querySelector('.exampleModalCenter #save').disabled = false;
                        document.querySelector('.spinner_request').style.display = 'none';  
                    }
                    
                }else{
                    $.ajax({
                        url: "{{ url($pageNameEn) }}/store",
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data: new FormData($('.exampleModalCenter #form')[0]),
                        beforeSend:function () {
                            $('form [id^=errors]').text('');
                        },
                        error: function(res){
                            $.each(res.responseJSON.errors, function (index , value) {
                                $(`form #errors-${index}`).css('display' , 'block').text(value);
                            });               
                            
                            document.querySelector('.exampleModalCenter #save').disabled = false;
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
                                $(".exampleModalCenter").exampleModalCenter('hide');  
    
                            }else{
                                $(".exampleModalCenter form bold[class=text-danger]").css('display', 'none');
                                $(".dataInput").val('');
        
                                location.reload();
                                $('#save').hide();
                                
                                alertify.set('notifier','position', 'top-center');
                                alertify.set('notifier','delay', 3);
                                alertify.success("✅ تمت تسوية رصيد الجهة بنجاح 💼💰");
                            }
                            
                            document.querySelector('.exampleModalCenter #save').disabled = false;
                            document.querySelector('.spinner_request').style.display = 'none';
                        }
                    });
                }

            }
        });
    });

</script>