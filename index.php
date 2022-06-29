<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Gas - Login </title>

    <link rel="icon" href="./assets/gascontrol.webp">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
</head>

<style type="text/css">
    body, html {
        height: 100%;
        background-repeat: no-repeat;
        background-image: linear-gradient(rgb(39, 172, 234), rgb(211, 211, 211));
    }

    .card-container.card {
        max-width: 350px;
        padding: 40px 40px;
    }

    .btn {
        font-weight: 700;
        height: 36px;
        -moz-user-select: none;
        -webkit-user-select: none;
        user-select: none;
        cursor: default;
    }

    /*
     * Card component
     */
    .card {
        background-color: #F7F7F7;
        /* just in case there no content*/
        padding: 20px 25px 30px;
        margin: 0 auto 25px;
        margin-top: 50px;
        /* shadows and rounded borders */
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        border-radius: 2px;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    }

    .profile-img-card {
        width: 96px;
        height: 96px;
        margin: 0 auto 10px;
        display: block;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        border-radius: 50%;
    }

    /*
     * Form styles
     */
    .profile-name-card {
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        margin: 10px 0 0;
        min-height: 1em;
    }

    .reauth-email {
        display: block;
        color: #404040;
        line-height: 2;
        margin-bottom: 10px;
        font-size: 14px;
        text-align: center;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    .form-signin #inputEmail,
    .form-signin #inputPassword {
        direction: ltr;
        height: 44px;
        font-size: 16px;
    }

    .form-signin input[type=email],
    .form-signin input[type=password],
    .form-signin input[type=text],
    .form-signin button {
        width: 100%;
        display: block;
        margin-bottom: 10px;
        z-index: 1;
        position: relative;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    .form-signin .form-control:focus {
        border-color: rgb(104, 145, 162);
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    }

    .btn.btn-signin {
        /*background-color: #4d90fe; */
        background-color: rgb(104, 145, 162);
        /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
        padding: 0px;
        font-weight: 700;
        font-size: 14px;
        height: 36px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        border: none;
        -o-transition: all 0.218s;
        -moz-transition: all 0.218s;
        -webkit-transition: all 0.218s;
        transition: all 0.218s;
    }

    .btn.btn-signin:hover,
    .btn.btn-signin:active,
    .btn.btn-signin:focus {
        background-color: rgb(87, 120, 219);
    }

    .forgot-password {
        color: rgb(104, 145, 162);
    }

    .forgot-password:hover,
    .forgot-password:active,
    .forgot-password:focus{
        color: rgb(12, 97, 33);
    }

    .modal-body .close{
        position: absolute;
        top: 0;
        right: 0;
        padding: 0.5rem 0.75rem;
        z-index: 1;
        background-color: transparent;
        border: 0;
        -webkit-appearance: none;
    }
</style>
<body>
    <div class="container">
        <div class="card card-container" id="card_login">
                
            <h5 class='card-title'><span style="color:grey;">Gas</span> <span style="color:skyblue;">Control</span></h5>
           
            <form class="form-signin">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email " required autofocus>
                <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
                <!-- <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div> -->
                <button class="btn btn-lg btn-primary btn-block btn-signin" id="btn-login">Ingresar</button>
            </form><!-- /form -->
            <a href="#" class="forgot-password" id="a_recovery">
                ¿Olvid&oacute; su contraseña?
            </a>
        </div><!-- /card-container -->


        <div class="card card-container d-none" id="card_recovery">
            <h5 class='card-title'><span style="color:grey;">Gas</span> <span style="color:skyblue;">Control</span></h5>

            <form class="form-signin">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmailRec" class="form-control" placeholder="Email" required autofocus>
                <button class="btn btn-lg btn-primary btn-block btn-signin" id="btn-recovery">Recuperar</button>
            </form><!-- /form -->

            <a href="#" class="forgot-password" id="a_return">
                Regresar
            </a>
        </div>

        <div class="card card-container d-none" id="card_change">
            <h5 class='card-title'><span style="color:grey;">Gas</span> <span style="color:skyblue;">Control</span></h5>

            <form class="form-signin">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="password" id="input-current-password" class="form-control" placeholder="Clave temporal" required autofocus>
                <input type="password" id="input-new-password" class="form-control" placeholder="Nueva clave" required autofocus>
                <input type="password" id="input-new-password2" class="form-control" placeholder="Confirmacion" required autofocus>
                <button class="btn btn-lg btn-primary btn-block btn-signin" id="btn-change">Cambiar clave</button>
            </form><!-- /form -->

        </div>

    </div><!-- /container -->

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

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://kit.fontawesome.com/fb1f2c1754.js" crossorigin="anonymous"></script>

<script src="./js/general.js?<?php echo md5_file('./js/general.js'); ?>"></script>
<script src="./js/validate.js?<?php echo md5_file('./js/validate.js'); ?>"></script>

<script type="text/javascript">
$(document).ready( function(){
    if( localStorage.getItem('x-token')!=='' ){
        const valid_token = validateJWT( localStorage.getItem('x-token') );

        valid_token.then( response => {
            window.location = `${apiObj.site}menu.php`;
        }, (errors) => {
            localStorage.clear();
        });
    } 

    $('#btn-login').on('click', (e) => {
        e.preventDefault();

        //Se deshabilita el boton esperando la respuesta
        $(this).prop('disabled', true);

        const data = { email:$('#inputEmail').val(), password:$('#inputPassword').val() };

        //Emal y contraseña requeridos
        if( data.email==='' || data.password==='' ){
            toastr.warning('El correo y contraseña son datos requeridos.');
           
            return;
        }

        const d  = {
                'email':data.email,
                'password':data.password
            };

        //Configuracion del ajax para envio de datos a la API
        const settings = {
            'url'    : apiObj.host+'/api/auth/login',
            'method' :'POST',
            'timeout':0,
            'headers':{
                'Content-Type': 'application/json'
            },
            'data':JSON.stringify( d )
        };

        $.ajax( settings )
            .done( ( response ) => {
                toastr.success('Credenciales de acceso validades con exito');

                $(this).prop('disabled', false);

                localStorage.setItem('x-token', response.token);
                localStorage.setItem('uid', response.uid);

                if( response.reset ){
                    $('#card_login, #card_recovery').addClass('d-none');

                    $('#card_change').removeClass('d-none');
                }
                else{
                    window.location = apiObj.site+'menu.php';
                }
            })
            .fail( ( errors ) => {
                const err = errors.responseJSON;

                $(this).prop('disabled', false);

                if( err.msg ){
                    toastr.error( err.msg );
                }

                if( err.errors ){
                    $( err.errors ).each( (i, v) => {
                        toastr.error( v.msg, `El ${v.param} con valor ${ (v.value==='')?'VACIO':v.value } incorrecto` )
                    });
                }
            });
    });

    $('#a_recovery').on('click', (e) => {
        e.preventDefault();

        $('#card_login input').val('');

        $('#card_login').addClass('d-none');
        $('#card_recovery').removeClass('d-none');
    });

    $('#a_return').on('click', (e) => {
        e.preventDefault();

        $('#card_recovery input').val('');

        $('#card_recovery').addClass('d-none');
        $('#card_login').removeClass('d-none');
    });

    $('#btn-recovery').on('click', (e) => {
        e.preventDefault();

        const email = $('#inputEmailRec').val();

        if( email==='' ){
            toastr.warning('El correo electronico de recuperacion es requerido');

            return;
        }

        const settings = {
            url     : `${ apiObj.host }/api/users/recoverpass/${ email }`,
            method  : 'PUT',
            timeot  : 0,
            data    : JSON.stringify({ email })
        }

        $.ajax( settings )
                        .done( response => {
                            toastr.success(`Una nueva clave temporal a sido enviada a su correo ${ email }`);
                        } )
                        .fail( errors => {
                            const err = errors.responseJSON;

                            if( err.msg ){
                                toastr.error( err.msg );
                            }

                            if( err.errors ){
                                $( err.errors ).each( (i, v) => {
                                    toastr.error( v.msg, `El ${v.param} con valor ${ (v.value==='')?'VACIO':v.value } incorrecto` )
                                });
                            }
                        } )
    });

    $('#btn-change').on('click', (e) => {
        e.preventDefault();

        const current = $('#input-current-password').val();
        const password = $('#input-new-password').val();
        const password2 = $('#input-new-password2').val();

        if( current==='' || password==='' || password2==='' )
            toastr.error('Todas los campos son requeridos');
        else if( password2!==password )
            toastr.warning('La nueva clave y su confirmacion no concuerdan');
        else{
            const settings = {
                url     : `${ apiObj.host }/api/users/pass/${ localStorage.getItem('uid') }`,
                method  : 'PUT',
                timeot  : 0,
                headers :{
                    'x-token': localStorage.getItem('x-token'),
                    'Content-Type': 'application/json'
                },
                data    : JSON.stringify({ current, password })
            }

            $.ajax( settings )
                            .done( response => {
                                localStorage.removeItem('uid');

                                window.location = apiObj.site+'menu.php';
                            } )
                            .fail( errors => {
                                const err = errors.responseJSON;

                                if( err.msg ){
                                    toastr.error( err.msg );
                                }

                                if( err.errors ){
                                    $( err.errors ).each( (i, v) => {
                                        toastr.error( v.msg, `El ${v.param} con valor ${ (v.value==='')?'VACIO':v.value } incorrecto` )
                                    });
                                }
                            } );
        }
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
});



</script>