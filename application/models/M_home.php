<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_home extends CI_Model
{

    function data_event_ready()
    {
        $this->db->select('combined_query.*');
        $this->db->from('(SELECT event.*, wilayah_kabupaten.*, MIN(price.harga) as min_price
                        FROM event
                        JOIN wilayah_kabupaten ON wilayah_kabupaten.id = event.kota
                        JOIN price ON price.id_event = event.id_event
                        WHERE price.stock_tiket >= (price.beli + price.gratis + price.tiket_bundling)
                        GROUP BY event.id_event
                        UNION
                        SELECT event.*, wilayah_kabupaten.*, MIN(price.harga) as min_price
                        FROM event
                        JOIN wilayah_kabupaten ON wilayah_kabupaten.id = event.kota
                        JOIN price ON price.id_event = event.id_event
                        GROUP BY event.id_event
                        ) AS combined_query');
        $this->db->group_by('combined_query.id_event');
        $this->db->order_by('combined_query.tgl_event', 'DESC');
        $this->db->limit(6);

        $query = $this->db->get();

        return $query->result();

        // Process $result as needed

    }


    function data_banner()
    {
        $this->db->select('*');
        $this->db->from('banner');
        $this->db->order_by('id_banner', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }
}
