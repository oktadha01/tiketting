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

        $xenditXCallbackToken = 'xIgnYLs9PRcUYjZzYJc1EZUP5Aj3W7dTrCH6AHJOBJ67g7Zl';

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
                $this->send_email($_externalId, $_paymentChannel, $datetime, $_amount);
            } else if ($_status == 'EXPIRED') {

                $this->db->where('code_bayar', $_externalId)->delete('tiket');
                $this->db->where('code_bayar', $_externalId)->delete('transaksi');

                $tiketCounts = array();
                $code_bayar = $this->input->post('code-bayar');
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

    // function send_email($_externalId, $_paymentChannel, $datetime, $_amount)
    function send_email()
    {
        // CB-54020215-0006
        $_externalId = 'CB-53021515-0007';
        $_paymentChannel = 'BCA';
        $datetime = '10-12-2024 09:00';
        $_amount = '100000';
        $data['data_tiket'] = $this->M_callback->m_data_tiket($_externalId);
        $data['transaksi'] = $this->M_callback->m_data_transaksi($_externalId);
        $data['data_e_tiket'] = $this->M_callback->m_data_e_tiket($_externalId);

        $data_transaksi = [];
        foreach ($data['transaksi'] as $trans) {
            $email = $trans->email;
            $nm_customer = $trans->nm_customer;
            $nm_kategori_event = $trans->nm_kategori_event;
            $nm_event = $trans->nm_event;
            $lokasi = $trans->lokasi;
            $tgl_event = $trans->tgl_event;
            $jam_event = $trans->jam_event;
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
            ];
        }
        $data['data_transaksi'] = $data_transaksi;
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'mail.wisdil.com',
            'smtp_user' => 'tiket@wisdil.com',  // Email gmail
            'smtp_pass'   => 'tiket123!',  // Password gmail
            // 'smtp_host' => 'smtp.gmail.com',
            // 'smtp_user' => 'Oktadha01@gmail.com',  // Email gmail
            // 'smtp_pass'   => 'rvcw cvny ibav czbh',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];
        // $email_to_user = $this->session->userdata('gmail');
        $email_to_user = $email;
        $this->load->library('email', $config);
        $this->email->from('tiket@wisdil.com', 'Wisdil.com');
        $this->email->to($email_to_user);
        $this->email->subject('Tiket ' . $nm_kategori_event . ' anda - Invoice #' . $_externalId);

        $body = $this->load->view('client/email/email_template.php', $data, true);

        $this->email->message($body);
        // Array to store dynamic PDF file paths
        $pdfFilepaths = array();

        foreach ($data['data_e_tiket'] as $tiket) {
            $pdfFilePath = FCPATH . 'upload/pdf/pdf-' . $tiket->code_tiket . '.pdf'; // Assuming FCPATH is defined and points to the root of your project
            if (file_exists($pdfFilePath)) { // Check if the file exists before adding it to the array
                $pdfFilepaths[] = $pdfFilePath;
            } else {
                echo 'Error! PDF file not found for code_tiket: ' . $tiket->code_tiket;
            }
            $this->email->attach($pdfFilePath);
        }

        // Assuming the email configuration is properly set up elsewhere in your code
        $this->email->send();
            // redirect(base_url('konfrim_akun'));
    }
}
