<div id="contenido">
	<h5>Personal</h5>

	<div class="row g-3 align-items-center">
        
	    <div class="col-auto">
	        <label for="input-search" class="col-form-label ">Buscar</label>
	    </div>

	    <div class="col-auto">
	        <input type="text" id="input-search" class="form-control form-control-sm text-uppercase" aria-describedby="">
	    </div>

	    <div class="col-auto">
	        <button class="btn btn-primary btn-sm" id="btn-search">
	            <i class="fa-solid fa-magnifying-glass"></i>
	        </button>

	        <button class="btn btn-success btn-sm" id="btn-add"> 
	          <i class="fa-solid fa-plus"></i> 
	        </button>
	    </div>
  </div>


  <div class="table-responsive">
  		<table class="table table-striped table-sm" id="table-staff">
  			<thead class="small">
		        <tr>
		          <th scope="col">#</th>
		          <th scope="col">Nombre</th>
		          <th scope="col">Puesto</th>
		          <th scope="col">Plaza</th>
		          <th scope="col">Status</th>
		          <th scope="col"> &nbsp; </th>
		        </tr>
	      	</thead>

	      	<tbody class="small"> </tbody>

	      	<tfoot class="small">
		        <tr>
		          <th scope="col">#</th>
		          <th scope="col">Nombre</th>
		          <th scope="col">Puesto</th>
		          <th scope="col">Plaza</th>
		          <th scope="col">Status</th>
		          <th scope="col"> &nbsp; </th>
		        </tr>
		    </tfoot>
  		</table>
  </div>
</div>

<div class="modal" id="modal-staff" tabindex="-1">

	<div class="modal-dialog modal-dialog-centered modal-lg">
		
		<div class="modal-content">
		
			<div class="modal-header">
				<h5 class="modal-title"> Colaborador # <span class="text-muted" id="sp-uid"></span> </h5>
			</div>

			<div class="modal-body">
				<form id="form-staff" autocomplete="off">
					
					<div class="row">
						
						<div class="col-2">
							<label class="form-label" for="idstaff">#</label>
			              	<input class="form-control form-control-sm text-uppercase" disabled type="text" id="idstaff">
			              	<input type="hidden" id="hi_idstaff">
						</div>

						<div class="col-8">
			              <label for="name" class="form-label">Nombre</label>
			              <input class="form-control form-control-sm text-uppercase" type="text" id="name">
			            </div>

			            <div class="col-2 pt-4">
			              <input class="form-check-input" type="checkbox" id="status">
			              <label class="form-check-label" for="status">Activo</label>
			            </div>

					</div>

					<div class="row">
						<div class="col-4">
							<label class="form-label" for="region">Puesto</label>
          					<select id="staff_type" class="form-select form-select-sm"></select>
						</div>

						<div class="col-4">
							<label class="form-label" for="region">Region</label>
          					<select id="region" class="form-select form-select-sm"></select>
						</div>

						<div class="col-4">
							<label class="form-label" for="subregion">Plaza</label>
              				<select id="subregion" class="form-select form-select-sm"></select>
						</div>
					</div>

				</form>
			</div>

			<div class="modal-footer">
				
				<button class="btn btn-secondary btn-sm" id="btn-modal-close">
		          <i class="fa-solid fa-xmark"></i>
		          Cerrar
		        </button>
		        <button class="btn btn-primary btn-sm" id="btn-save-staff">
		          <i class="fa-solid fa-floppy-disk"></i>
		        </button>

			</div>
		</div>

	</div>

</div>