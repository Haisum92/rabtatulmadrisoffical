<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->

             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $title;?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <?php echo $page_title;?>
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
                                        <strong>مضمون</strong>
                                    </div>
                                    <div class="col-sm-3">
                                        <strong>تاریخ</strong>
                                    </div>
                                    <div class="col-sm-2">
                                        <strong>وقت</strong>
                                    </div>
                                    <div class="col-sm-3">
                                        <strong>پہر</strong>
                                    </div>
                                </div>
                                <div class="row">
                                    &nbsp;
                                </div>

                                <?php 
                                if($exam_subjects_info != NULL){?>

                                <?php
                                // echo '<pre>';print_r($students_info);echo '</pre>';die();
                                $attribute = array('class' => 'web_form','id' => 'create_exam_date_sheet_form', 'name' => 'create_exam_date_sheet_form', 'role' => 'form' );
                                echo form_open_multipart('admin/createDateSheetForExam/'.$exam_id,$attribute);?>
                               
                                

                                <?php
                                $ten_subject_datesheet = (count($exam_subjects_info) > 7 ? true : false);
                                 foreach($exam_subjects_info as $key => $sbinfo){ $key++; ?>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <strong><?php echo $key;?></strong>
                                        </div>
                                        <div class="col-sm-2">
                                            <strong><?php echo $sbinfo['sub_name_urdu'];?></strong>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="date" name="subject_exam_date[]" id="subject_exam_date_id_<?php echo $key;?>" class="form-control padding-right0" value="" autocomplete="off">
                                                <input type="hidden" name="subject_id[]" class="form-control" placeholder="نمبر" value="<?php echo $sbinfo['sub_id'];?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                            <?php if($ten_subject_datesheet and $key >= 7){?>
                                                <input type="text" name="subject_exam_time[]" id="subject_exam_time<?php echo $key;?>" class="form-control" placeholder="2:30" value="2:30" autocomplete="off">
                                            <?php }else{?>
                                                <input type="text" name="subject_exam_time[]" id="subject_exam_time<?php echo $key;?>" class="form-control" placeholder="8:00" value="8:00" autocomplete="off">
                                            <?php }?>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                            <?php if($ten_subject_datesheet and $key >= 7){?>
                                                <input type="radio" name="exam_appearence_time_<?php echo $sbinfo['sub_id'];?>[]" value="first_time"><lable>&nbsp;بجے دوپہر&nbsp;</lable>
                                                <input type="radio" name="exam_appearence_time_<?php echo $sbinfo['sub_id'];?>[]" checked="checked" value="second_time"><lable>&nbsp;بجے صبح&nbsp;</lable>
                                            <?php }else{?>
                                                <input type="radio" name="exam_appearence_time_<?php echo $sbinfo['sub_id'];?>[]" checked="checked" value="first_time"><lable>&nbsp;بجے دوپہر&nbsp;</lable>
                                                <input type="radio" name="exam_appearence_time_<?php echo $sbinfo['sub_id'];?>[]" value="second_time"><lable>&nbsp;بجے صبح&nbsp;</lable>
                                            <?php }?>
                                            
                                            
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-info btn-sm fa fa-check"> Submit</button>
                                            <button type="button" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url()?>admin/createDateSheet'"> Back</button>
                                        </div>
                                    </div><!-- /.row (nested) -->

                                </form>
                                <?php }?>
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