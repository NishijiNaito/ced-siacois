<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Html Admin Index -->
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
                                    <button type="submit" class="btn btn-primary" >Edit Profile</button>

                                </form>
                                <form action="logout" method="POST">
                                    <button type="submit" class="btn btn-primary" >Logout</button>

                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <h5 class="card-title">รายละเอียด</h5>

                        <div class="row">
                            <div class="col-sm-6">
                                <?php

                                $perc = $all / 15 * 100;

                                ?>
                                <p class="card-text">จำนวนนักศึกษาฝึกงานทั้งหมดตอนนี้</p>
                                <p class="card-text"><?php echo $all; ?> จาก 15 คน</p>

                                <div class="progress">
                                    <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $perc; ?>%;" aria-valuenow="<?php echo $perc; ?>" aria-valuemin="0" aria-valuemax="15"></div>
                                </div>
                                &nbsp;

                                <p class="card-text">นักศึกษาฝึกฤดูร้อน : <?php echo $summer; ?> คน</p>


                                <p class="card-text">นักศึกษาฝึกสหกิจศึกษา : <?php echo $coop; ?> คน</p>


                                <p class="card-text">วันถัดไปของนักศึกษาที่จะสิ้นสุดการฝึกงาน</p>
                                <p class="card-text"><?php echo $nextend; ?> </p>
                                <p></p>



                            </div>
                            <div class="col-sm-6">

                                <?php
                                if ($_SESSION['role'] == 'admin') {
                                ?>
                                    <h5 class="card-title">ผู้ดูแลระบบ</h5>
                                    <a href="<?php echo current_url(); ?>/Employee">
                                        <p class="card-text">เพิ่ม / ลบ / แก้ไข เจ้าหน้าที่</p>
                                    </a>
                                    <a href="<?php echo current_url(); ?>/subdata">
                                        <p class="card-text">เพิ่ม / ลบ / แก้ไข รายละเอียดของมหาวิทยาลัยและหลักสูตร</p>
                                    </a>
                                    <a href="<?php echo current_url(); ?>/student">
                                        <p class="card-text">เพิ่ม / ลบ / แก้ไข นักศึกษา</p>
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <h5 class="card-title">เจ้าหน้าที่</h5>
                                    <a href="<?php echo current_url(); ?>/subdata">
                                        <p class="card-text">เพิ่ม / ลบ / แก้ไข รายละเอียดของมหาวิทยาลัยและหลักสูตร</p>
                                    </a>
                                    <a href="<?php echo current_url(); ?>/student">
                                        <p class="card-text">เพิ่ม / ลบ / แก้ไข นักศึกษา</p>
                                    </a>
                                    <a href="<?php echo current_url(); ?>/pdf">
                                        <p class="card-text">ส่งออก PDF</p>
                                    </a>
                                <?php
                                }
                                ?>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>