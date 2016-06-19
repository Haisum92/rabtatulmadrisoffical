<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>

            
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">تمام امتحانی مراکز کو دیکھیں</h1>
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
                                            <th class="center">City Name Urdu</th>
                                            <th class="center">City Name English</th>
                                            <th class="center">District Province</th>
                                            <th class="center">Options</th> -->
                                            <th class="center">نمبر شما ر</th>
                                            <th class="center">مرکز کا نام اردو میں</th>
                                            <!-- <th class="center">مرکز کا نام انگریزی میں</th> -->
                                            <th class="center">صوبہ</th>
                                            <th class="center">شہر</th>
                                            <th class="center">کیفیت</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php //echo '<pre>';print_r($examinaiton_center_array);echo '</pre>';die();?>
                                    <?php foreach ($examinaiton_center_array as $key => $examcenter) { ++$key;?>
                                        <tr class="odd <?php if($key%2 == 0){?>even<?php }else{?>odd<?php }?>">
                                            <td class="center"><?php echo $key;?></td>
                                            <td class="center"><?php echo $examcenter['exam_center_name_urdu'];?></td>
                                            <!-- <td class="center"><?php echo $examcenter['exam_center_name_eng'];?></td> -->
                                            <td class="center"><?php echo $examcenter['prov_name_urdu'];?></td>
                                            <td class="center"><?php echo $examcenter['district_name_urdu'];?></td>
                                            <td class="center">
                                                <a href="<?php echo base_url();?>admin/viewExaminationCenter/<?php echo $examcenter['eci_id'];?>"><button type="button" class="btn btn-info btn-sm">تفصیل</button></a>
                                                <a href="<?php echo base_url();?>admin/editExaminationCenter/<?php echo $examcenter['eci_id'];?>"><button type="button" class="btn btn-warning btn-sm">ترمیم</button></a>
                                                <a href="<?php echo base_url();?>admin/deleteExaminationCenter/<?php echo $examcenter['eci_id'];?>" onclick="return confirm('آپ کو امتحان حذف کرنا چاہتے ہیں آپ کو یقین ہے؟');"><button type="button" class="btn btn-danger btn-sm">خارج</button></a>
                                            
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
