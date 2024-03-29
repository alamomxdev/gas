const genObj = {};

const apiObj = {
	host : 'http://localhost:8080',
	site : 'http://localhost/gas/',
	cdn  : 'https://dxdaz5rc1ikv5.cloudfront.net'
	/*host : 'https://gcdev.tecnologiasalamo.com.mx:8080',
	site : 'https://tecnologiasalamo.com.mx/TEST_gascontrol/'*/
}

genObj.language = {
		            "processing": "Procesando...",
				    "lengthMenu": "Mostrar _MENU_ registros",
				    "zeroRecords": "No se encontraron resultados",
				    "emptyTable": "Ningún dato disponible en esta tabla",
				    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
				    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
				    "search": "Buscar:",
				    "infoThousands": ",",
				    "loadingRecords": "Cargando...",
				    "paginate": {
				        "first": "Primero",
				        "last": "Último",
				        "next": "Siguiente",
				        "previous": "Anterior"
				    },
				    "aria": {
				        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
				        "sortDescending": ": Activar para ordenar la columna de manera descendente"
				    },
				    "buttons": {
				        "copy": "Copiar",
				        "colvis": "Visibilidad"
				    }
		        };
genObj.buttons = 	[	
					{
		                extend: 'pdfHtml5',
		                orientation: 'landscape',
		                className:"btn btn-danger ml-1",
		                text:"<i class='far fa-file-pdf' title='PDF'></i>"
		            },
		            {
		            	extend:"excelHtml5",
		                className:"btn btn-success mr-1",
		                text:"<i class='far fa-file-excel' title='Excel'></i>"
		            }	          
				];
genObj.lengths = [ 20, 30, 50, 75, 100 ];


//Cierra la sesion
const closeSesion = () => {
	localStorage.clear();

    window.location = apiObj.site;
}

//Controla los errores generados por la API y muestra alertas de los mismos
const handleErrors = ( errors ) => {
	const { status, statusText, responseJSON, responseText } = errors;

	//console.log( errors );
	//console.log( status );
	//console.log( statusText );
	//console.log( responseJSON );
	//console.log( errors ); 

	if( !responseJSON ){
		toastr.warning('Error desconocido en solicitud');

		return;
	}

	if( !responseJSON.msg )
		responseJSON.msg = responseJSON.error;

    if( responseJSON.msg ){
    	if( responseJSON.code.includes('AUT') )
        	closeSesion();


        toastr.error( responseJSON.msg, 'Error' );

        return;
    }

    if( responseJSON.errors ){
        $( responseJSON.errors ).each( (i, v) => {
            toastr.error( v.msg, `El ${v.param} con valor ${ (v.value==='')?'VACIO':v.value } incorrecto` )
        });
    }

    if( responseJSON.error ){
    	toastr.error( responseJSON.error.name );
    }
};

//Genera una DataTable()
const dataTable = ( opt, ajax, columns ) => {
	const table = $(`#${ opt.id }`).dataTable({
		lengthMenu		: opt.lengths,
		language		: opt.language,
		bFilter			: false,
		buttons			: opt.buttons,
		paging			: false,
		ajax			: ajax,
		bDestroy		: true,
		columns			: columns,
		iDisplayLength	: opt.limit ,//Paginación
		scrollY			: opt.scrollY,
        scrollCollapse	: opt.scrollCollapse,
        ordering		: false
	}).DataTable();

	return table;
}


const objTOurl = ( obj ) => {
	const u = new URLSearchParams( obj ).toString();

	return u;
}

//Generador de settings para ajax
const ajaxSettingGen = ( url, method, headers, data=null, timeot=0 ) => {
	const settings = {
		url 	: url,
		method 	: method,
		timeot 	: timeot,
		beforeSend : ( request ) => {
			$.each( headers, (key, value) => {
				request.setRequestHeader( key, value );
			})
		}
	}

	if( data )
		settings.data = JSON.stringify( data );

	return settings;
}

//Solicitudes de ajax
const ajaxRequest = ( ajaxSettings ) => {
	return new Promise( ( resolve, reject ) => {
		$.ajax( ajaxSettings ).
			done( ( response ) => {
				resolve(response);
			})
			.fail( (errors) => {
				reject( errors );
			});
	});
}

//Llena los inputs de un formulario
const fillInputs = ( data, input_prefix='' ) => {
	$.each( data, (key, value) => {
		let input = `#${input_prefix}${key}`;

		if( value!==null ){
			if( typeof(value)==='boolean' )
				$(input).prop('checked', value)
			else
				$(input).val( value );
		}
	});
}

//Valida los campos requeridos del formulario antes de enviar
const formInputsValidate = ( formInputs ) => {
	let pass = true;
	const pass_data = [];


	$.each( formInputs, ( key, obj ) =>{
		if( obj.required && !obj.value ){
			toastr.error(`El campo de ${key} es requerido`);

			pass=false;
		}

		if( (obj.value || obj.passEmpety  ) || typeof(obj.value)=='boolean' ){
			pass_data.push( [ key, obj.value ] );
		}

	});

	return {pass, pass_data};
}

