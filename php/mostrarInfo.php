<?php
session_start();
require("conexion.php");

if (isset($_SESSION['user'])) { //verificar que la sesion exite
    $numced = $_SESSION['user'];
    $sql = "SELECT * FROM CLIENTE WHERE NUMCED_CLI=$numced";
    $result = $conexion->query($sql);
    $resultado = $result->fetchAll(PDO::FETCH_ASSOC);

    $sql2 = "SELECT titulo_pelicula, NUMBOLETOS_DETPEL, FECHCOMP_FACTURA, VALTOTAL_FACTURA
        from CLIENTE, FACTURA, DETALLE_PELICULA, PELICULA
        where CLIENTE.NUMCED_CLI=  $numced
            and FACTURA.NUMCED_CLI = $numced
            and FACTURA.ID_FACTURA = DETALLE_PELICULA.ID_FACTURA
            and DETALLE_PELICULA.ID_DETPEL = PELICULA .ID_PELICULA;";
    $result = $conexion->query($sql2);
    $resultado2 = $result->fetchAll(PDO::FETCH_ASSOC);

    echo '<section class="row">
        <div class="clearfix"></div>
        <div class="col-12">
        <h2><strong>Hola,</strong> bienvenido ' . $resultado[0]['NOMBRE_CLI'] . ' ' . $resultado[0]['APELLIDO_CLI'] . '.</h2>
        </div>
        <div id="perfil" class="col-6 col-sm-6 col-lg-3 mt-4">
            <div class="card">
                <div class="avatar-perfil">
                    <img src="resources/imagenes/perfil.jpg" class="img-fluid" alt="avatar">
                </div>

                <div class="info-perfil row">
                    <div class="col-2">
                        <p class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80%" fill="currentColor"
                                class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg>
                        </p>
                    </div>
                    <div class="col-8 text-center">
                        <p>Editar Perfil</p>
                    </div>
                    <div class="col-2 text-center">
                        <p>
                            <span id="editProfile">
                                <svg xmlns="http://www.w3.org/2000/svg" width="70%"
                                    fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path class="editarPerfil"
                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                </svg>
                            </span>
                        </p>
                    </div>
                </div>

                <div class="info-pedidos row">
                    <div class="col-2 text-center">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%"
                                fill="currentColor"class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                <path
                                    d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                <path fill-rule="evenodd"
                                    d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                            </svg>
                        </p>
                    </div>
                    <div class="col-8 text-center">
                        <p>Historial de pedidos</p>
                    </div>
                    <div class="col-2 text-center">
                        <p>
                            <span id="showRecord">
                                <svg xmlns="http://www.w3.org/2000/svg" width="90%"
                                    fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path class="mostrarPedidos"
                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path class="mostrarPedidos"
                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg>
                            </span>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-center">
                        <button id="logout" class="btn btn-primary btn-block mt-4 mb-4" style="background-color: red;">
                            Cerrar Sesión
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div id="editarInfo" class="col-12 col-sm-12 col-lg-8 mt-4">
            <div class="card pt-2 text-center">
                <h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
                        class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd"
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                    &nbsp;
                    &nbsp;
                    Editar Perfil
                </h2>
            </div>
            <div class="card">
                <form id="formMostrarCli">
                    <div class="row" id="dato">
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <label class="form-label" for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" placeholder="label" value="' . $resultado[0]['NOMBRE_CLI'] . '" />
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <label class="form-label" for="apellido">Apellido</label>
                                <input type="text" name="apellido" class="form-label" value="' . $resultado[0]['APELLIDO_CLI'] . '" />
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label" for="ci">Cédula de Identidad</label>
                            <input type="number" name="ci" class="form-label" value="' . $resultado[0]['NUMCED_CLI'] . '" readonly />
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label" for="ci">Fecha de nacimiento</label>
                            <input type="date" name="fecha" class="form-label" value="' . $resultado[0]['FECHANACIMIENTO_CLI'] . '" />
                        </div>
                        <div class="col-md-12 mb-4">
                            <label class="form-label" for="ci">Correo electrónico</label>
                            <input type="email" name="email" class="form-label" value="' . $resultado[0]['EMAIL_CLI'] . '" />
                        </div>
                        <div class="col-6">
                            <button onclick="editarInfo()" class="btn btn-primary btn-block mt-4 mb-4"
                                style="background-color: green;">
                                Actualizar cuenta
                            </button>
                        </div>
                        <div class="col-6">
                            <button onclick="borrarInfo()" class="btn btn-primary btn-block mt-4 mb-4"
                                style="background-color: red;">
                                Eliminar cuenta
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="pedidos" class="col-12 col-sm-12 col-lg-8 mt-4">
            <div class="card pt-2 text-center">
                <h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
                        class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                        <path
                            d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                        <path fill-rule="evenodd"
                            d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                    </svg>
                    &nbsp;
                    &nbsp;
                    Historial de pedidos
                </h2>
            </div>
            <div class="card ">
                <table class="table col-12 text-center">
                    <thead>
                        <tr>
                            <th scope="col">
                                <p>Película</p>
                            </th>
                            <th scope="col">
                                <p>Número de entradas</p>
                            </th>
                            <th scope="col">
                                <p>Fecha</p>
                            </th>
                            <th scope="col">
                                <p>Precio</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>';
            foreach ($resultado2 as $resultado) {
                echo '
                        <tr>
                            <th scope="row">' . $resultado['titulo_pelicula'] . '</th>
                            <td>' . $resultado['NUMBOLETOS_DETPEL'] . '</td>
                            <td>' . $resultado['FECHCOMP_FACTURA'] . '</td>
                            <td> $' . $resultado['VALTOTAL_FACTURA'] . '</td>
                        </tr>';
            }
        echo '
                    </tbody>
                </table>
            </div>
        </div>
        </section>';
} else {
    echo 'NO';
}
