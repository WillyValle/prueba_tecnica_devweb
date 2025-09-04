<div id="formularioProyecto" class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <?= isset($datos) ? 'Editar' : 'Agregar' ?> Proyecto
        </h3>
    </div>
    <form action="?c=projects&a=Guardar" method="POST">
        <div class="card-body">
            <div class="form-group">
                <input class="form-control" id="ID_PROJECT" type="hidden"
                       name="id_project" 
                       value="<?= isset($datos) ? $datos->id_project : '' ?>">
            </div>
            
            <div class="form-group">
                <label for="project_name">Nombre del Proyecto</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="project_name" 
                    name="project_name" 
                    placeholder="Ingrese el nombre del proyecto"
                    value="<?= isset($datos) ? $datos->project_name : '' ?>"
                    required>
            </div>
            
            <div class="form-group">
                <label for="municipality">Municipio</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="municipality" 
                    name="municipality" 
                    placeholder="Ingrese el municipio"
                    value="<?= isset($datos) ? $datos->municipality : '' ?>"
                    required>
            </div>
            
            <div class="form-group">
                <label for="department">Departamento</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="department" 
                    name="department" 
                    placeholder="Ingrese el departamento"
                    value="<?= isset($datos) ? $datos->department : '' ?>"
                    required>
            </div>
            
            <div class="form-group">
                <label for="start_date">Fecha de Inicio</label>
                <input 
                    type="date" 
                    class="form-control" 
                    id="start_date" 
                    name="start_date"
                    value="<?= isset($datos) ? $datos->start_date : '' ?>"
                    required>
            </div>
            
            <div class="form-group">
                <label for="end_date">Fecha de Finalización</label>
                <input 
                    type="date" 
                    class="form-control" 
                    id="end_date" 
                    name="end_date"
                    value="<?= isset($datos) ? $datos->end_date : '' ?>">
            </div>
        </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="reset" class="btn btn-secondary ml-2">Cancelar</button>
        </div>
    </form>
</div>
</div>