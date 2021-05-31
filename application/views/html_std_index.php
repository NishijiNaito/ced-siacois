<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Html Admin Index   -->
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


                                $perc = ($date->dateall - $date->dateremain) / $date->dateall * 100;

                                ?>

                                <p class="card-text">จำนวนเวลาฝึกงานทั้งหมดตอนนี้</p>
                                <p class="card-text"><?php echo $date->dateall - $date->dateremain; ?> จาก <?php echo $date->dateall; ?> วัน</p>

                                <div class="progress">
                                    <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $perc; ?>%;" aria-valuenow="<?php echo $perc; ?>" aria-valuemin="0" aria-valuemax="15"></div>
                                </div>
                                &nbsp;


                            </div>
                            <div class="col-sm-6">

                                <h5 class="card-title text-center">นักศึกษา</h5>
                                <a href="<?php echo current_url(); ?>/leaverequest">
                                    <div class="row justify-content-center">
                                        <span style="font-size: 48px; color: Dodgerblue;">
                                            <i class="fa fa-sticky-note" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <p class="card-text text-center">ข้อมูลการลา/การออกใบลา</p>
                                </a>
                                <?php if ($date->dateremain <= 10 && $eval) { ?>
                                    <a href="<?php echo current_url(); ?>/evaluate">
                                        <div class="row justify-content-center">
                                            <span style="font-size: 48px; color: Dodgerblue;">
                                                <i class="fa fa-tasks" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <p class="card-text text-center">ประเมินการฝึกงาน</p>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>





                    </div>
                </div>
            </div>

        </div>

    </div>
</div>