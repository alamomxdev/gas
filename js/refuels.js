$(document).ready( () => {
	$('button').on('click', (e)=>{ e.preventDefault(); });

	let regions = [];
	let subregions = [];
	const suppliers = [];

	let refuel_types = [];
	let refuel_subtypes = [];

	const refuel_plannings = {};

	const url=`${apiObj.host}/api/refuels/`;

	const headers_gen = {
	    'x-token' : localStorage.getItem('x-token')
	}

	const modal = $('#modal-refuel');
	const modal_cards = $('#modal-cards');
	const modal_vehicles = $('#modal-vehicles');
	const modal_img = $('#modal-img');

  	modal.modal({backdrop: 'static', keyboard: false, show:true });
  	modal_cards.modal({backdrop: 'static', keyboard: false, show:true });
  	modal_vehicles.modal({backdrop: 'static', keyboard: false, show:true });

//TABLAS
//############################################################
	//GENERARA LA TABLA DE RECARGAS
		const opts = {
			lengths : [ 20, 30, 50, 75, 100 ],
			language: genObj.language,
			buttons : genObj.buttons,
			limit : 20,
			id    : 'table-refuels'
		};
		const columns = [
			{ data: 'card' },
			{ data: 'refuel_number' },
			{ data: 'supplier' },
			{ data: 'refuel_type' },
			{ data: 'economic_number' },
			{ data: 'fm_planning' },
			{ data: 'subregion' },
			{ data: 'refuel_datetime' },
			{ data: 'refuel_createdat' },
			{ data: 'amount' },
			{ data: 'liters' },
			/*{ data: 'odometer' },*/
			{ 
				data: 'idrefuel', 
				render: ( data, type, row ) => { 
					const btn_open = `<button class='btn btn-primary btn-sm' idrefuel='${ data }'> <i class="fa-solid fa-pencil"></i> </button>`;

					const btn_img = ( row.img )?`<button class='btn btn-success btn-sm' img='${ row.img }'> <i class="fa-solid fa-image"></i> </button>`:'';

					return `${ btn_open } ${ btn_img }`; 
				} 
			}
		];
		const ajax = {
			url: url,
			type : "GET",
			dataSrc: "refuels",
			beforeSend: ( req ) => {
				req.setRequestHeader('x-token', localStorage.getItem('x-token') );

			},      
			error: function( errors ){
				handleErrors( errors );
			}
		}

		const table = dataTable( opts, ajax, columns );
	//GENERARA LA TABLA DE RECARGAS

	//Tabla de tatjetas
		const opts_g = {
			lengths 	: [ 10, 15 ],
			language	: genObj.language,
			buttons 	: genObj.buttons,
			limit 		: 10,
			id    		: 'table-cards',
			scrollY		: '25vh',
	        scrollCollapse	: true
		};
		const columns_g = [
			{ data: 'number' },
			{ data: 'supplier' },
			{ data: 'region' },
			{ data: 'subregion' },
			{ data: 'economic_number' },
			{ data: 'status', render: ( data, type, row ) => { 
				const region = ( row.region )?row.region:'';
				const subregion = ( row.subregion )?row.subregion:'';

				return `<button class='btn btn-primary btn-sm' idcard='${ row.idcard }' number='${ row.number }' economic_number='${ (row.economic_number)?row.economic_number:'' }' idvehicle='${ (row.idvehicle)?row.idvehicle:'' }' region='${ region }' subregion='${ subregion }'> 
								<i class="fa-solid fa-arrow-pointer"></i> 
						</button>`; 
			} }
		];
		const ajax_g = {
			url: `${apiObj.site}assets/cards.json`,
			type : "GET",
			dataSrc: "cards",
			beforeSend: ( req ) => {
				req.setRequestHeader('x-token', localStorage.getItem('x-token') );
			},      
			error: function( errors ){
				handleErrors( errors );
			}
		}
		const cards_table = dataTable( opts_g, ajax_g, columns_g );
	//Tabla de tatjetas

	//Tabla de historico de auto
		const opts_v= {
			lengths 	: [ 10, 15 ],
			language	: genObj.language,
			buttons 	: genObj.buttons,
			limit 		: 10,
			id    		: 'table-vehicle',
			scrollY		: '38vh',
	        scrollCollapse	: true
		};

		const columns_v = [
			{ data: 'VehicleNumber' },
			{ data: 'SequenceNumber' },
			{ data: 'VehicleDriverHistoryNumber' },
			{ data: 'TipoEstatus' },
			{ data: 'Type' },
			{ data: 'PickUpLocation' },
			{ data: 'DropOffLocation' },
			{ data: 'StartTime', render:( data, type, row ) =>{ return FMDateRes( data ); } },
			{ data: 'EndTime', render:( data, type, row ) =>{ return FMDateRes( data ); } },
			{ data: 'ActualStartTime', render:( data, type, row ) =>{ return FMDateRes( data ); } },
			{ data: 'ActualEndTime', render:( data, type, row ) =>{ return FMDateRes( data ); } },
			{ 
				data: 'InvoicingStatus', 
				render: ( data, type, row ) => { 
						const fm_contract=( !row.VehicleDriverHistoryNumber )
																			? ''
																			: row.VehicleDriverHistoryNumber;  

						const idregion = row.PickUpRegionSrId;
						const idsubregion = row.PickUpRegionId;

						const region = row.PickUpRegionSr;
						const subregion = row.PickUpRegion;

						const idrefuel_type = parseInt( $('#refuel_type').val()?$('#refuel_type').val():0 );
						const idrefuel_subtype = parseInt( $('#refuel_type').val()?$('#refuel_subtype').val():0 );

						const plannings = refuel_plannings.refuel_plannings;

						let button = 0;

						if( idrefuel_type && idrefuel_subtype ){
							const onid = [];
							const onparent = [];

							plannings.forEach( ( e, i, a ) => {
								
								if( e.idrefuel_type===idrefuel_subtype )
									onid.push( e );

								if( e.idrefuel_type===idrefuel_type )
									onparent.push( e );
							});
				

							if( onid.length > 0 ){
								onid.forEach( ( element, index, array ) => {
									if( element.idplanning_type === parseInt(row.PlanningType) ){
										button = 1;

										return;
									}
								});
							}

							if( onparent.length > 0 ){
								onparent.forEach( ( element, index, array ) => {
									if( element.idplanning_type === parseInt( row.PlanningType ) ){
										button = 1;

										return;
									}

									if( [ 26, 27 ].includes( element.idplanning_type ) && element.idplanning_type === parseInt( row.TypeId ) ){
										button = 1;

										return;
									}
								});
							}
						}

						return ( button ) ?`
								<button class='btn btn-primary btn-sm' region='${ region }' subregion='${ subregion }' idregion='${ idregion }' idsubregion='${ idsubregion }' id economic_number='${ row.VehicleNumber }' fm_planning='${ row.SequenceNumber }' fm_contract='${ fm_contract }'> 
									<i class='fa-solid fa-arrow-pointer'></i> 
								</button>`:''; 
				}

			}
		];

		const ajax_v = {
			url: `${apiObj.site}assets/vehicles.json`,
			type : "GET",
			dataSrc: "result",
			beforeSend: ( req ) => {
				req.setRequestHeader('x-token', localStorage.getItem('x-token') );				
			},  
			error: function( errors ){
				handleErrors( errors );
			}
		}

		const vehicle_table = dataTable( opts_v, ajax_v, columns_v );
	//Tabla de historico de auto
//############################################################

//Datos de BD
//############################################################
	//Oteber regiones y subregiones
  	const request_regions = ajaxRequest( ajaxSettingGen(`${apiObj.host}/api/regions`, 'GET', headers_gen) );
  	request_regions.then( response => {
  		regions = response.regions;
  		subregions = response.subregions;

  		$('#filter_region').append('<option value="">Region</option>');
  		$('#region_cost').append('<option value=""></option>');

  		regions.forEach( e => {
  			$('#filter_region, #region_cost').append(`<option value='${ e.idregion }'>${ e.name }</option`);
  		});
  	}, errors => {
  		handleErrors( errors );
  	});
	//############################################################

	//############################################################
	//Oteber proveedores para los filtos
	const request_suppliers = ajaxRequest( ajaxSettingGen(`${apiObj.host}/api/suppliers?active=1`, 'GET', headers_gen) );
	request_suppliers.then( response => {
		response.suppliers.forEach( (e, i, a) => {
			suppliers.push( { idsupplier:e.idsupplier, name:e.name } );

			$("#supplier").append(`<option value='${ e.idsupplier }'>${ e.name }</option>`);
		});
	}, errors => {
		handleErrors( errors );
	});

	//Obtejer tipos de carga
	const req_refueltypes = ajaxRequest( ajaxSettingGen(`${apiObj.host}/api/refueltypes`, 'GET', headers_gen) );
	req_refueltypes.then( response => {
		const { refuel_types:types, refuel_subtypes:subtypes } = response;

		$('#refuel_type').html(`<option value=''></option>`)

		$.each( types, ( i, e ) => {
			const { createdAt, updatedAt, ...data } = e;

			$('#refuel_type').append(`<option value='${ e.idrefuel_type }'>${ e.name }</option>`);

			refuel_types.push( data );
		});

		$.each( subtypes, ( i, e ) => {
			const { createdAt, updatedAt, ...data } = e;

			refuel_subtypes.push( data );
		});
	}, errors => {
		handleErrors( errors );
	});

	//Refuel Plannings
	const req_plannings = ajaxRequest( ajaxSettingGen(`${apiObj.host}/api/refueltypes/plannings`, 'GET', headers_gen) );
	req_plannings.then( response => {
		
		refuel_plannings.planning_types = response.planning_types;
		refuel_plannings.refuel_types = response.refuel_types;
		refuel_plannings.refuel_plannings = response.refuel_plannings;

	}, errors => {
		handleErrors( errors );
	});
//############################################################

//Modal de Refuel
//############################################################
	//Cambio de region en filtro
	$('#filter_region').on('change', function(){
		const region = parseInt($(this).val());
		
		$('#filter_subregion').html('<option value="">Plaza</option>');

		$.each( subregions, ( i, e ) => {
			if( e.idparent===region )
				$('#filter_subregion').append(`<option value='${ e.idregion }'>${ e.name }</option>`);
		});
	});

	//Cambio de region de cost
	$('#region_cost').on('change', function(){
		const idparent = parseInt($(this).val());

		fillSubRegionCost( idparent );
	});

	//Buscar Refuel
	$('#btn-search').on('click', () => { 
		const data = {
			refuel_number 	: $('#input-search').val(),
			idregion 		: ( $('#filter_region').val() )?parseInt( $('#filter_region').val() ):'',
			idsubregion 	: ( $('#filter_subregion').val() )?parseInt( $('#filter_subregion').val() ):'',
			f1 				: $('#filter-f1').val(),
			f2 				: $('#filter-f2').val()
		}

		const u = objTOurl( data );

		table.ajax.url(`${ url }?${ u }`).load(); 
	});

	//Calculo de litros
	$('#amount, #liters').on('keyup', ()=>{
		PerLiter();
	});

	//Buscar con ENTER
	$("#input-search").on('keypress', (e)=>{
		if( e.which===13 )
			$('#btn-search').click();	
	});

	//Obtener subtipos de carga
	$('#refuel_type').on('change', function(){
		const idparent = parseInt($(this).val());

		emptyVehicle();

		fillSubtype( idparent );
	});

	$('#refuel_subtype').on('change', function(){
		emptyVehicle();
	});

	//Nuevo registro
	$('#btn-add').on('click', ()=>{
		deleteForm();
		
		modal.modal('show');
	});

	//Guardar o modificar registro
	$('#btn-save-refuel').on('click', () => {
		const uid = $('#hi_idrefuel').val();

		const form = {
			idsupplier		: { value : parseInt( $('#supplier').val() ), required : true },
			idcard			: { value : parseInt( $('#card').attr('idcard') ), required : true },
			refuel_number 	: { value : $('#refuel').val(), required : true },
			idrefuel_type	: { value : parseInt( $('#refuel_type').val() ), required : true },
			idrefuel_subtype: { value : parseInt( $('#refuel_subtype').val() ), required : true },
			idvehicle		: { value : parseInt( $('#vehicle').attr('idvehicle') ) },
			fm_planning		: { value : $('#fm_planning').val() },
			fm_contract		: { value : $('#fm_contract').val() },
			idregion 		: { value : parseInt( $('#region').attr('idregion') ) },
			idsubregion 	: { value : parseInt( $('#subregion').attr('idsubregion') ) },
			idregion_cost 	: { value : parseInt( $('#region_cost').val() ), required : true },
			idsubregion_cost: { value : parseInt( $('#subregion_cost').val() ), required : true },
			refuel_date 	: { value : $('#refuel_date').val(), required : true },
			refuel_time 	: { value : $('#refuel_time').val(), required : true },
			amount 			: { value : parseFloat( $('#amount').val() ), required : true },
			liters 			: { value : parseFloat( $('#liters').val() ), required : true },
			comments 		: { value : $('#comments').val() }
		}

		let { pass, pass_data } = formInputsValidate(form);

		console.log( form );

		//SI es auto nuevo no necesita auto
		if( form.idrefuel_subtype.value !== 15 && !form.idvehicle.value  ){
			pass = false;

			toastr.warning('Es requerido un auto para seguir con la carga');
		}

		if( pass ){
			const entries = new Map( pass_data );
      		const data  = Object.fromEntries(entries);

      		const headers = {
		        'x-token'   : localStorage.getItem('x-token'),
		        'Content-Type'  : 'application/json'
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

	//Seleccionar una recarga
	$('#table-refuels').on('click', '.btn-primary', function(){
		const idrefuel = parseInt( $(this).attr('idrefuel') );

		const req = ajaxRequest( ajaxSettingGen(`${url}${idrefuel}`, 'GET', headers_gen) );

		req.then( response => {
			const { refuel } = response;

			deleteForm();

			fillSubtype( refuel.idrefuel_type );
			fillSubRegionCost( refuel.idregion_cost );

			$('#sp-uid').html( refuel.refuel_number );
			$('#hi_idrefuel').val( refuel.idrefuel );
			$('#supplier').val( refuel.idsupplier );
			$('#card').val( refuel.card );
			$('#card').attr( 'idcard', refuel.idcard );
			$('#refuel').val( refuel.refuel_number );
			$('#refuel_type').val( refuel.idrefuel_type );
			$('#refuel_subtype').val( refuel.idrefuel_subtype );
			$('#vehicle').val( refuel.economic_number );
			$('#vehicle').attr( 'economic_number', refuel.economic_number );
			$('#vehicle').attr( 'idvehicle', refuel.idvehicle );
			$('#region').val( refuel.region );
			$('#region').attr( 'idregion', refuel.idregion );
			$('#subregion').val( refuel.subregion );
			$('#subregion').attr( 'idsubregion', refuel.idsubregion );
			$('#region_cost').val( refuel.idregion_cost );
			$('#subregion_cost').val( refuel.idsubregion_cost );
			$('#fm_planning').val( refuel.fm_planning );
			$('#fm_contract').val( refuel.fm_contract );
			$('#refuel_date').val( refuel.refuel_date );
			$('#refuel_time').val( refuel.refuel_time );
			$('#amount').val( refuel.amount );
			$('#liters').val( refuel.liters );
			$('#comments').val( refuel.comments );

			$('#btn-view-img').attr('img', refuel.img );

			if( !refuel.img )
				$('#btn-view-img').prop('disabled', true);

			$('#refuel_attached').removeClass('d-none');

			PerLiter();

			modal.modal('show');
		}, errors => {
			handleErrors( errors );
		})
	});

	//Ver una imagen previa
	$('#table-refuels').on('click', '.btn-success', function(){
		const img = $(this).attr('img');

		$('#modal-img img').prop('src', '');
		
		$('#modal-img img').prop('src', `https://dg8dw0ohxnqbu.cloudfront.net/${img}`);

		modal_img.modal('show');
	});

	$('#btn-upload-img').on('click', () => {
		const file = $('#img').prop('files');
		const idrefuel = $('#hi_idrefuel').val();

		if( file.length > 0 ){
			const form = new FormData();

			form.append('file', file[0]);

			var settings = {
				"url": `${ apiObj.host }/api/uploads/refuels/${ idrefuel }`,
				"method": "PUT",
				"timeout": 0,
				"headers": {
					"x-token": localStorage.getItem('x-token')
				},
				dataType:'json',
				"processData": false,
				"mimeType": "multipart/form-data",
				"contentType": false,
				"data": form
			};

			const upload = ajaxRequest( settings );

			upload.then( response => {
				toastr.success(`Imagen de ticket ${ response.uploadS3.key } subida con exito`);

				$('#btn-view-img').attr('img', response.uploadS3.key );
				$('#btn-view-img').prop('disabled', false);

				$('#img').val('');
			}, errors => {
				handleErrors( errors );
			});
		}
	});

	$('#btn-view-img').on('click', function(){
		const img = $(this).attr('img');

		//window.open('https://dg8dw0ohxnqbu.cloudfront.net/'+img);

		$('#modal-img img').prop('src', '');
		
		$('#modal-img img').prop('src', `https://dg8dw0ohxnqbu.cloudfront.net/${img}`);

		modal_img.modal('show');
	});
//############################################################

//MODAL DE TERJTAS
//#####################################################################
	//Mostrar modal para buscar tarjetas
	$('#btn-card').on('click', () => {
		modal.modal('hide');

		const data = { active:1, supplier:$('#supplier').val() };

		const u = objTOurl( data );

		cards_table.ajax.url(`${apiObj.host}/api/cards?${u}`).load();

		modal_cards.modal('show');
	});

	//Seleccionar una tarjeta
	$('#table-cards').on('click', '.btn', function(){
		const idcard = $(this).attr('idcard')
		const economic_number = $(this).attr('economic_number');
		const idvehicle = $(this).attr('idvehicle');
		const number = $(this).attr('number');

		const region = $(this).attr('region');
		const subregion = $(this).attr('subregion');

		$('#card').val( number );
		$('#card').attr('idcard', idcard);
		$('#card').attr('economic_number', economic_number);
		$('#card').attr('idvehicle', idvehicle);

		if( idvehicle ){

		}

		/*$('#region').val(region);
		$('#subregion').val(subregion);*/

		modal_cards.modal('hide');
		modal.modal('show');
	});

	//Buscar con Enter
	$('#card-search').on('keypress', (e)=>{
		if( e.which===13 )
			$('#btn-search-card').click();
	});

	//Buscar con click
	$('#btn-search-card').on('click', () => {
		const data = {
			supplier: $('#supplier').val(),
			active	: 1,
			search	: $('#card-search').val()
		}

		const u = objTOurl( data );

		cards_table.ajax.url(`${ apiObj.host }/api/cards?${ u }`).load();
	});

	//Cerar modal de tarjetas
	$('#btn-card-close').on('click', ()=>{
		modal_cards.modal('hide');
		modal.modal('show');
	});

	//Borrar datos de tarjeta
	$('#btn-erase-card').on('click', ()=>{
		$('#card').val('');
		$('#card').attr('idcard', '');
		$('#card').attr('economic_number', '');
		$('#card').attr('idvehicle', '');

		/*$('#region').val('');
		$('#subregion').val('');*/
	});

	//Cuando su supplier se cambis
	$('#supplier').on('change', ()=>{
		$('#btn-erase-card').click();
	});

	//Cerrar modal
	$('#btn-modal-close').on('click', ()=>{
		modal.modal('hide');
	});
//#####################################################################

//MODAL DE Vehiculos
//#####################################################################
	//Mostrar modal para ver vehiculo
	$('#btn-vehicle').on('click', () => {
		const refuel_type = $('#refuel_type').val();
		const refuel_subtype = $('#refuel_subtype').val();

		if(  refuel_type && refuel_subtype ){
			modal_vehicles.modal('show');
			modal.modal('hide');

			const card_vehicle = $('#card').attr('economic_number');
			

			$('#modal-vehicles input').val('');
			$('#vehicle-number').attr( 'idvehicle', '' );

			if( card_vehicle ){
				$('#vehicle-search').val( card_vehicle );
			}

			vehicle_table.ajax.url(`${ ajax_v.url }`).load();
		}
		else
			toastr.warning('Tipo de carga y proposito requeridos');

	});

	//Borrar input de busqueda de vehiculo
	$('#btn-erase-vehicle').on('click', () => {
		emptyVehicle();
	});

	//Cerrar modal de vehiculos
	$('#btn-vehicle-close').on('click', () => {
		modal_vehicles.modal('hide');
		modal.modal('show');
	});

	//Buscar en tabla
	$('#btn-search-vehicle').on('click', () => {
		const card_vehicle = $('#card').attr('economic_number');

		if( card_vehicle )
			$('#vehicle-search').val( card_vehicle );

		const economic_number = $('#vehicle-search').val();

		if( economic_number ){
			const req_v = ajaxRequest( ajaxSettingGen(`${apiObj.host}/api/vehicles/search/${ economic_number }`, 'GET', headers_gen) );

			req_v.then( response => {
				const { vehicles:vehicle } = response;

				$('#vehicle-number').val( vehicle.economic_number );
				$('#vehicle-number').attr( 'idvehicle', vehicle.idvehicle );
				$('#vehicle-type').val( vehicle.type );
				$('#vehicle-model').val( vehicle.model );
				$('#vehicle-brand').val( vehicle.brand );
				$('#vehicle-license_plate').val( vehicle.license_plate );
				$('#vehicle-year').val( vehicle.year );
				$('#vehicle-version').val( vehicle.version );
				$('#vehicle-chassis_number').val( vehicle.chassis_number );

				//vehicle_table.ajax.url(`${ apiObj.host }/api/fm/vehiclehistory/${ economic_number }`).load();
				vehicle_table.ajax.url(`${ apiObj.site }/ajax/response.php?e=${ economic_number }`).load();

			}, errors => {
				handleErrors( errors );
			});
		}
		else{
			toastr.warning('Numero de vehiculo requerido');
		}
	});

	//Seleccionar un vehiculo
	$('#table-vehicle').on('click', '.btn', function(){
		const idvehicle = $('#vehicle-number').attr('idvehicle');
		const economic_number = $(this).attr('economic_number');
		const fm_planning = $(this).attr('fm_planning');
		const fm_contract = $(this).attr('fm_contract');

		const region = $(this).attr('region');
		const subregion = $(this).attr('subregion');
		const idregion = $(this).attr('idregion');
		const idsubregion = $(this).attr('idsubregion');

		$('#vehicle').val( economic_number );
		$('#vehicle').attr('idvehicle', idvehicle);
		$('#vehicle').attr('economic_number', economic_number);

		$('#fm_planning').val( fm_planning );
		$('#fm_contract').val( fm_contract );

		$('#region').val(region);
		$('#region').attr('idregion', idregion);
		$('#subregion').val(subregion);
		$('#subregion').attr('idsubregion', idsubregion);


		modal_vehicles.modal('hide');
		modal.modal('show');
	});

	//Busqueda con ENTER
	$('#vehicle-search').on('keypress', (e)=>{
		if( e.which===13 )
			$('#btn-search-vehicle').click();
	});
//#####################################################################

	const deleteForm = () =>{
		const form = document.forms['form-refuel'];
		form.reset();

		$('#sp-uid').html( '' );

		$('#card').val('');
		$('#card').attr('idcard', '');
		$('#card').attr('economic_number', '');
		$('#card').attr('idvehicle', '');

		$('#hi_idrefuel').val('');

		$('#vehicle').val('');
		$('#vehicle').attr('idvehicle', '');
		$('#vehicle').attr('economic_number', '');

		$('#region').attr('idregion', '');
		$('#subregion').attr('idsubregion', '');

		$('#comments').val('');

		$('#refuel_attached').addClass('d-none');
		$('#btn-view-img').attr('img', '');

		$('#btn-view-img').prop('disabled', false);
	}

	const FMDate = ( data ) =>{
		if( !data )
			return null;


		const date = data.split('T');

		const d = date[0].split('-');

		return `${ d[2] }/${ d[1] }/${ d[0] } ${ date[1].slice(0, -8) }`;
	}

	const FMDateRes = ( data ) =>{
		if( !data )
			return null;


		const date = data.split(' ');

		const d = date[0].split('-');

		return `${ d[2] }/${ d[1] }/${ d[0] } ${ date[1].slice(0, -8) }`;
	}

	const fillSubtype = ( idparent ) => {
		$('#refuel_subtype').html(`<option value=''></option>`);

		refuel_subtypes.forEach( ( e, i, a ) => {
			if( e.idparent===idparent )
				$('#refuel_subtype').append(`<option value='${ e.idrefuel_type }'>${ e.name }</option>`);
		});
	}

	const fillSubRegionCost = ( idparent ) => {
		$('#subregion_cost').html(`<option value=''></option>`);

		subregions.forEach( (e, i, a) => {
			if( idparent===e.idparent )
				$('#subregion_cost').append(`<option value='${ e.idregion }'>${ e.name }</option>`);
		});
	}

	const PerLiter = () => {
		const amount = parseFloat( $('#amount').val() );
		const liters = parseFloat( $('#liters').val() );

		$('#amount_per_liter').val('');

		if( amount>0 && liters>0 ){
			const pl = new Intl.NumberFormat('en-IN').format( amount/liters );

			$('#amount_per_liter').val( pl );
		}
	}

	const emptyVehicle = () => {
		$('#vehicle').val('');
		$('#vehicle').attr('idvehicle', '');
		$('#vehicle').attr('economic_number', '');


		$('#fm_planning').val('');
		$('#fm_contract').val('');

		$('#region').val('');
		$('#region').attr('idregion', '');
		$('#subregion').val('');
		$('#subregion').attr('idsubregion', '');
	}
});