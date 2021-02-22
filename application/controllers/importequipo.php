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
use PhpOffice\PhpSpreadsheet\IOFactory;
class Importequipo extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->library("Aauth");
        $this->load->model('export_model', 'export');
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
            exit;
        }

        if ($this->aauth->get_user()->roleid < 5) {

            exit('Not Allowed!');
        }
        $this->date = 'backup_' . date('Y_m_d_H_i_s');


    }
    function equipos()
    {
        $this->load->helper(array('form'));
        $this->load->model('categories_model');
        $head['title'] = "Importar Equipos";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['almacen'] = $this->categories_model->almacen_list();
        $data['warehouse'] = $this->categories_model->warehouse_list();
        $this->load->view('fixed/header', $head);
        $this->load->view('import/equipos', $data);
        $this->load->view('fixed/footer');

    }
	function usuarios()
    {
        $this->load->helper(array('form'));
        $this->load->model('categories_model');
        $head['title'] = "Importar usuarios";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['almacen'] = $this->categories_model->almacen_list();
        $data['warehouse'] = $this->categories_model->warehouse_list();
        $this->load->view('fixed/header', $head);
        $this->load->view('import/usuarios', $data);
        $this->load->view('fixed/footer');

    }
	function facturas()
    {
        $this->load->helper(array('form'));
        $this->load->model('categories_model');
        $head['title'] = "Importar usuarios";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['almacen'] = $this->categories_model->almacen_list();
        $data['warehouse'] = $this->categories_model->warehouse_list();
        $this->load->view('fixed/header', $head);
        $this->load->view('import/facturas', $data);
        $this->load->view('fixed/footer');

    }

    public function equipos_upload()
    {
        //datos del arhivo enviado por post
        $nombre_archivo = "temporal.csv";
        $tipo_archivo = $_FILES['cargar_csv']['type'];
        $tamano_archivo = $_FILES['cargar_csv']['size'];
		$bill_date = datefordatabase($array[5]);
        $bill_due_date = datefordatabase($array[6]);
        //comprobacion de extencion
        if(strcasecmp($tipo_archivo,"csv")){
            //copiando el archivo a la ruta application/cache/temporal.csv
            if (move_uploaded_file($_FILES['cargar_csv']['tmp_name'],  'application/cache/'.$nombre_archivo)){
                //abriendo el archivo para lectura
                $fp = fopen('application/cache/'.$nombre_archivo, "r");
                //indice para saber la linea del archivo
                $i=0;
                while (!feof($fp)){
                    //lectura de cada linea 
                    $linea = fgets($fp);
                    //separacion de la linea por ; en un array
                    $array = explode(";",$linea);
                    //comprovacion de que no sea la primera linea porque la destine para el encabezado en la generacion y que el primer dato del array tiene que ser diferente a nada y tambien un entero
                    if($i!=0 && strcasecmp($array[0],"")!=false){
                        $datax['codigo']=$array[0];
                        $datax['proveedor']=$array[1];
                        $datax['almacen']=$array[2];
                        $datax['mac']=$array[3];
                        $datax['serial']=$array[4];
                        $datax['llegada']=$bill_date;
                        $datax['final']=$bill_due_date;
                        $datax['marca']=$array[7];
                        $datax['asignado']=$array[8];
                        $datax['estado']=$array[9];
                        $datax['observacion']=$array[10];
                        
                        
                        $equipo = $this->db->get_where('equipos',array('codigo'=>$datax['codigo']))->row();
                        if(!isset($equipo)){
                          $this->db->insert('equipos',$datax);
                        }
                    }
                    //aumento indice en cada iteracion
                    $i++;
                }
                fclose($fp);
                $_SESSION['importacion']=true;
                redirect(base_url().'products/equipos' , 'refresh');
         }else{
            $_SESSION['importacion']=false;
                echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
         }
        }
        
    }
	 public function usuarios_upload()
    {
        //datos del arhivo enviado por post
        $nombre_archivo = $this->input->post('name');
        $tipo_archivo = $_FILES['cargar_csv']['type'];
        $tamano_archivo = $_FILES['cargar_csv']['size'];
		$bill_date = datefordatabase($array[9]);        
        //comprobacion de extencion
        if(strcasecmp($tipo_archivo,"csv")){
            //copiando el archivo a la ruta application/cache/temporal.csv
            if (move_uploaded_file($_FILES['cargar_csv']['tmp_name'],  'application/cache/'.$nombre_archivo)){
                //abriendo el archivo para lectura
                $fp = fopen('application/cache/'.$nombre_archivo, "r");
                //indice para saber la linea del archivo
                $i=0;
                while (!feof($fp)){
                    //lectura de cada linea 
                    $linea = fgets($fp);
                    //separacion de la linea por ; en un array
                    $array = explode(";",$linea);
                    //comprovacion de que no sea la primera linea porque la destine para el encabezado en la generacion y que el primer dato del array tiene que ser diferente a nada y tambien un entero
                    if($i!=0 && strcasecmp($array[0],"")!=false){
                        $datax['abonado']=$array[0];
                        $datax['name']=$array[1];
                        $datax['dosnombre']=$array[2];
                        $datax['unoapellido']=$array[3];
                        $datax['dosapellido']=$array[4];
                        $datax['company']=$array[5];
                        $datax['celular']=$array[6];
                        $datax['celular2']=$array[7];
                        $datax['email']=$array[8];
                        $datax['nacimiento']=$bill_date;
                        $datax['tipo_cliente']=$array[10];
						$datax['tipo_documento']=$array[11];
						$datax['documento']=$array[12];
						$datax['departamento']=$array[13];
						$datax['ciudad']=$array[14];
						$datax['localidad']=$array[15];
						$datax['barrio']=$array[16];
						$datax['nomenclatura']=$array[17];
						$datax['numero1']=$array[18];						
						$datax['adicionauno']=$array[19];
						$datax['numero2']=$array[20];
						$datax['adicional2']=$array[21];
						$datax['numero3']=$array[22];
						$datax['residencia']=$array[23];
						$datax['referencia']=$array[24];
						$datax['picture']='example.png';
						$datax['gid']=$array[25];
						$datax['name_s']=$array[26];
						$datax['contra']=$array[27];
						$datax['servicio']=$array[28];
						$datax['perfil']=$array[29];
						$datax['Iplocal']=$array[30];
						$datax['Ipremota']=$array[31];
						$datax['comentario']=$array[32];
						$datax['macequipo']=$array[33];
						$datax['usu_estado']=$array[34];
						$datax['balance']=$array[35];                        
                        
                        $usuarios = $this->db->get_where('customers',array('abonado'=>$datax['abonado']))->row();
                        if(!isset($usuarios)){
                          $this->db->insert('customers',$datax);
                        }
                    }
                    //aumento indice en cada iteracion
                    $i++;
                }
                fclose($fp);
                $_SESSION['importacion']=true;
                redirect(base_url().'Customers/index' , 'refresh');
         }else{
            $_SESSION['importacion']=false;
                echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
         }
        }
        
    }
	 public function facturas_upload()
    {
        //datos del arhivo enviado por post
        $nombre_archivo = $this->input->post('name');
        $tipo_archivo = $_FILES['cargar_csv']['type'];
        $tamano_archivo = $_FILES['cargar_csv']['size'];
		
		$bill_date = datefordatabase($array[1]);
		$bill_date_2 = datefordatabase($array[2]);
        //comprobacion de extencion
        if(strcasecmp($tipo_archivo,"csv")){
            //copiando el archivo a la ruta application/cache/temporal.csv
            if (move_uploaded_file($_FILES['cargar_csv']['tmp_name'],  'application/cache/'.$nombre_archivo)){
                //abriendo el archivo para lectura
                $fp = fopen('application/cache/'.$nombre_archivo, "r");
                //indice para saber la linea del archivo
                $i=0;
                while (!feof($fp)){
                    //lectura de cada linea 
                    $linea = fgets($fp);
                    //separacion de la linea por ; en un array
                    $array = explode(";",$linea);
                    //comprovacion de que no sea la primera linea porque la destine para el encabezado en la generacion y que el primer dato del array tiene que ser diferente a nada y tambien un entero
                    if($i!=0 && strcasecmp($array[0],"")!=false){
                        $datax['tid']=$array[0];
                        $datax['invoicedate']=$bill_date;
                        $datax['invoiceduedate']=$bill_date_2;
                        $datax['subtotal']=$array[3];
                        $datax['shipping']=$array[4];
                        $datax['discount']=$array[5];
                        $datax['tax']=$array[6];
                        $datax['total']=$array[7];
                        $datax['pmethod']=$array[8];
                        $datax['notes']=$array[9];
                        $datax['status']=$array[10];
						$datax['csd']=$array[11];
						$datax['eid']=$array[12];
						$datax['pamnt']=$array[13];
						$datax['items']=$array[14];
						$datax['taxstatus']=$array[15];
						$datax['discstatus']=$array[16];
						$datax['format_discount']=$array[17];
						$datax['refer']=$array[18];						
						$datax['television']=$array[19];
						$datax['combo']=$array[20];
						$datax['puntos']=$array[21];
						$datax['term']=$array[22];
						$datax['rec']=$array[23];
						$datax['ron']=$array[24];
						$datax['multi']=$array[25];
						$saldo = $array[26];
						//servicios agregados
						$lista_de_invoice_items = $this->db->select('*')->from('invoice_items')->get()->result();
						$datay['tid']=$datax['tid'];
						$datay['qty']=1;						
						$datay['discount']=0;						
						$datay['totaldiscount']=0;
							if($datax['combo']!==no){
								if($datax['combo']==='3Megas'){
									$datay['pid']=24;
								}else if($datax['combo']==='3MegasV'){
									$datay['pid']=243;
								}else if($datax['combo']==='3MegasSolo'){
									$datay['pid']=170;
								}else if($datax['combo']==='5Megas'){
									$datay['pid']=25;
								}else if($datax['combo']==='5MegasV'){
									$datay['pid']=244;
								}else if($datax['combo']==='5MegasVS'){
									$datay['pid']=247;
								}else if($datax['combo']==='5MegasSolo'){
									$datay['pid']=171;
								}else if($datax['combo']==='10Megas'){
									$datay['pid']=26;
								}else if($datax['combo']==='10MegasV'){
									$datay['pid']=245;
								}else if($datax['combo']==='10MegasSolo'){
									$datay['pid']=172;
								}else if($datax['combo']==='10MegasVS'){
									$datay['pid']=246;
								}else if($datax['combo']==='2Megas'){
									$datay['pid']=126;
								}else if($datax['combo']==='1Mega'){
									$datay['pid']=125;
								}
								$producto = $this->db->get_where('products',array('pid'=>$datay['pid']))->row();
								$x=intval($producto->product_price);								
								$datay['product']=$producto->product_name;
								$datay['qty']=1;
								$datay['price']=$x;
								$datay['tax']=0;								
								$datay['totaltax']=0;
								$datay['subtotal']=$x;
								$this->db->insert('invoice_items',$datay);    
							}

							if($datax['television']!==no){                
								$producto = $this->db->get_where('products',array('pid'=>27))->row();
								$datay['pid']=$producto->pid;
								$datay['product']=$producto->product_name;
								$datay['qty']=1;
								$x=intval($producto->product_price);							
								$datay['price']=$x;
								$datay['tax']=19;
								$datay['totaltax']=3992;
								$datay['subtotal']=$x+$datay['totaltax'];
								$this->db->insert('invoice_items',$datay);
							}
							if($datax['puntos']!==0){                
								$producto = $this->db->get_where('products',array('pid'=>158))->row();
								$datay['pid']=$producto->pid;
								$datay['product']=$producto->product_name;
								$datay['qty']=$datax['puntos'];
								$x=intval($producto->product_price);
								$datay['tax']=0;
								$datay['totaltax']=0;
								$datay['price']=$x;
								$datay['subtotal']=$x*$datay['qty'];
								$this->db->insert('invoice_items',$datay);
							}
							if($saldo!==0){                
								$producto = $this->db->get_where('products',array('pid'=>153))->row();
								$datay['pid']=$producto->pid;
								$datay['product']=$producto->product_name;
								$datay['qty']=1;
								$x=intval($array[26]);
								$datay['tax']=0;
								$datay['totaltax']=0;
								$datay['price']=$x;
								$datay['subtotal']=$x;
								$this->db->insert('invoice_items',$datay);
							}
							
                        
                        $facturas = $this->db->get_where('invoices',array('tid'=>$datax['tid']))->row();
                        if(!isset($facturas)){
                          $this->db->insert('invoices',$datax);
                        }
                    }
                    //aumento indice en cada iteracion
                    $i++;
                }
                fclose($fp);
                $_SESSION['importacion']=true;
                redirect(base_url().'invoices/index' , 'refresh');
         }else{
            $_SESSION['importacion']=false;
                echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
         }
        }
        
    }


    public function start_process()
    {
        require APPPATH . 'third_party/vendor/autoload.php';

        $name = $this->input->post('name');        
        $warehouse = $this->input->post('wid');
        $inputFileName = FCPATH . 'userfiles/' . $name;

        $spreadsheet = IOFactory::load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, false);
//print_r($sheetData);

		
        $products=array();
		

        foreach ($sheetData as $row) {
			
			$products[] = array(
                'id' => null,				
				'codigo' => $row[0],
                'proveedor' => $row[1],
				'almacen' => $warehouse,
                'mac' => $row[2],
                'serial' => $row[3],
                'llegada' => $row[4],
                'final' => $row[5],
                'marca' => $row[6],
                'asignado' => $row[7],
                'estado' => $row[8],
                'observacion' => $row[9]
            );


        }
        unlink( FCPATH . 'userfiles/' . $name);
        if(count($sheetData[0])==9) {
            $out = $this->db->insert_batch('equipos', $products);
            if($out) {
                echo json_encode(array('status' => 'Success', 'message' =>
                    "Product Data Imported Successfully!"));
            }
            else{
                echo json_encode(array('status' => 'Error', 'message' =>
                    "Database Import Error! Please use proper encoding of file and its content."));
            }
        }
        else{
            echo json_encode(array('status' => 'Error', 'message' =>
                "Please correct the format of CSV file, it should be as per template."));
        }


    }


    //customer





}