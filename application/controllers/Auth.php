<?php

/**
 * 
 * @property CI_Input $input
 * @property CI_Form_Validation $form_validation
 * 
 */
class Auth extends CI_Controller
{
    /**
     * 
     * Loads the login page
     * 
     */
    public function show_login()
    {

        $this->load->view('partials/header');
        $this->load->view('pages/auth/login');
        $this->load->view('partials/footer');
    }

    /**
     * 
     * Loads the register page
     * 
     */
    public function show_register()
    {
        $this->load->view('partials/header');
        $this->load->view('pages/auth/register');
        $this->load->view('partials/footer');
    }

    /**
     * 
     * Receives a POST HTTP request to login the user
     * 
     */
    public function login()
    {
        echo json_encode($this->input->post());
    }

    /**
     * 
     * Receives a POST HTTP request to login the user
     * 
     */
    public function register()
    {
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|callback_validate_unique_email');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[8]|max_length[255]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $json_response['form_errors'] = $this->form_validation->error_array();
            exit(json_encode($json_response));
        } else {
            $enc_password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

            $form_data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => $enc_password,
                'profile_picture' => 'user-avatar.png'
            );
            $this->user->insert($form_data);
            $json_response['message'] = 'Registered Successfully!';
            exit(json_encode($json_response));
        }
    }

    /**
     * 
     * Validates if the email is unique
     * @param string $email
     * @return boolean
     * 
     */
    public function validate_unique_email($email)
    {
        $this->form_validation->set_message('validate_unique_email', 'This email is taken.');

        if ($this->user->is_unique_email($email)) {
            return true;
        } else {
            return false;
        }
    }
}
