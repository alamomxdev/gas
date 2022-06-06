<div id="div_contenido">
  <h5>Empresas de carga</h5>

  <hr>

  <!-- Filtros -->
  <div class="row g-3 align-items-center">
        
    <div class="col-auto">
        <label for="input-search" class="col-form-label">Buscar</label>
    </div>

    <div class="col-auto">
        <input type="text" id="input-search" class="form-control form-control-sm" aria-describedby="passwordHelpInline">
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
  <!-- Filtros -->

  <!-- Contenido -->
  <div class="table-responsive">
    <table class="table table-striped table-sm" id="table-supplier">
      <thead class="small">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">RFC</th>
          <th scope="col">Telefono</th>
          <th scope="col">Correo</th>
          <th scope="col">Estado</th>
          <th scope="col"> &nbsp; </th>
        </tr>
      </thead>

      <tbody class="small"> </tbody>

      <tfoot class="small">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">RFC</th>
          <th scope="col">Telefono</th>
          <th scope="col">Correo</th>
          <th scope="col">Estado</th>
          <th scope="col"> &nbsp; </th>
        </tr>
      </tfoot>
    </table>
  </div>
  <!-- Contenido -->

</div>


<!-- Div Informacion MODAL -->
<div class="modal" id="modal-supplier" tabindex="-1">
  
  <div class="modal-dialog modal-dialog-centered modal-lg">
    
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Proveedor #<span class="text-muted" id="sp-uid"></span> </h5>
      </div>

      <div class="modal-body">
        
        <form id="form-supplier">
          <div class="row">
            <div class="col-2">
              <label class="form-label" for="idsupplier">#</label>
              <input class="form-control form-control-sm" type="number" id="idsupplier" disabled>
              <input type="hidden" id="hi_idsupplier">
            </div>

            <div class="col-8">
              <label class="form-label" for="name">Nombre <span class="text-danger">*</span></label>
              <input class="form-control form-control-sm" type="text" id="name">
            </div>

            <div class="col-2">
              <input class="form-check-input" type="checkbox" id="status">
              <label class="form-check-label" for="status">Activo</label>
            </div>
          </div>

          <div class="row">
            <div class="col-8">
              <label for="bussines_name" class="form-label">Razon Social <span class="text-danger">*</span></label>
              <input class="form-control form-control-sm" type="text" id="bussines_name">
            </div>

            <div class="col-4">
              <label class="form-label" for="rfc">RFC</label>
              <input class="form-control form-control-sm" type="text" id="rfc"></input>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <label class="form-label" for="phone1">Telefono #1 <span class="text-danger">*</span></label>
              <input class="form-control form-control-sm" type="tel" id="phone1"></input>
            </div>

            <div class="col-6">
              <label class="form-label" for="email1">Mail #1 <span class="text-danger">*</span></label>
              <input class="form-control form-control-sm" type="email" id="email1"></input>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <label class="form-label" for="phone1">Telefono #2</label>
              <input class="form-control form-control-sm" type="tel" id="phone2"></input>
            </div>

            <div class="col-6">
              <label class="form-label" for="email1">Mail #2</label>
              <input class="form-control form-control-sm" type="email" id="email2"></input>
            </div>
          </div>
        </form>

      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" id="btn-modal-close">
          <i class="fa-solid fa-xmark"></i>
          Cerrar
        </button>
        <button class="btn btn-primary btn-sm" id="btn-save-supplier">
          <i class="fa-solid fa-floppy-disk"></i>
        </button>
      </div>

    </div>
  </div>

</div>
<!-- Div Informacion MODAL -->
