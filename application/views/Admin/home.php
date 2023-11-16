<div id="page-wrapper">
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= $title ?><small></small>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>
                                Bem-vindo ao Sistema! <?= $this->session->userdata("user_logged")->nome ?>
                            </h2>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
