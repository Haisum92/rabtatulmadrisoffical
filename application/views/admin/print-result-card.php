<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->

             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">رزلٹ کارڈ</h1>
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
                                // echo '<pre>';print_r($affiliated_institutes_array);echo '</pre>';
    							$attribute = array('class' => 'web_form','id' => 'print_result_card',
                                                     'name' => 'print_result_card', 'role' => 'form' );
        						echo form_open_multipart('admin/printResultCard',$attribute) ?>
                                    
                                    <div class="row">

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Date of Result (تاریخ اعلان النتیجۃ عیسوی)</label>
                                                <input type="text" name="result_date" id="result_date" class="form-control" placeholder="تاریخ اعلان النتیجۃ عیسوی" value="<?php echo set_value('result_date');?>" autocomplete="off" >
                                            </div><!-- end group for class name -->

                                        </div>

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Hijri Year (ھجری سال)</label>
                                                <input type="text" name="hijri_year" id="hijri_year" class="form-control" placeholder="ھجری سال" value="<?php echo set_value('hijri_year');?>" autocomplete="off" >
                                            </div><!-- end group for class name -->

                                        </div>

                                    </div><!-- /.row (nested) -->

                                    <div class="row">

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Date of Exam (تاریخ الامتحان)</label>
                                                <select class="form-control" name="date_of_exam" id="date_of_exam">
                                                    <option value="رجب">رجب</option>
                                                    <option value="ذوالحجہ">ذوالحجہ</option>
                                                </select>
                                            </div><!-- end group for class name -->

                                        </div>

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Please select exam (امتحان کا انتخاب کریں)</label>
                                                <select class="form-control" name="exam_id" id="exam_id">
                                                    <?php if($exams_array != ""){
                                                        foreach ($exams_array as $key => $exams) {?>
                                                            <option value="<?php echo $exams['exam_info_id'];?>"><?php echo $exams['exam_year_dominic'].' - '.$exams['exam_name'];?></option>
                                                        <?php }
                                                    }?>
                                                </select>
                                            </div><!-- end group for class name -->

                                        </div>

                                    </div><!-- /.row (nested) -->

                                    <div class="row">

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Affiliated Institue (الحاق شدہ مدارس)</label>
                                                <select class="form-control" name="affliated_inst_id" id="affliated_inst_id">
                                                        <option value="" selected="selected"> -- امتحانی مرکز -- </option>
                                                    <?php if($affiliated_institutes_array != ""){
                                                        foreach ($affiliated_institutes_array as $key => $inst) {?>
                                                            <option value="<?php echo $inst['affli_id'];?>"><?php echo $inst['affli_shortname'].'  '.$inst['inst_reg_no'];?></option>
                                                        <?php }
                                                    }?>
                                                </select>
                                            </div><!-- end group for class name -->

                                        </div>

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                            </div><!-- end group for class name -->

                                        </div>

                                    </div><!-- /.row (nested) -->

                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Registration No (رجسٹریشن نمبر)</label>
                                                <input type="text" name="student_reg" id="student_reg" class="form-control" placeholder="رجسٹریشن نمبر" value="<?php echo set_value('student_reg');?>" autocomplete="off" >
                                                <p class="help-block">صرف ایک طالبعلم/طالبہ کے لیے</p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Roll No (رول نمبر)</label>
                                                <input type="text" name="student_roll_no" id="student_roll_no" class="form-control" placeholder="رول نمبر" value="<?php echo set_value('student_roll_no');?>" autocomplete="off" >
                                                <p class="help-block">صرف ایک طالب طالبعلم/طالبہ کے لیے</p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-info btn-sm fa fa-check">Submit</button>
                                            <button type="reset" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url();?>admin/viewAllStudents'"> Back</button>
                                        </div>
                                    </div><!-- /.row (nested) -->
                                </form>

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