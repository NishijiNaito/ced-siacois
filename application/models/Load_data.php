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

    //end of main

    function getemp($id)
    {
        $sql = "SELECT * from users where users_id = ?";
        return $this->db->query($sql, array($id))->result();
    }
    function getuprs()
    {
        $sql = "SELECT users_id,users_name,users_role_name from upr";
        return $this->db->query($sql)->result();
    }
    function getroles()
    {
        $sql = "SELECT * from users_role";
        return $this->db->query($sql)->result();
    }

    //end of Emp

    function getallstds()
    {
        $sql = "SELECT * from student";
        return $this->db->query($sql)->result();
    }

    function getstd($id, $date)
    {
        $sql = "SELECT * from student where student_id = ? and student_Start=?";
        return $this->db->query($sql, array($id, $date))->result();
    }
    //end of std

    function getallunicols()
    {
        $sql = "SELECT * from unicol";
        return $this->db->query($sql)->result();
    }
    function getunicol($id)
    {
        $sql = "SELECT * from unicol where unicol_id = ?";
        return $this->db->query($sql, array($id))->result();
    }

    function getallfacs()
    {
        $sql = "SELECT * from faculty";
        return $this->db->query($sql)->result();
    }

    function getfac($id)
    {
        $sql = "SELECT * from faculty where faculty_id = ?";
        return $this->db->query($sql, array($id))->result();
    }

    function getalldeps()
    {
        $sql = "SELECT * from department";
        return $this->db->query($sql)->result();
    }

    function getdep($id)
    {
        $sql = "SELECT * from department where department_id = ?";
        return $this->db->query($sql, array($id))->result();
    }
    // end of subdata










    //Start of Student
    function getdateofstudent($id, $date)
    {
        $sql = "SELECT student_Start,student_End
        ,DATEDIFF(student_End, student_Start)+1 as dateall ,
        DATEDIFF(student_End, now())+1 as dateremain 
              from student where student_id = ? and student_Start=?";

        return $this->db->query($sql, array($id, $date))->result();
    }

    function getstddatas($id, $date)
    {
        $sql = "SELECT * from (student,department,UniCol) left join faculty on(student_Faculty=Faculty_id)
        where student_id=? and student_start =?
        and student_start<=date(now()) 
        and student_end>=date(now()) 
        
        and Department_id=student_department 
        and UniCol_id = student_UniCol";
        //and student_Faculty=Faculty_id 
        return $this->db->query($sql, array($id, $date))->result();
    }



    function getleaverequest($id, $date)
    {
        $sql = "SELECT * from sumsaha.leaves where Leaves_std_id=? and Leaves_std_start=? order by Leaves_id desc";
        return $this->db->query($sql, array($id, $date))->result();
    }
    function getleaveone($id, $date, $no)
    {
        $sql = "SELECT * from sumsaha.leaves where Leaves_std_id=? and Leaves_std_start=? and Leaves_id = ? order by Leaves_id desc";
        return $this->db->query($sql, array($id, $date, $no))->result();
    }

    //Start form

    function getallformaccept_all(){
        $sql = "SELECT * from (form_accept,department,UniCol) left join faculty on(form_fac=Faculty_id)
        where 
        Department_id=form_dep 
        and UniCol_id = form_unicol";
        //and student_Faculty=Faculty_id 
        return $this->db->query($sql)->result();
    }
    function getallformaccept_one($id){
        $sql = "SELECT * from (form_accept,department,UniCol) left join faculty on(form_fac=Faculty_id)
        where 
        Department_id=form_dep 
        and UniCol_id = form_unicol and form_id = ?";
        //and student_Faculty=Faculty_id 
        return $this->db->query($sql,array($id))->result();
    }
    
    function getallformreturn_all(){
        $sql = "SELECT * from (form_return,department,UniCol) left join faculty on(form_fac=Faculty_id)
        where 
        Department_id=form_dep 
        and UniCol_id = form_unicol";
        //and student_Faculty=Faculty_id 
        return $this->db->query($sql)->result();
    }
    function getallformreturn_one($id){
        $sql = "SELECT * from (form_return,department,UniCol) left join faculty on(form_fac=Faculty_id)
        where 
        Department_id=form_dep 
        and UniCol_id = form_unicol and form_id = ?";
        //and student_Faculty=Faculty_id 
        return $this->db->query($sql,array($id))->result();
    }

    function getallformcerti_all(){
        $sql = "SELECT student_id,student_FNS,student_FName,student_LName,student_type,student_Start,DATEDIFF(student_End, now())+1 as dd,UniCol_name,Department_name,Faculty_name,UniCol_type from (student,department,UniCol) left join faculty on(Student_Faculty=Faculty_id)
        where 
        Department_id=Student_Department 
        and UniCol_id = Student_UniCol";
        //and student_Faculty=Faculty_id 
        return $this->db->query($sql)->result();
    }

    function getallformcerti_one($id, $date){
        $sql = "SELECT student_id,student_FNS,student_FName,student_LName,student_type,student_Start,student_End,DATEDIFF(student_End, now())+1 as dd,UniCol_name,Department_name,Faculty_name,UniCol_type from (student,department,UniCol) left join faculty on(Student_Faculty=Faculty_id)
        where 
        Department_id=Student_Department 
        and UniCol_id = Student_UniCol and student_id=? and student_Start=?";
        //and student_Faculty=Faculty_id 
        return $this->db->query($sql, array($id, $date))->result();
    }

    function getallformsummary_one($dates, $datee){
        $sql = "SELECT UniCol_name,UniCol_type,Faculty_name,Department_name,student_Start,student_End,count(*) c from department d,faculty f,unicol u,student s 
        where UniCol_id = student_UniCol and Faculty_id=student_Faculty 
        and student_department = Department_id 
        and student_Start>= ? and student_Start<= ? 
        group by student_UniCol,student_Faculty,student_department,student_Start";
        //and student_Faculty=Faculty_id 
        return $this->db->query($sql, array($dates, $datee))->result();
    }


}

/* End of file load_data.php */
