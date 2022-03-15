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
                margin: 20px 40px;
            }

            .menu{
                border: 2px solid;
                margin-top: 20px;
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
                margin-top: 10px;
                cursor: pointer;
                color: blue;
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
        <p id="cerrar-sesion">Cerrar sesion</p>
        <br>
        <?php
            if($_POST){
                if($_POST["boton"] == 'examen'){
                    echo 'Examen';
                }
                elseif($_POST["boton"] == 'calificacion'){
                    $consulta = mysqli_query($conexion, "SELECT * FROM calificacion WHERE id_usuario = '".$id_usuario."'");
                    $rows = mysqli_num_rows($consulta);
                    echo "<table>
                        <tr>
                            <th>Examen</th>
                            <th>Calificacion</th>
                        </tr>
                    ";
                    for($i=0; $i<=$rows; $i++){
                        $res = mysqli_fetch_array($consulta);
                        echo "<tr>";
                            echo "<td>" .$res['id_examen'];
                            echo "<td>" .$res['calificacion'];
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            }  
        ?>
    </body>
</html>