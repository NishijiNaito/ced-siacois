<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Html Admin Std -->
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
                        <h5 class="card-title">ส่งออก PDF</h5>

                        <div class="row justify-content-between">
                            <div class="col-sm">
                                <a href="<?php echo current_url(); ?>/accept">
                                    <p class="card-text">PDF ตอบรับ</p>
                                </a>
                                <a href="<?php echo current_url(); ?>/returning">
                                    <p class="card-text">PDF ส่งตัวกลับ</p>
                                </a>
                                <a href="<?php echo current_url(); ?>/certi">
                                    <p class="card-text">PDF ออกใบรับรอง</p>
                                </a>
                                <a href="<?php echo current_url(); ?>/summary">
                                    <p class="card-text">PDF สรุปยอด</p>
                                </a>
                                <!--  <a href="certificate"><p class="card-text">PDF เกียรติบัตร</p></a>
                  <a href="stats"><p class="card-text">PDF สถิติประจำปี</p></a>
                -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>