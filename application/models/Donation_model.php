<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donation_model extends CI_Model
{
    public function get_donationlist()
    {
        $sql = "SELECT 
                    d.d_no,
                    d.date,
                    d.donate_to,
                    d.remarks,
                    d.post,
                    u.name,
                    COALESCE(SUM(dl.qty), 0) AS total_qty
                FROM donation d
                JOIN user u ON u.id = d.user_id
                LEFT JOIN donationline dl ON dl.d_no = d.d_no
                GROUP BY d.d_no, d.date, d.donate_to, d.remarks, d.post, u.name
                ORDER BY d.date DESC, d.d_no DESC";

        return $this->db->query($sql)->result();
    }

    public function get_donation($d_no)
    {
        $this->db->select('d.*, u.name');
        $this->db->from('donation d');
        $this->db->join('user u', 'u.id = d.user_id');
        $this->db->where('d.d_no', $d_no);

        return $this->db->get()->row();
    }

    public function get_donationline($d_no)
    {
        $this->db->select('dl.*, p.name AS productname');
        $this->db->from('donationline dl');
        $this->db->join('product p', 'p.p_no = dl.p_no');
        $this->db->where('dl.d_no', $d_no);
        $this->db->order_by('dl.dl_no', 'ASC');

        return $this->db->get()->result();
    }

    public function get_productlist()
    {
        $this->db->select('p_no, name, qty');
        $this->db->from('product');
        $this->db->order_by('name', 'ASC');

        return $this->db->get()->result();
    }

    public function insertdonation($header, $p_no, $qty)
    {
        $this->db->trans_start();

        $this->db->insert('donation', $header);
        $d_no = $this->db->insert_id();

        foreach ($p_no as $key => $product_no) {
            if (!empty($product_no) && !empty($qty[$key])) {
                $this->db->insert('donationline', array(
                    'd_no'    => $d_no,
                    'p_no'    => $product_no,
                    'qty'     => $qty[$key],
                    'user_id' => $header['user_id']
                ));
            }
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function updatedonation($d_no, $header, $p_no, $qty)
    {
        $this->db->trans_start();

        $this->db->where('d_no', $d_no);
        $donation = $this->db->get('donation')->row();

        if (!$donation || $donation->post == 'YES') {
            $this->db->trans_complete();
            return false;
        }

        $this->db->where('d_no', $d_no);
        $this->db->update('donation', $header);

        $this->db->where('d_no', $d_no);
        $this->db->delete('donationline');

        foreach ($p_no as $key => $product_no) {
            if (!empty($product_no) && !empty($qty[$key])) {
                $this->db->insert('donationline', array(
                    'd_no'    => $d_no,
                    'p_no'    => $product_no,
                    'qty'     => $qty[$key],
                    'user_id' => $header['user_id']
                ));
            }
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function deletedonation($d_no)
    {
        $this->db->where('d_no', $d_no);
        $donation = $this->db->get('donation')->row();

        if (!$donation || $donation->post == 'YES') {
            return false;
        }

        $this->db->trans_start();

        $this->db->where('d_no', $d_no);
        $this->db->delete('donationline');

        $this->db->where('d_no', $d_no);
        $this->db->delete('donation');

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function postdonation($d_no)
    {
        $user_id = $this->session->userdata('id');

        $this->db->trans_start();

        // Get donation header
        $this->db->where('d_no', $d_no);
        $donation = $this->db->get('donation')->row();

        if (!$donation || $donation->post == 'YES') {
            $this->db->trans_complete();
            return false;
        }

        // Get donation lines
        $this->db->where('d_no', $d_no);
        $lines = $this->db->get('donationline')->result();

        if (empty($lines)) {
            $this->db->trans_complete();
            return false;
        }

        foreach ($lines as $line) {

            // Get current product qty
            $this->db->select('qty');
            $this->db->from('product');
            $this->db->where('p_no', $line->p_no);
            $product = $this->db->get()->row();

            if (!$product) {
                $this->db->trans_complete();
                return false;
            }

            // Allow negative balance
            $current_qty = $product->qty;
            $new_balance = $current_qty - $line->qty;

            // Insert product history
            $this->db->insert('product_history', array(
                'date'         => $donation->date,
                'ref_no'       => $d_no,
                'description'  => 'DONATION',
                'inqty'        => 0,
                'outqty'       => $line->qty,
                'bal'          => $new_balance,
                'product_p_no' => $line->p_no,
                'user_id'      => $user_id
            ));

            // Update product qty, even if result becomes negative
            $this->db->where('p_no', $line->p_no);
            $this->db->set('qty', 'qty - ' . (float)$line->qty, FALSE);
            $this->db->update('product');
        }

        // Mark donation as posted
        $this->db->where('d_no', $d_no);
        $this->db->update('donation', array(
            'post' => 'YES'
        ));

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}