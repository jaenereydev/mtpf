<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disposal_model extends CI_Model
{
    public function get_disposallist()
    {
        $sql = "SELECT 
                    d.dis_no,
                    d.date,
                    d.remarks,
                    d.post,
                    u.name,
                    COALESCE(SUM(dl.qty), 0) AS total_qty
                FROM disposal d
                JOIN user u ON u.id = d.user_id
                LEFT JOIN disposalline dl ON dl.dis_no = d.dis_no
                GROUP BY d.dis_no, d.date, d.remarks, d.post, u.name
                ORDER BY d.dis_no DESC";

        return $this->db->query($sql)->result();
    }

    public function get_disposal($dis_no)
    {
        $this->db->select('d.*, u.name');
        $this->db->from('disposal d');
        $this->db->join('user u', 'u.id = d.user_id');
        $this->db->where('d.dis_no', $dis_no);

        return $this->db->get()->row();
    }

    public function get_disposalline($dis_no)
    {
        $this->db->select('dl.*, p.name AS productname');
        $this->db->from('disposalline dl');
        $this->db->join('product p', 'p.p_no = dl.p_no');
        $this->db->where('dl.dis_no', $dis_no);
        $this->db->order_by('dl.disl_no', 'ASC');

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

    public function insertdisposal($header, $p_no, $qty)
    {
        $this->db->trans_start();

        $this->db->insert('disposal', $header);
        $dis_no = $this->db->insert_id();

        foreach ($p_no as $key => $product_no) {
            if (!empty($product_no) && !empty($qty[$key])) {
                $this->db->insert('disposalline', array(
                    'dis_no'  => $dis_no,
                    'p_no'    => $product_no,
                    'qty'     => $qty[$key],
                    'user_id' => $header['user_id']
                ));
            }
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function updatedisposal($dis_no, $header, $p_no, $qty)
    {
        $this->db->trans_start();

        $this->db->where('dis_no', $dis_no);
        $disposal = $this->db->get('disposal')->row();

        if (!$disposal || $disposal->post == 'YES') {
            $this->db->trans_complete();
            return false;
        }

        $this->db->where('dis_no', $dis_no);
        $this->db->update('disposal', $header);

        $this->db->where('dis_no', $dis_no);
        $this->db->delete('disposalline');

        foreach ($p_no as $key => $product_no) {
            if (!empty($product_no) && !empty($qty[$key])) {
                $this->db->insert('disposalline', array(
                    'dis_no'  => $dis_no,
                    'p_no'    => $product_no,
                    'qty'     => $qty[$key],
                    'user_id' => $header['user_id']
                ));
            }
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function deletedisposal($dis_no)
    {
        $this->db->where('dis_no', $dis_no);
        $disposal = $this->db->get('disposal')->row();

        if (!$disposal || $disposal->post == 'YES') {
            return false;
        }

        $this->db->trans_start();

        $this->db->where('dis_no', $dis_no);
        $this->db->delete('disposalline');

        $this->db->where('dis_no', $dis_no);
        $this->db->delete('disposal');

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function postdisposal($dis_no)
    {
        $user_id = $this->session->userdata('id');

        $this->db->trans_start();

        $this->db->where('dis_no', $dis_no);
        $disposal = $this->db->get('disposal')->row();

        if (!$disposal || $disposal->post == 'YES') {
            $this->db->trans_complete();
            return false;
        }

        $this->db->where('dis_no', $dis_no);
        $lines = $this->db->get('disposalline')->result();

        if (empty($lines)) {
            $this->db->trans_complete();
            return false;
        }

        foreach ($lines as $line) {

            $this->db->select('qty');
            $this->db->from('product');
            $this->db->where('p_no', $line->p_no);
            $product = $this->db->get()->row();

            if (!$product) {
                $this->db->trans_complete();
                return false;
            }

            /*
                Like donation, this allows negative inventory.
                If product qty is 0 and disposal qty is 5,
                new balance becomes -5.
            */
            $new_balance = $product->qty - $line->qty;

            $this->db->insert('product_history', array(
                'date'         => $disposal->date,
                'ref_no'       => $dis_no,
                'description'  => 'DISPOSAL',
                'inqty'        => 0,
                'outqty'       => $line->qty,
                'bal'          => $new_balance,
                'product_p_no' => $line->p_no,
                'user_id'      => $user_id
            ));

            $this->db->where('p_no', $line->p_no);
            $this->db->set('qty', 'qty - ' . (float)$line->qty, FALSE);
            $this->db->update('product');
        }

        $this->db->where('dis_no', $dis_no);
        $this->db->update('disposal', array(
            'post' => 'YES'
        ));

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}