<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Load_data', 'ld');
        $this->session;
        $this->load->helper(array('form'));
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
        $this->form_validation->set_rules('type', 'Type', 'required');


        if ($this->form_validation->run() == FALSE) { //if not input
            //echo "false";
            redirect(".");
        } else { //if input
            //echo "True";
            $getdata = $this->ld->userpass($_POST['type'], $_POST['uname'], $_POST['pwd']); //get records
            //echo count($getdata);
            if (count($getdata) > 0) { //check has data

                if ($_POST['type'] == 'adm') {

                    //$_SESSION['user_uname'] = $getdata[0]->user_uname;
                    //$_SESSION['user_role'] = $getdata[0]->user_role;

                    $_SESSION['user'] = $getdata[0]->users_name;
                    $_SESSION['role'] = $getdata[0]->users_role_name;
                    $_SESSION['name'] = $getdata[0]->users_FLName;
                } else {


                    $_SESSION['user'] = $getdata[0]->student_id;
                    $_SESSION['role'] = 'std';
                    $_SESSION['name'] = $getdata[0]->student_FName;
                    $_SESSION['date'] = $getdata[0]->student_Start;
                }
                //session section regist
                //$_SESSION['user_uname'] = $getdata[0]->user_uname;
                //$_SESSION['user_role'] = $getdata[0]->user_role;

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


                //"Student"
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
    public function logout()
    {

        session_destroy();
        redirect('.');
    }
}

/* End of file Login.php */
