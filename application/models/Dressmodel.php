<?php
class Dressmodel extends CI_Model {

    // var $title   = '';
    // var $content = '';
    // var $date    = '';

    function __construct()
    {
        parent::__construct();
    }
    
    function getAll()
    {
        $query = $this->db->get('dress');
        return $query->result();
    }

	function getOne($id)
	{
		$query = $this->db->get_where('dress', array('id' => $id));
		$result = $query->result();
		if(isset($result[0])){
			return $result[0];
		}else{
			return false;
		}
	}

    // function insert_entry()
    // {
    //     $this->title   = $_POST['title']; // please read the below note
    //     $this->content = $_POST['content'];
    //     $this->date    = time();
    // 
    //     $this->db->insert('entries', $this);
    // }
    // 
    // function update_entry()
    // {
    //     $this->title   = $_POST['title'];
    //     $this->content = $_POST['content'];
    //     $this->date    = time();
    // 
    //     $this->db->update('entries', $this, array('id' => $_POST['id']));
    // }

}