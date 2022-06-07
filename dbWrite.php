<?php
    $ext=file_exists("StationInformation.db");
    $db=new SQLite3("StationInformation.db");

    $query="INSERT INTO information
            VALUES('".$_POST["pref"]."',
                   '".$_POST["line"]."',
                   '".$_POST["station"]."',
                   '".$_POST["place"]."',
                   '".$_POST["info"]."')";
    $result=$db->exec($query);
    $db->close();
    header("Location:index.php");
?>