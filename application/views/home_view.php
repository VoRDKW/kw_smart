<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <h4 class="page-head-line">งานแจ้งซ่อมบำรุงคอมพิวเตอร์</h4>       
        </div>
        <div class="row">
            <div class="col-md-12">
<!--                <h4 class="page-head-line">รายการการแจ้งซ่อมของฉัน<p style="float:right"><a href="form-input.html" class="btn btn-md btn-danger pull-right hidden">>> แจ้งซ่อม <<</a></p></h4>-->

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-2 col-xs-3">
                            <h5 style="margin-bottom:5px">ค้นหา :</h5>
                        </div>
                        <div class="col-md-10 col-xs-8">
                            <form class="form-horizontal">                   
                                <div class="form-group col-md-3">
                                    <div class="col-sx-11 col-md-11">
                                        <input type="date" class="form-control" name="OpenDate" placeholder="ตั้งแต่วันที่">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col-sx-11 col-md-11">
                                        <div class="col-md-12">
                                            <select name="JobStatusID" class="selecter_3" data-selecter-options='{"cover":"true"}'>
                                                <option>สถานะ</option>
                                                <option value="1">ใหม่</option>
                                                <option value="2">กำลังซ่อม</option>
                                                <option value="3">ซ่อมเสร็จแล้ว</option>
                                                <option value="4">ซ่อมไม่ได้</option>
                                            </select>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <input class="btn btn-default" type="submit" value="ค้นหา">
                                    <input class="btn btn-default" type="reset" value="รีเซ็ต">
                                </div>                                    
                            </form> 
                        </div>
                    </div>
                </div>                    

            </div>
        </div>     
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="panel-title">รายการการแจ้งซ่อมของฉัน</div>
                    </div>                            
                    <table class="table">
                        <thead class="table table-bordered">
                        <th width="15%">รหัสงาน</th>
                        <th width="40%">หัวข้อ</th>
                        <th width="20%">วันที่แจ้งซ่อม</th>
                        <th width="20%">สถานะ</th>
                        <th width="5%"></th>
                        </thead>
                        <tbody>

                            <?php
                            if (count($data_job) == 0) {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="6">- คุณยังไม่มีงานแจ้งซ่อมใดๆ -
                                        <a href="<?= base_url('maintenance/add') ?>" class="btn btn-md btn-danger">
                                            <i class="fa fa-fw fa-ambulance"></i>>> แจ้งซ่อม <<
                                        </a>
                                    </td> 
                                </tr>
                                <?php
                            } else {
                                foreach ($data_job as $job) {                                  
                                    ?>
                                    <tr>
                                        <td><?= $job['JobID'] ?></td>
                                        <td><?= $job['JobName'] ?></td>
                                        <td><?= $job['CreateDate'] ?></td>
                                        <td><?= $job['JobStatusID'] ?></td>
                                        <td><a href="<?= base_url("maintenance/edit/" . $job['JobID']) ?>"><i class="fa fa-pencil"></i></a></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>                     
                </div>
            </div>
        </div>
    </div>
</div>
