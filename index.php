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
        </style>
    </head>
    <body>
        <h1 style="text-align: center;">Sistemas de Gestion Web de Examenes</h1>
        <hr>
        <form action="POST" style="display: flex; height:fit-content; flex-direction:column; width:50%; margin:auto; max-width:500px">
            <h2 style="text-align: center;">Iniciar Sesión</h2>
            <div style="display:inline-flex; height: fit-content;">
                <p>Usuario: </p>
                <input type="text" name="user" style="height: fit-content; margin-left:36px; width:100%"><br><br>
            </div>
            <br>
            <div style="display:inline-flex; height: fit-content;">
                <p>Contraseña: </p>
                <input type="password" name="password" style="height: fit-content; margin-left:10px; width:100%"><br><br>
            </div>
            <br>
            <input style="font-size:small; padding-left: 20px; padding-right: 20px; justify-content:center; height:2em" type="submit" value="Enviar">
        </form>
    </body>
</html>