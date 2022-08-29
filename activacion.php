<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/estilos.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/activacion.js"></script>
    <title>Inicio de sesión | TopCine</title>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
</head>

<body>
    <section class="background-radial-gradient overflow-hidden">
        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <h1 class="fw-bold ls-tight mb-4" style="color: hsl(218, 81%, 95%); text-align:center;">
                <i>"Anywhere,</i>
                <span style="color: hsl(218, 81%, 75%)"><i>Anytime,</i></span>
                <span style="color: hsl(218, 89%, 55%)"><i>Anyplace..."</i></span>
            </h1>
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <a href="index.html">
                        <img src="resources/imagenes/logo-TopCine.png" class="img-fluid" alt="logo">
                    </a>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div class="card bg-glass">
                        <div class="card-body px-4 py-5 px-md-5">
                            <?php
                            require 'php/conexion.php';
                            $msg = '';
                            if (!empty($_GET['code']) && isset($_GET['code'])) {
                                $code = $_GET['code'];


                                $sql = "SELECT NUMCED_CLI FROM CLIENTE WHERE ACTIVACION_CLI='$code'";
                                $result = $conexion->query($sql);
                                $resultado = $result->fetchAll(PDO::FETCH_ASSOC);

                                if (sizeof($resultado) > 0) {

                                    $sql2 = "SELECT NUMCED_CLI FROM CLIENTE WHERE ACTIVACION_CLI='$code' and STATUS_CLI ='0'";
                                    $result = $conexion->query($sql2);
                                    $resultado2 = $result->fetchAll(PDO::FETCH_ASSOC);

                                    if (sizeof($resultado2) == 1) {

                                        $sql3 = "UPDATE CLIENTE SET STATUS_CLI='1' WHERE ACTIVACION_CLI='$code'";
                                        $result = $conexion->query($sql3);
                                        $resultado3 = $result->fetchAll(PDO::FETCH_ASSOC);
                                        $msg = "Your account is activated";
                                    } else {
                                        $msg = "Your account is already active, no need to activate again";
                                    }
                                } else {
                                    $msg = "Wrong activation code.";
                                }
                            }
                            ?>
                            <?php echo $msg; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>