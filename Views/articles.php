	<?php
	
		$articles=$admin->getAllArticles();
		$machines=$admin->getAllMachines();

	
	
	
	if(isset($_POST["item"],$_POST["machine_id"],$_POST["article"],$_POST["colour"],$_SESSION['id'])){
					

			$_POST['date']=date("Y-m-d H:i:s");

		
			
		$admin->addArticle((object)$_POST);
	} 

	
	

	
	
	if( isset($_GET["action"])&&$_GET["action"]=="delete" &&isset($_SESSION['id'])){
		$id=$_GET["id"];
		
		
	$admin->deleteArticle($id);

	}
		if( isset($_GET["action"])&&$_GET["action"]=="export" &&isset($_SESSION['id'])){
		$export=new stdClass();
		$export->article=$_POST['article'];

		$export->quantity=$_POST['quantity'];
		
		
	$admin->exportArticle($export);

	}

	if( isset($_GET["action"])&&$_GET["action"]=="updateStock" &&isset($_SESSION['id'])){
		$quantity=new stdClass();
		$quantity->article=$_POST['article'];

		$quantity->stock=$_POST['stock'];
		
		
	$admin->updateArticleStock($quantity);

	}




	
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	
		
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">
					Articles
					 	
				</h2>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">

					
					<div class="panel-body">
					<button class="btn-lg btn-primary" data-toggle="modal" data-target="#addModal">Add Article</button>
										<a href="index.php?controller=api&action=mailDailyStock"><button class="btn btn-success" id="mailthis" >Mail</button></a>

						<table data-toggle="table"    data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						  						        <th data-field="Item" data-sortable="true">Item</th>
						  						         <th data-field="Mould_id" data-sortable="true">Mould_no</th>
						  						         <th data-field="Article" data-sortable="true">Article</th>
						  						          <th data-field="Colour" data-sortable="true">Colour</th>
						  						           <th data-field="Stock" data-sortable="true">Stock</th>
						  						     <th data-field="Status" data-sortable="true">Status</th>
						  						          <th data-field="Date" data-sortable="true">Date</th>

						     
						        
						       
						      
						        <th>Action</th>
						    </tr>
						    </thead>
						    <tbody>
						    <?php foreach($articles as $article){ ?>
						    <tr>
						    <td> <?php echo htmlentities($article->item); ?></td>
						     <td> <?php echo htmlentities($article->mould_no); ?></td>
						    <td> <?php echo htmlentities($article->article); ?></td>
						     <td> <?php echo htmlentities($article->colour); ?></td>
						      <td> <?php echo htmlentities($article->stock);
						      
						      	echo "&nbsp;<button  onclick='javascript:updateStock({$article->article})' class='btn-xs btn-info'>Update</button>
						      	";
						      	 ?>
						      	
						      </td>
						       <td> <?php 
						       if($article->stock>0) {
						       	echo "<span class='label label-success'>In Stock</span>";

						       	} else{
						       		echo"<span class='label label-warning'>Out of Stock</span>";
						       		} ?></td>
						     	  
						      <td> <?php echo substr($article->date,0,16); ?></td>
						  
							    
							

							
							  
							 

								
									
								

							<td>
							<?php if($article->stock>0) { ?>
							
				<button onclick="exportation(<?= htmlentities($article->article) ?>)" class="btn btn-success" >Export</span></button>
							    	
							    	<?php } ?>
							   
							    

							    	<a href="index.php?page=articles&action=delete&id=<?php echo $article->article ; ?>">
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
        <form method="post" id="myForm" onsubmit="javascript:verify()">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  	<h2 class="modal-title">Add Article</h2> 
  </div>
     <div class="modal-body">
   
       <div class="form-group">
       	<label>Item</label>
       	<input type="text" class="form-control" name="item" required="required">
       </div>
          <div class="form-group">
       	<label>Article</label>
       	<input type="text" class="form-control" name="article" id="article" required="required">

       </div>
          <div class="form-group">
       	<label>Colour</label>
       	<input type="text" class="form-control" name="colour" required="required">

       </div>
    
            <div class="form-group">
       	<label>Mould_no</label>
<select name="machine_id" class="form-control">
<?php foreach($machines as $machine) { ?>

<option value="<?= $machine->id ?>"><?= htmlentities($machine->mould_no); ?> | <?= htmlentities($machine->machine); ?></option>
<?php } ?>
</select>
<div class="form-group">
	<label>Add Parts</label> <input type="checkbox" id="addparts" class="checkbox-inline">
</div>
<div style="display:none;" class="form-group row " id="cont">
<div class="arts">
<div class="col-md-6">
<label> Article</label>

<select class="form-control" name="articles[articles][]">
<option> </option>
<?php foreach($articles as $a) {
	?>
	<option value="<?= $a->article ?>"><?= $a->article ?>| <?= $a->item ?> </option>

<?php } ?>
</select>
</div>
<div class="col-md-3">
<label> Quantity</label>
<input type="text" name="articles[quantities][]" class="form-control">
</div>
</div>
<div class="col-md-3">

<span style="cursor: pointer;" onclick="addrow()" id="addarts" class="btn-xs btn-primary"> Add</span>
</div>
	
</div>
       </div>
     
     
    
     
      

       
     
      
      </div>
      <div class="modal-footer">
        
        <input type="submit" class="btn btn-primary" value="Confirm">
      </div>
      </form>
     
    </div>
  </div>
</div>

<!-- EXPORTATION MODAL ***************** -->
<div class="modal fade bs-example-modal-sm" id="exportationModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
        <form method="post" action="index.php?page=articles&action=export" >
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  	<h2 class="modal-title">Export Article</h2> 
  </div>
     <div class="modal-body">
   
       <div class="form-group">
       	<label>Quantity</label>
       	<input type="text" class="form-control" name="quantity" required="required">
       	<input type="hidden" name="article" id="articleExported">
       </div>
      

       
     
      
      </div>
      <div class="modal-footer">
        
        <input type="submit" class="btn btn-primary" value="Confirm">
      </div>
      </form>
     
    </div>
  </div>
</div>

<!-- EXPORTATION MODAL ***************** -->
<div class="modal fade bs-example-modal-sm" id="updateStockModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
        <form method="post" action="index.php?page=articles&action=updateStock" >
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  	<h2 class="modal-title">Update Stock</h2> 
  </div>
     <div class="modal-body">
   
       <div class="form-group">
       	<label>Stock</label>
       	<input type="text" class="form-control" name="stock" required="required">
       	<input type="hidden" name="article" id="stockArticle">
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
	function addrow() {
		var d=$(".arts").html();
		$("#cont").append(d);


	}
	window.addEventListener('load',function(){
	$("#addparts").change(function() {
		console.log('changed');
		$("#cont").toggle();
	});
});
	var verified=true;

	var article=document.querySelector("#article");
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
		

check(article);

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
});
function exportation(article) {
	
	$("#exportationModal").modal("show");
	$("#exportationModal #articleExported").val(article);
}
function updateStock(article) {
	$("#updateStockModal").modal("show");
	$("#updateStockModal #stockArticle").val(article);
}
</script>

