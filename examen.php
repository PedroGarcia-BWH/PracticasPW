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
                height: 400px;
                border: 2px solid;
            }

            .pregunta{
                margin-top: 10px;
                margin-left: 10px;
                font-weight: bold;
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

                echo $examen['nombre_examen'];
                echo '</h1>';
                echo '<div class="cuestionario">';
                    echo '<h4 class="pregunta">Pregunta 1 - Como se pasan por variable a través de paginas en Laravel?';
                        //TODO - Cargar pregunta desde base de datos
                    echo '</h4>';
                    //TODO - Formulario tipo lista con las opciones
                echo '</div>';
            }
            else{
                echo '<h4>ERROR 300</h4>';
                echo '<p>No se ha encontrado ninguna opcion de carga valida</p>';
            }
        ?>
    </body>
</html>