<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name=”viewport” content=”width=device-width, initial-scale=1, shrink-to-fit=no”>
		<link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <title>駅選択画面|駅から街を探索しよう</title>
    </head>
    <body class="container">
		<div class="jumbotron text-center">
            <?php
                error_reporting(0);
                if($_POST["line"] != "" && $_POST["station"] != ""){
                    print('<h1>'.$_POST["station"].'駅の鉄道駅データ</h1>');
                }else{
                    print("<h1>駅の情報を取得できませんでした</h1>");
                }
            ?>
        </div>

        <?php
            if($_POST["line"] != "" && $_POST["station"] != ""){
                print('<form action="dbWrite.php" method="POST">');

                print('<div class="form-group">
                        <label class="col-form-label" >施設名</label>
                        <input type="text" name="place" class="form-control col-5">
                     </div>');

                print('<div class="form-group">
                        <label class="col-form-label">施設の情報</label>
                        <textarea name="info" rows="5" class="form-control"></textarea>
                     </div>');

                print('<input type="hidden" name="pref" value="'.$_POST["pref"].'">');
                print('<input type="hidden" name="line" value="'.$_POST["line"].'">');
                print('<input type="hidden" name="station" value="'.$_POST["station"].'">');

                print('<div class="form-group row">');
                print('<input type="submit" value="送信" class="btn btn-primary">');
                print('</div>');

                print('</form>');
            }else{
                print('<input type ="button" onclick = "history.back()" value = "戻る"></button>');
            }
        ?>

    </body>
</html>
