<div id="div_contenido">
    <h5>Historico de cargas</h5>

    <hr>

    <!-- Filtros -->
    <div class="row g-3 align-items-center">

        <div class="col-auto">
            <label for="input-search" class="col-form-label "># Folio/Ticket</label>
        </div>

        <div class="col-auto">
            <input type="text" id="input-search" size="5" class="form-control form-control-sm text-uppercase" aria-describedby="">
        </div>

        <div class="col-auto">
            <select id="filter_supplier" class="form-select form-select-sm" style="min-width: 100px; max-width: 100px;">
                <option value=""></option>
            </select>
        </div>

        <div class="col-auto">
            <label for="filter-f1" class="col-form-label">F. Inicial</label>
        </div>
        <div class="col-auto">
            <input type="date" id="filter-f1" class="form-control form-control-sm" style="min-width: 100px; max-width: 100px;">
        </div>

        <div class="col-auto">
            <label for="filter-f2" class="col-form-label">F. Fin</label>
        </div>
        <div class="col-auto">
            <input type="date" id="filter-f2" class="form-control form-control-sm" style="min-width: 100px; max-width: 100px;">
        </div>

    </div>
    <!-- Filtros -->

    <div class="row justify-content-end">
        <div class="col-auto">
            <button class="btn btn-primary btn-sm m-1" id="btn-search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

            <button class="btn btn-info btn-sm m-1" id="btn-filters">
                <i class="fa-solid fa-filter"></i>
                <span class="badge text-bg-dark" id="badge-filters">0</span>
            </button>

            <button class="btn btn-success btn-sm m-1" id="btn-excel">
                <i class="fa-solid fa-file-excel"></i>
            </button>

            <button class="btn btn-success btn-sm m-1" id="btn-layout-atica">
                <i class="fa-solid fa-a"></i>
                <i class="fa-solid fa-table"></i>
            </button>

            <button class="btn btn-success btn-sm m-1" id="btn-add"> 
                <i class="fa-solid fa-plus"></i> 
            </button>
        </div>
    </div>

    <!-- Contenido -->
    <div class="table-responsive">
        <table class="table table-striped table-sm" id="table-refuels">
            <thead class="small">
                <tr>
                    <th scope="col"># Tarjeta</th>
                    <th scope="col"># Ticket</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Vehiculo</th>
                    <th scope="col">Pleacion/Contrato</th>
                    <th scope="col">Plaza</th>
                    <th scope="col">F. Carga</th>
                    <th scope="col">F. Registro</th>
                    <th scope="col">Total</th>
                    <th scope="col">Litros</th>
                    <th scope="col"> &nbsp; </th>
                </tr>
            </thead>

            <tbody class="small"> </tbody>

            <tfoot class="small">
                <tr>
                    <th scope="col"># Tarjeta</th>
                    <th scope="col"># Carga</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Vehiculo</th>
                    <th scope="col">Pleacion/Contrato</th>
                    <th scope="col">Plaza</th>
                    <th scope="col">F. Carga</th>
                    <th scope="col">F. Registro</th>
                    <th scope="col">Total</th>
                    <th scope="col">Litros</th>
                    <th scope="col"> &nbsp; </th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- Contenido -->

</div>

<!-- Div Informacion REFUEL MODAL -->
<div class="modal" id="modal-refuel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Recarga #<span class="text-muted" id="sp-uid"></span> </h5>
            </div>

            <div class="modal-body">
                <form id="form-refuel" autocomplete="off">
                    <div class="row">
                        <div class="col col-4">
                            <label class="form-label">Proveedor <span class="small text-danger">*</span></label>
                            <select id="supplier" class="form-select form-select-sm text-uppercase"></select>
                        </div>

                        <div class="col col-4">
                            <label class="form-label" for="card"># Tarjeta <span class="small text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="card" disabled>
                                <button class="btn btn-sm btn-secondary" id="btn-card">
                                    <i class="fa-solid fa-filter"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" id="btn-erase-card">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col col-4">
                            <label class="form-label" for="card1"># Folio/Ticket <span class="small text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm text-uppercase" id="refuel">
                            <input type="hidden" id="hi_idrefuel">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-4">
                            <label class="form-label" for="refuel_type">Tipo de carga <span class="small text-danger">*</span></label>
                            <select class="form-select form-select-sm" id="refuel_type"></select>
                        </div>

                        <div class="col col-4">
                            <label class="form-label" for="refuel_type">Sub categoria <span class="small text-danger">*</span></label>
                            <select class="form-select form-select-sm" id="refuel_subtype"></select>
                        </div>

                        <div class="col col-4">
                            <label class="form-label" for="vehicle">Vehiculo <span class="small text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="vehicle" disabled>
                                <button class="btn btn-sm btn-secondary" id="btn-vehicle">
                                    <i class="fa-solid fa-filter"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" id="btn-erase-vehicle">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col col-6">
                            <label class="form-label" for="location">Oficina de carga <span class="small text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="location" disabled>
                                <button class="btn btn-sm btn-secondary" id="btn-location">
                                    <i class="fa-solid fa-filter"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" id="btn-erase-location">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col col-6">
                            <label class="form-label" for="location_cost">Oficina de <b>costo</b> <span class="small text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="location_cost" disabled>
                                <button class="btn btn-sm btn-secondary" id="btn-location_cost">
                                    <i class="fa-solid fa-filter"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" id="btn-erase-location_cost">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col col-6">
                            <label class="form-label" for="location_start">Oficina de salid</label>
                            <input type="text" class="form-control form-control-sm text-uppercase" id="location_start" disabled>
                        </div>

                        <div class="col col-6">
                            <label class="form-label" for="location_end">Oficina de retorno</label>
                            <input type="text" class="form-control form-control-sm text-uppercase" id="location_end" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-3">
                            <label class="form-label" for="fm_planning">Planeacion</label>
                            <input type="text" class="form-control form-control-sm text-uppercase" id="fm_planning" disabled>
                        </div>

                        <div class="col col-3">
                            <label class="form-label" for="fm_contract">Contrato</label>
                            <input type="text" class="form-control form-control-sm text-uppercase" id="fm_contract" disabled>
                        </div>

                        <div class="col col-3">
                            <label class="form-label" for="planning_type">Tipo de planeacion</label>
                            <input type="text" class="form-control form-control-sm text-uppercase" id="planning_type" disabled>
                        </div>

                        <div class="col col-3">
                            <label class="form-label" for="odometer">Kilometraje</label>
                            <input type="number" class="form-control form-control-sm" id="odometer">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-3">
                            <label class="form-label">Fecha de carga <span class="small text-danger">*</span></label>
                            <input type="date" class="form-control form-control-sm text-uppercase" id="refuel_date">
                        </div>

                        <div class="col col-3">
                            <label class="form-label">Hora de carga <span class="small text-danger">*</span></label>
                            <input type="time" class="form-control form-control-sm text-uppercase" id="refuel_time">
                        </div>

                        <div class="col-2">
                            <label class="form-label">Combustible <span class="small text-danger">*</span></label>
                            <select class="form-select form-select-sm" id="fuel_type"></select>
                        </div>

                        <div class="col-4">
                            <label class="form-label" for="card">Colaborador que cargo <span class="small text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="staff" disabled>
                                <button class="btn btn-sm btn-secondary" id="btn-staff">
                                    <i class="fa-solid fa-filter"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" id="btn-erase-staff">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-4">
                            <label class="form-label" for="card">Tipo de uso</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="costs" disabled>
                                <button class="btn btn-sm btn-secondary" id="btn-costs">
                                    <i class="fa-solid fa-filter"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" id="btn-erase-costs">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="col col-2">
                            <label class="form-label">Monto <span class="small text-danger">*</span></label>
                            <input type="number" class="form-control form-control-sm text-uppercase" id="amount">
                        </div>

                        <div class="col col-2">
                            <label class="form-label">Impuestos <span class="small text-danger">*</span></label>
                            <input type="number" class="form-control form-control-sm text-uppercase" id="taxes">
                        </div>

                        <div class="col col-2">
                            <label class="form-label"><b>Total</b></label>
                            <input type="number" class="form-control form-control-sm text-uppercase" id="total" disabled>
                        </div>

                        <div class="col col-2">
                            <label class="form-label">Litros <span class="small text-danger">*</span></label>
                            <input type="number" class="form-control form-control-s text-uppercase" id="liters">
                        </div>

                        <div class="col col-2">
                            <label class="form-label">$/L</label>
                            <input type="text" class="form-control form-control-sm text-uppercase" id="amount_per_liter" disabled>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col">
                            <div class="form-floating">
                                <textarea class="form-control form-control-sm text-uppercase" placeholder="Comentarios" id="comments"></textarea>
                                <label for="comments">Comentarios</label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row d-none" id="refuel_attached">
                        <div class="col col-12">

                            <div class="input-group d-flex justify-content-end">
                                <label class="input-group-text border border-secondary" style="width: 90%;" for="img" id="lb_img">Seleccione un archivo</label>
                                <input type="file" class="form-control form-control-sm d-none" id="img" accept="image/*,.pdf">

                                <button class="btn btn-sm btn-primary" id="btn-upload-img">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                </button>
                                <button class="btn btn-sm btn-success" id="btn-view-img">
                                    <i class="fa-solid fa-image"></i>
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

                <button class="btn btn-primary btn-sm" id="btn-save-refuel">
                    <i class="fa-solid fa-floppy-disk"></i>
                </button>
            </div>
        </div>

    </div>
</div>
<!-- Div Informacion MODAL -->

<!-- Modal para busqueda de tarjetas -->
<div class="modal" id="modal-cards">
    <div class="modal-dialog modal-dialog-centered modal-md">
        
        <div class="modal-content" style="max-height: 500px; min-height: 500px;">
            <div class="modal-header">
                <span class="fs-6">Busqueda de tarjetas</span>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-auto">
                        <label for="card-search"># Tarjeta</label>
                    </div>

                    <div class="col-auto">
                        <input type="text" class="form-control form-control-sm text-uppercase" id="card-search">
                    </div>

                    <div class="col-auto">
                        <button class="btn btn-sm btn-primary" id="btn-search-card">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="table-cards">
                        <thead class="small">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Proveedor</th>
                                <th scope="col">Region</th>
                                <th scope="col">Plaza</th>
                                <th scope="col">Vehiculo</th>
                                <th scope="col"> &nbsp; </th>
                            </tr>
                        </thead>

                        <tbody class="small"> </tbody>

                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" id="btn-card-close">
                    <i class="fa-solid fa-xmark"></i>
                    Cerrar
                </button>
            </div>
        </div>

    </div>
</div>
<!-- Modal para busqueda de tarjetas -->

<!-- Modal Vehiculos -->
<div class="modal" id="modal-vehicles">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        
        <div class="modal-content" style="max-height: 800px; min-height: 800px;">
            
            <div class="modal-header">
                <span class="fs-6">Busqueda de vehiculos</span>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-2">
                        <label for="">Tipo de carga</label>
                    </div>

                    <div class="col-3">
                        <select class="form-select form-select-sm" id="refuel_type_2"></select>
                    </div>

                    <div class="col-2">
                        <label for="">Sub categoria</label>
                    </div>

                    <div class="col-3">
                        <select class="form-select form-select-sm" id="refuel_subtype_2"></select>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-auto">
                        <label for="vehicle-search"># Vehiculo</label>
                    </div>

                    <div class="col-auto">
                        <input type="text" class="form-control form-control-sm text-uppercase" id="vehicle-search">
                    </div>

                    <div class="col-auto">
                        <button class="btn btn-sm btn-primary" id="btn-search-vehicle">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>

                        <button class="btn btn-sm btn-primary" id="btn-select-vehicle">
                            <i class="fa-solid fa-arrow-pointer"></i>
                            Seleccionar
                        </button>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col col-3">
                        <label class="form-label" for="vehicle-number">Economico</label>
                        <input class="form-control form-control-sm" type="text" id="vehicle-number" disabled>
                    </div>

                    <div class="col col-3">
                        <label class="form-label" for="vehicle-type">Tipo</label>
                        <input class="form-control form-control-sm" type="text" id="vehicle-type" disabled>
                    </div>

                    <div class="col col-3">
                        <label class="form-label" for="vehicle-model">Modelo</label>
                        <input class="form-control form-control-sm" type="text" id="vehicle-model" disabled>
                    </div>

                    <div class="col col-3">
                        <label class="form-label" for="vehicle-brand">Marca</label>
                        <input class="form-control form-control-sm" type="text" id="vehicle-brand" disabled>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-3">
                        <label class="form-label" for="vehicle-license_plate">Placas</label>
                        <input class="form-control form-control-sm" type="text" id="vehicle-license_plate" disabled>
                    </div>

                    <div class="col col-3">
                        <label class="form-label" for="vehicle-year">A&ntilde;o</label>
                        <input class="form-control form-control-sm" type="text" id="vehicle-year" disabled>
                    </div>

                    <div class="col col-3">
                        <label class="form-label" for="vehicle-version">Version</label>
                        <input class="form-control form-control-sm" type="text" id="vehicle-version" disabled>
                    </div>

                    <div class="col col-3">
                        <label class="form-label" for="vehicle-chassis_number"># Serie</label>
                        <input class="form-control form-control-sm" type="text" id="vehicle-chassis_number" disabled>
                    </div>
                </div>

                <hr>

                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="table-vehicle">
                        <thead class="small">
                            <tr>
                                <th scope="col">Planeacion</th>
                                <th scope="col">Contrato</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Salida</th>
                                <th scope="col">Retorno</th>
                                <th scope="col">Inicio real</th>
                                <th scope="col">Fin real</th>
                                <th scope="col"><i class="fa-solid fa-right-left"></i><i class="fa-solid fa-car-side"></i></th>
                                <th scope="col"><i class="fa-solid fa-dollar-sign"></i><i class="fa-solid fa-gas-pump"></i></th>
                                <th scope="col"><i class="fa-solid fa-battery-empty"></i><i class="fa-solid fa-gas-pump"></i></th>
                                <th scope="col">ERA</th>
                                <th scope="col">Drop</th>
                                <th scope="col">Env</th>
                                <th scope="col">Rec</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody class="small"> </tbody>

                    </table>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" id="btn-vehicle-close">
                    <i class="fa-solid fa-xmark"></i>
                    Cerrar
                </button>
            </div>

        </div>

    </div>
</div>
<!-- Modal Vehiculos -->

<!-- Modal para busqueda de tarjetas -->
<div class="modal" id="modal-locations">
    <div class="modal-dialog modal-dialog-centered modal-md">

        <input type="hidden" id="location_type">
        
        <div class="modal-content" style="max-height: 500px; min-height: 500px;">
            <div class="modal-header">
                <span class="fs-6">Busqueda de oficinas</span>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-auto">
                        <label for="location-search">Oficina</label>
                    </div>

                    <div class="col-auto">
                        <input type="text" class="form-control form-control-sm text-uppercase" id="location-search">
                    </div>

                    <div class="col-auto">
                        <button class="btn btn-sm btn-primary" id="btn-search-location">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="table-locations">
                        <thead class="small">
                            <tr>
                                <th scope="col"> - </th>
                                <th scope="col">Oficina</th>
                                <th scope="col">Plaza</th>
                                <th scope="col">Region</th>
                                <th scope="col"> &nbsp; </th>
                            </tr>
                        </thead>

                        <tbody class="small"> </tbody>

                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" id="btn-location-close">
                    <i class="fa-solid fa-xmark"></i>
                    Cerrar
                </button>
            </div>
        </div>

    </div>
</div>
<!-- Modal para busqueda de tarjetas -->

<!-- Modal para busqueda de STAFF -->
<div class="modal" id="modal-staff">
    <div class="modal-dialog modal-dialog-centered modal-md">
        
        <input type="hidden" id="staff_member">

        <div class="modal-content" style="max-height: 500px; min-height: 500px;">
            <div class="modal-header">
                <span class="fs-6">Busqueda de colaboradores</span>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-auto">
                        <label for="staff-search">Nombre</label>
                    </div>

                    <div class="col-auto">
                        <input type="text" class="form-control form-control-sm text-uppercase" id="staff-search">
                    </div>

                    <div class="col-auto">
                        <button class="btn btn-sm btn-primary" id="btn-search-staff">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="table-staff">
                        <thead class="small">
                            <tr>
                                <th scope="col"> - </th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Puesto</th>
                                <th scope="col"> &nbsp; </th>
                            </tr>
                        </thead>

                        <tbody class="small"> </tbody>

                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" id="btn-staff-close">
                    <i class="fa-solid fa-xmark"></i>
                    Cerrar
                </button>
            </div>
        </div>

    </div>
</div>
<!-- Modal para busqueda de STAFF -->

<!-- Modal img -->
<div class="modal" id="modal-img">
    <div class="modal-dialog modal-dialog-centered">
        
        <div class="modal-content">
            
            <div class="modal-body">
                    
                <img src="" class="img-fluid">

            </div>

        </div>

    </div>
</div>
<!-- Modal img -->

<!-- Modal Filtros -->
<div class="modal" id="modal-filters">
    
    <div class="modal-dialog modal-dialog-centered modal-md">
        
        <div class="modal-content">

            <div class="modal-header">
                <span class="fs-6">Filtros de busqueda</span>
            </div>


            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <label class="form-label">Region de carga</label>
                        <select class="form-select form-select-sm" id="filter_region"></select>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Plaza de carga</label>
                        <select class="form-select form-select-sm" id="filter_subregion"></select>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Oficina de carga</label>
                        <select class="form-select form-select-sm" id="filter_location"></select>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-4">
                        <label class="form-label">Region de costo</label>
                        <select class="form-select form-select-sm" id="filter_region_cost"></select>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Plaza de costo</label>
                        <select class="form-select form-select-sm" id="filter_subregion_cost"></select>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Oficina de costo</label>
                        <select class="form-select form-select-sm" id="filter_location_cost"></select>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col">

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="ch_cross_cost">
                            <label class="form-check-label" for="ch_cross_cost">
                                Costos cruzados
                            </label>
                        </div>
                    
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-sm btn-primary" id="btn-check-filters">
                    <i class="fa-solid fa-check"></i>
                </button>

                <button class="btn btn-sm btn-info" id="btn-erase-filters">
                    <i class="fa-solid fa-eraser"></i>
                </button>
            </div>

        </div>

    </div>

</div>
<!-- Modal Filtros -->

<!-- Modal tipo de costo -->
<div class="modal" id="modal-costs">
    

    <div class="modal-dialog modal-dialog-centered modal-md">
        
        <div class="modal-content">
            

            <div class="modal-header">
                <span class="fs-6">Uso de combustible</span>
            </div>


            <div class="modal-body">
                
                <div class="row">
                    <div class="col-auto">
                        <label for="costs-search">Buscar</label>
                    </div>

                    <div class="col-auto">
                        <input type="text" class="form-control form-control-sm text-uppercase" id="costs-search">
                    </div>

                    <div class="col-auto">
                        <button class="btn btn-sm btn-primary" id="btn-search-costs">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="table-costs">
                        <thead class="small">
                            <tr>
                                <th scope="col"> # </th>
                                <th scope="col">Concepto</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col"> &nbsp; </th>
                            </tr>
                        </thead>

                        <tbody class="small"> </tbody>

                    </table>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" id="btn-costs-close">
                    <i class="fa-solid fa-xmark"></i>
                    Cerrar
                </button>
            </div>

        </div>

    </div>

</div>
<!-- Modal tipo de costo -->
