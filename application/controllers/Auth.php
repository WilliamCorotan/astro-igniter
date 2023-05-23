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

        exit(json_encode(array("name" => 'test')));
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
        if (empty($this->session->userdata('is_logged_in'))) {
            redirect('login');
        }

        $data['overflow'] = 'overflow-y-scroll';
        $this->load->view('partials/auth/auth-header', $data);
        $this->load->view('pages/auth/profile');
        $this->load->view('partials/auth/auth-footer');
    }

    public function upload_profile_picture()
    {
        if (empty($this->session->userdata('is_logged_in'))) {
            redirect('login');
        }

        $config['upload_path'] = './assets/images/profile_pictures/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '5120000';

        $this->upload->initialize($config);


        if ($this->upload->do_upload('file')) {
            $file_name = $this->upload->data('file_name');
            $this->user->update($this->session->userdata('id'), array('profile_picture' => $file_name));
            $this->session->set_userdata('profile_picture', $file_name);
            $json_response['message'] = 'Successfully updated profile picture!';
            $json_response['file_name'] = $file_name;
            exit(json_encode($json_response));
        } else {
            $errors = array('error' => $this->upload->display_errors());
            $json_response['message'] = $errors;
            exit(json_encode($json_response));
        }
    }



    public function update_profile()
    {
        if (empty($this->session->userdata('is_logged_in'))) {
            redirect('login');
        }

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
        if (empty($this->session->userdata('is_logged_in'))) {
            redirect('login');
        }

        $this->form_validation->set_message('validate_password', 'Invalid password');

        if ($this->user->password_match($password)) {
            return true;
        } else {
            return false;
        }
    }
}
