<hr />

<div class="box">
	<div class="box-body">
		<div class="row">
			<div class="col-md-4">
				<div class="btn-group">
					<button type="button" class="btn btn-success" action="importar">Importar al sistema</button>
				</div>
			</div>
			<div class="col-md-8">
				{if !$banderaGeneral}
					<div class="alert alert-danger">
						<strong>Error</strong> Hay elementos que no pueden ser importados, revisa la lista
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
				</tr>
			</thead>
			<tbody>
				{foreach from=$ordenes item="row"}
					<tr>
						<td>{if $row->bandera}<input type="checkbox" class="orden" json='{$row->json}' />{/if}</td>
						<td>{$row->CODIGO}</td>
						<td>{$row->DESCRIPCION_DEL_ARTICULO}</td>
						<td {if $row->vendedor['idVendedor'] eq ''}title="El vendedor no existe en el sistema" class="text-danger"{/if}>{$row->CLAVE_VENDEDOR}</td>
						<td {if $row->sucursal['idSucursal'] eq ''}title="La sucursal no existe en el sistema o no se pudo determinar" class="text-danger"{/if}>
							{if $row->sucursal['nombre'] eq ''}-{else}{$row->sucursal['nombre']}{/if}
						</td>
						<td {if $row->area['idArea'] eq ''}title="El area de producción no existe en el sistema" class="text-danger"{/if}>
							{$row->AREA_DE_PRODUCCION}
						</td>
					</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
</div>