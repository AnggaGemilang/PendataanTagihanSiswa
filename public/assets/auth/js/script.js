$('.wrapper-icon-show').on('click','.btn-eye',function (e) {
    e.stopPropagation();
    if ($(this).parent().hasClass('active')) {
        $('.form-pwd').attr('type', 'password');
        $(this).parent().removeClass('active');
        $('.btn-eye > i').attr('class', 'fas fa-eye');
    } else {
        $(this).parent().addClass('active');
        $('.form-pwd').attr('type', 'text');
        $(this).find('i').attr('class', 'fas fa-eye-slash');
    }
    return false;
});

$(document).keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $('#form-submit').submit();
    }
});