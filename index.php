<!-- IMG_0649.JPG -->
<?php 
	$base_url    = 'http://localhost/14-02-2017';
	$base_path   = 'D:\www\html\14-02-2017\images';
	$image_files = scandir(__DIR__."/images");

	$images = [];
	foreach ($image_files as $file_names) {
		# code...
		if(is_image($base_path."/{$file_names}"))
			$images[] = $file_names;
	}

	function is_image($path){
	    $a = @getimagesize($path);
	    $image_type = $a[2];
	    
	    $allowed_typed = [IMAGETYPE_JPEG, IMAGETYPE_PNG];

	    if(in_array($image_type , $allowed_typed)){
	        return true;
	    }

	    return false;
	}

	var_dump($images);
?>
<!DOCTYPE html>
<html>
<head id="Head1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>tt meo con</title>
<meta id="fbUrl"         property="og:url"         content="https://tinker.press/hh.html">
<meta id="fbType"        property="og:type" content="article">
<meta id="fbTitle"       property="og:title"       content="Voi con ft. Meo con ＼＿ヘ(ᐖ◞)､">
<meta id="fbDescription" property="og:description" content="Anh vẫn ước, bình minh mỗi sáng
Được nhìn em ngắm dáng kiêu xa
Chạy theo một dải ngân hà
Cho tình đẹp mãi mặn mà yêu thương">
<meta id="fbImage"       property="og:image"       content="https://tinker.press/images/make-you-smile-2.jpg">
<meta id="fbSiteName"    property="og:site_name"   content="tinker.press">
<style type="text/css">
	body {
		width: 100%;
		height: 100%;
		background-color: black;
	}
</style>
</head>
<body>
<script type="text/javascript">
	
</script>
</body>
</html>