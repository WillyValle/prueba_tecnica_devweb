   <div id="formularioCategoria" class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Agregar Rubro</h3>
      </div>
      <form action="?c=budgetitems&a=Guardar" method="POST">
        <div class="card-body">
          <div class="form-group">
            <input class="form-control" id="ID_BUDGET_ITEM" type="hidden"
                   name="id_budget_item" value="<?=isset($datos) ? $datos->id_budget_item : ''?>">
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
              placeholder="Ingrese el nombre del donador"
              pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+(\s[a-zA-ZáéíóúÁÉÍÓÚñÑ]+)*$"
              title="Solo letras y espacios. Mínimo 2 caracteres. No números ni símbolos."
              minlength="2"
              maxlength="100"
              value="<?=isset($datos->name) ? htmlspecialchars($datos->name) : '' ?>"
              required>
            <small class="form-text text-muted">
              <i class="fas fa-info-circle"></i> Solo letras y espacios. Mínimo 2 caracteres. No números ni símbolos.
            </small>
          </div>
          <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Ingrese la descripción" maxlength="100" ><?=isset($datos->description) ? htmlspecialchars($datos->description) : '' ?></textarea>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <button type="reset" class="btn btn-secondary ml-2">Cancelar</button>
        </div>
      </form>
    </div>
</div>