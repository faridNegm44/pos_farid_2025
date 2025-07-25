<style>
    @font-face {
        font-family: "4_F4";
        src: url("{{ asset('back/fonts/4_F4.ttf') }}");
    }
    body {
        overflow: hidden;
        background-color: #fafafa;
        {{--  font-family: Almarai;  --}}
        text-align: right;
        font-family: "4_F4", serif;
    }
    .header {
        padding: 10px !important;
    }
    .header .btn {
        margin-right: 10px;
    }
    .header .form-group {
        margin-bottom: 0;
    }
    .main-content {
        {{--  flex-direction: column;  --}}
        width: 100% !important;
        margin: 0px auto;
        height: calc(100vh - 200px);
    }

    .product-selection{
        border: 0px !important;
    }

    @media (max-width: 1024px) {
        .main-content {
            display: flex;
            flex-direction: column;
            height: calc(100vh - 0px);
        }

        .btn:not(:disabled):not(.disabled){
            font-size: 10px !important;
        }

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
    {{--  .product-selection, .cart {
        overflow-y: auto;
    }  --}}
    .product-selection {
        flex: 1;
        border-left: 1px solid #ddd;
        padding-right: 10px;
    }
    {{--  .cart {
        flex: 4;
        padding-left: 10px;
    }  --}}
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
        background-color: #f1f1f1;
        padding: 10px;
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
    .footer-btn-group {
        background-color: #1c2e3f;
        padding: 10px;
        position: fixed;
        bottom: 0;
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
    }

    .total_info input::placeholder{
        font-size: 10px;
    }


    /* ////////////////////////////////////////////////////////////// */

    .table td, .table th{
        padding: 3px !important;
    }

    .btn-icon{
        width: 25px;
        height: 24px;
    }

    input[type="number"]{
        max-width: 70px;
        height: 20px;
        
        font-size: 13px;
        margin: auto;
        display: block;
        background: transparent;
        border-radius: 2px;
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

    #hidden_div{
        width: 93%;
        background: #fff;
        height: 300px;
        position: absolute;
        z-index: 1;
        overflow: auto;
        display: none;        
    }

    .alertify .ajs-body .ajs-content {
        padding: 16px 16px 16px 24px !important;
        font-size: 100px !important;
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
</style>