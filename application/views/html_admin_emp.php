<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Html Admin Emp -->
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
                        <h5 class="card-title">เจ้าหน้าที่</h5>
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
                                                <form name="editor" action="<?php echo current_url(); ?>/add" method="post">
                                                    <div class="row justify-content-center">
                                                        <div class="col-sm">
                                                            <button type="submit" class="btn btn-success">บันทึก</button>

                                                            <div class="form-group">
                                                                <label for="user">ชื่อผู้ใช้</label>
                                                                <input type="text" class="form-control" name="user" id="user" aria-describedby="helpId" placeholder="username" required>

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nam">ชื่อ-นามสกุล</label>
                                                                <input type="text" class="form-control" name="nam" id="nam" aria-describedby="helpId" placeholder="ชื่อ" required>

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="pwd">รหัสผ่าน</label>
                                                                <input type="password" class="form-control" name="pwd" id="pwd" placeholder="รหัสผ่าน" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="role">ตำแหน่ง</label>
                                                                <select class="form-control" name="role" id="role">
                                                                    <?php

                                                                    foreach ($roles as $role) {
                                                                        echo "<option value=\"";
                                                                        echo $role->users_role_id;
                                                                        echo "\">";
                                                                        echo $role->users_role_name;
                                                                        echo "</option>";
                                                                    }

                                                                    ?>

                                                                </select>
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
                                            <th scope="col">No</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        foreach($uprs as $upr){
                                            echo "<tr>";
                                            echo "<th scope=\"row\">";
                                            echo (int) $upr->users_id;
                                            echo "</th>";
                                            echo "<th>";
                                            echo $upr->users_name;
                                            echo "</th>";
                                            echo "<th>";
                                            echo $upr->users_role_name;
                                            echo "</th>";
                                            echo "<th>";
                                            echo "<a name=\"ed\"  class=\"btn btn-primary\" href=\"".current_url()."/edit/";
                                            echo $upr->users_id;
                                            echo "\" role=\"button\">Edit</a>";
                                            echo "</th>";
                                            echo "<th>";
                                            echo "<button type=\"button\" class=\"btn btn-danger\" onclick=\"del(";
                                            echo $upr->users_id;
                                            echo ")\">ลบ</button>";
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