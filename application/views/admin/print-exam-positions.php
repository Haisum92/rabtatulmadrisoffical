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
                                <?php //echo '<pre>';print_r($exam_info); echo '</pre>';?>
                                <?php //echo '<pre>';print_r($position_response); echo '</pre>';
                                    $temp =  0;
                                    $pcount = 0;
                                ?>
                                <?php foreach ($position_response as $key => $prec) {?>

                                        <?php if($temp == 0){
                                             $temp = $prec['total_marks'];
                                        }
                                        // echo $temp.'<br/>';
                                        ?>

                                        <div class="row" style="text-align: center;">

                                        <?php if($key == 0){?>

                                                <div class="col-lg-12 center">
                                                    <strong> پہلی پوزیشن</strong>
                                                </div>
                                                <?php ++$pcount;?>

                                        <?php }elseif( ($prec['total_marks'] < $temp) and $pcount == 1 ){?>

                                                <?php $temp = $prec['total_marks'];?>
                                                <div class="col-lg-12 center">
                                                    <strong> دوسری پوزیشن</strong>
                                                </div>
                                                <?php ++$pcount;?>

                                        <?php }elseif( ($prec['total_marks'] < $temp) and $pcount == 2){?>

                                                <div class="col-lg-12 center">
                                                    <strong> تیسری پوزیشن</strong>
                                                </div>
                                                
                                                <?php ++$pcount;?>

                                        <?php }?>

                                                <div class="col-lg-12 center">
                                                    <?php if($prec['stud_image'] != ""){?>
                                                        <img src="<?php echo base_url();?>student_images/<?php echo $prec['stud_image'];?>" width="150" height="150"/>
                                                    <?php }?>
                                                </div>
                                            <?php //echo $pcount;?>


                                        </div><!-- end row-->
                                        
                                            <!-- <div class="row" style="text-align: center;">

                                                <div class="col-lg-12 center">
                                                    <?php if($key == 0){?>
                                                       <strong> پہلی پوزیشن</strong>
                                                    <?php }elseif($key == 1){?>
                                                        <strong>دوسری پوزیشن</strong>
                                                    <?php }elseif($key == 2){?>
                                                        <strong>تیسری پوزیشن</strong>
                                                    <?php }?>
                                                </div>
                                                <div class="col-lg-12 center">
                                                    <?php if($prec['stud_image'] != ""){?>
                                                        <img src="<?php echo base_url();?>student_images/<?php echo $prec['stud_image'];?>" width="150" height="150"/>
                                                    <?php }?>
                                                </div>

                                            </div> -->
                                            <div class="row" dir="rtl">

                                                <div class="col-lg-12">
                                                   <strong> نام</strong> : <?php echo $prec['stud_name'];?>
                                                </div>
                                                <div class="col-lg-12">
                                                    <strong>رول نمبر</strong> : <?php echo $prec['stud_rollno'];?>
                                                </div>
                                                <div class="col-lg-12">
                                                    <strong>رجسٹریشن نمبر</strong> : <?php echo $prec['stud_regno'];?>
                                                </div>
                                                <div class="col-lg-12">
                                                   <strong>اسم الجامعۃ</strong> : <?php echo $prec['affli_shortname'];?>
                                                </div>
                                                <div class="col-lg-12">
                                                    <strong>نمبر</strong> : <?php echo $prec['total_marks'];?>
                                                </div>
                                                <div class="col-lg-12">
                                                    <strong>نمبر</strong> : <?php 
                                                    if($exam_grade == "grade3"){
                                                        $percent = ( ($prec['total_marks'] / 600) * 100);
                                                        echo round($percent,2);
                                                    }elseif($exam_grade == "grade4"){
                                                        $percent = ( ($prec['total_marks'] / 1000) * 100);
                                                        echo round($percent,2);
                                                    }?>
                                                </div>


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