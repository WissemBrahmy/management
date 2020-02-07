	<?php
	
		
		$materials=$admin->getAllMaterials();
		$articles=$admin->getAllArticles();

	
	
	
	if(isset($_POST["article"],$_POST["material"],$_POST["tsg"],$_POST["m_b"],$_POST["quantity"],$_SESSION['id'])){
	
		
			
		$admin->addMaterial((object)$_POST);
	} 

	
	

	
	
	if( isset($_GET["action"])&&$_GET["action"]=="delete" &&isset($_SESSION['id'])){
		$id=$_GET["id"];
		
		
	$admin->deleteMaterial($id);

	}



	
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	
		
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">
					Materials
					 	
				</h2>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">

					
		<div class="panel-body">
		<button class="btn-lg btn-primary" data-toggle="modal" data-target="#addModal">Add Material</button>
	<table data-toggle="table"    data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
				 <thead>
					 <tr>
						  						       
		 <th data-field="Item" data-sortable="true">Item</th>
<th data-field="Colour" data-sortable="true">Colour</th>

						  			<th data-field="Mould_id" data-sortable="true">Article</th>
						<th data-field="Machine" data-sortable="true">Material</th>
						  						          
						  <th data-field="M/B" data-sortable="true">M/B</th>
  <th data-field="TSG" data-sortable="true">TSG</th>
    <th data-field="Quantity" data-sortable="true">Quantity</th>
						     
						        
						       
						      
						        <th>Action</th>
						    </tr>
						    </thead>
						    <tbody>
						    <?php foreach($materials as $m){ ?>
						    <tr>
						    <td> <?php echo htmlentities($m->item); ?></td>
						   
						    <td> <?php echo htmlentities($m->colour); ?></td>
						    <td> <?php echo htmlentities($m->article); ?></td>
						    <td> <?php echo htmlentities($m->material); ?></td>
						      <td> <?php echo htmlentities($m->m_b); ?></td>
						    <td> <?php echo htmlentities($m->tsg); ?></td>
						    <td> <?php echo htmlentities($m->quantity); ?></td>




						   
						 
						     	  
						     
						  
							    
							

							
							  
							 

								
									
								

							<td>
							   
							    

							    	<a href="index.php?page=materials&action=delete&id=<?php echo htmlentities($m->id) ; ?>">
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
  	<h2 class="modal-title">Add Material</h2> 
  </div>
     <div class="modal-body">
   
       <div class="form-group">
       	<label>Article</label>
       	<select name="article" class="form-control" required>
       	<?php foreach($articles as $a) { ?>
       	<option value="<?= $a->article ?>"><?= $a->article ?> |
       	<?= $a->item ?></option>



       	<?php } ?>
       	</select>
     
       </div>
          <div class="form-group">
       	<label>Material</label>
       	<input type="text" class="form-control" name="material" required="required">

       </div>
            <div class="form-group">
       	<label>M/B</label>
       	<input type="text" class="form-control" name="m_b" required="required">

       </div>
            <div class="form-group">
       	<label>TSG</label>
       	<input type="text" class="form-control" name="tsg" >

       </div>
            <div class="form-group">
       	<label>M/B Quantity</label>
       	<input type="text" class="form-control" name="quantity" required="required">

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

	</script>

