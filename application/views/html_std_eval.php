<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Html Admin Eval   -->

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
                        <h5 class="card-title">การประเมินการฝึกงาน</h5>
                        <form name="editor" action="<?php echo current_url(); ?>/add" method="post">
                            <button type="submit" class="btn btn-success">บันทึก</button>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date">วันที่ประเมิน</label>
                                        <input type="date" class="form-control" name="date" id="date" value="<?php echo date("Y-m-d"); ?>" aria-describedby="hds" placeholder="วันที่สิ้นสุด" readonly>

                                    </div>

                                    <div class="form-group">
                                        <label for="address">ที่อยู่</label>
                                        <textarea id="address" class="form-control" name="address" rows="5" style="resize: none;"></textarea>
                                    </div>


                                    <div class="form-group">
                                        <label for="section">แผนกงานที่ฝึก</label>
                                        <select id="section" class="form-control" name="section">
                                            <option value="1">งานบริหารและธุรการ</option>
                                            <option value="2">งานวิเคราะห์/ทดสอบ</option>
                                            <option value="3">งานสารสนเทศ</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="year">ช่วงการฝึกงาน ปีการศึกษา (พ.ศ.)</label>
                                        <input type="number" class="form-control" name="year" id="year" value="<?php echo date("Y") + 543; ?>" aria-describedby="hds" placeholder="วันที่สิ้นสุด" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="range">ช่วงการฝึกงาน</label>
                                        <select id="range" class="form-control" name="range">
                                            <option value="1">ช่วงปิดภาคการศึกษา</option>
                                            <option value="2">ช่วงระหว่างภาคการศึกษาที่ 1</option>
                                            <option value="3">ช่วงระหว่างภาคการศึกษาที่ 2</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>1. การให้ความสำคัญ/การดูแลเอาใจใส่นักศึกษาฝึกงาน</h5>

                                        <label class="radio-inline">
                                            <input type="radio" name="Q01" value="5" required> มากที่สุด
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q01" value="4" required> มาก
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q01" value="3" required> ปานกลาง
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q01" value="2" required> น้อย
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q01" value="1" required> น้อยที่สุด
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <h5>2. การสอนงาน การมอบหมายงาน </h5>

                                        <label class="radio-inline">
                                            <input type="radio" name="Q02" value="5" required> มากที่สุด
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q02" value="4" required> มาก
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q02" value="3" required> ปานกลาง
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q02" value="2" required> น้อย
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q02" value="1" required> น้อยที่สุด
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <h5>3. งานที่ฝึกตรงกับสาขาที่เรียน </h5>

                                        <label class="radio-inline">
                                            <input type="radio" name="Q03" value="5" required> มากที่สุด
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q03" value="4" required> มาก
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q03" value="3" required> ปานกลาง
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q03" value="2" required> น้อย
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q03" value="1" required> น้อยที่สุด
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <h5>4. งานที่ฝึกได้รับความรู้และประสบการณ์เพิ่มเติม </h5>

                                        <label class="radio-inline">
                                            <input type="radio" name="Q04" value="5" required> มากที่สุด
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q04" value="4" required> มาก
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q04" value="3" required> ปานกลาง
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q04" value="2" required> น้อย
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q04" value="1" required> น้อยที่สุด
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <h5>5. การให้คำแนะนำระหว่างปฏิบัติงาน </h5>

                                        <label class="radio-inline">
                                            <input type="radio" name="Q05" value="5" required> มากที่สุด
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q05" value="4" required> มาก
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q05" value="3" required> ปานกลาง
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q05" value="2" required> น้อย
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q05" value="1" required> น้อยที่สุด
                                        </label>
                                    </div>



                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>6. การมีอัธยาศัยไมตรีของผู้ร่วมงาน </h5>

                                        <label class="radio-inline">
                                            <input type="radio" name="Q06" value="5" required> มากที่สุด
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q06" value="4" required> มาก
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q06" value="3" required> ปานกลาง
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q06" value="2" required> น้อย
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q06" value="1" required> น้อยที่สุด
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <h5>7. ความเหมาะสมและสภาพแวดล้อมของการปฏิบัติงาน </h5>

                                        <label class="radio-inline">
                                            <input type="radio" name="Q07" value="5" required> มากที่สุด
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q07" value="4" required> มาก
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q07" value="3" required> ปานกลาง
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q07" value="2" required> น้อย
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q07" value="1" required> น้อยที่สุด
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <h5>8. สวัสดิภาพและความปลอดภัยในการปฏิบัติงาน </h5>

                                        <label class="radio-inline">
                                            <input type="radio" name="Q08" value="5" required> มากที่สุด
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q08" value="4" required> มาก
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q08" value="3" required> ปานกลาง
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q08" value="2" required> น้อย
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q08" value="1" required> น้อยที่สุด
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <h5>9. ความพึงพอใจโดยรวมต่อการฝึกงาน </h5>

                                        <label class="radio-inline">
                                            <input type="radio" name="Q09" value="5" required> มากที่สุด
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q09" value="4" required> มาก
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q09" value="3" required> ปานกลาง
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q09" value="2" required> น้อย
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Q09" value="1" required> น้อยที่สุด
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label for="QCom">ข้อเสนอแนะเพิ่มเติม</label>
                                        <textarea id="QCom" class="form-control" name="QCom" rows="5" style="resize: none;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>





                    </div>
                </div>
            </div>

        </div>
    </div>

</div>