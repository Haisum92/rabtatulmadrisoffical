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
                                
                            <div class="dataTable_wrapper">
                            <?php if($students_info != "" and !empty($students_info)){?>
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
                                    <?php
                                        foreach ($students_info as $key => $student) {?>
                                            <tr class="odd gradeX">
                                                <td class="center"><?php echo ++$key;?></td>
                                                <td class="center"><?php echo $student['std_name'];?></td>
                                                <td class="center"><?php echo $student['std_father_name'];?></td>
                                                <td class="center"><?php echo $student['std_id_card_no'];?></td>
                                                <td class="center"><?php echo $student['std_dob_urdu'];?></td>
                                                <td class="center">
                                                    <a href="<?php echo base_url();?>admin/viewTenCourseStudentFemale/<?php echo $student['std_id'];?>"><button type="button" class="btn btn-info">تفصیل</button></a>
                                                    <a href="<?php echo base_url();?>admin/editStudent/<?php echo $student['std_id'];?>"><button type="button" class="btn btn-warning">ترمیم</button></a>
                                                    <a href="<?php echo base_url();?>admin/deleteStudent/<?php echo $student['std_id'];?>" onclick="return confirm('آپ طالب علم کے ریکارڈ کو ختم کرنا چاہتے ہیں?');"><button type="button" class="btn btn-danger">خارج</button></a>
                                                </td>
                                            </tr>

                                            <?php }?>

                                    </tbody>
                                </table>
                            <?php }else{?>
                                <div class="alert alert-danger">
                                        <?php echo 'کوئی طالب علم موجود نہیں ہے';?>
                                    </div>
                            <?php }?>
                                    
                            </div>
                            <!-- /.table-responsive -->
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
