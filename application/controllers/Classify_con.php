<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classify_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Product_model');
        $this->load->model('Classify_model');

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
    
    //--------------------------------------------------------------------------                   
    
    public function index()
    {                    
        $this->session->unset_userdata('prodno');
        $this->data['classify'] = $this->Classify_model->get_classifylist();
        $this->data['products'] = $this->Classify_model->get_productlist();

        $this->render_html('classify/classify_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function insertclassify()
    {
        $date = $this->input->post('date');
        $p_no = $this->input->post('p_no');
        $qty  = $this->input->post('qty');

        if (empty($date) || empty($p_no) || empty($qty)) {
            $this->session->set_flashdata('error', 'Please complete all required fields.');
            redirect('classify_con');
            return;
        }

        $header = array(
            'date'    => date('Y/m/d', strtotime($date)),
            'user_id' => $this->session->userdata('id'),
            'post'    => 'NO'
        );

        $added = $this->Classify_model->insertclassify($header, $p_no, $qty);

        if ($added) {
            $this->session->set_flashdata('success', 'Classify record added successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to add classify record.');
        }

        redirect('classify_con');
    }

    //--------------------------------------------------------------------------

    public function deleteclassify($c_no)
    {
        if (empty($c_no)) {
            $this->session->set_flashdata('error', 'Invalid classify record.');
            redirect('classify_con');
            return;
        }

        $deleted = $this->Classify_model->deleteclassify($c_no);

        if ($deleted) {
            $this->session->set_flashdata('success', 'Classify record deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete classify record. Posted records cannot be deleted.');
        }

        redirect('classify_con');
    }

    //--------------------------------------------------------------------------

    public function postclassify($c_no)
    {
        if (empty($c_no)) {
            $this->session->set_flashdata('error', 'Invalid classify record.');
            redirect('classify_con');
            return;
        }

        $posted = $this->Classify_model->postclassify($c_no);

        if ($posted) {
            $this->session->set_flashdata('success', 'Classify record posted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to post classify record. It may already be posted.');
        }

        redirect('classify_con');
    }

    //--------------------------------------------------------------------------

    public function classifyinfo($c_no)
    {
        if (empty($c_no)) {
            $this->session->set_flashdata('error', 'Invalid classify record.');
            redirect('classify_con');
            return;
        }

        $this->data['classify'] = $this->Classify_model->get_classify($c_no);
        $this->data['classifyline'] = $this->Classify_model->get_classifyline($c_no);
        $this->data['products'] = $this->Classify_model->get_productlist();

        if (!$this->data['classify']) {
            $this->session->set_flashdata('error', 'Classify record not found.');
            redirect('classify_con');
            return;
        }

        $this->render_html('classify/classify_info', true);
    }

    //--------------------------------------------------------------------------

    public function updateclassify()
    {
        $c_no = $this->input->post('c_no');
        

        if (empty($c_no)) {
            $this->session->set_flashdata('error', 'Invalid classify record.');
            redirect('classify_con');
            return;
        }

        $classify = $this->Classify_model->get_classify($c_no);

        if (!$classify) {
            $this->session->set_flashdata('error', 'Classify record not found.');
            redirect('classify_con');
            return;
        }

        if ($classify->post == 'YES') {
            $this->session->set_flashdata('error', 'Posted classify records cannot be updated.');
            redirect('classify_con/classifyinfo/'.$c_no);
            return;
        }

        $date  = $this->input->post('date');
        $cl_no = $this->input->post('cl_no');
        $p_no  = $this->input->post('p_no');
        $qty   = $this->input->post('qty');

        if (empty($date) || empty($p_no) || empty($qty)) {
            $this->session->set_flashdata('error', 'Please complete all required fields.');
            redirect('classify_con/classifyinfo/'.$c_no);
            return;
        }

        $header = array(
            'date'    => date('Y/m/d', strtotime($date)),
            'user_id' => $this->session->userdata('id')
        );

        $updated = $this->Classify_model->updateclassify($c_no, $header, $cl_no, $p_no, $qty);

        if ($updated) {
            $this->session->set_flashdata('success', 'Classify record updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update classify record.');
        }

        redirect('classify_con/classifyinfo/'.$c_no);
    }

    //--------------------------------------------------------------------------

    public function printclassify($c_no)
    {
        if (empty($c_no)) {
            $this->session->set_flashdata('error', 'Invalid classify record.');
            redirect('classify_con');
            return;
        }

        $data['classify'] = $this->Classify_model->get_classify($c_no);
        $data['classifyline'] = $this->Classify_model->get_classifyline($c_no);

        if (!$data['classify']) {
            $this->session->set_flashdata('error', 'Classify record not found.');
            redirect('classify_con');
            return;
        }

        $this->load->view('classify/classify_print', $data);
    }
}
