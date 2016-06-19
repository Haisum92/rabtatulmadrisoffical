<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- <link rel="stylesheet" href="/rabta/css/custom.css" type="text/css" /> -->
<title>Hifz-ul-Quran Attendance sheet</title>
<style type="text/css">
body {
  font-family: "Alvi Nastaleeq",Helvetica,Arial,sans-serif;
  font-size: 16px;
  line-height: 1.42857143;
  color: #333;
}
* {
		line-height: 20px;
}

.hifz-alquran-sheet {
	width: 100%;
	border: 1px solid #333;
}

.hifz-alquran-sheet tr td:last-child {
	/*min-width: 15px;*/
}

.hifz-alquran-sheet tr th {
	padding: 5px 10px;
	border-bottom: 1px solid;
}

.hifz-alquran-sheet tr th {
	border-left: 1px solid;
}

.hifz-alquran-sheet tr td img {
	margin: 0px !important;
	width: 75px !important;
	height: 65px !important;
	vertical-align: bottom;
}

.hifz-alquran-sheet tr td {
	min-width: 30px;
	height: 65px;
	text-align: center;
	border-bottom: 1px solid;
	border-left: 1px solid;
}

.hifz-alquran-sheet tr:last-child td {
	border-bottom: none;
}

.hifz-alquran-sheet tr th:first-child,
.hifz-alquran-sheet tr td:first-child {
	border-left: none;
}

.blocked-line {
	display: block;
}

.blocked-line .left {
	line-height: 0px;
	float: left;
	width: 170px;
}

.blocked-line .right {
	line-height: 0px;
	float: right;
}

.title {
	font-size: 30px !important;
	margin: 0px;
}

.sub-title {
	font-size: 20px;
}

.centerAlign {
	text-align: center;
}

.centerAlign .sig {
	width: 70px;
	float: left;
	margin-top: -27px;
}

.signew {
	width: 55px;
	float: right;
	margin-top: -25px;
	margin-right: 130px;
}

</style>
</head>

<body>
<?php
?>



  <?php 
  	if($student_data != NULL){
  		$count = 1;?>

 		<?php foreach ($student_data as $key => $sinfo) {?>

		  	
		  	<?php if($count == 1){?>
		  		<p class="centerAlign title">رابطۃ المدارس الاسلامیہ پاکستان</p>
				<p class="centerAlign sub-title"><?php echo $student_data[0]['exam_name'];?>
				<br/><?php echo $student_data[0]['exam_center_name_urdu'];?></p>
				<div class="blocked-line">
					<p class="left">پاس نمبر: 40</p>
					<p class="right">کل نمبر: 100</p>
				</div>
				<table class="hifz-alquran-sheet" cellspacing="0">
					<tr>
						<th style="max-width: 80px; width: 80px;">دستخط طالب علم</th>
						<th style="max-width: 80px; width: 80px; max-height: 80px; height: 80px;">تصویر</th>
						<th style="max-width: 50px; width: 50px;">حاصل کردہ نمبر</th>
						<th>سکول</th>
						<th>ولدیت</th>
						<th>نام طالب علم</th>
						<th style="max-width: 30px; width: 30px;">رول نمبر</th>
						<th style="max-width: 30px; width: 30px;">نمبر شمار</th>
					</tr>
			<?php }?>
						<tr>
							<td></td>
							<?php if($sinfo['std_image'] != "") {?>
								<td><img src='<?php echo base_url();?>student_images/<?php echo $sinfo['std_image'];?>' /></td>
							<?php }else{?>
								<td></td>
							<?php }?>
							<td></td>
							<td><?php echo $sinfo['affli_shortname'];?></td>
							<td><?php echo $sinfo['std_father_name'];?></td>
							<td><?php echo $sinfo['std_name'];?></td>
							<td><?php echo $sinfo['std_roll_no'];?></td>
							<td><?php echo $count;?></td>
						</tr>	  	

		  	<?php if($count %9 ==0){ ?>
		  	</table>
				<br/>
				<div class="blocked-line">
					<p class="left"><?php echo $sinfo['hifzulquran_exam_date']; ?> :منعقدہ تاریخ</p>
					<p class="right">_______________ :دستخط ممتحن</p>
				</div>
				<div style="page-break-after:always"></div>
				<p class="centerAlign title">رابطۃ المدارس الاسلامیہ پاکستان</p>
				<p class="centerAlign sub-title"><?php echo $student_data[0]['exam_name'].' '.$student_data[0]['exam_result_date_hijri'].'ھ';?>
				<br/><?php echo $student_data[0]['exam_center_name_urdu'];?></p>
				<div class="blocked-line">
					<p class="left">پاس نمبر: 40</p>
					<p class="right">کل نمبر: 100</p>
				</div>
				<table class="hifz-alquran-sheet" cellspacing="0">
					<tr>
						<th style="max-width: 80px; width: 80px;">دستخط طالب علم</th>
						<th style="max-width: 80px; width: 80px; max-height: 80px; height: 80px;">تصویر</th>
						<th style="max-width: 50px; width: 50px;">حاصل کردہ نمبر</th>
						<th>سکول</th>
						<th>ولدیت</th>
						<th>نام طالب علم</th>
						<th style="max-width: 30px; width: 30px;">رول نمبر</th>
						<th style="max-width: 30px; width: 30px;">نمبر شمار</th>
					</tr>
		  	<?php }?>
  
  		<?php $count++; }?>
  			</table>
  			<br/>
				<div class="blocked-line">
					<p class="left"><?php echo $sinfo['hifzulquran_exam_date']; ?> :منعقدہ تاریخ</p>
					<p class="right">_______________ :دستخط ممتحن</p>
				</div>
  <?php }else{?>
  
	<div class='notfounderror' style='color:#FFF; font-size:30px; background:#F03; text-align:center; border:1px solid #F00; ; padding:10px 10px 10px 10px; '>حاضری کا ریکا رڈ موجود نہیں ہے</div>

  <?php }?>
					   
</body>
</html>