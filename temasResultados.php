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
     if($_POST){
        $enlace = mysqli_connect("127.0.0.1","root","", "bduca");
        $id_asig = $_POST["seleccion"];
        $consulta = mysqli_query($enlace, "select * from tema where id_asignatura = $id_asig ");
        
        echo "<br /> Seleccione el tema para ver los Resultados: <br />";

        $nfilas = mysqli_num_rows ($consulta);
        echo "<form action = 'gestionResultados.php'  method='post'>";
        for ($i=0; $i<$nfilas; $i++)
        {
            $fila = mysqli_fetch_array ($consulta);
            echo "<br>";
            $asig = $fila["nombre_tema"];
            $id = $fila["id_tema"];
            echo "<input name='tema' type='radio' value = $id />$asig";
        }
        echo "<br>";
        echo "<input type='submit' value= 'Aceptar'>";
        echo "<form>";
        }
    ?>
</body>
</html>