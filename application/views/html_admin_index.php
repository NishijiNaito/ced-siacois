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
                                    <button type="submit" class="btn btn-primary">Edit Profile</button>

                                </form>
                                <form action="logout" method="POST">
                                    <button type="submit" class="btn btn-primary">Logout</button>

                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">


                        <div class="row">
                            <div class="col-sm-6">
                                <h5 class="card-title text-center">รายละเอียด</h5>
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
                                    <h5 class="card-title text-center">ผู้ดูแลระบบ</h5>
                                    <a href="<?php echo current_url(); ?>/Employee">
                                        <div class="row justify-content-center">
                                            <span style="font-size: 48px; color: Dodgerblue;">
                                                <i class="fa fa-users-cog" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <p class="card-text text-center">เพิ่ม / ลบ / แก้ไข เจ้าหน้าที่</p>
                                    </a>
                                    <a href="<?php echo current_url(); ?>/subdata">
                                        <div class="row justify-content-center">
                                            <span style="font-size: 48px; color: Dodgerblue;">
                                                <i class="fa fa-school" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <p class="card-text text-center">เพิ่ม / ลบ / แก้ไข รายละเอียดของมหาวิทยาลัยและหลักสูตร</p>
                                    </a>
                                    <a href="<?php echo current_url(); ?>/student">
                                        <div class="row justify-content-center">
                                            <span style="font-size: 48px; color: Dodgerblue;">
                                                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <p class="card-text text-center">เพิ่ม / ลบ / แก้ไข นักศึกษา</p>
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <h5 class="card-title text-center">เจ้าหน้าที่</h5>
                                    <a href="<?php echo current_url(); ?>/subdata">
                                        <div class="row justify-content-center">
                                            <span style="font-size: 48px; color: Dodgerblue;">
                                                <i class="fa fa-school" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <p class="card-text text-center">เพิ่ม / ลบ / แก้ไข รายละเอียดของมหาวิทยาลัยและหลักสูตร</p>
                                    </a>

                                    <a href="<?php echo current_url(); ?>/student">
                                        <div class="row justify-content-center">
                                            <span style="font-size: 48px; color: Dodgerblue;">
                                                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <p class="card-text text-center">เพิ่ม / ลบ / แก้ไข นักศึกษา</p>
                                    </a>
                                    <a href="<?php echo current_url(); ?>/pdf">
                                        <div class="row justify-content-center">
                                            <span style="font-size: 48px; color: Dodgerblue;">
                                                <i class="fa fa-file-pdf" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <p class="card-text text-center">ส่งออก PDF</p>
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