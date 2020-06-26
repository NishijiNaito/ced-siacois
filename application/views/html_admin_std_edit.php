<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Html Admin Std Edit -->
<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="row">

            <div class="col-sm">
                <div class="card bg-light">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col-sm-4">
                                สวัสดี , <?php echo $_SESSION['name']; ?>
                            </div>
                            <div class="col-sm-4 text-right">
                                <form action="<?php echo base_url(); ?>edit" method="POST">
                                    <button type="submit" class="btn btn-primary">Edit Profile</button>

                                </form>
                                <form action="<?php echo base_url(); ?>logout" method="POST">
                                    <button type="submit" class="btn btn-primary">Logout</button>

                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        <h5 class="card-title">แก้ไขนักศึกษา</h5>





                        <form name="editor" action="<?php echo base_url(); ?>adminconsole/student/save" method="post">



                            <div class="row justify-content-center">
                                <div class="col-sm">
                                    <button type="submit" class="btn btn-success">บันทึก</button>

                                    <div class="form-group">
                                        <label for="id">ชื่อผู้ใช้</label>
                                        <input type="text" class="form-control-plaintext" name="id" id="id" value="<?php echo $stds->student_id; ?>" aria-describedby="helpId" placeholder="รหัสนักศึกษา" readonly>

                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">รหัสผ่าน</label>
                                        <input type="password" class="form-control" name="pwd" id="pwd" placeholder="ถ้าต้องการเปลี่ยนโปรดกรอก">
                                    </div>

                                    <div class="form-group">
                                        <label for="fns">คำนำหน้า</label>
                                        <select id="fns" class="form-control" name="fns">
                                            <option <?php if ($stds->student_FNS == "นาย") {
                                                        echo "selected=\"selected\"";
                                                    } ?>>นาย</option>
                                            <option <?php if ($stds->student_FNS == "นาง") {
                                                        echo "selected=\"selected\"";
                                                    } ?>>นาง</option>
                                            <option <?php if ($stds->student_FNS == "นางสาว") {
                                                        echo "selected=\"selected\"";
                                                    } ?>>นางสาว</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="fnam">ชื่อ</label>
                                        <input type="text" class="form-control" name="fnam" id="fnam" value="<?php echo $stds->student_FName; ?>" aria-describedby="helpId" placeholder="ชื่อ" required>

                                    </div>
                                    <div class="form-group">
                                        <label for="lnam">นามสกุล</label>
                                        <input type="text" class="form-control" name="lnam" id="lnam" value="<?php echo $stds->student_LName; ?>" aria-describedby="helpId" placeholder="นามสกุล" required>

                                    </div>

                                    <div class="form-group">

                                        <label for="ucid">มหาวิทยาลัย</label>
                                        <select class="form-control" name="ucid" id="ucid">

                                            <?php
                                            foreach ($unicols as $uc) {

                                                if ($uc->UniCol_id == $stds->student_UniCol) {
                                                    echo "<option value=\"";
                                                    echo $uc->UniCol_id;
                                                    echo "\" selected=\"selected\">";
                                                    echo $uc->UniCol_name;
                                                    echo "</option>";
                                                } else {
                                                    echo "<option value=\"";
                                                    echo $uc->UniCol_id;
                                                    echo "\">";
                                                    echo $uc->UniCol_name;
                                                    echo "</option>";
                                                }
                                            }

                                            ?>
                                        </select>
                                    </div>


                                    <div class="form-group">

                                        <label for="fid">คณะ</label>
                                        <select class="form-control" name="fid" id="fid">
                                            <?php

                                            if ($stds->student_Faculty == null) {
                                            ?>
                                                <option value="no" selected>ไม่มีคณะ (สำหรับวิทยาลัย)</option>

                                                <?php

                                                foreach ($facs as $fac) {

                                                    echo "<option value=\"";
                                                    echo $fac->Faculty_id;
                                                    echo "\" >";
                                                    echo $fac->Faculty_name;
                                                    echo "</option>";
                                                }
                                            } else {
                                                ?>
                                                <option value="no">ไม่มีคณะ (สำหรับวิทยาลัย)</option>

                                            <?php
                                                foreach ($facs as $fac) {

                                                    if ($fac->Faculty_id == $stds->student_Faculty) {
                                                        echo "<option value=\"";
                                                        echo $fac->Faculty_id;
                                                        echo "\" selected=\"selected\">";
                                                        echo $fac->Faculty_name;
                                                        echo "</option>";
                                                    } else {
                                                        echo "<option value=\"";
                                                        echo $fac->Faculty_id;
                                                        echo "\">";
                                                        echo $fac->Faculty_name;
                                                        echo "</option>";
                                                    }
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>


                                    <div class="form-group">

                                        <label for="did">ภาควิชา</label>
                                        <select class="form-control" name="did" id="did">
                                            <?php

                                            foreach ($deps as $dep) {

                                                if ($dep->Department_id == $stds->student_department) {
                                                    echo "<option value=\"";
                                                    echo $dep->Department_id;
                                                    echo "\" selected=\"selected\">";
                                                    echo $dep->Department_name;
                                                    echo "</option>";
                                                } else {
                                                    echo "<option value=\"";
                                                    echo $dep->Department_id;
                                                    echo "\">";
                                                    echo $dep->Department_name;
                                                    echo "</option>";
                                                }
                                            }

                                            ?>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="yr">ชั้นปี</label>
                                        <select id="yr" class="form-control" name="yr">
                                            <option <?php if ($stds->student_Year == 2) {
                                                        echo "selected=\"selected\"";
                                                    } ?>>2</option>
                                            <option <?php if ($stds->student_Year == 3) {
                                                        echo "selected=\"selected\"";
                                                    } ?>>3</option>
                                            <option <?php if ($stds->student_Year == 4) {
                                                        echo "selected=\"selected\"";
                                                    } ?>>4</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="type">ประเภทฝึกงาน</label>
                                        <select id="type" class="form-control" name="type">
                                            <option value="1" <?php if ($stds->student_type == 1) {
                                                                    echo "selected=\"selected\"";
                                                                } ?>>ฤดูร้อน</option>
                                            <option value="2" <?php if ($stds->student_type == 2) {
                                                                    echo "selected=\"selected\"";
                                                                } ?>>สหกิจ</option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="dates">วันที่เริ่ม</label>
                                        <input type="date" class="form-control" name="dates" id="dates" value="<?php echo $stds->student_Start; ?>" aria-describedby="hds" placeholder="วันที่เริ่ม" required>
                                        <input type="hidden" name="bdates" value="<?php echo $stds->student_Start; ?>">

                                    </div>

                                    <div class="form-group">
                                        <label for="datee">วันที่สิ้นสุด</label>
                                        <input type="date" class="form-control" name="datee" id="datee" value="<?php echo $stds->student_End; ?>" aria-describedby="hds" placeholder="วันที่สิ้นสุด" required>

                                    </div>




                                </div>

                            </div>




                            <hr>

                        </form>






                    </div>
                </div>
            </div>

        </div>
    </div>
</div>