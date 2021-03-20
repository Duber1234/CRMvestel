<article class="content content items-list-page">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
		 <div class="card card-block sameheight-item">

                        
                            <div class="form-group row">
								<label class="col-sm-12 col-form-label"
                                       for="pay_cat"><h5>FILTRAR</h5></label>
                                <label class="col-sm-2 col-form-label"
                                       for="pay_cat">Estado</label>

                                <div class="col-sm-6">
                                    <select name="tec" class="form-control" id="estado">
                                        <option value=''>Todos</option>
                                        <option value='Activo'>Activos</option>
										<option value='Cortado'>Cortados</option>
                                        <option value='Suspendido'>Suspendidos</option>
                                        <option value='Instalar'>Instalar</option>
                                    </select>
                                </div>
                            </div>
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
                            </div>
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
                             <div class="form-group row">
                                
                                <label class="col-sm-2 col-form-label"
                                       for="pay_cat">Deudores Morosos</label>

                                <div class="col-sm-6">
                                    <select name="tec" class="form-control" id="deudores">
                                        <option value=''>Todos</option>
                                        <option value='Si'>Morosos</option>
                                    </select>
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="pay_cat"></label>

                                <div class="col-sm-4">
                                    <input type="button" class="btn btn-primary btn-md" value="VER" onclick="filtrar()">


                                </div>
                            </div>
                        
                    </div>
        <div class="grid_3 grid_4">
            <h5><?php echo $this->lang->line('Client Group') . '- ' . $group['title'] ?></h5> 
			<a href="#sendMail" data-toggle="modal" data-remote="false" class="btn btn-primary btn-sm"><i
                        class="fa fa-envelope"></i> <?php echo $this->lang->line('Send Group Message') ?> </a>
            <hr>
            <table id="fclientstable" class="table-striped" cellspacing="0" width="100%">
                <thead>
                <tr id="thead_tr">
                    <th>#</th>
					<th>Abonado</th>
					<th>Cedula</th>
                    <th><?php echo $this->lang->line('Name') ?></th>
					<th>Celular</th>
                    <th><?php echo $this->lang->line('Address') ?></th>
					<th>Estado</th>
                    <th><?php echo $this->lang->line('Settings') ?></th>
					<?php if ($this->aauth->get_user()->roleid > 4) { ?>
					<th>Config</th>
					<?php } ?>

                </tr>
                </thead>
                <tbody>
                </tbody>

                <tfoot>
                <tr id="tfoot_tr">
                    <th>#</th>
					<th>Abonado</th>
					<th>Cedula</th>
                    <th><?php echo $this->lang->line('Name') ?></th>
					<th>Celular</th>
                    <th><?php echo $this->lang->line('Address') ?></th>
					<th>Estado</th>
                    <th><?php echo $this->lang->line('Settings') ?></th>
					<?php if ($this->aauth->get_user()->roleid > 4) { ?>
					<th>Config</th>
					<?php } ?>
                </tr>
                </tfoot>
            </table>
        </div>
        <a href="#" onclick="redirect_to_export()" class="btn btn-primary btn-md">Exportar a Excel .XLSX</a>
    </div>

</article>

<script type="text/javascript">
    var tb;
    $(document).ready(function () {

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
                <h4 class="modal-title"><?php echo $this->lang->line('Email to group') ?> </h4>
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

<div id="informcion" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Informacion</h4>
            </div>

            <div class="modal-body" >
                 <h1 id="h1_info"></h1>
                 <a id="link_facturas" target="_blank" class="btn btn-info btn-sm" href=""><span class="icon-eye"></span>&nbsp;Ver Facturas del Customer</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('Close') ?> </button>
                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

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
	function filtrar(){
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
            if(morosos=="Si"){
                tb.ajax.url( baseurl+'clientgroup/load_morosos?id=<?=$_GET['id']?>').load();               
            }else{
                tb.ajax.url( baseurl+'clientgroup/grouplist?estado='+estado+"&id=<?=$_GET['id']?>&localidad="+localidad+"&barrio="+barrio+"&nomenclatura="+nomenclatura+"&numero1="+numero1+"&adicionauno="+adicionauno+"&numero2="+numero2+"&adicional2="+adicional2+"&numero3="+numero3+"&direccion="+direccion+"&sel_servicios="+sel_servicios).load();         
            }
            
        
       

    }
    function mostrar_informacion(link){
        $("#h1_info").text($(link).attr("title"));
        $("#link_facturas").attr('href',$(link).data("url"));
        $("#informcion").modal("show");
    }
    window.addEventListener("keyup", function(event){
    var codigo = event.keyCode || event.which;
        if (codigo == 27){
            $("#informcion").modal("hide");
        }
    }, false);
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
            var url_redirect=baseurl+'clientgroup/explortar_a_excel?estado='+estado+"&id=<?=$_GET['id']?>&localidad="+localidad+"&barrio="+barrio+"&nomenclatura="+nomenclatura+"&numero1="+numero1+"&adicionauno="+adicionauno+"&numero2="+numero2+"&adicional2="+adicional2+"&numero3="+numero3+"&direccion="+direccion+"&sel_servicios="+sel_servicios;
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
    var barrio_ComunaV = new Array ("-","Ciudad del Carmen","Ciudadela San Jorge","Casimena I","Casimena II","Casimena III","El Laguito","El Nogal","El Portal","El Progreso","La Primavera","Los Almendros","Maranatha","Montecarlo","Nuevo Hábitat","Nuevo Hábitat II","Nuevo Milenio","San Mateo","Villa Nelly","Villa Vargas","Villas de Chavinave");
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
</script>                   