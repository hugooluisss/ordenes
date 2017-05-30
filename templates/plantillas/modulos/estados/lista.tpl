<div class="box">
	<div class="box-body">
		<table id="tblEstados" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Nombre</th>
					<th>Orden</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$lista item="row"}
					<tr>
						<td style="border-left: 2px solid {$row.color}">{$row.idEstado}</td>
						<td>{$row.nombre}</td>
						<td>{$row.orden}</td>
						<td style="text-align: right">
							<button type="button" class="btn btn-primary" action="permisos" title="Asignación de permisos a perfiles" identificador="{$row.idEstado}" data-toggle="modal" data-target="#winPerfiles"><i class="fa fa-users"></i></button>
							
							<button type="button" class="btn btn-success" action="modificar" title="Modificar" datos='{$row.json}'><i class="fa fa-pencil"></i></button>
						</td>
					</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
</div>