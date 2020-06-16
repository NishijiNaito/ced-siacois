<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adminconsole extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->model('Load_data', 'ld');
    $this->load->model('Add_data', 'ad');
    $this->load->model('Useful', 'uf');

    $this->session;
    $this->_checkisadmin();
  }

  public function _checkisadmin()
  {

    if (!isset($_SESSION['user'])) {
      redirect(".");
    } else {
      if ($_SESSION['role'] == 'std') {
        redirect("student");
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
    $data['nav'] = array(array('Adminconsole'));
    $admin['all'] = $this->ld->allstudent()[0]->count;
    $admin['summer'] = $this->ld->allsummer()[0]->count;
    $admin['coop'] = $this->ld->allcoop()[0]->count;
    $admin['nextend'] = $this->uf->DateThai($this->ld->nextend()[0]->mi);
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

  public function employee($mode = null, $id = null)
  {
    if ($mode == null) { //Main Employee


      $data['nav'] = array(array('Adminconsole', 'adminconsole'), array('Employee'));

      $emp['uprs'] = $this->ld->getuprs();
      $emp['roles'] = $this->ld->getroles();


      $this->load->view('header');
      $this->load->view('html_head');
      $this->load->view('script_emp');

      $this->load->view('html_address', $data);

      $this->load->view('html_admin_emp', $emp);


      $this->load->view('bottom');
    } else {
      if ($mode == 'add') { //add Emp

        //for form validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('user', 'Username', 'required|trim');
        $this->form_validation->set_rules('nam', 'Name', 'required|trim');
        $this->form_validation->set_rules('pwd', 'Password', 'required|trim');
        $this->form_validation->set_rules('role', 'Role', 'required');


        if ($this->form_validation->run() == FALSE) { //if not input
          //echo "false";
          redirect("adminconsole/employee");
        } else { //if input

          // $realpass = md5($this->db->escape_like_str($pass));
          $data['users_name'] = $_POST['user'];
          $data['users_Password'] =  md5($this->db->escape_like_str($_POST['pwd']));
          $data['users_FLName'] = $_POST['nam'];
          $data['users_role'] = $_POST['role'];

          if ($this->ad->add_employee($data) == TRUE) { //True
            redirect("adminconsole/employee");
          } else { // false

            $this->_error("เนื่องจากกรอก username ซ้ำ โปรดใช้ username อื่น โปรดรอ 3 วินาที", "adminconsole/employee");
          }
        }
      } elseif ($mode == 'edit') { //add Emp
        if ($id == null) {
          redirect('adminconsole/Employee');
        }
        $data['nav'] = array(array('Adminconsole', 'adminconsole'), array('Employee', 'adminconsole/employee'), array('Edit'));

        $emp['uprs'] = $this->ld->getemp($id);

        if (count($emp['uprs']) == 0) {
          redirect('adminconsole/Employee');
        }
        $emp['uprs'] = $this->ld->getemp($id)[0];
        $emp['roles'] = $this->ld->getroles();


        $this->load->view('header');
        $this->load->view('html_head');


        $this->load->view('html_address', $data);

        $this->load->view('html_admin_emp_edit', $emp);

        $this->load->view('bottom');
      } elseif ($mode == 'save') {

        //for form validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('user', 'Username', 'required|trim');
        $this->form_validation->set_rules('nam', 'Name', 'required|trim');
        //$this->form_validation->set_rules('pwd', 'Password', 'required|trim');
        $this->form_validation->set_rules('role', 'Role', 'required');


        if ($this->form_validation->run() == FALSE) { //if not input
          //echo "false";
          redirect("adminconsole/employee");
        } else { //if input

          // $realpass = md5($this->db->escape_like_str($pass));
          $data['users_id'] = $_POST['uid'];
          $data['users_name'] = $_POST['user'];

          if (trim($_POST['pwd']) != "") {
            $data['users_Password'] =  md5($this->db->escape_like_str($_POST['pwd']));
          }

          $data['users_FLName'] = $_POST['nam'];
          $data['users_role'] = $_POST['role'];

          if ($this->ad->edit_employee($data) == TRUE) { //True
            redirect("adminconsole/employee");
          } else { // false
            echo "ErROR";
          }
        }
      } elseif ($mode == 'delete') {
        if ($id == null) {
          redirect("adminconsole/employee");
        }
        $data['users_id'] = $id;

        if ($this->ad->delete_employee($data) == TRUE) { //True
          redirect("adminconsole/employee");
        } else { // false
          echo "ErROR";
        }
      } else {
        redirect('adminconsole/Employee');
      }
    }
  }


  public function student($mode = null, $id = null, $date = null)
  {
    if ($mode == null) {
      $data['nav'] = array(array('Adminconsole', 'adminconsole'), array('Student'));

      $std['stds'] = $this->ld->getallstds();
      $std['unicols'] = $this->ld->getallunicols();
      $std['facs'] = $this->ld->getallfacs();
      $std['deps'] = $this->ld->getalldeps();

      $this->load->view('header');
      $this->load->view('html_head');
      $this->load->view('script_std');

      $this->load->view('html_address', $data);

      $this->load->view('html_admin_std', $std);


      $this->load->view('bottom');
    }
  }
}
        //header('Content-Type: application/json');

/* End of file Adminconsole.php */
