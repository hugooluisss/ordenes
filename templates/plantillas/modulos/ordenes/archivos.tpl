<div class="panel">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-2 text-right">
				<b>Orden: </b>
			</div>
			<div class="col-md-2">
				{$orden->getCodigo()}
			</div>
		</div>
		<div class="row">
			<div class="col-md-2 text-right">
				<b>Producto: </b>
			</div>
			<div class="col-md-2">
				{$movimiento->getClave()}
			</div>
			<div class="col-md-8">
				{$movimiento->getDescripcion()}
			</div>
		</div>
	</div>
</div>

<div class="panel">
	<form id="upload2" method="post" action="?mod=cmovimientos&action=uploadfile" enctype="multipart/form-data">
		<input type="hidden" id="orden" name="orden" value="{$orden->getId()}">
		<input type="hidden" id="movimiento" name="movimiento" value="{$movimiento->getClave()}">
		<input type="file" name="upl" multiple />
		<ul class="elementos list-group">
		<!-- The file list will be shown here -->
		</ul>
	</form>
	<div class="progress">
		<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
	</div>
	<div id="listaArchivos">
	</div>
</div>