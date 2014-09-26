<?php 

class dateOperations {
   
    function sum($date,$what=FALSE,$value,$return_format='mysql') {
       
        list($year, $month, $day) = split("-", $date);
             
        if ($what!='day' && $what!='month' && $what!='year') return false;
       
        if ($what=='day')   $day    = $day + intval($value);
        if ($what=='month')     $month  = $month + intval($value);
        if ($what=='year')  $year   = $year + intval($value);
       
        $date_tmp = mktime(0, 0, 0, $month, $day, $year);    
           
        if ($return_format=='mysql') {
            $date_tmp = date('Y-m-d', $date_tmp);
        } elseif (!$return_format=='timestamp') {
            return false;  
        }
                       
        return $date_tmp;
       
    }
   
   
    function subtract($date,$what=FALSE,$value,$return_format='mysql') {
       
        list($year, $month, $day) = split("-", $date);
           
        if ($what!='day' && $what!='month' && $what!='year') return false;    
       
        if ($what=='day')   $day    = $day - intval($value);
        if ($what=='month')     $month  = $month - intval($value);
        if ($what=='year')  $year   = $year - intval($value);
       
        $date_tmp = mktime(0, 0, 0, $month, $day, $year);    
       
        if ($return_format=='mysql') {
            $date_tmp = date('Y-m-d', $date_tmp);
        } elseif (!$return_format=='timestamp') {
            return false;  
        }
                       
        return $date_tmp;
       
    }

   
}

?>