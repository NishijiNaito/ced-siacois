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
}

/* End of file Student.php */
