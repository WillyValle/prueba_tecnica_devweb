<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Detalles de Orden de Compra #<?= $infoOrden->id_purchase_order ?>
    </h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <!-- Información de la orden -->
    <div class="row mb-4">
      <div class="col-md-12">
        <div class="info-box">
          <span class="info-box-icon bg-info"><i class="fas fa-shopping-cart"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Información de la Orden</span>
            <span class="info-box-number">
              <strong>Proyecto:</strong> <?= htmlspecialchars($infoOrden->project_name) ?><br>
              <strong>Proveedor:</strong> <?= htmlspecialchars($infoOrden->supplier_name) ?><br>
              <strong>Fecha:</strong> <?= date('d/m/Y', strtotime($infoOrden->order_date)) ?><br>
              <strong>Monto Total:</strong> Q. <?= number_format($infoOrden->total_amount, 2) ?>
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Botones de acción -->
    <div class="mb-3">
      <a class="btn btn-primary btn-flat" href="?c=purchaseorderdetails&a=FormCrear&order_id=<?= $infoOrden->id_purchase_order ?>">
        <i class="fas fa-plus"></i> Agregar Detalle
      </a>
      <a class="btn btn-secondary btn-flat" href="?c=purchaseorders">
        <i class="fas fa-arrow-left"></i> Volver a Órdenes
      </a>
      <a class="btn btn-info btn-flat" href="?c=purchaseorderdetails">
        <i class="fas fa-list"></i> Ver Todos los Detalles
      </a>
    </div>

    <!-- Tabla de detalles -->
    <div class="table-responsive">
      <table id="tabla-detalles-orden" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Rubro Presupuestario</th>
          <th>Descripción</th>
          <th>Monto</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $totalDetalles = 0;
        foreach($detalles as $detalle):
          $totalDetalles += $detalle->amount;
          
        ?>
        <tr id="fila-<?=$detalle->id_purchase_order_details?>-detalle" data-id="<?=$detalle->id_purchase_order_details?>">
          <td><?=htmlspecialchars($detalle->budget_item_name)?></td>
          <td><?=htmlspecialchars($detalle->budget_item_description ?: 'Sin descripción')?></td>
          <td>Q. <?=number_format($detalle->amount, 2)?></td>
          <td>
            <a href="?c=purchaseorderdetails&a=FormEditar&id=<?=$detalle->id_purchase_order_details?>" 
               class="btn btn-warning btn-sm">
              <i class="fas fa-edit"></i> Editar
            </a>
            <a href="?c=purchaseorderdetails&a=Eliminar&id=<?=$detalle->id_purchase_order_details?>&order_id=<?=$infoOrden->id_purchase_order?>" 
               class="btn btn-danger btn-sm"
               onclick="return confirm('¿Está seguro de eliminar este detalle?')">
              <i class="fas fa-trash"></i> Eliminar
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr class="bg-light">
          <th colspan="2">TOTAL DETALLES:</th>
          <th>Q. <?=number_format($totalDetalles, 2)?></th>
          <th>
            Acciones
          </th>
          
        </tr>
        </tfoot>
      </table>
    </div>

    <?php if(empty($detalles)): ?>
    <div class="alert alert-info text-center">
      <h5><i class="icon fas fa-info"></i> Sin detalles</h5>
      Esta orden de compra no tiene detalles agregados aún.
      <a href="?c=purchaseorderdetails&a=FormCrear&order_id=<?= $infoOrden->id_purchase_order ?>" class="btn btn-primary btn-sm ml-2">
        Agregar primer detalle
      </a>
    </div>
    <?php endif; ?>

  </div>
  <!-- /.card-body -->
</div>
    </div>