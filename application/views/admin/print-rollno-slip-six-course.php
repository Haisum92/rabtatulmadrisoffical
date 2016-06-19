<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Roll No Slips</title>
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
	margin:auto;
	padding-bottom: 20px;
}
.title {
	font-size:36px;
}
.pad {
padding: 10px;
	/*  margin-bottom: 34px;*/
	  width: 700px;
	  margin: 50px auto 20px;
}
#dostyle{
font-family: "Alvi Nastaleeq", Verdana, Arial, Helvetica, sans-serif;
color: 
black;
font-size: 15px;
direction: rtl;
}
body {
  font-family: "Alvi Nastaleeq",Helvetica,Arial,sans-serif;
  font-size: 16px;
  line-height: 1.42857143;
  color: #333;
  background-color: #fff;
  }
</style>
</head>

<body>
<?php //echo '<pre>';print_r($exam_student_array); echo '</pre>';//die();?>
<?php if(count($exam_student_array) > 0){?>
<?php $count = 1; foreach ($exam_student_array as $key => $esinfo) {?>
		<div class="pad border">
  <table width="100%" border="0">
    <tbody><tr>
      <td class="centerAlign title" style="font-size:30px">رابطۃ المدارس الاسلامیہ پاکستان</td>
    </tr>
    <tr>
      <td class="centerAlign"><?php echo $esinfo['exam_type_name_urdu'].' '.$esinfo['exam_name'];?></td>
    </tr>
  </tbody></table>
  <table style="padding-bottom:30px;" width="100%" border="0">
    <tbody><tr>
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
 </table>
 <?php if($esinfo['exam_type_id'] == 2){?>

 	<div class="tablee">
	    <table width="100%" border="0" cellspacing="0">
	      <tbody>
		      <tr>
		        <td width="33.3%" class="border centerAlign">وقت</td>
		        <td width="33.3%" class="border centerAlign">تاریخ</td>
		        <td width="33.3%" class="border centerAlign">مضمون</td>
		      </tr>
		     <?php $sub_name_urdu =  explode(',', $esinfo['sub_name_urdu']);
		      		$subject_id =  explode(',', $esinfo['sub_id']);
		      		// var_dump($sub_name_urdu);
		      		// var_dump($subject_id);
		      		$ci =&get_instance();
					$ci->load->model('admin_model');
		      	foreach($sub_name_urdu AS $key => $sub){
		      	$response = $ci->admin_model->searcharray($subject_id[$key],'exam_subject_id',$exam_date_sheet);
		      	?>
		      	<tr>
			        <?php if($exam_date_sheet[$response]['exam_appearance_time'] == 'first_time'){?>
			        	<td class="border centerAlign" dir="rtl"><?php echo $exam_date_sheet[$response]['exam_time'].'بجے صبح';?></td>
			        	<td class="border centerAlign"><?php echo $exam_date_sheet[$response]['exam_date'];?></td>
			        	<td class="border centerAlign"><?php echo $sub;?></td>
			        <?php }else{?>
			        	<td class="border centerAlign" dir="rtl"><?php echo $exam_date_sheet[$response]['exam_time'].'بجے دوپہر';?></td>
			        	<td class="border centerAlign"><?php echo $exam_date_sheet[$response]['exam_date'];?></td>
			        	<td class="border centerAlign"><?php echo $sub;?></td>
			        <?php }?>
			    </tr>

		      <?php }?>
		      		  
	      	  <tr>
		        <td colspan="1" class="centerAlign">ختم&nbsp;الرابطہ</td>
		        <td colspan="1">&nbsp;</td>
		        <td colspan="1" class="centerAlign">توقیع&nbsp;مراقب&nbsp;الامتحان</td>
		      </tr>
	    	</tbody>
	    </table>
	  </div>

 <?php }else{?>

 <?php //echo '<pre>';print_r($exam_date_sheet);echo '</pre>';?>
  <div class="tablee">
    <table width="100%" border="0" cellspacing="0">
      <tbody>
	      <tr>
	        <td width="33.3%" class="border centerAlign">وقت</td>
	        <td width="33.3%" class="border centerAlign">تاریخ</td>
	        <td width="33.3%" class="border centerAlign">مضمون</td>
	      </tr>
	     	<?php
		      	// echo '<pre>';print_r($exam_date_sheet);echo '</pre>';
	     		if($esinfo['subject_id'] != "" && !empty($esinfo['subject_id'])){

	     			$std_exam_dates = explode(",",$esinfo['subject_id']);
	     			
	     			foreach($exam_date_sheet AS $key => $ds){?>
		      		
		      			<?php if(in_array($ds['exam_subject_id'], $std_exam_dates)){?>
				      		<tr>
				      			<?php if($ds['exam_appearance_time'] == 'first_time'){?>
				      				<!-- <td class="border centerAlign">بجے صبح &nbsp;&nbsp;&nbsp;<?php echo $ds['exam_time'];?></td> -->
				      				<td class="border centerAlign">صبح &nbsp;&nbsp;&nbsp;<?php echo $ds['exam_time'];?></td>
				      			<?php }else{ ?>
				      				<!-- <td class="border centerAlign">بجے دوپہر &nbsp;<?php echo $ds['exam_time'];?></td> -->
				      				<td class="border centerAlign">دوپہر &nbsp;<?php echo $ds['exam_time'];?></td>
				      			<?php }?>
						        
						        <td class="border centerAlign"><?php echo date("d-m-Y",strtotime($ds['exam_date']));?></td>
						        <td class="border centerAlign"><?php echo $ds['sub_name_urdu']?></td>
						    </tr>
						<?php } // END IF FOR IN ARRAY CHECK?>

					 <?php } // END FOREACH LOOP?>   

	     		<?php  }else{ ?>
	     		
			      	<?php foreach($exam_date_sheet AS $key => $ds){?>
			      		
			      		<tr>
			      			<?php if($ds['exam_appearance_time'] == 'first_time'){?>
			      				<!-- <td class="border centerAlign">بجے صبح &nbsp;&nbsp;&nbsp;<?php echo $ds['exam_time'];?></td> -->
			      				<td class="border centerAlign">صبح &nbsp;&nbsp;&nbsp;<?php echo $ds['exam_time'];?></td>
			      			<?php }else{ ?>
			      				<!-- <td class="border centerAlign">بجے دوپہر &nbsp;<?php echo $ds['exam_time'];?></td> -->
			      				<td class="border centerAlign">دوپہر &nbsp;<?php echo $ds['exam_time'];?></td>
			      			<?php }?>
					        
					        <td class="border centerAlign"><?php echo date("d-m-Y",strtotime($ds['exam_date']));?></td>
					        <td class="border centerAlign"><?php echo $ds['sub_name_urdu']?></td>
					    </tr>

			      	<?php }?>

			    <?php }?>
	      <!-- <tr>
	        <td class="border centerAlign">بجے صبح 8:00</td>
	        <td class="border centerAlign">16-05-2015</td>
	        <td class="border centerAlign"><?php echo $exam_subject[0]['sub_name_urdu']?></td>
	      </tr>
          <tr>
	        <td class="border centerAlign">بجے صبح 8:00</td>
	        <td class="border centerAlign">17-05-2015</td>
	        <td class="border centerAlign"><?php echo $exam_subject[1]['sub_name_urdu'];?></td>
	      </tr>
          <tr>
	        <td class="border centerAlign">بجے صبح 8:00</td>
	        <td class="border centerAlign">18-05-2015</td>
	        <td class="border centerAlign"><?php echo $exam_subject[2]['sub_name_urdu'];?></td>
	      </tr>
	      <tr>
	        <td class="border centerAlign">بجے صبح 8:00</td>
	        <td class="border centerAlign">19-05-2015</td>
	        <td class="border centerAlign"><?php echo $exam_subject[5]['sub_name_urdu'];?></td>
	      </tr>
	      <tr>
	        <td class="border centerAlign">بجے صبح 8:00</td>
	        <td class="border centerAlign">20-05-2015</td>
	        <td class="border centerAlign"><?php echo $exam_subject[3]['sub_name_urdu'];?></td>
	      </tr>
	      <tr>
	        <td class="border centerAlign">بجے صبح 8:00</td>
	        <td class="border centerAlign">21-05-2015</td>
	        <td class="border centerAlign"><?php echo $exam_subject[4]['sub_name_urdu'];?></td>
	      </tr> -->
	      
	      </tr>
      	  <tr>
	        <td colspan="1" class="centerAlign">ختم&nbsp;الرابطہ</td>
	        <td colspan="1">&nbsp;</td>
	        <td colspan="1" class="centerAlign">توقیع&nbsp;مراقب&nbsp;الامتحان</td>
	      </tr>
    	</tbody>
    </table>
  </div>
  <?php }?>
</div>
	<?php if( ($count %2 == 0) ){?>
    	<div style="page-break-after:always"></div>
  	<?php }// end check for $key ?>

<?php $count++;}// end foreach?>
<?php }else{
	echo "<p align=center>کوئ طالبعلم موجود نھیں ہے</p>";		
}?>
</body>
</html>