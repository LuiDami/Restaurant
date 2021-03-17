<?php 
    if (!isset($_SESSION["login"])) {
        header("Location: ../../index.php");
    }
?>
<?php
    include_once '././model/Platos_model.php';
    $plato=new Platos();
    $platos_array = $plato->obtieneTodos();


    if(isset($_POST["cocinero"]["menus"])){
        include_once '././controller/cocineros_controller/Cocineros_menus_controller.php';
    }else if(isset($_POST["cocinero"]["platos"])){
        include_once '././controller/cocineros_controller/Cocineros_platos_controller.php';
    }else if(isset($_POST["cocinero"]["comandas"])){
        include_once '././view/cocineros_view/Cocineros_comandas_view.php';
    }else{
        include_once '././view/cocineros_view/Cocineros_view.php'; 
    }
    
    
