<div id="icon-edit" class="icon32"><br /></div>
<!-- El título -->
	<h2>Convocatorias</h2>

<br />	
<h3>Lista de Convocatorias</h3>

<table class="widefat post fixed" cellspacing="0" style="width:80%;">
	<thead>
	<tr>
		<th scope="col" id="lNombre"  class="manage-column column-nombre" style="width:100px;">Email</th>	
		<th scope="col" id="lApellido1"  class="manage-column column-apellido" style="width:100px;">Nombre</th>
		<th scope="col" id="lApellido2" class="manage-column column-apellido" style="width:100px;">Cargo</th>
		<th scope="col" id="lApellido2" class="manage-column column-web" style="width:150px;">Convocatoria</th>	
		<th scope="col" id="lApellido2" class="manage-column column-fechaAlta" style="width:150px;">Fecha</th>	
		<th scope="col" id="lApellido2" class="manage-column column-fechaAlta" style="width:150px;">Borrar</th>
	</tr>
	</thead>

	<tfoot>
	<tr>
		<th scope="col" id="lNombre"  class="manage-column column-nombre" style="width:100px;">Email</th>	
		<th scope="col" id="lApellido1"  class="manage-column column-apellido" style="width:100px;">Nombre</th>
		<th scope="col" id="lApellido2" class="manage-column column-apellido" style="width:100px;">Cargo</th>
		<th scope="col" id="lApellido2" class="manage-column column-web" style="width:150px;">Convocatoria</th>	
		<th scope="col" id="lApellido2" class="manage-column column-fechaAlta" style="width:150px;">Fecha</th>
		<th scope="col" id="lApellido2" class="manage-column column-fechaAlta" style="width:150px;">Borrar</th>
	</tr>
	</tfoot>

	<tbody>
	<?php

		if(isset($_POST["convo"]))
		{
			   borrarConvo($_POST["convo"]);
		} 


	
  
		$clientes = getListaClientes();
		foreach ($clientes as $cliente){
				echo '<tr id="" class="alternate author-self status-publish iedit" valign="top">
						<td class="categories column-nombre">
							'.$cliente->nombre .'
						</td>
						<td class="categories column-apellido1">
							'.$cliente->apellido1 .'
						</td>
						<td class="categories column-apellido2">
							'.$cliente->apellido2 .'
						</td>
						<td class="categories column-web">
							<div style="max-height: 150px !important; overflow: auto;">
								'.$cliente->web .'
							</div>
						</td>
						<td class="categories column-fechaAlta">
							'.$cliente->fechaAlta .'
						</td>
						<td class="categories column-borrar">
							
							<form method="post" action="admin.php?page=Convocatorias/panel.php">
								<input type="hidden" name="convo" value="'.$cliente->IDCliente .'">
								<input type="submit" value="Borrar">
							</form>
						</td>
					</tr>';
 	

	
	
		}
	?>		
	
	



	
	
	</tbody>
</table>	