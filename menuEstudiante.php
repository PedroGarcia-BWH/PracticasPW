<html>
    <head>
        <title>Menu estudiante</title>
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
                background-color: lightgray;
                font-size: larger;
            }

            body{
                padding: 20px 40px;
                max-width: 800px;
                margin: 0px auto;
            }

            .menu{
                border: 2px solid;
                margin-top: 20px;
                margin-bottom: 10px;
            }

            .menu form{
                margin: 0px;
            }

            .menu button{
                width: 100%;
                height: 3em;
            }

            #cerrar-sesion{
                text-decoration: underline;
                font-size: small;
                cursor: pointer;
                color: blue;
            }

            table{
                width: 100%;
                text-align: center;
                border: 2px solid;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th, tr, td{
                border: 2px solid black;
            }
        </style>
    </head>
    <body>
        <?php
            //Conexion a base de datos
            $conexion = mysqli_connect("127.0.0.1", "root", "", "bduca");
            $id_usuario = 1;
            //Obtener nombre y apellidos del usuario
            $consulta = mysqli_query($conexion, "SELECT * FROM usuario WHERE id_usuario = '".$id_usuario."'");
            $consulta = mysqli_fetch_array($consulta);

            $nombre = $consulta['nombre'];
            $apellido = $consulta['apellido'];
            echo '<h3>Bienvenido, '.$nombre .' '. $apellido;
        ?>
        <div class="menu">
            <h2 id="title">MENU ESTUDIANTE</h2>
            <form method="POST">
                <button name="boton" value="examen" type="submit">Realizar examen</button>
                <button name="boton" value="calificacion" type="submit">Consultar calificaciones</button>
            </form>
        </div>
        <a href="./index.php" id="cerrar-sesion">Cerrar sesion</a>
        <br>
        <?php
            if($_POST){
                if($_POST["boton"] == 'examen'){
                    $fechaActual = date('Y-m-d');
                    $consulta = mysqli_query($conexion, "SELECT * FROM examen WHERE fecha >= '".$fechaActual."' ");
                    $rows = mysqli_num_rows($consulta);

                    if($rows == 1){
                        echo '<div style="margin-top: 20px" >Se ha encontrado los siguientes examenes pendientes: </div>';
                    }
                    
                    echo "<table style>";
                    echo "<tr>";
                        echo "<th>Examen";
                        echo "<th>Fecha";
                        echo "<th>Disponibilidad";
                    for($i = 0; $i<$rows; $i++){
                        $examen = mysqli_fetch_array($consulta);
                        echo "<tr>";
                            echo "<td>".$examen['nombre_examen'];
                            if($examen['fecha'] == $fechaActual){
                                echo '<td style="background-color:#FF000055; color:#FF0000; width: 20%;">'.$examen['fecha'];
                                echo '<td style="width:20%;"><button name="examen" value='.$examen['id_examen'].'; style="width:100%; ; border:0px; text-decoration:underline; color:blue; cursor:pointer">Realizar</button>';
                            }
                            else{
                                echo "<td>".$examen['fecha'];
                                echo '<td style="width:20%;"><button name="examen" value='.$examen['id_examen'].'; style="width:100%; ; border:0px; cursor:default; color: gray;">No disponible</button>';
                            }
                    }
                    echo "</table>";
                }
                elseif($_POST["boton"] == 'calificacion'){
                    $consulta = mysqli_query($conexion, "SELECT * FROM calificacion WHERE id_alumno = '".$id_usuario."'");
                    $rows = mysqli_num_rows($consulta);
                    echo "<table>";
                        echo "<tr>";
                            echo '<th style="width:80%">Examen</th>';
                            echo "<th>Calificacion</th>";
                        echo "</tr>";
                    for($i=0; $i<$rows; $i++){
                        $res = mysqli_fetch_array($consulta);
                        //Conseguir nombre examen
                        $queryNomExam = mysqli_query($conexion, "SELECT nombre_examen FROM examen WHERE id_examen = '".$res['id_examen']."'");
                        $nomExam = mysqli_fetch_array($queryNomExam);
                        //Construccion tabla calificaciones
                        echo "<tr>";
                            echo "<td>" .$nomExam['nombre_examen'];
                            if($res['calificacion'] >= 5){
                                echo '<td style="color:#34B233; font-weight:bold; background-color: #34B23333;">' .$res['calificacion'];
                            }
                            else{
                                echo '<td style="color:#FF0000; font-weight:bold; background-color: #FF000055;">' .$res['calificacion'];
                            }
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            }
            mysqli_close($conexion);
        ?>
    </body>
</html>