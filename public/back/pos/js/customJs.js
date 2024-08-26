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

// start cancel enter button 
$(document).keypress(function (e) {
    if(e.which == 13){
        e.preventDefault();  
    }
});
// end cancel enter button 


// start open modal when click button (insert) to search products
document.addEventListener('keydown', function(event){
    if( event.which === 45 ){
        $('#modal_search_product').modal('show');
    }
});
// end open modal when click button (insert) to search products

// start open modal calc when click button when click ctrl+/
$(document).bind('keydown', function(event) {
    if( event.which === 191 && event.ctrlKey ) {
        $('#calc').modal('show');
    }
});
// end open modal calc when click button when click ctrl+/


// start get current full date and time
function showDate() {
    const now = new Date();
    const options = {
      weekday: 'long',
      day: 'numeric',
      month: 'numeric',
      year: 'numeric',
      locale: 'ar' 
    };
    const formattedDateTime = now.toLocaleString('ar-EG', options);
    document.getElementById('date').textContent = formattedDateTime;
  }
  setInterval(showDate, 1000);


  function showTime() {
    const now = new Date();
    const options = {
      hour: 'numeric',
      minute: 'numeric',
      second: 'numeric',
      locale: 'ar' 
    };
    const formattedDateTime = now.toLocaleString('ar-EG', options);
    document.getElementById('time').textContent = formattedDateTime;
  }
  setInterval(showTime, 1000);
// end get current full date and time
