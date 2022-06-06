<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Gas - Menu </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
          font-size: .875rem;
        }

        .feather {
          width: 16px;
          height: 16px;
          vertical-align: text-bottom;
        }

        /*
         * Sidebar
         */

        .sidebar {
          position: fixed;
          top: 0;
          /* rtl:raw:
          right: 0;
          */
          bottom: 0;
          /* rtl:remove */
          left: 0;
          z-index: 100; /* Behind the navbar */
          padding: 48px 0 0; /* Height of navbar */
          box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        @media (max-width: 767.98px) {
          .sidebar {
            top: 5rem;
          }
        }

        .sidebar-sticky {
          position: relative;
          top: 0;
          height: calc(100vh - 48px);
          padding-top: .5rem;
          overflow-x: hidden;
          overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        }

        .sidebar .nav-link {
          font-weight: 500;
          color: #333;
        }

        .sidebar .nav-link .feather {
          margin-right: 4px;
          color: #727272;
        }

        .sidebar .nav-link.active {
          color: #2470dc;
        }

        .sidebar .nav-link:hover .feather,
        .sidebar .nav-link.active .feather {
          color: inherit;
        }

        .sidebar-heading {
          font-size: .75rem;
          text-transform: uppercase;
        }

        /*
         * Navbar
         */

        .navbar-brand {
          padding-top: .75rem;
          padding-bottom: .75rem;
          font-size: 1rem;
          background-color: rgba(0, 0, 0, .25);
          box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
        }

        .navbar .navbar-toggler {
          top: .25rem;
          right: 1rem;
        }

        .navbar .form-control {
          padding: .75rem 1rem;
          border-width: 0;
          border-radius: 0;
        }

        .form-control-dark {
          color: #fff;
          background-color: rgba(255, 255, 255, .1);
          border-color: rgba(255, 255, 255, .1);
        }

        .form-control-dark:focus {
          border-color: transparent;
          box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
        }

      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
</head>

<body>
    
    <header class="navbar navbar-dark sticky-top bg-secondary flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-5" href="#">
        <span style="color:grey;">Gas</span> 
        <span style="color:skyblue;">Control</span>
      </a>

      <!-- <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">BOTON</span>
      </button>

      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
      
      <div class="navbar-nav">
        <div class="nav-item text-nowrap">
          
          <button class='btn btn-danger m-1'>
            <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i>
            Salir
          </button>

        </div>
      </div>
    </header>

    <div class="container-fluid">
      <div class="row">
        <!-- MENU -->
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
          <div class="position-sticky pt-3">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">
                  <i class="fa-solid fa-chart-pie"></i>
                  Estadisticas
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">
                  <i class="fa-solid fa-jug-detergent"></i>
                  Tanques estacionarios
                </a>
              </li>

              <li class="nav-item ">
                <a class="nav-link " aria-current="page" href="#">
                  <i class="fa-solid fa-handshake-angle"></i>
                  Empresas de carga
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">
                  <i class="fa-solid fa-wallet"></i>
                  Tarjetas de carga
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">
                  <i class="fa-solid fa-gas-pump"></i>
                  Cargas
                </a>
              </li>

            </ul>

            <hr>

            <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted">
              <i class="fa-solid fa-folder-tree"></i>
              <span>Catalogos</span>
            </h6>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">
                        <i class="fa-solid fa-oil-can"></i>
                        Tipos de carga
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">
                        <i class="fa-solid fa-oil-can"></i>
                        Tipos de combustible
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">
                        <i class="fa-solid fa-user-check"></i>
                        Usuarios
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">
                        <i class="fa-solid fa-id-card"></i>
                        Perfiles
                    </a>
                </li>
            </ul>

          </div>
        </nav>
        <!-- MENU -->

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div id="div_contenido">
            <h2>Tarjetas</h2>

            <!-- Filtros -->
            <div class="row g-3 align-items-center">
                
              <div class="col-auto">
                  <label for="inputPassword6" class="col-form-label">Buscar</label>
              </div>

              <div class="col-auto">
                  <input type="text" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
              </div>

              <div class="col-auto">
                  <select class="form-select" aria-label="Select region">
                      <option value="">Region</option>
                      <option value="">Centro</option>
                      <option value="">Noroeste</option>
                      <option value="">Baja Sur</option>
                      <option value="">Norte</option>
                      <option value="">Sureste</option>
                  </select>
              </div>

              <div class="col-auto">
                  <select class="form-select" aria-label="Select plaza">
                      <option value="">Plaza</option>
                      <option value="">...</option>
                      <option value="">...</option>
                      <option value="">...</option>
                      <option value="">...</option>
                      <option value="">...</option>
                  </select>
              </div>

              <div class="col-auto">
                  <select class="form-select" aria-label="Select oficina">
                      <option value="">Oficina</option>
                      <option value="">...</option>
                      <option value="">...</option>
                      <option value="">...</option>
                      <option value="">...</option>
                      <option value="">...</option>
                  </select>
              </div>

              <div class="col-auto">
                  <button class="btn btn-primary">
                      <i class="fa-solid fa-magnifying-glass"></i>
                  </button>
              </div>

            </div>
            <!-- Filtros -->

            <!-- Contenido -->
            <div class="table-responsive">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Empresa</th>
                    <th scope="col">Region</th>
                    <th scope="col">Plaza</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Ultimo Uso</th>
                    <th scope="col"> &nbsp; </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>13545</td>
                    <td>Gasomatic</td>
                    <td>Sureste</td>
                    <td>Cancun ZH</td>
                    <td> <span class="badge bg-danger"> Inactiva </span> </td>
                    <td> <span class="text-bold">13/05/2022 12:53</span> - <span class="text-muted">$450</span> </td>
                    <td> <button class="btn btn-sm btn-primary"> <i class="fa-solid fa-folder-open"></i> </button> </td>
                  </tr>

                  <tr>
                    <td>654321</td>
                    <td>Gasomatic</td>
                    <td>Sureste</td>
                    <td>Cancun ZH</td>
                    <td> <span class="badge bg-success"> Activa </span> </td>
                    <td> <span class="text-bold">13/05/2022 12:53</span> - <span class="text-muted">$450</span> </td>
                    <td> <button class="btn btn-sm btn-primary"> <i class="fa-solid fa-folder-open"></i> </button> </td>
                  </tr>

                  <tr>
                    <td>002255</td>
                    <td>Tanque Lleno</td>
                    <td>Sureste</td>
                    <td>Cancun ZH</td>
                    <td> <span class="badge bg-success"> Activa </span> </td>
                    <td> <span class="text-bold">13/05/2022 12:53</span> - <span class="text-muted">$450</span> </td>
                    <td> <button class="btn btn-sm btn-primary"> <i class="fa-solid fa-folder-open"></i> </button> </td>
                  </tr>
                  
                </tbody>
              </table>
            </div>
            <!-- Contenido -->

          </div>
          

          <!-- Div Informacion -->
          <div id="div_informacion" style="display: none;">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">#002255</h4>

                <form>
                  <div class="row">
                    <div class="col col-10">
                      <label for="input_nombre" class="form-label">Empresa <span class="text-danger text-bold"> * </span> </label>
                      <select id="input_nombre" class="form-select">
                        <option>Gasomatic</option>
                        <option>Tanque Lleno</option>
                        <option>Efectivale</option>
                      </select>
                    </div>

                    <div class="col col-2">
                      <label for="input_status" class="form-label">Estado</label>
                      <select id="input_status" class="form-select">
                        <option>Activo</option>
                        <option>Inactivo</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col col-4">
                      <label for="input_region" class="form-label">Region</label>
                      <select id="input_region" class="form-select">
                        <option>Centro</option>
                        <option>Sureste</option>
                        <option>Noroeste</option>
                        <option>Baja Sur</option>
                        <option>Norte</option>
                      </select>
                    </div>

                    <div class="col col-4">
                      <label for="input_plaza" class="form-label">Plaza</label>
                      <select id="input_plaza" class="form-select">
                        <option>Cd Mx</option>
                        <option>Mexico Apto</option>
                        <option>Toluca</option>
                        <option>Tuxtla</option>
                        <option>Veracruz</option>
                      </select>
                    </div>

                    <div class="col col-4">
                      <label for="input_creacion" class="form-label">Creacion</label>
                      <input type="text" id="input_creacion" disabled class="form-control" value="2022/01/23 12:08 - Nailea Delgado">
                    </div>
                  </div>  

                </form>

                <hr>

                <div class="row">
                  <div class="col col-11">
                    <h5>Ultimos movimientos</h5>
                  </div>

                  <!-- <div class="col col-1">
                    <button class="btn btn-sm btn-success"> <i class="fa-solid fa-plus"></i> </button>
                  </div> -->
                </div>
              </div>

              <div class="row">
                
                <div class="table-responsive">
                  <table class="table table-striped table-sm">
                    <thead>
                      <tr>
                        <th scope="col">Auto</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Planeacion/RA</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Creado</th>
                        <th scope="col">Folio</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Litros</th>
                        <th scope="col">Combustible</th>
                        <th scope="col">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td> 7789 </td>
                        <td> <span class="badge bg-primary"> Consumo cliente </span> </td>
                        <td> <a href="https://portal.fleetmastersoftware.com/">68954 (MZT1235)</a></td>
                        <td> 2022/02/28 - 13:54 </td>
                        <td> Jesus Siordia </td>
                        <td> 12547 </td>
                        <td> $1,125.05 </td>
                        <td> 38 </td>
                        <td> Gasolina (Premium) </td>
                        <td> 
                          <button class="btn btn-sm btn-success">
                            <i class="fa-solid fa-eye"></i>
                          </button>
                        </td>
                      </tr>

                      <tr>
                        <td> 7789 </td>
                        <td> <span class="badge bg-warning"> Uso interno </span> </td> 
                        <td> <a href="https://portal.fleetmastersoftware.com/">68955 (Taller externo)</a></td>
                        <td> 2022/03/12 - 13:54 </td>
                        <td> Nailea Delgado </td>
                        <td> 75642 </td>
                        <td> $989 </td>
                        <td> 25 </td>
                        <td> Gasolina (Magna) </td>
                        <td> 
                          <button class="btn btn-sm btn-success">
                            <i class="fa-solid fa-eye"></i>
                          </button>
                        </td>
                      </tr>

                      <tr>
                        <td> 7789 </td>
                        <td> <span class="badge bg-info"> Traslados </span> </td> 
                        <td> <a href="https://portal.fleetmastersoftware.com/">68925 (Traslado)</a></td>
                        <td> 2022/03/15 - 13:54 </td>
                        <td> Nailea Delgado </td>
                        <td> 75642 </td>
                        <td> $989 </td>
                        <td> 25 </td>
                        <td> Gasolina (Magna) </td>
                        <td> 
                          <button class="btn btn-sm btn-success">
                            <i class="fa-solid fa-eye"></i>
                          </button>
                        </td>
                      </tr>

                      <tr>
                        <td> 7789 </td>
                        <td> <span class="badge bg-secondary"> Unidad Nueva </span> </td> 
                        <td> N/A </td>
                        <td> 2022/03/23 - 13:54 </td>
                        <td> Nailea Delgado </td>
                        <td> 75642 </td>
                        <td> $989 </td>
                        <td> 25 </td>
                        <td> Gasolina (Magna) </td>
                        <td> 
                          <button class="btn btn-sm btn-success">
                            <i class="fa-solid fa-eye"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>

              <div class="card-footer">
                <button class="btn btn-sm btn-danger float-end m-1">
                  <i class="fa-solid fa-xmark"></i>
                </button>

                <button class="btn btn-sm btn-primary float-end m-1">
                  <i class="fa-solid fa-floppy-disk"></i> Guardar
                </button>
              </div>
            </div>
          </div>
          <!-- Div Informacion -->

        </main>
        
      </div>
    </div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<script src="https://kit.fontawesome.com/633e858528.js" crossorigin="anonymous"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready( () => {

  $(".table-striped .btn-primary").on("click", () => {
    $("#div_contenido").hide();

    $("#div_informacion").show();
  });


  $("#div_informacion .btn-danger").on("click", () => {
    $("#div_informacion").hide();

    $("#div_contenido").show();
  });

});

</script>