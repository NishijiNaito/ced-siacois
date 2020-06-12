<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('html_head');
        $this->load->view('html_login');
        $this->load->view('bottom');
        
    }
    public function hello(){
        echo "hello";
    }

}

/* End of file main.php */
