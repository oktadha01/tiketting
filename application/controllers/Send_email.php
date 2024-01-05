<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Send_email extends CI_Controller
{
    public $email;
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('tcpdf');
        // $this->load->model('M_pdf');
    }
    function index()
    {

        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'Oktadha01@gmail.com',  // Email gmail
            'smtp_pass'   => 'rvcw cvny ibav czbh',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];
        // $email_to_user = $this->session->userdata('gmail');
        $email_to_user = 'baronlivingstudio@gmail.com';
        $this->load->library('email', $config);
        $this->email->from('kinderton.idofficial@gmail.com', 'Kinderton');
        $this->email->to($email_to_user);
        $this->email->subject('Aktivasi Akun Kinderton');
        $data_email = array(
            'id_user'  => 'id_user',
            'nm_user'  => 'nm_user',
            'gmail' => 'gmail',
            'kontak' => 'kontak',
        );

        $body = $this->load->view('client/email/email_template.php', $data_email, TRUE);
        $this->email->message($body);
        // Array to store dynamic PDF file paths
        $pdfFilepaths = array(
            base_url('upload/pdf') . '/pdf-CT-1111122823.pdf',
            base_url('upload/pdf') . '/pdf-CT-1121122823.pdf',
            // Add more file paths dynamically as needed
        );

        // Loop through the array and attach PDF files
        foreach ($pdfFilepaths as $pdfFilePath) {
            $this->email->attach($pdfFilePath);
        }

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
            echo 'true.';
            // redirect(base_url('konfrim_akun'));
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }
    }
}
