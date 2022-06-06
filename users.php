<div id="div_contenido">
  <h5>Usuarios</h5>

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
    <table class="table table-striped table-sm" id="table-user">
      <thead class="small">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Role</th>
          <th scope="col">Email</th>
          <th scope="col">Estado</th>
          <th scope="col"> &nbsp; </th>
        </tr>
      </thead>

      <tbody class="small"> </tbody>

      <tfoot class="small">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Role</th>
          <th scope="col">Email</th>
          <th scope="col">Estado</th>
          <th scope="col"> &nbsp; </th>
        </tr>
      </tfoot>
    </table>
  </div>
  <!-- Contenido -->

</div>


<!-- Div Informacion MODAL -->
<div class="modal" id="modal-user" tabindex="-1">
  
  <div class="modal-dialog modal-dialog-centered modal-lg">
    
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Usuario #<span class="text-muted" id="sp-uid"></span> </h5>
      </div>

      <div class="modal-body">
        
        <form id="form-user">
          <div class="row">
            <div class="col-2">
              <label class="form-label" for="iduser">#</label>
              <input class="form-control form-control-sm" type="number" id="iduser" disabled>
              <input type="hidden" id="hi_iduser">
            </div>

            <div class="col-8">
              <label for="bussines_name" class="form-label">Rol <span class="text-danger">*</span></label>
              <select id="role" class="form-select"></select>
            </div>

            <div class="col-2 pt-4">
              <input class="form-check-input" type="checkbox" id="status">
              <label class="form-check-label" for="status">Activo</label>
            </div>
          </div>

          <div class="row">
            <div class="col col-6">
              <label class="form-label" for="name">Nombre <span class="text-danger">*</span></label>
              <input class="form-control form-control-sm" type="text" id="name">
            </div>

            <div class="col col-6">
              <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
              <input class="form-control form-control-sm" type="text" id="email">
            </div>
          </div>

          <div class="row">
            <div class="col col-6">
              <label class="form-label" for="password">Contraseña <span class="text-danger">*</span></label>
              <input class="form-control form-control-sm" type="password" id="password">
            </div>

            <div class="col col-6">
              <label class="form-label" for="password_confirm">Confirmacion <span class="text-danger">*</span></label>
              <input class="form-control form-control-sm" type="password" id="password_confirm">
            </div>
          </div>

          <hr>

          <div class="row">
            <div class="col col-6">
              <label class="form-label" for="regions">Regiones</label>
              <select class="form-select" multiple id="regions"></select>
            </div>

            <div class="col col-6">
              <label class="form-label" for="child_regions">Plazas</label>
              <select class="form-select" multiple id="child_regions"></select>
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