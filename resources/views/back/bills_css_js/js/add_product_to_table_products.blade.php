<script>
    
    // start when click to tr to add prouct to table products
    $(document).on('click', '#hidden_div_main_search tbody tr' , function() {
        //var product = $(this).data('product');
        //var price = $(this).data('price');

        const index = $('#main_content #products_table tbody tr').length;
        $('#main_content #products_table tbody').append(`
            <tr>
                <th>${index+1}</th>
                <td>
                    <button class="btn btn-danger btn-sm remove_this_tr" onclick="removeThisTr('#pos_create #products_table'); new Audio('{{ url('back/sounds/failed.mp3') }}').play();"><i class="fas fa-times"></i></button>
                </td>
                <td class="prod_name">ابليك مجزع اسود ف دهبي مقاس 10 اكس</td>
                <td>20</td>
                <td><input type="number" class="form-control form-control-sm text-center bill_qty" value="1"></td>
                <td>600</td>
                <td>600.00</td>
                <td><input type="number" class="form-control form-control-sm text-center bill_qty" value="0"></td>
                <td><input type="number" class="form-control form-control-sm text-center bill_qty" value="0"></td>
                <td><input type="number" class="form-control form-control-sm text-center bill_qty" value="0"></td>
                <td><input type="number" class="form-control form-control-sm text-center bill_qty" value="0"></td>
            </tr>
        `);
    }); 
    
</script>