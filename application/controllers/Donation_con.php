<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donation_con extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Donation_model');
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
        $this->data['donation'] = $this->Donation_model->get_donationlist();
        $this->data['products'] = $this->Donation_model->get_productlist();

        $this->render_html('donation/donation_view', true);
    }

    public function insertdonation()
    {
        $date      = $this->input->post('date');
        $donate_to = $this->input->post('donate_to');
        $remarks   = $this->input->post('remarks');
        $p_no      = $this->input->post('p_no');
        $qty       = $this->input->post('qty');

        if (empty($date) || empty($donate_to) || empty($p_no) || empty($qty)) {
            $this->session->set_flashdata('error', 'Please complete all required fields.');
            redirect('donation_con');
            return;
        }

        $header = array(
            'date'      => date('Y/m/d', strtotime($date)),
            'donate_to' => $donate_to,
            'remarks'   => $remarks,
            'user_id'   => $this->session->userdata('id'),
            'post'      => 'NO'
        );

        $added = $this->Donation_model->insertdonation($header, $p_no, $qty);

        if ($added) {
            $this->session->set_flashdata('success', 'Donation record added successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to add donation record.');
        }

        redirect('donation_con');
    }

    public function donationinfo($d_no)
    {
        if (empty($d_no)) {
            $this->session->set_flashdata('error', 'Invalid donation record.');
            redirect('donation_con');
            return;
        }

        $this->data['donation'] = $this->Donation_model->get_donation($d_no);
        $this->data['donationline'] = $this->Donation_model->get_donationline($d_no);
        $this->data['products'] = $this->Donation_model->get_productlist();

        if (!$this->data['donation']) {
            $this->session->set_flashdata('error', 'Donation record not found.');
            redirect('donation_con');
            return;
        }

        $this->render_html('donation/donation_info', true);
    }

    public function updatedonation()
    {
        $d_no = $this->input->post('d_no');

        if (empty($d_no)) {
            $this->session->set_flashdata('error', 'Invalid donation record.');
            redirect('donation_con');
            return;
        }

        $donation = $this->Donation_model->get_donation($d_no);

        if (!$donation) {
            $this->session->set_flashdata('error', 'Donation record not found.');
            redirect('donation_con');
            return;
        }

        if ($donation->post == 'YES') {
            $this->session->set_flashdata('error', 'Posted donation records cannot be updated.');
            redirect('donation_con/donationinfo/'.$d_no);
            return;
        }

        $header = array(
            'date'      => date('Y/m/d', strtotime($this->input->post('date'))),
            'donate_to' => $this->input->post('donate_to'),
            'remarks'   => $this->input->post('remarks'),
            'user_id'   => $this->session->userdata('id')
        );

        $p_no = $this->input->post('p_no');
        $qty  = $this->input->post('qty');

        $updated = $this->Donation_model->updatedonation($d_no, $header, $p_no, $qty);

        if ($updated) {
            $this->session->set_flashdata('success', 'Donation record updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update donation record.');
        }

        redirect('donation_con/donationinfo/'.$d_no);
    }

    public function deletedonation($d_no)
    {
        if (empty($d_no)) {
            $this->session->set_flashdata('error', 'Invalid donation record.');
            redirect('donation_con');
            return;
        }

        $deleted = $this->Donation_model->deletedonation($d_no);

        if ($deleted) {
            $this->session->set_flashdata('success', 'Donation record deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete donation record. Posted records cannot be deleted.');
        }

        redirect('donation_con');
    }

    public function postdonation($d_no)
    {
        if (empty($d_no)) {
            $this->session->set_flashdata('error', 'Invalid donation record.');
            redirect('donation_con');
            return;
        }

        $posted = $this->Donation_model->postdonation($d_no);

        if ($posted) {
            $this->session->set_flashdata('success', 'Donation record posted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to post donation. Please check product quantity or record status.');
        }

        redirect('donation_con');
    }

    public function printdonation($d_no)
    {
        if (empty($d_no)) {
            redirect('donation_con');
            return;
        }

        $data['donation'] = $this->Donation_model->get_donation($d_no);
        $data['donationline'] = $this->Donation_model->get_donationline($d_no);

        if (!$data['donation']) {
            redirect('donation_con');
            return;
        }

        $this->load->view('donation/donation_print', $data);
    }
}