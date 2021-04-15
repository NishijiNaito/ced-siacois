<?php
//หน่วยเครื่องมือกลาง คณะวิทยาศาสตร์ -> ศูนย์บริการตรวจสอบและรับรองมาตรฐาน
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
        //$this->load->library('FFPdf'); //$pdf = new FFPdf();
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

            $pdf->Text(135, 30, 'ศูนย์บริการตรวจสอบและรับรองมาตรฐาน');
            $pdf->Text(135, 37, 'มหาวิทยาลัยสงขลานครินทร์');
            $pdf->Text(135, 44, 'ตู้ ปณ 3 คอหงส์ หาดใหญ่');
            $pdf->Text(135, 51, 'สงขลา 90112');
            $pdf->Ln(10);
            //--------------------------------
            $pdf->MultiCell(0, 7, $this->uf->thai_date(date("Y-m-d")), 0, 'C');

            //--------------------------------

            $pdf->Text(35, 80, 'เรื่อง  ให้ความอนุเคราะห์ให้นักศึกษาฝึก' . ($data->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา'));



            $pdf->Text(35, 87, 'เรียน  คณบดีคณะ' . $data->Faculty_name . ($data->UniCol_type === "uni" ? ' มหา' : ' ') . 'วิทยาลัย' . $data->UniCol_name);
            $pdf->Text(35, 94, 'อ้างถึง  ' . $data->form_ref);
            $pdf->Ln(20);

            //--------------------------------

            $pdf->MultiCell(0, 7, '                   ตามที่ หนังสือที่อ้างถึง คณะ' . $data->Faculty_name . ($data->UniCol_type === "uni" ? ' มหา' : ' ') . 'วิทยาลัย' . $data->UniCol_name . ' ขอความอนุเคราะห์ให้นักศึกษา สาขาวิชา' . $data->Department_name . ' เข้าฝึก' . ($data->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา') . ' ระหว่างวันที่ ' . $this->uf->thai_date($data->form_start) . ' ถึง ' . $this->uf->thai_date($data->form_end) . ' ความโดยละเอียดที่แจ้งแล้วนั้น หน่วยงานได้พิจารณาแล้ว ยินดีอนุเคราะห์ให้ นักศึกษาฝึก' . ($data->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา') . ' จำนวน ' . $data->form_amo . ' คน', 0, 'L');
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
            $pdf->Text(43, 50, 'ศูนย์บริการตรวจสอบและรับรองมาตรฐาน โทร. 8058');
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
            $pdf->MultiCell(164, 10, '                   ตามที่ หนังสือที่อ้างถึง คณะ' . $data->Faculty_name . ($data->UniCol_type === "uni" ? ' มหา' : ' ') . 'วิทยาลัย' . $data->UniCol_name . ' ขอความอนุเคราะห์ให้นักศึกษา สาขาวิชา' . $data->Department_name . ' เข้าฝึก' . ($data->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา') . ' ระหว่างวันที่ ' . $this->uf->thai_date($data->form_start) . ' ถึง ' . $this->uf->thai_date($data->form_end) . ' ความโดยละเอียดที่แจ้งแล้วนั้น หน่วยงานได้พิจารณาแล้ว ยินดีอนุเคราะห์ให้ นักศึกษาฝึก' . ($data->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา') . ' จำนวน ' . $data->form_amo . ' คน', 0, 'L');
            $pdf->Text(60, $pdf->getY() + 15, 'จึงเรียนมาเพื่อโปรดทราบ');
            $pdf->Ln(29);

            //$pdf->MultiCell(164,10,$pdf->getX().'/'.$pdf->getY()));
            //$pdf->MultiCell(164,10,$pdf->getX().'/'.$pdf->getY()));
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

            $pdf->Text(135, 30, 'ศูนย์บริการตรวจสอบและรับรองมาตรฐาน');
            $pdf->Text(135, 37, 'มหาวิทยาลัยสงขลานครินทร์');
            $pdf->Text(135, 44, 'ตู้ ปณ 3 คอหงส์ หาดใหญ่');
            $pdf->Text(135, 51, 'สงขลา 90112');
            $pdf->Ln(10);
            //--------------------------------
            $pdf->MultiCell(0, 7, $this->uf->thai_date(date("Y-m-d")), 0, 'C');

            //--------------------------------

            $pdf->Text(35, 80, 'เรื่อง  ขอส่งตัวนักศึกษาฝึก' . ($data->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา'));


            $pdf->Text(35, 87, 'เรียน  คณบดีคณะ' . $data->Faculty_name . ' ' . ($data->UniCol_type === "uni" ? 'มหา' : '') . 'วิทยาลัย' . $data->UniCol_name);

            $pdf->Ln(20);

            //--------------------------------

            $pdf->MultiCell(0, 7, '                ตามที่ศูนย์บริการตรวจสอบและรับรองมาตรฐาน มหาวิทยาลัยสงขลานครินทร์ รับนักศึกษาฝึก' . ($data->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา') . ' มาฝึกงาน' . $data->form_about . ' ระหว่างวันที่ ' . $this->uf->thai_date($data->form_start) . ' ถึง ' . $this->uf->thai_date($data->form_end) . ' จำนวน ' . $data->form_amo . ' คนนั้น บัดนี้การฝึกงานได้เสร็จสิ้นแล้วจึงขอส่ง ตัวนักศึกษากลับสถาบัน', 0, 'L');
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
            //addimg
            $pdf->Image('asset/pic/in.jpg', 23, 20);


            //-------------------------------
            $pdf->SetFont('thsarabun', '', 24);
            $pdf->MultiCell(180, 10, 'บันทึกข้อความ', 0, 'C');
            $pdf->Ln(50);
            //--------------------------------------------
            $pdf->SetFont('thsarabun', '', 17);
            $pdf->Text(23, 50, 'ส่วนงาน');

            $pdf->SetFont('thsarabun', '', 17);
            $pdf->Text(43, 50, 'ศูนย์บริการตรวจสอบและรับรองมาตรฐาน โทร. 8058');
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
            $pdf->MultiCell(164, 10, '                   ตามที่ศูนย์บริการตรวจสอบและรับรองมาตรฐาน มหาวิทยาลัยสงขลานครินทร์ รับนักศึกษาฝึก' . ($data->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา') . ' มาฝึกงาน' . $data->form_about . ' ระหว่างวันที่ ' . $this->uf->thai_date($data->form_start) . ' ถึง ' . $this->uf->thai_date($data->form_end) . ' จำนวน ' . $data->form_amo . ' คนนั้น บัดนี้การฝึกงานได้เสร็จสิ้นแล้ว จึงขอส่งตัวนักศึกษากลับ', 0, 'L');
            $pdf->Text(60, $pdf->getY() + 15, 'จึงเรียนมาเพื่อโปรดทราบ');
            $pdf->Ln(29);

            //$pdf->MultiCell(164,10,$pdf->getX().'/'.$pdf->getY()));
            //$pdf->MultiCell(164,10,$pdf->getX().'/'.$pdf->getY()));
            //--------------------------------
            //$pdf->Text(112, $pdf->getY() + 0, 'ขอแสดงความนับถือ'));
            $pdf->Text(108, $pdf->getY() + 15, '(นางสาวผุสดี  มุหะหมัด)');
            $pdf->Text(105, $pdf->getY() + 10, 'หัวหน้าหน่วยเครื่องมือกลาง');
            $pdf->Ln(29);
        }


        $pdf->Output();
    }

    public function certi()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'Form Id', 'required|trim');
        $this->form_validation->set_rules('dstart', 'Form Id', 'required|trim');
        if ($this->form_validation->run() == FALSE) { //if not input
            redirect("adminconsole/pdf/certi");
        }

        //$_POST['uid'] side

        $temp = $this->ld->getallformcerti_one($_POST['id'], $_POST['dstart']);
        if (count($temp) != 1) {
            redirect("adminconsole/pdf/certi");
        }
        $data = $temp[0];
        
        $pdf = new TCPDF('L', 'mm', [297,210], true, 'UTF-8', false, true);

        $pdf->SetMargins(0, 0, 0);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(false,0); //เพื่อให้เต็มหน้า
        $pdf->AddPage();
        $pdf->Image('asset/pic/back.png', 0, 0, 297, 210, '', '', 'T', false, 300,'C');

        //--------------------------------------------
        $pdf->SetFont('thsarabun', '', 28);
        $pdf->SetTextColor(227, 108, 10);
        //--------------------------------
        $pdf->Ln(20);
        $pdf->MultiCell(0, 10, 'หนังสือรับรองการฝึกงาน', 0, 'C');

        $pdf->SetFont('thsarabun', '', 22);
        $pdf->SetTextColor(0, 32, 96);
        $pdf->Ln(1);
        $pdf->MultiCell(0, 15, "$data->student_FNS $data->student_FName $data->student_LName", 0, 'C');
        $pdf->SetFont('thsarabun', '', 20);
        $pdf->SetTextColor(128, 0, 128);
        $pdf->MultiCell(0, 8, "ได้ผ่านการฝึกงาน ตามหลักสูตรปริญญาตรี", 0, 'C');
        $pdf->MultiCell(0, 8, "สาขาวิชา $data->Department_name", 0, 'C');
        $pdf->MultiCell(0, 8, ($data->UniCol_type === "uni" ? 'มหา' : '') . "วิทยาลัย$data->UniCol_name", 0, 'C');
        $pdf->MultiCell(0, 8, "จาก หน่วยเครื่องมือกลาง", 0, 'C');
        $pdf->MultiCell(0, 8, $_POST['side'], 0, 'C');
        $pdf->MultiCell(0, 8, "ที่ตั้ง คณะวิทยาศาสตร์ มหาวิทยาลัยสงขลานครินทร์ อ.หาดใหญ่ จ.สงขลา", 0, 'C');
        $pdf->MultiCell(0, 8, "โดยมีระยะเวลาการฝึกงาน ตั้งแต่วันที่ " . $this->uf->thai_date($data->student_Start) . ' ถึง ' . $this->uf->thai_date($data->student_End), 0, 'C');
        $pdf->MultiCell(0, 8, "ในระหว่างการฝึกงานนักศึกษามีความประพฤติเรียบร้อย ขยันหมั่นเพียร มีความตั้งใจ", 0, 'C');
        $pdf->Ln(10);
        $pdf->SetTextColor(0, 0, 128);
        $pdf->Cell(150);
        // Centered text in a framed 20*10 mm cell and line break
        $pdf->Cell(40, 10, 'ลงชื่อ.....................................', 0, 1, 'C');
        $pdf->Cell(150);
        // Centered text in a framed 20*10 mm cell and line break
        $pdf->Cell(40, 10, '(นางสาวผุสดี มุหะหมัด)', 0, 1, 'C');
        $pdf->Cell(150);
        // Centered text in a framed 20*10 mm cell and line break
        $pdf->Cell(40, 10, 'ตำแหน่ง หัวหน้าหน่วยเครื่องมือกลาง', 0, 1, 'C');
        //--------------------------------



        $pdf->Output('certificate-' . $_REQUEST['id'] . '.pdf', 'I');
        
    }

    public function summary()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('dates', 'Form Id', 'required|trim');
        $this->form_validation->set_rules('datee', 'Form Id', 'required|trim');
        if ($this->form_validation->run() == FALSE) { //if not input
            redirect("adminconsole/pdf/summary");
        }
        if (strtotime($_POST['dates']) > strtotime($_POST['datee'])) { // Date Error
            $this->_error("เนื่องจากวันที่เริ่มต้น อยู่หลังวันที่สิ้นสุด โปรดรอ 3 วินาที", "adminconsole/pdf/summary");
        } else {
            $datas = $this->ld->getallformsummary_one($_POST['dates'], $_POST['datee']);

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8');

            // กำหนดคุณสมบัติของไฟล์ PDF เช่น ผู้สร้างไฟล์ หัวข้อไฟล์ คำค้น 
            $pdf->SetCreator('CED-SCI');
            $pdf->SetAuthor('CED-SCI Developer');
            $pdf->SetTitle('Ced Summary');
            $pdf->SetSubject('Use');
            $pdf->SetKeywords('CED,Training');

            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'CED Summary', 'Summary', array(0, 64, 255), array(0, 64, 128));
            $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

            // กำหนดให้ไม่แสดงส่วนหัวของเอกสาร
            $pdf->setPrintHeader(false);
            // กำหนดให้ไม่แสดงส่วนท้ายของเอกสาร
            $pdf->setPrintFooter(false);

            $pdf->SetAutoPageBreak(TRUE, 10);
            // กำหนดระยะขอบกระดาษ
            // PDF_MARGIN_LEFT = ขอบกระดาษด้านซ้าย 15mm
            // PDF_MARGIN_TOP = ขอบกระดาษด้านบน 27mm
            // PDF_MARGIN_RIGHT = ขอบกระดาษด้านขวา 15mm
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

            // กำหนดระยะห่างจากขอบกระดาษด้านบนมาที่ส่วนหัวกระดาษ
            // PDF_MARGIN_HEADER = 5mm
            //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            // กำหนดระยะห่างจากขอบกระดาษด้านล่างมาที่ส่วนท้ายกระดาษ
            // PDF_MARGIN_FOOTER = 10mm
            //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // กำหนดให้ขึ้นหน้าใหม่แบบอัตโนมัติ เมื่อเนื้อหาเกินระยะที่กำหนด
            // PDF_MARGIN_BOTTOM = 25mm นับจากขอบล่าง
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // กำหนดตัวอักษรสำหรับส่วนเนื้อหา ชื่อตัวอักษร รูปแบบและขนาดตัวอักษร
            $pdf->SetFont('thsarabun', '', 18);

            // กำหนดให้สร้างหน้าเอกสาร
            $pdf->AddPage();

            // ข้อมูลที่จะแสดงในเนื้อหา
            $html = "<p>ตารางที่ $_POST[amount] การบริหารนักศึกษาฝึกงานจากภายในคณะ ฯ และสถาบันต่างๆ</p>";
            $pdf->writeHTML($html);
            $pdf->SetFont('thsarabun', '', 16);
            $html = '<p></p><table width="100%" border="1" cellspacing="0" cellpadding="3">';
            $html .= "<tr>";
            $html .= '<td width="65%" align="center">มหาวิทยาลัย / วิทยาลัย</td>';
            $html .= '<td width="23%" align="center">ระยะเวลา</td>';
            $html .= '<td width="12%" align="center">จำนวน</td>';
            $html .= "</tr>";
            foreach ($datas as $data) {
                $html .= "<tr>";
                $html .= '<td width="65%" text-align="justify">' . ($data->UniCol_type === "uni" ? 'มหา' : '') . 'วิทยาลัย' . $data->UniCol_name . ($data->UniCol_type === "uni" ? ' คณะ' . $data->Faculty_name : '')  . ' สาขา' . $data->Department_name . '</td>';
                $html .= '<td width="23%">' . $this->uf->thai_date($data->student_Start) . ' ถึง ' . $this->uf->thai_date($data->student_End) . '</td>';
                $html .= '<td width="12%" align="center">' . $data->c . '</td>';
                $html .= "</tr>";
            }


            $html .= "</table>";

            // กำหนดการแสดงข้อมูลแบบ HTML 

            $pdf->writeHTML($html);
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

            // กำหนดการชื่อเอกสาร และรูปแบบการแสดงผล
            $pdf->Output('summary-' . $_POST['dates'] . 'to' . $_POST['datee'] . '.pdf', 'I');
        }


        //dates datee

    }
}
