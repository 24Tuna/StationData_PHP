<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name=”viewport” content=”width=device-width, initial-scale=1, shrink-to-fit=no”>
		<link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="style.css" rel="stylesheet">
		<title>施設情報閲覧画面｜駅から街を探索しよう</title>
	</head>
	<body class="container">
		<div class="jumbotron text-center">
            <?php
                error_reporting(0);
                if($_POST["line"] != "" && $_POST["station"] != ""){
                    print("<h1>".$_POST["line"]." ".$_POST["station"]."駅の周辺情報</h1>");
                }else{
                    print("<h1>駅の情報を取得できませんでした</h1>");
                }
            ?>
        </div>
        <?php
            if($_POST["line"] != "" && $_POST["station"] != ""){
                print("<iframe src=\"http://maps.google.co.jp/maps?q=".$_POST["station"]."駅
                    &output=embed&amp;t=m&amp;z=16\"
                    width=\"100%\" height=\"200sp\"
                    frameborder=\"0\"
                    marginwidth=\"0\" marginheight=\"0\"
                    scrolling=\"no\"></iframe>");

                $db=new SQLite3("StationInformation.db");
                $query="SELECT * FROM information
                    WHERE pref='".$_POST["pref"]."' AND line='".$_POST["line"]."' AND station='".$_POST["station"]."'";
                $result=$db->query($query);

                while($info=$result->fetchArray(SQLITE3_ASSOC)){

                    print("<div class=card>");
                    print("<h4 class=card-header>".$info["place"]."</h4>");
                    //print("<p>".$info["info"]."</p>");
                    $infoA=$info["info"];
                    echo nl2br($infoA);
                    print("</div>");
                }
            }else{
                print("<p>駅を入力してください</p>");
                print('<input type ="button" onclick = "history.back()" value = "戻る"></button>');
            }
        ?>
    </body>
</html>
