<?php
class Admin extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('record_model');
                $this->load->model('course_model');
                $this->load->model('recordimage_model');
                $this->load->model('recordcourse_model');
                $this->load->library('session');
                $this->load->helper('url_helper');
                $this->load->helper(array('form', 'url',));
        }
        public function login(){
            if($this->input->post('submit')){
                if($this->input->post('username')==='CCUSafe' && $this->input->post('password')==='CCUSafe@'){
                    $this->session->set_userdata('admin',true);
                    redirect('admin/index');
                }else{
                    show_error('登入錯誤');
                }
            }else{
                if ($this->session->userdata('admin')===true) {
                    redirect('admin/index');
                }else{
                    $this->load->view('templates/header_admin_login');
                    $this->load->view('admin/login');
                    $this->load->view('admin/updatelog');
                    $this->load->view('templates/footer');
                }
            }
        }
        public function index()
        {
            if($this->session->userdata('admin')===true){
                $data['record'] = $this->record_model->get();
                $this->load->view('templates/header_admin');
                $this->load->view('admin/index', $data);
                $this->load->view('templates/footer');
            }else{
                redirect('admin');
            }
            
        }

        public function view($id = NULL)
        {
            if ($this->session->userdata('admin')===true) {
                if ($id !== null) {
                    $data['record_item'] = $this->record_model->get($id);
                    $data['record_item_course'] = $this->recordcourse_model->get_selected($id);
                    $data['record_item_images'] = $this->recordimage_model->get($id);
                    if (empty($data['record_item'])) {
                        show_404();
                    }
                    $this->load->view('templates/header_admin');
                    $this->load->view('admin/view', $data);
                    $this->load->view('templates/footer');
                } else {
                    show_404();
                }
            }else{
                redirect('admin');
            }
        }
        public function course_index(){
            if ($this->session->userdata('admin')===true) {
                $data['course'] = $this->course_model->get();
                $this->load->view('templates/header_admin');
                $this->load->view('admin/course', $data);
                $this->load->view('templates/footer');
            }else{
                redirect('admin');
            }
        }
        public function enable_course($id = FALSE){
            if ($this->session->userdata('admin')===true) {
                if ($id !== false) {
                    $result = $this->course_model->changestatus($id);
                    if ($result===true) {
                        redirect('admin/course');
                        exit();
                    } else {
                        show_error('Change Course Status Error!');
                        exit();
                    }
                }
            }else{
                redirect('admin');
            }
        }
        public function addcourse(){
            if ($this->session->userdata('admin')===true) {
                $this->load->helper('form');
                $name = $this->input->post('addcourse');
                $result = $this->course_model->insert($name);
                if ($result>0) {
                    redirect('admin/course');
                    exit();
                } else {
                    show_error('Insert Course Error!');
                }
            }else{
                redirect('admin');
            }
        }
        public function delete(){
            if ($this->session->userdata('admin')===true) {
                $data =  $this->input->post('options');
                if ($data!==null) {
					//$this->recordimage_model->delete($data);
                    $rows = $this->record_model->delete($data);
                    redirect('admin/index');
                }else{
					show_error('無資料被刪除');
				}
            }else{
                redirect('admin');
            }
        }
        public function logout(){
            $this->session->unset_userdata('admin');
            redirect('admin');
        }
		public function export($id = false){
            if($id!=false){
                $this->load->library('pdf');
                $data['record_item'] = $this->record_model->get($id);
                if($data['record_item']!=null){
                    $data['record_item_course'] = $this->recordcourse_model->get_selected($id);
                    $data['record_item_images'] = $this->recordimage_model->get($id);
                    $html = $this->load->view('CreatePdfView', $data, true);
					$name = $data['record_item']['StudentId'];
                    $this->pdf->createPDF($html, $name, true);
				}else{
                //Error!
					show_error('找不到此資料');

				}
			}
        }
}