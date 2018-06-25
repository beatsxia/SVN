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

	//生成激活码
	class Code { 
	 //密码字典 
	 private $dic = array( 
	 0=>'0', 1=>'1', 2=>'2', 3=>'3', 4=>'4', 5=>'5', 6=>'6', 7=>'7', 8=>'8', 
	 9=>'9', 10=>'A', 11=>'B', 12=>'C', 13=>'D', 14=>'E', 15=>'F', 16=>'G', 17=>'H', 
	 18=>'I',19=>'J', 20=>'K', 21=>'L', 22=>'M', 23=>'N', 24=>'O', 25=>'P', 26=>'Q', 
	 27=>'R',28=>'S', 29=>'T', 30=>'U', 31=>'V', 32=>'W', 33=>'X', 34=>'Y', 35=>'Z' 
	 ); 
	 public function encodeID($int, $format=8) { 
	 $dics = $this->dic; 
	 $dnum = 36; //进制数 
	 $arr = array (); 
	 $loop = true; 
	 while ($loop) { 
	  $arr[] = $dics[bcmod($int, $dnum)]; 
	  $int = bcdiv($int, $dnum, 0); 
	  if ($int == '0') { 
	  $loop = false; 
	  } 
	 } 
	 if (count($arr) < $format) 
	  $arr = array_pad($arr, $format, $dics[0]); 
	 return implode('', array_reverse($arr)); 
	 } 
	 public function decodeID($ids) { 
	 $dics = $this->dic; 
	 $dnum = 36; //进制数 
	 //键值交换 
	 $dedic = array_flip($dics); 
	 //去零 
	 $id = ltrim($ids, $dics[0]); 
	 //反转 
	 $id = strrev($id); 
	 $v = 0; 
	 for ($i = 0, $j = strlen($id); $i < $j; $i++) { 
	  $v = bcadd(bcmul($dedic[$id { 
	  $i } 
	  ], bcpow($dnum, $i, 0), 0), $v, 0); 
	 } 
	 return $v; 
	 } 
	}
