<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->

             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">طالب علم کا ریکاڈ</h1>
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
                            <?php //echo '<pre>';print_r($student_info);echo '</pre>';die();?>
                            <div class="panel-body">

                                    <div class="row">

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Name (طالب علم کا نام):</label>
                                                	<?php echo $student_info[0]['std_name'];?>
                                            </div><!-- end group for examinatio center name -->


                                            <div class="form-group">
                                                <label>Identity Card No (شنا ختی کا رڈ نمبر):</label>
                                                <?php echo $student_info[0]['std_id_card_no'];?>
                                            </div><!-- end group for reg_no -->                        

                                            <div class="form-group">
                                                <label>Date of Birth Urdu (حروف میں):</label>
                                                <?php echo $student_info[0]['std_dob_urdu'];?>
                                            </div><!-- end group for father name no -->                                            

                                            <div class="form-group">
                                                <label>Examination center (امتحانی مرکز):</label>
                                                <?php echo $student_info[0]['exam_center_name_urdu'];?>
                                            </div><!-- end group for dob_eng  -->

                                            <div class="form-group">
                                                <label>Roll No (رول نمبر):</label>
                                                <?php echo $student_info[0]['std_roll_no'];?>
                                            </div><!-- end group for dob_urdu -->

                                            <div class="form-group">
                                                <label>Address (مستقل پتہ):</label>
                                                <?php echo $student_info[0]['std_address'];?>
                                            </div><!-- end group for address -->

                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <img src="<?php echo base_url();?>student_images/<?php echo $student_info[0]['std_image'];?>" alt="Student Image" width="100" height="100" />
                                            </div><!-- end profile image -->
                                            
                                        </div><!-- .col-lg-6 -->

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Father Name (والد کا نا م):</label>
                                                <?php echo $student_info[0]['std_father_name'];?>
                                            </div><!-- end group for class_name  no -->

                                            <div class="form-group">
                                                <label>Date of Birth English (تاریخ پیدا ئش ہندسوں میں):</label>
                                                <?php echo $student_info[0]['std_dob_eng'];?>
                                            </div><!-- end group for roll no -->

                                            <div class="form-group">
                                                <label>Class Name (کلاس کا نام):</label>
                                                <?php echo $student_info[0]['class_name_urdu'];?>
                                            </div><!-- end group for identity card -->

                                            <div class="form-group">
                                                <label>Registeration No (رجسٹریشن نمبر):</label>
                                                <?php echo $student_info[0]['std_reg_no'];?>
                                            </div><!-- end group for dob_urdu -->

                                            <div class="form-group">
                                                <label>Registeration No of Institute (جامع/مدرسہ کا رجسٹریشن نمبر):</label>
                                                <?php echo $student_info[0]['std_institute_reg_no'];?>
                                            </div><!-- end group for old_institute_reg_no -->

                                        </div><!-- .col-lg-6 -->

                                    </div><!-- /.row (nested) -->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url()?>admin/viewAllStudents'"> Back</button>
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