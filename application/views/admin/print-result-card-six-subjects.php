<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Result Card For Mutawasta Talba</title>
<style type="text/css">
@media print{
div.main_div {
	page-break-after:always;}
}
.main_div{
	position: relative;
	}
.exam_info{
	font-weight:bold;
	font-size:15px;
	text-align:center;
	position: absolute;
	visibility: visible;
	font-weight:bold;
	left: 110px;
	top: 80px;
	}
.stud_info{
	font-weight:bold;
	font-size:16px;
	text-align:center;
	position: absolute;
	visibility: visible;

	}
#stud_regno {
	width: 150px;
	left: 235px;
	top: 163px;
}
#stud_rollno {
	left: 64px;
	top: 163px;
	width: 77px;
}
#stud_name {
	left: 235px;
	top: 189px;
	width: 151px;
}
#stud_fathername {
	top: 189px;
	left: 53px;
	width: 100px;
}
#affli_shortname {
	left: 215px;
	top: 214px;
	width: 182px;
}
#exam_date {
	left: 25px;
	top: 214px;
	width: 100px;
}
#date{
	left: 331px;
	top: 653px;
	width: 77px;
}
.subject_marks{
	font-weight:bold;
	font-size:16px;
	text-align:center;
	position: absolute;
	visibility: visible;
	}
#subject_marks_1 {
	left: 268px;
	top: 315px;
}
#subject_marks_2 {
	left: 268px;
	top: 360px;
}
#subject_marks_3 {
	left: 268px;
	top: 405px;
}
#subject_marks_4 {
	left: 268px;
	top: 449px;
}
#subject_marks_5 {
	left: 268px;
	top: 492px;
}
#subject_marks_6 {
	left: 268px;
	top: 531px;
}
#subject_totalmarks{
	left: 266px;
	top: 582px;
}
#subject_grade{
	left: 63px;
	top: 405px;
}
.controller-sign {
	width: 50px;
	height: auto;
	position: absolute;
	top: 640px;
	left: 60px;
}
</style>

</head>

<body>
<?php
	//echo '<pre>';print_r($result_card_info);echo '</pre>';
	if ($result_card_info != NULL) {

		if ($exam_type == 1) {
			

			foreach ($result_card_info as $key => $rcinfo) {?>
              	
	            <div class="main_div">
	               <img border="0" src="<?php echo base_url();?>assets/images/controller_examination.png" alt="" class="controller-sign" />
				   <img border="0" src="<?php echo base_url();?>assets/images/transparent.png" alt="Pulpit rock" width="525.1" height="703.1" />
								<div class="exam_info" id="hijri_date"><?php echo $hijri_year; ?></div>
								<div class="stud_info" id="stud_rollno"><?php echo $rcinfo['std_roll_no'];?></div>
								<div class="stud_info" id="stud_regno"><?php echo $rcinfo['std_reg_no']; ?></div>
								<div class="stud_info" id="stud_name"><?php echo $rcinfo['std_name']; ?></div>
								<div class="stud_info" id="stud_fathername"><?php echo $rcinfo['std_father_name']; ?></div>
								<div class="stud_info" id="affli_shortname"><?php echo $rcinfo['affli_shortname']; ?></div>
								<div class="stud_info" id="exam_date"><?php echo $date_of_exam." ".$hijri_year.'ھ'; ?></div>
								<div class="stud_info" id="date"><?php echo $result_date; ?></div>


					<?php 	$marks_array = explode(',', $rcinfo['Obtained_marks']);
						  	/*$sliced_index_value = array_splice($marks_array, 4, 5);
						  	krsort($sliced_index_value);
						  	array_splice($marks_array,3,0,$sliced_index_value);*/
							// echo '<pre>';print_r($marks_array);echo '</pre>';
							$div_count = 1;
							$total = true;
							$sub_total = 0;
							for($x = 0; $x < 6; $x++){?>

								<div class="subject_marks" id="subject_marks_<?php echo $div_count;?>">
									<?php if(array_key_exists($x,$marks_array)){
										// echo $marks_array[$x]; 
										// echo $x;
										if ($marks_array[$x] < 40 and $marks_array[$x] != "") {

											$total = false;
											echo $marks_array[$x];
											$sub_total += $marks_array[$x];

										}elseif ($marks_array[$x] != "" and $marks_array[$x] != NULL){

											echo $marks_array[$x];
											$sub_total += $marks_array[$x];

										}else{
											echo "0";
											$total = false;
										}
									}else{

										echo "0";
										$total = false;
										
									}?>

								</div>
							
							<?php $div_count++; }// end for loop for subjects

					
	  					if ($total == true) {
	            
			                if (($sub_total >= 240) && ($sub_total <= 299)) {
			                    $grade_name = 'مقبول';
			                } else if (($sub_total >= 300) && ($sub_total <= 359)) {
			                    $grade_name = 'جید';
			                } else if (($sub_total >= 360) && ($sub_total <= 419)) {
			                    $grade_name = 'جیدجدا';
			                } else if (($sub_total >= 420) && ($sub_total <= 600)) {
			                    $grade_name = 'ممتاز';
			                }
			          
						}else{

							$grade_name="راسب";

						}?>
				   	<div class="subject_marks" id="subject_totalmarks"><?php if($total == true){ echo $sub_total;}else{echo "0";} ?></div>
	                <div class="subject_marks" id="subject_grade"><?php echo $grade_name; ?></div>

				</div><!-- end main div-->

	     	<?php }// end foreach for result ?>


		<?php }else{ // else for exam type

			foreach ($result_card_info as $key => $rcinfo) {?>
              	
	            <div class="main_div">

				   <img border="0" src="<?php echo base_url();?>assets/images/transparent.png" alt="Pulpit rock" width="525.1" height="703.1" />
								<div class="exam_info" id="hijri_date"><?php echo $hijri_year; ?></div>
								<div class="stud_info" id="stud_rollno"><?php echo $rcinfo['std_roll_no'];?></div>
								<div class="stud_info" id="stud_regno"><?php echo $rcinfo['std_reg_no']; ?></div>
								<div class="stud_info" id="stud_name"><?php echo $rcinfo['std_name']; ?></div>
								<div class="stud_info" id="stud_fathername"><?php echo $rcinfo['std_father_name']; ?></div>
								<div class="stud_info" id="affli_shortname"><?php echo $rcinfo['affli_shortname']; ?></div>
								<div class="stud_info" id="exam_date"><?php echo $date_of_exam." ".$hijri_year.'ھ'; ?></div>
								<div class="stud_info" id="date"><?php echo $result_date; ?></div>


					<?php 	$marks_array = explode(',', $rcinfo['Obtained_marks']);
						  	/*$sliced_index_value = array_splice($marks_array, 4, 5);
						  	echo '<pre>';print_r($sliced_index_value);echo '</pre>';
						  	krsort($sliced_index_value);
						  	echo '<pre>';print_r($sliced_index_value);echo '</pre>';
						  	array_splice($marks_array,3,0,$sliced_index_value);*/

							// echo '<pre>';print_r($marks_array);echo '</pre>';
							$subject_id 		= explode(',', $rcinfo['subject_id']);
							// echo '<pre>';print_r($subject_id);echo '</pre>';
							$r_subject_id 		= explode(',', $rcinfo['r_subject_id']);
							//echo '<pre>';print_r($r_subject_id);echo '</pre>';
							$r_obtained_marks 	= explode(',', $rcinfo['r_obtained_marks']);
							// echo '<pre>';print_r($r_obtained_marks);echo '</pre>';
							$div_count = 1;
							$total = true;
							$sub_total = 0;
							$r_count = 0;
							$new_total_score = 0;
							for($x = 0; $x < 6; $x++){?>

								<div class="subject_marks" id="subject_marks_<?php echo $div_count;?>">

									<?php if(isset($r_subject_id[$r_count]) and ($subject_id[$x] == $r_subject_id[$r_count]) ){

										if ($r_obtained_marks[$r_count] < 40) {

												$total = false;
												echo $r_obtained_marks[$r_count];
												$new_total_score += $r_obtained_marks[$r_count];

										}else{

											echo $r_obtained_marks[$r_count];
											$new_total_score += $r_obtained_marks[$r_count];

										}

										$r_count++;
										
									}else{

										if(array_key_exists($x,$marks_array)){
											// echo $marks_array[$x]; 
											// echo $x;
											if ($marks_array[$x] < 40 and $marks_array[$x] != "") {

												$total = false;
												echo $marks_array[$x];
												$new_total_score += $marks_array[$x];

											}elseif ($marks_array[$x] != "" and $marks_array[$x] != NULL){

												echo $marks_array[$x];
												$new_total_score += $marks_array[$x];

											}else{
												echo "0";
												$total = false;
											}

										}else{

											echo "0";
											$total = false;
											
										}

									} // end else for main if ?>
									

								</div>
							
							<?php $div_count++; }// end for loop for subjects

					
	  					if ($total == true) {
	            
			                if (($new_total_score >= 240) && ($new_total_score <= 299)) {
			                    $grade_name = 'مقبول';
			                } else if (($new_total_score >= 300) && ($new_total_score <= 359)) {
			                    $grade_name = 'جید';
			                } else if (($new_total_score >= 360) && ($new_total_score <= 419)) {
			                    $grade_name = 'جیدجدا';
			                } else if (($new_total_score >= 420) && ($new_total_score <= 600)) {
			                    $grade_name = 'ممتاز';
			                }
			          
						}else{
							
							$grade_name="راسب";

						}?>
				   	<div class="subject_marks" id="subject_totalmarks"><?php if($total == true){ echo $new_total_score;}else{echo "0";} ?></div>
	                <div class="subject_marks" id="subject_grade"><?php echo $grade_name; ?></div>

				</div><!-- end main div-->

	     	<?php }// end foreach for result ?>

		<?php }
			

    } else {  /// else for result_card_info ?>

		<div class='notfounderror' style='color:#FFF; font-size:30px; background:#F03; text-align:center; border:1px solid #F00; ; padding:10px 10px 10px 10px; '>اس طالب علم کا ریکا رڈ موجود نہیں</div>
	
	<?php  }?>			   
    
</body>
</html>