<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reclassify_con extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reclassify_model');
        $this->load->library('session');
        $this->load->model('User_model');
        $this->load->model('Company_model');

        $this->user = $this->User_model->get_users( $this->session->userdata('id'));
        $this->com = $this->Company_model->get_companyinfo();
        $this->active = "1";
        $this->open = "1";
        $this->data = [
            'users' => $this->user,
            'hidebtn' => 0,
            'com' => $this->com,
            'active' => $this->active,
            'open' => $this->open
        ];

        
        $user_id = $this->session->userdata('id');
        if(!$user_id) {
            $this->logout();
        }
    }

    public function index()
    {
        $this->data['reclassify'] = $this->Reclassify_model->get_reclassifylist();
        $this->data['products'] = $this->Reclassify_model->get_productlist();

        $this->render_html('reclassify/reclassify_view', true);
    }

    public function insertreclassify()
    {
        $date      = $this->input->post('date');
        $remarks   = $this->input->post('remarks');
        $from_p_no = $this->input->post('from_p_no');
        $to_p_no   = $this->input->post('to_p_no');
        $qty       = $this->input->post('qty');

        if (empty($date) || empty($from_p_no) || empty($to_p_no) || empty($qty)) {
            $this->session->set_flashdata('error', 'Please complete all required fields.');
            redirect('reclassify_con');
            return;
        }

        $header = array(
            'date'    => date('Y-m-d', strtotime($date)),
            'remarks' => $remarks,
            'user_id' => $this->session->userdata('id'),
            'post'    => 'NO'
        );

        $added = $this->Reclassify_model->insertreclassify($header, $from_p_no, $to_p_no, $qty);

        if ($added) {
            $this->session->set_flashdata('success', 'Reclassify record added successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to add reclassify record.');
        }

        redirect('reclassify_con');
    }

    public function reclassifyinfo($r_no)
    {
        if (empty($r_no)) {
            $this->session->set_flashdata('error', 'Invalid reclassify record.');
            redirect('reclassify_con');
            return;
        }

        $this->data['reclassify'] = $this->Reclassify_model->get_reclassify($r_no);
        $this->data['reclassifyline'] = $this->Reclassify_model->get_reclassifyline($r_no);
        $this->data['products'] = $this->Reclassify_model->get_productlist();

        if (!$this->data['reclassify']) {
            $this->session->set_flashdata('error', 'Reclassify record not found.');
            redirect('reclassify_con');
            return;
        }

        $this->render_html('reclassify/reclassify_info', true);
    }

    public function updatereclassify()
    {
        $r_no = $this->input->post('r_no');

        if (empty($r_no)) {
            $this->session->set_flashdata('error', 'Invalid reclassify record.');
            redirect('reclassify_con');
            return;
        }

        $reclassify = $this->Reclassify_model->get_reclassify($r_no);

        if (!$reclassify) {
            $this->session->set_flashdata('error', 'Reclassify record not found.');
            redirect('reclassify_con');
            return;
        }

        if ($reclassify->post == 'YES') {
            $this->session->set_flashdata('error', 'Posted reclassify records cannot be updated.');
            redirect('reclassify_con/reclassifyinfo/'.$r_no);
            return;
        }

        $header = array(
            'date'    => date('Y-m-d', strtotime($this->input->post('date'))),
            'remarks' => $this->input->post('remarks'),
            'user_id' => $this->session->userdata('id')
        );

        $from_p_no = $this->input->post('from_p_no');
        $to_p_no   = $this->input->post('to_p_no');
        $qty       = $this->input->post('qty');

        $updated = $this->Reclassify_model->updatereclassify($r_no, $header, $from_p_no, $to_p_no, $qty);

        if ($updated) {
            $this->session->set_flashdata('success', 'Reclassify record updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update reclassify record.');
        }

        redirect('reclassify_con/reclassifyinfo/'.$r_no);
    }

    public function deletereclassify($r_no)
    {
        if (empty($r_no)) {
            $this->session->set_flashdata('error', 'Invalid reclassify record.');
            redirect('reclassify_con');
            return;
        }

        $deleted = $this->Reclassify_model->deletereclassify($r_no);

        if ($deleted) {
            $this->session->set_flashdata('success', 'Reclassify record deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete reclassify record. Posted records cannot be deleted.');
        }

        redirect('reclassify_con');
    }

    public function postreclassify($r_no)
    {
        if (empty($r_no)) {
            $this->session->set_flashdata('error', 'Invalid reclassify record.');
            redirect('reclassify_con');
            return;
        }

        $posted = $this->Reclassify_model->postreclassify($r_no);

        if ($posted) {
            $this->session->set_flashdata('success', 'Reclassify record posted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to post reclassify record.');
        }

        redirect('reclassify_con');
    }

    public function printreclassify($r_no)
    {
        if (empty($r_no)) {
            redirect('reclassify_con');
            return;
        }

        $data['reclassify'] = $this->Reclassify_model->get_reclassify($r_no);
        $data['reclassifyline'] = $this->Reclassify_model->get_reclassifyline($r_no);

        if (!$data['reclassify']) {
            redirect('reclassify_con');
            return;
        }

        $this->load->view('reclassify/reclassify_print', $data);
    }
}