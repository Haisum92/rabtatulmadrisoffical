<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->

             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">امتحانی نرکز کی تفصیل</h1>
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
                            <?php //echo '<pre>';print_r($examination_center_info);echo '</pre>';die();?>
                            <div class="panel-body">

                                    <div class="row">

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                               <label>Examination Center Name Urdu (امتحانی مرکز کا نام اردو میں): </label>
                                                	<?php echo $examination_center_info[0]['exam_center_name_urdu'];?>
                                            </div><!-- end group for examinatio center name -->

                                            <div class="form-group">
                                                <label>Province (صوبہ):</label>
                                                <?php echo $examination_center_info[0]['prov_name_urdu'];?>
                                            </div><!-- end group for father name no -->                                            

                                            <div class="form-group">
                                                <label>Examination Center Address (امتحانی مرکز کا پتہ):</label>
                                                <?php echo $examination_center_info[0]['exam_center_address'];?>
                                            </div><!-- end group for dob_urdu -->
                                            
                                        </div><!-- .col-lg-6 -->

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Examination Center Name English (امتحانی مرکز کا نام انگریزی میں):</label>
                                                <?php echo $examination_center_info[0]['exam_center_name_eng'];?>
                                            </div><!-- end group for class_name  no -->
                                            
                                            <div class="form-group">
                                                <label>City (شہر): </label>
                                                <?php echo $examination_center_info[0]['district_name_urdu'];?>
                                            </div><!-- end group for reg_no -->                        

                                        </div><!-- .col-lg-6 -->

                                    </div><!-- /.row (nested) -->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="button" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url()?>admin/viewAllExaminationCenters'"> Back</button>
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