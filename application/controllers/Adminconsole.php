<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminconsole extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Load_data', 'ld');
        $this->load->model('Useful', 'uf');
        
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
        $admin['all'] = $this->ld->allstudent()[0]->count;
        $admin['summer'] = $this->ld->allsummer()[0]->count;
        $admin['coop'] = $this->ld->allcoop()[0]->count;
        $admin['nextend'] = $this->uf->DateThai( $this->ld->nextend()[0]->mi);
        //echo($this->ld->allstudent()[0]->count);//all
        //echo($this->ld->allsummer()[0]->count);//summer
        //echo($this->ld->allcoop()[0]->count);//coop
        //echo($this->uf->DateThai( $this->ld->nextend()[0]->mi));//nextend

        $this->load->view('header');
        $this->load->view('html_head');
        $this->load->view('html_address', $data);
        $this->load->view('html_admin_index', $admin);

        $this->load->view('bottom');
    
    }

}

/* End of file Adminconsole.php */
