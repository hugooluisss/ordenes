<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Importación automática de ordenes</h1>
	</div>
</div>

<div class="panel">
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12">
				<select id="selSucursal" name="selSucursal" class="form-control">
					{foreach from=$lista item="row"}
						<option value="{$row.idSucursal}">{$row.nombre}</option>
					{/foreach}
				</select>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-xs-12 text-right">
				<button id="btnEnviar" class="btn btn-success">Enviar</button>
			</div>
		</div>
	</div>
</div>

<div id="dvLista"></div>