<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->

             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add Subject</h1>
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
    							$attribute = array('class' => 'web_form','id' => 'add_subject', 'name' => 'add_subject',
                                                    'role' => 'form'
                                             );
        						echo form_open_multipart('admin/addSubject',$attribute) ?>
                                    <div class="row">

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Name (نام):</label>
                                                <input type="text" name="sub_name_urdu" id="sub_name_urdu" class="form-control" placeholder="مضمون کا نام" value="<?php echo set_value('prov_nane_urdu');?>" autocomplete="off" >
                                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                                            </div><!-- end group for class name -->

                                        </div>
                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Total Number (نمبر):</label>
                                                <input type="text" name="total_marks" id="total_marks" class="form-control" placeholder="نمبر" value="<?php echo set_value('prov_nane_eng');?>" autocomplete="off" >
                                            </div><!-- end group for examination name -->

                                        </div>
                                    </div><!-- /.row (nested) -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Class (کلاس):</label>
                                                <select class="form-control" name="class_id" id="class_id">
                                                <?php foreach ($class_array as $key => $class) {?>
                                                    <option value="<?php echo $class['class_id']?>"><?php echo $class['class_name_urdu'];?></option>
                                                <?php }?>
                                                </select>
                                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                                            </div><!-- end group for class name -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-info btn-sm fa fa-check"> Submit</button>
                                            <button type="button" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url()?>admin/viewAllSubjects'"> Back</button>
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