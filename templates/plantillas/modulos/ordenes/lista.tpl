<div class="box">
	<div class="box-body">
		<div class="row">
			<div class="col-md-6 text-left text-bold" style="vertical-align: middle">
				<span class="text-mute"><small>Última actualización: </small> </span> <span style="font-size: 26px;" id="hora">{$smarty.now|date_format:"%H:%M:%S"}</span>
				<br />
				<button class="btn btn-warning btn-xs" id="btnUpdateSesion">Actualizar sesión</button>
			</div>
			<div class="col-md-6 text-right">
				<div id="btnGroupActions" class="btn-group" role="group" aria-label="...">
					{if $PAGE.usuario->getIdTipo() eq 6}
						<button type="button" class="btn btn-danger" estado="10" title="Pasar a En Rack"><i class="fa fa-list-alt"></i></button>
						<button type="button" class="btn btn-danger" estado="11" title="Pasar a Perdido"><i class="fa fa-lastfm"></i></button>
						<button type="button" class="btn btn-danger" estado="9" title="Pasar a En tránsito"><i class="fa fa-arrow-circle-o-right"></i></button>
					{/if}
					{if $PAGE.usuario->getIdTipo() eq 4}
						<button type="button" class="btn btn-danger" estado="10" title="Pasar a En Rack"><i class="fa fa-list-alt"></i></button>
						<button type="button" class="btn btn-danger" estado="3" title="Pasar a Terminada">T</button>
					{/if}
					{if $PAGE.usuario->getIdTipo() eq 5}
						<button type="button" class="btn btn-danger" estado="10" title="Pasar a En Rack"><i class="fa fa-list-alt"></i></button>
						<button type="button" class="btn btn-danger" estado="3" title="Pasar a Terminada">T</button>
						<button type="button" class="btn btn-danger" estado="4" title="Pasar a Cancelada">C</button>
						<button type="button" class="btn btn-danger" estado="9" title="Pasar a En tránsito"><i class="fa fa-arrow-circle-o-right"></i></button>
					{/if}
				</div>
			</div>
		</div>
		<br />
		<table id="tblDatos" class="table table-bordered table-hover">
			<thead>
				<tr>
					{if in_array($PAGE.usuario->getIdTipo(), array(6, 5, 4))}
					<th>&nbsp;</th>
					{/if}
					<th>Código</th>
					<th>Descripción</th>
					<th>Observaciones</th>
					{if $PAGE.usuario->getIdtipo() eq 4}
						<th>Cliente</th>
					{else}
						<th>Sucursal</th>
					{/if}
					<th>Fecha</th>
					<th>Estado</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$lista item="row"}
					<tr>
						{if in_array($PAGE.usuario->getIdTipo(), array(6, 5, 4))}
						<td style="border-left: 3px solid {$row.colorEstado}">
							<input type="checkbox" class="setEstado" value="{$row.idOrden}" />
						</td>
						<td>{$row.codigo}</td>
						{else}
						<td style="border-left: 3px solid {$row.colorEstado}">{$row.codigo}</td>
						{/if}
						<td>{$row.descripcion}</td>
						<td>{$row.observaciones|truncate:30:"...":true}</td>
						{if $PAGE.usuario->getIdtipo() eq 4}
							<td>{$row.cliente}</td>
						{else}
							<td>{$row.sucursal}</td>
						{/if}
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