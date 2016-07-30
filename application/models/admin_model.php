<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function login()
	{
		$data = array(
			'email' 		=> $this->input->post('email'),
			'password'	=> $this->input->post('password')
		);
		$this->db->where($data);
		$query = $this->db->get('members_info');
		if( $query->num_rows() == 1 ){
			return $query->row_array();
		}
		else{
			return NULL;
		}
	
	}// end function login

	public function createExam()
	{
		//echo '<pre>';print_r($_POST);echo '</pre>';die();
		$data = array(
					'class_id' 					=> $this->input->post('class_id'),
					'exam_name' 				=> $this->input->post('exam_name'),
					'exam_type_id' 				=> $this->input->post('exam_type'),
					'exam_year_dominic' 		=> $this->input->post('exam_year_dominic'),
					'exam_result_date_dominic' 	=> $this->input->post('exam_result_date_dominic'),
					'exam_result_date_hijri' 	=> $this->input->post('exam_result_date_hijri'),
					'exam_degree_date_dominic' 	=> $this->input->post('exam_degree_date_dominic'),
					'exam_degree_date_hijri' 	=> $this->input->post('exam_degree_date_hijri'),
					'exam_center' 				=> $this->input->post('exam_center'),
					'created_on'	 		    => date('Y-m-d H:i:s')
				);

		$this->db->insert('exam_info', $data);
		if($this->db->affected_rows() > 0)
		{
			 return $this->db->insert_id(); // to the controller
		}else{
			return NULL;	
		}

	}// end function createExam

	public function update_exam($exam_id)
	{
		//echo '<pre>';print_r($_POST);echo '</pre>';die();
		$data = array(
					'class_id' 					=> $this->input->post('class_id'),
					'exam_name' 				=> $this->input->post('exam_name'),
					'exam_type_id' 				=> $this->input->post('exam_type'),
					'exam_year_dominic' 		=> $this->input->post('exam_year_dominic'),
					'exam_year_hijri' 			=> $this->input->post('exam_year_hijri'),
					'exam_result_date_dominic' 	=> $this->input->post('exam_result_date_dominic'),
					'exam_result_date_hijri' 	=> $this->input->post('exam_result_date_hijri'),
					'exam_degree_date_dominic' 	=> $this->input->post('exam_degree_date_dominic'),
					'exam_degree_date_hijri' 	=> $this->input->post('exam_degree_date_hijri'),
					'exam_center' 				=> $this->input->post('exam_center')
				);
		$this->db->where('exam_info_id', $exam_id);
		$this->db->update('exam_info', $data);
		if($this->db->affected_rows() >= 0){
			return true;
		}else{
			return false;
		}

	}// end function update_exam

	public function get_all_classes($status = '')
	{

		if(empty($status)){
			
			$this->db->select('ci.*', false);
			$this->db->from('classes_info AS ci');	
			$this->db->where('ci.status','active');
			$this->db->order_by("ci.class_id","ASC");		
				
		}else{

			$this->db->select('ci.*', false);
			$this->db->from('classes_info AS ci');	
			$this->db->order_by("ci.class_id","ASC");			
		}

		$query = $this->db->get();
		if($query->num_rows() > 0){

			return $query->result_array();

		}else{

		 	return NULL;
		 	
		}

	}// end function get_all_classes

	public function get_all_exam_types()
	{
		$this->db->select('et.*', false);
		$this->db->from('exam_type AS et');	
		$this->db->order_by("et.et_id","ASC");
		$query = $query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
		 	return NULL;
		}

	}// end function get_all_exam_types

	public function get_all_exams()
	{

		$this->db->select('e.*', false);
		$this->db->from('exam_info AS e');
		$this->db->join('exam_type AS et','et.et_id = e.exam_type_id','left');
		$this->db->order_by("e.exam_info_id","DESC");
		$query = $query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
		 	return NULL;
		}

	}// end get_all_exams

	public function get_all_exams_for_view()
	{

		$this->db->select('e.*,et.*,cinfo.*', false);
		$this->db->from('exam_info AS e');
		$this->db->join('exam_type AS et','et.et_id = e.exam_type_id','left');
		$this->db->join('classes_info AS cinfo','cinfo.class_id = e.class_id','left');
		$this->db->order_by('e.exam_info_id','ASC');
		$query = $query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
		 	return NULL;
		}

	}// end get_all_exams_for_view

	public function get_all_exams_for_result()
	{
		$this->db->select('e.*', false);
		$this->db->from('exam_info AS e');
		$this->db->join('exam_type AS et','et.et_id = e.exam_type_id','left');
		$this->db->join('classes_info AS ct','ct.class_id = e.class_id','left');
		$this->db->where('ct.class_type !=','grade0');
		$this->db->where('ct.class_type !=','grade1');
		$this->db->order_by("e.exam_info_id","ASC");
		$query = $query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
		 	return NULL;
		}

	}// end get_all_exams_for_result

	public function validate_if_exam_allowed()
	{
		
		$exam_class_id = $this->get_exam_class_id($this->input->post('exam_id'));
		if ($exam_class_id == "" || $exam_class_id == NULL) return false;


		switch ($this->input->post('course_grade')) {

			case 'grade3':
					$where = "c.class_id = '".$exam_class_id."'
							  AND ( c.class_type = 'grade3'
							  OR c.class_type = 'grade5'
							  OR c.class_type = 'grade6'
							  OR c.class_type = 'grade7')";
					
					$query = $this->db->select('c.*')
									 ->from('classes_info AS c')
									 ->where($where)
									 ->get();
				break;
			case 'grade0':
			case 'grade1':
			case 'grade2':
			case 'grade4':
					$query = $this->db->select('c.*')
										->from('classes_info AS c')
										->where('c.class_id',$exam_class_id)
										->where('c.class_type',$this->input->post('course_grade'))
										->get();

				break;
			default:
				return false;
				break;
		}

			if ($query->num_rows() > 0) {
				return true;
			}else{
				return false;
			}

	}// end function validate_if_exam_allowed

	public function get_exam_class_id($exam_id = '')
	{
		if (empty($exam_id)) {
			return NULL;
		}
		$this->db->select('einfo.class_id');
		$this->db->from('exam_info AS einfo');
		$this->db->where('einfo.exam_info_id',$exam_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->class_id;
		}

	}// end function get_exam_class_id

	public function get_single_exam_info_id($exam_id ='')
	{
		if (empty($exam_id)) {
			return NULL;
		}
		$this->db->select('einfo.*,cinfo.*,et.*',false);
		$this->db->from('exam_info AS einfo');
		$this->db->join('classes_info AS cinfo','cinfo.class_id = einfo.class_id','left');
		$this->db->join('exam_type AS et','et.et_id = einfo.exam_type_id','left');
		$this->db->where('einfo.exam_info_id',$exam_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			// $row = $query->row();
			// return $row->exam_name;
			return $query->result_array();
		}else{
			return NULL;
		}
	
	}// end function get_single_exam_info_id

	public function get_class_info_by_exam_id($exam_id = '')
	{
		if (empty($exam_id)) {
			return NULL;
		}
		$this->db->select('c.*',false);
		$this->db->from('classes_info AS c');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			// $row = $query->row();
			// return $row->exam_name;
			return $query->result_array();
		}else{
			return NULL;
		}

	}// end function get_class_info_by_exam_id

	public function get_single_class_info_id($class_id ='')
	{
		if (empty($class_id)) {
			return NULL;
		}
		$this->db->select('cinfo.*',false);
		$this->db->from('classes_info AS cinfo');
		$this->db->where('cinfo.class_id',$class_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			// $row = $query->row();
			// return $row->exam_name;
			return $query->result_array();
		}else{
			return NULL;
		}
	
	}// end function get_single_class_info_id

	public function add_class()
	{
		$data = array(
					'class_name_urdu' => $this->input->post('class_name_urdu'), 
					'class_name_eng' => $this->input->post('class_name_eng'), 
					'class_type' => $this->input->post('class_type'), 
					'date' => date("Y-m-d H:i:s")
				);
		$this->db->insert('classes_info',$data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}else{
			return NULL;
		}

	}// end function add_class

	public function update_class($class_id)
	{
		//echo '<pre>';print_r($_POST);echo '</pre>';die();
		$data = array(
					'class_name_urdu' 	=> $this->input->post('class_name_urdu'),
					'class_name_eng' 	=> $this->input->post('class_name_eng'),
					'class_type' 		=> $this->input->post('class_type')
				);
		$this->db->where('class_id', $class_id);
		$this->db->update('classes_info', $data);
		if($this->db->affected_rows() >= 0){
			return true;
		}else{
			return false;
		}

	}// end function update_class

	public function delete_class($class_id ='')
	{
		$data = array(
					'status' 	=> 'delete'
				);
		$this->db->where('class_id', $class_id);
		// print_r($data);die();
		$this->db->update('classes_info', $data);
		if($this->db->affected_rows() >= 0){
			return true;
		}else{
			return false;
		}

	}// end function delete_class

	public function get_class_and_exam_info_by_exam_id($exam_id = '')
	{
		if (empty($exam_id)) {
			return NULL;
		}
		$this->db->select('cinfo.*,einfo.*',false);
		$this->db->from('classes_info AS cinfo');
		$this->db->join('exam_info AS einfo','einfo.class_id = cinfo.class_id','left');
		$this->db->where('einfo.exam_info_id',$exam_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}
	
	}// end function get_class_and_exam_info_by_exam_id

	public function get_all_examination_center_info()
	{
		$query = $this->db->select('ecinfo.*,dinfo.*,pinfo.*',false)
						  ->from('examination_center_info AS ecinfo')
						  ->join('district_info AS dinfo','dinfo.d_id = ecinfo.exam_center_district','left')
						  ->join('province_info AS pinfo','pinfo.prov_id = dinfo.district_province','left')
						  ->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}
	
	}// end function get_all_examination_center_info

	public function get_all_subject_info_by_class_id($class_id ='')
	{
		if (empty($class_id)) {
			return NULL;
		}
		$query = $this->db->select('sinfo.*',false)
		         ->from('subject_info AS sinfo')
		         ->where('sinfo.class_id',$class_id)
		         ->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}

	}// end function get_all_subject_info_by_class_id

	public function get_all_classses()
	{
		// mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $conn);
		// $query =  $this->db->query("SET character_set_results = 'utf8',
		// 						   character_set_client = 'utf8',
		// 						    character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		$result = $query->get();

		$query = $this->db->select('cinfo.*',false)->from('classes_info AS cinfo')->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}

	}// end function get_all_classess

	public function get_new_reg_info_old($exam_id = '')
	{
		if (empty($exam_id)) {
			return NULL;
		}

		#query to generate roll_no_and_reg_no depending upon the exam id
		// $query = $this->db->select_max('sinfo.std_roll_no', 'roll_no')
		//                   ->select_max('sinfo.std_reg_no', 'reg_no')
		//          		  ->from('result_info AS rinfo')
		//          		  ->join('student_info AS sinfo','sinfo.std_reg_no = rinfo.std_reg_no','left')
		//          		  ->where('rinfo.exam_id',$exam_id)
		//          		  ->get();

		#general query for retrieving the roll_no and reg_no
		// $query = $this->db->select_max('sinfo.std_roll_no', 'roll_no')
		//                   ->select_max('sinfo.std_reg_no', 'reg_no')
		//          		  ->from('student_info AS sinfo')
		//          		  ->get();


		$query = $this->db->select_max('sinfo.std_roll_no', 'roll_no')
		                  ->select_max('sinfo.std_reg_no', 'reg_no')
		         		  ->from('student_info AS sinfo')
		         		  ->get();

		if ($query->num_rows() > 0) {

			$row = $query->row();

			if ($row->roll_no != "" && $row->reg_no != "") {

				// $new_roll_no = $this->generate_new_roll_no((int)$row->roll_no);
				$new_reg_no = $this->generate_new_reg_no((int)$row->reg_no);
				$new_roll_no = (int)$row->roll_no + 1;
				return array('roll_no' => $new_roll_no, 'reg_no' => $new_reg_no);

			}else{

				// $query = $this->db->select('einfo.exam_year_dominic',false)
			    //     		  ->from('exam_info AS einfo')
			 	//    		  ->where('einfo.exam_info_id',$exam_id)
			 	//     		  ->get();
				// if ($query->num_rows() > 0) {
				// 	$row = $query->row();
				// 	return $hijri_date_array = $this->gregorian_to_hijri(strtotime($row->exam_year_dominic));
				// }
				$query = $this->db->select_max('sinfo.std_roll_no', 'roll_no')
		                  ->select_max('sinfo.std_reg_no', 'reg_no')
		         		  ->from('student_info AS sinfo')
		         		  ->get();
				$new_reg_no  = $this->generate_new_reg_no();

			}
		}else{
			echo "here";
			$query = $this->db->select('einfo.exam_year_dominic',false)
			         		  ->from('exam_info_id AS einfo')
			         		  ->get();
			if ($query->num_row() > 0) {
				$row =  $query->row();

				return $this->gregorian_to_hijri(strtotime($row->exam_year));
			}
		}

	}// end function get_new_reg_info_old

	public function get_new_reg_no($exam_id = '')
	{
		$exam_year = $this->get_exam_year($exam_id);
		// echo '<pre>';print_r($exam_year);echo '</pre>';
		$query = $this->db->select_max('sinfo.std_reg_no','reg_no')
							->from('student_info As sinfo')
							->like('sinfo.std_reg_no',$exam_year[1],'after')
							->get();
		// echo $this->db->last_query();
		
		if ($query->num_rows() > 0) {
			// echo '<pre>';print_r($query->result_array());echo '</pre>';
			// echo 'we are here'; die();
			$row = $query->row();
			

			if ($row->reg_no != "") {
				// $new_roll_no = $this->generate_new_roll_no((int)$row->roll_no);
				// echo 'we are here'; die();
				// echo 'old registration no:'.$row->reg_no;
				// die();
				return intval($row->reg_no) +1;

			}else{

				return $this->generate_new_reg_no();
			}

		}else{

			return $this->generate_new_reg_no();
		}

	}// end function get_new_reg_no

	public function get_new_roll_no($exam_id = '',$class_id = '')
	{
		if (empty($exam_id) or empty($class_id)) {
			return NULL;
		}

		$query = $this->db->select_max('sinfo.std_roll_no', 'roll_no')
		         		  ->from('student_info AS sinfo')
		         		  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
		         		  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
		         		  ->join('classes_info AS cinfo','cinfo.class_id = seinfo.class_id','left')
		         		  ->where('seinfo.exam_id',$exam_id)
		         		  ->where('seinfo.class_id',$class_id)
		         		  ->get();

		if ($query->num_rows() > 0) {
			
			$row = $query->row();

			if ($row->roll_no != "") {
				// $new_roll_no = $this->generate_new_roll_no((int)$row->roll_no);
				// $new_reg_no = $this->generate_new_reg_no((int)$row->reg_no);
				// echo (int)$row->roll_no + 1;
				return (int)$row->roll_no + 1;

			}else{
				return '1';
			}
		}else{
			return '1';
		}

	}// end function get_new_roll_no

	public function get_exam_year($exam_id ='')
	{
		$query = $this->db->select('exam_year_dominic,exam_year_hijri')
							->from('exam_info')
							->where('exam_info_id',$exam_id)
							->get();
		if ($query->num_rows() > 0) {

			$row = $query->row_array();

			return array($row['exam_year_dominic'],$row['exam_year_hijri']);

		}else{

			return NULL;
		}

	}// end function get_exam_year

	public function islamic_month_names($i) // $i = 1..12
    {
        static $month  = array(
            "Muharram", "Safar", "Rabi’ al-awwal", "Rabi’ al-thani",
            "Jumada al-awwal", "Jumada al-thani", "Rajab", "Sha’ban",
            "Ramazan", "Shawwal", "Dhu al-Qi’dah", "Dhu al-Hijjah"
        );
        return $month[$i-1];

    }// end function islamic_month_names

    private function gregorian_to_hijri($time = null)
    {
        if ($time === null) $time = time();
        $m = date('m', $time);
        $d = date('d', $time);
        $y = date('Y', $time);
        return $this->JD_to_hijri(
            cal_to_jd(CAL_GREGORIAN, $m, $d, $y));
    
    }// end function gregorian_to_hijri

    private function hijri_to_gregorian($m, $d, $y)
    {
        return jd_to_cal(CAL_GREGORIAN,
            $this->hijri_to_JD($m, $d, $y));

    }// end function hijri_to_gregorian

    # Julian Day Count To Hijri
    private function JD_to_hijri($jd)
    {
        $jd = $jd - 1948440 + 10632;
        $n  = (int)(($jd - 1) / 10631);
        $jd = $jd - 10631 * $n + 354;
        $j  = ((int)((10985 - $jd) / 5316)) *
            ((int)(50 * $jd / 17719)) +
            ((int)($jd / 5670)) *
            ((int)(43 * $jd / 15238));
        $jd = $jd - ((int)((30 - $j) / 15)) *
            ((int)((17719 * $j) / 50)) -
            ((int)($j / 16)) *
            ((int)((15238 * $j) / 43)) + 29;
        $m  = (int)(24 * $jd / 709);
        $d  = $jd - (int)(709 * $m / 24);
        $y  = 30*$n + $j - 30;

        return array($m, $d, $y);

    }// end function JD_to_hijri

    # Hijri To Julian Day Count
    private function hijri_to_JD($m, $d, $y)
    {
        return (int)((11 * $y + 3) / 30) +
            354 * $y + 30 * $m -
            (int)(($m - 1) / 2) + $d + 1948440 - 385;

    }// end function hijri_to_JD

    private function generate_new_reg_no($old_reg_no = '')
    {
    	// echo 'we are here';die();
    	$hijri_year = $this->gregorian_to_hijri();
    	// echo '<br/>';
    	$hijri_year   = $hijri_year[2]; // like 1436 for 2015 [current year]
    	
    	if (empty($old_reg_no)) {
	    	$hijri_year = str_pad($hijri_year, 8, "0", STR_PAD_RIGHT);  // produces "-=-=-Alien"
	    	$hijri_year .= '1';
	    	return $hijri_year;	
    	
    	}else{
			
			$temp_array = str_split($old_reg_no);
			// echo '<br/>';
    		$temp_year  = $temp_array[0].$temp_array[1].$temp_array[2].$temp_array[3];
    		// echo '<br/>';
    		$temp_year  = intval($temp_year);
    		// echo '<br/>';
    		if ($temp_year == $hijri_year) {
    			// echo 'we are here';die();
    			return $old_reg_no + 1;
    			// echo "here";
    			// $temp_vals =  $temp_array[4].$temp_array[5].$temp_array[6].$temp_array[7].$temp_array[8];
    			// $temp_vals =  intval($temp_vals);
    			// return $temp_vals + 1;
    		}else{
    			// echo 'we are here in else';
    			// echo '<br/>';
    			// echo $hijri_year;
    			// echo '<br/>';
    			// echo $temp_year;
    			if ($hijri_year > $temp_year) {
    				// echo 'old_reg_no'; die();
    				$reg_no = str_pad($hijri_year, 8, "0", STR_PAD_RIGHT);  // produces "-=-=-Alien"
			    	$reg_no .= '1';
			    	// $reg_no = intval($reg_no) + 1;
			    	$reg_no = intval($reg_no);
			    	return $reg_no;
    			}
    		}

    	}

    }// end function generate_new_reg_no

    public function check_if_registration_no_exits($old_institute_reg_no ='')
    {
    	$query = $this->db->select('ainfo.*',false)
    					  ->from('affiliation_info AS ainfo')
    					  ->where('ainfo.inst_reg_no',$old_institute_reg_no)
    					  ->get();
    	if ($query->num_rows() > 0) {
    		return true;
    	}else{
    		return false;
    	}
   
    }// end function check_if_registration_no_exits

    public function check_if_registration_no_exits_except_current($old_institute_reg_no ='')
    {
    	$query = $this->db->select('ainfo.*',false)
    					  ->from('affiliation_info AS ainfo')
    					  ->where('ainfo.inst_reg_no',$old_institute_reg_no)
    					  ->get();
    	if ($query->num_rows() > 0) {
    		return true;
    	}else{
    		return false;
    	}
   
    }// end function check_if_registration_no_exits_except_current

    public function add_new_student($userimage = '')
    {
    	//echo '<pre>';print_r($_POST);echo '</pre>';die();$userimage['file_name']
    	if ($userimage != "") {

    		$data = array(
					'std_name' 				=> $this->input->post('name'),
					'std_father_name' 		=> $this->input->post('father_name'),
					'std_id_card_no' 		=> $this->input->post('id_card_no'),
					'std_dob_eng' 			=> $this->input->post('dob_eng'),
					'std_dob_urdu' 			=> $this->input->post('dob_urdu'),
					'std_institute_reg_no' 	=> $this->input->post('old_institute_reg_no'),
					'std_address' 			=> $this->input->post('address'),
					'std_image' 			=> $userimage['file_name'],
					'std_reg_no' 			=> $this->input->post('reg_no'),
					'std_roll_no' 			=> $this->input->post('roll_no'),
					'created_on'	 		=> date('Y-m-d H:i:s')
				);

    	}else{

			$data = array(
					'std_name' 				=> $this->input->post('name'),
					'std_father_name' 		=> $this->input->post('father_name'),
					'std_id_card_no' 		=> $this->input->post('id_card_no'),
					'std_dob_eng' 			=> $this->input->post('dob_eng'),
					'std_dob_urdu' 			=> $this->input->post('dob_urdu'),
					'std_institute_reg_no' 	=> $this->input->post('old_institute_reg_no'),
					'std_address' 			=> $this->input->post('address'),
					'std_image' 			=> '',
					'std_reg_no' 			=> $this->input->post('reg_no'),
					'std_roll_no' 			=> $this->input->post('roll_no'),
					'created_on'	 		=> date('Y-m-d H:i:s')
				);
    	
    	}

		$this->db->insert('student_info', $data);
		
		if($this->db->affected_rows() > 0)
		{
			$lc_std_id = $this->db->insert_id();// this is the id inserted into the studnet table

			if ($lc_std_id != "") {
					 	
				 	$data = array(
						'std_id' 			=> $lc_std_id,
						'exam_id' 			=> $this->input->post('exam_id'),
						'class_id' 			=> $this->input->post('class_id'),
						'exam_center_id' 	=> $this->input->post('exam_center'),
					);

				$this->db->insert('student_exam_info', $data);

				if($this->db->affected_rows() > 0){

					return $this->db->insert_id(); // returning new created to the controller
				
				}// end if for affected rows

			 } // end if for $lc_std_id
		
		}else{

			return NULL;

		}

    }// end function add_new_student


    public function get_single_student_info_by_reg_no($reg_no = '',$coming_from = '')
    {
    	if (empty($reg_no)) {
    		return NULL;
    	}

    	if (!empty($coming_from) and $coming_from == "third_attempt") {
    	
    		$query = $this->db->select('sinfo.*,seinfo.*,cinfo.*',false)
						  ->from('student_info AS sinfo')
						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id')
						  ->join('classes_info AS cinfo','cinfo.class_id = seinfo.class_id')
						  ->where('sinfo.std_reg_no',$reg_no)
						  ->order_by('sinfo.std_id','DESC')
   						  ->limit(1)
						  ->get();
    	
    	}else{

    		$query = $this->db->select('sinfo.*,seinfo.*,cinfo.*',false)
						  ->from('student_info AS sinfo')
						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id')
						  ->join('classes_info AS cinfo','cinfo.class_id = seinfo.class_id')
						  ->where('sinfo.std_reg_no',$reg_no)
						  ->get();
    	}


		if ($query->num_rows() > 0) {
			// echo '<pre>';print_r($query->result_array());echo '</pre>';
			// die();
			return $query->result_array();

		}

    }// end function get_single_student_info_by_reg_no

    public function get_single_student_info_by_id($std_id = '')
    {
    	if (empty($std_id)) {
    		return NULL;
    	}
    		
    		$query = $this->db->query('SELECT sinfo.*, `einfo`.*,`ainfo`.*
										  FROM student_info AS sinfo 
										  LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
										  LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
										  LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
										  WHERE `sinfo`.`std_id` = '.$std_id.'
										  ORDER BY sinfo.std_roll_no ASC');

		if ($query->num_rows() > 0) {
			// echo '<pre>';print_r($query->result_array());echo '</pre>';
			// die();
			return $query->result_array();

		}

    }// end function get_single_student_info_by_id

    public function get_single_student_attempt_no_id($std_id = '')
    {
    	if (empty($std_id)) {
    		return NULL;
    	}
    		$query = $this->db->select("attempt_no")
    							->where('std_id',$std_id)
    							->get('student_info');

		if ($query->num_rows() > 0) {
			$d_r = $query->result_array();
			/*echo '<pre>';print_r($d_r[0]['attempt_no']);echo '</pre>';
			echo '<pre>';print_r($d_r[0]['attempt_no']);echo '</pre>';
			die();*/
			return $d_r[0]['attempt_no'];

		}

    }// end function get_single_student_attempt_no_id

    public function get_single_student_info_by_reg_no_old($reg_no = '')
    {
    	if (empty($reg_no)) {
    		return NULL;
    	}

    	$query = $this->db->select('sinfo.*,seinfo.*,cinfo.*',false)
						  ->from('student_info AS sinfo')
						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id')
						  ->join('classes_info AS cinfo','cinfo.class_id = seinfo.class_id')
						  ->where('sinfo.std_reg_no',$reg_no)
						  ->get();

		if ($query->num_rows() > 0) {
			// echo '<pre>';print_r($query->result_array());echo '</pre>';
			// die();
			return $query->result_array();

		}

    }// end function get_single_student_info_by_reg_no_old

    public function get_all_students($limit = '',$offset = '')
    {
    	$query = $this->db->select('sinfo.*',false)
    					  ->from('student_info AS sinfo')
    					  ->limit($limit,$offset)
    					  ->get();
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	}
	
	}// end function get_all_students

	public function get_student_record_rows($exam_id = '')
	{
		$query = $this->db->select('sinfo.*')
						  ->from('student_info AS sinfo')
						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id')
						  ->where('seinfo.exam_id',$exam_id)
						  ->get();
		if($query->num_rows() > 0){

			return $query->num_rows();

		}else{
			return NULL;
		}

	}// end function get_student_record_rows

	public function get_all_student_record_rows()
	{
		$query = $this->db->select('sinfo.*')
						  ->from('student_info AS sinfo')
						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id')
						  ->get();
		if($query->num_rows() > 0){

			return $query->num_rows();

		}else{
			return NULL;
		}

	}// end function get_all_student_record_rows

	public function get_student_result_info($exam_id = '',$std_id = '',$exam_type = '1',$attempt_no = "first")
	{
		if ($exam_type == 2) {

			$query = $this->db->select('sinfo.*,sinfo.std_id AS student_id,rpsrinfo.*,rpsrinfo.rsrinfo_id AS rinfo_id')
						  ->from('student_info AS sinfo')
						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
						  ->join('repeat_student_result_info AS rpsrinfo','rpsrinfo.std_id = sinfo.std_id','left')
						  ->where('seinfo.exam_id',$exam_id)
						  ->where('sinfo.std_id',$std_id)
						  ->order_by('rpsrinfo.subject_id','ASC')
						  ->get();
		}else{

			if ($attempt_no == "first") {

				$query = $this->db->select('sinfo.*,sinfo.std_id AS student_id,rinfo.*')
						  ->from('student_info AS sinfo')
						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
						  ->join('result_info AS rinfo','rinfo.std_id = sinfo.std_id','left')
						  ->where('seinfo.exam_id',$exam_id)
						  ->where('sinfo.std_id',$std_id)
						  ->order_by('rinfo.subject_id','ASC')
						  ->get();

			}elseif ($attempt_no == "second") {

				$query = $this->db->select('sinfo.*,sinfo.std_id AS student_id,rpsrinfo.*,rpsrinfo.rsrinfo_id AS rinfo_id')
						  ->from('student_info AS sinfo')
						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
						  ->join('repeat_student_result_info AS rpsrinfo','rpsrinfo.std_id = sinfo.std_id','left')
						  ->where('seinfo.exam_id',$exam_id)
						  ->where('sinfo.std_id',$std_id)
						  ->order_by('rpsrinfo.subject_id','ASC')
						  ->get();

			}elseif ($attempt_no == "third") {

				$query = $this->db->select('sinfo.*,sinfo.std_id AS student_id,rpsrinfo.*,rpsrinfo.rsrinfo_id AS rinfo_id')
						  ->from('student_info AS sinfo')
						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
						  ->join('repeat_student_result_info AS rpsrinfo','rpsrinfo.std_id = sinfo.std_id','left')
						  ->where('seinfo.exam_id',$exam_id)
						  ->where('sinfo.std_id',$std_id)
						  ->order_by('rpsrinfo.subject_id','ASC')
						  ->get();
			}else{

				$query = $this->db->select('sinfo.*,sinfo.std_id AS student_id,rpsrinfo.*,rpsrinfo.rsrinfo_id AS rinfo_id')
						  ->from('student_info AS sinfo')
						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
						  ->join('repeat_student_result_info AS rpsrinfo','rpsrinfo.std_id = sinfo.std_id','left')
						  ->where('seinfo.exam_id',$exam_id)
						  ->where('sinfo.std_id',$std_id)
						  ->order_by('rpsrinfo.subject_id','ASC')
						  ->get();

			}
			
		}
		
		// echo $this->db->last_query();
		if($query->num_rows() > 0){
			// echo '<pre>';print_r($query->result_array());echo '</pre>';
			// die('yoho!');
			return $query->result_array();

		}else{

			return NULL;
		}

	}// end function get_student_result_info

	public function get_all_students_by_exam($exam_id = '',$limit = '',$offset = '')
    {
    	if (empty($exam_id)) {
    		return NULL;
    	}

    	if(isset($_POST['registeration_no']) and $_POST['registeration_no'] != ""){

    		// echo '<pre>';print_r($_POST);echo '</pre>';
    		$query = $this->db->select('sinfo.*',false)
    					  ->from('student_info AS sinfo')
    					  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
    					  ->where('seinfo.exam_id',$exam_id)
    					  ->where('sinfo.std_reg_no', $this->input->post('registeration_no'))
    					  // ->limit($limit,$offset)
    					  ->get();
    		// echo $this->db->last_query();
    	}elseif(isset($_POST['roll_no']) and $_POST['roll_no'] != ""){
    		// echo '<pre>';print_r($_POST);echo '</pre>';
    		$query = $this->db->select('sinfo.*',false)
    					  ->from('student_info AS sinfo')
    					  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
    					  ->where('seinfo.exam_id',$exam_id)
    					  ->where('sinfo.std_roll_no', $this->input->post('roll_no'))
    					  // ->limit($limit,$offset)
    					  ->get();
    		// echo $this->db->last_query();			
    	}else{

    		$query = $this->db->select('sinfo.*',false)
    					  ->from('student_info AS sinfo')
    					  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
    					  ->where('seinfo.exam_id',$exam_id)
    					  ->limit($limit,$offset)
    					  ->get();
    		// echo $this->db->last_query();
    	}
    	

    	if ($query->num_rows() > 0) {

    		return $query->result_array();

    	}
	
	}// get_all_students_by_exam

	public function get_all_students_ten_course_male()
    {
    	$query = $this->db->select('sinfo.*',false)
    					  ->from('student_info AS sinfo')
    					  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
    					  ->where('seinfo.exam_id',5)
    					  ->get();
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	}
	
	}// end function get_all_students_ten_course_male

	public function get_all_students_ten_course_female()
    {
    	$query = $this->db->select('sinfo.*',false)
    					  ->from('student_info AS sinfo')
    					  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
    					  ->where('seinfo.exam_id',8)
    					  ->get();
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	}
	
	}// end function get_all_students_ten_course_female

	public function view_student_info($student_id = '')
	{
		$query = $this->db->select('sinfo.*,einfo.*,cinfo.*,excinfo.*',false)
    					  ->from('student_info AS sinfo')
    					  ->join('student_exam_info AS sxinfo','sxinfo.std_id = sinfo.std_id','left')
    					  ->join('exam_info AS einfo','einfo.exam_info_id = sxinfo.exam_id','left')
    					  ->join('examination_center_info AS excinfo','excinfo.eci_id = sxinfo.exam_center_id','left')
    					  ->join('classes_info AS cinfo','cinfo.class_id = sxinfo.class_id','left')
    					  ->where('sinfo.std_id',$student_id)
    					  ->get();
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	}else{
    		return NULL;
    	}

	}// end function get_all_students

	public function delete_student($student_id ='')
	{
		/*echo '<pre>';print_r($student_id);echo '</pre>';
		die('yoho!');*/
		$this->db->where('std_id', $student_id)->delete('repeat_student_result_info');
		$this->db->where('std_id', $student_id)->delete('result_info');
		$this->db->where('std_id', $student_id)->delete('student_exam_info');
		$this->db->where('std_id', $student_id)->delete('student_info');

		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	
	}// end function delete_student

	public function update_student_info($userimage = '', $student_id ='')
	{
		//echo '<pre>';print_r($_POST);echo '</pre>';die();$userimage['file_name']

    	if ($userimage != "") {

    		$data = array(
					'std_name' 				=> $this->input->post('name'),
					'std_father_name' 		=> $this->input->post('father_name'),
					'std_id_card_no' 		=> $this->input->post('id_card_no'),
					'std_dob_eng' 			=> $this->input->post('dob_eng'),
					'std_dob_urdu' 			=> $this->input->post('dob_urdu'),
					'std_institute_reg_no' 	=> $this->input->post('old_institute_reg_no'),
					'std_address' 			=> $this->input->post('address'),
					'std_image' 			=> $userimage['file_name']
				);

    	}else{

			$data = array(
					'std_name' 				=> $this->input->post('name'),
					'std_father_name' 		=> $this->input->post('father_name'),
					'std_id_card_no' 		=> $this->input->post('id_card_no'),
					'std_dob_eng' 			=> $this->input->post('dob_eng'),
					'std_dob_urdu' 			=> $this->input->post('dob_urdu'),
					'std_institute_reg_no' 	=> $this->input->post('old_institute_reg_no'),
					'std_address' 			=> $this->input->post('address')
				);
    	// echo '<pre>';print_r($data);echo '</pre>';die();
		// echo $student_id;
    	// echo '<pre>';print_r($_POST);echo '</pre>';die();
    	}// end if for user image
    	$this->db->where('std_id', $student_id);
    	$this->db->update('student_info', $data);
		if($this->db->affected_rows() >= 0)
		{
			// $lc_std_id = $this->db->insert_id();// this is the id inserted into the studnet table

			// if ($lc_std_id != "") {
					 	
			 	$data = array(
					'exam_center_id' 	=> $this->input->post('exam_center'),
				);

				$this->db->where('std_id', $student_id);
				$this->db->update('student_exam_info', $data);

				if($this->db->affected_rows() >= 0){

					return true; // returning new created to the controller
				
				}// end if for affected rows

			 // } // end if for $lc_std_id
		
		}else{

			return false;

		}
	
	}

	public function get_current_user_info($user_id = '')
	{
		if (empty($user_id)) {
			return NULL;
		}
		$query = $this->db->select('minfo.*',false)
						 ->from('members_info AS minfo')
						 ->where('minfo.mem_id',$user_id)
						 ->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}
	
	}// end function get_current_user

	public function update_account_settings()
	{
		if ($this->input->post('password') != "" and $this->input->post('confirm_password') != "") {

				if ( $this->input->post('password') == $this->input->post('confirm_password') ) {
					
					$data = array(
								'password' => $this->input->post('password')
							);

				} else {
					return false;
				}
			$this->db->where('mem_id', 1);
			$this->db->update('members_info', $data);
			if ($this->db->affected_rows() >= 0) {
				return true;
			}else{
				return false;
			}
		} 
	
	}// end function update_account_settings	

	public function get_all_provinces()
	{
		$query = $this->db->select('pinfo.*',false)
						  ->from('province_info AS pinfo')
						  ->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}

	}// end function get_all_provinces

	public function get_single_province_info($prov_id ='')
	{
		if (empty($prov_id)) {
			return NULL;
		}
		$query = $this->db->select('pinfo.*',false)
						  ->from('province_info AS pinfo')
						  ->where('pinfo.prov_id',$prov_id)
						  ->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}
	
	}// end function get_single_province_info

	public function add_province()
	{
		$data = array(
					'prov_name_urdu' => $this->input->post('prov_name_urdu'),
					'prov_name_eng' => $this->input->post('prov_name_eng')
				);
		$this->db->insert('province_info', $data);
		if($this->db->affected_rows() > 0){
			return $this->db->insert_id();
		}else{
			return NULL;
		}
	
	}// end function add_province

	public function update_province($prov_id ='')
	{
		if (empty($prov_id)) {
			return false;
		}
		$data = array(
					'prov_name_urdu' => $this->input->post('prov_name_urdu'),
					'prov_name_eng' => $this->input->post('prov_name_eng')
				);
		$this->db->where('prov_id', $prov_id);
		$this->db->update('province_info', $data);
		if($this->db->affected_rows() >= 0){
			return true;
		}else{
			return false;
		}
	
	}// end function update_province

	public function get_all_districts_for_view()
	{
		$query = $this->db->select('dinfo.*,pinfo.*',false)
						  ->from('district_info AS dinfo')
						  ->join('province_info AS pinfo','pinfo.prov_id = dinfo.district_province','left')
						  ->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}
	
	}// end function get_all_districts_for_view

	public function get_all_districts_by_province($prov_id = '')
	{
		$query = $this->db->select('dinfo.*',false)
						  ->from('district_info AS dinfo')
						  // ->join('province_info AS pinfo','pinfo.prov_id = cinfo.district_province','left')
						  ->where('dinfo.district_province',$prov_id)
						  ->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}
	
	}// end function get_all_districts_by_province

	public function get_single_district_info_id($d_id ='')
	{
		if (empty($d_id)) {
			return NULL;
		}
		$query = $this->db->select('dinfo.*,pinfo.*',false)
						  ->from('district_info AS dinfo')
						  ->join('province_info AS pinfo','pinfo.prov_id = dinfo.district_province')
						  ->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}

	}// end function get_single_district_info_id

	public function add_district()
	{
		$data = array(
					'district_name_urdu' => $this->input->post('district_name_urdu'), 
					'district_name_eng' => $this->input->post('district_name_eng'), 
					'district_province' => $this->input->post('district_province'), 
					'created_on' => date("Y-m-d H:i:s")
				);
		$this->db->insert('district_info',$data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}else{
			return NULL;
		}

	}// end function add_district

	public function delete_district($d_id ='')
	{
		$this->db->where('d_id', $d_id)->delete('district_info');
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return NULL;
		}
	
	}// end function delete_district

	public function update_district($d_id)
	{
		// echo '<pre>';print_r($_POST);echo '</pre>';die();
		$data = array(
					'district_name_urdu' 	=> $this->input->post('district_name_urdu'),
					'district_name_eng' 	=> $this->input->post('district_name_eng'),
					'district_province'		=> $this->input->post('district_province')
				);
		// echo '<pre>';print_r($data);echo '</pre>';die();
		$this->db->where('d_id', $d_id);
		$this->db->update('district_info', $data);
		if($this->db->affected_rows() >= 0){
			return true;
		}else{
			return false;
		}

	}// end function update_district

	public function add_examination_center()
	{
		// $data = array(
		// 			'exam_center_name_urdu' => $this->input->post('exam_center_name_urdu'),
		// 			'exam_center_name_eng' => $this->input->post('exam_center_name_eng'),
		// 			'exam_center_district' => $this->input->post('exam_center_district'),
		// 			'exam_center_address' => $this->input->post('exam_center_address'),
		// 			'created_on' => date("Y-m-d H:i:s")
		// 	 	);

		$data = array(
					'exam_center_name_urdu' => $this->input->post('exam_center_name_urdu'),
					'exam_center_name_eng' => '',
					'exam_center_district' => $this->input->post('exam_center_district'),
					'exam_center_address' => $this->input->post('exam_center_address'),
					'created_on' => date("Y-m-d H:i:s")
			 	);	
		$this->db->insert('examination_center_info',$data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}
	
	}// end function add_examination_center

	public function update_examination_center($eci_id)
	{
		// echo '<pre>';print_r($_POST);echo '</pre>';die();
		$data = array(
					'exam_center_name_urdu' 	=> $this->input->post('exam_center_name_urdu'),
					'exam_center_district'		=> $this->input->post('exam_center_district')
				);
		$this->db->where('eci_id', $eci_id);
		$this->db->update('examination_center_info', $data);
		if($this->db->affected_rows() >= 0){
			return true;
		}else{
			return false;
		}
	
	}// end function update_examination_center

	public function get_examination_center_info($eci_id ='')
	{
		$query = $this->db->select('ecinfo.*,dinfo.*,pinfo.*',false)
						  ->from('examination_center_info AS ecinfo')
						  ->join('district_info AS dinfo','dinfo.d_id = ecinfo.exam_center_district','left')
						  ->join('province_info AS pinfo','pinfo.prov_id = dinfo.district_province','left')
						  ->where('ecinfo.eci_id',$eci_id)
						  ->get();
		if ($query->num_rows() > 0 ) {
			return $query->result_array();
		}else{
			return NULL;
		}
	
	}// end function examination_center_info

	public function delete_examination_center($eci_id ='')
	{
		$this->db->where('eci_id', $eci_id)->delete('examination_center_info');
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	
	}// end function delete_examination_center
	
	public function get_all_old_examination_centers()
	{
		$query = $this->db->select('examcinfo.*',false)
						  ->from('examcenter_info AS examcinfo')
						  ->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
			// echo '<pre>';print_r($query->result_array());echo "</pre>";
			?>
			<!-- <select>
				<?php foreach ($query->result_array() as $key => $oldCenters) {?>
					<option><?php echo $oldCenters['examcenter_name'];?></option>
				<?php }?>
			</select> -->
			<?php
		}else{
			echo "We are here";
		}
	
	}// end function updateExaminationCenters

	public function affiliate_new_institute()
	{
		// echo '<pre>';print_r($_POST);echo '</pre>';
		// 'affli_classgrade' 	=> $this->input->post('registration_no'),
		$affli_classgrade = '';
		if (isset($_POST['affiliation_grade0']) and $_POST['affiliation_grade0'] != "") {
			$affli_classgrade = $this->input->post('affiliation_grade0');
		}
		if (isset($_POST['affiliation_grade1']) and $_POST['affiliation_grade1'] != "") {
			if ($affli_classgrade != '') {
				$affli_classgrade .= ','.$this->input->post('affiliation_grade1');
			}else{
				$affli_classgrade = $this->input->post('affiliation_grade1');
			}
		}
		if (isset($_POST['affiliation_grade2']) and $_POST['affiliation_grade2'] != "") {
			if ($affli_classgrade != '') {
				$affli_classgrade .= ','.$this->input->post('affiliation_grade2');
			}else{
				$affli_classgrade = $this->input->post('affiliation_grade2');
			}
		}
		$affli_fromdate = $this->input->post('institute_affiliation_from');
		$affli_todate = $this->input->post('institute_affiliation_to');
		$monthNames = array(
						"جنوری" 	=> 1,
						"فروری" 	=> 2,
						"مارچ" 		=> 3,
						"اپریل" 		=> 4,
						"مئی" 		=> 5,
						"جون" 		=> 6,
						"جولائی" 	=> 7,
						"اگست" 		=> 8,
						"ستمبر" 	=> 9,
						"اکتوبر" 	=> 10,
						"نومبر" 		=> 11,
						"دسمبر" 		=> 12
					);//This Array For Getting Months With Integer
		$affli_fromdate = explode(" ", $affli_fromdate);
		$affli_todate = explode(" ", $affli_todate);
		// echo '<pre>';print_r($affli_fromdate);echo '</pre>';
		$affli_fromdate = $affli_fromdate[1].'-'.$monthNames[$affli_fromdate[0]].'-28';
		$affli_todate 	= $affli_todate[1].'-'.$monthNames[$affli_todate[0]].'-28';
		if (isset($_POST['class_grade_type']) and $_POST['class_grade_type'] != "") {
			if ($affli_classgrade != '') {
				$affli_classgrade .= ','.$this->input->post('class_grade_type');
			}else{
				$affli_classgrade = $this->input->post('class_grade_type');
			}
		}

		// die();
		// echo '<pre>';print_r($_POST);echo '</pre>';
		$data = array(
				'inst_reg_no' 		=> $this->input->post('registration_no'),
				'affli_fullname' 	=> $this->input->post('institute_full_name'),
				'affli_shortname' 	=> $this->input->post('institute_short_name'),
				'affli_ownername' 	=> $this->input->post('institute_owner_name'),
				'affli_address' 	=> $this->input->post('institute_address'),
				'affli_phoneno' 	=> $this->input->post('institute_phone_no'),
				'affli_mobileno' 	=> $this->input->post('institute_mobile_no'),
				'affli_date' 		=> $this->input->post('date_of_affiliation'),
				'affli_classgrade'	=> $affli_classgrade,
				'affli_fromdate' 	=> $affli_fromdate,
				'affli_todate' 		=> $affli_todate,
				'city_id' 			=> $this->input->post('institute_district'),
				'status' 			=> 'active',
				'date' 			    => date('Y-m-d H:i:s')
				);
		
		// echo '<pre>';print_r($data);echo '</pre>';
		// die();
		$this->db->insert('affiliation_info', $data);
		if($this->db->affected_rows() > 0)
		{
			 return $this->db->insert_id(); // to the controller
		}else{
			return NULL;	
		}
	
	}// end function affiliate_new_institute

	public function get_affiliated_institutes_info($status ='')
	{
		if (empty($status)) {
			$query = $this->db->select('afinfo.*',false)
					 ->from('affiliation_info AS afinfo')
					 ->order_by("afinfo.inst_reg_no","ASC")
					 // ->where('afinfo.status','active')
					 // ->limit(10)
					 ->get();
		}else{
			$query = $this->db->select('afinfo.*',false)
					 ->from('affiliation_info AS afinfo')
					 // ->where('afinfo.status',$status)
					 ->get();	
		}
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return NULL;
		}
	
	}// end functino get_affiliated_institutes_info

	public function get_all_subjects()
	{
		
		$query = $this->db->select('sifno.*,cinfo.class_name_urdu',false)
					 ->from('subject_info AS sifno')
					 ->join('classes_info AS cinfo','cinfo.class_id = sifno.class_id','left')
					 ->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return NULL;
		}

	}// end function get_all_subjects

	public function add_new_subject()
	{
		$data = array(
					'sub_name_urdu ' => $this->input->post('sub_name_urdu'),
					'total_marks ' => $this->input->post('total_marks'),
					'class_id ' => $this->input->post('class_id')
					);
		$this->db->insert('subject_info', $data);
		if($this->db->affected_rows() > 0)
		{
			 return $this->db->insert_id(); // to the controller
		}else{
			return NULL;	
		}
	
	}// end function add_new_subject

	public function update_subject($subject_id ='')
	{
		$data = array(
				'sub_name_urdu' => $this->input->post('sub_name_urdu'),
				'class_id' => $this->input->post('class_id'),
				);
		$this->db->where('sub_id', $subject_id);
		$this->db->update('subject_info', $data);
		if($this->db->affected_rows() >= 0){
			return true;
		}else{
			return false;
		}

	}// end function update_subject

	public function get_subject_info($subject_id='')
	{
		$query = $this->db->select('sinfo.*,cinfo.*',false)
						  ->from('subject_info AS sinfo')
						  ->join('classes_info AS cinfo','cinfo.class_id = sinfo.class_id','left')
						  ->where('sinfo.sub_id',$subject_id)
						  ->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}
	
	}// end function get_subject_info

	public function delete_subject($subject_id='')
	{
		$this->db->where('sub_id', $subject_id);
		$this->db->delete('subject_info');
		if($this->db->affected_rows() >= 0){
			return true;
		}else{
			return false;
		}

	}// end function delete_subject

	public function get_exam_subjects($exam_id='')
	{
		
		$query = $this->db->select('sinfo.*',false)
						  ->from('subject_info AS sinfo')
						  ->join('classes_info AS cinfo','cinfo.class_id = sinfo.class_id','left')
						  ->join('exam_info AS einfo','einfo.class_id = cinfo.class_id','left')
						  ->where('einfo.exam_info_id',$exam_id)
						  ->get();
						  // print($query);
						  // echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}

	}	// end function get_exam_subjects

	public function get_student_class_subjects($student_id ='',$exam_type = '',$exam_id = '')
	{
		if(empty($student_id)){
			return NULL;
		}
		if ($exam_type == 2) {

			$query =  $this->db->select('sbinfo.*',false)
						   ->from('subject_info AS sbinfo')
						   ->join('repeat_student_result_info AS rsrinfo','rsrinfo.subject_id = sbinfo.sub_id','left')
						   ->where('rsrinfo.std_id',$student_id)
						   ->where('rsrinfo.exam_id',$exam_id)
						   ->order_by('sbinfo.sub_id','ASC')
						   ->get();	   
		}else{

			$query =  $this->db->select('sbinfo.*',false)
						   ->from('subject_info AS sbinfo')
						   ->join('student_exam_info AS seinfo','seinfo.class_id = sbinfo.class_id','left')
						   ->where('seinfo.std_id',$student_id)
						   ->order_by('sbinfo.sub_id','ASC')
						   ->get();

		}
		
		// echo $this->db->last_query();
		if ($query->num_rows() > 0) {

			return $query->result_array();

		}else{

			return NULL;
			
		}

	}// end functioon get_student_class_subjects

	public function add_student_result($exam_id,$student_id = '')
	{
		if (empty($student_id) || empty($exam_id)) {
			return NULL;
		}

		$data =  array(
					'subject_id' => $this->input->post('subject_id'),
					'std_id'	 => $student_id,
					'exam_id'	 => $exam_id,
					'obtained_marks' => $this->input->post('obtained_marks')
				 );
		// echo '<pre>';print_r($data);echo '</pre>';die();
		$this->db->insert('result_info',$data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}else{
			return NULL;
		}

	}// end function add_student_result

	public function update_student_result($exam_id ='',$student_id)
	{
		if (empty($student_id) || empty($exam_id)) {
			return false;
		}
		$data = array(
					'obtained_marks' => $this->input->post('obtained_marks')
			 		);
		// echo $student_id.'<br/>';
		// echo $exam_id.'<br/>';
		// echo $this->input->post('subject_id');
		// echo '<pre>';print_r($data);echo '</pre>';die();
		$this->db->where('std_id', $student_id);
		$this->db->where('exam_id', $exam_id);
		$this->db->where('subject_id', $this->input->post('subject_id'));
		$this->db->update('result_info', $data);
		if($this->db->affected_rows() >= 0){
			return true;
		}else{
			return false;
		}
	
	}// end update_student_result

	public function add_six_student_result($exam_id ='',$student_id)
	{
		$response = false;
		
		foreach ($_POST['subject_id'] as $key => $value) {
			$data = array(
					'subject_id' => $value,
					'std_id'	 => $student_id,
					'exam_id'	 => $exam_id,
					'obtained_marks' => $_POST['obtained_marks'][$key]
					);
			// echo '<pre>';print_r($data);echo '</pre>';die();
			$this->db->insert('result_info',$data);

			if ($this->db->affected_rows() > 0) {
				$response = true;
			}else{
				return false;
			}
		}
		return $response;

	}// end function add_six_student_result

	public function update_six_student_result($exam_id ='',$student_id='',$exam_type = 1)
	{

		if (empty($student_id) || empty($exam_id) || empty($exam_type)) {
			return false;
		}
		$response = false;
		$add = false;

		if ($exam_type == 2) {

			foreach ($_POST['subject_id'] as $key => $value) {

					$data = array(
						'obtained_marks' => $_POST['obtained_marks'][$key]
				 		);
					
					$this->db->where('std_id', $student_id);
					$this->db->where('exam_id', $exam_id);
					$this->db->where('subject_id', $_POST['subject_id'][$key]);
					$this->db->update('repeat_student_result_info', $data);

			}// end foreach loop

		}else{

			if (isset($_POST['rsrinfo_id']) and count($_POST['rsrinfo_id']) > 0) {
				
				foreach ($_POST['rsrinfo_id'] as $key => $info) 
				{
					if ($_POST['obtained_marks'][$key] < 40) {
						$data = array(
								'obtained_marks' => $_POST['obtained_marks'][$key],
								'subject_status' => 'fail'
						 		);
					}else{
						$data = array(
								'obtained_marks' => $_POST['obtained_marks'][$key],
								'subject_status' => 'pass'
						 		);
					}

					$this->db->where('std_id', $student_id);
					$this->db->where('exam_id', $exam_id);
					$this->db->where('subject_id', $_POST['subject_id'][$key]);
					$this->db->where('rsrinfo_id', $_POST['rsrinfo_id'][$key]);
					$this->db->where('regular_student_id', $_POST['regular_student_id'][$key]);
					$this->db->update('repeat_student_result_info', $data);

				}	// END FOREACH LOOP

			}else{
				
				foreach ($_POST['subject_id'] as $key => $value)
				{
					if ($this->checkIfStudentExamSubjectResultExists($exam_id,$_POST['subject_id'][$key],$student_id,$exam_type))
					{						
						if ($_POST['obtained_marks'][$key] < 40) {
							$data = array(
									'obtained_marks' => $_POST['obtained_marks'][$key],
									'subject_status' => 'fail'
							 		);
						}else{
							$data = array(
									'obtained_marks' => $_POST['obtained_marks'][$key],
									'subject_status' => 'pass'
							 		);
						}

						$this->db->where('std_id', $student_id);
						$this->db->where('exam_id', $exam_id);
						$this->db->where('subject_id', $_POST['subject_id'][$key]);
						$this->db->update('result_info', $data);
						
					}else{
						
						$add = true;
						$insertData[] = array(
									'subject_id' => $_POST['subject_id'][$key],
									'std_id'	 => $student_id,
									'exam_id'	 => $exam_id,
									'obtained_marks' => $_POST['obtained_marks'][$key],
									'subject_status' => (isset($_POST['obtained_marks'][$key]) and ($_POST['obtained_marks'][$key] < 40)) ? 'fail' : 'pass'
									);

						//echo 'Subject Id = '.$_POST['subject_id'][$key].'  Marks: '.$_POST['obtained_marks'][$key].'<br/>';
					
					}

				}// end foreach loop
			}

			//echo $this->db->last_query().'<br/>';
		}
		
		if ($add) {
			$this->db->insert_batch('result_info', $insertData);
		}
		if($this->db->affected_rows() >= 0){
			$response = true;
		}else{
			return false;
		}
		return $response;
	
	}// end update_six_student_result

	public function add_ten_student_result($exam_id ='',$student_id)
	{
		$response = false;
		
		foreach ($_POST['subject_id'] as $key => $value) {
			$data = array(
					'subject_id' => $value,
					'std_id'	 => $student_id,
					'exam_id'	 => $exam_id,
					'obtained_marks' => $_POST['obtained_marks'][$key]
					);
			// echo '<pre>';print_r($data);echo '</pre>';die();
			$this->db->insert('result_info',$data);

			if ($this->db->affected_rows() > 0) {
				$response = true;
			}else{
				return false;
			}
		}
		return $response;

	}// end function add_ten_student_result

	public function update_ten_student_result($exam_id ='',$student_id)
	{
		if (empty($student_id) || empty($exam_id)) {
			return false;
		}
		$response = false;
		// echo '<pre>';print_r($_POST);echo '</pre>';//die();

		foreach ($_POST['subject_id'] as $key => $value) {

			$data = array(
					'obtained_marks' => $_POST['obtained_marks'][$key]
			 		);
			// print_r($data);die();
			$this->db->where('std_id', $student_id);
			$this->db->where('exam_id', $exam_id);
			$this->db->where('subject_id', $_POST['subject_id'][$key]);
			$this->db->update('result_info', $data);
			if($this->db->affected_rows() >= 0){
				$response = true;
			}else{
				return false;
			}
		}
		return $response;
	
	}// end update_ten_student_result

	public function get_exam_class_grade($exam_id ='')
	{
		if (!empty($exam_id)) {
			
			$query = $this->db->select('cinfo.class_type',false)
							  ->from('classes_info AS cinfo')
							  ->join('exam_info AS einfo','einfo.class_id = cinfo.class_id','left')
							  ->where('einfo.exam_info_id',$exam_id)
							  ->get();
			if ($query->num_rows() > 0) {
				$row = $query->row();
				return $row->class_type;
			}else{
				return NULL;
			}
		}else{
			return NULL;
		}
	
	}// end function get_exam_class_grade

	public function get_exam_type_by_exam_id($exam_id='')
	{
		$query =  $this->db->select('etinfo.et_id')
						   ->from('exam_type AS etinfo')
						   ->join('exam_info AS einfo','einfo.exam_type_id = etinfo.et_id','left')
						   ->where('einfo.exam_info_id',$exam_id)
						   ->get();
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->et_id;	
		}else{
			return NULL;
		}

	}// end function get_exam_type_by_exam_id

	public function get_exam_class_subject($exam_id ='',$exam_type = 1)
	{
		if ($exam_type == 2) {

			$query =  $this->db->select('sinfo.*',false)
						   ->from('subject_info AS sinfo')
						   ->join('classes_info AS cinfo','cinfo.class_id = sinfo.class_id','left')
						   ->join('exam_info AS einfo','einfo.class_id = cinfo.class_id','left')
						   ->where('einfo.exam_info_id',$exam_id)
						   ->get();
		}else{

			$query =  $this->db->select('sinfo.*',false)
						   ->from('subject_info AS sinfo')
						   ->join('classes_info AS cinfo','cinfo.class_id = sinfo.class_id','left')
						   ->join('exam_info AS einfo','einfo.class_id = cinfo.class_id','left')
						   ->where('einfo.exam_info_id',$exam_id)
						   ->get();

		}

		if ($query->num_rows() > 0) {

			return $query->result_array();
		
		}else{
		
			return NULL;
		
		}

	}// end function get_exam_class_subject

	public function get_all_exam_students($exam_id ='',$exam_type = 1,$exam_center_id = "")
	{
		if ($exam_type == 2) {
			
			if ($exam_center_id != "") {

				$query = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname,
										GROUP_CONCAT(sbinfo.sub_name_urdu ORDER BY sbinfo.sub_id ASC SEPARATOR ",") as sub_name_urdu,
										GROUP_CONCAT(sbinfo.sub_id ORDER BY sbinfo.sub_id ASC SEPARATOR ",") as sub_id,
										GROUP_CONCAT(dsinfo.exam_date ORDER BY dsinfo.exam_subject_id ASC SEPARATOR ",") as exam_date',false)
					  ->from('student_info AS sinfo')
					  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
					  ->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','left')
					  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
					  ->join('exam_type AS et','et.et_id = einfo.exam_type_id','left')
					  ->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','left')
					  ->join('repeat_student_result_info AS rsrinfo','rsrinfo.exam_id = seinfo.exam_id AND rsrinfo.std_id = sinfo.std_id','left')
					  ->join('subject_info AS sbinfo','sbinfo.sub_id = rsrinfo.subject_id','left')
					  ->join('datesheet_info AS dsinfo','dsinfo.exam_subject_id = rsrinfo.subject_id','left')
					  ->where('ecinfo.eci_id',$exam_center_id)
					  ->where('einfo.exam_info_id',$exam_id)
					  ->group_by('sinfo.std_id','ASC')
					  ->get();

			}else{

				$query = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname,
										GROUP_CONCAT(sbinfo.sub_name_urdu ORDER BY sbinfo.sub_id ASC SEPARATOR ",") as sub_name_urdu,
										GROUP_CONCAT(sbinfo.sub_id ORDER BY sbinfo.sub_id ASC SEPARATOR ",") as sub_id,
										GROUP_CONCAT(dsinfo.exam_date ORDER BY dsinfo.exam_subject_id ASC SEPARATOR ",") as exam_date',false)
					  ->from('student_info AS sinfo')
					  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
					  ->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','left')
					  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
					  ->join('exam_type AS et','et.et_id = einfo.exam_type_id','left')
					  ->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','left')
					  ->join('repeat_student_result_info AS rsrinfo','rsrinfo.exam_id = seinfo.exam_id AND rsrinfo.std_id = sinfo.std_id','left')
					  ->join('subject_info AS sbinfo','sbinfo.sub_id = rsrinfo.subject_id','left')
					  ->join('datesheet_info AS dsinfo','dsinfo.exam_subject_id = rsrinfo.subject_id','left')
					  ->where('einfo.exam_info_id',$exam_id)
					  /*->where('sinfo.std_roll_no',155)*/
					  ->group_by('sinfo.std_id','ASC')
					  ->get();
			}
			
		}else{

			if ($exam_center_id != "") {
				
				$query = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname',false)
							  ->from('student_info AS sinfo')
							  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
							  ->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','left')
							  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
							  ->join('exam_type AS et','et.et_id = einfo.exam_type_id','left')
							  ->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','left')
							  ->where('einfo.exam_info_id',$exam_id)
							  ->where('ecinfo.eci_id',$exam_center_id)
							  ->order_by('sinfo.std_id','ASC')
							  // ->limit(10)
							  ->get();
			}else{

				$query = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname',false)
							  ->from('student_info AS sinfo')
							  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
							  ->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','left')
							  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
							  ->join('exam_type AS et','et.et_id = einfo.exam_type_id','left')
							  ->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','left')
							  ->where('einfo.exam_info_id',$exam_id)
							  ->order_by('sinfo.std_id','ASC')
							  // ->limit(2)
							  ->get();

			}
		}
						   //echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}

	}// end function get_all_exam_students

	public function get_all_exam_students_six_course($exam_id ='',$exam_type = 1,$exam_center_id = "")
	{

		$data_set_to_return = array();

		if ($exam_type == 2) {
			
			if ($exam_center_id != "") {

				$query = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname,
										GROUP_CONCAT(sbinfo.sub_name_urdu ORDER BY sbinfo.sub_id ASC SEPARATOR ",") as sub_name_urdu,
										GROUP_CONCAT(sbinfo.sub_id ORDER BY sbinfo.sub_id ASC SEPARATOR ",") as sub_id,
										GROUP_CONCAT(dsinfo.exam_date ORDER BY dsinfo.exam_subject_id ASC SEPARATOR ",") as exam_date',false)
					  ->from('student_info AS sinfo')
					  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
					  ->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','left')
					  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
					  ->join('exam_type AS et','et.et_id = einfo.exam_type_id','left')
					  ->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','left')
					  ->join('repeat_student_result_info AS rsrinfo','rsrinfo.exam_id = seinfo.exam_id AND rsrinfo.std_id = sinfo.std_id','left')
					  ->join('subject_info AS sbinfo','sbinfo.sub_id = rsrinfo.subject_id','left')
					  ->join('datesheet_info AS dsinfo','dsinfo.exam_subject_id = rsrinfo.subject_id','left')
					  ->where('ecinfo.eci_id',$exam_center_id)
					  ->where('einfo.exam_info_id',$exam_id)
					  ->group_by('sinfo.std_id','ASC')
					  ->get();

			}else{

				$query = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname,
										GROUP_CONCAT(sbinfo.sub_name_urdu ORDER BY sbinfo.sub_id ASC SEPARATOR ",") as sub_name_urdu,
										GROUP_CONCAT(sbinfo.sub_id ORDER BY sbinfo.sub_id ASC SEPARATOR ",") as sub_id,
										GROUP_CONCAT(dsinfo.exam_date ORDER BY dsinfo.exam_subject_id ASC SEPARATOR ",") as exam_date',false)
					  ->from('student_info AS sinfo')
					  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
					  ->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','left')
					  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
					  ->join('exam_type AS et','et.et_id = einfo.exam_type_id','left')
					  ->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','left')
					  ->join('repeat_student_result_info AS rsrinfo','rsrinfo.exam_id = seinfo.exam_id AND rsrinfo.std_id = sinfo.std_id','left')
					  ->join('subject_info AS sbinfo','sbinfo.sub_id = rsrinfo.subject_id','left')
					  ->join('datesheet_info AS dsinfo','dsinfo.exam_subject_id = rsrinfo.subject_id','left')
					  ->where('einfo.exam_info_id',$exam_id)
					  /*->where('sinfo.std_roll_no',155)*/
					  ->group_by('sinfo.std_id','ASC')
					  ->get();
			}
			
		}else{

			if ($exam_center_id != "") {
				
				$query = $this->db->select('sinfo.*')
									->from('student_info AS sinfo')
									->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
									->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','inner')
									->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
									->where('einfo.exam_info_id',$exam_id)
									->where('ecinfo.eci_id',$exam_center_id)
									->order_by('sinfo.std_id','ASC')
									// ->limit(2,0)
									->get();
				/*echo $this->db->last_query();
				echo '<pre>';print_r($query->result_array());echo '</pre>';
					die('Yoho!');*/
				if ($query->num_rows() > 0) {

					$student_record = array();

					foreach ($query->result_array() as $key => $rec) {
						// echo $key.'<br/>'	;
						if ($rec['attempt_no'] == "third") {

							$sbquery = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname,GROUP_CONCAT(rpinfo.subject_id order by rpinfo.subject_id ASC SEPARATOR ",") as subject_id',false)
												->from('student_info AS sinfo')
												->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','inner')
												->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','inner')
												->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','inner')
												->join('exam_type AS et','et.et_id = einfo.exam_type_id','inner')
												->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','inner')
												->join('repeat_student_result_info AS rpinfo','rpinfo.std_id = sinfo.std_id','inner')
												->where('einfo.exam_info_id',$exam_id)
												->where('sinfo.std_id',$rec['std_id'])
												->order_by('sinfo.std_id','ASC')
												// ->limit(2,111)
												->get();

									// echo $this->db->last_query();
									$response = $sbquery->result_array();
									//$response[0]['rsubject_id'];
									$student_record[$key] = $response[0];
									/*echo '<pre>';print_r($student_record);echo '</pre>';
									die('Yoho!');*/
						
						}elseif($rec['attempt_no'] == "f_to_f"){

							$sbquery = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname,GROUP_CONCAT(rpinfo.subject_id order by rpinfo.subject_id ASC SEPARATOR ",") as subject_id',false)
												->from('student_info AS sinfo')
												->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','inner')
												->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','inner')
												->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','inner')
												->join('exam_type AS et','et.et_id = einfo.exam_type_id','inner')
												->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','inner')
												->join('repeat_student_result_info AS rpinfo','rpinfo.std_id = sinfo.std_id','left')
												->where('einfo.exam_info_id',$exam_id)
												->where('ecinfo.eci_id',$exam_center_id)
												->where('sinfo.std_id',$rec['std_id'])
												->group_by('rpinfo.subject_id')
												->order_by('sinfo.std_id','ASC')
												// ->limit(2,111)
												->get();
							/*echo $this->db->last_query();
							echo '<pre>';print_r($sbquery->result_array());echo '</pre>';
							die();*/
							$response = $sbquery->result_array();
									//$response[0]['rsubject_id'];
							$student_record[$key] = $response[0];
						
						}else{

							$sbquery = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname,GROUP_CONCAT(rinfo.subject_id order by rinfo.subject_id ASC SEPARATOR ",") as subject_id',false)
												->from('student_info AS sinfo')
												->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','inner')
												->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','inner')
												->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','inner')
												->join('exam_type AS et','et.et_id = einfo.exam_type_id','inner')
												->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','inner')
												->join('result_info AS rinfo','rinfo.std_id = sinfo.std_id','left')
												->where('einfo.exam_info_id',$exam_id)
												->where('ecinfo.eci_id',$exam_center_id)
												->where('sinfo.std_id',$rec['std_id'])
												->group_by('rinfo.subject_id')
												->order_by('sinfo.std_id','ASC')
												// ->limit(2,111)
												->get();
							/*echo $this->db->last_query();
							echo '<pre>';print_r($sbquery->result_array());echo '</pre>';
							die();*/
							$response = $sbquery->result_array();
									//$response[0]['rsubject_id'];
							$student_record[$key] = $response[0];
						
						}

					}

					return $student_record;
				}
				else{
					return NULL;
				}

			}else{

				$query = $this->db->select('sinfo.*')
									->from('student_info AS sinfo')
									->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
									->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
									->where('einfo.exam_info_id',$exam_id)
									->order_by('sinfo.std_id','ASC')
									// ->limit(2,39)
									->get();
				// echo $this->db->last_query();
				/*echo '<pre>';print_r($query->result_array());echo '</pre>';
					die('Yoho!');*/
				if ($query->num_rows() > 0) {

					$student_record = array();

					foreach ($query->result_array() as $key => $rec) {
						// echo $key.'<br/>'	;
						if ($rec['attempt_no'] == "third") {

							$sbquery = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname,GROUP_CONCAT(rpinfo.subject_id order by rpinfo.subject_id ASC SEPARATOR ",") as subject_id',false)
												->from('student_info AS sinfo')
												->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','inner')
												->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','inner')
												->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','inner')
												->join('exam_type AS et','et.et_id = einfo.exam_type_id','inner')
												->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','inner')
												->join('repeat_student_result_info AS rpinfo','rpinfo.std_id = sinfo.std_id','inner')
												->where('einfo.exam_info_id',$exam_id)
												->where('sinfo.std_id',$rec['std_id'])
												->order_by('sinfo.std_id','ASC')
												// ->limit(2,111)
												->get();

									// echo $this->db->last_query();
									$response = $sbquery->result_array();
									//$response[0]['rsubject_id'];
									$student_record[$key] = $response[0];
									/*echo '<pre>';print_r($student_record);echo '</pre>';
									die('Yoho!');*/
						}elseif ($rec['attempt_no'] == "f_to_f") {

							$sbquery = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname,GROUP_CONCAT(rpinfo.subject_id order by rpinfo.subject_id ASC SEPARATOR ",") as subject_id',false)
												->from('student_info AS sinfo')
												->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','inner')
												->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','inner')
												->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','inner')
												->join('exam_type AS et','et.et_id = einfo.exam_type_id','inner')
												->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','inner')
												->join('repeat_student_result_info AS rpinfo','rpinfo.std_id = sinfo.std_id','inner')
												->where('einfo.exam_info_id',$exam_id)
												->where('sinfo.std_id',$rec['std_id'])
												->order_by('sinfo.std_id','ASC')
												// ->limit(2,111)
												->get();

									// echo $this->db->last_query();
									$response = $sbquery->result_array();
									//$response[0]['rsubject_id'];
									$student_record[$key] = $response[0];
									/*echo '<pre>';print_r($student_record);echo '</pre>';
									die('Yoho!');*/
						}else{

							$sbquery = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname,GROUP_CONCAT(rinfo.subject_id order by rinfo.subject_id ASC SEPARATOR ",") as subject_id',false)
												->from('student_info AS sinfo')
												->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','inner')
												->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','inner')
												->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','inner')
												->join('exam_type AS et','et.et_id = einfo.exam_type_id','inner')
												->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','inner')
												->join('result_info AS rinfo','rinfo.std_id = sinfo.std_id','left')
												->where('einfo.exam_info_id',$exam_id)
												->where('sinfo.std_id',$rec['std_id'])
												->group_by('rinfo.subject_id')
												->order_by('sinfo.std_id','ASC')
												// ->limit(2,111)
												->get();
							
							$response = $sbquery->result_array();
					
							$student_record[$key] = $response[0];
						}

					}
					
					return $student_record;
				}else{
					return NULL;
				}
			
			}
		}

		return NULL;

	}// end function get_all_exam_students_six_course

	public function get_all_exam_students_six_course_old_13_4_16($exam_id ='',$exam_type = 1,$exam_center_id = "")
	{

		$data_set_to_return = array();
		if ($exam_type == 2) {
			
			if ($exam_center_id != "") {

				$query = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname,
										GROUP_CONCAT(sbinfo.sub_name_urdu ORDER BY sbinfo.sub_id ASC SEPARATOR ",") as sub_name_urdu,
										GROUP_CONCAT(sbinfo.sub_id ORDER BY sbinfo.sub_id ASC SEPARATOR ",") as sub_id,
										GROUP_CONCAT(dsinfo.exam_date ORDER BY dsinfo.exam_subject_id ASC SEPARATOR ",") as exam_date',false)
					  ->from('student_info AS sinfo')
					  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
					  ->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','left')
					  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
					  ->join('exam_type AS et','et.et_id = einfo.exam_type_id','left')
					  ->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','left')
					  ->join('repeat_student_result_info AS rsrinfo','rsrinfo.exam_id = seinfo.exam_id AND rsrinfo.std_id = sinfo.std_id','left')
					  ->join('subject_info AS sbinfo','sbinfo.sub_id = rsrinfo.subject_id','left')
					  ->join('datesheet_info AS dsinfo','dsinfo.exam_subject_id = rsrinfo.subject_id','left')
					  ->where('ecinfo.eci_id',$exam_center_id)
					  ->where('einfo.exam_info_id',$exam_id)
					  ->group_by('sinfo.std_id','ASC')
					  ->get();

			}else{

				$query = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname,
										GROUP_CONCAT(sbinfo.sub_name_urdu ORDER BY sbinfo.sub_id ASC SEPARATOR ",") as sub_name_urdu,
										GROUP_CONCAT(sbinfo.sub_id ORDER BY sbinfo.sub_id ASC SEPARATOR ",") as sub_id,
										GROUP_CONCAT(dsinfo.exam_date ORDER BY dsinfo.exam_subject_id ASC SEPARATOR ",") as exam_date',false)
					  ->from('student_info AS sinfo')
					  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
					  ->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','left')
					  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
					  ->join('exam_type AS et','et.et_id = einfo.exam_type_id','left')
					  ->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','left')
					  ->join('repeat_student_result_info AS rsrinfo','rsrinfo.exam_id = seinfo.exam_id AND rsrinfo.std_id = sinfo.std_id','left')
					  ->join('subject_info AS sbinfo','sbinfo.sub_id = rsrinfo.subject_id','left')
					  ->join('datesheet_info AS dsinfo','dsinfo.exam_subject_id = rsrinfo.subject_id','left')
					  ->where('einfo.exam_info_id',$exam_id)
					  /*->where('sinfo.std_roll_no',155)*/
					  ->group_by('sinfo.std_id','ASC')
					  ->get();
			}
			
		}else{

			if ($exam_center_id != "") {
				
				$query = $this->db->select('sinfo.*')
									->from('student_info AS sinfo')
									->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
									->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','inner')
									->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
									->where('einfo.exam_info_id',$exam_id)
									->where('ecinfo.eci_id',$exam_center_id)
									->order_by('sinfo.std_id','ASC')
									// ->limit(2,111)
									->get();
				// echo $this->db->last_query();
				/*echo '<pre>';print_r($query->result_array());echo '</pre>';
					die('Yoho!');*/
				if ($query->num_rows() > 0) {

					$student_record = array();

					foreach ($query->result_array() as $key => $rec) {
						// echo $key.'<br/>'	;
						if ($rec['attempt_no'] == "third") {

							$sbquery = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname,GROUP_CONCAT(rpinfo.subject_id order by rpinfo.subject_id ASC SEPARATOR ",") as subject_id',false)
												->from('student_info AS sinfo')
												->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','inner')
												->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','inner')
												->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','inner')
												->join('exam_type AS et','et.et_id = einfo.exam_type_id','inner')
												->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','inner')
												->join('repeat_student_result_info AS rpinfo','rpinfo.std_id = sinfo.std_id','inner')
												->where('einfo.exam_info_id',$exam_id)
												->where('sinfo.std_id',$rec['std_id'])
												->order_by('sinfo.std_id','ASC')
												// ->limit(2,111)
												->get();

									// echo $this->db->last_query();
									$response = $sbquery->result_array();
									//$response[0]['rsubject_id'];
									$student_record[$key] = $response[0];
									/*echo '<pre>';print_r($student_record);echo '</pre>';
									die('Yoho!');*/
						}else{

							$sbquery = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname,GROUP_CONCAT(rinfo.subject_id order by rinfo.subject_id ASC SEPARATOR ",") as subject_id',false)
												->from('student_info AS sinfo')
												->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','inner')
												->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','inner')
												->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','inner')
												->join('exam_type AS et','et.et_id = einfo.exam_type_id','inner')
												->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','inner')
												->join('result_info AS rinfo','rinfo.std_id = sinfo.std_id','left')
												->where('einfo.exam_info_id',$exam_id)
												->where('ecinfo.eci_id',$exam_center_id)
												->where('sinfo.std_id',$rec['std_id'])
												->group_by('rinfo.subject_id')
												->order_by('sinfo.std_id','ASC')
												// ->limit(2,111)
												->get();
							/*echo $this->db->last_query();
							echo '<pre>';print_r($sbquery->result_array());echo '</pre>';
							die();*/
							$response = $sbquery->result_array();
									//$response[0]['rsubject_id'];
							$student_record[$key] = $response[0];
						}

					}
					/*echo '<pre>';print_r($student_record);echo '</pre>';
									die('Yoho!');
					echo '<pre>';print_r($query->result_array());echo '</pre>';
					die('Yoho!');*/
					return $student_record;
				}
				else{
					return NULL;
				}

				/*$query = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname',false)
							  ->from('student_info AS sinfo')
							  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
							  ->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','left')
							  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
							  ->join('exam_type AS et','et.et_id = einfo.exam_type_id','left')
							  ->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','left')
							  ->where('einfo.exam_info_id',$exam_id)
							  ->where('ecinfo.eci_id',$exam_center_id)
							  ->order_by('sinfo.std_id','ASC')
							  // ->limit(2,111)
							  ->get();*/
			}else{

				$query = $this->db->select('sinfo.*')
									->from('student_info AS sinfo')
									->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
									->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
									->where('einfo.exam_info_id',$exam_id)
									->order_by('sinfo.std_id','ASC')
									// ->limit(2,111)
									->get();
				// echo $this->db->last_query();
				/*echo '<pre>';print_r($query->result_array());echo '</pre>';
					die('Yoho!');*/
				if ($query->num_rows() > 0) {

					$student_record = array();

					foreach ($query->result_array() as $key => $rec) {
						// echo $key.'<br/>'	;
						if ($rec['attempt_no'] == "third") {

							$sbquery = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname,GROUP_CONCAT(rpinfo.subject_id order by rpinfo.subject_id ASC SEPARATOR ",") as subject_id',false)
												->from('student_info AS sinfo')
												->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','inner')
												->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','inner')
												->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','inner')
												->join('exam_type AS et','et.et_id = einfo.exam_type_id','inner')
												->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','inner')
												->join('repeat_student_result_info AS rpinfo','rpinfo.std_id = sinfo.std_id','inner')
												->where('einfo.exam_info_id',$exam_id)
												->where('sinfo.std_id',$rec['std_id'])
												->order_by('sinfo.std_id','ASC')
												// ->limit(2,111)
												->get();

									// echo $this->db->last_query();
									$response = $sbquery->result_array();
									//$response[0]['rsubject_id'];
									$student_record[$key] = $response[0];
									/*echo '<pre>';print_r($student_record);echo '</pre>';
									die('Yoho!');*/
						}else{

							$sbquery = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname,GROUP_CONCAT(rinfo.subject_id order by rinfo.subject_id ASC SEPARATOR ",") as subject_id',false)
												->from('student_info AS sinfo')
												->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','inner')
												->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','inner')
												->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','inner')
												->join('exam_type AS et','et.et_id = einfo.exam_type_id','inner')
												->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','inner')
												->join('result_info AS rinfo','rinfo.std_id = sinfo.std_id','left')
												->where('einfo.exam_info_id',$exam_id)
												->where('sinfo.std_id',$rec['std_id'])
												->group_by('rinfo.subject_id')
												->order_by('sinfo.std_id','ASC')
												// ->limit(2,111)
												->get();
							/*echo $this->db->last_query();
							echo '<pre>';print_r($sbquery->result_array());echo '</pre>';
							die();*/
							$response = $sbquery->result_array();
									//$response[0]['rsubject_id'];
							$student_record[$key] = $response[0];
						}

					}
					/*echo '<pre>';print_r($student_record);echo '</pre>';
									die('Yoho!');
					echo '<pre>';print_r($query->result_array());echo '</pre>';
					die('Yoho!');*/
					return $student_record;
				}else{
					return NULL;
				}
				/*$query = $this->db->select('sinfo.*,seinfo.*,ecinfo.*,einfo.*,et.exam_type_name_urdu,ainfo.affli_fullname',false)
							  ->from('student_info AS sinfo')
							  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
							  ->join('examination_center_info AS ecinfo','ecinfo.eci_id = seinfo.exam_center_id','left')
							  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
							  ->join('exam_type AS et','et.et_id = einfo.exam_type_id','left')
							  ->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','left')
							  ->where('einfo.exam_info_id',$exam_id)
							  ->order_by('sinfo.std_id','ASC')
							  ->limit(2,111)
							  ->get();*/

			}
		}

		return NULL;
						   /*echo $this->db->last_query();
						   die('Yoho!');*/
		/*if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}*/

	}// end function get_all_exam_students_six_course

	public function get_gazet_detail_old($exam_id = '')
	{
			$query = $this->db->select('sinfo.*,einfo.*,ainfo.*')
						  ->from('student_info AS sinfo')
						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
						  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
						  ->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','left')
						  ->where('einfo.exam_info_id',$exam_id)
						  ->order_by("sinfo.std_roll_no","ASC")
						  ->get();
						  // echo $this->db->last_query();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}else{
				return NULL;
			}

	}// end function get_gazet_detail

	public function get_gazet_detail($exam_id = '',$inst_id = '')
	{
			
			if (!empty($inst_id)) {

				$query = $this->db->select('sinfo.*,einfo.*,ainfo.*,rinfo.*',false)
						  ->from('student_info AS sinfo')
						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
						  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
						  ->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','left')
						  ->join('result_info AS rinfo','rinfo.std_id = sinfo.std_id','left')
						  ->where('einfo.exam_info_id',$exam_id)
						  ->where('ainfo.affli_id',$inst_id)
						  ->order_by("sinfo.std_roll_no","ASC")
						  ->get();	

			}else{

				$query = $this->db->select('sinfo.*,einfo.*,ainfo.*,rinfo.*',false)
						  ->from('student_info AS sinfo')
						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
						  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
						  ->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','left')
						  ->join('result_info AS rinfo','rinfo.std_id = sinfo.std_id','left')
						  ->where('einfo.exam_info_id',$exam_id)
						  ->order_by("sinfo.std_roll_no","ASC")
						  ->get();	
			}
			
						  // echo $this->db->last_query();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}else{
				return NULL;
			}

	}// end function get_gazet_detail

	public function get_gazet_detail_for_six_or_ten_subjects($exam_id = '',$exam_type = 1,$inst_id = '')
	{		

			//,GROUP_CONCAT(DISTINCT rinfo.obtained_marks SEPARATOR ",") AS obtained_marks
			// $query = $this->db->select('sinfo.*,einfo.*,ainfo.*')
			// 				  ->select('GROUP_CONCAT(DISTINCT rinfo.subject_id SEPARATOR ",") AS subject FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id',false)
			// 			  ->from('student_info AS sinfo')
			// 			  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
			// 			  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
			// 			  ->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','left')
			// 			  // ->join('result_info AS rinfo','rinfo.std_id = sinfo.std_id AND rinfo.exam_id = einfo.exam_info_id','LEFT OUTER')
			// 			  ->where('einfo.exam_info_id',$exam_id)
			// 			  // ->where('sinfo.std_id',2084)
			// 			  ->order_by("sinfo.std_roll_no","ASC")
			// 			  ->get();

			$returnable_response = $subject_array = $student_records = $result_info = $obtained_marks_array = $subject_status_array = array();

			if (!empty($inst_id)) {

				if ($exam_type == 1) {

					$myquery  = 'SELECT sinfo.std_id,sinfo.attempt_no FROM student_info AS sinfo
									INNER JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									INNER JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id`
									LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no` 
									WHERE `einfo`.`exam_info_id` = '.$exam_id.'
									AND `ainfo`.`affli_id` = '.$inst_id.' 
									ORDER BY sinfo.std_roll_no ASC
									/*AND `sinfo`.`attempt_no` = "f_to_f"*/
							';
					$query = $this->db->query($myquery);
					/*$query = $this->db->query('SELECT sinfo.*, `einfo`.*,`ainfo`.*,
									 (SELECT GROUP_CONCAT(rinfo.subject_id ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks,
									 (SELECT GROUP_CONCAT(rinfo.subject_status ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Sub_status
									  FROM student_info AS sinfo 
									  LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									  LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									  LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
									  WHERE `einfo`.`exam_info_id` = '.$exam_id.' AND `ainfo`.`affli_id` = '.$inst_id.' ORDER BY sinfo.std_roll_no ASC');*/
				
				}else{

					$query = $this->db->query('SELECT sinfo.*, `einfo`.*,`ainfo`.*,
												GROUP_CONCAT(rpinfo.subject_id ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_subject_id
												,GROUP_CONCAT(rpinfo.obtained_marks ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_obtained_marks,
												GROUP_CONCAT(rpinfo.subject_status ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_Sub_status,
												(SELECT GROUP_CONCAT(rsinfo.subject_id ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as subject_id,
												(SELECT GROUP_CONCAT(rsinfo.obtained_marks ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Obtained_marks,
												(SELECT GROUP_CONCAT(rsinfo.subject_status ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Sub_status
												FROM student_info AS sinfo 
												LEFT JOIN `repeat_student_result_info` AS rpinfo ON `rpinfo`.`std_id` = `sinfo`.`std_id`
												LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id`
												LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
												LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
												WHERE `einfo`.`exam_info_id` = '.$exam_id.' AND `ainfo`.`affli_id` = '.$inst_id.'
												GROUP BY rpinfo.std_id ORDER BY sinfo.std_roll_no ASC');

					// $query = $this->db->query('SELECT sinfo.*, `einfo`.*,`ainfo`.*,
					// 				 (SELECT GROUP_CONCAT(rinfo.subject_id ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id,
					// 				 (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks,
					// 				 (SELECT GROUP_CONCAT(rinfo.subject_status ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Sub_status
					// 				  FROM student_info AS sinfo 
					// 				  LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
					// 				  LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
					// 				  LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
					// 				  WHERE `einfo`.`exam_info_id` = '.$exam_id.' AND `ainfo`.`affli_id` = '.$inst_id.' ORDER BY sinfo.std_roll_no ASC');

				}

			}else{

				if ($exam_type == 1) {

					$myquery  = 'SELECT sinfo.std_id,sinfo.attempt_no FROM student_info AS sinfo
									INNER JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									INNER JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									WHERE `einfo`.`exam_info_id` = '.$exam_id.'
									/*AND `sinfo`.`attempt_no` = "f_to_f"*/
							';

							// die("I AM HERE");
					/*$query = $this->db->query('SELECT sinfo.*, `einfo`.*,`ainfo`.*,
									 (SELECT GROUP_CONCAT(rinfo.subject_id ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks,
									 (SELECT GROUP_CONCAT(rinfo.subject_status ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Sub_status
									  FROM student_info AS sinfo 
									  LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									  LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									  LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
									  WHERE `einfo`.`exam_info_id` = '.$exam_id.'
									  ORDER BY sinfo.std_roll_no ASC');*/

					$query = $this->db->query($myquery);
				
				}else{

					$query = $this->db->query('SELECT sinfo.*, `einfo`.*,`ainfo`.*,GROUP_CONCAT(rpinfo.subject_id ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_subject_id
												,GROUP_CONCAT(rpinfo.obtained_marks ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_obtained_marks,
												GROUP_CONCAT(rpinfo.subject_status ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_Sub_status,
												(SELECT GROUP_CONCAT(rsinfo.subject_id ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as subject_id,
												(SELECT GROUP_CONCAT(rsinfo.obtained_marks ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Obtained_marks,
												(SELECT GROUP_CONCAT(rsinfo.subject_status ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Sub_status
												FROM student_info AS sinfo 
												LEFT JOIN `repeat_student_result_info` AS rpinfo ON `rpinfo`.`std_id` = `sinfo`.`std_id`
												LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id`
												LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
												LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
												WHERE `einfo`.`exam_info_id` = '.$exam_id.' 
												GROUP BY rpinfo.std_id ORDER BY sinfo.std_roll_no ASC');
				
				}
				
				/*$query = $this->db->query('SELECT sinfo.*, `einfo`.*,`ainfo`.*,
									 (SELECT GROUP_CONCAT(rinfo.subject_id ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks,
									 (SELECT GROUP_CONCAT(rinfo.subject_status ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Sub_status
									  FROM student_info AS sinfo 
									  LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									  LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									  LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
									  WHERE `einfo`.`exam_info_id` = '.$exam_id.' ORDER BY sinfo.std_roll_no ASC LIMIT 3,1');*/
			
			}
			
			if ($query->num_rows() > 0) {

				if ($exam_type != 1) {
					return $query->result_array();
				}

				$student_records = $query->result_array();
				/*echo '<pre>';print_r($student_records);echo '</pre>';
				die('yoho!');*/
				foreach ($student_records as $key => $rec) {
					
					if ($rec['attempt_no'] == "first") {

						$sb_query = $this->db->query('SELECT sinfo.*, `einfo`.*,`ainfo`.*,
									 (SELECT GROUP_CONCAT(rinfo.subject_id ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks,
									 (SELECT GROUP_CONCAT(rinfo.subject_status ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Sub_status
									  FROM student_info AS sinfo 
									  LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									  LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									  LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
									  WHERE `einfo`.`exam_info_id` = '.$exam_id.'
									  AND `sinfo`.`std_id` = '.$rec['std_id'].'
									  ORDER BY sinfo.std_roll_no ASC');
						$sb_query = $sb_query->result_array();
						/*echo '<pre>';print_r($sb_query);echo '</pre>';
						die("Now in my die case");*/
						$returnable_response[] = $sb_query[0]; 

					}elseif($rec['attempt_no'] == "third"){
						
						$student_info = $this->get_single_student_info_by_id($rec['std_id']);
						$student_info = $student_info[0];

						
						$r_result_info_query  = $this->db->query("SELECT rsrinfo.* FROM repeat_student_result_info AS rsrinfo WHERE rsrinfo.std_id = ".$rec['std_id']." ORDER BY rsrinfo.subject_id ASC");
						$r_result_info = $r_result_info_query->result_array();
						/*echo '<pre>';print_r($r_result_info);echo '</pre>';*/
						
						$r_result_info_sub_query = $this->db->query("SELECT rsinfo.* FROM repeat_student_result_info as rsinfo WHERE rsinfo.std_id = ".$r_result_info[0]['regular_student_id']." ORDER BY rsinfo.subject_id ASC ");
						$r_result_info_sub = $r_result_info_sub_query->result_array();
						/*echo '<pre>';print_r($r_result_info_sub);echo '</pre>';*/

						$r_result_info_sub_query_2 = $this->db->query("SELECT rinfo.* FROM result_info as rinfo WHERE rinfo.std_id = ".$r_result_info_sub[0]['regular_student_id']." ORDER BY rinfo.subject_id ASC ");
						$r_result_info_sub_2 = $r_result_info_sub_query_2->result_array();
						/*echo '<pre>';print_r($r_result_info_sub_2);echo '</pre>';*/

						if($r_result_info and count($r_result_info) > 0){
							foreach ($r_result_info as $key => $res)
							{
								$subject_array[] = $res['subject_id'];
								$obtained_marks_array[] = $res['obtained_marks'];
								$subject_status_array[] = $res['subject_status'];
							}	
						}
						
						if($r_result_info_sub and count($r_result_info_sub) > 0){
							foreach ($r_result_info_sub as $key => $res)
							{
								if (!in_array($res['subject_id'],$subject_array)) {
									$subject_array[] = $res['subject_id'];
									$obtained_marks_array[] = $res['obtained_marks'];
									$subject_status_array[] = $res['subject_status'];
								}
							}
						}

						if($r_result_info_sub_2 and count($r_result_info_sub_2) > 0){
							foreach ($r_result_info_sub_2 as $key => $res)
							{
								if (!in_array($res['subject_id'],$subject_array)) {
									$subject_array[] = $res['subject_id'];
									$obtained_marks_array[] = $res['obtained_marks'];
									$subject_status_array[] = $res['subject_status'];
								}
							}
						}

						$merged_array = array_combine($subject_array,$obtained_marks_array);
		    		  	ksort($merged_array);
		    		  	$std_subjects 		= implode(",", array_keys($merged_array));
		    		  	$std_obtained_marks = implode(",", array_values($merged_array));
						$std_subject_status = implode(",", $subject_status_array);

						$student_info['subject_id'] = $std_subjects;
						$student_info['Obtained_marks'] = $std_obtained_marks;
						$student_info['Sub_status'] = $std_subject_status;
						$returnable_response[] = $student_info;
						unset($subject_array,$obtained_marks_array,$subject_status_array,$std_subjects,$std_obtained_marks,$std_subject_status);
						
					}elseif($rec['attempt_no'] == "second"){
						
						$student_info = $this->get_single_student_info_by_id($rec['std_id']);
						$student_info = $student_info[0];
						
						$r_result_info_query  = $this->db->query("SELECT rsrinfo.* FROM repeat_student_result_info AS rsrinfo WHERE rsrinfo.std_id = ".$rec['std_id']." ORDER BY rsrinfo.subject_id ASC");
						$r_result_info = $r_result_info_query->result_array();
						
						$r_result_info_sub_query = $this->db->query("SELECT rinfo.* FROM result_info as rinfo WHERE rinfo.std_id = ".$r_result_info[0]['regular_student_id']." ORDER BY rinfo.subject_id ASC ");
						$r_result_info_sub = $r_result_info_sub_query->result_array();

						if($r_result_info and count($r_result_info) > 0){
							foreach ($r_result_info as $key => $res)
							{
								$subject_array[] = $res['subject_id'];
								$obtained_marks_array[] = $res['obtained_marks'];
								$subject_status_array[] = $res['subject_status'];
							}	
						}
						
						if($r_result_info_sub and count($r_result_info_sub) > 0){
							foreach ($r_result_info_sub as $key => $res)
							{
								if (!in_array($res['subject_id'],$subject_array)) {
									$subject_array[] = $res['subject_id'];
									$obtained_marks_array[] = $res['obtained_marks'];
									$subject_status_array[] = $res['subject_status'];
								}
							}
						}
						$merged_array = array_combine($subject_array,$obtained_marks_array);
		    		  	ksort($merged_array);
		    		  	$std_subjects 		= implode(",", array_keys($merged_array));
		    		  	$std_obtained_marks = implode(",", array_values($merged_array));
						$std_subject_status = implode(",", $subject_status_array);
						
						$student_info['subject_id'] = $std_subjects;
						$student_info['Obtained_marks'] = $std_obtained_marks;
						$student_info['Sub_status'] = $std_subject_status;
						$returnable_response[] = $student_info;
						unset($subject_array,$obtained_marks_array,$subject_status_array,$std_subjects,$std_obtained_marks,$std_subject_status);
						
					}elseif($rec['attempt_no'] == "f_to_f"){
						
						
						$student_info = $this->get_single_student_info_by_id($rec['std_id']);
						$student_info = $student_info[0];
						
						$r_result_info_query  = $this->db->query("SELECT rsrinfo.* FROM repeat_student_result_info AS rsrinfo WHERE rsrinfo.std_id = ".$rec['std_id']." ORDER BY rsrinfo.subject_id ASC");
						$r_result_info = $r_result_info_query->result_array();
						
						$r_result_info_sub_query = $this->db->query("SELECT rinfo.* FROM result_info as rinfo WHERE rinfo.std_id = ".$r_result_info[0]['regular_student_id']." ORDER BY rinfo.subject_id ASC ");
						$r_result_info_sub = $r_result_info_sub_query->result_array();

						if($r_result_info and count($r_result_info) > 0){
							foreach ($r_result_info as $key => $res)
							{
								$subject_array[] = $res['subject_id'];
								$obtained_marks_array[] = $res['obtained_marks'];
								$subject_status_array[] = $res['subject_status'];
							}	
						}
						
						if($r_result_info_sub and count($r_result_info_sub) > 0){
							foreach ($r_result_info_sub as $key => $res)
							{
								if (!in_array($res['subject_id'],$subject_array)) {
									$subject_array[] = $res['subject_id'];
									$obtained_marks_array[] = $res['obtained_marks'];
									$subject_status_array[] = $res['subject_status'];
								}
							}
						}

						$merged_array = array_combine($subject_array,$obtained_marks_array);
		    		  	ksort($merged_array);
		    		  	$std_subjects 		= implode(",", array_keys($merged_array));
		    		  	$std_obtained_marks = implode(",", array_values($merged_array));
						$std_subject_status = implode(",", $subject_status_array);
						
						$student_info['subject_id'] = $std_subjects;
						$student_info['Obtained_marks'] = $std_obtained_marks;
						$student_info['Sub_status'] = $std_subject_status;
						$returnable_response[] = $student_info;
						/*echo '<pre>';print_r($student_info);echo '</pre>';
						die('yoho!');*/
						unset($subject_array,$obtained_marks_array,$subject_status_array,$std_subjects,$std_obtained_marks,$std_subject_status);
						
					}
				}

			}
			
			// echo '<pre>';print_r($returnable_response);echo '</pre>';
			// die('yoho!');
			if (count($returnable_response) > 0) {
				return $returnable_response;
			}else {
				return NULL;
			}

	}// end function get_gazet_detail_for_six_or_ten_subjects

	public function update_hifz_exam_date_for_examination_center($exam_center_id ='')
	{
		if (empty($exam_center_id)) {
			return false;
		}
		$data = array(
					'hifzulquran_exam_date' => $this->input->post('hifzulquran_exam_date')
				);
		$this->db->where('eci_id', $exam_center_id);
		$this->db->update('examination_center_info', $data);
		if($this->db->affected_rows() >= 0){
			return true;
		}else{
			return false;
		}

	}// end function update_hifz_exam_date_for_examination_center

	public function update_tajweed_exam_date_for_examination_center($exam_center_id ='')
	{
		if (empty($exam_center_id)) {
			return false;
		}
		$data = array(
					'tajweedulquran_exam_date' => $this->input->post('tajweedulquran_exam_date')
				);
		$this->db->where('eci_id', $exam_center_id);
		$this->db->update('examination_center_info', $data);
		if($this->db->affected_rows() >= 0){
			return true;
		}else{
			return false;
		}
		
	}// end function update_tajweed_exam_date_for_examination_center

	public function getStudentForAttendanceSheet($exam_id ='',$exam_center_id = '',$exam_type = 1)
	{
		// echo 'here';
		if (!empty($exam_center_id)) {

				if ($exam_type == 2) {
					
					$query = $this->db->select('sinfo.*,ecinfo.exam_center_name_urdu,einfo.exam_name,GROUP_CONCAT(dsinfo.exam_date order by dsinfo.exam_subject_id ASC  SEPARATOR ",") as exam_date,GROUP_CONCAT(sbinfo.sub_name_urdu order by sbinfo.sub_id DESC SEPARATOR ",") as sub_name_urdu',false)
							  ->from('student_info AS sinfo')
							  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
							  ->join('examination_center_info ecinfo','ecinfo.eci_id = seinfo.exam_center_id','left')
							  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id')
							  ->join('repeat_student_result_info AS rsrinfo','rsrinfo.exam_id = seinfo.exam_id AND rsrinfo.std_id = sinfo.std_id','left')
						  	  ->join('subject_info AS sbinfo','sbinfo.sub_id = rsrinfo.subject_id','left')
						  	  ->join('datesheet_info AS dsinfo','dsinfo.exam_subject_id = rsrinfo.subject_id','left')
							  ->where('seinfo.exam_id',$exam_id)
							  ->where('ecinfo.eci_id',$exam_center_id)
							  // ->where('sinfo.std_roll_no',155)
							  ->group_by('sinfo.std_id','ASC')
							  ->get();
							  // echo $this->db->last_query();
							  // $query = $this->db->select('sinfo.*,ecinfo.exam_center_name_urdu,einfo.exam_name',false)
							  // ->from('student_info AS sinfo')
							  // ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
							  // ->join('examination_center_info ecinfo','ecinfo.eci_id = seinfo.exam_center_id','left')
							  // ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id')
							  // ->where('seinfo.exam_id',$exam_id)
							  // ->where('ecinfo.eci_id',$exam_center_id)
							  // ->get();
				}else{
					
					$query = $this->db->select('sinfo.*,ecinfo.exam_center_name_urdu,einfo.exam_name',false)
							  ->from('student_info AS sinfo')
							  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
							  ->join('examination_center_info ecinfo','ecinfo.eci_id = seinfo.exam_center_id','left')
							  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id')
							  ->where('seinfo.exam_id',$exam_id)
							  ->where('ecinfo.eci_id',$exam_center_id)
							  ->get();
				}

		}else{

			$query = $this->db->select('sinfo.*,ecinfo.exam_center_name_urdu,einfo.exam_name',false)
						  ->from('student_info AS sinfo')
						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
						  ->join('examination_center_info ecinfo','ecinfo.eci_id = seinfo.exam_center_id','left')
						  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id')
						  ->where('seinfo.exam_id',$exam_id)
						  ->get();

		}
		// echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}

	}// end function getStudentForAttendanceSheet

	public function getHifzStudentForAttendanceSheet($exam_id ='',$exam_center_id = '')
	{
		// echo 'here';
		if (empty($exam_id) or empty($exam_center_id)) {
			return NULL;
		}

		$query = $this->db->select('sinfo.*,ecinfo.exam_center_name_urdu,ecinfo.hifzulquran_exam_date,einfo.exam_name,einfo.exam_result_date_hijri,ainfo.affli_shortname',false)
						  ->from('student_info AS sinfo')
						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
						  ->join('examination_center_info ecinfo','ecinfo.eci_id = seinfo.exam_center_id','left')
						  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id')
						  ->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','left')
						  ->where('seinfo.exam_id',$exam_id)
						  ->where('ecinfo.eci_id',$exam_center_id)
						  ->get();

		// echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}

	}// end function getHifzStudentForAttendanceSheet

	public function getTajweedStudentForAttendanceSheet($exam_id ='',$exam_center_id = '')
	{
		// echo 'here';
		if (empty($exam_id) or empty($exam_center_id)) {
			return NULL;
		}

		$query = $this->db->select('sinfo.*,ecinfo.exam_center_name_urdu,ecinfo.tajweedulquran_exam_date,einfo.exam_name,einfo.exam_result_date_hijri,ainfo.affli_shortname',false)
						  ->from('student_info AS sinfo')
						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
						  ->join('examination_center_info ecinfo','ecinfo.eci_id = seinfo.exam_center_id','left')
						  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id')
						  ->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','left')
						  ->where('seinfo.exam_id',$exam_id)
						  ->where('ecinfo.eci_id',$exam_center_id)
						  ->get();

		// echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}

	}// end function getTajweedStudentForAttendanceSheet

	public function get_exam_subjects_by_exam_id($exam_id ='')
	{
		if (empty($exam_id)) {
			return NULL;
		}
		$class_id = $this->get_exam_class_id($exam_id);
		$subjects = $this->get_all_class_subjects($class_id);
		echo json_encode(array(
						'subject_array' => $subjects
						)
						);

	}// end function get_exam_subjects_by_exam_id

	public function get_all_students_with_subject_by_exam($exam_id = '',$subject_id = '',$limit = '',$offset = '')
	{
		if (empty($exam_id) || empty($subject_id) ) {
			return NULL;
		}
		$exam_type = $this->get_exam_type_by_exam_id($exam_id);

		if ($offset  == '') {

			if ($exam_type == 1) {

				$query = $this->db->query('SELECT sinfo.*, `einfo`.*,
										 (SELECT GROUP_CONCAT(rinfo.obtained_marks SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id AND rinfo.subject_id = '.$subject_id.') as Obtained_marks,
										 	(SELECT  rinfo.subject_status FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id AND rinfo.subject_id = '.$subject_id.') as sub_status
										 	FROM student_info AS sinfo 
										 	LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
										 	LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id`
										 	WHERE `einfo`.`exam_info_id` = '.$exam_id.' AND `sinfo`.`attempt_no` = "first" ORDER BY sinfo.std_roll_no ASC LIMIT '.$limit.' ');
			}else{

				$query = $this->db->query('SELECT sinfo.*, `einfo`.*,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id AND rinfo.subject_id = '.$subject_id.') as Obtained_marks,
									 (SELECT  rinfo.subject_status FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id AND rinfo.subject_id = '.$subject_id.') as sub_status
									 FROM student_info AS sinfo 
									 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id`
									 WHERE `einfo`.`exam_info_id` = '.$exam_id.' ORDER BY sinfo.std_roll_no ASC LIMIT '.$limit.' ');
			}
				
		}else{

			if ($exam_type == 1) {
					
				$query = $this->db->query('SELECT sinfo.*, `einfo`.*,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id AND rinfo.subject_id = '.$subject_id.') as Obtained_marks,
									 (SELECT  rinfo.subject_status FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id AND rinfo.subject_id = '.$subject_id.') as sub_status
									 FROM student_info AS sinfo 
									 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id`
									 WHERE `einfo`.`exam_info_id` = '.$exam_id.' AND `sinfo`.`attempt_no` = "first" ORDER BY sinfo.std_roll_no ASC LIMIT '.$offset.','.$limit.' ');
			}else{

				$query = $this->db->query('SELECT sinfo.*, `einfo`.*,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id AND rinfo.subject_id = '.$subject_id.') as Obtained_marks,
									 (SELECT  rinfo.subject_status FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id AND rinfo.subject_id = '.$subject_id.') as sub_status
									 FROM student_info AS sinfo 
									 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id`
									 WHERE `einfo`.`exam_info_id` = '.$exam_id.' ORDER BY sinfo.std_roll_no ASC LIMIT '.$offset.','.$limit.' ');
			}
		}
			
				// echo $this->db->last_query();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}else{
				return NULL;
			}

	}// end function get_all_students_with_subject_by_exam

	private function checkIfStudentExamSubjectResultExists($exam_id ='',$subject_id = '' ,$std_id = '',$exam_type = 1)
	{
		/*echo "exam_id => $exam_id, subject_id => $subject_id, std_id => $std_id, exam_type => $exam_type";
		echo '<pre>';print_r("I am here");echo '</pre>';
		die('yoho!');*/
		
		if ($exam_type == 2) {

			$query = $this->db->select('rsrinfo.*')
						  ->from('repeat_student_result_info AS rsrinfo')
						  ->where('rsrinfo.exam_id',$exam_id)
						  ->where('rsrinfo.std_id',$std_id)
						  ->where('rsrinfo.subject_id',$subject_id)
						  ->get();
		}else{

			$query = $this->db->select('rinfo.*')
						  ->from('result_info AS rinfo')
						  ->where('rinfo.exam_id',$exam_id)
						  ->where('rinfo.std_id',$std_id)
						  ->where('rinfo.subject_id',$subject_id)
						  ->get();	

		}

		/*echo 'Exam id is: '.$exam_id.' Subject_id is: '.$subject_id.' STd_id: '.$std_id.' exam type is: '.$exam_type;
		//die();
		echo $this->db->last_query();
		die();*/
		if ($query->num_rows() > 0) {
			return true;
		}else{
			return false;
		}

	}// end function checkIfStudentExamSubjectResultExists

	public function update_student_exam_subject_marks($exam_id = '',$subject_id = '',$exam_type = '1')
	{
		
		// echo '<pre>';print_r($_POST);echo '</pre>';
		// die();
		$response = false;
		$add = false;
			foreach ($_POST['std_id'] as $key => $std_id) {

				if ($this->checkIfStudentExamSubjectResultExists($exam_id,$subject_id,$std_id,$exam_type)) {

					// print_r($data);die();
					//echo '<pre>';print_r($_POST);echo '</pre>';die();
					$data = array(
								'obtained_marks' => $_POST['obtained_marks'][$key],
								'subject_status' => $_POST['option_'.$std_id]
							);
					// print_r($data);die();
					$this->db->where('std_id', $std_id);
					$this->db->where('exam_id', $exam_id);
					$this->db->where('subject_id', $subject_id);
					$this->db->update('result_info', $data);

				}else{
					// print_r($data);
					// die();
					$add = true;
					$insertData[] = array(
								'subject_id' => $subject_id,
								'std_id'	 => $std_id,
								'exam_id'	 => $exam_id,
								'obtained_marks' => ($_POST['obtained_marks'][$key] > 0) ? $_POST['obtained_marks'][$key] : 0,
								'subject_status' => (isset($_POST['option_'.$std_id])) ? $_POST['option_'.$std_id] : ""
								);

					// $data = array(
					// 	'subject_id' => $subject_id,
					// 	'std_id'	 => $std_id,
					// 	'exam_id'	 => $exam_id,
					// 	'obtained_marks' => $_POST['obtained_marks'][$key]
					// 	);
					// echo '<pre>';print_r($data);echo '</pre>';die();
					// $this->db->insert('result_info',$data);
				}

				
				
			}// end foreach
			/*echo '<pre>';print_r($insertData);echo '</pre>';
			die('yoho!');*/

			if ($add) {
					$this->db->insert_batch('result_info', $insertData);
				}
			if($this->db->affected_rows() >= 0){
				$response = true;
			}else{
				return false;
			}
		return $response;

	}// end function update_student_exam_subject_marks

	public function get_all_class_subjects($class_id ='')
	{
		if (empty($class_id)) {
			return NULL;
		}
		$query = $this->db->select('s.*',false)
						  ->from('subject_info AS s')
						  ->where('s.class_id',$class_id)
						  ->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return NULL;
		}

	}// end function get_all_class_subjects

	public function get_subject_name_by_id($subject_id ='' )
	{
		if (empty($subject_id)) {
			return NULL;
		}
		$query =  $this->db->select('sbinfo.sub_name_urdu')
						   ->from('subject_info AS sbinfo')
						   ->where('sbinfo.sub_id',$subject_id)
						   ->get();
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->sub_name_urdu;
		}
	
	}// end function get_subject_name_by_id

	public function get_all_student_result_card_info_old($exam_id ='',$affiliated_inst_id = '',$reg_no = '',$roll_no = '',$exam_type = 1)
	{
		if ( !empty($affiliated_inst_id) and empty($reg_no) and empty($roll_no) ) {

			if ($exam_type == 1) {
				

				$query = $this->db->query('SELECT sinfo.*, einfo.*,ainfo.affli_shortname,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks,
									 (SELECT GROUP_CONCAT(rinfo.subject_id ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id
									 FROM student_info AS sinfo 
									 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									 LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
									 WHERE `einfo`.`exam_info_id` = '.$exam_id.'
									 AND `sinfo`.`std_institute_reg_no` = '.$affiliated_inst_id.'
									 ORDER BY sinfo.std_roll_no ASC');


			}else{

				$query = $this->db->query('SELECT sinfo.*, `einfo`.*,ainfo.affli_shortname,
										  GROUP_CONCAT(rpinfo.subject_id ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_subject_id,
										  GROUP_CONCAT(rpinfo.obtained_marks ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_obtained_marks,
										  GROUP_CONCAT(rpinfo.subject_status ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_Sub_status,
										  (SELECT GROUP_CONCAT(rsinfo.subject_id ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as subject_id,
										  (SELECT GROUP_CONCAT(rsinfo.obtained_marks ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Obtained_marks,
										  (SELECT GROUP_CONCAT(rsinfo.subject_status ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Sub_status
										  FROM student_info AS sinfo 
										  LEFT JOIN `repeat_student_result_info` AS rpinfo ON `rpinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
										  LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
										  WHERE `einfo`.`exam_info_id` = '.$exam_id.' 
										  AND `sinfo`.`std_institute_reg_no` = '.$affiliated_inst_id.'
										  GROUP BY rpinfo.std_id ORDER BY sinfo.std_roll_no ASC LIMIT 1');


			}

			

			// $query = $this->db->select('sinfo.*,sinfo.std_id AS student_id,ainfo.*,rinfo.*')
			// 			  ->from('student_info AS sinfo')
			// 			  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
			// 			  ->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','left')
			// 			  ->join('result_info AS rinfo','rinfo.std_id = sinfo.std_id','left')
			// 			  ->where('seinfo.exam_id',$exam_id)
			// 			  ->order_by('')
			// 			  // ->where('sinfo.std_id',$std_id)
			// 			  ->get();
			// SELECT sinfo.*, einfo.*,ainfo.affli_shortname,
			// (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo
			// WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks
			// FROM student_info AS sinfo LEFT JOIN `student_exam_info` AS seinfo
			// ON `seinfo`.`std_id` = `sinfo`.`std_id`
			// LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id`
			// LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
			// WHERE `einfo`.`exam_info_id` = '9'
			// AND `sinfo`.`std_institute_reg_no` = '1'
			// ORDER BY sinfo.std_roll_no ASC
			// SELECT sinfo.*, einfo.*,ainfo.affli_shortname, (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks FROM student_info AS sinfo LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no` WHERE `einfo`.`exam_info_id` = '9' AND `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no` AND `sinfo`.`std_institute_reg_no` = '678' ORDER BY sinfo.std_roll_no ASC

		}elseif (!empty($affiliated_inst_id) and !empty($reg_no) and !empty($roll_no)) {

			if ($exam_type == 1) {

				$query = $this->db->query('SELECT sinfo.*, einfo.*,ainfo.affli_shortname,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks,
									 (SELECT GROUP_CONCAT(rinfo.subject_id ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id
									 FROM student_info AS sinfo 
									 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									 LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
									 WHERE `einfo`.`exam_info_id` = '.$exam_id.'
									 AND `sinfo`.`std_institute_reg_no` = '.$affiliated_inst_id.'
									 AND `sinfo`.`std_reg_no` = '.$reg_no.'
									 AND `sinfo`.`std_roll_no` = '.$roll_no.'
									 ORDER BY sinfo.std_roll_no ASC');
			}else{

				$query = $this->db->query('SELECT sinfo.*, `einfo`.*,ainfo.affli_shortname,
										  GROUP_CONCAT(rpinfo.subject_id ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_subject_id,
										  GROUP_CONCAT(rpinfo.obtained_marks ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_obtained_marks,
										  GROUP_CONCAT(rpinfo.subject_status ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_Sub_status,
										  (SELECT GROUP_CONCAT(rsinfo.subject_id ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as subject_id,
										  (SELECT GROUP_CONCAT(rsinfo.obtained_marks ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Obtained_marks,
										  (SELECT GROUP_CONCAT(rsinfo.subject_status ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Sub_status
										  FROM student_info AS sinfo 
										  LEFT JOIN `repeat_student_result_info` AS rpinfo ON `rpinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
										  LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
										  WHERE `einfo`.`exam_info_id` = '.$exam_id.' 
										  AND `sinfo`.`std_institute_reg_no` = '.$affiliated_inst_id.'
										  AND `sinfo`.`std_reg_no` = '.$reg_no.'
									 	  AND `sinfo`.`std_roll_no` = '.$roll_no.'
										  GROUP BY rpinfo.std_id ORDER BY sinfo.std_roll_no ASC');

			}
			

		}elseif (empty($affiliated_inst_id) and !empty($reg_no) and !empty($roll_no)) {

			if ($exam_type == 1) {

				$query = $this->db->query('SELECT sinfo.*, einfo.*,ainfo.affli_shortname,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks,
									 (SELECT GROUP_CONCAT(rinfo.subject_id ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id
									 FROM student_info AS sinfo 
									 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									 LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
									 WHERE `einfo`.`exam_info_id` = '.$exam_id.'
									 AND `sinfo`.`std_reg_no` = '.$reg_no.'
									 AND `sinfo`.`std_roll_no` = '.$roll_no.'
									 ORDER BY sinfo.std_roll_no ASC');

			}else{

				$query = $this->db->query('SELECT sinfo.*, `einfo`.*,ainfo.affli_shortname,
										  GROUP_CONCAT(rpinfo.subject_id ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_subject_id,
										  GROUP_CONCAT(rpinfo.obtained_marks ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_obtained_marks,
										  GROUP_CONCAT(rpinfo.subject_status ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_Sub_status,
										  (SELECT GROUP_CONCAT(rsinfo.subject_id ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as subject_id,
										  (SELECT GROUP_CONCAT(rsinfo.obtained_marks ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Obtained_marks,
										  (SELECT GROUP_CONCAT(rsinfo.subject_status ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Sub_status
										  FROM student_info AS sinfo 
										  LEFT JOIN `repeat_student_result_info` AS rpinfo ON `rpinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
										  LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
										  WHERE `einfo`.`exam_info_id` = '.$exam_id.' 
										  AND `sinfo`.`std_reg_no` = '.$reg_no.'
									 	  AND `sinfo`.`std_roll_no` = '.$roll_no.'
										  GROUP BY rpinfo.std_id ORDER BY sinfo.std_roll_no ASC LIMIT 1');


			}
			

		}elseif (empty($affiliated_inst_id) and !empty($reg_no) and empty($roll_no)) {

			if ($exam_type == 1) {

				$query = $this->db->query('SELECT sinfo.*, einfo.*,ainfo.affli_shortname,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks,
									 (SELECT GROUP_CONCAT(rinfo.subject_id ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id
									 FROM student_info AS sinfo 
									 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									 LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
									 WHERE `einfo`.`exam_info_id` = '.$exam_id.'
									 AND `sinfo`.`std_reg_no` = '.$reg_no.'
									 ORDER BY sinfo.std_roll_no ASC');

			}else{

				$query = $this->db->query('SELECT sinfo.*, `einfo`.*,ainfo.affli_shortname,
										  GROUP_CONCAT(rpinfo.subject_id ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_subject_id,
										  GROUP_CONCAT(rpinfo.obtained_marks ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_obtained_marks,
										  GROUP_CONCAT(rpinfo.subject_status ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_Sub_status,
										  (SELECT GROUP_CONCAT(rsinfo.subject_id ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as subject_id,
										  (SELECT GROUP_CONCAT(rsinfo.obtained_marks ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Obtained_marks,
										  (SELECT GROUP_CONCAT(rsinfo.subject_status ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Sub_status
										  FROM student_info AS sinfo 
										  LEFT JOIN `repeat_student_result_info` AS rpinfo ON `rpinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
										  LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
										  WHERE `einfo`.`exam_info_id` = '.$exam_id.' 
									 	  AND `sinfo`.`std_reg_no` = '.$reg_no.'
										  GROUP BY rpinfo.std_id ORDER BY sinfo.std_roll_no ASC');

			}
			

		}elseif (empty($affiliated_inst_id) and empty($reg_no) and !empty($roll_no)) {

			if ($exam_type == 1) {

				$query = $this->db->query('SELECT sinfo.*, einfo.*,ainfo.affli_shortname,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks,
									 (SELECT GROUP_CONCAT(rinfo.subject_id ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id
									 FROM student_info AS sinfo 
									 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									 LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
									 WHERE `einfo`.`exam_info_id` = '.$exam_id.'
									 AND `sinfo`.`std_roll_no` = '.$roll_no.'
									 ORDER BY sinfo.std_roll_no ASC');
			}else{

				$query = $this->db->query('SELECT sinfo.*, `einfo`.*,ainfo.affli_shortname,
										  GROUP_CONCAT(rpinfo.subject_id ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_subject_id,
										  GROUP_CONCAT(rpinfo.obtained_marks ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_obtained_marks,
										  GROUP_CONCAT(rpinfo.subject_status ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_Sub_status,
										  (SELECT GROUP_CONCAT(rsinfo.subject_id ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as subject_id,
										  (SELECT GROUP_CONCAT(rsinfo.obtained_marks ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Obtained_marks,
										  (SELECT GROUP_CONCAT(rsinfo.subject_status ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Sub_status
										  FROM student_info AS sinfo 
										  LEFT JOIN `repeat_student_result_info` AS rpinfo ON `rpinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
										  LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
										  WHERE `einfo`.`exam_info_id` = '.$exam_id.' 
									 	  AND `sinfo`.`std_roll_no` = '.$roll_no.'
										  GROUP BY rpinfo.std_id ORDER BY sinfo.std_roll_no ASC LIMIT 1');

			}
		
		}else{

			if ($exam_type == 1) {

				$query = $this->db->query('SELECT sinfo.*, einfo.*,ainfo.affli_shortname,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks,
									 (SELECT GROUP_CONCAT(rinfo.subject_id ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id
									 FROM student_info AS sinfo 
									 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									 LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
									 WHERE `einfo`.`exam_info_id` = '.$exam_id.'
									 AND `sinfo`.std_reg_no = 143602370
									 ORDER BY sinfo.std_roll_no ASC');

				$query =  $this->db->query("SELECT sinfo.std_id,sinfo.attempt_no FROM student_info AS sinfo
									INNER JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									INNER JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									WHERE `einfo`.`exam_info_id` = '$exam_id'
									#AND `sinfo`.std_reg_no = 143602370
									ORDER BY `sinfo`.std_id DESC 
									LIMIT 1
									");

				echo "SELECT sinfo.std_id,sinfo.attempt_no FROM student_info AS sinfo
									INNER JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									INNER JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									WHERE `einfo`.`exam_info_id` = '$exam_id'
									AND `sinfo`.std_reg_no = 143602370
									ORDER BY `sinfo`.std_id DESC ";


			}else{

				$query = $this->db->query('SELECT sinfo.*, `einfo`.*,ainfo.affli_shortname,
										  GROUP_CONCAT(rpinfo.subject_id ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_subject_id,
										  GROUP_CONCAT(rpinfo.obtained_marks ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_obtained_marks,
										  GROUP_CONCAT(rpinfo.subject_status ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_Sub_status,
										  (SELECT GROUP_CONCAT(rsinfo.subject_id ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as subject_id,
										  (SELECT GROUP_CONCAT(rsinfo.obtained_marks ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Obtained_marks,
										  (SELECT GROUP_CONCAT(rsinfo.subject_status ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Sub_status
										  FROM student_info AS sinfo 
										  LEFT JOIN `repeat_student_result_info` AS rpinfo ON `rpinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
										  LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
										  WHERE `einfo`.`exam_info_id` = '.$exam_id.' 
										  GROUP BY rpinfo.std_id ORDER BY sinfo.std_roll_no ASC');

			}
		
		}
		// echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			echo '<pre>';print_r($query->result_array());echo '</pre>';
			die();
			return $query->result_array();
		}else{
			return NULL;
		}
		
	}// end function get_all_student_result_card_info

	public function get_all_student_result_card_info($exam_id ='',$affiliated_inst_id = '',$reg_no = '',$roll_no = '',$exam_type = 1)
	{
		$returnable_response = $subject_array = $student_records = $result_info = $obtained_marks_array = $subject_status_array = array();
		
		if ( !empty($affiliated_inst_id) and empty($reg_no) and empty($roll_no) ) {
		
			if ($exam_type == 1) {
				
				$myquery  = 'SELECT sinfo.std_id,sinfo.attempt_no
								FROM student_info AS sinfo 
							 	LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
							 	LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
							 	LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
							 	WHERE `einfo`.`exam_info_id` = '.$exam_id.'
							 	AND `sinfo`.`std_institute_reg_no` = '.$affiliated_inst_id.'
								ORDER BY sinfo.std_roll_no ASC';

				$query = $this->db->query($myquery);
				/*$query = $this->db->query('SELECT sinfo.*, einfo.*,ainfo.affli_shortname,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks,
									 (SELECT GROUP_CONCAT(rinfo.subject_id ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id
									 FROM student_info AS sinfo 
									 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									 LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
									 WHERE `einfo`.`exam_info_id` = '.$exam_id.'
									 AND `sinfo`.`std_institute_reg_no` = '.$affiliated_inst_id.'
									 ORDER BY sinfo.std_roll_no ASC');*/
			}else{

				$query = $this->db->query('SELECT sinfo.*, `einfo`.*,ainfo.affli_shortname,
										  GROUP_CONCAT(rpinfo.subject_id ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_subject_id,
										  GROUP_CONCAT(rpinfo.obtained_marks ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_obtained_marks,
										  GROUP_CONCAT(rpinfo.subject_status ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_Sub_status,
										  (SELECT GROUP_CONCAT(rsinfo.subject_id ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as subject_id,
										  (SELECT GROUP_CONCAT(rsinfo.obtained_marks ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Obtained_marks,
										  (SELECT GROUP_CONCAT(rsinfo.subject_status ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Sub_status
										  FROM student_info AS sinfo 
										  LEFT JOIN `repeat_student_result_info` AS rpinfo ON `rpinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
										  LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
										  WHERE `einfo`.`exam_info_id` = '.$exam_id.' 
										  AND `sinfo`.`std_institute_reg_no` = '.$affiliated_inst_id.'
										  GROUP BY rpinfo.std_id ORDER BY sinfo.std_roll_no ASC LIMIT 1');
			}
			
			// $query = $this->db->select('sinfo.*,sinfo.std_id AS student_id,ainfo.*,rinfo.*')
			// 			  ->from('student_info AS sinfo')
			// 			  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
			// 			  ->join('affiliation_info AS ainfo','ainfo.inst_reg_no = sinfo.std_institute_reg_no','left')
			// 			  ->join('result_info AS rinfo','rinfo.std_id = sinfo.std_id','left')
			// 			  ->where('seinfo.exam_id',$exam_id)
			// 			  ->order_by('')
			// 			  // ->where('sinfo.std_id',$std_id)
			// 			  ->get();
			// SELECT sinfo.*, einfo.*,ainfo.affli_shortname,
			// (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo
			// WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks
			// FROM student_info AS sinfo LEFT JOIN `student_exam_info` AS seinfo
			// ON `seinfo`.`std_id` = `sinfo`.`std_id`
			// LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id`
			// LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
			// WHERE `einfo`.`exam_info_id` = '9'
			// AND `sinfo`.`std_institute_reg_no` = '1'
			// ORDER BY sinfo.std_roll_no ASC
			// SELECT sinfo.*, einfo.*,ainfo.affli_shortname, (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks FROM student_info AS sinfo LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no` WHERE `einfo`.`exam_info_id` = '9' AND `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no` AND `sinfo`.`std_institute_reg_no` = '678' ORDER BY sinfo.std_roll_no ASC
		}elseif (!empty($affiliated_inst_id) and !empty($reg_no) and !empty($roll_no)) {
			if ($exam_type == 1) {
				$myquery  = 'SELECT sinfo.std_id,sinfo.attempt_no
								FROM student_info AS sinfo 
							 	LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
								LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
								LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
								WHERE `einfo`.`exam_info_id` = '.$exam_id.'
								AND `sinfo`.`std_institute_reg_no` = '.$affiliated_inst_id.'
								AND `sinfo`.`std_reg_no` = '.$reg_no.'
								AND `sinfo`.`std_roll_no` = '.$roll_no.'
								ORDER BY sinfo.std_roll_no ASC';
				$query = $this->db->query($myquery);
				/*$query = $this->db->query('SELECT sinfo.*, einfo.*,ainfo.affli_shortname,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks,
									 (SELECT GROUP_CONCAT(rinfo.subject_id ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id
									 FROM student_info AS sinfo 
									 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									 LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
									 WHERE `einfo`.`exam_info_id` = '.$exam_id.'
									 AND `sinfo`.`std_institute_reg_no` = '.$affiliated_inst_id.'
									 AND `sinfo`.`std_reg_no` = '.$reg_no.'
									 AND `sinfo`.`std_roll_no` = '.$roll_no.'
									 ORDER BY sinfo.std_roll_no ASC');*/
			}else{
				$query = $this->db->query('SELECT sinfo.*, `einfo`.*,ainfo.affli_shortname,
										  GROUP_CONCAT(rpinfo.subject_id ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_subject_id,
										  GROUP_CONCAT(rpinfo.obtained_marks ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_obtained_marks,
										  GROUP_CONCAT(rpinfo.subject_status ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_Sub_status,
										  (SELECT GROUP_CONCAT(rsinfo.subject_id ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as subject_id,
										  (SELECT GROUP_CONCAT(rsinfo.obtained_marks ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Obtained_marks,
										  (SELECT GROUP_CONCAT(rsinfo.subject_status ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Sub_status
										  FROM student_info AS sinfo 
										  LEFT JOIN `repeat_student_result_info` AS rpinfo ON `rpinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
										  LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
										  WHERE `einfo`.`exam_info_id` = '.$exam_id.' 
										  AND `sinfo`.`std_institute_reg_no` = '.$affiliated_inst_id.'
										  AND `sinfo`.`std_reg_no` = '.$reg_no.'
									 	  AND `sinfo`.`std_roll_no` = '.$roll_no.'
										  GROUP BY rpinfo.std_id ORDER BY sinfo.std_roll_no ASC');
			}
			
		}elseif (empty($affiliated_inst_id) and !empty($reg_no) and !empty($roll_no)) {
			if ($exam_type == 1) {
				$myquery  = 'SELECT sinfo.std_id,sinfo.attempt_no FROM student_info sinfo
								LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
								LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
								LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
								WHERE `einfo`.`exam_info_id` = '.$exam_id.'
								AND `sinfo`.`std_reg_no` = '.$reg_no.'
								AND `sinfo`.`std_roll_no` = '.$roll_no.'
								ORDER BY sinfo.std_roll_no ASC';
				$query = $this->db->query($myquery);
				/*$query = $this->db->query('SELECT sinfo.*, einfo.*,ainfo.affli_shortname,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks,
									 (SELECT GROUP_CONCAT(rinfo.subject_id ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id
									 FROM student_info AS sinfo 
									 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									 LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
									 WHERE `einfo`.`exam_info_id` = '.$exam_id.'
									 AND `sinfo`.`std_reg_no` = '.$reg_no.'
									 AND `sinfo`.`std_roll_no` = '.$roll_no.'
									 ORDER BY sinfo.std_roll_no ASC');*/
			}else{
				$query = $this->db->query('SELECT sinfo.*, `einfo`.*,ainfo.affli_shortname,
										  GROUP_CONCAT(rpinfo.subject_id ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_subject_id,
										  GROUP_CONCAT(rpinfo.obtained_marks ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_obtained_marks,
										  GROUP_CONCAT(rpinfo.subject_status ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_Sub_status,
										  (SELECT GROUP_CONCAT(rsinfo.subject_id ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as subject_id,
										  (SELECT GROUP_CONCAT(rsinfo.obtained_marks ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Obtained_marks,
										  (SELECT GROUP_CONCAT(rsinfo.subject_status ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Sub_status
										  FROM student_info AS sinfo 
										  LEFT JOIN `repeat_student_result_info` AS rpinfo ON `rpinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
										  LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
										  WHERE `einfo`.`exam_info_id` = '.$exam_id.' 
										  AND `sinfo`.`std_reg_no` = '.$reg_no.'
									 	  AND `sinfo`.`std_roll_no` = '.$roll_no.'
										  GROUP BY rpinfo.std_id ORDER BY sinfo.std_roll_no ASC LIMIT 1');
			}
			
		}elseif (empty($affiliated_inst_id) and !empty($reg_no) and empty($roll_no)) {
			if ($exam_type == 1) {
				$myquery  = 'SELECT sinfo.std_id,sinfo.attempt_no
								FROM student_info AS sinfo 
								LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
								LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
								LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
								WHERE `einfo`.`exam_info_id` = '.$exam_id.'
								AND `sinfo`.`std_reg_no` = '.$reg_no.'
								ORDER BY sinfo.std_roll_no ASC';
				$query = $this->db->query($myquery);
				/*$query = $this->db->query('SELECT sinfo.*, einfo.*,ainfo.affli_shortname,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks,
									 (SELECT GROUP_CONCAT(rinfo.subject_id ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id
									 FROM student_info AS sinfo 
									 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									 LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
									 WHERE `einfo`.`exam_info_id` = '.$exam_id.'
									 AND `sinfo`.`std_reg_no` = '.$reg_no.'
									 ORDER BY sinfo.std_roll_no ASC');*/
			}else{
				$query = $this->db->query('SELECT sinfo.*, `einfo`.*,ainfo.affli_shortname,
										  GROUP_CONCAT(rpinfo.subject_id ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_subject_id,
										  GROUP_CONCAT(rpinfo.obtained_marks ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_obtained_marks,
										  GROUP_CONCAT(rpinfo.subject_status ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_Sub_status,
										  (SELECT GROUP_CONCAT(rsinfo.subject_id ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as subject_id,
										  (SELECT GROUP_CONCAT(rsinfo.obtained_marks ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Obtained_marks,
										  (SELECT GROUP_CONCAT(rsinfo.subject_status ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Sub_status
										  FROM student_info AS sinfo 
										  LEFT JOIN `repeat_student_result_info` AS rpinfo ON `rpinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
										  LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
										  WHERE `einfo`.`exam_info_id` = '.$exam_id.' 
									 	  AND `sinfo`.`std_reg_no` = '.$reg_no.'
										  GROUP BY rpinfo.std_id ORDER BY sinfo.std_roll_no ASC');
			}
			
		}elseif (empty($affiliated_inst_id) and empty($reg_no) and !empty($roll_no)) {
			
			if ($exam_type == 1) {
				$myquery  = 'SELECT sinfo.std_id,sinfo.attempt_no
								FROM student_info AS sinfo 
								LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
								LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
								LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
								WHERE `einfo`.`exam_info_id` = '.$exam_id.'
								AND `sinfo`.`std_roll_no` = '.$roll_no.'
								ORDER BY sinfo.std_roll_no ASC';
				$query = $this->db->query($myquery);
				/*$query = $this->db->query('SELECT sinfo.*, einfo.*,ainfo.affli_shortname,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks,
									 (SELECT GROUP_CONCAT(rinfo.subject_id ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id
									 FROM student_info AS sinfo 
									 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									 LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
									 WHERE `einfo`.`exam_info_id` = '.$exam_id.'
									 AND `sinfo`.`std_roll_no` = '.$roll_no.'
									 ORDER BY sinfo.std_roll_no ASC');*/
			}else{
				$query = $this->db->query('SELECT sinfo.*, `einfo`.*,ainfo.affli_shortname,
										  GROUP_CONCAT(rpinfo.subject_id ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_subject_id,
										  GROUP_CONCAT(rpinfo.obtained_marks ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_obtained_marks,
										  GROUP_CONCAT(rpinfo.subject_status ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_Sub_status,
										  (SELECT GROUP_CONCAT(rsinfo.subject_id ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as subject_id,
										  (SELECT GROUP_CONCAT(rsinfo.obtained_marks ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Obtained_marks,
										  (SELECT GROUP_CONCAT(rsinfo.subject_status ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Sub_status
										  FROM student_info AS sinfo 
										  LEFT JOIN `repeat_student_result_info` AS rpinfo ON `rpinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
										  LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
										  WHERE `einfo`.`exam_info_id` = '.$exam_id.' 
									 	  AND `sinfo`.`std_roll_no` = '.$roll_no.'
										  GROUP BY rpinfo.std_id ORDER BY sinfo.std_roll_no ASC LIMIT 1');
			}
		
		}else{

			if ($exam_type == 1) {

				$query = $this->db->query('SELECT sinfo.*, einfo.*,ainfo.affli_shortname,
									 (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks,
									 (SELECT GROUP_CONCAT(rinfo.subject_id ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id
									 FROM student_info AS sinfo 
									 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									 LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
									 WHERE `einfo`.`exam_info_id` = '.$exam_id.'
									 #AND `sinfo`.`std_reg_no` = 143602547
									 ORDER BY sinfo.std_roll_no ASC');
			}else{

				$query = $this->db->query('SELECT sinfo.*, `einfo`.*,ainfo.affli_shortname,
										  GROUP_CONCAT(rpinfo.subject_id ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_subject_id,
										  GROUP_CONCAT(rpinfo.obtained_marks ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_obtained_marks,
										  GROUP_CONCAT(rpinfo.subject_status ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_Sub_status,
										  (SELECT GROUP_CONCAT(rsinfo.subject_id ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as subject_id,
										  (SELECT GROUP_CONCAT(rsinfo.obtained_marks ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Obtained_marks,
										  (SELECT GROUP_CONCAT(rsinfo.subject_status ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Sub_status
										  FROM student_info AS sinfo 
										  LEFT JOIN `repeat_student_result_info` AS rpinfo ON `rpinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id`
										  LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
										  LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
										  WHERE `einfo`.`exam_info_id` = '.$exam_id.' 
										  GROUP BY rpinfo.std_id ORDER BY sinfo.std_roll_no ASC');
			}
		
		}
		
		// echo $this->db->last_query();

		if ($query->num_rows() > 0) {

			if ($exam_type != 1) {
				return $query->result_array();
			}
			$student_records = $query->result_array();
			/*echo '<pre>';print_r($student_records);echo '</pre>';
			die();*/

			foreach ($student_records as $key => $rec) 
			{					
				if ($rec['attempt_no'] == "first") {

					$sb_query = $this->db->query('SELECT sinfo.*, einfo.*,ainfo.affli_shortname,
												 (SELECT GROUP_CONCAT(rinfo.obtained_marks ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks,
												 (SELECT GROUP_CONCAT(rinfo.subject_id ORDER BY rinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id
												 FROM student_info AS sinfo 
												 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
												 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
												 LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
												 WHERE `sinfo`.`std_id` = '.$rec['std_id'].'
												 ORDER BY sinfo.std_roll_no ASC');
					
					$response = $sb_query->result_array();
					/*echo '<pre>';print_r($response[0]);echo '</pre>';
					die();*/
					$returnable_response[] = $response[0]; 
					
				}elseif($rec['attempt_no'] == "second"){
					
					$student_info = $this->get_single_student_info_by_id($rec['std_id']);
					$student_info = $student_info[0];
					
					$r_result_info_query  = $this->db->query("SELECT rsrinfo.* FROM repeat_student_result_info AS rsrinfo WHERE rsrinfo.std_id = ".$rec['std_id']." ORDER BY rsrinfo.subject_id ASC");
					$r_result_info = $r_result_info_query->result_array();
					
					$r_result_info_sub_query = $this->db->query("SELECT rinfo.* FROM result_info as rinfo WHERE rinfo.std_id = ".$r_result_info[0]['regular_student_id']." ORDER BY rinfo.subject_id ASC ");
					$r_result_info_sub = $r_result_info_sub_query->result_array();
					if($r_result_info and count($r_result_info) > 0){
						foreach ($r_result_info as $key => $res)
						{
							$subject_array[] = $res['subject_id'];
							$obtained_marks_array[] = $res['obtained_marks'];
							$subject_status_array[] = $res['subject_status'];
						}	
					}
					
					if($r_result_info_sub and count($r_result_info_sub) > 0){
						foreach ($r_result_info_sub as $key => $res)
						{
							if (!in_array($res['subject_id'],$subject_array)) {
								$subject_array[] = $res['subject_id'];
								$obtained_marks_array[] = $res['obtained_marks'];
								$subject_status_array[] = $res['subject_status'];
							}
						}
					}
					$merged_array = array_combine($subject_array,$obtained_marks_array);
	    		  	ksort($merged_array);
	    		  	$std_subjects 		= implode(",", array_keys($merged_array));
	    		  	$std_obtained_marks = implode(",", array_values($merged_array));
					$std_subject_status = implode(",", $subject_status_array);
					
					$student_info['subject_id'] = $std_subjects;
					$student_info['Obtained_marks'] = $std_obtained_marks;
					$student_info['Sub_status'] = $std_subject_status;
					$returnable_response[] = $student_info;
					unset($subject_array,$obtained_marks_array,$subject_status_array,$std_subjects,$std_obtained_marks,$std_subject_status);
					
				}elseif($rec['attempt_no'] == "third"){
					
					$student_info = $this->get_single_student_info_by_id($rec['std_id']);
					$student_info = $student_info[0];
					
					$r_result_info_query  = $this->db->query("SELECT rsrinfo.* FROM repeat_student_result_info AS rsrinfo WHERE rsrinfo.std_id = ".$rec['std_id']." ORDER BY rsrinfo.subject_id ASC");
					$r_result_info = $r_result_info_query->result_array();
					/*echo '<pre>';print_r($r_result_info);echo '</pre>';*/
					
					$r_result_info_sub_query = $this->db->query("SELECT rsinfo.* FROM repeat_student_result_info as rsinfo WHERE rsinfo.std_id = ".$r_result_info[0]['regular_student_id']." ORDER BY rsinfo.subject_id ASC ");
					$r_result_info_sub = $r_result_info_sub_query->result_array();
					/*echo '<pre>';print_r($r_result_info_sub);echo '</pre>';*/
					$r_result_info_sub_query_2 = $this->db->query("SELECT rinfo.* FROM result_info as rinfo WHERE rinfo.std_id = ".$r_result_info_sub[0]['regular_student_id']." ORDER BY rinfo.subject_id ASC ");
					$r_result_info_sub_2 = $r_result_info_sub_query_2->result_array();
					/*echo '<pre>';print_r($r_result_info_sub_2);echo '</pre>';*/
					if($r_result_info and count($r_result_info) > 0){
						foreach ($r_result_info as $key => $res)
						{
							$subject_array[] = $res['subject_id'];
							$obtained_marks_array[] = $res['obtained_marks'];
							$subject_status_array[] = $res['subject_status'];
						}	
					}
					
					if($r_result_info_sub and count($r_result_info_sub) > 0){
						foreach ($r_result_info_sub as $key => $res)
						{
							if (!in_array($res['subject_id'],$subject_array)) {
								$subject_array[] = $res['subject_id'];
								$obtained_marks_array[] = $res['obtained_marks'];
								$subject_status_array[] = $res['subject_status'];
							}
						}
					}
					if($r_result_info_sub_2 and count($r_result_info_sub_2) > 0){
						foreach ($r_result_info_sub_2 as $key => $res)
						{
							if (!in_array($res['subject_id'],$subject_array)) {
								$subject_array[] = $res['subject_id'];
								$obtained_marks_array[] = $res['obtained_marks'];
								$subject_status_array[] = $res['subject_status'];
							}
						}
					}
					$merged_array = array_combine($subject_array,$obtained_marks_array);
	    		  	ksort($merged_array);
	    		  	$std_subjects 		= implode(",", array_keys($merged_array));
	    		  	$std_obtained_marks = implode(",", array_values($merged_array));
					$std_subject_status = implode(",", $subject_status_array);
					$student_info['subject_id'] = $std_subjects;
					$student_info['Obtained_marks'] = $std_obtained_marks;
					$student_info['Sub_status'] = $std_subject_status;
					$returnable_response[] = $student_info;
					unset($subject_array,$obtained_marks_array,$subject_status_array,$std_subjects,$std_obtained_marks,$std_subject_status);
					
				}elseif($rec['attempt_no'] == "f_to_f"){
					
					
					$student_info = $this->get_single_student_info_by_id($rec['std_id']);
					$student_info = $student_info[0];
					
					$r_result_info_query  = $this->db->query("SELECT rsrinfo.* FROM repeat_student_result_info AS rsrinfo WHERE rsrinfo.std_id = ".$rec['std_id']." ORDER BY rsrinfo.subject_id ASC");
					$r_result_info = $r_result_info_query->result_array();
					
					$r_result_info_sub_query = $this->db->query("SELECT rinfo.* FROM result_info as rinfo WHERE rinfo.std_id = ".$r_result_info[0]['regular_student_id']." ORDER BY rinfo.subject_id ASC ");
					$r_result_info_sub = $r_result_info_sub_query->result_array();
					if($r_result_info and count($r_result_info) > 0){
						foreach ($r_result_info as $key => $res)
						{
							$subject_array[] = $res['subject_id'];
							$obtained_marks_array[] = $res['obtained_marks'];
							$subject_status_array[] = $res['subject_status'];
						}	
					}
					
					if($r_result_info_sub and count($r_result_info_sub) > 0){
						foreach ($r_result_info_sub as $key => $res)
						{
							if (!in_array($res['subject_id'],$subject_array)) {
								$subject_array[] = $res['subject_id'];
								$obtained_marks_array[] = $res['obtained_marks'];
								$subject_status_array[] = $res['subject_status'];
							}
						}
					}
					
					$merged_array = array_combine($subject_array,$obtained_marks_array);
	    		  	ksort($merged_array);
	    		  	$std_subjects 		= implode(",", array_keys($merged_array));
	    		  	$std_obtained_marks = implode(",", array_values($merged_array));
					$std_subject_status = implode(",", $subject_status_array);
					
					$student_info['subject_id'] = $std_subjects;
					$student_info['Obtained_marks'] = $std_obtained_marks;
					$student_info['Sub_status'] = $std_subject_status;
					$returnable_response[] = $student_info;
					// echo '<pre>';print_r($student_info);echo '</pre>';
					// die('yoho!');
					unset($subject_array,$obtained_marks_array,$subject_status_array,$std_subjects,$std_obtained_marks,$std_subject_status);
					
				}
			}// END FOREACH
			/*echo '<pre>';print_r($returnable_response);echo '</pre>';
			die('yoho!');*/
			if (count($returnable_response) > 0) {
				return $returnable_response;
			}else {
				return NULL;
			}
		}else{
			return NULL;
		}
		
	}// end function get_all_student_result_card_info

	public function get_exam_students_for_degree_print($exam_id='',$exam_type = 1,$grade_type = '')
	{
		if (empty($exam_id) || empty($grade_type)) {
			return NULL;
		}
		$response = array();
		// $query = $this->db->query('SELECT sinfo.*,
		// 						 (SELECT GROUP_CONCAT(rinfo.obtained_marks SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id AND rinfo.obtained_marks > 39) as Obtained_marks,
		// 						 einfo.exam_name,einfo.exam_type_id,ainfo.affli_shortname
		// 						 FROM student_info AS sinfo 
		// 						 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
		// 						 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
		// 						 LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
		// 						 WHERE `einfo`.`exam_info_id` = '.$exam_id.' ORDER BY sinfo.std_roll_no ASC');
		// WHERE `einfo`.`exam_info_id` = '.$exam_id.' ORDER BY sinfo.std_roll_no ASC LIMIT 0,2');
		if ($grade_type == 'grade0' || $grade_type == 'grade1' ) {
			$query = $this->db->query('SELECT sinfo.*,einfo.*,
									   ainfo.affli_shortname,rinfo.obtained_marks
								 FROM student_info AS sinfo 
								 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
								 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
								 LEFT JOIN `result_info` AS rinfo ON `rinfo`.std_id =  `sinfo`.`std_id`
								 LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
								 WHERE `einfo`.`exam_info_id` = '.$exam_id.'
								 AND  `rinfo`.`obtained_marks` > 39 ORDER BY sinfo.std_roll_no ASC');
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}else{
				return NULL;
			}
		}else{
			/*echo '<pre>';print_r($exam_id);echo '</pre>';
			die('yoho!');*/
			if ($exam_type == 1) {
				// echo 'I am here';die();
				$myquery = $this->db->query("SELECT sinfo.std_id,sinfo.attempt_no FROM student_info AS sinfo
									INNER JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
									INNER JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
									WHERE `einfo`.`exam_info_id` = ".$exam_id."
									");
			}else{
				$myquery = $this->db->query("SELECT sinfo.*, `einfo`.*,`ainfo`.*,
									GROUP_CONCAT(rpinfo.obtained_marks ORDER BY rpinfo.subject_id ASC SEPARATOR ',') AS r_obtained_marks,
									(SELECT GROUP_CONCAT(rsinfo.obtained_marks ORDER BY rsinfo.subject_id ASC SEPARATOR ',') FROM result_info AS rsinfo 
									WHERE rsinfo.std_id = rpinfo.regular_student_id AND rsinfo.`obtained_marks` > 39) AS Obtained_marks 
								FROM student_info AS sinfo 
								LEFT JOIN `repeat_student_result_info` AS rpinfo ON `rpinfo`.`std_id` = `sinfo`.`std_id` 
								LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
								LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
								LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no` 
								WHERE `einfo`.`exam_info_id` = ".$exam_id." 
								AND rpinfo.obtained_marks > 39 
								GROUP BY rpinfo.std_id 
								ORDER BY sinfo.std_roll_no ASC");
			}
			// echo '<pre>';print_r($myquery);echo '</pre>';
			// echo $this->db->last_query();
			// die('yoho!');
			if ($myquery->num_rows() > 0) 
			{
				if ($exam_type != 1) {
					return $myquery->result_array();
				}
				$student_records = $myquery->result_array();
				// echo '<pre>';print_r($student_records);echo '</pre>';
				// die('yoho!');
				$response_key = 0;
				foreach ($student_records as $key => $rec) 
				{
					if ($rec['attempt_no'] == "first") 
					{
						$sb_query = $this->db->query("SELECT SUM(rinfo.obtained_marks) AS total_marks,cinfo.class_type,sinfo.*,ainfo.*,
														einfo.*
														FROM student_info AS sinfo 
														LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
														LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
														LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no` 
														INNER JOIN `result_info` AS rinfo ON `rinfo`.`std_id` = `sinfo`.`std_id` 
														INNER JOIN `classes_info` AS cinfo ON `cinfo`.`class_id` = `einfo`.`class_id` 
														WHERE `seinfo`.`exam_id` = ".$exam_id." 
														AND rinfo.`obtained_marks` > 39
														AND `sinfo`.`std_id` = ".$rec['std_id']."
														GROUP BY rinfo.std_id 
														HAVING CASE class_type
														WHEN 'grade3' THEN total_marks > 239
														WHEN 'grade4' THEN total_marks > 400
														ELSE total_marks > 239
														END
														ORDER BY sinfo.std_roll_no ASC
														LIMIT 1");
						
						$std_info = $sb_query->result_array();
						if (count($std_info) > 0) {
							$response[$response_key++] = $std_info[0]; 
						}
					}elseif($rec['attempt_no'] == "second"){
						$temp_total_marks = 0;
						$temp_array = $inst_info = $r_result_info = $r_result_info_sub = array();
						$student_info = $this->get_single_student_info_by_id($rec['std_id']);
						$student_info = $student_info[0];
						$inst_info = $this->get_affiliated_institutes_info('',$student_info['std_institute_reg_no']);
						$inst_info = $inst_info[0];
						
						$r_result_info_query  = $this->db->query("SELECT SUM(rsrinfo.obtained_marks) AS total_marks,rsrinfo.regular_student_id FROM repeat_student_result_info AS rsrinfo WHERE rsrinfo.std_id = ".$rec['std_id']." AND rsrinfo.obtained_marks > 39 GROUP BY rsrinfo.std_id ORDER BY rsrinfo.subject_id ASC");
						$r_result_info = $r_result_info_query->result_array();
						
						if (count($r_result_info) > 0) {
							$r_result_info_sub_query = $this->db->query("SELECT SUM(rinfo.obtained_marks) AS total_marks FROM result_info as rinfo WHERE rinfo.std_id = ".$r_result_info[0]['regular_student_id']." AND rinfo.obtained_marks > 39 GROUP BY rinfo.std_id ORDER BY rinfo.subject_id ASC ");
							$r_result_info_sub = $r_result_info_sub_query->result_array();
						}
						if (count($r_result_info) > 0) {
							$temp_total_marks += $r_result_info[0]['total_marks'];
						}
						if (count($r_result_info_sub) > 0) {
							$temp_total_marks += $r_result_info_sub[0]['total_marks'];
						}
						if ($temp_total_marks > 239) {
							switch ($grade_type) {
								case 'grade3':									
										$temp_array['total_marks'] = $temp_total_marks;
										$temp_array = array_merge($temp_array,$student_info);
										$temp_array = array_merge($temp_array,$inst_info);
										// $temp_array['affli_shortname'] = $inst_info['affli_shortname'];
										$response[] = $temp_array;
									break;
								case 'grade4':
									if ($temp_total_marks > 400 ) {
										$temp_array['total_marks'] = $temp_total_marks;
										$temp_array = array_merge($temp_array,$student_info);
										$temp_array = array_merge($temp_array,$inst_info);
										$response[] = $temp_array;
									}
									break;
								
								default:
									# code...
									break;
							}
						}	// END IF
					}elseif($rec['attempt_no'] == "f_to_f"){
						
						
						$temp_total_marks = 0;
						$temp_array = $inst_info = $r_result_info = $r_result_info_sub = array();
						$student_info = $this->get_single_student_info_by_id($rec['std_id']);
						$student_info = $student_info[0];
						$inst_info = $this->get_affiliated_institutes_info('',$student_info['std_institute_reg_no']);
						$inst_info = $inst_info[0];
						
						$r_result_info_query  = $this->db->query("SELECT SUM(rsrinfo.obtained_marks) AS total_marks,rsrinfo.regular_student_id FROM repeat_student_result_info AS rsrinfo WHERE rsrinfo.std_id = ".$rec['std_id']." AND rsrinfo.obtained_marks > 39 GROUP BY rsrinfo.std_id ORDER BY rsrinfo.subject_id ASC");
						$r_result_info = $r_result_info_query->result_array();
						if (count($r_result_info) > 0) {
							$r_result_info_sub_query = $this->db->query("SELECT SUM(rinfo.obtained_marks) AS total_marks FROM result_info as rinfo WHERE rinfo.std_id = ".$r_result_info[0]['regular_student_id']." AND rinfo.obtained_marks > 39 GROUP BY rinfo.std_id ORDER BY rinfo.subject_id ASC ");
							$r_result_info_sub = $r_result_info_sub_query->result_array();
						}
						
						if (count($r_result_info) > 0) {
							$temp_total_marks += $r_result_info[0]['total_marks'];
						}
						if (count($r_result_info_sub) > 0) {
							$temp_total_marks += $r_result_info_sub[0]['total_marks'];
						}
						if ($temp_total_marks > 239) {
							switch ($grade_type) {
								case 'grade3':									
										$temp_array['total_marks'] = $temp_total_marks;
										$temp_array = array_merge($temp_array,$student_info);
										$temp_array = array_merge($temp_array,$inst_info);
										$response[] = $temp_array;
									break;
								case 'grade4':
									if ($temp_total_marks > 400 ) {
										$temp_array['total_marks'] = $temp_total_marks;
										$temp_array = array_merge($temp_array,$student_info);
										$temp_array = array_merge($temp_array,$inst_info);
										$response[] = $temp_array;
									}
									break;
								
								default:
									# code...
									break;
							}
						}	// END IF
						
					}
				}
				
				return $response;
			}else{
				return NULL;
			}
			
				// return $query->result_array();
			
		}
		
	}// end function get_exam_students_for_degree_print

	public function get_exam_students_record($exam_id ='')
	{
		if (empty($exam_id)) {
			return NULL;
		}
		$exam_type = $this->get_exam_type_by_exam_id($exam_id);
		// die();
		$response = array();
		if ($exam_type == 2) {

			$query = $this->db->query(
						'SELECT sinfo.*, `einfo`.*,ainfo.affli_shortname,
					  	GROUP_CONCAT(rpinfo.subject_id ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_subject_id,
					  	GROUP_CONCAT(rpinfo.obtained_marks ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_obtained_marks,
					  	GROUP_CONCAT(rpinfo.subject_status ORDER BY rpinfo.subject_id ASC SEPARATOR ",") AS r_Sub_status,
					  	(SELECT GROUP_CONCAT(rsinfo.subject_id ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as subject_id,
					  	(SELECT GROUP_CONCAT(rsinfo.obtained_marks ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Obtained_marks,
					  	(SELECT GROUP_CONCAT(rsinfo.subject_status ORDER BY rsinfo.subject_id ASC SEPARATOR ",") FROM result_info AS rsinfo WHERE rsinfo.std_id = rpinfo.regular_student_id) as Sub_status
					  	FROM student_info AS sinfo 
					  	LEFT JOIN `repeat_student_result_info` AS rpinfo ON `rpinfo`.`std_id` = `sinfo`.`std_id`
					  	LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id`
					  	LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
					  	LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
					  	WHERE `einfo`.`exam_info_id` = '.$exam_id.' 
					  	GROUP BY rpinfo.std_id ORDER BY sinfo.std_roll_no ASC'
					);

		}else{

			$query = $this->db->query('SELECT sinfo.*,
								 (SELECT GROUP_CONCAT(rinfo.subject_id SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id,
								 (SELECT GROUP_CONCAT(rinfo.obtained_marks SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks
								 FROM student_info AS sinfo 
								 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
								 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
								 LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
								 WHERE `einfo`.`exam_info_id` = '.$exam_id.' ORDER BY sinfo.std_roll_no ASC');
		
		}
		
		// echo '<pre>';print_r($query->result_array());echo '</pre>';
		// die();
				// echo $this->db->last_query();
			if ($query->num_rows() > 0) {

				$pass_students = 0;
				$break_the_loop = true;
				$exam_info = $this->get_class_and_exam_info_by_exam_id($exam_id);
				// echo $exam_info[0]['class_type'];
				$total_no_of_students = $query->num_rows();
			
				if ($exam_info[0]['class_type'] == 'grade0' || $exam_info[0]['class_type'] == 'grade1') {

					foreach ($query->result_array() as $key => $record) {
						if ($record['Obtained_marks'] > 39) {
							// echo 'Passed students: ';
							 // echo ++$pass_students;echo '<br/>';
							 ++$pass_students;
						}
					}

				}elseif ($exam_info[0]['class_type'] == 'grade3') {

					if ($exam_type == 2) {
						// var_dump($query->result_array());
						foreach ($query->result_array() as $key => $record) {

							$r_marks_array 		= explode(',', $record['r_obtained_marks']);
							$r_subject_id_array = explode(',', $record['r_subject_id']);
							$marks_array 		= explode(',', $record['Obtained_marks']);
							$subject_id_array 	= explode(',', $record['subject_id']);
							$no_of_r_subjects   = count($r_marks_array);
							
							/*echo '<pre>';print_r($r_marks_array);echo '</pre>';
							echo '<pre>';print_r($r_subject_id_array);echo '</pre>';
							echo '<pre>';print_r($marks_array);echo '</pre>';
							echo '<pre>';print_r($subject_id_array);echo '</pre>';*/

							for($fcount = 0; $fcount < $no_of_r_subjects;$fcount++){

								if($r_marks_array[$fcount] > 39){
									$break_the_loop = false;
								}else{
									$break_the_loop = true;
								}

							}// end for loop for $fcount with $no_of_r_subjects.

							if (!$break_the_loop) {
								// echo 'student is pass ';
								// echo ++$pass_students;echo '<br/>';
								++$pass_students;
							}
							// echo '<pre>';print_r($r_marks_array);echo '</pre>';
							
							/*die();	
							$data_to_compare = array();*/
						
						}// end foreach loop for if condition where exam type is non-regular means zimni

					}else{

						foreach ($query->result_array() as $key => $record) {

							$marks_array = explode(',', $record['Obtained_marks']);
							// echo '<pre>';print_r($marks_array);echo '</pre>';
							// $no_of_marks = array_sum(array)
							for ($i= 0; $i < 6 ; $i++) {

								if(array_key_exists($i, $marks_array)){
									
									if ($marks_array[$i] > 39) {
										// echo 'here'.$i.'<br/>';
										$break_the_loop = false;

									}else{
										$break_the_loop = true;
										break;
									}

								}else{
									$break_the_loop = true;
									break;
								}
							}// end for loop

							if (!$break_the_loop) {
								// echo 'student is pass ';
								// echo ++$pass_students;echo '<br/>';
								++$pass_students;
							}

						}// end foreach loop
					
					}
					

				}elseif ($exam_info[0]['class_type'] == 'grade4') {
					/*echo '<pre>';print_r($query->result_array());echo '</pre>';
					die();*/
					if ($exam_type == 2) {
						// var_dump($query->result_array());
						foreach ($query->result_array() as $key => $record) {

							$r_marks_array 		= explode(',', $record['r_obtained_marks']);
							$r_subject_id_array = explode(',', $record['r_subject_id']);
							$marks_array 		= explode(',', $record['Obtained_marks']);
							$subject_id_array 	= explode(',', $record['subject_id']);
							$no_of_r_subjects   = count($r_marks_array);
							
							/*echo '<pre>';print_r($r_marks_array);echo '</pre>';
							echo '<pre>';print_r($r_subject_id_array);echo '</pre>';
							echo '<pre>';print_r($marks_array);echo '</pre>';
							echo '<pre>';print_r($subject_id_array);echo '</pre>';*/

							for($fcount = 0; $fcount < $no_of_r_subjects;$fcount++){

								if($r_marks_array[$fcount] > 39){
									$break_the_loop = false;
								}else{
									$break_the_loop = true;
								}

							}// end for loop for $fcount with $no_of_r_subjects.

							if (!$break_the_loop) {
								// echo 'student is pass ';
								// echo ++$pass_students;echo '<br/>';
								++$pass_students;
							}
							// echo '<pre>';print_r($r_marks_array);echo '</pre>';
							
							/*die();	
							$data_to_compare = array();*/
						
						}// end foreach loop for if condition where exam type is non-regular means zimni

					}else{

						foreach ($query->result_array() as $key => $record) {
							$marks_array = explode(',', $record['Obtained_marks']);
							// echo '<pre>';print_r($marks_array);echo '</pre>';
							for ($i=0; $i < 10; $i++) {

								if(array_key_exists($i, $marks_array)){
									// echo 'key exists '.$i.'<br/>';
									if ($marks_array[$i] > 39) {
										// echo 'here'.$i.'<br/>';
										$break_the_loop = false;

									}else{
										$break_the_loop = true;
										break;
									}
								}else{
									$break_the_loop = true;
									break;
								}

							}// end for loop

							if (!$break_the_loop) {
								// echo 'student is pass ';
								// echo ++$pass_students;echo '<br/>';
								++$pass_students;
							}

						} // end foreach loop for else case where exam type is 1 means regular exam students

					}
					
				
				}
				$pass_student_percentage = ($pass_students / $total_no_of_students) * 100;
				$failed_student_percentage = 100 - $pass_student_percentage;
				// echo '<pre>';print_r($query->result_array());echo '</pre>';
				// die();
				$response = array(
								'total_no_students' => $total_no_of_students,
								'passed_student_percentage'	=> round($pass_student_percentage, 2),
								'failed_student_percentage'	=>	round($failed_student_percentage,2),
								'exam_name'			=> $exam_info[0]['exam_name']
							);
				return $response;
				// return $query->result_array();
			
			}else{
				return NULL;
			}

	}// end function get_exam_students_record

	public function get_exam_students_positions($exam_id ='')
	{
		if (empty($exam_id)) {
			return NULL;
		}
		$response = array();
		$query = $this->db->query('SELECT sinfo.*,ainfo.affli_shortname,
								 (SELECT GROUP_CONCAT(rinfo.subject_id SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as subject_id,
								 (SELECT GROUP_CONCAT(rinfo.obtained_marks SEPARATOR ",") FROM result_info AS rinfo WHERE rinfo.std_id = sinfo.std_id) as Obtained_marks
								 FROM student_info AS sinfo 
								 LEFT JOIN `student_exam_info` AS seinfo ON `seinfo`.`std_id` = `sinfo`.`std_id` 
								 LEFT JOIN `exam_info` AS einfo ON `einfo`.`exam_info_id` = `seinfo`.`exam_id` 
								 LEFT JOIN `affiliation_info` AS ainfo ON `ainfo`.`inst_reg_no` = `sinfo`.`std_institute_reg_no`
								 WHERE `einfo`.`exam_info_id` = '.$exam_id.' ORDER BY sinfo.std_roll_no ASC');
		// echo '<pre>';print_r($query->result_array());echo '</pre>';
		// die();
				// echo $this->db->last_query();
			if ($query->num_rows() > 0) {
				$filtered_array_index = 0;
				$total_marks = 0;
				$temp_first_position = 0;
				$first_postion_index = 0;
				$temp_second_position = 0;
				$second_postion_indexes = 0;
				$temp_third_position = 0;
				$third_postion_indexes = 0;
				$gained_marks = 0;
				$break_the_loop = true;
				$final_array = array();
				$exam_info = $this->get_class_and_exam_info_by_exam_id($exam_id);
				// echo $exam_info[0]['class_type'];
				// $total_no_of_students = $query->num_rows();
			
				if ($exam_info[0]['class_type'] == 'grade0' || $exam_info[0]['class_type'] == 'grade1') {

					foreach ($query->result_array() as $key => $record) {
						if ($record['Obtained_marks'] > 39) { //40 80 70 65 72 50
							// echo $record['Obtained_marks'].'<br/>';
							// if($temp_first_position < $record['Obtained_marks']){

							// 	$temp_first_position = $record['Obtained_marks'];

							// }elseif($temp_second_position < $record['Obtained_marks']){

							// 	$temp_second_position = $record['Obtained_marks'];

							// }elseif($temp_third_position < $record['Obtained_marks']){

							// 	$temp_third_position = $record['Obtained_marks'];
							// }

							// if($temp_first_position > $temp_second_position ){

							// 	if ($temp_first_position > $temp_third_position) {

							// 		$temp_first_position = $record['Obtained_marks']; 
							// 		$first_position_metadata =  array('name' => $record['std_name'] ,
							// 										  'image' => $record['std_image'] ,
							// 										  'roll_no' => $record['std_roll_no'],
							// 										  'reg_no' => $record['std_reg_no'],
							// 										  'institute_name' => $record['affli_shortname'],
							// 										  'marks'	=> $record['Obtained_marks'] );

							// 	}else{

							// 		$temp_first_position = $record['Obtained_marks']; 
							// 		$first_position_metadata =  array('name' => $record['std_name'] ,
							// 										  'image' => $record['std_image'] ,
							// 										  'roll_no' => $record['std_roll_no'],
							// 										  'reg_no' => $record['std_reg_no'],
							// 										  'institute_name' => $record['affli_shortname'],
							// 										  'marks'	=> $record['Obtained_marks'] );
									 

							// 	}
								
							// }

							if($temp_first_position < $record['Obtained_marks'] ){
								// echo $record['Obtained_marks'].'<br/>';
								// echo 'in largest <br/>';
								$temp_first_position = $record['Obtained_marks'].'<br/>';
								if ($first_position_metadata[$first_postion_indexes]['marks']) {
									# code...
								}
								$first_position_metadata[$first_postion_indexes] =  array('name' => $record['std_name'] ,
																  'image' => $record['std_image'] ,
																  'roll_no' => $record['std_roll_no'],
																  'reg_no' => $record['std_reg_no'],
																  'institute_name' => $record['affli_shortname'],
																  'marks'	=> $record['Obtained_marks'] );
								// echo '<pre>';print_r($first_position_metadata);echo '</pre>';
							}elseif($temp_second_position < $record['Obtained_marks']){
								// echo $record['Obtained_marks'].'<br/>';
								// echo 'in 2nd largest <br/>';
								$temp_second_position = $record['Obtained_marks'].'<br/>'; 
								$second_position_metadata[] =  array('name' => $record['std_name'] ,
																  'image' => $record['std_image'] ,
																  'roll_no' => $record['std_roll_no'],
																  'reg_no' => $record['std_reg_no'],
																  'institute_name' => $record['affli_shortname'],
																  'marks'	=> $record['Obtained_marks'] );
								// echo '<pre>';print_r($second_position_metadata);echo '</pre>';
							}elseif($temp_third_position < $record['Obtained_marks']){
								// echo $record['Obtained_marks'].'<br/>';
								// echo 'in 3rd largest <br/>';
								$temp_third_position = $record['Obtained_marks'].'<br/>';
								$third_position_metadata[] =  array('name' => $record['std_name'] ,
																  'image' => $record['std_image'] ,
																  'roll_no' => $record['std_roll_no'],
																  'reg_no' => $record['std_reg_no'],
																  'institute_name' => $record['affli_shortname'],
																  'marks'	=> $record['Obtained_marks'] ); 
								// echo '<pre>';print_r($third_position_metadata);echo '</pre>';
							}
						}
					}

				}elseif ($exam_info[0]['class_type'] == 'grade3') {

					foreach ($query->result_array() as $key => $record) {

						$marks_array = explode(',', $record['Obtained_marks']);
						if(array_key_exists(5, $marks_array)){
							$total_student_score = array_sum($marks_array);
							$filtered_array[$filtered_array_index]['stud_name'] =  $record['std_name'];
							$filtered_array[$filtered_array_index]['stud_image'] =  $record['std_image'];
							$filtered_array[$filtered_array_index]['stud_rollno'] =  $record['std_roll_no'];
							$filtered_array[$filtered_array_index]['stud_regno'] =  $record['std_reg_no'];
							$filtered_array[$filtered_array_index]['affli_shortname'] =  $record['affli_shortname'];
							$filtered_array[$filtered_array_index]['total_marks'] =  $total_student_score;
							$filtered_array_index++;
						}
						// echo '<pre>';print_r($marks_array);echo '</pre>';
						// $no_of_marks = array_sum(array)

					}// end foreach loop

			        $filtered_array = $this->array_sort_by_column($filtered_array, 'total_marks');
			        // foreach ($final_array as $key => $frec) {
			        // 	if ($temp_first_position < $frec['total_marks']) {
			        // 		$temp_first_position = $frec['total_marks'];
			        // 		$first_position_metadata[$first_postion_index] =  array('name' => $frec['std_name'] ,
											// 									  'image' => $frec['std_image'] ,
											// 									  'roll_no' => $frec['std_roll_no'],
											// 									  'reg_no' => $frec['std_reg_no'],
											// 									  'institute_name' => $frec['affli_shortname'],
											// 									  'marks'	=> $frec['Obtained_marks'] );
			        // 		$first_postion_index++;

			        // 	}elseif($temp_second_position < $frec['total_marks']) {

			        // 		$temp_second_position = $frec['total_marks'];

			        // 	}elseif($temp_second_position < $frec['total_marks']) {
			        		
			        // 		$temp_second_position = $frec['total_marks'];
			        // 	}
			        // 	$temp_first_position = 
			        // }
			        // echo '<pre>';print_r($final_array);echo '</pre>';
			        // die();
			        for($i = 0; $i < 5; $i ++){
			        	if(array_key_exists($i, $filtered_array)){
			        		array_push($final_array, $filtered_array[$i]);
			        	}else{
			        		array_push($final_array, $i);
			        	}
			        }
			        
				}elseif ($exam_info[0]['class_type'] == 'grade4') {

					foreach ($query->result_array() as $key => $record) {

						$marks_array = explode(',', $record['Obtained_marks']);
						if(array_key_exists(9, $marks_array)){
							$total_student_score = array_sum($marks_array);
							$filtered_array[$filtered_array_index]['stud_name'] =  $record['std_name'];
							$filtered_array[$filtered_array_index]['stud_image'] =  $record['std_image'];
							$filtered_array[$filtered_array_index]['stud_rollno'] =  $record['std_roll_no'];
							$filtered_array[$filtered_array_index]['stud_regno'] =  $record['std_reg_no'];
							$filtered_array[$filtered_array_index]['affli_shortname'] =  $record['affli_shortname'];
							$filtered_array[$filtered_array_index]['total_marks'] =  $total_student_score;
							$filtered_array_index++;
						}
						// echo '<pre>';print_r($marks_array);echo '</pre>';
						// $no_of_marks = array_sum(array)

					}// end foreach loop

			        $filtered_array = $this->array_sort_by_column($filtered_array, 'total_marks');
			        for($i = 0; $i < 3; $i ++){
			        	if(array_key_exists($i, $filtered_array)){
			        		array_push($final_array, $filtered_array[$i]);
			        	}else{
			        		array_push($final_array, $i);
			        	}
			        }
				
				}

				return $final_array;
				// return $query->result_array();
			}else{
				return NULL;
			}

	}// end function get_exam_students_positions


	private function array_sort_by_column(&$arr, $col, $dir = SORT_DESC)
	{
            $sort_col = array();
            foreach ($arr as $key => $row) {
                $sort_col[$key] = $row[$col];
            }

            array_multisort($sort_col, $dir, $arr);
            return $arr;
   	
   	}// end function array_sort_by_column

   	public function checkIfStudentRegistrationNoExists($std_registration_no = '')
   	{
   		if (empty($std_registration_no)) {
   			return false;
   		}
   		$query = $this->db->select('sinfo.*',false)
   						  ->from('student_info AS sinfo')
   						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
   						  ->where('sinfo.std_reg_no',$std_registration_no)
   						  ->get();
   		if ($query->num_rows() > 0) {
   			return true;
   		}else{
   			return false;
   		}

   	}// end function checkIfStudentRegistrationNoExists

   	public function checkIfstudentRecordExistsInExam($exam_id ='',$std_reg_no = '',$coming_from='')
   	{
   		if (empty($exam_id) || empty($std_reg_no) || empty($coming_from)) {
   			return NULL;
   		}

   		if ($coming_from == "third_attempt") {

   			// $std_info = $this->get_last_student_info_by_reg_no($std_reg_no);
   			$std_info = $this->get_single_student_info_by_reg_no($std_reg_no);
   			/*echo '<pre>';print_r($std_info);echo '</pre>';
   			die('yoho!');*/
   			$std_id   = $std_info[0]['std_id'];
   			$query = $this->db->select('sinfo.*',false)
   						  ->from('student_info AS sinfo')
   						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
   						  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
   						  ->join('repeat_student_result_info AS rpinfo','rpinfo.std_id = sinfo.std_id','left')
   						  ->where('einfo.exam_info_id',$exam_id)
   						  ->where('sinfo.std_id',$std_id)
   						  ->where('sinfo.std_reg_no',$std_reg_no)
   						  // ->order_by('sinfo.std_id','DESC')
   						  // ->limit(1)
   						  ->get();
   		}else{

   			$query = $this->db->select('sinfo.*',false)
   						  ->from('student_info AS sinfo')
   						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
   						  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
   						  ->join('result_info AS rinfo','rinfo.std_id = sinfo.std_id','left')
   						  ->where('einfo.exam_info_id',$exam_id)
   						  ->where('sinfo.std_reg_no',$std_reg_no)
   						  ->get();
   		}
   						/*echo $this->db->last_query();
   						die('yoho!');*/
   		if ($query->num_rows() > 0) {   			
   			return $query->result_array();
   		}else{
   			return NULL;
   		}
   	
   	}// end function checkIfstudentRecordExistsInExam

   	public function checkIfstudentRecordExistsInExam_old($exam_id ='',$std_reg_no = '')
   	{
   		if (empty($exam_id) || empty($std_reg_no)) {
   			return NULL;
   		}

   		$query = $this->db->select('sinfo.*',false)
   						  ->from('student_info AS sinfo')
   						  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
   						  ->join('exam_info AS einfo','einfo.exam_info_id = seinfo.exam_id','left')
   						  ->join('result_info AS rinfo','rinfo.std_id = sinfo.std_id','left')
   						  ->where('einfo.exam_info_id',$exam_id)
   						  ->where('sinfo.std_reg_no',$std_reg_no)
   						  ->get();
   						  // echo $this->db->last_query();
   						  // die();
   		if ($query->num_rows() > 0) {
   			return $query->result_array();
   		}else{
   			return NULL;
   		}
   	
   	}// end function checkIfstudentRecordExistsInExam :: 13_04_2016

   	public function checkIfstudentIsAllowedToRepeat($std_reg_no = '')
   	{
   		
   		$student_coming_from =  $this->input->post('student_from_category');

   		if ($student_coming_from == "third_attempt") {
   				
   			$std_sinfo  = $this->get_single_student_info_by_reg_no($std_reg_no,$student_coming_from);
   			/*echo '<pre>';print_r($_POST);echo '</pre>';
   			echo '<pre>';print_r($std_sinfo);echo '</pre>';
   			die();*/
   			$std_id  = $std_sinfo[0]['std_id'];
   			$query =  $this->db->select('rpinfo.*,sbinfo.*',false)
   						   ->from('repeat_student_result_info AS rpinfo')
   						   ->join('student_info AS sinfo','sinfo.std_id = rpinfo.std_id','inner')
   						   ->join('subject_info AS sbinfo','sbinfo.sub_id = rpinfo.subject_id','inner')
   						   // ->join('classes_info AS cinfo','cinfo.class_id = sbinfo.class_id','left')
   						   ->where('sinfo.std_id',$std_id)
   						   ->where('sinfo.std_reg_no',$std_reg_no)
   						   ->get();

   		}elseif ($student_coming_from == "f_to_f") {

   			$query =  $this->db->select('rinfo.*,sbinfo.*',false)
   						   ->from('result_info AS rinfo')
   						   ->join('student_info AS sinfo','sinfo.std_id = rinfo.std_id','left')
   						   ->join('subject_info AS sbinfo','sbinfo.sub_id = rinfo.subject_id','left')
   						   ->where('sinfo.std_reg_no',$std_reg_no)
   						   ->get();

   		}else{

   			$query =  $this->db->select('rinfo.*,sbinfo.*',false)
   						   ->from('result_info AS rinfo')
   						   ->join('student_info AS sinfo','sinfo.std_id = rinfo.std_id','left')
   						   ->join('subject_info AS sbinfo','sbinfo.sub_id = rinfo.subject_id','left')
   						   ->where('sinfo.std_reg_no',$std_reg_no)
   						   ->get();

   		}

   			/*echo $this->db->last_query();
   			die();*/
   		if ($query->num_rows() > 0) {
   			// echo '<pre>';print_r($query->result_array());echo '</pre>';
   			// die();

   			$data = $pass_sub = $reappear_sub = array();
   			$number_of_subjects = $query->num_rows();
   			$subject_records = $query->result_array();
   			$repeat = false;
   			
   			// die();
   			
   			if ($student_coming_from == 'fail') {
   				
   				foreach ($subject_records as $key => $sub) {
   				
	   				if ($sub['obtained_marks'] < 40) {

	   					$reappear_sub[$sub['subject_id']]['subject_name'] = $sub['sub_name_urdu'];
	   					$reappear_sub[$sub['subject_id']]['obtained_marks'] = $sub['obtained_marks'];
	   					$repeat = true;

	   				}elseif ($sub['obtained_marks'] >= 40) {
	   					
	   					$pass_sub[$sub['subject_id']]['subject_name'] = $sub['sub_name_urdu'];
	   					$pass_sub[$sub['subject_id']]['obtained_marks'] = $sub['obtained_marks'];

	   				}

	   			}// end foreach for subject records

   			}elseif ($student_coming_from == 'annual') {
   				// echo '<pre>';print_r($subject_records);echo '</pre>';
   				// die();
   				foreach ($subject_records as $key => $sub) {
   						
   						if ($sub['obtained_marks'] > 39) {
   						
   							$reappear_sub[$sub['subject_id']]['subject_name'] = $sub['sub_name_urdu'];
	   						$reappear_sub[$sub['subject_id']]['obtained_marks'] = $sub['obtained_marks'];
   							$repeat = true;

   						}else {
   							return NULL;
   						}

	   			}// end foreach for subject records
   			}elseif($student_coming_from == 'third_attempt'){
   				
   				foreach ($subject_records as $key => $sub) {
   				
	   				if ($sub['obtained_marks'] < 40) {

	   					$reappear_sub[$sub['subject_id']]['subject_name'] = $sub['sub_name_urdu'];
	   					$reappear_sub[$sub['subject_id']]['obtained_marks'] = $sub['obtained_marks'];
	   					$repeat = true;

	   				}elseif ($sub['obtained_marks'] >= 40) {
	   					
	   					$pass_sub[$sub['subject_id']]['subject_name'] = $sub['sub_name_urdu'];
	   					$pass_sub[$sub['subject_id']]['obtained_marks'] = $sub['obtained_marks'];

	   				}

	   			}// end foreach for subject records

   			}elseif($student_coming_from == 'f_to_f'){
   				
   				foreach ($subject_records as $key => $sub) {
   				
	   				if ($sub['obtained_marks'] < 40) {

	   					$reappear_sub[$sub['subject_id']]['subject_name'] = $sub['sub_name_urdu'];
	   					$reappear_sub[$sub['subject_id']]['obtained_marks'] = $sub['obtained_marks'];
	   					$repeat = true;

	   				}elseif ($sub['obtained_marks'] >= 40) {
	   					
	   					$pass_sub[$sub['subject_id']]['subject_name'] = $sub['sub_name_urdu'];
	   					$pass_sub[$sub['subject_id']]['obtained_marks'] = $sub['obtained_marks'];

	   				}

	   			}// end foreach for subject records
   			}
   			/*echo '<pre>';print_r($reappear_sub);echo '</pre>';
   			die('yoho!');*/
   			if ($number_of_subjects == 1 and $student_coming_from != "third_attempt" and $student_coming_from != "f_to_f") { // for hifz-ul-Quran

   				return $subject_records;

   			}else{

   				// echo '<pre>';print_r($reappear_sub);echo '</pre>';
   				$student_record = $this->get_single_student_info_by_reg_no($std_reg_no,$student_coming_from);
   				/*echo '<pre>';print_r($student_record);echo '</pre>';	
   				die();*/
   				$data = array('pass_sub' => $pass_sub,'reappear_sub' => $reappear_sub,'student_info' => $student_record);

   				/*echo '<pre>';print_r($data);echo '</pre>';
   				die('yoho!');*/
   				if (!$repeat) {
   					return NULL;
   				}
   				return $data;

   				// echo $query->num_rows();
   				// echo '<pre>';print_r($query->result_array());echo '</pre>';	

   			}   

   		}else{

   			return false;

   		}

   	}// end function checkIfstudentIsAllowedToRepeat

   	public function checkIfstudentIsAllowedToRepeat_old($std_reg_no = '')
   	{
   		// echo '<pre>';print_r($_POST);echo '</pre>';
   		// die();
   		$query =  $this->db->select('rinfo.*,sbinfo.*',false)
   						   ->from('result_info AS rinfo')
   						   ->join('student_info AS sinfo','sinfo.std_id = rinfo.std_id','left')
   						   ->join('subject_info AS sbinfo','sbinfo.sub_id = rinfo.subject_id','left')
   						   ->where('sinfo.std_reg_no',$std_reg_no)
   						   ->get();
   			// echo $this->db->last_query();
   		if ($query->num_rows() > 0) {
   			// echo '<pre>';print_r($query->result_array());echo '</pre>';
   			// die();

   			$data = $pass_sub = $reappear_sub = array();
   			$number_of_subjects = $query->num_rows();
   			$subject_records = $query->result_array();
   			$repeat = false;
   			$student_coming_from =  $this->input->post('student_from_category');
   			// die();
   			
   			if ($student_coming_from == 'fail') {
   				
   				foreach ($subject_records as $key => $sub) {
   				
	   				if ($sub['obtained_marks'] < 40) {

	   					$reappear_sub[$sub['subject_id']]['subject_name'] = $sub['sub_name_urdu'];
	   					$reappear_sub[$sub['subject_id']]['obtained_marks'] = $sub['obtained_marks'];
	   					$repeat = true;

	   				}elseif ($sub['obtained_marks'] >= 40) {
	   					
	   					$pass_sub[$sub['subject_id']]['subject_name'] = $sub['sub_name_urdu'];
	   					$pass_sub[$sub['subject_id']]['obtained_marks'] = $sub['obtained_marks'];

	   				}

	   			}// end foreach for subject records

   			}elseif ($student_coming_from == 'annual') {
   				// echo '<pre>';print_r($subject_records);echo '</pre>';
   				// die();
   				foreach ($subject_records as $key => $sub) {
   						
   						if ($sub['obtained_marks'] > 39) {
   						
   							$reappear_sub[$sub['subject_id']]['subject_name'] = $sub['sub_name_urdu'];
	   						$reappear_sub[$sub['subject_id']]['obtained_marks'] = $sub['obtained_marks'];
   							$repeat = true;

   						}else {
   							return NULL;
   						}

	   			}// end foreach for subject records
   			}
   			// echo '<pre>';print_r($reappear_sub);echo '</pre>';
   			// 	die();
   			if ($number_of_subjects == 1) { // for hifz-ul-Quran

   				return $subject_records;

   			}else{
   				
   				$student_record = $this->get_single_student_info_by_reg_no($std_reg_no);
   				// echo '<pre>';print_r($student_record);echo '</pre>';	
   				// die();
   				$data = array('pass_sub' => $pass_sub,'reappear_sub' => $reappear_sub,'student_info' => $student_record);
   				if (!$repeat) {
   					return NULL;
   				}
   				return $data;

   				// echo $query->num_rows();
   				// echo '<pre>';print_r($query->result_array());echo '</pre>';	

   			}   

   		}else{

   			return false;

   		}

   	}// end function checkIfstudentIsAllowedToRepeat :: 13-04-2016

   	public function update_student_basic_info()
   	{
		
   		$data = array(
               'std_institute_reg_no' => $this->input->post('old_institute_reg_no')
            );

		$this->db->where('std_id', $this->input->post('std_id'));
		$this->db->update('student_info', $data);

		$data1 = array(
			   'std_id' => $this->input->post('std_id'),
			   'exam_id' => $this->input->post('exam_id'),
			   'class_id' => $this->input->post('class_id'),
			   'exam_center_id' => $this->input->post('exam_center')
			);

		$this->db->insert('student_exam_info', $data1);

		$data2 = array();
   		foreach ($_POST['reappear_sub'] as $key => $pSub) {
			
			$data2[]	 =  array('subject_id' => $pSub,
							  'std_id' 	   => $this->input->post('std_id'),
							  'exam_id'    => $this->input->post('exam_id'),
							  'obtained_marks' => 0,
							  'subject_status' => 'pass' );		

		}// end loop for re-appear subject

		// echo '<pre>'.print_r($data2).'</pre>';
		// die();	

		$this->db->insert_batch('repeat_student_result_info', $data2);

		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;

   	}// end function update_student_basic_info

   	public function add_new_supplementary_student($student_record = '')
   	{
		$data = array(
			'std_name' 				=> $student_record['student_info'][0]['std_name'],
			'std_father_name' 		=> $student_record['student_info'][0]['std_father_name'],
			'std_id_card_no' 		=> $student_record['student_info'][0]['std_id_card_no'],
			'std_dob_eng' 			=> $student_record['student_info'][0]['std_dob_eng'],
			'std_dob_urdu' 			=> $student_record['student_info'][0]['std_dob_urdu'],
			'std_institute_reg_no' 	=> $this->input->post('old_institute_reg_no'),
			'std_address' 			=> $student_record['student_info'][0]['std_address'],
			'std_image' 			=> $student_record['student_info'][0]['std_image'],
			'std_reg_no' 			=> $student_record['student_info'][0]['std_reg_no'],
			'std_roll_no' 			=> $this->input->post('roll_no'),
			'created_on'	 		=> date('Y-m-d H:i:s')
		);
		if ($student_record['posted_data']['student_from_category'] == "third_attempt") {
			$data['attempt_no'] = 'third';
		}elseif($student_record['posted_data']['student_from_category'] == "f_to_f"){
			$data['attempt_no'] = 'f_to_f';
		}

		$this->db->insert('student_info', $data);
		
		if($this->db->affected_rows() > 0)
		{
			$lc_std_id = $this->db->insert_id();// this is the id inserted into the studnet table

			if ($lc_std_id != "") {
					 	
				 	$data = array(
						'std_id' 			=> $lc_std_id,
						'exam_id' 			=> $this->input->post('exam_id'),
						'class_id' 			=> $student_record['student_info'][0]['class_id'],
						'exam_center_id' 	=> $this->input->post('exam_center'),
					);

				$this->db->insert('student_exam_info', $data);

				if($this->db->affected_rows() > 0){

					$data2 = array();
			   		foreach ($_POST['reappear_sub'] as $key => $pSub) {
						
						$data2[]	 =  array('subject_id' => $pSub,
										  'std_id' 	   => $lc_std_id,
										  'exam_id'    => $this->input->post('exam_id'),
										  'obtained_marks' => 0,
										  'subject_status' => 'pass',
										  'regular_student_id' => $this->input->post('std_id') );		

					}// end loop for re-appear subject

					// echo '<pre>'.print_r($data2).'</pre>';
					// die();	

					$this->db->insert_batch('repeat_student_result_info', $data2);

					if ($this->db->affected_rows() > 0) {
						return true;
					}else{
						return false;
					}

					// return $this->db->insert_id(); // returning new created to the controller
				
				}// end if for affected rows

			 } // end if for $lc_std_id
		
		}else{

			return false;

		}

   	}// end function add_new_supplementary_student

   	public function checkIfExamDateSheetAlreadyCreated($exam_id = '')
   	{
   		if (empty($exam_id)) {
   			return true;
   		}

   		$query = $this->db->select('ds.*',false)
   						  ->from('datesheet_info AS ds')
   						  ->where('ds.exam_id',$exam_id)
   						  ->get();
   		if ($query->num_rows() > 0) {
   			return true;
   		}
   		return false;

   	}// end function checkIfExamDateSheetAlreadyCreated

   	public function add_exam_date_sheet($exam_id)
   	{
   		$response = false;
		$add = false;
		// echo '<pre>';print_r($_POST);echo '</pre>';
		// die();
			foreach ($_POST['subject_id'] as $key => $subject) {

				$insertData[] = array(
								'exam_id'	 => $exam_id,
								'exam_date'	 => $_POST['subject_exam_date'][$key],
								'exam_time' => $_POST['subject_exam_time'][$key],
								'exam_subject_id' => $subject,
								'exam_appearance_time' => $_POST['exam_appearence_time_'.$subject][0]
								);

				
				
			}// end foreach for subject_id
			// echo '<pre>';print_r($insertData);echo '</pre>';
			// die();
			$this->db->insert_batch('datesheet_info', $insertData);


			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}

   	}// end function add_exam_date_sheet

   	public function get_single_exam_date_sheet_by_id($exam_id ='')
   	{
   		$query =  $this->db->select('ds.*,sbinfo.sub_name_urdu',false)
   							  ->from('datesheet_info AS ds',false)
   							  ->join('subject_info AS sbinfo','sbinfo.sub_id = ds.exam_subject_id','inner')
   							  ->where('ds.exam_id',$exam_id)
   							  ->get();
   				// echo $this->db->last_query();
   		if ($query->num_rows() > 0) {
   			return $query->result_array();
   		}else{
   			return NULL;
   		}

   	}// end function get_single_exam_date_sheet_by_id

   	public function get_single_exam_date_sheet_by_id_with_sub_name($exam_id ='')
   	{
   		$query =  $this->db->select('ds.*,sbinfo.sub_name_urdu',false)
   							  ->from('datesheet_info AS ds',false)
   							  ->join('subject_info AS sbinfo','sbinfo.sub_id = ds.exam_subject_id','inner')
   							  ->where('ds.exam_id',$exam_id)
   							  ->get();
   				// echo $this->db->last_query();
   		if ($query->num_rows() > 0) {
   			return $query->result_array();
   		}else{
   			return NULL;
   		}

   	}// end function get_single_exam_date_sheet_by_id_with_sub_name

   	public function get_single_exam_date_sheet_for_edit_by_id($exam_id ='')
   	{
   		$query =  $this->db->select('ds.*,sbinfo.sub_name_urdu',false)
   							  ->from('datesheet_info AS ds')
   							  ->join('subject_info AS sbinfo','sbinfo.sub_id = ds.exam_subject_id','left')
   							  ->where('ds.exam_id',$exam_id)
   							  ->order_by('sbinfo.sub_id','ASC')
   							  ->get();
   				// echo $this->db->last_query();
   		if ($query->num_rows() > 0) {
   			return $query->result_array();
   		}else{
   			return NULL;
   		}

   	}// end function get_single_exam_date_sheet_for_edit_by_id

   	public function update_exam_date_sheet($exam_id ='')
   	{
   		$response = false;
   		foreach ($_POST['subject_id'] as $key => $sub) {
   			$data = array(
					'exam_date' 		   => $_POST['subject_exam_date'][$key],
					'exam_time' 		   => $_POST['subject_exam_time'][$key],
					'exam_appearance_time' => $_POST['exam_appearence_time_'.$sub][0]
				);
			// print_r($data);die();
			$this->db->where('exam_subject_id', $sub);
			$this->db->where('exam_id', $exam_id);
			$this->db->where('ds_id', $_POST['ds_row_id'][$key]);
			$this->db->update('datesheet_info', $data);
			if ($this->db->affected_rows() >= 0) {
				$response = true;
			}else{
				$response = false;	
			}
		}// end foreach

		return $response;

   	}// end function update_exam_date_sheet

   	public function searcharray($value, $key, $array)
   	{
   		/*echo 'subject_id: '.$value.'<br/>';
   		echo $key.'<br/>';
   		echo '<pre>';print_r($array);echo '</pre>';*/
   		// die();

		   foreach ($array as $k => $val) {
		       if ($val[$key] == $value) {
		       	// echo $k;die();
		       		// echo "i am here and value is: ".$value;die();
		           return $k;
		       }
		   }
		   return "null";
	
	}// end function searcharray

	public function returnAppendingRollNoSlipDataForTenCourse($exam_appearance_time = '',$exam_time = '',$exam_date = '',$subject_name='')
	{
		$str = "";
		/*$str = $str . '<td class="border centerAlign" dir="rtl">';
		if ($exam_appearance_time == 'first_time') {
			$str = $str . $exam_time . 'بجے صبح';
		}else{
			$str = $str . $exam_time . 'بجے دوپہر';
		}*/
		$str = $str . '</td">';
	    $str = $str . '<td class="border centerAlign">';
	    $str = $str . $exam_date;
	    $str = $str . '</td>';
	    $str = $str . '<td class="border centerAlign">';
	    $str = $str . $subject_name;
	    $str = $str . '</td>';
	    return $str;
	
	}// end function returnAppendingRollNoSlipDataForTenCourse


	public function returnStudentsForRegistrationUpdate()
	{
		
		$query =  $this->db->select('sinfo.*',false)
   							  ->from('student_info AS sinfo',false)
   							  ->join('student_exam_info AS seinfo','seinfo.std_id = sinfo.std_id','left')
   							  ->where('seinfo.exam_id',18)
   							  ->get();
   				// echo $this->db->last_query();
   		if ($query->num_rows() > 0) {
   			return $query->result_array();
   		}else{
   			return NULL;
   		}

	} // end function returnStudentsForRegistrationUpdate

	public function updateUserResgistrationNo($std_id = '',$new_registration_no = '',$old_registration_no = '',$roll_no)
	{
		/*if (empty($std_id) or empty($old_registration_no) or empty($new_registration_no) or empty($roll_no)) {
			return false;
		}
		$new_registration_no = ++$new_registration_no;
		$data = array(
					'std_reg_no' 					=> $new_registration_no
				);
		$this->db->where('std_id', $std_id);
		$this->db->where('std_reg_no', $old_registration_no);
		$this->db->where('std_roll_no', $roll_no);
		$this->db->update('student_info', $data);
		if($this->db->affected_rows() >= 0){
			return true;
		}else{
			return false;
		}*/
	} // end function updateUserResgistrationNo

}