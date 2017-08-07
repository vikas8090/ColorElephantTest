<?php
include('header.php');

?>

    <div class="container" style="padding-top: 96px;">
        <div class="row" style="margin: 0px auto; text-align: center;">
             <div>
			 <h2>Login</h2>
			    <div style='color:red;text-align: center;'><h6><?php if(isset($msg))echo $msg;?></h6></div>
                        <form role="form" name='loginfrm' method="post" action="<?php echo base_url(); ?>login/dologin">
                            <fieldset>
                                <div class="form-group">
                                  Email -   <input  placeholder="Email" class="form-control" name="email" type="text" autofocus>
                                </div>
								<br>
                                <div class="form-group">
                                 Password -    <input  placeholder="Password" class="form-control" name="password" type="password" value="">
                                </div>
								<br>
                                <input type="submit" class="btn btn-primary" name='login'  value='Sign in'>
                               
                                
                            </fieldset><div id='status' style='color:white'></div>
                        </form>
          </div>
		   <div class="row" style="margin: 0px auto; text-align: center;">
             <div>
			 <h2>Register</h2>
			      <?php 
	              echo $this->session->flashdata('error');
	              ?>
                        <form role="form" name='registerform' method="post" action="<?php echo base_url(); ?>login/register">
                            <fieldset>
							   <div class="form-group">
                                  Name -   <input  placeholder="Name" class="form-control" name="name" type="text" required>
                                </div>
								<br>
                                <div class="form-group">submitregister
                                  Email -   <input  placeholder="Email" class="form-control" name="email" type="email" required>
                                </div>
								<br>
                                <div class="form-group">
                                 Password - <input  placeholder="Password" class="form-control" name="password" type="password" value="" required>
                                </div>
								<br>
                                <input type="submit" class="btn btn-primary" name='register'  value='Register'>
                               
                                
                            </fieldset>
							<div id='status' style='color:white'></div>
                        </form>
          </div>
        </div>
    </div>


</body>

</html>





