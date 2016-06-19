<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->

             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">طالب علم کا رزلٹ <?php echo $exam_name[0]['exam_name'];?></h1>
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
                                        <div class="col-lg-4">
                                            <div class="form-group"> 
                                                <label>نام:&nbsp;&nbsp; <?php echo $result_info[0]['std_name'];?></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group"> 
                                                <label>رجسٹریشن نمبر:&nbsp;&nbsp; <?php echo $result_info[0]['std_reg_no'];?></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group"> 
                                                <label>رول نمبر:&nbsp;&nbsp; <?php echo $result_info[0]['std_roll_no'];?></label>
                                            </div>
                                        </div>
                                    </div>
    						    <?php
                                // echo '<pre>';print_r($result_info);echo '</pre>';//die();
    							$attribute = array('class' => 'web_form','id' => 'add_one_subject_result', 'name' => 'add_one_subject_result', 'role' => 'form' );
        						echo form_open_multipart('admin/viewOneResult/'.$exam_id.'/'.$exam_type.'/'.$result_info[0]['student_id'],$attribute) ?>
                                    <div class="row">

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                
                                                <label><?php if($exam_class_grade == "grade0"){?>Hifz ul Quran <?php }else{?> Tajweed ul Quran <?php }?> (رزلٹ)</label>

                                                <input type="text" name="obtained_marks" id="obtained_marks" class="form-control" placeholder="مضمون کے نمبر" value="<?php echo $result_info[0]['obtained_marks'];?>" autocomplete="off" >
                                                
                                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                                            </div><!-- end group for class name -->

                                        </div>

                                    </div><!-- /.row (nested) -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                        
                                        <?php if($result_info[0]['subject_id'] != ""){?>
                                            
                                            <input type="hidden" name="subject_id" value="<?php echo $result_info[0]['subject_id'];?>">

                                        <?php }else{?>
                                        
                                            <input type="hidden" name="subject_id" value="<?php echo $exam_subjects[0]['sub_id'];?>">

                                        <?php }?>
                                            
                                            <button type="submit" class="btn btn-info btn-sm fa fa-check"> Submit</button>
                                            <button type="button" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url()?>admin/oneSubjectStudents/<?php echo $exam_id;?>/<?php echo $exam_type;?>'"> Back</button>
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