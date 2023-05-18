<?php

class Task extends CI_Model
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
        return $this->db->insert('tasks', $data);
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

    public function fetch_by_user($id)
    {

        $result = $this->db
            ->select('tasks.id, tasks.title, tasks.body, tasks.start_date, tasks.due_date, statuses.code as status_code, priority_levels.code as priority_level_code')
            ->from('tasks')
            ->where('user_id', $id)
            ->join('priority_levels', 'tasks.priority_level_id = priority_levels.id')
            ->join('statuses', 'tasks.status_id = statuses.id')
            ->order_by('priority_level_id', 'ASC')
            ->order_by('created_at', 'DESC')
            ->get();

        return $result->result();
    }
}
