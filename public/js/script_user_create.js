$('[name="isPasswordReset"]').on("change", function(){
    if($('[name="isPasswordReset"]')[0].checked == true)
        $('#ResetPassword').show();
    else
        $('#ResetPassword').hide();
});
    