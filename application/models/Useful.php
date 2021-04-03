<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Useful extends CI_Model
{

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
    
    function thai_date(){
        $original_date = date("d");
        $original_wday = date("l");
        $original_month = date("F");
        $original_year = date("Y");
        
        $TH_Day = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
        $TH_Month = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    
        $nDay = date("w");
        $nMonth = date("n")-1;
        $date = date("j");
        $year = date("Y")+543;
    
        return $date." ".$TH_Month[$nMonth]." ".$year;
    
    }
}

/* End of file Useful.php */
