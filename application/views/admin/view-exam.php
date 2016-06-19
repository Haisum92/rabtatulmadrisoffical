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
                                                <label>Name (امتحا ن کا نام):</label>
                                                	<?php echo $exam_info[0]['exam_name'];?>
                                            </div><!-- end group for examinatio center name -->

                                            <div class="form-group">
                                                <label>Exam Year Dominic (سال عیسوی میں):</label>
                                                <?php echo $exam_info[0]['exam_year_dominic'];?>
                                            </div><!-- end group for father name no -->                                            

                                            <div class="form-group">
                                                <label>Exam Result Date Hijri (تاریخ اعلان النتیجۃ ہجری میں):</label>
                                                <?php echo $exam_info[0]['exam_result_date_hijri'];?>
                                            </div><!-- end group for dob_urdu -->

                                            <div class="form-group">
                                                <label>Exam Degree Date Dominic (تاریخ اصدارالشھادۃ عیسوی میں):</label>
                                                <?php echo $exam_info[0]['exam_degree_date_dominic'];?>
                                            </div><!-- end group for address -->

                                            
                                        </div><!-- .col-lg-6 -->

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Exam Class (کلاس):</label>
                                                <?php echo $exam_info[0]['class_name_urdu'];?>
                                            </div><!-- end group for class_name  no -->
                                            
                                            <div class="form-group">
                                                <label>Exam Type:</label>
                                                <?php echo $exam_info[0]['exam_type_name_urdu'];?>
                                            </div><!-- end group for reg_no -->                        

                                            <div class="form-group">
                                                <label>Exam Result Date Dominic (تاریخ اعلان النتیجۃ عیسوی میں):</label>
                                                <?php echo $exam_info[0]['exam_result_date_dominic'];?>
                                            </div><!-- end group for dob_eng  -->

                                           <div class="form-group">
                                                <label>Exam Degree Date Hijri (تاریخ اصدارالشھادۃ ہجری میں):</label>
                                                <?php echo $exam_info[0]['exam_degree_date_hijri'];?>
                                            </div><!-- end profile image -->

                                            <!-- <div class="form-group">
                                                <label>Registeration No of Institute (جامع/مدرسہ کا رجسٹریشن نمبر):</label>
                                                <?php //echo $exam_info[0]['std_institute_reg_no'];?>
                                            </div>-->
                                            <!-- end group for old_institute_reg_no --> 

                                        </div><!-- .col-lg-6 -->

                                    </div><!-- /.row (nested) -->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="button" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url()?>admin/viewAllExams'"> Back</button>
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