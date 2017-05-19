<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Ordenes</h1>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-body">
		<form role="form" id="frmBuscar" class="form-horizontal" onsubmit="javascript: return false;">
			<div class="form-group">
				<label for="selSucursal" class="col-lg-2">Sucursal</label>
				<div class="col-lg-3">
					<select class="form-control" id="selSucursal" name="selSucursal">
						{foreach item=item from=$sucursales}
							<option value="{$item.idSucursal}">{$item.nombre}</option>
						{/foreach}
					</select>
				</div>
				<label for="chkAntiguas" class="col-lg-2">Ordenes viejas</label>
				<input type="checkbox" id="chkAntiguas"/>
			</div>
			<div class="form-group">
				<label for="selSucursal" class="col-lg-2">Estado entrega</label>
				<div class="col-lg-6">
					<select class="form-control" id="selEntrega" name="selEntrega">
						<option value="0">Sin entregar</option>
						<option value="1">Entrega completa y en tiempo</option>
						<option value="2">Entrega incompleta y fuera de tiempo</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-info pull-right">Buscar</button>
				<input type="hidden" id="id"/>
			</div>
		</form>
	</div>
</div>

<div id="piechart" style="width: 100%; height: 500px;"></div>

<br />
<div class="well well-lg" id="listaOrdenes">
</div>