<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Useful extends CI_Model {

    function DateThai($strDate)
    {
        $strYear    =    date("Y", strtotime($strDate)) + 543;
        $strMonth =    date("n", strtotime($strDate));
        $strDay =    date("j", strtotime($strDate));
        $strHour =    date("H", strtotime($strDate));
        $strMinute =    date("i", strtotime($strDate));
        $strSeconds =  date("s", strtotime($strDate));
        $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        $strYearCut = substr($strYear, 2, 2); //เอา2ตัวท้ายของปี .พ.ศ. 
        return "$strDay $strMonthThai $strYear";
    } //end function DateThai


}

/* End of file Useful.php */
