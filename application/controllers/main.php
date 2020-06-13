<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->session;
        $this->_haveuser();

    }

    public function _haveuser()
    {

        if (isset($_SESSION['user'])) {
            if ($_SESSION['role'] == 'std') {
                redirect("student");
            } else {
                redirect("Adminconsole");
            }
        }
    }

    public function index()
    {
        $data['wrong'] = false;

        $this->load->view('header');
        $this->load->view('html_head');
        $this->load->view('html_login', $data);
        $this->load->view('bottom');
    }
    public function hello()
    {
        echo "hello";
    }
}

/* End of file main.php */
