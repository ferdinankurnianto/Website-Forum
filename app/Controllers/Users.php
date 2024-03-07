<?php
namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\UserLogModel;

class Users extends BaseController{
	public function __construct(){
		$this->form_validation = \Config\Services::validation();
	}
	public function index(){
	}
	public function login(){
		echo view('header_view');
		echo view('login_view');
		echo view('footer_view');
	}
	public function profile(){
		$model = new UsersModel;
		$data = $model->select('username, email, gender, birthdate')->find(session()->get('id'));
		echo view('header_view');
		echo view('profile_view', $data[0]);
		echo view('footer_view');
	}
	public function loginCheck(){
		date_default_timezone_set('Asia/Jakarta');
		$email = $this->request->getPost('email');
		$password = $this->request->getPost('password');
		$userModel = new UsersModel();
		$userLogModel = new UserLogModel();
		$data = [
			'email' => $email,
			'timestamp' => date('Y-m-d H:i:sa') ,
			'status' => 5
		];
		
		if($userModel->where('password', md5($password))->where('active', 1)->where('email', $email)->findAll()){
			$data['status'] = 1;
			$userLogModel->insert($data);
			$id = $userModel->select('id')->where('email',$email)->first();
			$username = $userModel->select('username')->where('email',$email)->first();
			$admin = $userModel->select('admin')->where('email',$email)->first();
			$udata = [
				'id' => $id,
				'username' => $username,
				'admin' => $admin,
				'logged_in' => true
			];
			session()->set($udata);
			return redirect()->to('forums');
		} else {
			if(!$userModel->where('email', $email)->findAll()){
				$data['status'] = 2;
				session()->setFlashData('errors', 'Email not registered');
			} elseif($userModel->where('password!=', md5($password))->where('email', $email)->findAll()){
				$data['status'] = 3;
				session()->setFlashData('errors', 'Wrong password');
			} elseif($userModel->where('active', 0)->where('email', $email)->findAll()){
				$data['status'] = 4;
				session()->setFlashData('errors', 'User not activated');
			} else{
				$data['status'] = 5;
				session()->setFlashData('errors', 'Unknown Error');
			}
			$userLogModel->insert($data);
			return redirect()->back();
		}
	}
	public function register(){
		if($this->request->getMethod()==='post'){
			$otp = substr(md5(rand()), 0, 25);
			$data =[
				'username' => $this->request->getPost('username'),
				'email' => $this->request->getPost('email'),
				'password' => $this->request->getPost('password'),
				'password2' => $this->request->getPost('password2'),
				'gender' => $this->request->getPost('gender'),
				'birthdate' => $this->request->getPost('birthdate'),
				'admin' => '0',
				'active' => '0',
				'otp' => $otp
			];
			if($this->form_validation->run($data, 'register') == FALSE){
				session()->setFlashdata('inputs', $this->request->getPost());
				session()->setFlashdata('errors', $this->form_validation->getErrors());
			} else {
				$data['password'] = md5($data['password']);
				$data['password2'] = md5($data['password2']);
				$model = new UsersModel();
				if ($model->insert($data)){
					$email = $data['email'];
					$sendEmail = new Mailer();
					$sendEmail->to="$email";
					$sendEmail->subject='Registration Success';
					$sendEmail->message="Dear ".$data['username'].",<br><br>
						You have registered on our website. Beforr you can login,
						please click this link below to activate your account:<br>".base_url('users/activate/'.$data['otp'])."<br>Best regards";
					if($sendEmail->send()){
						session()->setFlashdata('success', 'Registered successfully, please check your email to activate your account');
					} else {
						session()->setFlashdata('errors', ["We can\'t reach you by email!<br>Error:
						".$sendEmail->ErrorInfo]);
					}
				} else {
					session()->setFlashdata('inputs', $this->request->getPost());
					session()->setFlashdata('errors', 'Registration Failed');
				}
			}
		}
		echo view('header_view');
		echo view('registration_view');
		echo view('footer_view');
	}
	public function forget(){
		if($this->request->getMethod()==='post'){
			$model = new UsersModel();
			if($this->request->getVar('btnSubmit') === 'Submit'){
				$email = $this->request->getPost('email');
				$id = $model->select('id')->where('email',$email)->first();
				$username = $model->select('username')->where('email',$email)->first();
				$data =['otp' => substr(md5(rand()), 0, 25)];
				$model->update($id, $data);
				if($model->db->affectedRows()){
					if($username){
						$sendEmail = new Mailer();
						$sendEmail->to="$email";
						$sendEmail->subject='Forget Password';
						$sendEmail->message="Dear ".$username['username'].",<br><br>
							You requested for a password reset because you forget the password.
							Please click this link below:<br>".base_url('users/changePassword/'.$data['otp'])."<br>Best regards";
						if($sendEmail->send()){
							session()->setFlashData('success', 'Please check your email for further steps');
						} else {
							session()->setFlashdata('errors', ["We can\'t reach you by email!<br>Error:
							".$sendEmail->ErrorInfo]);
						}
					} else session()->setFlashdata('errors', 'Email does not exist in database');
				} else session()->setFlashdata('errors', 'Error Generating otp');
			}
		}
		echo view('header_view');
		echo view('forget_view');
		echo view('footer_view');
	}
	public function changePassword($otp=''){
		if($this->request->getMethod()==='post'){
			$model = new UsersModel();
			if($this->request->getVar('btnSubmit') === 'Submit'){
				$data =[
					'password' => $this->request->getPost('password'),
					'password2' => $this->request->getPost('password2')
				];
				if($this->form_validation->run($data, 'forget') == FALSE){
					session()->setFlashdata('inputs', $this->request->getPost());
					session()->setFlashdata('errors', $this->form_validation->getErrors());
				} else {
					$data =['password' => md5($data['password']) ];
					$model->where('otp',$otp)->set($data)->update();
					if ($model->db->affectedRows()){
						$model->where('otp',$otp)->set(['otp'=>''])->update();
						session()->setFlashdata('success', 'Password changed successfully.');
					} else {
						session()->setFlashdata('errors', 'Your token expired, please try requesting again');
					}
				}
			}
		}
		echo view('header_view');
		echo view('changepassword_view');
		echo view('footer_view');
	}
	public function activate($otp=''){
		$model = new UsersModel();
		$data = ['active' => '1'];
		$model->where('otp',$otp)->set($data)->update();
		if ($model->db->affectedRows()){
			$model->where('otp',$otp)->set(['otp'=>''])->update();
			return redirect()->to('users/login');
		}
	}
	
	public function getData(){
		$id = $this->request->getPost('id');
		$model = new UsersModel();
		if($id){
			$data['users'] = $model->where('id', $id)->findAll();
			echo json_encode($data['users']);
		} else {
			$data['users'] = $model->findAll();
			echo json_encode($data['users']);
		}
	}
	public function getUserLog(){
		$model = new UserLogModel();
		$data['users'] = $model->findAll();
		echo json_encode($data['users']);
	}
	public function add(){
		$data =[
			'username' => $this->request->getPost('username'),
			'email' => $this->request->getPost('email'),
			'password' => $this->request->getPost('password'),
			'gender' => $this->request->getPost('gender'),
			'birthdate' => $this->request->getPost('birthdate'),
			'admin' => '0',
			'active' => '0'
		];
		if($this->form_validation->run($data, 'user') == FALSE){
			$result['message'] = $this->form_validation->getErrors();
			$result['status'] = false;
		} else {
			$data['password'] = md5($data['password']);
			$model = new UsersModel();
			if ($model->insert($data)){
				$result['message'] = 'Insert Successfully';
				$result['status'] = true;
			} else {
				$result['message'] = 'Insert Failed';
				$result['status'] = false;
			}
		}
		echo json_encode($result);
	}
	public function edit(){
		$id = $this->request->getPost('id');
		$data =[
			'username' => $this->request->getPost('username'),
			'email' => $this->request->getPost('email'),
			'password' => $this->request->getPost('password'),
			'gender' => $this->request->getPost('gender'),
			'birthdate' => $this->request->getPost('birthdate')
		];
		
		if($this->form_validation->run($data, 'user') == FALSE){
			$result['message'] = $this->form_validation->getErrors();
			$result['status'] = false;
		} else {
			$data['password'] = md5($data['password']);
			$model = new UsersModel();
			if ($model->update($id, $data)){
				$result['message'] = 'Edit Successfully';
				$result['status'] = true;
			} else {
				$result['message'] = 'Edit Failed';
				$result['status'] = false;
			}
		}
		echo json_encode($result);
	}
	public function editProfile(){
		$id = session()->get('id');
		$dataSend = $this->request->getPost();
		$data =[
			''.$dataSend['dataSend'][0]['name'].'' => $dataSend['dataSend'][0]['value']
		];
		$model = new UsersModel;
		$model->setValidationRule($dataSend['dataSend'][0]['name'], 'required');
		if ($model->update($id, $data)){
				$result['message'] = 'Edit Successfully';
				$result['status'] = true;
			} else {
				$result['message'] = $model->errors();
				$result['status'] = false;
		}
		echo json_encode($result);
	}
	public function changePasswordProfile(){
		$id = session()->get('id');
		$data =[
			'oldPassword' => $this->request->getPost('oldPassword'),
			'password' => $this->request->getPost('password'),
			'password2' => $this->request->getPost('password2')
		];
		$model = new UsersModel;
		if($this->form_validation->run($data, 'forgetProfile') == FALSE){
			$result['message'] = $this->form_validation->getErrors();
			$result['status'] = false;
		} else {
			$data =['password' => md5($data['password']) ];
			$model->update($id, $data);
			if ($model->db->affectedRows()){
				$result['message'] = 'Password changed successfully.';
				$result['status'] = true;
			} else {
				$result['message'] = $model->errors();
				$result['status'] = false;
			}
		}
		echo json_encode($result);
	}
	public function delete(){
		$id = $this->request->getPost('id');
		$model = new UsersModel();
		if ($model->delete($id)){
			$result['message'] = 'Delete Successfully';
			$result['status'] = true;
		} else {
			$result['message'] = 'Delete Failed';
			$result['status'] = false;
		}
		echo json_encode($result);
	}
	public function deleteUserLog(){
		$id = $this->request->getPost('id');
		$model = new UserLogModel();
		if ($model->delete($id)){
			$result['message'] = 'Delete Successfully';
			$result['status'] = true;
		} else {
			$result['message'] = 'Delete Failed';
			$result['status'] = false;
		}
		echo json_encode($result);
	}
	public function logout(){
		session()->destroy();
		return redirect()->to('');
	}
	public function sessionCheck(){
		$user_id = session()->get('id');
		if(isset($user_id)){
			echo 'success';
		}
	}
}
?>
