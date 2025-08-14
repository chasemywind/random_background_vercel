<?php
//此php和保存链接的txt文件放在同一目录下
$filename = $_SERVER['DOCUMENT_ROOT']."/file/images.txt";
if(!file_exists($filename)){
    die($filename);
}
//从文本获取链接
$pics = [];
$fs = fopen($filename, "r");
while(!feof($fs)){
    $line = trim(fgets($fs));
    // 跳过空行和以#开头的注释行
    if ($line !== '' && strpos($line, '#') !== 0) {
        array_push($pics, $line);
    }
}
//从数组随机获取链接
$pic = $pics[array_rand($pics)];
//返回指定格式
die(header("Location: $pic"));  // 仅保留重定向功能
?>
