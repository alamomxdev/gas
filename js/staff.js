$(document).ready( ()=>{
	const url=`${apiObj.host}/api/staff/`;

	let regions = [];
	let subregions = [];
	let staff_types = [];

	const headers_gen = {
	    'x-token' : localStorage.getItem('x-token')
	}

	//Oteber regiones y subregiones
  	const request_regions = ajaxRequest( ajaxSettingGen(`${apiObj.host}/api/regions`, 'GET', headers_gen) );
  	request_regions.then( response => {
  		regions = response.regions;
  		subregions = response.subregions;

  		$('#region').append('<option value=""></option>');

  		regions.forEach( e => {
  			$('#region').append(`<option value='${ e.idregion }'>${ e.name }</option`);
  		});
  	}, errors => {
  		handleErrors( errors );
  	});

  	//Tipos de puest
  	const request_types = ajaxRequest( ajaxSettingGen(`${apiObj.host}/api/stafftypes`, 'GET', headers_gen) );
  	request_types.then( response => {
  		staff_types = response.stafftypes;

  		$('#staff_type').html('<option value=""></option>')

  		staff_types.forEach( ( type, index ) => {
  			$('#staff_type').append(`<option value="${ type.idstaff_type }">${ type.name }</option>`);
  		});
  	}, errors => {
  		handleErrors( errors );
  	})

	//TABLA
	const opts = {
	    lengths : [ 20, 30, 50, 75, 100 ],
	    language: genObj.language,
	    buttons : genObj.buttons,
	    limit : 20,
	    id    : 'table-staff'
	  };

	const columns = [
            { data: 'idstaff' },
            { data: 'name' },
            { data: 'staff_type' },
            { data: 'subregion' },
            { data: 'status', render: ( data, type, row, meta ) => { return ( data )?'<span class="badge bg-success"> Activo </span>':'<span class="badge bg-danger"> Inactivo </span>';  } },
            { data: 'status', render: ( data, type, row ) => { return '<button class="btn btn-primary btn-sm" uid="'+row.idstaff+'"> <i class="fa-solid fa-pencil"></i> </button>'; } },
          ];

    const ajax = {
	    url: `${url}`,
	    type : "GET",
	    dataSrc: "staff",
	    beforeSend: ( req ) => {
	      req.setRequestHeader('x-token', localStorage.getItem('x-token') );
	      /*req.setRequestHeader('search', $('#input-search').val() );

	      if( $('#filter_supplier').val()!==null )
	        req.setRequestHeader('supplier', $('#filter_supplier').val() );*/
	    },      
	    error: function( errors ){
	      handleErrors( errors );
	    }
	}

	const table = dataTable( opts, ajax, columns );

	//MODAL
	const modal = $('#modal-staff');
	modal.modal({backdrop: 'static', keyboard: false, show:true });

	//Buscar CARD
	$('#btn-search').on('click', () => { 
		const data = {
			name  : $('#input-search').val()
		}

	    const u = new URLSearchParams( data ).toString();

	    table.ajax.url(`${url}?${u}`).load();
	});

	//Buscar con ENTER
	$("#input-search").on('keypress', (e)=>{
	    if( e.which===13 )
	      $('#btn-search').click();
	});

	//NUEVO
	$('#btn-add').on('click', () => {
		const form = document.forms['form-staff'];
    	form.reset();

    	$('#hi_idstaff').val('');
    	$('#sp-uid').html('');

    	$("#subregion").html('<option value=""></<option>');

    	modal.modal('show');
	});

	//GUARDAR
	$('#btn-save-staff').on('click', () => {
		const uid = $('#hi_idstaff').val();

		const form = {
			name 		: { value : $('#name').val(), required : true },
			status 		: { value : ($('#status').is(':checked'))?true:false },
			idregion 	: { value : parseInt( $('#region').val() ) },
			idsubregion : { value : parseInt($('#subregion').val()) },
			idstaff_type: { value : parseInt( $('#staff_type').val() ), required : true }
		};

		const { pass, pass_data } = formInputsValidate(form);

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

	//CONSULTAR
	$('#table-staff').on('click', 'button', function(){
		const idstaff = $(this).attr('uid');

		const form = document.forms['form-staff'];
    	form.reset();
    	$('#hi_idstaff').val('');

    	$("#subregion").html('<option value=""></<option>');

    	const settings = ajaxSettingGen( `${url}/${idstaff}`, 'GET', headers_gen, null );
    	const request = ajaxRequest( settings );

    	request.then( response => {
    		const { staff } = response;

    		$('#sp-uid').html( staff.idstaff );
      		$('#hi_idstaff').val( staff.idstaff );
      		$('#idstaff').val( staff.idstaff );
      		$('#status').prop('checked', (staff.status)?true:false );

      		$('#name').val( staff.name );
      		$('#staff_type').val( staff.idstaff_type );
      		$('#region').val( staff.idregion );

    		if( staff.idsubregion || staff.idregion ){
		        $.each( subregions, (i, v) => {
		          if( v.idparent===staff.idregion )
		            $('#subregion').append(`<option ${ ( v.idregion===staff.idsubregion )?'selected':'' } value='${ v.idregion }'>${ v.name }</option>`);
		        });
      		}

      modal.modal('show');
    	}, errors => {
    		handleErrors( errors );
    	})
	});

	//CERRARMODAL
	$('#btn-modal-close').on('click', ()=>{
		modal.modal('hide');
	});

	//llenar plazas
	$('#region').on('change',  function(){
		const idregion = parseInt( $(this).val() );

		$('#subregion').html('<option value=""></option>');

		console.log( idregion, subregions );

		subregions.forEach( ( subregion, index ) => {

			if( subregion.idparent ===  idregion )
				$('#subregion').append(`<option value="${ subregion.idregion }">${ subregion.name }</option>`);
		});
	});
});