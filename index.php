<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name=”viewport” content=”width=device-width, initial-scale=1, shrink-to-fit=no”>
		<link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="style.css" rel="stylesheet">
        <title>駅選択画面|駅から街を探索しよう</title>
    </head>
    <body class="container">
		<div class="jumbotron text-center">
			<h1>日本の鉄道駅データ</h1>
		</div>
		<h2>指定した路線の駅データを表示</h2>
		<form action="index.php" method="POST" style="margin-bottom:40px">
			<div class="form-group con-left">
				<label>都道府県を選択</label>
				<select name="pref" class="col-4 form-control">
                    <!--都道府県表示-->
					<?php
						$urlPrefSelect="http://express.heartrails.com/api/xml?method=getPrefectures";
						$objectPrefSelect=simplexml_load_string(file_get_contents($urlPrefSelect));
						$jsonPrefSelect=json_encode($objectPrefSelect);
						$arrayPrefSelect=json_decode($jsonPrefSelect,true);

						$i=0;

						//プルダウン
						while(!empty($arrayPrefSelect['prefecture'][$i])){
							print('<option value="'.$arrayPrefSelect['prefecture'][$i].'"');
							if(!empty($_POST['pref'])&&$arrayPrefSelect['prefecture'][$i]==$_POST['pref']){
								print('selected');
							}
							print('>'.$arrayPrefSelect['prefecture'][$i].'</option>');
							$i++;
						}
						//プルダウン終わり
					?>
				</select>
                <input type="submit" value="都道府県を決定"
								class="btn btn-primary" style="margin-top:10px"
								onclick = "">
			</div>
        </form>
        <form action="index.php" method="POST" style="margin-bottom:40px">
			<div class="form-group">
				<label>路線を選択</label>
				<select name="line" class="col-4 form-control">
					<!--路線表示-->
					<?php
						$urlLineSelect="http://express.heartrails.com/api/xml?method=getLines&prefecture=".$_POST['pref'];
						$objectLineSelect=simplexml_load_string(file_get_contents($urlLineSelect));
						$jsonLineSelect=json_encode($objectLineSelect);
						$arrayLineSelect=json_decode($jsonLineSelect,true);
						$i=0;

						//プルダウン
						while(!empty($arrayLineSelect['line'][$i])){
							print('<option value="'.$arrayLineSelect['line'][$i].'"');
							if(!empty($_POST['line'])&&$arrayLineSelect['line'][$i]==$_POST['line']){
								print('selected');
							}
							print('>'.$arrayLineSelect['line'][$i].'</option>');
							$i++;
						}
						//プルダウン終わり
					?>
                </select>
                <?php
					if(!empty($_POST['pref'])){
						print('<input type="hidden" name="pref" value="'.$_POST['pref'].'">');
					}
				?>
                <input type="submit" value="路線を決定" class="btn btn-primary" style="margin-top:10px">
            </div>
        </form>
		<!--駅名表示-->
		<div class="form-group">
			<form method="POST" style="margin-bottom:40px">
				<?php
						print('<label>駅を選択</label>');
						print('<select name="station" class="col-4 form-control">');

						$urlStationData="http://express.heartrails.com/api/xml?method=getStations&line=".$_POST['line'];
						$objectStationData=simplexml_load_string(file_get_contents($urlStationData));
						$jsonStationData=json_encode($objectStationData);
						$arrayStationData=json_decode($jsonStationData,true);
						$i=0;
						//プルダウン
						while(!empty($arrayStationData['station'][$i])){
							print('<option value="'.$arrayStationData['station'][$i]['name'].'"');
							if(!empty($_POST['station'])&&$arrayStationData['station'][$i]==$_POST['station']){
								print('selected');
							}
							print('>'.$arrayStationData['station'][$i]['name'].'</option>');
							$i++;
						}
						//プルダウン終わり
				?>
		</div>

			<?php
					if(!empty($_POST['pref'])&&!empty($_POST['line'])){
						print('<input type="hidden" name="pref" value="'.$_POST['pref'].'">');
						print('<input type="hidden" name="line" value="'.$_POST['line'].'">');
					}
				?>
			<input type="submit" formaction="inputInfo.php" value="駅の情報を入力" class="btn btn-primary" style="margin-top:10px">

			<?php
					if(!empty($_POST['pref'])&&!empty($_POST['line'])){
						print('<input type="hidden" name="pref" value="'.$_POST['pref'].'">');
						print('<input type="hidden" name="line" value="'.$_POST['line'].'">');
					}
				?>
			<input type="submit" formaction="browseInfo.php" value="駅の情報を閲覧"
						class="btn btn-info" style="margin-top:10px">

			<!--<input type="hidden" formaction="test.php" value="">
			<?php
					//if(!empty($_POST['pref'])&&!empty($_POST['line'])){
					//	print('<input type="hidden" name="pref" value="'.$_POST['pref'].'">');
					//	print('<input type="hidden" name="line" value="'.$_POST['line'].'">');
					//}
				?>
			<input type="submit" formaction="test.php" class="btn btn-info" style="margin-top:10px">-->
        </form>
    </body>
</html>
