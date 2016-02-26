$(document).ready(function(){
    
    /*$('.return-button').click(function(e){
        e.preventDefault();
        var prev = document.referrer;
        var url = prev.replace("success_statut", "back");
        url = url.replace("error_statut", "back");
        window.location.href = url;
    });*/
/*
 Gestion du style de la page d'accueil / login en full screen
 */

    var height = $(document).height();
    $('#home_html').height(height);
    
    $(window).on('resize', function(e){
        var height = $(document).height();
        $('#home_html').height(height);
    });

/* 
 * Modal gestion 
 */

$('.modal').click(function(){
    var $this =$(this);
    $this.fadeOut(200, function(){
        $this.remove();
    })
});
/*
 Inscription datepicker
 */
    if(('#entry_date').length > 0){
        $('#entry_date').datepicker();
        $('#img_calendar, .img_calendar').click(function(){
            $('#entry_date').datepicker('show');
        });
    }
    if($('#calendar').length >0){
        $('#calendar').datepicker();
        $('#img_calendar, .img_calendar').click(function(){
            $('#calendar').datepicker('show');
        });
    }
    if($('.calendar').length >0){
        $('.calendar').datepicker();
        $('#img_calendar, .img_calendar').click(function(){
            $('.calendar').datepicker('show');
        });
    }

/*
 *Trace page
 */
    var $onglets = $('#trace-panel li');
    var $panels = $('#trace-panel .panel');
    $onglets.click(function(){

        var position = $(this).index('li');
        $onglets.removeClass('active');
        $panels.removeClass('active');
        $(this).addClass('active');
        $('#trace-panel .panel:eq('+position+')').addClass('active');

    });
    
    /*
     * Create vendor account
     */
    
    $('#collab_type').change(function(){
        var $selected = $('#collab_type option:selected');
       if($selected.val() == 0) {
           $('.vendor_block').slideDown();
       }
       else{
           $('.vendor_block').slideUp();
       }
    });

});

