<html>

    <head>
    <h1> Sistema de exámenes P1 </h1>  
    </head>
    <body>

    <FORM METHOD=POST>
            Correo electrónico:
            <INPUT NAME="correo" TYPE="text" SIZE=15 MAXLENGTH=100>
            <br/>
            Contraseña:
            <INPUT NAME="passwd" TYPE="password" SIZE=15 MAXLENGTH=10>
            <br/>
            <INPUT TYPE="submit" VALUE="Iniciar sesión">
        </FORM>

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

                            break;
                        
                        case 2:

                            break;

                    }

                }else{

                    echo "<h3> Usuario/contraseña incorrectos </h3>";

                }
            
            }
            

        ?>
    </body>

</html>