<?php 
    if (!(isset($_POST["categoria"]))) {
        header("Location: ../../index.php");
    }
?>
<thead>
    <tr>
        <th>Dni</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Editar</th>
    </tr>
</thead>
<tbody>   
    <?php

    $tuplas="";
    for($x=0;$x<count($trabajadores_array);$x++){
        $tuplas.= "<tr>"
        . "<td>".$trabajadores_array[$x]->dni."</td>"
        . "<td>".$trabajadores_array[$x]->nombre."</td>" 
        . "<td>".$trabajadores_array[$x]->apellido."</td>"   
        . "<td>"
        ."<form action='./index.php' method='post'>"
        ."<input type='submit' value='Editar' name='administrador[trabajadores][editar]'>"
        ."<input type='hidden' value='".$trabajadores_array[$x]->dni."' name='administrador[trabajadores][editar][dni]'>"
        ."</form>"
        ."</td>"    
        . "</tr>";
    }
    echo $tuplas;
    ?>
    </tbody> 