<?php

class User extends CI_Model
{

    /**
     * 
     * Fetches all data from the database
     * 
     */
    public function get_all()
    {
    }

    /**
     * 
     * Fetch specific data from the database
     * @param int $id
     * 
     */
    public function get($id)
    {
    }

    /**
     * 
     * Inserts new data into database
     * @param array $data
     * 
     */
    public function insert($data)
    {
        return $this->db->insert('users', $data);
    }

    /**
     * 
     * Updates specific data in the database 
     * @param int $id
     * @param array $data
     * 
     */
    public function update($id, $data)
    {
    }

    /**
     * 
     * Deletes specific data in the database
     * @param int $id
     * 
     */
    public function delete($id)
    {
    }

    /**
     * 
     * Validates if the email is unique
     * @param string $email
     * @return boolean
     * 
     */
    public function is_unique_email($email)
    {
        $result = $this->db->get_where('users', array('email' => $email));
        if (empty($result->row_array())) {
            return true;
        }
        return false;
    }
}
