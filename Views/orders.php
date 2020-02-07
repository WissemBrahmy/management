	<?php
	
		
		$orders=$admin->getAllOrders();
		$articles=$admin->getAllArticles();

	
	
	
	if(isset($_POST["article"],$_POST["quantity"],$_POST["packaging"],$_POST["ticket"],$_POST["product_destination"],$_POST["finish_date"],$_POST["cycle_time"],$_SESSION['id'])){
		$_POST['date']=date("Y-m-d H:i:s");
		
			
		$admin->addOrder((object)$_POST);
	} 

	
	

	
	
	if( isset($_GET["action"])&&$_GET["action"]=="delete" &&isset($_SESSION['id'])){
		$id=$_GET["id"];
		
		
	$admin->deleteOrder($id);

	}



	
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	
		
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">
					Orders
					 	
				</h2>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default" id="mypanel">

					
					<div class="panel-body">
					<button class="btn btn-success" id="mybutton" onclick="javascipt:print()">Print</button>

					<button id="mybuttonn" class="btn-lg btn-primary" data-toggle="modal" data-target="#addModal">Add Order</button>
						<table data-toggle="table"    data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						  						       
						  						         <th data-field="Date" data-sortable="true">Date</th>

						  						         <th data-field="Item" data-sortable="true">Item</th>
						  						          
						  						          
						  						          <th data-field="Mould_no" data-sortable="true">Mld_no</th>
						  						     
 <th data-field="Quantity" data-sortable="true">Qnt</th>
  <th data-field="Cycle Time" data-sortable="true">Cycle </th>
   <th data-field="Finish Date" data-sortable="true">Finish </th>
    <th data-field="Material" data-sortable="true">Material</th>
     <th data-field="Colorant" data-sortable="true">Colorant</th>
      <th data-field="TSG" data-sortable="true">TSG</th>
       <th data-field="Destination" data-sortable="true">Destination</th>
        <th data-field="Packaging" data-sortable="true">Pckg</th>
         <th data-field="Ticket" data-sortable="true">Ticket</th>



						     
						        
						       
						      
						        <th class="hdd">Action</th>
						    </tr>
						    </thead>
						    <tbody>
						    <?php foreach($orders as $order){ ?>
						    <tr>
						    <td> <?php echo substr($order->date,0,16); ?></td>
						   
						    <td> <?php echo htmlentities($order->article).'<b> | </b>'.htmlentities($order->item).'<b> | </b>'.htmlentities($order->colour); ?></td>
						    <td> <?= htmlentities($order->mould_no) ?></td>
						      <td> <?= htmlentities($order->quantity) ?></td>
						       <td> <?= htmlentities($order->cycle_time) ?></td>
						        <td> <?= htmlentities($order->finish_date) ?></td>
						         <td> <?= htmlentities($order->material) ?></td>
						          <td> <?php if($order->colorant) echo htmlentities($order->colorant).'<b> | </b>'.htmlentities($order->colorant_quantity); ?></td>
						           <td> <?php
						           if($order->tsg) { echo htmlentities($order->tsg).'<b> | </b>10g/kg'; } ?></td>
						            <td> <?= htmlentities($order->product_destination) ?></td>
						             <td> <?= htmlentities($order->packaging) ?> </td>
						              <td> <?= htmlentities($order->ticket) ?>| <?= htmlentities($order->ticket_quantity) ?></td>

						   
						 
						     	  
						     
						  
							    
							

							
							  
							 

								
									
								

							<td class='hdd'>
							   
							    

							    	<a href="index.php?page=orders&action=delete&id=<?php echo $order->id ; ?>">
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




<div class="modal fade bs-example-modal-lg" id="addModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md">

    <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
      <div class="modal-header" style="padding-top:10px; padding-bottom:2px;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  	<h3 class="modal-title">Add Order</h3> 
  </div>
     <div class="modal-body">
     <div class="row">
   <div class="col-md-3">
       <div class="form-group">
       	<label>Article</label>
       	     	<select name="article" id="article" onchange="javascript:getDataByArticle(this.value)" class="form-control" required>
       	     	<option></option>
       	<?php foreach($articles as $a) { ?>
       	<option value="<?= $a->article ?>"><?= htmlentities($a->article) ?> |
       	<?= $a->item ?></option>



       	<?php } ?>
       	</select>
       	
       </div>
       </div>
        <div class="col-md-3">
       <div class="form-group">
       	<label>Item</label>
      <input type="text" class="form-control" id="item" disabled />       	
       </div>
       </div>
          <div class="col-md-3">
       <div class="form-group">
       	<label>Mould_No</label>
      <input type="text" class="form-control" id="mould_no" disabled />       	
       </div>
       </div>
       <div class="col-md-3">
       	    <div class="form-group">
       	<label>Colour</label>
       	<input type="text" class="form-control"  id="colour"  disabled />

       </div>
       </div>


       </div>


      
           <div class="form-group">
       	<label>Quantity</label>
       	<input type="text" class="form-control"  name="quantity" required />

       </div>
      <div class="row">
      	<div class="col-md-6">
      	<div class="form-group">
      		<label>Cycle Time</label>
       	<input type="text" class="form-control" name="cycle_time" required />


      		
      	</div>
      		
      	</div>
      	  	<div class="col-md-6">
      	<div class="form-group">
      		<label>Finish date</label>
       	<input type="date" class="form-control"  name="finish_date" required />
      	
      		
      	</div>
      		
      	</div>
      </div>
          <div class="row">
      	<div class="col-md-4">
      	<div class="form-group">
      		<label>Material</label>
       	<input type="text" class="form-control" id="material" disabled  />


      		
      	</div>
      		
      	</div>
      	  	<div class="col-md-4">
      	<div class="form-group">
      		<label>Colorant</label>
       	<input type="text" class="form-control" id="colorant" disabled />
      	
      		
      	</div>
      		
      	</div>
      	  	  	<div class="col-md-4">
      	<div class="form-group">
      		<label>TSG</label>
       	<input type="text" class="form-control"  id="tsg" disabled />
      	
      		
      	</div>
      		
      	</div>
      </div>
      <div class="form-group">
      <label class="label-inline">Destination</label>
      <select name="product_destination" class="form-control" required>
      <option value="Ordered">Ordered</option>
      <option value="Assembly">Assembly</option>
      <option value="Tempography">Tempography</option>

      </select>
      </div>
           <div class="row">
      	<div class="col-md-4">
      	<div class="form-group">
      		<label>Packaging</label>
            <select name="packaging" class="form-control" required>
     <option value="Box5 small">Box5 small</option>
     <option value="Box10">Box10</option>
          <option value="Box15">Box15</option>
               <option value="Box20">Box20 </option>
                 <option value="Box25">Box25 </option>
                   <option value="Box5 big">Box5 big </option>
                     <option value="K">K </option>
                       <option value="P">P </option>

     </select>


      		
      	</div>
      		
      	</div>
      	  	<div class="col-md-4">
      	<div class="form-group">
      		<label>Ticket</label>
     <select name="ticket" onchange="javascript:getQuantityByTicket(this.value)" class="form-control" id="ticket" required>
         <option></option>
     <option value="Kanbans">Kanbans</option>
     <option value="MTS">MTS</option>

     </select>
      	
      		
      	</div>
      		
      	</div>
      	  	  	<div class="col-md-4">
      	<div class="form-group">
      		<label>Quantity</label>
       	<input type="text"  class="form-control"  id="quantity" disabled  />
      	
      		
      	</div>
      		
      	</div>
      </div>

     
    
  
     
     
    
     
      

       
     
      
      </div>
      <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px;">
        
        <input type="submit" class="btn btn-primary" value="Confirm">
      </div>
      </form>
     
    </div>
  </div>
</div>
		
		
	</div><!--/.main-->
	<script>
		function print() {
		
		  newWin= window.open("");
   newWin.document.write('<link href="css/bootstrap.min.css" rel="stylesheet"><link href="css/datepicker3.css" rel="stylesheet"><link href="css/styles.css" rel="stylesheet"><link href="css/bootstrap-table.css" rel="stylesheet"> <style>.form-control,.fixed-table-pagination,#mybutton,#mybuttonn,.hdd{ display:none;} .panel-body{ padding:2;} </style><center> <h3>Manufacturing orders</h3></center>'+$("#mypanel").html());
  
$(newWin).ready(function(){ 
setTimeout(function() {
	newWin.print();
	 newWin.close();
},200);
});
  

	}

	function getDataByArticle(article) {
		console.log(article);
			$("#addModal #item").val('');
			$("#addModal #mould_no").val('');
				$("#addModal #colour").val('');
					$("#addModal #material").val('');
						$("#addModal #colorant").val('');
						
								$("#addModal #tsg").val('');
							
		if(article) {
$.ajax(
{
	url:"index.php?controller=api&action=article_data",
	method:"GET",
	data:{article:article},
	dataType:"JSON",
	success:function(data) {
		console.log(data);
		$("#addModal #item").val(data.item);
			$("#addModal #mould_no").val(data.mould_no);
				$("#addModal #colour").val(data.colour);
					$("#addModal #material").val(data.material);
					if(data.m_b){
						$("#addModal #colorant").val(data.m_b+' | '+data.quantity);
					}
						if(data.tsg){
								$("#addModal #tsg").val(data.tsg+' | 10g/kg');
							}



	},
	error:function(e){
		console.log(e);
	}
});
}


	}
	function getQuantityByTicket(ticket) {
		var article=$("#addModal #article").val();
			$("#addModal #quantity").val('');
		if(ticket&&article) {
			
			$.ajax({
				url:"index.php?controller=api&action=getQuantityByTicket",
				method:"GET",
				dataType:"JSON",
				data:{article:article,ticket:ticket},
				success:function(data){
					if(typeof data =="object")
				$("#addModal #quantity").val(data.quantity);
				},
				error:function(e) {
					console.log(e);
				}
			});
		}


	}

	</script>

