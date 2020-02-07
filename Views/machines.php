	<?php
	
		
		$machines=$admin->getAllMachines();

	
	
	
	if(isset($_POST["mould_no"],$_POST["machine"],$_SESSION['id'])){
		$_POST['date']=date("Y-m-d H:i:s");
		
			
		$admin->addMachine((object)$_POST);
	} 

	
	

	
	
	if( isset($_GET["action"])&&$_GET["action"]=="delete" &&isset($_SESSION['id'])){
		$id=$_GET["id"];
		
		
	$admin->deleteMachine($id);

	}



	
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	
		
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">
					Machines
					 	
				</h2>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">

					
					<div class="panel-body">
					<button class="btn-lg btn-primary" data-toggle="modal" data-target="#addModal">Add Machine</button>
						<table data-toggle="table"    data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						  						       
						  						         <th data-field="Mould_id" data-sortable="true">Mould_no</th>
						  						         <th data-field="Machine" data-sortable="true">Machine</th>
						  						         <th data-field="Inject parts" data-sortable="true">Inject parts</th>
						  						         <th data-field="Cav" data-sortable="true">Cav</th>
						  						            <th data-field="capacity" data-sortable="true"> Theo prod capacity</th>
						  						          
						  						          <th data-field="Date" data-sortable="true">Date</th>

						     
						        
						       
						      
						        <th>Action</th>
						    </tr>
						    </thead>
						    <tbody>
						    <?php foreach($machines as $machine){ ?>
						    <tr>
						    <td> <?php echo htmlentities($machine->mould_no); ?></td>
						   
						    <td> <?php echo htmlentities($machine->machine); ?></td>
						     <td> <?php echo htmlentities($machine->inject_parts); ?></td>
						      <td> <?php echo htmlentities($machine->cav); ?></td>
						       <td> <?php if($machine->inject_parts>0 && $machine->cav>0)  echo 3600/$machine->inject_parts*$machine->cav*24; ?></td>
						   
						 
						     	  
						      <td> <?php echo substr($machine->date,0,16); ?></td>
						  
							    
							

							
							  
							 

								
									
								

							<td>
							   
							    

							    	<a href="index.php?page=machines&action=delete&id=<?php echo $machine->id ; ?>">
							    		<button class="btn btn-danger" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
							    	</a>
							    	
							    	
							    	

							   

							    
						    	
								

						    </td>
<!-- Modal -->


						    </tr>  

						    <?php } ?>  

						    </tbody>
						</table>
					</div>
				</div>

			</div>
		</div><!--/.row-->	




<div class="modal fade bs-example-modal-sm" id="addModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  	<h2 class="modal-title">Add machine</h2> 
  </div>
     <div class="modal-body">
   
       <div class="form-group">
       	<label>Mould_no</label>
       	<input type="text" class="form-control" name="mould_no" required="required">
       </div>
          <div class="form-group">
       	<label>machine</label>
       	<input type="text" class="form-control" name="machine" required="required">

       </div>
           <div class="form-group">
       	<label>inject parts</label>
       	<input type="text" class="form-control" name="inject_parts" required="required">

       </div>
           <div class="form-group">
       	<label>cav</label>
       	<input type="text" class="form-control" name="cav" required="required">

       </div>
     
    
  
     
     
    
     
      

       
     
      
      </div>
      <div class="modal-footer">
        
        <input type="submit" class="btn btn-primary" value="Confirm">
      </div>
      </form>
     
    </div>
  </div>
</div>
		
		
	</div><!--/.main-->
	<script>
function show(id){
	var dir=document.getElementById(id);
	dir.style.display="block";

	



}
function hide(id){

	var dir=document.getElementById(id);
	dir.style.display="none";

}
	</script>

