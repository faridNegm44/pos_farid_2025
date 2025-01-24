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
              success: function(){
                  $('#example1').DataTable().ajax.reload( null, false );

                  alertify.set('notifier','position', 'bottom-right');
                  alertify.set('notifier','delay', 4);
                  alertify.error("تم الحذف بنجاح");
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