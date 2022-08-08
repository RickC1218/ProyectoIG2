<?php
    echo '<section class="row">
    <div class="clearfix"></div>
    <div class="col-12">
        <h2><strong>Hola,</strong> bienvenido Nombre Apellido</h2>
    </div>
    <div id="perfil" class="col-6 col-sm-6 col-lg-3 mt-4">
        <div class="card">
            <div class="avatar-perfil">
                <img src="recursos/imagenes/perfil.jpg" class="img-fluid" alt="avatar">
            </div>
            <div class="info-perfil row">
                <p class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                        class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd"
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    Editar Perfil
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    <a href="/registro.html">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                            class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path class="editar"
                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                        </svg>
                    </a>
                </p>
            </div>
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
                <tbody>
                    <tr>
                        <th scope="row">Lightyear</th>
                        <td>4</td>
                        <td>20-07-2022</td>
                        <td>$24</td>
                    </tr>
                    <tr>
                        <th scope="row">Lightyear</th>
                        <td>4</td>
                        <td>20-07-2022</td>
                        <td>$24</td>
                    </tr>
                    <tr>
                        <th scope="row">Lightyear</th>
                        <td>4</td>
                        <td>20-07-2022</td>
                        <td>$24</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>';
?>