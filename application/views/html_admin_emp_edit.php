<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Html Admin Emp Edit -->
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
                        <h5 class="card-title">แก้ไขเจ้าหน้าที่</h5>
                        




                        <form name="editor" action="<?php echo base_url(); ?>adminconsole/employee/save" method="post">
                            <div class="row justify-content-center">
                                <div class="col-sm">
                                    <button type="submit" class="btn btn-success">บันทึก</button>
                                    <input type="hidden" name="uid" value="<?php echo $uprs->users_id; ?>">
                                    <div class="form-group">
                                        <label for="user">ชื่อผู้ใช้</label>
                                        <input type="text" class="form-control-plaintext" value="<?php echo $uprs->users_name; ?>" name="user" id="user" aria-describedby="helpId" placeholder="ไม่สามารถแก้ไขได้" readonly>
                                        <small id="helpId" class="form-text text-muted">ไม่สามารถแก้ไขได้</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="nam">ชื่อ-นามสกุล</label>
                                        <input type="text" class="form-control" value="<?php echo $uprs-> users_FLName; ?>" name="nam" id="nam" aria-describedby="helpId" placeholder="ชื่อ" required>

                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">รหัสผ่าน</label>
                                        <input type="password" class="form-control" name="pwd" id="pwd" placeholder="ถ้าต้องการเปลี่ยนโปรดกรอก">
                                    </div>

                                    <div class="form-group">
                                        <label for="role">ตำแหน่ง</label>
                                        <select class="form-control" name="role" id="role" value="Not Set">
                                            <?php
                                            foreach($roles as $role){

                                                if ($role->users_role_id == $uprs-> users_role) {
                                                    echo "<option value=\"";
                                                    echo $role->users_role_id;
                                                    echo "\" selected=\"selected\">";
                                                    echo $role->users_role_name;
                                                    echo "</option>";
                                                } else {
                                                    echo "<option value=\"";
                                                    echo $role->users_role_id;
                                                    echo "\">";
                                                    echo $role->users_role_name;
                                                    echo "</option>";
                                                }
                                            }
                                            mysqli_close($conn);
                                            ?>

                                        </select>
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