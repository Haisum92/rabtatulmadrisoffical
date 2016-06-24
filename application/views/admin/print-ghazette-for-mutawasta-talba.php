<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title style="direction: rtl;"><?php echo $gazetInfo[0]['exam_name'];?></title>
 

<style type="text/css">
@charset "utf-8";
/* CSS Document */

body {
	font: 100%/1.4 "Alvi Nastaleeq", Verdana, Arial, Helvetica, sans-serif;
	background:#CCC;
	margin: 0;
	padding: 0;
	color: #000;
	direction:rtl;
}

/* ~~ Element/tag selectors ~~ */
ul, ol, dl { /* Due to variations between browsers, it's best practices to zero padding and margin on lists. For consistency, you can either specify the amounts you want here, or on the list items (LI, DT, DD) they contain. Remember that what you do here will cascade to the .nav list unless you write a more specific selector. */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;
	text-align:center;	 /* removing the top margin gets around an issue where margins can escape from their containing div. The remaining bottom margin will hold it away from any elements that follow. */
	padding-right: 15px;
	padding-left: 15px; /* adding the padding to the sides of the elements within the divs, instead of the divs themselves, gets rid of any box model math. A nested div with side padding can also be used as an alternate method. */
}
a img { /* this selector removes the default blue border displayed in some browsers around an image when it is surrounded by a link */
	border: none;
}

/* ~~ Styling for your site's links must remain in this order - including the group of selectors that create the hover effect. ~~ */
a:link {
	color: #42413C;
	text-decoration: underline; /* unless you style your links to look extremely unique, it's best to provide underlines for quick visual identification */
}
a:visited {
	color: #6E6C64;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* this group of selectors will give a keyboard navigator the same hover experience as the person using a mouse. */
	text-decoration: none;
}

/* ~~this fixed width container surrounds the other divs~~ */
.container {
	width: 960px;
	background: #FFF;
	margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout */
}

/* ~~ the header is not given a width. It will extend the full width of your layout. It contains an image placeholder that should be replaced with your own linked logo ~~ */
.header {
	background: #44C0F4;
}

/* ~~ These are the columns for the layout. ~~ 

1) Padding is only placed on the top and/or bottom of the divs. The elements within these divs have padding on their sides. This saves you from any "box model math". Keep in mind, if you add any side padding or border to the div itself, it will be added to the width you define to create the *total* width. You may also choose to remove the padding on the element in the div and place a second div within it with no width and the padding necessary for your design.

2) No margin has been given to the columns since they are all floated. If you must add margin, avoid placing it on the side you're floating toward (for example: a right margin on a div set to float right). Many times, padding can be used instead. For divs where this rule must be broken, you should add a "display:inline" declaration to the div's rule to tame a bug where some versions of Internet Explorer double the margin.

3) Since classes can be used multiple times in a document (and an element can also have multiple classes applied), the columns have been assigned class names instead of IDs. For example, two sidebar divs could be stacked if necessary. These can very easily be changed to IDs if that's your preference, as long as you'll only be using them once per document.

4) If you prefer your nav on the left instead of the right, simply float these columns the opposite direction (all left instead of all right) and they'll render in reverse order. There's no need to move the divs around in the HTML source.

*/
.sidebar1 {
	float: right;
	width: 180px;
	/* [disabled]padding-bottom: 10px; */
}
.content {

	padding: 10px 0;
	width: 960px;
	float: right;
}

/* ~~ This grouped selector gives the lists in the .content area space ~~ */
.content ul, .content ol { 
	padding: 0 15px 15px 40px; /* this padding mirrors the right padding in the headings and paragraph rule above. Padding was placed on the bottom for space between other elements on the lists and on the left to create the indention. These may be adjusted as you wish. */
}

/* ~~ The navigation list styles (can be removed if you choose to use a premade flyout menu like Spry) ~~ */
ul.nav {
	list-style: none; /* this removes the list marker */
	border-top: 1px solid #666; /* this creates the top border for the links - all others are placed using a bottom border on the LI */
	margin-bottom: 15px; /* this creates the space between the navigation on the content below */
}
ul.nav li {
	border-bottom: 1px solid #666; /* this creates the button separation */
}
ul.nav a, ul.nav a:visited { /* grouping these selectors makes sure that your links retain their button look even after being visited */
	padding: 5px 5px 5px 15px;
	display: block; /* this gives the link block properties causing it to fill the whole LI containing it. This causes the entire area to react to a mouse click. */
	width: 160px;  /*this width makes the entire button clickable for IE6. If you don't need to support IE6, it can be removed. Calculate the proper width by subtracting the padding on this link from the width of your sidebar container. */
	text-decoration: none;
	background: #C6D580;
}
ul.nav a:hover, ul.nav a:active, ul.nav a:focus { /* this changes the background and text color for both mouse and keyboard navigators */
	background: #ADB96E;
	color: #FFF;
}

/* ~~ The footer ~~ */
.footer {
	padding: 10px 0;
	background: #44C0F4;
	position: relative;/* this gives IE6 hasLayout to properly clear */
	clear: both; /* this clear property forces the .container to understand where the columns end and contain them */
}

/* ~~ miscellaneous float/clear classes ~~ */
.fltrt {  /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page. The floated element must precede the element it should be next to on the page. */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* this class can be placed on a <br /> or empty div as the final element following the last floated div (within the #container) if the #footer is removed or taken out of the #container */
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}
.trmain {
	font-size:16px;
	font-weight:bold;
}
.trsec {
	font-size:13px;

}
</style>
</head>
<body>
<?php
	/*echo '<pre>';print_r($gazetInfo);echo '</pre>';
	die();*/
	if ($gazetInfo != NULL) {
		// exam_name
		if ($exam_type == 1) {
/*echo '<pre>';print_r($gazetInfo);echo '</pre>';
	die();*/
			$count = 1;foreach ($gazetInfo as $key => $info) {?>

		    <?php if($count == 1){?>

			    <h2>رابطۃ المدارس ا لا سلا میہ پا کستان</h2>
			    <?php if($info['exam_type_id'] ==  1){?>
			    	<?php if($gender == 'm'){?>
			    		<h2 dir="rtl" id="test"><!-- نتیجۃ سالانہ امتحان شہادۃ المتوسطہ (طلبہ) 1436ھ  --><?php echo $info['exam_name'];?> &nbsp;&nbsp;(کل نمبر: ۶۰۰)</h2>
			    	<?php }else{?>
			    		<h2 dir="rtl" id="test2"><!-- نتیجۃ سالانہ امتحان شہادۃ المتوسطہ (طالبات) 1436ھ --> <?php echo $info['exam_name'];?> &nbsp;&nbsp;(کل نمبر: ۶۰۰)</h2>
			    	<?php }?>
			    <?php }else{?>
			    	<?php if($gender == 'm'){?>
				    	<h2 dir="rtl" id="test3">نتیجۃ ضمنی امتحان شہادۃ المتوسطہ (طلبہ) 1436ھ <?php //echo $info['exam_name'];?> &nbsp;&nbsp;(کل نمبر: ۶۰۰)</h2>
			    	<?php }else{?>
			    		<h2 dir="rtl" id="test4">نتیجۃ ضمنی امتحان شہادۃ المتوسطہ (طالبات) 1436ھ <?php //echo $info['exam_name'];?> &nbsp;&nbsp;(کل نمبر: ۶۰۰)</h2>
			    	<?php }?>
			    <?php }?>
				
				<table  width="940" border="1" align="center" cellpadding="0" cellspacing="0">
					<tr class="trmain">
					    <td width="26"><div align="center">رقم  الجلوس</div></td>
					    <td width="60"><div align="center">اسم الطالب</div></td>
					    <td width="60"><div align="center">اسم الوالد</div></td>
					    <td width="70"><div align="center">تاریخ المیلاد</div></td>
					    <td width="165"><div align="center">المدرسۃ/دارلعلوم/الجامعۃ</div></td>
					    <td width="25"><div align="center">القرآن</div></td>
					    <td width="25"><div align="center">اللغۃ العربیۃ</div></td>
					    <td width="25"><div align="center">انگلش</div></td>
					    <td width="25"><div align="center">اردو</div></td>
					    <td width="25"><div align="center">معاشرتی علوم</div></td>
					    <td width="25"><div align="center">ریاضی</div></td>
					    <td width="30"><div align="center">المجموع</div></td>
					    <td width="25"><div align="center">ناجح/راسب</div></td>
					    <td width="27"><div align="center">التقدیر</div></td>
					    <td width="55"><div align="center">رقم التسجیل</div></td>
					    <td width="65"><div align="center">الملاحظات</div></td>
				  	</tr>   

			<?php }// end check for count ?>
		                                 
			  	<tr class="trsec">
			   
				    <td width="26" ><div align="center"><?php echo $info['std_roll_no'];?></div></td>
				    <td width="60" ><div align="center"><?php echo $info['std_name'];?></div></td>
				    <td width="60" ><div align="center"><?php echo $info['std_father_name'];?></div></td>
				    <td width="70" ><div align="center"><?php echo $info['std_dob_eng'];?></div></td>
				    <td width="165"><div align="center"><?php echo $info['affli_shortname'];?></div></td>

					<?php if($info['subject_id'] != ""){?>

				    	<?php 
				    		  $rasibTrue = false;
				    		  $cheating = false;
				    		  $cheatCount = 0;
				    		  $subject_id = explode(',', $info['subject_id']);
				    		  // echo '<pre>';print_r($subject_id);echo '</pre>';
				    		  $obtained_marks = explode(',', $info['Obtained_marks']);
				    		  $sub_status = explode(',', $info['Sub_status']);
				    		  $iterator = count($obtained_marks);
				    		  if (in_array('cheat',$sub_status)) {
				    		  	$cheating = true;
				    		  	$cheatIndex = array_search('cheat',$sub_status);
				    		  }
				    		  $total_score = array_sum($obtained_marks);
				    		  $myiterator = 0;for ($x=0; $x < count($exam_subjects); $x++) { ?>

				    		  	<?php if(isset($subject_id[$myiterator]) and $exam_subjects[$x]['sub_id'] == $subject_id[$myiterator])
				    		  		{?>
				    		  			<?php if($obtained_marks[$myiterator] < 40){
						    				$rasibTrue = true;
						    			}?>
						    			<td width="25">
						    				<div align='center'>
							    				<?php if($obtained_marks[$myiterator] < 40){?>
							    					<strong><?php echo $obtained_marks[$myiterator];?></strong>
							    				<?php }else{?>
							    					<?php echo $obtained_marks[$myiterator];?>
							    				<?php }?>
						    				</div>
						    			</td>

						    		<?php $myiterator++;
						    		}else{?>

						    			<td width="25">
						    				<div align='center'>
							    				<strong>0</strong>
							    				<?php $rasibTrue = true;?>
						    				</div>
						    			</td>

						    		<?php }?>
						    <?php } // end for loop
					    		/*for($x = 0;$x < $iterator; $x++ ){?>

					    			<?php if($obtained_marks[$x] < 40){
					    				$rasibTrue = true;
					    			}?>
					    			<td width="25">
					    				<div align='center'>
						    				<?php if($obtained_marks[$x] < 40){?>
						    					<strong><?php echo $obtained_marks[$x];?></strong>
						    				<?php }else{?>
						    					<?php echo $obtained_marks[$x];?>
						    				<?php }?>
					    				</div>
					    			</td>
					    		<?php } // end for loop for iterator

					    		if($iterator < 6){
					    			$otherIterator = 6 - $iterator;

					    			for($x = 0; $x < $otherIterator; $x++){?>

					    				<td width="25">
						    				<div align='center'>
							    				<strong>0</strong>
							    				<?php $rasibTrue = true;?>
						    				</div>
						    			</td>

					    			<?php }// end for loop
					    		} */ ?>

							<td width="25"><div align='center'><?php if($cheating){echo '0';}else{echo $total_score;}?></div></td>

							<?php if($rasibTrue){?>

				    			<td width="25"><div align='center'><?php echo "راسب"; ?></div></td>

				    		<?php }elseif($total_score >= 240){?>
				    		
				    			<td width="25"><div align='center'>ناجح</div></td>

				    		<?php }else{?>

				    			<td width="25"><div align='center'>راسب</div></td>

				    		<?php }?>

				    		
				    		<?php if( $rasibTrue ){?>

				    			<td width="25"><div align='center'><?php echo "راسب"; ?></div></td>

				    		<?php }elseif($total_score < 240){?>

				    			<td width="25"><div align='center'><?php echo "راسب"; ?></div></td>

				    		<?php }elseif($total_score >= 240 and $total_score <= 299){?>

				    			<td width="25"><div align='center'><?php echo "مقبول"; ?></div></td>

				    		<?php }elseif($total_score >= 300 and $total_score <= 359 ){?>

				    			<td width="25"><div align='center'><?php echo "جید"; ?></div></td>

				    		<?php }elseif($total_score >= 360 and $total_score <= 419){?>

				    			<td width="25"><div align='center'><?php echo "جید جدا"; ?></div></td>

				    		<?php }elseif($total_score >= 420){?>

				    			<td width="25"><div align='center'><?php echo "ممتاز"; ?></div></td>
				    		
				    		<?php }?>
				    		
				    		

				    <?php }else{?>

						<td width="25"><div align='center'> - </div></td>
						<td width="25"><div align='center'> - </div></td>
						<td width="25"><div align='center'> - </div></td>
						<td width="25"><div align='center'> - </div></td>
						<td width="25"><div align='center'> - </div></td>
						<td width="25"><div align='center'> - </div></td>
						<td width="25"><div align='center'> - </div></td>
						<td width="25"><div align='center'> - </div></td>
						<td width="25"><div align='center'> - </div></td>

					<?php }  // end else for $info['subject_id'] != ""?>
				    <td width="27"><div align="center"><?php echo $info['std_reg_no'];?></div></td>
				    <td width="65"><div align="center"><?php echo $info['std_address'];?></div></td>
			   
			 	</tr>
    	
	    		<?php if($count <= 21){
			
		 		 $count++;
		  
		  		}else{
		
				$count = 1;?>

				</table>
				<div style="page-break-after:always"></div>

	  		<?php } // end else for count check?>

			<?php } // end foreach for ghazet info

		}else{

			$count = 1;foreach ($gazetInfo as $key => $info) {?>

		    <?php if($count == 1){?>

			    <h2>رابطۃ المدارس ا لا سلا میہ پا کستان</h2>
			    <?php if($info['exam_type_id'] ==  1){?>
			    	<?php if($gender == 'm'){?>
			    		<h2 dir="rtl">نتیجۃ سالانہ امتحان شہادۃ المتوسطہ (طلبہ) 1436ھ <?php //echo $info['exam_name'];?> &nbsp;&nbsp;(کل نمبر: ۶۰۰)</h2>
			    	<?php }else{?>
			    		<h2 dir="rtl">نتیجۃ سالانہ امتحان شہادۃ المتوسطہ (طالبات) 1436ھ <?php //echo $info['exam_name'];?> &nbsp;&nbsp;(کل نمبر: ۶۰۰)</h2>
			    	<?php }?>
			    <?php }else{?>
			    	<?php if($gender == 'm'){?>
				    	<h2 dir="rtl">نتیجۃ ضمنی امتحان شہادۃ المتوسطہ (طلبہ) 1436ھ <?php //echo $info['exam_name'];?> &nbsp;&nbsp;(کل نمبر: ۶۰۰)</h2>
			    	<?php }else{?>
			    		<h2 dir="rtl">نتیجۃ ضمنی امتحان شہادۃ المتوسطہ (طالبات) 1436ھ <?php //echo $info['exam_name'];?> &nbsp;&nbsp;(کل نمبر: ۶۰۰)</h2>
			    	<?php }?>
			    <?php }?>
				
				<table  width="940" border="1" align="center" cellpadding="0" cellspacing="0">
					<tr class="trmain">
					    <td width="26"><div align="center">رقم  الجلوس</div></td>
					    <td width="60"><div align="center">اسم الطالب</div></td>
					    <td width="60"><div align="center">اسم الوالد</div></td>
					    <td width="70"><div align="center">تاریخ المیلاد</div></td>
					    <td width="165"><div align="center">المدرسۃ/دارلعلوم/الجامعۃ</div></td>
					    <td width="25"><div align="center">القرآن</div></td>
					    <td width="25"><div align="center">اللغۃ العربیۃ</div></td>
					    <td width="25"><div align="center">انگلش</div></td>
					    <td width="25"><div align="center">اردو</div></td>
					    <td width="25"><div align="center">معاشرتی علوم</div></td>
					    <td width="25"><div align="center">ریاضی</div></td>
					    <td width="30"><div align="center">المجموع</div></td>
					    <td width="25"><div align="center">ناجح/راسب</div></td>
					    <td width="27"><div align="center">التقدیر</div></td>
					    <td width="55"><div align="center">رقم التسجیل</div></td>
					    <td width="65"><div align="center">الملاحظات</div></td>
				  	</tr>   

			<?php }// end check for count ?>
		                                 
			  	<tr class="trsec">
			   
				    <td width="26" ><div align="center"><?php echo $info['std_roll_no'];?></div></td>
				    <td width="60" ><div align="center"><?php echo $info['std_name'];?></div></td>
				    <td width="60" ><div align="center"><?php echo $info['std_father_name'];?></div></td>
				    <td width="70" ><div align="center"><?php echo $info['std_dob_eng'];?></div></td>
				    <td width="165"><div align="center"><?php echo $info['affli_shortname'];?></div></td>
					<?php if($info['subject_id'] != ""){?>

				    	<?php 
				    		  $rasibTrue = false;
				    		  $cheating = false;
				    		  $cheatCount = 0;
				    		  $new_total_score = 0;
				    		  $subject_id = explode(',', $info['subject_id']);
				    		  $obtained_marks = explode(',', $info['Obtained_marks']);
				    		  $sub_status = explode(',', $info['Sub_status']);
				    		  $r_subject_id = explode(',', $info['r_subject_id']);
				    		  $r_obtained_marks = explode(',', $info['r_obtained_marks']);
				    		  $r_Sub_status = explode(',', $info['r_Sub_status']);
				    		  $iterator = count($obtained_marks);
				    		  if (in_array('cheat',$sub_status)) {
				    		  	$cheating = true;
				    		  	$cheatIndex = array_search('cheat',$sub_status);
				    		  }
				    		  $total_score = array_sum($obtained_marks);?>

				    			<?php 
					    		$r_count = 0;
					    		for($x = 0;$x < $iterator; $x++ ){?>

					    			<?php /*if(isset($r_subject_id[$r_count]) and ($subject_id[$x] == $r_subject_id[$r_count]) and $r_obtained_marks[$r_count] != 0 ){*/
					    				if(isset($r_subject_id[$r_count]) and ($subject_id[$x] == $r_subject_id[$r_count]) ){
					    			 ?>

					    				<?php if($r_obtained_marks[$r_count] < 40){
						    				$rasibTrue = true;
						    			}?>
						    			<td width="25">
						    				<div align='center'>
							    				<?php if($r_obtained_marks[$r_count] < 40){?>
							    					<strong><?php echo $r_obtained_marks[$r_count];?></strong>
							    				<?php }else{?>
							    					<?php echo $r_obtained_marks[$r_count];?>
							    				<?php }?>
						    				</div>
						    			</td>

						    			<?php $new_total_score += $r_obtained_marks[$r_count];
						    			$r_count++;?>

					    			<?php }else{ // end if for existing r_obtained_marks

					    				if($obtained_marks[$x] < 40){
						    				// echo $obtained_marks[$x].'here<br/>';
						    				$rasibTrue = true;
						    			}?>
						    			<td width="25">
						    				<div align='center'>
							    				<?php if($obtained_marks[$x] < 40){?>
							    					<strong><?php echo $obtained_marks[$x];?></strong>
							    				<?php }else{?>
							    					<?php echo $obtained_marks[$x];?>
							    				<?php }?>
						    				</div>
						    			</td>
						    			<?php $new_total_score += $obtained_marks[$x];?>
					    			<?php }// end else for existing r_obtained_marks ?>
					    			
					    		<?php } // end for loop for iterator
				    		?>

							<td width="25"><div align='center'><?php if($cheating){echo '0';}else{echo $new_total_score;}?></div></td>

							<?php if($rasibTrue){?>

				    			<td width="25"><div align='center'><?php echo "راسب"; ?></div></td>

				    		<?php }elseif($new_total_score >= 240){?>
				    		
				    			<td width="25"><div align='center'>ناجح</div></td>

				    		<?php }else{?>

				    			<td width="25"><div align='center'>راسب</div></td>

				    		<?php }?>

				    		
				    		<?php if( $rasibTrue ){?>

				    			<td width="25"><div align='center'><?php echo "راسب"; ?></div></td>

				    		<?php }elseif($new_total_score < 240){?>

				    			<td width="25"><div align='center'><?php echo "راسب"; ?></div></td>

				    		<?php }elseif($new_total_score >= 240 and $new_total_score <= 299){?>

				    			<td width="25"><div align='center'><?php echo "مقبول"; ?></div></td>

				    		<?php }elseif($new_total_score >= 300 and $new_total_score <= 359 ){?>

				    			<td width="25"><div align='center'><?php echo "جید"; ?></div></td>

				    		<?php }elseif($new_total_score >= 360 and $new_total_score <= 419){?>

				    			<td width="25"><div align='center'><?php echo "جید جدا"; ?></div></td>

				    		<?php }elseif($new_total_score >= 420){?>

				    			<td width="25"><div align='center'><?php echo "ممتاز"; ?></div></td>
				    		
				    		<?php }?>
				    		
				    		

				    <?php }else{?>

						<td width="25"><div align='center'> - </div></td>
						<td width="25"><div align='center'> - </div></td>
						<td width="25"><div align='center'> - </div></td>
						<td width="25"><div align='center'> - </div></td>
						<td width="25"><div align='center'> - </div></td>
						<td width="25"><div align='center'> - </div></td>
						<td width="25"><div align='center'> - </div></td>
						<td width="25"><div align='center'> - </div></td>
						<td width="25"><div align='center'> - </div></td>

					<?php }  // end else for $info['subject_id'] != ""?>
				    <td width="27"><div align="center"><?php echo $info['std_reg_no'];?></div></td>
				    <td width="65"><div align="center"><?php echo $info['std_address'];?></div></td>
			   
			 	</tr>
    	
	    		<?php if($count <= 21){
			
			 		 $count++;
			  
			  		}else{
			
					$count = 1;?>

					</table>
					<div style="page-break-after:always"></div>

		  		<?php } // end else for count check?>

			<?php } // end foreach for ghazet info

		}// end else for exam type check

	}else{
		echo "<p align=center>کوئ طالبعلم موجود نھیں ہے</p>";
	}?>
</body>
</html>