<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Load_data extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    function userpass($type, $user, $pass)
    {
        /*
        $dtb = new mysqli('localhost', 'root', '', 'sumsaha') or die("ERROR");
        
        $es = $dtb->real_escape_string($pass);
        $dtb->close();
        */
        $realpass = md5($this->db->escape_like_str($pass));
        if ($type == 'adm') {
            $sql = "SELECT * from upr where users_name=? and users_password=?";
        } else {
            $sql = "SELECT * from student where student_id=? and student_password=? and student_start<=date(now()) and student_end>=DATE_ADD(now(), INTERVAL -10 DAY)"; //เลื่อนไป 10 วัน
        }
        return $this->db->query($sql, array($user, $realpass))->result();
    }

    function allstudent()
    {
        $sql = "SELECT count(*) count from student where  student_start<=date(now()) and student_end>=date(now())";
        return $this->db->query($sql)->result();
    }
    function allsummer()
    {
        $sql = "SELECT count(*) count from student where  student_start<=date(now()) and student_end>=date(now()) and student_type=1";
        return $this->db->query($sql)->result();
    }
    function allcoop()
    {
        $sql = "SELECT count(*) count from student where  student_start<=date(now()) and student_end>=date(now()) and student_type=2";
        return $this->db->query($sql)->result();
    }
    function nextend()
    {
        $sql = "SELECT min(student_End) mi,max(student_End) ma
        from student
        where  student_start<=date(now()) 
        and student_end>=date(now())";
        return $this->db->query($sql)->result();
    }
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

/* End of file load_data.php */
