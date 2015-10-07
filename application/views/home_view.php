<div class="content-wrapper">
<<<<<<< HEAD
    <div class="container">
        <div class="row">
            <h4 class="page-head-line">งานแจ้งซ่อมบำรุงคอมพิวเตอร์</h4>
            <div>
                <?php 
                foreach ($data_job as $job) {
=======
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">รายการการแจ้งซ่อมของฉัน<p style="float:right"><a href="<?= base_url('maintenance')?>" class="btn btn-md btn-danger pull-right">>> แจ้งซ่อม <<</a></p></h4>
>>>>>>> origin/master
                    
                }
                ?>
                
            </div>
        </div>
        <div class="row" hidden="">
            <div class="col-md-12">
                <h4 class="page-head-line">รายการการแจ้งซ่อมของฉัน<p style="float:right"><a href="form-input.html" class="btn btn-md btn-danger pull-right hidden">>> แจ้งซ่อม <<</a></p></h4>

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

                <table class="table table-bordered">
                    <thead class="table table-bordered">
                    <th class="center" width="5%">ลำดับ</th>
                    <th class="center" width="20%">รหัสงาน</th>
                    <th class="center" width="30%">หัวข้อ</th>
                    <th class="center" width="20%">วันที่แจ้งซ่อม</th>
                    <th class="center" width="20%">สถานะ</th>
                    <th class="center" width="5%"></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="6">- คุณยังไม่มีงานแจ้งซ่อมใดๆ -</td> 
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>            
    </div>
</div>
