<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Load_data extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    function userpass($type,$user,$pass){
        /*
        $dtb = new mysqli('localhost', 'root', '', 'sumsaha') or die("ERROR");
        
        $es = $dtb->real_escape_string($pass);
        $dtb->close();
        */
        $realpass = md5($this->db->escape_like_str($pass));
        if($type=='adm'){
            $sql = "SELECT * from upr where users_name=? and users_password=?";
        }else{
            $sql = "SELECT * from student where student_id=? and student_password=? and student_start<=date(now()) and student_end>=DATE_ADD(now(), INTERVAL -10 DAY)"; //เลื่อนไป 10 วัน
        }
        return $this->db->query($sql,array($user,$realpass))->result();

    }
}

/* End of file load_data.php */
