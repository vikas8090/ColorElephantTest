<?php
include('header.php');

?>
<style>


.results tr[visible='false'],
.no-result{
  display:none;
}

.results tr[visible='true']{
  display:table-row;
}

.counter{
  padding:8px; 
  color:#ccc;
}
</style>
<div class="content-wrapper" style="padding-top: 96px;">
<form role="form" name='loginfrm' method="post" action="<?php echo base_url(); ?>login/logout">
    <fieldset>
                                
   <input type="submit" name='logout' class="btn btn-primary"  value='LogOut'>
                               
                                
    </fieldset><div id='status'  style='color:white'></div>
</form>
 <section class="content-header">

 <div class="col-md-12" style="text-align:center;" >
	<h1>Profile Data of Users</h1>
	<?php 
	echo $this->session->flashdata('error');
	?>
<form name="search" id="searchform">
     <div class="col-md-4" style="text-align:center;" >
    <div class="form-group">
    <label for="search"><b>Search</b></label>
    <input type="text" class="search form-control" id="search" name="search"  value="">
	<br>
	<span class="counter pull-right"></span>
	
    </div>
    </div>

</form>	
 </div>
 
 </section>
 <!-- Main content -->
    <section class="content">
<div class="row">

<div class="col-md-12" id="tabledata">
 <table class="table table-hover table-bordered results">
 <thead>
 <tr><th>Sr.No.</th><th>Name</th><th>Email</th><th>Webaddress</th><th>Coverletter</th><th>Working</th><th>IP</th>
 <th>Location</th><th>Date</th><th>CV</th><th>Action</th> </tr>
 <tr class="warning no-result">
      <td colspan="11"><i class="fa fa-warning"></i> No result</td>
 </tr>
 </thead>
 <tbody>
 <?php
 $s=1;
 foreach($users as $row){
	  
 	echo '<tr><td scope="row">'.$s.'</td><td>'.$row['name'].'</td><td>'.$row['email'].'</td><td>'.$row['webaddress'].'</td>
	<td>'.$row['coverletter'].'</td><td>'.$row['working'].'</td><td>'.$row['ip'].'</td><td>'.$row['location'].'</td>
	<td>'.$row['date'].'</td><td><a target="_blank" href="'.base_url().'Resume/'.$row['cvupload'].'">Download CV</a></td>
	<td><a target="_blank" href="'.base_url().'admin/view_profile/'.$row['id'].'">View Profile & Rate</a></td></tr>';
$s++;	
 }
 ?>
 </tbody>

 </table>

</div>

</div>
</section>
</div>
<script>

$(document).ready(function() {
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' result');

  if(jobCount == '0') {$('.no-result').show();}
    else {$('.no-result').hide();}
		  });
});

</script>
<?php
include('footer.php');

?>