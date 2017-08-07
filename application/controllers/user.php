<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	
	public function index()
	{
	
     if(isset($_REQUEST['submitprofile'])){
		 
		 $data['name'] = $this->input->post('name');
		 $data['email'] = $this->input->post('email');
		 $data['webaddress'] = $this->input->post('webaddress');
		 $data['coverletter'] = $this->input->post('coverletter');
		 $data['working'] = $this->input->post('working');
		 $captcha_code = $this->input->post('captcha_code');
		 
		 if($data['name'] !='' && $data['email'] !='' && $data['webaddress'] !='' && $data['coverletter'] !=''){
			
			 if(strcasecmp($_SESSION['captchaWord'], $captcha_code) != 0){  
		        $msg="<span style='color:red'>The Validation code does not match!</span>";// Captcha verification is incorrect.	
                $this->session->set_flashdata('error', $msg); 
                redirect(base_url());				
	        }else{
				
				$folder = "Resume/";
				$temp = explode(".", $_FILES["cvupload"]["name"]);
				$newfilename = round(microtime(true)).'.'. end($temp);
				$db_path ="$folder".$newfilename  ;
				$listtype = array(
				'.doc'=>'application/msword',
				'.docx'=>'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				'.rtf'=>'application/rtf',
				'.pdf'=>'application/pdf'); 
				$address = array();
				if (is_uploaded_file( $_FILES['cvupload']['tmp_name'] ) )
				{
				if($key = array_search($_FILES['cvupload']['type'],$listtype))
				{
				if (move_uploaded_file($_FILES['cvupload']  ['tmp_name'],"$folder".$newfilename))
				{
				$data['cvupload'] = $newfilename ;	
				$data['ip'] = getRealIpAddr();	
					
				$address = getLocationInfoByIp() ;	
				
                $data['location'] = $address['city'].' '.$address['Region'].' '.$address['country'];
                $data['date'] = date('Y-m-d');
                $data['status']='1';	
				 
                $emailid = $this->db->get_where('users', array('email' => $data['email']))->row()->email;
				if($emailid !=''){
				 $msg="<span style='color:red'>Email Id is present </span>";	
				 $this->session->set_flashdata('error', $msg); 
				 redirect(base_url());
				}else{
				 $this->db->insert('users', $data);
				}
				
					
				 $msg="<span style='color:red'>Profile Submitted </span>";	
				 $this->session->set_flashdata('error', $msg); 
				 
				 redirect(base_url());
				}
				}
				else    
				{
				  $msg="<span style='color:red'>File Type Should Be .Docx or .Pdf  Or .Doc</span>";
				  $this->session->set_flashdata('error', $msg);
                  redirect(base_url());				  
			
				}
				}else{
				   $msg="<span style='color:red'>Upload Your CV</span>";	
				   $this->session->set_flashdata('error',  $msg); 
                   redirect(base_url());				  
				} 	
				
			}
			 
			}else{
			 $msg="<span style='color:red'>All Fileds Are Required</span>";	
			 $this->session->set_flashdata('error', $msg); 
			redirect(base_url()); 
		 }
		 
		 }else{
			 
	        $values = array(
			'word' => '',
			'word_length' => 8,
			'img_path' => './images/',
			'img_url' => base_url() .'images/',
			'font_path' => base_url() . 'system/fonts/texb.ttf',
			'img_width' => '150',
			'img_height' => 50,
			'expiration' => 3600
			);
         $data = create_captcha($values);
        $_SESSION['captchaWord'] = $data['word'];		 
	   $this->load->view('index',$data);	 
	 }	
		
	
	}
	
	public function captcha_refresh(){
		$values = array(
		'word' => '',
		'word_length' => 8,
		'img_path' => './images/',
		'img_url' => base_url() .'images/',
		'font_path' => base_url() . 'system/fonts/texb.ttf',
		'img_width' => '150',
		'img_height' => 50,
		'expiration' => 3600
		);
		$data = create_captcha($values);
		$_SESSION['captchaWord'] = $data['word'];
		echo $data['image'];

		}
}

function getRealIpAddr()
    {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
   }
   
   function getLocationInfoByIp(){

    $client  = @$_SERVER['HTTP_CLIENT_IP'];

    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];

    $remote  = @$_SERVER['REMOTE_ADDR'];

    $result  = array('country'=>'', 'city'=>'','Region'=>'');

    if(filter_var($client, FILTER_VALIDATE_IP)){

        $ip = $client;

    }elseif(filter_var($forward, FILTER_VALIDATE_IP)){

        $ip = '47.8.1.173';

    }else{

        $ip = '47.8.1.173';

    }

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));    

    if($ip_data && $ip_data->geoplugin_countryName != null){

        $result['country'] = $ip_data->geoplugin_countryName;
        $result['city'] = $ip_data->geoplugin_city;
		$result['Region'] = $ip_data->geoplugin_region;
		

    }

    return $result;

   }