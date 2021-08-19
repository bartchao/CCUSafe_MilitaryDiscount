<?php
class Course_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function get($id = FALSE)
        {
            if ($id === FALSE)
            {
                    $query = $this->db->get('military_course');
                    return $query->result_array();
            }

            $query = $this->db->get_where('course', array('id' => $id));
            return $query->row_array();
        }
        //Show enabled course for user choose
        public function get_enabled()
        {
            $query = $this->db->get_where('military_course', array('Enable' => 1));
            return $query->result_array();
        }
        public function changestatus($id){
                $sql1 = sprintf('SELECT `Enable` FROM `military_course` where CourseId=%d;',$id);
                $query1 = $this->db->query($sql1)->row_array();
                $int = ($query1['Enable']==1 ? 0 : 1);
                $sql2 = sprintf('UPDATE `military_course` SET `Enable` = %d WHERE `military_course`.`CourseId` = %d',$int,$id);
                $query2 = $this->db->query($sql2);
                return $query2;
        }
        public function insert($name){
                $data = array(
                        'CourseName' => $name
                );
                $this->db->insert('military_course', $data);
                return $this->db->affected_rows();
        }
        public function delete($id){
            
        }
}