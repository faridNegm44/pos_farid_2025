<style>
    .page{
        margin-top: 5px;
    }
    .product-selection{
        border: 0px !important;
    }
    #products_table{
        width: 100%;
        overflow: auto;
        /*-webkit-box-shadow: -3px 3px 15px 0px rgba(194,194,194,1);
        -moz-box-shadow: -3px 3px 15px 0px rgba(194,194,194,1);
        box-shadow: -3px 3px 15px 0px rgba(194,194,194,1);*/

        /*height: 70vh;
        overflow: auto;*/
    }

    @media (min-width: 992px) {
        .main-content {
            display: flex;
            flex-direction: column;
            height: calc(80vh - 10px);
        }

        /*body{
            overflow: hidden;
        }*/
        
        .product-selection{
            border: 2px solid #ccc;
        }
    }

    #modal_save_bill .table td, .table th, #modal_dismissal_notices .table td, .table th{
        padding: 3px 0 !important; 
        font-size: 10px;
    }
    
    #modal_save_bill .table input, #modal_dismissal_notices .table input{
        height: 25px !important;
        font-size: 13px !important;
    }

    @media (min-width: 769px) and (max-width: 1024px) {
        #page_sales{
            margin-top: 40px; 
        }
    }

    @media (min-width: 768px) {
        .main-content {
            flex-direction: row;
        }
    }

    @media (max-width: 768px) {
        #icons_left, #add_user, #date_time{
            display: none;
        }
    }
    .product-selection, .cart {
        overflow-y: auto;
    }
    .product-selection {
        flex: 1;
        border-left: 1px solid #ddd;
        padding-right: 10px;
    }
    .cart {
        flex: 2;
        padding-left: 10px;
    }
    .table tbody td {
        vertical-align: middle;
    }
    .btn-icon {
        width: 34px;
        height: 34px;
        padding: 0;
        border-radius: 50%;
    }
    .total-bar {
        padding: 10px;
        background-color: #d9d6d6;        
        border: 2px solid #9ba1b0 !important;    
    }
    .total-bar .btn {
        margin-left: 10px;
    }
    .form-inline .form-control {
        width: auto;
    }
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    #page_purchases .footer-btn-group {
        background-color: #bda17e;
        position: fixed;
        bottom: 0;
        right: 12px;
        left: 0;
        width: 100%;
        z-index: 1000;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 3px 15px !important;
    }
    
    #page_sales .footer-btn-group {
        background-color: #70a584;
        position: fixed;
        bottom: 0;
        right: 12px;
        left: 0;
        width: 100%;
        z-index: 1000;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 3px 15px !important;
    }
    .footer-btn-group .btn {
        flex: 1;
        margin: 2px;
        height: 35px !important;
        color: #1a1a1a;
    }
    .footer-btn-group .btn i{
        font-size: 20px;
    }
    .footer-btn-group .btn span{
        position: relative;
        bottom: 5px;
    }

    .total_info input::placeholder{
        font-size: 10px;
    }


    .form-control::placeholder {
        transform: scale(0.9);
    }

    /*.form-control{
        height: 30px !important;
        color: #000 !important; 
    }*/
    .selectize-input{
        height: 30px !important;
        padding: 5px 8px !important
    }


    #main_content{
        padding: 15px 10px 5px;
    }


    /* ////////////////////////////////////////////////////////////// */

    .table td, .table th{
        padding: 3px !important;
    }

    .btn-icon{
        width: 25px;
        height: 24px;
    }

    .reqInputAddClass{
        border: 2px solid red !important;
    }
    
    .inputs_table{
        max-width: 95% !important;
        height: 20px !important;
        
        font-size: 13px;
        margin: auto;
        display: block;
        background: transparent;
        border-radius: 2px;
    }
    table select{
        max-width: 70% !important;
        width: 70% !important;
        height: 20px !important;
        
        border: 1px solid #ccc;
        margin: auto;
    }
    table select option{
        padding: 0px !important;
        font-size: 10px !important;
        text-align: center;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
}

    thead tr{
        font-size: 12px;
        
    }
    tbody tr{
        font-size: 12px;
        
    }
    .prod_name{
        font-size: 11px;
    }

    #countTableTr span{
        font-size: 16px;
        
        color: red;
    }
    .header .btn-group .btn{
        border-radius: 50% !important;
    }
    .header .btn-group i{
        font-size: 20px;
    }

    input::placeholder{
        font-size: 12px;         
    }

    #hidden_div_main_search{
        width: 97.1%;
        background: #f1f0cb;
        height: 200px;
        position: absolute;
        z-index: 1;
        overflow: auto;
        display: none;      
    }

    .alertify .ajs-body .ajs-content {
        padding: 16px 16px 16px 24px !important;
        font-weight: bold !important;
        text-align: center !important;
    }

    .alertify{ 
        z-index:999999 !important;
        display: block !important;
    }
    
    .alertify-notifier{ 
        z-index:999999 !important;
    }
    
    .ajs-button {
        border: 0px;
        
    }

    .ajs-cancel {
        background: rgb(209, 56, 56) !important;
        color: #fff !important;
    }

    .ajs-success{
        
        width: 320px !important;
        {{--  background: rgb(77, 124, 91) !important;  --}}
    }

    .ajs-error{
        
        width: 320px !important;
        background: rgb(155, 56, 64) !important;
    }

    .ajs-warning{
        
        width: 320px !important;
        background: orange !important;
    }

    .alertify-notifier.ajs-center.ajs-bottom .ajs-message.ajs-visible{
        bottom: 40px !important;
    }


    #modal_save_bill input, label{
        font-size: 12px !important;
    }
    
    #modal_save_bill table td{
        font-size: 16px !important;
    }

    {{--  spinner overlay  --}}
    .overlay_div {
        {{--  background-color: rgba(1, 1, 1, 0.948);  --}}
        background-color: black;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 20000;
        display: none;
    }
    .spinner{
        margin: 40vh auto;
        display: block;
        color: gold;
        width: 60px;
        height: 60px;
    }
    {{--  spinner overlay  --}}















    {{--  start modal_search_product  --}}
    #modal_search_product #search_by{
        font-size: 13px;
        
    }
    #modal_search_product #search_form{
        margin-bottom: 20px; 
    }
    #modal_search_product #table{
        height: 300px;
        max-height: 300px;
        overflow: auto;
    }
    #modal_search_product table tbody tr{
        cursor: pointer;
    }
    {{--  end modal_search_product  --}}

    #hidden_div_main_search table tbody tr{
        cursor: pointer;
    }

    .hor-toggle{
        display: none;
    }
</style>