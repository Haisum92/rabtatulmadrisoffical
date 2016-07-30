<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public $alreadydatefailure = false;
	public $nodatefailure = false;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		// $this->get_all_notifications();

	}// end function constructor

	public function index()
	{
		if( $this->session->userdata('is_logged') ){
			redirect('admin/dashboard', 'refresh');
		}
		else{
			redirect('admin/login', 'refresh');
		}

		// $this->load->view('welcome_message');
	
	}// end index function 

	public function login_check()
	{

		if( !$this->session->userdata('is_logged') ){

			$this->session->set_flashdata('redirectError', 'You must login to access Admin Panel!');
			
			redirect('admin/login', 'refresh');

		}// end if for session is_logged check

		if( !($this->session->userdata('user_type') && $this->session->userdata('user_type') == 'admin') ){

			$this->session->set_flashdata('redirectError', 'Admin access only.');

			redirect('admin/login', 'refresh');

		}// end if for session user_type check.

	}// end function login_check

	public function login()
	{
		if($this->preCheckLogin()){
			
			$data['admin'] = $this->admin_model->login();
			
			if( $data['admin'] != NULL ){

				$user_data = array(
							'is_logged'		=> 1,
							'user_type' 	=> 'admin',
							'admin_data'	=> $data['admin']
							);
				$this->session->set_userdata( $user_data );
				$data['data'] = $this->session->all_userdata('errors');
				redirect('admin/dashboard', 'refresh');
				
			}else{
				// $this->session->set_flashdata('failure', 'Invalid email or Password.');
				$this->session->set_flashdata('failure', 'غلط نام یا غلط خفیہ کوڈ۔.');
				$this->load->view('admin/login', $data);
			}
			
		}else{
			$this->load->view('admin/login');	
		}

	}// end function login

	private function preCheckLogin()
	{
		
		$this->form_validation->set_rules('email','Email','required|valid_email|xss_clean|trim');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}
	
	}// end function preCheckLogin

	public function dashboard()
	{

		$this->login_check();

		// $data['title'] = 'ABC';

		// $data['page_heading'] = 'Dashboard'; 

		$data['data'] = $this->session->all_userdata();

		$this->load->view('admin/dashboard', $data);

	}// end function dashboard

	public function createExam()
	{
		$this->login_check();

		$data['title'] = "Create Exam";
		$data['class_array'] = $this->admin_model->get_all_classes();
		$data['exam_type_array'] = $this->admin_model->get_all_exam_types();

		if($this->preCheckCreateExam()){

			if( ($last_created_exam_id =  $this->admin_model->createExam()) != NULL ){

				$this->session->set_flashdata('success', "Exam created successfully");
				redirect('admin/viewAllExams','refresh');

			}else{

				$this->session->set_flashdata('failure', 'Unable to create exam.');
				redirect('admin/createExam','refresh');

			}// end if for add_company_service_types
					
		}else{

			$this->load->view('admin/create-exam',$data);
			
		}// end if for preCheck company Registration

	}// end funciton createExam

	private function preCheckCreateExam()
	{
		// echo '<pre>';print_r($_POST);echo '</pre>';die();
		$this->form_validation->set_error_delimiters('<div class="errors">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');

		//setting rules
		$this->form_validation->set_rules('class_id', 'Class', 'required');
		$this->form_validation->set_rules('exam_name', 'Examination Name', 'required');
		$this->form_validation->set_rules('exam_year_dominic', 'Examination year dominic', 'required');
		$this->form_validation->set_rules('exam_result_date_dominic', 'Examination result date dominic', 'required');
		$this->form_validation->set_rules('exam_result_date_hijri', 'Examination result date hijri', 'required');
		$this->form_validation->set_rules('exam_degree_date_dominic', 'Examination degree date dominic', 'required');
		$this->form_validation->set_rules('exam_degree_date_hijri', 'Examination degree date hijri', 'required');
		$this->form_validation->set_rules('exam_center', 'Examination center', 'required');
		$this->form_validation->set_rules('exam_type', 'Examination type', 'required');
		
		// if rules fulfilled
		
		if ($this->form_validation->run() === FALSE){
			
			return false;
			
		}else{
			
			return true;	
			
		}
	
	}// end function preCheckCreateExam

	public function viewAllExams()
	{	
		$this->login_check();

		$data['title'] = "View All Exams";
		$data['class_array'] = $this->admin_model->get_all_classes();
		$data['exam_array'] = $this->admin_model->get_all_exams_for_view();
		$this->load->view('admin/view-all-exams',$data);
		
	}// end function viewAllExams

	public function viewExam($exam_id ='')
	{
		$this->login_check();

		if (empty($exam_id)) {
			redirect('admin/viewAllExams');
		}
		$data['title'] = "Exam Information";
		$data['exam_info'] = $this->admin_model->get_single_exam_info_id($exam_id);
		$this->load->view('admin/view-exam',$data);
	
	}// end function viewExam

	public function editExam($exam_id ='')
	{
		$this->login_check();

		if (empty($exam_id)) {
			redirect('admin/viewAllExams');
		}
		$data['title'] = "Exam Information";
		$data['class_array'] = $this->admin_model->get_all_classes();
		$data['exam_type_array'] = $this->admin_model->get_all_exam_types(); 
		$data['exam_info'] = $this->admin_model->get_single_exam_info_id($exam_id);

		if ($this->preCheckEditExam()) {
			
			if ($this->admin_model->update_exam($exam_id)) {
				$this->session->set_flashdata('success', 'Exam update successfull.');
				redirect('admin/viewAllExams');
			}else{
				$this->session->set_flashdata('error', 'Unable to update exam.');
				redirect('admin/viewAllExams');
			}

		}else{

			$this->load->view('admin/edit-exam',$data);

		}
	
	}// end function editExam

	private function preCheckEditExam()
	{
		// echo '<pre>';print_r($_POST);echo '</pre>';die();
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');

		//setting rules
		$this->form_validation->set_rules('class_id', 'Class', 'required');
		$this->form_validation->set_rules('exam_name', 'Examination Name', 'required');
		$this->form_validation->set_rules('exam_year_dominic', 'Examination year dominic', 'required');
		$this->form_validation->set_rules('exam_result_date_dominic', 'Examination result date dominic', 'required');
		$this->form_validation->set_rules('exam_result_date_hijri', 'Examination result date hijri', 'required');
		$this->form_validation->set_rules('exam_degree_date_dominic', 'Examination degree date dominic', 'required');
		$this->form_validation->set_rules('exam_degree_date_hijri', 'Examination degree date hijri', 'required');
		$this->form_validation->set_rules('exam_center', 'Examination center', 'required');
		$this->form_validation->set_rules('exam_type', 'Examination type', 'required');
		
		// if rules fulfilled
		
		if ($this->form_validation->run() === FALSE){
			
			return false;
			
		}else{
			
			return true;	
			
		}
	
	}// end function preCheckEditExam

	public function newStudent()
	{
		$this->login_check();

		$data['title'] = "Add New Student";
		$data['exams_array'] = $this->admin_model->get_all_exams();
		// $data['exam_type_array'] = $this->admin_model->get_all_exam_types();

		if($this->preChecknewStudent()){


			if( $this->admin_model->validate_if_exam_allowed() ){

				$this->redirectUserToRespectiveForm(); // this function redirect to user on the basis of their course selected

			}else{

				$this->session->set_flashdata('failure', 'یہ امتحان اس کلاس کا نہیں ہے-درست امتحان کا انتخاب کریں-.');
				redirect('admin/newStudent','refresh');

			}// end if for add_company_service_types
					
		}else{

			$this->load->view('admin/addNewStudent',$data);
			
		}// end if for preCheck company Registration
	
	}// end function new student

	private function preCheckNewStudent()
	{
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');

		//setting rules
		$this->form_validation->set_rules('exam_id', 'Exam selection', 'required');
		$this->form_validation->set_rules('course_grade', 'Course selection', 'required');

		if ($this->form_validation->run() === FALSE){
			
			return false;
			
		}else{
			
			return true;	
			
		}

	}// end function preCheckNewStudent

	private function redirectUserToRespectiveForm()
	{
		$exam_id = $this->input->post('exam_id');
		switch ($this->input->post('course_grade')) {

			case 'grade0':
				redirect('admin/addNewStudentForHifzCourse/'.$exam_id,'refresh');
				break;
			case 'grade1':
				redirect('admin/addNewStudentForTajweedCourse/'.$exam_id,'refresh');
				// die('grade1');
				break;
			case 'grade3':
				redirect('admin/addNewStudentForSixCourse/'.$exam_id,'refresh');
				break;
			case 'grade4':
				redirect('admin/addNewStudentForTenCourse/'.$exam_id,'refresh');
				break;
			
			default:
				# code...
				break;

		}// end switch for course grades

	}// end function redirectUserToRespectiveForm

	public function addNewStudentForHifzCourse($exam_id = '')
	{
		$this->login_check();

		$data['title'] = "Add Student For Hifz Course";

		if (!empty($exam_id)) {

			$data['class_exam_info']  = $this->admin_model->get_class_and_exam_info_by_exam_id($exam_id);

			// echo '<pre>';print_r($data['class_exam_info']);echo '</pre>';
			$data['exam_center_info'] = $this->admin_model->get_all_examination_center_info();
			// $data['subject_info'] 	  = $this->admin_model->get_all_subject_info_by_class_id($data['class_exam_info'][0]['class_id']);
			// $data['subject_info'] 	  = $this->admin_model->get_all_subject_info_by_class_id($data['class_exam_info'][0]['class_id']);
			
			$data['new_std_reg_no']	  = $this->admin_model->get_new_reg_no($exam_id);
			// echo '<pre>';print_r($data['new_std_reg_no']);echo '</pre>';
			$data['new_std_roll_no']  = $this->admin_model->get_new_roll_no($exam_id,$data['class_exam_info'][0]['class_id']);
			// print_r($data['class_exam_info']);
		}
		if ($this->preCheckAddNewStudentForHifzCourse()) {

			// check for if file is uploaded or not and if uploaded then process the image  
			if (isset($_FILES['userfile']['name']) and $_FILES['userfile']['name'] != "") {

					if ( ($uploaded_file_info = $this->uploadUserImage()) != NULL) {

						if (is_array($uploaded_file_info)) {

							if (($lc_std_id = $this->admin_model->add_new_student($uploaded_file_info)) != NULL) {

								$this->session->set_flashdata('success', 'طالب علم کو کامیابی ڈالا');
								redirect('admin/addNewStudentForHifzCourse','refresh');

							}else{

								$this->session->set_flashdata('failure', $uploaded_file_info);
								redirect('admin/addNewStudentForHifzCourse/'.$exam_id,'refresh');

							}

						}else{

							$this->session->set_flashdata('failure', $uploaded_file_info);
							redirect('admin/addNewStudentForHifzCourse/'.$exam_id,'refresh');

						}// end if for is array uploaded_file_data check	

					}else{

							$this->session->set_flashdata('failure', $uploaded_file_info);
							redirect('admin/addNewStudentForHifzCourse','refresh');

					}// end if for uploading user image	
			}else{

				if (($lc_std_id = $this->admin_model->add_new_student()) != NULL) {

					$this->session->set_flashdata('success', 'طالب علم کو کامیابی ڈالا');
					redirect('admin/newStudent','refresh');

				}else{

					$this->session->set_flashdata('failure', "Unable to add new studnet");
					redirect('admin/addNewStudentForHifzCourse/'.$exam_id,'refresh');

				}

			}// end if for adding the student with uplaoding the student image.

			// echo '<pre>';print_r($_POST);echo '</pre>';
			// echo '<pre>';print_r($_FILES);echo '</pre>';
		}else{
			$this->load->view('admin/add-student-for-hifz-course',$data);
			// echo $exam_id.'br/>'.print_r($data['subject_info']);die();
			
		}

	}// end function addNewStudentForHifzCourse

	private function preCheckAddNewStudentForHifzCourse()
	{		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');

		//setting rules
		$this->form_validation->set_rules('exam_center', 'Examination Center', 'trim|required|numeric');
		$this->form_validation->set_rules('reg_no', 'Registration No', 'trim|required|numeric');
		$this->form_validation->set_rules('roll_no', 'Roll No', 'trim|required|numeric');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('father_name', 'Father name', 'trim|required');
		// $this->form_validation->set_rules('id_card_no', 'ID Card No', 'trim|required');
		$this->form_validation->set_rules('dob_eng', 'DOB Digits', 'trim|required');
		$this->form_validation->set_rules('dob_urdu', 'DOB Characters', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		// if (empty($_FILES['userfile']['name'])) {
		// 	$this->form_validation->set_rules('userfile', 'Image', 'required');
		// }
		$this->form_validation->set_rules('old_institute_reg_no', 'Institute Registeration No', 'required|numeric|callback_instituteno_check');
		// $this->form_validation->set_rules('dob_urdu', 'DOB Characters', 'required');
		

		if ($this->form_validation->run() === FALSE){
			
			return false;
			
		}else{
			
			return true;	
			
		}

	}// end function preCheckAddNewStudentForHifzCourse

	public function editStudent($student_id ='')
	{
		if (empty($student_id)) {
			redirect('admin/viewAllStudents');
		}

		$this->login_check();

		$data['title'] = "Edit Student";
		$data['exams_array'] = $this->admin_model->get_all_exams();
		$data['exam_center_info'] = $this->admin_model->get_all_examination_center_info();
		$data['student_info'] = $this->admin_model->view_student_info($student_id);

		// echo '<pre>';print_r($_POST);echo '</pre>';
		// echo '<pre>';print_r($_FILES);echo '</pre>';
		// die();
		// $data['exam_type_array'] = $this->admin_model->get_all_exam_types();

		if($this->preCheckEditStudent()){
			// echo 'we are here';
			// echo '<pre>';print_r($_POST);echo '</pre>';
			// echo '<pre>';print_r($_FILES);echo '</pre>';
			// die();
			// check for if file is uploaded or not and if uploaded then process the image  
			if (isset($_FILES['userfile']['name']) and $_FILES['userfile']['name'] != "") {

					if ( ($uploaded_file_info = $this->uploadUserImage()) != NULL) {

						if (is_array($uploaded_file_info)) {

							if ( $this->admin_model->update_student_info($uploaded_file_info,$student_id) ) {

								$this->session->set_flashdata('success', 'طالب علم کا ریکارڈ کا میابی سہ اپ ڈیٹ ھو گیا ھے');
								redirect('admin/viewAllStudents','refresh');

							}else{

								$this->session->set_flashdata('failure', $uploaded_file_info);
								redirect('admin/editStudent/'.$student_id,'refresh');

							}

						}else{

							$this->session->set_flashdata('failure', $uploaded_file_info);
							redirect('admin/editStudent/'.$student_id,'refresh');

						}// end if for is array uploaded_file_data check	

					}else{

							$this->session->set_flashdata('failure', $uploaded_file_info);
							redirect('admin/editStudent/'.$student_id,'refresh');

					}// end if for uploading user image	
			
			}else{

				if ( $this->admin_model->update_student_info('',$student_id) ) {

					$this->session->set_flashdata('success', 'طالب علم کا ریکارڈ کا میابی سہ اپ ڈیٹ ھو گیا ھے');
					redirect('admin/viewAllStudents','refresh');

				}else{

					$this->session->set_flashdata('failure', "Unable to add new studnet");
					redirect('admin/editStudent/'.$student_id,'refresh');

				}

			}// end if for adding the student with uplaoding the student image.

		}else{

			$this->load->view('admin/edit-student',$data);
			
		}// end if for preCheck company Registration

	}// end function editStudent

	private function preCheckEditStudent()
	{		
		// echo '<pre>';print_r($_POST);echo '</pre>';
		// echo '<pre>';print_r($_FILES);echo '</pre>';
		// die();
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');

		//setting rules
		$this->form_validation->set_rules('exam_center', 'Examination Center', 'trim|required|numeric');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('father_name', 'Father name', 'trim|required');
		// $this->form_validation->set_rules('id_card_no', 'ID Card No', 'trim|required');
		$this->form_validation->set_rules('dob_eng', 'DOB Digits', 'trim|required');
		$this->form_validation->set_rules('dob_urdu', 'DOB Characters', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		// if (empty($_FILES['userfile']['name'])) {
		// 	$this->form_validation->set_rules('userfile', 'Image', 'required');
		// }
		$this->form_validation->set_rules('old_institute_reg_no', 'Institute Registeration No', 'required|numeric|callback_instituteno_check');
		// $this->form_validation->set_rules('dob_urdu', 'DOB Characters', 'required');
		

		if ($this->form_validation->run() === FALSE){
			
			return false;
			
		}else{

			// echo '<pre>';print_r($_POST);echo '</pre>';
			// echo '<pre>';print_r($_FILES);echo '</pre>';
			// die();
			if (isset($_FILES['userfile']['name']) and  $_FILES['userfile']['name'] != ""){

				if (isset($_POST['old_student_image']) and $_POST['old_student_image'] != "") {

					$file = 'student_images/'.$_POST['old_student_image'];
					// echo '<pre>';print_r($_POST);echo '</pre>';//die();
					// echo '<pre>';print_r($_FILES);echo '</pre>';die();

					if (file_exists($file) && is_readable($file) && unlink($file)){

						return true;

					}else{

						return false;
					}
				}else{

					return true;
					
				}

			}else{

				return true;

			}			
		}

	}// end function preCheckEditStudent

	public function instituteno_check($old_registration_no)
	{
		if ($old_registration_no != '')
		{
			if ($this->admin_model->check_if_registration_no_exits($old_registration_no)) {
				return TRUE;
			}else{
				$this->form_validation->set_message('instituteno_check', 'The %s donot exits in the directory');
				return FALSE;
			}
		}
		else
		{
			return TRUE;
		}

	}// end function instituteno_check

	public function addNewStudentForSixCourse($exam_id = '')
	{
		$this->login_check();

		$data['title'] = "Add Student For Six Course";
		if (!empty($exam_id)) {
			$data['class_exam_info']  = $this->admin_model->get_class_and_exam_info_by_exam_id($exam_id);
			$data['exam_center_info'] = $this->admin_model->get_all_examination_center_info();
			$data['subject_info'] 	  = $this->admin_model->get_all_subject_info_by_class_id($data['class_exam_info'][0]['class_id']);
			$data['subject_info'] 	  = $this->admin_model->get_all_subject_info_by_class_id($data['class_exam_info'][0]['class_id']);
			$data['new_std_reg_no']	  = $this->admin_model->get_new_reg_no();
			$data['new_std_roll_no']  = $this->admin_model->get_new_roll_no($exam_id,$data['class_exam_info'][0]['class_id']);
			// print_r($data['class_exam_info']);
		}
		if ($this->preCheckAddNewStudentForSixCourse()) {

			if (isset($_FILES['userfile']['name']) and $_FILES['userfile']['name'] != "") {

					if ( ($uploaded_file_info = $this->uploadUserImage()) != NULL) {

						if (is_array($uploaded_file_info)) {

							if (($lc_std_id = $this->admin_model->add_new_student($uploaded_file_info)) != NULL) {

								$this->session->set_flashdata('success', 'طالب علم کو کامیابی ڈالا');
								redirect('admin/addNewStudentForSixCourse/'.$exam_id,'refresh');

							}else{

								$this->session->set_flashdata('failure', "Unable to add new student");
								redirect('admin/addNewStudentForSixCourse/'.$exam_id,'refresh');

							}

						}else{

							$this->session->set_flashdata('failure', $uploaded_file_info);
							redirect('admin/addNewStudentForSixCourse/'.$exam_id,'refresh');

						}// end if for is array uploaded_file_data check	

					}else{

							$this->session->set_flashdata('failure', $uploaded_file_info);
							redirect('admin/addNewStudentForSixCourse','refresh');

					}// end if for uploading user image	
			
			}else{

				if (($lc_std_id = $this->admin_model->add_new_student()) != NULL) {

					$this->session->set_flashdata('success', 'طالب علم کو کامیابی ڈالا');
					redirect('admin/addNewStudentForSixCourse/'.$exam_id,'refresh');

				}else{

					$this->session->set_flashdata('failure', "Unable to add new studnet");
					redirect('admin/addNewStudentForSixCourse/'.$exam_id,'refresh');

				}

			}// end if for adding the student with uplaoding the student image.
			// echo '<pre>';print_r($_POST);echo '</pre>';
			// echo '<pre>';print_r($_FILES);echo '</pre>';
		}else{
			$this->load->view('admin/add-student-for-six-course',$data);
			// echo $exam_id.'br/>'.print_r($data['subject_info']);die();
			
		}

	}// end function addNewStudentForSixCourse

	private function preCheckAddNewStudentForSixCourse()
	{
			
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');

		//setting rules
		$this->form_validation->set_rules('exam_center', 'Examination Center', 'trim|required|numeric');
		$this->form_validation->set_rules('reg_no', 'Registration No', 'trim|required|numeric');
		$this->form_validation->set_rules('roll_no', 'Roll No', 'trim|required|numeric');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('father_name', 'Father name', 'trim|required');
		// $this->form_validation->set_rules('id_card_no', 'ID Card No', 'trim|required');
		$this->form_validation->set_rules('dob_eng', 'DOB Digits', 'trim|required');
		// $this->form_validation->set_rules('dob_urdu', 'DOB Characters', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		// if (empty($_FILES['userfile']['name'])) {
		// 	$this->form_validation->set_rules('userfile', 'Image', 'required');
		// }
		// $this->form_validation->set_rules('institute_reg_no', 'Institute Registeration No', 'required');
		// $this->form_validation->set_rules('dob_urdu', 'DOB Characters', 'required');
		

		if ($this->form_validation->run() === FALSE){
			
			return false;
			
		}else{
			
			return true;	
			
		}

	}// end function preCheckAddNewStudentForSixCourse

	public function addNewStudentForTenCourse($exam_id = '')
	{
		$this->login_check();

		$data['title'] = "Add Student For Ten Course Program";
		if (!empty($exam_id)) {
			$data['class_exam_info']  = $this->admin_model->get_class_and_exam_info_by_exam_id($exam_id);
			$data['exam_center_info'] = $this->admin_model->get_all_examination_center_info();
			$data['subject_info'] 	  = $this->admin_model->get_all_subject_info_by_class_id($data['class_exam_info'][0]['class_id']);
			$data['subject_info'] 	  = $this->admin_model->get_all_subject_info_by_class_id($data['class_exam_info'][0]['class_id']);
			$data['new_std_reg_no']	  = $this->admin_model->get_new_reg_no();
			$data['new_std_roll_no']  = $this->admin_model->get_new_roll_no($exam_id,$data['class_exam_info'][0]['class_id']);
			// print_r($data['class_exam_info']);
		}
		if ($this->preCheckAddNewStudentForTenCourse()) {

			if (isset($_FILES['userfile']['name']) and $_FILES['userfile']['name'] != "") {

					if ( ($uploaded_file_info = $this->uploadUserImage()) != NULL) {

						if (is_array($uploaded_file_info)) {

							if (($lc_std_id = $this->admin_model->add_new_student($uploaded_file_info)) != NULL) {

								$this->session->set_flashdata('success', 'طالب علم کو کامیابی ڈالا گیا ہے');
								redirect('admin/addNewStudentForTenCourse/'.$exam_id,'refresh');

							}else{

								$this->session->set_flashdata('failure', "Unable to add new student");
								redirect('admin/addNewStudentForTenCourse/'.$exam_id,'refresh');

							}

						}else{

							$this->session->set_flashdata('failure', $uploaded_file_info);
							redirect('admin/addNewStudentForTenCourse/'.$exam_id,'refresh');

						}// end if for is array uploaded_file_data check	

					}else{

							$this->session->set_flashdata('failure', "Unable to upload image try again please");
							redirect('admin/addNewStudentForTenCourse','refresh');

					}// end if for uploading user image	
			}else{

				if (($lc_std_id = $this->admin_model->add_new_student()) != NULL) {

					$this->session->set_flashdata('success', 'طالب علم کو کامیابی ڈالا');
					redirect('admin/addNewStudentForTenCourse/'.$exam_id,'refresh');

				}else{

					$this->session->set_flashdata('failure', "Unable to add new studnet");
					redirect('admin/addNewStudentForTenCourse/'.$exam_id,'refresh');

				}

			}// end if for adding the student with uplaoding the student image.
			// echo '<pre>';print_r($_POST);echo '</pre>';
			// echo '<pre>';print_r($_FILES);echo '</pre>';
		}else{
			$this->load->view('admin/add-student-for-ten-course',$data);
			// echo $exam_id.'br/>'.print_r($data['subject_info']);die();
			
		}

	}// end function addNewStudentForTenCourse

	private function preCheckAddNewStudentForTenCourse()
	{
			
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');

		//setting rules
		$this->form_validation->set_rules('exam_center', 'Examination Center', 'trim|required|numeric');
		$this->form_validation->set_rules('reg_no', 'Registration No', 'trim|required|numeric');
		$this->form_validation->set_rules('roll_no', 'Roll No', 'trim|required|numeric');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('father_name', 'Father name', 'trim|required');
		// $this->form_validation->set_rules('id_card_no', 'ID Card No', 'trim|required');
		$this->form_validation->set_rules('dob_eng', 'DOB Digits', 'trim|required');
		$this->form_validation->set_rules('dob_urdu', 'DOB Characters', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		// if (empty($_FILES['userfile']['name'])) {
		// 	$this->form_validation->set_rules('userfile', 'Image', 'required');
		// }
		// $this->form_validation->set_rules('institute_reg_no', 'Institute Registeration No', 'required');
		// $this->form_validation->set_rules('dob_urdu', 'DOB Characters', 'required');
		

		if ($this->form_validation->run() === FALSE){
			
			return false;
			
		}else{
			
			return true;	
			
		}

	}// end function preCheckAddNewStudentForTenCourse

	public function addNewStudentForTajweedCourse($exam_id = '')
	{

		$this->login_check();

		$data['title'] = "Add Student For Tajweed Course Program";
		if (!empty($exam_id)) {
			$data['class_exam_info']  = $this->admin_model->get_class_and_exam_info_by_exam_id($exam_id);
			$data['exam_center_info'] = $this->admin_model->get_all_examination_center_info();
			$data['subject_info'] 	  = $this->admin_model->get_all_subject_info_by_class_id($data['class_exam_info'][0]['class_id']);
			$data['subject_info'] 	  = $this->admin_model->get_all_subject_info_by_class_id($data['class_exam_info'][0]['class_id']);
			$data['new_std_reg_no']	  = $this->admin_model->get_new_reg_no();
			$data['new_std_roll_no']  = $this->admin_model->get_new_roll_no($exam_id,$data['class_exam_info'][0]['class_id']);
			// print_r($data['class_exam_info']);
		}
		if ($this->preCheckaddNewStudentForTajweedCourse()) {

			if (isset($_FILES['userfile']['name']) and $_FILES['userfile']['name'] != "") {

					if ( ($uploaded_file_info = $this->uploadUserImage()) != NULL) {

						if (is_array($uploaded_file_info)) {

							if (($lc_std_id = $this->admin_model->add_new_student($uploaded_file_info)) != NULL) {

								$this->session->set_flashdata('success', 'طالب علم کو کامیابی ڈالا');
								redirect('admin/addNewStudentForTajweedCourse'.$exam_id,'refresh');

							}else{

								$this->session->set_flashdata('failure', "Unable to add new student");
								redirect('admin/addNewStudentForTajweedCourse/'.$exam_id,'refresh');

							}

						}else{

							$this->session->set_flashdata('failure', $uploaded_file_info);
							redirect('admin/addNewStudentForTajweedCourse/'.$exam_id,'refresh');

						}// end if for is array uploaded_file_data check	

					}else{

							$this->session->set_flashdata('failure', "Unable to upload image try again please");
							redirect('admin/addNewStudentForTajweedCourse'.$exam_id,'refresh');

					}// end if for uploading user image	
			}else{

				if (($lc_std_id = $this->admin_model->add_new_student()) != NULL) {

					$this->session->set_flashdata('success', 'طالب علم کو کامیابی ڈالا');
					redirect('admin/addNewStudentForTajweedCourse/'.$exam_id,'refresh');

				}else{

					$this->session->set_flashdata('failure', "Unable to add new studnet");
					redirect('admin/addNewStudentForTajweedCourse/'.$exam_id,'refresh');

				}

			}// end if for adding the student with uplaoding the student image.
			// echo '<pre>';print_r($_POST);echo '</pre>';
			// echo '<pre>';print_r($_FILES);echo '</pre>';
		}else{
			$this->load->view('admin/add-student-for-tajweed-course',$data);
			// echo $exam_id.'br/>'.print_r($data['subject_info']);die();
			
		}

	}// end function addNewStudentForTajweedCourse

	private function preCheckaddNewStudentForTajweedCourse()
	{
			
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');

		//setting rules
		$this->form_validation->set_rules('exam_center', 'Examination Center', 'trim|required|numeric');
		$this->form_validation->set_rules('reg_no', 'Registration No', 'trim|required|numeric');
		$this->form_validation->set_rules('roll_no', 'Roll No', 'trim|required|numeric');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('father_name', 'Father name', 'trim|required');
		// $this->form_validation->set_rules('id_card_no', 'ID Card No', 'trim|required');
		$this->form_validation->set_rules('dob_eng', 'DOB Digits', 'trim|required');
		$this->form_validation->set_rules('dob_urdu', 'DOB Characters', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		// if (empty($_FILES['userfile']['name'])) {
		// 	$this->form_validation->set_rules('userfile', 'Image', 'required');
		// }
		// $this->form_validation->set_rules('institute_reg_no', 'Institute Registeration No', 'required');
		// $this->form_validation->set_rules('dob_urdu', 'DOB Characters', 'required');
		

		if ($this->form_validation->run() === FALSE){
			
			return false;
			
		}else{
			
			return true;	
			
		}

	}// end function preCheckaddNewStudentForTajweedCourse

	public function getClasses()
	{
		$data['class_array'] =  $this->admin_model->get_all_classes();

		echo "<pre>";print_r($data['class_array']);echo "</pre>";
	
	}// end function getClasses

	public function viewAllStudents($offset = NULL)
	{
		$this->login_check();

		$data['title'] = "View All Students";
		$config['base_url']   = base_url().'admin/viewAllStudents';
		$config['total_rows'] = $this->admin_model->get_all_student_record_rows();
		$data['students_info'] = $this->admin_model->get_all_students($this->config->item('per_page'),$offset);
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$this->load->view('admin/view-all-student',$data);
		// echo "<pre>";print_r($data['students_info']);echo "</pre>";
	
	}// end function viewAllStudents

	public function viewStudentsByExam($exam_id ='')
	{
		$this->login_check();
		$data['title'] 		= "امتحان کے حساب سے نمبر";
		$data['exams_array'] = $this->admin_model->get_all_exams();
		 // echo '<pre>';print_r($data['exams_array']);echo '</pre>';

		if ($this->preCheckViewStudentsByExam()) {
			
			$data['exam_class_grade'] = $this->admin_model->get_exam_class_grade($this->input->post('exam_id'));
			$exam_type_id = $this->admin_model->get_exam_type_by_exam_id($this->input->post('exam_id'));
			
			//redirect('admin/createDateSheet/'.$this->input->post('exam_id'));
			switch ($data['exam_class_grade']) {
				case 'grade0':
					redirect('admin/oneSubjectStudents/'.$this->input->post('exam_id').'/'.$exam_type_id);
					break;
				case 'grade1':
					redirect('admin/oneSubjectStudents/'.$this->input->post('exam_id').'/'.$exam_type_id);
					break;
				case 'grade3':
					redirect('admin/sixSubjectStudents/'.$this->input->post('exam_id').'/'.$exam_type_id);
					break;
				case 'grade4':
					redirect('admin/tenSubjectStudents/'.$this->input->post('exam_id').'/'.$exam_type_id);
					break;
				case 'grade5':
					echo 'Currently working at grade5';
					break;
				case 'grade6':
					echo 'Currently working at grade6';
					break;
				
				default:
					echo 'I am here with default';
					break;
			}

		}else{

			$this->load->view('admin/view-students-by-exam',$data);
			// echo '<pre>';print_r($data['exams_array']);echo '</pre>';

		}
		
	}// end function viewStudentsByExam

	private function preCheckViewStudentsByExam()
	{
		$this->form_validation->set_rules('exam_id', 'Exam','required');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function preCheckViewStudentsByExam

	public function oneSubjectStudents($exam_id = '',$exam_type = '',$offset = NULL)
	{
		$this->login_check();
		if (empty($exam_id)) {
			$this->session->set_flashdata('failure','امتحان کا انتخاب لازمی ھے');
			redirect('admin/viewStudentsByExam');
		}
		$data['title'] = "Students's Record";
		$data['exam_id'] = $exam_id;
		$data['exam_type'] = $exam_type;
		$data['no_subject'] = 1;
		$config['base_url']   = base_url().'admin/oneSubjectStudents/'.$exam_id.'/'.$exam_type;
		$config['total_rows'] = $this->admin_model->get_student_record_rows($exam_id);
		$config['uri_segment'] = 5;
		$data['students_info'] = $this->admin_model->get_all_students_by_exam($exam_id,$this->config->item('per_page'),$offset);
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		// echo '<pre>';print_r($data['students_info']);echo '</pre>';
		$this->load->view('admin/view-all-student-with-pagination',$data);

	}// end function oneSubjectStudents

	public function sixSubjectStudents($exam_id ='',$exam_type ='',$offset = NULL)
	{
		$this->login_check();
		if (empty($exam_id)) {
			$this->session->set_flashdata('failure','امتحان کا انتخاب لازمی ھے');
			redirect('admin/viewStudentsByExam');
		}
		$data['title'] = "Students's Record";
		$data['exam_id'] = $exam_id;
		$data['no_subject'] = 6;
		$data['exam_type'] = $exam_type;
		$config['base_url']   = base_url().'admin/sixSubjectStudents/'.$exam_id.'/'.$exam_type;
		$config['total_rows'] = $this->admin_model->get_student_record_rows($exam_id);
		$config['uri_segment'] = 5;
		$data['students_info'] = $this->admin_model->get_all_students_by_exam($exam_id,$this->config->item('per_page'),$offset);
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		// echo '<pre>';print_r($data['students_info']);echo '</pre>';
		$this->load->view('admin/view-all-student-with-pagination',$data);

	}// end function sixSubjectStudents

	public function tenSubjectStudents($exam_id ='',$exam_type ='',$offset = NULL)
	{
		$this->login_check();
		if (empty($exam_id) || empty($exam_type)) {
			$this->session->set_flashdata('failure','امتحان کا انتخاب لازمی ھے');
			redirect('admin/viewStudentsByExam');
		}
		$data['title'] = "Students's Record";
		$data['exam_id'] = $exam_id;
		$data['no_subject'] = 10;
		$data['exam_type'] = $exam_type;
		$config['base_url']   = base_url().'admin/tenSubjectStudents/'.$exam_id.'/'.$exam_type;
		$config['total_rows'] = $this->admin_model->get_student_record_rows($exam_id);
		$config['uri_segment'] = 5;
		$data['students_info'] = $this->admin_model->get_all_students_by_exam($exam_id,$this->config->item('per_page'),$offset);
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		// echo '<pre>';print_r($data['students_info']);echo '</pre>';
		$this->load->view('admin/view-all-student-with-pagination',$data);

	}// end function tenSubjectStudents

	public function viewOneResult($exam_id = '', $exam_type ='', $student_id ='')
	{
		if (empty($student_id)) {
			$this->session->set_flashdata('failure','طالب علم کے سیلیکشن لازمی ھے');
			redirect('admin/viewStudentsByExam');
		}
		$data['title'] = "رزلٹ";
		$data['exam_id'] = $exam_id;
		$data['exam_type'] = $exam_type;
		$data['result_info'] = $this->admin_model->get_student_result_info($exam_id,$student_id);
		// echo '<pre>';print_r($data['result_info']);echo '</pre>';
		$data['exam_class_grade'] = $this->admin_model->get_exam_class_grade($exam_id);
		$data['exam_subjects'] = $this->admin_model->get_student_class_subjects($student_id);
		$data['exam_name'] = $this->admin_model->get_single_exam_info_id($exam_id);
		// echo '<pre>';print_r($data['exam_subjects']);echo '</pre>';//die();
		// echo $data['result_info'][0]['rinfo_id'].'here';
		if ($this->preCheckViewOneResult()) {

			
			if ( $data['result_info'][0]['rinfo_id'] == "") {
			// echo '<pre>';print_r($_POST);echo '</pre>';die();	
				if ($this->admin_model->add_student_result($exam_id,$student_id)) {

					$this->session->set_flashdata('success','رزلٹ کامیابی سے اپڈیٹ ھو گیا');
					redirect('admin/oneSubjectStudents/'.$exam_id.'/'.$exam_type);

				}else{

					$this->session->set_flashdata('failure','رزلٹ اپڈیٹ نہیں ھو سکا دوبارہ کوشیش کریں');
					redirect('admin/oneSubjectStudents/'.$exam_id.'/'.$exam_type);
				}	

			}else{
				// echo '<pre>';print_r($_POST);echo '</pre>';die();
				if ($this->admin_model->update_student_result($exam_id,$student_id)) {

					$this->session->set_flashdata('success','رزلٹ کامیابی سے اپڈیٹ ھو گیا');
					redirect('admin/oneSubjectStudents/'.$exam_id.'/'.$exam_type);

				}else{

					$this->session->set_flashdata('failure','رزلٹ اپڈیٹ نہیں ھو سکا دوبارہ کوشیش کریں');
					redirect('admin/oneSubjectStudents/'.$exam_id.'/'.$exam_type);
				}

			}

		}else{

			$this->load->view('admin/add-one-subject-result',$data);

		}
		
	}// end function viewOneResult

	private function preCheckViewOneResult()
	{

		$this->form_validation->set_rules('subject_id','Subject','required');
		// $this->form_validation->set_rules('obtained_marks','Marks','numeric');		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function preCheckViewOneResult

	public function viewSixResult($exam_id = '', $exam_type = '', $student_id ='')
	{
		/*echo '<pre>';print_r("exam_id=>$exam_id, exam_type => $exam_type, student_id => $student_id");echo '</pre>';
		die('yoho!');*/
		if (empty($exam_id)) {
			$this->session->set_flashdata('failure','طالب علم کے سیلیکشن لازمی ھے');
			redirect('admin/viewStudentsByExam');
		}

		$data['title'] = "رزلٹ";
		$data['exam_id'] = $exam_id;
		$data['exam_type'] = $exam_type;
		$data['exam_class_grade'] = $this->admin_model->get_exam_class_grade($exam_id);
		$data['attempt_no'] = $this->admin_model->get_single_student_attempt_no_id($student_id);
		// die('Yoho! am here');
		
		if ($exam_type == 2) {

			$data['result_info'] = $this->admin_model->get_student_result_info($exam_id,$student_id,$exam_type,$data['attempt_no']);
			// echo '<pre>';print_r($data['result_info']);echo '</pre>';
			$data['exam_subjects'] = $this->admin_model->get_student_class_subjects($student_id,$exam_type,$exam_id);
			// echo '<pre>';print_r($data['exam_subjects']);echo '</pre>';
			$data['exam_name'] = $this->admin_model->get_single_exam_info_id($exam_id,$exam_type);

		}else{

			$data['result_info'] = $this->admin_model->get_student_result_info($exam_id,$student_id,$exam_type,$data['attempt_no']);
			$data['exam_subjects'] = $this->admin_model->get_student_class_subjects($student_id);
			$data['exam_name'] = $this->admin_model->get_single_exam_info_id($exam_id);

		}

		// echo '<!--';print_r($data);echo '--->';
		if ($this->preCheckViewSixResult()) {
		
			if ( $data['result_info'][0]['rinfo_id'] == "") {
					
				if ($this->admin_model->add_six_student_result($exam_id,$student_id)) {

					$this->session->set_flashdata('success','رزلٹ کامیابی سے اپڈیٹ ھو گیا');
					redirect('admin/sixSubjectStudents/'.$exam_id.'/'.$exam_type);

				}else{

					$this->session->set_flashdata('failure','رزلٹ اپڈیٹ نہیں ھو سکا دوبارہ کوشیش کریں');
					redirect('admin/sixSubjectStudents/'.$exam_id.'/'.$exam_type);
				
				}				

			}else{
				
				if ($this->admin_model->update_six_student_result($exam_id,$student_id,$exam_type)) {

						$this->session->set_flashdata('success','رزلٹ کامیابی سے اپڈیٹ ھو گیا');
						redirect('admin/sixSubjectStudents/'.$exam_id.'/'.$exam_type);

					}else{

						$this->session->set_flashdata('failure','رزلٹ اپڈیٹ نہیں ھو سکا دوبارہ کوشیش کریں');
						redirect('admin/sixSubjectStudents/'.$exam_id.'/'.$exam_type);
					}


			}

		}else{

			$this->load->view('admin/add-six-subject-result',$data);

		}
		
	}// end function viewSixResult

	private function preCheckViewSixResult()
	{
		
		$this->form_validation->set_rules('subject_id[]','Subject','required');
		// $this->form_validation->set_rules('obtained_marks','Marks','numeric');		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function preCheckViewSixResult

	public function viewTenResult($exam_id = '', $exam_type = '', $student_id ='')
	{
		if (empty($student_id)) {
			$this->session->set_flashdata('failure','طالب علم کے سیلیکشن لازمی ھے');
			redirect('admin/viewStudentsByExam');
		}
		$data['title'] = "رزلٹ";
		$data['exam_id'] = $exam_id;
		$data['exam_type'] = $exam_type;
		$data['exam_class_grade'] = $this->admin_model->get_exam_class_grade($exam_id);
		$data['attempt_no'] = $this->admin_model->get_single_student_attempt_no_id($student_id);

		if ($exam_type == 2) {
			
			$data['result_info'] = $this->admin_model->get_student_result_info($exam_id,$student_id,$exam_type,$data['attempt_no']);
			// echo '<pre>';print_r($data['result_info']);echo '</pre>';
			$data['exam_subjects'] = $this->admin_model->get_student_class_subjects($student_id,$exam_type,$exam_id);
			// echo '<pre>';print_r($data['exam_subjects']);echo '</pre>';
			$data['exam_name'] = $this->admin_model->get_single_exam_info_id($exam_id,$exam_type);

		}else{
			
			$data['result_info'] = $this->admin_model->get_student_result_info($exam_id,$student_id,$exam_type,$data['attempt_no']);
			$data['exam_subjects'] = $this->admin_model->get_student_class_subjects($student_id,$exam_type,$exam_id);
			$data['exam_name'] = $this->admin_model->get_single_exam_info_id($exam_id,$exam_type);
			// echo '<pre>';print_r($data['exam_subjects']);echo '</pre>';//die();
		}

		// echo $data['result_info'][0]['rinfo_id'].'here';
		if ($this->preCheckViewTenResult()) {
			
			if ( $data['result_info'][0]['rinfo_id'] == "") {
				
				echo '<pre>';print_r($_POST);echo '</pre>';die();	
				if ($this->admin_model->add_ten_student_result($exam_id,$student_id)) {

					$this->session->set_flashdata('success','رزلٹ کامیابی سے اپڈیٹ ھو گیا');
					redirect('admin/tenSubjectStudents/'.$exam_id.'/'.$exam_type);

				}else{

					$this->session->set_flashdata('failure','رزلٹ اپڈیٹ نہیں ھو سکا دوبارہ کوشیش کریں');
					redirect('admin/tenSubjectStudents/'.$exam_id.'/'.$exam_type);
				}	

			}else{
				// var_dump($_POST);die('asdfs');
				/*echo '<pre>';print_r($_POST);echo '</pre>';
				die('i am in the die section');*/
				if ($this->admin_model->update_six_student_result($exam_id,$student_id,$exam_type)) {

					$this->session->set_flashdata('success','رزلٹ کامیابی سے اپڈیٹ ھو گیا');
					redirect('admin/tenSubjectStudents/'.$exam_id.'/'.$exam_type);

				}else{

					$this->session->set_flashdata('failure','رزلٹ اپڈیٹ نہیں ھو سکا دوبارہ کوشیش کریں');
					redirect('admin/tenSubjectStudents/'.$exam_id.'/'.$exam_type);
				
				}

			}

		}else{

			$this->load->view('admin/add-ten-subject-result',$data);

		}
		
	}// end function viewTenResult

	private function preCheckViewTenResult()
	{
		
		$this->form_validation->set_rules('subject_id[]','Subject','required');
		// $this->form_validation->set_rules('obtained_marks','Marks','numeric');		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function preCheckViewTenResult

	public function viewAllStudentsTenCourseMale()
	{
		$this->login_check();

		$data['title'] = "View All Students";
		$data['students_info'] = $this->admin_model->get_all_students_ten_course_male();
		$this->load->view('admin/view-all-student-ten-course-male',$data);
		// echo "<pre>";print_r($data['students_info']);echo "</pre>";
	
	}// end function viewAllStudents

	public function viewAllStudentsTenCourseFemale()
	{
		$this->login_check();

		$data['title'] = "View All Students";
		$data['students_info'] = $this->admin_model->get_all_students_ten_course_female();
		$this->load->view('admin/view-all-student-ten-course-female',$data);
		// echo "<pre>";print_r($data['students_info']);echo "</pre>";
	
	}// end function viewAllStudentsTenCourseFemale

	public function viewStudent($student_id = '')
	{
		$this->login_check();

		if(empty($student_id)){
			return NULL;
		}
		$data['title'] = "Students's Record";
		$data['student_info'] = $this->admin_model->view_student_info($student_id);
		$this->load->view('admin/view-student',$data);
		// echo "<pre>";print_r($data['student_info']);echo "</pre>";

	}// end function viewStudent

	public function viewTenCourseStudentMale($student_id = '')
	{
		$this->login_check();

		if(empty($student_id)){
			return NULL;
		}
		$data['title'] = "Students's Record";
		$data['student_info'] = $this->admin_model->view_student_info($student_id);
		$this->load->view('admin/view-student-ten-course-male',$data);
		// echo "<pre>";print_r($data['student_info']);echo "</pre>";

	}// end function viewTenCourseStudentMale

	public function viewTenCourseStudentFemale($student_id = '')
	{
		$this->login_check();

		if(empty($student_id)){
			return NULL;
		}
		$data['title'] = "Students's Record";
		$data['student_info'] = $this->admin_model->view_student_info($student_id);
		$this->load->view('admin/view-student-ten-course-female',$data);
		// echo "<pre>";print_r($data['student_info']);echo "</pre>";

	}// end function viewTenCourseStudentFemale

	public function deleteStudent($student_id = '',$exam_id = '',$exam_type = '')
	{
		$class_grade = $this->admin_model->get_exam_class_grade($exam_id);
		
		if (empty($student_id) or empty($exam_id)) {

			$this->session->set_flashdata('failure', 'Please select student first.');

			switch ($class_grade) {
				case 'grade0':
					redirect('admin/oneSubjectStudents/'.$exam_id.'/'.$exam_type);
					break;
				case 'grade1':
					redirect('admin/oneSubjectStudents/'.$exam_id.'/'.$exam_type);
					break;
				case 'grade3':
					redirect('admin/sixSubjectStudents/'.$exam_id.'/'.$exam_type);
					break;
				case 'grade4':
					redirect('admin/tenSubjectStudents/'.$exam_id.'/'.$exam_type);
					break;
				case 'grade5':
					redirect('admin/viewAllStudents');
					break;
				case 'grade6':
					redirect('admin/tenSubjectStudents/viewAllStudents');
					break;
				case 'grade7':
					redirect('admin/viewAllStudents');
					break;
				default:
					redirect('admin/viewAllStudents');
					break;
			}
		}
		
		if ($this->admin_model->delete_student($student_id)) {
				
				$this->session->set_flashdata('success', 'اسٹوڈنٹ ریکارڈ کامیابی سے خارج');
				
				switch ($class_grade) 
				{
					case 'grade0':
						redirect('admin/oneSubjectStudents/'.$exam_id.'/'.$exam_type);
						break;
					case 'grade1':
						redirect('admin/oneSubjectStudents/'.$exam_id.'/'.$exam_type);
						break;
					case 'grade3':
						redirect('admin/sixSubjectStudents/'.$exam_id.'/'.$exam_type);
						break;
					case 'grade4':
						redirect('admin/tenSubjectStudents/'.$exam_id.'/'.$exam_type);
						break;
					case 'grade5':
						redirect('admin/viewAllStudents');
						break;
					case 'grade6':
						redirect('admin/tenSubjectStudents/viewAllStudents');
						break;
					case 'grade7':
						redirect('admin/viewAllStudents');
						break;
					default:
						redirect('admin/viewAllStudents');
						break;
				}

		}else{

			$this->session->set_flashdata('failure', 'اسٹوڈنٹ ریکارڈحذف کرنے سے قاصر');
				redirect('admin/viewAllStudents/','refresh');
		}
	
	}// end function deleteStudent

	private function uploadUserImage()
	{
		$config['upload_path'] = './student_images/';
		$config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG|gif';
		$config['max_size']	= '5012';
		$config['overwrite']	= FALSE;
		$config['remove_spaces'] = TRUE;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = $this->upload->display_errors();
			return $error;
		}else{
			$fileInfo = $this->upload->data();
			return $fileInfo;
		}

	}// end function uploadUserImage

	public function editSettings()
	{
		$data['title'] = "Edit Settings";
		$u_info = $this->session->userdata('admin_data');
		$data['member_info'] = $this->admin_model->get_current_user_info($u_info['mem_id']);
		if ($this->preCheckEditSettings()) {
			if ($this->admin_model->update_account_settings()) {
				# code...
			}
			$this->session->set_flashdata('success','Account updated successfully');
			redirect('admin/editSettings');

		}else{

			$this->load->view('admin/edit-setting',$data);

		}
		// echo '<pre>';print_r($data['member_info']);echo "</pre>";
	
	}// end function editSettings
	
	private function preCheckEditSettings()
	{
		$this->form_validation->set_rules('password', 'Password', 'min_length[5]');
		$this->form_validation->set_rules('confirm_password', 'Confirm', 'matches[password]');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function  preCheckEditSettings

	public function viewAllClasses()
	{
		$data['title'] = "View All Classes";
		$data['class_array'] =  $this->admin_model->get_all_classes();
		$this->load->view('admin/view-all-classes',$data);
		// echo '<pre>';print_r($data['class_array']);echo '</pre>';
	
	}// end function viewAllClasses

	public function viewClass($class_id ='')
	{
		$this->login_check();

		if (empty($class_id)) {
			$this->session->set_flashdata('failure','No class was selected to view');
			redirect('admin/viewAllClasses');
		}
		$data['title'] = "Class Information";
		$data['class_info'] = $this->admin_model->get_single_class_info_id($class_id);
		$this->load->view('admin/view-class',$data);
	
	}// end function viewExam

	public function AddClass()
	{
		$this->login_check();
		$data['title'] = "Add Class";

		if ($this->preCheckAddClass()) {
				
			if ( ($lc_class_id = $this->admin_model->add_class()) != NULL) {
				$this->session->set_flashdata('success','Class added successfully');
				redirect('admin/viewAllClasses');
			}else{
				$this->session->set_flashdata('failure','Unable to add class');
				redirect('admin/viewAllClasses');
			}

		}else{
			$this->load->view('admin/add-class',$data);
		}

	}// end function AddClass

	private function preCheckAddClass()
	{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');

		//setting rules
		$this->form_validation->set_rules('class_name_urdu', 'Urdu Name', 'required');
		$this->form_validation->set_rules('class_name_eng', 'English Name', 'required');
		$this->form_validation->set_rules('class_type', 'Class type', 'required');
		
		// if rules fulfilled
		
		if ($this->form_validation->run() === FALSE){
			
			return false;
			
		}else{
			
			return true;	
			
		}

	}// end function preCheckAddClass

	public function editClass($class_id ='')
	{
		$this->login_check();

		if (empty($class_id)) {
			$this->session->set_flashdata('failure','No class was selected for modification');
			redirect('admin/viewAllClasses');
		}
		$data['title'] = "Exam Information";
		$data['class_info'] = $this->admin_model->get_single_class_info_id($class_id);

		if ($this->preCheckEditClass()) {
			
			if ($this->admin_model->update_class($class_id)) {

				$this->session->set_flashdata('success', 'Class update successfull.');
				redirect('admin/viewAllClasses');

			}else{
				$this->session->set_flashdata('error', 'Unable to update class.');
				redirect('admin/viewAllClasses');
			}

		}else{

			$this->load->view('admin/edit-class',$data);

		}
	
	}// end function editClass

	private function preCheckEditClass()
	{
		// echo '<pre>';print_r($_POST);echo '</pre>';die();
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');

		//setting rules
		$this->form_validation->set_rules('class_name_urdu', 'Urdu Name', 'required');
		$this->form_validation->set_rules('class_name_eng', 'English Name', 'required');
		$this->form_validation->set_rules('class_type', 'Class type', 'required');
		
		// if rules fulfilled
		
		if ($this->form_validation->run() === FALSE){
			
			return false;
			
		}else{
			
			return true;	
			
		}
	
	}// end function preCheckEditExam

	public function deleteClass($class_id ='')
	{
		$this->login_check();
		if (empty($class_id)) {
			$this->session->set_flashdata('failure','No class selected');
			redirect('admin/viewAllClasses');
		}else{

			if ($this->admin_model->delete_class($class_id)) {

				$this->session->set_flashdata('success','Class deleted successfully');
				redirect('admin/viewAllClasses');

			}else{

				$this->session->set_flashdata('failure','Unable to delete class');
				redirect('admin/viewAllClasses');
			}
		}
	
	}// end function deleteClass

	public function viewAllAffliatedInstitues()
	{
		$this->login_check();

		$data['title'] = "View Affiliated Institutes";
		$data['institute_array'] = $this->admin_model->get_affiliated_institutes_info();
		// echo count($data['institute_array']);
		$this->load->view('admin/view-all-affiliated-institutes',$data);
		// echo '<pre>';print_r($data['institute_array']);echo "</pre>";

	}// end funciton viewAllAffliatedInstitues

	public function affiliateNewInstitute()
	{
		$data['title'] = "نئے مدرسے کا الحاق";
		$data['province_array'] = $this->admin_model->get_all_provinces();
		$data['district_array'] = $this->admin_model->get_all_districts_for_view();
		if ($this->preCheckAffiliateNewInstitute()) {
			
			if (($l_c_af_id = $this->admin_model->affiliate_new_institute())) {

				$this->session->set_flashdata('success','نئے مدرسے کا الحاق کامیابی سے ھو گیا ہے');
				redirect('admin/viewAllAffliatedInstitues','refresh');

			}else{

				$this->session->set_flashdata('failure','الحاق کامیابی سے نہیں ھو سکا براہے مہربانی دوبارہ کوشیش کریں');
				redirect('admin/viewAllAffliatedInstitues','refresh');
			}

		}else{
			$this->load->view('admin/affiliate-new-institute',$data);
		}
		// echo '<pre>';print_r($data['district_array']);echo '</pre>';
		
	}// end function affiliateNewInstitute

	private function preCheckAffiliateNewInstitute()
	{
		// echo '<pre>';print_r($_POST);echo '</pre>';die();
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already exists.');

		//setting rules
		/*$this->form_validation->set_rules('registration_no', 'Registration No', 'required|callback_instituteno_check');*/
		$this->form_validation->set_rules('registration_no', 'Registration No', 'required');
		$this->form_validation->set_rules('affiliation_grade', 'Grade', 'required');
		$this->form_validation->set_rules('institute_full_name', 'Fullname', 'required');
		$this->form_validation->set_rules('institute_short_name', 'Short Name', 'required');
		$this->form_validation->set_rules('institute_province', 'Province', 'required');
		$this->form_validation->set_rules('institute_district', 'District', 'required');
		$this->form_validation->set_rules('institute_address', 'Address', 'required');
		$this->form_validation->set_rules('institute_phone_no', 'Phone No', 'required');
		$this->form_validation->set_rules('institute_mobile_no', 'Mobile No', 'required');
		$this->form_validation->set_rules('date_of_affiliation', 'Date of Affiliation', 'required');
		$this->form_validation->set_rules('institute_affiliation_from', 'Affiliation from', 'required');
		$this->form_validation->set_rules('institute_affiliation_to', 'Affiliation to', 'required');
		
		// if rules fulfilled
		
		if ($this->form_validation->run() === FALSE){
			
			return false;
			
		}else{
			
			return true;	
			
		}

	}// end function preCheckAffiliateNewInstitute

	public function viewAllProvinces()
	{
		$data['title'] = "View All Provinces";
		$data['province_array'] = $this->admin_model->get_all_provinces();
		$this->load->view('admin/view-all-province',$data);

	}// end function viewAllaProvinces

	public function addProvince()
	{

		$data['title'] = "Add New Province";
		if ($this->preCheckAddProvince()) {

			if ($this->admin_model->add_province()) {

				$this->session->set_flashdata('success','Province added successfully');
				redirect('admin/viewAllProvinces');
			
			}else{
				$this->session->set_flashdata('failure','Unable to add province');
				redirect('admin/viewAllProvinces');
			}
		}else{

			$this->load->view('admin/add-province',$data);
		}
	
	}// end function addProvince

	private function preCheckAddProvince()
	{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');
		//setting rules
		$this->form_validation->set_rules('prov_name_urdu', 'Urdu Name', 'required');
		$this->form_validation->set_rules('prov_nane_eng', 'English Name', 'alpha');
		
		// if rules fulfilled
		
		if ($this->form_validation->run() === FALSE){

			return false;
			
		}else{
			
			return true;	
			
		}

	}// end function preCheckAddProvince

	public function editProvince($prov_id ='')
	{
		if (empty($prov_id)) {
			$this->session->set_flashdata('failure','No province selected to alter');
			redirect('admin/viewAllProvinces');
		}
		$data['title'] = "Edit Province";
		$data['province_info'] = $this->admin_model->get_single_province_info($prov_id);

		if ($this->preCheckEditProvince()) {

			if ($this->admin_model->update_province($prov_id)) {

				$this->session->set_flashdata('success','Province updated successfully');
				redirect('admin/viewAllProvinces');

			}else{

				$this->session->set_flashdata('failure','Unable to update province');
				redirect('admin/viewAllProvinces');
			}

		}else{
			$this->load->view('admin/edit-province',$data);
		}

	}// end function editProvince

	private function preCheckEditProvince()
	{
		// echo '<pre>';print_r($_POST);echo '</pre>';die();
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');

		//setting rules
		$this->form_validation->set_rules('prov_name_urdu', 'Urdu Name', 'required');
		$this->form_validation->set_rules('prov_name_eng', 'English Name', 'alpha');
		
		// if rules fulfilled
		
		if ($this->form_validation->run() === FALSE){
			
			return false;
			
		}else{
			
			return true;	
			
		}
	
	}// end function preCheckEditProvince

	public function ViewAllDistricts()
	{
		$data['title'] = "View All Cities";
		$data['district_array'] = $this->admin_model->get_all_districts_for_view();
		$this->load->view('admin/view-all-districts',$data);

	}// end function ViewAllDistricts

	public function viewDistrict($d_id ='')
	{
		$this->login_check();

		if (empty($d_id)) {
			$this->session->set_flashdata('failure','No class was selected to view');
			redirect('admin/ViewAllDistricts');
		}
		$data['title'] = "Class Information";
		$data['district_info'] = $this->admin_model->get_single_district_info_id($d_id);
		$this->load->view('admin/view-district',$data);
	
	}// end function viewCity

	public function addDistrict()
	{
		$data['title'] = "Add New District";
		$data['province_array'] = $this->admin_model->get_all_provinces();

		if ($this->preCheckAddDistrict()) {

			if ( ($lc_c_id = $this->admin_model->add_district()) != NULL) {
				$this->session->set_flashdata('success','City added successfully');
				redirect('admin/ViewAllDistricts');	
			}else{
				$this->session->set_flashdata('failure','Unable to add city');
				redirect('admin/ViewAllDistricts');
			}

		}else{

			$this->load->view('admin/add-district',$data);

		}

	}// end function addDistrict

	private function preCheckAddDistrict()
	{
		// echo '<pre>';print_r($_POST);echo '</pre>';die();
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');

		//setting rules
		$this->form_validation->set_rules('district_name_urdu', 'Urdu Name', 'required');
		// $this->form_validation->set_rules('class_name_eng', 'English Name', 'required');
		$this->form_validation->set_rules('district_province', 'District Province', 'required');
		
		// if rules fulfilled
		
		if ($this->form_validation->run() === FALSE){
			
			return false;
			
		}else{
			
			return true;	
			
		}
	
	}// end function preCheckeditDistrict

	public function editDistrict($d_id ='')
	{
		$this->login_check();

		if (empty($d_id)) {
			$this->session->set_flashdata('failure','No city was selected for modification');
			redirect('admin/viewAllClasses');
		}
		$data['title'] = "City Information";
		$data['district_info'] = $this->admin_model->get_single_district_info_id($d_id);
		$data['province_array'] = $this->admin_model->get_all_provinces();

		if ($this->preCheckeditDistrict()) {
			
			if ($this->admin_model->update_district($d_id)) {

				$this->session->set_flashdata('success', 'City update successfull.');
				redirect('admin/ViewAllDistricts');

			}else{
				$this->session->set_flashdata('error', 'Unable to update city.');
				redirect('admin/ViewAllDistricts');
			}

		}else{

			$this->load->view('admin/edit-district',$data);

		}
	
	}// end function editDistrict

	private function preCheckeditDistrict()
	{
		// echo '<pre>';print_r($_POST);echo '</pre>';die();
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');

		//setting rules
		$this->form_validation->set_rules('district_name_urdu', 'Urdu Name', 'required');
		// $this->form_validation->set_rules('district_name_eng', 'English Name', 'required');
		$this->form_validation->set_rules('district_province', 'District Province', 'required');
		
		// if rules fulfilled
		
		if ($this->form_validation->run() === FALSE){
			
			return false;
			
		}else{
			
			return true;	
			
		}
	
	}// end function preCheckeditDistrict

	public function deleteDistrict($d_id ='')
	{
		$this->login_check();

		if (empty($d_id)) {
			$this->session->set_flashdata('failure','No city was selected for modification');
			redirect('admin/ViewAllDistricts');
		}
		if ($this->admin_model->delete_city($d_id)) {
			
			$this->session->set_flashdata('success','City deleted successfully');
			redirect('admin/ViewAllDistricts');
		
		}else{

			$this->session->set_flashdata('failure','Unable to delete city');
			redirect('admin/ViewAllDistricts');

		}// end if for deleting city

	}// end function delete_city

	public function viewAllExaminationCenters()
	{
		$data['title'] = "View all examination centers";
		$data['examinaiton_center_array'] = $this->admin_model->get_all_examination_center_info();
		$this->load->view('admin/view-all-examination-centers',$data);
		// $this->admin_model->updateExaminationCenters();
	
	}// viewAllExaminationCenters

	public function addExaminationCenter()
	{
		$data['title'] = "Add New Examination Center";
		$data['province_array'] = $this->admin_model->get_all_provinces();

		if ($this->preCheckAddExaminationCenter()) {

			if (($data = $this->admin_model->add_examination_center()) != NULL) {
				$this->session->set_flashdata('success','Examination center added successfully');
				redirect('admin/viewAllExaminationCenters');
			}else{
				$this->session->set_flashdata('failure','Unable to add examination center');
				redirect('admin/viewAllExaminationCenters');
			}

		}else{

			$this->load->view('admin/add-examination-center',$data);

		}

	}// end function addExaminationCenter

	private function preCheckAddExaminationCenter()
	{
		// echo '<pre>';print_r($_POST);echo '</pre>';die();
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');

		//setting rules
		$this->form_validation->set_rules('exam_center_name_urdu', 'Center Urdu Name', 'required');
		$this->form_validation->set_rules('exam_province', 'Center Province', 'required');
		// $this->form_validation->set_rules('exam_center_name_eng', 'English Name', 'required');
		$this->form_validation->set_rules('exam_center_district', 'Center City', 'required');
		$this->form_validation->set_rules('exam_center_address', 'Center City', 'required');

		
		// if rules fulfilled
		
		if ($this->form_validation->run() === FALSE){
			
			return false;
			
		}else{
			
			return true;	
			
		}

	}// end function preCheckAddExaminationCenter

	public function viewExaminationCenter($eci_id ='')
	{
		if (empty($eci_id)) {
			$this->session->set_flashdata('failure','No Examination Center Selected');
			redirect('admin/viewAllExaminationCenters');
		}
		$data['title'] = "View Examination Information";
		$data['examination_center_info'] = $this->admin_model->get_examination_center_info($eci_id);
		$this->load->view('admin/view-examination-center',$data);

	}// end function viewExaminationCenter

	public function editExaminationCenter($eci_id='')
	{
		if (empty($eci_id)) {
			$this->session->set_flashdata('failure','No Examination Center Selected');
			redirect('admin/viewAllExaminationCenters');
		}
		$data['title'] = "View Examination Information";
		$data['examination_center_info'] = $this->admin_model->get_examination_center_info($eci_id);
		$data['province_array'] = $this->admin_model->get_all_provinces();
		$data['district_array'] = $this->admin_model->get_all_districts_for_view();

		if ($this->preCheckEditExaminationCenter()) {

			if ($this->admin_model->update_examination_center($eci_id)) {
			
				$this->session->set_flashdata('success','Examination Center updated successfully');
				redirect('admin/viewAllExaminationCenters');
			
			}else{
				$this->session->set_flashdata('failure','Unable to update examination center');
				redirect('admin/viewAllExaminationCenters');
			}
			# code...
		}else{
			$this->load->view('admin/edit-examination-center',$data);
		}
	
	}// end function editExaminationCenter

	private function preCheckEditExaminationCenter()
	{
		// echo '<pre>';print_r($_POST);echo '</pre>';die();
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');

		//setting rules
		$this->form_validation->set_rules('exam_center_name_urdu', 'Center Urdu Name', 'required');
		$this->form_validation->set_rules('exam_province', 'Center Province', 'required');
		// $this->form_validation->set_rules('exam_center_name_eng', 'English Name', 'required');
		$this->form_validation->set_rules('exam_center_district', 'Center City', 'required');
		$this->form_validation->set_rules('exam_center_address', 'Center City', 'required');

		
		// if rules fulfilled
		
		if ($this->form_validation->run() === FALSE){
			
			return false;
			
		}else{
			
			return true;	
			
		}

	}// end function preCheckEditExaminationCenter

	public function deleteExaminationCenter($eci_id ='')
	{
		if (empty($eci_id)) {

			$this->session->set_flashdata('failure','No Examination Center Selected');
			redirect('admin/viewAllExaminationCenters');
		}
		if ($this->admin_model->delete_examination_center($eci_id)) {

			$this->session->set_flashdata('success','Examination Center Deleted Successfully');
			redirect('admin/viewAllExaminationCenters');

		}else{

			$this->session->set_flashdata('failure','Unable to delete examination center');
			redirect('admin/viewAllExaminationCenters');
		}
		
	}// end function deleteExaminationCenter

	public function ViewCitiesByProvince($prov_id = '')
	{
		if (empty($prov_id)) {
			return NULL;
		}
		$data['cities_array'] = $this->admin_model->get_all_districts_by_province($prov_id);
		return $data['cities_array'];

	}// end function ViewCitiesByProvince

	public function getProvinceCitiesAjax()
	{
		$data['cities_array'] = $this->ViewCitiesByProvince($this->input->post('prov_id'));
		// echo $this->input->post('prov_id');
		// echo '<pre>';print_r($data['cities_array']);echo '</pre>';
		echo json_encode(array('cities_array' => $data['cities_array']));

	}// end function ViewCitiesByProvince

	public function validateRegisterationNoAjax()
	{
		$isAllowed = true; // or false
		if($this->instituteno_check($this->input->post('registration_no'))){
			$isAllowed = false;
		}else{
			$isAllowed =  true;
		}
		// Finally, return a JSON
			echo json_encode(array(
			    'valid' => $isAllowed,
			));

	}// end function validateRegisterationNoAjax

	public function validateRegisterationNoAjaxForEditStudent()
	{
		$isAllowed = true; // or false
		if($this->is_institute_no_exists($this->input->post('old_institute_reg_no'))){
			$isAllowed = true;
		}else{
			$isAllowed =  false;
		}
		// Finally, return a JSON
			echo json_encode(array(
			    'valid' => $isAllowed,
			));

	}// end function validateRegisterationNoAjaxForEditStudent

	public function is_institute_no_exists($old_registration_no)
	{
		if ($old_registration_no != '')
		{
			if ($this->admin_model->check_if_registration_no_exits($old_registration_no)) {
				return true;
			}else{
				$this->form_validation->set_message('instituteno_check', 'The %s donot exits in the directory');
				return false;
			}
		}
		else
		{
			return false;
		}

	}// end function is_institute_no_exists

	public function viewAllSubjects()
	{
		$this->login_check();
		$data['title'] =  "تمام مضامیں";
		$data['subject_array'] = $this->admin_model->get_all_subjects();
		// echo '<pre>';print_r($data['subject_array']);echo '</pre>';
		$this->load->view('admin/view-all-subjects',$data);
	
	}// end function viewAllSubjects

	public function addSubject()
	{
		$this->login_check();
		$data['title'] = "میا مضامین داخل کریں";
		$data['class_array'] = $this->admin_model->get_all_classes();

		if ($this->preCheckAddSubject()) {
			
			if (($lc_sub_id = $this->admin_model->add_new_subject())  != NULL) {
				
				$this->session->set_flashdata('success','مضمون کامیابی سے داخل ھو گیا ھے');
				redirect('admin/viewAllSubjects');
			}else{
				$this->session->set_flashdata('failure','مضامین داخل کرنے میں مسلا ھے دوبارہ کوشیش کریں');
				redirect('admin/viewAllSubjects');
			}


		}else{

			$this->load->view('admin/add-subject',$data);
		}

	}// end function addSubject

	private function preCheckAddSubject()
	{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');

		//setting rules
		$this->form_validation->set_rules('sub_name_urdu', 'Subject Name', 'required');
		$this->form_validation->set_rules('total_marks', 'Total Marks', 'required|numeric');
		$this->form_validation->set_rules('class_id', 'Class', 'required');
			
		// if rules fulfilled
		
		if ($this->form_validation->run() === FALSE){
			
			return false;
			
		}else{
			
			return true;	
			
		}

	}// end function preCheckAddSubject

	public function editSubject($subject_id = '')
	{

		$this->login_check();
		if (empty($subject_id)) {
			$this->session->set_flashdata('failure','مضامین کا انتخاب لازمی ھے');
			redirect('admin/viewAllSubjects');
		}
		$data['title'] = "مضامین میں ترمیم";
		$data['class_array'] = $this->admin_model->get_all_classes();
		$data['subject_data'] = $this->admin_model->get_subject_info($subject_id);

		if ($this->preCheckEditSubject()) {
			
			if ( $this->admin_model->update_subject($subject_id) ) {
				$this->session->set_flashdata('success','مضامون کامیابی سے اپڈیٹ ھو گیا ھے');
				redirect('admin/viewAllSubjects');
			}else{
				$this->session->set_flashdata('failure','مضامون کامیابی سے اپڈیٹ نہیں ہو سکا دوبارہ کوشیش کریں');
				redirect('admin/viewAllSubjects');
			}

		}else{

			$this->load->view('admin/edit-subject',$data);
		}
	
	}// end function editSubject

	private function preCheckEditSubject()
	{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		//Setting validation messages
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');

		//setting rules
		$this->form_validation->set_rules('sub_name_urdu', 'Subject Name', 'required');
		$this->form_validation->set_rules('total_marks', 'Total Marks', 'required|numeric');
		$this->form_validation->set_rules('class_id', 'Class', 'required');
			
		// if rules fulfilled
		
		if ($this->form_validation->run() === FALSE){
			
			return false;
			
		}else{
			
			return true;	
			
		}

	}// end function preCheckEditSubject

	public function deleteSubject($subject_id ='')
	{
		if (empty($subject_id)) {
			$this->session->set_flashdata('failure','مضامین کا انتخاب لازمی ھے');
			redirect('admin/viewAllSubjects');
		}
		if ($this->admin_model->delete_subject($subject_id)) {
				$this->session->set_flashdata('success','مضامون کامیابی سے ختم ھو گیا ھے');
				redirect('admin/viewAllSubjects');
		}else{
			$this->session->set_flashdata('failure','مضامون کامیابی سے ختم نہیں ہو سکا دوبارہ کوشیش کریں');
			redirect('admin/viewAllSubjects');
		}	
		
	}// end function deleteSubject

	public function dateSheet()
	{
		$data['title'] = "Exam Datesheet";
		$data['exam_array'] = $this->admin_model->get_all_exams();

		if ($this->preCheckDateSheet()) {
			// echo '<pre>';print_r($_POST);echo '</pre>';
			// die();
			$data['exam_id'] = $this->input->post('exam_id');
			$data['exam_class_grade'] = $this->admin_model->get_exam_class_grade($data['exam_id']);
			$data['exam_info'] = $this->admin_model->get_single_exam_info_id($data['exam_id']);
			$data['date_sheet_info'] = $this->admin_model->get_single_exam_date_sheet_for_edit_by_id($data['exam_id']);
			// echo '<pre>';print_r($data['date_sheet_info']);echo '</pre>';
			if ($data['date_sheet_info'] == NULL) {
				$this->session->set_flashdata('failure','امتحان کی ڈیٹ شیٹ موجود نہیں ہے');
	 			redirect('admin/dateSheet','refresh');	
			}
			// echo '<pre>';print_r($_POST);echo '</pre>';
			
			switch ($data['exam_class_grade']) {
				case 'grade0':
				case 'grade1':
					# code...
					break;
				case 'grade2':
				case 'grade3':
				case 'grade4':
				case 'grade5':
				case 'grade6':
						$this->load->view('admin/view-exam-date-sheet',$data);
					break;
				
				default:
					# code...
					break;
			}
		}else{
			
			$this->load->view('admin/add-datesheet',$data);
		
		}
		// echo '<pre>';print_r($data['exam_array']);echo '</pre>';

	}// end function dateSheet

	public function preCheckDateSheet()
	{
	 	$this->form_validation->set_rules('exam_id','Exam','required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}
	 	
	} // end function preCheckDateSheet

	public function viewSixSubjectDateSheet($exam_id ='')
	{
	 	$data['title']	=	"ڈیٹ شیٹ";
	 	$data['date_sheet_info'] = $this->admin_model->get_single_exam_date_sheet_for_edit_by_id($exam_id);
	 	$this->load->view('admin/view-exam-date-sheet',$data);
	 	
	}// end function viewSixSubjectDateSheet

	public function createDateSheet()
	{
		$data['alreadyDateSheetError'] = false;
	 	$data['title']	=	"ڈیٹ شیٹ";
	 	$data['exam_array'] = $this->admin_model->get_all_exams_for_result();

	 	if ($this->preCheckCreateDateSheet()) {

	 		redirect('admin/createDateSheetForExam/'.$this->input->post('exam_id'));

	 	}else{

	 		$data['alreadyDateSheetError'] = ($this->alreadydatefailure == true ? true : false);
	 		$this->load->view('admin/create-date-sheet',$data);
	 	}
	 	
	 	// echo '<pre>';print_r($data['subject_array']);echo '</pre>';

	} // end function preCheckDateSheet

	private function preCheckCreateDateSheet()
	{
		$this->form_validation->set_rules('exam_id','Exam','required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			if ($this->admin_model->checkIfExamDateSheetAlreadyCreated($this->input->post('exam_id'))) {
				$this->alreadydatefailure = true;
				return false;
			}
			return true;
		}

	}// end function preCheckCreateDateSheet

	public function createDateSheetForExam($exam_id ='')
	{
		if (empty($exam_id)) {
	 		$this->session->set_flashdata('failure','امتحان کا انتخاب لازمی ھے');
	 		redirect('admin/createDateSheet');
	 	}

	 	$data['title'] = "ڈیٹ شیٹ";
	 	$data['page_title'] = "مضامین کے حساب سے ڈیٹ شیٹ بنائیں";
	 	$data['exam_id'] = $exam_id;
	 	$data['exam_subjects_info'] = $this->admin_model->get_exam_subjects($exam_id);

	 	if ($this->preCheckCreateDateSheetForExam()) {
	 			
	 			if ($this->admin_model->add_exam_date_sheet($exam_id)) {
	 				$this->session->set_flashdata('success','ڈیٹ شیٹ کامیابی سے داخل ہو گئی ہے');
	 				redirect('admin/createDateSheet');
	 			}else{
	 				$this->session->set_flashdata('failure','دوبارہ کوشیش کریں شکریہ');
	 				redirect('admin/createDateSheet');
	 			}

	 	}else{

	 		$this->load->view('admin/create-exam-date-sheet-form',$data);
	 	}

	}// end function createDateSheetForExam

	private function preCheckCreateDateSheetForExam()
	{
		$this->form_validation->set_rules('subject_id[]', 'Subject', 'required');
		$this->form_validation->set_rules('subject_exam_date[]','Exam Date','required');
		$this->form_validation->set_rules('subject_exam_time[]','Exam Time','');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function preCheckCreateDateSheetForExam

	public function editDateSheet()
	{
		$data['noDateSheetError'] = false;
	 	$data['title']	=	"ڈیٹ شیٹ";
	 	$data['exam_array'] = $this->admin_model->get_all_exams_for_result();

	 	if ($this->preCheckEditDateSheet()) {
	 		// echo '<pre>';print_r($_POST);echo '</pre>';die();
	 		redirect('admin/editDateSheetForExam/'.$this->input->post('exam_id'));

	 	}else{

	 		$data['noDateSheetError'] = ($this->nodatefailure == true ? true : false);
	 		$this->load->view('admin/edit-date-sheet',$data);
	 	}

	}// end function editDateSheetsd

	private function preCheckEditDateSheet()
	{

		$this->form_validation->set_rules('exam_id', 'Exam', 'required');

		if( $this->form_validation->run() === FALSE ){

			return false;
		}else{
			// echo '<pre>';print_r($_POST);echo '</pre>'; die();
			if (!$this->admin_model->checkIfExamDateSheetAlreadyCreated($this->input->post('exam_id'))) {
				// echo 'i am here';die();
				$this->nodatefailure = true;
				return false;
			}
			return true;
		}

	}// end function preCheckEditDateSheet

	public function editDateSheetForExam($exam_id='')
	{
		if (empty($exam_id)) {
	 		$this->session->set_flashdata('failure','امتحان کا انتخاب لازمی ھے');
	 		redirect('admin/editDateSheet');
	 	}

	 	$data['title'] = "ڈیٹ شیٹ";
	 	$data['page_title'] = "مضامین کے حساب سے ڈیٹ شیٹ میں ترمیم کریں";
	 	$data['exam_id'] = $exam_id;
	 	// $data['exam_subjects_info'] = $this->admin_model->get_exam_subjects($exam_id);
	 	$data['date_sheet_info'] = $this->admin_model->get_single_exam_date_sheet_for_edit_by_id($exam_id);
	 	// echo '<pre>';print_r($data['date_sheet_info']);echo '</pre>';
	 	// die();
	 	if ($this->preCheckEditDateSheetForExam()) {
	 			
	 			if ($this->admin_model->update_exam_date_sheet($exam_id)) {

	 				$this->session->set_flashdata('success','ڈیٹ شیٹ کامیابی سے اپ ڈیٹ ہو گئی ہے');
	 				redirect('admin/editDateSheet');

	 			}else{

	 				$this->session->set_flashdata('failure','دوبارہ کوشیش کریں شکریہ');
	 				redirect('admin/editDateSheet');

	 			}

	 	}else{

	 		$this->load->view('admin/edit-exam-date-sheet-form',$data);
	 	}
	
	}// end function editDateSheetForExam

	private function preCheckEditDateSheetForExam()
	{
		$this->form_validation->set_rules('subject_id[]', 'Subject', 'required');
		$this->form_validation->set_rules('subject_exam_date[]','Exam Date','required');
		$this->form_validation->set_rules('subject_exam_time[]','Exam Time','');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function preCheckCreateDateSheetForExam

	public function rollNoSlip()
	{
		$data['title'] = "Exam Rollno Slip";
		$data['exam_array'] = $this->admin_model->get_all_exams();
		$data['examination_center_id'] = $this->admin_model->get_all_examination_center_info();
		// echo '<pre>';print_r($data['exam_array']);echo '</pre>';
		if ($this->preCheckRollNoSlip()) {
			$data['exam_info'] = $this->admin_model->get_single_exam_info_id($this->input->post('exam_id'));
			// echo '<pre>';print_r($data['exam_info']);echo '</pre>';
			// die();
			switch ($data['exam_info'][0]['class_type']) {

				case 'grade0':
					redirect('admin/printHifzulQuran/'.$this->input->post('exam_id').'/'.$data['exam_info'][0]['et_id'].'/'.$this->input->post('exam_center_id'));
					break;
				case 'grade1':
						redirect('admin/printTajweedulQuran/'.$this->input->post('exam_id').'/'.$data['exam_info'][0]['et_id'].'/'.$this->input->post('exam_center_id'));
					break;
				case 'grade2':
				case 'grade3':
						redirect('admin/printSixCourseRollNoSlip/'.$this->input->post('exam_id').'/'.$data['exam_info'][0]['et_id'].'/'.$this->input->post('exam_center_id'));
						// echo 'ان امتحانات پر کاپ جاری ھے';
						break;
				case 'grade4':
					redirect('admin/print10CourseRollNoSlip/'.$this->input->post('exam_id').'/'.$data['exam_info'][0]['et_id'].'/'.$this->input->post('exam_center_id'));
					break;
				case 'grade5':
				case 'grade6':
						echo 'ان امتحانات پر کاپ جاری ھے';
						break;
				default:
					# code...
					break;

			}	// end switch for exam_class_grade

		}else{
			$this->load->view('admin/exam-rollno-slip',$data);
		}

	}// end function rollNoSlip

	private function preCheckRollNoSlip()
	{
		$this->form_validation->set_rules('exam_id','Exam','required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function preCheckRollNoSlip

	public function redirectForRollnoSlip($exam_id)
	{

		if (!empty($exam_id)) {
			$this->session->set_flashdata('failure','امتحان کا انتخاب لازمی ھے');
			redirect('admin/rollNoSlip');
		}

	}// end function redirectForRollnoSlip

	public function examAttendance()
	{
		$data['title'] = "Print attendance sheet";
		$data['exam_array'] = $this->admin_model->get_all_exams();
		$data['examination_center_id'] = $this->admin_model->get_all_examination_center_info();

		// echo '<pre>';print_r($data['examamination_center_id']);echo '</pre>';
		if ($this->preCheckexamAttendance()) {
			// echo '<pre>';print_r($_POST);echo '</pre>';
			$data['exam_info'] = $this->admin_model->get_single_exam_info_id($this->input->post('exam_id'));
			// echo '<pre>';print_r($data['exam_info']);echo '</pre>';
			// die();
			$data['exam_class_grade'] = $this->admin_model->get_exam_class_grade($this->input->post('exam_id'));
			//die();

			switch ($data['exam_class_grade']) {
				case 'grade0':
					redirect('admin/printHifzulQuranAttendanceSheet/'.$this->input->post('exam_id').'/'.$this->input->post('exam_center_id').'/'.$data['exam_info'][0]['et_id']);
					break;
				case 'grade1':
					redirect('admin/printTajweedulQuranAttendanceSheet/'.$this->input->post('exam_id').'/'.$this->input->post('exam_center_id').'/'.$data['exam_info'][0]['et_id']);
					break;
				case 'grade2':
				case 'grade3':
					redirect('admin/printSixCourseAttendanceSheet/'.$this->input->post('exam_id').'/'.$this->input->post('exam_center_id').'/'.$data['exam_info'][0]['et_id']);
					break;
				case 'grade4':
					redirect('admin/print10CourseAttendanceSheet/'.$this->input->post('exam_id').'/'.$this->input->post('exam_center_id').'/'.$data['exam_info'][0]['et_id']);
					break;
				case 'grade5':
				case 'grade6':
						echo 'ان امتحانات پر کاپ جاری ھے';
						break;
				default:
					# code...
					break;

			}	// end switch for exam_class_grade

		}else{

			$this->load->view('admin/exam-attendance-sheet',$data);

		}

	}// end function examAttendance

	private function preCheckexamAttendance()
	{
		$this->form_validation->set_rules('exam_id','Exam','required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function preCheckexamAttendance

	public function printHifzulQuranAttendanceSheet($exam_id ='',$examination_center_id = '')
	{
		$this->login_check();
		if (empty($exam_id)) {
			$this->session->set_flashdata('failure','امتحان کا انتخاب لازمی ھے');
			redirect('admin/examAttendance');
		}

		$data['student_data'] = $this->admin_model->getHifzStudentForAttendanceSheet($exam_id,$examination_center_id);
		// echo '<pre>';print_r($data['student_data']);echo '</pre>';
		// die();
		$this->load->view('admin/print-hifz-attendance-sheet',$data);

	}// end function printHifzulQuranAttendanceSheet

	public function printTajweedulQuranAttendanceSheet($exam_id ='',$examination_center_id = '')
	{
		$this->login_check();
		if (empty($exam_id)) {
			$this->session->set_flashdata('failure','امتحان کا انتخاب لازمی ھے');
			redirect('admin/examAttendance');
		}

		$data['student_data'] = $this->admin_model->getTajweedStudentForAttendanceSheet($exam_id,$examination_center_id);
		// echo '<pre>';print_r($data['student_data']);echo '</pre>';
		// die();
		$this->load->view('admin/print-tajweed-attendance-sheet',$data);

	}// end function printTajweedulQuranAttendanceSheet

	public function printSixCourseAttendanceSheet($exam_id ='',$examination_center_id = '',$exam_type = 1)
	{
		$this->login_check();
		if (empty($exam_id)) {
			$this->session->set_flashdata('failure','امتحان کا انتخاب لازمی ھے');
			redirect('admin/examAttendance');
		}
		$data['exam_type'] =  $exam_type;

		// $data['datesheet_info'] = $this->admin_model->get_single_exam_date_sheet_by_id($exam_id);
		$data['student_data'] = $this->admin_model->getStudentForAttendanceSheet($exam_id,$examination_center_id,$exam_type);
		// echo '<pre>';print_r($data['student_data']);echo '</pre>';
		// die();
		$this->load->view('admin/print-six-course-attendance-sheet',$data);

	}// end function printSixCourseAttendanceSheet

	public function print10CourseAttendanceSheet($exam_id ='',$examination_center_id = '',$exam_type = 1)
	{
		$this->login_check();
		if (empty($exam_id)) {
			$this->session->set_flashdata('failure','امتحان کا انتخاب لازمی ھے');
			redirect('admin/examAttendance');
		}
		$data['exam_type'] = $exam_type;
		$data['student_data'] = $this->admin_model->getStudentForAttendanceSheet($exam_id,$examination_center_id,$exam_type);
		// echo '<pre>';print_r($data['student_data']);echo '</pre>';
		$this->load->view('admin/print-ten-course-attendance-sheet',$data);

	}// end function print10CourseAttendanceSheet

	public function printHifzulQuran($exam_id ='',$exam_type = 1,$examination_center_id = '')
	{
		$data['exam_subject'] = $this->admin_model->get_exam_class_subject($exam_id,$exam_type);
		$data['exam_student_array'] = $this->admin_model->get_all_exam_students($exam_id,$exam_type,$examination_center_id);
		// echo '<pre>';print_r($data['exam_subject']);echo '</pre>';
		$this->load->view('admin/print-rollno-slip-hifz',$data);
	
	}// end function printHifzulQuran

	public function printTajweedulQuran($exam_id ='',$exam_type = 1,$examination_center_id = '')
	{
		$data['exam_subject'] = $this->admin_model->get_exam_class_subject($exam_id,$exam_type);
		$data['exam_student_array'] = $this->admin_model->get_all_exam_students($exam_id,$exam_type,$examination_center_id);
		// echo '<pre>';print_r($data['exam_student_array']);echo '</pre>';
		$this->load->view('admin/print-rollno-slip-tajweed',$data);
	
	}// end function printTajweedulQuran

	public function printSixCourseRollNoSlip($exam_id ='',$exam_type = 1,$examination_center_id = '')
	{
		$data['exam_date_sheet'] = $this->admin_model->get_single_exam_date_sheet_by_id($exam_id,$exam_type,$examination_center_id);
		if ($data['exam_date_sheet'] == NULL) {
			$this->session->set_flashdata('failure','پہلے ڈیٹ شیٹ بنائیں');
			redirect('admin/rollNoSlip');
		}
		$data['exam_subject'] = $this->admin_model->get_exam_class_subject($exam_id,$exam_type);
		// $data['exam_student_array'] = $this->admin_model->get_all_exam_students($exam_id,$exam_type,$examination_center_id);
		$data['exam_student_array'] = $this->admin_model->get_all_exam_students_six_course($exam_id,$exam_type,$examination_center_id);
		/*echo '<pre>';print_r($data['exam_student_array']);echo '</pre>';
		die();*/
		$this->load->view('admin/print-rollno-slip-six-course',$data);
	
	}// end function printSixCourseRollNoSlip

	public function print10CourseRollNoSlip($exam_id ='',$exam_type = 1,$examination_center_id = '')
	{
		$data['exam_subject'] = $this->admin_model->get_exam_class_subject($exam_id,$exam_type);
		/*echo '<pre>';print_r($data['exam_subject']);echo '</pre>';
		die('yoho!');*/
		$data['exam_date_sheet'] = $this->admin_model->get_single_exam_date_sheet_by_id_with_sub_name($exam_id);
		if ($data['exam_date_sheet'] == NULL) {
			$this->session->set_flashdata('failure','پہلے ڈیٹ شیٹ بنائیں');
			redirect('admin/rollNoSlip');
		}
		$data['exam_student_array'] = $this->admin_model->get_all_exam_students_six_course($exam_id,$exam_type,$examination_center_id);

		/*echo '<pre>';print_r($data['exam_student_array']);echo '</pre>';
		die('yoho!');*/

		// $query="SELECT result.*,affiliation.*,student.*,examcenter.*,exam.* FROM result_info AS result 
		// 				RIGHT JOIN affiliation_info AS affiliation ON result.affli_id=affiliation.affli_id
		// 				RIGHT JOIN examcenter_info AS examcenter ON result.examcenter_id=examcenter.examcenter_id
		// 				RIGHT JOIN student_info AS student ON result.stud_id=student.stud_id
		// 				RIGHT JOIN exam_info AS exam ON result.exam_id=exam.exam_id
		// 				WHERE result.exam_id='$exam_id'
		// 				ORDER BY result.stud_rollno ASC";

		$this->load->view('admin/print-rollno-slip-ten-course',$data);
	
	}// end function print10CourseRollNoSlip


	public function print10CourseRollNoSlipold($exam_id ='',$exam_type = 1,$examination_center_id = '')
	{
		$data['exam_subject'] = $this->admin_model->get_exam_class_subject($exam_id,$exam_type);
		$data['exam_date_sheet'] = $this->admin_model->get_single_exam_date_sheet_by_id_with_sub_name($exam_id);
		if ($data['exam_date_sheet'] == NULL) {
			$this->session->set_flashdata('failure','پہلے ڈیٹ شیٹ بنائیں');
			redirect('admin/rollNoSlip');
		}
		$data['exam_student_array'] = $this->admin_model->get_all_exam_students($exam_id,$exam_type,$examination_center_id);

		// echo '<pre>';print_r($data['exam_student_array']);echo '</pre>';
		// die();

		// $query="SELECT result.*,affiliation.*,student.*,examcenter.*,exam.* FROM result_info AS result 
		// 				RIGHT JOIN affiliation_info AS affiliation ON result.affli_id=affiliation.affli_id
		// 				RIGHT JOIN examcenter_info AS examcenter ON result.examcenter_id=examcenter.examcenter_id
		// 				RIGHT JOIN student_info AS student ON result.stud_id=student.stud_id
		// 				RIGHT JOIN exam_info AS exam ON result.exam_id=exam.exam_id
		// 				WHERE result.exam_id='$exam_id'
		// 				ORDER BY result.stud_rollno ASC";

		$this->load->view('admin/print-rollno-slip-ten-course',$data);
	
	}// end function print10CourseRollNoSlipold 13-april-16

	/*public function examAttendance()
	{
		$data['title'] = "Print attendance sheet";
		$data['exam_array'] = $this->admin_model->get_all_exams();
		// echo '<pre>';print_r($data['exam_array']);echo '</pre>';
		if ($this->preCheckexamAttendance()) {

			$data['exam_class_grade'] = $this->admin_model->get_exam_class_grade($this->input->post('exam_id'));
			//die();
			switch ($data['exam_class_grade']) {
				case 'grade0':
					redirect('admin/printHifzulQuranDateSheet/'.$this->input->post('exam_id'));
					break;
				case 'grade1':
				case 'grade2':
				case 'grade3':
					redirect('admin/printSixCourseDateSheet/'.$this->input->post('exam_id'));
					break;
				case 'grade4':
					redirect('admin/print10CourseRollNoSlip/'.$this->input->post('exam_id'));
					break;
				case 'grade5':
				case 'grade6':
						echo 'ان امتحانات پر کاپ جاری ھے';
						break;
				default:
					# code...
					break;

			}	// end switch for exam_class_grade

		}else{
			$this->load->view('admin/exam-attendance-sheet',$data);
		}

	}// end function examAttendance*/

	public function printHifzulQuranDateSheet($exam_id ='')
	{
		$data['exam_student_array'] = $this->admin_model->get_all_exam_students($exam_id);
		//echo '<pre>';print_r($data['exam_student_array']);echo '</pre>';
		
		$this->load->view('admin/print-exam-attendance-sheet',$data);
	
	}// end function printHifzulQuranDateSheet

	public function ghazatDetail()
	{
		$this->login_check();// checking the login status for the current logged in user.	
		$data['title'] = "گزٹ کے لے امتحان کا انتخاب کریں";
		$data['exam_array'] = $this->admin_model->get_all_exams();
		$data['inst_array'] = $this->admin_model->get_affiliated_institutes_info();
		$data['exam_type'] = $this->admin_model->get_exam_type_by_exam_id($this->input->post('exam_id'));
		// die();
		// echo '<pre>';print_r($data['exam_array']);echo '</pre>';
		if ($this->preCheckGhazatDetail() ) {

			$class_type = $this->admin_model->get_exam_class_grade($this->input->post('exam_id'));

			switch ($class_type) {

				case 'grade0':
					redirect('admin/printGhazetForHifzulQuran/'.$this->input->post('exam_id').'/'.$this->input->post('inst_id'));
					break;
				case 'grade1':
					redirect('admin/printGhazetForTajweedulQuran/'.$this->input->post('exam_id').'/'.$this->input->post('inst_id'));
					break;
				case 'grade3':
					redirect('admin/printGhazetForMutawastaTalba/'.$this->input->post('exam_id').'/'.$data['exam_type'].'/'.$this->input->post('exam_gender').'/'.$this->input->post('inst_id'));
					break;
				case 'grade4':
					redirect('admin/printShahadTulSanviaAlAama/'.$this->input->post('exam_id').'/'.$data['exam_type'].'/'.$this->input->post('exam_gender').'/'.$this->input->post('inst_id'));
					break;
				case 'grade5':
					redirect('admin/printShahadTulSanviaAlKhasa/'.$this->input->post('exam_id').'/'.$data['exam_type'].'/'.$this->input->post('exam_gender').'/'.$this->input->post('inst_id'));
					break;
				case 'grade6':
					redirect('admin/printShahadTulAalia/'.$this->input->post('exam_id').'/'.$data['exam_type'].'/'.$this->input->post('exam_gender').'/'.$this->input->post('inst_id'));
					break;
				case 'grade7':
					redirect('admin/printShahadTulAalia/'.$this->input->post('exam_id').'/'.$data['exam_type'].'/'.$this->input->post('exam_gender').'/'.$this->input->post('inst_id'));
					break;
				
				default:
					# code...
					break;

			}// end swtich 

		}else{

			$this->load->view('admin/ghazat-detail',$data);

		}

	}// end function ghazatDetail

	private function preCheckGhazatDetail()
	{
		$this->form_validation->set_rules('exam_id','Exam','required|numeric');
		$this->form_validation->set_rules('exam_gender','Student Type','required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function preCheckGhazatDetail

	public function printGhazetForHifzulQuran($exam_id = '', $inst_id = '')
	{
		if (empty($exam_id)) {

			$this->session->set_flashdata('failure', 'امتحان کا انتخاب لازمی ہے');
			
			redirect('admin/ghazatDetail', 'refresh');
		}

		$data['gazetInfo'] = $this->admin_model->get_gazet_detail($exam_id,$inst_id);
		// echo '<pre>';print_r($data['gazetInfo']);echo '</pre>';
		$this->load->view('admin/print-ghazette-for-hifz-ul-quran',$data);
		// $this->load->view('admin/print-ghazette-for-tajweed-ul-quran',$data);

	}// end function printGhazetForHifzulQuran

	public function printGhazetForTajweedulQuran($exam_id = '' , $inst_id = '')
	{
		if (empty($exam_id)) {

			$this->session->set_flashdata('failure', 'امتحان کا انتخاب لازمی ہے');
			
			redirect('admin/ghazatDetail', 'refresh');
		}

		$data['gazetInfo'] = $this->admin_model->get_gazet_detail($exam_id,$inst_id);

		// echo '<pre>';print_r($data['gazetInfo']);echo '</pre>';
		$this->load->view('admin/print-ghazette-for-tajweed-ul-quran',$data);

	}// end function printGhazetForTajweedulQuran

	public function printGhazetForMutawastaTalba($exam_id,$exam_type = 1, $gender = '', $inst_id = '')
	{
		if (empty($exam_id)) {

			$this->session->set_flashdata('failure', 'امتحان کا انتخاب لازمی ہے');
			
			redirect('admin/ghazatDetail', 'refresh');
		}
		$data['gender'] = $gender;
		$data['exam_type'] = $exam_type;
		$data['exam_subjects'] = $this->admin_model->get_exam_subjects($exam_id);
		$data['gazetInfo'] = $this->admin_model->get_gazet_detail_for_six_or_ten_subjects($exam_id,$exam_type,$inst_id);
		// echo '<pre>';print_r($data['gazetInfo']);echo '</pre>';die();
		$this->load->view('admin/print-ghazette-for-mutawasta-talba',$data);

	}// end function printGhazetForMutawastaTalba

	public function printShahadTulSanviaAlAama($exam_id = '',$exam_type = 1,$exam_gender = '', $inst_id = '')
	{
		if (empty($exam_id)) {

			$this->session->set_flashdata('failure', 'امتحان کا انتخاب لازمی ہے');
			
			redirect('admin/ghazatDetail', 'refresh');
		}

		$data['exam_type'] = $exam_type;
		$data['exam_subjects'] = $this->admin_model->get_exam_subjects($exam_id);
		$data['gazetInfo'] = $this->admin_model->get_gazet_detail_for_six_or_ten_subjects($exam_id,$exam_type,$inst_id);
		// echo '<pre>';print_r($data['gazetInfo']);echo '</pre>';
		// die();
		$this->load->view('admin/print-shahad-tul-sanvia-al-aama-talbat',$data);
		
		/*if ($exam_gender == 'm') {

			$this->load->view('admin/print-shahad-tul-sanvia-al-aama-talbat',$data);
		
		}else{
			// echo 'f';
			$this->load->view('admin/print-shahad-tul-sanvia-al-aama-talbat',$data);
		
		}*/

	}// end function printShahadTulSanviaAlAama

	public function printShahadTulSanviaAlKhasa($exam_id)
	{
		if (empty($exam_id)) {

			$this->session->set_flashdata('failure', 'امتحان کا انتخاب لازمی ہے');
			
			redirect('admin/ghazatDetail', 'refresh');
		}

		$data['gazetInfo'] = $this->admin_model->get_gazet_detail($exam_id);
		// echo '<pre>';print_r($data['gazetInfo']);echo '</pre>';
		$this->load->view('admin/print-shahad-tul-sanvia-al-khasa',$data);

	}// end function printShahadTulSanviaAlKhasa

	public function hifzulQuranExamDateForExaminationCenters()
	{
		$this->login_check();
		$data['title'] = "حفظ القران ڈیٹ شیٹ";
		$data['exam_center_array']	=	$this->admin_model->get_all_examination_center_info();
		//echo '<pre>';print_r($data['exam_center_array']);echo '</pre>';
		$this->load->view('admin/view-date-for-hifz-ul-quran',$data);

	}// end functin hifzulQuranExamDateForExaminationCenters

	public function editDateSheetHifzQuran($exam_center_id ='')
	{	
		$this->login_check();
		if (empty($exam_center_id)) {
			$this->session->set_flashdata('failure','مرکز کا انتخاب لازمی ھے');
			redirect('admin/hifzulQuranExamDateForExaminationCenters');
		}
		$data['title'] = "حفظ اقران ڈیٹ شیٹ امڈیٹ کریں";
		$data['exam_data'] = $this->admin_model->get_examination_center_info($exam_center_id);
		// $data['exam_date_info'] = $this->admin_model->get_exam_date_info_for_hifz_quran($echq_id);
		// echo '<pre>';print_r($data['exam_data']);echo '</pre>';
		if ($this->preCheckEditDateSheetHifzQuran()) {
			
			if ($this->admin_model->update_hifz_exam_date_for_examination_center($exam_center_id)) {
				
				$this->session->set_flashdata('success','تاریخ کامیابی سے داخل کر دی گئی ھے');
				redirect('admin/hifzulQuranExamDateForExaminationCenters');

			}else{

				$this->session->set_flashdata('faiure','تاریخ کامیابی سے داخل نہیں ھو سکی دوبارہ کوشیش کریں');
				redirect('admin/hifzulQuranExamDateForExaminationCenters');

			}

		}else{
			$this->load->view('admin/edit-date-for-hifz-quran',$data);
		}

	}// end function editDateSheetHifzQuran

	private function preCheckEditDateSheetHifzQuran($value='')
	{
		$this->login_check();
		$this->form_validation->set_rules('hifzulquran_exam_date','Exam Date','required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function preCheckEditDateSheetHifzQuran

	public function tajweedulQuranExamDateForExaminationCenters()
	{
		$this->login_check();
		$data['title'] = "تجوید القران ڈیٹ شیٹ";
		$data['exam_center_array']	=	$this->admin_model->get_all_examination_center_info();
		//echo '<pre>';print_r($data['exam_center_array']);echo '</pre>';
		$this->load->view('admin/view-date-for-tajweed-ul-quran',$data);

	}// end functin tajweedulQuranExamDateForExaminationCenters

	public function editDateSheetTajweedUlQuran($exam_center_id ='')
	{	
		$this->login_check();
		if (empty($exam_center_id)) {
			$this->session->set_flashdata('failure','مرکز کا انتخاب لازمی ھے');
			redirect('admin/tajweedulQuranExamDateForExaminationCenters');
		}
		$data['title'] = "تجوید اقران ڈیٹ شیٹ امڈیٹ کریں";
		$data['exam_data'] = $this->admin_model->get_examination_center_info($exam_center_id);
		// $data['exam_date_info'] = $this->admin_model->get_exam_date_info_for_hifz_quran($echq_id);
		// echo '<pre>';print_r($data['exam_data']);echo '</pre>';
		if ($this->preCheckEditDateSheetTajweedUlQuran()) {
			
			if ($this->admin_model->update_tajweed_exam_date_for_examination_center($exam_center_id)) {
				
				$this->session->set_flashdata('success','تاریخ کامیابی سے داخل کر دی گئی ھے');
				redirect('admin/tajweedulQuranExamDateForExaminationCenters');

			}else{

				$this->session->set_flashdata('faiure','تاریخ کامیابی سے داخل نہیں ھو سکی دوبارہ کوشیش کریں');
				redirect('admin/tajweedulQuranExamDateForExaminationCenters');

			}

		}else{
			$this->load->view('admin/edit-date-for-tajweed-ul-quran',$data);
		}

	}// end function editDateSheetTajweedUlQuran

	private function preCheckEditDateSheetTajweedUlQuran()
	{
		$this->login_check();
		$this->form_validation->set_rules('tajweedulquran_exam_date','Exam Date','required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function preCheckEditDateSheetTajweedUlQuran

	public function printResultCard()
	{
		/*echo '<pre>';print_r($_POST);echo '</pre>';
		die('HERE');*/
		$this->login_check();
		$data['title'] = 'رزلٹ کارڈ پرنٹ کریں';
		$data['exams_array'] = $this->admin_model->get_all_exams_for_result();
		$data['affiliated_institutes_array'] = $this->admin_model->get_affiliated_institutes_info();
		if ($this->preCheckPrintResultCard() ) {

				
			$class_type = $this->admin_model->get_exam_class_grade($this->input->post('exam_id'));//die();
			$exam_type = $this->admin_model->get_exam_type_by_exam_id($this->input->post('exam_id'));//die();
			switch ($class_type) {

				case 'grade3':
					// this is for mutawasta talba || Mutawasta (Talbat)
					$user_data['result_card_detail'] = @$_POST;
					$this->session->set_userdata( $user_data );
					redirect('admin/printResultCardForMutawastaTalba/'.$this->input->post('exam_id').'/'.$exam_type);
					break;
				case 'grade4':
					// this is for Shahad-Tul Sanvia Aama (Talba) || Shahad-Tul Sanvia Aama (Talbat)
					$user_data['result_card_detail'] = @$_POST;
					$this->session->set_userdata( $user_data );
					redirect('admin/printResultCardForTenSubjects/'.$this->input->post('exam_id').'/'.$exam_type);
					break;
				case 'grade5':
					$user_data['result_card_detail'] = @$_POST;
					$this->session->set_userdata( $user_data );
					redirect('admin/printResultCardForMutawastaTalba/'.$this->input->post('exam_id').'/'.$exam_type);
					break;
				case 'grade6':
					$user_data['result_card_detail'] = @$_POST;
					$this->session->set_userdata( $user_data );
					redirect('admin/printResultCardForMutawastaTalba/'.$this->input->post('exam_id').'/'.$exam_type);
					break;
				case 'grade7':
					$user_data['result_card_detail'] = @$_POST;
					$this->session->set_userdata( $user_data );
					redirect('admin/printResultCardForMutawastaTalba/'.$this->input->post('exam_id').'/'.$exam_type);
					break;
				
				default:
					# code...
					break;

			}// end swtich 

		}else{

			$this->load->view('admin/print-result-card',$data);

		}

	}// end function printResultCard

	private function preCheckPrintResultCard()
	{
		// echo '<pre>';print_r($_POST);echo '</pre>';
		$this->form_validation->set_rules('result_date','Date of Result','required');
		$this->form_validation->set_rules('hijri_year','Hijri Year','required');
		$this->form_validation->set_rules('date_of_exam','Exam Month','required');
		$this->form_validation->set_rules('exam_id','Exam','required|numeric');
		$this->form_validation->set_rules('student_reg','Registration No','numeric');
		$this->form_validation->set_rules('student_roll_no','Roll No','numeric');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function preCheckPrintResultCard

	public function printResultCardForMutawastaTalba($exam_id ='',$exam_type = 1)
	{
		$data['title'] = "رزلٹ کارڈ متوسطہ طلبہ";
		// Array
		// 	(
		// 	    [result_date] => 2015
		// 	    [hijri_year] => 1436
		// 	    [date_of_exam] => Ø±Ø¬Ø¨
		// 	    [exam_id] => 9
		// 	    [affliated_inst_id] => 1
		// 	    [student_reg] => 
		// 	    [student_roll_no] => 
			// )
		$result_detail 			= $this->session->userdata('result_card_detail');
		/*echo '<pre>';print_r($result_detail);echo '</pre>';*/
		$data['result_date'] 	= $result_detail['result_date'];
		$data['hijri_year'] 	= $result_detail['hijri_year'];
		$data['date_of_exam'] 	= $result_detail['date_of_exam'];
		$data['exam_type'] 		= $exam_type;

		$data['result_card_info'] = $this->admin_model->get_all_student_result_card_info($exam_id,$result_detail['affliated_inst_id'],
																					  $result_detail['student_reg'],$result_detail['student_roll_no'],$exam_type );
		
		$this->load->view('admin/print-result-card-six-subjects',$data);
		// echo '<pre>';print_r($data['result_card_info']);echo '</pre>';

	}// end function printResultCardForMutawastaTalba

	public function printResultCardForTenSubjects($exam_id ='',$exam_type = 1)
	{
		$data['title'] = "رزلٹ کارڈ";
		// Array
		// 	(
		// 	    [result_date] => 2015
		// 	    [hijri_year] => 1436
		// 	    [date_of_exam] => Ø±Ø¬Ø¨
		// 	    [exam_id] => 9
		// 	    [affliated_inst_id] => 1
		// 	    [student_reg] => 
		// 	    [student_roll_no] => 
			// )
		$result_detail = $this->session->userdata('result_card_detail');
		$data['result_date'] = $result_detail['result_date'];
		$data['hijri_year'] = $result_detail['hijri_year'];
		$data['date_of_exam'] = $result_detail['date_of_exam'];
		$data['exam_type'] = $exam_type;

		$data['result_card_info'] = $this->admin_model->get_all_student_result_card_info($exam_id,$result_detail['affliated_inst_id'],
																					  $result_detail['student_reg'],$result_detail['student_roll_no'],$exam_type);
		// echo '<pre>';print_r($data['result_card_info']);echo '</pre>';die();
		
		$this->load->view('admin/print-result-card-ten-subjects',$data);

	}// end function printResultCardForTenSubjects

	public function degreeForm()
	{
		$this->login_check();
		$data['title'] = 'رزلٹ کارڈ پرنٹ کریں';
		$data['exams_array'] = $this->admin_model->get_all_exams();
		// $data['affiliated_institutes_array'] = $this->admin_model->get_affiliated_institutes_info();
		// echo '<pre>';print_r($data['exams_array']);echo '</pre>';

		if ($this->preCheckDegreeForm()) {

			$user_data['degree_detail'] = @$_POST;
			$user_data['degree_detail']['exam_type'] = $this->admin_model->get_exam_type_by_exam_id($this->input->post('exam_id'));
			// echo '<pre>';print_r($user_data['degree_detail']);echo '</pre>';
			// die();
			$this->session->set_userdata( $user_data );

			redirect('admin/printDegree');

		}else{

			$this->load->view('admin/print-degree',$data);

		}

	}// end function degreeForm

	private function preCheckDegreeForm()
	{
		$this->form_validation->set_rules('degree_date_dominic','Hijri Date','required');
		$this->form_validation->set_rules('degree_date_english','English Date','required');
		$this->form_validation->set_rules('exam_id','Exam','required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function preCheckPrintDegree

	public function printDegree()
	{
		$degree_detail = $this->session->userdata('degree_detail');
		/*echo '<pre>';print_r($degree_detail);echo '</pre>';
		die();*/
		if (empty($degree_detail) ) {
			$this->session->set_flashdata('failure','دوبارہ کوشیش کریں شکریہ');
			redirect('admin/degreeForm');
		}
		$data['degree_date_dominic'] = $degree_detail['degree_date_dominic'];
		$data['degree_date_english'] = $degree_detail['degree_date_english'];
		// echo 'exam id: '.$degree_detail['exam_id'];
		$exam_class_grade = $this->admin_model->get_exam_class_grade($degree_detail['exam_id']);
		$data['student_record'] = $this->admin_model->get_exam_students_for_degree_print($degree_detail['exam_id'],$degree_detail['exam_type'],$exam_class_grade);
		/*echo '<pre>';print_r($data['student_record']);echo '</pre>';
		die('i am here');*/
		$data['exam_class_grade'] =  $exam_class_grade;
		$this->load->view('admin/print-degree-for-single-subject',$data);
	
	}// end function printDegree

	public function marksWithSubject()
	{
		$this->login_check();

		$data['title'] = "Marks according to subject";
		$data['exams_array'] = $this->admin_model->get_all_exams();

		if ($this->preCheckMarksWithSubject()) {
			
			redirect('admin/addExamSubjectMarks/'.$this->input->post('exam_id').'/'.$this->input->post('subject_id'));

		}else{
			
			$this->load->view('admin/marks-with-subjects',$data);
		}
		// echo '<pre>';print_r($data['exams_array']);echo '</pre>';

	}// end function marksWithSubject

	private function preCheckMarksWithSubject()
	{
		$this->form_validation->set_rules('exam_id','Exam','required|numeric');
		$this->form_validation->set_rules('subject_id','Subject','required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function preCheckMarksWithSubject

	public function addExamSubjectMarks($exam_id ='', $subject_id = '',$offset = NULL)
	{
		/*echo $this->config->item('per_page');
		echo '<pre>';print_r($exam_id);echo '</pre>';
		echo '<pre>';print_r($subject_id);echo '</pre>';
		echo '<pre>';print_r($offset);echo '</pre>';
		die('yoho!');*/
		$this->login_check();
		if (empty($exam_id)) {
			$this->session->set_flashdata('failure','امتحان کا انتخاب لازمی ھے');
			redirect('admin/viewStudentsByExam');
		}

		$data['title'] = "Subject's Record";
		$data['exam_id'] = $exam_id;
		$data['subject_id'] = $subject_id;
		$data['sub_name'] = $this->admin_model->get_subject_name_by_id($subject_id);
		$data['exam_info'] = $this->admin_model->get_single_exam_info_id($exam_id);
		$config['base_url']   = base_url().'admin/addExamSubjectMarks/'.$exam_id.'/'.$subject_id;
		$config['total_rows'] = $this->admin_model->get_student_record_rows($exam_id);
		$data['students_info'] = $this->admin_model->get_all_students_with_subject_by_exam($exam_id,$subject_id,$this->config->item('per_page'),$offset);
		$this->load->library('pagination');
		$config['uri_segment'] = 5;
		$config['per_page'] = $this->config->item('per_page');
		// print_r($config);
		$this->pagination->initialize($config);
		$data['page_offset'] = $offset;

		if ($this->preCheckAddExamSubjectMarks()) {
			/*echo '<pre>';print_r($_POST);echo '</pre>';
			die('yoho!');*/
			// redirect('admin/addExamSubjectMarks/'.$exam_id.'/'.$subject_id);
			if ($this->admin_model->update_student_exam_subject_marks($exam_id,$subject_id)) {

				// echo '<pre>';print_r($_POST);echo '</pre>';

				if( ($_POST['page_offset'] + $this->config->item('per_page') )> $config['total_rows'] )
				{
					$this->session->set_flashdata('success','تمام رزلٹ کامیابی سے اپڈیٹ ہو گیا ھے');
					redirect('admin/addExamSubjectMarks/'.$exam_id.'/'.$subject_id);
				}

				if($_POST['page_offset'] != NULL ){

					$nextPage = $this->config->item('per_page') + $_POST['page_offset'];	

				}else{
					
					$nextPage = $this->config->item('per_page');	
					
					
				}
				
				// echo $nextPage;die();

				$this->session->set_flashdata('success','رزلٹ کامیابی سے اپڈیٹ ہو گیا ھے');
				redirect('admin/addExamSubjectMarks/'.$exam_id.'/'.$subject_id.'/'.$nextPage);
				// redirect('admin/addExamSubjectMarks/'.$exam_id.'/'.$subject_id);

			}else{
				$this->session->set_flashdata('failure','رزلٹ اپڈیٹ نہیں ہو سکا');
				redirect('admin/addExamSubjectMarks/'.$exam_id.'/'.$subject_id);
			}

		}else{
			// echo '<pre>';print_r($data['students_info']);echo '</pre>';
			$this->load->view('admin/add-exam-subject-marks',$data);
		}

	}// end function addExamSubjectMarks

	public function preCheckAddExamSubjectMarks()
	{
		// echo '<pre>';print_r($_POST);echo '</pre>';
		if (isset($_POST) and $_POST != NULL) {
		 	return true;
		 }
		// if (isset($_POST)){
			
		// 	return true;
		// }
		// return true;
		// $this->form_validation->set_rules('subject_id[]','Subject','required');
		// $this->form_validation->set_rules('std_id[]','Student','required|numeric');
		// $this->form_validation->set_rules('obtained_marks[]','Marks','');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function preCheckAddExamSubjectMarks

	public function get_exam_subjects_ajax()
	{
			$data['subjects_array'] = $this->admin_model->get_exam_subjects_by_exam_id($this->input->post('exam_id'));
			echo $data['subjects_array'];

	}// end function get_exam_subjects_ajax

	public function passAndFailStudentPercentage()
	{
			
		$data['title'] = "Percentage of pass and failure of students";
		$data['exam_info'] = $this->admin_model->get_all_exams();
		if ($this->preCheckPassFailPercentage()) {

			$data['percentage_response'] = $this->admin_model->get_exam_students_record($this->input->post('exam_id'));
			
			// echo '<pre>';print_r($data['percentage_response']);echo '</pre>';	
			// die();
			// redirect('admin/printPassFailPercentage');
			$this->load->view('admin/print-pass-fail-percentage',$data);

		}else{

			$this->load->view('admin/pass-and-fail-student',$data);

		}
		
	}// end function passAndFailStudentPercentage

	private function preCheckPassFailPercentage()
	{
		$this->form_validation->set_rules('exam_id','Exam','required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function preCheckPassFailPercentage

	public function viewPositionsByExam()
	{
		$data['title'] = "View Positions by exam";
		$data['exam_info'] = $this->admin_model->get_all_exams();
		if ($this->preCheckPassFailPercentage()) {
			$data['exam_info'] = $this->admin_model->get_single_exam_info_id($this->input->post('exam_id'));
			$data['exam_grade'] = $this->admin_model->get_exam_class_grade($this->input->post('exam_id'));
			$data['position_response'] = $this->admin_model->get_exam_students_positions($this->input->post('exam_id'));
			// echo '<pre>';print_r($data['position_response']);echo '</pre>';	
			// die();
			// redirect('admin/printPassFailPercentage');
			$this->load->view('admin/print-exam-positions',$data);

		}else{

			$this->load->view('admin/exam-positions',$data);

		}
	
	}// end function viewPositionsByExam

	private function preCheckViewPositionsByExam()
	{
		$this->form_validation->set_rules('exam_id','Exam','required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function preCheckPassFailPercentage

	public function manageOldStudents()
	{
		$data['title'] = "View Positions by exam";
		$data['exams_array'] = $this->admin_model->get_all_exams();

		if ($this->preCheckmanageOldStudents()) {

			if ($this->admin_model->validate_if_exam_allowed()) {
				
				if ( ($response = $this->admin_model->checkIfstudentRecordExistsInExam($this->input->post('exam_id'),
																$this->input->post('student_registration_num'),
																$this->input->post('student_from_category'))) == NULL) {
					
					if ( ($data = $this->admin_model->checkIfstudentIsAllowedToRepeat($this->input->post('student_registration_num'))) != NULL) {
						/*var_dump($data);
						die('Yoho!');*/
						$data['posted_data'] = @$_POST;
						$user_data['student_record'] = @$data;
						$this->session->set_userdata($user_data);
						redirect('admin/manageOldStudentForm/'.$this->input->post('exam_id'),'refresh');
						
					}else{
						// $this->session->set_flashdata('failure', 'ھم معاذرت خواہ ہیں طالب علم دوبارہ امتحان نہیں دے سکتا.');
						$this->session->set_flashdata('failure', 'بہترتقدیرمیں کا میا بی کے لیے امتحان دیا جا سکتا ہے.');
						redirect('admin/manageOldStudents','refresh');
					}
					
				}else{
					$this->session->set_flashdata('failure', 'رجشٹریشن نمبر پہلے ہی اس کلاس میں موجود ہے.');
					redirect('admin/manageOldStudents','refresh');
				}
			}else{
				$this->session->set_flashdata('failure', 'یہ امتحان اس کلاس کا نہیں ہے-درست امتحان کا انتخاب کریں-.');
				redirect('admin/manageOldStudents','refresh');
			}
		}else{

			$this->load->view('admin/manage-old-students',$data);

		}

		// var_dump($data['exam_info']);

	}// end function manageOldStudents

	private function preCheckmanageOldStudents()
	{

		$this->form_validation->set_rules('exam_id','Exam','required|numeric');
		$this->form_validation->set_rules('student_registration_num','Registration No','required|numeric');
		$this->form_validation->set_rules('course_grade','Course','required');
		$this->form_validation->set_rules('student_from_category','From','required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if( $this->form_validation->run() === FALSE ){
			return false;
		}else{
			return true;
		}

	}// end function preCheckmanageOldStudents

	public function manageOldStudentForm($exam_id = '')
	{
		if (empty($exam_id)) {
			$this->session->set_flashdata('failure', 'امتحان کا انتخاب لازمی ہے.');
			redirect('admin/manageOldStudents','refresh');
		}
		$data['title'] = "Re-appear registration form";
		$data['exam_info'] = $this->admin_model->get_single_exam_info_id($exam_id);
		$data['examination_center_info'] = $this->admin_model->get_all_examination_center_info();
		$data['student_record'] = $this->session->userdata('student_record');
		$data['new_roll_no'] = $this->admin_model->get_new_roll_no($exam_id,$data['exam_info'][0]['class_id']);
		// echo '<pre>';print_r($data['student_record']);echo '</pre>';
		// echo '<pre>';print_r($_POST);echo '</pre>';
			// die('Yoho!');
		if ($this->input->post('student_coming_from')) {
			
			if ($this->admin_model->add_new_supplementary_student($data['student_record'])) {
				
				$this->session->set_flashdata('success', 'طالب علم کامیابی سے ضمنی امتحان میں داخل کر دیا گیا ہے.');
				redirect('admin/manageOldStudents','refresh');

			}else{
				$this->session->set_flashdata('success', 'براہے مہربانی دوبارہ کوشیش کریں.');
				redirect('admin/manageOldStudents','refresh');
			}
			
		}else{

		$this->load->view('admin/manage-old-student-form',$data);

		}
	
	}// end function manageOldStudentForm

	public function checkStudentRegisterationNoExistsAjax()
	{
		$isAllowed = false; // or true
		if($this->checkIfStudentRegistrationNoExists($this->input->post('student_registration_num'))){
			$isAllowed = true;
		}
		// Finally, return a JSON
			echo json_encode(array(
			    'valid' => $isAllowed,
			));

	}// end function checkStudentRegisterationNoExistsAjax

	private function checkIfStudentRegistrationNoExists($std_reg_no ='')
	{
		if ($std_reg_no != '')
		{
			if ($this->admin_model->checkIfStudentRegistrationNoExists($std_reg_no)) {
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return TRUE;
		}

	}// end function checkIfStudentRegistrationNoExists


	public function updateUserRegistrationNo()
	{
		$student_record = $this->admin_model->returnStudentsForRegistrationUpdate();
		echo '<pre>';print_r($student_record);echo '</pre>';
		die();
		/*$registration_no = 143700000;
		foreach ($student_record as $key => $std) {
			echo "Student ID : ".$std['std_id']." Registration No: ".$std['std_reg_no']. " Roll No: ".$std['std_roll_no']."<br/><br/>";
			die();
			if ($this->admin_model->updateUserResgistrationNo($std['std_id'],$registration_no,$std['std_reg_no'],$std['std_roll_no'])) {
				echo "Done With This Information:<br/>Student ID : ".$std['std_id']." Registration No: ".$std['std_reg_no']. " Roll No: ".$std['std_roll_no']."<br/><br/>";
			}else{
				echo 'unable to update and the information is given below:<br/>';
				echo "Student ID : ".$std['std_id']." Registration No: ".$std['std_reg_no']. " Roll No: ".$std['std_roll_no']."<br/><br/>";
				die();
			}
			$registration_no++;
		}
		echo "<br/><br/>All done with success<br/><br/>";
		echo '<pre>';print_r($student_record);echo '</pre>';*/

	}// end function updateUserRegistrationNo

	public function logout()
	{
		$this->session->unset_userdata('is_logged');
		$this->session->unset_userdata('admin_data');
		$this->session->unset_userdata('user_type');
		redirect('admin/login', 'refresh');

	}// end function logout

}	

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */	