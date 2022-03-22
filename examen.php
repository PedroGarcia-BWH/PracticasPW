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
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                echo '<h1 id="title">Examen ';
                $conexion = mysqli_connect("127.0.0.1", "root", "", "bduca");
                $consulta = mysqli_query($conexion, "SELECT * FROM examen WHERE id_examen >= '".$_POST['boton']."' ");
                $examen = mysqli_fetch_array($consulta);
                $id_tema = $examen['id_tema'];


                /* Creacion del examen */

                $consultaPreguntas = mysqli_query($conexion, "SELECT * FROM bateriapreguntas WHERE id_tema = '".$id_tema."'");
                $nPreguntas = mysqli_num_rows($consultaPreguntas);
                for($i = 0; $i < $nPreguntas; $i++){
                    $preguntas[$i] = mysqli_fetch_array($consultaPreguntas);
                }

                $preguntasExamenLocal = [];
                for($numeroPreguntasExamenLocal = 1; $numeroPreguntasExamenLocal <= 2; $numeroPreguntasExamenLocal++){
                    do{
                        $n = rand(0, $nPreguntas);
                    }while(in_array($n, $preguntasExamenLocal));
                    array_push($preguntasExamenLocal, $n);
                }
                $_POST['pregunta'] = 1;

                echo $examen['nombre_examen'];
                echo '</h1>';
                echo '<div class="cuestionario">';
                   if($_POST){
                    echo '<h4 class="pregunta">Pregunta 1 -'.$preguntas[$_POST['pregunta']]['pregunta'].'</h4>';
                    echo '<form method="POST">';
                        for($i=1; $i<=4; $i++){
                            echo '<div class="opcion"><input type="radio" name="respuesta" value="'.$i.'">'.$preguntas[$_POST['pregunta']]['opcion'.$i.''].'</div>';
                        }
                        echo '<button name="pregunta" value="'.(string)($_POST['pregunta']+1).'" type="submit">Siguiente pregunta</button>';
                    echo '</form>';
                   }
                echo '</div>';
            }
            else{
                echo '<h4>ERROR 300</h4>';
                echo '<p>No se ha encontrado ninguna opcion de carga valida</p>';
            }
        ?>

    </body>
</html>