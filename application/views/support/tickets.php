<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="grid_3 grid_4">
            <div class="header-block">
                <h3 class="title">
                    <?php echo $this->lang->line('Support Tickets') ?>
                </h3></div>


            <p>&nbsp;</p>
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-xs-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-block">
                                <div class="media">
                                    <div class="media-body text-xs-left">
										<?php $numero_asignados= $this->db->select('count(idt) as numero')->from('tickets')->where('status="Pendiente"')->get()->result(); ?>
                                        <h3 class="pink"><?=$numero_asignados[0]->numero?></h3>
                                        <span><?php echo $this->lang->line('Waiting') ?></span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <i class="icon-clock3 pink font-large-2 float-xs-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-xs-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-block">
                                <div class="media">
                                    <div class="media-body text-xs-left">
										<?php $numero_asignados= $this->db->select('count(idt) as numero')->from('tickets')->where('status="Realizando"')->get()->result(); ?>
                                        <h3 class="indigo"><?=$numero_asignados[0]->numero?></h3>
                                        <span><?php echo $this->lang->line('Processing') ?></span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <i class="icon-spinner5 indigo font-large-2 float-xs-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-xs-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-block">
                                <div class="media">
                                    <div class="media-body text-xs-left">
										<?php $numero_asignados= $this->db->select('count(idt) as numero')->from('tickets')->where('status="Resuelto"')->get()->result(); ?>
                                        <h3 class="green"><?=$numero_asignados[0]->numero?></h3>
                                        <span><?php echo $this->lang->line('Solved') ?></span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <i class="icon-clipboard2 green font-large-2 float-xs-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-xs-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-block">
                                <div class="media">
                                    <div class="media-body text-xs-left">
                                        <h3 class="deep-cyan"><?php echo $totalt ?></h3>
                                        <span><?php echo $this->lang->line('Total') ?></span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <i class="icon-stats-bars22 deep-cyan font-large-2 float-xs-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                       aria-expanded="true">Tecnico</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="link-tab" data-toggle="tab" href="#link"
                                       aria-controls="link"
                                       aria-expanded="false">Estado</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="thread-tab" data-toggle="tab" href="#thread"
                                       aria-controls="thread">Fechas</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="milestones-tab" data-toggle="tab" href="#milestones"
                                       aria-controls="milestones"> Sede</a>
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
                                               for="pay_cat">Tecnico</label>

                                        <div class="col-sm-6">
                                            <select name="tec" class="form-control" id="tecnicos2">
                                                <option value='0'>Todos</option>
                                                <?php
                                                    foreach ($tecnicoslista as $row) {
                                                        $cid = $row['id'];
                                                        $title = $row['username'];
                                                        echo "<option value='$title' data-id='$cid'>$title</option>";
                                                    }
                                                    ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="link" role="tabpanel" aria-labelledby="link-tab" aria-expanded="false">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"
                                                   for="pay_cat">Estado</label>

                                            <div class="col-sm-6">
                                                <select name="trans_type" class="form-control" id="estados">
                                                    <option value=''>Todas</option>
                                                    <option value='Pendiente'>Pendiente</option>
                                                    <option value='Resuelto'>Resuelto</option>
                                                </select>
                                            </div>                              
                                        </div>    
                                </div>
                                <!--thread-->
                                <div class="tab-pane fade" id="thread" role="tabpanel" aria-labelledby="thread-tab" aria-expanded="false">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"
                                               for="pay_cat">Fechas</label>

                                        <div class="col-sm-6">
                                            <select name="trans_type" class="form-control" id="fechas" onchange="filtrado_fechas()">
                                                <option value=''>Todas</option>
                                                <option value='fcreada'>Fecha Creada</option>
                                                <option value='fcierre'>Fecha Cierre</option>
                                            </select>
                                        </div>                              
                                    </div>
                                    <div class="form-group row" id="div_fechas" style="display: none">
                                        <label class="col-sm-2 col-form-label"
                                               for="pay_cat" id="label_fechas">Fecha Creada</label>

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
                                <!--thread-->
                                <!--milestones-->
                                <div class="tab-pane fade" id="milestones" role="tabpanel" aria-labelledby="milestones-tab" aria-expanded="false">
                                     
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"
                                                   for="sede_sel">Sede</label>

                                            <div class="col-sm-6">
                                                <select name="sede_sel" class="form-control" id="sede_sel">                                        
                                                    <option value="">Todo</option>
                                                    <?php 
                                                            foreach ($listaclientgroups as $key => $sede) {
                                                                echo "<option value='".$sede['id']."'>".$sede['title']."</option>";
                                                            }

                                                     ?>                                        
                                                </select>
                                            </div>                              
                                        </div>

                                </div>
                                <!--milestones-->
                                <!--otro filtro 
                                <div class="tab-pane fade" id="activities" role="tabpanel" aria-labelledby="activities-tab" aria-expanded="false">

                                </div>
                                activities-->
                                
                                


                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="pay_cat"></label>

                                <div class="col-sm-4">
                                    <input type="button" class="btn btn-primary btn-md" value="VER" onclick="filtrar()">


                                </div>
                            </div>
                </div>
                <!-- fin paneles -->

			<div class="table-responsive">
            <table id="doctable" class="table table-hover" cellspacing="0" width="100%">
                <thead>
                <tr>
					<th>#</th>
					<th><i class="icon-marquee"></th>
					<th>N° orden</th>	
                    <th><?php echo $this->lang->line('Subject') ?></th>
					<th>Detalle</th>
                    <th>F/creada</th>
					<th>F/cierre</th>
					<th>Abonado</th>
					<th>Usuario</th>
                    <th>Factura</th>
					<th>Asignado</th>
					<th>Sede</th>
					<th>Estado</th>
                    <th>Accion</th>
					<?php if ($this->aauth->get_user()->roleid >= 3) { ?>
					<th>Config</th>
					<?php } ?>

                </tr>
                </thead>
                <tbody>
				
                </tbody>

            </table>
			</div>
			 <div class="col-md-12">
			<h6 class="colspan 1">ASIGNAR ORDEN</h6>
			</div>
			<div class="col-xs-3 mb-1">
			<select name="asignado" id="tecnicos" class="form-control mb-1">
				<?php
					foreach ($tecnicoslista as $row) {
						$cid = $row['id'];
						$title = $row['username'];
						echo "<option value='$title'>$title</option>";
					}
					?>
			</select>
				</div>
			<div class="col-xs-2 mb-1">
				<input type="hidden" id="action-url" value="tickets/update_status">
                        <button type="button" class="btn btn-primary"
                                onclick="asignar_tecnico()">Asignar</button>
			</div>
			
			</div>
        </div>
    </div>
    <input type="hidden" id="dashurl" value="tickets/ticket_stats">
</article>

<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('delete this ticket') ?></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="tickets/delete_ticket">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var tb;
    $(document).ready(function () {

        tb=$('#doctable').DataTable({

            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php if (isset($_GET['filter'])) {
                    $filter = $_GET['filter'];
                } else {
                    $filter = '';
                }    echo site_url('tickets/tickets_load_list?stat=' . $filter)?>",
                "type": "POST"
            },
            "columnDefs": [
                {
                    "targets": [0],
                    "orderable": false,
                },
            ],
			"order": [[ 2, "desc" ]],
                "language": {
                    "info": "Pagina _PAGE_ de _PAGES_",
                    "zeroRecords": "No se encontraron resultados",
                    "processing": "Procesando...",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                }

        });
        //miniDash();

 

     

       
    });
 /*  lo comento porque no fue necesario, porque puedo validar solo con una serie de fechas y no necesito estos campos pero lo dejo porque es funcional para futuras ediciones con fecha
    
    function editar_datepickerts(formato,fecha){
        $('#sdate3').datepicker({autoHide: true, format: formato});
        $('#sdate3').datepicker('setDate', fecha);
    }
*/
  function  filtrado_fechas(){
        var opcion_seleccionada=$("#fechas option:selected").val();
        if(opcion_seleccionada=="fcreada"){
            $("#div_fechas").show();
            $("#label_fechas").text("Fecha Creada")
        }else if(opcion_seleccionada=="fcierre"){
            $("#label_fechas").text("Fecha Cierre")
            $("#div_fechas").show();
        }else{
            $("#div_fechas").hide();
        }
    }

    let lista_ordenes=[];
    function asignar_orden(elemento){
        var indice_elemento=lista_ordenes.indexOf($(elemento).data("id"));
        
        if(indice_elemento==-1){
                if(elemento.checked==true){
                    lista_ordenes.push($(elemento).data("id"));                   
                }
        }else{
            if(elemento.checked==false){
                lista_ordenes.splice(indice_elemento,1);
            }
        }
    }

    $("#doctable").on('draw.dt',function (){
        $(lista_ordenes).each(function(index,value){
            var checked_seleccionado=document.getElementById("input_"+value);            
            try{
                if(checked_seleccionado.checked==false){
                        console.log("si esta imprimiendo todo esta bien Gloria Al Dios Altisimo Jesus de Nazaret.");
                        $(checked_seleccionado).prop("checked",true);

                }
            }catch(error){

            }
            
        });

    });
    function asignar_tecnico (){
        var id_tecnico_seleccionado=$("#tecnicos").val();
	
        $.post(baseurl+"tickets/asignar_ordenes",{id_tecnico_seleccionado:id_tecnico_seleccionado,lista:lista_ordenes},function(data){

                if(data=="correcto"){
                    var url1=baseurl+"tickets/";
                    window.location.replace(url1);
                }
        });
    }
    function eliminar_ticket(id){
        var confirmacion = confirm("Deseas Eliminar esta orden ?");
        if(confirmacion==true){
            $.post(baseurl+"tickets/delete_ticket",{deleteid:id},function (data){
                alert("Orden Eliminada...");                
                window.location.reload();
            },'json');
      }
    }
    function filtrar(){
        var tecnico=$("#tecnicos2 option:selected").val();
        var estado =$("#estados option:selected").val();
        var sdate =$("#sdate").val();
        var edate =$("#edate").val();
        var opcion_seleccionada=$("#fechas option:selected").val();
        var sede_filtrar=$("#sede_sel option:selected").val();
        if(tecnico=="" && estado=="" && opcion_seleccionada=="" && ciudad_filtrar==""){
            tb.ajax.url( baseurl+'tickets/tickets_load_list?stat=' ).load();     
        }else{
            var id1=$("#tecnicos2 option:selected").data("id");
            tb.ajax.url( baseurl+"tickets/tickets_load_list?sdate="+sdate+"&edate="+edate+"&opcselect="+opcion_seleccionada+"&tecnico="+tecnico+"&estado="+estado+"&tec1="+id1+"&sede_filtrar="+sede_filtrar+"&stat=" ).load();     
        }
       

    }
</script>
