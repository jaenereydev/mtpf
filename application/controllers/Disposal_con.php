<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disposal_con extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Disposal_model');
        $this->load->library('session');
        $this->load->model('User_model');
        $this->load->model('Company_model');

        $this->user = $this->User_model->get_users( $this->session->userdata('id'));
        $this->active = "1";
        $this->open = "1";
        $this->data = [
            'users' => $this->user,
            'hidebtn' => 0,
                'active' => $this->active,
                'open' => $this->open
        ];

        $user_id = $this->session->userdata('id');
        if (!$user_id) {
            $this->logout();
        }
    }

    public function index()
    {
        $this->data['disposal'] = $this->Disposal_model->get_disposallist();
        $this->data['products'] = $this->Disposal_model->get_productlist();

        $this->render_html('disposal/disposal_view', true);
    }

    public function insertdisposal()
    {
        $date    = $this->input->post('date');
        $remarks = $this->input->post('remarks');
        $p_no    = $this->input->post('p_no');
        $qty     = $this->input->post('qty');

        if (empty($date) || empty($p_no) || empty($qty)) {
            $this->session->set_flashdata('error', 'Please complete all required fields.');
            redirect('disposal_con');
            return;
        }

        $header = array(
            'date'    => date('Y/m/d', strtotime($date)),
            'remarks' => $remarks,
            'post'    => 'NO',
            'user_id' => $this->session->userdata('id')
        );

        $added = $this->Disposal_model->insertdisposal($header, $p_no, $qty);

        if ($added) {
            $this->session->set_flashdata('success', 'Disposal record added successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to add disposal record.');
        }

        redirect('disposal_con');
    }

    public function disposalinfo($dis_no)
    {
        if (empty($dis_no)) {
            $this->session->set_flashdata('error', 'Invalid disposal record.');
            redirect('disposal_con');
            return;
        }

        $this->data['disposal'] = $this->Disposal_model->get_disposal($dis_no);
        $this->data['disposalline'] = $this->Disposal_model->get_disposalline($dis_no);
        $this->data['products'] = $this->Disposal_model->get_productlist();

        if (!$this->data['disposal']) {
            $this->session->set_flashdata('error', 'Disposal record not found.');
            redirect('disposal_con');
            return;
        }

        $this->render_html('disposal/disposal_info', true);
    }

    public function updatedisposal()
    {
        $dis_no = $this->input->post('dis_no');

        if (empty($dis_no)) {
            $this->session->set_flashdata('error', 'Invalid disposal record.');
            redirect('disposal_con');
            return;
        }

        $disposal = $this->Disposal_model->get_disposal($dis_no);

        if (!$disposal) {
            $this->session->set_flashdata('error', 'Disposal record not found.');
            redirect('disposal_con');
            return;
        }

        if ($disposal->post == 'YES') {
            $this->session->set_flashdata('error', 'Posted disposal records cannot be updated.');
            redirect('disposal_con/disposalinfo/'.$dis_no);
            return;
        }

        $header = array(
            'date'    => date('Y/m/d', strtotime($this->input->post('date'))),
            'remarks' => $this->input->post('remarks'),
            'user_id' => $this->session->userdata('id')
        );

        $p_no = $this->input->post('p_no');
        $qty  = $this->input->post('qty');

        $updated = $this->Disposal_model->updatedisposal($dis_no, $header, $p_no, $qty);

        if ($updated) {
            $this->session->set_flashdata('success', 'Disposal record updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update disposal record.');
        }

        redirect('disposal_con/disposalinfo/'.$dis_no);
    }

    public function deletedisposal($dis_no)
    {
        if (empty($dis_no)) {
            $this->session->set_flashdata('error', 'Invalid disposal record.');
            redirect('disposal_con');
            return;
        }

        $deleted = $this->Disposal_model->deletedisposal($dis_no);

        if ($deleted) {
            $this->session->set_flashdata('success', 'Disposal record deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete disposal record. Posted records cannot be deleted.');
        }

        redirect('disposal_con');
    }

    public function postdisposal($dis_no)
    {
        if (empty($dis_no)) {
            $this->session->set_flashdata('error', 'Invalid disposal record.');
            redirect('disposal_con');
            return;
        }

        $posted = $this->Disposal_model->postdisposal($dis_no);

        if ($posted) {
            $this->session->set_flashdata('success', 'Disposal record posted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to post disposal record.');
        }

        redirect('disposal_con');
    }

    public function printdisposal($dis_no)
    {
        if (empty($dis_no)) {
            redirect('disposal_con');
            return;
        }

        $data['disposal'] = $this->Disposal_model->get_disposal($dis_no);
        $data['disposalline'] = $this->Disposal_model->get_disposalline($dis_no);

        if (!$data['disposal']) {
            redirect('disposal_con');
            return;
        }

        $this->load->view('disposal/disposal_print', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
}