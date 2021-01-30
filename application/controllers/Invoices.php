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

class Invoices extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('invoices_model', 'invocies');
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        if ($this->aauth->get_user()->roleid < 2) {

            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');

        }
        if ($this->aauth->get_user()->roleid == 2) {
            $this->limited = $this->aauth->get_user()->id;
        } else {
            $this->limited = '';
        }

    }

    //create invoice
    public function create()
    {
        $this->load->model('customers_model', 'customers');
        $this->load->model('plugins_model', 'plugins');
        $data['exchange'] = $this->plugins->universal_api(5);
        $data['customergrouplist'] = $this->customers->group_list();
        $data['lastinvoice'] = $this->invocies->lastinvoice();			
        $data['warehouse'] = $this->invocies->warehouses();		
        $data['terms'] = $this->invocies->billingterms();
        $data['currency'] = $this->invocies->currencies();
        $head['title'] = "New Invoice";
		$data['departamentos'] = $this->customers->departamentos_list();
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('invoices/newinvoice', $data);
        $this->load->view('fixed/footer');
    }	
     public function generar_facturas()
    {
        $this->load->model('customers_model', 'customers');
        $this->load->model('transactions_model');
        $head['title'] = "Generar Facturas";        
        $data['accounts'] = $this->transactions_model->acc_list();
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('invoices/generar_facturas', $data);
        $this->load->view('fixed/footer');
    }
    public function generar_facturas_action(){
        set_time_limit(3000);
        $caja1=$this->db->get_where('accounts',array('id' =>$_POST['pay_acc']))->row();
        $customers = $this->db->get_where("customers", array("usu_estado"=>'Activo',"ciudad"=>$caja1->holder))->result_array();
        $ciudades= array();
        $sdate=$this->input->post("sdate");
        $date1= new DateTime($sdate);
        $sdate1=$date1->format("Y-m-d");
        $time_sdate1=strtotime($sdate1);
        $customers_afectados=array();

        foreach ($customers as $key => $value) {
            $invoices = $this->db->select("*")->from("invoices")->where('csd='.$value['id'])->order_by('invoicedate',"DESC")->get()->result();
            
            //echo "<br>";
            //var_dump("customer = ".$value['id']." |");
            $_customer_factura_creada=false;
            foreach ($invoices as $key => $value2) {
                $time_dateinv=strtotime($value2->invoicedate);
                $dtime2=new DateTime($value2->invoicedate);
                if($time_dateinv>$time_sdate1){
                    $_customer_factura_creada=true;
                    //echo "Ya tiene factura ".$sdate1." | ".$value2->invoicedate;
                }else if($date1->format("Y-m")==$dtime2->format("Y-m")){
                    $_customer_factura_creada=true;
                   // echo "Ya tiene factura 2 ".$sdate1." | ".$value2->invoicedate;
                }else{                                                                                    
                    $internet="";
                    $television="";
                    $puntos=0;
                    $_tiene_internet=false;
                    $_tiene_television=false;
                    if($value2->combo!="no" ){                    
                        $_tiene_internet=true;
                        $internet=$value2->combo;
                        if($value2->television!="no" ){
                            $_tiene_television=true;
                        }
                    }else if($value2->television!="no"){
                        $_tiene_television=true;
                    }
                    if($value2->puntos!=null && $value2->puntos!=0){
                                $puntos=$value2->puntos;
                        }
                    
                    $lista_items=$this->db->get_where("invoice_items", array('tid' => $value2->tid))->result_array();
                    foreach ($lista_items as $key => $item_invoic) {
                        if(strpos(strtolower($item_invoic['product']), "reconexi")!==false){

                        }else if(strpos(strtolower($item_invoic['product']), "afiliaci")!==false){
                            
                        }else{
                            if(strpos(strtolower($item_invoic['product']), "tele")!==false){
                                $_tiene_television=true;
                            }else{
                                if($item_invoic['product']=="1Mega" ||$item_invoic['product']=="1 Mega"){
                                    $_tiene_internet=true;
                                    $internet="1 Mega";
                                }else if($item_invoic['product']=="2Megas" ||$item_invoic['product']=="2 Megas"){
                                    $_tiene_internet=true;
                                    $internet="2 Megas";
                                }else if($item_invoic['product']=="3Megas"|| $item_invoic['product']=="3 Megas"){
                                    $_tiene_internet=true;
                                    $internet="3 Megas";
                                }else if($item_invoic['product']=="5Megas"||$item_invoic['product']=="5 Megas"){
                                    $_tiene_internet=true;
                                    $internet="5 Megas";
                                }else if($item_invoic['product']=="10Megas"||$item_invoic['product']=="10 Megas"){
                                    $_tiene_internet=true;
                                    $internet="10 Megas";
                                }else if($item_invoic['product']=="50Megas"||$item_invoic['product']=="50 Megas"){
                                    $_tiene_internet=true;
                                    $internet="50 Megas";
                                }else if($item_invoic['product']=="3MegasSolo"){
                                    $_tiene_internet=true;
                                    $internet="3MegasSolo";
                                }else if($item_invoic['product']=="5MegasSolo"){
                                    $_tiene_internet=true;
                                    $internet="5MegasSolo";
                                }else if($item_invoic['product']=="10MegasSolo"){
                                    $_tiene_internet=true;
                                    $internet="10MegasSolo";
                                }else if($item_invoic['product']=="5MegasD"){
                                    $_tiene_internet=true;
                                    $internet="5MegasD";
                                }else if($item_invoic['product']=="Punto Adicional"){
                                    $puntos=$item_invoic['qty'];
                                }
                            }

                            

                        }
                    }
                    if($_customer_factura_creada==false){
                      
                            $internet_data= array();
                            $television_data= array();
                            $factura_data=array();
                            $tidactualmasuno= $this->db->select('max(tid)+1 as tid')->from('invoices')->get()->result();
                            //esta data es de la nueva factura para insertar
                            $factura_data['tid']=$tidactualmasuno[0]->tid;
                            $factura_data['tax']=0;
                            $factura_data['total']=0;
                            $factura_data['subtotal']=0;
                            if($_tiene_television==true){
                                if(strpos(strtolower($caja1->holder), strtolower("mocoa"))!==false){
                                    $tv_product= $this->db->get_where("products", array('pid' => "159"))->row();
                                    $television_data['pid']=$tv_product->pid;
                                    $television_data['price']=$tv_product->product_price;
                                    $television_data['subtotal']=$tv_product->product_price;
                                    $television_data['totaltax']=0;
                                    $television_data['tax']=0;
                                    $television_data['product']="Television";
                                    $factura_data['subtotal']=$tv_product->product_price;
                                    $factura_data['total']=$tv_product->product_price;
                                }else{
                                    $tv_product= $this->db->get_where("products", array('pid' => "27"))->row();
                                    $x1=3992+$tv_product->product_price;
                                    $television_data['pid']=$tv_product->pid;
                                    $television_data['price']=$tv_product->product_price;
                                    $television_data['subtotal']=$x1;
                                    $television_data['totaltax']=3992;
                                    $television_data['tax']=$tv_product->taxrate;
                                    $factura_data['tax']=3992;
                                    $factura_data['subtotal']=$tv_product->product_price;
                                    $factura_data['total']=$x1;

                                    if(strpos(strtolower($caja1->holder), strtolower("yopal"))!==false){
                                        $television_data['product']="Television Yopal";
                                    }else{
                                        $television_data['product']="Television";
                                    }
                                }
                                $television_data['tid']=$factura_data['tid'];
                                $television_data['qty']=1;
                                $television_data['discount']=0;                                
                                $television_data['totaldiscount']=0;
                                
                                    $this->db->insert("invoice_items",$television_data);
                                


                            }                                                                                    
                            //estan listos los datos de tv item invoice falta llenar los campos faltantes 
                            //falta llenar los datos de internet y posteriormente insertar
                            if($internet=="1Mega" ||$internet=="1 Mega"){
                                $_tiene_internet=true;
                                $internet="1 Mega";
                            }else if($internet=="2Megas" ||$internet=="2 Megas"){
                                $_tiene_internet=true;
                                $internet="2 Megas";
                            }else if($internet=="3Megas"|| $internet=="3 Megas"){
                                $_tiene_internet=true;
                                $internet="3 Megas";
                            }else if($internet=="5Megas"||$internet=="5 Megas"){
                                $_tiene_internet=true;
                                $internet="5 Megas";
                            }else if($internet=="10Megas"||$internet=="10 Megas"){
                                $_tiene_internet=true;
                                $internet="10 Megas";
                            }else if($internet=="50Megas"||$internet=="50 Megas"){
                                $_tiene_internet=true;
                                $internet="50 Megas";
                            }else if($internet=="3MegasSolo"){
                                $_tiene_internet=true;
                                $internet="3MegasSolo";
                            }else if($internet=="5MegasSolo"){
                                $_tiene_internet=true;
                                $internet="5MegasSolo";
                            }else if($internet=="10MegasSolo"){
                                $_tiene_internet=true;
                                $internet="10MegasSolo";
                            }else if($internet=="5MegasD"){
                                $_tiene_internet=true;
                                $internet="5MegasD";
                            }

                            if($_tiene_internet==true){
                                $producto_internet=$this->db->get_where("products", array('product_name' =>$internet))->row();
                                $internet_data['tid']=$factura_data['tid'];
                                $internet_data['pid']=$producto_internet->pid;
                                $internet_data['product']=$producto_internet->product_name;
                                $internet_data['qty']=1;
                                $internet_data['price']=$producto_internet->product_price;
                                $internet_data['tax']=0;
                                $internet_data['discount']=0;
                                $internet_data['subtotal']=$producto_internet->product_price;
                                $internet_data['totaldiscount']=0;
                                $internet_data['totaltax']=0;
                                $factura_data['subtotal']+=$producto_internet->product_price;
                                $factura_data['total']+=$producto_internet->product_price;
                                
                                    $this->db->insert("invoice_items",$internet_data);
                                
                            }
                            $puntos_data= array();
                            if($puntos!=0){
                                $punto_adicional=$this->db->get_where("products", array('product_name' =>"Punto Adicional"))->row();
                                $puntos_data['pid']=$punto_adicional->pid;
                                $puntos_data['product']=$punto_adicional->product_name;
                                $puntos_data['qty']=$puntos;
                                $puntos_data['price']=$punto_adicional->product_price;
                                $puntos_data['tax']=0;
                                $puntos_data['discount']=0;
                                $puntos_data['subtotal']=$punto_adicional->product_price*$puntos;
                                $puntos_data['totaldiscount']=0;
                                $puntos_data['totaltax']=0;
                                $factura_data['subtotal']+=$puntos_data['subtotal'];
                                $factura_data['total']+=$puntos_data['subtotal'];
                                
                                    $this->db->insert("invoice_items",$puntos_data);
                                
                            }
                            $factura_data['puntos']=$puntos;

                            //falta los puntos no se olvide hacer igual que en tickets y luego preguntar que alli se valora cada uno en ves de despues de 3 puntos
                            //y crear el invoice
                            if($factura_data['total']!=0){
                                $dia_final_de_mes=date("Y-m-t 23:00:00", $time_sdate1);
                                $date_fecha_corte=new DateTime($dia_final_de_mes);
                                
                                $factura_data['invoicedate']=$sdate1;
                                $factura_data['invoiceduedate']=$date_fecha_corte->format("Y-m-d");
                                $factura_data['discount']=0;
                                $factura_data['notes']=".";
                                $factura_data['status']="due";
                                $factura_data['csd']=$value2->csd;
                                $factura_data['eid']=$value2->eid;
                                $factura_data['pamnt']=0;
                                $factura_data['items']=$value2->items;
                                $factura_data['taxstatus']=$value2->taxstatus;
                                $factura_data['discstatus']=$value2->discstatus;
                                $factura_data['format_discount']=$value2->format_discount;
                                $factura_data['refer']=$value2->refer;
                                if($_tiene_television==true){
                                    $factura_data['television']="Television";
                                }else{
                                    $factura_data['television']="no";
                                }
                                if($_tiene_internet==true){
                                    $factura_data['combo']=str_replace(" ","",$internet);
                                }else{
                                    $factura_data['combo']="no";
                                }
                                $factura_data['term']=$value2->term;
                                $factura_data['rec']=$value2->rec;
                                $factura_data['ron']=$value2->ron;
                                $factura_data['multi']=$value2->multi;
                                
                                    $this->db->insert("invoices",$factura_data);
                                    $customers_afectados[]=array('csd' => $value2->csd,"tid"=>$factura_data['tid'],"nombres"=>$value['name']." ".$value['unoapellido'],"celular"=>$value['celular'],"cedula"=>$value['documento']);
                                    
                                    //var_dump("INSERTADO");
                                    //var_dump($factura_data);
                                                           
                                $_customer_factura_creada=true;
                            }



                            
                        
                    }


                }   
                
            }
            

        }
        
        

        $this->load->model('customers_model', 'customers');
        //$this->load->model('transactions_model');
        $head['title'] = "Generar Facturas";        
        $data['customers_afectados'] = $customers_afectados;
        $data['fecha'] = $sdate1;
        $data['pay_acc'] = $caja1->holder;
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('invoices/facturas_generadas', $data);
        $this->load->view('fixed/footer');
    }

    public function lista_facturas_generadas(){

        $lista_invoices=$this->db->get_where("invoices", array('invoicedate' =>$_GET['fecha'],"refer"=>$_GET['pay_acc'],"notes"=>"."))->result_array();
        $no = $this->input->post('start');
        $data=array();
        $x=0;
        $minimo=$this->input->post('start');
        $maximo=$minimo+10;
        foreach ($lista_invoices as $key => $value) {
            
            if($x>=$minimo && $x<$maximo){
                $no++;
                $customers = $this->db->get_where("customers", array('id' => $value['csd']))->row();
                $row = array();
                $row[] = $no;
                //$row[] = $customers->abonado;
                $row[] = '<a href="customers/view?id=' . $customers->id . '">' . $customers->name ." ". $customers->unoapellido. '</a>';
                $row[] = $customers->celular;
                $row[] = $customers->documento;
                //$row[] = $customers->nomenclatura . ' ' . $customers->numero1 . $customers->adicionauno.' Nº '.$customers->numero2.$customers->adicional2.' - '.$customers->numero3;
                //$row[] = $customers->usu_estado;
                $row[] = '<a href="'.base_url().'customers/invoices?id='.$value['csd'].'" class="btn btn-info btn-sm"><span class="icon-eye"></span>  Facturas</a> <a href="'.base_url().'invoices/view?id='.$value['tid'].'" class="btn btn-info btn-sm"><span class="icon-eye"></span>  Factura Creada</a>';
                $data[] = $row;

            }
            $x++;
             
             
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($lista_invoices),
            "recordsFiltered" => count($lista_invoices),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    //edit invoice
    public function edit()
    {

        $tid = intval($this->input->get('id'));
        $data['id'] = $tid;
        $data['title'] = "Edit Invoice $tid";
        $this->load->model('customers_model', 'customers');
        $data['customergrouplist'] = $this->customers->group_list();
        $data['terms'] = $this->invocies->billingterms();
        $data['currency'] = $this->invocies->currencies();
        $data['invoice'] = $this->invocies->invoice_details($tid, $this->limited);
        if ($data['invoice']) $data['products'] = $this->invocies->invoice_products($tid);
        $head['title'] = "Edit Invoice #$tid";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['warehouse'] = $this->invocies->warehouses();
        $this->load->model('plugins_model', 'plugins');
        $data['exchange'] = $this->plugins->universal_api(5);

        $this->load->view('fixed/header', $head);
        if ($data['invoice']) $this->load->view('invoices/edit', $data);
        $this->load->view('fixed/footer');

    }

    //invoices list
    public function index()
    {
        $head['title'] = "Manage Invoices";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('invoices/invoices');
        $this->load->view('fixed/footer');
    }
	public function apertura()

    {
		if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        $this->load->model('employee_model', 'employee');
        $id = $this->aauth->get_user()->id;
        $data['employee'] = $this->employee->employee_details($id);
        $data['eid'] = intval($id);        
        $head['title'] = "Account Statement";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('invoices/apertura', $data);
        $this->load->view('fixed/footer');

    }

    //action
    public function action()
    {

        $customer_id = $this->input->post('customer_id');
        $invocieno = $this->input->post('invocieno');
        $invoicedate = $this->input->post('invoicedate');
        $invocieduedate = $this->input->post('invocieduedate');
        $notes = $this->input->post('notes');
        $tax = $this->input->post('tax_handle');
        $subtotal = $this->input->post('subtotal');
        $shipping = $this->input->post('shipping');
        $refer = $this->input->post('refer');
		$television = $this->input->post('television');
		$combo = $this->input->post('combo');
		$puntos = $this->input->post('puntos');
        $total = $this->input->post('total');
        $project = $this->input->post('prjid');
        $total_tax = 0;
        $total_discount = 0;
        $discountFormat = $this->input->post('discountFormat');
        $pterms = $this->input->post('pterms');
        $currency = $this->input->post('mcurrency');
        $i = 0;
        if ($discountFormat == '0') {
            $discstatus = 0;
        } else {
            $discstatus = 1;
        }

        if ($customer_id == 0) {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('Please add a new client')));
            exit;
        }
        $this->db->trans_start();
        //products

        $pid = $this->input->post('pid');
        $productlist = array();
        $prodindex = 0;
        $itc = 0;
        $flag = false;
        if ($tax == 'yes') {
            $textst = 1;

            foreach ($pid as $key => $value) {

                $product_id = $this->input->post('pid');
                $product_name1 = $this->input->post('product_name');
                $product_qty = $this->input->post('product_qty');
                $product_price = $this->input->post('product_price');
                $product_tax = $this->input->post('product_tax');
                $product_discount = $this->input->post('product_discount');
                $product_subtotal = $this->input->post('product_subtotal');
                $ptotal_tax = $this->input->post('taxa');
                $ptotal_disc = $this->input->post('disca');
                $product_des = $this->input->post('product_description');
                $total_discount += $ptotal_disc[$key];
                $total_tax += $ptotal_tax[$key];

                $data = array(
                    'tid' => $invocieno,
                    'pid' => $product_id[$key],
                    'product' => $product_name1[$key],
                    'qty' => $product_qty[$key],
                    'price' => $product_price[$key],
                    'tax' => $product_tax[$key],
                    'discount' => $product_discount[$key],
                    'subtotal' => $product_subtotal[$key],
                    'totaltax' => $ptotal_tax[$key],
                    'totaldiscount' => $ptotal_disc[$key],
                    'product_des' => $product_des[$key]
                );

                $flag = true;
                $productlist[$prodindex] = $data;
                $i++;
                $prodindex++;


                $amt = intval($product_qty[$key]);
                if ($product_id[$key] > 0) {
                    $this->db->set('qty', "qty-$amt", FALSE);
                    $this->db->where('pid', $product_id[$key]);
                    $this->db->update('products');
                }
                $itc += $amt;


            }
        } else {
            $textst = 0;
            foreach ($pid as $key => $value) {

                $product_id = $this->input->post('pid');

                $product_name1 = $this->input->post('product_name');
                $product_qty = $this->input->post('product_qty');
                $product_price = $this->input->post('product_price');
                $product_discount = $this->input->post('product_discount');
                $product_subtotal = $this->input->post('product_subtotal');
                $ptotal_disc = $this->input->post('disca');
                $product_des = $this->input->post('product_description');
                $total_discount += $ptotal_disc[$key];


                $data = array(
                    'tid' => $invocieno,
                    'pid' => $product_id[$key],
                    'product' => $product_name1[$key],
                    'qty' => $product_qty[$key],
                    'price' => $product_price[$key],
                    'discount' => $product_discount[$key],
                    'subtotal' => $product_subtotal[$key],
                    'totaldiscount' => $ptotal_disc[$key],
                    'product_des' => $product_des[$key]
                );


                $flag = true;
                $productlist[$prodindex] = $data;
                $i++;
                $prodindex++;
            }
            //stock

            $amt = intval($product_qty[$key]);
            if ($product_id[$key] > 0) {
                $this->db->set('qty', "qty-$amt", FALSE);
                $this->db->where('pid', $product_id[$key]);
                $this->db->update('products');
            }


            $itc += $amt;

        }


        $transok = true;


        //Invoice Data
        $bill_date = datefordatabase($invoicedate);
        $bill_due_date = datefordatabase($invocieduedate);
		if (($television !== no) || $combo !== no){
			$estado = 'Instalar';
		}else{
			$estado = '';
		}
        $data = array(
			'tid' => $invocieno, 
			'invoicedate' => $bill_date, 
			'invoiceduedate' => $bill_due_date, 
			'subtotal' => $subtotal, 
			'shipping' => $shipping, 
			'discount' => $total_discount, 
			'tax' => $total_tax, 
			'total' => $total, 
			'notes' => $notes, 
			'csd' => $customer_id, 
			'eid' => $this->aauth->get_user()->id, 
			'items' => $itc, 
			'taxstatus' => $textst, 
			'discstatus' => $discstatus, 
			'format_discount' => $discountFormat, 
			'refer' => $refer, 
			'term' => $pterms, 
			'multi' => $currency, 
			'television' => $television, 
			'combo' => $combo,
			'puntos' => $puntos,
			'ron' => $estado);

        if ($flag == true) {
            $this->db->insert_batch('invoice_items', $productlist);
			$tidactualmasuno= $this->db->select('max(codigo)+1 as codigo')->from('tickets')->get()->result();
            if ($this->db->insert('invoices', $data)) {
				if (($television !== no) || $combo !== no){
				$data2['codigo']=$tidactualmasuno[0]->codigo;	
                $data2['subject']='servicio';
				$data2['detalle']='Instalacion';	
                $data2['created']=$bill_date;
                $data2['cid']=$customer_id;
                $data2['status']='Pendiente';
                //Tipo de instalacion
					if ($television == 'Television' AND $combo == no){
					$data2['section']='Instalacion Television';
						}if ($television == no AND $combo !== no){
							$data2['section']='Instalacion de Internet '.$combo.'';
							}if ($television == 'Television' AND $combo !== no){
								$data2['section']='Instalacion Television mas '.$combo.'';
					}
                $data2['id_invoice']=$invocieno;
				$data2['id_factura']=null;
                $this->db->insert('tickets',$data2);
				//actualizar estado usuario
				$this->db->set('usu_estado', 'Instalar');
        		$this->db->where('id', $customer_id);
        		$this->db->update('customers');
                
                    
				}

                $validtoken = hash_hmac('ripemd160', $invocieno, $this->config->item('encryption_key'));
                $link = base_url('billing/view?id=' . $invocieno . '&token=' . $validtoken);
                echo json_encode(array('status' => 'Success', 'message' =>
                    $this->lang->line('Invoice Success') . " <a href='view?id=$invocieno' class='btn btn-info btn-lg'><span class='icon-file-text2' aria-hidden='true'></span> " . $this->lang->line('View') . "  </a> &nbsp; &nbsp; <a href='$link' class='btn btn-orange btn-lg'><span class='icon-earth' aria-hidden='true'></span> " . $this->lang->line('Public View') . " </a>"));
            } else {
                echo json_encode(array('status' => 'Error', 'message' =>
                    "Invalid Entry!"));
                $transok = false;
            }


        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                "Please choose product from product list. Go to Item manager section if you have not added the products."));
            $transok = false;
        }

        if (($this->aauth->get_user()->roleid > 3) AND $project > 0) {

            $data = array('pid' => $project, 'meta_key' => 11, 'meta_data' => $invocieno, 'value' => '0');

            $this->db->insert('project_meta', $data);

        }


        if ($transok) {
            $this->db->trans_complete();
        } else {
            $this->db->trans_rollback();
        }


    }
	 public function rec_status()
    {
        $tid = $this->input->post('tid');
		$usr = $this->input->post('usuario');
        $status = $this->input->post('status');
		$tv = $this->input->post('television');
		$int = $this->input->post('internet');
		$this->db->set('combo', $int);
		$this->db->set('television', $tv);
        $this->db->set('ron', $status);
        $this->db->where('tid', $tid);
        //$this->db->update('invoices');		 
		$cuenta = $this->db->get_where('invoices',array('tid'=>$tid))->row();
		$tidactualmasuno= $this->db->select('max(codigo)+1 as codigo')->from('tickets')->get()->result();
		if ($this->db->update('invoices')) {			
				if ($tv !== no && $int !== no ){
				$data2['codigo']=$tidactualmasuno[0]->codigo;	
                $data2['subject']='servicio';					
                $data2['created']=$cuenta->invoicedate;
                $data2['cid']=$usr;
                $data2['status']='Pendiente';
                //Tipo de instalacion
					if ($cuenta->television !== 'Television' AND $cuenta->combo !== no){
						$data2['detalle']='Reinstalacion Television';
						$data2['section']='Instalacion Television';
						}if ($cuenta->television !== no AND $cuenta->combo == no){
							$data2['detalle']='Reinstalacion Internet';
							$data2['section']='Instalacion de Internet '.$int.'';
							}
                $data2['id_invoice']=null;
				$data2['id_factura']=$tid;
                $this->db->insert('tickets',$data2);
				}			
		}
		 //estado usuario
		$this->db->set('usu_estado', $status);
        $this->db->where('id', $usr);
        $this->db->update('customers');
        echo json_encode(array('status' => 'Success', 'message' =>
            $this->lang->line('UPDATED'), 'pstatus' => $status));
    }
	public function activar()
    {
		$tid = $this->input->post('iduser');
        $status = $this->input->post('perfil');
		$fecha = $this->input->post('fecha');
		$hora = $this->input->post('hora');
		$bill_fecha = datefordatabase($fecha);
		$bill_hora = datefordatabase($hora);
		if ($tid){
        $this->invocies->activar($tid,$status,$bill_fecha,$bill_hora);
		}
		if ($this->invocies->activar($tid,$status,$bill_fecha,$bill_hora)) {                
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('Invoice has  been updated') . " <a href='view?id=$invocieno' class='btn btn-info btn-lg'><span class='icon-file-text2' aria-hidden='true'></span> " . $this->lang->line('View') . " </a> "));
            } else {
                echo json_encode(array('status' => 'Error', 'message' =>
                    $this->lang->line('ERROR')));
                $transok = false;
            }
		
        
    }


    public function ajax_list()
    {

        $list = $this->invocies->get_datatables($this->limited);

        $data = array();

        $no = $this->input->post('start');

        foreach ($list as $invoices) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $invoices->tid;
            $row[] = $invoices->name ." ". $invoices->unoapellido;
			$row[] = $invoices->abonado;
            $row[] = dateformat($invoices->invoiceduedate);
			$row[] = $invoices->ron;
            $row[] = amountFormat($invoices->total);
			$row[] = $invoices->refer;
            $row[] = '<span class="st-' . $invoices->status . '">' . $this->lang->line(ucwords($invoices->status)) . '</span>';
            $row[] = '<a href="' . base_url("invoices/view?id=$invoices->tid") . '" class="btn btn-success btn-xs"><i class="icon-file-text"></i> ' . $this->lang->line('View') . '</a> &nbsp; <a href="' . base_url("invoices/printinvoice?id=$invoices->tid") . '&d=1" class="btn btn-info btn-xs"  title="Download"><span class="icon-download"></span></a>&nbsp; &nbsp';
			if ($this->aauth->get_user()->roleid > 4) { 
			$row[] = '<a href="#" data-object-id="' . $invoices->tid . '" class="btn btn-danger btn-xs delete-object"><span class="icon-trash"></span></a>';}

            $data[] = $row;
        }


        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->invocies->count_all($this->limited),
            "recordsFiltered" => $this->invocies->count_filtered($this->limited),
            "data" => $data,
        );

        //output to json format
        echo json_encode($output);

    }

    public function view()
    {
        $this->load->model('accounts_model');
        $data['acclist'] = $this->accounts_model->accountslist();
        $tid = intval($this->input->get('id'));
        $data['id'] = $tid;
        $head['title'] = "View Invoice $tid";
        $data['invoice'] = $this->invocies->invoice_details($tid, $this->limited);
        $data['attach'] = $this->invocies->attach($tid);
        if ($data['invoice']) $data['products'] = $this->invocies->invoice_products($tid);
        if ($data['invoice']) $data['activity'] = $this->invocies->invoice_transactions($tid);

        $data['employee'] = $this->invocies->employee($data['invoice']['eid']);

        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        if ($data['invoice']) $this->load->view('invoices/view', $data);
        $this->load->view('fixed/footer');

    }


    public function printinvoice()
    {

        $tid = intval($this->input->get('id'));

        $data['id'] = $tid;
        $data['title'] = "Invoice $tid";
        $data['invoice'] = $this->invocies->invoice_details($tid, $this->limited);
        if ($data['invoice']) $data['products'] = $this->invocies->invoice_products($tid);
        if ($data['invoice']) $data['employee'] = $this->invocies->employee($data['invoice']['eid']);

        ini_set('memory_limit', '64M');

        $html = $this->load->view('invoices/view-print-'.LTR, $data, true);
        $html2 = $this->load->view('invoices/header-print-'.LTR, $data, true);

        //PDF Rendering
        $this->load->library('pdf_invoice');

        $pdf = $this->pdf_invoice->load();
        $pdf->SetHTMLHeader($html2);
        $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #'.$tid.'</div>');

        $pdf->WriteHTML($html);

        if ($this->input->get('d')) {

            $pdf->Output('Invoice_#' . $tid . '.pdf', 'D');
        } else {
            $pdf->Output('Invoice_#' . $tid . '.pdf', 'I');
        }


    }

    public function delete_i()
    {
        $id = $this->input->post('deleteid');

        if ($this->invocies->invoice_delete($id, $this->limited)) {
            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('DELETED')));

        } else {

            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }

    }

    public function editaction()
    {


        $customer_id = $this->input->post('customer_id');
        $invocieno = $this->input->post('invocieno');
        $invoicedate = $this->input->post('invoicedate');
        $invocieduedate = $this->input->post('invocieduedate');
        $notes = $this->input->post('notes');
        $tax = $this->input->post('tax_handle');
        $subtotal = $this->input->post('subtotal');
        $shipping = $this->input->post('shipping');
        $refer = $this->input->post('refer');
		$television = $this->input->post('television');
		$combo = $this->input->post('combo');
		$puntos = $this->input->post('puntos');
        $total = $this->input->post('total');
        $total_tax = 0;
        $total_discount = 0;
        $discountFormat = $this->input->post('discountFormat');
        $pterms = $this->input->post('pterms');
        $currency = $this->input->post('mcurrency');
        $i = 0;

        if ($this->limited) {
            $employee = $this->invocies->invoice_details($invocieno, $this->limited);
            if ($this->aauth->get_user()->id != $employee['eid']) exit();

        }
        if ($discountFormat == '0') {
            $discstatus = 0;
        } else {
            $discstatus = 1;
        }

        if ($customer_id == 0) {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('Please add a new client')));
            exit;


        }


        $this->db->trans_start();
        $flag = false;
        $transok = true;


        //Product Data
        $pid = $this->input->post('pid');
        $productlist = array();

        $prodindex = 0;
        $itc = 0;

        $this->db->delete('invoice_items', array('tid' => $invocieno));
        if ($tax == 'yes') {
            $taxstatus = 1;

            foreach ($pid as $key => $value) {

                $product_id = $this->input->post('pid');
                $product_name1 = $this->input->post('product_name');
                $product_qty = $this->input->post('product_qty');
                $old_product_qty = $this->input->post('old_product_qty');
                $product_price = $this->input->post('product_price');
                $product_tax = $this->input->post('product_tax');
                $product_discount = $this->input->post('product_discount');
                $product_subtotal = $this->input->post('product_subtotal');
                $ptotal_tax = $this->input->post('taxa');
                $ptotal_disc = $this->input->post('disca');
                $product_des = $this->input->post('product_description');
                $total_discount += $ptotal_disc[$key];
                $total_tax += $ptotal_tax[$key];

                $data = array(
                    'tid' => $invocieno,
                    'pid' => $product_id[$key],
                    'product' => $product_name1[$key],
                    'qty' => $product_qty[$key],
                    'price' => $product_price[$key],
                    'tax' => $product_tax[$key],
                    'discount' => $product_discount[$key],
                    'subtotal' => $product_subtotal[$key],
                    'totaltax' => $ptotal_tax[$key],
                    'totaldiscount' => $ptotal_disc[$key],
                    'product_des' => $product_des[$key]

                );


                $flag = true;
                $productlist[$prodindex] = $data;
                $i++;
                $prodindex++;

                $amt = intval($product_qty[$key]) - intval(@$old_product_qty[$key]);

                if ($product_id[$key] > 0) {
                    $this->db->set('qty', "qty-$amt", FALSE);
                    $this->db->where('pid', $product_id[$key]);
                    $this->db->update('products');
                }
                $itc += $amt;


            }
        } else {
            $taxstatus = 0;
            foreach ($pid as $key => $value) {
                $product_id = $this->input->post('pid');
                $product_name1 = $this->input->post('product_name');
                $product_qty = $this->input->post('product_qty');
                $old_product_qty = $this->input->post('old_product_qty');
                $product_price = $this->input->post('product_price');
                $product_discount = $this->input->post('product_discount');
                $product_subtotal = $this->input->post('product_subtotal');
                $product_des = $this->input->post('product_description');
                $ptotal_disc = $this->input->post('disca');
                $total_discount += $ptotal_disc[$key];
                $data = array(
                    'tid' => $invocieno,
                    'product' => $product_name1,
                    'qty' => $product_qty,
                    'price' => $product_price,
                    'discount' => $product_discount,
                    'subtotal' => $product_subtotal,
                    'product_des' => $product_des[$key]
                );


                $flag = true;
                $productlist[$prodindex] = $data;
                $i++;
                $prodindex++;

                if ($product_id[$key] > 0) {
                    $amt = intval($product_qty[$key]) - intval($old_product_qty[$key]);
                    $this->db->set('qty', "qty-$amt", FALSE);
                    $this->db->where('pid', $product_id[$key]);
                    $this->db->update('products');
                }


                $itc += $amt;

            }
        }

        $bill_date = datefordatabase($invoicedate);
        $bill_due_date = datefordatabase($invocieduedate);

        $data = array(
			'invoicedate' => $bill_date,
			'invoiceduedate' => $bill_due_date,
			'subtotal' => $subtotal,
			'shipping' => $shipping,
			'discount' => $total_discount,
			'tax' => $total_tax,
			'total' => $total,
			'notes' => $notes,
			'csd' => $customer_id,
			'items' => $itc,
			'taxstatus' => $taxstatus,
			'discstatus' => $discstatus,
			'format_discount' => $discountFormat,
			'refer' => $refer,
			'television' => $television,
			'combo' => $combo,
			'puntos' => $puntos,
			'term' => $pterms,
			'multi' => $currency);
        $this->db->set($data);
        $this->db->where('tid', $invocieno);

        if ($flag) {

            if ($this->db->update('invoices', $data)) {
                $this->db->insert_batch('invoice_items', $productlist);
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('Invoice has  been updated') . " <a href='view?id=$invocieno' class='btn btn-info btn-lg'><span class='icon-file-text2' aria-hidden='true'></span> " . $this->lang->line('View') . " </a> "));
            } else {
                echo json_encode(array('status' => 'Error', 'message' =>
                    $this->lang->line('ERROR')));
                $transok = false;
            }


        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                "Please add at least one product in invoice"));
            $transok = false;
        }


        if ($this->input->post('restock')) {
            foreach ($this->input->post('restock') as $key => $value) {


                $myArray = explode('-', $value);
                $prid = $myArray[0];
                $dqty = $myArray[1];
                if ($prid > 0) {

                    $this->db->set('qty', "qty+$dqty", FALSE);
                    $this->db->where('pid', $prid);
                    $this->db->update('products');
                }
            }


        }


        if ($transok) {
            $this->db->trans_complete();
        } else {
            $this->db->trans_rollback();
        }
    }

    public function update_status()
    {
        $tid = $this->input->post('tid');
        $status = $this->input->post('status');


        $this->db->set('status', $status);
        $this->db->where('tid', $tid);
        $this->db->update('invoices');

        echo json_encode(array('status' => 'Success', 'message' =>
            $this->lang->line('UPDATED'), 'pstatus' => $status));
    }


    public function addcustomer()
    {
        $name = $this->input->post('name');
		$dosnombre = $this->input->post('dosnombre');
        $unoapellido = $this->input->post('unoapellido');
		$dosapellido = $this->input->post('dosapellido');
        $company = $this->input->post('company');
        $celular = $this->input->post('celular');
        $celular2 = $this->input->post('celular2');
        $email = $this->input->post('email');
        $nacimiento = $this->input->post('nacimiento');
        $tipo_cliente = $this->input->post('tipo_cliente');
        $tipo_documento = $this->input->post('tipo_documento');
        $documento = $this->input->post('documento');
        $departamento = $this->input->post('departamento');
        $ciudad = $this->input->post('ciudad');
        $localidad = $this->input->post('localidad');
        $barrio = $this->input->post('barrio');
        $nomenclatura = $this->input->post('nomenclatura');
        $numero1 = $this->input->post('numero1');
        $adicionauno = $this->input->post('adicionauno');
        $numero2 = $this->input->post('numero2');
        $adicional2 = $this->input->post('adicional2');
		$numero3 = $this->input->post('numero3');
		$residencia = $this->input->post('residencia');
		$referencia = $this->input->post('referencia');
		$customergroup = $this->input->post('customergroup');
		$name_s = $this->input->post('name_s');
		$contra = $this->input->post('contra');
		$servicio = $this->input->post('servicio');
		$perfil = $this->input->post('perfil');
		$Iplocal = $this->input->post('Iplocal');
		$Ipremota = $this->input->post('Ipremota');
		$comentario = $this->input->post('comentario');
        $this->customers->add($name, $dosnombre, $unoapellido, $dosapellido, $company, $celular, $celular2, $email, $nacimiento, $tipo_cliente, $tipo_documento, $documento, $departamento, $ciudad, $localidad, $barrio, $nomenclatura, $numero1, $adicionauno, $numero2, $adicional2, $numero3, $residencia, $referencia, $customergroup, $name_s, $contra, $servicio, $perfil, $Iplocal, $Ipremota, $comentario);

    }

    public function file_handling()
    {
        if($this->input->get('op')) {
            $name = $this->input->get('name');
            $invoice = $this->input->get('invoice');
            if ($this->invocies->meta_delete($invoice,1, $name)){
            echo json_encode(array('status' => 'Success'));
        }
        }
        else {
            $id = $this->input->get('id');
            $this->load->library("Uploadhandler_generic", array(
                'accept_file_types' => '/\.(gif|jpe?g|png|docx|docs|txt|pdf|xls)$/i', 'upload_dir' => FCPATH . 'userfiles/attach/', 'upload_url' => base_url() . 'userfiles/attach/'
            ));
            $files = (string)$this->uploadhandler_generic->filenaam();
            if ($files != '') {

                $this->invocies->meta_insert($id, 1, $files);
            }
        }


    }

    	    public function delivery()
    {

        $tid = intval($this->input->get('id'));

        $data['id'] = $tid;
        $data['title'] = "Invoice $tid";
        $data['invoice'] = $this->invocies->invoice_details($tid, $this->limited);
        if ($data['invoice']) $data['products'] = $this->invocies->invoice_products($tid);
        if ($data['invoice']) $data['employee'] = $this->invocies->employee($data['invoice']['eid']);

        ini_set('memory_limit', '64M');

        $html = $this->load->view('invoices/del_note', $data, true);

        //PDF Rendering
        $this->load->library('pdf');

        $pdf = $this->pdf->load();

        $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:-6pt;">{PAGENO}/{nbpg} #'.$tid.'</div>');

        $pdf->WriteHTML($html);

        if ($this->input->get('d')) {

            $pdf->Output('DO_#' . $tid . '.pdf', 'D');
        } else {
            $pdf->Output('DO_#' . $tid . '.pdf', 'I');
        }


    }

	    public function proforma()
    {

        $tid = intval($this->input->get('id'));

        $data['id'] = $tid;
        $data['title'] = "Invoice $tid";
        $data['invoice'] = $this->invocies->invoice_details($tid, $this->limited);
        if ($data['invoice']) $data['products'] = $this->invocies->invoice_products($tid);
        if ($data['invoice']) $data['employee'] = $this->invocies->employee($data['invoice']['eid']);
        ini_set('memory_limit', '64M');
        $html = $this->load->view('invoices/proforma', $data, true);
        //PDF Rendering
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:-6pt;">{PAGENO}/{nbpg} #'.$tid.'</div>');
        $pdf->WriteHTML($html);
        if ($this->input->get('d')) {
            $pdf->Output('Proforma_#' . $tid . '.pdf', 'D');
        } else {
            $pdf->Output('Proforma_#' . $tid . '.pdf', 'I');
        }


    }


	 public function duplicate()
    {

        $tid = intval($this->input->get('id'));
        $data['id'] = $tid;
        $data['title'] = "New Invoice";
        $this->load->model('customers_model', 'customers');
		$data['lastinvoice'] = $this->invocies->lastinvoice();
        $data['customergrouplist'] = $this->customers->group_list();
        $data['terms'] = $this->invocies->billingterms();
        $data['currency'] = $this->invocies->currencies();
        $data['invoice'] = $this->invocies->invoice_details($tid, $this->limited);
        if ($data['invoice']) $data['products'] = $this->invocies->invoice_products($tid);

        $head['usernm'] = $this->aauth->get_user()->username;
        $data['warehouse'] = $this->invocies->warehouses();
        $this->load->model('plugins_model', 'plugins');
        $data['exchange'] = $this->plugins->universal_api(5);

        $this->load->view('fixed/header', $head);
        if ($data['invoice']) $this->load->view('invoices/duplicate', $data);
        $this->load->view('fixed/footer');

    }

}