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
        try {
            $rawRequest          = file_get_contents("php://input");
            $request             = json_decode($rawRequest, true);

            $_id                 = $request['id'];
            $_externalId         = $request['external_id'];
            $_userId             = $request['user_id'];
            $_status             = $request['status'];
            $_paidAmount         = $request['paid_amount'];
            $_paidAt             = $request['paid_at'];
            $_paymentChannel     = $request['payment_channel'];
            $_paymentDestination = $request['payment_destination'];

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

            $code_bayar = $_externalId;
            redirect(base_url('Transaction/CB/') . $code_bayar);

            } else if ($_status == 'EXPIRED') {

                $this->db->where('code_bayar', $_externalId)->delete('tiket');
                $this->db->where('code_bayar', $_externalId)->delete('transaksi');

                // Hapus file PDF
                $pdfFileName = 'pdf-' . $_externalId . '.pdf';
                $pdfFilePath = FCPATH . 'upload/pdf/' . $pdfFileName;
                if (file_exists($pdfFilePath)) {
                    unlink($pdfFilePath);
                }

                // Hapus file QR
                $qrFileName = 'pdf-' . $_externalId . '.png';
                $qrFilePath = FCPATH . 'upload/qr/' . $qrFileName;
                if (file_exists($qrFilePath)) {
                    unlink($qrFilePath);
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

    function callback_FVA() {
        xendit_loaded();
        $this->db->trans_begin();
        $xenditXCallbackToken = 'xIgnYLs9PRcUYjZzYJc1EZUP5Aj3W7dTrCH6AHJOBJ67g7Zl';

        try {
            $rawRequest          = file_get_contents("php://input");
            $request             = json_decode($rawRequest, true);

            $_id                 = $request['id'];
            $_externalId         = $request['external_id'];
            $_status             = $request['status'] ?? 'default_fva_value';
            $_code               = $request['merchant_code'];

            if ($_status == 'COMPLETED') {
                $status = 'LUNAS';

                $this->db->set('status_transaksi', $status)
                    ->set('tes_status', $_code)
                    ->where('code_bayar', $_externalId)
                    ->where('status_transaksi', 'PENDING')
                    ->update('transaksi');

                $transfer_exists   = $this->db->get_where('transaksi', [
                    'code_bayar' => $_externalId
                ])->num_rows();

            } else if ($_status == 'EXPIRED') {
                $status = 'Expired';
                $this->db->where('code_bayar', $_externalId)->delete('tiket');
            }
                $this->db->trans_commit();

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

    function callback_ewallet()
    {
        $rawRequestInput = file_get_contents("php://input");
        $arrRequestInput = json_decode($rawRequestInput, true);
        print_r($arrRequestInput);
    }

}