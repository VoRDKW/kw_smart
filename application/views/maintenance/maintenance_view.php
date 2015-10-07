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
            <a href="<?= base_url('maintenance/add') ?>" class="btn btn-info btn-lg pull-right">
                <i class="fa fa-lg fa-ambulance"></i>&nbsp;แจ้งซ่อมบำรุง
            </a>              
        </h4>
    </div>
    <div class="row">
        <?php
        foreach ($data_job as $job) {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= $job['JobName'] ?>
                </div>
                <div class="panel-body">


                    <div class="col-md-12">
                        <a href="<?= base_url("maintenance/edit/" . $job['JobID']) ?>" class="btn btn-warning">
                            <i class="fa fa-edit"></i>&nbsp;แก้ไข
                        </a>
                        &nbsp;
                        <a href="<?= base_url("maintenance/edit/" . $job['JobID']) ?>" class="btn btn-danger">
                            <i class="fa fa-trash"></i>&nbsp;ยกเลิก
                        </a>
                    </div>

                </div>
            </div>
        <?php } ?>
    </div>


</div>

