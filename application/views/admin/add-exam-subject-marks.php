<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->

             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">نمبر مضمون <?php echo $sub_name;?> <?php echo $exam_info[0]['exam_name'];?> </h1>
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
                                    <div class="col-sm-2">
                                        <strong>نمبر شمار</strong>
                                    </div>
                                    <div class="col-sm-2">
                                        <strong>رجسٹریشن نمبر</strong>
                                    </div>
                                    <div class="col-sm-2">
                                        <strong>رول نمبر</strong>
                                    </div>
                                    <div class="col-sm-2">
                                        <strong>نمبر</strong>
                                    </div>
                                    <div class="col-sm-2">
                                        <strong>ھدایات</strong>
                                    </div>
                                </div>
                                <div class="row">
                                    &nbsp;
                                </div>

                                <?php 
                                if($students_info != NULL){?>

                                <?php
                                // echo '<pre>';print_r($students_info);echo '</pre>';die();
                                $attribute = array('class' => 'web_form','id' => 'add_student_single_subject_marks', 'name' => 'add_student_single_subject_marks', 'role' => 'form' );
                                echo form_open_multipart('admin/addExamSubjectMarks/'.$exam_id.'/'.$subject_id,$attribute);?>
                               
                                

                                <?php foreach($students_info as $key => $std){ $key++; ?>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <strong><?php echo $key.'-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$std['std_name'];?></strong>
                                        </div>
                                        <div class="col-sm-2">
                                            <strong><?php echo $std['std_reg_no'];?></strong>
                                        </div>
                                        <div class="col-sm-2">
                                            <strong><?php echo $std['std_roll_no'];?></strong>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <input type="text" name="obtained_marks[]" id="marks_obtained_<?php echo $key;?>" class="form-control" placeholder="نمبر" value="<?php echo $std['Obtained_marks'];?>" autocomplete="off">
                                                <input type="hidden" name="std_id[]" class="form-control" placeholder="نمبر" value="<?php echo $std['std_id'];?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                            
                                                <input type="radio" name="option_<?php echo $std['std_id'];?>" <?php if($std['sub_status'] == "pass"){?>checked<?php }?> value="pass"><lable>&nbsp;P&nbsp;</lable>
                                            
                                                <input type="radio" name="option_<?php echo $std['std_id'];?>" <?php if($std['sub_status'] == "absent"){?>checked="checked"<?php }?> value="absent"><lable>&nbsp;A&nbsp;</lable>
                                            
                                                <input type="radio" name="option_<?php echo $std['std_id'];?>" <?php if($std['sub_status'] == "cheat"){?> checked="checked" <?php }?> value="cheat"><lable>&nbsp;C&nbsp;</lable>
                                            
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="hidden" name="page_offset" value="<?php echo $page_offset;?>"/>                                            
                                            <button type="submit" class="btn btn-info btn-sm fa fa-check"> Submit</button>
                                            <button type="button" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url()?>admin/marksWithSubject'"> Back</button>
                                        </div>
                                    </div><!-- /.row (nested) -->

                                    

                                   <!--  <div class="row">
                                        <div class="col-lg-6"> -->
                                            <!-- <input type="submit" class="btn btn-lg btn-sucess" id="Register" value="Sign up"/> -->
                                            <!-- <input type="submit" name="submit" id="submit" class="btn btn-info btn-sm fa fa-check" value="Submit" /> -->
                                            <!-- <button type="submit" name="submit" id="submit" value="submit" class="btn btn-info btn-sm fa fa-check"> Submit</button>
                                            <button type="button" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url()?>admin/viewAllClasses'"> Back</button> -->
                                        <!-- </div> -->
                                    <!-- </div> -->
                                    <!-- /.row (nested) -->

                                </form>
                                <?php }?>
                            </div>
                            <!-- /.panel-body -->
                            <?php echo $this->pagination->create_links();?>
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->     
<?php $this->load->view('admin/footer');?>