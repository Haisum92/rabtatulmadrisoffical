<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->
             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">موجودہ طالب علم کا داخلہ فارم</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <?php echo $title;?>
                                <?php /*echo '<pre>';print_r($student_info);echo '</pre>';*/?>
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
    						    <?php
    							$attribute = array('class' => 'web_form','id' => 'manage-old-student-form', 
                                                   'name' => 'manage-old-student-form', 'role' => 'form'
                                                 );
        						echo form_open_multipart('admin/manageOldStudentForm/'.$exam_info[0]['exam_info_id'],$attribute);?>
                                    
                                    <div class="row">

                                        <div class="col-md-12">

                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label>Please select examination center (امتحانی مرکز کا انتخاب کریں)</label>
                                                    <select class="form-control" name="exam_center" id="exam_center">
                                                    	<?php if($examination_center_info != ""){
                                                    		foreach ($examination_center_info as $key => $examcenter) {?>
                                                    			<option value="<?php echo $examcenter['eci_id'];?>"><?php echo $examcenter['exam_center_name_urdu'];?></option>
                                                    		<?php }
                                                    	}?>
                                                    </select>
                                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                                </div><!-- end group for examinatio center name -->

                                            </div>

                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                
                                                    <label>Class Name (کلاس کا نام)</label>
                                                    <input type="text" name="class_name" readonly="readonly" id="class_name" class="form-control" placeholder="رکلاس کا نام" value="<?php echo $student_record['student_info'][0]['class_name_urdu'];?>" autocomplete="off" >
                                                    <input type="hidden" name="class_id" id="class_id" class="form-control" placeholder="رکلاس کا نام" value="<?php echo $student_record['student_info'][0]['class_id'];?>" editable="false" >
                                                   <!--  <input type="hidden" name="exam_id" id="exam_id" class="form-control" placeholder="رکلاس کا نام" value="<?php echo $class_exam_info[0]['exam_info_id'];?>" editable="false" > -->
                                                
                                                </div><!-- end group for class_name  no -->

                                            </div>

                                        </div><!-- /.col-md-12-->

                                        <div class="col-md-12">

                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label>Registeration No (رجسٹریشن نمبر)</label>
                                                    <input type="text" readonly="readonly" name="reg_no" id="reg_no" class="form-control" placeholder="رجسٹریشن نمبر" value="<?php echo $student_record['student_info'][0]['std_reg_no'];?>" autocomplete="off" >
                                                </div><!-- end group for reg_no -->

                                            </div>

                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label>Roll No (ر و ل نمبر)</label>
                                                    <input type="text" name="roll_no" readonly="readonly" id="roll_no" class="form-control" placeholder="امتحا ن کا نام" value="<?php echo $new_roll_no;?>" autocomplete="off">
                                                </div><!-- end group for roll no -->

                                            </div>

                                        </div><!-- /.col-md-12-->

                                        <div class="col-md-12">

                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label>Name (طالب علم کانام)</label>
                                                    <input type="text" name="name" id="name" readonly="readonly" class="form-control" placeholder="طالب علم کانام" value="<?php echo $student_record['student_info'][0]['std_name'];?>" autocomplete="off" >
                                                </div><!-- end group for identity card no -->

                                            </div>

                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label>Father Name (والد کا نا م)</label>
                                                    <input type="text" name="father_name" readonly="readonly" id="father_name" class="form-control" placeholder="والد کا نا م" value="<?php echo $student_record['student_info'][0]['std_father_name'];?>" autocomplete="off" >
                                                </div><!-- end group for father name no -->

                                            </div>

                                        </div><!-- /.col-md-12-->

                                        <div class="col-md-12">

                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label>Registeration No of Institute (جامع/مدرسہ کا رجسٹریشن نمبر)</label>
                                                    <input type="text" name="old_institute_reg_no" id="old_institute_reg_no" class="form-control" placeholder="جامع/مدرسہ کا رجسٹریشن نمبر"  value="<?php echo $student_record['student_info'][0]['std_institute_reg_no'];?>" autocomplete="off">
                                                </div><!-- end group for old_institute_reg_no -->

                                            </div>

                                        </div><!-- /.col-md-12-->

                                    </div><!-- /.row (nested) -->

                                    <?php if($student_record['posted_data']['student_from_category'] != "annual"){?>

                                        <div class="row" dir="rtl">

                                            <h3 dir="rtl" class="text-center">جن مضامین میں طالب علم پاس ہوا</h3>
                                            <div class="col-md-12">

                                            <?php $counter =  1;foreach ($student_record['pass_sub'] as $key => $pSub) {?>
                                                    
                                                    <div class="col-lg-6">

                                                        <div class="form-group">
                                                            <label><?php echo $counter.'- '.$pSub['subject_name'];?>: </label>
                                                            <?php echo $pSub['obtained_marks'];?>
                                                        </div><!-- end group for old_institute_reg_no -->

                                                    </div>

                                            <?php $counter++; }?>

                                            </div><!-- /.col-md-12-->

                                        </div><!-- end row for جن مضامین میں طالب علم پاس ہوا -->

                                    <?php } // end if check for annaul?>

                                    <div class="row" dir="rtl">

                                        <h3 dir="rtl" class="text-center">جن مضامین میں طالب علم امتحان دی سکتا ہے</h3>
                                        <div class="col-md-12">
                                                    <?php //echo '<pre>';print_r($student_record['reappear_sub']);echo '</pre>';?>
                                        <?php $counter =  1;foreach ($student_record['reappear_sub'] as $key => $pSub) {?>
                                                
                                                <div class="col-lg-6">

                                                    <div class="form-group">
                                                        <label><?php echo $counter.'- '.$pSub['subject_name'];?>: </label>
                                                        <?php echo $pSub['obtained_marks'];?>
                                                        <input type="hidden" name="reappear_sub[]" value="<?php echo $key;?>">
                                                    </div><!-- end group for old_institute_reg_no -->

                                                </div>

                                        <?php $counter++; }?>

                                        </div><!-- /.col-md-12-->

                                    </div>

                                    <div class="row" dir="rtl">

                                        <h3 dir="rtl" class="text-center">طالب علم کی امتحان میں شرکت</h3>
                                        <div class="col-md-12">
                                            <div class="row">
                                            <div class="form-group">
                                                    <div class="col-lg-3">
                                                        <div class="radio">
                                                             <label>مکمل سا لانہ امتحان</label>
                                                             <input type="radio" name="student_from_category" id="annual" <?php if($student_record['posted_data']['student_from_category'] == 'annual'){?>checked="checked"<?php }?> disabled value="annual">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="radio">
                                                            <label>ضمنی امتحان</label>
                                                            <input type="radio" name="student_from_category" id="fail" <?php if($student_record['posted_data']['student_from_category'] == 'fail'){?>checked="checked"<?php }?> value="fail" disabled>&nbsp;&nbsp;&nbsp;                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="radio">
                                                            <label>بہترتقدیرمیں کا میا بی کے لیے</label>
                                                                <input type="radio" name="student_from_category" id="course_grade" value="grade3" <?php if($student_record['posted_data']['student_from_category'] == 'grade3'){?>checked="checked"<?php }?> disabled>&nbsp;&nbsp;&nbsp;
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="radio">
                                                            <label>تیسری دفعہ</label>
                                                            <input type="radio" name="student_from_category" id="third_attempt" value="third_attempt" <?php if($student_record['posted_data']['student_from_category'] == 'third_attempt'){?>checked="checked"<?php }?> disabled>&nbsp;&nbsp;&nbsp;
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="radio">
                                                            <label>سالانہ سے سالانہ</label>
                                                            <input type="radio" name="student_from_category" id="f_to_f" value="f_to_f" <?php if($student_record['posted_data']['student_from_category'] == 'f_to_f'){?>checked="checked"<?php }?> disabled>&nbsp;&nbsp;&nbsp;
                                                        </div>
                                                    </div>
                                            </div><!-- end group for type of exam -->
                                        </div><!-- end row-->
                                        </div><!-- /.col-md-12-->

                                    </div>

                                    <div class="row">

                                        <div class="col-lg-6">
                                            <input type="hidden" name="exam_id" value="<?php echo $exam_info[0]['exam_info_id'];?>">
                                            <input type="hidden" name="std_id" value="<?php echo $student_record['student_info'][0]['std_id'];?>">
                                            <input type="hidden" name="student_coming_from" value="<?php echo $student_record['posted_data']['student_from_category'];?>">
                                            <button type="submit" name="form_submit" value="submit" class="btn btn-info btn-sm fa fa-check"> Submit</button>
                                            <button type="reset" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url();?>admin/viewAllStudents'">Back</button>
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