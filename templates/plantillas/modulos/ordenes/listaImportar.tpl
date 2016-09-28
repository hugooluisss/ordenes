<div class="row">
	<div class="col-md-12">
		<div class="btn-group">
			<button type="button" class="btn btn-success" action="seleccionar">Seleccionar</button>
			<button type="button" class="btn btn-success" action="desseleccionar">Limpiar selección</button>
			<button type="button" class="btn btn-danger"  action="importar">Importar al sistema</button>
		</div>
	</div>
</div>

<table id="tblDatos" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Código</th>
			<th>Cantidad</th>
			<th>Artículo</th>
			<th>Descripción</th>
			<th>Observaciones</th>
			<th>Cliente</th>
			<th>Vendedor</th>
			<th>Elaboró</th>
			<th>Importe</th>
			<th>Sucursal</th>
			<th>Área</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$lista item="row"}
			<tr>
				<td class="text-center" style="{if !($row.areaExiste and $row.vendedorExiste)}border-left: 1px solid red;{/if}">
					{if $row.areaExiste and $row.vendedorExiste}
						<input type="checkbox" datos='{$row.json}' />
					{/if}
				</td>
				<td>{$row.codigo}</td>
				<td class="text-right">{$row.cantidad}</td>
				<td>{$row.cveart}</td>
				<td>{$row.desart}</td>
				<td>{$row.obsart}</td>
				<td>{$row.cliente}</td>
				<td style="{if !$row.vendedorExiste}color: red;{/if}">{$row.vendedor}</td>
				<td>{$row.elaborado}</td>
				<td class="text-right">{$row.importe}</td>
				<td>{$row.sucursal}</td>
				<td style="{if !$row.areaExiste}color: red;{/if}">{$row.area}</td>
			</tr>
		{/foreach}
	</tbody>
</table>