<html>
    <head>
        <title>Revision</title>
        <style type="text/css">
            *{
                font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
                position: relative;
            }

            p, h2{
                margin: 0;
                padding: 0;
                height: fit-content;
            }

            #title{
                text-align: center;
                border: 2px solid;
                background-color: #97CAEF;
                font-size: larger;
            }

            body{
                padding: 20px 40px;
                max-width: 800px;
                margin: 0px auto;
            }

            .cuestionario{
                height: fit-content;
                border: 2px solid;
            }

            .pregunta{
                margin-top: 10px;
                margin-left: 10px;
                margin-bottom: 0;
                font-weight: bold;
            }

            input{
                margin-left: 30px;
            }

            form{
                width: 100%;
                height: 50%;
                min-height: fit-content;
                display: flex;
                flex-direction: column;
                justify-content: space-around;
            }
            button{
                width: 20%;
                margin-top: 10px;
                margin-left: auto;
                margin-right: 5px;
            }

            .opcion{
                font-size: small;
            }
        </style>
    </head>
    <body>
        
    </body>
</html>
<?php
    echo '<h1 id="title">Revisión ';
    $conexion = mysqli_connect("127.0.0.1", "root", "", "bduca");
    $consulta = mysqli_query($conexion, "SELECT * FROM examen WHERE id_examen = '".$_POST['revision']."' ");
    $examen = mysqli_fetch_array($consulta);
    $id_tema = $examen['id_tema'];
    
    $queryIdPreguntas = mysqli_query($conexion, "SELECT * FROM preguntaexamen WHERE id_examen = '".$_POST['revision']."'");
    $numPreguntas = mysqli_num_rows($queryIdPreguntas);

    $conexion = mysqli_connect("127.0.0.1", "root", "", "bduca");
    if(isset($_POST['revision'])){
        $queryTema = mysqli_query($conexion, "SELECT * FROM tema WHERE id_tema IN (SELECT id_tema FROM examen WHERE id_examen = '".$_POST['revision']."' )");
        $tema = mysqli_fetch_array($queryTema);
        echo $tema['nombre_tema'];
        echo '</h1>';
        echo '<div class="cuestionario">';

        //Recoger examen de la base de datos
        $queryIdPreguntas = mysqli_query($conexion, "SELECT * FROM preguntaexamen WHERE id_examen = '".$_POST['revision']."'");
        $numPreguntas = mysqli_num_rows($queryIdPreguntas);
        echo '<form action=menuEstudiante.php method="POST">';
        for($i=1; $i<=$numPreguntas; $i++){
            $Idpregunta = mysqli_fetch_array($queryIdPreguntas);
            $queryPreguntas = mysqli_query($conexion, "SELECT * FROM bateriapreguntas WHERE id_pregunta = '".$Idpregunta['id_pregunta']."'");
            $pregunta = mysqli_fetch_array($queryPreguntas);
            echo '<h4 class="pregunta">Pregunta '.$i.' -'.$pregunta['pregunta'].'</h4>';
            $correctaRow = mysqli_query($conexion, "SELECT correcta FROM bateriapreguntas WHERE id_pregunta =  '".$Idpregunta['id_pregunta']."'");
            $correctaRow = mysqli_fetch_array($correctaRow);
            $seleccionadaRow = mysqli_query($conexion, "SELECT respuesta FROM preguntaexamen WHERE id_pregunta = '".$Idpregunta['id_pregunta']."' AND id_examen = '".$_POST['revision']."'");
            $seleccionadaRow = mysqli_fetch_array($seleccionadaRow);
            for($j=1; $j<=4; $j++){
                if($j == $correctaRow['correcta'] && $j == $seleccionadaRow['respuesta']){
                    echo '<div class="opcion" style="background-color: #34B23333;"><input type="radio" name="respuesta'.$i.'" value="'.$j.'" checked disabled>'.$pregunta['opcion'."$j".''].'</div>';
                }
                if($j != $correctaRow['correcta'] && $j == $seleccionadaRow['respuesta']){
                    echo '<div class="opcion" style="background-color: #FF000055"><input type="radio" name="respuesta'.$i.'" value="'.$j.'" checked disabled>'.$pregunta['opcion'."$j".''].'</div>';
                }
                if($j == $correctaRow['correcta'] && $j != $seleccionadaRow['respuesta']){
                    echo '<div class="opcion" style="background-color: #34B23333"><input type="radio" name="respuesta'.$i.'" value="'.$j.'" disabled>'.$pregunta['opcion'."$j".''].'</div>';
                }
                else{
                    echo '<div class="opcion"><input type="radio" name="respuesta'.$i.'" value="'.$j.'" disabled>'.$pregunta['opcion'."$j".''].'</div>';
                }
            }
            if($seleccionadaRow['respuesta'] == 0){
                echo '<div class="opcion" style="background-color: #FFFF0055"><input type="radio" name="respuesta'.$i.'" value="0" disabled checked>Dejar en blanco</div>';
            }
            else{
                echo '<div class="opcion"><input type="radio" name="respuesta'.$i.'" value="0" disabled >Dejar en blanco</div>';
            }
        }
        echo '<button name="respuesta" value='.$_POST['revision'].' type="submit">Terminar revision</button>';
        echo '</form>';
        echo '</div>';
    }
?>