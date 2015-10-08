<script>
    jQuery(document).ready(function ($) {
        $("#menu-top li").removeAttr('class');
        $("#btnMaintenance").addClass("menu-top-active");
    });
</script>

<div class="container" style="padding-bottom: 8%;padding-top: 1%">
    <div class="row">
        <h4 class="page-head-line">
            <?= $page_title ?>
            <a href="<?= base_url('maintenance/add') ?>" class="btn btn-info btn-lg pull-right" style="margin-top: -10px">
                <i class="fa fa-lg fa-ambulance"></i>&nbsp;แจ้งซ่อมบำรุง
            </a>              
        </h4>
    </div>
    <div class="row">
        <?php
        foreach ($data_job as $job) {
            $JobStatusID = $job['JobStatusID'];
            if ($JobStatusID == 1) {
                $class = "panel-warning";
                $loadicon = '<i class="fa fa-circle-o-notch fa-spin"></i>';
            } elseif ($JobStatusID == 2) {
                $class = "panel-info";
                $loadicon = '<i class="fa fa-spinner fa-pulse"></i>';
            } elseif ($JobStatusID == 3) {
                $class = "panel-success";
                $loadicon = '<i class="fa fa-check"></i>';
            } else {
                $class = "panel-danger";
                $loadicon = '<i class="fa fa-ban"></i>';
            }
            if (count($job) == 0) {
            ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        คุณยังไม่มีงานแจ้งซ่อมใดๆ 
                        <a href="<?= base_url('maintenance/add') ?>" class="btn btn-md btn-danger">
                            >> <i class="fa fa-fw fa-ambulance"></i> แจ้งซ่อม <<
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="panel <?= $class ?>">
                <div class="panel-heading">
                    หัวข้อ :&nbsp; <?= $job['JobName'] ?>
                    <p class="pull-right"><?= $job['JobStatusName'] ?> <?= $loadicon ?></p>
                </div>
                <div class="panel-body">
                    <div class="col-md-6" style="margin-right:2px #ddd">
                        <dl class="dl-horizontal">
                            <dt>หมายเลขงาน :</dt>
                            <dd><?= $job['JobID'] ?></dd>
                            <dt>วันที่แจ้ง :</dt>
                            <dd><?= $job['CreateDate'] ?></dd>
                            <dt>เลขที่ กว. :</dt>
                            <dd><?= $job['NumberKWDevice'] ?></dd>                                              
                            <dt>สถานะงาน :</dt>
                            <dd><?= $job['JobStatusName'] ?></dd>
                            <dt>อาคาร :</dt>
                            <dd><?= $job['BuildingNo'] ?></dd>     
                            <dt>ชั้น :</dt>
                            <dd><?= $job['Floor'] ?></dd>
                            <dt>ห้อง :</dt>
                            <dd><?= $job['RoomNO'] ?></dd>
                            <dt>ปัญหาที่เเจ้ง :</dt>
                            <dd><?= $job['BuildingNo'] ?></dd>                          
                        </dl>
                    </div>
                    <div class="col-md-5">
                        <?php
                        foreach ($job['Images'] as $image) {
                            ?>
                            <img src="<?= base_url('assets/upload/' . $image['ImageThumbPath']) ?>" alt="" class="img-thumbnail" />
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    if ($JobStatusID == 1) {
                        ?>
                        <div class="col-md-1">
                            <a href="<?= base_url("maintenance/edit/" . $job['JobID']) ?>" class="btn btn-warning pull-right">
                                <i class="fa fa-edit"></i>&nbsp;แก้ไข
                            </a>                      
                        </div>
                        <?php
                    }
                    ?>                    
                </div>
            </div>
        <?php } ?>
    </div>


</div>

