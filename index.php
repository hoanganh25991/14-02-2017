<!-- IMG_0649.JPG -->
<?php
$base_path = __DIR__ . "/resized";
$image_files = scandir($base_path);

function is_image($path){
    $a = @getimagesize($path);
    $image_type = $a[2];

    $allowed_typed = [
        IMAGETYPE_JPEG,
        IMAGETYPE_PNG
    ];

    if(in_array($image_type, $allowed_typed)){
        return true;
    }

    return false;
}

//Build shuffed_images file as right url on server
$images = [];
foreach($image_files as $file_name){
    if(is_image($base_path . "/{$file_name}")){
        $images[] = "resized/{$file_name}";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>tt meo con</title>
    <meta property="og:url" content="https://tinker.press/hh.html">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Voi con ft. Meo con ＼＿ヘ(ᐖ◞)､">
    <meta property="og:description"
          content="Anh vẫn ước, bình minh mỗi sáng. Được nhìn em ngắm dáng kiêu xa. Chạy theo một dải ngân hà. Cho tình đẹp mãi mặn mà yêu thương.">
    <meta property="og:image" content="https://tinker.press/images/make-you-smile-2.jpg">
    <meta property="og:site_name" content="tinker.press">
    <style type="text/css">
        body {
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
            /*transform-origin: bottom left;*/
        }

        #tho {
            border-left: 5px solid seagreen;
            background-color: antiquewhite;
            padding: 10px 20px;
            max-width: 700px;
            border-left: 5px solid seagreen;
            font-size: 2em;
            border-radius: 3px;
        }

        #control{
            border-left: 5px solid seagreen;
            background-color: antiquewhite;
            padding: 10px 20px;
            max-width: 100px;
            border-radius: 3px;
            transition: all 5s  ease-in-out;
            opacity: 0;
        }

    </style>
</head>
<body>
<p id="tho">
    Anh vẫn ước, bình minh mỗi sáng.<br>
    Được nhìn em ngắm dáng kiêu xa.<br>
    Chạy theo một dải ngân hà.<br>
    Cho tình đẹp mãi mặn mà yêu thương.
</p>

<p id="control">
    <a move-step="black" href="#">black</a> or <a move-step="white" href="#">white</a>
</p>

<div id='slide-container'>
    <img id='slide'>
</div>
<script>
    <?php $images_json = json_encode($images); ?>
    <?php echo "window.images = {$images_json};" ?>
</script>
<script src="main.js"></script>
</body>
</html>