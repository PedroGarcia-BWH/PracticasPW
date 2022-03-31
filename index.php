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
        <h1 STYLE="text-align: center;">Sistemas de Gestion Web de Exámenes</h1>
        <hr>
        <form METHOD=POST STYLE="display: flex; height:fit-content; flex-direction:column; width:50%; margin:auto; max-width:500px">
            <h2 STYLE="text-align: center;">Iniciar Sesión</h2>
            <div STYLE="display:inline-flex; height: fit-content;">
                <p>Correo electrónico: </p>
                <input TYPE="text" NAME="user" MAXLENGTH=60 STYLE="height: fit-content; margin-left:36px; width:100%"><br><br>
            </div>
            <br>
            <div style="display:inline-flex; height: fit-content;">
                <p>Contraseña: </p>
                <input TYPE="password" NAME="passwd" MAXLENGTH=10 STYLE="height: fit-content; margin-left:10px; width:100%"><br><br>
            </div>
            <br>
            <input STYLE="font-size:small; padding-left: 20px; padding-right: 20px; justify-content:center; height:2em" TYPE="submit" VALUE="Iniciar sesión">
        </form>
    </body>
</html>

<FORM METHOD=POST>
            Correo electrónico:
            <INPUT NAME="correo" TYPE="text" SIZE=15 MAXLENGTH=100>
            <br/>
            Contraseña:
            <INPUT NAME="passwd" TYPE="password" SIZE=15 MAXLENGTH=10>
            <br/>
            <INPUT TYPE="submit" VALUE="Iniciar sesión">
        </FORM>