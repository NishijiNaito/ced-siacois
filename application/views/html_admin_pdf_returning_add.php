<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Html Admin Pdf returning -->
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
                        <h5 class="card-title">PDF ส่งตัวกลับ</h5>

                        <form method="post" action="<?php echo base_url(); ?>adminconsole/pdf/returning/saveadd">



                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <label for="uid">มหาวิทยาลัย</label>
                                        <select class="form-control" name="uid" id="uid">
                                            <?php
                                            foreach ($unicols as $unicol) {
                                                echo "<option value=\"";
                                                echo $unicol->UniCol_id;
                                                echo "\">";
                                                echo $unicol->UniCol_name;
                                                echo "</option>";
                                            }
                                            ?>

                                        </select>
                                    </div>


                                    <div class="form-group">

                                        <label for="fid">คณะ</label>
                                        <select class="form-control" name="fid" id="fid">
                                            <?php
                                            foreach ($facs as $fac) {
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
                                            <?php
                                            foreach ($deps as $dep) {
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
                                        <label for="type">ประเภทฝึกงาน</label>
                                        <select id="type" class="form-control" name="type">
                                            <option value="1">ฤดูร้อน</option>
                                            <option value="2">สหกิจ</option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="ww">ฝึกงานเกี่ยวกับ</label>
                                        <textarea id="ww" class="form-control" name="ww" rows="5"></textarea>
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="dates">วันที่เริ่ม</label>
                                        <input type="date" class="form-control" name="dates" id="dates" value="<?php echo date('Y-m-d'); ?>" aria-describedby="hds" placeholder="วันที่เริ่ม">

                                    </div>

                                    <div class="form-group">
                                        <label for="datee">วันที่สิ้นสุด</label>
                                        <input type="date" class="form-control" name="datee" id="datee" value="<?php echo date('Y-m-d'); ?>" aria-describedby="hds" placeholder="วันที่สิ้นสุด">

                                    </div>


                                    <div class="form-group">
                                        <label for="amount">จำนวนคนที่มาฝึก</label>
                                        <input type="number" class="form-control" name="amount" id="amount" aria-describedby="helpId" placeholder="จำนวนคน">

                                    </div>

                                    <button type="submit" class="btn btn-success">บันทึก</button>

                                </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>