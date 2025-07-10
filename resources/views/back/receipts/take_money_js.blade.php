
{{-- stat when click to .take_money --}}
<script>
    // start edit
    $(document).on('click', '.take_money', function(e) {
        let res_id = $(this).attr("res_id");
        document.querySelector("#res_id_take_money").value = res_id;
    });
    // end edit


    // start update
    $(document).on('click', '.takeMoneyModal .save', function(e) {
        e.preventDefault();
        const res_id = $(".takeMoneyModal form #res_id_take_money").val();
        let treasury = $("#treasury").val();

        if(!treasury){
            alertify.set('notifier','position', 'top-center');
            alertify.set('notifier','delay', 4);
            alertify.error(`💡 يرجى اختيار الخزينة أولًا. حتى يتم تسجيل تحصيل الإيصال عليها بشكل صحيح`);
        }else{
            alertify.confirm(
                'انتبة <i class="fas fa-exclamation-triangle text-warning" style="margin: 0px 3px;"></i>', 
                `<span class="text-center">
                    <span class="text-danger">🧾 هل أنت متأكد من تحصيل مبلغ المطالبة؟</span>
                    <strong class="d-block p-1">💰 سيتم إنشاء إذن توريد نقدية لهذا المبلغ داخل الخزينة المالية.</strong>
                    <strong class="d-block p-1">📥 هل ترغب في المتابعة؟</strong>
                </span>`, 
            function(){
                $.ajax({
                    url: `{{ url($pageNameEn.'/take_money/${res_id}/${treasury}') }}`,
                    type: "get",
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
                            $(".takeMoneyModal").modal('hide');  
    
                        }else{
                            $('#example1').DataTable().ajax.reload( null, false );
                            $(".takeMoneyModal").modal('hide');                            

                            alertify.set('notifier','position', 'top-center');
                            alertify.set('notifier','delay', 4);
                            alertify.success(`❌ تم تحصيل الإيصال بنجاح.✅ ولا يمكن التعديل عليه مرة أخرى`);
                        }
                    },
                    error: function(){
    
                    }
                });
    
            }, function(){ 
    
            }).set({
                labels:{
                    ok:"نعم <i class='fas fa-check text-success' style='margin: 0px 3px;'></i>",
                    cancel: "لاء <i class='fa fa-times text-light' style='margin: 0px 3px;'></i>"
                }
            });
        }


    });
    // end update
</script>
{{-- end when click to .take_money --}}