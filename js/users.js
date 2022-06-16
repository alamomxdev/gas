$(document).ready( () =>{
	const url=`${apiObj.host}/api/users/`;

	const opts = {
		lengths : [ 20, 30, 50, 75, 100 ],
		language: genObj.language,
		buttons	: genObj.buttons,
		limit	: 20,
		id 		: 'table-user'
	};
	const columns = [
	        	{ data: 'iduser' },
	        	{ data: 'name' },
	        	{ data: 'role', render: ( data ) =>{ return data.name; } },
	        	{ data: 'email' },
	        	{ data: 'status', render: ( data, type, row, meta ) => { return ( data )?'<span class="badge bg-success"> Activo </span>':'<span class="badge bg-danger"> Inactivo </span>';  } },
	        	{ data: 'status', render: ( data, type, row ) => { return '<button class="btn btn-primary btn-sm" uid="'+row.iduser+'"> <i class="fa-solid fa-folder-open"></i> </button>'; } },
	        ];
	const ajax = {
		url: url,
		type : "GET",
		dataSrc: "users",
		beforeSend: ( req ) => {
			req.setRequestHeader('x-token', localStorage.getItem('x-token') );
			req.setRequestHeader('search', $('#input-search').val() );
		},			
		error: function( errors ){
			//handleErrors( errors );
		}
	}

	const table = dataTable( opts, ajax, columns );

	const modal = $('#modal-user');
	modal.modal({backdrop: 'static', keyboard: false, show:true });

	//LLenar roles
	const headers_role = {
		'x-token' : localStorage.getItem('x-token'),
		'type' : 'active'
	}
	const settings_role = ajaxSettingGen( `${apiObj.host}/api/roles`, 'GET', headers_role );
	const request_role = ajaxRequest( settings_role );

	request_role.then( response => { 
		$('#role').append(`<option selected value=''></option>`);
		$.each( response.roles, ( i, v ) =>{
			$('#role').append(`<option value='${v.idrole}'>${v.name}</option>`);
		});
	}, errors => {
		handleErrors( errors );
	});

	//LLenar regiones
	const settings_regions = ajaxSettingGen( `${apiObj.host}/api/regions/parents`, 'GET', headers_role );
	const request_regions = ajaxRequest( settings_regions );
	request_regions.then( response =>{
		$.each( response.regions, (i, v) => {
			$('#regions').append(`<option value='${v.idregion}'>${v.name}</option>`);
		});
	}, errors => {
		handleErrors( errors );
	});

	//Obtejer plazas
	$('#regions').on("change", ()=>{
		const regions = $('#regions :selected').map( ( _, e ) => e.value ).get();

		$('#child_regions').html('');

		const settings_regions = ajaxSettingGen( `${apiObj.host}/api/regions/childs/${ (regions.length==0)?0:regions }`, 'GET', headers_role );
		const request_subregions = ajaxRequest( settings_regions );
		request_subregions.then( response =>{
			$.each( response.regions, (i, v) => {
				$('#child_regions').append(`<option value='${v.idregion}'>${v.name}</option>`);
			});
		}, errors => {
			handleErrors( errors );
		});
	});
	     
	//Buscar user
	$('#btn-search').on('click', () => { 
		table.ajax.reload(); 
	});

	//Buscar con ENTER
	$("#input-search").on('keypress', (e)=>{
		if( e.which===13 )
			$('#btn-search').click();
	});

	//Cerrar modal
	$('#btn-modal-close').on('click', ()=>{
		modal.modal('hide');
	});

	//Nuevo registro
	$('#btn-add').on('click', ()=>{
		const form = document.forms['form-user'];
		form.reset();

		$('#hi_iduser').val('');
		$('#sp-uid, #child_regions').html('')

		modal.modal('show');
	});

	//Consultar registro
	$('#table-user').on('click', 'button', function(){
		const uid = $(this).attr("uid");

		const headers = {
			'x-token': localStorage.getItem('x-token')
		}
		const settings = ajaxSettingGen( `${url}/${uid}`, 'GET', headers, null );
		const request = ajaxRequest( settings );

		$('#child_regions').html('');

		request.then( response => {
			const form = document.forms['form-user'];
			form.reset();

			const { user, regions, user_regions } = response;
			const { iduser_create, iduser_update, createdAt, updatedAt, idrole, ...data } = user;

			data.role = idrole;

			$("#sp-uid").html( data.iduser );

			fillInputs(data);
			
			$('#hi_iduser').val(data.iduser);

			//Listado de plazas de las zonas a las que tiene acceos el usuario
			$.each(regions, ( i, v )=>{
				let s = '';

				$.each( user_regions, (index, value) =>{
					if( value.idregion===v.idregion )
						s = 'selected';
				});

				$('#child_regions').append(`<option ${s} value='${v.idregion}'>${v.name}</option>`);
			});
			
			//Regiones a las que el usuario tiene acceso
			const r = [];
			$.each( user_regions, (i, v) => r.push( v.idregion ) );
			$('#regions').val( r );

			modal.modal('show');
		}, errors => {
			handleErrors( errors );
		});
	});

	//Guardar registro
	$('#btn-save-supplier').on('click', () => {
		const uid = $('#hi_iduser').val();

		const r = $('#regions :selected').map( (  i, e ) => e.value ).get();
		const rc = $('#child_regions :selected').map( (  i, e ) => e.value ).get();


		const form = {
			iduser 			: { value:$('#hi_iduser').val(), required: false }, 
			name 			: { value:$('#name').val(), required: true }, 
			status 			: { value:$('#status').is(':checked'), required: false }, 
			email 			: { value:$('#email').val(), required: true }, 
			idrole 			: { value:$('#role').val(), required: true }, 
			password 		: { value:$('#password').val(), required: false },
			password_confirm: { value:$('#password_confirm').val(), required: false },
			regions 		: { value:[ r, rc ], required:false }
		};

		if( form.password.value && form.password.value!==form.password_confirm.value ){
			toastr.warning('La contraseña y su confirmacion no coinciden');

			return;
		}

		if( uid==='' && form.password.value=='' ){
			toastr.warning('La contraseña es obligatoria en altas');

			return;
		}

		const { pass, pass_data } = formInputsValidate(form);

		if( pass ){
			const entries = new Map( pass_data );
			const { iduser, password_confirm, ...data } = Object.fromEntries(entries);

			if( data.password==='' )
				delete data.password;

			const headers = {
				'x-token'		: localStorage.getItem('x-token'),
				'Content-Type' 	: 'application/json'
			}

			const settings = ajaxSettingGen( `${url}/${uid}`, (uid)?'PUT':'POST', headers, data );

			const request = ajaxRequest( settings );

			request.then( response => {
				const msg = ( uid )?'Actualizacion exitosa':'Alta en sistema existosa';

				toastr.success( msg );

				modal.modal('hide');

				table.ajax.reload();
			}, errors => {
				handleErrors( errors );
			});
		}

	});
});