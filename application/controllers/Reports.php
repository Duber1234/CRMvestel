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

class Reports extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('reports_model', 'reports');
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        if ($this->aauth->get_user()->roleid < 4) {

            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');

        }

    }

    public function index()
    {


    }

    //Statistics

    public function statistics()

    {

        $data['stat'] = $this->reports->statistics();
        $head['title'] = "Statisticst";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('reports/stat', $data);
        $this->load->view('fixed/footer');

    }

    //accounts section

    public function accountstatement()

    {
        $this->load->model('transactions_model');
        $data['accounts'] = $this->transactions_model->acc_list();
        $head['title'] = "Account Statement";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('reports/statement', $data);
        $this->load->view('fixed/footer');

    }
	public function cierre()

    {
        $this->load->model('transactions_model');
        $data['accounts'] = $this->transactions_model->acc_list();
        $head['title'] = "Account Statement";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('invoices/cierre', $data);
        $this->load->view('fixed/footer');

    }

    public function customerstatement()

    {
        $this->load->model('transactions_model');
        $data['accounts'] = $this->transactions_model->acc_list();
        $head['title'] = "Account Statement";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('reports/customer_statement', $data);
        $this->load->view('fixed/footer');

    }

    public function supplierstatement()

    {
        $this->load->model('transactions_model');
        $data['accounts'] = $this->transactions_model->acc_list();
        $head['title'] = "Account Statement";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('reports/supplier_statement', $data);
        $this->load->view('fixed/footer');

    }

    public function viewstatement()

    {
        $this->load->model('accounts_model', 'accounts');
        $pay_acc = $this->input->post('pay_acc');
        $trans_type = $this->input->post('trans_type');
        $sdate = datefordatabase($this->input->post('sdate'));
        $edate = datefordatabase($this->input->post('edate'));
        $ttype = $this->input->post('ttype');
        $account = $this->accounts->details($pay_acc);
        $data['filter'] = array($pay_acc, $trans_type, $sdate, $edate, $ttype, $account['holder']);
		$data['income'] = $this->reports->incomestatement();
        $head['title'] = "Account Statement";
        $head['usernm'] = $this->aauth->get_user()->username;


        $data['datos_informe']=array("pay_acc"=>$pay_acc,"trans_type"=>$trans_type,"sdate"=>$sdate,"edate"=>$edate);
        //codigo listar
            
            
            $datex=new DateTime($sdate);
            $edate=$datex->format('Y-m-d')." 23:59:00";
            
            $list = $this->reports->get_statements($pay_acc, $trans_type, $sdate, $edate);
            
            $lista2=array();
            foreach ($list as $key => $value) {
                if($value['estado']!="Anulada"){
                    $lista2[]=$value;    
                }
                
            }
            $data['lista']=$lista2;
            $anulaciones=array();
            foreach ($list as $key => $value) {
                if($value["estado"]=="Anulada"){
                    $anulaciones[]=$value;
                }
            }
            $data['lista_anulaciones']=$anulaciones;
            
            //obteniendo datos mes actual
            $dia_inicial_mes_actual = date($datex->format("Y-m")."-01 00:00:00");
            $dia_final_de_mes_actual=date($datex->format("Y-m")."-t 23:00:00", strtotime($dia_inicial_mes_actual));
            $lista_mes_actual = $this->reports->get_statements($pay_acc, $trans_type, $dia_inicial_mes_actual, $dia_final_de_mes_actual);
            //end obteniendo datos mes actual
            $data['lista_mes_actual']=$lista_mes_actual;
            //obteniendo datos mes anterior
            $xdate=strtotime($datex->format("Y-m-d")." 00:00:00");
            

            $dia_inicial_mes_anterior=date("Y-m", strtotime("-1 month", $xdate))."-01";
            $dia_final_de_mes_anterior=date("Y-m-t 23:00:00", strtotime($dia_inicial_mes_anterior));
            
            
            
            $lista_mes_anterior = $this->reports->get_statements($pay_acc, $trans_type, $dia_inicial_mes_anterior, $dia_final_de_mes_anterior);
            //obteniendo datos mes anterior
            
            $data['lista_mes_anterior']=$lista_mes_anterior;
        //fin codigo listar
            $data['texto_mes_actual']=$this->reports->devolver_nombre_mes($datex->format('m'))." ".$datex->format('Y');
            $d1=new DateTime($dia_inicial_mes_anterior);
            $data['texto_mes_anterior']=$this->reports->devolver_nombre_mes($d1->format("m"))." ".$d1->format("Y");

            $list3 =array();
            foreach ($lista_mes_anterior as $key => $value) {
                if($value['estado']!="Anulada"){
                    $list3[]=$value;
                }
            }
            $data['lista_mes_anterior']=$list3;
            $lista4=array();
            foreach ($lista_mes_actual as $key => $value) {
                if($value['estado']!="Anulada"){
                    $lista4[]=$value;
                }
            }
            $data['lista_mes_actual']=$lista4;



        $this->load->view('fixed/header', $head);
        $this->load->view('reports/statement_list', $data);
        $this->load->view('fixed/footer');
    }

    public function sacar_pdf(){
         //$this->load->model('accounts_model', 'accounts');
        $pay_acc = $this->input->post('pay_acc');
        $trans_type = $this->input->post('trans_type');
        $sdate = $this->input->post('sdate');
        $edate = $this->input->post('edate');
        //$ttype = $this->input->post('ttype');
        //$account = $this->accounts->details($pay_acc);
        //$data['filter'] = array($pay_acc, $trans_type, $sdate, $edate, $ttype, $account['holder']);
        //$data['income'] = $this->reports->incomestatement();
        //$head['title'] = "Account Statement";
        //$head['usernm'] = $this->aauth->get_user()->username;

        //codigo listar
          $data['fecha']=$sdate;  
             //hice esto para hacer que el cierre sea de un dia si se desea reestablecer a entre fechas solo comentar la linea 57;
              $datex=new DateTime($sdate);
            $edate=$datex->format('Y-m-d')." 23:59:00";
            
            
            $list = $this->reports->get_statements($pay_acc, $trans_type, $sdate, $edate);
            
            $lista2=array();
            foreach ($list as $key => $value) {
                if($value['estado']!="Anulada"){
                    $lista2[]=$value;    
                }
                
            }
            $data['lista']=$lista2;
            $anulaciones=array();
            foreach ($list as $key => $value) {
                if($value["estado"]=="Anulada"){
                    $anulaciones[]=$value;
                }
            }
            $data['lista_anulaciones']=$anulaciones;
            
            $dia_inicial_mes_actual = date($datex->format("Y-m")."-01 00:00:00");
            $dia_final_de_mes_actual=date($datex->format("Y-m")."-t 23:00:00", strtotime($dia_inicial_mes_actual));
            $lista_mes_actual = $this->reports->get_statements($pay_acc, $trans_type, $dia_inicial_mes_actual, $dia_final_de_mes_actual);
            //end obteniendo datos mes actual
            $data['lista_mes_actual']=$lista_mes_actual;
            //obteniendo datos mes anterior
            $xdate=strtotime($datex->format("Y-m-d")." 00:00:00");
            

            $dia_inicial_mes_anterior=date("Y-m", strtotime("-1 month", $xdate))."-01";
            $dia_final_de_mes_anterior=date("Y-m-t 23:00:00", strtotime($dia_inicial_mes_anterior));
            
            
            
            $lista_mes_anterior = $this->reports->get_statements($pay_acc, $trans_type, $dia_inicial_mes_anterior, $dia_final_de_mes_anterior);
            //obteniendo datos mes anterior
            
            $data['lista_mes_anterior']=$lista_mes_anterior;
        //fin codigo listar
            $data['texto_mes_actual']=$this->reports->devolver_nombre_mes($datex->format('m'))." ".$datex->format('Y');
            $d1=new DateTime($dia_inicial_mes_anterior);
            $data['texto_mes_anterior']=$this->reports->devolver_nombre_mes($d1->format("m"))." ".$d1->format("Y");

            $list3 =array();
            foreach ($lista_mes_anterior as $key => $value) {
                if($value['estado']!="Anulada"){
                    $list3[]=$value;
                }
            }
            $data['lista_mes_anterior']=$list3;
            $lista4=array();
            foreach ($lista_mes_actual as $key => $value) {
                if($value['estado']!="Anulada"){
                    $lista4[]=$value;
                }
            }
            $data['lista_mes_actual']=$lista4;


           $data['lista_datos']=$this->statements_para_pdf();


        $this->load->view('reports/sacar_pdf', $data);
    }

    public function customerviewstatement()

    {
        $this->load->model('customers_model', 'customer');
        $cid = $this->input->post('customer');
        $trans_type = $this->input->post('trans_type');
        $sdate = datefordatabase($this->input->post('sdate'));
        $edate = datefordatabase($this->input->post('edate'));
        $ttype = $this->input->post('ttype');
        $customer = $this->customer->details($cid);
        $data['filter'] = array($cid, $trans_type, $sdate, $edate, $ttype, $customer['name']);

        //  print_r( $data['statement']);
        $head['title'] = "Customer Account Statement";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('reports/customerstatement_list', $data);
        $this->load->view('fixed/footer');


    }

    public function supplierviewstatement()

    {
        $this->load->model('supplier_model', 'supplier');
        $cid = $this->input->post('supplier');
        $trans_type = $this->input->post('trans_type');
        $sdate = datefordatabase($this->input->post('sdate'));
        $edate = datefordatabase($this->input->post('edate'));
        $ttype = $this->input->post('ttype');
        $customer = $this->supplier->details($cid);
        $data['filter'] = array($cid, $trans_type, $sdate, $edate, $ttype, $customer['name']);

        //  print_r( $data['statement']);
        $head['title'] = "Supplier Account Statement";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('reports/supplierstatement_list', $data);
        $this->load->view('fixed/footer');


    }


    //

    public function statements()
    {

        $pay_acc = $this->input->post('ac');
        $trans_type = $this->input->post('ty');
        $sdate = datefordatabase($this->input->post('sd'));
        $edate = datefordatabase($this->input->post('ed'));
          $datex=new DateTime($sdate);
            $edate=$datex->format('Y-m-d')." 23:59:00";
            
        $list = $this->reports->get_statements($pay_acc, $trans_type, $sdate, $edate);
        $balance = 0;

        foreach ($list as $row) {
            
            if($row['estado']!="Anulada"){
                $balance += $row['credit'] - $row['debit'];
            echo '<tr><td>' . $row['date'] . '</td><td>' . $row['note'] . '</td><td>' . amountFormat($row['debit']) . '</td><td>' . amountFormat($row['credit']) . '</td><td>' . amountFormat($balance) . '</td></tr>';
            }
        }

    }
    public function statements_para_pdf()
    {

        $pay_acc = $this->input->post('pay_acc');
        $trans_type = $this->input->post('trans_type');
        $sdate = $this->input->post('sdate');
        $edate = $this->input->post('edate');
          $datex=new DateTime($sdate);
            $edate=$datex->format('Y-m-d')." 23:59:00";
            
        $list = $this->reports->get_statements($pay_acc, $trans_type, $sdate, $edate);
        $balance = 0;
        $var_lista="";
        $conteo=0;
        foreach ($list as $row) {
            
            if($row['estado']!="Anulada"){
                $balance += $row['credit'] - $row['debit'];
                $conteo++;
                if($conteo%2==0){
                    $texto_style="style='padding: 0.75rem 2rem;border-bottom: 1px solid #e3ebf3;color: #333;font-size: 12px;text-align: center;'";    
                }else{
                    $texto_style="style='padding: 0.75rem 2rem;border-bottom: 1px solid #e3ebf3;color: #333;font-size: 12px;background-color: rgba(0, 0, 0, 0.05);text-align: center;'";                
                }
                
                $var_lista.= '<tr><td '.$texto_style.'>' . $row['date'] .'</td><td '.$texto_style.'>' . $row['note'] . '</td><td '.$texto_style.'>' . amountFormat($row['debit']) . '</td><td '.$texto_style.'>' . amountFormat($row['credit']) . '</td><td '.$texto_style.'>' . amountFormat($balance) . '</td></tr>';
            }
        }
        return $var_lista;

    }

    public function customerstatements()
    {


        $pay_acc = $this->input->post('ac');
        $trans_type = $this->input->post('ty');
        $sdate = datefordatabase($this->input->post('sd'));
        $edate = datefordatabase($this->input->post('ed'));


        $list = $this->reports->get_customer_statements($pay_acc, $trans_type, $sdate, $edate);
        $balance = 0;

        foreach ($list as $row) {
            $balance += $row['credit'] - $row['debit'];
            echo '<tr><td>' . $row['date'] . '</td><td>' . $row['note'] . '</td><td>' . amountFormat($row['debit']) . '</td><td>' . amountFormat($row['credit']) . '</td><td>' . amountFormat($balance) . '</td></tr>';
        }

    }

    public function supplierstatements()
    {


        $pay_acc = $this->input->post('ac');
        $trans_type = $this->input->post('ty');
        $sdate = datefordatabase($this->input->post('sd'));
        $edate = datefordatabase($this->input->post('ed'));


        $list = $this->reports->get_supplier_statements($pay_acc, $trans_type, $sdate, $edate);
        $balance = 0;

        foreach ($list as $row) {
            $balance += $row['debit'] - $row['credit'];
            echo '<tr><td>' . $row['date'] . '</td><td>' . $row['note'] . '</td><td>' . amountFormat($row['debit']) . '</td><td>' . amountFormat($row['credit']) . '</td><td>' . amountFormat($balance) . '</td></tr>';
        }

    }


    // income section


    public function incomestatement()

    {
        $head['title'] = "Income Statement";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->model('transactions_model');
        $data['accounts'] = $this->transactions_model->acc_list();
        $data['income'] = $this->reports->incomestatement();
        $this->load->view('reports/incomestatement', $data);
        $this->load->view('fixed/footer');

    }


    public function customincome()
    {

        if ($this->input->post('check')) {
            $acid = $this->input->post('pay_acc');
            $sdate = datefordatabase($this->input->post('sdate'));
            $edate = datefordatabase($this->input->post('edate'));

            $date1 = new DateTime($sdate);
            $date2 = new DateTime($edate);

            $diff = $date2->diff($date1)->format("%a");
            if ($diff < 90) {
                $income = $this->reports->customincomestatement($acid, $sdate, $edate);

                echo json_encode(array('status' => 'Success', 'message' => 'Calculated', 'param1' => '<b>Income between the dates is ' . amountFormat(floatval($income['credit'])) . '</b>'));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => 'Date range should be within 90 days', 'param1' => ''));
            }

        }
    }

    // expense section


    public function expensestatement()

    {
        $head['title'] = "Expense Statement";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);

        $this->load->model('transactions_model');
        $data['accounts'] = $this->transactions_model->acc_list();
        $data['income'] = $this->reports->expensestatement();


        $this->load->view('reports/expensestatement', $data);


        $this->load->view('fixed/footer');

    }


    public function customexpense()
    {

        if ($this->input->post('check')) {
            $acid = $this->input->post('pay_acc');
            $sdate = datefordatabase($this->input->post('sdate'));
            $edate = datefordatabase($this->input->post('edate'));

            $date1 = new DateTime($sdate);
            $date2 = new DateTime($edate);

            $diff = $date2->diff($date1)->format("%a");
            if ($diff < 90) {
                $income = $this->reports->customexpensestatement($acid, $sdate, $edate);

                echo json_encode(array('status' => 'Success', 'message' => 'Calculated', 'param1' => '<b>Expense between the dates is ' . amountFormat(floatval($income['debit'])) . '</b>'));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => 'Date range should be within 90 days', 'param1' => ''));
            }

        }

    }


    public function refresh_data()

    {


        $head['title'] = "Refreshing Reports";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('reports/refresh_data');
        $this->load->view('fixed/footer');

    }

    public function refresh_process()

    {

        $this->load->model('cronjob_model');
        if ($this->cronjob_model->reports()) {

            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('Calculated')));
        }

    }

    public function taxstatement()

    {
        $this->load->model('transactions_model');
        $data['accounts'] = $this->transactions_model->acc_list();
        $head['title'] = "TAX Statement";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('reports/tax_statement', $data);
        $this->load->view('fixed/footer');

    }

    public function taxviewstatement()

    {


        $trans_type = $this->input->post('ty');
        $sdate = datefordatabase($this->input->post('sdate'));
        $edate = datefordatabase($this->input->post('edate'));

        $data['filter'] = array($sdate, $edate, $trans_type);

        //  print_r( $data['statement']);
        $head['title'] = "TAX Statement";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('reports/tax_out', $data);
        $this->load->view('fixed/footer');


    }

    public function taxviewstatements_load()
    {


        $trans_type = $this->input->post('ty');
        $sdate = datefordatabase($this->input->post('sd'));
        $edate = datefordatabase($this->input->post('ed'));

if($trans_type=='Sales') {
    $where = " WHERE DATE(invoices.invoicedate) BETWEEN '$sdate' AND '$edate' ";
    $query = $this->db->query("SELECT customers.taxid AS VAT_Number,invoices.tid AS invoice_number,invoices.total AS amount,invoices.tax AS tax,customers.name AS customer_name,customers.company AS Company_Name,invoices.invoicedate AS date FROM invoices LEFT JOIN customers ON invoices.csd=customers.id" . $where);
}
else
{

    $where = " WHERE (DATE(purchase.invoicedate) BETWEEN '$sdate' AND '$edate') ";
    $query = $this->db->query("SELECT supplier.taxid AS VAT_Number,purchase.tid AS invoice_number,purchase.total AS amount,purchase.tax AS tax,supplier.name AS customer_name,supplier.company AS Company_Name,purchase.invoicedate AS date FROM purchase LEFT JOIN supplier ON purchase.csd=supplier.id" . $where);
}


//echo $where;


        $balance = 0;

        foreach ($query->result_array() as $row) {
            $balance += $row['tax'];
            echo '<tr><td>' . $row['invoice_number'] . '</td><td>' . $row['customer_name'] . '</td><td>' . $row['VAT_Number'] . '</td><td>' . amountFormat($row['amount']) . '</td><td>' . amountFormat($row['tax']) . '</td><td>' . amountFormat($balance) . '</td></tr>';
        }




    }


}