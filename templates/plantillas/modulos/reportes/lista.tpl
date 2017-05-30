<div class="box">
	<div class="box-body">
		<table id="tblDatos" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Código</th>
					<th>Descripción</th>
					<th>Observaciones</th>
					<th>Área</th>
					<th>Vendedor</th>
					<th>Fecha</th>
					<th>Estado</th>
					<th>Cantidad</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$lista item="row"}
					<tr>
						<td style="border-left: 3px solid {$row.colorEstado}">{$row.codigo}</td>
						<td>{$row.descripcion}</td>
						<td>{$row.observaciones}</td>
						<td>{$row.area}</td>
						<td>{$row.vendedor}</td>
						<td {if $row.actual eq 1}class="text-danger"{/if}>{$row.registro}</td>
						<td>{$row.estado}</td>
						<td>{$row.cantidad}</td>
					</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
</div>