<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->

             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit Province</h1>
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
    							$attribute = array('class' => 'web_form','id' => 'edit_province', 'name' => 'edit_province' );
        						echo form_open_multipart('admin/editProvince/'.$province_info[0]['prov_id'],$attribute) ?>
                                    <div class="row">

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Province Name Urdu</label>
                                                <input type="text" name="prov_name_urdu" id="prov_name_urdu" class="form-control" placeholder="سال عیسوی میں" value="<?php echo $province_info[0]['prov_name_urdu'];?>" autocomplete="off" >
                                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                                            </div><!-- end group for class name -->

                                        </div>
                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Province Name English</label>
                                                <input type="text" name="prov_name_eng" id="prov_name_eng" class="form-control" placeholder="سال عیسوی میں" value="<?php echo $province_info[0]['prov_name_eng'];?>" autocomplete="off" >
                                            </div><!-- end group for examination year in dominic -->


                                        </div>
                                    </div><!-- /.row (nested) -->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-info btn-sm fa fa-check"> Update</button>
                                            <button type="button" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url()?>admin/viewAllProvinces'"> Back</button>
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