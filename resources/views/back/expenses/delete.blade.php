<script>
    const deleteBtns = document.querySelectorAll(".delete");

    $(document).on("click" , "table .delete" ,function(e){
    e.preventDefault();
    let res_id = $(this).attr("res_id");
    let res_title = $(this).attr("res_title");
      
    alertify.confirm(
        'تحذير <i class="fas fa-exclamation-triangle text-warning" style="margin: 0px 3px;"></i>', 
        `<span class="text-center">
            <span class="text-danger">هل انت متأكد من حذف مصروف</span>
            <strong class="d-block">${res_title}</strong>
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
                        $('#example1').DataTable().ajax.reload( null, false );
                          
                        location.reload();
                        
                        alertify.set('notifier','position', 'top-center');
                        alertify.set('notifier','delay', 4);
                        alertify.success(`تم حذف المصروف بنجاح وارجاع مبلغ المصروف الي الخزينة`);
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