<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>


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
                                <form action="logout" method="POST">
                                    <button type="submit" class="btn btn-primary">Logout</button>

                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        <h5 class="card-title">แก้ไขข้อมูล</h5>
                        <form name="editor" action="login/saveedit" method="post">



                            <div class="row justify-content-center">
                                <div class="col-sm">
                                    <button type="submit" class="btn btn-success">บันทึก</button>

                                    <div class="form-group">
                                        <label for="id">ชื่อผู้ใช้</label>
                                        <input type="text" class="form-control-plaintext" name="uid" id="uid" value="<?php echo $_SESSION['user']; ?>" aria-describedby="helpId" placeholder="รหัสนักศึกษา" readonly>

                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">รหัสผ่าน</label>
                                        <input type="password" class="form-control" name="pwd" id="pwd" placeholder="ถ้าต้องการเปลี่ยนโปรดกรอก">
                                    </div>

                                    <input type="hidden" name="bdates" value="<?php echo $_SESSION['date']; ?>">



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