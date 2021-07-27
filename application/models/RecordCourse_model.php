<?php
class RecordCourse_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function get($id = FALSE)
        {
            if ($id === FALSE)
            {
                    $query = $this->db->get('records_course');
                    return $query->result_array();
            }
            $query = $this->db->get_where('records_course', array('id' => $id));
            return $query->row_array();
        }
        public function get_selected($id)
        {
			$sql = sprintf('SELECT a.CourseId,a.CourseName FROM `course` as a NATURAL JOIN `records_course` as b where b.RecordId = %d',$id);
			$query = $this->db->query($sql);
            return $query->result_array();
        }
        public function update($array){

        }
        public function delete($id){
            
        }
        public function insert($data)
        {
                $recordId = $data['rowid'];
                $checked = $data['course'];
                foreach($checked as $item)
                {
                    $insert = array(
                        'RecordId' => $recordId,
                        'CourseId' => $item  
                    );
                    $this->db->insert('records_course',$insert);
                }               
                return $this->db->insert_id(); 
        }
}