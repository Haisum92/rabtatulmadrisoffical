<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>

            
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">تمام طلباء کو دیکھیں</h1>
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
                        <!-- /.panel-heading -->
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
                                    <div class="col-lg-6">
                                        <form class="navbar-form navbar-left" role="search" name="search_student_by_registration_no" id="search_student_by_registration_no" method="post">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="ریجسٹریشن نمبر سے تلاش کریں" name="registeration_no" id="registeration_no" class="search_name">
                                                <button type="submit" class="btn btn-info">Search</button>
                                            </div>
                                        </form>
                                    </div><!-- /.col-lg-3-->
                                    <div class="col-lg-6">
                                        <form class="navbar-form navbar-left" role="search" name="search_student_by_roll_no" id="search_student_by_roll_no" method="post">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="رول نمبر سے تلاش کریں" name="roll_no" id="roll_no" class="search_name">
                                                <button type="submit" class="btn btn-info">Search</button>
                                            </div>
                                        </form>
                                    </div><!-- /.col-lg-3-->
                                </div>
                                <?php if($students_info !=  NULL){?>

                                    <div class="dataTable_wrapper">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th class="center">طالب علم کی تعداد</th>
                                                    <th class="center">نام</th>
                                                    <th class="center">والد کا نام</th>
                                                    <th class="center">شناختی کارڈ نمبر</th>
                                                    <th class="center">تاریخ پیدائش</th>
                                                    <th class="center">کیفیت</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($students_info as $key => $student) {?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?php echo ++$key;?></td>
                                                    <td class="center"><?php echo $student['std_name'];?></td>
                                                    <td class="center"><?php echo $student['std_father_name'];?></td>
                                                    <td class="center"><?php echo $student['std_id_card_no'];?></td>
                                                    <td class="center"><?php echo $student['std_dob_urdu'];?></td>
                                                    <td class="center">
                                                        <a href="<?php echo base_url();?>admin/viewStudent/<?php echo $student['std_id'];?>"><button type="button" class="btn btn-info">تفصیل</button></a>
                                                        <a href="<?php echo base_url();?>admin/editStudent/<?php echo $student['std_id'];?>"><button type="button" class="btn btn-warning">ترمیم</button></a>
                                                        <a href="<?php echo base_url();?>admin/deleteStudent/<?php echo $student['std_id'];?>/<?php echo $exam_id.'/'.$exam_type;?>" onclick="return confirm('آپ طالب علم کے ریکارڈ کو ختم کرنا چاہتے ہیں?');"><button type="button" class="btn btn-danger">خارج</button></a>
                                                        <?php if($no_subject == 1){?>
                                                            <?php if($exam_type == 2){?>
                                                                <a href="<?php echo base_url();?>admin/viewOneResult/<?php echo $exam_id.'/'.$exam_type.'/'.$student['std_id'];?>"><button type="button" class="btn btn-success">رزلٹ</button></a>
                                                            <?php }else{?>
                                                                <a href="<?php echo base_url();?>admin/viewOneResult/<?php echo $exam_id.'/'.$exam_type.'/'.$student['std_id'];?>"><button type="button" class="btn btn-success">رزلٹ</button></a>
                                                            <?php }?>
                                                        <?php }elseif($no_subject == 6){?>                                                          
                                                            
                                                            <?php if($exam_type == 2){?>
                                                                <a href="<?php echo base_url();?>admin/viewSixResult/<?php echo $exam_id.'/'.$exam_type.'/'.$student['std_id'];?>"><button type="button" class="btn btn-success">رزلٹ</button></a>
                                                            <?php }else{?>
                                                                <a href="<?php echo base_url();?>admin/viewSixResult/<?php echo $exam_id.'/'.$exam_type.'/'.$student['std_id'];?>"><button type="button" class="btn btn-success">رزلٹ</button></a>
                                                            <?php }?>
                                                            
                                                        <?php }elseif($no_subject == 10){?>

                                                            <?php if($exam_type == 2){?>
                                                                <a href="<?php echo base_url();?>admin/viewTenResult/<?php echo $exam_id.'/'.$exam_type.'/'.$student['std_id'];?>"><button type="button" class="btn btn-success">رزلٹ</button></a>
                                                            <?php }else{?>
                                                                <a href="<?php echo base_url();?>admin/viewTenResult/<?php echo $exam_id.'/'.$exam_type.'/'.$student['std_id'];?>"><button type="button" class="btn btn-success">رزلٹ</button></a>
                                                            <?php }?>

                                                            
                                                        <?php }?>
                                                        
                                                    </td>
                                                </tr>
                                            <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                        <!-- /.table-responsive -->
                                        <?php if( (isset($_POST['registeration_no']) and $_POST['registeration_no'] == '')
                                                 || (isset($_POST['roll_no']) and $_POST['roll_no'] == '') 
                                                 || (!isset($_POST['roll_no']) and !isset($_POST['registeration_no']))){?>
                                            
                                            <?php echo $this->pagination->create_links();?>

                                        <?php }?>

                                <?php }else{ ?>

                                    <div class="alert alert-danger">
                                        <?php echo 'کوئ طالب علم موجود نہیں ہے';?>
                                    </div>

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
