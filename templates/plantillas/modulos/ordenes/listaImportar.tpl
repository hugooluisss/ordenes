<hr />
<div class="row">
	<div class="col-md-4">
		<div class="btn-group">
			<button type="button" class="btn btn-success" action="importar" datos='{$listaJson}' {if !$error}disabled=true{/if} inicio="{$folios.inicio}" fin="{$folios.fin}">Importar al sistema</button>
		</div>
	</div>
	<div class="col-md-8">
		{if !$error}
			<div class="alert alert-danger">
				<strong>Error</strong> Hay elementos que no pueden ser importados, revisa la lista
			</div>
		{else}
			<div class="alert alert-warning">
				<strong>Listo...</strong> ODT's del <b>{$folios.inicio}</b> al <b>{$folios.fin}</b>
			</div>
		{/if}
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
				<td class="text-center" style="{if !($row.areaExiste and $row.vendedorExiste and $row.sucursalExiste and $row.ordenExiste)}border-left: 1px solid red; color: red;{else}color: green;{/if}">
					{if $row.areaExiste and $row.vendedorExiste and $row.sucursalExiste and $row.ordenExiste}
						<i class="fa fa-check" aria-hidden="true"></i>
					{else}
						<i class="fa fa-times" aria-hidden="true"></i>
					{/if}
				</td>
				<td style="{if !$row.ordenExiste}color: red;{/if}" {if !$row.ordenExiste}title="La orden ya está registrada o se encuentra dentro de un rango ya importado en esta razón social"{/if}>{$row.codigo}</td>
				<td>{$row.cliente}</td>
				<td style="{if !$row.vendedorExiste}color: red;{/if}" {if !$row.vendedorExiste}title="El vendedor no está registrado en el sistema"{/if}>{$row.vendedor}</td>
				<td style="{if !$row.sucursalExiste}color: red;{/if}" {if !$row.sucursalExiste}title="La sucursal no existe o no pertenece a la razón social seleccionada para importar"{/if}>{$row.sucursal}</td>
				<td style="{if !$row.areaExiste}color: red;{/if}" {if !$row.areaExiste}title="Esta área no se encuentra registrada en el sistema"{/if}>{$row.area}</td>
			</tr>
		{/foreach}
	</tbody>
</table>