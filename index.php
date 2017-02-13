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

    <!-- Google Fonts embed code -->
    <script type="text/javascript">
        (function() {
            var link_element = document.createElement("link"),
                s = document.getElementsByTagName("script")[0];
            if (window.location.protocol !== "http:" && window.location.protocol !== "https:") {
                link_element.href = "http:";
            }
            link_element.href += "//fonts.googleapis.com/css?family=Pacifico:400";
            link_element.rel = "stylesheet";
            link_element.type = "text/css";
            s.parentNode.insertBefore(link_element, s);
        })();
    </script>

    <style type="text/css">
        /* vietnamese */
        /*@font-face {*/
            /*font-family: 'Pangolin';*/
            /*font-style: normal;*/
            /*font-weight: 400;*/
            /*src: url(http://fonts.gstatic.com/s/pangolin/v1/D0pqkrCtRxgv1Bac7dRO4BTbgVql8nDJpwnrE27mub0.woff2) format('woff2');*/
            /*unicode-range: U+0102-0103, U+1EA0-1EF9, U+20AB;*/
        /*}*/
        body {

            /*font-family: 'Pangolin';*/
            font-family: 'Pacifico';
            font-size: 13px;
            font-style: normal;
            font-weight: 400;
            background: url(background/big-flower.png) #f2f2f2 50% 50%;
            /*color: #AA9A45;*/
            color: #9C27B0;
            /*transform: rotate(30deg);*/
        }
        #slide-container {
            width: 600px;
            height: 400px;
            margin: auto;
            overflow: hidden;
            border-radius: 10px;
            /*background: no-repeat  url(background/big-flower.png) #f2f2f2;*/
        }
        #slide {
            height: 100%;
            margin: 32px auto;
            display: block;
            transform-origin: bottom left;
            cursor:pointer;
            border-radius: 10px;
        }
        #tho {
            border-left: 5px solid seagreen;
            /*background-color: #AA9A45;*/
            /*background-color: #9C27B0;*/
            padding: 10px 20px;
            max-width: 700px;
            border-left: 5px solid seagreen;
            font-size: 2em;
            border-radius: 3px;
        }
        #control{
            border-left: 5px solid seagreen;
            /*background-color: #AA9A45;*/
            padding: 10px 20px;
            max-width: 100px;
            border-radius: 3px;
            transition: all 5s  ease-in-out;
            opacity: 0;
        }
        #say {

            color: #760000;
            transition: all 1s ease-in-out;
            opacity: 0;
            position: absolute;
            padding: 10px 20px;
        }
        .sticker {
            width: 120px;
            height: 120px;
            background: url('sticker/oh-yeah.png') -12px;
            background-size: 432px 432px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div id='slide-container'>
    <p id="tho">
        Anh vẫn ước, bình minh mỗi sáng.<br>
        Được nhìn em ngắm dáng kiêu xa.<br>
        Chạy theo một dải ngân hà.<br>
        Cho tình đẹp mãi mặn mà yêu thương.
    </p>

    <p id="control">
        <a move-step="black" href="#">black</a> or <a move-step="white" href="#">white</a>
    </p>

    <img id='slide'>
    <div id="say">
        <p style="font-size: 5em;">LOVE YOU</p>
        <div class='sticker' id='oh-yeah'></div>
    </div>
</div>
<script>
    <?php $images_json = json_encode($images); ?>
    <?php echo "window.images = {$images_json};" ?>
</script>
<script src="main.js"></script>
</body>
</html>