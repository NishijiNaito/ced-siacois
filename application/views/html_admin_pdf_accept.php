<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Html Admin Pdf accept -->
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
                        <h5 class="card-title">PDF ตอบรับ</h5>
                        <?php


                        ?>
                        <a name="" id="" class="btn btn-success" href="<?php echo current_url(); ?>/add" role="button">เพิ่ม</a>
                        <hr>

                        <div class="row justify-content-between">
                            <div class="col-sm">
                                <table class="table table-striped table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">สร้างฟอร์ม</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        foreach ($forms as $form) {

                                        ?>

                                            <tr>
                                                <td scope="col"><?php echo $form->form_id; ?></td>
                                                <td scope="col">

                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#form-<?php echo $form->form_id; ?>">
                                                        ดูข้อมูลก่อนออกแบบฟอร์ม
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="form-<?php echo $form->form_id; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="color: black;">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">ข้อมูลก่อนออกแบบฟอร์ม</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">


                                                                    <p>มหาวิทยาลัย : <?php echo $form->UniCol_name; ?></p>
                                                                    <p>คณะ : <?php echo $form->Faculty_id; ?></p>
                                                                    <p>ภาควิชา : <?php echo $form->Department_name; ?></p>
                                                                    <p>อ้างอิง : <?php echo $form->form_ref; ?></p>
                                                                    <p>ประเภทฝึกงาน : <?php echo ($form->form_type == 1 ? 'ประสบการณ์วิชาชีพ' : 'สหกิจศึกษา'); ?></p>
                                                                    <p>วันที่เริ่มต้น : <?php echo $this->uf->DateThai($form->form_start); ?></p>
                                                                    <p>วันที่สิ้นสุด : <?php echo $this->uf->DateThai($form->form_end); ?></p>
                                                                    <p>จำนวน : <?php echo $form->form_amo; ?></p>

                                                                    <form method="post" action="<?php echo current_url(); ?>/form">
                                                                        <input type="hidden" name="id" value="<?php echo $form->form_id; ?>">
                                                                        <button type="submit" class="btn btn-success">สร้างเอกสาร</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>






                                                </td>
                                                <td scope="col"><a name="" id="" class="btn btn-primary" href="<?php echo current_url(); ?>/edit/<?php echo $form->form_id; ?>" role="button">แก้ไขฟอร์ม</a></td>
                                                <td scope="col"><input name="" id="" class="btn btn-danger" type="button" value="ลบ" onclick="del(<?php echo $form->form_id; ?>)"></td>

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