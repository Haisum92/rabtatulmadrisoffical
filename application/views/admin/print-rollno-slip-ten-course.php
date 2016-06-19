<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Roll No Slips</title>
<style type="text/css">
body {
  font-family: "Alvi Nastaleeq",Helvetica,Arial,sans-serif;
  font-size: 16px;
  line-height: 1.42857143;
  color: #333;
  background-color: #fff;
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
	  margin: 10px auto 0px;
	  height: 420px;

}
.pad-odd {
	margin-bottom: 45px;
}
#dostyle{
font-family: "Alvi Nastaleeq", Verdana, Arial, Helvetica, sans-serif;
color: 
black;
font-size: 15px;
direction: rtl;
}
</style>
</head>

<body>
<?php 
	//echo '<pre>';print_r($exam_date_sheet);echo '</pre>';die();
	// echo '<pre>';print_r($exam_student_array);echo '</pre>';die();
	/*echo '<pre>';print_r($exam_date_sheet);echo '</pre>';	
	die();*/
	if($exam_student_array != NULL && count($exam_student_array) > 0){

$count = 1; foreach ($exam_student_array as $key => $esinfo) {?>
		<div class="pad border <?php echo $count % 2 == 1 ? 'pad-odd' : '' ?>">
  <table width="100%" border="0">
    <tbody><tr>
      <td class="centerAlign title" style="font-size:30px">رابطۃ المدارس الاسلامیہ پاکستان</td>
    </tr>
    <tr>
      <td class="centerAlign"><?php echo $esinfo['exam_name'];?></td>
    </tr>
  </tbody></table>
  <table style="padding-bottom:30px;" width="100%" border="0">
    <tbody><tr>
      <td width="8%">&nbsp;</td>
		<td width="8%" rowspan="4" class="border">
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
  <div class="tablee">
  <?php if($esinfo['exam_type_id'] == 2){?>

	   
	    <table width="100%" border="0" cellspacing="0">
	      <tbody>
		      <tr>
		        <td width="20%" class="border centerAlign">وقت</td>
		        <td width="20%" class="border centerAlign">الوقت الثانی</td>
		        <td width="20%" class="border centerAlign">وقت</td>
		        <td width="20%" class="border centerAlign">تاریخ</td>
		        <td width="20%" class="border centerAlign">مضمون</td>
		      </tr>
		      <?php $sub_name_urdu =  explode(',', $esinfo['sub_name_urdu']);
		      		$subject_id =  explode(',', $esinfo['sub_id']);
		      		$exam_date =  explode(',', $esinfo['exam_date']);
		      		// var_dump($sub_name_urdu);
		      		// die();
		      		// var_dump($exam_date);
		      		// /die();
		      		$ci =&get_instance();
					$ci->load->model('admin_model');
					$strFinal = "<tr>";
					$strStart = '<td class="border centerAlign">&nbsp;</td><td class="border centerAlign">&nbsp;</td>';
					$midArea = "";
					$prevDate = NULL;
					$i = 0;
					$loopcount = 0;
					$empty = true;
		      foreach($sub_name_urdu AS $key => $sub){// echo $sub;?>

		      	<?php 

		      			// echo 'subject_id'.$subject_id[$key].'<br/>';
		      			// echo $exam_date[$key].'<br/>';
		      			$response = $ci->admin_model->searcharray($subject_id[$key],'exam_subject_id',$exam_date_sheet);

		      			/*$nextdate = strtotime($exam_date[$key]);
		      					if (strtotime($prevDate) == $nextdate) {

		      						// die($loopcount.$sub);
		      						$i++;
		      						$temp = '<td class="border centerAlign">'.$exam_date_sheet[$response]['exam_date'].'</td>' .'<td class="border centerAlign">'.$sub.'</td>';
						        	$midArea = $temp .$midArea;
		      						$empty = false;	
		      						$loopcount++;

		      					}else{

		      						
		      						if ($loopcount == 0) {
		      							
		      							if($i == 0){

			      							if($exam_date_sheet[$response]['exam_appearance_time'] == 'first_time'){

			      								$midArea .= '<td class="border centerAlign" dir="rtl">'.$exam_date_sheet[$response]["exam_time"].'بجے صبح</td>';
			      								$midArea .= '<td class="border centerAlign">'.$exam_date_sheet[$response]['exam_date'].'</td>';
							        			$midArea .= '<td class="border centerAlign">'.$sub.'</td>';

			      							}else{

			      								$midArea .= '<td class="border centerAlign" dir="rtl">'.$exam_date_sheet[$response]["exam_time"].'بجے دوپہر</td>';
			      								$midArea .= '<td class="border centerAlign">'.$exam_date_sheet[$response]['exam_date'].'</td>';
							        			$midArea .= '<td class="border centerAlign">'.$sub.'</td>';
			      							
			      							}
			      							
		      							}

		      						}
							        
							       
		      					}// end else for $exam_date[$key] == $prevDate*/

		      					/*if ($key != 0 ){
		      								
	  								if($i == 0 and $empty and $loopcount == 1){
	  									// die();
	  									//die($loopcount.$sub);
		      							$strFinal .= $strStart.$midArea.'</tr>';
	      								$loopcount = 0;

	      							}elseif($loopcount == 2 and !$empty){
	      								// /die($loopcount.$sub.'test');
	      								$strFinal .= $midArea.'</tr>';
										$empty = false;
										$loopcount = 0;
	      							}

	      							$i = 0;
	  							}

		      					$loopcount++;
		      					$prevDate = $exam_date[$key];*/
		      					// echo $prevDate = $exam_date[$key].'<br/>';      					
		      					?>

						        <?php  if($exam_date_sheet[$response]['exam_appearance_time'] == 'first_time'){?>
						        <tr>
						        	<td class="border centerAlign">&nbsp;</td>
						        	<td class="border centerAlign">&nbsp;</td>
						        	<td class="border centerAlign" dir="rtl"><?php echo $exam_date_sheet[$response]['exam_time'].'بجے صبح';?></td>
						        	<td class="border centerAlign"><?php echo $exam_date_sheet[$response]['exam_date'];?></td>
						        	<td class="border centerAlign"><?php echo $sub;?></td>
						        </tr>
						        <?php }else{?>
						        <tr>
						        	<td class="border centerAlign" dir="rtl"><?php echo $exam_date_sheet[$response]['exam_time'].'بجے دوپہر';?></td>
						        	<td class="border centerAlign"><?php echo $sub;?></td>
						        	<td class="border centerAlign">&nbsp;</td>
						        	<td class="border centerAlign"><?php echo $exam_date_sheet[$response]['exam_date'];?></td>
						        	<td class="border centerAlign">&nbsp;</td>
						        </tr>
						        <?php }?>
	         <?php } // end foreach loop for subjects ?>

	         <?php 
	         /*if ($empty) {
			    $strFinal = $strStart . $midArea ."</tr>";
			 }
			 // $strFinal = $strFinal . "</tr>";
			 echo $strFinal;*/
			 ?>
	      	  <tr>
		        <td colspan="2" class="centerAlign">ختم&nbsp;الرابطہ</td>
		        <td colspan="2">&nbsp;</td>
		        <td colspan="2" class="centerAlign">توقیع&nbsp;مراقب&nbsp;الامتحان</td>
		      </tr>
	      </tbody>
	    </table>
	    <?php //echo '<pre>';print_r($exam_date_sheet);echo '</pre>';
	    //die();?>

   <?php }else{?>

   	    <table width="100%" border="0" cellspacing="0">
      	   <tbody>
	      <tr>
	        <td width="20%" class="border centerAlign">وقت</td>
	        <td width="20%" class="border centerAlign">الوقت الثانی</td>
	        <td width="20%" class="border centerAlign">وقت</td>
	        <td width="20%" class="border centerAlign">تاریخ</td>
	        <td width="20%" class="border centerAlign">مضمون</td>
	      </tr>
	      <?php
	      		if($esinfo['subject_id'] != "" && !empty($esinfo['subject_id'])){

	      			$row_empty		= "<td class='border centerAlign'>&nbsp;</td><td class='border centerAlign'>&nbsp;</td>";
		      			
	      			$row_one_date    = @$exam_date_sheet[0]['exam_date'];
	      			$row_one_count   = 0;
	      			$row_two_date    = @$exam_date_sheet[1]['exam_date'];
	      			$row_two_count   = 0;
	      			$row_three_date  = @$exam_date_sheet[2]['exam_date'];
	      			$row_three_count = 0;
	      			$row_four_date   = @$exam_date_sheet[3]['exam_date'];
	      			$row_four_count  = 0;
	      			$row_five_date   = @$exam_date_sheet[4]['exam_date'];
	      			$row_five_count  = 0;
	      			$row_six_date    = @$exam_date_sheet[5]['exam_date'];
	      			$row_six_count  = 0;

	      			$row_one   		= "";
	      			$row_two   		= "";
	      			$row_three   	= "";
	      			$row_four    	= "";
	      			$row_five   	= "";
	      			$row_six   		= "";
	      			$temp       	= "";
	      			$final_datesheet = "";

			      	$std_exam_dates = explode(",",$esinfo['subject_id']);
			      	
			      	/*echo '<pre>';print_r($std_exam_dates);echo '</pre>';
			      	echo '<pre>';print_r($esinfo);echo '</pre>';

			      	echo '<pre>';print_r($exam_date_sheet);echo '</pre>';*/
			      	foreach($exam_date_sheet AS $key => $ds){?>
			      		
			      		<?php if(in_array($ds['exam_subject_id'], $std_exam_dates)){?>
				      		<?php
				      			
				      			if($row_one_date == $ds['exam_date']){
		      					
			      					if($ds['exam_appearance_time'] == 'first_time'){

			      						$row_one   		.= "<td class='border centerAlign'>صبح &nbsp;&nbsp;&nbsp;".$ds['exam_time']."</td>";
			      						$row_one   		.= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>";
			      						$row_one   		.= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>";
			      						$row_one_count++;
			      					
			      					}else{

			      						$row_one   		.= "<td class='border centerAlign'>دوپہر &nbsp;".$ds['exam_time']."</td>";
			      						$row_one   		.= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>";
			      						$row_one   		.= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>";
			      						$row_one_count++;	
			      					
			      					}
			      					
			      				}
			      				
			      				if($row_two_date == $ds['exam_date']){
			      					
			      					if($ds['exam_appearance_time'] == 'first_time'){

			      						$row_two   		.= "<td class='border centerAlign'>صبح &nbsp;&nbsp;&nbsp;".$ds['exam_time']."</td>";
			      						$row_two   		.= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>";
			      						$row_two   		.= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>";
			      						$row_two_count++;

			      					}else{

			      						
			      						$row_two   		= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>".$row_two;
			      						if ($row_two_count == 0) {
				      							$row_two   		= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>".$row_two;
				      					}
			      						$row_two   		= "<td class='border centerAlign'>دوپہر &nbsp;".$ds['exam_time']."</td>".$row_two;
			      						
			      						$row_two_count++;	
			      					}

			      					/*if ($row_two_count == 1) {
			      							
			      						if($ds['exam_appearance_time'] == 'first_time'){

				      						$row_two   		.= "<td class='border centerAlign'>صبح &nbsp;&nbsp;&nbsp;".$ds['exam_time']."</td>";
				      						$row_two   		.= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>";
				      						$row_two   		.= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>";
				      						++$row_two_count;

				      					}else{
				      						if ($row_two_count > 0) {
				      							$row_two   		= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>".$row_two;
				      						}
				      						$row_two   		= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>".$row_two;
				      						$row_two   		= "<td class='border centerAlign'>دوپہر &nbsp;".$ds['exam_time']."</td>".$row_two;

				      						++$row_two_count;
				      					}

			      					}else{

			      						
			      						if($ds['exam_appearance_time'] == 'first_time'){

				      						$row_two   		.= "<td class='border centerAlign'>صبح &nbsp;&nbsp;&nbsp;".$ds['exam_time']."</td>";
				      						$row_two   		.= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>";
				      						$row_two   		.= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>";
				      						++$row_two_count;

				      					}else{

				      						
				      						$row_two   		= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>".$row_two;
				      						if ($row_two_count == 0) {
				      							$row_two   		= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>".$row_two;
				      						}
				      						$row_two   		= "<td class='border centerAlign'>دوپہر &nbsp;".$ds['exam_time']."</td>".$row_two;

				      						++$row_two_count;
				      					}
			      					}*/

			      				}
			      				
			      				if($row_three_date == $ds['exam_date']){
			      					
			      					if($ds['exam_appearance_time'] == 'first_time'){

			      						$row_three   		.= "<td class='border centerAlign'>صبح &nbsp;&nbsp;&nbsp;".$ds['exam_time']."</td>";
			      						$row_three   		.= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>";
			      						$row_three   		.= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>";
			      						$row_three_count++;

			      					}else{

			      						
			      						$row_three   		= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>".$row_three;
			      						if ($row_three_count == 0) {
				      							$row_three   		= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>".$row_three;
				      					}
			      						$row_three   		= "<td class='border centerAlign'>دوپہر &nbsp;".$ds['exam_time']."</td>".$row_three;
			      						
			      						$row_three_count++;	
			      					}

			      				}
			      				

			      				if($row_four_date == $ds['exam_date']){
			      					// echo $ds['exam_subject_id'];die('Yoho!');
			      					if($ds['exam_appearance_time'] == 'first_time'){
			      						$row_four   		.= "<td class='border centerAlign'>صبح &nbsp;&nbsp;&nbsp;".$ds['exam_time']."</td>";
			      						$row_four   		.= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>";
			      						$row_four   		.= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>";
			      						$row_four_count++;
			      					}else{

			      						
			      						$row_four   		= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>".$row_four;
			      						if ($row_four_count == 0) {
				      							$row_four   		= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>".$row_four;
				      					}
			      						$row_four   		= "<td class='border centerAlign'>دوپہر &nbsp;".$ds['exam_time']."</td>".$row_four ;
			      						$row_four_count++;	
			      					}

			      				}
			      				


			      				if($row_five_date == $ds['exam_date']){
			      					
			      					
			      					if($ds['exam_appearance_time'] == 'first_time'){
			      						$row_five   		.= "<td class='border centerAlign'>صبح &nbsp;&nbsp;&nbsp;".$ds['exam_time']."</td>";
			      						$row_five   		.= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>";
			      						$row_five   		.= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>";
			      						$row_five_count++;
			      					}else{
			      						
			      						$row_five   		= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>".$row_five;
			      						if ($row_five_count == 0) {
				      							$row_five   		= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>".$row_five;
				      					}
			      						$row_five   		= "<td class='border centerAlign'>دوپہر &nbsp;".$ds['exam_time']."</td>".$row_five;
			      						$row_five_count++;	
			      					}

			      				}

			      				if($row_six_date == $ds['exam_date']){
			      					
			      					
			      					if($ds['exam_appearance_time'] == 'first_time'){
			      						$row_six   		.= "<td class='border centerAlign'>صبح &nbsp;&nbsp;&nbsp;".$ds['exam_time']."</td>";
			      						$row_six   		.= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>";
			      						$row_six   		.= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>";
			      						$row_six_count++;
			      					}else{
			      						
			      						$row_six   		= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>".$row_six;
			      						if ($row_six_count == 0) {
				      							$row_six   		= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>".$row_six;
				      					}
			      						$row_six   		= "<td class='border centerAlign'>دوپہر &nbsp;".$ds['exam_time']."</td>".$row_six;
			      						$row_six_count++;	
			      					}

			      				}
				      		?>	
				      		<?php /*

				      		<tr>
				      			<td class="border centerAlign">&nbsp;</td>
			        			<td class="border centerAlign">&nbsp;</td>
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
							*/?>
						<?php }?>

			      	<?php } // END FOEACH LOOP?>

			      		<?php 

				      		if ($row_one_count > 0) {
			      				
			      				if ($row_one_count > 1) {
			      				
			      					$final_datesheet .= '<tr>'.$row_one;
			      				
			      				}else{
			      				
			      					$final_datesheet .= '<tr>'.$row_empty.$row_one;
			      					
			      				}
			      				$final_datesheet .= '<tr/>';
			      			}
			      			

			      			if ($row_two_count > 0) {
			      				
			      				if ($row_two_count > 1) {

			      					$final_datesheet .= '<tr>'.$row_two;

			      				}else{

			      					$final_datesheet .= '<tr>'.$row_empty.$row_two;
			      				}
			      				$final_datesheet .= '<tr/>';
			      			}
			      			

			      			if ($row_three_count > 0) {
			      				
			      				if ($row_three_count > 1) {
			      				
			      					$final_datesheet .= '<tr>'.$row_three;
			      				
			      				}else{
			      				
			      					$final_datesheet .= '<tr>'.$row_empty.$row_three;
			      				
			      				}
			      				$final_datesheet .= '<tr/>';
			      			}
			      			
			      			
			      			if ($row_four_count > 0) {
			      			
			      				if ($row_four_count > 1) {
			      				
			      					$final_datesheet .= '<tr>'.$row_four;
			      				
			      				}else{
			      				
			      					$final_datesheet .= '<tr>'.$row_empty.$row_four;
			      				
			      				}
			      				$final_datesheet .= '<tr/>';
			      			}
			      			

			      			if ($row_five_count > 0) {
			      				
			      				if ($row_five_count > 1) {
			      					
			      					$final_datesheet .= '<tr>'.$row_five;

			      				}else{

			      					$final_datesheet .= '<tr>'.$row_empty.$row_five;
			      				}
			      				$final_datesheet .= '<tr/>';
			      			}

			      			if ($row_six_count > 0) {
			      				
			      				if ($row_six_count > 1) {
			      					
			      					$final_datesheet .= '<tr>'.$row_six;

			      				}else{

			      					$final_datesheet .= '<tr>'.$row_empty.$row_six;
			      				}
			      				$final_datesheet .= '<tr/>';
			      			}

			      			echo $final_datesheet;

			      		?>

		      	<?php }else{

		      			$row_empty		= "<td class='border centerAlign'>&nbsp;</td><td class='border centerAlign'>&nbsp;</td>";
		      			
		      			$row_one_date   = $exam_date_sheet[0]['exam_date'];
		      			$row_one_count  = 0;
		      			$row_two_date   = $exam_date_sheet[1]['exam_date'];
		      			$row_two_count  = 0;
		      			$row_three_date = $exam_date_sheet[2]['exam_date'];
		      			$row_three_count  = 0;
		      			$row_four_date  = $exam_date_sheet[3]['exam_date'];
		      			$row_four_count  = 0;
		      			$row_five_date  = $exam_date_sheet[4]['exam_date'];
		      			$row_five_count  = 0;
		      			$row_six_date    = @$exam_date_sheet[5]['exam_date'];
	      				$row_six_count  = 0;

		      			$row_one   		= "";
		      			$row_two   		= "";
		      			$row_three   	= "";
		      			$row_four    	= "";
		      			$row_five   	= "";
		      			$row_six   		= "";
		      			$temp       	= "";
		      			$final_datesheet = "";

		      			foreach($exam_date_sheet AS $key => $ds){?>
		      				
		      				<?php
		      				
		      				if($row_one_date == $ds['exam_date']){
		      					
		      					if($ds['exam_appearance_time'] == 'first_time'){

		      						$row_one   		.= "<td class='border centerAlign'>صبح &nbsp;&nbsp;&nbsp;".$ds['exam_time']."</td>";
		      						$row_one   		.= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>";
		      						$row_one   		.= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>";
		      						$row_one_count++;
		      					
		      					}else{

		      						$row_one   		.= "<td class='border centerAlign'>دوپہر &nbsp;".$ds['exam_time']."</td>";
		      						$row_one   		.= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>";
		      						$row_one   		.= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>";
		      						$row_one_count++;	
		      					
		      					}
		      					
		      				}
		      				
		      				if($row_two_date == $ds['exam_date']){
		      					
		      					if ($row_two_count == 1) {
		      						
		      						if($ds['exam_appearance_time'] == 'first_time'){

			      						$row_two   		.= "<td class='border centerAlign'>صبح &nbsp;&nbsp;&nbsp;".$ds['exam_time']."</td>";
			      						$row_two   		.= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>";
			      						$row_two   		.= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>";
			      						++$row_two_count;

			      					}else{

			      						$row_two   		= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>".$row_two;

			      							$row_two   		= "<td class='border centerAlign'>دوپہر &nbsp;".$ds['exam_time']."</td>".$row_two;
			      						/*$row_two   		= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>".$row_two;*/
			      						
			      						++$row_two_count;
			      					}

		      					}else{

		      						
		      						if($ds['exam_appearance_time'] == 'first_time'){

			      						$row_two   		.= "<td class='border centerAlign'>صبح &nbsp;&nbsp;&nbsp;".$ds['exam_time']."</td>";
			      						$row_two   		.= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>";
			      						$row_two   		.= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>";
			      						++$row_two_count;
			      					}else{

			      						$row_two   		= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>".$row_two;
			      						$row_two   		= "<td class='border centerAlign'>دوپہر &nbsp;".$ds['exam_time']."</td>".$row_two;

			      						++$row_two_count;
			      					}
		      					}

		      				}
		      				
		      				if($row_three_date == $ds['exam_date']){
		      					
		      					if($ds['exam_appearance_time'] == 'first_time'){
		      						$row_three   		.= "<td class='border centerAlign'>صبح &nbsp;&nbsp;&nbsp;".$ds['exam_time']."</td>";
		      						$row_three   		.= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>";
		      						$row_three   		.= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>";
		      						$row_three_count++;
		      					}else{

		      						$row_three   		= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>".$row_three;
		      						$row_three   		= "<td class='border centerAlign'>دوپہر &nbsp;".$ds['exam_time']."</td>".$row_three;
		      						
		      						$row_three_count++;	
		      					}

		      				}
		      				
		      				if($row_four_date == $ds['exam_date']){
		      					
		      					if($ds['exam_appearance_time'] == 'first_time'){
		      						$row_four   		.= "<td class='border centerAlign'>صبح &nbsp;&nbsp;&nbsp;".$ds['exam_time']."</td>";
		      						$row_four   		.= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>";
		      						$row_four   		.= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>";
		      						$row_four_count++;
		      					}else{

		      						$row_four   		= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>".$row_four;
		      						$row_four   		= "<td class='border centerAlign'>دوپہر &nbsp;".$ds['exam_time']."</td>".$row_four ;
		      						$row_four_count++;	
		      					}

		      				}

		      				if($row_five_date == $ds['exam_date']){
		      					

		      					if($ds['exam_appearance_time'] == 'first_time'){
		      						$row_five   		.= "<td class='border centerAlign'>صبح &nbsp;&nbsp;&nbsp;".$ds['exam_time']."</td>";
		      						$row_five   		.= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>";
		      						$row_five   		.= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>";
		      						$row_five_count++;
		      					}else{

		      						$row_five   		= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>".$row_five;
		      						$row_five   		= "<td class='border centerAlign'>دوپہر &nbsp;".$ds['exam_time']."</td>".$row_five;
		      						$row_five_count++;	
		      					}

		      				}

		      				if($row_six_date == $ds['exam_date']){
			      					
			      					
			      					if($ds['exam_appearance_time'] == 'first_time'){
			      						$row_six   		.= "<td class='border centerAlign'>صبح &nbsp;&nbsp;&nbsp;".$ds['exam_time']."</td>";
			      						$row_six   		.= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>";
			      						$row_six   		.= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>";
			      						$row_six_count++;
			      					}else{
			      						
			      						$row_six   		= "<td class='border centerAlign'>".$ds['sub_name_urdu']."</td>".$row_six;
			      						if ($row_six_count == 0) {
				      							$row_six   		= "<td class='border centerAlign'>".date("d-m-Y",strtotime($ds['exam_date']))."</td>".$row_six;
				      					}
			      						$row_six   		= "<td class='border centerAlign'>دوپہر &nbsp;".$ds['exam_time']."</td>".$row_six;
			      						$row_six_count++;	
			      					}

			      				}
		      				
		      				?>

		      			<?php } // END FOREACH LOOP ?>

		      			<?php
		      			
		      			if ($row_one_count > 0) {
		      				
		      				if ($row_one_count > 1) {
		      				
		      					$final_datesheet .= '<tr>'.$row_one;
		      				
		      				}else{
		      				
		      					$final_datesheet .= '<tr>'.$row_empty.$row_one;
		      					
		      				}
		      				$final_datesheet .= '<tr/>';
		      			}
		      			

		      			if ($row_two_count > 0) {
		      				
		      				if ($row_two_count > 1) {

		      					$final_datesheet .= '<tr>'.$row_two;

		      				}else{

		      					$final_datesheet .= '<tr>'.$row_empty.$row_two;
		      				}
		      				$final_datesheet .= '<tr/>';
		      			}
		      			

		      			if ($row_three_count > 0) {
		      				if ($row_three_count > 1) {
		      					$final_datesheet .= '<tr>'.$row_three;
		      				}else{
		      					$final_datesheet .= '<tr>'.$row_empty.$row_three;
		      				}
		      				$final_datesheet .= '<tr/>';
		      			}
		      			
		      			if ($row_four_count > 0) {
		      				if ($row_four_count > 1) {
		      					$final_datesheet .= '<tr>'.$row_four;
		      				}else{
		      					$final_datesheet .= '<tr>'.$row_empty.$row_four;
		      				}
		      				$final_datesheet .= '<tr/>';
		      			}
		      			
		      			if ($row_five_count > 0) {
			      				
		      				if ($row_five_count > 1) {
		      					
		      					$final_datesheet .= '<tr>'.$row_five;

		      				}else{

		      					$final_datesheet .= '<tr>'.$row_empty.$row_five;
		      				}
		      				$final_datesheet .= '<tr/>';
		      			}

		      			if ($row_six_count > 0) {
		      				
		      				if ($row_six_count > 1) {
		      					
		      					$final_datesheet .= '<tr>'.$row_six;

		      				}else{

		      					$final_datesheet .= '<tr>'.$row_empty.$row_six;
		      				}
		      				$final_datesheet .= '<tr/>';
		      			}

		      			
		      			echo $final_datesheet;
		      			?>

		      	<?php  }?>
	      
	      <tr>
	        <td colspan="2" class="centerAlign">ختم&nbsp;الرابطہ</td>
	        <td colspan="2">&nbsp;</td>
	        <td colspan="2" class="centerAlign">توقیع&nbsp;مراقب&nbsp;الامتحان</td>
	      </tr>
    	   </tbody>
    </table>

   <?php }?>
  </div>
</div>
	<?php if( ($count %2 == 0) ){?>
    	<div style="page-break-after:always"></div>
  	<?php }// end check for $key ?>
<?php $count++; }?>
<?php }else{?>
	<p>کوی طالب علم موجود نہیں ہے</p>
<?php }?>
</body>
</html>