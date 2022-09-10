<?php
$str = "aB0!";
$pattern1 =  '/[a-z]/';
$pattern2 =  '/[A-Z]/';
$pattern3 =  '/[0-9]/';
$pattern4 =  '/[\!\@\#\$\%\^\&\*]/';

echo preg_match($pattern1, $str);
echo preg_match($pattern2, $str);
echo preg_match($pattern3, $str);
echo preg_match($pattern4, $str);
if(preg_match($pattern1, $str)&&preg_match($pattern2, $str)&&preg_match($pattern3, $str)&&preg_match($pattern4, $str)){
    echo 'hello';
}
