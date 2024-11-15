<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Carbon\Carbon;
use Xendit\Invoice;

class Callback extends CI_Controller
{
    public $db;
    public $input;
    public $output;
    public $M_transaksi;
    public $M_callback;
    public $email;
    public $uri;

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_transaksi');
        $this->load->model('M_callback');
    }

    function callback_invoice()
    {

        xendit_loaded();
        $this->db->trans_begin();

        // $xenditXCallbackToken = 'xIgnYLs9PRcUYjZzYJc1EZUP5Aj3W7dTrCH6AHJOBJ67g7Zl';

        try {
            $rawRequestInput = file_get_contents("php://input");
            $request         = json_decode($rawRequestInput, true);

            $_id                 = $request['id'];
            $_externalId         = $request['external_id'];
            $_userId             = $request['user_id'];
            $_status             = $request['status'];
            $_paidAt             = $request['paid_at'];
            $_paymentChannel     = $request['payment_channel'];
            $_paymentDestination = $request['payment_destination'];
            $_amount             = $request['amount'];

            $status = '0';
            if ($_status == 'PAID') {
                $status = '1';

                $date_convert = Carbon::parse($_paidAt);
                $datetime = $date_convert->format('d-m-Y H:i:s');

                $this->send_email($_externalId, $_paymentChannel, $datetime, $_amount);

                $this->db->set('bank', $_paymentChannel)
                    ->set('tgl_byr', $datetime)
                    ->set('status_transaksi', $status)
                    ->where('code_bayar', $_externalId)
                    ->update('transaksi');

                $this->db->insert('saldo', [
                    'code_bayar'   => $_externalId,
                    'tanggal'      => $datetime,
                    'nominal'      => $_amount,
                ]);
            } else if ($_status == 'EXPIRED') {

                $tiketCounts = array();
                $code_bayar = $_externalId;
                $data['tiket'] = $this->M_transaksi->m_select_tiket($code_bayar);
                foreach ($data['tiket'] as $file) {
                    $id_price = $file->id_price;

                    if (isset($tiketCounts[$id_price])) {
                        $tiketCounts[$id_price]++;
                    } else {
                        $tiketCounts[$id_price] = 1;
                    }
                    unlink('./upload/pdf/pdf-' . $file->code_tiket . '.pdf');
                    unlink('./upload/qr/qr-' . $file->code_tiket . '.png');
                }
                $this->M_transaksi->m_delete_transaksi_tiket($code_bayar);
                foreach ($tiketCounts as $id_price => $count) {
                    $this->db->select("*");
                    $this->db->where('id_price', $id_price);
                    $query_ = $this->db->get('price');
                    if ($query_->num_rows() <> 0) {
                        $data_ = $query_->row();
                        $id_price = $data_->id_price;
                        $stock_tiket = $data_->stock_tiket + $count;
                        $this->M_transaksi->m_update_stock_tiket($id_price, $stock_tiket);
                    }
                }
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }

            $response = [
                'status'  => true,
                'message' => 'Permintaan Diterima',
                'detail'  => $request,
            ];
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => false,
                    'errors' => [
                        'message' => $e->getMessage(),
                        'type' => 'input',
                    ],
                    'detail' => [],
                ]));
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    function event_free_tiket()
    {
        $_externalId = $this->uri->segment(3);
        $_paymentChannel = '-';
        $datetime = date('d-m-Y H:i:s');
        $_amount = 'free';
        $this->send_email($_externalId, $_paymentChannel, $datetime, $_amount);
    }
    
    // function send_email()
    function send_email($_externalId, $_paymentChannel, $datetime, $_amount)
    {
        if ($_amount == 'free') {
            $_amount = 'Gratis';
        } else {
            $_amount = 'Rp. ' . number_format($_amount, 0, ',', '.');
        }
    
        $data['data_tiket'] = $this->M_callback->m_data_tiket($_externalId);
        $data['transaksi'] = $this->M_callback->m_data_transaksi($_externalId);
        $data['data_e_tiket'] = $this->M_callback->m_data_e_tiket($_externalId);
    
        $data_transaksi = [];
        foreach ($data['transaksi'] as $trans) {
            $email = isset($trans->email) ? $trans->email : ''; // Pastikan variabel $email terdefinisi
            $nm_customer = isset($trans->nm_customer) ? $trans->nm_customer : ''; 
            $nm_kategori_event = isset($trans->nm_kategori_event) ? $trans->nm_kategori_event : ''; // Pastikan variabel $nm_kategori_event terdefinisi
            $nm_event = isset($trans->nm_event) ? $trans->nm_event : ''; 
            $lokasi = isset($trans->lokasi) ? $trans->lokasi : ''; 
            $tgl_event = isset($trans->tgl_event) ? $trans->tgl_event : ''; 
            $jam_event = isset($trans->jam_event) ? $trans->jam_event : ''; 
            $kota_event = isset($trans->nama) ? $trans->nama : '';
    
            $data_transaksi[] = [
                'nm_customer' => $nm_customer,
                'nm_kategori_event' => $nm_kategori_event,
                'nm_event' => $nm_event,
                'lokasi' => $lokasi,
                'tgl_event' => $tgl_event,
                'jam_event' => $jam_event,
                'invoice' => $_externalId,
                'payment' => $_paymentChannel,
                'tgl_trans' => $datetime,
                'nominal' => $_amount,
                'kota_event' => $kota_event,
            ];
        }
        $data['data_transaksi'] = $data_transaksi;
    
        // Setup konfigurasi email
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'talang.iixcp.rumahweb.net',
            'smtp_user' => 'tiket@wisdil.com',
            'smtp_pass' => 'tiket123!',
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];
    
        $email_to_user = $email; // Pastikan variabel $email sudah memiliki nilai
    
        $this->load->library('email', $config);
        $this->email->from('tiket@wisdil.com', 'Wisdil.com');
        $this->email->to($email_to_user);
        $this->email->subject('Tiket ' . $nm_kategori_event . ' anda - Invoice #' . $_externalId);
    
        // Load email template
        $body = $this->load->view('client/email/email_template.php', $data, true);
        $this->email->message($body);
    
        // Lampirkan file PDF
        
       // CUSTOM ADD PDF
        $pdfFilePath = FCPATH . 'upload/pdf/DOS&DONT.pdf'; // Assuming FCPATH is defined and points to the root of your project
        $this->email->attach($pdfFilePath);
        // END CUSTOM ADD PDF

        foreach ($data['data_e_tiket'] as $tiket) {
            $pdfFilePath = FCPATH . 'upload/pdf/pdf-' . $tiket->code_tiket . '.pdf';
            if (file_exists($pdfFilePath)) {
                $this->email->attach($pdfFilePath);
            }
        }
    
        if (!$this->email->send()) {
            log_message('error', 'Email gagal dikirim: ' . $this->email->print_debugger());
        }
    }

}