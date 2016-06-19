<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->

             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Ghazette Detail</h1>
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
    							$attribute = array('class' => 'web_form','id' => 'ghazat_detail', 'name' => 'ghazat_detail',
                                                    'role' => 'form'
                                             );
        						echo form_open_multipart('admin/ghazatDetail',$attribute) ?>
                                    <div class="row">

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Select Exam (امتحان کا انتخاب کریں)</label>
                                                <select class="form-control" name="exam_id" id="exam_id">
                                                <?php foreach($exam_array AS $key => $exam){?>
                                                    <option value="<?php echo $exam['exam_info_id'];?>"><?php echo $exam['exam_name'];?></option>
                                                <?php }?>
                                                </select>

                                            </div>
                                        </div><!-- end col-lg-6-->

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Select Student Type (طلبہ | طالبات)</label>
                                                <select class="form-control" name="exam_gender" id="exam_gender">
                                                    <option value="m">طلبہ</option>
                                                    <option value="f">طالبات</option>
                                                </select>

                                            </div>
                                        </div><!-- end col-lg-6-->


                                    </div><!-- /.row (nested) -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label> الحاق شدہ مدرسہ کا انتخاب کریں </label>
                                                <select class="form-control" name="inst_id" id="inst_id">
                                                <option value=""> -- </option>
                                                <?php foreach($inst_array AS $key => $inst){?>
                                                    <option value="<?php echo $inst['affli_id'];?>"><?php echo $inst['affli_shortname'];?></option>
                                                <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-info btn-sm fa fa-check"> Print</button>
                                            <button type="button" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url()?>admin/dashboard'"> Back</button>
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