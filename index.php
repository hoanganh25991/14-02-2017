<!-- IMG_0649.JPG -->
<?php 
	$base_url    = 'http://localhost/14-02-2017';
	// $base_path   = 'D:\www\html\14-02-2017\images';
	$base_path   = 'D:\www\html\14-02-2017\resized';
	$image_files = scandir(__DIR__."/resized");

	unset($image_files[0]);
	unset($image_files[1]);

	$images = [];
	foreach ($image_files as $file_names) {
		$images[] = $base_url."/resized/{$file_names}";
	}
	// foreach ($image_files as $file_names) {
	// 	# code...
	// 	if(is_image($base_path."/{$file_names}"))
	// 	if($file_names != '.' || $file_names != '..')
	// 		$images[] = $base_url."/resized/{$file_names}";
	// }

	// function is_image($path){
	//     $a = @getimagesize($path);
	//     $image_type = $a[2];
	    
	//     $allowed_typed = [IMAGETYPE_JPEG, IMAGETYPE_PNG];

	//     if(in_array($image_type , $allowed_typed)){
	//         return true;
	//     }

	//     return false;
	// }

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
	let Quick_Loop = function(images){
		let f = 1000;
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
		//default as set up
		// const ANIMATION_OUT    = 'scale(0,0)';
		const ANIMATION_OUT    = {
			name : 'transform',
			value: 'scale(0,0)'
		};
		// const ANIMATION_IN     = 'scale(1,1)';
		const ANIMATION_IN     = {
			name : 'transform',
			value: 'scale(1,1)'  
		};
		
		// let easeInOutCubic = function(x) {
		// 	// return (x * x * x);
		// 	return (x * x);
		// };
		let easeInOutCubic = function(x) {
			if (x < 0.5) {
				return (2 * x * x);
	
			} else {
				x -= 1;
				return 1 - (2 * x * x);
			}
		};

		let run = function(){
			if(typeof images[count] == 'undefined'){
					console.log('End slide loop');
					//reset count
					count = 0;
					return;
			}

			let percent = (images.length - count) / images.length;
			let step = easeInOutCubic(percent) * f;
			step = step < 200 ? 200 : step ;
			console.log(step);
			
			setTimeout(function(){
				duration = step/4/1000;
				slide.style.transition = `all ${duration}s ease-in-out`;
				requestAnimationFrame(function(){
					slide.style[ANIMATION_IN.name] = ANIMATION_IN.value;
					slide.src = images[count];
					//create a point let it disappear
					setTimeout(function(){
						requestAnimationFrame(function(){
							console.log('call', ANIMATION_OUT);
							slide.style[ANIMATION_OUT.name] = ANIMATION_OUT.value;
						});
					}, step * 3/4);

					

					count++;
					console.log(count);
					//continue run
					run();
				});
			}, step);

			
		}

		return {run};
	}

	let shuffle = function (array) {
	  var currentIndex = array.length, temporaryValue, randomIndex;

	  // While there remain elements to shuffle...
	  while (0 !== currentIndex) {

	    // Pick a remaining element...
	    randomIndex = Math.floor(Math.random() * currentIndex);
	    currentIndex -= 1;

	    // And swap it with the current element.
	    temporaryValue = array[currentIndex];
	    array[currentIndex] = array[randomIndex];
	    array[randomIndex] = temporaryValue;
	  }

	  return array;
	}

	images = shuffle(images);

	let quick_loop = Quick_Loop(images);
	// quick_loop.run();
	window.addEventListener('click', function(){
		quick_loop.run();
	});
</script>
</body>
</html>