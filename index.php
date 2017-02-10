<!-- IMG_0649.JPG -->
<?php 
	$base_url    = 'http://localhost/14-02-2017';
	$base_path   = 'D:\www\html\14-02-2017\images';
	$image_files = scandir(__DIR__."/images");

	$images = [];
	foreach ($image_files as $file_names) {
		# code...
		if(is_image($base_path."/{$file_names}"))
			$images[] = $base_url."/images/{$file_names}";
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

	// var_dump($images);
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

	#slide-container {
		width: 600px;
		height: 400px;
		margin: auto;
		overflow: hidden;
	}

	#slide {
		height: 100%;
		margin-left: auto;
		margin-right: auto;
		display: block;
		transform-origin: bottom left;
	}

</style>
</head>
<body>
<div id='slide-container'>
	<img id='slide'>
</div>
<script>
	<?php $images_json = json_encode($images); ?>
	<?php echo "window.images = {$images_json};" ?>
</script>
<script type="text/javascript">
	let slide = document.querySelector('#slide');
	//define class as function-style
	let Quick_Loop = function(images, config = {}){
		let step       = 2000; //60 ms
		let count        = 0;
		let is_preloaded = false;

		let preload = function(){
			if(is_preloaded){
				console.log('Images preloaded');
				return;
			}

			images.forEach(url => {
				let i = new Image();
				i.src = url;
			});

			is_preloaded = true;
		}

		//execute preload, rather than let in inside run
		//bcs, right after run is setTimeout, which doesn't wait for
		//preload finish
		preload();

		//for transform animation
		const duration = step/2/1000; //count in s
		//default as set up
		// const ANIMATION_OUT    = 'scale(0,0)';
		const ANIMATION_OUT    = {
			name : 'opacity',
			value: '0'
		};
		// const ANIMATION_IN     = 'scale(1,1)';
		const ANIMATION_IN     = {
			name : 'opacity',
			value: '1'  
		};

		slide.style.transition = `all ${duration}s ease-in-out`;

		let run = function(){
			if(typeof images[count] == 'undefined'){
					console.log('End slide loop');
					//reset count
					count = 0;
					return;
			}
			
			setTimeout(function(){
				requestAnimationFrame(function(){
					slide.style[ANIMATION_IN.name] = ANIMATION_IN.value;
					slide.src = images[count];
					//create a point let it disappear
					setTimeout(function(){
						requestAnimationFrame(function(){
							console.log('call', ANIMATION_OUT);
							slide.style[ANIMATION_OUT.name] = ANIMATION_OUT.value;
						});
					}, step/2);

					count++;
					//continue run
					run();
				});
			}, step);

			
		}

		return {run};
	}


	let quick_loop = Quick_Loop(images);
	// quick_loop.run();
	window.addEventListener('click', function(){
		quick_loop.run();
	});
</script>
</body>
</html>