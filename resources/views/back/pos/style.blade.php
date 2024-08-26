<style>
    body {
        overflow: hidden;
        background-color: #f8f9fa;
        font-family: Almarai;
        text-align: right;
    }
    .header {
        background-color: #f8f9fa;
        padding: 10px;
    }
    .header .btn {
        margin-right: 10px;
    }
    .header .form-group {
        margin-bottom: 0;
    }
    .main-content {
        display: flex;
        flex-direction: column;
        height: calc(100vh - 120px);
    }

    @media (max-width: 1024px) {
        .main-content {
            display: flex;
            flex-direction: column;
            height: calc(60vh - 0px);
        }
    }


    @media (min-width: 768px) {
        .main-content {
            flex-direction: row;
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
        padding: 15px !important;
    }
    .footer-btn-group .btn {
        flex: 1;
        margin: 2px;
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
        font-weight: bold;
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
        font-weight: bold;
    }
    tbody tr{
        font-size: 12px;
        font-weight: bold;
    }
    .prod_name{
        font-size: 11px;
    }

    #countTableTr span{
        font-size: 16px;
        font-weight: bold;
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


    {{--  start modal_search_product  --}}
    #modal_search_product #search_by{
        font-size: 13px;
        font-weight: bold;
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