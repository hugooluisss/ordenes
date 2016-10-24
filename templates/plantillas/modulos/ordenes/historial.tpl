La orden fue registrada el <b>{$orden->getRegistro()}</b> y se encuentra en estado <b>{$orden->estado->getNombre()}</b>. 
<b>
{if $orden->estado->getId() eq 3}
	Fue terminada hace {$tiempo}
{else}
	Desde su registro han pasado {$tiempo}
{/if}
</b>
<table id="tblDatos" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Estado</th>
			<th>Usuario</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$lista item="row"}
			<tr>
				<td style="border-left: 3px solid {$row.color}">{$row.fecha}</td>
				<td>{$row.estado}</td>
				<td>{$row.usuario}</td>
			</tr>
		{/foreach}
	</tbody>
</table>