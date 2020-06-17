<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Html Admin Leave   -->
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
                                <form action="edit" method="POST">
                                    <button type="submit" class="btn btn-primary">Edit Profile</button>

                                </form>
                                <form action="logout" method="POST">
                                    <button type="submit" class="btn btn-primary">Logout</button>

                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <h5 class="card-title">นักศึกษา</h5>
                        <p class="card-text">กรอกใบลา</p>

                        <div class="row justify-content-center">
                            <div class="col-sm">





                                <!-- Toggle Modal -->

                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#formss"> ลาป่วย </button>


                                <!-- Modal -->
                                <div id="formss" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered" role="document">

                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">กรอกใบลาป่วย</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">


                                                <!-- Form -->
                                                <form name="editor" action="<?php echo base_url(); ?>student/leaverequest/add" method="post">
                                                    <div class="row justify-content-center">
                                                        <div class="col-sm">
                                                            <button type="submit" class="btn btn-success">บันทึก</button>
                                                            <input type="hidden" name="typ" value="1"> <!-- ลาป่วย -->

                                                            &nbsp;
                                                            <div class="form-group">
                                                                <label for="reason">เนื่องด้วยข้าพเจ้า <?php echo $data->student_FNS; ?> <?php echo $data->student_FName; ?> <?php echo $data->student_LName; ?> นักศึกษาฝึก<?php echo ($data->student_type = 1) ? "งานฤดูร้อน" : "สหกิจศึกษา"; ?> จากสาขา<?php echo $data->Department_name; ?> คณะ<?php echo $data->Faculty_name; ?> มหาวิทยาลัย<?php echo $data->UniCol_name; ?>
                                                                    มีความประสงค์ขอลาป่วย เนื่องจาก</label>
                                                                <textarea id="reason" class="form-control" name="reason" rows="5"></textarea>
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


                                <!-- Toggle Modal -->

                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#formsa"> ลากิจ </button>


                                <!-- Modal -->
                                <div id="formsa" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered" role="document">

                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">กรอกใบลากิจ</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">


                                                <!-- Form -->
                                                <form name="editor" action="<?php echo base_url(); ?>student/leaverequest/add" method="post">
                                                    <div class="row justify-content-center">
                                                        <div class="col-sm">
                                                            <button type="submit" class="btn btn-success">บันทึก</button>
                                                            <input type="hidden" name="typ" value="2"> <!-- ลากิจ -->

                                                            &nbsp;
                                                            <div class="form-group">
                                                                <label for="reason">เนื่องด้วยข้าพเจ้า <?php echo $data->student_FNS; ?> <?php echo $data->student_FName; ?> <?php echo $data->student_LName; ?> นักศึกษาฝึก<?php echo ($data->student_type = 1) ? "งานฤดูร้อน" : "สหกิจศึกษา"; ?> จากสาขา<?php echo $data->Department_name; ?> คณะ<?php echo $data->Faculty_name; ?> มหาวิทยาลัย<?php echo $data->UniCol_name; ?>

                                                                    มีความประสงค์ขอลากิจ เนื่องจาก
                                                                </label>
                                                                <textarea id="reason" class="form-control" name="reason" rows="5"></textarea>
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
                                            <th scope="col">ลำดับที่</th>
                                            <th scope="col">ดูข้อมูล</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $iw=0;
                                        if (count($leaves) > 0) {

                                            foreach($leaves as $leave){
                                                $iw++;
                                        ?>
                                                <tr>
                                                    <th scope="row">
                                                        <?php echo $leave->Leaves_id; ?>
                                                    </th>
                                                    <th>
                                                        <!-- Toggle Modal -->

                                                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#shown<?php echo $iw; ?>"> ดูข้อมูล</button>




                                                    </th>


                                                    <th><button type="button" class="btn btn-danger" onclick="del(<?php echo $leave->Leaves_id; ?>)">ลบ</button></th>
                                                </tr>

                                                <!-- Modal -->
                                                <div id="shown<?php echo $iw; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

                                                    <div class="modal-dialog modal-dialog-centered" role="document">

                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">ข้อมูลการลา</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <?php echo $leave->Leaves_Reason; ?>
                                                                <hr>
                                                                <a href="<?php echo base_url(); ?>student/leaverequest/form/<?php echo $leave->Leaves_id; ?>">
                                                                    <button class="btn btn-success" type="button"> พิมพ์เป็น pdf </button>
                                                                </a>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <!-- End Modal -->

                                            <?php
                                            }
                                        } else { ?>
                                            <tr>
                                                <th colspan="4">ไม่มีข้อมูลการลา</th>
                                            </tr>
                                        <?php
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