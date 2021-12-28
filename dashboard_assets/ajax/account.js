
var _account = {
 
    /*
	|--------------------------------------------
	|					LogIn 					|
	|--------------------------------------------
    */
    login: function(){
        form = $("#admin-login-form");
        var request = {
            url: config.url + "login",
            method: "POST",
            data: form.serialize(),
        }
        $.ajax(request).done(function(response){
            response = $.parseJSON(response);
            if(response.success){
                _alert.remove_errors();
                window.location.replace(response.url);
            }else if(response.error){
                _alert.display_errors(response.error_message);
            }else if(response.invalid_error){
                _alert.remove_errors();
                _alert.error(response.error_message);
            }
        });
    },


    /*
    |-----------------------------------------------------
    |	Change Password                                  |
    |-----------------------------------------------------
    */
    change_password: function () {
        form = $("#change-password-form");
        var request = {
            url: config.url + 'change-password',
            method: 'post',
            data: form.serialize(),
        }
        $.ajax(request).done(function (response) {
            response = $.parseJSON(response);
            if (response.success) {

                $("#change-password-form")[0].reset();

                _alert.remove_errors();
                _alert.success(response.message);
            } else if (response.error) {
                _alert.display_errors(response.error_message);
            } 
        });
    }


}; // end of class "_account"