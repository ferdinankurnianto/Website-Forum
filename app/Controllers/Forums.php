<?php
namespace App\Controllers;
use App\Models\ForumsModel;

class Forums extends BaseController{
	public function __construct(){
		$this->form_validation = \Config\Services::validation();
	}
	public function index($id=''){
		if($id){
			$data['id']=$id;
			echo view('header_view');
			echo view('threads_view',$data);
			echo view('footer_view');
		} else {
			echo view('header_view');
			echo view('forums_view');
			echo view('footer_view');
		}
	}
	public function getForums(){
		$id = $this->request->getPost('id');
		$forumModel = new ForumsModel();
		if($id){
			$data['forums'] = $forumModel->where('id', $id)->findAll();
			echo json_encode($data['forums']);
		} else {
			$data['forums'] = $forumModel->findAll();
			$data['threads'] = $forumModel->latestPost();
			echo json_encode($data);
		}
	}
	public function getForum(){
		$id = $this->request->getPost('id');
		$model = new ForumsModel();
		if($id){
			$data['forums'] = $model->where('id', $id)->findAll();
			echo json_encode($data['forums']);
		} else {
			$data['count_all'] = $model->select('COUNT(*) as count_replies')
								->join('threads as t', 'forums.id=t.forum_id')
								->join('replies as r','r.thread_id=t.id')
								->findAll();
			$data['count'] = $model->select('COUNT(*) as count_threads')
								->join('threads as t', 'forums.id=t.forum_id')
								->findAll();
			$data['forums'] = $model->findAll();
			echo json_encode($data);
		}
	}
	public function add(){
		$data =[
			'forum_title' => $this->request->getPost('title'),
			'subtitle' => $this->request->getPost('subtitle')
		];
		if($this->form_validation->run($data, 'forum') == FALSE){
			$result['message'] = $this->form_validation->getErrors();
			$result['status'] = false;
		} else {
			$model = new ForumsModel();
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
			'forum_title' => $this->request->getPost('title'),
			'subtitle' => $this->request->getPost('subtitle')
		];
		
		if($this->form_validation->run($data, 'forum') == FALSE){
			$result['message'] = $this->form_validation->getErrors();
			$result['status'] = false;
		} else {
			$model = new ForumsModel();
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
		$model = new ForumsModel();
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
