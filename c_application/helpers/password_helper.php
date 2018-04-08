<?php
/**
 * 用户密码加密
 */
    function md5_password($password,$salt) {//定义一个salt值，的随机字符串
	    $new_password=$password.$salt;  //把密码和salt连接
	    $new_password=md5($new_password);  //执行MD5散列
	    return $new_password;  //返回散列   
	}
	//$length长度  生成长度的随机字符串
    function createRandomStr($length){ 
		$str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';//62个字符 
		$strlen = 62; 
		while($length > $strlen){ 
			$str .= $str; 
			$strlen += 62;
		}
		$str = str_shuffle($str); 
		return substr($str,0,$length); 
	}
