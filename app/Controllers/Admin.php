<?php
namespace App\Controllers;
use App\Models\UsersModel;

class Admin extends BaseController{
	public function index(){
		echo view('header_admin');
		echo view('admin_view');
		echo view('footer_view');
	}
	public function forum(){
		echo view('header_admin');
		echo view('forums_admin');
		echo view('footer_view');
	}
	public function thread(){
		echo view('header_admin');
		echo view('threads_admin');
		echo view('footer_view');
	}
	public function reply(){
		echo view('header_admin');
		echo view('reply_admin');
		echo view('footer_view');
	}
	public function user(){
		echo view('header_admin');
		echo view('user_admin');
		echo view('footer_view');
	}
	public function userLog(){
		echo view('header_admin');
		echo view('userlog_admin');
		echo view('footer_view');
	}
	public function setStatus(){
		$id = $this->request->getPost('id');
		$status = $this->request->getPost('status');
		$model = new UsersModel();
		if ($status == '1'){
			$data = ['active' => '0'];
			if($model->update($id, $data)){
				$result['message'] = 'Deactivated Successfully';
				$result['status'] = true;
			} else {
				$result['message'] = 'Deactivate Failed';
				$result['status'] = false;
			}
		} else {
			$data = ['active' => '1'];
			if($model->update($id, $data)){
				$result['message'] = 'Activated Successfully';
				$result['status'] = true;
			} else {
				$result['message'] = 'Activate Failed';
				$result['status'] = false;
			}
		}
		echo json_encode($result);
	}
}
?>
