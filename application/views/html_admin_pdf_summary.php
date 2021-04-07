<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Html Admin Pdf Summary -->
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
                        <h5 class="card-title">PDF สรุปยอด</h5>
                        <hr>

                        <div class="row justify-content-between">
                            <div class="col-sm">
                                <p class="card-text">โปรดเลือกช่วงเวลาที่จะออกเอกสาร</p>
                                
                                <form action="<?php echo base_url(); ?>adminpdf/summary" method="POST">

                                    <div class="form-group">
                                        <label for="dates">วันที่เริ่ม</label>
                                        <input type="date" class="form-control" name="dates" id="dates" value="<?php echo date('Y-m-d'); ?>" aria-describedby="hds" placeholder="วันที่เริ่ม" required>

                                    </div>

                                    <div class="form-group">
                                        <label for="datee">วันที่สิ้นสุด</label>
                                        <input type="date" class="form-control" name="datee" id="datee" value="<?php echo date('Y-m-d'); ?>" aria-describedby="hds" placeholder="วันที่สิ้นสุด" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="amount">ตารางที่</label>
                                        <input type="number" class="form-control" name="amount" id="amount" aria-describedby="helpId" placeholder="ตารางที่..." required>
                                        <small id="helpId" class="form-text text-muted">ตารางที่ ... การบริหารนักศึกษาฝึกงานจากภายในคณะ ฯ และสถาบันต่างๆ</small>

                                    </div>

                                    <button type="submit" class="btn btn-success">บันทึก</button>

                                </form>

                            </div>
                        </div>







                    </div>
                </div>
            </div>

        </div>
    </div>
</div>