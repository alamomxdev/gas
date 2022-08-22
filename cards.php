<div id="div_contenido">
  <h5>Tarjetas</h5>

  <hr>

  <!-- Filtros -->
  <div class="row g-3 align-items-center">
        
    <div class="col-auto">
        <label for="input-search" class="col-form-label ">Numero</label>
    </div>

    <div class="col-auto">
        <input type="text" id="input-search" size="10" class="form-control form-control-sm text-uppercase" aria-describedby="">
    </div>

    <div class="col-auto">
        <select id="filter_supplier" class="form-select form-select-sm"></select>
    </div>

    <!-- <div class="col-auto">
        <select id="filter_region" class="form-select form-select-sm"></select>
    </div>

    <div class="col-auto">
        <select id="filter_subregion" class="form-select form-select-sm"></select>
    </div> -->

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
    <table class="table table-striped table-sm" id="table-cards">
      <thead class="small">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Proveedor</th>
          <th scope="col">Region</th>
          <th scope="col">Plaza</th>
          <th scope="col">Vehiculo</th>
          <th scope="col">Estatus</th>
          <th scope="col"> &nbsp; </th>
        </tr>
      </thead>

      <tbody class="small"> </tbody>

      <tfoot class="small">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Proveedor</th>
          <th scope="col">Region</th>
          <th scope="col">Plaza</th>
          <th scope="col">Vehiculo</th>
          <th scope="col">Estatus</th>
          <th scope="col"> &nbsp; </th>
        </tr>
      </tfoot>
    </table>
  </div>
  <!-- Contenido -->

</div>

<!-- Div Informacion MODAL -->
<div class="modal" id="modal-card" tabindex="-1">
  
  <div class="modal-dialog modal-dialog-centered modal-lg">
    
    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title"> Tarjeta #<span class="text-muted" id="sp-uid"></span> </h5>
      </div>

      <div class="modal-body">
        
        <form id="form-card" autocomplete="off">
          <div class="row">
            <div class="col-2">
              <label class="form-label" for="iduser">#</label>
              <input class="form-control form-control-sm text-uppercase" type="text" id="number">
              <input type="hidden" id="hi_idcard">
            </div>

            <div class="col-8">
              <label for="supplier" class="form-label">Proveedor</label>
              <select id="supplier" class="form-select form-select-sm"></select>
            </div>

            <div class="col-2 pt-4">
              <input class="form-check-input" type="checkbox" id="status">
              <label class="form-check-label" for="status">Activa</label>
            </div>
          </div>

          <div class="row">
            <div class="col col-6">
              <label class="form-label" for="region">Region</label>
              <select id="region" class="form-select form-select-sm"></select>
            </div>

            <div class="col col-6">
              <label class="form-label" for="subregion">Plaza</label>
              <select id="subregion" class="form-select form-select-sm"></select>
            </div>
          </div>

          <div class="row">
            <div class="col col-4">

              <div class="input-group mt-3">
                  <label class="form-label" for="vehicle">Vehiculo: &nbsp;</label>
                  <input type="text" class="form-control form-control-sm text-uppercase" placeholder="" aria-describedby="button-addon2" id="vehicle" disabled>
                  <button class="btn btn-secondary btn-sm" type="button" id="button-vehicle">
                      <i class="fa-brands fa-searchengin"></i>
                  </button>
                  <button class="btn btn-danger btn-sm" type="button" id="button-vehicle-erase">
                      <i class="fa-solid fa-eraser"></i>
                  </button>
              </div>

            </div>
          </div>

        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" id="btn-modal-close">
          <i class="fa-solid fa-xmark"></i>
          Cerrar
        </button>
        <button class="btn btn-primary btn-sm" id="btn-save-card">
          <i class="fa-solid fa-floppy-disk"></i>
        </button>
      </div>

    </div>
  </div>

</div>
<!-- Div Informacion MODAL -->


<!-- MODAL PARA BUSQUEDA DE CARROS -->
<div class="modal" id="modal-vehicles" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      
        <div class="modal-content">
          
            <div class="modal-header">
              <h5 class="modal-title">Busqueda de vehiculos</h5>
            </div>

            <div class="modal-body">
              <div class="row">
                <div class="col-auto">
                  <label for="veicle-search">Economico</label>
                </div>

                <div class="col-auto">
                  <input type="text" class="form-control form-control-sm text-uppercase" size="10" id="veicle-search">
                </div>

                <div class="col-auto">
                  <button class="btn btn-secondary btn-sm" id='btn-seach-vehicle'> 
                    <i class="fa-solid fa-magnifying-glass"></i>
                  </button>
                </div>
              </div>

              <hr>

              <div class="row" style="min-height: 300px;">
                
                <table class="table" id="table-vehicle">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Tipo</th>
                      <th scope="col">Modelo</th>
                      <th scope="col">Marca</th>
                      <th scope="col">A&ntilde;o</th>
                      <th scope="col">Version</th>
                      <th scope="col">Estatus</th>
                      <th scope="col"> &nbsp; </th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td id="td_vehicle_economic"></td>
                      <td id="td_vehicle_type"></td>
                      <td id="td_vehicle_model"></td>
                      <td id="td_vehicle_brand"></td>
                      <td id="td_vehicle_year"></td>
                      <td id="td_vehicle_version"></td>
                      <td id="td_vehicle_status"></td>
                      <td id="td_vehicle_tools"></td>
                    </tr>
                  </tbody>

                </table>

              </div>
            </div>

            <div class="modal-footer">
              <button class="btn btn-secondary btn-sm" id="btn-modalv-close">
                <i class="fa-solid fa-xmark"></i>
                Cerrar
              </button>
            </div>

        </div>

    </div>
</div>
<!-- MODAL PARA BUSQUEDA DE CARROS -->