<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

      
    public function index() {
        if ($this->session->userdata('login') == 1){
		// $this->load->view('admin/dashboard');
		 redirect(base_url() . 'admin/dashboard', 'refresh');
		}else{
		 $this->load->view('admin/login');
		}
          
       
    }
    function dashboard(){
		
	 if ($this->session->userdata('login') == 1){
		 
		    $data['users'] = $this->db->get('users')->result_array();
			$this->load->view('admin/dashboard', $data);
		    
		}else{
		 $this->load->view('admin/login');
		}	
	 	
		
	}
	
	function profile($id=''){
	   
	   if ($this->session->userdata('login') == 1){
		 
		    if(isset($_REQUEST['updateprofile'])){
		 	
			$upd['rating'] = $this->input->post('rating');
		    $upd['status'] = $this->input->post('status');
		    $id = $this->input->post('upid');
			
			   $this->db->where('id', $id);
               $this->db->update('users', $upd); 
			   
			   $msg="<span style='color:red'>Profile Updated</span>";	
			   $this->session->set_flashdata('error', $msg); 
			   redirect(base_url() . 'admin/dashboard', 'refresh');
			   
		    }
		
		 $data['users'] = $this->db->get_where('users', array('id' => $id))->result_array();
	 
	   $this->load->view('admin/view_profile', $data);
		    
		}else{
		 $this->load->view('admin/login');
		}	
			
	}
	
	
	function searchdata(){
		
		
		
	}
    function dologin() {
        $response = array();
          		   
        //Recieving post input of email, password from ajax request
        if ($_POST['email'] == '' || $_POST['password'] == '') {
            $data['msg'] = 'Empty Email OR Password';
			
            $this->load->view('admin/login', $data);
            
        }else{
			$email = $_POST["email"];
            $password = $_POST["password"];
            $response['submitted_data'] = $_POST;

        //Validating login
        $login_status = $this->validate_login($email, $password);
        $response['login_status'] = $login_status;
        if ($login_status != 'success') {
            $data['msg'] = 'Invalid Email OR Password';
			
            $this->load->view('admin/login', $data);
        } else {
			
            redirect(base_url() . 'admin', 'refresh');
        }

			
		}
        
        
    }

    function validate_login($email = '', $password = '') {

       
         $credential = array('email' => $email,'password' => $password);
        
        // Checking login credential for users
        $query = $this->db->get_where('admin', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $this->session->set_userdata('login', '1');
            $this->session->set_userdata('user_id', $row->id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('email', $row->email);
           return 'success';
        }

        return 'invalid';
    }

    function logout() {
        $this->session->unset_userdata('login');
        $this->session->unset_userdata('user_id');
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url().'admin', 'refresh');
    }

   function register(){
	   
	   if(isset($_REQUEST['register'])){
		   
		 $data['name'] = $this->input->post('name');
		 $data['email'] = $this->input->post('email');
		 $data['password'] = $this->input->post('password');
		 
		
		 $query = $this->db->get_where('admin', array('email' => $data['email'])); 
		  
           
		  if($query->num_rows() > 0){
			 $msg="<span style='color:red'>Email Id is present!</span>";	
			 $this->session->set_flashdata('error', $msg); 
			 redirect(base_url().'admin');
		  }else{
			$code =  mt_rand(1000,9999);
			$data['code']= $code;
			$data['status']= 0;
			
			$to      = $data['email'];
            $subject = 'Email Verification Code';
            $message = 'Your Email verification code is - '.$code;
            $headers = 'From: color@test.com' . "\r\n" .
             'Reply-To: color@test.com' . "\r\n" .
             'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);
			
			
		    $this->db->insert('admin', $data);
			$regid = $this->db->insert_id();
			$this->session->set_userdata('regid', $regid);
			
			$msg="<span style='color:red'>Enter Code Send to your email id!</span>";	
			$this->session->set_flashdata('error', $msg); 
			$this->load->view('admin/emailotp', $data);
			
		  }
		   
		   
	   }
	   
	   
   }

   
   function emailotp(){
	  if(isset($_POST['otpe'])){
		  
		   $code = $this->input->post('code');
		   $cid =  $this->session->userdata('regid');
		  $emailid = $this->db->get_where('admin', array('id' => $cid , 'code' => $code))->row()->email;
		  if($emailid ==''){
			 $msg="<span style='color:red'>Code is wrong!</span>";	
			 $this->session->set_flashdata('error', $msg); 
			 redirect(base_url().'admin');
		  }else{
			  $data['status']= 1 ;
			   $this->db->where('id', $cid);
               $this->db->update('admin', $data); 

	       $query = $this->db->get_where('admin', array('id' => $cid)); 
		  
           if ($query->num_rows() > 0) {
            $row = $query->row();

            $this->session->set_userdata('login', '1');
            $this->session->set_userdata('user_id', $row->id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('email', $row->email);
            redirect(base_url().'admin');
         }  
		 }
	  } 
	   
   }
   
}
