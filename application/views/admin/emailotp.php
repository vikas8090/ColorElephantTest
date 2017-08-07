<?php
include('header.php');

?>

    <div class="container" style="padding-top: 96px;">
        <div class="row" style="margin: 0px auto; text-align: center;">
             <div>
			 <h2>Email Verification</h2>
			       <?php 
	                echo $this->session->flashdata('error');
	                ?>
                        <form role="form" name='emailotp' method="post" action="<?php echo base_url(); ?>login/emailotp">
                            <fieldset>
                                <div class="form-group">
                                  Enter Code -   <input  placeholder="Enter Code" class="form-control" name="code" type="text" required>
                                </div>
								
								<br>
                                <input type="submit" class="btn btn-primary" name='otpe'  value='Submit'>
                               
                                
                            </fieldset><div id='status' style='color:white'></div>
                        </form>
          </div>
		  
    </div>
</div>

</body>

</html>





