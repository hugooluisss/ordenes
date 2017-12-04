<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Importación remota</h1>
	</div>
</div>

<div class="panel">
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-2 text-right">
				<label for="selRazon">Razón social</label>
			</div>
			<div class="col-xs-6">
				<select id="selRazon" name="selRazon" class="form-control">
					{foreach from=$lista item="row"}
						<option value="{$row.idRazon}" empresa="{$row.numero}" consecutivo="{$row.consecutivo}">{$row.clave}</option>
					{/foreach}
				</select>
			</div>
			<div class="col-xs-4">
				<button id="btnEnviar" class="btn btn-success">Enviar</button>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				Última orden importada: <span campo="ultimaOrden"></span>
			</div>
		</div>
	</div>
</div>

<div id="dvLista"></div>