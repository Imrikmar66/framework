<?php


class DateFr {
    
    private $date;
    
    private $days = array(
        'Monday' => 'Lundi',
        'Tuesday' => 'Mardi',
        'Wednesday' => 'Mercredi',
        'Thursday' => 'Jeudi',
        'Friday' => 'Vendredi',
        'Saturday' => 'Samedi',
        'Sunday' => 'Dimanche',
    );
    
    private $months = array(
        'January' => 'Janvier',
        'February' => 'Février',
        'March' => 'Mars',
        'April' => 'Avril',
        'May' => 'Mai',
        'June' => 'Juin',
        'July' => 'Juillet',
        'August' => 'Août',
        'September' => 'Septembre',
        'October' => 'Octobre',
        'November' => 'Novembre',
        'December' => 'Décembre'
    );
    
    function __construct($date){
        $this->date = $date;
    }
    
    function getDate() {
        return $this->date;
    }

    function setDate($date) {
        $this->date = $date;
    }
    
    public function displayDate(){
        echo $this->date;
    }
    
    public function convertDate(){
        
        $this->convertMonth();
        $this->convertDay();

    }
    
    public function convertDay(){
        
        foreach($this->days as $en_day => $fr_day){
            
            if(stripos($this->date, $en_day) !== false){
                $this->date = str_replace($en_day, $fr_day, $this->date);
            }
            
        }
        
    }
    
    public function convertMonth(){
        
        foreach($this->months as $en_month => $fr_month){
            
            if(stripos($this->date, $en_month)){
                $this->date = str_replace($en_month, $fr_month, $this->date);
            }
            
        }
        
    }
    
    //Attention !!! Required date format dd/mm/yyyy
    public function toSQLFormat(){
        
        $yyyy = substr($this->date, 6);
        $mm = substr($this->date, 3, 2);
        $dd = substr($this->date, 0, 2);
        
        return $yyyy."-".$mm."-".$dd;
        
    }
    
    //Attention !!! Required date format yyyy-mm-dd
     public function SQLtoFrenchFormat(){
        
        $yyyy = substr($this->date, 0, 4);
        $mm = substr($this->date, 5, 2);
        $dd = substr($this->date, 8, 2);
        
        return $dd."/".$mm."/".$yyyy;
        
    }
    
    public function checkDateFormat(){
        
        if(preg_match("/[0-9][0-9](\/)[0-9][0-9](\/)[0-9][0-9][0-9][0-9]/", $this->date)){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function numberOfDaysSinceToday(){
        $now = time();
        $usedDate = strtotime($this->toSQLFormat());
        $datediff = $now - $usedDate;
        
        return floor($datediff/(60*60*24));
    }
    
    public function numberOfYearsSinceToday(){
        $now = time();
        $usedDate = strtotime($this->toSQLFormat());
        $datediff = $now - $usedDate;

        return floor($datediff / (365*60*60*24));
    }
    
}
