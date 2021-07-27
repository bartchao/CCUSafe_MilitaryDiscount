<?php
class Record_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function get($id = FALSE)
        {
            if ($id === FALSE)
            {
                $sql = 'SELECT * FROM military_discount.records order by RecordId desc';
                $query = $this->db->query($sql);
                return $query->result_array();
            }
            $query = $this->db->get_where('records', array('RecordId' => $id));
            return $query->row_array();
        }
        public function update($array){

        }
        public function delete($array){
            foreach($array as $item){
                $this->db->delete('records', array('RecordId' => $item));
            }
            return $this->db->affected_rows();
        }
        public function insert($data)
        {
                //$slug = url_title($this->input->post('title'), 'dash', TRUE);
                
                $this->db->insert('records', $data);  
                return $this->db->insert_id();      
        }
}