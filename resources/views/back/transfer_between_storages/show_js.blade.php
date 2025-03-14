<script>
    ///////////////////////////////// show /////////////////////////////////
    $(document).on("click" , "#example1 tr .show" ,function(){
        const res_id = $(this).attr("res_id");

        $.ajax({
            url: `{{ url($pageNameEn) }}/show/${res_id}`,
            type: 'GET',
            dataType: 'json',
            beforeSend: function(){
                $(`#exampleModalCenterShow .modal-body .data_removed`).text('');
            },
            success: function(res){
                console.log(res);

                $(`#exampleModalCenterShow .modal-body #num_order`).text(res.find[0].num_order);
                $(`#exampleModalCenterShow .modal-body #created_at`).text(res.created_at);
                $(`#exampleModalCenterShow .modal-body #value`).text(res.find[0].value);
                $(`#exampleModalCenterShow .modal-body #user_id`).text(res.find[0].userName);
                $(`#exampleModalCenterShow .modal-body #notes`).text(res.find[0].notes);
                
                $(`#exampleModalCenterShow .modal-body #num_order_treasure_from span`).text(res.find[0].transaction_from_name);
                $(`#exampleModalCenterShow .modal-body #value_treasure_from span`).text(res.find[0].money);
                
                $(`#exampleModalCenterShow .modal-body #num_order_treasure_to span`).text(res.find[1].transaction_to_name);
                $(`#exampleModalCenterShow .modal-body #value_treasure_to span`).text(res.find[1].money);

                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 2);
                alertify.success("تمت جلب بيانات التحويل بنجاح");
            }
        });

    });
</script>