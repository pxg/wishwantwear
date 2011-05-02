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
	
	function favouriteDress($userId, $dressId)
	{
		#TODO: could check if an entry already exists for this user and dress
		$data = array(
		   'user_id' => $userId,
		   'dress_id' => $dressId,
		);

		$this->db->insert('user_dress', $data);	
	}
	
	function getFavourites($userId)
	{
		$this->db->select('*');
		$this->db->from('dress');
		$this->db->join('user_dress', 'user_dress.dress_id = dress.id');
		$this->db->where('user_dress.user_id', $userId);
		$results = $this->db->get();
		
		// Convert into same format as the getAll result
		foreach ($results->result() as $row) {
			$return[] = $row;
		}
		return $return;
	}
}