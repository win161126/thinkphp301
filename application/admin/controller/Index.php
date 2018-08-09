<?php
namespace app\admin\controller;

use app\admin\controller\Commond;
// use think\Controller;

class Index extends Commond{
	function index(){
		$this->assign('title','后台首页');
		return $this->fetch();
	}
}



?>