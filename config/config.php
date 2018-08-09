<?php
return [
	// 应用调试模式
    'app_debug'              => true,

    // 'url_route_on'           => true,
    // 'url_route_must'         => false,
    'captcha'  => [       
		// 验证码字符集合        
		'codeSet'  => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY', 
		   // 验证码字体大小(px)5.        
		'fontSize' => 16, 
		// 是否画混淆曲线
		'useCurve' => false,
		// 验证码图片高度
		'imageH'   => 30,
		 // 验证码图片宽度
		'imageW'   => 90,
		  // 验证码位数       
		'length'   => 1,
		 // 验证成功后是否重置    
		 'reset'    => true
	 ],
];


?>