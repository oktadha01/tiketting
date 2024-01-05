<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pdf extends CI_Model {

    public function saveToDatabase($pdfFilePath) {
        $pdfData = file_get_contents($pdfFilePath);

        $data = array(
            'pdf_data' => $pdfData,
        );

        $this->db->insert('pdf_table', $data);
    }
}