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
        } elseif ($mode == 'add') { //add leaves

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
            $data['rep'] = $this->ld->getleaveone($_SESSION['user'], $_SESSION['date'], $id)[0];
            $stddata = $this->ld->getstddatas($_SESSION['user'], $_SESSION['date'])[0];
            $data['stddata'] = $this->ld->getstddatas($_SESSION['user'], $_SESSION['date'])[0];

            if (count($rep) == 0) {
                redirect("student/leaverequest");
            }

            $strs = "เนื่องด้วยข้าพเจ้า ".$stddata ->student_FNS."".$stddata ->student_FName." "
            .$stddata ->student_LName." นักศึกษาฝึก".(($stddata ->student_type==1)?"งานฤดูร้อน":"สหกิจศึกษา"). " จากสาขา".$stddata ->Department_name." คณะ".$stddata ->Faculty_name." มหาวิทยาลัย".$stddata ->UniCol_name.
            " มีความประสงค์ขอลา".(($rep[0]->Leaves_Type==1)?"ป่วย":"กิจ" )." เนื่องจาก ".$rep[0]->Leaves_Reason;

            $html = $this->load->view('pdf_leaves', $data, TRUE);
            //echo $rep[0]->Leaves_Reason;
            $this->load->library('Pdf');
            $pdf = new Pdf();
            $pdf->setPrintHeader(false);

            $pdf->SetMargins(23, 30, 23);
            $pdf->AddPage();
            //addFont
            



            $pdf->Image(base_url() . 'asset/pic/in.jpg', 23, 20);


            //-------------------------------
            $pdf->SetFont('thsarabun', '', 24);
            $pdf->MultiCell(180, 10, 'บันทึกข้อความ', 0, 'C');
            $pdf->Ln(50);
            //--------------------------------------------
            $pdf->SetFont('thsarabun', '', 17);
            $pdf->Text(23, 50, 'ส่วนงาน');

            $pdf->SetFont('thsarabun', '', 17);
            $pdf->Text(43, 50, 'หน่วยเครื่องมือกลาง คณะวิทยาศาสตร์ โทร. 8058');
            //--------------------------------
            $pdf->SetFont('thsarabun', '', 17);
            $pdf->Text(23, 60, 'ที่่');

            $pdf->SetFont('thsarabun', '', 17);
            $pdf->Text(33, 60, 'มอ.300.02/');

            $pdf->SetFont('thsarabun', '', 17);
            $pdf->Text(90, 60, 'วันที่่');


            $pdf->SetFont('thsarabun', '', 17);
            $pdf->Text(100, 60, $this->uf->thai_date(date("Y-m-d")));
            //--------------------------------------------
            $pdf->SetFont('thsarabun', '', 17);
            $pdf->Text(23, 70, 'เรื่อง');

            $pdf->SetFont('thsarabun', '', 17);
            $pdf->Text(33, 70, 'ขอลา' . (($rep[0]->Leaves_Type == 1) ? "ป่วย" : "กิจ"));

            //--------------------------------

            $pdf->SetFont('thsarabun', '', 17);
            $pdf->Text(23, 80, 'เรียน');

            $pdf->SetFont('thsarabun', '', 17);
            $pdf->Text(33, 80, 'หัวหน้าหน่วยเครื่องมือกลาง');
            $pdf->Ln(15);
            //--------------------------------
            $pdf->SetFont('thsarabun', '', 16);
            //$pdf->MultiCell(164, 20, "             " . $strs, 0,'L' );
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Ln(15);

            $pdf->MultiCell(130, 10, '                        จึงเรียนมาเพื่อโปรดทราบ');

            //$pdf->MultiCell(164,10,$this->uf->co($pdf->getX().'/'.$pdf->getY()));
            //$pdf->MultiCell(164,10,$this->uf->co($pdf->getX().'/'.$pdf->getY()));
            //--------------------------------

            $pdf->SetFont('thsarabun', '', 17);
            $pdf->Text(110, $pdf->getY() + 20, '(' . $stddata ->student_FNS . $stddata ->student_FName. ' ' .$stddata ->student_LName. ')');
            $pdf->setY($pdf->getY() + 5);
            $pdf->Text(115, $pdf->getY() + 10, "นักศึกษาฝึก" . (($stddata ->student_type == 1) ? "งานฤดูร้อน" : "สหกิจศึกษา"));
            $pdf->setY($pdf->getY() + 10);

            $pdf->Output();

        } else {
            redirect('student/leaverequest');
        }
    }
}

/* End of file Student.php */
