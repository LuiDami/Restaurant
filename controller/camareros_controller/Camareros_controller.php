<?php 
    if (!isset($_SESSION["login"])) {
        header("Location: ../../index.php");
    }
?>
<?php

if(isset($_POST["camarero"])){
    include_once '././view/camareros_view/Camareros_view.php'; 
}


