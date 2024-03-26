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

    public function get_warna($id_event) {
        $this->db->select('id_event, color_nama, color_email, color_kategori, color_code_tiket');
        $this->db->where('id_event', $id_event);
        return $this->db->get('custom_tiket')->row_array();
    }
}