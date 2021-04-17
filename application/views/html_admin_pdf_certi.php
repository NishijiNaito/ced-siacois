<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Html Admin Pdf Certi -->
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
                        <h5 class="card-title">PDF ออกใบรับรอง</h5>
                        <hr>
                        

                        <div class="row justify-content-between">
                            <div class="col-sm">
                                <table class="table table-striped table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">รหัสนักศึกษา</th>
                                            <th scope="col">ชื่อ-นามสกุล</th>
                                            <th scope="col">สถานะฝึกงาน</th>
                                            <th scope="col">ออกใบรับรอง</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($forms as $form) {
                                            echo "<tr>";
                                            echo "<td scope=\"row\">".$form->student_id."</td>";
                                            echo "<td>".$form->student_FName." ".$form->student_LName."</td>";

                                        ?>
                                            <td><?php echo ($form->student_type == 1 ? 'ฤดูร้อน' : 'สหกิจศึกษา');
                                                if ($form->dd >= 0) {
                                                    echo " เหลือเวลาฝึกงานอีก $form->dd วัน";
                                                } else {
                                                    echo " ฝึกงานผ่านไปแล้ว " . (-$form->dd) . " วัน";
                                                }   ?></td>



                                            <td>


                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#model<?php echo $form->student_id; ?>">
                                                    ออกใบรับรอง
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="model<?php echo $form->student_id; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="color: black;">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" style="color: black;">ออกใบรับรอง</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <?php echo "$form->student_FNS $form->student_FName $form->student_LName"; ?>
                                                                <hr>





                                                                <form method="post" action="<?php echo base_url(); ?>adminpdf/certi">
                                                                    <input type="hidden" name="id" value="<?php echo $form->student_id; ?>">
                                                                    <input type="hidden" name="dstart" value="<?php echo $form->student_Start; ?>">
                                                                    <div class="form-group">
                                                                        <label for="side">ฝึกงานในด้าน</label>
                                                                        <input type="text" class="form-control" name="side" id="side" aria-describedby="helpside" placeholder="ด้าน (จำเป็น)" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="topic">โดยมีหัวข้อวิจัยเรื่อง</label>
                                                                        <input type="text" class="form-control" name="topic" id="topic" aria-describedby="helpside" placeholder="หัวข้อวิจัย (ใส่หรือไม่ก็ได้)">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-success">สร้าง</button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>



                                            </td>


                                        <?php
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