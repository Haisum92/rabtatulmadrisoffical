<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->

             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">تفصیل امتحانی مرکز</h1>
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
                                // echo '<pre>';print_r($examination_center_info);echo '</pre>';die();
    							$attribute = array('class' => 'web_form','id' => 'edit_examination_center', 'name' => 'edit_examination_center',
                                                    'role' => 'form'
                                             );
        						echo form_open_multipart('admin/editExaminationCenter/'.$examination_center_info[0]['eci_id'],$attribute) ?>
                                    <div class="row">

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                            <label>Examination Center Name Urdu (امتحانی مرکز کا نام اردو میں)</label>
                                                <input type="text" name="exam_center_name_urdu" id="exam_center_name_urdu" class="form-control" placeholder="امتحانی مرکز کا نام اردو میں" value="<?php echo $examination_center_info[0]['exam_center_name_urdu'];?>" autocomplete="off" >
                                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                                            </div><!-- end group for class name -->

                                            <div class="form-group">
                                            <label>Province (صوبہ)</label>
                                            <select class="form-control" name="exam_province" id="exam_province">
                                                    <option value="" disabled selected>--- صوبہ کا انتخا ب کریں ---</option>
                                                    <?php if($province_array != ""){
                                                        foreach ($province_array as $key => $province) {?>
                                                            <option value="<?php echo $province['prov_id'];?>" <?php if($examination_center_info[0]['prov_id'] == $province['prov_id']){?> selected="selected" <?php }?>><?php echo $province['prov_name_urdu'];?></option>
                                                        <?php }
                                                    }?>
                                                </select>
                                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                                            </div><!-- end group for class name -->

                                            <div class="form-group">
                                                <label>Examination Center Address (امتحانی مرکز کا پتہ) </label>
                                                <textarea class="form-control" name="exam_center_address" id="exam_center_address" rows="3"><?php echo $examination_center_info[0]['exam_center_address'];?></textarea>
                                            </div><!-- end group for examination name -->


                                        </div>
                                        <div class="col-lg-6">

                                            <!-- <div class="form-group">
                                                <label>Examination Center Name English (امتحانی مرکز کا نام انگریزی میں) </label>
                                                <input type="text" name="exam_center_name_eng" id="exam_center_name_eng" class="form-control" placeholder="امتحانی مرکز کا نام انگریزی میں" value="<?php echo $examination_center_info[0]['exam_center_name_eng'];?>" autocomplete="off" >
                                            </div> -->
                                            <!-- end group for examination name -->

                                            <div class="form-group">
                                                <label>City (شہر)</label>
                                                <select class="form-control" name="exam_center_district" id="exam_center_district">
                                                    <option value="" disabled selected>--- شہر کا انتخا ب کریں ---</option>
                                                <?php if($district_array != ""){?>
                                                        <?php foreach ($district_array as $key => $district) {?>
                                                            <option value="<?php echo $district['d_id'];?>" <?php if($examination_center_info[0]['exam_center_district'] == $district['d_id']){?> selected="selected" <?php }?>><?php echo $district['district_name_urdu'];?></option>
                                                        <?php }
                                                    }?>
                                                </select>
                                            </div><!-- end select input for cities --> 

                                        </div>
                                    </div><!-- /.row (nested) -->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-info btn-sm fa fa-check"> Submit</button>
                                            <button type="button" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url()?>admin/viewAllExaminationCenters'"> Back</button>
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