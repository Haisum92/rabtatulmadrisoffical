<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/rabta/css/custom.css" type="text/css" />
<title>Six Course Attendance Sheet</title>
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
.borderBottom{
/*	border-bottom:solid;
	/*border-style:solid;*/
	/*border-width:1px;*/
	
}

.tablee {
	width: 600px;
	margin:auto;
}
.title {
	font-size:36px;
}
.pad {
	padding:10px;
	margin-bottom:35px;
}
.limited{
	margin-right:10px;
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
<?php
?>



  <?php 
  	if($student_data != NULL){
  		$count = 1;
  		// echo '<pre>';print_r($student_data);echo '</pre>';die();

  		if ($exam_type == 2) {
  			
  			foreach ($student_data as $key => $sinfo) {?>

			  	<div class="pad border">

				  	<table width="100%" border="0">
					    <tr>
					      <td class="centerAlign title">رابطہ المدارس الاسلامیہ پاکستان</td>
					    </tr>
					    <tr>
					      <td class="centerAlign"><?php echo $sinfo['exam_name'];?></td>
					    </tr>
					</table>
					<table style="padding-bottom:30px;" width="100%" border="0">
						    <tr>
						      	<td>&nbsp;</td>
						      	<?php if($sinfo['std_image'] != ""){?>
						      		<td width="15%" rowspan="4" class="border"><img src="<?php echo base_url();?>student_images/<?php echo $sinfo['std_image'];?>" width="90" height="100" /></td> 
						  		<?php }else{?>
						  			<td width="15%" rowspan="4" class="border">&nbsp;</td> 
						  		<?php }?>
						        
						      	<td>&nbsp;</td>
						      	<td class="centerAlign border"><?php echo $sinfo['std_reg_no'];?></td>
						      	<td>:رقم التسجیل</td>
						      	<td width="5%" class="centerAlign">&nbsp;</td>
						      	<td width="15%" class="centerAlign border"><?php echo $sinfo['std_roll_no'];?></td>
						      	<td class="centerAlign">&nbsp;</td>
						      	<td width="12%" class="rightAlign">:رقوم الجلوس</td>
						    </tr>
						    <tr>
						      	<td width="8%">&nbsp;</td>
							    <td width="6%">&nbsp;</td>
							    <td id="dostyle" width="20%" class="centerAlign border"><?php echo $sinfo['std_father_name'];?></td>
							    <td width="12%" class="leftAlign">:اسم الوالد</td>
							    <td id="dostyle" colspan="2" class="centerAlign border"><?php echo $sinfo['std_name'];?></td>
							    <td class="centerAlign">&nbsp;</td>
							    <td class="rightAlign">:اسم الطالب</td>
						    </tr>
						    <tr>
						      <td class="rightAlign">&nbsp;</td>
						      <td class="rightAlign">&nbsp;</td>
						      <td colspan="4" class="centerAlign"></td>
						      <td width="0%">&nbsp;</td>
						      <td class="rightAlign"></td>
						    </tr>
						    <tr>
						      <td class="rightAlign">&nbsp;</td>
						      <td class="rightAlign">&nbsp;</td>
						      <td colspan="4" class="centerAlign border"><?php echo $sinfo['exam_center_name_urdu'];?></td>
						      <td>&nbsp;</td>
						      <td class="rightAlign">مرکز الامتحان</td>
						    </tr>
					</table>
					<div class="tablee">
					    <table width="100%" border="0" cellspacing="0">
					      <tr>
					        <td id="dostyle" width="32%" class="centerAlign">دستخط(طالب علم) </td>
					        <td id="dostyle" width="35%" class="centerAlign">سیریل نمبر(جوابی کاپی)</td>
					        <td  id="dostyle" width="33%" class="centerAlign">تاریخ</td>
					      </tr>
					      <?php $student_subjects = explode(',', $sinfo['sub_name_urdu']);
					      		$exam_date = explode(',', $sinfo['exam_date']);
					      	//echo '<pre>';print_r($student_subjects);echo '</pre>';
					      	foreach ($student_subjects as $key => $value) {?>
								<tr>
							        <td class="centerAlign borderBottom">___________________</td>
							        <td class="centerAlign borderBottom">___________________</td>
							        <td class="centerAlign"><?php echo $exam_date[$key];?></td>
							    </tr>					      		
					      	<?php }
					      ?>    
						  <tr>
					        <td class="centerAlign borderBottom">&nbsp;</td>
					        <td class="centerAlign borderBottom">&nbsp;</td>
					        <td class="centerAlign">&nbsp;</td>
					      </tr>
					                                 
					      <tr>
					        <td class="centerAlign borderBottom">&nbsp;</td>
					        <td class="centerAlign borderBottom">&nbsp;</td>
					        <td class="centerAlign">&nbsp;</td>
					      </tr>
					     
					      <tr>
					        <td class="leftAlign">ختم الرابطہ</td>
					        <td>&nbsp;</td>
					        <td class="centerAlign"><img src="/rabta/images/signature.png" class="sig" /> توقیع مراقب الامتحان</td>
					      </tr>
					    </table>
					</div>
			  	
			  	</div>

			  	<?php if($count %2 ==0){?>
						<div style="page-break-after:always"></div>
			  	<?php }?>
	  
	  		<?php $count++; } // end foreach ?>

  		<?php }else{

  			foreach ($student_data as $key => $sinfo) {?>

			  	<div class="pad border">

				  	<table width="100%" border="0">
					    <tr>
					      <td class="centerAlign title">رابطہ المدارس الاسلامیہ پاکستان</td>
					    </tr>
					    <tr>
					      <td class="centerAlign"><?php echo $sinfo['exam_name'];?></td>
					    </tr>
					</table>
					<table style="padding-bottom:30px;" width="100%" border="0">
						    <tr>
						      	<td>&nbsp;</td>
						      	<?php if($sinfo['std_image'] != ""){?>
						      		<td width="15%" rowspan="4" class="border"><img src="<?php echo base_url();?>student_images/<?php echo $sinfo['std_image'];?>" width="90" height="100" /></td> 
						  		<?php }else{?>
						  			<td width="15%" rowspan="4" class="border">&nbsp;</td> 
						  		<?php }?>
						        
						      	<td>&nbsp;</td>
						      	<td class="centerAlign border"><?php echo $sinfo['std_reg_no'];?></td>
						      	<td>:رقم التسجیل</td>
						      	<td width="5%" class="centerAlign">&nbsp;</td>
						      	<td width="15%" class="centerAlign border"><?php echo $sinfo['std_roll_no'];?></td>
						      	<td class="centerAlign">&nbsp;</td>
						      	<td width="12%" class="rightAlign">:رقوم الجلوس</td>
						    </tr>
						    <tr>
						      	<td width="8%">&nbsp;</td>
							    <td width="6%">&nbsp;</td>
							    <td id="dostyle" width="20%" class="centerAlign border"><?php echo $sinfo['std_father_name'];?></td>
							    <td width="12%" class="leftAlign">:اسم الوالد</td>
							    <td id="dostyle" colspan="2" class="centerAlign border"><?php echo $sinfo['std_name'];?></td>
							    <td class="centerAlign">&nbsp;</td>
							    <td class="rightAlign">:اسم الطالب</td>
						    </tr>
						    <tr>
						      <td class="rightAlign">&nbsp;</td>
						      <td class="rightAlign">&nbsp;</td>
						      <td colspan="4" class="centerAlign"></td>
						      <td width="0%">&nbsp;</td>
						      <td class="rightAlign"></td>
						    </tr>
						    <tr>
						      <td class="rightAlign">&nbsp;</td>
						      <td class="rightAlign">&nbsp;</td>
						      <td colspan="4" class="centerAlign border"><?php echo $sinfo['exam_center_name_urdu'];?></td>
						      <td>&nbsp;</td>
						      <td class="rightAlign">مرکز الامتحان</td>
						    </tr>
					</table>
					<div class="tablee">
					    <table width="100%" border="0" cellspacing="0">
					      <tr>
					        <td id="dostyle" width="32%" class="centerAlign">دستخط(طالب علم) </td>
					        <td id="dostyle" width="35%" class="centerAlign">سیریل نمبر(جوابی کاپی)</td>
					        <td  id="dostyle" width="33%" class="centerAlign">تاریخ</td>
					      </tr>
					      <tr>
					        <td class="centerAlign borderBottom">___________________</td>
					        <td class="centerAlign borderBottom">___________________</td>
					        <td class="centerAlign"><?php echo '30-04-2016';?></td>
					      </tr>
					      <tr>
					        <td class="centerAlign borderBottom">___________________</td>
					        <td class="centerAlign borderBottom">___________________</td>
					        <td class="centerAlign"><?php echo '01-05-2016';?></td>
					      </tr> 
					      <tr>
					        <td class="centerAlign borderBottom">___________________</td>
					        <td class="centerAlign borderBottom">___________________</td>
					        <td class="centerAlign"><?php echo '02-05-2016';?></td>
					      </tr> 
					      <tr>
					        <td class="centerAlign borderBottom">___________________</td>
					        <td class="centerAlign borderBottom">___________________</td>
					        <td class="centerAlign"><?php echo '03-05-2016';?></td>
					      </tr>    
					      <tr>
					        <td class="centerAlign borderBottom">___________________</td>
					        <td class="centerAlign borderBottom">___________________</td>
					        <td class="centerAlign"><?php echo '04-05-2016';?></td>
					      </tr> 
					      <tr>
					        <td class="centerAlign borderBottom">___________________</td>
					        <td class="centerAlign borderBottom">___________________</td>
					        <td class="centerAlign"><?php echo '05-05-2016';?></td>
					      </tr>    
						  <tr>
					        <td class="centerAlign borderBottom">&nbsp;</td>
					        <td class="centerAlign borderBottom">&nbsp;</td>
					        <td class="centerAlign">&nbsp;</td>
					      </tr>
					                                 
					      <tr>
					        <td class="centerAlign borderBottom">&nbsp;</td>
					        <td class="centerAlign borderBottom">&nbsp;</td>
					        <td class="centerAlign">&nbsp;</td>
					      </tr>
					     
					      <tr>
					        <td class="leftAlign">ختم الرابطہ</td>
					        <td>&nbsp;</td>
					        <td class="centerAlign"><img src="/rabta/images/signature.png" class="sig" /> توقیع مراقب الامتحان</td>
					      </tr>
					    </table>
					</div>
			  	
			  	</div>

			  	<?php if($count %2 ==0){?>
						<div style="page-break-after:always"></div>
			  	<?php }?>
	  
	  		<?php $count++; } // end foreach ?>

  		<?php } ?>

 		

  <?php }else{?>
  
	<div class='notfounderror' style='color:#FFF; font-size:30px; background:#F03; text-align:center; border:1px solid #F00; ; padding:10px 10px 10px 10px; '>حاضری کا ریکا رڈ موجود نہیں ہے</div>

  <?php }?>

					   
</body>
</html>