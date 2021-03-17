<?php 
    if (!isset($_SESSION["login"])) {
        header("Location: ../../index.php");
    }
?>
<?php
    //luis Damian
    


    if(isset($_POST["barman"]["bebidas"])){
        include_once '././controller/barmans_controller/Barmans_bebidas_controller.php';
    }else if(isset($_POST["barman"]["comandas"])){
        include_once '././view/barmans_view/Barmans_comandas_view.php';
    }else{
        include_once '././view/barmans_view/Barmans_view.php'; 
    }
    

