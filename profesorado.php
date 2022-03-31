<html>
<head>
        <title>Menu profesorado</title>
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

            h2{
                background-color: lightgray;
                padding: 5px;
                padding-left: 10px;
                border-radius: 5px;
            }

            #head{
                height: fit-content;
                display: flex;
                justify-content: space-between;
            }

            #head h3{
                margin: 0;
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
                height: fit-content;
                text-decoration: underline;
                font-size: small;
                cursor: pointer;
                color: blue;
                margin: auto 1px;
            }

            table{
                width: calc(100% - 20px);
                text-align: center;
                border: 2px solid;
                border-collapse: collapse;
                margin: 0 auto;
                margin-top: 10px;
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
            echo '<div id="head">';
            echo '<h3>Bienvenido, '.$nombre .' '. $apellido;
            echo '</h3>';
            echo '<a href="./index.php" id="cerrar-sesion">Cerrar sesion</a>';
            echo '</div>';
        ?>
    <h1> Zona de profesorado</h1>
    <div class="menu">
            <h2 id="title">MENU PROFESORADO</h2>
            <form method="POST">
                <button name="boton" value="preguntas" type="submit">Gestionar Preguntas</button>
                <button name="boton" value="resultados" type="submit">Gestionar Resultados</button>
            </form>
        </div>
        <br>
        <?php
            if($_POST){
                if($_POST["boton"] == 'preguntas'){
                    $enlace = mysqli_connect("127.0.0.1", "root", "", "bduca"); 
                    $user = 1;
                    echo "<br /> Seleccione la asignatura: <br />";
                    $consulta = mysqli_query($enlace, "select * from asignatura where id_profesor = $user ");
                    
                    $nfilas = mysqli_num_rows ($consulta);
                    echo "<form action = temas.php method='post'>";
                    for ($i=0; $i<$nfilas; $i++)
                    {
                        $fila = mysqli_fetch_array ($consulta);
                        echo "<br>";
                        $asig = $fila["nombre_asig"];
                        $id = $fila["id_asig"];
                        echo "<input name='seleccion' type='radio' value = $id />$asig";
                    }
                    echo "<br>";
                    echo "<input type='submit' value= 'Aceptar'>";
                    echo "<form>";
                    
                       
                
            }elseif($_POST["boton"] == 'resultados'){
                $enlace = mysqli_connect("127.0.0.1", "root", "", "bduca"); 
                    $user = 1;
                    echo "<br /> Seleccione la asignatura para ver los resultados: <br />";
                    $consulta = mysqli_query($enlace, "select * from asignatura where id_profesor = $user ");
                    
                    $nfilas = mysqli_num_rows ($consulta);
                    echo "<form action = temasResultados.php method='post'>";
                    for ($i=0; $i<$nfilas; $i++)
                    {
                        $fila = mysqli_fetch_array ($consulta);
                        echo "<br>";
                        $asig = $fila["nombre_asig"];
                        $id = $fila["id_asig"];
                        echo "<input name='seleccion' type='radio' value = $id />$asig";
                    }
                    echo "<br>";
                    echo "<input type='submit' value= 'Aceptar'>";
                    echo "<form>";
            }
            mysqli_close($enlace);
        }
        ?>
</html>