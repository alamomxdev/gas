<div id="contenido">
	<h5>Configuraciones del sistema</h5>

	<hr>

	<div class="row g-3 align-items-center">
		<div class="col-auto">
			<label class="col-form-label" for="input-fuel-exceed-limit" style="margin-left: 57px;">Procentaje de excedente de combustible</label>
		</div>

		<div class="col-auto">
			<input type="number" id="input-fuel-exceed-limit" class="form-control form-control-sm" style="width: 100px;" min="0" aria-describedby="">
		</div>

		<div class="col-auto">
			<label class="col-form-label">%</label>
			<span class="small text-danger">*</span>
		</div>
	</div>

	<div class="row g-3 align-items-center">
		<div class="col-auto">
			<label class="col-form-label" for="input-fuel-amount-limit" style="margin-left: 138px;">Limite de monto de recarga</label>
		</div>

		<div class="col-auto">
			<input type="number" id="input-fuel-amount-limit" class="form-control form-control-sm" style="width: 100px;" min="0" aria-describedby="">
		</div>

		<div class="col-auto">
			<label class="col-form-label">$</label>
			<span class="small text-danger">*</span>
		</div>
	</div>

	<div class="row g-3 align-items-center">
		<div class="col-auto">
			<label class="col-form-label" for="input-refuel-elapsed-time-limit" style="margin-left: 0px;">Limite de tiempo excedido para captura de cargas</label>
		</div>

		<div class="col-auto">
			<input type="number" id="input-refuel-elapsed-time-limit" class="form-control form-control-sm" style="width: 100px;" min="0" aria-describedby="">
		</div>

		<div class="col-auto">
			<label class="col-form-label">hrs.</label>
			<span class="small text-danger">*</span>
		</div>
	</div>

	<div class="row g-3">
		<div class="col mt-4" style="padding-left: 480px;">
			<button class="btn btn-sm btn-primary f-left" id="btn_guardar">
				<i class="fa-solid fa-floppy-disk"></i>
				Guardar
			</button>
		</div>
	</div>
</div>