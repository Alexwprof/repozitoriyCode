
let param;

$('.list').on('change',function()
{
$('.btn_vote_class').removeAttr('disabled');

    if($(this).prop('checked')){

    param = $(this).data('id');

    }

});


$('.btn_vote_class').on('click',function() {
    $('.middle_button').css("display","none");
    $(".hide_class").css("display","none");
    $("#wrap_vote").css("background-color","#f2f2f2");
    

    $.ajax({
        url: '/ajax/ajaxFile.php',
        type: "post",
        data: {listPAramMain: param},
        success: function (data) {
        //$('.result').html(param);
        $('.btn_vote_class').fadeIn(500);
        $('.progreess_bar_line').fadeIn(500);
        $('.procent').fadeIn(300);
        
        }
        
        });
    });


   
     
