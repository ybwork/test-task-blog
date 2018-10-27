<?php

namespace implementing\models;

use \interfaces\models\Model;

class ModelImp implements Model
{
	/**
	 * Gets all records from db
	 *
	 * @return array data or status code
	 */
	public function get_all()
	{
		$db = $this->db_connection->get_connection();

       	$sql = "SELECT id, $this->fields FROM $this->table_name ORDER BY id DESC";

       	$query = $db->prepare($sql);

		if ($query->execute()) {
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		} else {
			http_response_code(500);
			$this->validator->check_response();
		}
	}

	/**
	 * Gets all record from db by offset/limit
	 *
	 * @param $offset - place for start
	 * @param $limit - record number limit
	 * @return array data or status code
	 */
	public function get_all_by_offset_limit(int $offset, int $limit)
	{
		$db = $this->db_connection->get_connection();

        $sql = "SELECT id, $this->fields FROM $this->table_name ORDER BY id DESC LIMIT :offset, :limit";

       	$query = $db->prepare($sql);

       	$query->bindValue(':offset', $offset, \PDO::PARAM_INT);
       	$query->bindValue(':limit', $limit, \PDO::PARAM_INT);

		if ($query->execute()) {
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		} else {
			http_response_code(500);
			$this->validator->check_response();
		}
	}

	/**
	 * Saves data to db
	 * 
	 * @param $data - data for save
	 * @return status code and response in json or only status code
	 */
	public function create(array $data)
	{
        $data = $this->validator->validate($data, $this->rules_validation);

        $db = $this->db_connection->get_connection();
        
	    $sql = "INSERT INTO $this->table_name ($this->fields) VALUES ($this->binding_fields_for_create)";

	    $query = $db->prepare($sql);

	    $binding_fields = explode(', ', $this->fields);
	    foreach ($binding_fields as $binding_field) {
	    	$query->bindValue(":$binding_field", $data[$binding_field]);
	    }

	    if ($query->execute()) {	    	
			header('HTTP/1.0 200 OK', http_response_code(200));

			$response['message'] = 'Готово';
			$response['data'] = $data;

			echo json_encode($response);
			return true;
	    } else {
			http_response_code(500);
			$this->validator->check_response('ajax');	
	    }
	}

	/**
	 * Gets data from db
	 * 
	 * @param $id - field for sampling
	 * @return array data or status code
	 */
	public function show(int $id)
	{
		$db = $this->db_connection->get_connection();

		$sql = "SELECT id, $this->fields FROM $this->table_name WHERE id = :id";

		$query = $db->prepare($sql);

		$query->bindValue(':id', $id);

		if ($query->execute()) {
			return $query->fetch(\PDO::FETCH_ASSOC);
		} else {
			http_response_code(500);
			$this->validator->check_response('ajax');
		}	
	}

	/**
	 * Updates selected data from db
	 * 
	 * @param $data - data for update
	 * @return status code and response in json or only status code
	 */
    public function update(array $data)
    {
        $data = $this->validator->validate($data, $this->rules_validation);

        $db = $this->db_connection->get_connection();

        $sql = "UPDATE $this->table_name SET $this->binding_fields_for_update WHERE id = :id";

        $query = $db->prepare($sql);

        $query->bindValue(':id', $data['id'], \PDO::PARAM_INT);
        $binding_fields = explode(', ', $this->fields);
        foreach ($binding_fields as $binding_field) {
        	$query->bindValue(":$binding_field", $data[$binding_field]);
        }

        if ($query->execute()) {        	
			header('HTTP/1.0 200 OK', http_response_code(200));

			$response['message'] = 'Готово';
			$response['data'] = $data;

			echo json_encode($response);
			return true;
        } else {

			http_response_code(500);
			$this->validator->check_response('ajax');
        }
    }

	/**
	 * Deletes selected data from db
	 * 
	 * @param $id - unique number record for delete
	 * @return status code and response in json or only status code
	 */
    public function delete(int $id)
    {
		$db = $this->db_connection->get_connection();

		$sql = "DELETE FROM $this->table_name WHERE id = :id";

		$query = $db->prepare($sql);

		$query->bindValue(':id', $id, \PDO::PARAM_INT);

		if ($query->execute()) {			
    		header('HTTP/1.0 200 OK', http_response_code(200));

			$response['message'] = 'Готово';

			echo json_encode($response);
			return true;	
		} else {			
    		http_response_code(500);
    		$this->validator->check_response('ajax');
		}
    }

	/**
	 * Counts data to db
	 * 
	 * @return array data or status code
	 */
	public function count()
	{
		$db = $this->db_connection->get_connection();
		
		$sql = "SELECT COUNT(*) FROM $this->table_name";

		$query = $db->prepare($sql);

		if ($query->execute()) {
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		} else {
			http_response_code(500);
			$this->validator->check_response();
		}
	}
}

