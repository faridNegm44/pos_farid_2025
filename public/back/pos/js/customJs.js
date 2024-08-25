// strt count table tr
    function countTableTr(selector){
        let countTableTr = $(selector).length;
        $('#countTableTr span').text(countTableTr);
    }
    countTableTr('#pos_create #products_table tbody tr');
// end count table tr


// start remove This Tr on table
    function removeThisTr(selector) {
        $(selector).on('click', '.remove_this_tr', function (e) { 
            $(this).closest('tr').fadeOut(100, function(){
                $(this).remove();

                // countdown the tr pos_create page
                countTableTr('#pos_create #products_table tbody tr');
            });    
        });
    }
// end remove This Tr on table


// start focus the input[type="number"]
    $('input[type="number"]').on('focus', function() {
        $(this).select();
    });
// end focus the input[type="number"]


// start valid if input[type="number"].val < 1
    $('input[type="number"]').on('input', function() {
        if ($(this).val() < 1) {
            $(this).val(1);
        }
    });
// end valid if input[type="number"].val < 1