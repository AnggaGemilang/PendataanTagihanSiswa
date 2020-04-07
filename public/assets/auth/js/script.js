$(document).ready(function(){
    $('.wrapper-password-field').on('click','.btn-eye',function(e){
        e.stopPropagation();
        if($(this).prev().hasClass('active'))
        {
            $('.form-pwd').attr('type','password').removeClass('active');
            $('.btn-eye > i').attr('class','fas fa-eye');
        } else {
            $(this).prev().attr('type','text').addClass('active');
            $(this).find('i').attr('class','fas fa-eye-slash');
        } 
        return false;
    });
});

$('.btn-login').on('click', function(){
    $(this).attr('disabled');
});