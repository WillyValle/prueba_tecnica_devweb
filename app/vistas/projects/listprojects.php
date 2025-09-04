<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Proyectos
    </h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <!-- Boton para agregar proyecto -->
    <div>
      <a class="btn btn-primary btn-flat" href="?c=projects&a=FormCrear"><i class="fas fa-plus"></i> Agregar Proyecto</a>

    </div>
    <br>
    <!-- Tabla de registros -->
    <div class="table-responsive">
      <table id="tabla-projects" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Código proyecto</th>
          <th>Nombre del Proyecto</th>
          <th>Municipio</th>
          <th>Departamento</th>
          <th>Fecha Inicio</th>
          <th>Fecha Fin</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($this->modelo->Listar() as $r): 
        ?>
        <tr id="fila-<?=$r->id_project?>-projects" data-id="<?=$r->id_project?>">
          <td><?=htmlspecialchars($r->project_code)?></td>
          <td><?=htmlspecialchars($r->project_name)?></td>
          <td><?=htmlspecialchars($r->municipality)?></td>
          <td><?=htmlspecialchars($r->department)?></td>
          <td><?=htmlspecialchars(date('d/m/Y', strtotime($r->start_date)))?></td>
          <td><?=$r->end_date ? htmlspecialchars(date('d/m/Y', strtotime($r->end_date))) : 'Sin definir'?></td>
          <td>
            <a href="?c=projects&a=FormEditar&id=<?=$r->id_project?>" class="btn btn-warning btn-sm">
              <i class="fas fa-edit"></i> Editar
            </a>
            <a href="?c=projects&a=Eliminar&id=<?=$r->id_project?>" class="btn btn-danger btn-sm">
              <i class="fas fa-trash-alt"></i> Eliminar
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
          <th>Nombre del Proyecto</th>
          <th>Municipio</th>
          <th>Departamento</th>
          <th>Fecha Inicio</th>
          <th>Fecha Fin</th>
          <th>Acciones</th>
        </tr>
        </tfoot>
      </table>
    </div>

  </div>
  <!-- /.card-body -->
</div>
</div>