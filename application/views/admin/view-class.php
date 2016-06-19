<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->

             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">ثا نویہ عامہ کے نئے طالب علم کا داخلہ فارم</h1>
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
                            <?php //echo '<pre>';print_r($exam_info);echo '</pre>';die();?>
                            <div class="panel-body">

                                    <div class="row">

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Name (کلاس کا نام):</label>
                                                	<?php echo $class_info[0]['class_name_urdu'];?>
                                            </div><!-- end group for examinatio center name -->

                                            <div class="form-group">
                                                <label>Class Type :</label>
                                                <?php echo $class_info[0]['class_type'];?>
                                            </div><!-- end group for father name no -->                                            
                                            
                                        </div><!-- .col-lg-6 -->

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Class Name Eng :</label>
                                                <?php echo $class_info[0]['class_name_eng'];?>
                                            </div><!-- end group for class_name  no -->

                                        </div><!-- .col-lg-6 -->

                                    </div><!-- /.row (nested) -->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url()?>admin/viewAllExams'"> Back</button>
                                        </div>
                                    </div><!-- /.row (nested) -->

                                </form><!-- end form -->

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