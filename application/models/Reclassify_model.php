<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reclassify_model extends CI_Model
{
    public function get_reclassifylist()
    {
        $sql = "SELECT 
                    r.r_no,
                    r.date,
                    r.remarks,
                    r.post,
                    u.name,
                    COALESCE(SUM(rl.qty), 0) AS total_qty
                FROM reclassify r
                JOIN user u ON u.id = r.user_id
                LEFT JOIN reclassifyline rl ON rl.r_no = r.r_no
                GROUP BY r.r_no, r.date, r.remarks, r.post, u.name
                ORDER BY r.date DESC, r.r_no DESC";

        return $this->db->query($sql)->result();
    }

    public function get_reclassify($r_no)
    {
        $this->db->select('r.*, u.name');
        $this->db->from('reclassify r');
        $this->db->join('user u', 'u.id = r.user_id');
        $this->db->where('r.r_no', $r_no);

        return $this->db->get()->row();
    }

    public function get_reclassifyline($r_no)
    {
        $this->db->select('
            rl.*,
            fp.name AS from_productname,
            tp.name AS to_productname
        ');
        $this->db->from('reclassifyline rl');
        $this->db->join('product fp', 'fp.p_no = rl.from_p_no');
        $this->db->join('product tp', 'tp.p_no = rl.to_p_no');
        $this->db->where('rl.r_no', $r_no);
        $this->db->order_by('rl.rl_no', 'ASC');

        return $this->db->get()->result();
    }

    public function get_productlist()
    {
        $this->db->select('p_no, name, qty');
        $this->db->from('product');
        $this->db->where('active', 'YES');
        $this->db->order_by('name', 'ASC');

        return $this->db->get()->result();
    }

    public function insertreclassify($header, $from_p_no, $to_p_no, $qty)
    {
        $this->db->trans_start();

        $this->db->insert('reclassify', $header);
        $r_no = $this->db->insert_id();

        foreach ($from_p_no as $key => $from_product) {
            if (!empty($from_product) && !empty($to_p_no[$key]) && !empty($qty[$key])) {

                if ($from_product == $to_p_no[$key]) {
                    continue;
                }

                $this->db->insert('reclassifyline', array(
                    'r_no'      => $r_no,
                    'from_p_no' => $from_product,
                    'to_p_no'   => $to_p_no[$key],
                    'qty'       => $qty[$key],
                    'user_id'   => $header['user_id']
                ));
            }
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function updatereclassify($r_no, $header, $from_p_no, $to_p_no, $qty)
    {
        $this->db->trans_start();

        $this->db->where('r_no', $r_no);
        $reclassify = $this->db->get('reclassify')->row();

        if (!$reclassify || $reclassify->post == 'YES') {
            $this->db->trans_complete();
            return false;
        }

        $this->db->where('r_no', $r_no);
        $this->db->update('reclassify', $header);

        $this->db->where('r_no', $r_no);
        $this->db->delete('reclassifyline');

        foreach ($from_p_no as $key => $from_product) {
            if (!empty($from_product) && !empty($to_p_no[$key]) && !empty($qty[$key])) {

                if ($from_product == $to_p_no[$key]) {
                    continue;
                }

                $this->db->insert('reclassifyline', array(
                    'r_no'      => $r_no,
                    'from_p_no' => $from_product,
                    'to_p_no'   => $to_p_no[$key],
                    'qty'       => $qty[$key],
                    'user_id'   => $header['user_id']
                ));
            }
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function deletereclassify($r_no)
    {
        $this->db->where('r_no', $r_no);
        $reclassify = $this->db->get('reclassify')->row();

        if (!$reclassify || $reclassify->post == 'YES') {
            return false;
        }

        $this->db->trans_start();

        $this->db->where('r_no', $r_no);
        $this->db->delete('reclassifyline');

        $this->db->where('r_no', $r_no);
        $this->db->delete('reclassify');

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function postreclassify($r_no)
    {
        $user_id = $this->session->userdata('id');

        $this->db->trans_start();

        $this->db->where('r_no', $r_no);
        $reclassify = $this->db->get('reclassify')->row();

        if (!$reclassify || $reclassify->post == 'YES') {
            $this->db->trans_complete();
            return false;
        }

        $this->db->where('r_no', $r_no);
        $lines = $this->db->get('reclassifyline')->result();

        if (empty($lines)) {
            $this->db->trans_complete();
            return false;
        }

        foreach ($lines as $line) {

            if ($line->from_p_no == $line->to_p_no) {
                $this->db->trans_complete();
                return false;
            }

            /*
             * FROM PRODUCT: subtract qty
             */
            $this->db->select('qty');
            $this->db->from('product');
            $this->db->where('p_no', $line->from_p_no);
            $from_product = $this->db->get()->row();

            if (!$from_product) {
                $this->db->trans_complete();
                return false;
            }

            $from_new_balance = $from_product->qty - $line->qty;

            $this->db->insert('product_history', array(
                'date'         => $reclassify->date,
                'ref_no'       => $r_no,
                'description'  => 'RECLASSIFY OUT',
                'inqty'        => 0,
                'outqty'       => $line->qty,
                'bal'          => $from_new_balance,
                'product_p_no' => $line->from_p_no,
                'user_id'      => $user_id
            ));

            $this->db->where('p_no', $line->from_p_no);
            $this->db->set('qty', 'qty - ' . (float)$line->qty, FALSE);
            $this->db->update('product');


            /*
             * TO PRODUCT: add qty
             */
            $this->db->select('qty');
            $this->db->from('product');
            $this->db->where('p_no', $line->to_p_no);
            $to_product = $this->db->get()->row();

            if (!$to_product) {
                $this->db->trans_complete();
                return false;
            }

            $to_new_balance = $to_product->qty + $line->qty;

            $this->db->insert('product_history', array(
                'date'         => $reclassify->date,
                'ref_no'       => $r_no,
                'description'  => 'RECLASSIFY IN',
                'inqty'        => $line->qty,
                'outqty'       => 0,
                'bal'          => $to_new_balance,
                'product_p_no' => $line->to_p_no,
                'user_id'      => $user_id
            ));

            $this->db->where('p_no', $line->to_p_no);
            $this->db->set('qty', 'qty + ' . (float)$line->qty, FALSE);
            $this->db->update('product');
        }

        $this->db->where('r_no', $r_no);
        $this->db->update('reclassify', array(
            'post' => 'YES'
        ));

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}