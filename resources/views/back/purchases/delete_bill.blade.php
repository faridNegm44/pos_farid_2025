<script>
    $(document).on("click", "table .delete_bill", function(e) {
        e.preventDefault();
        let bill_id = $(this).attr("res_id");
        
        alertify.confirm(
            'تحذير هام <i class="fas fa-exclamation-triangle text-warning" style="margin:0 3px;"></i>',
            `<div style='text-align:center;background-color:#000; padding:15px; border-radius:5px;'>
                <span style='font-size:18px;color: red'>هل أنت متأكد من حذف فاتورة المشتريات نهائياً؟</span><br>
                <span style='color:#888;font-size:15px;'>لن يمكنك استرجاع بيانات الفاتورة بعد الحذف!</span>
            </div>`,
            function() {
                $.ajax({
                    url: `{{ url('purchases/destroy_bill') }}/${bill_id}`,
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
                                    <div style='text-align:center;background: #E7D3D3;padding: 25px 5px;border-radius: 5px;'>
                                        <p class="p-1">🗑️ تم حذف فاتورة المشتريات بنجاح ✅</p>
                                        <p class="p-1">📦 تم خصم الكميات المرتبطة من المخزون</p>
                                        <p class="p-1">📊 تم تحديث متوسط تكلفة الأصناف تلقائيًا</p>
                                        <p class="p-1">💾 تم تعديل الأرصدة المالية للمورد المرتبط</p>
                                        <p class="p-1">🔄 تم تسجيل العملية في سجل الحركات للحفظ والمراجعة</p>
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