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
            .textbox{
                width:50%;
            }
        </style>
    </head>
            
    <body>
        <h1>Gestión de preguntas para Examenes<h1>
        <br><form method="post">Seleccione la acción que desea hacer<br>
        <input name="accion" type="radio" value = "create"  />Crear<br>
        <input name="accion" type ="radio" value="modify" />Modificar<br>
        <input name="accion" type ="radio" value="delete" />Eliminar<br>
        <input type="submit" value= "enviar">
        <form>

        <?php
        $tema = $_COOKIE['tema'];
        $enlace = mysqli_connect("127.0.0.1","root","", "bduca");

        
        if(isset($_POST['accion']))
        {
            
            if($_POST['accion'] == "delete")
            {
                echo "<br /> Seleccione la pregunta a eliminar: <br />";
                $consulta = mysqli_query($enlace, "select * from bateriapreguntas where id_tema = 4  ");
                
                $nfilas = mysqli_num_rows ($consulta);
                echo "<form method='post'>";
                for ($i=0; $i<$nfilas; $i++)
                {
                    $fila = mysqli_fetch_array ($consulta);
                    echo "<br>";
                    $pregunta = $fila["pregunta"];
                    $id = $fila["id_pregunta"];
                    echo "<input name='selPreguntaErase' type='radio' value = $id />$pregunta";
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
                echo "<br>Seleccione la respuesta correcta y seleccione enviar una vez introducido los datos:<br>";
                echo "<br /><input name='correcta' type='radio' value = 'opcion1' checked='checked' />Respuesta 1 =
                <input class='textbox' type='text' name='respuesta1'><br />";
                echo "<br><input name='correcta' type ='radio' value='opcion2' />Respuesta 2 = <input class='textbox' type='text' name='respuesta2'><br>";
                echo "<br><input name='correcta' type ='radio' value='opcion3' />Respuesta 3 =<input class='textbox' type='text' name='respuesta3'><br>";
                echo "<br><input name='correcta' type ='radio' value='opcion4' />Respuesta 4 =<input class='textbox' type='text' name='respuesta4'><br>";
                echo "<input type='submit' value= 'enviar'>";
                echo "<form>";
                       
            }
        
            if($_POST['accion'] == "modify")
            {
                echo "<br /> Seleccione la pregunta: <br />";
                $consulta = mysqli_query($enlace, "select * from bateriapreguntas where id_tema = 4  ");
                
                $nfilas = mysqli_num_rows ($consulta);
                echo "<form method='post'>";
                for ($i=0; $i<$nfilas; $i++)
                {
                    $fila = mysqli_fetch_array ($consulta);
                    echo "<br>";
                    $pregunta = $fila["pregunta"];
                    $id = $fila["id_pregunta"];
                    echo "<input name='selPregunta' type='radio' value = $id />$pregunta";
                }
                echo "<br>";
                echo "<input type='submit' value= 'Aceptar'>";
                echo "<form>";

                  
            }
            
        }

            if(isset($_POST['selMod']))
            {
                $selMod = $_POST['selMod'];
                $mod = $_POST['mod'];
                if($mod == $_COOKIE['correcta']){
                    $nombre = mysqli_query($enlace, "update bateriapreguntas set $selMod = $mod, correcta = $mod where id_pregunta = $selPregunta "); //mirar esto
                    header('Location: final.php');
                }else{
                    $nombre = mysqli_query($enlace, "update bateriapreguntas set $selMod = $mod, where id_pregunta = 2"); //mirar esto
                    header('Location: final.php');
                }
            }
            if(isset($_POST['correcta']))
            {
                $pregunta= $_POST['pregunta'];$respuesta1 =$_POST["respuesta1"];$respuesta2 =$_POST["respuesta2"];$respuesta3 =$_POST["respuesta3"];$respuesta4 =$_POST["respuesta4"];$correcta=$_POST["correcta"];
                $nombre = mysqli_query($enlace, "insert into bateriapreguntas (id_tema, pregunta, opcion1, opcion2, opcion3, opcion4,correcta) values ('".$tema."','".$pregunta."'.,'".$respuesta1."','".$respuesta2."','".$respuesta3."','".$respuesta4."','".$correcta."')"); //mirar esto
                header('Location: final.php');
            }
            if(isset($_POST['selPreguntaErase'])){
                $selpregunta = $_POST['selPreguntaErase'];
                
                
              // $nombre = mysqli_query($enlace, "delete from bateriapreguntas where id_pregunta =  $selpregunta"); //mirar esto
               header('Location: final.php');
            } 

            if(isset($_POST['selPregunta']))
                {
                    $selpregunta = $_POST['selPregunta'];
                    $consulta = mysqli_query($enlace, "select * from bateriapreguntas where id_pregunta = $selpregunta ");
                    $fila = mysqli_fetch_array ($consulta);
                    $pregunta = $fila['pregunta']; $p1 =  $fila['opcion1']; $p2 = $fila['opcion2']; $p3 = $fila['opcion3']; $p4 = $fila['opcion4'];
                    $ok = setcookie("correcta",$fila['correcta']);
                    echo "Selecciona que quiere modificar";
                    echo "<form method='post'>"; 
                    echo "<br> <input name='selMod' type='radio' value = 'pregunta' />Pregunta:  $pregunta <br>";
                    echo "<br> <input name='selMod' type='radio' value = 'opcion1' />Respuesta 1: $p1 <br>";
                    echo "<br> <input name='selMod' type='radio' value = 'opcion2' />Respuesta 2: $p2  <br>";
                    echo "<br> <input name='selMod' type='radio' value = 'opcion3' />Respuesta 3: $p3 <br>";
                    echo "<br> <input name='selMod' type='radio' value = 'opcion4' />Respuesta 4: $p4 <br>";
                    echo"<br>Introduce la modificación:<br>";
                    echo "<br><input class='textbox' type='text' name='mod'><br>";

                    echo "<input type='submit' value= 'Aceptar'>";
                    echo "<form>";

                
                }
                       
    ?>
    <body>
<html>