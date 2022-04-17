<html>
<head>
        <title>Menú profesorado</title>
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

            h4{
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

            .boton{
                margin-top: 20px;
            }

            th, tr, td{
                border: 2px solid black;
            }
        </style>
    </head>
            
    <body>
        <?php
            echo '<div id="head">';
            echo '<h3>GESTION DE PREGUNTAS PARA EXAMENES';
            echo '</h3>';
            echo '<a href="index.php" id="cerrar-sesion">Cerrar sesión</a>';
            echo '</div>';
        ?>
        <br><form method="post">
        <h4>Seleccione la acción que desea hacer:</h4>
        <input name="accion" type="radio"  checked='checked' value = "create"  />Crear<br>
        <input name="accion" type ="radio" value="modify" />Modificar<br>
        <input name="accion" type ="radio" value="delete" />Eliminar<br>
        <input class="boton" type="submit" value= "enviar">
        <form>

        <?php
        $tema = $_COOKIE['tema'];
        $enlace = mysqli_connect("127.0.0.1","root","", "bduca");

        
        if(isset($_POST['accion']))
        {
            
            if($_POST['accion'] == "delete")
            {
                echo "<br><h4>Seleccione la pregunta a eliminar:</h4>";
                $consulta = mysqli_query($enlace, "select * from bateriapreguntas where id_tema = 4  ");
                
                $nfilas = mysqli_num_rows ($consulta);
                echo "<form method='post'>";
                for ($i=0; $i<$nfilas; $i++)
                {
                    $fila = mysqli_fetch_array ($consulta);
                    $pregunta = $fila["pregunta"];
                    $id = $fila["id_pregunta"];
                    echo "<input name='selPreguntaErase' type='radio' checked='checked' value = $id />$pregunta";
                    echo "<br>";
                }
                echo "<br>";
                echo "<input type='submit' value= 'Aceptar'>";
                echo "<form>";

                
            } 
            if($_POST['accion'] == "create")
            {
                echo "<br>Introduzca la pregunta:<br>";
                echo "<br><input class='textbox' type='text' name='pregunta'><br>";
                    
                echo "<br><form method='post'><br>";
                echo "<br><h2>Seleccione la respuesta correcta y seleccione enviar una vez introducido los datos:</h2><br>";
                echo "<br /><input name='correcta' type='radio' value = '1' checked='checked' />Respuesta 1 =
                <input class='textbox' type='text' name='respuesta1'><br />";
                echo "<br><input name='correcta' type ='radio' value='2' />Respuesta 2 = <input class='textbox' type='text' name='respuesta2'><br>";
                echo "<br><input name='correcta' type ='radio' value='3' />Respuesta 3 =<input class='textbox' type='text' name='respuesta3'><br>";
                echo "<br><input name='correcta' type ='radio' value='4' />Respuesta 4 =<input class='textbox' type='text' name='respuesta4'><br>";
                echo "<input class='boton' type='submit' value= 'enviar'>";
                echo "<form>";     
            }
        
            if($_POST['accion'] == "modify")
            {
                echo "<br><h4>Seleccione la pregunta:</h4>";
                $consulta = mysqli_query($enlace, "select * from bateriapreguntas where id_tema = 4  ");
                
                $nfilas = mysqli_num_rows ($consulta);
                echo "<form method='post'>";
                for ($i=0; $i<$nfilas; $i++)
                {
                    $fila = mysqli_fetch_array ($consulta);
                    $pregunta = $fila["pregunta"];
                    $id = $fila["id_pregunta"];
                    echo "<input name='selPregunta' type='radio' checked='checked' value = $id />$pregunta";
                    echo "<br>";
                }
                echo "<input class='boton' type='submit' value= 'Aceptar'>";
                echo "<form>";            
            }         
        }
            if(isset($_POST['selMod']))
            {
                $selMod = $_POST['selMod'];
                $mod = $_POST['mod'];
                $id = $_COOKIE['id_pregunta'];

                echo "update bateriapreguntas set $selMod = ".$mod." where id_pregunta = $id";
                $nombre = mysqli_query($enlace, "update bateriapreguntas set $selMod = '$mod' where id_pregunta = $id"); //mirar esto
                header('Location: final.php');
                
            }
            if(isset($_POST['correcta']))
            {
                $pregunta= $_POST['pregunta'];$respuesta1 =$_POST["respuesta1"];$respuesta2 =$_POST["respuesta2"];$respuesta3 =$_POST["respuesta3"];$respuesta4 =$_POST["respuesta4"];$correcta=$_POST["correcta"];
               
                $nombre = mysqli_query($enlace, "insert into bateriapreguntas (id_tema, pregunta, opcion1, opcion2, opcion3, opcion4,correcta) values 
                ($tema,'".$pregunta."','".$respuesta1."','".$respuesta2."','".$respuesta3."','".$respuesta4."','".$correcta."')"); //mirar esto
                header('Location: final.php');
            }
            if(isset($_POST['selPreguntaErase'])){
                $selpregunta = $_POST['selPreguntaErase'];
                
                
               $nombre = mysqli_query($enlace, "delete from bateriapreguntas where id_pregunta =  $selpregunta"); //mirar esto
               header('Location: final.php');
            } 

            if(isset($_POST['selPregunta']))
                {
                    $selpregunta = $_POST['selPregunta'];
                    $consulta = mysqli_query($enlace, "select * from bateriapreguntas where id_pregunta = $selpregunta ");
                    $fila = mysqli_fetch_array ($consulta);
                    $pregunta = $fila['pregunta']; $p1 =  $fila['opcion1']; $p2 = $fila['opcion2']; $p3 = $fila['opcion3']; $p4 = $fila['opcion4'];
                    $ok = setcookie("id_pregunta", $selpregunta);
                    $ok = setcookie("correcta",$fila['correcta']);
                    echo "<h4>Selecciona que quiere modificar</h4>";
                    echo "<form method='post'>"; 
                    echo "<input name='selMod' type='radio' value = 'pregunta' />Pregunta:  $pregunta";
                    echo "<br> <input name='selMod' type='radio' checked='checked' value = 'opcion1' />Respuesta 1: $p1";
                    echo "<br> <input name='selMod' type='radio' value = 'opcion2' />Respuesta 2: $p2";
                    echo "<br> <input name='selMod' type='radio' value = 'opcion3' />Respuesta 3: $p3";
                    echo "<br> <input name='selMod' type='radio' value = 'opcion4' />Respuesta 4: $p4";
                    echo"<br><br>Introduce la modificación:<br>";
                    echo "<br><input class='textbox' type='text' name='mod'><br>";

                    echo "<input class='boton' type='submit' value= 'Aceptar'>";
                    echo "<form>";
                }              
    ?>
    <body>
<html>