<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Adminpdf extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Load_data', 'ld');
        $this->load->model('Add_data', 'ad');
        $this->load->model('Useful', 'uf');

        $this->load->library('Pdf'); //$pdf = new Pdf();

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
        $this->_error("Denied for access", "Adminconsole");
    }
    public function accept()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'Form Id', 'required|trim');
        if ($this->form_validation->run() == FALSE) { //if not input
            redirect("adminconsole/pdf/accept");
        }

        //$_POST['uid']

        $temp = $this->ld->getallformaccept_one($_POST['id']);
        if (count($temp) != 1) {
            redirect("adminconsole/pdf/accept");
        }
        $data = $temp[0];

        $pdf = new Pdf();

        $pdf->setPrintHeader(false);
        if ($data->UniCol_formtype != 'in') {


            $pdf->SetMargins(35, 53, 25);
            $pdf->AddPage();
            //addFont


            //--------------------------------------------


            $pdf->Image('asset/pic/out.jpg', 95, 15, 25, 40);
            $pdf->SetFont('thsarabun', '', 15);
            $pdf->Text(35, 30, 'ที่ อว.6801.0917 ');

            $pdf->Text(135, 30, 'หน่วยเครื่องมือกลาง คณะวิทยาศาสตร์');
            $pdf->Text(135, 37, 'มหาวิทยาลัยสงขลานครินทร์');
            $pdf->Text(135, 44, 'ตู้ ปณ 3 คอหงส์ หาดใหญ่');
            $pdf->Text(135, 51, 'สงขลา 90112');
            $pdf->Ln(10);
            //--------------------------------
            $pdf->MultiCell(0, 7, $this->uf->thai_date(date("Y-m-d")), 0, 'C');

            //--------------------------------

            $pdf->Text(35, 80, 'เรื่อง  ให้ความอนุเคราะห์ให้นักศึกษาฝึก' . ($data->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา'));



            $pdf->Text(35, 87, 'เรียน  คณบดีคณะ' . $data->Faculty_name . ' มหาวิทยาลัย' . $data->UniCol_name);
            $pdf->Text(35, 94, 'อ้างถึง  ' . $data->form_ref);
            $pdf->Ln(20);

            //--------------------------------

            $pdf->MultiCell(0, 7, '                   ตามที่ หนังสือที่อ้างถึง คณะ' . $data->Faculty_name . ' มหาวิทยาลัย' . $data->UniCol_name . ' ขอความอนุเคราะห์ให้นักศึกษา สาขาวิชา' . $data->Department_name . ' เข้าฝึก' . ($data->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา') . ' ระหว่างวันที่ ' . $this->uf->thai_date($data->form_start) . ' ถึง ' . $this->uf->thai_date($data->form_end) . ' ความโดยละเอียดที่แจ้งแล้วนั้น หน่วยงานได้พิจารณาแล้ว ยินดีอนุเคราะห์ให้ นักศึกษาฝึก' . ($data->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา') . ' จำนวน ' . $data->form_amo . ' คน', 0, 'L');
            $pdf->Text(60, $pdf->getY() + 15, 'จึงเรียนมาเพื่อโปรดทราบ');
            $pdf->Ln(29);

            //--------------------------------
            $pdf->Text(112, $pdf->getY() + 0, 'ขอแสดงความนับถือ');
            $pdf->Text(108, $pdf->getY() + 20, '(นางสาวผุสดี  มุหะหมัด)');
            $pdf->Text(105, $pdf->getY() + 7, 'หัวหน้าหน่วยเครื่องมือกลาง');
            $pdf->Ln(29);
            //********************* */
            $pdf->Text(35, 250, 'หน่วยเครื่องมือกลาง');
            $pdf->Text(35, 257, 'โทร 0-7428-8058');
            $pdf->Text(35, 264, 'โทรสาร 0-7455-8850');
        } else { /* in */

            $pdf->SetMargins(23, 30, 23);
            $pdf->AddPage();
            //addFont

            $pdf->Image('asset/pic/in.jpg', 23, 20);


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
            $pdf->Text(33, 70, ' ให้ความอนุเคราะห์ให้นักศึกษาฝึก' . ($data->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา'));

            //--------------------------------

            $pdf->SetFont('thsarabun', '', 17);
            $pdf->Text(23, 80, 'เรียน');

            $pdf->SetFont('thsarabun', '', 17);
            $pdf->Text(33, 80, 'หัวหน้าภาควิชา' . $data->Department_name);
            $pdf->Ln(20);
            //--------------------------------
            $pdf->SetFont('thsarabun', '', 16);
            $pdf->MultiCell(164, 10, '                   ตามที่ หนังสือที่อ้างถึง คณะ' . $data->Faculty_name . ' มหาวิทยาลัย' . $data->UniCol_name . ' ขอความอนุเคราะห์ให้นักศึกษา สาขาวิชา' . $data->Department_name . ' เข้าฝึก' . ($data->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา') . ' ระหว่างวันที่ ' . $this->uf->thai_date($data->form_start) . ' ถึง ' . $this->uf->thai_date($data->form_end) . ' ความโดยละเอียดที่แจ้งแล้วนั้น หน่วยงานได้พิจารณาแล้ว ยินดีอนุเคราะห์ให้ นักศึกษาฝึก' . ($data->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา') . ' จำนวน ' . $data->form_amo . ' คน', 0, 'L');
            $pdf->Text(60, $pdf->getY() + 15, 'จึงเรียนมาเพื่อโปรดทราบ');
            $pdf->Ln(29);

            //$pdf->MultiCell(164,10,co($pdf->getX().'/'.$pdf->getY()));
            //$pdf->MultiCell(164,10,co($pdf->getX().'/'.$pdf->getY()));
            //--------------------------------
            //$pdf->Text(112, $pdf->getY() + 0, 'ขอแสดงความนับถือ'));
            $pdf->Text(108, $pdf->getY() + 15, '(นางสาวผุสดี  มุหะหมัด)');
            $pdf->Text(105, $pdf->getY() + 10, 'หัวหน้าหน่วยเครื่องมือกลาง');
            $pdf->Ln(29);
        }
        $pdf->Output();
    }

    public function returning()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'Form Id', 'required|trim');
        if ($this->form_validation->run() == FALSE) { //if not input
            redirect("adminconsole/pdf/accept");
        }

        //$_POST['uid']

        $temp = $this->ld->getallformreturn_one($_POST['id']);
        if (count($temp) != 1) {
            redirect("adminconsole/pdf/accept");
        }
        $data = $temp[0];

        $pdf = new Pdf();
        $pdf->setPrintHeader(false);

        if ($data->UniCol_formtype != 'in') {

            $pdf->SetMargins(35, 53, 25);
            $pdf->AddPage();
            //addFont
            $pdf->Image('asset/pic/out.jpg', 95, 15, 25, 40);
            $pdf->SetFont('thsarabun', '', 15);
            //--------------------------------------------
            $pdf->Text(35, 30, 'ที่ อว.6801.0917 ');

            $pdf->Text(135, 30, 'หน่วยเครื่องมือกลาง คณะวิทยาศาสตร์');
            $pdf->Text(135, 37, 'มหาวิทยาลัยสงขลานครินทร์');
            $pdf->Text(135, 44, 'ตู้ ปณ 3 คอหงส์ หาดใหญ่');
            $pdf->Text(135, 51, 'สงขลา 90112');
            $pdf->Ln(10);
            //--------------------------------
            $pdf->MultiCell(0, 7, $this->uf->thai_date(date("Y-m-d")), 0, 'C');

            //--------------------------------

            $pdf->Text(35, 80, 'เรื่อง  ขอส่งตัวนักศึกษาฝึก' . ($data->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา'));


            $pdf->Text(35, 87, 'เรียน  คณบดีคณะ' . $data->Faculty_name . ' มหาวิทยาลัย' . $data->UniCol_name);

            $pdf->Ln(20);

            //--------------------------------

            $pdf->MultiCell(0, 7, '                ตามที่หน่วยเครื่องมือกลาง คณะวิทยาศาสตร์ มหาวิทยาลัยสงขลานครินทร์ รับนักศึกษาฝึก' . ($data->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา') . ' มาฝึกงาน' . $data->form_about . ' ระหว่างวันที่ ' . $this->uf->thai_date($data->form_start) . ' ถึง ' . $this->uf->thai_date($data->form_end) . ' จำนวน ' .$data->form_amo . ' คนนั้น บัดนี้การฝึกงานได้เสร็จสิ้นแล้วจึงขอส่ง ตัวนักศึกษากลับสถาบัน', 0, 'L');
            $pdf->Text(60, $pdf->getY() + 15, 'จึงเรียนมาเพื่อโปรดทราบ');
            $pdf->Ln(29);

            //--------------------------------
            $pdf->Text(112, $pdf->getY() + 0, 'ขอแสดงความนับถือ');
            $pdf->Text(108, $pdf->getY() + 20, '(นางสาวผุสดี  มุหะหมัด)');
            $pdf->Text(105, $pdf->getY() + 7, 'หัวหน้าหน่วยเครื่องมือกลาง');
            $pdf->Ln(29);
            //********************* */
            $pdf->Text(35, 250, 'หน่วยเครื่องมือกลาง');
            $pdf->Text(35, 257, 'โทร 0-7428-8058');
            $pdf->Text(35, 264, 'โทรสาร 0-7455-8850');
        } else { /* in */

            $pdf->SetMargins(23, 30, 23);
            $pdf->AddPage();
            //addFont
            $pdf->Image('asset/pic/in.jpg', 23, 20);


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
            $pdf->Text(33, 70, ' ขอส่งตัวนักศึกษาฝึก' . ($data->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา'));

            //--------------------------------

            $pdf->SetFont('thsarabun', '', 17);
            $pdf->Text(23, 80, 'เรียน');

            $pdf->SetFont('thsarabun', '', 17);
            $pdf->Text(33, 80, 'หัวหน้าภาควิชา' . $data->Department_name);
            $pdf->Ln(20);
            //--------------------------------
            $pdf->SetFont('thsarabun', '', 16);
            $pdf->MultiCell(164, 10, '                   ตามที่หน่วยเครื่องมือกลาง คณะวิทยาศาสตร์ มหาวิทยาลัยสงขลานครินทร์ รับนักศึกษาฝึก' . ($data->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา') . ' มาฝึกงาน' . $data->form_about . ' ระหว่างวันที่ ' . $this->uf->thai_date($data->form_start) . ' ถึง ' . $this->uf->thai_date($data->form_end  ) . ' จำนวน ' . $data->form_amo . ' คนนั้น บัดนี้การฝึกงานได้เสร็จสิ้นแล้ว จึงขอส่งตัวนักศึกษากลับ', 0, 'L');
            $pdf->Text(60, $pdf->getY() + 15, 'จึงเรียนมาเพื่อโปรดทราบ');
            $pdf->Ln(29);

            //$pdf->MultiCell(164,10,co($pdf->getX().'/'.$pdf->getY()));
            //$pdf->MultiCell(164,10,co($pdf->getX().'/'.$pdf->getY()));
            //--------------------------------
            //$pdf->Text(112, $pdf->getY() + 0, co('ขอแสดงความนับถือ'));
            $pdf->Text(108, $pdf->getY() + 15, '(นางสาวผุสดี  มุหะหมัด)');
            $pdf->Text(105, $pdf->getY() + 10, 'หัวหน้าหน่วยเครื่องมือกลาง');
            $pdf->Ln(29);
        }


        $pdf->Output();
    }
}
