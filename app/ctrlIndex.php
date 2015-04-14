<?php

class ctrlIndex extends ctrl
{
	public function index()
	{
		$this->posts = $this->db->query('SELECT * FROM post ORDER BY ctime DESC')->all();

		$this->out('posts.php');
	}
}