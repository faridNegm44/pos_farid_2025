<script>
    $(".refresh_page").on("click", function(){
        alertify.confirm(
        'تحذير !! <i class="fas fa-exclamation-triangle text-warning" style="margin: 0px 3px;"></i>',
        `<div style="text-align: center;">
            <p style="font-weight: bold;">
                هل انت متأكد من الإلغاء وتحديث الصفحة
            </p>
        </div>`,
        function(){
            location.reload();
        }, function(){

        }).set({
            labels:{
                ok:"نعم <i class='fas fa-check text-success' style='margin: 0px 3px;'></i>",
                cancel: "لاء <i class='fa fa-times text-light' style='margin: 0px 3px;'></i>"
            }
        });
    });
</script>