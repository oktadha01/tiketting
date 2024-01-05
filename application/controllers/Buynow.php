<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Buynow extends CI_Controller
{
    public $M_buynow;
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
        $this->load->model('M_pdf');
    }
    function checkout()
    {
        $this->db->select("RIGHT(tiket.code_tiket, 4) as kode", FALSE);
        $this->db->order_by('code_tiket', 'DESC');
        $this->db->limit(1);

        $query_ = $this->db->get('tiket');
        // $kode_max_ = [];
        if ($query_->num_rows() <> 0) {
            $data_ = $query_->row();
            // for ($i = 1; $i < 2; $i++) {
            $kode_ = intval($data_->kode) + 1;
            $kode_max_     = str_pad($kode_, 4, "0", STR_PAD_LEFT);
            // echo $kode_max_;
            // }
        } else {
            $kode_ = 1;
            // for ($i = 1; $i < 2; $i++) {
            $kode_max_     = str_pad($kode_, 4, "0", STR_PAD_LEFT);
            // echo $kode_max_;

            // }
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

        // $kode_max = $_POST[$kode_max_];
        // $start_value = 1; // or any other starting value
        $data = array();

        $index = 0; // Set index array awal dengan 0
        foreach ($email as $dataemail) { // Kita buat perulangan berdasarkan email sampai data terakhir
            array_push($data, array(
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
                'code_bayar' => 'CB-' . $id_event . date('md') . $customer . '-' . $kode_max_,  // Ambil dan set data alamat sesuai index array dari $index
                'kota' => $kota[$index],  // Ambil dan set data alamat sesuai index array dari $index
                'code_tiket' => 'CT-' . $id_event . $id_price[$index] . date('md') . '-' . sprintf('%04d', $kode_max_++),  // Ambil dan set data alamat sesuai index array dari $index
            ));
            // var_dump($data);
            $index++;
        }
        $this->M_buynow->save_tiket($data);

        $no = '1';
        $jmlh = '0';
        $nominal = '0';
        foreach ($data as $item) {
            // Access individual elements of $item using their keys
            $id = $no++;
            $jmlh++;
            $email = $item['email'];
            $id_customer = $item['id_customer'];
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
            if ($id == '1') {
                $this->M_buynow->update_customer($id_customer, $email, $nama, $tgl_lahir, $gender, $kontak, $no_identitas, $kota);
            } else {
            }

            $tiket = "(SELECT * FROM price WHERE id_price = $id_price)";
            $query = $this->db->query($tiket);
            foreach ($query->result() as $rows) {
                $nominal = $rows->harga + $nominal;
                $kategori_price = $rows->kategori_price;
            };

            require_once(dirname(__FILE__) . '/../libraries/phpqrcode/qrlib.php');
            $tempDir = './upload/qr/';
            $codeContents = $code_tiket;
            QRcode::png($codeContents, $tempDir . 'qr-' . $code_tiket . '.png', QR_ECLEVEL_L, 5);

            // echo '<img src="' . base_url("upload/qr/") . $code . '.png" alt="">';
            // $html = $this->load->view('client/pdf/pdf', $code, true);

            // $pdf = new TCPDF();
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

            // $this->M_pdf->saveToDatabase($pdfFilePath);

            echo 'PDF generated and saved to the database.';

            echo "id: $id,<br>Email: $email,<br> ID Customer: $id_customer,<br> Name: $nama || $code_bayar, etc.";
            echo '<br><br>';
        }
        $currentDateTime = date('m-d-Y H:i:s');
        $newDateTime = date('m-d-Y H:i:s', strtotime($currentDateTime . ' +1 hours'));

        
        $data_transaksi = [
            'id_customer' => $id_customer,
            'code_bayar' => $code_bayar,
            'jumlah_tiket' => $jmlh,
            'nominal' => $nominal,
            'jumlah_tiket' => $jmlh,
            'bank' => $payment,
            'tgl_transaksi' => $newDateTime,
        ];
        $this->M_buynow->insert_transaksi($data_transaksi);
        Redirect(base_url('Transaction/CB/') . $code_bayar);
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