<?php 
$base_url    = 'http://localhost/14-02-2017';
// $base_path   = 'D:\www\html\14-02-2017\shuffed_images';
$base_path   = 'D:\www\html\14-02-2017\resized';
$image_files = scandir(__DIR__."/resized");
echo count($image_files);
$count = 1;
foreach ($image_files as $index => $file_name) {
	exec("mv {$base_path}/{$file_name} {$base_path}/{$count}.jpg");
	$count++;
}
die;
?>