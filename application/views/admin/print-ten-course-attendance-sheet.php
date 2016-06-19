<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="/rabta/css/custom.css" type="text/css" />
        <title>10 Course Attendance Sheet</title>
        <style type="text/css">
            .rightAlign {
                text-align: right;
            }
            .centerAlign {
                text-align: center;
            }
            .leftAlign {
                text-align: left;
            }
            .border {
                border-style:solid;
                border-width:1px;
            }
            .tablee {
                width: 600px;
                height:255px;
                margin:auto;
            }
            .title {
                font-size:36px;
            }
            .pad {
                padding:5px;
                margin-bottom:25px;
            }
            .borderBottom{
                border-bottom:solid;
                /*border-style:solid;*/
                border-width:1px;

            }
            .borderLeft{
                border-left:solid;
                /*border-style:solid;*/
                border-width:1px;

            }
            .borderRight{
                border-right:solid;
                /*border-style:solid;*/
                border-width:1px;

            }
            #dostyle{
                font-family: "Alvi Nastaleeq", Verdana, Arial, Helvetica, sans-serif;
                color: 
                    black;
                font-size: 16px;
                direction: rtl;
            }
        </style>
    </head>

    <body>
    <?php if($student_data != NULL){

        if ($exam_type == 2) {
        
            $count = 1;foreach($student_data AS $key => $sinfo){?>

                <div class="pad border">
                    <table width="100%" border="0">
                        <tr>
                            <td class="centerAlign title" style="font-size:32px;margin-top:5px;">رابطۃ المدارس الاسلامیہ پاکستان</td>
                        </tr>
                        <tr>
                            <td class="centerAlign"><?php echo $sinfo['exam_name']; ?></td>
                        </tr>
                    </table>
                    <table style="padding-bottom:15px;" width="100%" border="0">
                        <tr>
                            <td width="8%">&nbsp;</td>
                            <?php if($sinfo['std_image'] != ""){?>
                                <td width="15%" rowspan="4" class="border"><img src="<?php echo base_url();?>student_images/<?php echo $sinfo['std_image'];?>"width="90" height="100" /></td>
                            <?php } else { ?>
                                <td width="15%" rowspan="4" class="border"></td>
                            <?php } ?>
                            <td width="7%">&nbsp;</td>
                            <td class="centerAlign border"><?php echo $sinfo['std_reg_no']; ?></td>
                            <td>:رقم التسجیل</td>
                            <td width="5%" class="centerAlign">&nbsp;</td>
                            <td width="15%" class="centerAlign border"><?php echo $sinfo['std_roll_no']; ?></td>
                            <td class="centerAlign">&nbsp;</td>
                            <td width="10%" class="rightAlign">:رقوم الجلوس</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td id="dostyle" width="20%" class="centerAlign border"><?php echo $sinfo['std_father_name']; ?></td>
                            <td width="12%" class="leftAlign">:اسم الوالد</td>
                            <td id="dostyle" colspan="2" class="centerAlign border"><?php echo $sinfo['std_name']; ?></td>
                            <td class="centerAlign">&nbsp;</td>
                            <td class="rightAlign">:اسم الطالب</td>
                        </tr>
                        <tr>
                            <td class="rightAlign">&nbsp;</td>
                            <td class="rightAlign">&nbsp;</td>
                            <td colspan="4" class="centerAlign">&nbsp;</td>
                            <td width="0%">&nbsp;</td>
                            <td class="rightAlign">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="rightAlign">&nbsp;</td>
                            <td class="rightAlign">&nbsp;</td>
                            <td colspan="4" class="centerAlign border"><?php echo $sinfo['exam_center_name_urdu']; ?></td>
                            <td>&nbsp;</td>
                            <td class="rightAlign">مرکز الامتحان</td>
                        </tr>
                    </table>
                    <?php $exam_date = explode(',', $sinfo['exam_date']);?>
                    <div class="tablee" <?php if(count($exam_date) > 5){?> style="height:325px;" <?php }?>>
                        <table width="100%" border="0" cellspacing="">
                            <tr>
                                <td id="dostyle" colspan="2" class="border centerAlign">دستخط(طالب علم)</td>
                                <td id="dostyle" colspan="2" class="border centerAlign">سیریل نمبر(جوابی کاپی)</td>
                                <td width="20%" class="border centerAlign" id="dostyle">تاریخ</td>
                            </tr>
                            <tr>
                                <td id="dostyle" width="20%" class="borderLeft borderRight centerAlign borderBottom">عصری</td>
                                <td id="dostyle" width="20%" class="borderRight borderLeft borderBottom centerAlign">درس نظامی</td>
                                <td id="dostyle" width="20%" class="centerAlign borderBottom borderLeft borderRight">عصری</td>
                                <td id="dostyle" width="20%" class="borderLeft centerAlign borderRight borderBottom">درس نظامی</td>
                                <td class="border centerAlign">&nbsp;</td>
                            </tr>
                            <?php $student_subjects = explode(',', $sinfo['sub_name_urdu']);
                                  
                            //echo '<pre>';print_r($student_subjects);echo '</pre>';
                            foreach ($student_subjects as $key => $value) {?>
                                
                                <tr>
                                    <td class="borderLeft centerAlign borderBottom">&nbsp;</td>
                                    <td class="borderBottom borderRight centerAlign">&nbsp;</td>
                                    <td class="borderLeft centerAlign borderBottom">&nbsp;</td>
                                    <td class="borderBottom borderRight centerAlign">&nbsp;</td>
                                    <td class="border centerAlign"><?php echo $exam_date[$key]; ?></td>
                                </tr>

                            <?php }?>                                  

                            <tr style="height: 40px;">
                                <td colspan="2" class="centerAlign">ختم الرابطہ</td>
                                <td colspan="2">&nbsp;</td>
                                <td class="centerAlign">توقیع مراقب الامتحان</td>
                            </tr>
                        </table>
                        <img src="/rabta/images/signature.png" class="signew" />
                    </div>
               
                </div>
                                  
                <?php if($count %2 ==0){?>
                    <!-- || (count($exam_date) > 5) -->
                    <div style="page-break-after:always"></div>

                <?php }?>

            <?php $count++; } // end foreach?>

        <?php }else{?>

            <?php $count = 1;foreach($student_data AS $key => $sinfo){?>

                <div class="pad border">
                    <table width="100%" border="0">
                        <tr>
                            <td class="centerAlign title" style="font-size:32px;margin-top:5px;">رابطۃ المدارس الاسلامیہ پاکستان</td>
                        </tr>
                        <tr>
                            <td class="centerAlign"><?php echo $sinfo['exam_name']; ?></td>
                        </tr>
                    </table>
                    <table style="padding-bottom:15px;" width="100%" border="0">
                        <tr>
                            <td width="8%">&nbsp;</td>
                            <?php if($sinfo['std_image'] != ""){?>
                                <td width="15%" rowspan="4" class="border"><img src="<?php echo base_url();?>student_images/<?php echo $sinfo['std_image'];?>"width="90" height="100" /></td>
                            <?php } else { ?>
                                <td width="15%" rowspan="4" class="border"></td>
                            <?php } ?>
                            <td width="7%">&nbsp;</td>
                            <td class="centerAlign border"><?php echo $sinfo['std_reg_no']; ?></td>
                            <td>:رقم التسجیل</td>
                            <td width="5%" class="centerAlign">&nbsp;</td>
                            <td width="15%" class="centerAlign border"><?php echo $sinfo['std_roll_no']; ?></td>
                            <td class="centerAlign">&nbsp;</td>
                            <td width="10%" class="rightAlign">:رقوم الجلوس</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td id="dostyle" width="20%" class="centerAlign border"><?php echo $sinfo['std_father_name']; ?></td>
                            <td width="12%" class="leftAlign">:اسم الوالد</td>
                            <td id="dostyle" colspan="2" class="centerAlign border"><?php echo $sinfo['std_name']; ?></td>
                            <td class="centerAlign">&nbsp;</td>
                            <td class="rightAlign">:اسم الطالب</td>
                        </tr>
                        <tr>
                            <td class="rightAlign">&nbsp;</td>
                            <td class="rightAlign">&nbsp;</td>
                            <td colspan="4" class="centerAlign">&nbsp;</td>
                            <td width="0%">&nbsp;</td>
                            <td class="rightAlign">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="rightAlign">&nbsp;</td>
                            <td class="rightAlign">&nbsp;</td>
                            <td colspan="4" class="centerAlign border"><?php echo $sinfo['exam_center_name_urdu']; ?></td>
                            <td>&nbsp;</td>
                            <td class="rightAlign">مرکز الامتحان</td>
                        </tr>
                    </table>
                    <div class="tablee">
                        <table width="100%" border="0" cellspacing="">
                            <tr>
                                <td id="dostyle" colspan="2" class="border centerAlign">دستخط(طالب علم)</td>
                                <td id="dostyle" colspan="2" class="border centerAlign">سیریل نمبر(جوابی کاپی)</td>
                                <td width="20%" class="border centerAlign" id="dostyle">تاریخ</td>
                            </tr>
                            <tr>
                                <td id="dostyle" width="20%" class="borderLeft borderRight centerAlign borderBottom">عصری</td>
                                <td id="dostyle" width="20%" class="borderRight borderLeft borderBottom centerAlign">درس نظامی</td>
                                <td id="dostyle" width="20%" class="centerAlign borderBottom borderLeft borderRight">عصری</td>
                                <td id="dostyle" width="20%" class="borderLeft centerAlign borderRight borderBottom">درس نظامی</td>
                                <td class="border centerAlign">&nbsp;</td>
                            </tr>
                            
                            <tr>
                                <td class="borderLeft centerAlign borderBottom">&nbsp;</td>
                                <td class="borderBottom borderRight centerAlign">&nbsp;</td>
                                <td class="borderLeft centerAlign borderBottom">&nbsp;</td>
                                <td class="borderBottom borderRight centerAlign">&nbsp;</td>
                                <td class="border centerAlign"><?php echo '30-04-2016'; ?></td>
                            </tr>
                        
                            <tr>
                                <td class="borderLeft centerAlign borderBottom">&nbsp;</td>
                                <td class="borderBottom borderRight centerAlign">&nbsp;</td>
                                <td class="borderLeft centerAlign borderBottom">&nbsp;</td>
                                <td class="borderBottom borderRight centerAlign">&nbsp;</td>
                                <td class="border centerAlign"><?php echo '01-05-2016'; ?></td>
                            </tr>

                           
                            <tr>
                                <td class="borderLeft centerAlign borderBottom">&nbsp;</td>
                                <td class="borderBottom borderRight centerAlign">&nbsp;</td>
                                <td class="borderLeft centerAlign borderBottom">&nbsp;</td>
                                <td class="borderBottom borderRight centerAlign">&nbsp;</td>
                                <td class="border centerAlign"><?php echo '02-05-2016'; ?></td>
                            </tr>
                            <tr>
                                <td class="borderLeft centerAlign borderBottom">&nbsp;</td>
                                <td class="borderBottom borderRight centerAlign">&nbsp;</td>
                                <td class="borderLeft centerAlign borderBottom">&nbsp;</td>
                                <td class="borderBottom borderRight centerAlign">&nbsp;</td>
                                <td class="border centerAlign"><?php echo '03-05-2016'; ?></td>
                            </tr>
                            <tr>
                                <td class="borderLeft centerAlign borderBottom">&nbsp;</td>
                                <td class="borderBottom borderRight centerAlign">&nbsp;</td>
                                <td class="borderLeft centerAlign borderBottom">&nbsp;</td>
                                <td class="borderBottom borderRight centerAlign">&nbsp;</td>
                                <td class="border centerAlign"><?php echo '04-05-2016'; ?></td>
                            </tr>
                            <tr>
                                <td class="borderLeft centerAlign borderBottom">&nbsp;</td>
                                <td class="borderBottom borderRight centerAlign">&nbsp;</td>
                                <td class="borderLeft centerAlign borderBottom">&nbsp;</td>
                                <td class="borderBottom borderRight centerAlign">&nbsp;</td>
                                <td class="border centerAlign"><?php echo '05-05-2016'; ?></td>
                            </tr>  
                                    

                            <tr style="height: 40px;">
                                <td colspan="2" class="centerAlign">ختم الرابطہ</td>
                                <td colspan="2">&nbsp;</td>
                                <td class="centerAlign">توقیع مراقب الامتحان</td>
                            </tr>
                        </table>
                        <img src="/rabta/images/signature.png" class="signew" />
                    </div>
               
                </div>
                                  
                <?php if($count %2 ==0 ){?>

                    <div style="page-break-after:always"></div>

                <?php }?>

            <?php $count++; } // end foreach?>

        <?php }?>

    <?php }else{?>   

           <div class='notfounderror' style='color:#FFF; font-size:30px; background:#F03; text-align:center; border:1px solid #F00; ; padding:10px 10px 10px 10px; '>اس رول نمبر سلپ کا ریکا رڈ موجود نہیں</div>
    
    <?php }?> 

    </body>
</html>