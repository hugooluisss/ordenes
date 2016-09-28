<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Importación de ordenes</h1>
	</div>
</div>
<div class="panel">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12 text-center">
				<button class="btn btn-danger" id="btnUpload"><i class="fa fa-upload" aria-hidden="true"></i> Subir archivo</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12" id="datos">
				
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="winUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1>Archivo de importación</h1>
			</div>
			<div class="modal-body">
				<form id="upload" method="post" action="index.php?mod=cordenes&action=uploadfile" enctype="multipart/form-data">
					<input type="file" name="upl" multiple />
				</form>
			</div>
		</div>
	</div>
</div>