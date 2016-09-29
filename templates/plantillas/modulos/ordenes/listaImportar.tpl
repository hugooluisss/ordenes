<div class="row">
	<div class="col-md-12">
		<div class="btn-group">
			<button type="button" class="btn btn-danger" action="importar" datos='{$listaJson}' {if !$error}disabled=true{/if}>Importar al sistema</button>
		</div>
	</div>
</div>

<table id="tblDatos" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Código</th>
			<th>Cliente</th>
			<th>Vendedor</th>
			<th>Sucursal</th>
			<th>Área</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$lista item="row"}
			<tr>
				<td class="text-center" style="{if !($row.areaExiste and $row.vendedorExiste and $row.sucursalExiste)}border-left: 1px solid red; color: red;{else}color: green;{/if}">
					{if $row.areaExiste and $row.vendedorExiste and $row.sucursalExiste}
						<i class="fa fa-check" aria-hidden="true"></i>
					{else}
						<i class="fa fa-times" aria-hidden="true"></i>
					{/if}
				</td>
				<td>{$row.codigo}</td>
				<td>{$row.cliente}</td>
				<td style="{if !$row.vendedorExiste}color: red;{/if}">{$row.vendedor}</td>
				<td style="{if !$row.sucursalExiste}color: red;{/if}">{$row.sucursal}</td>
				<td style="{if !$row.areaExiste}color: red;{/if}">{$row.area}</td>
			</tr>
		{/foreach}
	</tbody>
</table>