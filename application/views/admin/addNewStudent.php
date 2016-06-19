<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->

             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">نئے طالب علم کا داخلہ فارم</h1>
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
    							$attribute = array('class' => 'web_form','id' => 'add_new_student',
                                                     'name' => 'add_new_student', 'role' => 'form' );
        						echo form_open_multipart('admin/newStudent',$attribute) ?>
                                    <div class="row">

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
                                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                                            </div><!-- end group for class name -->

                                            <div class="form-group">
                                                <label>Select the course name (کورس کا نام منتخب کریں)</label>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="course_grade" id="course_grade" value="grade0">حفظ القران الکریم
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="course_grade" id="course_grade" value="grade1">تجوید القران الکریم
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="course_grade" id="course_grade" value="grade3">چھ مضامین(متوستہ،خاصہ،عالیہ۔۔)
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="course_grade" id="course_grade" value="grade4">دس مضامین(ثا نویہ عامہ)
                                                        </label>
                                                    </div>
                                            </div><!-- end group for type of exam -->

                                        </div>

                                    </div><!-- /.row (nested) -->
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