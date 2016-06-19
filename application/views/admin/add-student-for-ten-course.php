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
    							$attribute = array('class' => 'web_form','id' => 'add-student-ten-course', 
                                                   'name' => 'add-student-ten-course', 'role' => 'form'
                                                 );
        						echo form_open_multipart('admin/addNewStudentForTenCourse/'.$class_exam_info[0]['exam_info_id'],$attribute) ?>
                                    <div class="row">

                                        <div class="col-md-12">
                                            
                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label>Please select examination center (امتحانی مرکز کا انتخاب کریں)</label>
                                                    <select class="form-control" name="exam_center" id="exam_center">
                                                    	<?php if($exam_center_info != ""){
                                                    		foreach ($exam_center_info as $key => $ecenter) {?>
                                                    			<option value="<?php echo $ecenter['eci_id'];?>"><?php echo $ecenter['exam_center_name_urdu'];?></option>
                                                    		<?php }
                                                    	}?>
                                                    </select>
                                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                                </div><!-- end group for examinatio center name -->

                                            </div><!-- end col-lg-6-->

                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label>Class Name (کلاس کا نام)</label>
                                                    <input type="text" name="class_name" readonly="readonly" id="class_name" class="form-control" placeholder="رکلاس کا نام" value="<?php echo $class_exam_info[0]['class_name_urdu'];?>" autocomplete="off" >
                                                    <input type="hidden" name="class_id" id="class_id" class="form-control" placeholder="رکلاس کا نام" value="<?php echo $class_exam_info[0]['class_id'];?>" editable="false" >
                                                    <input type="hidden" name="exam_id" id="exam_id" class="form-control" placeholder="رکلاس کا نام" value="<?php echo $class_exam_info[0]['exam_info_id'];?>" editable="false" >
                                                </div><!-- end group for class_name  no -->

                                            </div><!-- end col-lg-6-->

                                        </div><!-- end col-md-12-->

                                        <div class="col-md-12">

                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label>Registeration No (رجسٹریشن نمبر)</label>
                                                    <input type="text" readonly="readonly" name="reg_no" id="reg_no" class="form-control" placeholder="رجسٹریشن نمبر" value="<?php echo $new_std_reg_no;?>" autocomplete="off" >
                                                </div><!-- end group for reg_no -->

                                            </div>
                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label>Roll No (ر و ل نمبر)</label>
                                                    <input type="text" name="roll_no" readonly="readonly" id="roll_no" class="form-control" placeholder="امتحا ن کا نام" value="<?php echo $new_std_roll_no;?>" autocomplete="off" >
                                                </div><!-- end group for roll no -->
                                            </div>

                                        </div>

                                        <div class="col-md-12">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Name (طالب علم کانام)</label>
                                                    <input type="text" name="name" id="name" class="form-control" placeholder="طالب علم کانام" value="<?php echo set_value('name');?>" autocomplete="off" >
                                                </div><!-- end group for identity card no -->
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Father Name (والد کا نا م)</label>
                                                    <input type="text" name="father_name" id="father_name" class="form-control" placeholder="والد کا نا م" value="<?php echo set_value('father_name');?>" autocomplete="off" >
                                                </div><!-- end group for father name no -->
                                            </div>
                                        </div>

                                        <div class="col-md-12">

                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label>ID Card No (شنا ختی کا رڈ نمبر)</label>
                                                    <input type="text" name="id_card_no" id="id_card_no" class="form-control" placeholder="شنا ختی کا رڈ نمبر" value="<?php echo set_value('id_card_no');?>" autocomplete="off" >
                                                </div><!-- end group for identity card -->
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Date of Birth English (تاریخ پیدا ئش ہندسوں میں)</label>
                                                    <input type="date" name="dob_eng" id="dob_eng" class="form-control" placeholder="تاریخ پیدا ئش ہندسوں میں" value="<?php echo set_value('dob_eng');?>" autocomplete="off" >
                                                </div><!-- end group for dob_eng  -->
                                            </div>

                                        </div>

                                        <div class="col-md-12">

                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label>Date of Birth Urdu (حروف میں)</label>
                                                    <input type="text" name="dob_urdu" id="dob_urdu" class="form-control" placeholder="حروف میں" readonly="readonly" value="<?php echo set_value('dob_urdu');?>" autocomplete="off" >
                                                </div><!-- end group for dob_urdu -->
                                            </div>

                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label>Registeration No of Institute (جامع/مدرسہ کا رجسٹریشن نمبر)</label>
                                                    <input type="text" name="old_institute_reg_no" id="old_institute_reg_no" class="form-control" placeholder="جامع/مدرسہ کا رجسٹریشن نمبر"  value="<?php echo set_value('old_institute_reg_no');?>" autocomplete="off" >
                                                </div><!-- end group for old_institute_reg_no -->

                                            </div>
                                        </div>

                                        <div class="col-md-12">

                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label>Address (مستقل پتہ)</label>
                                                    <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                                                </div><!-- end group for address -->
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Upload Photo (طالب علم کی تصویر)</label>
                                                    <input type="file" name="userfile" id="userfile">
                                                </div><!-- end profile image -->

                                            </div>
                                        </div><!-- .col-md-12 -->


                                    </div><!-- /.row (nested) -->

                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="col-lg-6">
                                                <button type="submit" class="btn btn-info btn-sm fa fa-check"> Submit</button>
                                                <button type="reset" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url();?>admin/viewAllStudents'">&nbsp;Back</button>
                                            </div>
                                        </div><!-- end col-md-12 -->
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