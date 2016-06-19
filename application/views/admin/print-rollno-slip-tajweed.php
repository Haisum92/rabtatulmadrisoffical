<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Tajweed-ul-Quran Roll No Slips</title>
<style type="text/css">
body{
  font-family: "Alvi Nastaleeq", Verdana, Arial, Helvetica, sans-serif;
}
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
    margin: 0 auto;
  /*padding-bottom: 10px;*/
}
.title {
  font-size:36px;
}
.pad {
    padding: 0px 10px 60px 10px;
    margin-top: 60px;
}
#dostyle{
font-family: "Alvi Nastaleeq", Verdana, Arial, Helvetica, sans-serif;
color: 
black;
font-size: 14px;
direction: rtl;
}
</style>
</head>

<body>

<?php if($exam_student_array != NULL){
  // echo '<pre>';print_r($exam_student_array);echo '</pre>';
  $count = 1; foreach ($exam_student_array as $key => $esinfo) {?>

	<div class="pad border">
      <table width="100%" border="0">
        <tbody>
          <tr>
            <td class="centerAlign title" style="font-size:25px">رابطۃ المدارس الاسلامیہ پاکستان</td>
          </tr>
          <tr>
            <td class="centerAlign"><?php echo $esinfo['exam_name'];?></td>
          </tr>
        </tbody>
      </table><!-- first table closed-->

      <table style="padding-bottom:5px;" width="100%" border="0">
        <tbody>
          <tr>
            <td width="8%">&nbsp;</td>
          	<td width="15%" rowspan="4" class="border">
          			<?php if($esinfo['std_image'] != ""){?>
          					<img src="<?php echo base_url();?>student_images/<?php echo $esinfo['std_image'];?>" alt="Student Image" width="90" height="100" />
          			<?php }?>
        		</td>  
            <td width="6%">&nbsp;</td>
            <td class="centerAlign border"><?php echo $esinfo['std_reg_no'];?></td>
            <td>:رقم التسجیل</td>
            <td width="5%" class="centerAlign">&nbsp;</td>
            <td width="15%" class="centerAlign border"><?php echo $esinfo['std_roll_no'];?></td>
            <td class="centerAlign">&nbsp;</td>
            <td width="10%" class="rightAlign">:رقوم الجلوس</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td id="dostyle" width="20%" class="centerAlign border"><?php echo $esinfo['std_father_name'];?></td>
            <td width="12%" class="leftAlign">:اسم&nbsp;الوالد</td>
            <td id="dostyle" colspan="2" class="centerAlign border"><?php echo $esinfo['std_name'];?></td>
            <td class="centerAlign">&nbsp;</td>
            <td class="rightAlign">:اسم الطالب</td>
          </tr>
          <tr>
            <td class="rightAlign">&nbsp;</td>
            <td class="rightAlign">&nbsp;</td>
            <td colspan="4" class="centerAlign border"><?php echo $esinfo['affli_fullname'];?></td>
            <td width="1%">&nbsp;</td>
            <td class="rightAlign">اسم&nbsp;المدرستہ</td>
          </tr>
          <tr>
            <td class="rightAlign">&nbsp;</td>
            <td class="rightAlign">&nbsp;</td>
            <td colspan="4" class="centerAlign border"><?php echo $esinfo['exam_center_name_urdu'];?></td>
            <td>&nbsp;</td>
            <td class="rightAlign">مرکز&nbsp;الامتحان</td>
          </tr>
        </tbody>
      </table><!-- second table closed-->


      <div class="tablee">

        <table width="100%" border="0" cellspacing="0">
          <tbody>
            <tr>
              <td width="33.3%" class="border centerAlign">وقت</td>
              <td width="33.3%" class="border centerAlign">تاریخ</td>
              <td width="33.3%" class="border centerAlign">مضمون</td>
            </tr>
            <tr>
              <td class="border centerAlign" style="padding-top: 10px;padding-bottom: 10px;">بجے صبح 8:00</td>
              <td class="border centerAlign" style="padding-top: 10px;padding-bottom: 10px;"><?php echo $esinfo['tajweedulquran_exam_date'];?></td>
              <td class="border centerAlign" style="padding-top: 10px;padding-bottom: 10px;"><?php echo 'تجوید القرآن'?></td>      
            </tr>
              <tr>
              <td colspan="1" class="centerAlign" style="padding-top: 30px;">ختم&nbsp;الرابطہ</td>
              <td colspan="1" style="padding-top: 30px;">&nbsp;</td>
              <td colspan="1" class="centerAlign" style="padding-top: 30px;">توقیع&nbsp;مدیر&nbsp;الامتحان</td>
            </tr>
         </tbody>
        </table><!-- third table closed-->

      </div><!-- .tablee closed-->

      <?php /*<div class="tablee">

        <table width="100%" border="0" cellspacing="0">
          <tbody>
    	      <tr>
    	        <td width="33.3%" class="border centerAlign">وقت</td>
    	        <td width="33.3%" class="border centerAlign">تاریخ</td>
    	        <td width="33.3%" class="border centerAlign">مضمون</td>
    	      </tr>
    	      <tr>
    	        <td class="border centerAlign">بجے صبح 8:00</td>
    	        <td class="border centerAlign"><?php echo $esinfo['tajweedulquran_exam_date'];?></td>
    	        <td class="border centerAlign"><?php echo $exam_subject[0]['sub_name_urdu']?></td>      
    	      </tr>
          	  <tr>
    	        <td colspan="1" class="centerAlign">ختم&nbsp;الرابطہ</td>
              <td colspan="1">&nbsp;</td>
              <td colspan="1" class="centerAlign">توقیع&nbsp;مدیر&nbsp;الامتحان</td>
    	      </tr>
         </tbody>
        </table><!-- third table closed-->

      </div><!-- .tablee closed-->*/?>

  </div>

  <?php if( ($count %2 == 0) ){?>
    <div style="page-break-after:always"></div>
  <?php }// end check for $key ?>

<?php $count++;}// endforeach

  }else{?>
      <div class="notfounderror" style="color:#FFF; font-size:30px; background:#F03; text-align:center; border:1px solid #F00; ; padding:10px 10px 10px 10px; ">کوئ طالبعلم موجود نھیں ہے</div>
  <?php }?>

</body>
</html>