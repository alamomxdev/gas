<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Gas - Menu </title>

    <link rel="icon" href="./assets/gascontrol.webp">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

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

        .sidebar .nav-link {
          margin-right: 4px;
          color: #727272;
        }

        .sidebar .nav-link.active {
          color: #2470dc !important;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
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

<body method="POST">
    
    <header class="navbar navbar-dark sticky-top bg-secondary flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-5" href="#">
        <img src="./assets/logo_alamo.png" class="mr-3" style="width:80px;">
        <span style="color:black;">Gas</span> 
        <span style="color:skyblue;">Control</span>
      </a>

      <p class="navbar-toggler" id='p_user_name'></p>
      
      <div class="navbar-nav">
        <div class="nav-item text-nowrap">
          
          <button class='btn btn-danger m-1' id="btn-salir">
            <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i>
            Salir
          </button>

        </div>
      </div>
    </header>

    <div class="container-fluid">
      <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
          <div class="position-sticky pt-3">
            <ul class="nav flex-column" id="ul_menus"></ul>

            <hr>

            <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted d-none" id="cats_title">
              <i class="fa-solid fa-folder-tree"></i>
              <span>Catalogos</span>
            </h6>

            <ul class="nav flex-column" id="ul_cats"></ul>

          </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="row">
          <?php
            switch ($_GET['opt']) {
              case 'suppliers':
                include('fuel_suppliers.php');
              break;

              case 'users':
                include('users.php');
              break;

              case 'roles':
                include('roles.php');
              break;

              case 'cards':
                include('cards.php');
              break;

              case 'refuels':
                include('refuels.php');
              break;

              case 'staff':
                include('staff.php');
              break;
              
              default:
                // code...
              break;
            }
          ?>
            </div> 

        </main>
      </div>
    </div>

    <input type="hidden" name="hi_opt" id="hi_opt">

    <div class="modal" id="modal-load" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">

            <div class="modal-content">

                  <div class="modal-body">

                      <div class="text-center">
                          <div class="spinner-grow text-primary" role="status">
                              <span class="visually-hidden">Loading...</span>
                          </div>

                          <div class="spinner-grow text-secondary" role="status">
                              <span class="visually-hidden">Loading...</span>
                          </div>

                          <div class="spinner-grow text-success" role="status">
                              <span class="visually-hidden">Loading...</span>
                          </div>

                          <div class="spinner-grow text-danger" role="status">
                              <span class="visually-hidden">Loading...</span>
                          </div>

                          <div class="spinner-grow text-warning" role="status">
                              <span class="visually-hidden">Loading...</span>
                          </div>

                          <div class="spinner-grow text-info" role="status">
                              <span class="visually-hidden">Loading...</span>
                          </div>

                          <div class="spinner-grow text-dark" role="status">
                              <span class="visually-hidden">Loading...</span>
                          </div>
                      </div>

                  </div>

            </div>

        </div>
    </div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<script src="https://kit.fontawesome.com/633e858528.js" crossorigin="anonymous"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="./js/general.js?<?php echo md5_file('./js/general.js'); ?>"></script>

<script src="./js/validate.js?<?php echo md5_file('./js/validate.js'); ?>"></script>

<script src="./js/menu.js?<?php echo md5_file('./js/menu.js'); ?>"></script>


<?php
  switch ($_GET['opt']) {
    case 'suppliers':
      $md5 = md5_file('./js/fuel_suppliers.js');

      echo '<script src="./js/fuel_suppliers.js?'.$md5.'"></script>';
    break;

    case 'users':
      $md5 = md5_file('./js/users.js');

      echo '<script src="./js/users.js?'.$md5.'"></script>';
    break;

    case 'roles':
      $md5 = md5_file('./js/roles.js');

      echo '<script src="./js/roles.js?'.$md5.'"></script>';
    break;

    case 'cards':
      $md5 = md5_file('./js/cards.js');

      echo '<script src="./js/cards.js?'.$md5.'"></script>';
    break;

    case 'refuels':
      $md5 = md5_file('./js/refuels.js');

      echo '<script src="./js/refuels.js?'.$md5.'"></script>';
    break;

    case 'staff':
      $md5 = md5_file('./js/staff.js');

      echo '<script src="./js/staff.js?'.$md5.'"></script>';
    break;
    
    default:
      // code...
    break;
  }
?>

<script type="text/javascript">
$(document).ready( function(){
  const general_opt = '<?php echo $_GET['opt']; ?>';

  $(document).on('click', 'a', (e) => {
   e.preventDefault();
  });

  //Valida que el usuario ya tenga un token correcto
  if( localStorage.getItem('x-token')!=='' ){
      const valid_token = validateJWT( localStorage.getItem('x-token') );

      valid_token.then( response => {
        $('#p_user_name').html( `Bienvenido ${response.name}` );

        getMenu( response.idrole, general_opt );


      }, (errors) => {
          localStorage.clear();

          window.location = window.location = apiObj.site;
      });
  }

  //Salir del sistema
  $('#btn-salir').click(function(){
    localStorage.clear();

    window.location = apiObj.site;
  });

  //Accion del menu de herramientas
  $(document).on('click', '#ul_menus a, #ul_cats a', function(e){
    $(this).parent().parent().find('a').removeClass('active');

    $(this).addClass('active');

    const opt = $(this).attr('href');

    const href = window.location.href.split('?');

    window.location = href[0]+'?opt='+opt;
  });

  const modal_load = $('#modal-load');
  modal_load.modal({backdrop: 'static', keyboard: false, show:true });

  $(document).ajaxError( function( event, jqxhr, settings, thrownError ){
        //toastr.error( `${ event.type } ${ jqxhr.responseText } ${ settings.type }` );


        modal_load.modal('hide');
  }).ajaxStart( () => {
        //console.log( 'Start: ' );

        modal_load.modal('show');

  }).ajaxStop( () => {
        //console.log( 'Stop: ' );

        modal_load.modal('hide');
  });

} );
</script>