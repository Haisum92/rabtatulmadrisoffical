<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>

            
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">تمام الحاق شدہ مدارس کی لسٹ</h1>
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
                                            <th class="center">مدارس کی تعداد</th>
                                            <th class="center">نام</th>
                                            <th class="center">رجسٹریشں نمبر</th>
                                            <th class="center">نام مہتمم/ناظم</th>
                                            <th class="center">تاریخ الحاق</th>
                                            <th class="center">تجد ید الحاق</th>
                                            <th class="center">کیفیت</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php //echo '<pre>';print_r($institute_array);echo '</pre>';die();?>
                                    <?php foreach ($institute_array as $key => $institute) { ++$key;?>
                                        <tr class="odd <?php if($key%2 == 0){?>even<?php }else{?>odd<?php }?>">
                                            <td class="center"><?php echo $key;?></td>
                                            <td class="center" lang="ur"><?php echo $institute['affli_fullname'];?></td>
                                            <td class="center"><?php echo $institute['inst_reg_no'];?></td>
                                            <td class="center"><?php echo $institute['affli_ownername'];?></td>
                                            <td class="center"><?php echo $institute['affli_fromdate'];?></td>
                                            <td class="center"><?php echo $institute['affli_todate'];?></td>
                                            <td class="center">
                                                <a href="<?php echo base_url();?>admin/viewClass/<?php echo $institute['affli_id'];?>"><button type="button" class="btn btn-info btn-sm">تفصیل</button></a>
                                                <a href="<?php echo base_url();?>admin/editClass/<?php echo $institute['affli_id'];?>"><button type="button" class="btn btn-warning btn-sm">ترمیم</button></a>
                                                <a href="<?php echo base_url();?>admin/deleteClass/<?php echo $institute['affli_id'];?>" onclick="return confirm('آپ کو امتحان حذف کرنا چاہتے ہیں آپ کو یقین ہے؟');"><button type="button" class="btn btn-danger btn-sm">خارج</button></a>
                                            
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
