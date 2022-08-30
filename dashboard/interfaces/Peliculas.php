<?php
require "../core/config.php";
require "../../Controller/BasedeDatos.php";

$sql = "SELECT * FROM PELICULA";
$result = mysqli_query($con, $sql);
$r = mysqli_fetch_all($result, MYSQLI_ASSOC);
if (mysqli_query($con, $sql)) {
} else {
  echo "error " . $sql . "<br>" . mysqli_error($con);
}
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="<?= ROOT_ADMIN ?>/assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Topcine Admin Dashboard</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?= ROOT_ADMIN ?>/assets/img/favicon/logo-TopCine.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="<?= ROOT_ADMIN ?>/assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="<?= ROOT_ADMIN ?>/assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?= ROOT_ADMIN ?>/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?= ROOT_ADMIN ?>/assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?= ROOT_ADMIN ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="<?= ROOT_ADMIN ?>/assets/vendor/libs/apex-charts/apex-charts.css" />

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="<?= ROOT_ADMIN ?>/assets/vendor/js/helpers.js"></script>

  <!-- sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="<?= ROOT_ADMIN ?>/assets/js/config.js"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
              <img style="width: 70px;" src="<?= ROOT_ADMIN ?>/assets/img/favicon/logo-TopCine.png">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Topcine</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-item">
            <a href="/ProyectoIG2/dashboard/" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Dashboard</div>
            </a>
          </li>

          <!-- Layouts -->
          <li class="menu-item  active">
            <a href="Peliculas.php" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-video"></i>
              <div data-i18n="Layouts">Peliculas</div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item">
                <a href="Peliculas.php" class="menu-link">
                  <div data-i18n="Without menu">Estrenos</div>
                </a>
              </li>
              </a>
          </li>
        </ul>
        </li>
        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-coffee"></i>
            <div data-i18n="Account Settings">Snacks</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="Combos.php" class="menu-link">
                <div data-i18n="Account">Combos</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="Combos.php" class="menu-link">
                <div data-i18n="Notifications">Bebidas</div>
              </a>
            </li>
          </ul>
        </li>
        <li class="menu-item">
          <a href="Promociones.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-cool"></i>
            <div data-i18n="Authentications">Promociones</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="Facturas.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-money"></i>
            <div data-i18n="Misc">Facturas</div>
          </a>
        </li>
        <li class="menu-item">
              <a href="Salas.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-tv"></i>
                <div data-i18n="Misc">Salas</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="Usuarios.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Misc">Usuarios</div>
              </a>
            </li>
      </aside>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
              </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- Place this tag where you want the button to render. -->
              <li class="nav-item lh-1 me-3">
                <a class="github-button" href="https://github.com/themeselection/sneat-html-admin-template-free" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a>
              </li>

              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="<?= ROOT_ADMIN ?>/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="<?= ROOT_ADMIN ?>/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block">John Doe</span>
                          <small class="text-muted">Admin</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="bx bx-user me-2"></i>
                      <span class="align-middle">My Profile</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="bx bx-cog me-2"></i>
                      <span class="align-middle">Settings</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <span class="d-flex align-items-center align-middle">
                        <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                        <span class="flex-grow-1 align-middle">Billing</span>
                        <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                      </span>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="auth-login-basic.html">
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!--/ User -->
            </ul>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Películas/</span> Estrenos</h4>
            <button class="btn btn-primary py-2 mb-4" data-bs-toggle="modal" data-bs-target="#NuevaPelicula">Nueva Pelicula</button>
            <!-- Form de Registro de Nueva Pelicula (Modal) -->
            <div class="col-lg-4 col-md-3">
              <!-- Modal -->
              <div class="modal fade modal" id="NuevaPelicula" data-bs-backdrop="static" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <form class="modal-content needs-validation" method="POST">
                    <div class="modal-header">
                      <h5 class="modal-title" id="backDropModalTitle">Nueva Pelicula</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col mb-3">
                          <label for="Nombre_Pelicula" class="form-label">Nombre Pelicula</label>
                          <input type="text" id="Nombre_Pelicula" class="form-control" placeholder="Ingrese el Nombre" autofocus />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="Actores_Principales" class="form-label">Actores Principales</label>
                          <input type="text" id="Actores_Principales" class="form-control" placeholder="Ej:Crhis, Alan, etc" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="Actores_Secundarios" class="form-label">Actores Secundarios</label>
                          <input type="text" id="Actores_Secundarios" class="form-control" placeholder="Ej:Crhis, Alan, etc" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="Idioma" class="form-label">Idioma</label>
                          <input type="text" id="Idioma" class="form-control" placeholder="Ingrese el Idioma" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="Estreno" class="form-label">Estreno</label>
                          <input type="date" id="Estreno" class="form-control" placeholder="yyyy/mm/dd" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="Banner_Pelicula" class="form-label">Banner</label>
                          <input type="text" id="Banner_Pelicula" class="form-control" placeholder="Suba un Archivo" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="Duracion" class="form-label">Duración</label>
                          <input type="text" id="Duracion" class="form-control" placeholder="Tiempo en minutos" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="Sinopsis" class="form-label">Sinopsis</label>
                          <input type="text" id="Sinopsis" class="form-control" placeholder="Sinopsis" />
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                        Cancelar
                      </button>
                      <button type="button" class="btn btn-primary" id="Guardar_Pelicula" data-bs-dismiss="modal">
                        Guardar
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- /Inicio Form Update Pelicula (Modal)-->
            <div class="col-lg-4 col-md-3">
              <!-- Modal -->

              <div class="modal fade modal" id="EditPelicula" data-bs-backdrop="static" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <form class="modal-content needs-validation" method="POST">
                    <div class="modal-header">
                      <h5 class="modal-title" id="backDropModalTitle">Editar Pelicula</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col mb-3">
                          <label for="N_Nombre_Pelicula" class="form-label">Nombre Pelicula</label>
                          <input type="text" id="N_Nombre_Pelicula" class="form-control" placeholder="Ingrese el Nombre" autofocus />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="N_Actores_Principales" class="form-label">Actores Principales</label>
                          <input type="text" id="N_Actores_Principales" class="form-control" placeholder="Ej:Crhis, Alan, etc" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="N_Actores_Secundarios" class="form-label">Actores Secundarios</label>
                          <input type="text" id="N_Actores_Secundarios" class="form-control" placeholder="Ej:Crhis, Alan, etc" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="N_Idioma" class="form-label">Idioma</label>
                          <input type="text" id="N_Idioma" class="form-control" placeholder="Ingrese el Idioma" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="N_Estreno" class="form-label">Estreno</label>
                          <input type="date" id="N_Estreno" class="form-control" placeholder="yyyy/mm/dd" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="N_Banner_Pelicula" class="form-label">Banner</label>
                          <input type="text" id="N_Banner_Pelicula" class="form-control" placeholder="Suba un Archivo" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="N_Duracion" class="form-label">Duración</label>
                          <input type="text" id="N_Duracion" class="form-control" placeholder="Tiempo en minutos" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="N_Sinopsis" class="form-label">Sinopsis</label>
                          <input type="text" id="N_Sinopsis" class="form-control" placeholder="Sinopsis" />
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                        Cancelar
                      </button>
                      <button type="button" class="btn btn-primary" id="Actualizar_Pelicula" data-bs-dismiss="modal">
                        Guardar
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            
            <!-- /Fin Form Update Pelicula (Modal)-->
            <!-- Hoverable Table rows -->
            <div class="card">
              <h5 class="card-header">Peliculas de Estreno</h5>
              <div class="table-responsive text-wrap">
                <table class="table  table-sm table-hover">
                  <thead>
                    <tr class="text-wrap">
                      <th>Id</th>
                      <th>Título</th>
                      <th>Actores Principales</th>
                      <th>Actores Secundarios</th>
                      <th>Idioma</th>
                      <th>Estreno</th>
                      <th>Banner</th>
                      <th>Duración</th>
                      <th>Sinapsis</th>
                      <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php
                    foreach ($r  as $pelicula) {
                      echo "<tr>
                        <td><i class='fab fa-angular fa-lg text-danger me-3'></i> <strong>${pelicula['ID_PELICULA']}</strong></td>
                        <td>${pelicula['TITULO_PELICULA']}</td>
                        <td>${pelicula['ACTPRIN_PELICULA']}</td>
                        <td>${pelicula['ACTSECUN_PELICULA']}</td>
                        <td>${pelicula['IDIOMA_PELICULA']}</td>
                        <td>${pelicula['ESTRENO_PELICULA']}</td>
                        <td> <img class='img-fluid rounded' src='../../${pelicula['IMAGEN_PELICULA']}' </img> </td>
                        <td>${pelicula['DURACION_PELICULA']} minutos</td>
                        <td class='text-sm'>${pelicula['SINOPSIS_PELICULA']}</td>
                        <td>
                          <div class='dropdown'>
                            <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                              <i class='bx bx-dots-vertical-rounded'></i>
                            </button>
                            <div class='dropdown-menu'>
                            <a class='dropdown-item' data-bs-toggle = 'modal' data-bs-target = '#NuevaPelicula'
                            ><i class='bx bx-bookmark-plus me-1'></i> Añadir</a
                          >
                              <a class='dropdown-item' data-bs-toggle = 'modal' data-bs-target = '#EditPelicula' onclick='rellenarFormulario(${pelicula['ID_PELICULA']})'
                                ><i class='bx bx-edit-alt me-1'></i> Edit</a
                              >
                              <a class='dropdown-item' id='${pelicula['ID_PELICULA']}' onclick='Eliminar_Pelicula(this.id)' href='javascript:void(0);'
                                ><i class='bx bx-trash me-1'></i> Delete</a
                              >
                            </div>
                          </div>
                        </td>
                      </tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!--/ Hoverable Table rows -->
          </div>
        </div>
        <!-- / Content -->

        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
          <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
              ©
              <script>
                document.write(new Date().getFullYear());
              </script>
              , made with ❤️ by
              <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
            </div>
            <div>
              <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
              <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

              <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>

              <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="footer-link me-4">Support</a>
            </div>
          </div>
        </footer>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
      </div>
      <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
  </div>

  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
  </div>


  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="<?= ROOT_ADMIN ?>/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="<?= ROOT_ADMIN ?>/assets/vendor/libs/popper/popper.js"></script>
  <script src="<?= ROOT_ADMIN ?>/assets/vendor/js/bootstrap.js"></script>
  <script src="<?= ROOT_ADMIN ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="<?= ROOT_ADMIN ?>/assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="<?= ROOT_ADMIN ?>/assets/vendor/libs/apex-charts/apexcharts.js"></script>

  <!-- Main JS -->
  <script src="<?= ROOT_ADMIN ?>/assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="<?= ROOT_ADMIN ?>/assets/js/dashboards-analytics.js"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <!-- dasboard crud -->
  <script src="../core/crud_Peliculas/Insert_pelicula.js"></script>
  <script src="../core/crud_Peliculas/Delete_pelicula.js"></script>
  <script src="../core/crud_Peliculas/Update_pelicula.js"></script>
</body>

</html>