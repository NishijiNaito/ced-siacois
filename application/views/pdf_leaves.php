<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo "เนื่องด้วยข้าพเจ้า ".$stddata ->student_FNS."".$stddata ->student_FName." "
            .$stddata ->student_LName." นักศึกษาฝึก".(($stddata ->student_type==1)?"งานฤดูร้อน":"สหกิจศึกษา"). " จากสาขา".$stddata ->Department_name." คณะ".$stddata ->Faculty_name." มหาวิทยาลัย".$stddata ->UniCol_name.
            " มีความประสงค์ขอลา".(($rep->Leaves_Type==1)?"ป่วย":"กิจ" )." เนื่องจาก ".$rep->Leaves_Reason; ?></p>