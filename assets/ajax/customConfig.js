var config = {
	//"url" : "http://lvsi3flngwcp7xusjgt3erfoay6opkpukzstnkodtxew3qmysadc4xyd.onion/"
	"url" : "http://localhost/herbal/"
	//"url" : "http://herbal.techostudios.com/"
};

var _alert = {
	place: "#result",

	success:function(message, time = null){
		_alert.hide();
		intTime = 3000;
		if(time != null){
			intTime = time;
		}
		var myHtml = '<div id="alert-box" class="alert alert-success alert-dismissible">';
		myHtml += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
		myHtml += message + '</div>';
		$(_alert.place).prepend(myHtml);
		setTimeout(function () {_alert.hide()}, intTime);
	},

	error:function(message){
		_alert.hide();
		var myHtml = '<div id="alert-box" class="alert alert-danger alert-dismissible">';
		myHtml += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
		myHtml += message + '</div>';
		$(_alert.place).prepend(myHtml);
		setTimeout(function () {_alert.hide()}, 3000);
	},

	hide: function(){
		$("#alert-box").fadeOut("slow", function(){
			$('.alert').remove();
		});
	},

	/*
	|--------------------------------------------
	|	     Display form errors			    |
	|--------------------------------------------
    */
	display_errors(errors_data){
		$.each(errors_data, function (key, val) {
			if (val != '') {
				$('input[name="' + key + '"]').next().html(val).addClass('has-error');
				$('select[name="' + key + '"]').next().html(val).addClass('has-error');
				$('.' + key).next().html(val).addClass('has-error');
			} else {
				val = '';
				$('input[name="' + key + '"]').next().html(val).removeClass('has-error');
				$('select[name="' + key + '"]').next().html(val).removeClass('has-error');
				$('.' + key).next().html(val).removeClass('has-error');
			}
		});
	},
	/*
	|--------------------------------------------
	|	  Remove form errors when not need	    |
	|--------------------------------------------
    */
	remove_errors(){
		val = '';
		//$('form :input').next().html(val).removeClass('has-error');
		//$("input[type=text]").next().html(val).removeClass('has-error');
		$('.error').next().html(val).removeClass('has-error');
		$('.address').next().html(val).removeClass('has-error');
	},

};
