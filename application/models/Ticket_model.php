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

class Ticket_model extends CI_Model
{


    //documents list
	var $table = 'customers';
    var $doccolumn_order = array(null, 'id', 'subject', 'created','status', null);
    var $doccolumn_search = array('idt', 'abonado', 'asignado', 'cid', 'subject','detalle', 'created','status');


    public function thread_list($id)
    {
        $this->db->select('tickets_th.*,customers.name AS custo,employee_profile.name AS emp');
        $this->db->from('tickets_th');
        $this->db->join('customers', 'tickets_th.cid=customers.id', 'left');
        $this->db->join('employee_profile', 'tickets_th.eid=employee_profile.id', 'left');
        $this->db->where('tickets_th.tid', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    private function send_email($mailto, $mailtotitle, $subject, $message, $attachmenttrue = false, $attachment = '')
    {
        $this->load->library('ultimatemailer');
        $this->db->select('host,port,auth,auth_type,username,password,sender');
        $this->db->from('sys_smtp');
        $query = $this->db->get();
        $smtpresult = $query->row_array();
        $host = $smtpresult['host'];
        $port = $smtpresult['port'];
        $auth = $smtpresult['auth'];
		 $auth_type = $smtpresult['auth_type'];
        $username = $smtpresult['username'];;
        $password = $smtpresult['password'];
        $mailfrom = $smtpresult['sender'];
        $mailfromtilte = $this->config->item('ctitle');

        $this->ultimatemailer->bin_send($host, $port, $auth,$auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto, $mailtotitle, $subject, $message, $attachmenttrue, $attachment);

    }

    public function thread_info($id)
    {
        $this->db->select('tickets.*, customers.name,customers.email,customers.nomenclatura,customers.numero1,customers.adicionauno,customers.numero2,customers.adicional2,customers.numero3,customers.documento,customers.barrio,customers.celular,customers.unoapellido');
        $this->db->from('tickets');
        $this->db->join('customers', 'tickets.cid=customers.id', 'left');
        $this->db->where('tickets.idt', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
	public function barrios_list($id)
    { 
		$this->db->select('*');
        $this->db->from('barrio');
        $this->db->where('idLocalidad', $id);
        $query = $this->db->get();
        return $query->result_array(); 
    }
	public function group_barrio($id)
    {

        $this->db->from('barrio');
        $this->db->where('idBarrio', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
	public function details($thread_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $thread_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function ticket()
    {
        $this->db->select('*');
        $this->db->from('univarsal_api');
        $this->db->where('id', 3);
        $query = $this->db->get();
        return $query->row();
    }
	public function tecnico_list()
    {
        $query = $this->db->query("SELECT id,username FROM aauth_users WHERE UPPER(roleid) >= '3'");
        return $query->result_array();		
		
    }
	public function factura_list($custid)
    {
        $query = $this->db->query('SELECT id, tid, invoicedate FROM invoices WHERE csd=\''.$custid.'\'');
        return $query->result_array();
		
    }

    function addreply($thread_id, $message, $filename)
    {
        $data = array('tid' => $thread_id, 'message' => $message, 'cid' => 0, 'eid' => $this->aauth->get_user()->id, 'cdate' => date('Y-m-d H:i:s'), 'attach' => $filename);
        if ($this->ticket()->key2) {

            $customer = $this->thread_info($thread_id);

            $this->send_email($customer['email'], $customer['name'], '[Customer Ticket] #' . $thread_id, $message . $this->ticket()->other, $attachmenttrue = false, $attachment = '');

        }
        return $this->db->insert('tickets_th', $data);

    }

    function deleteticket($id)
    {
        $this->db->delete('tickets', array('idt' => $id));

        $this->db->select('attach');
        $this->db->from('tickets_th');
        $this->db->where('tid', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        foreach ($result as $row) {
            if ($row['attach'] != '') {

                unlink(FCPATH . 'userfiles/support/' . $row['attach']);

            }
        }
        $this->db->delete('tickets_th', array('tid' => $id));
        return true;
    }

    public function ticket_stats()
    {

        $query = $this->db->query("SELECT
				COUNT(IF( status = 'Pendiente', id, NULL)) AS Pendiente,
				COUNT(IF( status = 'Realizando', id, NULL)) AS Realizando,
				COUNT(IF( status = 'Resuelto', id, NULL)) AS Resuelto
				FROM tickets ");
        echo json_encode($query->result_array());

    }


    function ticket_datatables($filt)
    {
        $this->ticket_datatables_query($filt);
        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }

    private function ticket_datatables_query($filt)
    {

        $this->db->from('tickets');
        if ($filt == 'unsolved') {
            $this->db->where('status!=', 'Solved');
        }
		$this->db->join('customers', 'tickets.cid=customers.id', 'left');
        $i = 0;

        foreach ($this->doccolumn_search as $item) // loop column
        {
            $search = $this->input->post('search');
            $value = $search['value'];
            if ($value) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->doccolumn_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) {
            $this->db->order_by($this->doccolumn_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function ticket_count_filtered($filt)
    {
        $this->ticket_datatables_query($filt);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function ticket_count_all($filt)
    {
        $this->ticket_datatables_query($filt);
        $query = $this->db->get();
        return $query->num_rows();
    }
	function addticket($subject, $message, $filename)
    {
        $data = array('subject' => $subject, 'created' => date('Y-m-d H:i:s'), 'cid' => $this->session->userdata('user_details')[0]->cid, 'status' => 'Waiting');
        $this->db->insert('tickets', $data);
        $thread_id = $this->db->insert_id();


        $data = array('tid' => $thread_id, 'message' => $message, 'cid' => $this->session->userdata('user_details')[0]->cid, 'eid' => 0, 'cdate' => date('Y-m-d H:i:s'), 'attach' => $filename);
        if ($this->ticket()->key2) {


            $this->send_email($this->ticket()->url, $this->ticket()->name, '[Customer Ticket] #' . $thread_id, $message, $attachmenttrue = false, $attachment = '');

        }

        return $this->db->insert('tickets_th', $data);


    }
	public function meta_insert($id, $type, $meta_data)
    {

        $data = array('type' => $type, 'rid' => $id, 'col1' => $meta_data);
        if ($id) {
            return $this->db->insert('meta_data', $data);
        } else {
            return 0;
        }
    }

    public function attach($id)
    {
        $this->db->select('meta_data.*');
        $this->db->from('meta_data');
        $this->db->where('meta_data.type', 5);
        $this->db->where('meta_data.rid', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function meta_delete($id,$type,$name)
    {
        if (@unlink(FCPATH . 'userfiles/attach/' . $name)) {
            return $this->db->delete('meta_data', array('rid' => $id, 'type' => $type, 'col1' => $name));
        }
    }


}