<style>
.st-Activo, .st-Instalar , .st-Cortado, .st-Suspendido, .st-Exonerado
{
	text-transform: uppercase;
    color: #fff;
    padding: 4px;
    border-radius: 11px;
    font-size: 15px;
}
.st-Activo
{
 background-color: #4EAA28;
}
.st-Instalar
{
 background-color: #A49F20;
}
.st-Cortado
{
 background-color: #A4282A;
}
.st-Suspendido
{
 background-color: #2224A3;
}
.st-Exonerado
{
 background-color: #24A9AB;
}
.st-Compromiso
{
 background-color: #962895;
}
</style>
<article class="content content items-list-page">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div id="div_notify3">
        <div id="notify3" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message3"><img src="<?=base_url()?>/assets/img/iconocargando.gif"></div>
        </div>
		 </div>
            <!-- paneles -->
            <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <label class="col-sm-12 col-form-label"
                                       for="pay_cat"><h5>FILTRAR </h5> </label> 

                            <ul class="nav nav-tabs nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active"
                                       aria-controls="active"
                                       aria-expanded="true">Estado</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="link-tab" data-toggle="tab" href="#link"
                                       aria-controls="link"
                                       aria-expanded="false">Servicio</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="thread-tab" data-toggle="tab" href="#thread"
                                       aria-controls="thread">Direccion</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="milestones-tab" data-toggle="tab" href="#milestones"
                                       aria-controls="milestones"> Cuenta</a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="ingreso-tab" data-toggle="tab" href="#ingreso"
                                       aria-controls="ingreso"> Ingreso</a>
                                </li>
                               <!-- <li class="nav-item">
                                    <a class="nav-link" id="thread-tab" data-toggle="tab" href="#activities"
                                       aria-controls="activities">Otro Filtro</a>
                                </li>-->
                               
                            </ul>
                            <div class="tab-content px-1 pt-1">
                                <div role="tabpanel" class="tab-pane fade active in" id="active" aria-labelledby="active-tab" aria-expanded="true">
                                    <div class="form-group row">
                                            
                                        <label class="col-sm-2 col-form-label"
                                               for="pay_cat">Estado</label>

                                        <div class="col-sm-6">
                                            <select name="tec" class="form-control" id="estado">
                                                <option value=''>Todos</option>
                                                <option value='Activo'>Activos</option>
                                                <option value='Cortado'>Cortados</option>
                                                <option value='Suspendido'>Suspendidos</option>
                                                <option value='Instalar'>Instalar</option>
												<option value='Exonerado'>Exonerado</option>
												<option value='Cartera'>Cartera</option>
												<option value='Compromiso'>Compromiso</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="link" role="tabpanel" aria-labelledby="link-tab" aria-expanded="false">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"
                                                   for="pay_cat">Servicio</label>

                                            <div class="col-sm-6">
                                                <select name="trans_type" class="form-control" id="sel_servicios">
                                                    <option value=''>Todos</option>
                                                    <option value='Internet'>Internet</option>
                                                    <option value='TV'>TV</option>
                                                    <option value='Combo'>Combo</option>
                                                </select>
                                            </div>                              
                                            <input type="checkbox" id="check1" name="individual_service" style="cursor:pointer;" ><b onclick="ckekar_1()" style="cursor: pointer;"><i  >&nbsp; Individualizar Servicio</i></b>
                                        </div>
                                </div>
                                <!--thread-->
                                <div class="tab-pane fade" id="thread" role="tabpanel" aria-labelledby="thread-tab" aria-expanded="false">

                                        <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"
                                               for="pay_cat">Direccion</label>

                                        <div class="col-sm-6">
                                            <select name="trans_type" class="form-control" id="sel_dir_personalizada" onclick="act_sel_dir_personalizada()">
                                                <option value=''>Todas</option>
                                                <option value='Personalizada'>Personalizada</option>
                                            </select>
                                        </div>                              
                                    </div>
                                    <div id="div_direccion_personalizada">
                                            <div class="form-group row">
                                        
                                        
                                        

                                            <div class="col-sm-12">
                                                <h6><label class="col-sm-2 col-form-label"
                                                   for="ciudad"><?php echo $this->lang->line('') ?>Ciudad</label></h6>
                                                <div id="ciudades">
                                                    <select id="cmbCiudades" class="selectpicker form-control" name="ciudad" onChange="cambia4()">                                
                                                        <?php if($_GET['id']=="1"){?>
                                                            <option value="0">-</option>
                                                        <?php }else if($_GET['id']=="2"){ ?>
                                                            <option value="Yopal">Yopal</option>
                                                        <?php }else if($_GET['id']=="3"){ ?>
                                                            <option value="Villanueva">Villanueva</option>
                                                        <?php }else if($_GET['id']=="4"){ ?>
                                                            <option value="Monterrey">Monterrey</option>
                                                        <?php }else if($_GET['id']=="5"){ ?>
                                                            <option value="Mocoa">Mocoa</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                   
                                            </div>
                                          
                                           
                                        </div>
                                            <div class="form-group row"> 
                                            
                                                <div class="col-sm-6">
                                                    <h6><label class="col-sm-2 col-form-label"
                                                       for="localidad"><?php echo $this->lang->line('') ?>Localidad</label></h6>
                                                    <div id="localidades">
                                                        <select id="cmbLocalidades"  class="selectpicker form-control" name="localidad" onChange="cambia5()">
                                                        <option value="0">-</option>
                                                        </select>
                                                    </div>
                                                       
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <h6><label class="col-sm-2 col-form-label"
                                                       for="barrio"><?php echo $this->lang->line('') ?>Barrio</label></h6>
                                                    <div id="barrios">
                                                        <select id="cmbBarrios" class="selectpicker form-control" name="barrio" >
                                                        <option value="0">-</option>
                                                        </select>
                                                    </div>
                                                       
                                                </div>
                                                 
                                            </div>
                                            <div class="form-group row">

                                                <h6><label class="col-sm-12 col-form-label"
                                                       for="city"><?php echo $this->lang->line('') ?>Direccion</label></h6>

                                                
                                            
                                                <div class="col-sm-2">
                                                <select class="form-control"  id="nomenclatura" name="nomenclatura">
                                                                            <option value="-">-</option>
                                                                            <option value="Calle">Calle</option>
                                                                            <option value="Carrera">Carrera</option>
                                                                            <option value="Diagonal">Diagonal</option>
                                                                            <option value="Transversal">Transversal</option>
                                                                            <option value="Manzana">Manzana</option>
                                                                    </select>
                                                
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" placeholder="Numero" id="numero1" 
                                                           class="form-control margin-bottom" name="numero1">
                                                </div>
                                                <div class="col-sm-2">
                                                    <select class="form-control" id="adicionauno" name="adicionauno">
                                                                            <option value=""></option>
                                                                            <option value="bis">bis</option>
                                                                            <option value="sur">sur</option>
                                                                            <option value="a">a</option>
                                                                            <option value="a">a sur</option>
                                                                            <option value="b">b</option>
                                                                            <option value="a">b sur</option>
                                                                            <option value="c">c</option>
                                                                            <option value="d">d</option>
                                                                            <option value="e">e</option>
                                                                            <option value="f">f</option>
                                                                            <option value="g">g</option>
                                                                            <option value="h">h</option>
                                                                            <option value="a bis">a bis</option>
                                                                            <option value="b bis">b bis</option>
                                                                            <option value="c bis">c bis</option>
                                                                            <option value="d bis">d bis</option>
                                                                    </select>
                                                </div>
                                                <div class="col-sm-1" style="margin-left: -10px; width: 2%">
                                                    <label class="col-form-label" for="Nº">Nº</label>
                                                </div>
                                                <div class="col-sm-2" style="margin-left: 14px;">
                                                    <input type="text" placeholder="Numero"
                                                           class="form-control margin-bottom" id="numero2" name="numero2" style="margin-left: -20px;">
                                                </div>
                                                <div class="col-sm-2" style="margin-left: -30px;margin-right: -20px;">
                                                    <select class="col-sm-1 form-control" id="adicional2" name="adicional2">
                                                                            <option value=""></option>
                                                                            <option value="bis">bis</option>
                                                                            <option value="sur">sur</option>
                                                                            <option value="a">a</option>
                                                                            <option value="a sur">a sur</option>
                                                                            <option value="b">b</option>
                                                                            <option value="b sur">b sur</option>
                                                                            <option value="c">c</option>
                                                                            <option value="d">d</option>
                                                                            <option value="e">e</option>
                                                                            <option value="f">f</option>
                                                                            <option value="g">g</option>
                                                                            <option value="h">h</option>
                                                                            <option value="a bis">a bis</option>
                                                                            <option value="b bis">b bis</option>
                                                                            <option value="c bis">c bis</option>
                                                                            <option value="d bis">d bis</option>
                                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" placeholder="Numero"
                                                           class="form-control margin-bottom" name="numero3" id="numero3">
                                                </div>
                                            </div>
                                    </div>

                                </div>
                                <!--thread-->
                                <!--milestones-->
                                <div class="tab-pane fade" id="milestones" role="tabpanel" aria-labelledby="milestones-tab" aria-expanded="false">
                                    <div class="form-group row">
                                
                                        <label class="col-sm-2 col-form-label"
                                               for="pay_cat">Estado de Cuenta</label>

                                        <div class="col-sm-6">
                                            <select name="tec" class="form-control" id="deudores">
                                                <option value=''>Todo</option>
                                                <option value='1mes'>Corriente</option>
                                                <option value='masdeunmes'>Mas del Mes</option>
                                                <option value='2meses'>Mas de 2 meses</option>
                                                <option value='3y4meses'>Mas de 3 y 4 meses</option>
                                                <option value='Todos'>Todos los Deudores</option>
                                                <option value='saldoaFavor'>Saldo a Favor</option>
                                                <option value='al Dia'>Al Dia</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <!--milestones-->
                                
                                <div class="tab-pane fade" id="ingreso" role="tabpanel" aria-labelledby="ingreso-tab" aria-expanded="false">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"
                                               for="pay_cat">Fechas</label>

                                        <div class="col-sm-6">
                                            <select name="trans_type" class="form-control" id="fechas" onchange="filtrado_fechas()">
                                                <option value=''>Todas</option>
                                                <option value='fecha_ingreso'>De los ingresos</option>
                                                
                                            </select>
                                        </div>                              
                                    </div>
                                    <div class="form-group row" id="div_fechas" style="display: none">
                                        <label class="col-sm-2 col-form-label"
                                               for="pay_cat" id="label_fechas">De los ingresos</label>

                                        <div class="col-sm-2">
                                            <input type="text" class="form-control required"
                                                   placeholder="Start Date" name="sdate" id="sdate"
                                                    autocomplete="false">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control required"
                                                   placeholder="End Date" name="edate" id="edate"
                                                   data-toggle="datepicker" autocomplete="false">
                                        </div>
                                    </div>
                                </div>
                                
                                
                                


                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="pay_cat"></label>

                                <div class="col-sm-4">
                                    <input type="button" class="btn btn-primary btn-md" value="VER" onclick="filtrar(1);reestablecer_seleciones();">


                                </div>
                            </div>
                </div>
                <!-- fin paneles -->
                        
                           
							
                        
                    
        <div class="grid_3 grid_4">
            <h5><?php echo $this->lang->line('Client Group') . '- ' . $group['title'] ?></h5> 
			
                        <a href=""  class="btn btn-primary btn-md" onclick="abrir_modal_sms(event)"><i
                        class="fa fa-envelope"></i>Enviar mensajes de Grupo</a>

			<a href="#" onclick="redirect_to_export()" class="btn btn-success btn-md">Exportar a Excel .XLSX</a>
<a href=""  class="btn btn-danger btn-md" onclick="abrir_modal_corte_usuarios(event)"><i
                        class="fa fa-envelope"></i>Cortar Usuarios</a>
            <hr>
            <table id="fclientstable" class="table-striped" cellspacing="0" width="100%">
                <thead>
                <tr >
                    <th><input type="checkbox" name="" style="cursor: pointer;" onclick="selet_all_customers(this)">&nbspSMS</th>
                    <th>#</th>
					<th>Abonado</th>
					<th>Cedula</th>
                    <th><?php echo $this->lang->line('Name') ?></th>
					<th>Celular</th>
                    <th><?php echo $this->lang->line('Address') ?></th>
                    <th>Barrio</th>
                    <th>Serv. Suscritos</th>
					<th id="despues_de_thead">Estado</th>
                    <th><?php echo $this->lang->line('Settings') ?></th>
					<?php if ($this->aauth->get_user()->roleid > 4) { ?>
					<th>Config</th>
					<?php } ?>

                </tr>
                </thead>
                <tbody>
                </tbody>

                <tfoot>
                <tr >
                    <th>SMS</th>
                    <th>#</th>
					<th>Abonado</th>
					<th>Cedula</th>
                    <th><?php echo $this->lang->line('Name') ?></th>
					<th>Celular</th>
                    <th><?php echo $this->lang->line('Address') ?></th>
                    <th>Barrio</th>
                    <th>Serv. Suscritos</th>
					<th id="despues_de_tfoot">Estado</th>
                    <th><?php echo $this->lang->line('Settings') ?></th>
					<?php if ($this->aauth->get_user()->roleid > 4) { ?>
					<th>Config</th>
					<?php } ?>
                </tr>
                </tfoot>
            </table>
            <div style="float: right;" id="pagination_div">
            Seccionamiento ->
                        <a  id="pagination_0" onclick="filtrar(0)" >All&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <a  id="pagination_1" data-start="<?=$array_pagination['1']['start']?>" data-end="<?=$array_pagination['1']['end']?>" onclick="filtrar(1)">1&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <a  id="pagination_2" data-start="<?=$array_pagination['2']['start']?>" data-end="<?=$array_pagination['2']['end']?>" onclick="filtrar(2)">2&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <a  id="pagination_3" data-start="<?=$array_pagination['3']['start']?>" data-end="<?=$array_pagination['3']['end']?>" onclick="filtrar(3)">3&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <a  id="pagination_4" data-start="<?=$array_pagination['4']['start']?>" data-end="<?=$array_pagination['4']['end']?>" onclick="filtrar(4)">4&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <a  id="pagination_5" data-start="<?=$array_pagination['5']['start']?>" data-end="<?=$array_pagination['5']['end']?>" onclick="filtrar(5)">5&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <a  id="pagination_6" data-start="<?=$array_pagination['6']['start']?>" data-end="<?=$array_pagination['6']['end']?>" onclick="filtrar(6)">6&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <a  id="pagination_7" data-start="<?=$array_pagination['7']['start']?>" data-end="<?=$array_pagination['7']['end']?>" onclick="filtrar(7)">7&nbsp;&nbsp;&nbsp;&nbsp;</a>
            </div>
        </div>
        
    </div>

</article>

<script type="text/javascript">

    function selet_all_customers(elemento){
        var estado=$("#estado option:selected").val();
           
      
            var localidad= $("#cmbLocalidades option:selected").val();
            var barrio= $("#cmbBarrios option:selected").val();
            var nomenclatura= $("#nomenclatura option:selected").val();
            var numero1= $("#numero1").val();
            
            var adicionauno= $("#adicionauno option:selected").val();
            var numero2= $("#numero2").val();
            var adicional2= $("#adicional2 option:selected").val();
            var numero3= $("#numero3").val();
            var direccion = $("#sel_dir_personalizada option:selected").val();
            var sel_servicios = $("#sel_servicios option:selected").val();
            var morosos=$("#deudores option:selected").val();

            var ingreso_select=$("#fechas option:selected").val();
            var sdate=$("#sdate").val();
            var edate=$("#edate").val();
            var checked_ind_service =$("#check1").prop('checked');
            var url =baseurl+"clientgroup/get_filtrados_para_checked?id=<?=$_GET['id']?>&morosos="+morosos+"&estado="+estado+"&localidad="+localidad+"&barrio="+barrio+"&nomenclatura="+nomenclatura+"&numero1="+numero1+"&adicionauno="+adicionauno+"&numero2="+numero2+"&adicional2="+adicional2+"&numero3="+numero3+"&direccion="+direccion+"&sel_servicios="+sel_servicios+"&ingreso_select="+ingreso_select+"&sdate="+sdate+"&edate="+edate+"&checked_ind_service="+checked_ind_service;
             if(elemento.checked==true){
                $("#div_notify3").html('<div id="notify3" class="alert alert-success" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message3">></div></div>');
                    $("#notify3 .message3").html("<strong> Cargando</strong>: <img src='<?=base_url()?>/assets/img/iconocargando.gif'>");
                    $("#notify3").removeClass("alert-danger").removeClass("alert-success").addClass("alert-warning").fadeIn();
                    //$("html, body").animate({scrollTop: $('#notify3').offset().top}, 1000);

                $.post(url,{},function(data){
                    var puntos=1;
                    $(data).each(function(index,value){
                        var data1srt='{"id":'+(value.id)+',"celular":"'+(value.celular)+'"}';
                        var indice_elemento=lista_customers_sms.indexOf(data1srt);
                
                        if(indice_elemento==-1){
                            
                                lista_customers_sms.push(data1srt);
                        }

                    });
                    $("#div_notify3").html('<div id="notify3" class="alert alert-success" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message3">></div></div>');
                   $("#notify3 .message3").html("<strong> Cargando</strong>: Usuarios Seleccionados...");
                    $("#notify3").removeClass("alert-danger").removeClass("alert-warning").addClass("alert-success").fadeIn();
                    $("html, body").animate({scrollTop: $('#notify3').offset().top}, 1000);
                    $("input[type=checkbox]").prop("checked",true);        
                },'json');

                
        }else{
            $("input[type=checkbox]").prop("checked",false); 
            lista_customers_sms=[];   

        }
    }
    var tb;
    $(document).ready(function () {
$("#pagination_div").hide();
        tb=$('#fclientstable').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('clientgroup/grouplist') . '?id=' . $group['id']; ?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false, //set not orderable
                },
				
            ],	
            "language":{
                    "processing": "Procesando...",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "search": "Buscar:",
                    "infoThousands": ",",
                    "loadingRecords": "Cargando...",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                     "info": "Mostrando de _START_ a _END_ de _TOTAL_ entradas"

                }
			

        });
		

    });
</script>
<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?> </h4>
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('delete this customer') ?> </p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="customers/delete_i">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?> </button>
                <button type="button" data-dismiss="modal"
                        class="btn"><?php echo $this->lang->line('Cancel') ?> </button>
            </div>
        </div>
    </div>
</div>

<div id="sendMail" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('Sms to group') ?> </h4>
            </div>

            <div class="modal-body" id="emailbody">
                <form id="sendmail_form">


                    <div class="row">
                        <div class="col-xs-12 mb-1"><label
                                    for="shortnote"><?php echo $this->lang->line('Group Name') ?> </label>
                            <input type="text" class="form-control"
                                   value="<?php echo $group['title'] ?>"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 mb-1"><label
                                    for="shortnote"><?php echo $this->lang->line('Subject') ?></label>
                            <input type="text" class="form-control"
                                   name="subject" id="subject">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 mb-1"><label
                                    for="plantillas">Plantillas</label>
                        <select id="plantillas" class="form-control">
                            <option value="">-</option>
                            <?php foreach ($plantillas as $key => $value) {
                                echo "<option value='".$value['other']."'>".$value['name']."</option>";
                            } ?>
                        </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 mb-1"><label
                                    for="number">numero de telefono</label>
                            <input type="text" class="form-control"
                                   name="number" id="number">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 mb-1"><label
                                    for="shortnote"><?php echo $this->lang->line('Message') ?></label>
                            <textarea name="text" class="summernote" id="contents" title="Contents"></textarea></div>
                    </div>

                    <input type="hidden" class="form-control"
                           name="gid" value="<?php echo $group['id'] ?>">
                    <input type="hidden" id="action-url" value="clientgroup/sendGroup">


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('Close') ?> </button>
                <button type="button" class="btn btn-primary"
                        id="sendNow"><?php echo $this->lang->line('Send') ?> </button>
            </div>
        </div>
    </div>
</div>
<div id="sendSms" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('Sms to group') ?> </h4>
            </div>

            <div class="modal-body" id="emailbody">
                <form id="sendSMS_form">
<div id="div_notify2">
<div id="notify2" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message2"></div>
        </div>
</div>
<div id="div_notify4">

</div>
                    
                    <div class="row">
                        <div class="col-xs-12 mb-1"><label
                                    for="plantillas">Plantillas</label>
                        <select id="plantillas2" name="plantillas2" class="form-control" onchange="cargar_plantilla()">
                            <option value="">-</option>
                            
                            <?php foreach ($plantillas as $key => $value) {
                                echo "<option value='".$value['id']."' data-texto='".$value['other']."'>".$value['name']."</option>";
                            } ?>
                        </select>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-xs-12 mb-1"><label
                                    for="number">Nombre Campaña</label>
                            <input type="text" class="form-control"
                                   name="name_campaign" id="name_campaign" maxlength="10" minlength="10" >
                        </div>
                    </div>
                    <div class="row" id="div_numero_individual">
                        <div class="col-xs-12 mb-1"><label
                                    for="number">Numero de telefono individual</label>
                            <input type="text" class="form-control"
                                   name="number2" id="number2" maxlength="10" minlength="10" >
                        </div>
                    </div>
                    <div class="row" id="div_envio_masivo">
                        <div class="col-xs-12 mb-1"><label
                                    for="number">Numeros envio masivo</label>
                            <input type="text" class="form-control" readonly="true" 
                                   name="numerosMasivos" id="numerosMasivo" minlength="10" >
                                   <input type="text" class="form-control" hidden="true" 
                                   name="ultimo_lote" id="ultimo_lote"  >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 mb-1"><label
                                    for="shortnote"><?php echo $this->lang->line('Message') ?></label>
                            <textarea name="text2" class="form-control" maxlength="250" id="contents2" title="Contents"></textarea></div>
                    </div>
					<div class="row">
                        <div class="col-xs-12 mb-1"><label
                                    for="shortnote">Personalizar</label><br>
                            <span>1er Nombre = {primer_nombre}</span><br>
							<span>2do Nombre = {segundo_nombre}</span><br>
							<span>1er Apellido = {primer_apellido}</span><br>
							<span>2do Apellido = {segundo_apellido}</span><br>
							<span>Saldo = {monto_debe}</span><br>
                            <span>Documento = {documento}</span><br>
                            <span>Mes Actual = {mes_actual}</span><br>
						</div>
                    </div>
                    <input type="hidden" class="form-control"
                           name="gid" value="<?php echo $group['id'] ?>">
                    <input type="hidden" id="action-urlSMS" value="clientgroup/sendGroupSms">


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('Close') ?> </button>
                <button type="button" class="btn btn-primary"
                        id="sendNow2" onclick="enviar_SMS()"><?php echo $this->lang->line('Send') ?> </button>
            </div>
        </div>
    </div>
</div>

<div id="modal_corte_multiple_usuarios" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('Sms to group') ?> </h4>
            </div>

            <div class="modal-body" id="emailbody">
                <form id="corte-users_form">

<div id="div_notify5">

</div>
                    
                    <div class="row">
                        <div class="col-xs-12 mb-1"><label
                                    for="plantillas">Tipo de Corte</label>
                        <select id="tipo_corte" name="tipo_corte" class="form-control" onchange="cargar_plantilla()">
                            <option value="">-</option>
                            <option value="Corte Internet">Corte Internet</option>
                            <option value="Corte Television">Corte Television</option>
                            <option value="Corte Combo">Corte Combo</option>
                            
                        </select>
                        </div>
                    </div>
                    
                    
                    <div class="row" id="div_envio_masivo">
                        <div class="col-xs-12 mb-1"><label
                                    for="number">Customers</label>
                            <input type="text" class="form-control" readonly="true" 
                                   name="ids_customers_corte" id="ids_customers_corte" >
                                   
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 mb-1"><label
                                    for="shortnote"><?php echo $this->lang->line('Message') ?></label>
                            <textarea name="description_corte" class="form-control"  id="description_corte" title="Descripcion Corte"></textarea></div>
                    </div>
                    
                    <input type="hidden" class="form-control"
                           name="gid" value="<?php echo $group['id'] ?>">
                    <input type="hidden" id="action-url-cortes" value="clientgroup/cortar_usuarios_multiple">


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('Close') ?> </button>
                <button type="button" class="btn btn-primary"
                        id="sendNow4" onclick="realizar_corte_usuarios()">Realizar Corte de Usuarios </button>
            </div>
        </div>
    </div>
</div>

<div id="alert_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Informacion</h4>
            </div>

            <div class="modal-body" id="body_modal">
               <p>Ah ocurrido un error por la cantidad de registros, se va a segmentar por paginas automaticamente, seleccionando la 1</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('Close') ?> </button>
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function  filtrado_fechas(){
        var opcion_seleccionada=$("#fechas option:selected").val();
        if(opcion_seleccionada=="fecha_ingreso"){
            $("#div_fechas").show();
            
        }else{
            $("#div_fechas").hide();
        }
    }
    function cargar_plantilla(){
        var text=$("#plantillas2 option:selected").data("texto");
        
        if($("#plantillas2 option:selected").val()=="37"){
            $("#contents2").attr("maxlength",250);
        }else{
            $("#contents2").attr("maxlength",250);
        }
        
        $("#contents2").val(text);
    }
   

    var columnasAgregadas=false;
    function nuevas_columnas(){
        if(!columnasAgregadas){
              tb.destroy();
              $("#despues_de_thead").after("<th class='cols_adicionadas'>Ingreso</th>");
              $("#despues_de_tfoot").after("<th class='cols_adicionadas'>Ingreso</th>");
              $("#despues_de_thead").after("<th class='cols_adicionadas'>Suscripcion</th>");
              $("#despues_de_tfoot").after("<th class='cols_adicionadas'>Suscripcion</th>");
              $("#despues_de_thead").after("<th class='cols_adicionadas'>Deuda</th>");
              $("#despues_de_tfoot").after("<th class='cols_adicionadas'>Deuda</th>");

              var morosos=$("#deudores option:selected").val();

              var estado=$("#estado option:selected").val();
           
      
                var localidad= $("#cmbLocalidades option:selected").val();
                var barrio= $("#cmbBarrios option:selected").val();
                var nomenclatura= $("#nomenclatura option:selected").val();
                var numero1= $("#numero1").val();
                
                var adicionauno= $("#adicionauno option:selected").val();
                var numero2= $("#numero2").val();
                var adicional2= $("#adicional2 option:selected").val();
                var numero3= $("#numero3").val();
                var direccion = $("#sel_dir_personalizada option:selected").val();
                var sel_servicios = $("#sel_servicios option:selected").val();

                var ingreso_select=$("#fechas option:selected").val();
                var sdate=$("#sdate").val();
                var edate=$("#edate").val();
                var checked_ind_service =$("#check1").prop('checked');
              tb=$('#fclientstable').DataTable({

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('clientgroup/load_morosos') . '?id=' . $group['id']; ?>&morosos="+morosos+"&estado="+estado+"&localidad="+localidad+"&barrio="+barrio+"&nomenclatura="+nomenclatura+"&numero1="+numero1+"&adicionauno="+adicionauno+"&numero2="+numero2+"&adicional2="+adicional2+"&numero3="+numero3+"&direccion="+direccion+"&sel_servicios="+sel_servicios+"&ingreso_select="+ingreso_select+"&sdate="+sdate+"&edate="+edate+"&pagination_start="+pagination_start+"&pagination_end="+pagination_end+"&checked_ind_service="+checked_ind_service,
                    "type": "POST",
                    error: function (xhr, error, code)
                    {
                        
                    }
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                    {
                        "targets": [0], //first column / numbering column
                        "orderable": false, //set not orderable
                    },
                    
                ],  
                "language":{
                    "processing": "Procesando...",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "search": "Buscar:",
                    "infoThousands": ",",
                    "loadingRecords": "Cargando...",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                     "info": "Mostrando de _START_ a _END_ de _TOTAL_ entradas"

                }
                

            });
              columnasAgregadas=true;
      }
    }

    $(function () {
        $('.summernote').summernote({
            height: 100,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['fullscreen', ['fullscreen']],
                ['codeview', ['codeview']]
            ]
        });

        $('form').on('submit', function (e) {
            e.preventDefault();
            alert($('.summernote').summernote('code'));
            alert($('.summernote').val());
        });

        
    });
    var pagination_start="";
    var pagination_end="";
     
	function filtrar($pagination_id){
        $("#pagination_div").show();
            var estado=$("#estado option:selected").val();
           
      
            var localidad= $("#cmbLocalidades option:selected").val();
            var barrio= $("#cmbBarrios option:selected").val();
            var nomenclatura= $("#nomenclatura option:selected").val();
            var numero1= $("#numero1").val();
            
            var adicionauno= $("#adicionauno option:selected").val();
            var numero2= $("#numero2").val();
            var adicional2= $("#adicional2 option:selected").val();
            var numero3= $("#numero3").val();
            var direccion = $("#sel_dir_personalizada option:selected").val();
            var sel_servicios = $("#sel_servicios option:selected").val();
            var morosos=$("#deudores option:selected").val();

            var ingreso_select=$("#fechas option:selected").val();
            var sdate=$("#sdate").val();
            var edate=$("#edate").val();
            var checked_ind_service =$("#check1").prop('checked');
            if($pagination_id==0){
                pagination_end="";
                pagination_start="";
            }else{
                pagination_start=$("#pagination_"+$pagination_id).data("start");
                pagination_end=$("#pagination_"+$pagination_id).data("end");                                              
            }

                //color:blue;font-weight:900
            
            
                for (var i = 0; i <= 7; i++) {
                    
                    if(i!=$pagination_id){
                        $("#pagination_"+i).css("color","");
                        $("#pagination_"+i).css("font-weight","");        
                    }else{
                        $("#pagination_"+$pagination_id).css("color","blue");
                        $("#pagination_"+$pagination_id).css("font-weight","900");
                    }
                }

             
            //if(morosos!=""){
                if(columnasAgregadas){
                    tb.ajax.url( baseurl+'clientgroup/load_morosos?id=<?=$_GET['id']?>&morosos='+morosos+"&estado="+estado+"&localidad="+localidad+"&barrio="+barrio+"&nomenclatura="+nomenclatura+"&numero1="+numero1+"&adicionauno="+adicionauno+"&numero2="+numero2+"&adicional2="+adicional2+"&numero3="+numero3+"&direccion="+direccion+"&sel_servicios="+sel_servicios+"&ingreso_select="+ingreso_select+"&sdate="+sdate+"&edate="+edate+"&pagination_start="+pagination_start+"&pagination_end="+pagination_end+"&checked_ind_service="+checked_ind_service).load();               
                }else{
                    nuevas_columnas();
                    $("option[value=100]").text("Todo");
                }
           /* }else{
                tb.ajax.url( baseurl+'clientgroup/grouplist?estado='+estado+"&id=<?=$_GET['id']?>&localidad="+localidad+"&barrio="+barrio+"&nomenclatura="+nomenclatura+"&numero1="+numero1+"&adicionauno="+adicionauno+"&numero2="+numero2+"&adicional2="+adicional2+"&numero3="+numero3+"&direccion="+direccion+"&sel_servicios="+sel_servicios).load();         
            }*/
            
        
       

    }
 
 function reestablecer_seleciones(){
    lista_customers_sms=[];
    lista_customers_sms_aux=[];
 }
    function redirect_to_export(){
         var estado=$("#estado option:selected").val();
           
      
            var localidad= $("#cmbLocalidades option:selected").val();
            var barrio= $("#cmbBarrios option:selected").val();
            var nomenclatura= $("#nomenclatura option:selected").val();
            var numero1= $("#numero1").val();
            
            var adicionauno= $("#adicionauno option:selected").val();
            var numero2= $("#numero2").val();
            var adicional2= $("#adicional2 option:selected").val();
            var numero3= $("#numero3").val();
            var direccion = $("#sel_dir_personalizada option:selected").val();
            var sel_servicios = $("#sel_servicios option:selected").val();
            var morosos=$("#deudores option:selected").val();

            var ingreso_select=$("#fechas option:selected").val();
            var sdate=$("#sdate").val();
            var edate=$("#edate").val();
            var checked_ind_service =$("#check1").prop('checked');
            var url_redirect=baseurl+'clientgroup/explortar_a_excel?estado='+estado+"&id=<?=$_GET['id']?>&localidad="+localidad+"&barrio="+barrio+"&nomenclatura="+nomenclatura+"&numero1="+numero1+"&adicionauno="+adicionauno+"&numero2="+numero2+"&adicional2="+adicional2+"&numero3="+numero3+"&direccion="+direccion+"&sel_servicios="+sel_servicios+"&morosos="+morosos+"&ingreso_select="+ingreso_select+"&sdate="+sdate+"&edate="+edate+"&checked_ind_service="+checked_ind_service;
            window.location.replace(url_redirect);

    }
    $("#div_direccion_personalizada").hide();
    function act_sel_dir_personalizada(){
        var sel_dir_personalizada= $("#sel_dir_personalizada option:selected").val();
        if(sel_dir_personalizada==""){
            $("#div_direccion_personalizada").hide();
        }else{
            $("#div_direccion_personalizada").show();
        }
    }
    function abrir_modal_corte_usuarios(e){
        e.preventDefault();
        var lista_cadena="";
        $(lista_customers_sms).each(function(index,value){
        value=JSON.parse(value);
        if(lista_cadena!=""){
            lista_cadena=lista_cadena+","+value.id;    
        }else{
            lista_cadena=value.id;    
        }
        
    });

    
    $("#ids_customers_corte").val(lista_cadena);
    $("#div_notify5").html("");


        $("#modal_corte_multiple_usuarios").modal("show");
    }
    function realizar_corte_usuarios(){
        $("#div_notify5").append('<div id="notify_5" class="alert alert-warning" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message_5"></div></div>');        
        $("#notify_5 .message_5").html("Relizando Cortes</strong>: <img src='"+baseurl+"/assets/img/iconocargando.gif'>");
                    $("#notify_5").fadeIn();
                    $("html, body").animate({scrollTop: $('#notify_5').offset().top}, 1000);

        var o_data =  $("#corte-users_form").serialize();
        var action_url= $('#action-url-cortes').val();


        send_corte_multiple_form(o_data,action_url);
    }

    //seleccion multiple
    /*var f =1000;
    var y=f/500;
    if(y % 1==0){

        console.log(parseInt(y)+" lotes");
    }else{
        console.log(parseInt(y)+" +1 lotes");
    }*/
 function enviar_SMS(){
        //$("#div_notify2").html('<div id="notify2" class="alert alert-success" ><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message2"></div></div>');
        /*$("#div_notify3").html('<div id="notify_1" class="alert alert-warning" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message_1"></div></div>');        
        $("#notify_1 .message_1").html("<strong> Enviando Lote 1 de "+n_lotes_customers+"</strong>: <img src='<?=base_url()?>/assets/img/iconocargando.gif'>");
                    $("#notify_1").fadeIn();
                    $("html, body").animate({scrollTop: $('#notify_1').offset().top}, 1000);*/

        $("#div_notify4").append('<div id="notify_'+n_lote_actual_customers+'" class="alert alert-warning" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message_'+n_lote_actual_customers+'"></div></div>');        
        $("#notify_"+n_lote_actual_customers+" .message_"+n_lote_actual_customers).html("<strong> Enviando Lote "+n_lote_actual_customers+" de "+n_lotes_customers+"</strong>: <img src='"+baseurl+"/assets/img/iconocargando.gif'>");
                    $("#notify_"+n_lote_actual_customers).fadeIn();
                    $("html, body").animate({scrollTop: $('#notify_'+n_lote_actual_customers).offset().top}, 1000);
if(n_lote_actual_customers<n_lotes_customers){
    $("#ultimo_lote").val("no");
}else{
    $("#ultimo_lote").val("si");
}

         var o_data =  $("#sendSMS_form").serialize();
        var action_url= $('#action-urlSMS').val();


        sendMail_g(o_data,action_url);
}
    var n_lotes_customers=1;
    var n_lote_actual_customers=1;
    let lista_customers_sms_aux=[];
    var x=0;
    var y=0;
function abrir_modal_sms(e){
    
    e.preventDefault();
    //console.log(lista_customers_sms[0]);
    n_lotes_customers=1;
    n_lote_actual_customers=1;
    //console.log(lista_customers_sms.length);
    

    if(lista_customers_sms.length>500){
        var x= lista_customers_sms.length/500;
        if(x % 1==0){
            n_lotes_customers=parseInt(x);
        }else{
            n_lotes_customers=parseInt(x)+1;
        }
        lista_customers_sms_aux=lista_customers_sms;
      //saber cuantas veces voy a segmentar la lista, n_lotes_customers;
      //en que segmentacion esta, n_lote_actual_customers;
      //de que indice a que indice escojer segun la segmentacion, x, y;
      n_lote_actual_customers=1;
      x=0;
      y=499;
      lista_customers_sms=lista_customers_sms.slice(x,y);

    }
    //console.log(lista_customers_sms.length);
    $("#sendSms").modal("show");
    var lista_cadena="";
    $(lista_customers_sms).each(function(index,value){
        value=JSON.parse(value);
        if(lista_cadena!=""){
            lista_cadena=lista_cadena+","+value.id+"-"+value.celular;    
        }else{
            lista_cadena=value.id+"-"+value.celular;    
        }
        
    });

    if(lista_cadena==""){
        $("#div_envio_masivo").hide();
        $("#div_numero_individual").show();
    }else{
        $("#div_envio_masivo").show();
        $("#div_numero_individual").hide();
    }
    $("#numerosMasivo").val(lista_cadena);
    $("#div_notify4").html("");
}
    let lista_customers_sms=[];
 function agregar_customer_envio_sms(elemento){
        var data1srt='{"id":'+$(elemento).data("id-customer")+',"celular":"'+$(elemento).data("celular")+'"}';
        var indice_elemento=lista_customers_sms.indexOf(data1srt);
        
        if(indice_elemento==-1){
                if(elemento.checked==true){
                    lista_customers_sms.push(data1srt);                   
                }
        }else{
            if(elemento.checked==false){
                lista_customers_sms.splice(indice_elemento,1);
            }
        }
      /* var y="";
        $(lista_customers_sms).each(function(index){
            if(y==""){
                y=this;
            }else{
                y+=","+this;
            }
        });
        if(y==""){
            $("#span_facturas").hide();
        }else{
            $("#span_facturas").text(" Orden Facturas a Pagar : "+y);
            $("#span_facturas").show();
            $("#in_shortnote").val("Pago de la factura #"+y);
        }*/
        
    }
    
$("#fclientstable").on('draw.dt',function (){
        $(lista_customers_sms).each(function(index,value){
           value= JSON.parse(value);
            var checked_seleccionado=document.getElementById("input_"+value.id);            
            try{
                if(checked_seleccionado.checked==false){
                        console.log("si esta imprimiendo todo esta bien Gloria Al Dios Altisimo Jesus de Nazaret.");
                        $(checked_seleccionado).prop("checked",true);

                }
            }catch(error){

            }
            
        });

    });
    //end seleccion multiple

   
    var localidad_Yopal = new Array ("-","ComunaI","ComunaII","ComunaIII","ComunaIV","ComunaV","ComunaVI");
    var localidad_Monterrey = new Array ("-","Ninguno");
    var localidad_Villanueva = new Array ("-","SinLocalidad");
    var localidad_Mocoa = new Array ("-","Ninguna");
     cambia4();
                            //crear funcion que ejecute el cambio
                            function cambia4(){
                                var ciudad;
                                ciudad = $("#cmbCiudades option:selected").val();
                                //se verifica la seleccion dada
                                if(ciudad!=0 && ciudad!="-"){
                                    mis_opts=eval("localidad_"+ciudad);
                                    $("#cmbLocalidades").find('option').remove().end();
                                    for (var i = 0; i < mis_opts.length; i++) {
                                        $('#cmbLocalidades').append(new Option(mis_opts[i], mis_opts[i]));
                                    }
                                    
                                }else{
                                    $("#cmbLocalidades").find('option').remove().end();
                                    $('#cmbLocalidades').append(new Option("-", "-"));                                           
                                }
                                
                            }

                            var barrio_ComunaI = new Array ("-","Bello horizonte","Brisas del Cravo","El Batallon","El Centro","El Libertador","La Corocora","La Estrella bon Habitad","la Pradera","Luis Hernandez Vargas","San Martin","La Arboleda");
    var barrio_ComunaII = new Array ("-","El Triunfo","Comfacasanare","Conjunto Residencial Comfaboy","El Bicentenario","El Remanso","Juan Pablo","La Floresta","Los Andes","Los Helechos","Los Heroes","Maria Milena","Puerta Amarilla","Valle de los guarataros","Villa Benilda","Barcelona","Ciudad Jardín","Juan Hernando Urrego","Unión San Carlos","Laureles","Villa Natalia");
    var barrio_ComunaIII = new Array ("-","20 De Julio","Aerocivil","El Gavan","El Oasis","El Recuerdo","La Amistad","Maria Paz","Mastranto II","Provivienda");
    var barrio_ComunaIV = new Array ("-","1ro de Mayo","Araguaney","Vencedores","Casiquiare","El Bosque","La Campiña","La Esperanza","Las Palmeras","Paraíso","Villa Rocío");
    var barrio_ComunaV = new Array ("-","Ciudad del Carmen","La Victoria","Bella Vista","La Libertad","La Resistencia","Los Angeles","Ciudadela San Jorge","Casimena I","Casimena II","Casimena III","El Laguito","El Nogal","El Portal","El Progreso","La Primavera","Los Almendros","Maranatha","Montecarlo","Nuevo Hábitat","Nuevo Hábitat II","Nuevo Milenio","San Mateo","Villa Nelly","Villa Vargas","Villas de Chavinave");
    var barrio_ComunaVI = new Array ("-","Villa Lucia","Villa Salomé 1","Xiruma","Llano Vargas","Bosques de Sirivana","Bosques de Guarataros","Villa David","Getsemaní","Villa Salomé 2","Las americas","Puente Raudal","Camoruco");
    var barrio_Ninguno = new Array ("-","Palmeras","Pradera","Esperanza","Villa del prado","Primavera","Nuevo milenio","San jose","Centro","Panorama","Alfonso lopez","Rivera de san andres","Rosales","Nuevo horizonte","La roca","Paomera","Floresta","Alcaravanes","Morichito","Villa santiago","15 de octubre","Glorieta","Olimpico","Brisas del tua","Guaira","Esteros","Villa del bosque","Villa mariana","Guadalupe","Leche miel","Lanceros","Paraiso","El caney","Villa daniela","Julia luz","Los esteros");
    var barrio_SinLocalidad = new Array ("-","Banquetas","Bella Vista","Bello Horizonte","Brisas del Agua Clara","Brisas del Upia I","Brisas del Upia II","Buenos Aires","Caricare","Centro","Ciudadela la Virgen","Comuneros","El Bosque","El Morichal","El Morichalito","El Portal","Fundadores","La floresta","Las Vegas","Mirador","Palmeras","Panorama","Paraiso I","Paraiso II","Progreso","Quintas del Camino Real","Villa Alejandra","Villa Campestre","Villa Estampa","Villa Luz","Villa del Palmar","Villa Mariana","Villa de los angeles");
    var barrio_Ninguna = new Array ("-","Venecia","Villa Caimaron","Villa Colombia","Villa Daniela","Villa del Norte","Villa del rio","Villa Diana","Villa Natalia","Villa Nueva","Palermo","Paraiso","Peñan","Pinos","Piñayaco","Placer","Plaza de Mercado","Prados","Progreso","Rumipamba","San Andres","San Agustin","San Fernando","San Francisco","La Loma","La union","Las Vegas","Libertador","Loma","Los Angeles","Miraflores","Modelo","Naranjito","Nueva Floresta","Obrero 1","Obrero 2","Olimpico","Pablo VI","Pablo VI bajo");
                            //crear funcion que ejecute el cambio
                            function cambia5(){
                                var localidad;
                                localidad = $("#cmbLocalidades option:selected").val();
                                //se verifica la seleccion dada
                                if(localidad!=0 && localidad!="-"){
                                    mis_opts=eval("barrio_"+localidad);
                                    //definimos cuantas obciones hay
                                    $("#cmbBarrios").find('option').remove().end();
                                    for (var i = 0; i < mis_opts.length; i++) {
                                        $('#cmbBarrios').append(new Option(mis_opts[i], mis_opts[i]));
                                    }
                                }else{
                                //resultado si no hay obciones
                                    $("#cmbBarrios").find('option').remove().end();
                                    $('#cmbBarrios').append(new Option("-", "-"));                                              
                                }
                                
                            }

function ckekar_1(){
    var selecccionado =$("#check1").prop('checked');
    if(selecccionado){
        $("#check1").prop('checked',false);
    }else{
        $("#check1").prop('checked',true);
    }
}                            
</script>                   