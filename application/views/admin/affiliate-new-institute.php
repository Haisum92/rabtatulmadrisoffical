<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>
			<!-- BEGIN PAGE CONTENT -->

             <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">نے مدرسے کا الحاق</h1>
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
    							$attribute = array('class' => 'web_form','id' => 'affiliate_new_institute', 
                                                   'name' => 'affiliate_new_institute', 'role' => 'form'
                                                 );
        						  echo form_open_multipart('admin/affiliateNewInstitute/',$attribute) ?>
                                    <div class="row">

                                        <div class="col-md-12">
                                            
                                            <div class="col-md-6">
                                               <div class="form-group">
                                                    <label>Registration No: (رجسٹریشن نمبر)</label>
                                                    <input type="text" name="registration_no" placeholder="ادارہ کا رجسٹریشن نمبر" class="form-control" id="registration_no" value="<?php echo set_value('registration_no');?>" autofocus=""/>
                                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                               </div><!-- end group for examinatio center name -->
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Affiliation Grade: (درجہ الحاق)</label>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="affiliation_grade" id="affiliation_grade_0" value="grade0">حفظ القرآن</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="affiliation_grade" id="affiliation_grade_1" value="grade1">تجوید و قرات</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="affiliation_grade_2" id="affiliation_grade_2" value="grade2" onclick="enableClassGradeType(this);">درس نظامی</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select name="class_grade_type" id="class_grade_type" class="form-control form-select" disabled="disabled">
                                                                <option value="grade3" selected="selected">متوسطہ</option>
                                                                <option value="grade4">ثانویہ عامہ</option>
                                                                <option value="grade5">ثانویہ خاصہ</option>
                                                                <option value="grade6">عالیہ</option>
                                                                <option value="grade7">عالمیہ</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div><!-- end group for class_name  no -->
                                            </div>

                                        </div><!-- end col-md-12-->

                                        <div class="col-md-12">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Full Name of Institute: (ادارہ کا مکمل نام)</label>
                                                    <input type="text" name="institute_full_name" id="institute_full_name" class="form-control" placeholder="ادارہ کا پورا نام" value="<?php echo set_value('institute_full_name');?>" autocomplete="off" >
                                                </div><!-- end group for reg_no -->
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Short Name of Institute: (ادارہ کا مختصر نام)</label>
                                                    <input type="text" name="institute_short_name" id="institute_short_name" class="form-control" placeholder="ادارہ کا مختصر نام" value="<?php echo set_value('institute_short_name')?>" autocomplete="off" >
                                                </div><!-- end group for roll no -->
                                            </div>

                                        </div><!-- end col-md-6-->

                                        <div class="col-md-12">
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Institute Owner Name: (مہتمم /ناظم کا نام )</label>
                                                    <input type="text" name="institute_owner_name" id="institute_owner_name" class="form-control" placeholder="مہتمم/ناظم کا نام" value="<?php echo set_value('institute_owner_name');?>" autocomplete="off" >
                                                </div><!-- end group for identity card no -->
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Province Name: (صوبہ کا نام)</label>
                                                    <select name="institute_province" id="institute_province" class="form-control form-select">
                                                        <option value="" selected="selected">-- --</option>
                                                        <?php if($province_array != ""){?>
                                                        <?php foreach ($province_array as $key => $prov) {?>
                                                            <option value="<?php echo $prov['prov_id'];?>"><?php echo $prov['prov_name_urdu'];?></option>
                                                        <?php }?>
                                                        <?php }// end foreach?>
                                                    </select>    
                                                </div><!-- end group for father name no -->
                                            </div>

                                        </div>

                                        <div class="col-md-12">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>District: (تحصیل)</label>
                                                    <select name="institute_district" id="institute_district" class="form-control form-select">
                                                        <option value="" selected="selected">-- --</option>
                                                    </select>
                                                </div><!-- end group for identity card -->
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Address: (پتہ)</label>
                                                    <textarea name="institute_address" id="institute_address" class="form-control"><?php echo set_value('institute_address');?></textarea>
                                                </div><!-- end group for dob_eng  -->
                                            </div>

                                        </div><!-- .col-lg-12-->

                                        <div class="col-md-12">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone No: (فون نمبر)</label>
                                                    <input type="text" name="institute_phone_no" id="institute_phone_no" class="form-control" placeholder="فون نمبر" value="<?php echo set_value('institute_phone_no');?>" autocomplete="off" >
                                                </div><!-- end group for identity card -->
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Mobile No: (موبائل نمبر)</label>
                                                    <input type="text" name="institute_mobile_no" id="institute_mobile_no" class="form-control" placeholder="موبائل نمبر" value="<?php echo set_value('institute_mobile_no');?>" autocomplete="off" >
                                                </div><!-- end group for instiute mobile no  -->
                                            </div>

                                        </div><!-- .col-lg-12-->

                                        <div class="col-md-12">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Affiliation Date: (تاریخ الحاق)</label>
                                                    <input type="date" name="date_of_affiliation" id="date_of_affiliation" class="form-control" placeholder="تاریخ الحاق" value="<?php echo set_value('date_of_affiliation');?>" autocomplete="off" >
                                                </div><!-- end group for identity card -->
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Affiliation From: (تاریخ تجد ید ازسال)</label>
                                                    <input type="text" name="institute_affiliation_from" id="institute_affiliation_from" class="form-control" placeholder="تاریخ تجد ید ازسال" value="<?php echo set_value('institute_affiliation_from');?>" autocomplete="off" >
                                                </div><!-- end group for instiute mobile no  -->
                                            </div>

                                        </div><!-- .col-lg-12-->

                                        <div class="col-md-12">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Affiliation To: (الحاق تا سال)</label>
                                                    <input type="text" name="institute_affiliation_to" id="institute_affiliation_to" class="form-control" placeholder="الحاق تا سال" value="<?php echo set_value('institute_affiliation_from');?>" autocomplete="off" >
                                                </div><!-- end group for instiute mobile no  -->
                                            </div>

                                            

                                        </div><!-- .col-lg-12-->

                                    </div><!-- /.row (nested) -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-lg-6">
                                                <button type="submit" class="btn btn-info btn-sm fa fa-check"> Submit</button>
                                                <button type="reset" class="btn btn-info btn-sm fa fa-arrow-left" onclick="window.location='<?php echo base_url();?>admin/viewAllAffliatedInstitues'">&nbsp;Back</button>
                                            </div>
                                        </div>
                                    </div><!-- /.row (nested) -->

                                </form><!-- end form -->

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