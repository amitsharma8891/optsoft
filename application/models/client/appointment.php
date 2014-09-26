<?php

class appointment extends CI_Model {

    public function get_all_dates_between_two($date1, $date2) {
        $date_array = array();

        function returnDates($fromdate, $todate) {
            $fromdate = \DateTime::createFromFormat('d-m-Y', $fromdate);
            $todate = \DateTime::createFromFormat('d-m-Y', $todate);
            return new \DatePeriod(
                            $fromdate,
                            new \DateInterval('P1D'),
                            $todate->modify('+1 day')
            );
        }

        $datePeriod = returnDates($date1, $date2);
        foreach ($datePeriod as $date) {
//            echo $date->format('d-m-Y'), PHP_EOL;
            array_push($date_array, $date->format('d-m-Y'));
        }
        return $date_array;
    }
    
   

//    public function get_all_slots() {
//        
//    }


}

?>
