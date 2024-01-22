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

    var $template = 'tmpt_client/index';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('tcpdf');
        $this->load->model('M_buynow');
        $this->load->model('M_detail');
        $this->load->model('M_pdf');
    }
    function checkout()
    {
        $this->db->select("RIGHT(tiket.code_tiket, 4) as kode", FALSE);
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
        $email = $_POST['email']; // Ambil data email dan masukkan ke variabel email
        $id_price = $_POST['id_price']; // Ambil data nama dan masukkan ke variabel nama
        $id_event = $_POST['id_event'];
        $nama = $_POST['nama']; // Ambil data nama dan masukkan ke variabel nama
        $tgl_lahir = $_POST['tgl_lahir']; // Ambil data tgl_lahir dan masukkan ke variabel tgl_lahir
        $gender = $_POST['gender']; // Ambil data gender dan masukkan ke variabel gender
        $kontak = $_POST['kontak']; // Ambil data gender dan masukkan ke variabel gender
        $no_identitas = $_POST['no_identitas']; // Ambil data gender dan masukkan ke variabel gender
        $kota = $_POST['kota']; // Ambil data gender dan masukkan ke variabel gender
        $code = $_POST['code']; // Ambil data gender dan masukkan ke variabel gender
        $payment = $_POST['payment']; // Ambil data gender dan masukkan ke variabel gender
        // edit okta
        $status = $_POST['status'];
        // end edit
        $data_in = array();
        // edit okta
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
                    // $action = 'cetak';
                    if ($rows->status_bundling == '1') {
                        $count = '1';
                    } else {
                        $count = $rows->stock_tiket;
                    }
                    $data_kategori .= "$id_price, ";
                    $data_count .= "$count, ";
                }
                echo 'cek_stock_ready';
                echo "id: $id_price, Count: $count stock: $stock_tiket<br>";
            }
        }
        if ($action == 'cetak') {
            $this->M_buynow->save_tiket($data_in);
            $this->cetak_e_tiket($data_in);
            $this->insert_transaksi($data_in, $payment);
            $this->update_stock_tiket($tiketCounts);
        } else {
            $this->callback_stock_ready($data_kategori, $data_count, $data_kategori_sold, $data_count_sold, $nm_event);
        }
    }

    function callback_stock_ready($data_kategori, $data_count, $data_kategori_sold, $data_count_sold, $nm_event)
    {
        $data_kategori = $data_kategori;
        $data_count = $data_count;
        echo $data_kategori;
        echo $data_count;
        $email = $this->input->cookie('session');
        $nm_event = preg_replace("![^a-z0-9]+!i", " ", $nm_event);
        $data['event']        = $this->M_detail->m_event($nm_event);
        $data['customer']        = $this->M_detail->m_customer($email);
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
                $stock_tiket = $rows->stock_tiket - $count;
                // if($stock_tiket < 0){
                //     $stock_tiket = $rows->stock_tiket
                // }
                $this->M_buynow->update_stok_tiket($id_price, $stock_tiket);
            }
            echo "id_price: $id_price, Count: $count <br>";
        }
    }
    function cetak_e_tiket($data_in)
    {
        $no = '1';
        $jmlh = '0';
        foreach ($data_in as $item) {

            // Access individual elements of $item using their keys
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


            // get the current page break margin
            $bMargin = $pdf->getBreakMargin();
            // get current auto-page-break mode
            $auto_page_break = $pdf->getAutoPageBreak();
            // disable auto-page-break
            $pdf->setAutoPageBreak(false, 0);
            // set bacground image
            $img_file = base_url('upload/TIKET.PNG');
            $pdf->Image($img_file, null, 0, 148, 105, '', '', '', false, 300, 'C', false, false, 0);
            // restore auto-page-break status
            $pdf->setAutoPageBreak($auto_page_break, $bMargin);
            // set the starting point for the page content
            $pdf->setPageMark();
            // Add background color
            $pdf->Rect(0, 0, $pdf->GetPageWidth(), 6, 'F'); // Adjust the height (10 in this example) as needed

            // Add header text
            $pdf->SetY(1); // Set the Y position for the header text
            $headerText = 'WWW.Musickanpa.com';
            $headerText = strtoupper($headerText); // Convert the header text to uppercase
            $pdf->setFont('dejavusans', '', 6); // Set font for the header text
            $pdf->setFontSpacing(2);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor('Black');
            $pdf->Rect(0, 0, $pdf->GetPageWidth(), 4, 'F'); // Adjust the height (10 in this example) as needed
            $pdf->Cell(0, 0, $headerText, 0, 0, 'C', true); // Print the header text
            // Print a text
            $pdf->setFont('times', '', 18);
            $pdf->Cell(10, 7, '', 0, 1);
            $pdf->Cell(10, 7, '', 0, 1);
            $pdf->Cell(10, 7, '', 0, 0);

            $textnama = $nama;
            $textnama = strtoupper($textnama); // Convert the header text to uppercase
            $jumlah = "1";
            $nama = implode(" ", array_slice(explode(" ", $textnama), 0, $jumlah));
            $pdf->SetY(35); // Set the Y position for the header text
            $pdf->SetX(15); // Set the Y position for the header text
            $pdf->setFontSpacing(2);
            $pdf->setFont('dejavusans', 'B', 25);
            $pdf->SetFillColor(59, 78, 135);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(50, 1, $nama, 0, 1, 'L'); // Print the header text

            $textemail = $email;
            // $textemail = strtoupper($textemail); // Convert the header text to uppercase
            $pdf->SetY(46); // Set the Y position for the header text
            $pdf->SetX(16); // Set the Y position for the header text
            $pdf->setFontSpacing(1);
            $pdf->setFont('dejavusans', '', 7);
            $pdf->SetFillColor(59, 78, 135);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(50, 1, $textemail, 0, 1, 'L'); // Print the header text


            $textkategoritiket = $kategori_price;
            $textkategoritiket = strtoupper($textkategoritiket); // Convert the header text to uppercase
            $pdf->SetY(50); // Set the Y position for the header text
            $pdf->SetX(16); // Set the Y position for the header text
            $pdf->setFontSpacing(2);
            $pdf->setFont('dejavusans', '', 20);
            $pdf->SetFillColor(59, 78, 135);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(50, 1, $textkategoritiket, 0, 1, 'L'); // Print the header text

            $pdf->Image(base_url('upload/qr/qr-' . $code_tiket . '.png'), 101, 37, 28);

            $headerText = 'Kode Tiket';
            $headerText = strtoupper($headerText); // Convert the header text to uppercase
            $pdf->SetY(66); // Set the Y position for the header text
            $pdf->SetX(80); // Set the Y position for the header text
            $pdf->setFontSpacing(0);
            $pdf->setFont('dejavusans', '', 5);
            $pdf->SetFillColor(59, 78, 135);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(50, 1, $headerText, 0, 1, 'R'); // Print the header text

            $textcodetiket = $code_tiket;
            $textcodetiket = strtoupper($textcodetiket); // Convert the header text to uppercase
            $pdf->SetY(68); // Set the Y position for the header text
            $pdf->SetX(80); // Set the Y position for the header text
            $pdf->setFontSpacing(0);
            $pdf->setFont('dejavusans', '', 10);
            $pdf->SetFillColor(59, 78, 135);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(50, 1, $textcodetiket, 0, 1, 'R'); // Print the header text

            $pdfFilePath = FCPATH . 'upload/pdf' . '/pdf-' . $code_tiket . '.pdf';
            $pdf->Output($pdfFilePath, 'F');

            // edit okta
            echo 'PDF generated and saved to the database.';

            echo "id: $id,<br>Email: $email,<br> ID Customer: $status,<br> Name: $nama || $code_tiket, etc.";
            echo '<br><br>';
            // Increment the count for the id$id_price


            //    end edit

        }
        // } else {


        // }


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

                // echo "id: $id,<br>Email: $email,<br> ID Customer: $id_customer,<br> Name: $nama || $code_bayar, etc.";
                // echo '<br><br>';

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

        xendit_loaded();
        $this->db->trans_begin();

        try {

            // code xendit
            $data_faktur = [
                "external_id"       => $code_bayar,
                "description"       => "Pembayaran Tiket Wisdil $code_bayar $nama",
                "amount"            => preg_replace('/[Rp. ]/', '', $nominal),
                'invoice_duration'  => 3600,
                'customer' => [
                    'given_names'   => $nama,
                    'surname'       => $code_bayar,
                    'mobile_number' => $code_tiket,
                    'mobile_number' => $kontak,
                ],
            ];

            $tgl_trx = date('d-m-Y H:i:s');
            $createInvoice  = Invoice::create($data_faktur);
            $payment_url    = $createInvoice['invoice_url'];

            $data_transaksi = [

                'id_customer'       => $id_customer,
                'id_event'          => $id_event,
                'code_bayar'        => $code_bayar,
                'jumlah_tiket'      => $jmlh,
                'nominal'           => preg_replace('/[Rp. ]/', '', $nominal),
                'tgl_transaksi'     => $tgl_trx,
                'url_payment'       => $payment_url,

            ];
            $this->M_buynow->insert_transaksi($data_transaksi);
            $this->db->trans_commit();

            redirect($payment_url);
            // Redirect(base_url('Transaction/CB/') . $code_bayar);


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


// code tiket
// id_event-id_customer-id_price-tgl-code
// 1           1           1           3
// id_event-id_customer-id_price-tgl-code
// 1           1           1           2

// code bayar
// id_event-bulan_tgl_tahun-id_customer
// 1         10-10-2023           1

// date('l, d-m-Y')
// <img src="<?= base_url('upload/qr/');