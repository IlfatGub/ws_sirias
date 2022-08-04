$(function(){
    $('#modalButton').click(function(){
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });
    $('.modalButton').click(function(){
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });
    $("[data-toggle='tooltip']").tooltip();
    $("[data-toggle='popover']").popover();


    $("#checkbox").change(function(){
        $('.chekboxReport').prop('checked', $(this).is(':checked'));
    });



    $(document).on('click', '#invoices-original', function () {
            var val = $(this).val();
            var note = $("#invoices-note");

        if (val == 2){
            console.log(val);
            note.text("Оригинал обязуемся передать в течение 20 дней");
        } else{
            note.empty();
        }
    });



    $(document).on('click', '#invoices-id_org', function () {
        var val = $(this).val();

        $.post('/site/dogovora?name=' + val , function(data) {

            var result = jQuery.parseJSON(data);

            if (result.data == true){
                console.log(result.select);

                $('#invoices-document').html(result.select);
            } else{

            }
        });

        // var note = $("#invoices-note");
        //
        // if (val == 2){
        //     console.log(val);
        //     note.text("Оригинал обязуемся передать в течение 20 дней");
        // } else{
        //     note.empty();
        // }
    });




});
