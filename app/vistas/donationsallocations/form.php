<div id="formularioCategoria" class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">
          <?= isset($datos) ? 'Editar' : 'Agregar' ?> Donación y Asignación
        </h3>
      </div>
      <form action="?c=donationsallocations&a=Guardar" method="POST">
        <div class="card-body">
          <div class="form-group">
            <input class="form-control" id="id_allocation" name="id_allocation" type="hidden" 
                   value="<?= isset($datos) ? $datos->id_allocation : '' ?>">
          </div>
          
          <div class="form-group">
            <label for="donors_id">
              Donante<span class="text-danger">*</span>
            </label>
            <select name="donors_id" id="donors_id" class="form-control" required>
              <option value="">Seleccione un donante...</option>
              <?php foreach($this->modelo->ListarDonors() as $donor): ?>
                <option value="<?= $donor->id ?>" 
                        <?= (isset($datos) && $datos->donors_id == $donor->id) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($donor->name) ?>
                </option>
              <?php endforeach; ?>
            </select>
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
            <label for="budget_items">
              Rubro Presupuestario<span class="text-danger">*</span>
            </label>
            <select name="budget_items" id="budget_items" class="form-control" required>
              <option value="">Seleccione un rubro...</option>
              <?php foreach($this->modelo->ListarBudgetItems() as $item): ?>
                <option value="<?= $item->id ?>" 
                        <?= (isset($datos) && $datos->budget_items == $item->id) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($item->name) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="amount">
              Cantidad<span class="text-danger">*</span>
            </label>
            <input 
              type="number" 
              step="0.01"
              class="form-control" 
              id="amount"
              name="amount"
              value="<?= isset($datos) ? $datos->amount : '' ?>"
              required>
          </div>

          <div class="form-group">
            <label for="date">
              Fecha de Donación<span class="text-danger">*</span>
            </label>
            <input 
              type="date" 
              class="form-control" 
              id="date" 
              name="date" 
              value="<?= isset($datos) ? date('Y-m-d', strtotime($datos->date)) : '' ?>"
              required>
          </div>

        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <a href="?c=donationsallocations" class="btn btn-secondary ml-2">Cancelar</a>
        </div>
      </form>
</div>
              </div>