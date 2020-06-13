<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Html Login -->
<div class="row justify-content-center">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">โปรดเข้าสู่ระบบ</h5>
                <?php
                    if($wrong){
                ?>
                <div id="nothave" class="alert alert-danger" role="alert" >
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    กรอกชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง
                </div>
                <?php
                    }
                ?>
                <form method="post" action="login/login">

                    <div class="form-group">
                        <label for="uname">ชื่อผู้ใช้งาน</label>
                        <input id="uname" class="form-control" type="text" name="uname" required>
                    </div>

                    <div class="form-group">
                        <label for="pass">รหัสผ่าน</label>
                        <input id="pass" class="form-control" type="password" name="pwd" required>
                    </div>
                    <div class="form-group">
                      <label for="type">เข้าสู่ระบบในฐานะ</label>
                      <select class="form-control" name="type" id="type">
                        <option value="adm">ผู้ดูแลระบบ</option>
                        <option value="std">นักศึกษา</option>
                        
                      </select>
                    </div>

                    <button type="submit" onclick="" class="btn btn-success">Login</button>
                    <br>



                </form>
            </div>
        </div>
    </div>
</div>