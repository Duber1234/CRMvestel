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

class Quote extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('quote_model', 'quote');
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        if ($this->aauth->get_user()->roleid < 2) {

            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');

        }
    }

    //create invoice
    public function create()
    {
        $this->load->model('customers_model', 'customers');
        $this->load->model('plugins_model', 'plugins');
		$this->load->model('ticket_model', 'ticket');		
		$custid = $this->input->get('id');
        $data['details'] = $this->customers->details($custid);
        $data['exchange'] = $this->plugins->universal_api(5);
		$data['facturalist'] = $this->ticket->factura_list($custid);
        $data['currency'] = $this->quote->currencies();
        $data['customergrouplist'] = $this->customers->group_list();
        $data['lastquote'] = $this->quote->lastquote();
        $data['terms'] = $this->quote->billingterms();
        $head['title'] = "New Quote";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['warehouse'] = $this->quote->warehouses();
        $this->load->view('fixed/header', $head);
        $this->load->view('quotes/newquote', $data);
        $this->load->view('fixed/footer');
    }

    //edit invoice
    public function edit()
    {
        $this->load->model('ticket_model', 'ticket');
        $thread_id = intval($this->input->get('id'));
		$ticket = $this->db->get_where('tickets', array('idt' => $thread_id))->row();
		$codigo = $ticket->codigo;
        $data['id'] = $tid;
        $data['title'] = "Quote $tid";
        $data['thread_info'] = $this->ticket->thread_info($thread_id);
		$data['thread_agen'] = $this->ticket->thread_agen($codigo);
        $data['thread_list'] = $this->ticket->thread_list($thread_id);
		$data['facturalist'] = $this->ticket->factura_list($thread_id);
        $head['title'] = "Edit Quote #$tid";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['warehouse'] = $this->quote->warehouses();
        $this->load->model('plugins_model', 'plugins');
        $data['exchange'] = $this->plugins->universal_api(5);
        $this->load->view('fixed/header', $head);
        $this->load->view('quotes/edit', $data);
        $this->load->view('fixed/footer');

    }

    //invoices list
    public function index()
    {
        $head['title'] = "Manage Quote";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('quotes/quotes');
        $this->load->view('fixed/footer');
    }

    //action
    public function action()
    {

        $customer_id = $this->input->post('customer_id');
		$nticket = $this->input->post('ticketnumero');
        $subject = $this->input->post('subject');
        $detalle = $this->input->post('detalle');
        $created = $this->input->post('created');
        $section = $this->input->post('section');
		$factura = $this->input->post('factura');
		$agendar = $this->input->post('agendar');
		$fagenda = $this->input->post('f_agenda');
		$nomen = $this->input->post('nomenclatura');
		$nuno = $this->input->post('numero1');
		$auno = $this->input->post('adicional1');
		$ndos = $this->input->post('numero2');
		$ados = $this->input->post('adicional2');
		$ntres = $this->input->post('numero3');
		$local = $this->input->post('localidad');
		$barrio = $this->input->post('barrio');
		$hora = date($this->input->post('hora'));
		$tv = $this->input->post('tele');
		$inter = $this->input->post('inter');
		$punto = $this->input->post('punto');
        if ($customer_id) {
        	$this->quote->addticket($customer_id, $nticket, $subject, $detalle, $created, $section, $factura,$agendar,$fagenda,$hora,$nomen,$nuno,$auno,$ndos,$ados,$ntres,$local,$barrio,$tv,$inter,$punto);
			
		}


    }


    public function ajax_list()
    {

        $list = $this->quote->get_datatables();
        $data = array();

        $no = $this->input->post('start');


        foreach ($list as $invoices) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $invoices->tid;
            $row[] = $invoices->name;
            $row[] = dateformat($invoices->invoicedate);
            $row[] = amountFormat($invoices->total);
            $row[] = '<span class="st-' . $invoices->status . '">' . $this->lang->line(ucwords($invoices->status)) . '</span>';
            $row[] = '<a href="' . base_url("quote/view?id=$invoices->tid") . '" class="btn btn-success btn-xs"><i class="icon-file-text"></i> ' . $this->lang->line('View') . '</a> &nbsp; <a href="' . base_url("quote/printquote?id=$invoices->tid") . '&d=1" class="btn btn-info btn-xs"  title="Download"><span class="icon-download"></span></a>&nbsp; &nbsp;<a href="#" data-object-id="' . $invoices->tid . '" class="btn btn-danger btn-xs delete-object"><span class="icon-trash"></span></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->quote->count_all(),
            "recordsFiltered" => $this->quote->count_filtered(),
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
        $head['title'] = "Quote $tid";
        $data['invoice'] = $this->quote->quote_details($tid);
        $data['products'] = $this->quote->quote_products($tid);
        $data['attach'] = $this->quote->attach($tid);


        $data['employee'] = $this->quote->employee($data['invoice']['eid']);

        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('quotes/view', $data);
        $this->load->view('fixed/footer');

    }


    public function printquote()
    {

        $tid = intval($this->input->get('id'));

        $data['id'] = $tid;
        $data['title'] = "Quote $tid";
        $data['invoice'] = $this->quote->quote_details($tid);
        $data['products'] = $this->quote->quote_products($tid);
        $data['employee'] = $this->quote->employee($data['invoice']['eid']);

        ini_set('memory_limit', '64M');

        $html = $this->load->view('quotes/view-print-'.LTR, $data, true);


        //PDF Rendering
        $this->load->library('pdf');

        $pdf = $this->pdf->load();

        $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:-6pt;">{PAGENO}/{nbpg} #'.$tid.'</div>');

        $pdf->WriteHTML($html);

        if ($this->input->get('d')) {

            $pdf->Output('Quote_#' . $tid . '.pdf', 'D');
        } else {
            $pdf->Output('Quote_#' . $tid . '.pdf', 'I');
        }


    }

    public function delete_i()
    {
        $id = $this->input->post('deleteid');

        if ($this->quote->quote_delete($id)) {
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
		$nticket = $this->input->post('ticketnumero');
		$agendar = $this->input->post('agendar');
		$fagenda = $this->input->post('f_agenda');
		$hora = $this->input->post('hora');
        $subject = $this->input->post('subject');
        $detalle = $this->input->post('detalle');
        $created = $this->input->post('created');
        $section = $this->input->post('section');
		$factura = $this->input->post('factura'); 
        $bill_date = datefordatabase($created);       
        $data = array('codigo' => $nticket, 'subject' => $subject, 'detalle' => $detalle, 'created' => $bill_date, 'section' => $section, 'id_factura' => $factura);
        $this->db->set($data);
        $this->db->where('idt', $customer_id);
		$this->db->update('tickets');
		$start = datefordatabase($fagenda);
			
			if ($agendar==actualizar){
				$data2 = array(					
					'title' => $detalle.' '.$hora.' Orden #'.$nticket,
					'start' => $start,            
					'description' => strip_tags($section)           
				);
				$this->db->where('idorden', $nticket);
				$this->db->update('events', $data2);
			}
			if ($agendar==si){
				$data2 = array(
					'idorden' => $nticket,
					'title' => $detalle.' '.$hora.' Orden #'.$nticket,
					'start' => $start,            
					'description' => strip_tags($section)           
				);
				$this->db->insert('events', $data2);
			}
		
		

        echo json_encode(array('status' => 'Success', 'message' =>
            $this->lang->line('UPDATED'), 'pstatus' => $status));
        


        
    }


    public function update_status()
    {
        $tid = $this->input->post('tid');
        $status = $this->input->post('status');


        $this->db->set('status', $status);
        $this->db->where('tid', $tid);
        $this->db->update('quotes');

        echo json_encode(array('status' => 'Success', 'message' =>
            $this->lang->line('Quote Status updated') . '', 'pstatus' => $status));
    }

    public function convert()
    {
        $tid = $this->input->post('tid');


        if ($this->quote->convert($tid)) {

            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('Quote to invoice conversion')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }

    public function file_handling()
    {
        if($this->input->get('op')) {
            $name = $this->input->get('name');
            $invoice = $this->input->get('invoice');
            if ($this->quote->meta_delete($invoice,2, $name)){
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
                $fid = rand(100, 9999);
                $this->quote->meta_insert($id, 2, $files);
            }
        }


    }


}