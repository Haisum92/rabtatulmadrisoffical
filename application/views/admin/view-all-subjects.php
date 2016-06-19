<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>

            
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">تمام مضامن کو دیکھیں</h1>
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
                                <?php if($subject_array != NULL){?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th class="center">مضامین کی تعداد</th>
                                            <th class="center">نام</th>
                                            <th class="center">کلاس</th>
                                            <th class="center">نمبر</th>
                                            <th class="center">کیفیت</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php //echo '<pre>';print_r($exam_array);echo '</pre>';die();?>
                                    <?php foreach ($subject_array as $key => $sub) { ++$key;?>
                                        <tr class="odd <?php if($key%2 == 0){?>even<?php }else{?>odd<?php }?>">
                                            <td class="center"><?php echo $key;?></td>
                                            <td class="center"><?php echo $sub['sub_name_urdu'];?></td>
                                            <td class="center"><?php echo $sub['class_name_urdu'];?></td>
                                            <td class="center"><?php echo $sub['total_marks'];?></td>
                                            <td class="center">
                                                <a href="<?php echo base_url();?>admin/editSubject/<?php echo $sub['sub_id'];?>"><button type="button" class="btn btn-warning btn-sm">ترمیم</button></a>
                                                <a href="<?php echo base_url();?>admin/deleteSubject/<?php echo $sub['sub_id'];?>" onclick="return confirm('کیا آپ مضمون کو ختم کرنا چاہتے ہیں؟');"><button type="button" class="btn btn-danger btn-sm">خارج</button></a>
                                            
                                            </td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>

                                <?php }else{?>
                                    <div class="alert alert-danger">
                                        <?php echo "کوئ مضمون موجود نہیں ھے";?>
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
