<style>
	.titulos{
		background-color:#4881A6;
		font-weight: bold;
		padding-top: 10px;
		padding-bottom: 10px;
		
	}
	
	input[type=checkbox] {
  		transform: scale(1.5);
		margin-left: 10px;
		pointer-events: none;
	}
	input[type=radio] {
  		transform: scale(1.5);
		margin-left: 10px;
		pointer-events: none;
	}

</style>

<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <form method="post" id="data_form" class="form-horizontal">
            <div class="grid_3 grid_4">

                <h5>FORMATO ANALISIS SEGURO DE TRABAJO</h5>
                <hr>
				<table width="100%" border="1">
					  <tbody>
						<tr>
						  <td colspan="4" width="50%"><span style="font-weight: bold">Ciudad:</span> <?php echo $rta['city']; ?> &nbsp;</td>
						  <td colspan="4" width="50%"><span style="font-weight: bold">Nombre y Apellido:</span> <?php echo $rta['name']; ?>&nbsp;</td>
						</tr>
						<tr>
						  <td colspan="4"><span style="font-weight: bold">Área/Proceso:</span> 
							  <?php $rol = $this->db->get_where('aauth_users',array('id'=>$rta['id']))->row(); echo user_role($rol); ?></td>
						  <td colspan="4"><span style="font-weight: bold">Ubicación donde se realiza el trabajo:</span> <?php echo $rta['ubicacion']; ?></td>
						</tr>
						<tr>
						  	<td colspan="4"><span style="font-weight: bold">Fecha de realización del Trabajo:</span> 
								<?php echo $rta['fecha']; ?></td>
							<td valign="top" colspan="4"><span style="font-weight: bold">Lugar de Trabajo:</span> 
								<?php echo $rta['lugar']; ?></td>
						</tr>
						<tr>
						  <td colspan="4"><span style="font-weight: bold">Hora de Inicio (a.m.):</span>
							  <?php echo $rta['horain']; ?></td>
						  <td colspan="4"><span style="font-weight: bold">Hora de Finalización ( p.m.):</span>
							  <?php echo $rta['horafin']; ?></td>
						</tr>
						<tr>
						  <td valign="top" colspan="4"><span style="font-weight: bold">Descripción de la tarea a realizar:</span>  </td>
							<td colspan="4"><?php echo $rta['tarea']; ?></td>
						</tr>
						<tr>
							<td align="center" class="titulos" colspan="8">PARA ESTE TRABAJO SE REQUIERE PERMISO DE:</td>
						</tr>
						<tr>
							<td colspan="8" align="center" style="padding-top: 10px">
								¿TRABAJO EN ALTURA ? 
                                                <input type="radio" name="alturas"
                                                       <?= ($rta['alturas']=='1')?'checked':'' ?>>  Si
                                                <input type="radio" name="alturas"
                                                       <?= ($rta['alturas']=='0')?'checked':'' ?>>  No
                                            </td>
						</tr>
						<tr>
							<td align="center" class="titulos" colspan="8">ELEMENTOS DE PROTECCION PERSONAL A USAR</td>
						</tr>
						<tr>
							<td colspan="8"><table width="100%" border="0">
								  <tbody>
									<tr>
									  <td align="right">CASCO DE SEGURIDAD: </td>
										<td><input type="checkbox" name="casco" <?= ($rta['casco']=='0')?'checked':'' ?>></input></td>
									  <td align="right">GAFAS ESPECIALES:</td>
									  <td><input type="checkbox" name="gafas" <?= ($rta['gafas']=='0')?'checked':'' ?>></input></td>
									</tr>
									<tr>
									  <td align="right">MONOGAFAS:</td>
									  <td><input type="checkbox" name="monogafas" <?= ($rta['monogafas']=='0')?'checked':'' ?>></input></td>
									  <td align="right">TAPAOIDOS:</td>
									  <td><input type="checkbox" name="tapaoidos" <?= ($rta['tapaoidos']=='0')?'checked':'' ?>></input></td>
									</tr>
									<tr>
									  <td align="right">GUANTES:</td>
									  <td><input type="checkbox" name="guantes" <?= ($rta['guantes']=='0')?'checked':'' ?>></input></td>
									  <td align="right">VISERA O CARETA:</td>
									  <td><input type="checkbox" name="careta" <?= ($rta['careta']=='0')?'checked':'' ?>></input></td>
									</tr>
									<tr>
									  <td align="right">ARNES:</td>
									  <td><input type="checkbox" name="arnes" <?= ($rta['arnes']=='0')?'checked':'' ?>></input></td>
									  <td align="right">EQUIPO DE PRIMEROS AUXILIOS:</td>
									  <td><input type="checkbox" name="1er_aux" <?= ($rta['1er_aux']=='0')?'checked':'' ?>></input></td>
									</tr>
									<tr>
									  <td align="right">ESLINGA:</td>
									  <td><input type="checkbox" name="eslinga" <?= ($rta['eslinga']=='0')?'checked':'' ?>></input></td>
									  <td align="right">RESPIRADOR ESPECIAL:</td>
									  <td><input type="checkbox" name="respirador" <?= ($rta['respirador']=='0')?'checked':'' ?>></input></td>
									</tr>
									<tr>
									  <td align="right">TIE OFF + MOSQUETON:</td>
									  <td><input type="checkbox" name="mosquete" <?= ($rta['mosquete']=='0')?'checked':'' ?>></input></td>
									  <td align="right">¿ OTRO?, Cual:</td>
									  <td><input type="text" name="otros" size="70%" maxlength="30%" style="border: 0"></input></td>
									</tr>
								  </tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td align="center" class="titulos" colspan="8">EQUIPOS Y HERRAMIENTAS A USAR</td>
						</tr>
						<tr>
							<td colspan="2" style="font-weight: bold" align="center">EQUIPOS Y HERRAMIENTAS</td>
							<td colspan="7" style="font-weight: bold">Indique cada una de las herramientas a utilizar.</td>
							
						</tr>
						<tr>
							<td colspan="1"  width="20%">Manuales</td>
							<td colspan="1" width="5%"><?php echo $rta['manual1']; ?></td>
							<td colspan="7"><?php echo $rta['manual2']; ?></td>
						</tr>
						<tr>
							<td colspan="1">Eléctricas</td>
							<td colspan="1"><?php echo $rta['electro1']; ?></td>
							<td colspan="6"><?php echo $rta['electro2']; ?></td>
						</tr>
						<tr>
							<td colspan="1">Mecánicas</td>
							<td colspan="1"><?php echo $rta['mecan1']; ?></td>
							<td colspan="6"><?php echo $rta['mecan2']; ?></td>
						</tr>
						<tr>
							<td colspan="1">Otras</td>
							<td colspan="1"><?php echo $rta['otras1']; ?></td>
							<td colspan="6"><?php echo $rta['otras2']; ?></td>
						</tr>
						<tr>
							<td align="center" class="titulos" colspan="8">ANALISIS DE LA TAREA</td>
						</tr>
						<tr>
							<td colspan="4">¿Qué tan alto se encuentra el lugar de trabajo?</td>
							<td colspan="4"><?php echo $rta['alto']; ?></td>
						</tr>
						<tr>
							<td colspan="4">¿Cuál es el sistema de acceso al lugar de trabajo?</td>
							<td colspan="4"><?php echo $rta['acceso']; ?></td>
						</tr>
						<tr>
							<td colspan="4">¿Se han establecido los puntos de anclaje?</td>
							<td colspan="4"><?php echo $rta['puntos']; ?></td>
						</tr>
						<tr>
							<td colspan="4">¿Se han realizado los cálculos de la distancia de caída?</td>
							<td colspan="4"><?php echo $rta['distancia']; ?></td>
						</tr>
						<tr>
							<td colspan="4">¿Cuáles son los sistemas de prevención y protección requeridos?</td>
							<td colspan="4"><?php echo $rta['prevencion']; ?></td>
						</tr>
						<tr>
							<td colspan="4">¿Cuáles son los elementos de protección requeridos?</td>
							<td colspan="4"><?php echo $rta['proteccion']; ?></td>
						</tr>
						<tr>
							<td colspan="4">¿Cuántos trabajadores se requieren?</td>
							<td colspan="4"><?php echo $rta['trabajadores']; ?></td>
						</tr>
						<tr>
							<td colspan="4">¿Qué materiales y recursos van a utilizarse?</td>
							<td colspan="4"><?php echo $rta['materiales']; ?></td>
						</tr>
						<tr>
							<td colspan="4">¿Hay peligro de resbalar o tropezar alrededor del área de trabajo?</td>
							<td colspan="4"><?php echo $rta['peligros']; ?></td>
						</tr>
						<tr>
							<td colspan="4">¿Qué otros peligros hay en el lugar de trabajo?
							(chispas, electricidad, químicos, superficie resbaladiza,
							superficies calientes, objetos filosos, cargas pesadas,
							etc.) Especifique:</td>
							<td colspan="4"><?php echo $rta['peligro_otros']; ?></td>
						</tr>
						<tr>
							<td align="center" class="titulos" colspan="2" width="25%">Pasos detallados de la tarea</td>
							<td align="center" class="titulos" colspan="2" width="25%">Peligros existentes y
							potenciales</td>
							<td align="center" class="titulos" colspan="2" width="25%">Consecuencias</td>
							<td align="center" class="titulos" colspan="2" width="25%">Controles Requeridos</td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $rta['tarea1']; ?></td>
							<td colspan="2"><?php echo $rta['riesgo1']; ?></input></td>
							<td colspan="2"><?php echo $rta['consecuencia1']; ?></td>
							<td colspan="2"><?php echo $rta['control1']; ?></input></td>
						</tr>
						<tr>
							<td colspan="2"><input type="text" name="tarea2" size="40%" maxlength="30%" style="border: 0"></input></td>
							<td colspan="2"><input type="text" name="riesgo2" size="40%" maxlength="30%" style="border: 0"></input></td>
							<td colspan="2"><input type="text" name="consecuencia2" size="40%" maxlength="30%" style="border: 0"></input></td>
							<td colspan="2"><input type="text" name="control2" size="40%" maxlength="30%" style="border: 0"></input></td>
						</tr>
						<tr>
							<td colspan="2"><input type="text" name="tarea3" size="40%" maxlength="30%" style="border: 0"></input></td>
							<td colspan="2"><input type="text" name="riesgo3" size="40%" maxlength="30%" style="border: 0"></input></td>
							<td colspan="2"><input type="text" name="consecuencia3" size="40%" maxlength="30%" style="border: 0"></input></td>
							<td colspan="2"><input type="text" name="control3" size="40%" maxlength="30%" style="border: 0"></input></td>
						</tr>
						<tr>
							<td colspan="2"><input type="text" name="tarea4" size="40%" maxlength="30%" style="border: 0"></input></td>
							<td colspan="2"><input type="text" name="riesgo4" size="40%" maxlength="30%" style="border: 0"></input></td>
							<td colspan="2"><input type="text" name="consecuencia4" size="40%" maxlength="30%" style="border: 0"></input></td>
							<td colspan="2"><input type="text" name="control4" size="40%" maxlength="30%" style="border: 0"></input></td>
						</tr>
						<tr>
							<td colspan="2"><input type="text" name="tarea5" size="40%" maxlength="30%" style="border: 0"></input></td>
							<td colspan="2"><input type="text" name="riesgo5" size="40%" maxlength="30%" style="border: 0"></input></td>
							<td colspan="2"><input type="text" name="consecuencia5" size="40%" maxlength="30%" style="border: 0"></input></td>
							<td colspan="2"><input type="text" name="control5" size="40%" maxlength="30%" style="border: 0"></input></td>
						</tr>
						<tr>
							<td align="center" class="titulos" colspan="8">EVALUACION DEL RIESGO</td>
						</tr>
						<tr>
							<td colspan="8" style="font-weight: bold">¿Es posible, probable o casi-seguro que ocurra un incidente?</td>
						</tr>
						<tr>
							<td colspan="8"><input type="radio" name="incidente" <?= ($rta['incidente']=='0')?'checked':'' ?>></input>&nbsp;Si, deténgase y no proceda con la tarea. Analice con el supervisor encargado el paso a paso, revisen controles y
							responda la siguiente pregunta.</td>
						</tr>
						<tr>
							<td colspan="8"><input type="radio" name="incidente" <?= ($rta['incidente']=='1')?'checked':'' ?>></input>&nbsp;No, continúe con la tarea con precaución, implemente los controles establecidos.</td>
						</tr>
						<tr>
							<td colspan="8" style="font-weight: bold">¿Es seguro proceder ahora en la tarea con los controles adicionales?</td>
						</tr>
						<tr>
							<td colspan="8"><input type="radio" name="seguro" <?= ($rta['seguro']=='0')?'checked':'' ?>></input>&nbsp;Si, proceda con la tarea.</td>
						</tr>
						<tr>
							<td colspan="8"><input type="radio" name="seguro" <?= ($rta['seguro']=='1')?'checked':'' ?>></input>&nbsp;No, consulte al supervisor antes de tomar cualquier decisión.</td>
						</tr>
						<tr>
							<td align="center" class="titulos" colspan="5" width="70%">Nombre y Cedula de los trabajadores (Ejecutor)</td>
							<td align="center" class="titulos" colspan="3" width="30%">Firma</td>
						</tr>
						<tr>
							<td align="center" colspan="5" width="70%"><?php echo $rta['name'].' CC: '.$rta['dto']; ?></td>
							<td align="center" colspan="3" width="30%"><img alt="image" class="img-responsive"
                                                 src="<?php echo base_url('userfiles/employee_sign/' . $rta['sign']); ?>" style="width: 40%"></td>
						</tr>
							<td align="center" class="titulos" colspan="5" width="70%">Nombre y Cedula de la persona (Emisor)</td>
							<td align="center" class="titulos" colspan="3" width="30%">Firma</td>
						</tr>
						<tr>
							<td align="center" colspan="5" width="70%"></td>
							<td align="center" colspan="3" width="30%"></td>
						</tr>
					  </tbody>
					</table>
					

				</div>
				
                <div class="form-group row">
					
                    <label class="col-sm-12 col-form-label"></label>
					
                    <div class="col-sm-12" align="center">
                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom"
                               value="<?php echo $this->lang->line('Add') ?>" data-loading-text="Adding...">
                        <input type="hidden" value="encuesta/addats" id="action-url">
                    </div>
                </div>

            </div>
        </form>
    </div>
</article>

