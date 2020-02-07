<?php
namespace back\Models\backEnd;


use PDO;

use connection\DB as DBB;

class Back
{
	private $db;

	public function __construct() {
		//singletone db instance
	$this->db=DBB::getConnection();
	

	}

	public function login($guest){
		$q=$this->db->prepare("select * from admins where login=?");
		$q->execute([$guest->login]);
		if($q->rowCount()) {
			$user=$q->fetch(PDO::FETCH_OBJ);
			if(!password_verify($guest->password,$user->password)) {
				return "<span style='color:red'>Wrong login or password !</span>";
			} 
			$_SESSION['id']=$user->id;
			$_SESSION['login']=$user->login;
			//redirection
			echo "<script>location.href='index.php' </script>";
		} else{
			return "<span style='color:red'>Wrong login or password !</span>";

		}
	

	}
//***********************ARTICLES *******************************************//	

//return all articles list
	public function getAllArticles() {
		$q=$this->db->query("select articles.*,machines.machine,machines.mould_no from articles left join machines on articles.machine_id=machines.id");
		$articles=$q->fetchAll(PDO::FETCH_OBJ);
		
		return $articles;
	}
//return all data by article
	public function getDataByArticle($article) {
		$q=$this->db->query("select articles.*,materials.material,materials.quantity,materials.m_b,materials.tsg,machines.mould_no from articles left join materials on articles.article=materials.article
			left join machines on articles.machine_id=machines.id
			where articles.article='".$article."' ");
		$article=$q->fetch(PDO::FETCH_OBJ);
		die(json_encode($article));
	}


	//insert article
	public function addArticle($article) {
		//if article exist
	
		
		if($this->findArticleById($article->article)) {
		echo "<script>alert('Article exists')</script>";	
		} else{
			$d=0;
			$article->articles['articles']=array_filter($article->articles['articles']);
			$article->articles['quantities']=array_filter($article->articles['quantities']);
			
			$this->db->beginTransaction();
			for($i=0;$i<count($article->articles['articles']);$i++) {



				$d+=$this->db->exec("update articles set stock=stock-".$article->articles['quantities'][$i]." where article=".$article->articles['articles'][$i]." and stock-".$article->articles['quantities'][$i].">0");
				if($d==0){
					break;
				}
				
			}
			if($d!=count($article->articles['articles'])){
				$this->db->rollback();
			}else{
				$this->db->commit();
			}
			
			if($d==count($article->articles['articles'])) {
		$q=$this->db->prepare("insert into articles( `item`, `machine_id`, `article`, `colour`, `stock`,`exported`, `date`) values(?,?,?,?,?,?,?)");
		
		if(
		$q->execute([$article->item,$article->machine_id,$article->article,$article->colour,0,0,$article->date]) ) {
			echo "<script>alert(' Article added')</script>";
		echo " <script>location.href='index.php?page=articles'</script>";

		} else{
			echo "<script>alert('Problem adding article')</script>";

		}
	} else{
		echo "<script>alert('Problem adding article parts stock not available')</script>";

	}
	}
			

	}
	//update stock
		public function updateArticleStock($quantity) {
		$q=$this->db->prepare("update articles set stock=?,date=NOW() where article=?");
		if(
		$q->execute([$quantity->stock,$quantity->article])) {
			echo "<script>alert('Stock updated')</script>";
		echo " <script>location.href='index.php?page=articles'</script>";

		} else{
			echo "<script>alert('Problem updating stock')</script>";

		}	

	}

	public function deleteArticle($id) {
		$q=$this->db->prepare("delete from articles where article=?");
		if($q->execute([$id])) {
			echo "<script>location.href='index.php?page=articles'; alert('  Article deleted'); </script>";
		} else{
			echo "<script> alert('Problem deleting Article')</script>";
		}
	}

		public function exportArticle($export) {
			$article=$this->findArticleById($export->article);
			if($article->stock<$export->quantity) {
		echo "<script>location.href='index.php?page=articles'; alert(' Quantity exported not available ');</script>";

			} else{

		$q=$this->db->prepare("update articles  set stock=stock-? where article=? and stock>=?");
		$q1=$this->db->prepare("insert into exportations (article,quantity,date) values(?,?,?) on duplicate key update quantity=quantity+?,date=NOW()");
		if($q->execute([$export->quantity,$export->article,$export->quantity,]) &&
			$q1->execute([$export->article,$export->quantity,date('Y-m-d H:i:s'),$export->quantity])) {
			echo "<script>location.href='index.php?page=articles'; alert(' Article exported'); </script>";
		} else{
			echo "<script> alert('Problem exporting Article')</script>";
		}
	}
	}

	public function findArticleById($id) {
		$q=$this->db->prepare("select * from articles where article=:id");
		$q->bindValue(":id",$id);
		$q->execute();
		$article=$q->fetch(PDO::FETCH_OBJ);

		return ($q->rowCount())?$article:false;
	}


//***********************************MACHINES*************************//

	public function getAllMachines() {
		$q=$this->db->query("select * from machines");
		$machines=$q->fetchAll(PDO::FETCH_OBJ);
		return $machines;
	}

	public function addMachine($machine) {
    $q=$this->db->prepare("insert into machines(mould_no,machine,inject_parts,cav,date) values(?,?,?,?,?)");
   if( $q->execute([$machine->mould_no,$machine->machine,$machine->inject_parts,$machine->cav,$machine->date])) {
   	echo "<script>location.href='index.php?page=machines'; alert(' Machine added');</script>";
   } else{
   	echo "<script> alert('Problem adding machine');</script>";

   }

	}

	public function deleteMachine($id) {
	$q=$this->db->prepare("delete from machines where id=?");
		
		if($q->execute([$id]) ) {
			echo "<script>location.href='index.php?page=machines'; alert(' Machine deleted');</script>";
		} else{
			echo "<script> alert('problem deleting machine ');</script>";

		}


	}
/**********************************PRICES************************************/
	public function getAllPrices() {
		$q=$this->db->query("select prices.*,articles.item from prices inner join articles on prices.article=articles.article");
		return $q->fetchAll(PDO::FETCH_OBJ);
	}

	public function addPrice($price) {
		$q=$this->db->prepare("insert into prices(article,price,date) values(?,?,?)");
		if($q->execute([$price->article,$price->price,$price->date,])) {
			echo "<script>window.location.href='index.php?page=prices'; alert(' Price added');</script>";
		} else{
			echo "<script> alert(' Problem adding price')</script>";
		}
	}

	public function deletePrice($id) {
		$q=$this->db->prepare("delete from prices where id=?");
		if($q->execute([$id])) {
			echo "<script>window.location.href='index.php?page=prices'; alert(' Price deleted');</script>";
		} else{
			
			echo "<script> alert(' Problem deleting price');</script>";
		}

	}

//***********************************MATERIALS*************************//

	public function getAllMaterials() {
		$q=$this->db->query("select materials.*,articles.colour,articles.item from materials inner join articles on materials.article=articles.article");
		$materials=$q->fetchAll(PDO::FETCH_OBJ);
		return $materials;
	}

	public function addMaterial($material) {
    $q=$this->db->prepare("insert into materials(article,material,m_b,tsg,quantity) values(?,?,?,?,?)");
   if( $q->execute([$material->article,$material->material,$material->m_b,$material->tsg,$material->quantity])) {
   	echo "<script>location.href='index.php?page=materials'; alert(' Material added');</script>";
   } else{
   	echo "<script> alert('Problem adding material');</script>";

   }

	}

	public function deleteMaterial($id) {
	$q=$this->db->prepare("delete from materials where id=?");
		
		if($q->execute([$id]) ) {
			echo "<script>location.href='index.php?page=materials'; alert(' Material deleted');</script>";
		} else{
			echo "<script> alert('problem deleting material ');</script>";

		}


	}

	//***********************************TICKETS*************************//

	public function getAllTickets() {
		$q=$this->db->query("select tickets.*,articles.colour,articles.item from tickets inner join articles on tickets.article=articles.article");
		$tickets=$q->fetchAll(PDO::FETCH_OBJ);
		return $tickets;
	}

	public function addTicket($ticket) {
    $q=$this->db->prepare("insert into tickets(article,type,quantity) values(?,?,?)");
   if( $q->execute([$ticket->article,$ticket->type,$ticket->quantity])) {
   	echo "<script>location.href='index.php?page=tickets'; alert(' Ticket added');</script>";
   } else{
   	echo "<script> alert('Problem adding ticket');</script>";

   }

	}

	public function deleteTicket($id) {
	$q=$this->db->prepare("delete from tickets where id=?");
		
		if($q->execute([$id]) ) {
			echo "<script>location.href='index.php?page=tickets'; alert(' Ticket deleted');</script>";
		} else{
			echo "<script> alert('problem deleting ticket ');</script>";

		}

	}
			public function getQuantityByTicket($ticket,$article) {
				$q=$this->db->query("select quantity from tickets where
				type='".$ticket."' and article='".$article."' ");
		$quantity=$q->fetch(PDO::FETCH_OBJ);
		die(json_encode($quantity));

		}


	//***********************************TICKETS*************************//

	public function getAllOrders() {
		$q=$this->db->query("select orders.*,articles.colour,articles.item,machines.mould_no,materials.tsg,materials.material, materials.m_b as colorant,materials.quantity as colorant_quantity,orders.ticket as ticket,tickets.quantity as ticket_quantity
		 from 
			orders left join articles on orders.article=articles.article 
			left join machines on articles.machine_id=machines.id
			left join materials on orders.article =materials.article
			inner join tickets on orders.article=tickets.article and orders.ticket=tickets.type ");
		$orders=$q->fetchAll(PDO::FETCH_OBJ);

		return $orders;
	}

	public function addOrder($order) {
    $q=$this->db->prepare("insert into orders(article,quantity,cycle_time,finish_date,product_destination,packaging,ticket,date) values(?,?,?,?,?,?,?,?)");
    
   if( $q->execute([$order->article,$order->quantity,$order->cycle_time,$order->finish_date,$order->product_destination,$order->packaging,$order->ticket,$order->date])) {
   	echo "<script>location.href='index.php?page=orders'; alert(' Order added');</script>";
   } else{
   	echo "<script> alert('Problem adding order');</script>";

   }

	}

	public function deleteOrder($id) {
	$q=$this->db->prepare("delete from orders where id=?");
		
		if($q->execute([$id]) ) {
			echo "<script>location.href='index.php?page=orders'; alert(' Order deleted');</script>";
		} else{
			echo "<script> alert('problem deleting order ');</script>";

		}


	}

	//*****************DAILY PRODUCTION***************************************//

	public function getDailyProduction() {
		$q=$this->db->query("select articles.*,machines.machine,prices.price from articles  inner join machines on articles.machine_id=machines.id inner join prices on articles.article=prices.article where DATE(articles.date)=DATE(NOW())");
		
		$production=$q->fetchAll(PDO::FETCH_OBJ);
	
		return $production;
	
	}

	public function mailDailyProduction() {
		//pdf generation
			require_once("fpdf.php");
$pdf=new \FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","B",16);
$pdf->cell(0,10,"Daily Production  ".date("Y-m-d"),0,0,'C');
$pdf->ln();
$pdf->setLineWidth(0.5);
$pdf->line(5,22,205,22);
$pdf->ln();
$pdf->SetFont("Arial","B",11);



$pdf->FancyTable_DailyProduction(array("Machine","Article","Item","Colour","Quantity","Price","Total Price"),$this->getDailyProduction());
//change D to S
$x=$pdf->output('S',"Daily-production ".date("Y-m-d").".pdf");

//mailing the pdf to mail list

$mails=require_once("config/mails.php");

require_once('phpmailer\PHPMailerAutoload.php');
$mail = new \PHPMailer;
$mail->isSMTP(); 
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);   
//mail config                                  
$mail->Host = 'smtp.gmail.com';                   
$mail->SMTPAuth = true;                              
$mail->Username = 'naciri1938@gmail.com';   
$mail->Password = '21760436';                           
$mail->SMTPSecure = 'tls';                           
$mail->From =$mails['from']; 
$mail->FromName = $mails['name'];
//add adresses
foreach($mails['mails'] as $m){
$mail->addAddress($m); 
}                

$mail->WordWrap = 50;                                 

$mail->Subject = 'Daily-production '.date("Y-m-d");
$mail->Body    = $mails['body'];
$mail->AddStringAttachment($x, "Daily-production ".date("Y-m-d").".pdf");

if(!$mail->send()) {   
  die($mail->ErrorInfo);
} else {
 echo "<script> alert('Mail sent with success');
 location.href='index.php?page=daily_production' </script>";
   // $pdf->output('D',"Daily-production ".date("Y-m-d").".pdf");
}

	}


	//*********** Mail Daily Stock *** //

public function mailDailyStock() {

		//pdf generation
			require_once("fpdf.php");
$pdf=new \FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","B",16);
$pdf->cell(0,10,"Daily Stock  ".date("Y-m-d"),0,0,'C');
$pdf->ln();
$pdf->setLineWidth(0.5);
$pdf->line(5,22,205,22);
$pdf->ln();
$pdf->SetFont("Arial","B",11);



$pdf->FancyTable_DailyStock(array("Item","Mould_no","Article","Colour","Stock","Date"),$this->getAllArticles());
//change D to S
$x=$pdf->output('S',"Daily-Stock ".date("Y-m-d").".pdf");

//mailing the pdf to mail list

$mails=require_once("config/mails.php");

require 'phpmailer\PHPMailerAutoload.php';
$mail = new \PHPMailer;
$mail->isSMTP(); 
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);   
//mail config                                  
$mail->Host = 'smtp.gmail.com';                   
$mail->SMTPAuth = true;                              
$mail->Username = 'naciri1938@gmail.com';   
$mail->Password = '21760436';                           
$mail->SMTPSecure = 'tls';                           
$mail->From =$mails['from']; 
$mail->FromName = $mails['name'];
//add adresses
foreach($mails['mails'] as $m){
$mail->addAddress($m); 
}                

$mail->WordWrap = 50;                                 

$mail->Subject = 'Daily-Stock '.date("Y-m-d");
$mail->Body    = $mails['body'];
$mail->AddStringAttachment($x, "Daily-Stock ".date("Y-m-d").".pdf");

if(!$mail->send()) {   
  die($mail->ErrorInfo);
} else {
 echo "<script> alert('Mail sent with success'); location.href='index.php?page=articles'</script>";
   // $pdf->output('D',"Daily-production ".date("Y-m-d").".pdf");
}

	}


	//*****************EXPORTATION**************************************//

	public function getExportations() {
		$q=$this->db->query("select exportations.*,
			articles.item,articles.colour
			 from exportations inner join articles on exportations.article=articles.article");
		$exportations=$q->fetchAll(PDO::FETCH_OBJ);
		$q1=$this->db->prepare("select type from tickets where article=?");
		foreach($exportations as $e) {
			$e->types=array();
			$q1->execute([$e->article]);
			$e->types=$q1->fetchAll(PDO::FETCH_OBJ);

		}

		return $exportations;
	}


}