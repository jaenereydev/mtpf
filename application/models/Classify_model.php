<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classify_model extends CI_Model
{
    public function get_classifylist()
    {
        $sql = "SELECT 
                    c.c_no,
                    c.date,
                    c.post,
                    u.name,
                    COALESCE(SUM(cl.qty), 0) AS total_qty
                FROM classify c
                JOIN user u ON u.id = c.user_id
                LEFT JOIN classifyline cl ON cl.c_no = c.c_no
                GROUP BY c.c_no, c.date, c.post, u.name
                ORDER BY c.date DESC, c.c_no DESC";

        $query = $this->db->query($sql);
        return $query->result();
    }

    //--------------------------------------------------------------------------

    public function insertclassify($header, $p_no, $qty)
    {
        $this->db->trans_start();

        $this->db->insert('classify', $header);
        $c_no = $this->db->insert_id();

        foreach ($p_no as $key => $product_no) {
            if (!empty($product_no) && !empty($qty[$key])) {
                $line = array(
                    'c_no'    => $c_no,
                    'p_no'    => $product_no,
                    'user_id' => $header['user_id'],
                    'qty'     => $qty[$key]
                );

                $this->db->insert('classifyline', $line);
            }
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    //--------------------------------------------------------------------------

    public function deleteclassify($c_no)
    {
        // Check classify header first
        $this->db->where('c_no', $c_no);
        $classify = $this->db->get('classify')->row();

        if (!$classify) {
            return false;
        }

        // Do not delete posted records
        if ($classify->post == 'YES') {
            return false;
        }

        $this->db->trans_start();

        // Delete classify lines first
        $this->db->where('c_no', $c_no);
        $this->db->delete('classifyline');

        // Delete classify header
        $this->db->where('c_no', $c_no);
        $this->db->delete('classify');

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    //--------------------------------------------------------------------------

    public function get_classify($c_no)
    {
        $this->db->select('c.*, u.name');
        $this->db->from('classify c');
        $this->db->join('user u', 'u.id = c.user_id');
        $this->db->where('c.c_no', $c_no);

        return $this->db->get()->row();
    }

    //--------------------------------------------------------------------------

    public function get_classifyline($c_no)
    {
        $this->db->select('cl.*, p.name AS productname');
        $this->db->from('classifyline cl');
        $this->db->join('product p', 'p.p_no = cl.p_no');
        $this->db->where('cl.c_no', $c_no);
        $this->db->order_by('cl.cl_no', 'ASC');

        return $this->db->get()->result();
    }

    //--------------------------------------------------------------------------

    public function get_productlist()
    {
        $this->db->select('p_no, name');
        $this->db->from('product');
        $this->db->order_by('name', 'ASC');

        return $this->db->get()->result();
    }

    //--------------------------------------------------------------------------

    public function postclassify($c_no)
    {
        $user_id = $this->session->userdata('id');

        $this->db->trans_start();

        // Get classify header
        $this->db->where('c_no', $c_no);
        $classify = $this->db->get('classify')->row();

        if (!$classify || $classify->post == 'YES') {
            $this->db->trans_complete();
            return false;
        }

        // Get classify lines
        $this->db->where('c_no', $c_no);
        $lines = $this->db->get('classifyline')->result();

        if (empty($lines)) {
            $this->db->trans_complete();
            return false;
        }

        foreach ($lines as $line) {

            // Get current product quantity
            $this->db->select('qty');
            $this->db->from('product');
            $this->db->where('p_no', $line->p_no);
            $product = $this->db->get()->row();

            $current_qty = $product ? $product->qty : 0;
            $new_balance = $current_qty + $line->qty;

            // Insert product history
            $this->db->insert('product_history', array(
                'date'         => $classify->date,
                'ref_no'       => $c_no,
                'description'  => 'CLASSIFY',
                'inqty'        => $line->qty,
                'bal'          => $new_balance,
                'product_p_no' => $line->p_no,
                'user_id'      => $user_id
            ));

            // Update product qty
            $this->db->where('p_no', $line->p_no);
            $this->db->set('qty', 'qty + ' . (float)$line->qty, FALSE);
            $this->db->update('product');
        }

        // Mark classify as posted
        $this->db->where('c_no', $c_no);
        $this->db->update('classify', array(
            'post' => 'YES'
        ));

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    //--------------------------------------------------------------------------

    public function updateclassify($c_no, $header, $cl_no, $p_no, $qty)
    {
        $this->db->trans_start();

        // Check if posted
        $this->db->where('c_no', $c_no);
        $classify = $this->db->get('classify')->row();

        if (!$classify || $classify->post == 'YES') {
            $this->db->trans_complete();
            return false;
        }

        // Update classify header
        $this->db->where('c_no', $c_no);
        $this->db->update('classify', $header);

        // Delete old lines
        $this->db->where('c_no', $c_no);
        $this->db->delete('classifyline');

        // Insert new lines
        foreach ($p_no as $key => $product_no) {
            if (!empty($product_no) && !empty($qty[$key])) {
                $line = array(
                    'c_no'    => $c_no,
                    'p_no'    => $product_no,
                    'user_id' => $header['user_id'],
                    'qty'     => $qty[$key]
                );

                $this->db->insert('classifyline', $line);
            }
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    //--------------------------------------------------------------------------
}