<?php

class Dashboard_model extends CI_Model
{
    //----------------------------------------------------------------------

    public function totalproductqty()
    {
        $this->db->select_sum('qty', 'total_qty');
        $this->db->from('product');
        $this->db->where('active', 'YES');

        $query = $this->db->get();
        $row = $query->row();

        return $row->total_qty ? $row->total_qty : 0;
    }

    //----------------------------------------------------------------------

    public function productcount()
    {
        return $this->db
            ->where('active', 'YES')
            ->count_all_results('product');
    }

    //----------------------------------------------------------------------

    public function lowstockcount()
    {
        $this->db->where('active', 'YES');
        $this->db->where('qty <=', 10);
        $this->db->where('qty >=', 0);

        return $this->db->count_all_results('product');
    }

    //----------------------------------------------------------------------

    public function negativestockcount()
    {
        $this->db->where('active', 'YES');
        $this->db->where('qty <', 0);

        return $this->db->count_all_results('product');
    }

    //----------------------------------------------------------------------

    public function lowstockproducts()
    {
        $this->db->select('p_no, name, qty');
        $this->db->from('product');
        $this->db->where('active', 'YES');
        $this->db->where('qty <=', 10);
        $this->db->order_by('qty', 'ASC');

        return $this->db->get()->result();
    }

    //----------------------------------------------------------------------

    public function production_today()
    {
        $this->db->select_sum('qty', 'total_qty');
        $this->db->from('production');
        $this->db->where('date', date('Y-m-d'));

        $query = $this->db->get();
        $row = $query->row();

        return $row->total_qty ? $row->total_qty : 0;
    }

    //----------------------------------------------------------------------

    public function production_week()
    {
        $monday = date('Y-m-d', strtotime('monday this week'));
        $sunday = date('Y-m-d', strtotime('sunday this week'));

        $this->db->select_sum('qty', 'total_qty');
        $this->db->from('production');
        $this->db->where('date >=', $monday);
        $this->db->where('date <=', $sunday);

        $query = $this->db->get();
        $row = $query->row();

        return $row->total_qty ? $row->total_qty : 0;
    }

    //----------------------------------------------------------------------

    public function production_month()
    {
        $this->db->select_sum('qty', 'total_qty');
        $this->db->from('production');
        $this->db->where('date >=', date('Y-m-01'));
        $this->db->where('date <=', date('Y-m-t'));

        $query = $this->db->get();
        $row = $query->row();

        return $row->total_qty ? $row->total_qty : 0;
    }

    //----------------------------------------------------------------------

    public function donation_month()
    {
        $sql = "SELECT COALESCE(SUM(dl.qty), 0) AS total_qty
                FROM donation d
                JOIN donationline dl ON dl.d_no = d.d_no
                JOIN product p ON p.p_no = dl.p_no
                WHERE d.post = 'YES'
                AND p.active = 'YES'
                AND d.date BETWEEN ? AND ?";

        $query = $this->db->query($sql, array(date('Y-m-01'), date('Y-m-t')));
        $row = $query->row();

        return $row->total_qty ? $row->total_qty : 0;
    }

    //----------------------------------------------------------------------

    public function reclassify_month()
    {
        $sql = "SELECT COALESCE(SUM(rl.qty), 0) AS total_qty
                FROM reclassify r
                JOIN reclassifyline rl ON rl.r_no = r.r_no
                JOIN product fp ON fp.p_no = rl.from_p_no
                JOIN product tp ON tp.p_no = rl.to_p_no
                WHERE r.post = 'YES'
                AND fp.active = 'YES'
                AND tp.active = 'YES'
                AND r.date BETWEEN ? AND ?";

        $query = $this->db->query($sql, array(date('Y-m-01'), date('Y-m-t')));
        $row = $query->row();

        return $row->total_qty ? $row->total_qty : 0;
    }

    //----------------------------------------------------------------------

    public function production_last_7_days()
    {
        $sql = "SELECT 
                    date,
                    SUM(qty) AS total_qty
                FROM production
                WHERE date >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
                GROUP BY date
                ORDER BY date ASC";

        return $this->db->query($sql)->result();
    }

    //----------------------------------------------------------------------

    public function product_movement_this_month()
    {
        $sql = "SELECT 
                    p.name,
                    COALESCE(SUM(ph.inqty), 0) AS total_in,
                    COALESCE(SUM(ph.outqty), 0) AS total_out,
                    p.qty AS current_balance
                FROM product_history ph
                JOIN product p ON p.p_no = ph.product_p_no
                WHERE p.active = 'YES'
                AND ph.date BETWEEN ? AND ?
                GROUP BY p.p_no, p.name, p.qty
                ORDER BY (COALESCE(SUM(ph.inqty), 0) + COALESCE(SUM(ph.outqty), 0)) DESC
                LIMIT 10";

        return $this->db->query($sql, array(date('Y/m/01'), date('Y/m/t')))->result();
    }

    //----------------------------------------------------------------------

    public function cash_sales_today()
    {
        $sql = "SELECT COALESCE(SUM(CAST(totalamount AS DECIMAL(12,2))), 0) AS total_amount
                FROM `transaction`
                WHERE type = 'CASH'
                AND STR_TO_DATE(date, '%Y/%m/%d') = CURDATE()";

        $query = $this->db->query($sql);
        $row = $query->row();

        return $row->total_amount ? $row->total_amount : 0;
    }

    //----------------------------------------------------------------------

    public function cash_sales_month()
    {
        $sql = "SELECT COALESCE(SUM(CAST(totalamount AS DECIMAL(12,2))), 0) AS total_amount
                FROM `transaction`
                WHERE type = 'CASH'
                AND STR_TO_DATE(date, '%Y/%m/%d') BETWEEN ? AND ?";

        $query = $this->db->query($sql, array(date('Y-m-01'), date('Y-m-t')));
        $row = $query->row();

        return $row->total_amount ? $row->total_amount : 0;
    }

    //----------------------------------------------------------------------

    public function credit_sales_month()
    {
        $sql = "SELECT COALESCE(SUM(CAST(totalamount AS DECIMAL(12,2))), 0) AS total_amount
                FROM `transaction`
                WHERE type = 'CREDIT'
                AND STR_TO_DATE(date, '%Y/%m/%d') BETWEEN ? AND ?";

        $query = $this->db->query($sql, array(date('Y/m/01'), date('Y/m/t')));
        $row = $query->row();

        return $row->total_amount ? $row->total_amount : 0;
    }

    //----------------------------------------------------------------------

    public function credit_payment_month()
    {
        $sql = "SELECT COALESCE(SUM(CAST(totalpayment AS DECIMAL(12,2))), 0) AS total_amount
                FROM customerpayment
                WHERE post = 'YES'
                AND STR_TO_DATE(date, '%Y/%m/%d') BETWEEN ? AND ?";

        $query = $this->db->query($sql, array(date('Y/m/01'), date('Y/m/t')));
        $row = $query->row();

        return $row->total_amount ? $row->total_amount : 0;
    }

    //----------------------------------------------------------------------

    public function expenses_month()
    {
        $sql = "SELECT COALESCE(SUM(CAST(amount AS DECIMAL(12,2))), 0) AS total_amount
                FROM expenses
                WHERE STR_TO_DATE(date, '%Y/%m/%d') BETWEEN ? AND ?";

        $query = $this->db->query($sql, array(date('Y/m/01'), date('Y/m/t')));
        $row = $query->row();

        return $row->total_amount ? $row->total_amount : 0;
    }

    //----------------------------------------------------------------------

    public function total_sales_month()
    {
        $sql = "SELECT COALESCE(SUM(CAST(totalamount AS DECIMAL(12,2))), 0) AS total_amount
                FROM `transaction`
                WHERE STR_TO_DATE(date, '%Y/%m/%d') BETWEEN ? AND ?";

        $query = $this->db->query($sql, array(date('Y/m/01'), date('Y/m/t')));
        $row = $query->row();

        return $row->total_amount ? $row->total_amount : 0;
    }

    //----------------------------------------------------------------------

    public function credit_balance()
    {
        /*
            Total credit balance based on:
            all CREDIT transactions - all posted customer payments
        */

        $sql_credit = "SELECT COALESCE(SUM(CAST(totalamount AS DECIMAL(12,2))), 0) AS total_credit
                    FROM `transaction`
                    WHERE type = 'CREDIT'";

        $credit = $this->db->query($sql_credit)->row();

        $sql_payment = "SELECT COALESCE(SUM(CAST(totalpayment AS DECIMAL(12,2))), 0) AS total_payment
                        FROM customerpayment
                        WHERE post = 'YES'";

        $payment = $this->db->query($sql_payment)->row();

        $total_credit = $credit->total_credit ? $credit->total_credit : 0;
        $total_payment = $payment->total_payment ? $payment->total_payment : 0;

        return $total_credit - $total_payment;
    }

    //----------------------------------------------------------------------

    public function net_cash_month()
    {
        /*
            Cash available this month:
            cash sales + customer credit payments - expenses
        */

        return $this->cash_sales_month() + $this->credit_payment_month() - $this->expenses_month();
    }

    //----------------------------------------------------------------------


    public function production_period($date_from, $date_to)
    {
        $this->db->select_sum('qty', 'total_qty');
        $this->db->from('production');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);

        $query = $this->db->get();
        $row = $query->row();

        return $row->total_qty ? $row->total_qty : 0;
    }

    //----------------------------------------------------------------------

    public function cash_sales_period($date_from, $date_to)
    {
        $sql = "SELECT COALESCE(SUM(CAST(totalamount AS DECIMAL(12,2))), 0) AS total_amount
                FROM `transaction`
                WHERE type = 'CASH'
                AND STR_TO_DATE(date, '%Y-%m-%d') BETWEEN ? AND ?";

        $query = $this->db->query($sql, array($date_from, $date_to));
        $row = $query->row();

        return $row->total_amount ? $row->total_amount : 0;
    }

    //----------------------------------------------------------------------

    public function credit_sales_period($date_from, $date_to)
    {
        $sql = "SELECT COALESCE(SUM(CAST(totalamount AS DECIMAL(12,2))), 0) AS total_amount
                FROM `transaction`
                WHERE type = 'CREDIT'
                AND STR_TO_DATE(date, '%Y-%m-%d') BETWEEN ? AND ?";

        $query = $this->db->query($sql, array($date_from, $date_to));
        $row = $query->row();

        return $row->total_amount ? $row->total_amount : 0;
    }

    //----------------------------------------------------------------------

    public function credit_payment_period($date_from, $date_to)
    {
        $sql = "SELECT COALESCE(SUM(CAST(totalpayment AS DECIMAL(12,2))), 0) AS total_amount
                FROM customerpayment
                WHERE post = 'YES'
                AND STR_TO_DATE(date, '%Y-%m-%d') BETWEEN ? AND ?";

        $query = $this->db->query($sql, array($date_from, $date_to));
        $row = $query->row();

        return $row->total_amount ? $row->total_amount : 0;
    }

    //----------------------------------------------------------------------

    public function expenses_period($date_from, $date_to)
    {
        $sql = "SELECT COALESCE(SUM(CAST(amount AS DECIMAL(12,2))), 0) AS total_amount
                FROM expenses
                WHERE STR_TO_DATE(date, '%Y-%m-%d') BETWEEN ? AND ?";

        $query = $this->db->query($sql, array($date_from, $date_to));
        $row = $query->row();

        return $row->total_amount ? $row->total_amount : 0;
    }

    //----------------------------------------------------------------------

    public function net_cash_period($date_from, $date_to)
    {
        return $this->cash_sales_period($date_from, $date_to)
            + $this->credit_payment_period($date_from, $date_to)
            - $this->expenses_period($date_from, $date_to);
    }
    //----------------------------------------------------------------------

    public function donation_period($date_from, $date_to)
    {
        $sql = "SELECT COALESCE(SUM(dl.qty), 0) AS total_qty
                FROM donation d
                JOIN donationline dl ON dl.d_no = d.d_no
                JOIN product p ON p.p_no = dl.p_no
                WHERE d.post = 'YES'
                AND p.active = 'YES'
                AND d.date BETWEEN ? AND ?";

        $query = $this->db->query($sql, array($date_from, $date_to));
        $row = $query->row();

        return $row->total_qty ? $row->total_qty : 0;
    }

    //----------------------------------------------------------------------

    public function reclassify_period($date_from, $date_to)
    {
        $sql = "SELECT COALESCE(SUM(rl.qty), 0) AS total_qty
                FROM reclassify r
                JOIN reclassifyline rl ON rl.r_no = r.r_no
                JOIN product fp ON fp.p_no = rl.from_p_no
                JOIN product tp ON tp.p_no = rl.to_p_no
                WHERE r.post = 'YES'
                AND fp.active = 'YES'
                AND tp.active = 'YES'
                AND r.date BETWEEN ? AND ?";

        $query = $this->db->query($sql, array($date_from, $date_to));
        $row = $query->row();

        return $row->total_qty ? $row->total_qty : 0;
    }

    //----------------------------------------------------------------------

    public function production_chart_period($date_from, $date_to)
    {
        $sql = "SELECT 
                    date,
                    SUM(qty) AS total_qty
                FROM production
                WHERE date BETWEEN ? AND ?
                GROUP BY date
                ORDER BY date ASC";

        return $this->db->query($sql, array($date_from, $date_to))->result();
    }
    //----------------------------------------------------------------------

    public function product_movement_period($date_from, $date_to)
    {
        $sql = "SELECT 
                    p.name,
                    COALESCE(SUM(ph.inqty), 0) AS total_in,
                    COALESCE(SUM(ph.outqty), 0) AS total_out,
                    p.qty AS current_balance
                FROM product_history ph
                JOIN product p ON p.p_no = ph.product_p_no
                WHERE p.active = 'YES'
                AND ph.date BETWEEN ? AND ?
                GROUP BY p.p_no, p.name, p.qty
                ORDER BY (COALESCE(SUM(ph.inqty), 0) + COALESCE(SUM(ph.outqty), 0)) DESC
                LIMIT 10";

        return $this->db->query($sql, array($date_from, $date_to))->result();
    }

    //----------------------------------------------------------------------

    public function financial_chart_period($date_from, $date_to)
    {
        $sql = "SELECT 
                    x.date,
                    SUM(x.cash_sales) AS cash_sales,
                    SUM(x.credit_payment) AS credit_payment,
                    SUM(x.expenses) AS expenses
                FROM (
                    SELECT 
                        STR_TO_DATE(date, '%Y/%m/%d') AS date,
                        CAST(totalamount AS DECIMAL(12,2)) AS cash_sales,
                        0 AS credit_payment,
                        0 AS expenses
                    FROM `transaction`
                    WHERE type = 'CASH'
                    AND STR_TO_DATE(date, '%Y/%m/%d') BETWEEN STR_TO_DATE(?, '%Y/%m/%d') AND STR_TO_DATE(?, '%Y/%m/%d')

                    UNION ALL

                    SELECT 
                        STR_TO_DATE(date, '%Y/%m/%d') AS date,
                        0 AS cash_sales,
                        CAST(totalpayment AS DECIMAL(12,2)) AS credit_payment,
                        0 AS expenses
                    FROM customerpayment
                    WHERE post = 'YES'
                    AND STR_TO_DATE(date, '%Y/%m/%d') BETWEEN STR_TO_DATE(?, '%Y/%m/%d') AND STR_TO_DATE(?, '%Y/%m/%d')

                    UNION ALL

                    SELECT 
                        STR_TO_DATE(date, '%Y/%m/%d') AS date,
                        0 AS cash_sales,
                        0 AS credit_payment,
                        CAST(amount AS DECIMAL(12,2)) AS expenses
                    FROM expenses
                    WHERE STR_TO_DATE(date, '%Y/%m/%d') BETWEEN STR_TO_DATE(?, '%Y/%m/%d') AND STR_TO_DATE(?, '%Y/%m/%d')
                ) x
                GROUP BY x.date
                ORDER BY x.date ASC";

        return $this->db->query($sql, array(
            $date_from, $date_to,
            $date_from, $date_to,
            $date_from, $date_to
        ))->result();
    }
    
    //----------------------------------------------------------------------
    //----------------------------------------------------------------------
    //----------------------------------------------------------------------

}