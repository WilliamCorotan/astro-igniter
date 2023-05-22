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
        $user_data = array(
            'username_email' => $this->input->post('username_email'),
            'password' => $this->input->post('password'),
        );

        $authenticated_user = $this->user->verify_user($user_data);

        if (!empty($authenticated_user)) {
            $this->session->set_userdata($authenticated_user);
            $this->session->set_userdata('is_logged_in', true);
            exit(json_encode($authenticated_user));
        } else {
            $json_response['login_errors'] = 'Invalid Credentials, Please Try Again!';
            exit(json_encode($json_response));
        }
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

    public function logout()
    {
        $session_data = array('id', 'username', 'email', 'password', 'profile_picture', 'created_at', 'updated_at', 'is_logged_in');
        $this->session->unset_userdata($session_data);

        $json_response['message'] = 'Logged out successfully!';
        exit(json_encode($json_response));
    }

    public function show_profile()
    {
        $data['overflow'] = 'overflow-y-scroll';
        $this->load->view('partials/auth/auth-header', $data);
        $this->load->view('pages/auth/profile');
        $this->load->view('partials/auth/auth-footer');
    }

    public function update_profile()
    {
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|callback_validate_unique_email');
        $this->form_validation->set_rules('old_password', 'password', 'required|min_length[8]|max_length[255]|callback_validate_password');
        $this->form_validation->set_rules('new_password', 'new password', 'required|min_length[8]|max_length[255]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');


        if ($this->form_validation->run() == FALSE) {
            $json_response['form_errors'] = $this->form_validation->error_array();
            exit(json_encode($json_response));
        } else {
            $enc_password = password_hash($this->input->post('new_password'), PASSWORD_BCRYPT);

            $form_data = array(
                'id' => $this->session->userdata('id'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => $enc_password,
            );
            $id = $this->session->userdata('id');
            $this->user->update($id, $form_data);

            $this->session->set_userdata($form_data);

            $json_response['message'] = 'Successfully updated user information!';
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

        if ($this->user->is_unique_email($email, $this->session->userdata('id'))) {
            return true;
        } else {
            return false;
        }
    }

    public function validate_password($password)
    {
        $this->form_validation->set_message('validate_password', 'Invalid password');

        if ($this->user->password_match($password)) {
            return true;
        } else {
            return false;
        }
    }
}
