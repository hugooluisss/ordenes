<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Importación de ordenes</h1>
	</div>
</div>
<div class="panel">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12 text-center">
				<table id="tblRazones" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Clave</th>
							<th>Ultimo importado</th>
							<th>Rango ODTs</th>
							<th>Última orden</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						{foreach from=$razonesSociales item="row"}
							<tr>
								<td>{$row.clave}</td>
								<td>{if $row.ultimaImportacion.momento eq ''}Nunca{else}{$row.ultimaImportacion.momento}{/if}</td>
								<td>{$row.ultimaImportacion.inicio} - {$row.ultimaImportacion.fin}</td>
								<td>{$row.consecutivo}</td>
								<td>
									<button class="btn btn-danger btnUpload" razonSocial="{$row.idRazon}"><i class="fa fa-upload" aria-hidden="true"></i> Subir archivo</button>
								</td>
							</tr>
						{/foreach}
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="winUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1>Archivo de importación</h1>
			</div>
			<div class="modal-body">
				<div class="alert alert-info">
					<strong>Importando!</strong> Se está analizando el archivo, por favor espera.
				</div>
				<form id="upload" method="post" action="index.php?mod=cordenes&action=uploadfile" enctype="multipart/form-data">
					<input type="file" name="upl" multiple />
				</form>
				<div class="row">
					<div class="col-md-12" id="datos">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>