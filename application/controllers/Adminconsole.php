<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminconsole extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here

        $this->session;
        $this->_checkisadmin();
    }

    public function _checkisadmin(){

        if (!isset($_SESSION['user'])) {
            redirect(".");
          } else {
            if ($_SESSION['role'] == 'std') {
              redirect("student");
            }
          }
          
    }
    

    public function index()
    {
        //$data['nav'] = array(array('Adminconsole', 'admin'), array('Project'));
        $data['nav'] = array(array('Adminconsole'));

        $this->load->view('header');
        $this->load->view('html_head');
        $this->load->view('html_address', $data);
        $this->load->view('bottom');
    
    }

}

/* End of file Adminconsole.php */
