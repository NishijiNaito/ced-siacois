<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Load_data', 'ld');
        $this->load->model('Add_data', 'ad');
        $this->session;
        $this->load->helper(array('form'));
    }

    public function _haveuser()
    {

        if (!isset($_SESSION['user'])) {
            redirect('.');
        }
    }

    public function _error($message, $goto)
    {
        $this->load->view('header');
        $this->load->view('html_head');
        $err['msg'] = $message;
        $err['goto'] = $goto;
        $this->load->view('error_popup', $err);
    }


    public function index()
    {
        redirect(".");
    }

    public function login()
    {
        //for form validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('uname', 'Username', 'required|trim');
        $this->form_validation->set_rules('pwd', 'Password', 'required|trim');
        //$this->form_validation->set_rules('type', 'Type', 'required');


        if ($this->form_validation->run() == FALSE) { //if not input
            //echo "false";
            redirect(".");
        } else { //if input
            //echo "True";
            $getdata = $this->ld->userpass("std", $_POST['uname'], $_POST['pwd']); //get records std
            //echo count($getdata);
            if (count($getdata) > 0) { //Have in Student
                $_SESSION['user'] = $getdata[0]->student_id;
                $_SESSION['role'] = 'std';
                $_SESSION['name'] = $getdata[0]->student_FName;
                $_SESSION['date'] = $getdata[0]->student_Start;
            } else { // If Not In Student Find in Admin
                $getdata = $this->ld->userpass("adm", $_POST['uname'], $_POST['pwd']);
                if (count($getdata) > 0) {
                    $_SESSION['user'] = $getdata[0]->users_name;
                    $_SESSION['role'] = $getdata[0]->users_role_name;
                    $_SESSION['name'] = $getdata[0]->users_FLName;
                }
            }

            if (count($getdata) > 0) { //Have data
                $time = $_SERVER['REQUEST_TIME'];
                $timeout_duration = 600;

                if (
                    isset($_SESSION['LAST_ACTIVITY']) &&
                    ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration
                ) {
                    session_unset();
                    session_destroy();
                    session_start();
                } else {
                    $_SESSION['LAST_ACTIVITY'] = $time;
                }

                if ($_POST['type'] == 'std') {
                    redirect("student");
                } else {
                    redirect("adminconsole");
                }
            } else { // no data
                $data['wrong'] = true;

                $this->load->view('header');
                $this->load->view('html_head');
                $this->load->view('html_login', $data);
                $this->load->view('bottom');
            }

            //$this->load->view('formsuccess');
        }
    }

    public function edit()
    {
        $this->_haveuser();
        if ($_SESSION['role'] === "std") {
            $data['nav'] = array(array('Student', 'student'), array('แก้ไขข้อมูล'));
        } else {
            $data['nav'] = array(array('Adminconsole', 'adminconsole'), array('แก้ไขข้อมูล'));
        }

        $this->load->view('header');
        $this->load->view('html_head');
        $this->load->view('html_address', $data);

        if ($_SESSION['role'] === "std") {
            $this->load->view('html_edit_student', $data);
        } else {
            $this->load->view('html_edit_admin', $data);
        }

        $this->load->view('bottom');
    }

    public function saveedit()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('uid', 'Username', 'required|trim');
        if ($_SESSION['role'] != "std") {
            $this->form_validation->set_rules('nam', 'Name', 'required|trim');
        }


        if ($this->form_validation->run() == FALSE) { //if not input
            //echo "false";
            redirect(".");
        } else { //uid pwd - nam -bdates
            if ($_SESSION['role'] === "std") { //std edit
                $data['student_id'] = $_POST['uid'];

                $data['student_Start'] = $_POST['bdates'];
                if (trim($_POST['pwd']) != "") {
                    $data['student_password'] =  md5($this->db->escape_like_str($_POST['pwd']));
                }

                if ($this->ad->edit_student($data, $_POST['bdates']) == TRUE) { //True
                    redirect("student");
                } else { // false
                    $this->_error("เนื่องจากกรอก ชื่อผู้ใช้ ซ้ำกัน โปรดใช้ ชื่อผู้ใช้ อื่น โปรดรอ 3 วินาที", "student");
                }
            } else { // admin group edit

                $data['users_name'] = $_POST['uid'];

                if (trim($_POST['pwd']) != "") {
                    $data['users_Password'] =  md5($this->db->escape_like_str($_POST['pwd']));
                }

                $data['users_FLName'] = $_POST['nam'];

                if ($this->ad->edit_employee_by_username($data) == TRUE) { //True
                    $_SESSION['name'] = $_POST['nam'];
                    redirect("adminconsole");
                } else { // false
                    echo "ErROR";
                }
            }
        }
    }






    public function logout()
    {

        session_destroy();
        redirect('.');
    }
}

/* End of file Login.php */
