<?php

function send_email()
{
    $CI = get_instance();
    $key = $CI->db->select('*')
        ->from('pengaturan')
        ->where('status', '1')
        ->where('name', 'XENDIT_KEY')
        ->get()->result();
    if (count($key) == 0) {
        return 0;
    }
    Xendit::setApiKey($key[0]->value);
}
