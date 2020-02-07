	<?php
	
		
		$tickets=$admin->getAllTickets();
		$articles=$admin->getAllArticles();

	
	
	
	if(isset($_POST["type"],$_POST["quantity"],$_POST["article"],$_SESSION['id'])){
		
		
			
		$admin->addTicket((object)$_POST);
	} 

	
	

	
	
	if( isset($_GET["action"])&&$_GET["action"]=="delete" &&isset($_SESSION['id'])){
		$id=$_GET["id"];
		
		
	$admin->deleteTicket($id);

	}



	
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	
		
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">
					Tickets
					 	
				</h2>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">

					
					<div class="panel-body">
					<button class="btn-lg btn-primary" data-toggle="modal" data-target="#addModal">Add Ticket</button>
						<table data-toggle="table"    data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						  						       
						  						         <th data-field="Item" data-sortable="true">Item</th>
						  						         <th data-field="Article" data-sortable="true">Article</th>
						  						              <th data-field="Colour" data-sortable="true">Colour</th>
						  						                   <th data-field="Type" data-sortable="true">Type</th>
						  						          
						  						          <th data-field="Quantity" data-sortable="true">Quantity</th>

						     
						        
						       
						      
						        <th>Action</th>
						    </tr>
						    </thead>
						    <tbody>
						    <?php foreach($tickets as $ticket){ ?>
						    <tr>
						    <td> <?php echo $ticket->item; ?></td>
						   
						    <td> <?php echo $ticket->article; ?></td>
						      <td> <?php echo $ticket->colour; ?></td>
						        <td> <?php echo $ticket->type; ?></td>
						   
						 
						     	  
						      <td> <?php echo $ticket->quantity ?></td>
						  
							    
							

							
							  
							 

								
									
								

							<td>
							   
							    

							    	<a href="index.php?page=tickets&action=delete&id=<?php echo $ticket->id ; ?>">
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
  	<h2 class="modal-title">Add Ticket</h2> 
  </div>
     <div class="modal-body">
   
       <div class="form-group">
   
         
       	<label>Article</label>
       	<select name="article" class="form-control" required>
       	<?php foreach($articles as $a) { ?>
       	<option value="<?= htmlentities($a->article) ?>"><?= htmlentities($a->article) ?> |
       	<?= htmlentities($a->item) ?></option>



       	<?php } ?>
       	</select>
     
       </div>
      
          <div class="form-group">
       	<label>Type</label>
       <select name="type" required class="form-control">
       <option value="Kanbans">Kanbans</option>
       <option value="MTS">MTS</option>
       </select>


       </div>

           <div class="form-group">
       	<label>Quantity</label>
       	<input type="text" name="quantity" class="form-control" required />


  


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

	</script>

