const validateJWT = ( token='' ) => {
    //Configuracion del ajax para envio de datos a la API
    const settings = {
        'url'    : apiObj.host+'/api/auth/token',
        'method' :'POST',
        'timeout':0,
        'async'  : true,
        'headers':{
            'x-token': token
        }
    };

    return new Promise( ( resolve, reject ) => {
        $.ajax( settings )
                        .done( ( response ) => {
                            resolve( response );
                        })
                        .fail( errors => {
                            reject(errors);
                        } );
    });
}