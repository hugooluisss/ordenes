<div class="row" style="margin-left: 10px;"> <!--style="border: 1px solid #3c8dbc; margin: 5px auto;" -->
	<div class="col-md-2 text-center" style="color: {$orden->sucursal->getColor()}; background: #ecf0f5;">
		<i class="fa fa-tag fa-5x" aria-hidden="true"></i>
		<br />
		{$orden->sucursal->getnombre()}
	</div>
	<div class="col-md-6">
		<h1 style="color: #3c8dbc">Orden de servicio</h1>
	</div>
	<div class="col-md-4">
		<b>Estado</b><br /><br />
		<select id="selEstadoOrden" name="selEstadoOrden" class="form-control">
			{foreach key=key item=item from=$estados}
				<option value="{$item.idEstado}" {if $orden->estado->getId() eq $item.idEstado}selected{/if}>{$item.nombre}</option>
			{/foreach}
		</select>
	</div>
</div>
<hr />
<div class="row">
	<div class="col-md-2">
		<b>Código</b>
	</div>
	<div class="col-md-2">
		<input class="form-control text-right" value="{$orden->getCodigo()}" readonly disabled />
	</div>
	<div class="col-md-2 col-md-offset-3">
		<b>Fecha y hora</b>
	</div>
	<div class="col-md-3">
		<input class="form-control text-right" value="{$orden->getRegistro()}" readonly disabled />
	</div>
</div>
<br />
<div class="row">
	<div class="col-md-2">
		<b>Id Vendedor</b>
	</div>
	<div class="col-md-2">
		<input class="form-control text-right" value="{$orden->vendedor->getClave()}" readonly disabled />
	</div>
	<div class="col-md-2">
		<b>Nombre</b>
	</div>
	<div class="col-md-6">
		<input class="form-control" value="{$orden->vendedor->getNombre()}" readonly disabled />
	</div>
</div>
<br />
<div class="row">
	<div class="col-md-2">
		<b>Cliente</b>
	</div>
	<div class="col-md-10">
		<input class="form-control" value="{$orden->getCliente()}" readonly disabled />
	</div>
</div>
<br />
<div class="row">
	<div class="col-md-12">
		<table id="tblDatos" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Clave</th>
					<th>Descripción</th>
					<th>Importe</th>
					<th>Área</th>
					<th>Fecha</th>
					{if in_array($perfil, array(2))}
						<th>&nbsp;</th>
					{/if}
				</tr>
			</thead>
			<tbody>
				{foreach from=$orden->movimientos item="row"}
				<tr
					clave="{$row->getClave()}"
					descripcion="{$row->getDescripcion()}"
					importe="{$row->getImporte()}"
					area="{$row->area->getNombre()}"
					cantidad="{$row->getCantidad()}"
					elaboracion="{$orden->getElaboracion()}"
					observaciones="{$row->getObservaciones()}"
					
					idArea="{$row->area->getId()}"
					fecha="{$row->getFecha()}"
					notasucursales="{$row->getNotasSucursales()}"
					impresiondigital="{$row->getImpresionDigital()}"
					disenador="{if $row->getDisenador() eq ''}{$PAGE.usuario->getNombre()}{else}{$row->getDisenador()}{/if}"
					fechaimpresion="{$row->getFechaImpresion()}"
					notasproduccion="{$row->getNotasProduccion()}"
					claveimpresor="{if $row->getClaveImpresor() eq ''}{$PAGE.usuario->getClave()}{else}{$row->getClaveImpresor()}{/if}"
					nombreimpresor="{if $row->getNombreImpresor() eq ''}{$PAGE.usuario->getNombre()}{else}{$row->getNombreImpresor()}{/if}"
					fechaenvio="{$row->getFechaEnvio()}"
					horaenvio="{$row->getHoraEnvio()}"
					envio="{$row->getEnvio()}"
					fecharecepcion="{$row->getFechaRecepcion()}"
					entregacliente="{$row->getEntregaCliente()}"
					notas="{$row->getNotas()}"
					
				>
					<td>{$row->getClave()}</td>
					<td>{$row->getDescripcion()}</td>
					<td class="text-right">{$row->getImporte()}</td>
					<td class="text-center">{$row->area->getNombre()}</td>
					<td>{$row->getFecha()}</td>
					{if in_array($perfil, array(2))}
						<td class="text-center">
							<a href="index.php?mod=archivosorden&orden={$row->getOrden()|escape:"url"}&clave={$row->getClave()|escape:"url"}" target="_blank"><i class="fa fa-paperclip" aria-hidden="true"></i></a>
						</td>
					{/if}
				</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
</div>
<br />

<div class="row">
	<div class="col-md-2">
		<b>Área de producción</b>
	</div>
	<div class="col-md-2">
		<input class="form-control text-right" value="" readonly disabled campo="area"/>
	</div>
	<div class="col-md-2">
		<b>Clave del artículo</b>
	</div>
	<div class="col-md-2">
		<input class="form-control text-right" value="" readonly disabled campo="clave"/>
	</div>
	<!--
	<div class="col-md-2">
		<b>Fecha elaboración
	</div>
	<div class="col-md-2">
		<input class="form-control text-right" value="" readonly disabled campo="elaboracion"/>
	</div>
	-->
</div>
<br />
<div class="row">
	<div class="col-md-2">
		<b>Cantidad</b>
	</div>
	<div class="col-md-2">
		<input class="form-control text-right" value="" readonly disabled campo="cantidad"/>
	</div>
	<div class="col-md-2">
		<b>Descripción</b>
	</div>
	<div class="col-md-6">
		<input class="form-control" value="" readonly disabled campo="descripcion"/>
	</div>
</div>
<br />
<div class="row">
	<div class="col-md-2">
		<b>Observaciones</b>
	</div>
	<div class="col-md-6">
		<input class="form-control" value="" readonly disabled campo="observaciones"/>
	</div>
</div>

<hr />
<div class="row">
	<div class="col-md-2">
		<b>Notas sucursales</b>
	</div>
	<div class="col-md-10">
		<textarea campo="notasSucursales" class="form-control" id="txtNotasSucursales"></textarea>
	</div>
</div>
<br />
<div class="row">
	<div class="col-md-4">
		<input type="checkbox" id="chkImpresionDigital" value="Si"> <b>Impresiones digitales</b>
	</div>
	<div class="col-md-2">
		<b>Diseñador</b>
	</div>
	<div class="col-md-6">
		<input class="form-control" value="" id="txtDisenador" />
	</div>
</div>
<hr />
<div class="row">
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-3">
				<b>Observaciones</b>
			</div>
			<div class="col-md-4">
				<input class="form-control" value="" campo="notas" id="txtNotas"/>
			</div>
			<div class="col-md-2">
				<b>Impresion</b>
			</div>
			<div class="col-md-3">
				<input class="form-control" value="" placeholder="YYYY-MM-DD" readonly="" campo="fechaImpresion" id="txtFechaImpresion"/>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-md-2 col-md-offset-1">
				<input type="checkbox" id="chkEnvio" value="Si"> <b>Envio</b>
			</div>
			<div class="col-md-3">
				<b>Fecha y hora</b>
			</div>
			<div class="col-md-3">
				<input class="form-control" value="" placeholder="YYYY-MM-DD" readonly campo="fechaenvio" id="txtFechaEnvio"/>
			</div>
			<div class="col-md-3">
				<select id="selHoraEnvio" class="form-control">
					<option value="11:30:00">11:30</option>
					<option value="17:30:00">17:30</option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<b>Notas de produccion</b>
		<textarea campo="notasProduccion" class="form-control" rows="4" id="txtNotasProduccion"></textarea>
	</div>
</div>
<br />
<div class="row">
	<div class="col-md-2">
		<b>Impresor</b>
	</div>
	<div class="col-md-2">
		<input class="form-control text-right" readonly disabled="true" id="txtClaveImpresor"/>
	</div>
	<div class="col-md-8">
		<input class="form-control" readonly disabled="true" value="" id="txtNombreImpresor"/>
	</div>
</div>
<hr />
<div class="row">
	<div class="col-md-3">
		<b>Fecha de recepción</b>
	</div>
	<div class="col-md-3">
		<input class="form-control text-right" readonly="true" value="" id="txtFechaRecepcion"/>
	</div>
	<div class="col-md-3">
		<b>Entrega al cliente</b>
	</div>
	<div class="col-md-3">
		<input class="form-control" readonly="true" value="" id="txtFechaEntregaCliente"/>
	</div>
</div>
<hr />
<div class="row">
	<div class="col-md-12">
		<button class="btn btn-success pull-right" id="btnGuardar">Guardar</button>
	</div>
</div>