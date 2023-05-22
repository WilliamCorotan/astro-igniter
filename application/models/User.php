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
        return $this->db->update('users', $data, array('id' => $id));
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
    public function is_unique_email($email, $id)
    {
        $query = $this->db->get_where('users', array('email' => $email));
        $result = $query->row_array();

        if (empty($result)) {
            return true;
        } else if ($result['id'] === $id) {
            return true;
        }

        return false;
    }

    /**
     * 
     * Verify if the user login credentials matches the database
     * @param array $user_data
     * @return array $result | []
     * 
     */
    public function verify_user($user_data)
    {

        $result = $this->db
            ->select('*')
            ->from('users')
            ->where('username', $user_data['username_email'])
            ->or_where('email', $user_data['username_email'])
            ->get()
            ->row_array();
        if (!empty($result)) {
            if (password_verify($user_data['password'], $result['password'])) {

                return $result;
            } else {

                return [];
            }
        }
    }

    public function password_match($password)
    {
        $result = $this->db
            ->select('*')
            ->from('users')
            ->where('id', $this->session->userdata('id'))
            ->get()
            ->row_array();
        if (!empty($result)) {
            if (password_verify($password, $result['password'])) {
                return $result;
            } else {
                return [];
            }
        }
    }
}
