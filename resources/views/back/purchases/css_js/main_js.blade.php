<script>
    // start focus products_selectize when page load
    $(document).ready(function(){
        $("#products_selectize")[0].selectize.focus();
    });
    // end focus products_selectize when page load
        
    

    // start focus product input search when click altKey + ctrlKey
    $(document).bind('keydown', function(event) {
        if( event.altKey  && event.ctrlKey) {
            $("#products_selectize")[0].selectize.focus();
        }
    });
    // end focus product input search when click altKey + ctrlKey



    $(document).on('input' , '.numValidate', function (e) {
        $(this).val($(this).val().replace(/[^0-9.]/g, ''));

        if (($(this).val().split('.').length - 1) > 1)
            $(this).val($(this).val().substring(0, $(this).val().length - 1));
    });


    // start focus the input[type="number"]
    $(document).on('focus', 'input[type="number"], .focused, .focus_input', function() {
        $(this).select();
    });
    // end focus the input[type="number"]


    // start valid if input[type="number"].val < 1
        //$(document).on('input', 'input[type="number"]', function() {
        //    if ($(this).val() < 1) {
        //        $(this).val(1);
        //    }
        //});
    // end valid if input[type="number"].val < 1

    // start cancel enter button 
        $(document).keypress(function (e) {
            if(e.which == 13){
                e.preventDefault();  
            }
        });
    // end cancel enter button 
    


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


    $(document).ready(function () {
        // selectize
        $('.selectize').selectize({
            hideSelected: true
        });
    });











    //  old data if making inpput search to products not selectize search
                    //// start focus main_input_search when page load
                    //$(document).ready(function(){
                    //        $("#main_input_search").focus();
                    //    });
                    //    // end focus main_input_search when page load
                        
                        
                    //    // start when focus main_input_search or focus out 
                    //    $("#main_input_search").focus(function() {
                    //        $(this).css('background', '#a5e3a5');
                    //    });
                    //    $("#main_input_search").blur(function() {
                    //        $(this).css('background', '#fff');
                    //    });
                    //    // end when focus main_input_search or focus out 


                    //    // start shortcut to focus input main_input_search
                    //    $(document).keydown(function(event) {
                    //        if (event.shiftKey && event.keyCode === 112) {
                    //            $('#main_input_search').focus();
                    //        }
                    //    });
                    //    // end shortcut to focus input main_input_search



                    //    // start when click out of hidden_div_main_search
                    //    $(document).on("click", function (event) {
                    //        if (!$(event.target).closest("#hidden_div_main_search").length) {
                    //            $("#hidden_div_main_search").hide(); 
                    //        }
                    //    });
                    //    // end when click out of hidden_div_main_search
    //  old data if making inpput search to products not selectize search
</script>