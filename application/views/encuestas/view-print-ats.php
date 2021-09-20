<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Encuesta ATS #<?php echo $rta['idats'] ?></title>
    <style>
	.titulos{
		background-color:#4881A6;
		font-weight: bold;
		padding-top: 10px;
		
	}
	
	input[type=checkbox] {
  		transform: scale(1.5);
		margin-left: 10px;
		pointer-events: none;
	}
	input[type=radio] {
  		transform: scale(1.5);
		margin-left: 10px;
	}

</style>
</head>

<body>


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
                                                       <?= ($rta['alturas']=='1')?'checked="true"':'' ?>>  Si
                                                <input type="radio" name="alturas"
                                                       <?= ($rta['alturas']=='0')?'checked="true"':'' ?>>  No
                                            </td>
						</tr>
						<tr>
							<td align="center" class="titulos" colspan="8">ELEMENTOS DE PROTECCION PERSONAL A USAR</td>
						</tr>
						<tr>
							<td colspan="8"><table border="1">
								  <tbody>
									<tr>
									  <td align="right">CASCO DE SEGURIDAD: </td>
										<td><input type="checkbox" name="casco" <?= ($rta['casco']=='0')?'checked="true"="true"':'' ?>></input></td>
									  <td align="right">GAFAS ESPECIALES:</td>
									  <td><input type="checkbox" name="gafas" <?= ($rta['gafas']=='0')?'checked="true"':'' ?>></input></td>
									</tr>
									<tr>
									  <td align="right">MONOGAFAS:</td>
									  <td><input type="checkbox" name="monogafas" <?= ($rta['monogafas']=='0')?'checked="true"':'' ?>></input></td>
									  <td align="right">TAPAOIDOS:</td>
									  <td><input type="checkbox" name="tapaoidos" <?= ($rta['tapaoidos']=='0')?'checked="true"':'' ?>></input></td>
									</tr>
									<tr>
									  <td align="right">GUANTES:</td>
									  <td><input type="checkbox" name="guantes" <?= ($rta['guantes']=='0')?'checked="true"':'' ?>></input></td>
									  <td align="right">VISERA O CARETA:</td>
									  <td><input type="checkbox" name="careta" <?= ($rta['careta']=='0')?'checked="true"':'' ?>></input></td>
									</tr>
									<tr>
									  <td align="right">ARNES:</td>
									  <td><input type="checkbox" name="arnes" <?= ($rta['arnes']=='0')?'checked="true"':'' ?>></input></td>
									  <td align="right">EQUIPO DE PRIMEROS AUXILIOS:</td>
									  <td><input type="checkbox" name="1er_aux" <?= ($rta['1er_aux']=='0')?'checked="true"':'' ?>></input></td>
									</tr>
									<tr>
									  <td align="right">ESLINGA:</td>
									  <td><input type="checkbox" name="eslinga" <?= ($rta['eslinga']=='0')?'checked="true"':'' ?>></input></td>
									  <td align="right">RESPIRADOR ESPECIAL:</td>

									  <td><input type="checkbox" name="respirador" <?= ($rta['respirador']=='0')?'checked="true"':'' ?>></input></td>
									</tr>
									<tr>
									  <td align="right">TIE OFF + MOSQUETON:</td>
									  <td><input type="checkbox" name="mosquete" <?= ($rta['mosquete']=='0')?'checked="true"':'' ?>></input></td>
									  <td align="right">¿ OTRO?, Cual:</td>
									  <td><?php echo $rta['otros']; ?></td>
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
							<td colspan="6" style="font-weight: bold">Indique cada una de las herramientas a utilizar.</td>
							
						</tr>
						<tr>
							<td colspan="1">Manuales</td>
							<td colspan="1"><?php echo $rta['manual1']; ?></td>
							<td colspan="6"><?php echo $rta['manual2']; ?></td>
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
							<td align="center" class="titulos" colspan="2">Pasos detallados de la tarea</td>
							<td align="center" class="titulos" colspan="2">Peligros existentes y
							potenciales</td>
							<td align="center" class="titulos" colspan="2">Consecuencias</td>
							<td align="center" class="titulos" colspan="2">Controles Requeridos</td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $rta['tarea1']; ?></td>
							<td colspan="2"><?php echo $rta['riesgo1']; ?></input></td>
							<td colspan="2"><?php echo $rta['consecuencia1']; ?></td>
							<td colspan="2"><?php echo $rta['control1']; ?></input></td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $rta['tarea2']; ?></td>
							<td colspan="2"><?php echo $rta['riesgo2']; ?></td>
							<td colspan="2"><?php echo $rta['consecuencia2']; ?></td>
							<td colspan="2"><?php echo $rta['control2']; ?></td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $rta['tarea3']; ?></td>
							<td colspan="2"><?php echo $rta['riesgo3']; ?></td>
							<td colspan="2"><?php echo $rta['consecuencia3']; ?></td>
							<td colspan="2"><?php echo $rta['control3']; ?></td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $rta['tarea4']; ?></td>
							<td colspan="2"><?php echo $rta['riesgo4']; ?></td>
							<td colspan="2"><?php echo $rta['consecuencia4']; ?></td>
							<td colspan="2"><?php echo $rta['control4']; ?></td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $rta['tarea5']; ?></td>
							<td colspan="2"><?php echo $rta['riesgo5']; ?></td>
							<td colspan="2"><?php echo $rta['consecuencia5']; ?></td>
							<td colspan="2"><?php echo $rta['control5']; ?></td>
						</tr>
						<tr>
							<td align="center" class="titulos" colspan="8">EVALUACION DEL RIESGO</td>
						</tr>
						<tr>
							<td colspan="8" style="font-weight: bold">¿Es posible, probable o casi-seguro que ocurra un incidente?</td>
						</tr>
						<tr>
							<td colspan="8"><input type="radio" name="incidente" <?= ($rta['incidente']=='0')?'checked="true"':'' ?>></input>&nbsp;Si, deténgase y no proceda con la tarea. Analice con el supervisor encargado el paso a paso, revisen controles y
							responda la siguiente pregunta.</td>
						</tr>
						<tr>
							<td colspan="8"><input type="radio" name="incidente" <?= ($rta['incidente']=='1')?'checked="true"':'' ?>></input>&nbsp;No, continúe con la tarea con precaución, implemente los controles establecidos.</td>
						</tr>
						<tr>
							<td colspan="8" style="font-weight: bold">¿Es seguro proceder ahora en la tarea con los controles adicionales?</td>
						</tr>
						<tr>
							<td colspan="8"><input type="radio" name="seguro" <?= ($rta['seguro']=='0')?'checked="true"':'' ?>></input>&nbsp;Si, proceda con la tarea.</td>
						</tr>
						<tr>
							<td colspan="8"><input type="radio" name="seguro" <?= ($rta['seguro']=='1')?'checked="true"':'' ?>></input>&nbsp;No, consulte al supervisor antes de tomar cualquier decisión.</td>
						</tr>
						<tr>
							<td align="center" class="titulos" colspan="5">Nombre y Cedula de los trabajadores (Ejecutor)</td>
							<td align="center" class="titulos" colspan="3">Firma</td>
						</tr>
						<tr>
							<td align="center" colspan="5"><?php echo $rta['name'].' CC: '.$rta['dto']; ?></td>
							<td align="center" colspan="3"><img alt="image" class="img-responsive"
                                                 src="<?php echo base_url('userfiles/employee_sign/' . $rta['sign']); ?>" style="width: 40%"></td>
						</tr>
						<tr>
							<td align="center" class="titulos" colspan="5">Nombre y Cedula de la persona (Emisor)</td>
							<td align="center" class="titulos" colspan="3">Firma</td>
						</tr>
						<tr>
							<td align="center" colspan="5"><?php
								$autor = $this->db->get_where('employee_profile',array('id'=>$rta['autoriza']))->row();
								echo $autor->name.' CC: '.$autor->dto; ?></td>
							<td align="center" colspan="3"><img alt="image" class="img-responsive"
                                                 src="<?php echo base_url('userfiles/employee_sign/' . $autor->sign); ?>" style="width: 40%"></td>
						</tr>
					  </tbody>
					</table>

</body>
</html>