<!-- テスト用のファイルです -->

<?php
  $db=new SQLite3("StationInformation.db");
  $query="SELECT * FROM information";
  $result=$db->query($query);

  print("<iframe width=\"100%\" height=\"200sp\" src=\"http://maps.google.co.jp/maps?q=東京駅&output=embed&amp;t=m&amp;z=17\" frameborder=\"0\" marginwidth=\"0\" marginheight=\"0\" scrolling=\"no\"></iframe>");

  //https://www.google.co.jp/maps/place/%E6%9D%B1%E4%BA%AC%E9%A7%85/@35.6812362,139.7649361,17z/data=!3m1!4b1!4m5!3m4!1s0x60188bfbd89f700b:0x277c49ba34ed38!8m2!3d35.6812362!4d139.7671248

	while($info=$result->fetchArray(SQLITE3_ASSOC)){
    print("<div class=card>");
    print("<h4 class=card-header>".$info["place"]."</h4>");
    //print("<p>".$info["info"]."</p>");
    $infoA=$info["info"];
		echo "<p>".$info["pref"]." ";
		echo $info["line"]." ";
		echo $info["station"]."</p>";
    echo nl2br($infoA);
    print("</div>");
  }
?>
