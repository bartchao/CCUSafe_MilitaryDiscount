<?php
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('record_model');
        $this->load->model('course_model');
        $this->load->model('recordcourse_model');
        $this->load->model('recordimage_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
    }
    public function redirect(){
        redirect('user/step1');
    }
    public function step1()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        //Form Validation Config goes here
        $config = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'valid_email',
                'errors' => array(
                    'valid_email' => '請輸入合法的 %s',
                )
            ),
            array(
                'field' => 'discount',
                'label' => '折抵天數',
                'rules' => 'greater_than[0]',
                'erros' => '%s需大於0'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE)
        {
            //Check User State
            if($this->session->userdata('Record')===null){
                $data['course'] = $this->course_model->get_enabled();
                $this->load->view('templates/header');
                $this->load->view('user/step1', $data);
                $this->load->view('templates/footer');
            }else{
                redirect('user/step2');
            }
            
        }
        else
        {
            $record = array(
                'Name' => $this->input->post('username'),
                'Grade' => $this->input->post('grade'),
                'StudentId' => $this->input->post('studentid'),
                'Email' => $this->input->post('email'),
                'DiscountDays' => $this->input->post('discount'),
                'BirthDate' => $this->input->post('birthdate'),
                'ApplyDate' => $this->input->post('applydate')
            );
            $course = $this->input->post('checked');
            $this->session->set_userdata('Record', $record);
            $this->session->set_userdata('Course', $course);
            redirect('user/step2');
        }
    }
    public function step2()
    {
        $this->load->helper('form');
        $data = array();
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        //Max Upload size 15MB
        $config['max_size']             = 15000;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        $config['file_ext_tolower']     = true;
        $config['encrypt_name']			= true;
        //Load upload library
        $session = $this->session->userdata('Record');
        if($session===null){
            redirect('user','location',301);exit();
        }else{
            if ($this->input->post('submit') !== null) {
                if (!empty($_FILES['upload']['name'])) {
                    $filesCount = count($_FILES['upload']['name']);
                    $data = $_FILES;
                    $filename = array();
                    for ($i = 0; $i < $filesCount; $i++) {
                        $_FILES['file']['name']     = $data['upload']['name'][$i];
                        $_FILES['file']['type']     = $data['upload']['type'][$i];
                        $_FILES['file']['tmp_name'] = $data['upload']['tmp_name'][$i];
                        $_FILES['file']['error']     = $data['upload']['error'][$i];
                        $_FILES['file']['size']     = $data['upload']['size'][$i];
    
                        $this->load->library('upload', $config);
                        //$this->upload->initialize($config);
    
                        if ($this->upload->do_upload('file')) {
                            // Uploaded file data
                            $fileData = $this->upload->data();
                            $filename[$i] = $fileData['file_name'];
                            //$uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
                        } else {
                            $msg = $this->upload->display_errors();
                            log_message('error',$msg);
                            show_error('上傳檔案發生錯誤，請回上一頁重試。'.$msg);
                            break;
                        }  
                    }
                    $this->session->set_userdata('File',$filename);
                    if($this->write()==true){
                        redirect('user/success');
                    }
                }
            }else if($this->input->post('reset') !== null){
                $this->resetsession(true);
            }else{
                $this->load->view('templates/header');
                $this->load->view('user/step2');
                $this->load->view('templates/footer');
            }
        }
        
    }
    public function write(){
        $record = $this->session->userdata('Record');
        $course = $this->session->userdata('Course');
        $filename = $this->session->userdata('File');
        if($record !== null){
            $rowid = $this->record_model->insert($record);
            if($rowid >0){
                $data['rowid'] = $rowid;
                $data['course'] = $course;
                $data['file'] = $filename;
                $this->recordcourse_model->insert($data);
                $this->recordimage_model->insert($data);
                $this->resetsession(false);
                return true;
            }else{
                show_error('操作逾時，請重新操作。');
            }
        }else{
            //set Record Err
            show_error('操作逾時，請重新操作。');
        }
    }
    public function success(){
        $this->load->view('templates/header');
        $this->load->view('user/success');
        $this->load->view('templates/footer');
    }
    public function resetsession($redirect = false){
        $this->session->unset_userdata('Record');
        $this->session->unset_userdata('Course');
        $this->session->unset_userdata('File');
        if($redirect){
            redirect('user/step1','location',301);
        }

    }
}