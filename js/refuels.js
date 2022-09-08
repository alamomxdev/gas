$(document).ready( () => {
	$('button').on('click', (e)=>{ e.preventDefault(); });

	let regions = [];
	let subregions = [];
	let locations = [];
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
	const modal_locations = $('#modal-locations');
	const modal_staff = $('#modal-staff')

  	modal.modal({backdrop: 'static', keyboard: false, show:true });
  	modal_cards.modal({backdrop: 'static', keyboard: false, show:true });
  	modal_vehicles.modal({backdrop: 'static', keyboard: false, show:true });
  	modal_locations.modal({backdrop: 'static', keyboard: false, show:true });
  	modal_staff.modal({backdrop: 'static', keyboard: false, show:true });

//TABLAS
//############################################################
	//GENERARA LA TABLA DE RECARGAS
		const opts = {
			lengths : [ 20, 30, 50, 75, 100 ],
			language: genObj.language,
			dom: '<Bl<f>rtip>',
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
			{ 
				data: 'fm_planning',
				render : ( data, type, row ) => {
					return ` ${ (data)?data:'' }${ ( row.fm_contract )?` / ${row.fm_contract}`:'' } `;
				} 
			},
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

					const ext = ( row.img )?row.img.split('.'):[];

					const btn_img = ( row.img )?`<button class='btn btn-success btn-sm' img='${ row.img }'> <i class="fa-solid ${ ext[1]==='pdf'?'fa-file-pdf':'fa-image' } "></i> </button>`:'';

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
		const opts_s = {
			lengths 	: [ 10, 15 ],
			language	: genObj.language,
			buttons 	: genObj.buttons,
			limit 		: 10,
			id    		: 'table-staff',
			scrollY		: '25vh',
	        scrollCollapse	: true
		};
		const columns_s = [
			{ data: 'idstaff' },
			{ data: 'name' },
			{ data: 'staff_type' },
			{ data: 'status', render: ( data, type, row ) => { 
				return `<button class='btn btn-primary btn-sm' idstaff='${ row.idstaff }' name='${ row.name }'> 
								<i class="fa-solid fa-arrow-pointer"></i> 
						</button>`; 
			} }
		];
		const ajax_s = {
			url: `${apiObj.site}assets/staff.json`,
			type : "GET",
			dataSrc: "staff",
			beforeSend: ( req ) => {
				req.setRequestHeader('x-token', localStorage.getItem('x-token') );
			},      
			error: function( errors ){
				handleErrors( errors );
			}
		}
		const staff_table = dataTable( opts_s, ajax_s, columns_s );
	//Tabla de Staff

	//Tabla de Staff

	//Tabla de oficinas
		const opts_l = {
			lengths 	: [ 10, 15 ],
			language	: genObj.language,
			buttons 	: genObj.buttons,
			limit 		: 10,
			id    		: 'table-locations',
			scrollY		: '25vh',
	        scrollCollapse	: true
		};
		const columns_l = [
			{ data: 'reference' },
			{ data: 'name' },
			{ data: 'subregion' },
			{ data: 'region' },
			{ data: 'status', render: ( data, type, row ) => { 
				return `<button class='btn btn-primary btn-sm' idlocation='${ row.idlocation }' location='${ row.name }'> 
								<i class="fa-solid fa-arrow-pointer"></i> 
						</button>`; 
			} }
		];
		const ajax_l = {
			url: `${apiObj.site}assets/locations.json`,
			type : "GET",
			dataSrc: "locations",
			beforeSend: ( req ) => {
				req.setRequestHeader('x-token', localStorage.getItem('x-token') );
			},      
			error: function( errors ){
				handleErrors( errors );
			}
		}
		const cards_locations = dataTable( opts_l, ajax_l, columns_l );
	//Tabla de oficinas

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
			{ data: 'SequenceNumber' },
			{ data: 'VehicleDriverHistoryNumber' },
			{ data: 'Type' },
			{ data: 'PickUpLocation' },
			{ data: 'DropOffLocation' },
			{ data: 'ActualStartTime', render:( data, type, row ) =>{ return FMDate( data ); } },
			{ data: 'ActualEndTime', render:( data, type, row ) =>{ return FMDate( data ); } },
			{ data: 'VeicleChanged', render:( data, type, row ) =>{ return ( data )?'Si':'No' } },
			{ data: 'fullTankPrepayment', render:( data, type, row ) =>{ 
				const prepay = ( ( data==='true' )?'Si':'' )

				return prepay; 
			} },
			{ data: 'ActualEndTime', render:( data, type, row ) =>{ 
				const { StartFuelLevel, EndFuelLevel, FuelCapacity } = row;

				const liters = ( StartFuelLevel > EndFuelLevel ) ? (((StartFuelLevel-EndFuelLevel)/100)*FuelCapacity)+' lts' : '';

				return liters;
			} },
			{ data: 'HasERA', render:( data, type, row ) =>{ 
				const ret = ( ( data )?'Si':'' )

				return ret; 
			} },
			{ data: 'HasDrop', render:( data, type, row ) =>{ 
				const ret = ( ( data )?'Si':'' )

				return ret; 
			} },
			{ data: 'HasDelivery', render:( data, type, row ) =>{ 
				const ret = ( ( data )?'Si':'' )

				return ret; 
			} },
			{ data: 'HasRecolection', render:( data, type, row ) =>{ 
				const ret = ( ( data )?'Si':'' )

				return ret; 
			} },
			{ 
				data: 'InvoicingStatus', 
				render: ( data, type, row ) => { 
						const fm_contract=( !row.VehicleDriverHistoryNumber )
																			? ''
																			: row.VehicleDriverHistoryNumber;  

						const location_start = row.PickUpLocation;
						const idlocation_start = row.PickUpLocationId;

						const location_end = row.DropOffLocation;
						const idlocation_end = row.DropOffLocationId;

						const idrefuel_type = parseInt( $('#refuel_type').val()?$('#refuel_type').val():0 );
						const idrefuel_subtype = parseInt( $('#refuel_type').val()?$('#refuel_subtype').val():0 );

						const plannings = refuel_plannings.refuel_plannings;

						let button = 0;

						button = row.Selectable;
						return ( row.Selectable ) ?`
								<button class='btn btn-primary btn-sm' 
									location_start='${ location_start }'
									idlocation_start='${ idlocation_start }'
									location_end='${ location_end }'
									idlocation_end='${ idlocation_end }'
									economic_number='${ row.VehicleNumber }' 
									fm_planning='${ row.SequenceNumber }' 
									fm_contract='${ fm_contract }'
									idplanning_type='${ row.PlanningType }'
									planning_type='${ row.Type }'
									odometer='${ row.EndOdometer }'>
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
  		locations = response.locations;


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

			$("#supplier, #filter_supplier").append(`<option value='${ e.idsupplier }'>${ e.name }</option>`);
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

			$('#refuel_type').append(`<option value='${ e.idrefuel_type }'>${ e.name } </option>`);

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

	//Obtener tipos de combutible
	const req_fueltypes = ajaxRequest( ajaxSettingGen(`${apiObj.host}/api/fueltypes`, 'GET', headers_gen) );
	req_fueltypes.then( res => {
		const { fuelTypes } = res;

		$('#fuel_type').html('<option value=""></option>')

		fuelTypes.forEach( ( fuel, i ) => {
			$('#fuel_type').append(`<option value='${ fuel.idfuel_type }'>${ fuel.name }</option>`);
		});
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
		$('#filter_location').html('<option value="">Oficina</option>');

		$.each( subregions, ( i, e ) => {
			if( e.idparent===region )
				$('#filter_subregion').append(`<option value='${ e.idregion }'>${ e.name }</option>`);
		});
	});

	//Cambio de plaza
	$('#filter_subregion').on('change', function(){
		const subregion = parseInt( $(this).val() );

		$('#filter_location').html('<option value="">Oficina</option>');

		locations.forEach( ( location, index ) => {
			if( subregion === location.idregion )
				$('#filter_location').append(`<option value='${ location.idlocation }'>${ location.name }</option>`);
		});
	});

	//Buscar Refuel
	$('#btn-search').on('click', () => { 
		const data = {
			refuel_number 	: $('#input-search').val(),
			idregion 		: ( $('#filter_region').val() )?parseInt( $('#filter_region').val() ):'',
			idsubregion 	: ( $('#filter_subregion').val() )?parseInt( $('#filter_subregion').val() ):'',
			f1 				: $('#filter-f1').val(),
			f2 				: $('#filter-f2').val(),
			idlocation 		: ( $('#filter_location').val() ) ? parseInt( $('#filter_location').val() ) : '',
			idsupplier		: ( $('#filter_supplier').val() )?parseInt( $('#filter_supplier').val() ):''
		}

		const u = objTOurl( data );

		table.ajax.url(`${ url }?${ u }`).load(); 
	});

	$('#btn-excel').on('click', () => {
		const data = {
			refuel_number 	: $('#input-search').val(),
			idregion 		: ( $('#filter_region').val() )?parseInt( $('#filter_region').val() ):'',
			idsubregion 	: ( $('#filter_subregion').val() )?parseInt( $('#filter_subregion').val() ):'',
			f1 				: $('#filter-f1').val(),
			f2 				: $('#filter-f2').val(),
			idlocation 		: ( $('#filter_location').val() ) ? parseInt( $('#filter_location').val() ) : '',
			idsupplier		: ( $('#filter_supplier').val() )?parseInt( $('#filter_supplier').val() ):''
		}

		const u = objTOurl( data );

		const request = ajaxRequest( ajaxSettingGen(`${url}/excel?${ u }`, 'GET', headers_gen) );

		request.then( res => {
			toastr.success(`Archivo enviado a su cuenta de correo <i class="fa-solid fa-envelope-circle-check"></i>`);
		}, errors => {
			handleErrors(errors);
		} )
	});

	$('#btn-layout-atica').on('click', () => {
		const data = {
			refuel_number 	: $('#input-search').val(),
			idregion 		: ( $('#filter_region').val() )?parseInt( $('#filter_region').val() ):'',
			idsubregion 	: ( $('#filter_subregion').val() )?parseInt( $('#filter_subregion').val() ):'',
			f1 				: $('#filter-f1').val(),
			f2 				: $('#filter-f2').val(),
			idlocation 		: ( $('#filter_location').val() ) ? parseInt( $('#filter_location').val() ) : '',
			idsupplier		: ( $('#filter_supplier').val() )?parseInt( $('#filter_supplier').val() ):''
		}

		const u = objTOurl( data );

		const request = ajaxRequest( ajaxSettingGen(`${url}/excelAtica?${ u }`, 'GET', headers_gen) );

		request.then( res => {
			toastr.success(`Layout para <b>Atica</b> enviado a su correo <i class="fa-solid fa-envelope-circle-check"></i>`);
		}, errors => {
			handleErrors(errors);
		} )
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
			idsupplier			: { value : parseInt( $('#supplier').val() ), required : true },
			idcard				: { value : parseInt( $('#card').attr('idcard') ), required : true },
			refuel_number 		: { value : $('#refuel').val(), required : true },
			idrefuel_type		: { value : parseInt( $('#refuel_type').val() ), required : true },
			idrefuel_subtype	: { value : parseInt( $('#refuel_subtype').val() ), required : true },
			idvehicle			: { value : parseInt( $('#vehicle').attr('idvehicle') ) },
			fm_planning			: { value : $('#fm_planning').val() },
			fm_contract			: { value : $('#fm_contract').val() },
			idplanning_type		: { value : ( $('#planning_type').attr('idplanning_type') )?parseInt( $('#planning_type').attr('idplanning_type') ):'' },
			idlocation 			: { value : parseInt( $('#location').attr('idlocation') ), required : true },
			idlocation_cost 	: { value : parseInt( $('#location_cost').attr('idlocation') ), required : true },
			idlocation_start 	: { value : parseInt( $('#location_start').attr('idlocation_start') ) },
			idlocation_end 		: { value : parseInt( $('#location_end').attr('idlocation_end') ) },
			refuel_date 		: { value : $('#refuel_date').val(), required : true },
			refuel_time 		: { value : $('#refuel_time').val(), required : true },
			amount 				: { value : parseFloat( $('#amount').val() ), required : true },
			liters 				: { value : parseFloat( $('#liters').val() ), required : true },
			comments 			: { value : $('#comments').val() },
			odometer			: { value : parseInt( $('#odometer').val() ) },
			idstaff				: { value : parseInt( $('#staff').attr('idstaff') ), required : true },
			idfuel_type 		: { value : parseInt( $('#fuel_type').val() ), required : true }
		}

		let { pass, pass_data } = formInputsValidate(form);

		//Resfuel Sub Type
		let rsp;
		refuel_subtypes.forEach( ( row, i ) => {
			if( form.idrefuel_subtype.value == row.idrefuel_type )
				rsp = row;
		});

		//console.log( rsp );

		//SI es auto nuevo no necesita planeacion
		if( !form.fm_planning.value && rsp.hasPlanning  ){
			pass = false;

			toastr.warning('Es requerido una planeacion para seguir con la carga');
		}

		if(  !form.idvehicle.value && rsp.hasVehicle ){
			pass = false;

			toastr.warning('Es necesario seleccionar un vehiculo para la carga');
		}

		if( !form.odometer.value && rsp.hasVehicle ){
			pass = false;

			toastr.warning('Es necesario ingresar el kilometraje de la unidad');
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
			
			$('#location').val( refuel.location );
			$('#location').attr( 'idlocation', refuel.idlocation );
			$('#location_cost').val( refuel.location_cost );
			$('#location_cost').attr( 'idlocation', refuel.idlocation_cost );
			$('#location_start').val( refuel.location_start );
			$('#location_start').attr( 'idlocation_start', refuel.idlocation_start );
			$('#location_end').val( refuel.location_end );
			$('#location_end').attr( 'idlocation_end', refuel.idlocation_end );

			$('#odometer').val( refuel.odometer );
			
			$('#fm_planning').val( refuel.fm_planning );
			$('#fm_contract').val( refuel.fm_contract );
			$('#planning_type').val( refuel.planning_type );
			$('#planning_type').attr('idplanning_type', refuel.idplanning_type );
			$('#refuel_date').val( refuel.refuel_date );
			$('#refuel_time').val( refuel.refuel_time );
			$('#amount').val( refuel.amount );
			$('#liters').val( refuel.liters );

			$('#fuel_type').val( refuel.idfuel_type );

			$('#staff').val( refuel.staff );
			$('#staff').attr('idstaff', refuel.idstaff);

			$('#comments').val( refuel.comments );

			fillRefuelRegions( refuel.idregion, refuel.idsubregion );

			$('#btn-view-img').attr('img', refuel.img );

			if( !refuel.img ){
				$('#btn-view-img').prop('disabled', true);
				$('#btn-view-img').html(`<i class="fa-solid fa-image"></i>`);
			}
			else{
				const ext = refuel.img.split('.');

				$('#lb_img').html( refuel.img );

				$('#btn-view-img').html(`<i class="fa-solid ${ (ext[1]==='pdf')?'fa-file-pdf':'fa-image' } "></i>`);
			}

			$('#refuel_attached').removeClass('d-none');

			PerLiter();

			modal.modal('show');
		}, errors => {
			handleErrors( errors );
		})
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

	//Ver una imagen previa
	$('#table-refuels').on('click', '.btn-success', function(){
		const ext = $(this).attr('img').split('.');
		const img = $(this).attr('img');

		if( ext[1]==='pdf' ){
			window.open( `${apiObj.cdn}/${img}` );
		}
		else{
			$('#modal-img img').prop('src', '');
			
			$('#modal-img img').prop('src', `${apiObj.cdn}/${img}`);

			modal_img.modal('show');
		}
		
	});

	$('#btn-view-img').on('click', function(){
		const ext = $(this).attr('img').split('.');
		const img = $(this).attr('img');

		if( ext[1]==='pdf' ){
			window.open( `${apiObj.cdn}/${img}` );
		}
		else{
			$('#modal-img img').prop('src', '');
			
			$('#modal-img img').prop('src', `${apiObj.cdn}/${img}`);

			modal_img.modal('show');
		}
	});

	$('#img').on('change', function(){
		const file = $('#img').prop('files');

		$('#lb_img').html('Seleccione un archivo');

		if( file.length>0 ){
			$('#lb_img').html( file[0].name );
		}
	});
//############################################################

//MODAL DE OFICINAS
	$('#btn-location, #btn-location_cost').on('click', function(){
		modal.modal('hide');

		const is_cost = ( $(this).attr('id')=='location_cost' ) ? true : false;

		$('#location-search').val('');

		const data = { search:$('#location-search').val(), is_cost };

		const u = objTOurl( data );

		cards_locations.ajax.url(`${apiObj.host}/api/locations?${u}`).load();

		$('#location_type').val( $(this).attr('id') );

		modal_locations.modal('show');
	});

	$('#btn-search-location').on('click', () => {
		const data = { search:$('#location-search').val() };

		const u = objTOurl( data );

		cards_locations.ajax.url(`${apiObj.host}/api/locations?${u}`).load();
	});

	$('#location-search').on('keypress', (e) => {
		if( e.which===13 )
			$('#btn-search-location').click();
	});

	$('#btn-location-close').on('click', () => {
		modal.modal('show');

		modal_locations.modal('hide');
	});

	$('#table-locations').on('click', '.btn', function(){
		const idlocation = $(this).attr('idlocation');
		const location = $(this).attr('location');
		const type = $('#location_type').val();

		const input = ( type==='btn-location' )?'location':'location_cost';

		$(`#${ input }`).val( location );
		$(`#${ input }`).attr('idlocation', idlocation );

		modal_locations.modal('hide');
		modal.modal('show');
	});

	$("#btn-erase-location").on('click', () => {
		$('#location').val('');
		$('#location').attr('idlocation', '');
	});

	$("#btn-erase-location_cost").on('click', () => {
		$('#location_cost').val('');
		$('#location_cost').attr('idlocation', '');
	});
//MODAL DE OFICINAS

//MODAL DE TARJETAS
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

//MODAL DE STAFF
//#####################################################################
	//Mostrar modal para buscar
	$('#btn-staff').on('click', () => {
		modal.modal('hide');

		const data = { name:$('#staff-search').val() };

		const u = objTOurl( data );

		staff_table.ajax.url(`${apiObj.host}/api/staff?${u}`).load();

		modal_staff.modal('show');
	});

	//Seleccionar uno
	$('#table-staff').on('click', '.btn', function(){
		const idstaff = $(this).attr('idstaff')
		const name = $(this).attr('name');

		$('#staff').val( name );
		$('#staff').attr('idstaff', idstaff);

		modal_staff.modal('hide');
		modal.modal('show');
	});

	//Cerar modal
	$('#btn-staff-close').on('click', ()=>{
		modal_staff.modal('hide');
		modal.modal('show');
	});

	//Buscar con Enter
	$('#staff-search').on('keypress', (e)=>{
		if( e.which===13 )
			$('#btn-search-staff').click();
	});

	//Buscar con click
	$('#btn-search-staff').on('click', () => {
		const data = { name:$('#staff-search').val() };

		const u = objTOurl( data );

		staff_table.ajax.url(`${apiObj.host}/api/staff?${u}`).load();
	});

	//Borrar datos de tarjeta
	$('#btn-erase-staff').on('click', ()=>{
		$('#staff').val('');
		$('#staff').attr('idstaff', '');

		/*$('#region').val('');
		$('#subregion').val('');*/
	});
//#####################################################################

//MODAL DE Vehiculos
//#####################################################################
	//Mostrar modal para ver vehiculo
	$('#btn-vehicle').on('click', () => {
		const refuel_type = parseInt( $('#refuel_type').val() );
		const refuel_subtype = parseInt($('#refuel_subtype').val());

		$('#btn-select-vehicle').addClass('d-none');

		refuel_subtypes.forEach( ( v, i ) => {
			if( refuel_subtype === v.idrefuel_type && !v.hasPlanning ){

				$('#btn-select-vehicle').removeClass('d-none');

				/*if( !v.hasVehicle )
					$('#btn-select-vehicle').addClass('d-none');*/
			}
		});

		

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
			const idrefuel_type = $('#refuel_type').val();
			const idrefuel_subtype = $('#refuel_subtype').val();

			const data = { idrefuel_type, idrefuel_subtype };

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

				const ajax = {
					url: `${ apiObj.host }/api/fm/vehiclehistory/${ economic_number }`,
					type : "GET",
					dataSrc: "result",
					data,
					beforeSend: ( req ) => {
						req.setRequestHeader('x-token', localStorage.getItem('x-token') );				
					},  
					error: function( errors ){
						handleErrors( errors );
					}
				}

				dataTable( opts_v, ajax, columns_v );

				//vehicle_table.ajax.url(`${ apiObj.host }/api/fm/vehiclehistory/${ economic_number }`).load();

			}, errors => {
				handleErrors( errors );
			});
		}
		else{
			toastr.warning('Numero de vehiculo requerido');
		}
	});

	//Seleccionar vehiculo sin planeacion
	$('#btn-select-vehicle').on('click', () => {
		const idvehicle = $('#vehicle-number').attr('idvehicle');
		const economic_number = $('#vehicle-number').val();

		$('#vehicle').val( economic_number );
		$('#vehicle').attr('idvehicle', idvehicle);
		$('#vehicle').attr('economic_number', economic_number);

		modal_vehicles.modal('hide');
		modal.modal('show');

		fillRefuelRegions();
	});

	//Seleccionar un vehiculo
	$('#table-vehicle').on('click', '.btn', function(){
		const idvehicle = $('#vehicle-number').attr('idvehicle');
		const economic_number = $(this).attr('economic_number');
		const fm_planning = $(this).attr('fm_planning');
		const fm_contract = $(this).attr('fm_contract');

		const location_start = $(this).attr('location_start');
		const idlocation_start = $(this).attr('idlocation_start');

		const location_end = $(this).attr('location_end');
		const idlocation_end = $(this).attr('idlocation_end');

		const planning_type = $(this).attr('planning_type');
		const idplanning_type = $(this).attr('idplanning_type');

		const odometer = $(this).attr('odometer');

		$('#vehicle').val( economic_number );
		$('#vehicle').attr('idvehicle', idvehicle);
		$('#vehicle').attr('economic_number', economic_number);

		$('#planning_type').val( planning_type );
		$('#planning_type').attr('idplanning_type', idplanning_type);

		$('#fm_planning').val( fm_planning );
		$('#fm_contract').val( fm_contract );

		$('#location_start').val( location_start );
		$('#location_start').attr('idlocation_start', idlocation_start);

		$('#location_end').val( location_end );
		$('#location_end').attr('idlocation_end', idlocation_end);

		$('#odometer').val( odometer );

		$('#region, #subregion').html('<option value=""></option>');
		fillRefuelRegions();

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

		$('#staff').val('');
		$('#staff').attr('idstaff', '');

		$('#planning_type').attr('idplanning_type', '');

		$('#hi_idrefuel').val('');

		$('#vehicle').val('');
		$('#vehicle').attr('idvehicle', '');
		$('#vehicle').attr('economic_number', '');

		$('#location').attr('idlocation', '');
		$('#location_cost').attr('idlocation', '');
		$('#location_start').attr('idlocation_start', '');
		$('#location_end').attr('idlocation_end', '');
	
		$('#comments').val('');

		$('#refuel_attached').addClass('d-none');
		$('#btn-view-img').attr('img', '');

		$('#btn-view-img').prop('disabled', false);

		$('#lb_img').html('Seleccione un archivo');
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
				$('#refuel_subtype').append(`<option value='${ e.idrefuel_type }'>${ e.name } ${ e.maxLiters ? `(Max ${e.maxLiters} lts.)`: '' }</option>`);
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

		$('#planning_type').val( '' );
		$('#planning_type').attr('idplanning_type', '');

		$('#location_start').val('');
		$('#location_start').attr('idlocation_start', '');

		$('#location_end').val('');
		$('#location_end').attr('idlocation_end', '');
	}

	const fillRefuelRegions = ( idregion, idsubregion ) => {
		$('#region, #subregion').html('<option value=""></option>');

		const region_start = $('#region_start').val();
		const idregion_start = parseInt( $('#region_start').attr('idregion_start') );
		const subregion_start = $('#subregion_start').val();
		const idsubregion_start = parseInt( $('#subregion_start').attr('idsubregion_start') );

		const region_end = $('#region_end').val();
		const idregion_end = parseInt( $('#region_end').attr('idregion_end') );
		const subregion_end = $('#subregion_end').val();
		const idsubregion_end = parseInt( $('#subregion_end').attr('idsubregion_end') );

		let region_start_is = false;
		let region_end_is = false;
		let subregion_start_is = false;
		let subregion_end_is = false;

		regions.forEach( (e, i, a) => {
			$('#region').append(`<option ${ idregion===e.idregion?'selected':'' } value='${ e.idregion }'>${ e.name }</option`);

			if( region_start!=='' ){
				if( e.idregion===idregion_start )
					region_start_is=true;

				if( e.idregion===idregion_end )
					region_end_is=true;
			}
			
		});

		if( !region_start_is && region_start!=='' )
			$('#region').append(`<option ${ idregion===idregion_start?'selected':'' } value='${ idregion_start }'>${ region_start }</option>`);

		if( !region_end_is && region_start!=='' )
			$('#region').append(`<option ${ idregion===idregion_end?'selected':'' } value='${ idregion_end }'>${ region_end }</option>`);

		if( idsubregion ){
			const region_end = $('#region_end').val();
			const idregion_end = parseInt( $('#region_end').attr('idregion_end') );
			const subregion_end = $('#subregion_end').val();
			const idsubregion_end = parseInt( $('#subregion_end').attr('idsubregion_end') );

			subregions.forEach( (e, i, a) => {
				if( idregion===e.idparent ){
					$('#subregion').append(`<option ${ idsubregion===e.idregion ? 'selected' : '' } value='${ e.idregion }'>${ e.name }</option`);

					if( e.idregion===idsubregion_start )
						subregion_start_is=true;

					if( e.idregion===idsubregion_end )
						subregion_end_is=true;
				}
			});

			if( !subregion_start_is && region_start!=='' )
				$('#region').append(`<option ${ idsubregion===idsubregion_start ? 'selected' : '' } value='${ idsubregion_start }'>${ subregion_start }</option>`);

			if( !subregion_end_is && region_start!=='' )
				$('#region').append(`<option ${ idsubregion===idsubregion_end ? 'selected' : '' } value='${ idsubregion_end }'>${ subregion_end }</option>`);
		}
	}
});