<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Donadores
    </h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <!-- Boton para agregar donador -->
    <div>
      <a class="btn btn-primary btn-flat" href="?c=donors&a=FormCrear"><i class="fas fa-plus"></i> Agregar Donador</a>
    </div>
    <br>

    <!-- Tabla de registros -->
    <div class="table-responsive">
      <table id="tabla-donors" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($this->modelo->Listar() as $r): 
        ?>
        <tr id="fila-<?=$r->id_donor?>-donors" data-id="<?=$r->id_donor?>">
          <td><?=htmlspecialchars($r->name)?></td>
          <td><?=htmlspecialchars($r->description)?></td>
          <td>
            <a href="?c=donors&a=FormEditar&id=<?=$r->id_donor?>" 
               class="btn btn-warning btn-sm">
              <i class="fas fa-edit"></i> Editar
            </a>
            <a href="?c=donors&a=Eliminar&id=<?=$r->id_donor?>" class="btn btn-danger btn-sm">
              <i class="fas fa-trash-alt"></i> Eliminar
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Acciones</th>
        </tr>
        </tfoot>
      </table>
    </div>

  </div>
  <!-- /.card-body -->
</div>
</div>
