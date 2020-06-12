<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Html Login -->
<div class="row justify-content-center">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">โปรดเข้าสู่ระบบ</h5>
                <form method="post" action="">

                    <div class="form-group">
                        <label for="user">ชื่อผู้ใช้งาน</label>
                        <input id="user" class="form-control" type="text" name="">
                    </div>

                    <div class="form-group">
                        <label for="pass">รหัสผ่าน</label>
                        <input id="pass" class="form-control" type="password" name="">
                    </div>
                    <button type="button" onclick="" class="btn btn-success">
                        <span id="butt" style="visibility:Hidden;" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Login</button>
                    <br>

                    <div id="nothave" class="alert alert-danger" role="alert" style="visibility:Hidden;">
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                        กรอกชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>