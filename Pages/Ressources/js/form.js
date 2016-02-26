String.prototype.isLetterString = function(minLength) {
    if(minLength == undefined){
        minLength = 0;
    }
    if(this.length >= minLength && this.isOnlyLetter()){
        return true;
    }
    else {
        return false;
    }
}

String.prototype.isSimpleString = function(minLength){
    if(minLength == undefined){
        minLength = 0;
    }
    if(this.length >= minLength){
        return true;
    }
    else {
        return false;
    }
}

String.prototype.isMail = function(){
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(this);
}

String.prototype.isPhoneNumber = function(){
    if(this.length == 10 && this.isNumeric()){
        return true
    }
    else {
        return false;
    }
}

String.prototype.isNumeric = function(){
    return /^\d+$/.test(this);
}

String.prototype.isOnlyLetter = function(){
    if(this.length == 0){
        return true;
    }
    return /^[a-zA-Z\u00C0-\u00ff\-\s]+$/.test(this);
}

String.prototype.formatFrDateToJSDateFormat = function (){
    
    var date = this.split("/");
    
    var day = date[0];
    var month = date[1];
    var year = date[2];
    
    return year + "-" + month + "-" + day;
}

$.prototype.inputError = function(type, minLength){
    
    minLength = parseInt(optionalParameter(minLength, 0));
    
    var tabError = {
        date : 'Date invalide',
        length : 'Ce champ nécessite au moins ' + minLength + ' charactères',
        simple : 'Format incorrect',
        letter : 'Ce champ ne peut contenir que des lettres',
        number : 'Ce champ ne peut contenir que des nombres',
        mail : 'Format mail incorrect',
        phone : 'Format numéro de téléphone incorrect',
        pwd : 'Les mots de passe ne correspondent pas'
    }
    
    if(this.hasClass('error_input')){
        return;
    }
    this.addClass('error_input');
    var target = $('label[for="' + this.attr('id') + '"]');
    var errorDiv = "<div data-input='"+this.attr('id')+"' class='error_modal'>"+tabError[type]+"</div>";
    target.before(errorDiv);
    
}

$.prototype.radioError = function(){
    var error = "Il manque une donnée";
    $("input[name='"+this.attr('name')+"']").addClass('error_radio');
}
$.prototype.removeRadioError = function(){
    var error = "Il manque une donnée";
    $("input[name='"+this.attr('name')+"']").removeClass('error_radio');
}

$.prototype.removeError = function(){
    if(!this.hasClass('error_input')){
        return;
    }
    this.removeClass('error_input');
    var target = $('.error_modal[data-input="' + this.attr('id') + '"]');
    target.remove();
}

function optionalParameter(variable, defaultValue){
    if(variable == undefined){
        return defaultValue;
    }
    else{
        return variable;
    }
}

$(document).ready(function(){

var $form = $('form.toCheck');

$form.each(function(){
    var $_this = $(this);
    var $sender = $(this).find('input[type="submit"]');
    $sender.click(function(e){
        e.preventDefault();

        var errorInForm = false;

        var $isChecked = $_this.find('.isChecked');
        var $isDate = $_this.find('.isDate');
        var $isSimple = $_this.find('.isSimple');
        var $isLetter = $_this.find('.isLetter');
        var $isNumber = $_this.find('.isNumber');
        var $isMail = $_this.find('.isMail');
        var $isPhoneNumber = $_this.find('.isPhoneNumber');
        
        var $password = $_this.find(".password_check");
        var $password_confirm = $_this.find(".password_confirm_check");

        $isChecked.each(function(){
            
            var name = $(this).attr('name');
            if(!$_this.find('input[name="'+name+'"]').is(':checked')){
                errorInForm = true;
                $(this).radioError();
            }
            else{
                $(this).removeRadioError();
            }
            
        });
        
        $isDate.each(function(){

            var value = $(this).val();
            if(!Date.parse(value.formatFrDateToJSDateFormat())){
                errorInForm = true;
                $(this).inputError('date');
            }
            else{
                $(this).removeError();
            }
        });

        $isSimple.each(function(){

            var value = $(this).val();
            var minLength = parseInt($(this).attr('data-min'));
            if(!value.isSimpleString(minLength)){
                errorInForm = true;
                $(this).inputError('length', minLength);
            }
            else{
                $(this).removeError();
            }
        });

        $isLetter.each(function(){

            var value = $(this).val();
            var minLength = parseInt($(this).attr('data-min'));
            if(!value.isLetterString(minLength)){
                errorInForm = true;
                $(this).inputError('letter', minLength);
            }
            else{
                $(this).removeError();
            }
        });

        $isNumber.each(function(){

            var value = $(this).val();
            if(!value.isNumeric()){
                errorInForm = true;
                $(this).inputError('number');
            }
            else{
                $(this).removeError();
            }
        });

        $isMail.each(function(){

            var value = $(this).val();
            if(!value.isMail()){
                errorInForm = true;
                $(this).inputError('mail');
            }
            else{
                $(this).removeError();
            }
        });

        $isPhoneNumber.each(function(){

            var value = $(this).val();
            if(!value.isPhoneNumber()){
                errorInForm = true;
                $(this).inputError('phone');
            }
            else{
                $(this).removeError();
            }
        });
        
        if($password.length > 0 && $password_confirm.length > 0){

            if( $password.val().length < 5 ){
                errorInForm = true;
                $password.removeError();
                $password.inputError('length', 5);
            }
            else if($password.val() != $password_confirm.val()){
                errorInForm = true;
                $password.removeError();
                $password.inputError('pwd');
            }
            else{
                $password.removeError();
            }
            
        }

        if(errorInForm == false){
            $_this.submit();
        }

    });
});



});