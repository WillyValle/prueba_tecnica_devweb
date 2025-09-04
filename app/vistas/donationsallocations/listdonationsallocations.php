<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Donaciones y Asignaciones
    </h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <!-- Botón para agregar donación -->
    <div>
      <a class="btn btn-primary btn-flat" href="?c=donationsallocations&a=FormCrear">
        <i class="fas fa-plus"></i> Agregar Donación
      </a>
    </div>
    <br>
    <!-- Tabla de registros -->
    <div class="table-responsive">
      <table id="tabla-donations" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Nombre del Donante</th>
          <th>Nombre del Proyecto</th>
          <th>Rubro Presupuestario</th>
          <th>Cantidad</th>
          <th>Fecha Donación</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($this->modelo->Listar() as $r): 
        ?>
        <tr id="fila-<?=$r->id_allocation?>-donations" data-id="<?=$r->id_allocation?>">
          <td><?=htmlspecialchars($r->donor_name)?></td>
          <td><?=htmlspecialchars($r->project_name)?></td>
          <td><?=htmlspecialchars($r->budget_item_name)?></td>
          <td>Q. <?=number_format($r->amount, 2)?></td>
          <td><?=htmlspecialchars(date('d/m/Y', strtotime($r->date)))?></td>
          <td>
            <a href="?c=donationsallocations&a=FormEditar&id=<?=$r->id_allocation?>" 
               class="btn btn-warning btn-sm">
              <i class="fas fa-edit"></i> Editar
            </a>
            <a href="?c=donationsallocations&a=Eliminar&id=<?=$r->id_allocation?>" class="btn btn-danger btn-sm">
              <i class="fas fa-trash-alt"></i> Eliminar
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
          <th>Nombre del Donante</th>
          <th>Nombre del Proyecto</th>
          <th>Rubro Presupuestario</th>
          <th>Cantidad</th>
          <th>Fecha Donación</th>
          <th>Acciones</th>
        </tr>
        </tfoot>
      </table>
    </div>

  </div>
  <!-- /.card-body -->
</div>
</div>