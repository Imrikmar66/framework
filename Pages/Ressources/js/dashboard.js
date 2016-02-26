//
Date.prototype.addDays = function(days){
    var dat = new Date(this.valueOf());
    dat.setDate(dat.getDate() + days);
    return dat;
}

Date.prototype.formatDateToString = function (){
    var date = new Date(this.valueOf());
    var day = parseInt(date.getDate());
    var month = parseInt(date.getMonth())+1
    var day = day < 10 ? "0" + day : day;
    var month = month < 10 ? "0" + month : month;
    var years = date.getFullYear();
    return years + "-" + month + "-" + day;
}

/*function getLastWednesday() {
  d = new Date();
  var day = d.getDay(),
      diff = d.getDate() - day + (day == 0 ? -6:3); // adjust when day is sunday
  return new Date(d.setDate(diff));
}*/

function getLastWednesday(weekNumber) {
  d = new Date();
  var day = d.getDay() + (7*weekNumber),
      diff = d.getDate() - day + (day == 0 ? -6:3); // adjust when day is sunday
  return new Date(d.setDate(diff));
}

function dateIsBetween(d1, d2, dBetween){
    return (d1.getTime() < dBetween) && (dBetween < d2.getTime());
}

function calcDataForWeek(week){

    //Get All needed dates
    var currentWeekArray = [];
    for(var i in rapports){
        if (dateIsBetween(getLastWednesday(week + 1), getLastWednesday(week), new Date(rapports[i].date))){
            currentWeekArray.push(rapports[i]);
        }
    }

    //Calc percentage
    var Statut1 = 0;
    var Statut2 = 0;
    var Statut3 = 0;

    for(var i in currentWeekArray){
        var activities = currentWeekArray[i].activities;

        for(var y in activities){
            activity = parseInt(activities[y].statut);
            switch(activity){
                case 1 : 
                    Statut1++;
                    break;
                case 2 : 
                    Statut2++;
                    break;    
                case 3 : 
                    Statut3++;
                    break;
                default:
                    break;
            }
        }  
    }

    var FullStatut = Statut1 + Statut2 + Statut3;

    if(FullStatut != 0){
        Statut1 = Math.round((100*Statut1)/FullStatut)/100;
        Statut2 = Math.round((100*Statut2)/FullStatut)/100;
        Statut3 = Math.round((100*Statut3)/FullStatut)/100;
    }
    else{
        Statut1 = 0;
        Statut2 = 0;
        Statut3 = 0;
    }
    
    var Percent = {
        Statut1 : Statut1,
        Statut2 : Statut2,
        Statut3 : Statut3
    }

    var weekDate = {
        d1 : {
                date : getLastWednesday(week + 1),
                st1 : 0,
                st2 : 0,
                st3 : 0
        },
        d2 : {
                date : getLastWednesday(week + 1).addDays(1),
                st1 : 0,
                st2 : 0,
                st3 : 0
        },
        d3 : {
                date : getLastWednesday(week + 1).addDays(2),
                st1 : 0,
                st2 : 0,
                st3 : 0
        },
        d4 : {
                date : getLastWednesday(week + 1).addDays(3),
                st1 : 0,
                st2 : 0,
                st3 : 0
        },
        d5 : {
                date : getLastWednesday(week + 1).addDays(4),
                st1 : 0,
                st2 : 0,
                st3 : 0
        },
        d6 : {
                date : getLastWednesday(week + 1).addDays(5),
                st1 : 0,
                st2 : 0,
                st3 : 0
        },
        d7 : {
                date : getLastWednesday(week + 1).addDays(6),
                st1 : 0,
                st2 : 0,
                st3 : 0
        }
    }

    for(var i in currentWeekArray){
        var current = currentWeekArray[i];
        for(var y in weekDate){
            var object = weekDate[y];
            if(current.date == object.date.formatDateToString()){
                var activities = current.activities;
                for(var z in activities){
                    activity = parseInt(activities[z].statut);
                    switch(activity){
                        case 1 : 
                            weekDate[y].st1++;
                            break;
                        case 2 : 
                            weekDate[y].st2++;
                            break;    
                        case 3 : 
                            weekDate[y].st3++;
                            break;
                        default:
                            break;
                    }
                }  

            }
        }

    }
    
    drawChart(weekDate);
    drawCircle(Percent);
    
}

//google graphics
google.load("visualization", "1", {packages:["corechart"]});
//google.setOnLoadCallback(drawChart);

function drawChart(weekDate) {
  var data = new google.visualization.DataTable();
    data.addColumn('date');
    data.addColumn('number', 'Vendu');
    data.addColumn({role: 'annotation', type: 'string'}, 'annotations');
    data.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}}, 'tooltips');
    data.addColumn('number', 'En cours');
    data.addColumn({role: 'annotation', type: 'string'}, 'annotations');
    data.addColumn('number', 'Abandon');
    data.addColumn({role: 'annotation', type: 'string'}, 'annotations');
    data.addRows([
      [{f:"Mercredi" ,  v:weekDate.d1.date},  weekDate.d1.st3,null,/*createCustomHTMLContent("a + b= d")*/null,weekDate.d1.st2,null, weekDate.d1.st1,null],
      [{f:"Jeudi" ,     v:weekDate.d2.date},  weekDate.d2.st3,/*"50 ↑ 10%"*/null,null,  weekDate.d2.st2,null, weekDate.d2.st1,null],
      [{f:"Vendredi" ,  v:weekDate.d3.date},  weekDate.d3.st3,null,null,weekDate.d3.st2,null, weekDate.d3.st1,null],
      [{f:"Samedi" ,    v:weekDate.d4.date},  weekDate.d4.st3,null,null,weekDate.d4.st2,/*"B"*/null, weekDate.d4.st1,null],
      [{f:"Dimanche" ,  v:weekDate.d5.date},  weekDate.d5.st3,null,/*"a + b= d"*/null,weekDate.d5.st2,null,  weekDate.d5.st1,/*"C"*/null],
      [{f:"Lundi" ,     v:weekDate.d6.date},  weekDate.d6.st3,null,null,weekDate.d6.st2,null,  weekDate.d6.st1,null],
      [{f:"Mardi" ,     v:weekDate.d7.date},  weekDate.d7.st3,null,null,weekDate.d7.st2,null,  weekDate.d7.st1,null]
    ]);
    
 var $element = $('#graphic_container');
  var options = {
    vAxis: {
        minValue: 0
    },
    //legend: {position: 'none'},
    colors : ['#70b93b', '#ee7e2a', '#db4c3c'],
    pointSize: 5,
    pointShape: { type: 'circle', rotation: 180 },
    pointsVisible: true,
    tooltip: {isHtml: true},
    width: $element.width(),
    height: $element.height(),
   animation: {
        duration: 1000,
        easing: 'out'
      }
    /*annotations: {
        boxStyle: {
          // Color of the box outline.
          //stroke: '#888',
          // Thickness of the box outline.
          strokeWidth: 0,
          // x-radius of the corner curvature.
          rx: 10,
          // y-radius of the corner curvature.
          ry: 10,
          // Attributes for linear gradient fill.
          x: 20,
          y: 10,
          gradient: {
                // Start color for gradient.
                color1: '#fbf6a7',
                // Finish color for gradient.
                color2: '#33b679',
                // Where on the boundary to start and
                // end the color1/color2 gradient,
                // relative to the upper left corner
                // of the boundary.
                x1: '0%', y1: '0%',
                x2: '100%', y2: '100%',
                // If true, the boundary for x1,
                // y1, x2, and y2 is the box. If
                // false, it's the entire chart.
                useObjectBoundingBoxUnits: true
            }
        }
    }*/
  };
  
    function createCustomHTMLContent(content) {
        return '<div style="padding:5px 5px 5px 5px;"><span>'+content+'</span></div>';
    }

  var chart = new google.visualization.AreaChart(document.getElementById('graphic_container'));
  chart.draw(data, options);
}

//circles 
var circle1 = new ProgressBar.Circle('#circle_1', {
        color: '#000',
        strokeWidth: 8,
        trailWidth: 8,
        easing: 'easeInOut',
        duration: 1000,
        text: {
            value: '0'
        },
        from: { color: '#70b93b', width: 8 },
        to: { color: '#70b93b', width: 8 },
        // Set default step function for all animate calls
        step: function(state, circle) {
            circle.path.setAttribute('stroke', state.color);
            circle.path.setAttribute('stroke-width', state.width);
             circle.setText((circle.value() * 100).toFixed(0) + "%");
        }
    });

var circle2 = new ProgressBar.Circle('#circle_2', {
    color: '#000',
    strokeWidth: 8,
    trailWidth: 8,
    easing: 'easeInOut',
    duration: 1000,
    text: {
        value: '0'
    },
    from: { color: '#ee7e2a', width: 8 },
    to: { color: '#ee7e2a', width: 8 },
    // Set default step function for all animate calls
    step: function(state, circle) {
        circle.path.setAttribute('stroke', state.color);
        circle.path.setAttribute('stroke-width', state.width);
         circle.setText((circle.value() * 100).toFixed(0) + "%");
    }
});

var circle3 = new ProgressBar.Circle('#circle_3', {
    color: '#000',
    strokeWidth: 8,
    trailWidth: 8,
    easing: 'easeInOut',
    duration: 1000,
    text: {
        value: '0'
    },
    from: { color: '#db4c3c', width: 8 },
    to: { color: '#db4c3c', width: 8 },
    // Set default step function for all animate calls
    step: function(state, circle) {
        circle.path.setAttribute('stroke', state.color);
        circle.path.setAttribute('stroke-width', state.width);
         circle.setText((circle.value() * 100).toFixed(0) + "%");
    }
});
    
function drawCircle(Percent){

    circle1.max = Percent.Statut3;    
    circle2.max = Percent.Statut2;
    circle3.max = Percent.Statut1;
    
    //Animation
    circle1.animate(circle1.max, function() {
        //circle.animate(0);
    });
    circle2.animate(circle2.max, function() {
        //circle.animate(0);
    });
    circle3.animate(circle3.max, function() {
        //circle.animate(0);
    });
}
  
$(document).ready(function(){
   var week = 0;
   calcDataForWeek(week);
   
   $left = $('.arrow.left');
   $right = $('.arrow.right');
   $left.click(function(){
       week++;
       calcDataForWeek(week);
   });
   $right.click(function(){
       week--;
       calcDataForWeek(week);
   });
   
   
});
$(window).resize(function(){
   calcDataForWeek(0);
});

//Gestion des panneaux

var $onglets = $('#dashboard-panel li');
var $panels = $('#dashboard-panel .panel');
$onglets.click(function(){
   
    var position = $(this).index('li');
    $onglets.removeClass('active');
    $panels.removeClass('active');
    $(this).addClass('active');
    $('#dashboard-panel .panel:eq('+position+')').addClass('active');
 
});

//Seller delete
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
                       if($('#gestion-table tbody tr').length < 1){
                           $('#gestion-table').remove();
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
   
   $('.delete_observer').click(function(){
       var $this = $(this);
       var message = "Voulez vous vraiment supprimer ce collaborateur ?";
       confirm(message, function(){
            var id = $this.attr('data-observer');
            var parent = $this.parents('tr');
            $.ajax({
               url : "ajaxManagement/manageUser.php",
               method : "post",
               dataType : "json",
               data : {
                   action : "delete_observer",
                   user_id : id
               },
               success : function(data){
                   if(data.status == "success"){
                       parent.remove();
                       if($('#gestion-table tbody tr').length < 1){
                           $('#gestion-table').remove();
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
          //Tri des informations par date
    var $date1 = $('.date1');
    var $date2 = $('.date2');
    var $Rtrs = $('#rapport-table tbody tr');
    var $Rtbody = $('#rapport-table tbody');
    var $Rcalendar = $('#panel-gestion .img_calendar');
    
    $Rcalendar.click(function(){
        $date1.val("");
        $date2.val("");
        $Rtbody.empty();
        $Rtrs.each(function(){
            $Rtbody.append($(this));
        });
    });
    
    $date1.datepicker({
        onSelect: function() {
            if($date1.val().length > 0 && $date2.val().length > 0){
                reOrderRapports();
            }
        }
    });
    $date2.datepicker({
        onSelect: function() {
            if($date2.val().length > 0 && $date1.val().length > 0){
                reOrderRapports();
            }
        }
    });
    
    function reOrderRapports(){
        
        var date1 = new Date($date1.val().formatFrDateToJSDateFormat());
        var date2 = new Date($date2.val().formatFrDateToJSDateFormat());
            
        var $htmlRapports = [];
        
        for(var i in rapportsOrder){
            var rapport = rapportsOrder[i];
            if(dateIsBetween(date1, date2, new Date(rapport.date_creation))){
                $htmlRapports.push($Rtrs[rapportsOrder[i].order]);
            }
        }
        
        $Rtbody.empty();
        for(var y in $htmlRapports){
            $Rtbody.append($htmlRapports[y]);
        }
        
    }
})