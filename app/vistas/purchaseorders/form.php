<div id="formularioPurchaseOrder" class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">
          <?= isset($datos) ? 'Editar' : 'Agregar' ?> Orden de Compra
        </h3>
      </div>
      <form action="?c=purchaseorders&a=Guardar" method="POST">
        <div class="card-body">
          <div class="form-group">
            <input class="form-control" id="id_purchase_order" name="id_purchase_order" type="hidden" 
                   value="<?= isset($datos) ? $datos->id_purchase_order : '' ?>">
          </div>
          
          <div class="form-group">
            <label for="projects_id">
              Proyecto<span class="text-danger">*</span>
            </label>
            <select name="projects_id" id="projects_id" class="form-control" required>
              <option value="">Seleccione un proyecto...</option>
              <?php foreach($this->modelo->ListarProjects() as $project): ?>
                <option value="<?= $project->id ?>" 
                        <?= (isset($datos) && $datos->projects_id == $project->id) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($project->name) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="suppliers_id">
              Proveedor<span class="text-danger">*</span>
            </label>
            <select name="suppliers_id" id="suppliers_id" class="form-control" required>
              <option value="">Seleccione un proveedor...</option>
              <?php foreach($this->modelo->ListarSuppliers() as $supplier): ?>
                <option value="<?= $supplier->id ?>" 
                        <?= (isset($datos) && $datos->suppliers_id == $supplier->id) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($supplier->name) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="order_date">
              Fecha de Orden<span class="text-danger">*</span>
            </label>
            <input 
              type="date" 
              class="form-control" 
              id="order_date" 
              name="order_date" 
              value="<?= isset($datos) ? date('Y-m-d', strtotime($datos->order_date)) : '' ?>"
              required>
          </div>

          <?php if(isset($datos)): ?>
          <div class="form-group">
            <label>Monto Total Calculado</label>
            <div class="form-control-plaintext">
              <strong>Q. <?= number_format($datos->total_amount, 2) ?></strong>
              <small class="text-muted ml-2">(Se calcula automáticamente desde los detalles)</small>
            </div>
          </div>
          <?php endif; ?>

        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <a href="?c=purchaseorders" class="btn btn-secondary ml-2">Cancelar</a>
        </div>
      </form>
</div>
          </div>