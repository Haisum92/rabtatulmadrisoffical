<?php $this->load->view('admin/header');?>
<?php $this->load->view('admin/navigation');?>

            
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">تجوید القران کی ڈیٹ شیٹ بنائیں</h1>
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
                                <?php if (!empty($exam_center_array) and $exam_center_array != NULL) {?>
                                   
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th class="center">نمبر شما ر</th>
                                                <th class="center">امتحانی مرکز</th>
                                                <th class="center">تاریخ امتحان تجوید القران </th>
                                                <th class="center">کیفیت</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php //echo '<pre>';print_r($examinaiton_center_array);echo '</pre>';die();?>
                                        <?php foreach ($exam_center_array as $key => $einfo) { ++$key;?>
                                            <tr class="odd <?php if($key%2 == 0){?>even<?php }else{?>odd<?php }?>">
                                                <td class="center"><?php echo $key;?></td>
                                                <td class="center"><?php echo $einfo['exam_center_name_urdu'];?></td>
                                                <td class="center"><?php echo $einfo['tajweedulquran_exam_date'];?></td>
                                                <td class="center">
                                                    <!-- <a href="<?php echo base_url();?>admin/assignDateForHifzulQuran/<?php echo $record['echqed_id'];?>"><button type="button" class="btn btn-info btn-sm">ڑبٹ</button></a> -->
                                                    <a href="<?php echo base_url();?>admin/editDateSheetTajweedUlQuran/<?php echo $einfo['eci_id'];?>"><button type="button" class="btn btn-warning btn-sm">ترمیم</button></a>
                                                    <!-- <a href="<?php echo base_url();?>admin/deleteDateSheetHifzQuran/<?php echo $einfo['eci_id'];?>" onclick="return confirm('کیا اپ امتحانی تاریخ کتم کرنا چاھرے ھیں؟');"><button type="button" class="btn btn-danger btn-sm">خارج</button></a> -->
                                                
                                                </td>
                                            </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>

                                <?php }else{?>

                                    <div class="alert alert-danger">
                                        کوی ریکارڈ موجود نہیں ھے۔
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
