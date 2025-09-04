<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Órdenes de Compra
    </h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <!-- Botón para agregar orden de compra -->
    <div>
      <a class="btn btn-primary btn-flat" href="?c=purchaseorders&a=FormCrear">
        <i class="fas fa-plus"></i> Agregar Orden de Compra
      </a>
    </div>
    <br>
    <!-- Tabla de registros -->
    <div class="table-responsive">
      <table id="tabla-purchaseorders" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th># Orden</th>
          <th>Proyecto</th>
          <th>Proveedor</th>
          <th>Monto Total</th>
          <th>Fecha de Orden</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($this->modelo->Listar() as $r): 
        ?>
        <tr id="fila-<?=$r->id_purchase_order?>-purchaseorders" data-id="<?=$r->id_purchase_order?>">
          <td><?=htmlspecialchars($r->id_purchase_order)?></td>
          <td><?=htmlspecialchars($r->project_name)?></td>
          <td><?=htmlspecialchars($r->supplier_name)?></td>
          <td>Q. <?=number_format($r->total_amount, 2)?></td>
          <td><?=htmlspecialchars(date('d/m/Y', strtotime($r->order_date)))?></td>
          <td>
            <a href="?c=purchaseorders&a=FormEditar&id=<?=$r->id_purchase_order?>" 
               class="btn btn-warning btn-sm">
              <i class="fas fa-edit"></i> Editar
            </a>
            <a href="?c=purchaseorderdetails&a=VerDetallesPorOrden&order_id=<?=$r->id_purchase_order?>" 
               class="btn btn-info btn-sm">
              <i class="fas fa-eye"></i> Detalles
            </a>
            <a href="?c=purchaseorders&a=Eliminar&id=<?=$r->id_purchase_order?>" class="btn btn-danger btn-sm">
              <i class="fas fa-trash-alt"></i> Eliminar
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
          <th># Orden</th>
          <th>Proyecto</th>
          <th>Proveedor</th>
          <th>Monto Total</th>
          <th>Fecha de Orden</th>
          <th>Acciones</th>
        </tr>
        </tfoot>
      </table>
    </div>

  </div>
  <!-- /.card-body -->
</div>
</div>