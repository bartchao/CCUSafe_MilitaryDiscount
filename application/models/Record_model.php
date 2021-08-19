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
                //Fake Delete,so choose not delete one.
                $sql = 'SELECT * FROM military_records where `Delete`=0 order by RecordId desc';
                $query = $this->db->query($sql);
                return $query->result_array();
            }
            $query = $this->db->get_where('military_records', array('RecordId' => $id));
            return $query->row_array();
        }
        public function update($array){

        }
        public function delete($item){
			//For REal Database Delete
			// foreach($item as $id){
            // $this->db->delete('military_records', array('RecordId' => $id));
			// }
            // return $this->db->affected_rows();
			//Fake Delete (Hide)
			foreach($item as $id){
				$sql1 = sprintf('SELECT `Delete` FROM `military_records` where RecordId=%d;',$id);
                $query1 = $this->db->query($sql1)->row_array();
                $int = ($query1['Delete']==1 ? 0 : 1);
                $sql2 = sprintf('UPDATE `military_records` SET `Delete` = %d WHERE `military_records`.`RecordId` = %d',$int,$id);
                $query2 = $this->db->query($sql2);
                return $query2;

			}
            return $this->db->affected_rows();
        }
        public function insert($data)
        {
                //$slug = url_title($this->input->post('title'), 'dash', TRUE);
                
                $this->db->insert('military_records', $data);  
                return $this->db->insert_id();      
        }
}