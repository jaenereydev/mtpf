<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Production_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Product_model');
        $this->load->model('Production_model');

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
        $this->data['production'] = $this->Production_model->get_productionlist();
        $this->data['buildingcount'] = $this->Production_model->buildingcount();
        $this->data['buildinglist'] = $this->Production_model->get_building();

        $this->data['production_today'] = $this->Production_model->production_today();
        $this->data['production_week'] = $this->Production_model->production_week();
        $this->data['production_month'] = $this->Production_model->production_month();

        $this->render_html('production/production_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function get_buildinglist()
    {
        $data = $this->Production_model->get_building();
        echo json_encode($data);
    }

    //--------------------------------------------------------------------------

    public function insertbuilding()
    {

        $b = array(
            'name' => $this->input->post('name'),
            'user_id' => $this->session->userdata('id'),
            'status' => 'ACTIVE',
        );
        $added = $this->Production_model->insertbuilding($b);

        if ($added) {
            $this->session->set_flashdata('success', 'Building record added successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to add Building record.');
        }

        redirect('production_con'); 
    }

  //--------------------------------------------------------------------------

    public function insertproduction()
    {
        $date = $this->input->post('date');
        $p = array(
            'date' => date('Y-m-d', strtotime($date)),
            'b_no' => $this->input->post('bno'),
            'qty' => $this->input->post('quantity'),
            'user_id' => $this->session->userdata('id'),
        );
        $added = $this->Production_model->insertproduction($p);

        if ($added) {
            $this->session->set_flashdata('success', 'Production record added successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to add production record.');
        }

        redirect('production_con'); 
    }

  //--------------------------------------------------------------------------

    public function update_building_name()
    {
        $b_no = $this->input->post('b_no');
        $name = $this->input->post('name');

        if (empty($b_no) || empty($name)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Missing required data.'
            ]);
            return;
        }

        $updated = $this->Production_model->update_building_name($b_no, $name);

        if ($updated) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Building name updated successfully.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'No changes were made.'
            ]);
        }
    }

    //--------------------------------------------------------------------------

    public function delbuilding($b)
    {

        $this->Production_model->deletebuilding($b, $this->session->userdata('id'));

        redirect('production_con'); 
    }

    //--------------------------------------------------------------------------

    public function updateproduction_inline()
    {
        $production_number = $this->input->post('production_number');
        $date = $this->input->post('date');
        $b_no = $this->input->post('b_no');
        $qty = $this->input->post('qty');

        if (empty($production_number) || empty($date) || empty($b_no) || empty($qty)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Missing required fields.'
            ]);
            return;
        }

        $data = array(
            'date'    => date('Y-m-d', strtotime($date)),
            'b_no'    => $b_no,
            'qty'     => $qty,
            'user_id' => $this->session->userdata('id')
        );

        $updated = $this->Production_model->updateproduction_inline($production_number, $data);

        if ($updated) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Production updated successfully.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'No changes were made.'
            ]);
        }
    }

    //--------------------------------------------------------------------------

    public function get_production_today()
    {
        $production_today = $this->Production_model->production_today();

        echo json_encode([
            'production_today' => $production_today
        ]);
    }

    //--------------------------------------------------------------------------

    public function get_production_summary()
    {
        echo json_encode([
            'production_today' => $this->Production_model->production_today(),
            'production_week'  => $this->Production_model->production_week(),
            'production_month' => $this->Production_model->production_month()
        ]);
    }

    //--------------------------------------------------------------------------

    public function deleteproduction($production_number)
    {
        if (empty($production_number)) {
            redirect('production_con');
            return;
        }

        $deleted = $this->Production_model->deleteproduction($production_number);

        if ($deleted) {
            $this->session->set_flashdata('success', 'Production record deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete production record.');
        }

        redirect('production_con');
    }

    //--------------------------------------------------------------------------


}
