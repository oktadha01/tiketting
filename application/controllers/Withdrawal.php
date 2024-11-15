<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Withdrawal extends AUTH_Controller
{
    var $template = 'tmpt_admin/index';
    public $userdata;
    public $db;
    public $input;
    public $M_withdrawal;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_withdrawal');
    }

    public function index()
    {
        $id_sales = $this->userdata->id_sales;
        $data['list'] = $this->M_withdrawal->_get_datatables_trx($id_sales);
        $total_profit = 0;
        foreach ($data['list'] as $trans) {
            $total_profit += $trans->count * 1000;
        }
        $data['userdata']        = $this->userdata;
        $data['saldo'] = $total_profit;
        $data['tittle']          = 'Withdrawal Profit';
        $data['bread']           = 'Withdrawal';
        // $data['option']          = $this->Banner_kat_model->get_agency();
        $data['content']         = 'page_sales/withdrawal/withdrawal';
        $data['script']          = 'page_sales/withdrawal/withdrawal_js';
        $this->load->view($this->template, $data);
    }

    function get_data_transaksi()
    {
        $id_sales = $this->userdata->id_sales;
        $data['list'] = $this->M_withdrawal->_get_datatables_trx($id_sales);
        $output = '';
        foreach ($data['list'] as $trans) {
            $output .= '<tr>' .
                '<td><div class="form-check form-check-success">' .
                '<label class="form-check-label">' .
                '<input type="checkbox" class="cheklis-send" data-id-event="' . $trans->id_event . '" value="' . $trans->count * 1000 . '">' .
                '<i class="input-helper"></i>' .
                ' </label>' .
                '</div></td>' .
                '<td>' . $trans->nm_event . '</td>' .
                '<td>Rp. ' . number_format($trans->count * 1000, 0, ',', '.') . '</td>' .
                '</tr>';
        }
        echo $output;
    }

    public function pengajuan()
    {
        $id_sales = $this->userdata->id_sales;
        $id_event = $this->input->post('id_event');

        // Define the query to get event data and calculate profit
        $this->db->select('event.id_event, event.nm_event, event.tgl_event, event.status_profit,sales.nama, COUNT(*) as count');
        $this->db->from('transaksi');
        $this->db->join('event', 'event.id_event = transaksi.id_event');
        $this->db->join('sales', 'event.id_sales_event = sales.id_sales');
        $this->db->where('sales.id_sales', $id_sales);
        $this->db->where('event.status_profit', 0);
        $this->db->where_in('event.id_event', $id_event);
        $this->db->group_by('event.id_event');

        $query = $this->db->get();
        $result = $query->result();
        $profit = 0;
        $biaya_transaksi = 2775;

        // Calculate total profit
        foreach ($result as $row) {
            $profit += $row->count * 1000;
            $nama_sales = $row->nama;
            $event_id = $row->id_event;
            $this->M_withdrawal->m_update_status_profit($event_id);
        }

        // Generate withdrawal number
        $this->db->select("MAX(CAST(RIGHT(no_wd, LOCATE('-', REVERSE(no_wd)) - 1) AS UNSIGNED)) as kode", FALSE);
        $this->db->from('transaksi_sales');
        $this->db->order_by('kode', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        $last_counter_result = $query->row();
        $last_counter = isset($last_counter_result->kode) ? $last_counter_result->kode : 0;
        $new_counter = $last_counter + 1;

        // Format the new withdrawal number
        $no_wd = "WD-" . $id_sales . "-" . date('dm') . "-" . $new_counter;

        // Prepare data for insertion
        $data = [
            'sales_id'          => $id_sales,
            'no_wd'             => $no_wd,
            'event_id'          => implode(',', $id_event), // Convert array to string
            'tgl_pengajuan'     => date('d-m-Y'),
            'nominal_transaksi' => $profit,
            'biaya_transaksi'   => $biaya_transaksi,
            'total_transaksi'   => $profit - $biaya_transaksi
        ];

        // Insert data into the database
        $this->M_withdrawal->m_insert_pengajuan($data);

        // Prepare WhatsApp URL

        $to_whatsappNumber = '6289615139363';
        $message = urlencode("Yth. Admin, saya $nama_sales. Dengan ini saya mengajukan penarikan profit dengan kode withdrawal $no_wd. Mohon untuk segera ditinjau dan diproses. Terima kasih.");
        $waUrl = "https://wa.me/$to_whatsappNumber?text=$message";

        // Return the URL to be opened in a new tab
        echo $waUrl;
    }

    function get_data_transaksi_proses()
    {
        $id_sales = $this->userdata->id_sales;
        $data['list'] = $this->M_withdrawal->m_data_transaksi_proses($id_sales);

        // Prepare an array to hold the response data
        $response = [];
        foreach ($data['list'] as $trans) {
            $response[] = [
                'id_event' => $trans->event_id,
                'no_wd' => $trans->no_wd,
                'tgl_pengajuan' => $trans->tgl_pengajuan,
                'nominal_transaksi' => number_format($trans->nominal_transaksi, 0, ',', '.'),
                'biaya_transaksi' => number_format($trans->biaya_transaksi, 0, ',', '.'),
                'total_transaksi' => number_format($trans->total_transaksi, 0, ',', '.'),
            ];
        }

        // Return the response as JSON
        echo json_encode($response);
    }
}
