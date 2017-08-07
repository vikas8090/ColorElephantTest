<?php
include('header.php');

?>
<div class="content-wrapper" style="padding-top: 96px;">
 <section class="content-header">

 <div class="col-md-12" style="text-align:center;" >
	<h1>View Profile And Rate the Profile</h1>
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

<form method="post" action="<?php echo base_url(); ?>login/profile"  enctype="multipart/form-data">
  
   <?php 
   
   foreach($users as $row){?>
     <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" readonly value="<?php echo $row['name']; ?>" >
    </div>
	
	 <div class="form-group">
    <label for="email">Email Id</label>
    <input type="email" class="form-control" id="email" name="email" readonly value="<?php echo $row['email']; ?>" >
   </div>
   
    <div class="form-group">
    <label for="address">Web Address</label>
    <input type="text" class="form-control" id="webaddress" name="webaddress" readonly value="<?php echo $row['webaddress'];  ?>" >
   </div>
   <div class="form-group">
    <label for="address">Cover Letter</label>
    <textarea rows="4" cols="50" name="coverletter" readonly class="form-control"><?php echo $row['coverletter']; ?></textarea>
    </div>
	
	<div class="form-group">
    <label for="address">Do You Like Working ?</label>
    <select class="form-control" id="working" name="working">
      <option value="Yes" <?php if($row['working']=='Yes'){echo 'selected';} ?>>Yes</option>
      <option value="No" <?php if($row['working']=='No'){echo 'selected';} ?>>No</option>
    </select>
   </div>
   <div class="form-group">
    <label for="address">IP</label>
    <input type="text" class="form-control" readonly id="ip" name="ip" value="<?php echo $row['ip'];  ?>" >
   </div>
   <div class="form-group">
    <label for="address">Location</label>
    <input type="text" class="form-control" readonly id="location" name="location" value="<?php echo $row['location'];  ?>" >
   </div>
    <div class="form-group">
    <label for="address">Date</label>
    <input type="text" class="form-control" readonly id="date" name="date" value="<?php echo $row['date'];  ?>" >
   </div>
   <div class="form-group">
    <label for="address">Rate The Profile</label>
    <select class="form-control" id="rating" name="rating">
      <option value="1" <?php if($row['rating']=='1'){echo 'selected';} ?>>1 Star</option>
      <option value="2" <?php if($row['rating']=='2'){echo 'selected';} ?>>2 Star</option>
	  <option value="3" <?php if($row['rating']=='3'){echo 'selected';} ?>>3 Star</option>
      <option value="4" <?php if($row['rating']=='4'){echo 'selected';} ?>>4 Star</option>
	   <option value="5" <?php if($row['rating']=='5'){echo 'selected';} ?>>5 Star</option>
	  
    </select>
   </div>
   <div class="form-group">
    <label for="address">Status</label>
    <select class="form-control" id="status" name="status">
      <option value="1" <?php if($row['status']=='1'){echo 'selected';} ?>>Active</option>
      <option value="0" <?php if($row['status']=='0'){echo 'selected';} ?>>Deactive</option>
	  
	  
    </select>
	<input type="hidden" name="upid" value="<?php echo $row['id']; ?>">
   </div>
  <?php }
   ?>
  
  <button type="submit" name="updateprofile" class="btn btn-primary">Update</button>
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