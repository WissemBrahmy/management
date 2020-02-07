	<?php
	
		$exportations=$admin->getExportations();
		

	
	


	
	

	
	

	






	
	?>
	<style type="text/css">
		<style> @media only print
{
    footer, header, .sidebar .page-header .btn{ display:none; }
}  </style>
	</style>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	
		
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">
				Exportations
					 	
				</h2>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default" id="mypanel">

					
					<div class="panel-body">
					<button class="btn btn-info" id="mybutton" onclick="javascipt:print()">Print</button>
				
						<table data-toggle="table"  data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="Date" data-sort-order="desc">
						    <thead>
						    <tr>
						      <th data-field="Date" data-sortable="true">Date</th>
						  						           <th data-field="Item" data-sortable="true">Item</th>
						  						          <th data-field="Article" data-sortable="true">Article</th>
						  						     
						  						         <th data-field="Colour" data-sortable="true">Colour</th>
						  						                <th data-field="Type" data-sortable="true">type</th>
						  						          <th data-field="Quantity" data-sortable="true">Quantity</th>
						  						               
						  						    
						  						    
						  						          

						     
						        
						       
						      
						  
						    </tr>
						    </thead>
						    <tbody>
						    <?php foreach($exportations as $exp){ ?>
						    <tr>
						    <td> <?php echo htmlentities(substr($exp->date,0,16)); ?></td>
						      <td> <?php echo htmlentities($exp->item); ?></td>
						     <td> <?php echo htmlentities($exp->article); ?></td>
						   
						
						     <td> <?php echo htmlentities($exp->colour); ?></td>
						         <td>
						          <?php
						          if(count($exp->types)) {
						          	if(count($exp->types)==2) {
						          		echo $exp->types[0]->type." | ".$exp->types[1]->type;
						          	} elseif(count($exp->types)==1) {
						          		echo $exp->types[0]->type;
						          	}
						          }
						          ?>
						          </td>
						             <td> <?php echo htmlentities($exp->quantity); ?></td>
						             
						
						    
						     	  
						      
						  
							    
							

							
							  
							 

								
									
								

						
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
   newWin.document.write('<link href="css/bootstrap.min.css" rel="stylesheet"><link href="css/datepicker3.css" rel="stylesheet"><link href="css/styles.css" rel="stylesheet"><link href="css/bootstrap-table.css" rel="stylesheet"> <style>.form-control,.fixed-table-pagination,#mybutton{ display:none;}  </style><center> <h3>Exportations</h3></center> '+$("#mypanel").html());
  
$(newWin).ready(function(){ 
setTimeout(function() {
	newWin.print();
	 newWin.close();
},200);
});
  

	}

</script>

