<script>
    const deleteBtns = document.querySelectorAll(".delete");

    $(document).on("click" , "table .delete" ,function(e){
    e.preventDefault();
    let res_id = $(this).attr("res_id");
    let res_title = $(this).attr("res_title");
      
    alertify.confirm(
        'تحذير <i class="fas fa-exclamation-triangle text-warning" style="margin: 0px 3px;"></i>', 
        `<span class="text-center">
            <span class="text-danger">هل انت متأكد من حذف</span>
            <strong class="d-block">${res_title}</strong>
        </span>`, 
    function(){
        $.ajax({
              url: `{{ url($pageNameEn.'/destroy/${res_id}') }}`,
              type: "get",
              success: function(res){
                if(res.success_delete){
                    $('#example1').DataTable().ajax.reload( null, false );
                    
                    $('#code').val(res.latestId);

                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 4);
                    alertify.success(`تم حذف المورد ( ${res.success_delete} ) بنجاح`);
                }

                if(res.cannot_delete){
                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 6);
                    alertify.warning(`تحذير: لايمكن حذف المورد ( ${res.cannot_delete} ) لأن المورد تمت عليه حركات من قبل`);
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