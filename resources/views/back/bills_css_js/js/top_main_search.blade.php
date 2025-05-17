<script>
    
    // start when change input data 
    $("#top_section #main_input_search").on('input', function(e){
        const thisVal = $("#main_input_search").val();
        
        if(!thisVal){
            $("#hidden_div_main_search").css('display', 'none');
            $('#top_section #hidden_div_main_search tbody tr').remove();
        }
    });
    // end when change input data 


    // start function searchProducts
    function searchProducts(dataToSearch){
        $.ajax({
            url: `{{ url('search_products') }}/${dataToSearch}`,
            type: 'get',
            beforeSend: function(){
                $("#hidden_div_main_search").css('display', 'none');
                $('#top_section #hidden_div_main_search tbody tr').remove();
                $("#overlay_page").fadeIn();
            },
            success: function(res){
                if(res.length > 0){
                    console.log(res);

                    $("#hidden_div_main_search").css('display', 'block');
                    $("#overlay_page").fadeOut();

                    $.each(res , function(index, value){                    
                        $('#top_section #hidden_div_main_search tbody').append(`
                            <tr>
                                <td>${value.id}</td>
                                <td>${value.nameAr}</td>
                                <td>11</td>
                                <td>${value.sellPrice}</td>
                            </tr>
                        `);
                    });

                }else{
                    $("#overlay_page").fadeOut();

                    alertify.set('notifier','position', 'bottom-center');
                    alertify.set('notifier','delay', 3);
                    alertify.error("لاتوجد أصناف مشابهة لبحثك. حاول مرة أخري");
                }
                
            }
        });
    }
    // end function searchProducts



    // start when click enter when focus on search input
    $('#main_input_search').on('keypress', function(e) {
        if (e.which == 13) {
            const thisVal = $(this).val();
              
            if(thisVal){
                searchProducts(thisVal);
            }
        }
    });
    // end when click enter when focus on search input




    // start when click form submit to search products 
    $("#top_section #main_form_search").on('submit', function(e){
        e.preventDefault();
        const thisVal = $("#main_input_search").val();

        if(thisVal){
            searchProducts(thisVal);
        }
    });
    // end when click form submit to search products 
</script>