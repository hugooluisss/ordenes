<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Dashboard importación</h1>
	</div>
</div>


<ul id="panelTabs" class="nav nav-tabs">
	{foreach from=$empresas item="row" name="empresas"}
	<li {if $smarty.foreach.empresas.first}class="active"{/if}><a data-toggle="tab" href="#empresa{$row.idRazon}">{$row.clave}</a></li>
	{/foreach}
</ul>

<div class="tab-content">
	{foreach from=$empresas item="row" name="empresas"}
	<div id="empresa{$row.idRazon}" class="tab-pane fade {if $smarty.foreach.empresas.first}in active{/if}">
		<div class="box">
			<div class="box-body">
				<table id="tblEmpresa{$row.idRazon}" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Orden</th>
							<th>Fecha</th>
							<th>Mensaje</th>
						</tr>
					</thead>
					<tbody>
						{foreach from=$row.importacion item="imp"}
						
							<tr>
								<td style="border-left: 4px solid {if $imp.estado eq 0}red{else}blue{/if}">{$imp.codigo}</td>
								<td>{$imp.fecha}</td>
								<td>{$imp.mensaje}</td>
							</tr>
						{/foreach}
					</tbody>
				</table>
			</div>
		</div>
	</div>
	{/foreach}
</div>