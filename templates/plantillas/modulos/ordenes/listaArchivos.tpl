<table id="tblDatos" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Tamaño</th>
			<th>Fecha FTP</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$lista item="row"}
			<tr>
				<td>{$row.nombre}</td>
				<td class="text-right">{$row.tamano}</td>
				<td class="text-right">{$row.creacion}</td>
				<td class="text-right">
					<a class="btn btn-default" href="{$row.ruta}" download="{$row.nombre}"> <i class="fa fa-search"></i></a>
					{if $PAGE.usuario->getIdTipo() eq 2}
						<button type="button" class="btn btn-danger" action="borrar" title="Eliminar" datos='{$row.json}'><i class="fa fa-times"></i></button>
					{/if}
				</td>
			</tr>
		{/foreach}
	</tbody>
</table>