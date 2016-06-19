<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->

             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $exam_info[0]['exam_name'];?></h1>
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
                                if($date_sheet_info != NULL){?>
                                

                                <?php
                                 foreach($date_sheet_info as $key => $dinfo){ $key++; ?>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <strong><?php echo $key;?></strong>
                                        </div>
                                        <div class="col-sm-2">
                                            <strong><?php echo $dinfo['sub_name_urdu'];?></strong>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <p><?php echo $dinfo['exam_date'];?></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <?php echo $dinfo['exam_time'];?>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <?php 
                                                // echo $dinfo['exam_appearance_time'];
                                                if($dinfo['exam_appearance_time'] == 'first_time'){?>
                                                    صبح
                                                <?php }else{?>
                                                    دوپہر
                                                <?php }?>                                            
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="button" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url()?>admin/datesheet'"> Back</button>
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