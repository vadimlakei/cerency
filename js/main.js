$(document).ready(function() {

    /* get history row count from session */
    $.ajax({
        type: "GET",
        url: 'sessions/getsession.php',
        success: function (data) {
            console.log(data);
            if(data){
               $('#history_rows').empty();
               $('#history_rows').val(data);
            }
        },
        error: function (data) {
            console.log('Errror');
        }
    });

    /* get currencies for conversion */
    $.ajax({
        type: "GET",
        url: 'actions/currencies.php',
        dataType: 'json',
        success: function (data) {
            // console.log(data);
            data.forEach(function(el) {
                $("#from").append( '<option>' + el + '</option>');
                $("#to").append( '<option>' + el + '</option>');
            });
        },
        error: function (data) {
            console.log('Errror');
        }
    });

    /* get currencies list for select */
    $.ajax({
        type: "GET",
        url: 'actions/currs.php',
        success: function (data) {
            $("#cur-list").append(data);
        },
        error: function (data) {
            console.log('Errror');
        }
    });

    historyTable();

    /* count conversion result */
    $('#submit').click(function(){
        amount = $('#amount').val();
        amount_el = $('#amount');
        from = $('#from').val();
        to = $('#to').val();
        if (checkInput(amount, '#amount')){
            $.ajax({
                type: "POST",
                url: 'actions/count.php',
                data: {
                    amount: amount,
                    from: from,
                    to: to
                },
                success: function (data) {
                    $('#amount_error').hide();
                    $("#result").empty();
                    $("#result").append(data);
                    getActions();
                },
                error: function (data) {
                    console.log('Errror');
                }
            });

        } else {

            $('#amount').css('border',"3px solid #dc3545");
            $('#amount_error').show();
        }
    });


    function getActions(){
        $.ajax({
            type: "GET",
            url: 'actions/actions.php',
            success: function (data) {
                $("#table_body").empty();
                $("#table_body").append(data);
            },
            error: function (data) {
                console.log('Errror');
            }
        });
    }


    function checkInput(input, selector){

        if( input !== ""){
            $(selector).css('border', '1px solid #ced4da');

            return true;

        } else {

            return false;
        }
    }

    /* set how many history rows should to display in the History table */
    $('#history_button').click(function(){

        history_rows = $('#history_rows').val();

        if (history_rows >= 12){
            $('#history_rows_error').show();
            return false;
        } else {
            $('#history_rows_error').hide();
        }

        if (checkInput(history_rows, '#history_rows')){

            $.ajax({
                type: "POST",
                url: 'sessions/setsession.php',
                data: {
                    history: history_rows,
                },
                success: function (data) {
                    $('#history_rows').css('border', '1px solid #ced4da');
                    historyTable();
                },
                error: function (data) {
                    console.log('Errror History');
                }
            });

        } else {

            $('#history_rows').css('border',"3px solid #dc3545");
        }
    });


    /*  get selected currencies */
    $('#select-curr').click( function(){
        $('#div-cur-list').hide();

        var checks = [];
        $('input.form-check-input').each(function () {
            box = this.checked ? $(this).val() : "";
            if (box !== ''){
                checks.push(box);
            }
        });
        $.ajax({
            type: "POST",
            url: 'sessions/setcursession.php',
            data: {
                checks: checks,
            },
            success: function (data) {
                // console.log(data);
                location.reload();
            },
            error: function (data) {
                console.log('Errror');
            }
        });
    });

    /* put data to  history table */
    function historyTable(){
        $.ajax({
            type: "GET",
            url: 'actions/actions.php',
            success: function (data) {
                if(data){
                    $('#no_data').hide();
                    $("#history").show();
                    $("#table_body").empty();
                    $("#table_body").append(data);
                }
            },
            error: function (data) {
                console.log('Errror');
            }
        });
    }

});
