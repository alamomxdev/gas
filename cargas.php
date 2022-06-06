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
                <a class="nav-link" aria-current="page" href="#">
                  <i class="fa-solid fa-wallet"></i>
                  Tarjetas de carga
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">
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
            <h2>Historico de Cargas</h2>

            <!-- Filtros -->
            <div class="row g-3 align-items-center">
                  
              <div class="col-auto">
                  <label for="buscar" class="col-form-label">Buscar</label>
              </div>

              <div class="col-auto">
                  <input type="text" id="buscar" class="form-control">
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
                  <label for="buscar" class="col-form-label">F. Inicial</label>
              </div>
            <div class="col-auto">
                <input type="date" id="date" class="form-control" >
            </div>

            <div class="col-auto">
                  <label for="buscar" class="col-form-label">F. Fin</label>
              </div>
            <div class="col-auto">
                <input type="date" id="date" class="form-control" >
            </div>

              <div class="col-auto">
                  <button class="btn btn-primary">
                      <i class="fa-solid fa-magnifying-glass"></i>
                  </button>

                  <button class="btn btn-success"> 
                    <i class="fa-solid fa-plus"></i> 
                  </button>
              </div>

            </div>
            <!-- Filtros -->

            <!-- Contenido -->
            <div class="table-responsive">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th scope="col"># Tarjeta</th>
                    <th scope="col">Folio</th>
                    <th scope="col">Empresa</th>
                    <th scope="col">Tipo carga</th>
                    <th scope="col">Auto</th>
                    <th scope="col">Plan/RA</th>
                    <th scope="col">Plaza</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Creado</th>
                    <th scope="col">Monto</th>
                    <th scope="col">Litros</th>
                    <th scope="col">Combustible</th>
                    <th scope="col">KM</th>
                    <th scope="col"> &nbsp; </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td> 123546 </td>
                    <td> 00022233355666 </td>
                    <td> Tanque lleno </td>
                    <td> Consumo cliente </td>
                    <td> 7918 </td>
                    <td> <a href="https://portal.fleetmastersoftware.com/">68954 (MZT1235)</a> </td>
                    <td> Cancun ZH </td>
                    <td> 2022/03/23 13:59 </td>
                    <td> 2022/03/24 08:59 - Olivier </td>
                    <td> $1,084.02 </td>
                    <td> 40 </td>
                    <td> Gasolina (magna) </td>
                    <td> 12,356 </td>
                    <td> <button class="btn btn-success btn-sm"> <i class="fa-solid fa-eye"></i> </button> </td>
                  </tr>

                  <tr>
                    <td> 123546 </td>
                    <td> 00022233355666 </td>
                    <td> Tanque lleno </td>
                    <td> Consumo cliente </td>
                    <td> 7918 </td>
                    <td> <a href="https://portal.fleetmastersoftware.com/">68954 (MZT1235)</a> </td>
                    <td> Cancun ZH </td>
                    <td> 2022/03/23 13:59 </td>
                    <td> 2022/03/24 08:59 - Olivier </td>
                    <td> $1,084.02 </td>
                    <td> 40 </td>
                    <td> Gasolina (magna) </td>
                    <td> 12,356 </td>
                    <td> <button class="btn btn-success btn-sm"> <i class="fa-solid fa-eye"></i> </button> </td>
                  </tr>

                  <tr>
                    <td> 123546 </td>
                    <td> 00022233355666 </td>
                    <td> Tanque lleno </td>
                    <td> Consumo cliente </td>
                    <td> 7918 </td>
                    <td> <a href="https://portal.fleetmastersoftware.com/">68954 (MZT1235)</a> </td>
                    <td> Cancun ZH </td>
                    <td> 2022/03/23 13:59 </td>
                    <td> 2022/03/24 08:59 - Olivier </td>
                    <td> $1,084.02 </td>
                    <td> 40 </td>
                    <td> Gasolina (magna) </td>
                    <td> 12,356 </td>
                    <td> <button class="btn btn-success btn-sm"> <i class="fa-solid fa-eye"></i> </button> </td>
                  </tr>

                  <tr>
                    <td> 123546 </td>
                    <td> 00022233355666 </td>
                    <td> Tanque lleno </td>
                    <td> Consumo cliente </td>
                    <td> 7918 </td>
                    <td> <a href="https://portal.fleetmastersoftware.com/">68954 (MZT1235)</a> </td>
                    <td> Cancun ZH </td>
                    <td> 2022/03/23 13:59 </td>
                    <td> 2022/03/24 08:59 - Olivier </td>
                    <td> $1,084.02 </td>
                    <td> 40 </td>
                    <td> Gasolina (magna) </td>
                    <td> 12,356 </td>
                    <td> <button class="btn btn-success btn-sm"> <i class="fa-solid fa-eye"></i> </button> </td>
                  </tr>

                  <tr>
                    <td> 123546 </td>
                    <td> 00022233355666 </td>
                    <td> Tanque lleno </td>
                    <td> Consumo cliente </td>
                    <td> 7918 </td>
                    <td> <a href="https://portal.fleetmastersoftware.com/">68954 (MZT1235)</a> </td>
                    <td> Cancun ZH </td>
                    <td> 2022/03/23 13:59 </td>
                    <td> 2022/03/24 08:59 - Olivier </td>
                    <td> $1,084.02 </td>
                    <td> 40 </td>
                    <td> Gasolina (magna) </td>
                    <td> 12,356 </td>
                    <td> <button class="btn btn-success btn-sm"> <i class="fa-solid fa-eye"></i> </button> </td>
                  </tr>

                  <tr>
                    <td> 123546 </td>
                    <td> 00022233355666 </td>
                    <td> Tanque lleno </td>
                    <td> Consumo cliente </td>
                    <td> 7918 </td>
                    <td> <a href="https://portal.fleetmastersoftware.com/">68954 (MZT1235)</a> </td>
                    <td> Cancun ZH </td>
                    <td> 2022/03/23 13:59 </td>
                    <td> 2022/03/24 08:59 - Olivier </td>
                    <td> $1,084.02 </td>
                    <td> 40 </td>
                    <td> Gasolina (magna) </td>
                    <td> 12,356 </td>
                    <td> <button class="btn btn-success btn-sm"> <i class="fa-solid fa-eye"></i> </button> </td>
                  </tr>

                  <tr>
                    <td> 123546 </td>
                    <td> 00022233355666 </td>
                    <td> Tanque lleno </td>
                    <td> Consumo cliente </td>
                    <td> 7918 </td>
                    <td> <a href="https://portal.fleetmastersoftware.com/">68954 (MZT1235)</a> </td>
                    <td> Cancun ZH </td>
                    <td> 2022/03/23 13:59 </td>
                    <td> 2022/03/24 08:59 - Olivier </td>
                    <td> $1,084.02 </td>
                    <td> 40 </td>
                    <td> Gasolina (magna) </td>
                    <td> 12,356 </td>
                    <td> <button class="btn btn-success btn-sm"> <i class="fa-solid fa-eye"></i> </button> </td>
                  </tr>

                  <tr>
                    <td> 123546 </td>
                    <td> 00022233355666 </td>
                    <td> Tanque lleno </td>
                    <td> Consumo cliente </td>
                    <td> 7918 </td>
                    <td> <a href="https://portal.fleetmastersoftware.com/">68954 (MZT1235)</a> </td>
                    <td> Cancun ZH </td>
                    <td> 2022/03/23 13:59 </td>
                    <td> 2022/03/24 08:59 - Olivier </td>
                    <td> $1,084.02 </td>
                    <td> 40 </td>
                    <td> Gasolina (magna) </td>
                    <td> 12,356 </td>
                    <td> <button class="btn btn-success btn-sm"> <i class="fa-solid fa-eye"></i> </button> </td>
                  </tr>

                  <tr>
                    <td> 123546 </td>
                    <td> 00022233355666 </td>
                    <td> Tanque lleno </td>
                    <td> Consumo cliente </td>
                    <td> 7918 </td>
                    <td> <a href="https://portal.fleetmastersoftware.com/">68954 (MZT1235)</a> </td>
                    <td> Cancun ZH </td>
                    <td> 2022/03/23 13:59 </td>
                    <td> 2022/03/24 08:59 - Olivier </td>
                    <td> $1,084.02 </td>
                    <td> 40 </td>
                    <td> Gasolina (magna) </td>
                    <td> 12,356 </td>
                    <td> <button class="btn btn-success btn-sm"> <i class="fa-solid fa-eye"></i> </button> </td>
                  </tr>

                  <tr>
                    <td> 123546 </td>
                    <td> 00022233355666 </td>
                    <td> Tanque lleno </td>
                    <td> Consumo cliente </td>
                    <td> 7918 </td>
                    <td> <a href="https://portal.fleetmastersoftware.com/">68954 (MZT1235)</a> </td>
                    <td> Cancun ZH </td>
                    <td> 2022/03/23 13:59 </td>
                    <td> 2022/03/24 08:59 - Olivier </td>
                    <td> $1,084.02 </td>
                    <td> 40 </td>
                    <td> Gasolina (magna) </td>
                    <td> 12,356 </td>
                    <td> <button class="btn btn-success btn-sm"> <i class="fa-solid fa-eye"></i> </button> </td>
                  </tr>

                  <tr>
                    <td> 123546 </td>
                    <td> 00022233355666 </td>
                    <td> Tanque lleno </td>
                    <td> Consumo cliente </td>
                    <td> 7918 </td>
                    <td> <a href="https://portal.fleetmastersoftware.com/">68954 (MZT1235)</a> </td>
                    <td> Cancun ZH </td>
                    <td> 2022/03/23 13:59 </td>
                    <td> 2022/03/24 08:59 - Olivier </td>
                    <td> $1,084.02 </td>
                    <td> 40 </td>
                    <td> Gasolina (magna) </td>
                    <td> 12,356 </td>
                    <td> <button class="btn btn-success btn-sm"> <i class="fa-solid fa-eye"></i> </button> </td>
                  </tr>

                  <tr>
                    <td> 123546 </td>
                    <td> 00022233355666 </td>
                    <td> Tanque lleno </td>
                    <td> Consumo cliente </td>
                    <td> 7918 </td>
                    <td> <a href="https://portal.fleetmastersoftware.com/">68954 (MZT1235)</a> </td>
                    <td> Cancun ZH </td>
                    <td> 2022/03/23 13:59 </td>
                    <td> 2022/03/24 08:59 - Olivier </td>
                    <td> $1,084.02 </td>
                    <td> 40 </td>
                    <td> Gasolina (magna) </td>
                    <td> 12,356 </td>
                    <td> <button class="btn btn-success btn-sm"> <i class="fa-solid fa-eye"></i> </button> </td>
                  </tr>

                  <tr>
                    <td> 123546 </td>
                    <td> 00022233355666 </td>
                    <td> Tanque lleno </td>
                    <td> Consumo cliente </td>
                    <td> 7918 </td>
                    <td> <a href="https://portal.fleetmastersoftware.com/">68954 (MZT1235)</a> </td>
                    <td> Cancun ZH </td>
                    <td> 2022/03/23 13:59 </td>
                    <td> 2022/03/24 08:59 - Olivier </td>
                    <td> $1,084.02 </td>
                    <td> 40 </td>
                    <td> Gasolina (magna) </td>
                    <td> 12,356 </td>
                    <td> <button class="btn btn-success btn-sm"> <i class="fa-solid fa-eye"></i> </button> </td>
                  </tr>

                  <tr>
                    <td> 123546 </td>
                    <td> 00022233355666 </td>
                    <td> Tanque lleno </td>
                    <td> Consumo cliente </td>
                    <td> 7918 </td>
                    <td> <a href="https://portal.fleetmastersoftware.com/">68954 (MZT1235)</a> </td>
                    <td> Cancun ZH </td>
                    <td> 2022/03/23 13:59 </td>
                    <td> 2022/03/24 08:59 - Olivier </td>
                    <td> $1,084.02 </td>
                    <td> 40 </td>
                    <td> Gasolina (magna) </td>
                    <td> 12,356 </td>
                    <td> <button class="btn btn-success btn-sm"> <i class="fa-solid fa-eye"></i> </button> </td>
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
                <h4 class="card-title">Control de cargas</h4>

                <form>
                  <div class="row">
                    <div class="col col-4">
                      <label for="input_nombre" class="form-label">Tarjeta <span class="text-danger text-bold"> * </span> </label>
                      <input type="text" id="input_nombre" class="form-control" value="123456">
                    </div>

                    <div class="col col-4">
                      <label for="input_nombre" class="form-label">Folio Carga <span class="text-danger text-bold"> * </span> </label>
                      <input type="text" id="input_nombre" class="form-control" value="00225533">
                    </div>

                    <div class="col col-4">
                      <label for="input_status" class="form-label">Empresa</label>
                      <select id="input_status" class="form-select">
                        <option>Gasomatic</option>
                        <option>Tanque lleno</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col col-6 col-md-6 col-lg-3">
                      <label for="input_razon" class="form-label">Tipo de carga</label>
                      <select id="input_status" class="form-select">
                        <option>Uso interno</option>
                        <option>Consumo clientes</option>
                        <option>Traslados</option>
                        <option>Carga unidad nueva</option>
                      </select>
                    </div>

                    <div class="col col-6 col-md-6 col-lg-3">
                      <label for="input_razon" class="form-label">Region</label>
                      <select id="input_status" class="form-select">
                        <option>Shuttle Van</option>
                        <option>Gerente Plaza</option>
                        <option>Gerente Regional</option>
                        <option>Talleres</option>
                        <option>Cuentas comerciales y RP</option>
                        <option>Gestoria</option>
                      </select>
                    </div>

                    <div class="col col-6 col-md-6 col-lg-3">
                      <label for="input_nombre" class="form-label">Auto <span class="text-danger text-bold"> * </span> </label>
                      <input type="text" id="input_nombre" class="form-control" value="9908">
                    </div>

                    <div class="col col-6 col-md-6 col-lg-3">
                      <label for="input_nombre" class="form-label">Plan/RA <span class="text-danger text-bold"> * </span> </label>
                      <input type="text" id="input_nombre" class="form-control" value="668923 (MZT123) ">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col col-6 col-md-6 col-lg-3">
                      <label for="input_razon" class="form-label">Region</label>
                      <select id="input_status" class="form-select">
                        <option>Centro</option>
                        <option>Norte</option>
                        <option>Sureste</option>
                        <option>Noroeste</option>
                        <option>Baja Sur</option>
                      </select>
                    </div>

                    <div class="col col-6 col-md-6 col-lg-3">
                      <label for="input_razon" class="form-label">Plaza</label>
                      <select id="input_status" class="form-select">
                        <option>Cd MX</option>
                        <option>Mexico Apto</option>
                        <option>Toluca</option>
                        <option>Tuxtla</option>
                        <option>Veracruz</option>
                      </select>
                    </div>

                    <div class="col col-6 col-md-6 col-lg-3">
                      <label for="input_nombre" class="form-label">Fecha Carga <span class="text-danger text-bold"> * </span> </label>
                      <input type="text" id="input_nombre" class="form-control" value="2022/03/23 18:02">
                    </div>

                    <div class="col col-6 col-md-6 col-lg-3">
                      <label for="input_nombre" class="form-label">Creado <span class="text-danger text-bold"> * </span> </label>
                      <input type="text" id="input_nombre" class="form-control" value="2022/03/25 18:02 - Olivier" disabled>
                    </div>
                  </div>

                  <div class="row">
                    
                    <div class="col col-6 col-md-6 col-lg-3">
                      <label for="input_nombre" class="form-label">Monto <span class="text-danger text-bold"> * </span> </label>
                      <input type="text" id="input_nombre" class="form-control" value="$1,205">
                    </div>

                    <div class="col col-6 col-md-6 col-lg-3">
                      <label for="input_nombre" class="form-label">Listros <span class="text-danger text-bold"> * </span> </label>
                      <input type="text" id="input_nombre" class="form-control" value="41" disabled>
                    </div>

                    <div class="col col-6 col-md-6 col-lg-3">
                      <label for="input_nombre" class="form-label">Kilometraje <span class="text-danger text-bold"> * </span> </label>
                      <input type="text" id="input_nombre" class="form-control" value="25,826" disabled>
                    </div>

                    <div class="col col-6 col-md-6 col-lg-3">
                      <label for="input_razon" class="form-label">Combustible</label>
                      <select id="input_status" class="form-select">
                        <option>Gasolina (magan)</option>
                        <option>Gasolina (premium)</option>
                        <option>Gas LP</option>
                        <option>Dieser</option>
                      </select>
                    </div>

                  </div>
                </form>

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

  $(".table-striped .btn-success").on("click", () => {
    $("#div_contenido").hide();

    $("#div_informacion").show();
  });


  $("#div_informacion .btn-danger").on("click", () => {
    $("#div_informacion").hide();

    $("#div_contenido").show();
  });

});

</script>