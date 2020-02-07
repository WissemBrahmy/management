	<?php
	
		$production=$admin->getDailyProduction();
		
		
	

	
	


	

	






	
	?>


	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	
		
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">
					Daily Production
					 	
				</h2>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default" id="mypanel">

					
					<div class="panel-body">
					<button class="btn btn-info" id="mybutton" onclick="javascipt:print()">Print</button>
					<a id="mmailthis" href="index.php?controller=api&action=mailDailyProduction"><button class="btn btn-success" id="mailthis" >Mail</button></a>
				
						<table data-toggle="table"  data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="Quantity" data-sort-order="desc">
						    <thead>
						    <tr>
						  						        <th data-field="Machine" data-sortable="true">Machine</th>
						  						          <th data-field="Article" data-sortable="true">Article</th>
						  						         <th data-field="Item" data-sortable="true">Item</th>
						  						         <th data-field="Colour" data-sortable="true">Colour</th>
						  						          <th data-field="Quantity" data-sortable="true">Quantity</th>
						  						           <th data-field="Price" data-sortable="true">Price</th>
						  						     <th data-field="Total Price" data-sortable="true">Total Price</th>
						  						          

						     
						        
						       
						      
						  
						    </tr>
						    </thead>
						    <tbody>
						    <?php foreach($production as $exp){ ?>
						    <tr>
						    <td> <?php echo htmlentities($exp->machine); ?></td>
						     <td> <?php echo htmlentities($exp->article); ?></td>
						     <td> <?php echo htmlentities($exp->item); ?></td>
						
						     <td> <?php echo htmlentities($exp->colour); ?></td>
						         <td> <?php echo htmlentities($exp->stock); ?></td>
						             <td> <?php echo htmlentities($exp->price); ?></td>
						                 <td> <?php echo ($exp->stock/1000)*$exp->price ?></td>
						
						    
						     	  
						      
						  
							    
							

							
							  
							 

								
									
								

						
<!-- Modal -->


						    </tr>  

						    <?php } ?>  

						    </tbody>
						</table>
					</div>
				</div>

			</div>
		</div><!--/.row-->	







		
		
	</div><!--/.main-->
	<script>
	function print() {
		
		  newWin= window.open("");
   newWin.document.write('<link href="css/bootstrap.min.css" rel="stylesheet"><link href="css/datepicker3.css" rel="stylesheet"><link href="css/styles.css" rel="stylesheet"><link href="css/bootstrap-table.css" rel="stylesheet"> <style>.form-control,.fixed-table-pagination,#mybutton,#mailthis,#mmailthis{ display:none;}  </style><center> <h3>Daily Production</h3></center>'+$("#mypanel").html());
  
$(newWin).ready(function(){ 
setTimeout(function() {
	newWin.print();
	 newWin.close();
},200);
});
  

	}

</script>

