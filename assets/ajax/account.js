var admin_tbl;
var traveller_vaccine_tbl;
var _account = {
 
    /*
	|--------------------------------------------
	|					LogIn 					|
	|--------------------------------------------
    */
    login: function(){
        form = $("#login_register_form");
        var request = {
            url: config.url + "account/login",
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
    |	 Create user account                             |
    |-----------------------------------------------------
    */
    register: function () {
        form = $("#login_register_form");
        var request = {
            url: config.url + 'account/register',
            method: 'post',
            data: form.serialize(),
        }
        $.ajax(request).done(function (response) {
            response = $.parseJSON(response);
            if (response.success) {
                $("#login_register_form")[0].reset();

                _alert.remove_errors();
                _alert.success(response.message);
                
                if(response.url){
                    setTimeout(function () { window.location.href = response.url }, 900);
                }
            } else if (response.error) {
                _alert.display_errors(response.error_message);
            } 
        });
    },


    /*
    |-----------------------------------------------------
    |	Change Password (admin, doc, nurse, etc) for all |
    |-----------------------------------------------------
    */
    change_password: function () {
        form = $("#change_password_form");
        var request = {
            url: config.url + 'account/change_password',
            method: 'post',
            data: form.serialize(),
        }
        $.ajax(request).done(function (response) {
            response = $.parseJSON(response);
            if (response.success) {

                $("#change_password_form")[0].reset();

                _alert.remove_errors();
                _alert.success(response.message);
            } else if (response.error) {
                _alert.display_errors(response.error_message);
            } 
        });
    }



}; // end of class "_account"