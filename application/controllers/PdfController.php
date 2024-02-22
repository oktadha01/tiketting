<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PdfController extends CI_Controller
{
    public $M_pdf;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Tcpdf');
        // $this->load->library('phpqrcode');
        $this->load->model('M_pdf');
    }

    public function index()
    {

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
        $img_file = FCPATH . 'upload/e-tiket.jpg';
        $pdf->Image($img_file, null, 0, 148, 105, '', '', '', false, 300, 'C', false, false, 0);
        // restore auto-page-break status
        $pdf->setAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $pdf->setPageMark();
        // Add background color

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

        $headerText = 'Oktadha Nurdiansyah';
        $headerText = strtoupper($headerText); // Convert the header text to uppercase
        $jumlah = "1";
        $nama = implode(" ", array_slice(explode(" ", $headerText), 0, $jumlah));
        $pdf->SetY(35); // Set the Y position for the header text
        $pdf->SetX(15); // Set the Y position for the header text
        $pdf->setFontSpacing(2);
        $pdf->setFont('dejavusans', 'B', 25);
        $pdf->SetFillColor(59, 78, 135);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(50, 1, $nama, 0, 1, 'L'); // Print the header text

        $pdf->Image(base_url('assets/images/LOGO-WISDIL.png'), 16, 10, 15);

        $headerText = 'Oktadha01@gmail.coom';
        // $headerText = strtoupper($headerText); // Convert the header text to uppercase
        $pdf->SetY(46); // Set the Y position for the header text
        $pdf->SetX(16); // Set the Y position for the header text
        $pdf->setFontSpacing(1);
        $pdf->setFont('dejavusans', '', 7);
        $pdf->SetFillColor(59, 78, 135);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(50, 1, $headerText, 0, 1, 'L'); // Print the header text
        

        $headerText = 'VIP 01';
        $headerText = strtoupper($headerText); // Convert the header text to uppercase
        $pdf->SetY(50); // Set the Y position for the header text
        $pdf->SetX(16); // Set the Y position for the header text
        $pdf->setFontSpacing(2);
        $pdf->setFont('dejavusans', '', 20);
        $pdf->SetFillColor(59, 78, 135);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(50, 1, $headerText, 0, 1, 'L'); // Print the header text

        $pdf->Image(base_url('upload/qr/qr-CT-53520202-0001.png'), 101, 37, 28);

        $headerText = 'Kode Booking';
        $headerText = strtoupper($headerText); // Convert the header text to uppercase
        $pdf->SetY(66); // Set the Y position for the header text
        $pdf->SetX(80); // Set the Y position for the header text
        $pdf->setFontSpacing(0);
        $pdf->setFont('dejavusans', '', 5);
        $pdf->SetFillColor(59, 78, 135);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(50, 1, $headerText, 0, 1, 'R'); // Print the header text

        $headerText = 'CT-1111122823';
        $headerText = strtoupper($headerText); // Convert the header text to uppercase
        $pdf->SetY(68); // Set the Y position for the header text
        $pdf->SetX(80); // Set the Y position for the header text
        $pdf->setFontSpacing(0);
        $pdf->setFont('dejavusans', '', 10);
        $pdf->SetFillColor(59, 78, 135);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(50, 1, $headerText, 0, 1, 'R'); // Print the header text


        // ---------------------------------------------------------

        //Close and output PDF document
        $pdf->Output('example_051.pdf', 'I');
        //============================================================+
        // END OF FILE
        //============================================================+

        // require_once(dirname(__FILE__) . '/../libraries/phpqrcode/qrlib.php');
        // $tempDir = './upload/';
        // $codeContents = 'https://temurespondenkpwbijateng.com/kehadiran.php';
        // QRcode::png($codeContents, $tempDir.'qrcode.png', QR_ECLEVEL_L, 5);
        // $html = $this->load->view('client/pdf/pdf', [], true);

        // $pdf = new TCPDF();
        // $pdf->SetPrintHeader(false);
        // $pdf->SetPrintFooter(false);
        // $pdf->AddPage();
        // $pdf->writeHTML($html, true, false, true, false, '');

        // $pdfFilePath = FCPATH . 'upload' . '/output.pdf';
        // $pdf->Output($pdfFilePath, 'F');

        // $this->M_pdf->saveToDatabase($pdfFilePath);

        // echo 'PDF generated and saved to the database.';
    }
}