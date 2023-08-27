$(document).ready( () => {
	const url=`${apiObj.host}/api/sysconfig/`;

	const headers_gen = {
	    'x-token' : localStorage.getItem('x-token')
	}

	const request_sysconfig = ajaxRequest( ajaxSettingGen(url, 'GET', headers_gen) );
	request_sysconfig.then( response => {
		const { sysConfig } = response;

		$('#input-fuel-exceed-limit').val(sysConfig.fuel_limit_exceed_percentage);
		$('#input-fuel-amount-limit').val(sysConfig.refuel_amount_limit);
		$('#input-refuel-elapsed-time-limit').val(sysConfig.elapsed_time_limit);
	});

	$('#input-refuel-elapsed-time-limit, #input-fuel-amount-limit, #input-fuel-exceed-limit').on('keypress', function(e){
		if( e.which==13 ){
			$('#btn_guardar').click();
		}
	});

	$('#btn_guardar').click(() => {
		const form = {
			fuel_limit_exceed_percentage : {value : $('#input-fuel-exceed-limit').val(), required : true},
			refuel_amount_limit : {value : $('#input-fuel-amount-limit').val(), required : true},
			elapsed_time_limit : {value : $('#input-refuel-elapsed-time-limit').val(), required : true}
		}

		const { pass, pass_data } = formInputsValidate(form);

		if(pass){
			const entries = new Map( pass_data );
			const data  = Object.fromEntries(entries);

			const headers = {
				'x-token'   : localStorage.getItem('x-token'),
				'Content-Type'  : 'application/json'
			}

			const settings = ajaxSettingGen( `${url}`, 'PUT', headers, data );
			const request = ajaxRequest( settings );

			request.then(response => {
				console.log(response);
				const msg = 'Configuraciones guardadas con exito';

				toastr.success( msg );
			}, errors => {
				handleErrors( errors );
			});
		}
	});
});