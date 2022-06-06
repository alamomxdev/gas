$(document).ready(function(){
	const opts = {
		lengths : [ 20, 30, 50, 75, 100 ],
		language: genObj.language,
		buttons	: genObj.buttons,
		limit	: 20,
		id 		: 'table-supplier'
	};
	const columns = [
	        	{ data: 'idsupplier' },
	        	{ data: 'name' },
	        	{ data: 'rfc' },
	        	{ data: 'phone1' },
	        	{ data: 'email1' },
	        	{ data: 'status', render: ( data, type, row, meta ) => { return ( data )?'<span class="badge bg-success"> Activo </span>':'<span class="badge bg-danger"> Inactivo </span>';  } },
	        	{ data: 'status', render: ( data, type, row ) => { return '<button class="btn btn-primary btn-sm" uid="'+row.idsupplier+'"> <i class="fa-solid fa-folder-open"></i> </button>'; } },
	        ];
	const ajax = {
		url: "http://localhost:8080/api/suppliers",
		type : "GET",
		dataSrc: "suppliers",
		beforeSend: ( req ) => {
			req.setRequestHeader('x-token', localStorage.getItem('x-token') );
			req.setRequestHeader('search', $('#input-search').val() );
		},			
		error: function( errors ){
			handleErrors( errors );
		}
	}

	const table = dataTable( opts, ajax, columns );

	const modal = $('#modal-supplier');
	modal.modal({backdrop: 'static', keyboard: false, show:true });

	//Buscar supplier
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
		const form = document.forms['form-supplier'];
		form.reset();

		$('#hi_idsupplier').val('');
		$('#sp-uid').html('')

		modal.modal('show');
	});

	//Consultar registro
	$('#table-supplier').on('click', 'button', function(){
		const uid = $(this).attr("uid");

		const headers = {
			'x-token': localStorage.getItem('x-token')
		}

		const settings = ajaxSettingGen( `${apiObj.host}/api/suppliers/${uid}`, 'GET', headers, null );

		const request = ajaxRequest( settings );

		request.then( response => {
			const form = document.forms['form-supplier'];
			form.reset();

			const { supplier } = response;
			const { iduser_create, iduser_update, createdAt, updatedAt, ...data } = supplier;

			$("#sp-uid").html( data.idsupplier );

			fillInputs(data);
			
			$('#hi_idsupplier').val(data.idsupplier);

			modal.modal('show');
		}, errors => {
			handleErrors( errors );
		});
	});

	//Guardar registro
	$('#btn-save-supplier').on('click', () => {
		const form = {
			idsupplier 		: { value:$('#hi_idsupplier').val(), requiered: false }, 
			name 			: { value:$('#name').val(), requiered: true }, 
			status 			: { value:$('#status').is(':checked'), requiered: false }, 
			bussines_name 	: { value:$('#bussines_name').val(), requiered: true }, 
			rfc 			: { value:$('#rfc').val(), requiered: false }, 
			phone1 			: { value:$('#phone1').val(), requiered: true }, 
			phone2 			: { value:$('#phone2').val(), requiered: false }, 
			email1 			: { value:$('#email1').val(), requiered: true }, 
			email2 			: { value:$('#email2').val(), requiered: false }
		};

		const { pass, pass_data } = formInputsValidate(form);

		if( pass ){
			const entries = new Map( pass_data );
			const { idsupplier, ...data } = Object.fromEntries(entries);
			const uid = $('#hi_idsupplier').val();

			const headers = {
				'x-token'		: localStorage.getItem('x-token'),
				'Content-Type' 	: 'application/json'
			}

			const settings = ajaxSettingGen( `${apiObj.host}/api/suppliers/${uid}`, (uid)?'PUT':'POST', headers, data );

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

