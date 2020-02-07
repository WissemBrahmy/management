	<?php
	
		
		$prices=$admin->getAllPrices();
		$articles=$admin->getAllArticles();

	
	
	
	if(isset($_POST["article"],$_POST["price"],$_SESSION['id'])){
		$_POST['date']=date("Y-m-d H:i:s");
		
			
		$admin->addPrice((object)$_POST);
	} 

	
	

	
	
	if( isset($_GET["action"])&&$_GET["action"]=="delete" &&isset($_SESSION['id'])){
		$id=$_GET["id"];
		
		
	$admin->deletePrice($id);

	}



	
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	
		
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">
					Prices
					 	
				</h2>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">

					
					<div class="panel-body">
					<button class="btn-lg btn-primary" data-toggle="modal" data-target="#addModal">Add Price</button>
						<table data-toggle="table"    data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						  						       
						  						         <th data-field="Article" data-sortable="true">Article</th>
						  						         <th data-field="Price" data-sortable="true">Price</th>
						  						          
						  						          <th data-field="Date" data-sortable="true">Date</th>

						     
						        
						       
						      
						        <th>Action</th>
						    </tr>
						    </thead>
						    <tbody>
						    <?php foreach($prices as $price){ ?>
						    <tr>
						    <td> <?php echo $price->article; ?> | <?= $price->item ?></td>
						   
						    <td> <?php echo $price->price; ?></td>
						   
						 
						     	  
						      <td> <?php echo substr($price->date,0,16); ?></td>
						  
							    
							

							
							  
							 

								
									
								

							<td>
							   
							    

							    	<a href="index.php?page=prices&action=delete&id=<?php echo $price->id ; ?>">
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
        <form method="post" id="myForm">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  	<h2 class="modal-title">Add Price</h2> 
  </div>
     <div class="modal-body">
   
       <div class="form-group">
       	<label>Article</label>
       	<select name="article" class="form-control">
       	<?php foreach($articles as $article) {
       		?>
       		<option value="<?= $article->article ?>"><?= htmlentities($article->article) ?>
       		| <?= htmlentities($article->item) ?></option>

       <?php 	} ?>
       </select>

       </div>
          <div class="form-group">
       	<label>Price</label>
       	<input type="text" id="price" class="form-control" name="price" required="required">

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
	var verified=true;
	var price=document.querySelector("#price");

	function check(node) {
		var oldBorder=node.style.borderColor;
			var oldBackground=node.style.backgroundColor

	node.addEventListener("keyup",function() {
		
		if(isNaN(parseFloat(node.value)) ) {
			
			node.style.backgroundColor="rgba(255,0,0,0.1)";
			node.style.borderColor="rgba(255,0,0,0.9)"

			verified=false;
		
		}else{
			node.style.backgroundColor=oldBackground;
				node.style.borderColor=oldBorder;
			verified=true;
			


		}
	});
}
		

check(price);

function verify() {
	if(verified==false){
	return false;
}
return true;

}
document.querySelector("#myForm").addEventListener("submit",function(e) {
	e.preventDefault();
	if( verify()) {
		this.submit();
	} 
})
</script>


