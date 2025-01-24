<script>
    $(".refresh_page").click(function(){
        
        if(($("#products_table tbody tr").length) > 0){
            alertify.confirm(
                'تحذير <i class="fas fa-exclamation-triangle text-warning" style="margin: 0px 3px;"></i>', 
                `<span class="text-center">
                    <span class="text-danger">هل انت متأكد من إلغاء الفاتورة الحالية وتحديث الصفحة</span>
                </span>`, 
            function(){
                location.reload();
            }, function(){ 
    
            }).set({
                labels:{
                    ok:"نعم <i class='fas fa-check text-success' style='margin: 0px 3px;'></i>",
                    cancel: "لاء <i class='fa fa-times text-light' style='margin: 0px 3px;'></i>"
                }
            });
    


        }else{
            location.reload();
        }
    });
</script>