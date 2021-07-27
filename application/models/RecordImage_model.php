<?php
class RecordImage_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
        }
        public function get($id = FALSE)
        {
            if ($id === FALSE)
            {
                    $query = $this->db->get('records_images');
                    return $query->result_array();
            }
            $query = $this->db->get_where('records_images', array('RecordId' => $id));
            return $query->result_array();
        }
        
        public function update($array){

        }
        public function delete($id){
            
        }
        public function insert($data)
        {
                $recordId = $data['rowid'];
                $filename = $data['file'];
                foreach($filename as $item)
                {
                    $insert = array(
                        'RecordId' => $recordId,
                        'ImagePath' => $item  
                    );
                    $this->db->insert('records_images',$insert);
                }               
                return $this->db->insert_id(); 
        }
}