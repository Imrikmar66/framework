$(document).ready(function(){

    //Main user edition
    $("#info-profil .edit").click(function(){
       $(this).addClass('noDisp');
       $('.cancel').removeClass("noDisp")
       $('#edit_info').removeClass("noDisp");
       var $inputs = $('#info-list input.disabled');
       var $checkboxs = $('#activity_choice input');
       $inputs.removeClass("disabled");
       $inputs.prop('disabled', false);
       $checkboxs.prop('disabled', false);
       $('#label_password_valid').removeClass("noDisp");
    });
    
    $("#info-profil .cancel").click(function(){
       $(this).addClass("noDisp")
       $('#edit_info').addClass("noDisp");
       $("#info-list .edit").removeClass("noDisp");
       var $inputs = $('#info-list input');
       var $checkboxs = $('#activity_choice input');
       $inputs.addClass("disabled");
       $inputs.prop('disabled', true);
       $checkboxs.prop('disabled', true);
       $('#label_password_valid').addClass("noDisp");
    });
    
    //Equip edition
    $('.edit_user').click(function(){
        var id = $(this).attr('data-user');
        $('.edit-profil').addClass('noDisp');
        $('.edit-profil[data-user="'+id+'"]').removeClass('noDisp');
        
    });
    
    $('.edit-profil .cancel').click(function(){
       
       $('.edit-profil').addClass('noDisp')
        
    });
    
    $('.see_equip').click(function(){
       
       var id = $(this).attr('data-user');
       var $vendors = $('.vendors[data-user="'+id+'"]');
       $vendors.toggleClass('noDisp');
       
    });
    
    //calendar
    if($('.user_calendar').length >0){
        $('.user_calendar').datepicker();
    }
    
    //Valid users admin
   $("#valid-team .accept_link").click(function(){
       var id = $(this).attr('data-val');
       var parent = $(this).parents('tr');

       $.ajax({
           url : "ajaxManagement/manageUser.php",
           method : "post",
           dataType : "json",
           data : {
               action : "accept",
               user_id : id
           },
           success : function(data){
               if(data.status == "success"){
                   parent.remove();
                   if($('#valid-team tbody tr').length < 1){
                       $('#valid-team').remove();
                   }
               }
               else{
                   alert("Une erreur s'est produite");
               }
           },
           error : function(jqXHR, textStatus, errorThrown){
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                alert("Une erreur s'est produite");
           }
       });
   });
   
   $("#valid-team .refuse_link").click(function(){
        var $this = $(this);
        var message = "Voulez-vous vraiment refuser cette demande ?";
        confirm(message, function(){
            var id = $this.attr('data-val');
            var parent = $this.parents('tr');
           $.ajax({
               url : "ajaxManagement/manageUser.php",
               method : "post",
               dataType : "json",
               data : {
                   action : "refuse",
                   user_id : id
               },
               success : function(data){
                   if(data.status == "success"){
                       parent.remove();
                       if($('#valid-team tbody tr').length < 1){
                           $('#valid-team').remove();
                       }
                   }
                   else{
                       alert("Une erreur s'est produite");
                   }
               },
               error : function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                    alert("Une erreur s'est produite");
               }
           });
       });
   });
   
   $('.delete_user').click(function(){
       var $this = $(this);
       var message = "Voulez vous vraiment supprimer ce collaborateur ?";
        confirm(message, function(){
            var id = $this.attr('data-user');
            var parent = $this.parents('tr');
           $.ajax({
               url : "ajaxManagement/manageUser.php",
               method : "post",
               dataType : "json",
               data : {
                   action : "delete_user",
                   user_id : id
               },
               success : function(data){
                   if(data.status == "success"){
                       parent.remove();
                       if($('#info-team tbody tr').length < 1){
                           $('#info-team').remove();
                       }
                   }
                   else{
                       alert("Une erreur s'est produite");
                   }
               },
               error : function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                    alert("Une erreur s'est produite");
               }
           });
       });
   });
   
   $('.delete_seller').click(function(){
       var $this = $(this);
       var message = "Voulez vous vraiment supprimer ce collaborateur ?";
       confirm(message, function(){
            var id = $this.attr('data-seller');
            var parent = $this.parents('tr');
            $.ajax({
               url : "ajaxManagement/manageUser.php",
               method : "post",
               dataType : "json",
               data : {
                   action : "delete_seller",
                   user_id : id
               },
               success : function(data){
                   if(data.status == "success"){
                       parent.remove();
                       if($('#info-seller tbody tr').length < 1){
                           $('#info-seller').remove();
                       }
                   }
                   else{
                       alert("Une erreur s'est produite");
                   }
               },
               error : function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                    alert("Une erreur s'est produite");
               }
           });
       });
   });
   
   function confirm(message, callback){
       
       var popup = "<div class='confirm'><p>"+message+"</p><span class='Y' >Oui</span><span class='N' >Non</span></div>";
       $('body').append(popup);
       var $popup = $('.confirm');
       $popup.fadeIn(200);
       $('.confirm .Y').unbind('click').click(function(){
           
           $popup.fadeOut(200, function(){ $popup.remove();});
           callback();
           
       });
       $('.confirm .N').unbind('click').click(function(){
           
           $popup.fadeOut(200, function(){ $popup.remove();});
           
       });
       
   }
   
});


