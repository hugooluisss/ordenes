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
			<th>Producto</th>
			<th>Vendedor</th>
			<th>Sucursal</th>
			<th>Área</th>
			{if $PAGE.usuario->getIdTipo() eq 1}
				<th>&nbsp;</th>
			{/if}
		</tr>
	</thead>
	<tbody>
		{foreach from=$ordenes item="row"}
			<tr>
				<td>{$row->CVE_DOC}</td>
				<td>{$row->CODIGO}</td>
				<td>{$row->DESCRIPCION_DEL_ARTICULO}</td>
				<td>{$row->CLAVE_VENDEDOR}</td>
				<td></td>
				<td>{$row->AREA_DE_PRODUCCION}</td>
				<td></td>
			</tr>
		{/foreach}
	</tbody>
</table>