<?php
  class MY_Controller extends CI_Controller
  {
    var $data = '';
    
    public function render_html($page = '', $bool = true)
    {
      
      $this->load->view('inc/header_view', $this->data);
      if($bool)
        $this->load->view('inc/sidebar_view');
      $this->load->view($page);
      $this->load->view('inc/footer_view');
    }

    public function logout()
    {
      $this->session->sess_destroy();
      redirect('/');
    }

   
   
  }
?>