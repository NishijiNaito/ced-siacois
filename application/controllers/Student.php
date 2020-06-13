<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Student extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
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
    }
}

/* End of file Student.php */
