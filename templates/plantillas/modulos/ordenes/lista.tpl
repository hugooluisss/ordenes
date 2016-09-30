<div class="box">
	<div class="box-body">
		<table id="tblDatos" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Código</th>
					<th>Cliente</th>
					<th>Vendedor</th>
					<th>Sucursal</th>
					<th>Fecha</th>
					<th>Estado</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$lista item="row"}
					<tr>
						<td style="border-left: 3px solid {$row.colorEstado}">{$row.codigo}</td>
						<td>{$row.cliente}</td>
						<td>{$row.vendedor}</td>
						<td>{$row.sucursal}</td>
						<td {if $row.actual eq 1}class="text-danger"{/if}>{$row.registro}</td>
						<td>{$row.estado}</td>
						<td class="text-right">
							<button type="button" class="btn btn-success" action="detalle" title="Detalle" datos='{$row.json}'><i class="fa fa-search"></i></button>
						</td>
					</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
</div>