<?php
namespace app\index\model;

use think\Model;

class Member extends Model{
	protected $insert = ['ctime','ip'];
     
	protected $createTime = 'ctime';

	protected $autoWriteTimestamp = true;

	protected function setIpAttr(){
		return request()->ip();
	}
}



?>