$(document).ready( ()=>{
  const suppliers = [];
  let regions = [];
  let subregions = [];

  const url=`${apiObj.host}/api/cards/`;

  const headers_gen = {
    'x-token' : localStorage.getItem('x-token'),
    'search' : ''
  }
  const settings_suppliers = ajaxSettingGen( `${apiObj.host}/api/suppliers?active=1`, 'GET', headers_gen );
  const request_suppliers = ajaxRequest( settings_suppliers );
  //Obteener proveedores
  request_suppliers.then( response => {
    $('#filter_supplier').html('<option value="">Proveedor...</option>');

    $.each( response.suppliers, (i, e) => {
      $('#filter_supplier').append(`<option value='${e.idsupplier}'>${e.name}</option>`);

      suppliers.push({ idsupplier:e.idsupplier, name:e.name });
    });
  }, errors =>{
    handleErrors( errors );
  });

  //Obteber regiones y subregiones
  const request_regions = ajaxRequest( ajaxSettingGen(`${apiObj.host}/api/regions`, 'GET', headers_gen) );
  request_regions.then( response => {
    regions = response.regions;
    subregions = response.subregions;
  }, errors =>{
    handleErrors( errors );
  });

  //TABLA
  const opts = {
    lengths : [ 20, 30, 50, 75, 100 ],
    language: genObj.language,
    buttons : genObj.buttons,
    limit : 20,
    id    : 'table-cards'
  };
  const columns = [
            { data: 'number' },
            { data: 'supplier' },
            { data: 'region' },
            { data: 'subregion' },
            { data: 'economic_number' },
            { data: 'status', render: ( data, type, row, meta ) => { return ( data )?'<span class="badge bg-success"> Activo </span>':'<span class="badge bg-danger"> Inactivo </span>';  } },
            { data: 'status', render: ( data, type, row ) => { return '<button class="btn btn-primary btn-sm" uid="'+row.idcard+'"> <i class="fa-solid fa-pencil"></i> </button>'; } },
          ];
  const ajax = {
    url: `${url}`,
    type : "GET",
    dataSrc: "cards",
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
  //TABLAS

  const modal = $('#modal-card');
  modal.modal({backdrop: 'static', keyboard: false, show:true });

  const modal_v = $('#modal-vehicles');
  modal_v.modal({backdrop: 'static', keyboard: false, show:true });

  const fillSelects = () => {
    $.each( suppliers, ( i, v ) => {
      $("#supplier").append(`<option value='${ v.idsupplier }'>${ v.name }</option>`);
    });

    $.each( regions, (i, v) => {
      $('#region').append(`<option value='${ v.idregion }'>${ v.name }</option>`);
    });
  }

  //Buscar CARD
  $('#btn-search').on('click', () => { 
    const data = {
        supplier: ($('#filter_supplier').val())?parseInt( $('#filter_supplier').val() ):'',
        search  : $('#input-search').val()
    }

    const u = new URLSearchParams( data ).toString();

    table.ajax.url(`${url}?${u}`).load();
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

  //Cerrar modal de vehiculos
  $('#btn-modalv-close').on('click', () => {
    modal_v.modal('hide');
  });

  //Nuevo registro
  $('#btn-add').on('click', ()=>{
    const form = document.forms['form-card'];
    form.reset();

    $('#hi_idcard').val('');
    $('#vehicle').attr('economic_number', '');
    $('#vehicle').attr('idvehicle', '');

    $("#supplier, #region, #subregion").html('<option value=""></<option>');

    fillSelects();

    modal.modal('show');
  });

  //Mostrar plazas de la regions
  $('#region').on('change', function(){
    $('#subregion').html('<option value=""></<option>');

    const idregion = $(this).val();

    $.each( subregions, ( i, v ) => {
      if( v.idparent==idregion )
        $('#subregion').append(`<option value='${ v.idregion }'>${ v.name }</option>`);
      
    });
  });

  //MOstar info de tarjeta
  $('#table-cards').on('click', 'button', function(){
    const uid = $(this).attr('uid');

    const form = document.forms['form-card'];
    form.reset();

    $('#vehicle').attr('idvehicle', '');
    $('#vehicle').attr('economic_number', '');

    const headers = {
      'x-token': localStorage.getItem('x-token')
    }
    const settings = ajaxSettingGen( `${url}/${uid}`, 'GET', headers, null );
    const request = ajaxRequest( settings );

    $("#supplier, #region, #subregion").html('<option value=""></<option>');

    fillSelects();

    request.then( res => {
      const card = res.cards[0];

      $('#sp-uid').html( card.number );
      $('#hi_idcard').val( card.idcard );
      $('#number').val( card.number );
      $('#supplier').val( card.idsupplier );
      $('#status').prop('checked', (card.status)?true:false );
      $('#region').val( card.idregion );
      $('#vehicle').val( card.economic_number );
      $('#vehicle').attr( 'idvehicle', card.idvehicle );
      $('#vehicle').attr( 'economic_number', card.economic_number );

      if( card.idsubregion ){
        $.each( subregions, (i, v) => {
          if( v.idparent===card.idregion )
            $('#subregion').append(`<option ${ ( v.idregion===card.idsubregion )?'selected':'' } value='${ v.idregion }'>${ v.name }</option>`);
        });
      }

      modal.modal('show');
    }, errors => {
      handleErrors( errors );
    });
  });

  //Guardar registro
  $('#btn-save-card').on('click', () => {
    const uid = $('#hi_idcard').val();

    const form = {
      number      : { value:$('#number').val(), required:true },
      idsupplier  : { value:$('#supplier').val(), required:true },
      status      : { value: ($('#status').is(':checked'))?true:false, required:false },
      idregion    : { value: parseInt($('#region').val()) },
      idsubregion : { value: parseInt($('#subregion').val()) },
      idvehicle   : { value:($('#vehicle').attr('idvehicle')==='')?null:$('#vehicle').attr('idvehicle'), passEmpety:true }
    }

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

  $('#button-vehicle').on('click', () => {
      $('#table-vehicle td').html('');
      $('#veicle-search').val('');

      modal_v.modal('show');
  });

  $('#button-vehicle-erase').on('click', ()=>{
    $('#vehicle').attr('idvehicle', '');
    $('#vehicle').attr('economic_number', '');

    $('#vehicle').val('');
  })

  $('#btn-seach-vehicle').on('click', () => {
    const economic_number = $('#veicle-search').val();

    $('#table-vehicle td').html('');

    if( economic_number ){
      const request_v = ajaxRequest( ajaxSettingGen(`${apiObj.host}/api/vehicles/search/${economic_number}`, 'GET', headers_gen) );

      request_v.then( response => {
        const vehicle = response.vehicles;

        if(vehicle){
          const button = `<button class='btn btn-sm btn-primary' uid='${ vehicle.idvehicle }' economic_number='${ vehicle.economic_number }'> <i class="fa-solid fa-arrow-pointer"></i> </button>`;

          $('#td_vehicle_economic').html( vehicle.economic_number );
          $('#td_vehicle_type').html( vehicle.reference );
          $('#td_vehicle_model').html( vehicle.model );
          $('#td_vehicle_brand').html( vehicle.brand );
          $('#td_vehicle_year').html( vehicle.year );
          $('#td_vehicle_version').html( vehicle.version );
          $('#td_vehicle_status').html( (vehicle.status)?`<span class='badge bg-success'>1</span>`:`<span class='badge bg-danger'>0</span>` );
          $('#td_vehicle_tools').html( (vehicle.status)?button:'' );
        }
        
      }, errors => {
        handleErrors( errors );
      } )
    }
  });

  $('#table-vehicle').on('click', '.btn-primary', function(){
    const uid = $(this).attr('uid');
    const economic_number = $(this).attr('economic_number');

    $('#vehicle').val( economic_number );

    $('#vehicle').attr('idvehicle', uid);
    $('#vehicle').attr('economic_number', economic_number);

    modal_v.modal('hide');
  })
});