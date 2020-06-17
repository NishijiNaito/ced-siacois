<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Student extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Load_data', 'ld');
        $this->load->model('Add_data', 'ad');
        $this->load->model('Useful', 'uf');
        $this->session;
        $this->_checkisstudent();
    }

    public function _checkisstudent()
    {

        if (!isset($_SESSION['user'])) {
            redirect(".");
        } else {
            if ($_SESSION['role'] != 'std') {
                redirect("Adminconsole");
            }
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
        //$data['nav'] = array(array('Adminconsole', 'admin'), array('Project'));
        $data['nav'] = array(array('Student'));
        $std['date'] = $this->ld->getdateofstudent($_SESSION['user'], $_SESSION['date'])[0];
        $this->load->view('header');
        $this->load->view('html_head');

        $this->load->view('html_address', $data);
        $this->load->view('html_std_index', $std);

        $this->load->view('bottom');
    }
    public function leaverequest($mode = null, $id = null)
    {
        if ($mode == null) {
            $data['nav'] = array(array('Student', 'student'), array('Leave Request'));
            $std['data'] = $this->ld->getstddatas($_SESSION['user'], $_SESSION['date'])[0];
            $std['leaves'] = $this->ld->getleaverequest($_SESSION['user'], $_SESSION['date']);

            $this->load->view('header');
            $this->load->view('script_leave');

            $this->load->view('html_head');
            $this->load->view('html_address', $data);
            $this->load->view('html_std_leave', $std);

            $this->load->view('bottom');
        } elseif ($mode == 'add') { //add Emp

            //for form validation
            $this->load->library('form_validation');

            $this->form_validation->set_rules('typ', 'Type', 'required|trim');
            $this->form_validation->set_rules('reason', 'Reason', 'required|trim');


            if ($this->form_validation->run() == FALSE) { //if not input
                //echo "false";
                $this->_error("โปรดกรอกข้อมูลให้ครบถ้วน โปรดรอ 3 วินาที", "student/leaverequest");
            } else { //if input

                // $realpass = md5($this->db->escape_like_str($pass));
                $data['Leaves_Std_id'] = $_SESSION['user'];
                $data['Leaves_Std_Start'] =  $_SESSION['date'];
                $data['Leaves_Type'] = $_POST['typ'];
                $data['Leaves_Reason'] = $_POST['reason'];
                $data['Leaves_Time_Request'] = date('Y-m-d H:i:s');

                if ($this->ad->add_leaves($data) == TRUE) { //True
                    redirect("student/leaverequest");
                } else { // false

                    $this->_error("ข้อมูลผิดพลาด โปรดรอ 3 วินาที", "student/leaverequest");
                }
            }
        } elseif ($mode == 'delete') {
            if ($id == null) {
                redirect("student/leaverequest");
            }
            $data['Leaves_id'] = $id;
            $data['Leaves_Std_id'] = $_SESSION['user'];
            $data['Leaves_Std_Start'] =  $_SESSION['date'];



            if ($this->ad->delete_leaves($data) == TRUE) { //True
                redirect("student/leaverequest");
            } else { // false
                $this->_error("ข้อมูลผิดพลาด โปรดรอ 3 วินาที", "student/leaverequest");
            }
        } elseif ($mode == 'form') {
            if ($id == null) {
                redirect("student/leaverequest");
            }
            $rep = $this->ld->getleaveone($_SESSION['user'], $_SESSION['date'], $id);
            if (count($rep) == 0) {
                redirect("student/leaverequest");
            }


            

        } else {
            redirect('student/leaverequest');
        }
    }
}

/* End of file Student.php */
