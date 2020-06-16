<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Html Admin Std -->
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
                        <h5 class="card-title">นักศึกษา</h5>
                        <div class="row justify-content-center">
                            <div class="col-sm">





                                <!-- Toggle Modal -->

                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modUni"> <i class="fa fa-plus" aria-hidden="true"></i> เพิ่ม</button>


                                <!-- Modal -->
                                <div id="modUni" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered" role="document">

                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">เพิ่มชื่อผู้ใช้งาน</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">


                                                <!-- Form -->
                                                <form name="editor" action="<?php echo base_url(); ?>adminconsole/student/add" method="post">
                                                    <div class="row justify-content-center">
                                                        <div class="col-sm">
                                                            <button type="submit" class="btn btn-success">บันทึก</button>

                                                            <div class="form-group">
                                                                <label for="id">ชื่อผู้ใช้</label>
                                                                <input type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="รหัสนักศึกษา" required>

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="pwd">รหัสผ่าน</label>
                                                                <input type="password" class="form-control" name="pwd" id="pwd" placeholder="รหัสผ่าน" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="fns">คำนำหน้า</label>
                                                                <select id="fns" class="form-control" name="fns">
                                                                    <option>นาย</option>
                                                                    <option>นาง</option>
                                                                    <option>นางสาว</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="fnam">ชื่อ</label>
                                                                <input type="text" class="form-control" name="fnam" id="fnam" aria-describedby="helpId" placeholder="ชื่อ" required>

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="lnam">นามสกุล</label>
                                                                <input type="text" class="form-control" name="lnam" id="lnam" aria-describedby="helpId" placeholder="นามสกุล" required>

                                                            </div>

                                                            <div class="form-group">

                                                                <label for="uid">มหาวิทยาลัย / วิทยาลัย</label>
                                                                <select class="form-control" name="uid" id="uid">
                                                                    <?php
                                                                    foreach($unicols as $uc){


                                                                        echo "<option value=\"";
                                                                        echo $uc->UniCol_id;
                                                                        echo "\">";
                                                                        echo $uc->UniCol_name;
                                                                        echo "</option>";
                                                                    }

                                                                    ?>

                                                                </select>
                                                            </div>


                                                            <div class="form-group">

                                                                <label for="fid">คณะ</label>
                                                                <select class="form-control" name="fid" id="fid">
                                                                    <?php

                                                                    foreach($facs as $fac){

                                                                        echo "<option value=\"";
                                                                        echo $fac->Faculty_id;
                                                                        echo "\">";
                                                                        echo $fac->Faculty_name;
                                                                        echo "</option>";
                                                                    }

                                                                    ?>

                                                                </select>
                                                            </div>


                                                            <div class="form-group">

                                                                <label for="did">ภาควิชา</label>
                                                                <select class="form-control" name="did" id="did">
                                                                    <option value="no" selected>ไม่มีภาควิชา (สำหรับวิทยาลัย)</option>
                                                                    <?php

                                                                    foreach($deps as $dep){

                                                                        echo "<option value=\"";
                                                                        echo $dep->Department_id;
                                                                        echo "\">";
                                                                        echo $dep->Department_name;
                                                                        echo "</option>";
                                                                    }

                                                                    ?>

                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="yr">ชั้นปี</label>
                                                                <select id="yr" class="form-control" name="yr">
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="type">ประเภทฝึกงาน</label>
                                                                <select id="type" class="form-control" name="type">
                                                                    <option value="1">ฤดูร้อน</option>
                                                                    <option value="2">สหกิจ</option>

                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="dates">วันที่เริ่ม</label>
                                                                <input type="date" class="form-control" name="dates" id="dates" aria-describedby="hds" placeholder="วันที่เริ่ม" required>

                                                            </div>

                                                            <div class="form-group">
                                                                <label for="datee">วันที่สิ้นสุด</label>
                                                                <input type="date" class="form-control" name="datee" id="datee" aria-describedby="hds" placeholder="วันที่สิ้นสุด" required>

                                                            </div>




                                                        </div>

                                                    </div>
                                                    <hr>

                                                </form>

                                                <!-- End Form -->


                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <!-- End Modal -->






                            </div>

                        </div>
                        <hr>
                        <div class="row justify-content-between">
                            <div class="col-sm">
                                <table class="table table-striped table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">รหัสนักศึกษา</th>
                                            <th scope="col">ชื่อ-นามสกุล</th>
                                            <th scope="col">สถานะฝึกงาน</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                       foreach($stds as $std){
                                            echo "<tr>";
                                            echo "<th scope=\"row\">";
                                            echo $std->student_id;
                                            echo "</th>";
                                            echo "<th>";
                                            echo $std->student_FName;
                                            echo " ";
                                            echo $std->student_LName;
                                            echo "</th>";
                                            echo "<th>";
                                            echo ($std->student_type == 1 ? 'ฤดูร้อน' : 'สหกิจศึกษา');
                                            echo "</th>";
                                            echo "<th>";
                                            echo "<a name=\"ed\"  class=\"btn btn-primary\" href=\"".current_url()."/edit/";
                                            echo $std->student_id;
                                            echo "/";
                                            echo $std->student_Start;
                                            echo "\" role=\"button\">Edit</a>";
                                            echo "</th>";
                                            echo "<th>";
                                            echo "<button type=\"button\" class=\"btn btn-danger\" onclick=\"del(";
                                            echo $std->student_id;
                                            echo ",'";
                                            echo $std->student_Start;
                                            echo "')\">ลบ</button>";
                                            echo "</th>";
                                            echo "</tr>";
                                        }

                                        

                                        ?>




                                    </tbody>




                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>