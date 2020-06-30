<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Html Admin Std -->
<div class="row justify-content-center">
    <div class="col-md-11">

        <div class="row">
            <div class="col-sm">
                <div class="card">
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


                        <div id="subdata" role="tablist" aria-multiselectable="true">
                            <div class="card">
                                <div class="card-header" role="tab" id="subUni">

                                    <h5 class="mb-0">

                                        <a data-toggle="collapse" data-parent="#subdata" href="#subUniDat" aria-expanded="true" aria-controls="subUniDat">
                                            มหาวิทยาลัย
                                        </a>

                                        <!-- Toggle Modal -->

                                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modUni"> <i class="fa fa-plus" aria-hidden="true"></i> เพิ่ม</button>
                                        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modUniE">แก้ไข</button>

                                    </h5>

                                    <!-- Modal Add -->
                                    <div id="modUni" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

                                        <div class="modal-dialog modal-dialog-centered" role="document">

                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มมหาวิทยาลัย / วิทยาลัย</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <!-- Form -->
                                                    <form method="post" action="<?php echo base_url(); ?>adminconsole/subdata/add">
                                                        <input type="hidden" name="type" value="1">

                                                        <div class="form-group">
                                                            <label for="uctype">ประเภท</label>
                                                            <select id="uctype" class="custom-select" name="uctype" required>
                                                                <option value="col">วิทยาลัย</option>
                                                                <option value="uni">มหาวิทยาลัย</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="Uni">ชื่อ</label>
                                                            <input type="text" name="fo01" id="Uni" class="form-control" placeholder="มหาวิทยาลัย" aria-describedby="helpUni" required>
                                                            <small id="helpUni" class="text-muted">ไม่ต้องใส่คำว่า "มหาวิทยาลัย / วิทยาลัย"</small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="formtype">รูปแบบฟอร์ม</label>
                                                            <select id="formtype" class="custom-select" name="fotype" required>
                                                                <option value="in">ภายใน</option>
                                                                <option value="out">ภายนอก</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-success">เพิ่ม</button>
                                                    </form>
                                                    <!-- End Form -->
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- End Modal -->

                                    <!-- Modal Edit -->

                                    <div id="modUniE" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขรายละเอียด</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <form method="post" action="<?php echo base_url(); ?>adminconsole/subdata/edit">
                                                        <input type="hidden" name="type" id="iutype" value="1">


                                                        <div class="form-group">

                                                            <label for="iuid">ชื่อมหาวิทยาลัย / วิทยาลัยเดิม</label>
                                                            <select class="form-control" name="ucfdid" id="iuid" onchange="changeunidata()">
                                                                <?php
                                                                foreach ($unicols as $unicol) {


                                                                    echo "<option value=\"";
                                                                    echo $unicol->UniCol_id;
                                                                    echo "\">";
                                                                    echo $unicol->UniCol_name;
                                                                    echo "</option>";
                                                                }

                                                                ?>

                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="fo01">แก้ไขเป็น</label>
                                                            <input type="text" class="form-control" name="fo01" id="fo01" aria-describedby="helpId" placeholder="ชื่อใหม่" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="iuctype">ประเภท</label>
                                                            <select id="iuctype" class="custom-select" name="uctype" required>
                                                                <option value="col">วิทยาลัย</option>
                                                                <option value="uni">มหาวิทยาลัย</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="formtype">รูปแบบฟอร์ม</label>
                                                            <select id="Eformtype" class="custom-select" name="fotype" required>
                                                                <option value="in">ภายใน</option>
                                                                <option value="out">ภายนอก</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-success">แก้ไข</button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Edit -->




                                </div>
                                <div id="subUniDat" class="collapse in" role="tabpanel" aria-labelledby="subUni">
                                    <div class="card-body">




                                        <!-- <div id="text" onClick="test();"> your text here </div> -->

                                        <?php


                                        foreach ($unicols as $unicol) {
                                            echo "<div id=\"Uni";
                                            echo $unicol->UniCol_id;
                                            echo "\" onClick=\"del(1,";
                                            echo $unicol->UniCol_id;
                                            echo ",'";
                                            echo $unicol->UniCol_name;
                                            echo "','";
                                            echo  $unicol->UniCol_type;
                                            echo"');\">";
                                            echo $unicol->UniCol_name;
                                            echo "</div>";
                                        }


                                        ?>




                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="subFac">
                                    <h5 class="mb-0">



                                        <a data-toggle="collapse" data-parent="#subdata" href="#subFacDat" aria-expanded="true" aria-controls="subFacDat">
                                            คณะ
                                        </a>

                                        <!-- Toggle Modal -->

                                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modFac"> <i class="fa fa-plus" aria-hidden="true"></i> เพิ่ม</button>

                                        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modFacE">แก้ไข</button>


                                    </h5>


                                    <!-- Modal -->
                                    <div id="modFac" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

                                        <div class="modal-dialog modal-dialog-centered" role="document">

                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มคณะ</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <!-- Form -->
                                                    <form method="post" action="<?php echo base_url(); ?>adminconsole/subdata/add">
                                                        <input type="hidden" name="type" value="2">
                                                        <div class="form-group">
                                                            <label for="Uni">คณะ</label>
                                                            <input type="text" name="fo01" id="Uni" class="form-control" placeholder="คณะ" aria-describedby="helpUni" required>
                                                            <small id="helpUni" class="text-muted">ไม่ต้องใส่คำว่า "คณะ"</small>
                                                        </div>

                                                        <button type="submit" class="btn btn-success">เพิ่ม</button>
                                                    </form>
                                                    <!-- End Form -->
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- End Modal -->


                                    <!-- Modal Edit -->

                                    <div id="modFacE" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขคณะ</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <form method="post" action="<?php echo base_url(); ?>adminconsole/subdata/edit">
                                                        <input type="hidden" name="type" value="2">
                                                        <div class="form-group">

                                                            <label for="uid">ชื่อคณะเดิม</label>
                                                            <select class="form-control" name="uid" id="uid">
                                                                <?php

                                                                foreach ($facs as $fac) {


                                                                    echo "<option value=\"";
                                                                    echo $fac->Faculty_id;
                                                                    echo "\">";
                                                                    echo $fac->Faculty_name;
                                                                    echo "</option>";
                                                                }

                                                                ?>

                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="fo01">แก้ไขเป็น</label>
                                                            <input type="text" class="form-control" name="fo01" id="fo01" aria-describedby="helpId" placeholder="ชื่อใหม่" required>
                                                        </div>

                                                        <button type="submit" class="btn btn-success">แก้ไข</button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Edit -->







                                </div>
                                <div id="subFacDat" class="collapse in" role="tabpanel" aria-labelledby="subFac">
                                    <div class="card-body">





                                        <?php

                                        foreach ($facs as $fac) {
                                            echo "<div id=\"Fac";
                                            echo $fac->Faculty_id;
                                            echo "\" onClick=\"del(2,";
                                            echo $fac->Faculty_id;
                                            echo ",'";
                                            echo $fac->Faculty_name;

                                            echo "','none";
                                            
                                            echo"');\">";
                                            echo $fac->Faculty_name;

                                            echo "</div>";
                                        }


                                        ?>








                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="subDep">
                                    <h5 class="mb-0">


                                        <a data-toggle="collapse" data-parent="#subdata" href="#subDepDat" aria-expanded="true" aria-controls="subDepDat">
                                            ภาควิชา
                                        </a>

                                        <!-- Toggle Modal -->

                                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modDep"> <i class="fa fa-plus" aria-hidden="true"></i> เพิ่ม</button>

                                        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modDepE">แก้ไข</button>



                                    </h5>

                                    <!-- Modal -->
                                    <div id="modDep" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

                                        <div class="modal-dialog modal-dialog-centered" role="document">

                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มภาควิชา</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <!-- Form -->
                                                    <form method="post" action="<?php echo base_url(); ?>adminconsole/subdata/add">
                                                        <input type="hidden" name="type" value="3">
                                                        <div class="form-group">
                                                            <label for="Uni">ภาควิชา</label>
                                                            <input type="text" name="fo01" id="Uni" class="form-control" placeholder="ภาควิชา" aria-describedby="helpUni" required>
                                                            <small id="helpUni" class="text-muted">ไม่ต้องใส่คำว่า "ภาควิชา"</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="dtype">ประเภท</label>
                                                            <select id="dtype" class="custom-select" name="dtype" required>
                                                                <option value="col">วิทยาลัย</option>
                                                                <option value="uni">มหาวิทยาลัย</option>
                                                            </select>
                                                        </div>

                                                        <button type="submit" class="btn btn-success">เพิ่ม</button>
                                                    </form>
                                                    <!-- End Form -->
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- End Modal -->

                                    <!-- Modal Edit -->

                                    <div id="modDepE" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขภาควิชา</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <form method="post" action="<?php echo base_url(); ?>adminconsole/subdata/edit">
                                                        <input type="hidden" id = "idtype" name="type" value="3">
                                                        <div class="form-group">

                                                            <label for="idid">ชื่อภาควิชาเดิม</label>
                                                            <select class="form-control" name="ucfdid" id="idid" onchange="changedepdata()">
                                                                <?php

                                                                foreach ($deps as $dep) {




                                                                    echo "<option value=\"";
                                                                    echo $dep->Department_id;
                                                                    echo "\">";
                                                                    echo $dep->Department_name;
                                                                    echo "</option>";
                                                                }

                                                                ?>

                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="fo01">แก้ไขเป็น</label>
                                                            <input type="text" class="form-control" name="fo01" id="fo01" aria-describedby="helpId" placeholder="ชื่อใหม่" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="idetype">ประเภท</label>
                                                            <select id="idetype" class="custom-select" name="dtype" required>
                                                                <option value="col">วิทยาลัย</option>
                                                                <option value="uni">มหาวิทยาลัย</option>
                                                            </select>
                                                        </div>

                                                        <button type="submit" class="btn btn-success">แก้ไข</button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Edit -->









                                </div>
                                <div id="subDepDat" class="collapse in" role="tabpanel" aria-labelledby="subDep">
                                    <div class="card-body">





                                        <?php

                                        foreach ($deps as $dep) {

                                            echo "<div id=\"Dep";
                                            echo $dep->Department_id;
                                            echo "\" onClick=\"del(3,";
                                            echo $dep->Department_id;
                                            echo ",'";
                                            echo $dep->Department_name;
                                            echo "','none";
                                            
                                            echo"');\">";
                                            echo $dep->Department_name;
                                            echo "</div>";
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

    </div>
</div>