<script>
    $(document).on("click" , "table .delete" ,function(e){
        e.preventDefault();
        let res_id = $(this).attr("res_id");
      
        alertify.confirm(
            'تحذير <i class="fas fa-exclamation-triangle text-warning" style="margin: 0px 3px;"></i>', 
            `<span class="text-center">
                <span class="text-danger">⚠️ هل أنت متأكد من حذف هذا الجرد؟ لا يمكن إرجاع التعامل مرة اخري علي هذا الجرد بعد عملية الحذف.</span>
            </span>`, 
        function(){
            $.ajax({
                url: `{{ url($pageNameEn.'/destroy/${res_id}') }}`,
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
                        $(".modal").modal('hide');  

                    }else{
                        if(res.success_delete){
                            $('#example1').DataTable().ajax.reload( null, false );
                            
                            alertify.set('notifier','position', 'top-center');
                            alertify.set('notifier','delay', 4);
                            alertify.success(`تم حذف الجرد المسجل بنجاح`);
                        }
        
                        if(res.cannot_delete){
                            alertify.set('notifier','position', 'top-center');
                            alertify.set('notifier','delay', 6);
                            alertify.error(`🛑 خطأ: لا يمكن حذف الجرد لأن هناك أصناف مسجلة بداخله.`);
                        }
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
        });
</script>