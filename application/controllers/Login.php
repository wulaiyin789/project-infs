<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
    }


    // Login function
    public function index() {

        // Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path'     => base_url().'assets/fonts/Roboto-Black.ttf',
            'img_width'     => '160',
            'img_height'    => 50,
            'expiration'    => 7200,
            'word_length'   => 4,
            'font_size'     => 50,
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
        );

        $captcha = create_captcha($config);
        $data['captcha_img'] = $captcha['image'];

        // Get values passe from form
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $cookiepass = $this->input->post('password');
        $remember = $this->input->post('customCheck1');
        $deleteCookie = $this->input->post('customCheck2');

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('captcha','Captcha','required|callback_validation_captcha');

        if($this->form_validation->run() == TRUE) {

            if ($remember) {
                $this->load->helper('cookie');

                $email_cookie = array(
                  'name' => 'email',
                  'value' => $email,
                  'expire' => '3600',
                  'path' => '/'
                );

                $this->input->set_cookie($email_cookie);

                $password_cookie = array(
                  'name' => 'password',
                  'value' => $password,
                  'expire' => '3600',
                  'path' => '/'
                );

                $this->input->set_cookie($password_cookie);       
            }

            if($deleteCookie) {
                delete_cookie('email');
                delete_cookie('password');
            }

            $data_login = array(
                'email'     =>  $this->input->post('email')
            );

            $result = $this->login_model->authenticate($data_login);

            // if($result == TRUE) {

            if($result > 0) {

                // $r = $this->login_model->session_login($data_login1);

                $data = $result->row_array();
                $session_data = array (
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'password' => $data['password']
                );

                // $this->session->set_userdata('email', $data_login['email']);

                if(password_verify($this->input->post('password'), $data['password'])) {
                    $this->session->set_userdata($session_data);
                    redirect(base_url(). "Profile/");
                } else {
                    redirect(base_url(). "Login/");
                }
                
            }
        } else {
            $this->session->set_userdata('captchaCode', $captcha['word']);
            $data['title']='Active! Login';
            $data['page']='login';
            $this->load->view('site', $data);
        }

    }

    // Reset Captcha
    public function refresh_capt(){
        // Captcha configuration, same as original setting
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path'     => base_url().'assets/fonts/Roboto-Black.ttf',
            'img_width'     => '160',
            'img_height'    => 50,
            'expiration'    => 7200,
            'word_length'   => 4,
            'font_size'     => 50,
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
        );

        $captcha = create_captcha($config);
        
        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);
        
        // Display captcha image
        echo $captcha['image'];
    }


    // Captcha validation
    public function validation_captcha() {
        if(strtolower($this->input->post('captcha')) != strtolower($this->session->userdata('captchaCode'))) {
            $this->session->set_flashdata('error_validation', 'The captcha did not matching');
            return redirect(base_url(). 'Login/');
        } else {
            return TRUE;
        }
    }  


    // Forget Password Page
    public function Forgetpass() {
        $data['title']='Active! Forget Password';
        $data['page']='forgetpass';
        $this->load->view('site', $data);
        $this->load->view('forgetpass');


    }

    // Reset and email link to the user
    public function resetlink() {
        $email = $this->input->post('email');
        $result = $this->db->query("SELECT * FROM users WHERE email = '" . $email . "'")->result_array();

        if(count($result) > 0) {

            $token = rand(1000, 9999);

            $this->db->query("UPDATE users SET password = '" . $token . "' WHERE email = '" . $email . "'");


            $this->load->library('email');

            $config = array(
                'protocol' => 'smtp',
                'smtp_crypto' => 'tls',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_port' => 465,
                'smtp_crypto' => 'ssl',
                'smtp_timeout' => '30',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE,
                'newline' => '\r\n',
                'crlf' => '\r\n',
            );

            $this->load->library('email', $config); 

            $this->email->initialize();

            $this->email->from('wulaiyin789@gmail.com', 'John Wick');
            $this->email->to($email);

            $this->email->subject('Reset Password');
            $this->email->message("Please click the below link to reset your password. '".base_url('Login/reset?token=').$token. "'");


            if($this->email->send()) {
                echo "Email sent";
                header("Refresh:5; url=Login");
            } else {
                echo $this->email->print_debugger();
            }

        } else {

            $this->session->set_flashdata('error', "Email cannot register!");

            header("Refresh:3; url=Login/forgetpass");

        }

    }


    // Reset Password Link
    public function reset() {

        $data['title']='Active! Set New Password';
        $data['page']='resetpass';
        $this->load->view('site', $data);
        $this->load->view('resetpass');

        $data['token'] = $this->input->get('token');
        $_SESSION['token'] = $data['token'];
    }

    // Update Password Function
    public function updatepass() {

        $_SESSION['token'];
        $data = $this->input->post();

        if($data['password'] == $data['cpassword']) {

            $this->db->query("UPDATE users SET password = '".$data['password']."' WHERE password = '".$_SESSION['token']."'");

            echo "Your password has been reset. You can login now!";
            header("Refresh:3; url=Login");

        } else {

            echo "Confirm password isn't match with your password! Try Again!";
            header("Refresh:3; url=Login/forgetpass");
        }

        header("Refresh:3; url=Login");
    }
}

?>