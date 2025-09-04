<div id="formularioPurchaseOrderDetails" class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">
          <?= isset($datos) ? 'Editar' : 'Agregar' ?> Detalle de Orden de Compra
        </h3>
      </div>
      <form action="?c=purchaseorderdetails&a=Guardar" method="POST">
        <div class="card-body">
          <div class="form-group">
            <input class="form-control" id="id_purchase_order_details" name="id_purchase_order_details" type="hidden" 
                   value="<?= isset($datos) ? $datos->id_purchase_order_details : '' ?>">
          </div>
          
          <div class="form-group">
            <label for="purchase_orders_id">
              Orden de Compra<span class="text-danger">*</span>
            </label>
            <select name="purchase_orders_id" id="purchase_orders_id" class="form-control" required>
              <option value="">Seleccione una orden de compra...</option>
              <?php foreach($this->modelo->ListarPurchaseOrders() as $order): ?>
                <option value="<?= $order->id ?>" 
                        <?php 
                        $selected = false;
                        if(isset($datos) && $datos->purchase_orders_id == $order->id) {
                            $selected = true;
                        } elseif(isset($purchase_order_id) && $purchase_order_id == $order->id) {
                            $selected = true;
                        }
                        echo $selected ? 'selected' : '';
                        ?>>
                  <?= htmlspecialchars($order->name) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="budget_items_id">
              Rubro Presupuestario<span class="text-danger">*</span>
            </label>
            <select name="budget_items_id" id="budget_items_id" class="form-control" required>
              <option value="">Seleccione un rubro presupuestario...</option>
              <?php foreach($this->modelo->ListarBudgetItems() as $item): ?>
                <option value="<?= $item->id ?>" 
                        <?= (isset($datos) && $datos->budget_items_id == $item->id) ? 'selected' : '' ?>
                        title="<?= htmlspecialchars($item->description) ?>">
                  <?= htmlspecialchars($item->name) ?>
                  <?= $item->description ? ' - ' . htmlspecialchars($item->description) : '' ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="amount">
              Monto<span class="text-danger">*</span>
            </label>
            <input 
              type="number" 
              step="0.01"
              class="form-control" 
              id="amount"
              name="amount"
              value="<?= isset($datos) ? $datos->amount : '' ?>"
              placeholder="0.00"
              required>
            <small class="form-text text-muted">Ingrese el monto específico para este rubro presupuestario</small>
          </div>

        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <a href="<?= isset($purchase_order_id) ? '?c=purchaseorderdetails&a=VerDetallesPorOrden&order_id='.$purchase_order_id : (isset($datos) ? '?c=purchaseorderdetails&a=VerDetallesPorOrden&order_id='.$datos->purchase_orders_id : '?c=purchaseorderdetails') ?>" 
             class="btn btn-secondary ml-2">Cancelar</a>
        </div>
      </form>
</div>