String.prototype.formatFrDateToJSDateFormat = function (){
    
    var date = this.split("/");
    
    var day = date[0];
    var month = date[1];
    var year = date[2];
    
    return year + "-" + month + "-" + day;
}

function dateIsBetween(d1, d2, dBetween){
    return (d1.getTime() <= dBetween.getTime()) && (dBetween.getTime() <= d2.getTime());
}

$(document).ready(function(){

    var $date1 = $('.date1');
    var $date2 = $('.date2');
    var $date3 = $('.date3');
    var $date4 = $('.date4');
    var $Ftrs = $('#formation-table tbody tr');
    var $Itrs = $('#interview-table tbody tr');
    var $Ftbody = $('#formation-table tbody');
    var $Itbody = $('#interview-table tbody');
    var $Fcalendar = $('#panel-formation .img_calendar');
    var $Icalendar = $('#panel-vendeur .img_calendar');
    
    $Fcalendar.click(function(){
        $date1.val("");
        $date2.val("");
        $Ftbody.empty();
        $Ftrs.each(function(){
            $Ftbody.append($(this));
        });
    });
    
    $Icalendar.click(function(){
        $date3.val("");
        $date4.val("");
        $Itbody.empty();
        $Itrs.each(function(){
            $Itbody.append($(this));
        });
    });
    
    $date1.datepicker({
        onSelect: function() {
            if($date1.val().length > 0 && $date2.val().length > 0){
                reOrderFormations();
            }
        }
    });
    $date2.datepicker({
        onSelect: function() {
            if($date2.val().length > 0 && $date1.val().length > 0){
                reOrderFormations();
            }
        }
    });
    $date3.datepicker({
        onSelect: function() {
            if($date3.val().length > 0 && $date4.val().length > 0){
                reOrderInterviews();
            }
        }
    });
    $date4.datepicker({
        onSelect: function() {
            if($date4.val().length > 0 && $date3.val().length > 0){
                reOrderInterviews();
            }
        }
    });
    
    function reOrderFormations(){
        
        var date1 = new Date($date1.val().formatFrDateToJSDateFormat());
        var date2 = new Date($date2.val().formatFrDateToJSDateFormat());
            
        var $htmlFormations = [];
        
        for(var i in formations){
            var formation = formations[i];
            if(dateIsBetween(date1, date2, new Date(formation.date))){
                $htmlFormations.push($Ftrs[formations[i].order]);
            }
        }
        
        $Ftbody.empty();
        for(var y in $htmlFormations){
            $Ftbody.append($htmlFormations[y]);
        }
        
    }
    
    function reOrderInterviews(){
        
        var date3 = new Date($date3.val().formatFrDateToJSDateFormat());
        var date4 = new Date($date4.val().formatFrDateToJSDateFormat());
        
        var $htmlInterviews = [];
        
        for(var i in interviews){
            var interview = interviews[i];
            if(dateIsBetween(date3, date4, new Date(interview.date))){
                $htmlInterviews.push($Itrs[interviews[i].order]);
            }
        }
        
        $Itbody.empty();
        for(var y in $htmlInterviews){
            $Itbody.append($htmlInterviews[y]);
        }
        
    }
    
    
    
    
});
