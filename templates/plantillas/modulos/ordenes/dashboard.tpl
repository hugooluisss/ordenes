<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Dashboard importación</h1>
	</div>
</div>

<div class="panel">
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-6 col-sm-4 text-center">
				<button class="btn btn-success btn-block" id="btnSAE">Consultar SAE</button>
			</div>
			<div class="col-xs-6 col-sm-4 text-center">
				<button class="btn btn-default btn-block" id="btnActualizar">Actualizar</button>
			</div>
			<div class="col-xs-6 col-sm-4 text-center">
				<button class="btn btn-default btn-block" data-toggle="modal" data-target="#winEmpresas">Empresas</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="winEmpresas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Empresas</h4>
			</div>
			<div class="modal-body">
				{foreach from=$empresas item="row"}
					<div class="checkbox">
						<label><input type="checkbox" value="idRazon">{$row.clave}</label>
					</div>
				{/foreach}
			</div>
		</div>
	</div>
</div>