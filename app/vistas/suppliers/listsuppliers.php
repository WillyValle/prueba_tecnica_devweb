<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Proveedores
    </h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <!-- Boton para crear nuevo proveedor -->
    <div>
      <a href="?c=suppliers&a=FormCrear" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i> Agregar Proveedor</a>
      </button>
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
        <tr id="fila-<?=$r->id_suppliers?>-suppliers" data-id="<?=$r->id_suppliers?>">
          <td><?=htmlspecialchars($r->name)?></td>
          <td><?=htmlspecialchars($r->description)?></td>
          <td>
            <a href="?c=suppliers&a=FormEditar&id=<?=$r->id_suppliers?>" 
               class="btn btn-warning btn-sm">
              <i class="fas fa-edit"></i> Editar
            </a>
            <a href="?c=suppliers&a=Eliminar&id=<?=$r->id_suppliers?>" class="btn btn-danger btn-sm">
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
