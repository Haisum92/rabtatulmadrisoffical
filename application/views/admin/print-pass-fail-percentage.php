<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->

             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $percentage_response['exam_name'];?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <?php echo $title;?>
                            </div>
                            <div class="panel-body">

                                <?php echo validation_errors();?>
                                <?php if ($this->session->flashdata('success') != ""){?>
                                    <div class="alert alert-success">
                                        <?php echo $this->session->flashdata('success');?>
                                    </div>
                                <?php }?>
                                <?php if ($this->session->flashdata('failure') != ""){?>
                                    <div class="alert alert-danger">
                                        <?php echo $this->session->flashdata('failure');?>
                                    </div>
                                <?php }?>

                                    <div class="row">

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>(طلبہ/طالبات کی تعداد): </label>
                                                <?php echo $percentage_response['total_no_students'];?>
                                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                                            </div><!-- end group for class name -->

                                        </div>

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>(کامیاب طلبہ/طالبات کا تناسب): </label>
                                                <?php echo $percentage_response['passed_student_percentage'].'%';?>
                                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                                            </div><!-- end group for class name -->

                                        </div>
                                       
                                    </div><!-- /.row (nested) -->

                                    <div class="row">

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>(ناکام طلبہ/طالبات کا تناسب ): </label>
                                                <?php echo $percentage_response['failed_student_percentage'].'%';?>
                                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                                            </div><!-- end group for class name -->

                                        </div>
                                       
                                    </div><!-- /.row (nested) -->

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
<?php $this->load->view('admin/footer');?>