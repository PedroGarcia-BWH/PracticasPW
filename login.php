<html>

    <head>
        <title>Sistema de Gestion de Examenes</title>
            <style type="text/css">
                *{
                    font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
                    position: relative;
                }

                p{
                    margin: 0;
                    padding: 0;
                    height: fit-content;
                }

                h3{
                background-color: lightgray;
                border-radius: 5px;
                text-align: center;
                width: 35%;
                margin-left: auto;
                margin-right: auto;
                }
            </style> 
    </head>
    <body>
        
    <h1 STYLE="text-align: center;">Sistemas de Gestion Web de Exámenes</h1>
        <hr>
        <form METHOD=POST STYLE="display: flex; height:fit-content; flex-direction:column; width:50%; margin:auto; max-width:500px">
            <h2 STYLE="text-align: center;">Iniciar Sesión</h2>
            <div STYLE="display:inline-flex; height: fit-content;">
                <p>Correo electrónico: </p>
                <input TYPE="text" NAME="correo" STYLE="height: fit-content; margin-left:-15px; width:100%"><br><br>
            </div>
            <br>
            <div style="display:inline-flex; height: fit-content;">
                <p>Contraseña: </p>
                <input TYPE="password" NAME="passwd" MAXLENGTH=10 STYLE="height: fit-content; margin-left:10px; width:100%"><br><br>
            </div>
            <br>
            <input STYLE="font-size:small; padding-left: 20px; padding-right: 20px; justify-content:center; height:2em" TYPE="submit" VALUE="Iniciar sesión">
        </form>

        <?php
            if(isset($_POST['correo']) && isset($_POST['passwd'])){
            
                $passwd= $_POST['passwd'];
                $correo= $_POST['correo'];
                $conexion = mysqli_connect("127.0.0.1","root","","bduca");

                $consulta = mysqli_query($conexion, "SELECT id_usuario, tipo, passwd FROM usuario WHERE correo = '".$correo."'");

                $fila = mysqli_fetch_array($consulta);
                $nfilas = mysqli_num_rows($consulta);
                mysqli_close($conexion);

                if($nfilas == 1 && password_verify($passwd, $fila["passwd"])){ //Si solamente hay una coincidencia significa que el usuario existe y ha metido los datos correctamente.
                    
                    $hash = password_hash($passwd, PASSWORD_DEFAULT, [10]);
                    session_start();
                    $_SESSION['id_usuario'] = $fila["id_usuario"];

                    switch($fila["tipo"]){
                        
                        case 1:
                            header('Location: profesorado.php');
                            break;
                        
                        case 2:
                            header('Location: menuEstudiante.php');
                            break;

                    }

                }else{

                    echo "<h3> Usuario/contraseña incorrectos </h3>";

                }
            
            }
            

        ?>
    </body>

</html>