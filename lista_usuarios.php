<?php
session_start();
if (!isset($_SESSION["id"]))
    header("Location: login.php");
else {
    if (!$_SESSION["permisos"])
        header("Location: cita.php");

    $token = true;
    include("logica/conectar.php");
    $usuarios = $con->query("SELECT * FROM usuario");

}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/datatables.min.css">
    <link href="css/fontawesome-free-6.0.0-beta3-web/css/all.css" rel="stylesheet">
    <!--load all styles -->
</head>

<body>
    <nav>
        <div class="nav-wrapper navcolor fixed">
            <div class="container">
                <a href="lista.php" class="brand-logo texto-logo">Solicitudes</a>
                <ul class="right hide-on-med-and-down">
                    <li><a>Bienvenido <?php echo $_SESSION["nombre"] ?></a></li>
                    <li><a href="lista.php">Revisar Citas</a></li>
                    <li><a href="lista_usuarios.php">Ver usuarios</a></li>
                    <li><a href="logica/logout.php">Salir</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row contenedor">
        <div class="col s12 m4">
            <img src="img/logo.png" class="responsive-img" alt="">
        </div>
        <div class="col s12 m4 center">
            <img src="img/usuarios.png" height="250px" width="250px" class="responsive-img" alt="">
        </div>
        <div class="col s12 m4 hide-on-med-and-down"></div>
    </div>

    <div class="container">
        <div class="row">
            <h5 class="title title-table">Usuarios</h5>
            <table id="tabla" class="striped center">
                <thead class="table-head">
                    <th>Nombre</th>
                    <th>Cédula</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php while($row = $usuarios->fetch_assoc()){ ?>
                    <td><?php echo $row["nombre"] ?></td>
                    <td><?php echo $row["cedula"] ?></td>
                    <td><?php echo $row["email"] ?></td>
                    <td><?php echo $row["direccion"] ?></td>
                    <td><a class="btn btn-flat" href="ver_usuario.php?id=<?php echo $row["id_usuario"] ?>"><i class="fas fa-eye"></i></a></td>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/elementos_materialize.js"></script>
    <script src="js/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": "No hay data encontrada",
                    "info": "Total: _MAX_ resultados",
                    "infoEmpty": "No hay coincidencias",
                    "infoFiltered": "",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });
    </script>
</body>

</html>