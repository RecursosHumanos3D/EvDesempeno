$('#modalButton').click(function () {
    $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
});
function getData()
{
    //alert("wena la wea !");
}

function modales() {
            $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
}

$('.sigi').on('click', function (event) {
    var all_answered = true;
    $("input:radio").each(function () {
        var name = $(this).attr("class");

        if ($("input:radio[class=" + name + "]:checked").length == 0)
        {
            all_answered = false;
        }
    });



    if (all_answered == true) {
        alert("ha concluido su evaluacion");
    } else {
        alert("faltan itemsdasdas por responder");
    }
});



function finalizaItem(dependencia)
{

    var all_answered = true;
    $("input:radio").each(function () {
        var name = $(this).attr("name");
        if ($("input:radio[name=" + name + "]:checked").length == 0)
        {
            all_answered = false;
        }
    });



    if (all_answered == true) {
        window.location = "/evaluabio/frontend/web/index.php?r=navegacion%2Fevaluaciones&id=" + dependencia + "";
    } else {


        alert("faltan items por responder");
    }


}

function localstorage(idAutonumerico, idV){
    
    
    
}



function finalizaItem2(dependencia)
{

    var all_answered = true;
    $("input:radio").each(function () {
        var name = $(this).attr("name");
        if ($("input:radio[name=" + name + "]:checked").length == 0)
        {
            all_answered = false;
        }
    });



    if (all_answered == true) {
        window.location = "/evalua/frontend/web/index.php?r=navegacion%2Fevaluaciones&id=" + dependencia + "";
    } else {


        alert("faltan items por responder");
    }


}