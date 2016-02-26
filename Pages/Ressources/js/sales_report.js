$(document).ready(function(){
    
    $("#calendar").change(function(){
        $("#hidden_date").val($(this).val());
    });
    
    $("input[name='contri_seller[]']").each(function(){
        var val = $(this).val();
        $("#seller_opt option[value='"+val+"']").remove();
    });
    $("input[name='contri_observer[]']").each(function(){
        var val = $(this).val();
        $("#observer_opt option[value='"+val+"']").remove();
    });
    
    //Ajout de personnes présentes
    $("#persons").on('change', function(){
        var $selected = $("#persons option:selected");
        var name = "";
        if($selected.parent('optgroup').attr('id') == "seller_opt"){
            name = "contri_seller[]";
        }
        else{
            name="contri_observer[]"
        }
        if($selected && $selected.not('.noOne')){
            var $span = "<span data-val='" + $selected.val() + "' data-text='" + $selected.text() + "' class='added_person' >";
            $span += $selected.text();
            $span += "<input type='hidden' value='" + $selected.val() + "' name='" + name + "' />";
            $span += "</span>";
            
            $selected.remove();
            $("#sales_block_persons").append($span);
            bindClickOnContributor();
        }
       
    });
    
    //Activité commerciale
    var $line  = "<tr>" + $('#original').html() + "</tr>";
    $('#original').removeAttr('id');  
    
    //Ajout ligne
    function bindAddLine(){
        $("#commercial_activity .rbtn.add").unbind('click').click(function(){  
            var $lastTr
            if($(this).hasClass('new')){
                $("#commercial_activity tr.disabled").before( $line );
                $lastTr = $("#commercial_activity tr.disabled").prev();
            }
            else{
                $(this).parents('tr').after( $line );
                $lastTr = $(this).parents('tr').next();
            }
            //Reset line
            $lastTr.find('input[type="text"]').val('');
            bindSellerSelection();
            var $firstOpt = $lastTr.find('select option').first();
            $firstOpt.prop('selected', true);
            $lastTr.find('select').change();


            bindRemoveLineOnTrash();
            bindTripleButonAction();
            bindSellerSelection();
            bindAddLine();
            bindMarkGestion();
            bindSelectEvent();
        });
    }
    
    bindAddLine();
    bindRemoveLineOnTrash();
    bindTripleButonAction();
    bindSellerSelection();
    bindClickOnContributor();
    bindMarkGestion();
    bindSelectEvent();
    
    function bindClickOnContributor(){
        $('.added_person').unbind('click').click(function(){
                var type = $(this).children('input').attr('name');
                
                var $option = "<option value='" + $(this).attr('data-val') + "'>"+ $(this).attr('data-text') +"</option>";
                $(this).remove();
                
                if(type == "contri_seller[]")
                    $("#seller_opt").append($option);
                
                else if(type == "contri_observer[]")
                    $("#observer_opt").append($option);
                
            });
    }
    //Retirer ligne
    function bindRemoveLineOnTrash(){
        $('#commercial_activity .trash').click(function(){
            $(this).parent('tr').remove();
        });
    }
    
    //Triple button action

    function bindTripleButonAction(){
        $('.lbtn:not(.disabled)').unbind('click').click(function(){
            var $this = $(this);
            if($this.hasClass('squared')){
                setTimeout(function(){
                    $this.siblings('.lbtn').removeClass('noDisp');
                }, 500);
                $this.removeClass('squared'); 
                $this.siblings('.input_statut').val(0);
            }
            else{
                $this.siblings('.input_statut').val($this.attr('data-value'));
                $this.siblings('.lbtn').addClass('noDisp');
                setTimeout(function(){
                    $this.addClass('squared');   
                }, 500);
            }
        });
    }
    
    //Gestion marques
    function bindSellerSelection(){
        $(".activity_seller").unbind('change').change(function(){
            var $marks = $(this).parents('tr').find('.activity_marks');
            var user_id = G_user_id;
            var seller_id = parseInt($(this).children('option:selected').val());

            $.ajax({
                url : 'ajaxManagement/sellerMark.php',
                method : 'post',
                data : {
                    user_id : user_id,
                    seller_id : seller_id
                },
                success : function(data){
                    var opts = buildMarkSellect(data);
                    $marks.html(opts);
                    bindSellerSelection();
                },
                error : function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
             });
        });
    }
    
    function buildMarkSellect(data){
        var array = data.marks;
        var vo = data.VO;
        var firstMark = data.firstMark;
        
        var opts = "";
        for(var key in array){
            var selected = "";
            if(array[key].id == firstMark){
                selected = "selected";
            }
            var opt = "<option value=" + array[key].id + " " + selected + " >" + array[key].name + "</option>";
            opts += opt;
        }
        if(vo == 1){
            opts += "<option value=0 class='other-mark' >Autre</option>"
        }
        return opts;
    }
    
    //other marks gestion
    function bindMarkGestion(){
        var $newMark = $('.newMark');
        if($newMark.length > 0){

            $('.activity_marks').unbind('change').change(function(){

               var $selected = $(this).find('option:selected');
               if($selected.hasClass('other-mark')){
                   $(this).parent().find('.newMark').fadeIn();
               }

            });

            $('.cancelMark').unbind('click').click(function(){
                $(this).parents('.newMark').fadeOut();
                $(this).parents('tr').find('.activity_marks option').first().prop('selected', true);
            });

            $('.validMark').unbind('click').click(function(){

                var $this = $(this);
                var markName = $this.parent().find('.newMarkName').val();
                if(markName.length > 0){

                    var parameters = {
                        newMark : 1,
                        markName : markName,
                        user_id : G_user_id
                    };

                    $.ajax({
                       url : 'ajaxManagement/sellerMark.php',
                       method : 'POST',
                       data : parameters,
                       dataType : 'json',
                       success : function(data){

                            var $marks = $this.parents('tr').find('.activity_marks');
                            var user_id = G_user_id;
                            var seller_id = parseInt($this.parents('tr').find(".activity_seller option:selected").val());
                            var firstMark = data.mark;
                            $.ajax({
                                url : 'ajaxManagement/sellerMark.php',
                                method : 'post',
                                data : {
                                    user_id : user_id,
                                    seller_id : seller_id
                                },
                                success : function(data){
                                    data.firstMark = firstMark;
                                    var opts = buildMarkSellect(data);
                                    $marks.html(opts);
                                    bindSellerSelection();
                                    $this.parents('.newMark').fadeOut();
                                },
                                error : function(jqXHR, textStatus, errorThrown){
                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }
                             });

                       },
                       error: function(){

                       }
                    });

                }

            });

        }
        
    }
    
    function bindSelectEvent(){
        $('.activity_marks').on('mousedown', function(event){
            var offsetRight = $(this).offset().left + $(this).innerWidth();
            
            if(event.clientX < (offsetRight - (0.2*$(this).innerWidth()))){
                event.preventDefault(); 
                $(this).focus();
            }
        });
    }

});
