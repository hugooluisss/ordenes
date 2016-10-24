<div class="box">
	<div class="box-body">
		<table id="tblDatos" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Código</th>
					<th>Descripción</th>
					<th>Observaciones</th>
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
						<td>{$row.descripcion}</td>
						<td>{$row.observaciones}</td>
						<td>{$row.sucursal}</td>
						<td {if $row.actual eq 1}class="text-danger"{/if}>{$row.registro}</td>
						<td>{$row.estado}</td>
						<td class="text-right">
							{if $row.archivo neq '' and $PAGE.usuario->getIdTipo() eq 3}
								<a href="{$row.archivo}" download class="btn btn-primary" action="setEstado" estado="2" title="Descargar archivo" datos='{$row.json}'><i class="fa fa-download"></i></a>
							{/if}
						
							{if $PAGE.usuario->getIdTipo() eq 6 and $row.idEstado neq 9}
								<button type="button" class="btn btn-warning" action="setEstado" estado="9" title="Pasar a En tránsito" datos='{$row.json}'><i class="fa fa-arrow-circle-o-right"></i></button>
							{/if}
							{if $PAGE.usuario->getIdTipo() eq 5}
								<button type="button" class="btn btn-warning" title="Historial de estados" action="historialEstados" datos='{$row.json}'><i class="fa fa-certificate"></i></button>
							{/if}
							{if $PAGE.usuario->getIdTipo() eq 4 and in_array($row.idEstado, array(10, 11, 9)) neq true}
								<button type="button" class="btn btn-warning" action="setEstado" estado="10" title="Pasar a En Rack" datos='{$row.json}'><i class="fa fa-list-alt"></i></button>
								<button type="button" class="btn btn-warning" action="setEstado" estado="11" title="Pasar a Perdido" datos='{$row.json}'><i class="fa fa-lastfm"></i></button>
							{/if}
							<button type="button" class="btn btn-success" action="detalle" title="Detalle" datos='{$row.json}'><i class="fa fa-search"></i></button>
						</td>
					</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
</div>