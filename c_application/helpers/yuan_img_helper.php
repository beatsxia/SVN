<?php
/**
  *  blog:http://www.zhaokeli.com
 * �����ԲͼƬ,���ͼƬ���������ξ�ȡ��С�ߵ�Բ�뾶,����߿�ʼ���г�Բ��
 * @param  string $imgpath [description]
 * @return [type]          [description]
 */
function yuan_img($imgpath = '') {
	$ext     = pathinfo($imgpath);
	$src_img = null;
	switch ($ext['extension']) {
	case 'jpg':
		$src_img = imagecreatefromjpeg($imgpath);
		break;
	case 'jpeg':
		$src_img = imagecreatefromjpeg($imgpath);
		break;
	case 'png':
		$src_img = imagecreatefrompng($imgpath);
		break;
	case 'JPG':
		$src_img = imagecreatefromjpeg($imgpath);
		break;
	case 'JPEG':
		$src_img = imagecreatefromjpeg($imgpath);
		break;
	case 'PNG':
		$src_img = imagecreatefrompng($imgpath);
		break;
	}
	$wh  = getimagesize($imgpath);
	$w   = $wh[0];
	$h   = $wh[1];
	$w   = min($w, $h);
	$h   = $w;
	$img = imagecreatetruecolor($w, $h);
	//��һ��һ��Ҫ��
	imagesavealpha($img, true);
	//ʰȡһ����ȫ͸������ɫ,���һ������127Ϊȫ͸��
	$bg = imagecolorallocatealpha($img, 255, 255, 255, 127);
	imagefill($img, 0, 0, $bg);
	$r   = $w / 2; //Բ�뾶
	$y_x = $r; //Բ��X����
	$y_y = $r; //Բ��Y����
	for ($x = 0; $x < $w; $x++) {
		for ($y = 0; $y < $h; $y++) {
			$rgbColor = imagecolorat($src_img, $x, $y);
			if (((($x - $r) * ($x - $r) + ($y - $r) * ($y - $r)) < ($r * $r))) {
				imagesetpixel($img, $x, $y, $rgbColor);
			}
		}
	}
	return $img;
}