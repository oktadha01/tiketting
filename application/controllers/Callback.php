<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Carbon\Carbon;
use Xendit\Invoice;

class Callback extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function callback_invoice() {

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
            $_givenNames         = $request['surname'];

            $status = '0';
            if ($_status == 'PAID') {
                $status = '1';

                $date_convert = Carbon::parse($_paidAt);
                $datetime = $date_convert->format('Y-m-d H:i:s');

                $this->db->set('bank', $_paymentChannel)
                         ->set('tgl_byr', $datetime)
                         ->set('status_transaksi', $status)
                         ->where('code_bayar', $_externalId)
                         ->update('transaksi');

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

}