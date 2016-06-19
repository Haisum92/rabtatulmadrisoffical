<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->

             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">تاریخ امتحان</h1>
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
                                // echo '<pre>';print_r($exam_info);echo '</pre>';die();
    							$attribute = array('class' => 'web_form','id' => 'edit_date_for_hifz_ul_quran', 'name' => 'edit_date_for_hifz_ul_quran', 'role' => 'form' );
        						echo form_open_multipart('admin/editDateSheetHifzQuran/'.$exam_data[0]['eci_id'],$attribute) ?>
                                    <div class="row">

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Examination Center (امتحانی مراکز)</label>
                                                <input type="text" name="examination_center_name" id="examination_center_name" readonly="readonly" class="form-control" placeholder="امتحانی مرکز کا نام" value="<?php echo $exam_data[0]['exam_center_name_urdu'];?>" autocomplete="off">
                                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                                            </div><!-- end group for class name -->
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Date of Exam (تاریخ امتحان)</label>
                                                <input type="date" name="hifzulquran_exam_date" id="hifzulquran_exam_date" class="form-control" placeholder="تاریخ" value="<?php if( $exam_data[0]['hifzulquran_exam_date'] != NULL ){ echo $exam_data[0]['hifzulquran_exam_date'];}else{?>YYYY-mm-dd<?php }?>" autocomplete="off">
                                            </div><!-- end group for examination year in dominic -->


                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-info btn-sm fa fa-check"> Submit</button>
                                            <button type="button" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url()?>admin/hifzulQuranExamDateForExaminationCenters'">Back</button>
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