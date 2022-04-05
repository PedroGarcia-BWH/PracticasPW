<html>
    <head>
        <title>Examen</title>
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
        
        <?php
            session_start();
            echo '<h1 id="title">Examen ';
            $conexion = mysqli_connect("127.0.0.1", "root", "", "bduca");
            if(!isset($_SESSION['id_examen'])){
                $consulta = mysqli_query($conexion, "SELECT * FROM examen WHERE id_examen = '".$_POST['boton']."' ");
            }
            else{
                $consulta = mysqli_query($conexion, "SELECT * FROM examen WHERE id_examen = '".$_SESSION['id_examen']."' ");
            }
            $examen = mysqli_fetch_array($consulta);
            $id_tema = $examen['id_tema'];
            
            $queryIdPreguntas = mysqli_query($conexion, "SELECT * FROM preguntaexamen WHERE id_examen = '".$_SESSION['id_examen']."'");
            $numPreguntas = mysqli_num_rows($queryIdPreguntas);


            /* Creacion del examen y guardado en BD */
            if(!isset($_SESSION['id_examen'])|| $numPreguntas == 0){
                $consultaPreguntas = mysqli_query($conexion, "SELECT * FROM bateriapreguntas WHERE id_tema = $id_tema");
                $nPreguntas = mysqli_num_rows($consultaPreguntas);
                for($i = 1; $i < $nPreguntas; $i++){
                    $preguntas[$i] = mysqli_fetch_array($consultaPreguntas);
                }

                $preguntasExamenLocal = [];
                for($numeroPreguntasExamenLocal = 1; $numeroPreguntasExamenLocal <= 5; $numeroPreguntasExamenLocal++){
                    do{
                        $n = rand(1, $nPreguntas);
                    }while(in_array($n, $preguntasExamenLocal));
                    array_push($preguntasExamenLocal, $n);
                    $query_examenBD = mysqli_query($conexion, "INSERT INTO preguntaexamen (id_examen, id_pregunta) VALUES (".$examen['id_examen'].", $n)");
                    $_SESSION['id_examen'] = $examen['id_examen']; 
                }
            }
            /* Cargar examen de la BD */
            if(isset($_SESSION['id_examen'])){
                $queryTema = mysqli_query($conexion, "SELECT * FROM tema WHERE id_tema IN (SELECT id_tema FROM examen WHERE id_examen = '".$_SESSION['id_examen']."' )");
                $tema = mysqli_fetch_array($queryTema);
                echo $tema['nombre_tema'];
                echo '</h1>';
                echo '<div class="cuestionario">';

                //Recoger examen de la base de datos
                $queryIdPreguntas = mysqli_query($conexion, "SELECT * FROM preguntaexamen WHERE id_examen = '".$_SESSION['id_examen']."'");
                $numPreguntas = mysqli_num_rows($queryIdPreguntas);
                $arrayOrdenIdPreguntas = [0,];
                echo '<form method="POST">';
                for($i=1; $i<=$numPreguntas; $i++){
                    $Idpregunta = mysqli_fetch_array($queryIdPreguntas);
                    $queryPreguntas = mysqli_query($conexion, "SELECT * FROM bateriapreguntas WHERE id_pregunta = '".$Idpregunta['id_pregunta']."'");
                    array_push($arrayOrdenIdPreguntas, $Idpregunta['id_pregunta']);
                    $pregunta = mysqli_fetch_array($queryPreguntas);
                    echo '<h4 class="pregunta">Pregunta '.$i.' -'.$pregunta['pregunta'].'</h4>';
                    for($j=1; $j<=4; $j++){
                        echo '<div class="opcion"><input type="radio" name="respuesta'.$i.'" value="'.$j.'">'.$pregunta['opcion'."$j".''].'</div>';
                    }
                    echo '<div class="opcion"><input type="radio" name="respuesta'.$i.'" value="0">Dejar en blanco</div>';
                }
                echo '<button name="respuesta" value='.$_SESSION['id_examen'].' type="submit">Enviar examen</button>';
                echo '</form>';
                echo '</div>';
            }

            if(isset($_POST['respuesta'])){
                $calificacion = 0;
                for($res = 1; $res<=$numPreguntas; $res++){
                    if(!isset($_POST['respuesta'.$res.''])){
                        $_POST['respuesta'.$res.''] = 0;
                    }
                    mysqli_query($conexion, "UPDATE preguntaexamen SET respuesta = '".$_POST['respuesta'.$res.'']."' WHERE id_pregunta = '".$arrayOrdenIdPreguntas[$res]."'");
                    if (mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM bateriapreguntas WHERE id_pregunta = '".$arrayOrdenIdPreguntas[$res]."' AND correcta =  '".$_POST['respuesta'.$res.'']."'")) == 1){
                        $calificacion++;
                    }
                    unset($_POST['respuesta'.$res.'']);
                }
                $calificacion = $calificacion/$numPreguntas * 10;
                mysqli_query($conexion, "UPDATE examen SET calificacion = $calificacion WHERE id_examen = '".$_SESSION['id_examen']."'");
                unset($_POST['respuesta']);

                header('Location: ./finExamen.php');
            }
        ?>
    </body>
</html>