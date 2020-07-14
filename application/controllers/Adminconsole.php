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

  public function employee($mode = null, $id = null) //complete
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
    } elseif ($mode == 'add') { //add Emp

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


  public function student($mode = null, $id = null, $dat = null) //complete
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
    } elseif ($mode == 'add') { //add Std

      //for form validation
      $this->load->library('form_validation');

      $this->form_validation->set_rules('id', 'ID', 'required|trim');
      $this->form_validation->set_rules('pwd', 'Password', 'required|trim');
      $this->form_validation->set_rules('fns', 'frontName', 'required|trim');
      $this->form_validation->set_rules('fnam', 'Firstname', 'required|trim');
      $this->form_validation->set_rules('lnam', 'Lastname', 'required|trim');
      $this->form_validation->set_rules('ucid', 'unicolid', 'required|trim');
      $this->form_validation->set_rules('fid', 'Facultyid', 'required|trim');
      $this->form_validation->set_rules('did', 'Departmentid', 'required|trim');
      $this->form_validation->set_rules('yr', 'Year', 'required|trim');
      $this->form_validation->set_rules('type', 'Type', 'required|trim');
      $this->form_validation->set_rules('dates', 'datestart', 'required|trim');
      $this->form_validation->set_rules('datee', 'dateend', 'required|trim');


      if ($this->form_validation->run() == FALSE) { //if not input
        //echo "false";
        redirect("adminconsole/student");
      } else { //if input

        if (strtotime($_POST['dates']) > strtotime($_POST['datee'])) { // Date Error
          $this->_error("เนื่องจากวันที่เริ่มต้น อยู่หลังวันที่สิ้นสุด โปรดรอ 3 วินาที", "adminconsole/student");
        } else {


          // $realpass = md5($this->db->escape_like_str($pass));
          $data['student_id'] = $_POST['id'];
          $data['student_Start'] = $_POST['dates'];
          $data['student_password'] =  md5($this->db->escape_like_str($_POST['pwd']));
          $data['student_FNS'] = $_POST['fns'];
          $data['student_FName'] = $_POST['fnam'];
          $data['student_LName'] = $_POST['lnam'];
          $data['student_UniCol'] = $_POST['ucid'];
          if ($_POST['fid'] != 'no') {
            $data['student_faculty'] = $_POST['fid'];
          }
          $data['student_department'] = $_POST['did']; //depart
          $data['student_Year'] = $_POST['yr'];
          $data['student_type'] = $_POST['type'];
          $data['student_End'] = $_POST['datee'];

          if ($this->ad->add_student($data) == TRUE) { //True
            redirect("adminconsole/student");
          } else { // false

            $this->_error("เนื่องจากกรอก ชื่อผู้ใช้ ซ้ำกัน โปรดใช้ ชื่อผู้ใช้ อื่น โปรดรอ 3 วินาที", "adminconsole/student");
          }
        }
      }
    } elseif ($mode == 'edit') { //edit Std
      if ($id == null || $dat == null) {
        redirect('adminconsole/student');
      }

      $data['nav'] = array(array('Adminconsole', 'adminconsole'), array('Student', 'adminconsole/Student'), array('Edit'));



      if (count($this->ld->getstd($id, $dat)) == 0) {
        redirect('adminconsole/student');
      }

      $std['stds'] = $this->ld->getstd($id, $dat)[0];
      $std['unicols'] = $this->ld->getallunicols();
      $std['facs'] = $this->ld->getallfacs();
      $std['deps'] = $this->ld->getalldeps();

      $this->load->view('header');
      $this->load->view('html_head');


      $this->load->view('html_address', $data);

      $this->load->view('html_admin_std_edit', $std);

      $this->load->view('bottom');
    } elseif ($mode == 'save') {
      //

      //for form validation
      $this->load->library('form_validation');

      $this->form_validation->set_rules('id', 'ID', 'required|trim');
      //$this->form_validation->set_rules('pwd', 'Password', 'required|trim');
      $this->form_validation->set_rules('fns', 'frontName', 'required|trim');
      $this->form_validation->set_rules('fnam', 'Firstname', 'required|trim');
      $this->form_validation->set_rules('lnam', 'Lastname', 'required|trim');
      $this->form_validation->set_rules('ucid', 'unicolid', 'required|trim');
      $this->form_validation->set_rules('fid', 'Facultyid', 'required|trim');
      $this->form_validation->set_rules('did', 'Departmentid', 'required|trim');
      $this->form_validation->set_rules('yr', 'Year', 'required|trim');
      $this->form_validation->set_rules('type', 'Type', 'required|trim');
      $this->form_validation->set_rules('dates', 'datestart', 'required|trim');
      $this->form_validation->set_rules('bdates', 'beforedatestart', 'required|trim');

      $this->form_validation->set_rules('datee', 'dateend', 'required|trim');


      if ($this->form_validation->run() == FALSE) { //if not input
        //echo "false";
        redirect("adminconsole/student");
      } else { //if input

        if (strtotime($_POST['dates']) > strtotime($_POST['datee'])) { // Date Error
          $this->_error("เนื่องจากวันที่เริ่มต้น อยู่หลังวันที่สิ้นสุด โปรดรอ 3 วินาที", "adminconsole/student");
        } else {


          // $realpass = md5($this->db->escape_like_str($pass));
          $data['student_id'] = $_POST['id'];

          $data['student_Start'] = $_POST['dates'];
          if (trim($_POST['pwd']) != "") {
            $data['student_password'] =  md5($this->db->escape_like_str($_POST['pwd']));
          }
          $data['student_FNS'] = $_POST['fns'];
          $data['student_FName'] = $_POST['fnam'];
          $data['student_LName'] = $_POST['lnam'];
          $data['student_UniCol'] = $_POST['ucid'];
          if ($_POST['fid'] == 'no') {
            $data['student_faculty'] = NULL;
          } else {
            $data['student_faculty'] = $_POST['fid'];
          }
          $data['student_department'] = $_POST['did']; //depart
          $data['student_Year'] = $_POST['yr'];
          $data['student_type'] = $_POST['type'];
          $data['student_End'] = $_POST['datee'];

          if ($this->ad->edit_student($data, $_POST['bdates']) == TRUE) { //True
            redirect("adminconsole/student");
          } else { // false

            $this->_error("เนื่องจากกรอก ชื่อผู้ใช้ ซ้ำกัน โปรดใช้ ชื่อผู้ใช้ อื่น โปรดรอ 3 วินาที", "adminconsole/student");
          }
        }
      }
    } elseif ($mode == 'delete') {
      if ($id == null || $dat == null) {
        redirect("adminconsole/student");
      }
      $data['student_id'] = $id;
      $data['student_Start'] = $dat;

      if ($this->ad->delete_student($data) == TRUE) { //True

        redirect("adminconsole/student");
      } else { // false
        echo "ErROR";
      }
    } else {
      redirect('adminconsole/student');
    }
  }

  public function subdata($mode = null, $type = null, $id = null) //complete
  {
    if ($mode == null) {


      $data['nav'] = array(array('Adminconsole', 'adminconsole'), array('Subdata'));

      //$std['stds'] = $this->ld->getallstds();
      $sub['unicols'] = $this->ld->getallunicols();
      $sub['facs'] = $this->ld->getallfacs();
      $sub['deps'] = $this->ld->getalldeps();

      $this->load->view('header');
      $this->load->view('html_head');
      $this->load->view('script_sub');

      $this->load->view('html_address', $data);

      $this->load->view('html_admin_sub', $sub);



      $this->load->view('bottom');
    } elseif ($mode == "jsonload") {
      header('Content-Type: application/json');

      if ($type == null || $id == null) { // type id
        echo json_encode(array('status' => '0', 'message' => 'Error insert data!'));
      } else {

        if ($type == 1) { // university
          $data = $this->ld->getunicol($id);
          if (count($data) == 0) {
            echo json_encode(array('status' => '0', 'message' => 'Error No data!'));
          } else {
            $arr = array(
              'status' => '1',
              'message' => 'comp',
              "uname" => $data[0]->UniCol_name,
              "uform" => $data[0]->UniCol_formtype,
              "utype" => $data[0]->UniCol_type

            );
            echo json_encode($arr);
          }
        } else { // department
          $data = $this->ld->getdep($id);
          if (count($data) == 0) {
            echo json_encode(array('status' => '0', 'message' => 'Error No data!'));
          } else {
            $arr = array(
              'status' => '1',
              'message' => 'comp',
              "dname" => $data[0]->Department_name,
              "dtype" => $data[0]->Department_type,

            );
            echo json_encode($arr);
          }
        }
      }
    } elseif ($mode == "edit") {
      //for form validation
      $this->load->library('form_validation');

      $this->form_validation->set_rules('type', 'type', 'required|trim');
      $this->form_validation->set_rules('fo01', 'name', 'required|trim');



      if ($this->form_validation->run() == FALSE) { //if not input
        //echo "false";
        redirect("adminconsole/subdata");
      } else { //if input

        $okay = false;
        switch ($_POST['type']) {
          case '1':
            $data['UniCol_name'] = $_POST['fo01'];
            $data['UniCol_formtype'] = $_POST['fotype'];
            $data['UniCol_type'] = $_POST['uctype'];
            $okay = $this->ad->edit_subdata(1, $data, $_POST['ucfdid']);

            break;
          case '2':
            $data['Faculty_name'] = $_POST['fo01'];
            $okay = $this->ad->edit_subdata(2, $data, $_POST['fid']);
            break;
          case '3':
            $data['Department_name'] = $_POST['fo01'];
            $data['Department_type'] = $_POST['dtype'];
            $okay = $this->ad->edit_subdata(3, $data, $_POST['ucfdid']);
            break;
          default:
            # code...
            break;
        }

        if ($okay) { //True
          redirect("adminconsole/subdata");
        } else { // false

          $this->_error("เนื่องจากเกิดข้อผิดพลาดทางเทคนิค โปรดติดต่อผู้ดูแล โปรดรอ 3 วินาที", "adminconsole/subdata");
        }
      }
    } elseif ($mode == "add") {

      //edit
      //for form validation
      $this->load->library('form_validation');

      $this->form_validation->set_rules('type', 'type', 'required|trim');
      $this->form_validation->set_rules('fo01', 'name', 'required|trim');



      if ($this->form_validation->run() == FALSE) { //if not input
        //echo "false";
        redirect("adminconsole/subdata");
      } else { //if input

        $okay = false;
        switch ($_POST['type']) {
          case '1':
            $data['UniCol_name'] = $_POST['fo01'];
            $data['UniCol_formtype'] = $_POST['fotype'];
            $data['UniCol_type'] = $_POST['uctype'];
            $okay = $this->ad->add_subdata(1, $data);

            break;
          case '2':
            $data['Faculty_name'] = $_POST['fo01'];
            $okay = $this->ad->add_subdata(2, $data);
            break;
          case '3':
            $data['Department_name'] = $_POST['fo01'];
            $data['Department_type'] = $_POST['dtype'];
            $okay = $this->ad->add_subdata(3, $data);
            break;
          default:
            # code...
            break;
        }

        if ($okay) { //True
          redirect("adminconsole/subdata");
        } else { // false

          $this->_error("เนื่องจากเกิดข้อผิดพลาดทางเทคนิค โปรดติดต่อผู้ดูแล โปรดรอ 3 วินาที", "adminconsole/subdata");
        }
      }
    } elseif ($mode == "delete") {
      //delete
      if ($type == null || $id == null) { // type id
        redirect("adminconsole/subdata");
      } else {
        $okay = false;

        switch ($type) {
          case '1':
            $data['UniCol_id'] = $id;
            $okay = $this->ad->delete_subdata(1, $data);

            break;
          case '2':
            # code...
            $data['Faculty_id'] = $id;
            $okay = $this->ad->delete_subdata(2, $data);

            break;
          case '3':
            # code...
            $data['Department_id'] = $id;
            $okay = $this->ad->delete_subdata(3, $data);

            break;
          default:
            # code...
            break;
        }

        if ($okay) { //True
          redirect("adminconsole/subdata");
        } else { // false

          $this->_error("เนื่องจากเกิดข้อผิดพลาดทางเทคนิค โปรดติดต่อผู้ดูแล โปรดรอ 3 วินาที", "adminconsole/subdata");
        }
      }
    } else {
      redirect("adminconsole/subdata");
    }
  }

  public function pdf($mode = null, $type = null, $id = null)
  {
    if ($mode == null) { // index pdf


      $data['nav'] = array(array('Adminconsole', 'adminconsole'), array('PDF'));

      //$std['stds'] = $this->ld->getallstds();
      //$sub['unicols'] = $this->ld->getallunicols();
      //$sub['facs'] = $this->ld->getallfacs();
      //$sub['deps'] = $this->ld->getalldeps();

      $this->load->view('header');
      $this->load->view('html_head');
      //$this->load->view('script_sub');

      $this->load->view('html_address', $data);

      $this->load->view('html_admin_pdf');



      $this->load->view('bottom');
    } elseif ($mode == "accept") { // pdf accept
      if ($type == null) {
        $data['nav'] = array(array('Adminconsole', 'adminconsole'), array('PDF', 'adminconsole/pdf'), array('accept'));

        //$std['stds'] = $this->ld->getallstds();
        //$sub['unicols'] = $this->ld->getallunicols();
        //$sub['facs'] = $this->ld->getallfacs();
        //$sub['deps'] = $this->ld->getalldeps();
        $pdf['forms'] = $this->ld->getallformaccept();

        $this->load->view('header');
        $this->load->view('html_head');
        $this->load->view('script_pdf');

        $this->load->view('html_address', $data);

        $this->load->view('html_admin_pdf_accept',$pdf);



        $this->load->view('bottom');
      } else {
        redirect("adminconsole/pdf/accept");
      }
    } else { // other not in mode go to index mode
      redirect("adminconsole/pdf");
    }
  }
}
        //header('Content-Type: application/json');

/* End of file Adminconsole.php */