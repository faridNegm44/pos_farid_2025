<script>
    const deleteBtns = document.querySelectorAll(".delete");

    $(document).on("click" , "table .delete" ,function(e){
    e.preventDefault();
    let res_id = $(this).attr("res_id");
    let unit_name = $(this).attr("unit_name");
      
    alertify.confirm(
        'تحذير <i class="fas fa-exclamation-triangle text-warning" style="margin: 0px 3px;"></i>', 
        `<span class="text-center">
            <span class="text-danger">هل انت متأكد من حذف</span>
            <strong class="d-block">${unit_name}</strong>
        </span>`, 
    function(){
        $.ajax({
              url: `{{ url($pageNameEn.'/destroy/${res_id}') }}`,
              type: "get",
              success: function(res){
                if(res.success_delete){
                    $('#example1').DataTable().ajax.reload( null, false );
                    
                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 4);
                    alertify.success(`تم حذف وحدة الصنف بنجاح`);
                }

                if(res.cannot_delete){
                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 6);
                    alertify.warning(`خطأ: لايمكن حذف الوحدة لأنها مسجلة لأصناف بالفعل.`);
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