<div id="formularioCategoria" class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <?= isset($datos) ? 'Editar' : 'Agregar' ?> Proveedor
        </h3>
    </div>
    <form action="?c=suppliers&a=Guardar" method="POST">
        <div class="card-body">
            <div class="form-group">
                <input class="form-control" id="ID_SUPPLIER" type="hidden"
                       name="id_suppliers" 
                       value="<?= isset($datos) ? $datos->id_suppliers : '' ?>">
            </div>
            
            <div class="form-group">
                <label for="name">
                    Nombre<span class="text-danger">*</span>
                </label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="name" 
                    name="name" 
                    placeholder="Ingrese el nombre del proveedor"
                    pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+(\s[a-zA-ZáéíóúÁÉÍÓÚñÑ]+)*$"
                    title="Solo letras y espacios. Mínimo 2 caracteres. No números ni símbolos."
                    minlength="2"
                    maxlength="100"
                    value="<?= isset($datos) ? htmlspecialchars($datos->name) : '' ?>"
                    required>
                <small class="form-text text-muted">
                    <i class="fas fa-info-circle"></i> Solo letras y espacios. Mínimo 2 caracteres. No números ni símbolos.
                </small>
            </div>
            
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea 
                    class="form-control" 
                    id="description" 
                    name="description" 
                    rows="3" 
                    placeholder="Ingrese la descripción" 
                    maxlength="100"><?= isset($datos) ? htmlspecialchars($datos->description) : '' ?></textarea>
                <small class="form-text text-muted">
                    <i class="fas fa-info-circle"></i> Máximo 100 caracteres.
                </small>
            </div>
        </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Guardar
            </button>
            <a href="?c=suppliers&a=index" class="btn btn-secondary ml-2">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>
    </form>
</div>