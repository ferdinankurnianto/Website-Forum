<?php
namespace App\Controllers;
use App\Models\ThreadsModel;

class Threads extends BaseController{
	public function __construct(){
		$this->form_validation = \Config\Services::validation();
	}
	public function index($forum_id='', $id=''){
		$data['id']=$id;
		$data['forum_id']=$forum_id;
		echo view('header_view');
		echo view('thread_view',$data);
		echo view('footer_view');
	}
	public function getThreads($id=''){
		$model = new ThreadsModel();
		$data['threads'] = $model->select('threads.*, u.username, f.forum_title')->join('forums as f', 'threads.forum_id = f.id')
								->join('users as u', 'threads.user_id = u.id')->where('f.id',$id)->findAll();
		$data['replies'] = $model->latestReply();
		echo json_encode($data);
	}
	public function getThread($id=''){
		$model = new ThreadsModel();
		$data['thread'] = $model->select('threads.*, u.username')->join('users as u', 'threads.user_id = u.id')
							->where('threads.id',$id)->findAll();
		echo json_encode($data['thread']);
	}
	public function getData(){
		$id = $this->request->getPost('id');
		$model = new ThreadsModel();
		if($id){
			$data['threads'] = $model->where('id', $id)->findAll();
			echo json_encode($data['threads']);
		} else {
			$data['threads'] = $model->findAll();
			echo json_encode($data['threads']);
		}
	}
	public function add(){
		$data =[
			'forum_id' => $this->request->getPost('forum_id'),
			'user_id' => $this->request->getPost('user_id'),
			'title' => $this->request->getPost('title'),
			'content' => $this->request->getPost('content'),
			'timestamp' => date('Y-m-d h:i:sa')
		];
		if($this->form_validation->run($data, 'thread') == FALSE){
			$result['message'] = $this->form_validation->getErrors();
			$result['status'] = false;
		} else {
			$model = new ThreadsModel();
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
			'forum_id' => $this->request->getPost('forum_id'),
			'user_id' => $this->request->getPost('user_id'),
			'title' => $this->request->getPost('title'),
			'content' => $this->request->getPost('content'),
			'timestamp' => date('Y-m-d h:i:sa')
		];
		
		if($this->form_validation->run($data, 'thread') == FALSE){
			$result['message'] = $this->form_validation->getErrors();
			$result['status'] = false;
		} else {
			$model = new ThreadsModel();
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
		$model = new ThreadsModel();
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
