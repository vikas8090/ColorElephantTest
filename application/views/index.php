<?php
include('header.php');

?>
<script type="text/javascript">

// Ajax post for refresh captcha image.
$(document).ready(function() {
$("a.refresh").click(function() {
jQuery.ajax({
type: "POST",
url: "<?php echo base_url(); ?>" + "user/captcha_refresh",
success: function(res) {
if (res)
{
jQuery("div.image").html(res);
}
}
});
});
});
</script>
<div class="content-wrapper" style="padding-top: 96px;">
 <section class="content-header">

 <div class="col-md-12" style="text-align:center;" >
	<h1>Submit Your Profile Here</h1>
	<?php 
	echo $this->session->flashdata('error');
	?>
 </div>
 
 </section>
 <!-- Main content -->
    <section class="content">
<div class="row">
<div class="col-md-3">
</div>
<div class="col-md-6">

<form method="post" action="<?php echo base_url(); ?>"  enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="" placeholder="Enter name" required>
   </div>
  <div class="form-group">
    <label for="email">Email Id</label>
    <input type="email" class="form-control" id="email" name="email" value="" placeholder="Enter email" required>
   </div>
  <div class="form-group">
    <label for="address">Web Address</label>
    <input type="text" class="form-control" id="webaddress" name="webaddress" value="" placeholder="Enter Web Address" required>
   </div>
   <div class="form-group">
    <label for="address">Cover Letter</label>
    <textarea rows="4" cols="50" name="coverletter" class="form-control" required></textarea>
    </div>
	<div class="form-group">
    <label for="address">Do You Like Working ?</label>
    <select class="form-control" id="working" name="working">
      <option value="Yes">Yes</option>
      <option value="No">No</option>
    </select>
   </div>
   <div class="form-group">
    <label for="cv">Attach CV</label>
    <input type="file" class="form-control-file" id="cvupload" name="cvupload">
    </div>
    <div class="form-group">
	<div class='image'>
    <?php echo $image; ?>
	</div>
    <label for='message'>Enter the code above here :</label>
	 <input id="captcha_code" class="form-control" name="captcha_code" type="text" required>
	  Can't read the image? click <a id="refreshcap" class ='refresh' href='#'><b>here</b></a> to refresh.
    </div>
 <button type="submit" name="submitprofile" class="btn btn-primary">Submit</button>
</form>
</div>
<div class="col-md-3">
</div>
</div>
</section>
</div>
<?php
include('footer.php');

?>