<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->

             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">طالب علم کا رزلٹ امتحان <?php echo $exam_name[0]['exam_name'];?></h1>
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
                                //echo '<pre>';print_r($result_info);echo '</pre>';//die();
    							$attribute = array('class' => 'web_form','id' => 'add_ten_subject_result', 'name' => 'add_ten_subject_result', 'role' => 'form' );
        						echo form_open_multipart('admin/viewTenResult/'.$exam_id.'/'.$exam_type.'/'.$result_info[0]['student_id'],$attribute) ?>
                                    <div class="row">
                                            <?php if($result_info[0]['subject_id'] != ""){?>
                                                <?php
                                                if ($attempt_no == "second" OR $attempt_no == "third" OR $attempt_no == "f_to_f") {
                                                        
                                                        $resultKey = 0; foreach ($exam_subjects as $key => $sub) { ?>
                                                            <?php
                                                                if (isset($result_info[$resultKey]) AND $result_info[$resultKey]['subject_id'] == $sub['sub_id']) {?>
                                                                    
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">    
                                                                            <label><?php echo $sub['sub_name_urdu'];?> </label>
                                                                            <input type="text" name="obtained_marks[]" class="form-control" placeholder="مضمون کے نمبر" value="<?php echo $result_info[$resultKey]['obtained_marks'];?>" autocomplete="off"id="obtained_marks_<?php echo $resultKey;?>">
                                                                            <input type="hidden" name="subject_id[]" value="<?php echo $sub['sub_id'];?>">
                                                                            <input type="hidden" name="rsrinfo_id[]" value="<?php echo $result_info[$resultKey]['rsrinfo_id'];?>">
                                                                            <input type="hidden" name="regular_student_id[]" value="<?php echo $result_info[$resultKey]['regular_student_id'];?>">

                                                                        <?php $resultKey++;?>
                                                                        </div>
                                                                    </div>            

                                                                <?php
                                                                }   // END IF FOR RESULT_INFO[RESULT_KEY] CHECK
                                                            
                                                        }   //  END FOREACH LOOP

                                                    }else{

                                                        $resultKey = 0; $count = 0;foreach ($exam_subjects as $key => $sub) { $key++;?>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">    
                                                                <label><?php echo $sub['sub_name_urdu'];?> </label>
                                                                <?php if(array_key_exists($resultKey, $result_info)){?>

                                                                    <?php if($result_info[$resultKey]['subject_id'] == $sub['sub_id']){?>

                                                                        <input type="text" name="obtained_marks[]" id="obtained_marks_<?php echo $key;?>" class="form-control" placeholder="مضمون کے نمبر" value="<?php echo $result_info[$resultKey]['obtained_marks'];?>" autocomplete="off">
                                                                    
                                                                    <?php $resultKey++;

                                                                    }else{?>

                                                                        <input type="text" name="obtained_marks[]" id="obtained_marks_<?php echo $key;?>" class="form-control" placeholder="مضمون کے نمبر" value="" autocomplete="off">
                                                                    
                                                                    <?php }?>

                                                                <?php }else{?>

                                                                        <input type="text" name="obtained_marks[]" id="obtained_marks_<?php echo $key;?>" class="form-control" placeholder="مضمون کے نمبر" value="" autocomplete="off">
                                                                
                                                                <?php }?>

                                                                <input type="hidden" name="subject_id[]" value="<?php echo $sub['sub_id'];?>">
                                                            </div>
                                                        </div>

                                                            <?php $count++;}?>
                                                    <?php
                                                    }
                                                    ?>

                                            <?php }else{?>

                                                    <?php foreach ($exam_subjects as $key => $sub) { $key++;?>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">    
                                                            <label><?php echo $sub['sub_name_urdu'];?> </label>
                                                            <input type="text" name="obtained_marks[]" id="obtained_marks_<?php echo $key;?>" class="form-control" placeholder="مضمون کے نمبر" value="" autocomplete="off">
                                                            <input type="hidden" name="subject_id[]" value="<?php echo $sub['sub_id'];?>">
                                                        </div>
                                                    </div>

                                                <?php }?>

                                            <?php }?>

                                    </div><!-- /.row (nested) -->

                                    <div class="row">
                                        <div class="col-lg-6">                                            
                                            <button type="submit" class="btn btn-info btn-sm fa fa-check"> Submit</button>
                                            <button type="button" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url()?>admin/tenSubjectStudents/<?php echo $exam_id;?>'"> Back</button>
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