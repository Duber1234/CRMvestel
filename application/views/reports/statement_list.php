<style>
  /* Cambios sobre la propia tabla */
  table {
    border-collapse: collapse;
    border: 1px solid #5F5F5F;
	  width: 80%;
  }
  /* Espacio de relleno en celdas y cabeceras */
  td,
  th {
    padding: 10px;
  }
  /* Modificación de estilos en cabeceras */
  th {
    background: #555;
    color: #fff;
    text-transform: uppercase;
	  text-align: center;
	  font-size: 14px;
  }
  /* Modificación de estilos en celdas */
  td {   
    border-bottom: 2px solid #111;
    color: #333;
    font-size: 12px;
  }
	/* Modificación de estilos en celdas */
  . {
    text-align: left;
    border-bottom: 2px solid #111;
    color: #333;
    font-size: 12px;
  }
	.cen
	{
		text-align: left;
	}
	/* Modificación de estilos en pie de tabla */
  .pie {
    background:#E1E1E1;
    color: #000000;
    text-transform: uppercase;
	text-align: center;
	  font-size: 10px;
  }
.sub {
	color: #000000;
    text-transform: uppercase;
	text-align: center;
	  font-size: 10px;
	font-weight: bold;
  }
</style>
<?php 
	$array_afiliaciones=array();
	$var_cuenta_planes=array("1Mega"=>0,"2Megas"=>0,"3Megas"=>0,"5Megas"=>0,"10Megas"=>0,"Television"=>0); 
	$var_cuenta_planes_montos=array("1MegaMonto"=>0,"2MegasMonto"=>0,"3MegasMonto"=>0,"5MegasMonto"=>0,"10MegasMonto"=>0,"TelevisionMonto"=>0); 
//tabla total cobranza
	//productos con iva
		$cuantos_prod_con_iva_hay=0;
		$monto_prod_con_iva_hay=0;
		$monto_iva_prod_con_iva_hay=0;

	//end productos con iva

	//productos sin iva
		$cuantos_prod_sin_iva_hay=0;
		$monto_prod_sin_iva_hay=0;
	//end productos sin iva
//end tabla total cobranza
		$array_reconexiones=array('cantidad' =>0 ,"monto"=>0 );
		$array_bancos=array("Bancolombia" => array('cantidad' => 0,"monto"=>0 ),"BBVA"=>array('cantidad' => 0,"monto"=>0 ));
		$array_resumen_tipo_servicio= array('Internet' => array('cantidad' => 0,"monto"=>0 ),"Television"=> array('cantidad' => 0,"monto"=>0 ));
		$array_efectivo=array("cantidad"=>0,"monto"=>0);

		foreach ($lista as $key => $value) { 
			$invoice = $this->db->get_where("invoices",array("tid"=>$value['tid']))->row(); 
			$invoice_items=$this->db->get_where('invoice_items',array('tid' =>$value['tid']))->result_array();
//resumen por cobranza
			if($invoice->tax==0){
				$monto_prod_sin_iva_hay+=intval($value['credit']);
				$cuantos_prod_sin_iva_hay++;
			}else{
				$cuantos_prod_con_iva_hay++;
				if($value['credit']!=0){
					$valor_parcial=intval($value['credit']);
					$valor_total=intval($invoice->total);
					$cuanto_porcentaje=($valor_parcial*100)/$valor_total;
					$cuanto_iva=intval($invoice->tax);
					$cuanto_iva=($cuanto_iva*$cuanto_porcentaje)/100;
					$cuanto_iva=intval($cuanto_iva);
					
					$valor_parcial=$valor_parcial-$cuanto_iva;
					//montos
					$monto_prod_con_iva_hay+=$valor_parcial;
					$monto_iva_prod_con_iva_hay+=$cuanto_iva;
				}
			}
//end resumen por cobranza
			$sumatoria_items=0;
			$items_tocados=array();
			foreach ($invoice_items as $key => $item_invoic) {
				$valor_parcial=intval($value['credit']);
				$valor_total=intval($invoice->total);
				$valor_item=intval($item_invoic['subtotal']);
				//para la Resumen por Servicios
				if($item_invoic['product']=="1Mega" ||$item_invoic['product']=="1 Mega"){
			 		$var_cuenta_planes['1Mega']++;
			 		if($value['credit']!=0){
			 					
			 			$cuanto_porcentaje_item_en_invoice=($valor_item*100)/$valor_total;
			 			$valor_item=($valor_parcial*$cuanto_porcentaje_item_en_invoice)/100;
			 			$var_cuenta_planes_montos['1MegaMonto']+=$valor_item;	
			 			$sumatoria_items+=$valor_item;
			 			$items_tocados['1MegaMonto']=true;
			 		}
			 		

			 		
			 		//resumen tipo servicio
			 		$array_resumen_tipo_servicio['Internet']['cantidad']++;
			 		$array_resumen_tipo_servicio['Internet']['monto']+=intval($item_invoic['subtotal']);

				}else if($item_invoic['product']=="2Megas" ||$item_invoic['product']=="2 Megas"){
					$var_cuenta_planes['2Megas']++;

					if($value['credit']!=0){
			 					
			 			$cuanto_porcentaje_item_en_invoice=($valor_item*100)/$valor_total;
			 			$valor_item=($valor_parcial*$cuanto_porcentaje_item_en_invoice)/100;
			 			$var_cuenta_planes_montos['2MegasMonto']+=$valor_item;	
			 			$sumatoria_items+=$valor_item;
			 			$items_tocados['2MegasMonto']=true;
			 		}

					

					//resumen tipo servicio
			 		$array_resumen_tipo_servicio['Internet']['cantidad']++;
			 		$array_resumen_tipo_servicio['Internet']['monto']+=intval($item_invoic['subtotal']);

				}else if($item_invoic['product']=="3Megas"|| $item_invoic['product']=="3 Megas"){
					$var_cuenta_planes['3Megas']++;
					if($value['credit']!=0){
			 					
			 			$cuanto_porcentaje_item_en_invoice=($valor_item*100)/$valor_total;
			 			$valor_item=($valor_parcial*$cuanto_porcentaje_item_en_invoice)/100;
			 			$var_cuenta_planes_montos['3MegasMonto']+=$valor_item;	
			 			$sumatoria_items+=$valor_item;
			 			$items_tocados['3MegasMonto']=true;
			 		}

					//resumen tipo servicio
			 		$array_resumen_tipo_servicio['Internet']['cantidad']++;
			 		$array_resumen_tipo_servicio['Internet']['monto']+=intval($item_invoic['subtotal']);

				}else if($item_invoic['product']=="5Megas"||$item_invoic['product']=="5 Megas"){
					$var_cuenta_planes['5Megas']++;
					if($value['credit']!=0){
			 					
			 			$cuanto_porcentaje_item_en_invoice=($valor_item*100)/$valor_total;
			 			$valor_item=($valor_parcial*$cuanto_porcentaje_item_en_invoice)/100;
			 			$var_cuenta_planes_montos['5MegasMonto']+=$valor_item;	
			 			$sumatoria_items+=$valor_item;
			 			$items_tocados['5MegasMonto']=true;
			 		}

					//resumen tipo servicio
			 		$array_resumen_tipo_servicio['Internet']['cantidad']++;
			 		$array_resumen_tipo_servicio['Internet']['monto']+=intval($item_invoic['subtotal']);

				}else if($item_invoic['product']=="10Megas"||$item_invoic['product']=="10 Megas"){
					$var_cuenta_planes['10Megas']++;
					if($value['credit']!=0){
			 					
			 			$cuanto_porcentaje_item_en_invoice=($valor_item*100)/$valor_total;
			 			$valor_item=($valor_parcial*$cuanto_porcentaje_item_en_invoice)/100;
			 			$var_cuenta_planes_montos['10MegasMonto']+=$valor_item;	
			 			$sumatoria_items+=$valor_item;
			 			$items_tocados['10MegasMonto']=true;
			 		}

					//resumen tipo servicio
			 		$array_resumen_tipo_servicio['Internet']['cantidad']++;
			 		$array_resumen_tipo_servicio['Internet']['monto']+=intval($item_invoic['subtotal']);

				}else if(strpos(strtolower($item_invoic['product']), "reconexi")!==false){
					$array_reconexiones['cantidad']++;
					if($value['credit']!=0){
			 					
			 			$cuanto_porcentaje_item_en_invoice=($valor_item*100)/$valor_total;
			 			$valor_item=($valor_parcial*$cuanto_porcentaje_item_en_invoice)/100;
						$array_reconexiones['monto']+=$valor_item;
						$sumatoria_items+=$valor_item;
						$items_tocados['array_reconexiones']="monto";
			 		}
					
				}else{
					if(strpos(strtolower($item_invoic['product']), "afilia")!==false ){
						if($value['credit']!=0){
					 					
					 			$cuanto_porcentaje_item_en_invoice=($valor_item*100)/$valor_total;
					 			$valor_item=($valor_parcial*$cuanto_porcentaje_item_en_invoice)/100;
					 		
						$cuenta_afiliacion=1;
						$monto_afiliacion=0;
						if(isset($array_afiliaciones[$item_invoic['product']])) {
							$array_afiliaciones[$item_invoic['product']]['cuenta_afiliacion']++;
							$array_afiliaciones[$item_invoic['product']]['monto_afiliacion']+=$valor_item;
						}else{
							$array_afiliaciones[$item_invoic['product']]=array('cuenta_afiliacion' => intval($cuenta_afiliacion),"monto_afiliacion"=> $valor_item);
						}
						$sumatoria_items+=$valor_item;
						$items_tocados['array_afiliaciones']=$item_invoic['product'];
					  }

					}else if(strpos(strtolower($item_invoic['product']), "tele")!==false){
							$var_cuenta_planes['Television']++;
							if($value['credit']!=0){
					 					
					 			$cuanto_porcentaje_item_en_invoice=($valor_item*100)/$valor_total;
					 			$valor_item=($valor_parcial*$cuanto_porcentaje_item_en_invoice)/100;
					 			$var_cuenta_planes_montos['TelevisionMonto']+=$valor_item;	
					 			$sumatoria_items+=$valor_item;
					 			$items_tocados['TelevisionMonto']=true;
					 		}
					}else{
						if($value['credit']!=0){
					 					
					 		if($valor_item!=0){
					 			$items_tocados['array_afiliaciones']=$item_invoic['product'];
					 		}
						 			$cuanto_porcentaje_item_en_invoice=($valor_item*100)/$valor_total;
						 			$valor_item=($valor_parcial*$cuanto_porcentaje_item_en_invoice)/100;
						 		
							$cuenta_afiliacion=1;
							$monto_afiliacion=0;
							if(isset($array_afiliaciones[$item_invoic['product']])) {
								$array_afiliaciones[$item_invoic['product']]['cuenta_afiliacion']++;
								$array_afiliaciones[$item_invoic['product']]['monto_afiliacion']+=$valor_item;
							}else{
								$array_afiliaciones[$item_invoic['product']]=array('cuenta_afiliacion' => intval($cuenta_afiliacion),"monto_afiliacion"=> $valor_item);
							}
							$sumatoria_items+=$valor_item;

						}

						/*saldo anterior se muestra aqui*/
					}
					
				}
				

				

				//resumen por tipo servicio
				if(strpos(strtolower($item_invoic['product']), "tele")!==false){
					$array_resumen_tipo_servicio['Television']['cantidad']++;
					$array_resumen_tipo_servicio['Television']['monto']+=intval($item_invoic['subtotal']);
				}else if(strpos(strtolower($item_invoic['product']), "afilia")!==false){
					$array_resumen_tipo_servicio['Internet']['cantidad']++;
			 		$array_resumen_tipo_servicio['Internet']['monto']+=intval($item_invoic['subtotal']);
				}
				//end resumen por tipo servicio
				// esto hasta la llave de cierre se borra solo es prueba
				$valor_parcial=intval($value['credit']);
				$valor_total=intval($invoice->total);
				$valor_item=intval($item_invoic['subtotal']);
				if($value['credit']!=0){
					 					
					 			$cuanto_porcentaje_item_en_invoice=($valor_item*100)/$valor_total;
					 			$valor_item=($valor_parcial*$cuanto_porcentaje_item_en_invoice)/100;
					 			$var_prueba3+=$valor_item;	
					 			
					 		}
					 		//var_dump("prue = ".$var_prueba3);
			}
			if($sumatoria_items<$value['credit'] ){
				$diference=$value['credit']-$sumatoria_items;
				if($diference>1){
					$conteo=count($items_tocados);
					$valores_por_cada_uno=$diference/$conteo;
					foreach ($items_tocados as $key1 => $value2) {
						if($key1=="array_reconexiones"){
							$array_reconexiones['monto']+=$valores_por_cada_uno;
						}else if($key1=="array_afiliaciones"){
							$array_afiliaciones[$value2]['monto_afiliacion']+=$valores_por_cada_uno;
						}else{
							$var_cuenta_planes_montos[$key1]+=$valores_por_cada_uno;
						}
					}
					var_dump($items_tocados);
					//var_dump("sum = ".$sumatoria_items." | credit=".$value['credit']." id=".$value['tid']);	
				}

				$items_tocados=array();
				
			}else if($sumatoria_items>$value['credit'] ){
				//falta programar este pedaso de cuando los items suman mas que el valor de la factura OJO
				//OJO
				//OJO
				//OJO
				//OJO 
				var_dump("sum = ".$sumatoria_items." | credit=".$value['credit']." id=".$value['tid']);	
			}
			
			/*$ticket = $this->db->select("*")->from('tickets')->where("id_invoice=".$value['tid']." or id_factura=".$value['tid'])->get();
			//$varx =$ticket->result();
			
			if(strpos(strtolower($varx[0]->detalle),'reconexi')!==false){
					//$array_reconexiones['cantidad']++;
					//$array_reconexiones['monto']+=$value['credit'];
			}*/

			if($value['method']=="Bank"){
				if($value['nombre_banco']=="Bancolombia"){
					$array_bancos['Bancolombia']['cantidad']++;
					$array_bancos['Bancolombia']['monto']+=intval($value['credit']);
				}else{
					$array_bancos['BBVA']['cantidad']++;
					$array_bancos['BBVA']['monto']+=intval($value['credit']);
				}
			}else if($value['method']=="Cash"){
				$array_efectivo['cantidad']++;
				$array_efectivo['monto']+=intval($invoice->subtotal);
			}


			//$var_prueba1+=intval($value['credit']);
			//var_dump("TID= ".$invoice->tid."  ValorTotal =".$var_prueba1." valor_invoice=".$invoice->total);
		 } 
 			//var_dump($var_prueba1);
		 //tabla 1
		 $tabla_total_cobranza_monto=$monto_prod_sin_iva_hay+$monto_prod_con_iva_hay+$monto_iva_prod_con_iva_hay;
		//end tabla 1
			//tabla 3 Resumen por Servicios
			$var_cantidad_mensualidades=$var_cuenta_planes['1Mega']+$var_cuenta_planes['2Megas']+$var_cuenta_planes['3Megas']+$var_cuenta_planes['5Megas']+$var_cuenta_planes['10Megas']+$var_cuenta_planes['Television'];
			$var_total_mensualidades=$var_cuenta_planes_montos['1MegaMonto']+$var_cuenta_planes_montos['2MegasMonto']+$var_cuenta_planes_montos['3MegasMonto']+$var_cuenta_planes_montos['5MegasMonto']+$var_cuenta_planes_montos['10MegasMonto']+$var_cuenta_planes_montos['TelevisionMonto'];
			//end tabla 3 Resumen por Servicios
			
			//sobre afiliaciones


			//end sobre afiliaciones
		 	
		 	//tabla resumen por servicios total final

		 
		 ?>

<article class="content">
	<form method="POST" action="<?=base_url()?>reports/sacar_pdf" target="_blank">
		<input type="hidden" name="pay_acc" value="<?=$datos_informe['pay_acc']?>" >
		<input type="hidden" name="trans_type" value="<?=$datos_informe['trans_type']?>">
		<input type="hidden" name="sdate" value="<?=$datos_informe['sdate']?>">
		<input type="hidden" name="edate" value="<?=$datos_informe['edate']?>">

		<button class="btn btn-primary" style="margin-left: 3px;">Sacar Pdf</button>
	
	</form>
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
		 <div class="card card-block">

        
            <h6><?php echo $this->lang->line('') ?>Estado de Caja</h6>
			 <hr>
            <p><?php echo $this->lang->line('') ?>Caja : <?php echo $filter[5] ?></p>
            <hr>
			 <div class="col-sm-6">
			<h6><?php echo $this->lang->line('') ?>Resumen Cobranza</h6>
				 
			<table class="party">
				<thead>
					<tr>
						<th>DESCRIPCION</th><th>CANT</th><th>MONTO</th>	
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Excento</td><td style="text-align: center"><?=$cuantos_prod_sin_iva_hay?></td><td style="text-align: center"><?="$ ".number_format($monto_prod_sin_iva_hay,0,",",".")?></td>
					</tr>
					<tr>
						<td>Base</td><td style="text-align: center"><?=$cuantos_prod_con_iva_hay?></td><td style="text-align: center"><?="$ ".number_format($monto_prod_con_iva_hay,0,",",".")?></td>
					</tr>
					<tr>
						<td>iva</td><td style="text-align: center"><?=$cuantos_prod_con_iva_hay?></td><td style="text-align: center"><?="$ ".number_format($monto_iva_prod_con_iva_hay,0,",",".")?></td>
					</tr>
					
				</tbody>
				<tfoot>
					<tr>
						<th class="pie">TOTAL COBRANZA</th>
						<th class="pie"><?=$cuantos_prod_sin_iva_hay+$cuantos_prod_con_iva_hay?></th>
						<th class="pie"><?="$ ".number_format($tabla_total_cobranza_monto,0,",",".")?></th>			
					</tr>
				</tfoot>
			</table>
			<hr>
			<h6><?php echo $this->lang->line('') ?>Resumen por Banco</h6>
			<table class="party">
				<thead>
					<tr>
						<th>DESCRIPCION</th>
						<th>CANT</th>
						<th>MONTO</th>			
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Bancolombia</td>
						<td style="text-align: center"><?=$array_bancos['Bancolombia']['cantidad']?></td>
						<td style="text-align: center"><?="$ ".number_format($array_bancos['Bancolombia']['monto'],0,",",".")?></td>
					</tr>
					<tr>
						<td>BBVA colombia</td>
						<td style="text-align: center"><?=$array_bancos['BBVA']['cantidad']?></td>
						<td style="text-align: center"><?="$ ".number_format($array_bancos['BBVA']['monto'],0,",",".")?></td>
					</tr>					
				</tbody>
				<tfoot>
					<tr>
						<th class="pie">TOTAL COBRANZA</th>
						<th class="pie"><?= $array_bancos['Bancolombia']['cantidad']+$array_bancos['BBVA']['cantidad'] ?></th>
						<th class="pie"><?= "$ ".number_format($array_bancos['Bancolombia']['monto']+$array_bancos['BBVA']['monto'],0,",",".") ?></th>			
					</tr>
				</tfoot>
			</table>
			<hr>
			<h6><?php echo $this->lang->line('') ?>Resumen por Servicios</h6>
			<table class="party">
				<thead>
					<tr>
						<th>DESCRIPCION</th>
						<th>CANT</th>
						<th>MONTO</th>			
					</tr>
				</thead>
				<tbody>

					
					<?php if($var_cuenta_planes['1Mega']!=0){  ?>
					<tr>
						<td>Internet 1MG</td>
						<td style="text-align: center"><?=$var_cuenta_planes['1Mega']?></td>
						<td style="text-align: center"><?="$ ".number_format($var_cuenta_planes_montos['1MegaMonto'],0,",",".")?></td>
					</tr>
					<?php } ?>
					<?php if($var_cuenta_planes['2Megas']!=0){  ?>
					<tr>
						<td>Internet 2MG</td>
						<td style="text-align: center"><?=$var_cuenta_planes['2Megas']?></td>
						<td style="text-align: center"><?="$ ".number_format($var_cuenta_planes_montos['2MegasMonto'],0,",",".")?></td>
					</tr>
					<?php } ?>
					<?php if($var_cuenta_planes['3Megas']!=0){  ?>
					<tr>
						<td>Internet 3MG</td>
						<td style="text-align: center"><?=$var_cuenta_planes['3Megas']?></td>
						<td style="text-align: center"><?="$ ".number_format($var_cuenta_planes_montos['3MegasMonto'],0,",",".")?></td>
					</tr>
					<?php } ?>
					<?php if($var_cuenta_planes['5Megas']!=0){  ?>
					<tr>
						<td>Internet 5MG</td>
						<td style="text-align: center"><?=$var_cuenta_planes['5Megas']?></td>
						<td style="text-align: center"><?="$ ".number_format($var_cuenta_planes_montos['5MegasMonto'],0,",",".")?></td>
					</tr>
					<?php } ?>
					<?php if($var_cuenta_planes['10Megas']!=0){  ?>
					<tr>
						<td>Internet 10MG</td>
						<td style="text-align: center"><?=$var_cuenta_planes['10Megas']?></td>
						<td style="text-align: center"><?="$ ".number_format($var_cuenta_planes_montos['10MegasMonto'],0,",",".")?></td>
					</tr>
					<?php } ?>
					<?php if($var_cuenta_planes['Television']!=0){  ?>
					<tr>
						<td>Television</td>
						<td style="text-align: center"><?=$var_cuenta_planes['Television']?></td>
						<td style="text-align: center"><?="$ ".number_format($var_cuenta_planes_montos['TelevisionMonto'],0,",",".")?></td>
					</tr>
					<?php } ?>
					<tr>
						<th class="pie">TOTAL MENSUALIDADES</th>
						<th class="pie"><?=$var_cantidad_mensualidades?></th>
						<th class="pie"><?="$ ".number_format($var_total_mensualidades,0,",",".") ?></th>			
					</tr>
					<?php 
					$var_cuenta_afiliaciones=0;
					$var_monto_afiliaciones=0;
					foreach ($array_afiliaciones as $key => $afiliacion) { 
						$var_cuenta_afiliaciones+=$afiliacion['cuenta_afiliacion'];
						$var_monto_afiliaciones+=$afiliacion['monto_afiliacion'];
						?>
					<tr>
						<td><?=$key?></td>
						<td style="text-align: center"><?=$afiliacion['cuenta_afiliacion']?></td>
						<td style="text-align: center"><?="$ ".number_format($afiliacion['monto_afiliacion'],0,",",".")?></td>
					</tr>
					<?php } ?>
					<tr>
						<td class="sub">Total Ventas</td>
						<td class="sub"><?=$var_cuenta_afiliaciones?></td>
						<td class="sub"><?="$ ".number_format($var_monto_afiliaciones,0,",",".")?></td>
					</tr>
					<tr>
						<td class="sub">Total Reconexiones</td>
						<td class="sub"><?=$array_reconexiones['cantidad']?></td>
						<td class="sub"><?="$ ".number_format($array_reconexiones['monto'],0,",",".")?></td>
					</tr>
					<tr>
						<td class="sub">Total Materiales</td>
						<td class="sub">0</td>
						<td class="sub">0</td>
					</tr>
					<tr>
						<td class="sub">Total Otros</td>
						<td class="sub">0</td>
						<td class="sub">0</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<?php $var_total_resumen_por_servicios=$var_total_mensualidades+$var_monto_afiliaciones+$array_reconexiones['monto']; ?>
						<th class="pie">TOTAL</th>
						<th class="pie"><?=$var_cantidad_mensualidades+$var_cuenta_afiliaciones+$array_reconexiones['cantidad']?></th>
						<th class="pie"><?= "$ ".number_format($var_total_resumen_por_servicios,0,",",".") ?></th>			
					</tr>
				</tfoot>
			</table>
			<hr>
			<h6><?php echo $this->lang->line('') ?>Resumen de cargos cobrados por meses</h6>
			<table class="party">
				<thead>
					<tr>
						<th>DESCRIPCION</th>
						<th>CANT</th>
						<th>MONTO</th>			
					</tr>
				</thead>
				<tbody>
					<?php 
					$valores_mes_actual= array('cantidad' =>0 , 'monto'=>0,'Internet'=> array('cantidad' => 0,"monto"=>0),"Television"=> array('cantidad' =>0 ,"monto"=>0 ));
					$valores_mes_anterior= array('cantidad' =>0 , 'monto'=>0,'Internet'=> array('cantidad' => 0,"monto"=>0),"Television"=> array('cantidad' =>0 ,"monto"=>0 ));

					foreach ($lista_mes_actual as $key => $val1) {
						$inv1 = $this->db->get_where("invoices",array("tid"=>$val1['tid']))->row(); 
						$valores_mes_actual['monto']+=intval($inv1->subtotal);

						$invoice_items = $this->db->get_where("invoice_items",array('tid' => $val1['tid'] ))->result_array();
						foreach ($invoice_items as $key => $item_invoic) {
							if($item_invoic['product']=="1Mega" ||$item_invoic['product']=="1 Mega"){
						 		$valores_mes_actual['Internet']['cantidad']++;
						 		$valores_mes_actual['Internet']['monto']+=intval($item_invoic['subtotal']);

							}else if($item_invoic['product']=="2Megas" ||$item_invoic['product']=="2 Megas"){
								$valores_mes_actual['Internet']['cantidad']++;
						 		$valores_mes_actual['Internet']['monto']+=intval($item_invoic['subtotal']);

							}else if($item_invoic['product']=="3Megas"|| $item_invoic['product']=="3 Megas"){
								$valores_mes_actual['Internet']['cantidad']++;
						 		$valores_mes_actual['Internet']['monto']+=intval($item_invoic['subtotal']);

							}else if($item_invoic['product']=="5Megas"||$item_invoic['product']=="5 Megas"){
								$valores_mes_actual['Internet']['cantidad']++;
						 		$valores_mes_actual['Internet']['monto']+=intval($item_invoic['subtotal']);

							}else if($item_invoic['product']=="10Megas"||$item_invoic['product']=="10 Megas"){
								$valores_mes_actual['Internet']['cantidad']++;
						 		$valores_mes_actual['Internet']['monto']+=intval($item_invoic['subtotal']);
							}

							if(strpos(strtolower($item_invoic['product']), "tele")!==false){
								$valores_mes_actual['Television']['cantidad']++;
								$valores_mes_actual['Television']['monto']+=intval($item_invoic['subtotal']);
							}else if(strpos(strtolower($item_invoic['product']), "afilia")!==false){
								$valores_mes_actual['Internet']['cantidad']++;
						 		$valores_mes_actual['Internet']['monto']+=intval($item_invoic['subtotal']);
							}

						}
					}

					foreach ($lista_mes_anterior as $key => $val1) {
						$inv1 = $this->db->get_where("invoices",array("tid"=>$val1['tid']))->row(); 
						$valores_mes_anterior['monto']+=intval($inv1->subtotal);

						$invoice_items = $this->db->get_where("invoice_items",array('tid' => $val1['tid'] ))->result_array();

						foreach ($invoice_items as $key => $item_invoic) {
							if($item_invoic['product']=="1Mega" ||$item_invoic['product']=="1 Mega"){
						 		$valores_mes_anterior['Internet']['cantidad']++;
						 		$valores_mes_anterior['Internet']['monto']+=intval($item_invoic['subtotal']);

							}else if($item_invoic['product']=="2Megas" ||$item_invoic['product']=="2 Megas"){
								$valores_mes_anterior['Internet']['cantidad']++;
						 		$valores_mes_anterior['Internet']['monto']+=intval($item_invoic['subtotal']);

							}else if($item_invoic['product']=="3Megas"|| $item_invoic['product']=="3 Megas"){
								$valores_mes_anterior['Internet']['cantidad']++;
						 		$valores_mes_anterior['Internet']['monto']+=intval($item_invoic['subtotal']);

							}else if($item_invoic['product']=="5Megas"||$item_invoic['product']=="5 Megas"){
								$valores_mes_anterior['Internet']['cantidad']++;
						 		$valores_mes_anterior['Internet']['monto']+=intval($item_invoic['subtotal']);

							}else if($item_invoic['product']=="10Megas"||$item_invoic['product']=="10 Megas"){
								$valores_mes_anterior['Internet']['cantidad']++;
						 		$valores_mes_anterior['Internet']['monto']+=intval($item_invoic['subtotal']);
							}

							if(strpos(strtolower($item_invoic['product']), "tele")!==false){
								$valores_mes_anterior['Television']['cantidad']++;
								$valores_mes_anterior['Television']['monto']+=intval($item_invoic['subtotal']);
							}else if(strpos(strtolower($item_invoic['product']), "afilia")!==false){
								$valores_mes_anterior['Internet']['cantidad']++;
						 		$valores_mes_anterior['Internet']['monto']+=intval($item_invoic['subtotal']);
							}

						}
					}



					 ?>

					<tr>
						<td><?=$texto_mes_actual?></td>
						<td style="text-align: center"><?=count($lista_mes_actual)?></td>
						<td style="text-align: center"><?="$ ".number_format($valores_mes_actual['monto'],0,",",".")?></td>
					</tr>
					<tr>
						<td><?=$texto_mes_anterior?></td>
						<td style="text-align: center"><?=count($lista_mes_anterior)?></td>
						<td style="text-align: center"><?="$ ".number_format($valores_mes_anterior['monto'],0,",",".")?></td>
					</tr>					
				</tbody>
				<tfoot>
					<tr>
						<th class="pie">TOTAL COBRANZA POR MESES</th>
						<th class="pie"><?=count($lista_mes_anterior)+count($lista_mes_actual)?></th>
						<th class="pie"><?="$ ".number_format($valores_mes_actual['monto']+$valores_mes_anterior['monto'],0,",",".") ?></th>			
					</tr>
				</tfoot>
			</table>
        </div>
			 <div class="col-sm-6">            
			<h6><?php echo $this->lang->line('') ?>Resumen por Forma de pago</h6>
			<table class="party">
				<thead>
					<tr>
						<th>DESCRIPCION</th>
						<th>CANT</th>
						<th>MONTO</th>			
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Efectivo</td>
						<td style="text-align: center"><?=$array_efectivo['cantidad']?></td>
						<td style="text-align: center"><?="$ ".number_format($array_efectivo['monto'],0,",",".")?></td>
					</tr>
					<tr>
						<td>Tarjeta Debito</td>
						<td style="text-align: center">0</td>
						<td style="text-align: center">0</td>
					</tr>
					<tr>
						<td>Tarjeta Credito</td>
						<td style="text-align: center">0</td>
						<td style="text-align: center">0</td>
					</tr>
					<tr>
						<td>Deposito</td>
						<td style="text-align: center">0</td>
						<td style="text-align: center">0</td>
					</tr>
					<tr>
						<td>Transferencia</td>
						<td style="text-align: center"><?=$array_bancos['Bancolombia']['cantidad']+$array_bancos['BBVA']['cantidad']?></td>
						<td style="text-align: center"><?="$ ".number_format($array_bancos['Bancolombia']['monto']+$array_bancos['BBVA']['monto'],0,",",".")?></td>
					</tr>
					<tr>
						<td>Cheque</td>
						<td style="text-align: center">0</td>
						<td style="text-align: center">0</td>
					</tr>
					<tr>
						<td>Retencion</td>
						<td style="text-align: center">0</td>
						<td style="text-align: center">0</td>
					</tr>
					<tr>
						<td>Domiciliacion Bancaria</td>
						<td style="text-align: center">0</td>
						<td style="text-align: center">0</td>
					</tr>
					
				</tbody>
				<tfoot>
					<tr>
						<th class="pie">TOTAL FORMA PAGO</th>
						<th class="pie"><?=$array_efectivo['cantidad']+$array_bancos['Bancolombia']['cantidad']+$array_bancos['BBVA']['cantidad']?></th>
						<th class="pie"><?="$ ".number_format($array_efectivo['monto']+$array_bancos['Bancolombia']['monto']+$array_bancos['BBVA']['monto'],0,",",".")?></th>			
					</tr>
				</tfoot>
			</table>
			<hr>
			<h6><?php echo $this->lang->line('') ?>Resumen Anulaciones</h6>
			<table class="party">
				<thead>
					<tr>
						<th>DESCRIPCION</th>
						<th>CANT</th>
						<th>MONTO</th>			
					</tr>
				</thead>
				<tbody>
					<?php 
						$cuenta_anulaciones=array("Cobranza Efectiva"=>array("cantidad"=>0,"monto"=>0),"Anulado de Cierre"=>array("cantidad"=>0,"monto"=>0),"Anulado de otros Cierres"=>array("cantidad"=>0,"monto"=>0));
						foreach ($lista_anulaciones as $key => $value) {
								$anul=$this->db->get_where("anulaciones",array("transactions_id"=>$value['id']))->row();
								
								if(isset($cuenta_anulaciones[$anul->detalle])) {
									
									$cuenta_anulaciones[$anul->detalle]['cantidad']++;
									
									$invoce = $this->db->get_where("invoices",array("tid"=>$value['tid']))->row();
									$cuenta_anulaciones[$anul->detalle]['monto']+=intval($invoce->subtotal);
									
								}

						} 

					?>
					<tr>
						<td>Cobranza efectiva</td>
						<td style="text-align: center"><?=$cuenta_anulaciones['Cobranza Efectiva']['cantidad']?></td>
						<td style="text-align: center"><?="$ ".number_format($cuenta_anulaciones['Cobranza Efectiva']['monto'],0,",",".")?></td>
					</tr>
					<tr>
						<td>Anulado de cierre</td>
						<td style="text-align: center"><?=$cuenta_anulaciones['Anulado de Cierre']['cantidad']?></td>
						<td style="text-align: center"><?="$ ".number_format($cuenta_anulaciones['Anulado de Cierre']['monto'],0,",",".")?></td>
					</tr>
					<tr>
						<td>Anulado de otros cierres</td>
						<td style="text-align: center"><?=$cuenta_anulaciones['Anulado de otros Cierres']['cantidad']?></td>
						<td style="text-align: center"><?="$ ".number_format($cuenta_anulaciones['Anulado de otros Cierres']['monto'],0,",",".")?></td>
					</tr>
					
					
				</tbody>
				<tfoot>
					<tr>
						<th class="pie">COBRADO - ANULADO DE OTRAS FECHAS</th>
						<th class="pie"><?=$cuenta_anulaciones['Cobranza Efectiva']['cantidad']+$cuenta_anulaciones['Anulado de Cierre']['cantidad']+$cuenta_anulaciones['Anulado de otros Cierres']['cantidad']?></th>
						<th class="pie"><?="$ ".number_format($cuenta_anulaciones['Cobranza Efectiva']['monto']+$cuenta_anulaciones['Anulado de Cierre']['monto']+$cuenta_anulaciones['Anulado de otros Cierres']['monto'],0,",",".")?></th>			
					</tr>
				</tfoot>
			</table>
			<hr>
			<h6><?php echo $this->lang->line('') ?>Resumen de cargos cobrados por meses INTERNET</h6>
			<table class="party">
				<thead>
					<tr>
						<th>DESCRIPCION</th>
						<th>CANT</th>
						<th>MONTO</th>			
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?=$texto_mes_actual?></td>
						<td style="text-align: center"><?=$valores_mes_actual['Internet']['cantidad']?></td>
						<td style="text-align: center"><?="$ ".number_format($valores_mes_actual['Internet']['monto'],0,",",".") ?></td>
					</tr>
					<tr>
						<td><?=$texto_mes_anterior?></td>
						<td style="text-align: center"><?=$valores_mes_anterior['Internet']['cantidad']?></td>
						<td style="text-align: center"><?="$ ".number_format($valores_mes_anterior['Internet']['monto'],0,",",".") ?></td>
					</tr>					
				</tbody>
				<tfoot>
					<tr>
						<th class="pie">TOTAL COBRANZA POR MESES</th>
						<th class="pie"><?=$valores_mes_actual['Internet']['cantidad']+$valores_mes_anterior['Internet']['cantidad']?></th>
						<th class="pie"><?= "$ ".number_format($valores_mes_actual['Internet']['monto']+$valores_mes_anterior['Internet']['monto'],0,",",".") ?></th>			
					</tr>
				</tfoot>
			</table>
			<hr>
			<h6><?php echo $this->lang->line('') ?>Resumen de cargos cobrados por meses TV</h6>
			<table class="party">
				<thead>
					<tr>
						<th>DESCRIPCION</th>
						<th>CANT</th>
						<th>MONTO</th>			
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?=$texto_mes_actual?></td>
						<td style="text-align: center"><?=$valores_mes_actual['Television']['cantidad']?></td>
						<td style="text-align: center"><?="$ ".number_format($valores_mes_actual['Television']['monto'],0,",",".") ?></td>
					</tr>
					<tr>
						<td><?=$texto_mes_anterior?></td>
						<td style="text-align: center"><?=$valores_mes_anterior['Television']['cantidad']?></td>
						<td style="text-align: center"><?="$ ".number_format($valores_mes_anterior['Television']['monto'],0,",",".") ?></td>
					</tr>					
				</tbody>
				<tfoot>
					<tr>
						<th class="pie">TOTAL COBRANZA POR MESES</th>
						<th class="pie"><?=$valores_mes_actual['Television']['cantidad']+$valores_mes_anterior['Television']['cantidad']?></th>
						<th class="pie"><?= "$ ".number_format($valores_mes_actual['Television']['monto']+$valores_mes_anterior['Television']['monto'],0,",",".") ?></th>			
					</tr>
				</tfoot>
			</table>
			<hr>
			<h6><?php echo $this->lang->line('') ?>Resumen por tipo de servicio</h6>
			<table class="party">
				<thead>
					<tr>
						<th>DESCRIPCION</th>
						<th>CANT</th>
						<th>MONTO</th>			
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Internet</td>
						<td style="text-align: center"><?=$array_resumen_tipo_servicio['Internet']['cantidad']?></td>
						<td style="text-align: center"><?="$ ".number_format($array_resumen_tipo_servicio['Internet']['monto'],0,",",".")?></td>
					</tr>
					<tr>
						<td>Television</td>
						<td style="text-align: center"><?=$array_resumen_tipo_servicio['Television']['cantidad']?></td>
						<td style="text-align: center"><?="$ ".number_format($array_resumen_tipo_servicio['Television']['monto'],0,",",".")?></td>
					</tr>					
				</tbody>
				<tfoot>
					<tr>
						<th class="pie">TOTAL TIPO DE SERVICIOS</th>
						<th class="pie"><?=$array_resumen_tipo_servicio['Internet']['cantidad']+$array_resumen_tipo_servicio['Television']['cantidad']?></th>
						<th class="pie"><?="$ ".number_format($array_resumen_tipo_servicio['Internet']['monto']+$array_resumen_tipo_servicio['Television']['monto'],0,",",".") ?></th>			
					</tr>
				</tfoot>
			</table>
        </div>
		
    </div>
		
        <div class="grid_3 grid_4">
            

            


            <table class="table table-striped" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th><?php echo $this->lang->line('Date') ?></th>
                    <th><?php echo $this->lang->line('Description') ?></th>

                    <th><?php echo $this->lang->line('Debit') ?></th>
                    <th><?php echo $this->lang->line('Credit') ?></th>

                    <th><?php echo $this->lang->line('Balance') ?></th>


                </tr>
                </thead>
                <tbody id="entries">
                </tbody>

                <tfoot>
                <tr>
                    <th><?php echo $this->lang->line('Date') ?></th>
                    <th><?php echo $this->lang->line('Description') ?></th>

                    <th><?php echo $this->lang->line('Debit') ?></th>
                    <th><?php echo $this->lang->line('Credit') ?></th>

                    <th><?php echo $this->lang->line('Balance') ?></th>


                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</article>
<script type="text/javascript">


    $(document).ready(function () {

        $('#entries').html('<td class="text-lg-center" colspan="5">Data loading...</td>');

        $.ajax({

            url: baseurl + 'reports/statements',
            type: 'POST',
            data: <?php echo "{'ac': '" . $filter[0] . "','sd':'" . $filter[2] . "','ed':'" . $filter[3] . "','ty':'" . $filter[1] . "'}"; ?>,
            dataType: 'html',
            success: function (data) {
                $('#entries').html(data);

            },
            error: function (data) {
                $('#response').html('Error')
            }

        });
    });
</script>
