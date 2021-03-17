<?php 
    if (!(isset($_POST["categoria"]))) {
        header("Location: ../../index.php");
    }
?>
<?php
    
    include_once '../../model/Trabajadores_model.php';
    include_once '../../model/Administradores_model.php';
    include_once '../../model/Barmans_model.php';
    include_once '../../model/Camareros_model.php';
    include_once '../../model/Cocineros_model.php';
    $trabajador=new Trabajadores();
    $administrador=new Administradores();
    $barman=new Barmans();
    $camarero=new Camareros();
    $cocinero=new Cocineros();
        
            /**
             * en el caso de que solo haya un criterio de categoria
             */
            if ($_POST["categoria"]=="camarero") {
                if ($_POST["camarero_estado"]=="1") {
                    $trabajadores_array = $camarero->obtener_trabajadores_activados();
                } elseif($_POST["camarero_estado"]=="todo") {
                    print_r($_POST["camarero_estado"]);
                    $trabajadores_array = $camarero->obtener_trabajadores();
                } else {
                    $trabajadores_array = $camarero->obtener_trabajadores_desactivados();
                }
            }elseif ($_POST["categoria"]=="cocinero") {
                if ($_POST["cocinero_estado"]=="1") {
                    $trabajadores_array = $cocinero->obtener_trabajadores_activados();
                } elseif($_POST["cocinero_estado"]=="todo") {
                    $trabajadores_array = $cocinero->obtener_trabajadores();
                } else {
                    $trabajadores_array = $cocinero->obtener_trabajadores_desactivados();
                }
            }elseif ($_POST["categoria"]=="barman") {
                if ($_POST["barman_estado"]=="1") {
                    $trabajadores_array = $barman->obtener_trabajadores_activados();
                } elseif($_POST["barman_estado"]=="todo") {
                    $trabajadores_array = $barman->obtener_trabajadores();
                } else {
                    $trabajadores_array = $barman->obtener_trabajadores_desactivados();
                }
            }elseif ($_POST["categoria"]=="administrador") {
                if ($_POST["administrador_estado"]=="1") {
                    $trabajadores_array = $administrador->obtener_trabajadores_activados();
                } elseif($_POST["administrador_estado"]=="todo") {
                    $trabajadores_array = $administrador->obtener_trabajadores();
                } else {
                    $trabajadores_array = $administrador->obtener_trabajadores_desactivados();
                }
            }elseif ($_POST["categoria"]=="todos") {
               $trabajadores_array = $trabajador->obtieneTodos(); 
            }

        include_once '../../view/administradores_view/Administrar_trabajadores_tabla_datos_view.php';

    
    
    
    




?>













    

