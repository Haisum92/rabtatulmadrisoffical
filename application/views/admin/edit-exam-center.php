<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->

             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">امتحانی مرکز کی تفصیل</h1>
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
    							$attribute = array('class' => 'web_form','id' => 'edit_exam', 'name' => 'edit_exam' );
        						echo form_open_multipart('admin/editExam/'.$exam_info[0]['exam_info_id'],$attribute) ?>
                                    <div class="row">

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Class (کلاس)</label>
                                                <select class="form-control" name="class_id" id="class_id">
                                                	<?php if($class_array != ""){
                                                		foreach ($class_array as $key => $class) {?>
                                                			<option value="<?php echo $class['class_id'];?>" <?php if($exam_info[0]['class_id'] == $class['class_id']){?>selected<?php }?>><?php echo $class['class_name_urdu'];?></option>
                                                		<?php }
                                                	}?>
                                                </select>
                                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                                            </div><!-- end group for class name -->

                                            <div class="form-group">
                                                <label>Exam Year in Dominic (عیسویٰ)</label>
                                                <input type="text" name="exam_year_dominic" id="exam_year_dominic" class="form-control" placeholder="سال عیسوی میں" value="<?php echo $exam_info[0]['exam_year_dominic'];?>" autocomplete="off" >
                                            </div><!-- end group for examination year in dominic -->

                                            <div class="form-group">
                                                <label>Date of declaring result in Hijri (ہجری)</label>
                                                <input type="text" name="exam_result_date_hijri" id="exam_result_date_hijri" class="form-control" placeholder="تاریخ اعلان النتیجۃ ہجری میں" value="<?php echo $exam_info[0]['exam_result_date_hijri'];?>" autocomplete="off" >
                                            </div><!-- end group for examination result date in hijri -->

                                            <div class="form-group">
                                                <label>Exam degree date in Hijri (ہجری)</label>
                                                <input type="text" name="exam_degree_date_hijri" id="exam_degree_date_hijri" class="form-control" placeholder="تاریخ اصدارالشھادۃ ہجری میں" value="<?php echo $exam_info[0]['exam_degree_date_hijri'];?>" autocomplete="off" >
                                            </div><!-- end group for examination date in hijri -->

                                            <div class="form-group">
                                                <label>Type Of Exam</label>
                                                <select class="form-control" name="exam_type" id="exam_type">
                                                    <?php if($exam_type_array != ""){
                                                        foreach ($exam_type_array as $key => $etype) {?>
                                                            <option value="<?php echo $etype['et_id'];?>" <?php if($exam_info[0]['et_id'] == $etype['et_id']){?>selected<?php }?>><?php echo $etype['exam_type_name_eng'].' ('.$etype['exam_type_name_urdu'].')';?></option>
                                                        <?php }
                                                    }?>
                                                </select>
                                            </div><!-- end group for type of exam -->

                                        </div>
                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label>Examination Name</label>
                                                <input type="text" name="exam_name" id="exam_name" class="form-control" placeholder="امتحا ن کا نام" value="<?php echo $exam_info[0]['exam_name'];?>" autocomplete="off" >
                                            </div><!-- end group for examination name -->

                                            <div class="form-group">
                                                <label>Date of declaring result in Dominic (عیسویٰ)</label>
                                                <input type="text" name="exam_result_date_dominic" id="exam_result_date_dominic" class="form-control" placeholder="تاریخ اعلان النتیجۃ عیسوی میں" value="<?php echo $exam_info[0]['exam_result_date_dominic'];?>" autocomplete="off" >
                                            </div><!-- end group for date of declaring result in dominic -->
                                            
                                            <div class="form-group">
                                                <label>Exam degree date in Dominic (عیسویٰ)</label>
                                                <input type="text" name="exam_degree_date_dominic" id="exam_degree_date_dominic" class="form-control" placeholder="تاریخ اصدارالشھادۃ عیسوی میں" value="<?php echo $exam_info[0]['exam_degree_date_dominic'];?>" autocomplete="off" >
                                            </div><!-- end group for exam degree date in dominic -->
                                            
                                            <div class="form-group">
                                                <label>Examaminaton Center (دفنر)</label>
                                                <input type="text" name="exam_center" id="exam_center" class="form-control" placeholder="امتحان مرکز" value="<?php echo $exam_info[0]['exam_center'];?>" autocomplete="off" >
                                            </div><!-- end group for examination center -->

                                        </div>
                                    </div><!-- /.row (nested) -->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-info btn-sm fa fa-check"> Update</button>
                                            <button type="button" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url()?>admin/viewAllExams'"> Back</button>
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