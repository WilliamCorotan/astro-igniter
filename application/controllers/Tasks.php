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
}
