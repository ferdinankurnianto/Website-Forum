<?php
namespace App\Controllers;
use App\Models\RepliesModel;

class Replies extends BaseController{
	public function __construct(){
		$this->form_validation = \Config\Services::validation();
	}
	public function index(){
	}
	public function getReplies($id=''){
		$model = new RepliesModel();
		$data['replies'] = $model->select('replies.*, u.username')
								->join('threads as t', 'replies.thread_id = t.id')
								->join('users as u', 'replies.user_id = u.id')->where('t.id',$id)->findAll();
		echo json_encode($data['replies']);
	}
	public function getData(){
		$id = $this->request->getPost('id');
		$model = new RepliesModel();
		if($id){
			$data['replies'] = $model->where('id', $id)->findAll();
			echo json_encode($data['replies']);
		} else {
			$data['replies'] = $model->findAll();
			echo json_encode($data['replies']);
		}
	}
	public function add(){
		$data =[
			'thread_id' => $this->request->getPost('thread_id'),
			'user_id' => $this->request->getPost('user_id'),
			'content' => $this->request->getPost('content'),
			'timestamp' => date('Y-m-d h:i:sa')
		];
		if($this->form_validation->run($data, 'reply') == FALSE){
			$result['message'] = $this->form_validation->getErrors();
			$result['status'] = false;
		} else {
			$model = new RepliesModel();
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
			'thread_id' => $this->request->getPost('thread_id'),
			'user_id' => $this->request->getPost('user_id'),
			'content' => $this->request->getPost('content'),
			'timestamp' => date('Y-m-d h:i:sa')
		];
		
		if($this->form_validation->run($data, 'reply') == FALSE){
			$result['message'] = $this->form_validation->getErrors();
			$result['status'] = false;
		} else {
			$model = new RepliesModel();
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
	public function delete(){
		$id = $this->request->getPost('id');
		$model = new RepliesModel();
		if ($model->delete($id)){
			$result['message'] = 'Delete Successfully';
			$result['status'] = true;
		} else {
			$result['message'] = 'Delete Failed';
			$result['status'] = false;
		}
		echo json_encode($result);
	}
}
?>
