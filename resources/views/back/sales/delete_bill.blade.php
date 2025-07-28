<script>
    $(document).on("click", "table .delete_bill", function(e) {
        e.preventDefault();
        let bill_id = $(this).attr("res_id");
        
        alertify.confirm(
            'تحذير هام <i class="fas fa-exclamation-triangle text-warning" style="margin:0 3px;"></i>',
            `<div style='text-align:center;'>
                <span class='text-danger' style='font-size:18px;'>هل أنت متأكد من حذف الفاتورة نهائياً؟</span><br>
                <span style='color:#888;font-size:15px;'>لن يمكنك استرجاع بيانات الفاتورة بعد الحذف!</span>
            </div>`,
            function() {
                $.ajax({
                    url: `{{ url('sales/destroy_bill') }}/${bill_id}`,
                    type: "get",
                    success: function(res) {
                        if(res.notAuth){
                            alertify.dialog('alert')
                                .set({transition:'slide',message: `
                                    <div style='text-align:center;'>
                                        <p style='color:#e67e22;font-size:18px;margin-bottom:10px;'>صلاحية غير متوفرة 🔐⚠️</p>
                                        <p>${res.notAuth}</p>
                                    </div>
                                `, 'basic': true})
                                .show();
                            $(".modal").modal('hide');
                        }else{
                            if(res.success_delete){
                                alertify.dialog('alert')
                                .set({transition:'slide',message: `
                                    <div style='text-align:center;'>
                                        <p>تم حذف الفاتورة بنجاح ✅</p>
                                        <p>✨ تمت إعادة الكميات إلى المخزن 📦</p>
                                        <p>📊 تم تحديث متوسطات الأسعار تلقائيًا 🔄   </p>
                                    </div>
                                `, 'basic': true})
                                .show();

                                $('#example1').DataTable().ajax.reload( null, false );
                            }
                            if(res.cannot_delete){
                                alertify.set('notifier','position','top-center');
                                alertify.set('notifier','delay',6);
                                alertify.warning('خطأ: لا يمكن حذف الفاتورة لارتباطها بسجلات أخرى.');
                            }
                        }
                    },
                    error: function(){
                        alertify.error('حدث خطأ أثناء محاولة حذف الفاتورة');
                    }
                });
            },
            function(){}
        ).set({
            labels:{
                ok:"نعم <i class='fas fa-check text-success' style='margin:0 3px;'></i>",
                cancel:"لا <i class='fa fa-times text-light' style='margin:0 3px;'></i>"
            }
        });
    });
</script>