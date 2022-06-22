$(document).ready( () =>{
	const url=`${apiObj.host}/api/roles/`;

	const opts = {
		lengths : [ 20, 30, 50, 75, 100 ],
		language: genObj.language,
		buttons	: genObj.buttons,
		limit	: 20,
		id 		: 'table-roles'
	};
	const columns = [
	        	{ data: 'idrole' },
	        	{ data: 'name' },
	        	{ data: 'status', render: ( data, type, row, meta ) => { return ( data )?'<span class="badge bg-success"> Activo </span>':'<span class="badge bg-danger"> Inactivo </span>';  } },
	        	{ data: 'status', render: ( data, type, row ) => { return '<button class="btn btn-primary btn-sm" uid="'+row.idrole+'"> <i class="fa-solid fa-pencil"></i> </button>'; } },
	        ];

	const ajax = {
		url: url,
		type : "GET",
		dataSrc: "roles",
		beforeSend: ( req ) => {
			req.setRequestHeader('x-token', localStorage.getItem('x-token') );
		},			
		error: function( errors ){
			handleErrors( errors );
		}
	}

	const table = dataTable( opts, ajax, columns );

	const modal = $('#modal-role');
	modal.modal({backdrop: 'static', keyboard: false, show:true });

	//################################################################################################
	//OBTENER PERMISOS
	const head_rights = {
		'x-token' : localStorage.getItem('x-token'),
	}
	const set_rights = ajaxSettingGen( `${apiObj.host}/api/rights`, 'GET', head_rights );
	const req_rights = ajaxRequest( set_rights );

	let right_list = [];

	req_rights.then( response => {
		$.each( response.rights, (i, v) => {
			const html = `
						<li class="list-group-item">
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="ch_right_${v.idright}" uid="${v.idright}">
								<label class="form-check-label" for="ch_right_${v.idright}">
									${v.name} <i class="${v.icon}"></i>
								</label>
							</div>
						</li>
						`;

			$('#role_rights').append(html);
		});
	}, errors =>{
		handleErrors(errors);
	} );
	//Fin de obtener permisos
	//################################################################################################

	//Buscar Role
	$('#btn-search').on('click', () => { 
		const data = {
			search : $('#input-search').val()
		}

		const u = objTOurl( data );

		table.ajax.url(`${ url }?${ u }`).load();
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
		const form = document.forms['form-role'];
		form.reset();

		$('#hi_idrole').val('');
		$('#sp-uid').html('');

		modal.modal('show');
	});

	//Consultar registro
	$("#table-roles").on('click', 'button', function(){
		const form = document.forms['form-role'];
		form.reset();

		const uid = $(this).attr('uid');

		const headers = {
			'x-token': localStorage.getItem('x-token')
		}
		const settings = ajaxSettingGen( `${url}/${uid}`, 'GET', headers, null );
		const request = ajaxRequest( settings );

		request.then( response => {
			const { createdAt, iduser_create, iduser_update, updatedAt, ...data } = response.role;
			const rights = response.role_rights;

			$("#sp-uid").html( data.idrole );
			fillInputs(data);

			$('#hi_idrole').val( data.idrole );

			$.each( rights, ( i, v ) => {
				$(`#ch_right_${v.idright}`).prop('checked', true);
			});

			modal.modal('show');
		}, errors => {
			handleErrors( errors );
		})
	});

	//Guardar Rol
	$("#btn-save").on('click', function(){
		const uid = $('#hi_idrole').val();
		const rights = [];

		$('#role_rights input[type=checkbox]').each( (i,e) => {
			if( $(e).is(':checked') )
				rights.push({ idright:parseInt($(e).attr('uid')) });
		});

		const form = {
			idrole	: { value:$('#hi_idrole').val(), required:false },
			name 	: { value:$('#name').val(), required:true },
			status	: { value:$('#status').is(':checked'), required:false },
			rights 	: { value:rights, required:false }
		}

		const { pass, pass_data } = formInputsValidate(form);

		if( pass ){
			const entries = new Map( pass_data );
			const { idrole, ...data } = Object.fromEntries(entries);

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