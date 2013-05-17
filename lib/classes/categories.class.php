<?php

class Categories extends General
{
	
	public $name;

	public function fetchCategories()
	{

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$result = $db->query('
		SELECT *
		FROM categories
		ORDER BY addedDate DESC
		');
		
		$totalRows = $result->num_rows;
		
		$results = array();
		
		if($totalRows > 0)
		{
		
			while($row = $result->fetch_object())
			{
			
				array_push($results, array(
					'ID' => $row->ID,
					'name' => stripslashes($row->name),
					'description' => stripslashes($row->description),
					'addedDate' => $row->addedDate
				));
			
			}
		
		}
		
		return $results;
			
	}
	
	public function fetchCategory()
	{
	
		$ID = $this->getVar('get', 'ID');

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$result = $db->query('
		SELECT *
		FROM categories
		WHERE ID = "'.$ID.'"
		LIMIT 1
		');
		
		$totalRows = $result->num_rows;
		
		$results = array();
		
		if($totalRows > 0)
		{
		
			while($row = $result->fetch_object())
			{
			
				$results = array(
					'ID' => $row->ID,
					'name' => stripslashes($row->name),
					'description' => stripslashes($row->description)
				);
			
			}
		
		}
		
		return $results;
		
	}

	public function categoryExists()
	{

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$result = $db->query('
		SELECT ID
		FROM categories
		WHERE name = "'.$this->name.'"
		LIMIT 1
		');
		
		return (bool)$result->num_rows;
		
	}
	
	public function saveCategory()
	{
		
		$ID = $this->getVar('post', 'ID');
		$name = $this->getVar('post', 'name');
		$description = $this->getVar('post', 'description');

		if($name == ''){ $this->jsonReply(false, 'Enter a name');}
		if($description == ''){ $this->jsonReply(false, 'Enter a description');}
		
		$this->save(array(
			'ID' => $ID,
			'name' => $name,
			'description' => $description
		));
		
		$this->jsonReply(true, 'Category saved');
		
		$this->setNotification('Updated category');
		
	}
	
	public function newCategory()
	{
		
		$name = $this->getVar('post', 'name');
		$description = $this->getVar('post', 'description');
		
		$this->name = $name;
		
		if($this->categoryExists()){ $this->jsonReply(false, 'Category is taken');}
		if($name == ''){ $this->jsonReply(false, 'Enter a name for the category');}
		if($description == ''){ $this->jsonReply(false, 'Enter a description for the category');}
		
		$this->create(array(
			'name' => $name,
			'description' => $description,
			'addedDate' => $this->datetime()
		));
		
		$this->setNotification('Created new category');
		
		$this->jsonReply(true, 'Category created');
		
	}
	
	private function save($fields)
	{
		
		extract($fields);

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$result = $db->query('
		UPDATE categories
		SET
		name = "'.$name.'",
		description = "'.$description.'"
		WHERE ID = "'.$ID.'"
		');
		
		$this->handleResult($result);
		
		return true;
		
	}
	
	private function create($fields)
	{
		
		extract($fields);

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$result = $db->query('
		INSERT INTO categories
		(
		name,
		description, 
		addedDate
		)
		VALUES
		(
		"'.$name.'",
		"'.$description.'",
		"'.$this->datetime().'"
		)
		');
		
		$this->handleResult($result);
		
	}
	
	public function deleteCategory()
	{
	
		$ID = $this->getVar('post', 'ID');
		
		if(!is_numeric($ID)){ $this->jsonReply(false, 'Oh no you don\'t!');}
		
		$this->delete($ID);
		
		$this->jsonReply(true, 'Category deleted');
		
		$this->setNotification('Deleted category');
		
	}
	
	private function delete($ID)
	{

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$result = $db->query('
		DELETE FROM categories
		WHERE ID = "'.$ID.'"
		');
		
		$this->handleResult($result);
		
		return true;
		
	}

}