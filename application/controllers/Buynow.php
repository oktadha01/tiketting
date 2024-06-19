<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Carbon\Carbon;
use Xendit\Invoice;

class Buynow extends CI_Controller
{
    public $M_buynow;
    public $M_detail;
    public $db;
    public $uri;
    public $session;
    public $input;
    public $M_pdf;
    public $output;
    public $Event_model;

    var $template = 'tmpt_client/index';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Tcpdf');
        $this->load->model('M_buynow');
        $this->load->model('M_detail');
        $this->load->model('M_pdf');
        $this->load->model('Event_model');
    }
    function get_ajax_kab()
    {
        $query = $this->Event_model->get_kabupaten();
        $data = "<option value=''>- Pilih Kota -</option>";
        foreach ($query as $value) {
            $data .= "<option value='" . $value->id . "'>" . $value->nama . "</option>";
        }
        echo $data;
    }
    function checkout()
    {
        $this->db->select("MAX(CAST(RIGHT(tiket.code_tiket, 4) AS UNSIGNED)) as kode", FALSE);
        $this->db->order_by('code_tiket', 'DESC');
        $this->db->limit(1);

        $query_ = $this->db->get('tiket');
        if ($query_->num_rows() <> 0) {
            $data_ = $query_->row();
            $kode_ = intval($data_->kode) + 1;
            $kode_max_     = str_pad($kode_, 4, "0", STR_PAD_LEFT);
        } else {
            $kode_ = 1;
            $kode_max_     = str_pad($kode_, 4, "0", STR_PAD_LEFT);
        }


        $customer = $_POST['akun'];
        $email = $_POST['email'];
        $id_price = $_POST['id_price'];
        $id_event = $_POST['id_event'];
        $nama = $_POST['nama'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $gender = $_POST['gender'];
        $kontak = $_POST['kontak'];
        $no_identitas = $_POST['no_identitas'];
        $kota = $_POST['kota'];
        $code = $_POST['code'];
        $payment = isset($_POST['payment']) ? $_POST['payment'] : 'default_value';
        $status = $_POST['status'];
        $data_in = array();

        // var_dump($id_event);
        // exit;

        $index = 0; // Set index array awal dengan 0
        foreach ($email as $dataemail) { // Kita buat perulangan berdasarkan email sampai data terakhir
            $tiket = "(SELECT * FROM price WHERE id_price = '$id_price[$index]')";
            $query = $this->db->query($tiket);
            foreach ($query->result() as $rows) {
                if ($rows->status_bundling == '1') {

                    for ($i = 0; $i < $rows->tiket_bundling; $i++) {
                        array_push($data_in, array(
                            'email' => $dataemail,
                            'id_customer' => $customer,
                            'id_price' => $id_price[$index],  // Ambil dan set data nama sesuai index array dari $index
                            'id_event' => $id_event,
                            'nama' => $nama[$index],  // Ambil dan set data nama sesuai index array dari $index
                            'tgl_lahir' => $tgl_lahir[$index],  // Ambil dan set data telepon sesuai index array dari $index
                            'gender' => $gender[$index],  // Ambil dan set data alamat sesuai index array dari $index
                            'kontak' => $kontak[$index],  // Ambil dan set data alamat sesuai index array dari $index
                            'no_identitas' => $no_identitas[$index],  // Ambil dan set data alamat sesuai index array dari $index
                            'kota' => $kota[$index],  // Ambil dan set data alamat sesuai index array dari $index
                            // edit okta
                            'code_bayar' => 'CB-' . $id_event . date('md') . $customer . '-' . str_pad($kode_, 4, "0", STR_PAD_LEFT),  // Ambil dan set data alamat sesuai index array dari $index
                            // and edit
                            'kota' => $kota[$index],  // Ambil dan set data alamat sesuai index array dari $index
                            'code_tiket' => 'CT-' . $id_event . $id_price[$index] . date('md') . '-' . sprintf('%04d', $kode_max_++),  // Ambil dan set data alamat sesuai index array dari $index
                            // edit okta
                            'status' => 'bundling',
                            // end edit
                        ));
                    }
                } else {
                    array_push($data_in, array(
                        'email' => $dataemail,
                        'id_customer' => $customer,
                        'id_price' => $id_price[$index],  // Ambil dan set data nama sesuai index array dari $index
                        'id_event' => $id_event,
                        'nama' => $nama[$index],  // Ambil dan set data nama sesuai index array dari $index
                        'tgl_lahir' => $tgl_lahir[$index],  // Ambil dan set data telepon sesuai index array dari $index
                        'gender' => $gender[$index],  // Ambil dan set data alamat sesuai index array dari $index
                        'kontak' => $kontak[$index],  // Ambil dan set data alamat sesuai index array dari $index
                        'no_identitas' => $no_identitas[$index],  // Ambil dan set data alamat sesuai index array dari $index
                        'kota' => $kota[$index],  // Ambil dan set data alamat sesuai index array dari $index
                        // edit okta
                        'code_bayar' => 'CB-' . $id_event . date('md') . $customer . '-' . str_pad($kode_, 4, "0", STR_PAD_LEFT),  // Ambil dan set data alamat sesuai index array dari $index
                        // and edit
                        'kota' => $kota[$index],  // Ambil dan set data alamat sesuai index array dari $index
                        'code_tiket' => 'CT-' . $id_event . $id_price[$index] . date('md') . '-' . sprintf('%04d', $kode_max_++),  // Ambil dan set data alamat sesuai index array dari $index
                        // edit okta
                        'status' => $status[$index],
                        // end edit
                    ));
                }
            };
            // var_dump($data);
            $index++;
        };
        $this->cek_stock_ready($data_in, $payment);
    }

    function cek_stock_ready($data_in, $payment)
    {
        $tiketCounts = array();

        foreach ($data_in as $item) {
            $id_price = $item['id_price'];

            if (isset($tiketCounts[$id_price])) {
                $tiketCounts[$id_price]++;
            } else {
                $tiketCounts[$id_price] = 1;
            }
            // edit okta

        }
        $action = 'cetak';
        $action1 = 'close';
        $data_kategori = "";
        $data_count = "";
        $data_kategori_sold = "";
        $data_count_sold = "";
        foreach ($tiketCounts as $id_price => $count) {
            $tiket = "(SELECT event.nm_event,  price.stock_tiket, price.status_bundling, price.beli, price.gratis, price.id_price FROM event,price WHERE price.id_price = $id_price AND event.id_event = price.id_event)";
            $query = $this->db->query($tiket);
            foreach ($query->result() as $rows) {
                $nm_event = $rows->nm_event;
                $stock_tiket = $rows->stock_tiket - $count;
                if ($count > $rows->stock_tiket) {
                    $action = 'stop';
                    if ($rows->status_bundling == '1') {
                        $count = '0';
                    } else {
                        if ($rows->stock_tiket >= $rows->beli + $rows->gratis) {
                            $count = $rows->stock_tiket - $rows->gratis;
                            $action1 = 'open';
                        } else {
                            $count = '0';
                        }
                    }

                    $data_kategori_sold .= "$id_price, ";
                    $data_count_sold .= "$count, ";

                    $data_kategori .= "$id_price, ";
                    $data_count .= "$count, ";
                    // echo $action;
                } else {
                    $action1 = 'open';
                    if ($rows->status_bundling == '1') {
                        $count = '1';
                    } else {
                        $count = $count;
                    }
                    $data_kategori .= "$id_price, ";
                    $data_count .= "$count, ";
                }
            }
        }
        if ($action == 'cetak') {
            $this->M_buynow->save_tiket($data_in);
            $this->cetak_e_tiket($data_in);
            $this->update_stock_tiket($tiketCounts);
            $this->insert_transaksi($data_in, $payment);
        } else {
            $this->callback_stock_ready($data_kategori, $data_count, $data_kategori_sold, $data_count_sold, $nm_event, $action1);
        }
    }

    function callback_stock_ready($data_kategori, $data_count, $data_kategori_sold, $data_count_sold, $nm_event, $action1)
    {
        $data_kategori = $data_kategori;
        $data_count = $data_count;
        // echo $data_kategori;
        // echo '<br>';
        // echo $data_count;
        // echo '<br>';
        // echo $action1;
        $email = $this->input->cookie('session');
        $nm_event = preg_replace("![^a-z0-9]+!i", " ", $nm_event);
        $data['tittle']          = 'Checkout';
        $data['event']        = $this->M_detail->m_event($nm_event);
        $data['customer']        = $this->M_detail->m_customer($email);
        $data['action'] = $action1;
        $data['data_kategori'] = $data_kategori;
        $data['data_count'] = $data_count;
        $data['data_kategori_sold'] = $data_kategori_sold;
        $data['data_count_sold'] = $data_count_sold;
        $data['content']         = "client/buynow/buynow";
        $data['script']         = 'client/buynow/buynow_js';
        $this->load->view($this->template, $data);
    }

    function update_stock_tiket($tiketCounts)
    {
        foreach ($tiketCounts as $id_price => $count) {
            $tiket = "(SELECT * FROM price WHERE id_price = $id_price)";
            $query = $this->db->query($tiket);
            foreach ($query->result() as $rows) {
                $id_price = $rows->id_price;
                $stock_tiket = $rows->stock_tiket - $count;
                // if($stock_tiket == 0){
                //     $stock_tiket = $rows->stock_tiket;
                // }
                $this->M_buynow->update_stok_tiket($id_price, $stock_tiket);
            }
        }
    }

    function cetak_e_tiket($data_in)
    {
        $no = '1';
        $jmlh = '0';
        foreach ($data_in as $item) {

            $id = $no++;
            $jmlh++;
            $email = $item['email'];
            $id_customer = $item['id_customer'];
            // edit okta
            $id_event = $item['id_event'];
            // end edit
            $id_price = $item['id_price'];
            $code_bayar = $item['code_bayar'];
            $code_tiket = $item['code_tiket'];
            $code['code'] = $item['code_tiket'];
            $nama = $item['nama'];
            $tgl_lahir = $item['tgl_lahir'];
            $gender = $item['gender'];
            $kontak = $item['kontak'];
            $no_identitas = $item['no_identitas'];
            $kota = $item['kota'];
            // edit okta
            $status = $item['status'];
            // End edit
            $tiket = "(SELECT * FROM price WHERE id_price = $id_price)";
            $query = $this->db->query($tiket);
            foreach ($query->result() as $rows) {
                $kategori_price = $rows->kategori_price;
            };
            // end edit
            require_once(dirname(__FILE__) . '/../libraries/phpqrcode/qrlib.php');
            $tempDir = './upload/qr/';
            $codeContents = $code_tiket;
            QRcode::png($codeContents, $tempDir . 'qr-' . $code_tiket . '.png', QR_ECLEVEL_L, 5);
            // create new PDF document
            $pdf = new TCPDF('L', 'mm', 'A6');
            $pdf->AddPage();

            $warna = "(SELECT * FROM custom_tiket WHERE id_event = $id_event)";
            $query = $this->db->query($warna);
            foreach ($query->result() as $rows) {
                $nama_warna = $rows->color_nama;
                $email_warna = $rows->color_email;
                $kategori_warna = $rows->color_kategori;
                $code_warna = $rows->color_code_tiket;
                $background = $rows->background;

                // var_dump($background);
                // exit;



            $bMargin = $pdf->getBreakMargin();
            $auto_page_break = $pdf->getAutoPageBreak();
            $pdf->setAutoPageBreak(false, 0);
            $img_file = base_url('upload/backround_tiket/' . $background);
            $pdf->Image($img_file, null, 3, 148, 102, '', '', '', false, 300, 'C', false, false, 0);
            $pdf->setAutoPageBreak($auto_page_break, $bMargin);
            $pdf->setPageMark();
            $pdf->SetY(1);
            $headerText = 'WWW.WISDIL.COM';
            $headerText = strtoupper($headerText);
            $pdf->setFont('dejavusans', '', 6);
            $pdf->setFontSpacing(2);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor('Black');
            $pdf->Rect(0, 0, $pdf->GetPageWidth(), 4, 'F');
            $pdf->Cell(0, 0, $headerText, 0, 0, 'C', true);
            // Print a text
            $pdf->setFont('times', '', 18);
            $pdf->Cell(10, 7, '', 0, 1);
            $pdf->Cell(10, 7, '', 0, 1);
            $pdf->Cell(10, 7, '', 0, 0);

            $pdf->Image(base_url('assets/images/LOGO-WISDIL.png'), 16, 10, 15);

            $textnama = $nama;
            $textnama = strtoupper($textnama);
            $jumlah = "1";
            $nama = implode(" ", array_slice(explode(" ", $textnama), 0, $jumlah));
            $pdf->SetY(35);
            $pdf->SetX(15);
            $pdf->setFontSpacing(2);
            $pdf->setFont('dejavusans', 'B', 25);
            $pdf->SetFillColor(59, 78, 135);
            list($r, $g, $b) = sscanf($nama_warna, '#%02x%02x%02x');
            $pdf->SetTextColor($r, $g, $b);
            $pdf->Cell(50, 1, $nama, 0, 1, 'L');

            $textemail = $email;
            $pdf->SetY(46);
            $pdf->SetX(16);
            $pdf->setFontSpacing(1);
            $pdf->setFont('dejavusans', '', 7);
            $pdf->SetFillColor(59, 78, 135);
            list($r, $g, $b) = sscanf($email_warna, '#%02x%02x%02x');
            $pdf->SetTextColor($r, $g, $b);
            $pdf->Cell(50, 1, $textemail, 0, 1, 'L');


            $textkategoritiket = $kategori_price;
            $textkategoritiket = strtoupper($textkategoritiket);
            $pdf->SetY(50);
            $pdf->SetX(16);
            $pdf->setFontSpacing(2);
            $pdf->setFont('dejavusans', '', 20);
            $pdf->SetFillColor(59, 78, 135);
            list($r, $g, $b) = sscanf($kategori_warna, '#%02x%02x%02x');
            $pdf->SetTextColor($r, $g, $b);
            $pdf->Cell(50, 1, $textkategoritiket, 0, 1, 'L');

            $pdf->Image(base_url('upload/qr/qr-' . $code_tiket . '.png'), 101, 37, 28);

            $headerText = 'Kode Tiket';
            $headerText = strtoupper($headerText);
            $pdf->SetY(66);
            $pdf->SetX(80);
            $pdf->setFontSpacing(0);
            $pdf->setFont('dejavusans', '', 5);
            $pdf->SetFillColor(59, 78, 135);
            list($r, $g, $b) = sscanf($code_warna, '#%02x%02x%02x');
            $pdf->SetTextColor($r, $g, $b);
            $pdf->Cell(50, 1, $headerText, 0, 1, 'R');
            $textcodetiket = $code_tiket;
            $textcodetiket = strtoupper($textcodetiket);
            $pdf->SetY(68); // Set the Y position for the header text
            $pdf->SetX(80); // Set the Y position for the header text
            $pdf->setFontSpacing(0);
            $pdf->setFont('dejavusans', '', 10);
            $pdf->SetFillColor(59, 78, 135);
            list($r, $g, $b) = sscanf($code_warna, '#%02x%02x%02x');
            $pdf->SetTextColor($r, $g, $b);
            $pdf->Cell(50, 1, $textcodetiket, 0, 1, 'R'); // Print the header text

            $pdfFilePath = FCPATH . 'upload/pdf' . '/pdf-' . $code_tiket . '.pdf';
            $pdf->Output($pdfFilePath, 'F');
        };
        }
    }

    function insert_transaksi($data_in, $payment)
    {
        // Access individual elements of $item using their keys
        $no = '1';
        $jmlh = '0';
        $nominal = '0';
        // edit okta
        $counter = 0;
        // end edit
        foreach ($data_in as $item) {

            $id = $no++;
            $jmlh++;
            $email = $item['email'];
            $id_customer = $item['id_customer'];
            // edit okta
            $id_event = $item['id_event'];
            // end edit
            $id_price = $item['id_price'];
            $code_bayar = $item['code_bayar'];
            $code_tiket = $item['code_tiket'];
            $code['code'] = $item['code_tiket'];
            $nama = $item['nama'];
            $tgl_lahir = $item['tgl_lahir'];
            $gender = $item['gender'];
            $kontak = $item['kontak'];
            $no_identitas = $item['no_identitas'];
            $kota = $item['kota'];
            // edit okta
            $status = $item['status'];
            // End edit
            if ($id == '1') {
                $this->M_buynow->update_customer($id_customer, $email, $nama, $tgl_lahir, $gender, $kontak, $no_identitas, $kota);
            } else {
            };
            // edit okta
            if ($status == 'free') {
            } else if ($status == 'bundling') {
                $counter++;
                if ($counter == '1') {
                    $tiket = "(SELECT * FROM price WHERE id_price = $id_price)";
                    $query = $this->db->query($tiket);
                    foreach ($query->result() as $rows) {
                        $nominal = $rows->harga + $nominal;
                        $kategori_price = $rows->kategori_price;
                    };
                }
            } else {
                $tiket = "(SELECT * FROM price WHERE id_price = $id_price)";
                $query = $this->db->query($tiket);
                foreach ($query->result() as $rows) {
                    $nominal = $rows->harga + $nominal;
                    $kategori_price = $rows->kategori_price;
                };
            };
        }

        if ($nominal == '0') {
            $subtotal = '0';
            $tgl_trx = date('d-m-Y H:i:s');
            $data_transaksi = [

                'id_customer'       => $id_customer,
                'id_event'          => $id_event,
                'code_bayar'        => $code_bayar,
                'jumlah_tiket'      => $jmlh,
                'nominal'           => preg_replace('/[Rp. ]/', '', $subtotal),
                'tgl_transaksi'     => $tgl_trx,
                'tgl_byr'           => $tgl_trx,
                'url_payment'       => 'free',
                'status_transaksi'  => '1',

            ];

            $this->db->insert('saldo', [
                'code_bayar'   => $code_bayar,
                'tanggal'      => $tgl_trx,
                'nominal'      => $subtotal,
            ]);

            $this->M_buynow->insert_transaksi($data_transaksi);

        } else {
            $subtotal = $nominal * 0.03 + 7850 + $nominal;

            xendit_loaded();
            $this->db->trans_begin();

            try {

                // code xendit
                $successRedirectUrl = base_url('Transaction/CB/') . $code_bayar;

                $data_faktur = [
                    "external_id"       => $code_bayar,
                    "description"       => "Pembayaran Tiket Wisdil Kode Bayar: $code_bayar Kode Tiket: $code_tiket nama:$nama",
                    "amount"            => preg_replace('/[Rp. ]/', '', $subtotal),
                    'invoice_duration'  => 3600,
                    'customer' => [
                        'given_names'   => $nama,
                        'surname'       => $code_tiket,
                        'mobile_number' => $kontak,
                    ],

                    'success_redirect_url' => $successRedirectUrl,
                    'failure_redirect_url' => "http://localhost:8080/tiketting/Buynow/failure",
                ];


                $tgl_trx = date('d-m-Y H:i:s');
                $createInvoice  = Invoice::create($data_faktur);
                $payment_url    = $createInvoice['invoice_url'];

                $data_transaksi = [

                    'id_customer'       => $id_customer,
                    'id_event'          => $id_event,
                    'code_bayar'        => $code_bayar,
                    'jumlah_tiket'      => $jmlh,
                    'nominal'          => preg_replace('/[Rp. ]/', '', $subtotal),
                    'tgl_transaksi'     => $tgl_trx,
                    'url_payment'       => $payment_url,

                ];

                $this->M_buynow->insert_transaksi($data_transaksi);
                $this->db->trans_commit();

                $response = [
                    'status' => true,
                    'message' => 'Success',
                    'data' => [
                        'payment_url' => $payment_url,
                    ],
                ];

                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));

                redirect($payment_url);
            } catch (\Xendit\Exceptions\ApiException $e) {
                $this->db->trans_rollback();

                $response = [
                    'status'       => false,
                    'errors'       => [
                        'message'  => $e->getMessage(),
                        'type'     => 'xendit',
                    ],
                    'detail'       => [],
                ];

                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
            } catch (Exception $e) {
                $this->db->trans_rollback();
                $response = [
                    'status' => false,
                    'errors' => [
                        'message' => $e->getMessage(),
                        'type' => 'input',
                    ],
                    'detail' => [],
                ];
            }
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

    public function failure()
    {
        echo "Pembayaran Gagal";

        echo '<script>
        setTimeout(function(){
                    window.location.href = "' . base_url('detail/event/kanpa-fest') . '";
                }, 3000);
            </script>';
    }
}