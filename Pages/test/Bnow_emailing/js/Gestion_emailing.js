/* --------- Vérification des champs et envoi ajax ------------ */
    function BnowMailManager(datas){
        
        if(typeof datas.errorMessages === 'undefined'){
            datas.errorMessages = {
                required : 'Veuillez remplir les champs obligatoires',
                dataLength : 'caractères minimum',
                letterString : 'Ce champ ne peut comporter que des lettres',
                simpleString : 'Ce champ ne peut comporter que des caractère alphanumériques',
                mail : 'Le format mail est incorrect',
                phoneNumber : 'Le format numéro de téléphone est incorrect',
                numeric : 'Ce champ ne peut contenir que des caractère numériques',
                onlyLetter : 'Ce champ ne peut comporter que des lettres'
            };
        }
        
        this.$main = datas.$tag;
        this.errorMessage = datas.errorMessages;
        this.$all_fields = this.$main.find('input, textarea');
        this.$mail = this.$main.children(".bnow_mail_mail");
        this.$to_dest =this.$main.children('.to_dest');
        this.$to_tpl = this.$main.children('.to_tpl');
        this.$send = this.$main.children("input[type='submit']");
        this.$honeypot = this.$main.children('.bnow_email_honeypot');
        this.$errorMessage = this.$main.children('.error_info');

        this.webserviceUrl = this.$main.children('.to_service').val();

    }
    
    /*{
        required : 'Veuillez remplir les champs obligatoires',
        dataLength : 'caractères minimum',
        letterString : 'Ce champ ne peut comporter que des lettres',
        simpleString : 'Ce champ ne peut comporter que des caractère alphanumériques',
        mail : 'Le format mail est incorrect',
        phoneNumber : 'Le format numéro de téléphone est incorrect',
        numeric : 'Ce champ ne peut contenir que des caractère numériques',
        onlyLetter : 'Ce champ ne peut comporter que des lettres'
    }*/

    BnowMailManager.prototype.checkFields = function(){
        
        var context = this;
        var fieldsOk = true;
        var requiredFieldAlertAsOccured = false;
       
        context.$errorMessage.html('');
        context.$all_fields.removeClass('bnow_emailing_error');
        
        context.$all_fields.each(function(){
            
            var minLength = 0;

            if($(this).hasClass('isRequired') || $(this).val().length > 0){
                
                if($(this).hasClass('isRequired') && $(this).val().length < 1){
                    fieldsOk = false;
                    $(this).addClass('bnow_emailing_error');
                    if(requiredFieldAlertAsOccured === false){
                        context.$errorMessage.pAppend(context.errorMessage.required);
                        requiredFieldAlertAsOccured = true;
                    }
                }
                
                if($(this).attr("data-length")){
                    minLength = $(this).attr("data-length");
                    if($(this).val().length < minLength){
                        fieldsOk = false;
                        $(this).addClass('bnow_emailing_error');
                        context.$errorMessage.pAppend(minLength + ' ' + context.errorMessage.dataLength);
                    }
                }

               if($(this).hasClass("isLetterString")){
                   if(!Tools.isLetterString($(this).val(), minLength)){
                        fieldsOk = false;
                        $(this).addClass('bnow_emailing_error');
                        context.$errorMessage.pAppend(context.errorMessage.letterString);
                    }
               }
               else if($(this).hasClass("isSimpleString")){
                   if(!Tools.isSimpleString($(this).val(), minLength)){
                        fieldsOk = false;
                        $(this).addClass('bnow_emailing_error');
                        context.$errorMessage.pAppend(context.errorMessage.simpleString);
                    }
               }
               else if($(this).hasClass("isMail")){
                   if(!Tools.isMail($(this).val())){
                        fieldsOk = false;
                        $(this).addClass('bnow_emailing_error');
                        context.$errorMessage.pAppend(context.errorMessage.mail);
                    }
               }
               else if($(this).hasClass("isPhoneNumber")){
                   if(!Tools.isPhoneNumber($(this).val())){
                        fieldsOk = false;
                        $(this).addClass('bnow_emailing_error');
                        context.$errorMessage.pAppend(context.errorMessage.phoneNumber);
                    }
               }
               else if($(this).hasClass("isNumeric")){
                   if(!Tools.isNumeric($(this).val())){
                        fieldsOk = false;
                        $(this).addClass('bnow_emailing_error');
                        context.$errorMessage.pAppend(context.errorMessage.numeric);
                    }
               }
               else if($(this).hasClass("isOnlyLetter")){
                   if(!Tools.isOnlyLetter($(this).val())){
                        fieldsOk = false;
                        $(this).addClass('bnow_emailing_error');
                        context.$errorMessage.pAppend(context.errorMessage.onlyLetter);
                    }
               }
               
           }
            
        });
        
        if(this.$honeypot.val().length > 0){
            fieldsOk = false;
        }

        return fieldsOk;

    }

BnowMailManager.prototype.init = function(){

    /*$('.bnow_email_form').each(function(){*/
        
    var BnowMailMainManager = this;

    BnowMailMainManager.$send.click(function(event){
       event.preventDefault();

       if(!BnowMailMainManager.checkFields()){
           //alert("Attention ! Certains champs sont incorrects !");
           return false;
       }

        var datas = {
        };
        datas['isPJ'] = 0;
        var files = [];

        BnowMailMainManager.$all_fields.each(function(){
            if(!$(this).is('input[type="file"]')){
                datas[$(this).attr('name')] = $(this).val();
            }
            else{
                var input = $(this)[0];
                if(!input){
                   //console.log("no input"); 
                }
                else if(!input.files){
                    //console.log("no files"); 
                }
                else if(!input.files[0]){
                    //console.log("no file"); 
                }
                else{
                    files[$(this).attr('name')] = input.files[0];
                    datas['isPJ'] = 1;
                }
            }

        });

        datas = JSON.stringify(datas);

       var formData = new FormData();

       formData.append("sendMail", 1);
       formData.append("from", BnowMailMainManager.$mail.val());
       formData.append("to", BnowMailMainManager.$to_dest.val());
       formData.append("template", BnowMailMainManager.$to_tpl.val());
       formData.append("header_content", BnowMailMainManager.$mail.val());
       formData.append("templateDatas", datas);
       for(var key in files){
           formData.append(key, files[key]);
       }
	   
       $.ajax({
            url: BnowMailMainManager.webserviceUrl,
            method: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            type : "json",
            xhr: function() {
                myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){
                    myXhr.upload.addEventListener('progress',function(){}, false);
                }
                return myXhr;
            },
            success: function(data){
                BnowMailMainManager.$send.prop('disabled', true);
                BnowMailMainManager.$send.val('Merci');
				BnowMailMainManager.$send.addClass('btn_thanks');
				console.log(data);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log('error durring ajax call :'+ errorThrown);
            }
        });

    });
        
    /*});*/
    
};
    
$.prototype.pAppend = function(val){
    this.append('<p>'+val+'</p>');
};
$.prototype.bnow_emailing = function(errorMess){
    var datas = {
        $tag : this,
        errorMessages : errorMess
    };
    var mailManager = new BnowMailManager(datas);
    mailManager.init();
}
/* ---------------------------------- Verifing tools ------------------------------------ */

function Tools() {

}

Tools.isLetterString = function(string, minLength) {
    if(string.length >= minLength && Tools.isOnlyLetter(string)){
        return true;
    }
    else {
        return false;
    }
}

Tools.isSimpleString = function(string, minLength){
    if(string.length >= minLength){
        return true;
    }
    else {
        return false;
    }
}

Tools.isMail = function(string){
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(string);
}

Tools.isPhoneNumber = function(string){
    if(string.length == 10 && Tools.isNumeric(string)){
        return true
    }
    else {
        return false;
    }
}

Tools.isNumeric = function(string){
    return /^\d+$/.test(string);
}

Tools.isOnlyLetter = function(string){
    return /^[a-zA-Z\u00C0-\u017F]+$/.test(string);
}