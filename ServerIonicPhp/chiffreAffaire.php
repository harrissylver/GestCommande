<?php
	header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Content-Type: application/json; charset=utf-8"); 
      
		include "library/config.php";
		$postjson = json_decode(file_get_contents('php://input'), true);
		//if ($postjson['aksi'] == 'get_chiffre'){
			$data = array();
			$query = mysqli_query($mysqli,"SELECT client.NumCli,Nom,SUM(Pu*Qte) AS Total FROM commande,client,produit WHERE commande.NumProd=produit.NumProd AND client.Numcli=commande.NumCli GROUP BY client.NumCli");

				while ($row= mysqli_fetch_array($query)){
					$data[]=array(
						'NumCli'=> $row['NumCli'],
						'Nom'=> $row['Nom'],
						'Total'=> $row['Total']
					);
				}

				if ($query) $result = json_encode(array('success'=>true,'result'=>$data));
				else $result = json_encode(array('success'=>false));
				echo $result; 
//		}



?>