<?php
/**
 * Neo Billing -  Accounting,  Invoicing  and CRM Software
 * Copyright (c) Rajesh Dukiya. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@ultimatekode.com
 *  Website: https://www.ultimatekode.com
 *
 *  ************************************************************************
 *  * This software is furnished under a license and may be used and copied
 *  * only  in  accordance  with  the  terms  of such  license and with the
 *  * inclusion of the above copyright notice.
 *  * If you Purchased from Codecanyon, Please read the full License from
 *  * here- http://codecanyon.net/licenses/standard/
 * ***********************************************************************
 */

defined('BASEPATH') OR exit('No direct script access allowed');
class Clientgroup extends CI_Controller
{
    
    public function __construct()
    {

        parent::__construct();
        $this->load->model('clientgroup_model', 'clientgroup');
        $this->load->model('customers_model', 'customers');
               
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        if ($this->aauth->get_user()->roleid < 2) {

            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');

        }
    }

    //groups
    public function index()
    {
        $data['group'] = $this->customers->group_list();
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Client Groups';
        $this->load->view('fixed/header', $head);
        $this->load->view('groups/groups', $data);
        $this->load->view('fixed/footer');
    }
    public function explortar_a_excel(){
        set_time_limit(3000);
        $this->db->select("*");
        $this->db->from("customers");        
        $this->db->where("gid",$_GET['id']);
        if (isset($_GET['estado']) && $_GET['estado'] != '' && $_GET['estado'] != null) {
            $this->db->where('usu_estado=', $_GET['estado']);
        }
        if (isset($_GET['direccion']) &&$_GET['direccion'] =="Personalizada"){ 
            if ($_GET['localidad'] != '' && $_GET['localidad'] != '-' && $_GET['localidad'] != '0') {
                $this->db->where('localidad=', $_GET['localidad']);
            }

            if ($_GET['barrio'] != '' && $_GET['barrio'] != '-' && $_GET['barrio'] != '0') {
                $this->db->where('barrio=', $_GET['barrio']);
            }
            if ($_GET['nomenclatura'] != '' && $_GET['nomenclatura'] != '-') {
                $this->db->where('nomenclatura=', $_GET['nomenclatura']);
            }
            if ($_GET['numero1'] != '') {
                $this->db->where('numero1=', $_GET['numero1']);
            }
            if ($_GET['adicionauno'] != '' && $_GET['adicionauno'] != '-') {
                $this->db->where('adicionauno=', $_GET['adicionauno']);
            }
            if ($_GET['numero2'] != '' && $_GET['numero2'] != '-') {
                $this->db->where('numero2=', $_GET['numero2']);
            }
            if ($_GET['adicional2'] != '' && $_GET['adicional2'] != '-') {
                $this->db->where('adicional2=', $_GET['adicional2']);
            }
            if ($_GET['numero3'] != '' && $_GET['numero3'] != '-') {
                $this->db->where('numero3=', $_GET['numero3']);
            }
        }
        $lista_customers=$this->db->get()->result();
        $cust_group=$this->db->get_where("customers_group",array('id' => $_GET['id']))->row();
        
        //codigo para hacer filtros por mora y servicios

        $lista_customers2=array();
        
        foreach ($lista_customers as $key => $customers) {
            $due=$this->customers->due_details($customers->id);
            $money=$this->customers->money_details($customers->id);
            $customers->money=$money['credit']-$money['debit'];
            $debe_customer=($due['total']-$due['pamnt'])+$money['debit'];//se agrego el campo de money debit por el item de gastos que se mencino en fechas anteriores
            $lista_invoices = $this->db->from("invoices")->where("csd",$customers->id)->order_by('invoicedate',"DESC")->get()->result();
            $customer_moroso=false;
            $valor_ultima_factura=0;
            $_var_tiene_internet=false;
            $_var_tiene_tv=false;
            $suscripcion_str="";
            if($debe_customer==0){
                $customer_moroso=false;
            }
                $fact_valida=false;
                foreach ($lista_invoices as $key => $invoice) {
                    $suma=0;
                    if($invoice->combo!="no" && $invoice->combo!="" && $invoice->combo!="-"){
                        $fact_valida=true;
                        $_var_tiene_internet=true;
                    }
                    if($invoice->television!="no" && $invoice->television!="" && $invoice->television!="-"){
                        $fact_valida=true;
                        $_var_tiene_tv=true;
                    }
                    if($invoice->ron!="" && $invoice->ron!=null){
                        $fact_valida=true;
                    }
                    if($fact_valida){
                        if($_var_tiene_tv){
                            if(str_replace(" ", "", $invoice->refer)=="Mocoa"){
                                $producto=$this->db->get_where('products', array("pid"=>"159"))->row();
                                $suma+=$producto->product_price;
                            }else{
                                $producto=$this->db->get_where('products', array("pid"=>"27"))->row();
                                $suma+=$producto->product_price+3992;
                            }
                            if($producto!=null){
                                $suscripcion_str="Tv";
                            }
                            
                        }

                        if($_var_tiene_internet){
                            $lista_de_productos=$this->db->from("products")->like("product_name","mega","both")->get()->result();
                            $var_e=strtolower(str_replace(" ", "",$invoice->combo));
                            foreach ($lista_de_productos as $key => $prod) {
                                $prod->product_name=strtolower(str_replace(" ", "",$prod->product_name ));
                                if($prod->product_name==$var_e){
                                    $suma+=$prod->product_price;                                    
                                    break;
                                }
                            }

                            if(!empty($var_e)){
                                if($suscripcion_str!=""){
                                    $suscripcion_str.="+".$var_e;
                                }else{
                                    $suscripcion_str=$var_e;
                                }    
                            }
                        }
                        
                    }
                    $invoice->total=$suma;
                   // if(!$fact_valida){
                        /*    $query=$this->db->query('SELECT * FROM `invoice_items` WHERE tid='.$invoice->tid.' and (product like "%mega%" or product like "%tele%" or product like "%punto adicional%")')->result_array();
                            if(count($query)!=0){
                                $fact_valida=true;
                                $suma=0;
                                foreach ($query as $key => $value) {
                                    if(strpos(strtolower($value['product']),"reconexi" )!==false || strpos(strtolower($value['product']),"afiliaci" )!==false){
                                            
                                    }else{
                                        $suma+=$value['subtotal'];    
                                    }
                                    
                                    //si se selecciona el filtro por servicios realiza este filtro
                                    if(isset($_GET['sel_servicios']) && $_GET['sel_servicios'] != '' && $_GET['sel_servicios'] != null){
                                        if(strpos(strtolower($value['product']),"mega" )!==false){
                                            $_var_tiene_internet=true;
                                        }
                                        if(strpos(strtolower($value['product']),"television" )!==false){
                                            $_var_tiene_tv=true;   
                                        }
                                    }

                                }
                                $invoice->total=$suma;
                            }*/
                   // }
                    if($_GET['morosos']=="1mes"){
                        if($fact_valida && $debe_customer==$invoice->total && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }
                    }else if($_GET['morosos']=="masdeunmes"){
                        if($fact_valida && $debe_customer>$invoice->total && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }
                    }else if($_GET['morosos']=="2meses"){
                        if($fact_valida && $debe_customer>=($invoice->total*2) && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }
                    }else if($_GET['morosos']=="3y4meses"){
                        if($fact_valida && $debe_customer>=($invoice->total*3) && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }
                    }else if($_GET['morosos']=="Todos"){
                        if($fact_valida && $debe_customer>0 && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }
                    }else if($_GET['morosos']=="saldoaFavor"){
                        if($fact_valida && $debe_customer<0 && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }

                    }else if($_GET['morosos']=="al Dia"){
                        if($fact_valida && $debe_customer==0 && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }

                    }else if($_GET['morosos']==""){
                        if($fact_valida){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;
                        }

                    }

                    
                }    
            
            //filtro por servicios con morosos
            if(isset($_GET['sel_servicios']) && $_GET['sel_servicios'] != '' && $_GET['sel_servicios'] != null ){
                //aunque sea moroso pero para aplicar el filtro se va a cambiar la variable moroso
               
                if($_GET['morosos']==""){//para que muestre todos si esta seleccionada esta opcion, probar si colocando esta condicion encima del if funciona bien para eliminar y dejar solo una
                    $customer_moroso=true;
                }

                if($_GET['sel_servicios']=="Internet" && !$_var_tiene_internet){
                            $customer_moroso=false;                        
                }else if($_GET['sel_servicios']=="TV" && !$_var_tiene_tv){//preguntar que si solo debe de filtrar los que tienen tv o si tiene tv pero tambien internet lo puede listar lo mismo con la de internet
                            $customer_moroso=false;     
                }else if($_GET['sel_servicios']=="Combo" ){
                    if(!$_var_tiene_internet || !$_var_tiene_tv){
                        $customer_moroso=false;
                    }
                }

            }else{
                if($_GET['morosos']==""){//para que muestre todos si esta seleccionada esta opcion
                    $customer_moroso=true;
                }
            }
            //end fitro por servicios con morosos 

            if($customer_moroso){
                $customers->deuda=$debe_customer;
                $customers->suscripcion=$valor_ultima_factura;            
                $customers->suscripcion_str=$suscripcion_str;
                $lista_customers2[] = $customers;
            }else{

            }
             
        }
        //fin codigo para hacer filtros por mora y servicios


        
        $this->load->library('Excel');
    
    //define column headers
    $headers = array('Abonado' => 'string','Cedula' => 'string', 'Nombre' => 'string', 'Celular' => 'string', 'Direccion' => 'string','Barrio' => 'string','Serv. Suscritos' => 'string', 'Estado' => 'string','Deuda' => 'integer','Suscripcion' => 'integer','Ingreso' => 'integer');
    
    //fetch data from database
    //$salesinfo = $this->product_model->get_salesinfo();
    
    //create writer object
    $writer = new Excel();
    
        //meta data info
    $keywords = array('xlsx','CUSTOMERS','VESTEL');
    $writer->setTitle('Reporte Customers '.$cust_group->title);
    $writer->setSubject('');
    $writer->setAuthor('VESTEL');
    $writer->setCompany('VESTEL');
    $writer->setKeywords($keywords);
    $writer->setDescription('Reporte Customers '.$cust_group->title);
    $writer->setTempDir(sys_get_temp_dir());
    
    //write headers el primer campo que es nombre de la hoja de excel deve de coincidir en writeSheetHeader y writeSheetRow para tener en cuenta si se piensan agregar otras hojas o algo por el estilo
    $writer->writeSheetHeader('Customers '.$cust_group->title, $headers,$col_options = array(

['font'=>'Arial','font-style'=>'bold','font-size'=>'12',"fill"=>"#BDD7EE",'halign'=>'center'],
['font'=>'Arial','font-style'=>'bold','font-size'=>'12',"fill"=>"#BDD7EE",'halign'=>'center'],
['font'=>'Arial','font-style'=>'bold','font-size'=>'12',"fill"=>"#BDD7EE",'halign'=>'center'],
['font'=>'Arial','font-style'=>'bold','font-size'=>'12',"fill"=>"#BDD7EE",'halign'=>'center'],
['font'=>'Arial','font-style'=>'bold','font-size'=>'12',"fill"=>"#BDD7EE",'halign'=>'center'],
['font'=>'Arial','font-style'=>'bold','font-size'=>'12',"fill"=>"#BDD7EE",'halign'=>'center'],
['font'=>'Arial','font-style'=>'bold','font-size'=>'12',"fill"=>"#BDD7EE",'halign'=>'center'],
['font'=>'Arial','font-style'=>'bold','font-size'=>'12',"fill"=>"#BDD7EE",'halign'=>'center'],
['font'=>'Arial','font-style'=>'bold','font-size'=>'12',"fill"=>"#BDD7EE",'halign'=>'center'],
['font'=>'Arial','font-style'=>'bold','font-size'=>'12',"fill"=>"#BDD7EE",'halign'=>'center'],
));
    
    //write rows to sheet1
    foreach ($lista_customers2 as $key => $customer) {            
            $direccion= $customer->nomenclatura . ' ' . $customer->numero1 . $customer->adicionauno.' Nº '.$customer->numero2.$customer->adicional2.' - '.$customer->numero3;
            $writer->writeSheetRow('Customers '.$cust_group->title,array($customer->abonado,$customer->documento ,$customer->name, $customer->celular, $direccion,$customer->barrio ,$customer->suscripcion_str,$customer->usu_estado,$customer->deuda,$customer->suscripcion,$customer->money));
    }
        
        
    
    $fecha_actual= date("d-m-Y");
    $dia= date("N");
    $this->load->model('reports_model', 'reports');
    $fecha_actual=$this->reports->obtener_dia($dia)." ".$fecha_actual;
    $fileLocation = 'Customers '.$cust_group->title.' '.$fecha_actual.'.xlsx';
    
    //write to xlsx file
    $writer->writeToFile($fileLocation);
    //echo $writer->writeToString();
    
    //force download
    header('Content-Description: File Transfer');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Content-Disposition: attachment; filename=".basename($fileLocation));
    header("Content-Transfer-Encoding: binary");
    header("Expires: 0");
    header("Pragma: public");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header('Content-Length: ' . filesize($fileLocation)); //Remove

    ob_clean();
    flush();

    readfile($fileLocation);
    unlink($fileLocation);
    exit(0);
       

    }
    //view
    public function groupview()
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $id = $this->input->get('id');		
        $data['group'] = $this->clientgroup->details($id);
        $head['title'] = 'Group View';
        
        $this->db->select("*");
        $this->db->from("customers");        
        $this->db->where("gid",$_GET['id']);
        $this->db->order_by('id', 'DESC');
        $lista_customers=$this->db->get()->result();
        
        $total=count($lista_customers);
        $x=intval($total/7);
        //var_dump($x);
        $array= array('1' => array('start' => $lista_customers[0]->id,'end' => $lista_customers[$x]->id),//11
            '2' => array('start' => $lista_customers[$x+1]->id,'end' => $lista_customers[$x*2]->id),//12-22
            '3' => array('start' => $lista_customers[($x*2)+1]->id,'end' => $lista_customers[$x*3]->id),//23-33
            '4' => array('start' => $lista_customers[($x*3)+1]->id,'end' => $lista_customers[$x*4]->id),//34-44
            '5' => array('start' => $lista_customers[($x*4)+1]->id,'end' => $lista_customers[$x*5]->id),//45-55
            '6' => array('start' => $lista_customers[($x*5)+1]->id,'end' => $lista_customers[$x*6]->id),//56-66
            '7' => array('start' => $lista_customers[($x*6)+1]->id,'end' => $lista_customers[$total-1]->id),//
        );
        $data['array_pagination']=$array;
        //var_dump($array);
        $this->load->model('templates_model','templates');
        $data['plantillas'] = $this->templates->get_template(30,37);
        //var_dump($data['plantillas']);
        $this->load->view('fixed/header', $head);
        $this->load->view('groups/groupview', $data);
        $this->load->view('fixed/footer');
    }

    //datatable
    public function grouplist()

    {
        $base = base_url() . 'customers/';
        $id = $this->input->get('id');
        $list = $this->customers->get_datatables($id);
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $customers) {

            if(isset($customers->idx)){
                $customers->id=$customers->idx;
            }
            $servicios_detail=$this->customers->servicios_detail($customers->id);            
            $servicios_str="";
            if($servicios_detail['television']!="" && $servicios_detail['television']!="no" && $servicios_detail['television']!="-"){
                $servicios_str="Tv";
            }
            if($servicios_detail['combo']!="" && $servicios_detail['combo']!="no" && $servicios_detail['combo']!="-"){
                if($servicios_str==""){
                    $servicios_str=$servicios_detail['combo'];
                }else{
                    $servicios_str.="+".$servicios_detail['combo'];
                }   
            }

            $no++;

            $row = array();
            $row[] = '<input id="input_'.$customers->id.'" type="checkbox" name="x" class="clientes_para_enviar_sms" data-id-customer="'.$customers->id.'"  data-celular="'.$customers->celular.'" style="cursor:pointer; margin-left: 9px;" onclick="agregar_customer_envio_sms(this)" ></input>';    
            $row[] = $no;
			$row[] = $customers->abonado;
			$row[] = $customers->documento;
            $row[] = '<a href="' . $base . 'view?id=' . $customers->id . '">' . $customers->name . ' </a>';
			$row[] = $customers->celular;			
            $row[] = $customers->nomenclatura . ' ' . $customers->numero1 . $customers->adicionauno.' Nº '.$customers->numero2.$customers->adicional2.' - '.$customers->numero3;
            $row[] = $customers->barrio;
            $row[] = $servicios_str;
			$row[] = '<span class="st-'.$customers->usu_estado. '">' .$customers->usu_estado. '</span>';
            $row[] = '<a href="' . $base . 'edit?id=' . $customers->id . '" class="btn btn-success btn-sm"><span class="icon-pencil"></span> '.$this->lang->line('Edit').'</a>';
			if ($this->aauth->get_user()->roleid > 4) {
			$row[] = '<a href="#" data-object-id="' . $customers->id . '" class="btn btn-danger btn-sm delete-object"><span class="icon-bin"></span></a>';}


            $data[] = $row;
            
        }
        //para el filtro replico el for each pero por un for y reacomodo los items de a 10 cubriendo espacios en blanco

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->customers->count_all($id),
            "recordsFiltered" => $this->customers->count_filtered($id),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    
    public function load_morosos(){ 
        set_time_limit(6000);
        if($this->input->post('start')!="0"){
            
            $this->list_data_precargada();
            
        }else{

        $listax=array();
        $this->db->select("*");
        $this->db->from("customers");        
        $this->db->where("gid",$_GET['id']);
        if (isset($_GET['estado']) && $_GET['estado'] != '' && $_GET['estado'] != null) {
            $this->db->where('usu_estado=', $_GET['estado']);
        }
        if (isset($_GET['direccion']) &&$_GET['direccion'] =="Personalizada"){ 
            if ($_GET['localidad'] != '' && $_GET['localidad'] != '-' && $_GET['localidad'] != '0') {
                $this->db->where('localidad=', $_GET['localidad']);
            }

            if ($_GET['barrio'] != '' && $_GET['barrio'] != '-' && $_GET['barrio'] != '0') {
                $this->db->where('barrio=', $_GET['barrio']);
            }
            if ($_GET['nomenclatura'] != '' && $_GET['nomenclatura'] != '-') {
                $this->db->where('nomenclatura=', $_GET['nomenclatura']);
            }
            if ($_GET['numero1'] != '') {
                $this->db->where('numero1=', $_GET['numero1']);
            }
            if ($_GET['adicionauno'] != '' && $_GET['adicionauno'] != '-') {
                $this->db->where('adicionauno=', $_GET['adicionauno']);
            }
            if ($_GET['numero2'] != '' && $_GET['numero2'] != '-') {
                $this->db->where('numero2=', $_GET['numero2']);
            }
            if ($_GET['adicional2'] != '' && $_GET['adicional2'] != '-') {
                $this->db->where('adicional2=', $_GET['adicional2']);
            }
            if ($_GET['numero3'] != '' && $_GET['numero3'] != '-') {
                $this->db->where('numero3=', $_GET['numero3']);
            }
        }
        if($_GET['pagination_start']!="" && $_GET['pagination_start']!=null){
                $this->db->where('id<=',$_GET['pagination_start']);
                $this->db->where("id>=",$_GET['pagination_end']);    
                //eh pensado una forma mucho mas compleja para realizar esto y es atraves de multihilo o multitarea algo muy complejo pero con tiempo seria bueno intentarlo
        }
        
        $this->db->order_by('id', 'DESC');

        $lista_customers=$this->db->get()->result();
        


        $no = $this->input->post('start');
        $data=array();
        $x=0;
        $minimo=$this->input->post('start');
        $maximo=$minimo+10;
        $descontar=0;
        foreach ($lista_customers as $key => $customers) {
            $due=$this->customers->due_details($customers->id);
            $money=$this->customers->money_details($customers->id);//para poder arreglar el tema de la velocidad de carga esta ligado con este proceso la solucion a la que llegamos es crear los campos debit y credit en customers y en cada proceso del sistema en los que se cree elimine o editen transacciones se debe de editar el valor de customers;
            $customers->money=$money['credit']-$money['debit'];
            $debe_customer=($due['total']-$due['pamnt'])+$money['debit'];//se agrego el campo de money debit por el item de gastos que se mencino en fechas anteriores

            $lista_invoices = $this->db->from("invoices")->where("csd",$customers->id)->order_by('invoicedate',"DESC")->get()->result();
            $customer_moroso=false;
            $valor_ultima_factura=0;
            $_var_tiene_internet=false;
            $_var_tiene_tv=false;
            $suscripcion_str="";
            if($debe_customer==0){
                $customer_moroso=false;
            }
                $fact_valida=false;
                foreach ($lista_invoices as $key => $invoice) {
                    $suma=0;
                    if($invoice->combo!="no" && $invoice->combo!="" && $invoice->combo!="-"){
                        $fact_valida=true;
                        $_var_tiene_internet=true;
                    }
                    if($invoice->television!="no" && $invoice->television!="" && $invoice->television!="-"){
                        $fact_valida=true;
                        $_var_tiene_tv=true;
                    }
                    if($invoice->ron!="" && $invoice->ron!=null){
                        $fact_valida=true;
                    }
                    if($fact_valida){
                        if($_var_tiene_tv){
                            $producto=null;
                            if(str_replace(" ", "", $invoice->refer)=="Mocoa"){
                                $producto=$this->db->get_where('products', array("pid"=>"159"))->row();
                                $suma+=$producto->product_price;
                            }else{
                                $producto=$this->db->get_where('products', array("pid"=>"27"))->row();
                                $suma+=$producto->product_price+3992;
                            }
                            if($producto!=null){
                                $suscripcion_str="Tv";
                            }
                            
                        }

                        if($_var_tiene_internet){
                            $lista_de_productos=$this->db->from("products")->like("product_name","mega","both")->get()->result();
                            $var_e=strtolower(str_replace(" ", "",$invoice->combo));
                            foreach ($lista_de_productos as $key => $prod) {
                                $prod->product_name=strtolower(str_replace(" ", "",$prod->product_name ));
                                if($prod->product_name==$var_e){
                                    $suma+=$prod->product_price;                                    
                                    break;
                                }
                            }
                            if(!empty($var_e)){
                                if($suscripcion_str!=""){
                                    $suscripcion_str.="+".$var_e;
                                }else{
                                    $suscripcion_str=$var_e;
                                }    
                            }
                            
                        }
                        
                    }
                    $invoice->total=$suma;
                   // if(!$fact_valida){
                          /*  $query=$this->db->query('SELECT * FROM `invoice_items` WHERE tid='.$invoice->tid.' and (product like "%mega%" or product like "%tele%" or product like "%punto adicional%")')->result_array();
                            if(count($query)!=0){
                                $fact_valida=true;
                                $suma=0;
                                foreach ($query as $key => $value) {
                                    if(strpos(strtolower($value['product']),"reconexi" )!==false || strpos(strtolower($value['product']),"afiliaci" )!==false){
                                            
                                    }else{
                                        $suma+=$value['subtotal'];    
                                    }
                                    
                                    //si se selecciona el filtro por servicios realiza este filtro
                                    if(isset($_GET['sel_servicios']) && $_GET['sel_servicios'] != '' && $_GET['sel_servicios'] != null){
                                        if(strpos(strtolower($value['product']),"mega" )!==false){
                                            $_var_tiene_internet=true;
                                        }
                                        if(strpos(strtolower($value['product']),"television" )!==false){
                                            $_var_tiene_tv=true;   
                                        }
                                    }

                                }
                                $invoice->total=$suma;
                            }*/
                   // }
                    if($_GET['morosos']=="1mes"){
                        if($fact_valida && $debe_customer==$invoice->total && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }
                    }else if($_GET['morosos']=="masdeunmes"){
                        if($fact_valida && $debe_customer>$invoice->total && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }
                    }else if($_GET['morosos']=="2meses"){
                        if($fact_valida && $debe_customer>=($invoice->total*2) && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }
                    }else if($_GET['morosos']=="3y4meses"){
                        if($fact_valida && $debe_customer>=($invoice->total*3) && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }
                    }else if($_GET['morosos']=="Todos"){
                        if($fact_valida && $debe_customer>0 && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }
                    }else if($_GET['morosos']=="saldoaFavor"){
                        if($fact_valida && $debe_customer<0 && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }

                    }else if($_GET['morosos']=="al Dia"){
                        if($fact_valida && $debe_customer==0 && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }

                    }else if($_GET['morosos']==""){
                        if($fact_valida){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;
                        }

                    }

                    
                }    
            
            //filtro por servicios con morosos
            if(isset($_GET['sel_servicios']) && $_GET['sel_servicios'] != '' && $_GET['sel_servicios'] != null ){
                //aunque sea moroso pero para aplicar el filtro se va a cambiar la variable moroso
               
                if($_GET['morosos']==""){//para que muestre todos si esta seleccionada esta opcion, probar si colocando esta condicion encima del if funciona bien para eliminar y dejar solo una
                    $customer_moroso=true;
                }

                if($_GET['sel_servicios']=="Internet" && !$_var_tiene_internet){
                            $customer_moroso=false;                        
                }else if($_GET['sel_servicios']=="TV" && !$_var_tiene_tv){//preguntar que si solo debe de filtrar los que tienen tv o si tiene tv pero tambien internet lo puede listar lo mismo con la de internet
                            $customer_moroso=false;     
                }else if($_GET['sel_servicios']=="Combo" ){
                    if(!$_var_tiene_internet || !$_var_tiene_tv){
                        $customer_moroso=false;
                    }
                }

            }else{
                if($_GET['morosos']==""){//para que muestre todos si esta seleccionada esta opcion
                    $customer_moroso=true;
                }
            }
            //end fitro por servicios con morosos 

            if($customer_moroso){
                if(($x>=$minimo && $x<$maximo) || $_POST['length']=="100"){
                    $no++;                
                    
                    $row = array();
                        //$money=$this->customers->money_details($customers->id);
                            $row[] = '<input id="input_'.$customers->id.'" type="checkbox" name="x" class="clientes_para_enviar_sms" data-id-customer="'.$customers->id.'"  data-celular="'.$customers->celular.'" style="cursor:pointer; margin-left: 9px;" onclick="agregar_customer_envio_sms(this)" ></input>';    
                            $row[] = $no;
                            $row[] = $customers->abonado;
                            $row[] = $customers->documento;
                            $row[] = '<a href="'.base_url().'customers/view?id=' . $customers->id . '">' . $customers->name . ' </a>';
                            $row[] = $customers->celular;           
                            $row[] = $customers->nomenclatura . ' ' . $customers->numero1 . $customers->adicionauno.' Nº '.$customers->numero2.$customers->adicional2.' - '.$customers->numero3;
                            $row[] = $customers->barrio;
                            $row[] = $suscripcion_str;
                            $row[] = '<span class="st-'.$customers->usu_estado. '">' .$customers->usu_estado. '</span>';
                            $row[] = amountFormat($debe_customer);
                            $row[] = amountFormat($valor_ultima_factura);
                            $row[] = amountFormat($money['credit']-$money['debit']);
                            $row[] = '<a href="' . base_url() . 'customers/edit?id=' . $customers->id . '" class="btn btn-success btn-sm"><span class="icon-pencil"></span> '.$this->lang->line('Edit').'</a>&nbsp;<a style="margin-top:1px;" target="_blanck" class="btn btn-info btn-sm"  href="'.base_url().'customers/invoices?id='.$customers->id.'"><span class="icon-eye"></span>&nbsp;Facturas</a>';
                            if ($this->aauth->get_user()->roleid > 4) {
                            $row[] = '<a href="#" data-object-id="' . $customers->id . '" class="btn btn-danger btn-sm delete-object"><span class="icon-bin"></span></a>';
                            }
                            

                        $data[] = $row;
                    

                }

                $x++;
                $customers->debe_customer=$debe_customer;
                $customers->valor_ultima_factura=$valor_ultima_factura;
                $customers->suscripcion_str=$suscripcion_str;
                $customers->ingreso=$money['credit']-$money['debit'];
                $listax[]=$customers;
                
            }else{
                $descontar++;
            }
             
        }
        
        $datax['datos']=json_encode($listax);//cuanto esto falle por ser muchos customers y toque buscar una solucion seria guardarlo en dos campos mitad y mitad es decir el count /2 serian los items a guardar en datoa y en dato b el resto de igual forma en el proceso de lectura se leen los dos y de unifican en una sola variable
        $this->db->update("filtros_historial",$datax, array("id"=>$this->aauth->get_user()->id));
        $var_recordsFiltered=count($lista_customers)-$descontar;
        if($_POST['length']=="100"){
            $var_recordsFiltered=0;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($lista_customers)-$descontar,
            "recordsFiltered" => $var_recordsFiltered,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    }
    public function list_data_precargada(){
        $no = $this->input->post('start');
        $data=array();
        $x=0;
        $minimo=$this->input->post('start');
        $maximo=$minimo+10;
        $descontar=0;
        $lista=$this->db->get_where("filtros_historial",array('id' =>$this->aauth->get_user()->id))->row();
        $lista2=json_decode($lista->datos);
        
        foreach ($lista2 as $key => $customers) {
            
            if(($x>=$minimo && $x<$maximo) || $_POST['length']=="100"){
                     $no++;                
                    
                    $row = array();
                            $row[] = '<input id="input_'.$customers->id.'" type="checkbox" name="x" class="clientes_para_enviar_sms" data-id-customer="'.$customers->id.'"  data-celular="'.$customers->celular.'" style="cursor:pointer; margin-left: 9px;" onclick="agregar_customer_envio_sms(this)" ></input>';    
                            $row[] = $no;
                            $row[] = $customers->abonado;
                            $row[] = $customers->documento;
                            $row[] = '<a href="'.base_url().'customers/view?id=' . $customers->id . '">' . $customers->name . ' </a>';
                            $row[] = $customers->celular;           
                            $row[] = $customers->nomenclatura . ' ' . $customers->numero1 . $customers->adicionauno.' Nº '.$customers->numero2.$customers->adicional2.' - '.$customers->numero3;
                            $row[] = $customers->barrio;
                            $row[] = $customers->suscripcion_str;
                            $row[] = '<span class="st-'.$customers->usu_estado. '">' .$customers->usu_estado. '</span>';
                            $row[] = amountFormat($customers->debe_customer);
                            $row[] = amountFormat($customers->valor_ultima_factura);
                            $row[] = amountFormat($customers->ingreso);
                            $row[] = '<a href="' . base_url() . 'customers/edit?id=' . $customers->id . '" class="btn btn-success btn-sm"><span class="icon-pencil"></span> '.$this->lang->line('Edit').'</a>&nbsp;<a style="margin-top:1px;" target="_blanck" class="btn btn-info btn-sm"  href="'.base_url().'customers/invoices?id='.$customers->id.'"><span class="icon-eye"></span>&nbsp;Facturas</a>';
                            if ($this->aauth->get_user()->roleid > 4) {
                            $row[] = '<a href="#" data-object-id="' . $customers->id . '" class="btn btn-danger btn-sm delete-object"><span class="icon-bin"></span></a>';
                            }
                            

                        $data[] = $row;
                    

                }

                $x++;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($lista2),
            "recordsFiltered" => count($lista2),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

     public function get_filtrados_para_checked(){ 
        set_time_limit(6000);
       

        $listax=array();
        $this->db->select("*");
        $this->db->from("customers");        
        $this->db->where("gid",$_GET['id']);
        if (isset($_GET['estado']) && $_GET['estado'] != '' && $_GET['estado'] != null) {
            $this->db->where('usu_estado=', $_GET['estado']);
        }
        if (isset($_GET['direccion']) &&$_GET['direccion'] =="Personalizada"){ 
            if ($_GET['localidad'] != '' && $_GET['localidad'] != '-' && $_GET['localidad'] != '0') {
                $this->db->where('localidad=', $_GET['localidad']);
            }

            if ($_GET['barrio'] != '' && $_GET['barrio'] != '-' && $_GET['barrio'] != '0') {
                $this->db->where('barrio=', $_GET['barrio']);
            }
            if ($_GET['nomenclatura'] != '' && $_GET['nomenclatura'] != '-') {
                $this->db->where('nomenclatura=', $_GET['nomenclatura']);
            }
            if ($_GET['numero1'] != '') {
                $this->db->where('numero1=', $_GET['numero1']);
            }
            if ($_GET['adicionauno'] != '' && $_GET['adicionauno'] != '-') {
                $this->db->where('adicionauno=', $_GET['adicionauno']);
            }
            if ($_GET['numero2'] != '' && $_GET['numero2'] != '-') {
                $this->db->where('numero2=', $_GET['numero2']);
            }
            if ($_GET['adicional2'] != '' && $_GET['adicional2'] != '-') {
                $this->db->where('adicional2=', $_GET['adicional2']);
            }
            if ($_GET['numero3'] != '' && $_GET['numero3'] != '-') {
                $this->db->where('numero3=', $_GET['numero3']);
            }
        }
    
        
    

        $lista_customers=$this->db->get()->result();
        


    
        $data=array();
        $x=0;
    
    
        $descontar=0;
        foreach ($lista_customers as $key => $customers) {
            $due=$this->customers->due_details($customers->id);
            $money=$this->customers->money_details($customers->id);//para poder arreglar el tema de la velocidad de carga esta ligado con este proceso la solucion a la que llegamos es crear los campos debit y credit en customers y en cada proceso del sistema en los que se cree elimine o editen transacciones se debe de editar el valor de customers;
            $customers->money=$money['credit']-$money['debit'];
            $debe_customer=($due['total']-$due['pamnt'])+$money['debit'];//se agrego el campo de money debit por el item de gastos que se mencino en fechas anteriores

            $lista_invoices = $this->db->from("invoices")->where("csd",$customers->id)->order_by('invoicedate',"DESC")->get()->result();
            $customer_moroso=false;
            $valor_ultima_factura=0;
            $_var_tiene_internet=false;
            $_var_tiene_tv=false;
            $suscripcion_str="";
            if($debe_customer==0){
                $customer_moroso=false;
            }
                $fact_valida=false;
                foreach ($lista_invoices as $key => $invoice) {
                    $suma=0;
                    if($invoice->combo!="no" && $invoice->combo!="" && $invoice->combo!="-"){
                        $fact_valida=true;
                        $_var_tiene_internet=true;
                    }
                    if($invoice->television!="no" && $invoice->television!="" && $invoice->television!="-"){
                        $fact_valida=true;
                        $_var_tiene_tv=true;
                    }
                    if($invoice->ron!="" && $invoice->ron!=null){
                        $fact_valida=true;
                    }
                    if($fact_valida){
                        if($_var_tiene_tv){
                            $producto=null;
                            if(str_replace(" ", "", $invoice->refer)=="Mocoa"){
                                $producto=$this->db->get_where('products', array("pid"=>"159"))->row();
                                $suma+=$producto->product_price;
                            }else{
                                $producto=$this->db->get_where('products', array("pid"=>"27"))->row();
                                $suma+=$producto->product_price+3992;
                            }
                            if($producto!=null){
                                $suscripcion_str="Tv";
                            }
                            
                        }

                        if($_var_tiene_internet){
                            $lista_de_productos=$this->db->from("products")->like("product_name","mega","both")->get()->result();
                            $var_e=strtolower(str_replace(" ", "",$invoice->combo));
                            foreach ($lista_de_productos as $key => $prod) {
                                $prod->product_name=strtolower(str_replace(" ", "",$prod->product_name ));
                                if($prod->product_name==$var_e){
                                    $suma+=$prod->product_price;                                    
                                    break;
                                }
                            }
                            if(!empty($var_e)){
                                if($suscripcion_str!=""){
                                    $suscripcion_str.="+".$var_e;
                                }else{
                                    $suscripcion_str=$var_e;
                                }    
                            }
                            
                        }
                        
                    }
                    $invoice->total=$suma;
                   // if(!$fact_valida){
                          /*  $query=$this->db->query('SELECT * FROM `invoice_items` WHERE tid='.$invoice->tid.' and (product like "%mega%" or product like "%tele%" or product like "%punto adicional%")')->result_array();
                            if(count($query)!=0){
                                $fact_valida=true;
                                $suma=0;
                                foreach ($query as $key => $value) {
                                    if(strpos(strtolower($value['product']),"reconexi" )!==false || strpos(strtolower($value['product']),"afiliaci" )!==false){
                                            
                                    }else{
                                        $suma+=$value['subtotal'];    
                                    }
                                    
                                    //si se selecciona el filtro por servicios realiza este filtro
                                    if(isset($_GET['sel_servicios']) && $_GET['sel_servicios'] != '' && $_GET['sel_servicios'] != null){
                                        if(strpos(strtolower($value['product']),"mega" )!==false){
                                            $_var_tiene_internet=true;
                                        }
                                        if(strpos(strtolower($value['product']),"television" )!==false){
                                            $_var_tiene_tv=true;   
                                        }
                                    }

                                }
                                $invoice->total=$suma;
                            }*/
                   // }
                    if($_GET['morosos']=="1mes"){
                        if($fact_valida && $debe_customer==$invoice->total && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }
                    }else if($_GET['morosos']=="masdeunmes"){
                        if($fact_valida && $debe_customer>$invoice->total && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }
                    }else if($_GET['morosos']=="2meses"){
                        if($fact_valida && $debe_customer>=($invoice->total*2) && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }
                    }else if($_GET['morosos']=="3y4meses"){
                        if($fact_valida && $debe_customer>=($invoice->total*3) && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }
                    }else if($_GET['morosos']=="Todos"){
                        if($fact_valida && $debe_customer>0 && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }
                    }else if($_GET['morosos']=="saldoaFavor"){
                        if($fact_valida && $debe_customer<0 && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }

                    }else if($_GET['morosos']=="al Dia"){
                        if($fact_valida && $debe_customer==0 && $customer_moroso==false){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;                    
                        }else if($fact_valida){
                            break;
                        }

                    }else if($_GET['morosos']==""){
                        if($fact_valida){
                            $customer_moroso=true;
                            $valor_ultima_factura=$invoice->total;
                            break;
                        }

                    }

                    
                }    
            
            //filtro por servicios con morosos
            if(isset($_GET['sel_servicios']) && $_GET['sel_servicios'] != '' && $_GET['sel_servicios'] != null ){
                //aunque sea moroso pero para aplicar el filtro se va a cambiar la variable moroso
               
                if($_GET['morosos']==""){//para que muestre todos si esta seleccionada esta opcion, probar si colocando esta condicion encima del if funciona bien para eliminar y dejar solo una
                    $customer_moroso=true;
                }

                if($_GET['sel_servicios']=="Internet" && !$_var_tiene_internet){
                            $customer_moroso=false;                        
                }else if($_GET['sel_servicios']=="TV" && !$_var_tiene_tv){//preguntar que si solo debe de filtrar los que tienen tv o si tiene tv pero tambien internet lo puede listar lo mismo con la de internet
                            $customer_moroso=false;     
                }else if($_GET['sel_servicios']=="Combo" ){
                    if(!$_var_tiene_internet || !$_var_tiene_tv){
                        $customer_moroso=false;
                    }
                }

            }else{
                if($_GET['morosos']==""){//para que muestre todos si esta seleccionada esta opcion
                    $customer_moroso=true;
                }
            }
            //end fitro por servicios con morosos 

            if($customer_moroso){
                    $listax[]=array('id' =>$customers->id ,"celular"=>$customers->celular);                                    
            }
             
        }
        
        echo json_encode($listax);
    
    }

    public function create()
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Create Group';
        $this->load->view('fixed/header', $head);
        $this->load->view('groups/add');
        $this->load->view('fixed/footer');
    }

    public function add()
    {
        $group_name = $this->input->post('group_name');
        $group_desc = $this->input->post('group_desc');

        if ($group_name) {
            $this->clientgroup->add($group_name, $group_desc);
        }
    }

    public function editgroup()
    {
        $gid = $this->input->get('id');
        $this->db->select('*');
        $this->db->from('customers_group');
        $this->db->where('id', $gid);
        $query = $this->db->get();
        $data['group'] = $query->row_array();

        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Edit Group';
        $this->load->view('fixed/header', $head);
        $this->load->view('groups/groupedit', $data);
        $this->load->view('fixed/footer');

    }

    public function editgroupupdate()
    {
        $gid = $this->input->post('gid');
        $group_name = $this->input->post('group_name');
        $group_desc = $this->input->post('group_desc');
        if ($gid) {
            $this->clientgroup->editgroupupdate($gid, $group_name, $group_desc);
        }
    }

    public function delete_i()
    {
        $id = $this->input->post('deleteid');
        if ($id != 1) {
            $this->db->delete('customers_group', array('id' => $id));
            $this->db->set(array('gid' => 1));
            $this->db->where('gid', $id);
            $this->db->update('customers');
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        } else if ($id == 1) {
            echo json_encode(array('status' => 'Error', 'message' => 'You can not delete the default group!'));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }

    function sendGroup()
    {
        $id = $this->input->post('gid');
        $subject = $this->input->post('subject');
        $message = $this->input->post('text');
        $attachmenttrue = false;
        $attachment = '';
        $recipients = $this->clientgroup->recipients($id);
        $this->load->model('communication_model');
        $this->communication_model->group_email($recipients, $subject, $message, $attachmenttrue, $attachment);
    }
    public function sendGroupSms()
    {set_time_limit(400);
        /*$id = $this->input->post('gid');
        $subject = $this->input->post('subject');
        $message = $this->input->post('text');
        $attachmenttrue = false;
        $attachment = '';
        $recipients = $this->clientgroup->recipients($id);
        $this->load->model('communication_model');
        $this->communication_model->group_email($recipients, $subject, $message, $attachmenttrue, $attachment);*/
        //var_dump($_POST);
        $message = $this->input->post('text2');
        $number = $this->input->post('number2');
        $name_campaign = $this->input->post('name_campaign');
        $this->load->library('CellVozApi');
        $api = new CellVozApi();
        $retorno=$api->getToken(); 
        $valido=false;
        $alerta=" ";        

        if($_POST['numerosMasivos']==""){

            if(is_integer(intval($number)) && strlen($number)==10){
                $valido=true;
            }else{
                $alerta.="Numero no valido <br> ";
                $valido=false;
            }
        }else{

            //falta validar cada numero que sea de 10 dijitos y letra o si no borrarlo y si no hay ninguno valido, enviar alerta y tambien dar informacion de los que se excluyeron
            //y leer todo el codigo de la libreria metodo a metodo para ver como puedo aplicar los componentes json necesarios para el envio de mensajes masivos enves de individuales;        
            //Con la Ayuda de Dios lo saco jejejeje :)
            //pero mañana con el favor de el ...
            $numeros=str_replace(" ","",$_POST['numerosMasivos']);
            $numeros=explode(",",$numeros);        
            $valido=true;
            //var_dump($numeros);
        }
        //var_dump($_POST);
        //var_dump($_POST['numerosMasivos']);
        if($message==""){
            $alerta.=" Mensaje no puede ser vacio";
            $valido=false;
        }else{

        }
        
if ($valido) {
            $mensaje="";
            $caracteres_pasados="";
            if(is_array($numeros)){
                $mensajes_a_enviar="";
                $this->load->model('Reports_model', 'reports');


                foreach ($numeros as $key => $numer) {
                    
                        $msg_customer=$message;
                        $datosy=explode("-", $numer);
                    if(strlen($datosy[1])==10){    

                        //asignacion de variables
                        $customer= $this->db->get_where("customers",array("id"=>$datosy[0]))->row();
                        
                        $due=$this->customers->due_details($customer->id);
                        $money=$this->customers->money_details($customer->id);//para poder arreglar el tema de la velocidad de carga esta ligado con este proceso la solucion a la que llegamos es crear los campos debit y credit en customers y en cada proceso del sistema en los que se cree elimine o editen transacciones se debe de editar el valor de customers;
                        //$customers->money=$money['credit']-$money['debit'];
                        $debe_customer=($due['total']-$due['pamnt'])+$money['debit'];//se agrego el campo de money debit por el item de gastos que se mencino en fechas anteriores
                        //$msg_customer="Señor(a) ".$customer->name." ".$customer->unoapellido." su saldo es ".amountFormat($debe_customer)." ".$message;

                        $msg_customer=str_replace("{primer_nombre}",$customer->name,$msg_customer);
                        $msg_customer=str_replace("{segundo_nombre}",$customer->dosnombre,$msg_customer);
                        $msg_customer=str_replace("{primer_apellido}",$customer->unoapellido,$msg_customer);
                        $msg_customer=str_replace("{segundo_apellido}",$customer->dosapellido,$msg_customer);
                        $msg_customer=str_replace("{monto_debe}",amountFormat($debe_customer),$msg_customer);
                        $msg_customer=str_replace("{documento}",$customer->documento,$msg_customer);
                        $msg_customer=str_replace("{mes_actual}",$this->reports->devolver_nombre_mes(date("m")),$msg_customer);
                        if(strlen($msg_customer)>=160){
                            $caracteres_pasados.=$msg_customer.","; 
                        }else{
                        $ultimo_mensaje=$msg_customer;
                    //end asignacion de variables
                        $msg_customer='               {
                                  "codeCountry": "57",
                                  "number": "'.$datosy[1].'",
                                  "message": "'.$msg_customer.'",
                                  "type": 1
                                }';

                        $mensajes_a_enviar.=$msg_customer.","; 
                        }
                    }else{
                        /*$msg_customer='               {
                                  "codeCountry": "57",
                                  "number": "notiene",
                                  "message": "no tiene",
                                  "type": 1
                                }';*/

                        //$caracteres_pasados.=$msg_customer.","; 
                    }  

                }
                        //$mensajes_a_enviar = trim($mensajes_a_enviar, ',');
                if($_POST['ultimo_lote']=="si"){
                //agregar numero del jefe
                    $mensajes_a_enviar.='{
                                  "codeCountry": "57",
                                  "number": "3106247129",
                                  "message": "'.$ultimo_mensaje.'",
                                  "type": 1
                                }';
                }else{
                    $mensajes_a_enviar = trim($mensajes_a_enviar, ',');
                }
                //var_dump($mensajes_a_enviar);
                $var=$api->envio_sms_masivos_por_curl($retorno->getToken(),$mensajes_a_enviar,$name_campaign);        
                //$mensaje=json_decode($var);
                /*if($mensaje->success==true){
                    $mensaje="Enviado";
                }else{
                    $mensaje=$mensaje->message;
                }*/
                $mensaje="Enviado";
            }else{
                $var=$api->enviar_msm($retorno->getToken(),$number,$message);    
                $mensaje=$var->getMessage();
            }

            if($mensaje=="Enviado"){
                echo json_encode(array('status' => 'Success-sms', 'message' => 'SMS Enviado Con Exito',"variable completa"=>$var,"caracteres_pasados"=>$caracteres_pasados));    
            }else{
                echo json_encode(array('status' => 'Error-sms', 'message' => $mensaje, "variable completa"=>$var));    
            }
            
        } else {
            echo json_encode(array('status' => 'Error-sms', 'message' => $alerta));
        }                      
        
    }
    public function cambiar_barrios(){
        set_time_limit(6000);
        $lista_customers=$this->db->get_where("customers")->result_array();
        foreach ($lista_customers as $key => $value) {
            $barrio =ucwords(strtolower($value['barrio']));
            
            $this->db->update("customers",array("barrio"=>$barrio),array('id' => $value['id']));
        }
        
        var_dump("Exito");
    }
    public function prueba_envio_masivo_sms_curl(){
        set_time_limit(6000);
        $this->load->library('CellVozApi');
        $api = new CellVozApi();
        $retorno=$api->getToken(); 
        var_dump($api->envio_sms_masivos_por_curl_2($retorno->getToken(),"",""));
    }
}