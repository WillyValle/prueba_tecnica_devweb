<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Detalles de Órdenes de Compra
    </h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <!-- Botón para agregar detalle -->
    <div>
      <a class="btn btn-primary btn-flat" href="?c=purchaseorderdetails&a=FormCrear">
        <i class="fas fa-plus"></i> Agregar Detalle
      </a>
      <a class="btn btn-secondary btn-flat" href="?c=purchaseorders">
        <i class="fas fa-arrow-left"></i> Volver a Órdenes
      </a>
    </div>
    <br>
    <!-- Tabla de registros -->
    <div class="table-responsive">
      <table id="tabla-purchaseorderdetails" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th># Orden</th>
          <th>Proyecto</th>
          <th>Proveedor</th>
          <th>Fecha Orden</th>
          <th>Rubro Presupuestario</th>
          <th>Monto</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($this->modelo->Listar() as $r): 
        ?>
        <tr id="fila-<?=$r->id_purchase_order_details?>-purchaseorderdetails" data-id="<?=$r->id_purchase_order_details?>">
          <td>
            <a href="?c=purchaseorderdetails&a=VerDetallesPorOrden&order_id=<?=$r->id_purchase_order?>" 
               class="text-primary">
              #<?=htmlspecialchars($r->id_purchase_order)?>
            </a>
          </td>
          <td><?=htmlspecialchars($r->project_name)?></td>
          <td><?=htmlspecialchars($r->supplier_name)?></td>
          <td><?=htmlspecialchars(date('d/m/Y', strtotime($r->order_date)))?></td>
          <td><?=htmlspecialchars($r->budget_item_name)?></td>
          <td>Q. <?=number_format($r->amount, 2)?></td>
          <td>
            <a href="?c=purchaseorderdetails&a=FormEditar&id=<?=$r->id_purchase_order_details?>" 
               class="btn btn-warning btn-sm">
              <i class="fas fa-edit"></i> Editar
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
          <th>Fecha Orden</th>
          <th>Rubro Presupuestario</th>
          <th>Monto</th>
          <th>Acciones</th>
        </tr>
        </tfoot>
      </table>
    </div>

  </div>
  <!-- /.card-body -->
</div>
        </div>