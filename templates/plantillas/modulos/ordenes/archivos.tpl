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
	<div class="alert alert-danger">
		<b>No cierres la ventana</b>
		<p>En este momento el sistema está subiendo el o los archivos que indicaste, no cierres la ventana para no interrumpir el proceso</p>
	</div>
	<br />
	<div class="progress">
		<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
	</div>
	
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#listaArchivos">Lista de archivos</a></li>
		<li><a data-toggle="tab" href="#log" {if in_array($PAGE.usuario->getIdTipo(), array(3)) or $orden->estado->getId() eq 2}class="hide"{/if}>Subir</a></li>
	</ul>
	
	<div class="tab-content">
		<div id="listaArchivos" class="tab-pane fade in active">
			
		</div>
		<div id="log" class="tab-pane fade">
			<br />
			<form id="upload2" method="post" action="?mod=cmovimientos&action=uploadfile" enctype="multipart/form-data">
				<input type="hidden" id="orden" name="orden" value="{$orden->getId()}">
				<input type="hidden" id="movimiento" name="movimiento" value="{$movimiento->getClave()}">
				<input type="file" name="upl" multiple />
				<ul class="elementos list-group">
				<!-- The file list will be shown here -->
				</ul>
			</form>
			<div id="historial"></div>
		</div>
	</div>
</div>