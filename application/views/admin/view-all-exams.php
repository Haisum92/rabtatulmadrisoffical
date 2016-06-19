<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>

            
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">تمام امتحان کو دیکھیں</h1>
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
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <!-- <th class="center">Sr#</th>
                                            <th class="center">Name</th>
                                            <th class="center">Class</th>
                                            <th class="center">Exam Type</th>
                                            <th class="center">Exam Year</th>
                                            <th class="center">Options</th> -->

                                            <th class="center">نمبر شمار</th>
                                            <th class="center">نام</th>
                                            <th class="center">کلا س</th>
                                            <th class="center">امتحان کی قسم</th>
                                            <th class="center">امتحانی سا ل</th>
                                            <th class="center">کیفیت</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php //echo '<pre>';print_r($exam_array);echo '</pre>';die();?>
                                    <?php foreach ($exam_array as $key => $exam) { ++$key;?>
                                        <tr class="odd <?php if($key%2 == 0){?>even<?php }else{?>odd<?php }?>">
                                            <td class="center"><?php echo $key;?></td>
                                            <td class="center"><?php echo $exam['exam_name'];?></td>
                                            <td class="center"><?php echo $exam['class_name_urdu'];?></td>
                                            <td class="center"><?php echo $exam['exam_type_name_urdu'];?></td>
                                            <td class="center"><?php echo $exam['exam_year_dominic'];?></td>
                                            <td class="center">
                                                <a href="<?php echo base_url();?>admin/viewExam/<?php echo $exam['exam_info_id'];?>"><button type="button" class="btn btn-info btn-sm">تفصیل</button></a>
                                                <a href="<?php echo base_url();?>admin/editExam/<?php echo $exam['exam_info_id'];?>"><button type="button" class="btn btn-warning btn-sm">ترمیم</button></a>
                                                <a href="<?php echo base_url();?>admin/DeleteExam/<?php echo $exam['exam_info_id'];?>" onclick="return confirm('آپ کو امتحان حذف کرنا چاہتے ہیں آپ کو یقین ہے؟');"><button type="button" class="btn btn-danger btn-sm">خارج</button></a>
                                            
                                            </td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
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
