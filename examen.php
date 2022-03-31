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
                height: 300px;
                border: 2px solid;
            }

            .pregunta{
                margin-top: 10px;
                margin-left: 10px;
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

            .opcion{
                font-size: small;
            }
        </style>
    </head>
    <body>
        
        <?php
            echo '<h1 id="title">Examen ';
            $conexion = mysqli_connect("127.0.0.1", "root", "", "bduca");
            $consulta = mysqli_query($conexion, "SELECT * FROM examen WHERE id_examen = '".$_POST['boton']."' ");
            $examen = mysqli_fetch_array($consulta);
            $id_tema = $examen['id_tema'];

            /* Comprobar si  */


            /* Creacion del examen */
            //TODO - Guardar la generacion del examen en la base de datos
            if(!isset($_SESSION['id_examen'])){
                $consultaPreguntas = mysqli_query($conexion, "SELECT * FROM bateriapreguntas WHERE id_tema = '".$id_tema."'");
                $nPreguntas = mysqli_num_rows($consultaPreguntas);
                for($i = 1; $i < $nPreguntas; $i++){
                    $preguntas[$i] = mysqli_fetch_array($consultaPreguntas);
                }

                $preguntasExamenLocal = [];
                for($numeroPreguntasExamenLocal = 1; $numeroPreguntasExamenLocal <= 2; $numeroPreguntasExamenLocal++){
                    do{
                        $n = rand(1, $nPreguntas);
                    }while(in_array($n, $preguntasExamenLocal));
                    array_push($preguntasExamenLocal, $n);
                    $query_examenBD = mysqli_query($conexion, "INSERT INTO preguntaexamen (id_examen, id_pregunta) VALUES (".$examen['id_examen'].", $n)");
                    $_SESSION['id_examen'] = $examen['id_examen']; 
                }
                
                //Guardar examen en la base de datos 
            }
            if(isset($_SESSION['id_examen'])){
                $queryTema = mysqli_query($conexion, "SELECT * FROM tema WHERE id_tema IN (SELECT id_tema FROM examen WHERE id_examen = '".$_SESSION['id_examen']."' )");
                $tema = mysqli_fetch_array($queryTema);
                echo $tema['nombre_tema'];
                echo '</h1>';
                echo '<div class="cuestionario">';

                //Recoger examen de la base de datos
                $queryIdPreguntas = mysqli_query($conexion, "SELECT * FROM preguntaexamen WHERE id_examen = '".$_SESSION['id_examen']."'");
                $numPreguntas = mysqli_num_rows($queryIdPreguntas);
                for($i=0; $i<$numPreguntas; $i++){
                    $Idpregunta = mysqli_fetch_array($queryIdPreguntas);
                    $queryPreguntas = mysqli_query($conexion, "SELECT * FROM bateriapreguntas WHERE id_pregunta = '".$Idpregunta['id_pregunta']."'");
                    $pregunta = mysqli_fetch_array($queryPreguntas);
                    echo '<h4 class="pregunta">Pregunta '.$i.' -'.$pregunta['pregunta'].'</h4>';
                    echo '<form method="POST">';
                        for($i=1; $i<=4; $i++){
                            echo '<div class="opcion"><input type="radio" name="respuesta" value="'.$i.'">'.$pregunta['opcion'."$i".''].'</div>';
                        }
                }
                    echo '</form>';
                echo '</div>';
            }
        ?>

    </body>
</html>