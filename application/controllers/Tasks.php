<?php

class Tasks extends CI_Controller
{

    /**
     * 
     * Shows dashboard
     * 
     */
    public function index()
    {
        $this->load->view('partials/auth/auth-header');
        $this->load->view('pages/tasks/index');
        $this->load->view('partials/auth/auth-footer');
    }


    /**
     * 
     * Shows form for creating a new data
     * 
     */
    public function create()
    {
    }

    /**
     * 
     * Stores data into database
     * 
     */
    public function store()
    {
        $data = array(
            'title' =>  $this->input->post('title'),
            'body' => $this->input->post('body'),
            'start_date' => $this->input->post('start_date'),
            'due_date' => $this->input->post('due_date'),
            'priority_level_id' => $this->input->post('priority_level'),
            'user_id' => $this->session->userdata('id'),
            'status_id' => 1,
        );
        $this->task->insert($data);
        $json_response['data'] = $data;

        exit(json_encode($json_response['data']));
    }

    /**
     * 
     * Shows a specific data
     * @param int $id
     * 
     */
    public function show($id)
    {
    }

    /**
     * 
     * Shows form for updating a specific data
     * @param int $id
     * 
     */
    public function edit($id)
    {
    }

    /**
     * 
     * Updates data and stores to database
     * @param int $id
     * 
     */
    public function update($id)
    {
    }

    /**
     * 
     * Deletes specific data from the database
     * @param int $id
     * 
     */
    public function destroy($id)
    {
    }

    public function get_all_by_user()
    {
        $json_response['data'] = $this->task->fetch_by_user($this->session->userdata('id'));
        exit(json_encode($json_response));
    }
}
