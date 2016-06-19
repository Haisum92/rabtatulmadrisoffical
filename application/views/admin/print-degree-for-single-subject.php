<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Sanad</title>
        <link rel="styelsheet" type="text/css" href="../../css/ArabicNaskhSSK/stylesheet.css">
        <style type="text/css">
            @media print{
                div.main_div {
                    page-break-after:always;}
            }
            .main_div{
                position: relative;
            }
            .degree_info{
                font-size: 18px;
				font-weight: bold;
                text-align:center;
                position: absolute;
                visibility: visible;

            }
			.degree_info_arabic{
				font-family:"Alvi Nastaleeq";
				direction: rtl;
                font-size: 19px;
				font-weight: bolder;
                text-align:center;
                position: absolute;
                visibility: visible;

            }
    #total_no {
        /*font-family: 'ArabicNaskhSSK';*/
    	width: 84px;
        left: 750px;
        top: 442px;
    }
    #hijri_date {
	    left: 766px;
        top: 421px;
        width: 98px;
    }
    #stud_name {
        left: 550px;
        top: 342px;
        width: 215px;
    }

    #stud_fathername {
        top: 344px;
        left: 346px;
        width: 213px;
    }
    #affli_shortname {
        font-size: 16px;
        left: 345px;
        top: 377px;
        width: 203px;
    }
    #stud_dob {
        font-family: 'ArabicNaskhSSK';
        left: 167px;
        top: 345px;
        width: 106px;
        font-weight: bold;
        font-size: 16px;
        direction: ltr;
    }

    #hijiridateminustwo {
        left: 185px;
        top: 360px;
        width: 90px;
    }
   #stud_grade  {
        left: 670px;
        top: 407px;
        width: 109px;
    }
    #english_date {
    	left: 598px;
        top: 421px;
        width: 104px;
    }
    #stud_regno {
    	font-weight: bold;
        left: 375px;
        top: 429px;
        width: 82px;
    }
    #stud_rollno {
	    font-weight: bold;
        left: 240px;
        top: 429px;
        width: 74px;
    }
    #exam_degreebcdate {
	    left: 646px;
        top: 537px;
        width: 91px;
    }
    #exam_resultbcdate {
    	left: 645px;
        top: 500px;
        width: 89px;
    }
    #office {
        font-size: 14px;
        left: 696px;
        top: 575px;
        width: 86px;
    }
    #exam_degreeabcdate {
	   left: 646px;
        top: 552px;
        width: 90px;
    }
    #exam_resultabcdate {
        left: 646px;
        top: 516px;
        width: 90px;
    }
    #stud_address{
        left: 590px;
        top: 362px;
        width: 212px;
    }

        </style>
    </head>

    <body>
    <?php 
    if ($student_record != NULL) {
        var_dump($student_record);die();
        foreach($student_record AS $key => $srecord){?>
            <div class="main_div">
            <img border="0" src="<?php echo base_url();?>assets/images/transparent.png" alt="Pulpit rock" width="954.5" height="705.5" />   
            <div class="degree_info" id="stud_address"><?php echo $srecord['std_address']; ?></div>
            <div class="degree_info_arabic" id="total_no"><?php 
            $numerial_no = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
            $arabic_no = array("۰", "۱", "۲", "۳", "٤", "۵", "٦", "۷", "۸", "۹");
            $total_marks_arabic = str_replace($numerial_no, $arabic_no, 100);
            $obtained_marks_arabic = str_replace($numerial_no, $arabic_no, $srecord['obtained_marks']);
            echo $obtained_marks_arabic.' / '.$total_marks_arabic; ?></div>
            <div class="degree_info" id="stud_name"><?php echo $srecord['std_name']; ?></div>
            <div class="degree_info" id="stud_fathername"><?php echo $srecord['std_father_name']; ?></div>
            <div class="degree_info" id="affli_shortname"><?php echo $srecord['affli_shortname']; ?></div>
            <?php 
            $dateofbirth_arabic = str_replace($numerial_no, $arabic_no, $srecord['std_dob_eng']);
            $dateofbirth_arabic = explode('-', $dateofbirth_arabic);
            // echo '<pre>';print_r($dateofbirth_arabic);echo '</pre>';
            $stud_dobinwords =  $dateofbirth_arabic[0].'/'. $dateofbirth_arabic[1].'/'.$dateofbirth_arabic[2].' م';
            // $stud_dobinwords = $dateofbirth_arabic[2] . "/" . $dateofbirth_arabic[1] . "/" . $dateofbirth_arabic[0] . " م"; /* yyyy/mm/dd */
            ?>
            <div class="degree_info_arabic" id="stud_dob"><?php echo $stud_dobinwords; ?></div>
            <div class="degree_info_arabic" id="hijiridateminustwo"><?php echo "۱٤۳٤ ھ"; ?></div>
            <?php //if ($subjects_totalmarks == 100) {
                if (($srecord['obtained_marks'] >= 40) && ($srecord['obtained_marks'] <= 49)) {
                    $grade_name = 'مقبول';
                } else if (($srecord['obtained_marks'] >= 50) && ($srecord['obtained_marks'] <= 59)) {
                    $grade_name = 'جید';
                } else if (($srecord['obtained_marks'] >= 60) && ($srecord['obtained_marks'] <= 69)) {
                    $grade_name = 'جیدجدا';
                } else if (($srecord['obtained_marks'] >= 70) && ($srecord['obtained_marks'] <= 100)) {
                    $grade_name = 'ممتاز';
                }
                $subjects_totalmarks = '۱۰۰';
            //}?>
            <div class="degree_info" id="stud_grade"><?php echo $grade_name; ?></div>
            <div class="degree_info_arabic" id="hijri_date"><?php echo $degree_date_dominic; ?></div>
            <div class="degree_info_arabic" id="english_date"><?php echo $degree_date_english; ?></div>
            <div class="degree_info" id="stud_regno"><?php echo $srecord['std_reg_no']; ?></div>
            <div class="degree_info" id="stud_rollno"><?php echo $srecord['std_roll_no']; ?></div>
            <div class="degree_info_arabic" id="exam_resultbcdate"><?php echo $srecord['exam_result_date_dominic']; ?></div>
            <div class="degree_info_arabic" id="exam_resultabcdate"><?php echo $srecord['exam_result_date_hijri']; ?></div>
            <div class="degree_info_arabic" id="exam_degreebcdate"><?php echo $srecord['exam_degree_date_dominic']; ?></div>
            <div class="degree_info_arabic" id="exam_degreeabcdate"><?php echo $srecord['exam_degree_date_hijri']; ?></div>
            <div class="degree_info" id="office">المنصورہ لاہور</div>
        </div>
        <?php }
    }else {?>
                <div class='notfounderror' style='color:#FFF; font-size:30px; background:#F03; text-align:center; border:1px solid #F00; ; padding:10px 10px 10px 10px; '>اس طالب علم کا ریکا رڈ موجود نہیں</div>
        <?php
    }?>
        

    </body>
</html>