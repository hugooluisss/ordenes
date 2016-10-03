<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Ordenes</h1>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-body">
		{if $PAGE.usuario->getIdTipo() eq 1}
			<form role="form" id="frmBuscar" class="form-horizontal" onsubmit="javascript: return false;">
				<div class="form-group">
					<label for="selSucursal" class="col-lg-2">Sucursal</label>
					<div class="col-lg-3">
						<select class="form-control" id="selSucursal" name="selSucursal">
							{foreach item=item from=$sucursales}
								<option value="{$item.idSucursal}" {if $PAGE.usuario->sucursal->getId() eq $item.idSucursal}selected{/if}>{$item.nombre}</option>
							{/foreach}
						</select>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-info pull-right">Buscar</button>
					<input type="hidden" id="id"/>
				</div>
			</form>
		{else}
			<div class="row" style="margin-left: 10px;"> <!--style="border: 1px solid #3c8dbc; margin: 5px auto;" -->
				<div class="col-md-2 text-center" style="color: {$PAGE.usuario->sucursal->getColor()}; background: #ecf0f5;">
					<i class="fa fa-tag fa-5x" aria-hidden="true"></i>
					<br />
					{$PAGE.usuario->sucursal->getnombre()}
				</div>
				<div class="col-md-6">
					<h1 style="color: #3c8dbc">Orden de servicio</h1>
				</div>
			</div>
		{/if}
	</div>
</div>
<div id="dvLista"></div>

<div class="modal fade" id="winOrden" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">
				
			</div>
		</div>
	</div>
</div>