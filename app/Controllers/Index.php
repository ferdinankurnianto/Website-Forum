<?php
namespace App\Controllers;

class Index extends BaseController{
	public function index(){
		echo view('header_view');
		echo view('forums_view');
		echo view('footer_view');
	}
	public function credit(){
		echo view('header_view');
		echo view('credit_view');
		echo view('footer_view');
	}
}
?>
