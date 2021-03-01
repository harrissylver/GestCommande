<?php
	header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Content-Type: application/json; charset=utf-8"); 
      
		include "library/config.php";
		$postjson = json_decode(file_get_contents('php://input'), true);
		if ($postjson['aksi'] == 'get_factresult'){
			$data = array();
			$query = mysqli_query($mysqli,"SELECT Design,Pu,Qte,(Pu*Qte) AS Montant FROM commande,client,produit WHERE commande.NumProd=produit.NumProd AND client.Numcli=commande.NumCli AND client.Numcli='$postjson[NumCli]'");

				while ($row= mysqli_fetch_array($query)){
					$data[]=array(
						'Design'=> $row['Design'],
						'Pu'=> $row['Pu'],
						'Qte'=> $row['Qte'],
						'Montant'=> $row['Montant']
						
					);
					
				}

				if ($query) $result = json_encode(array('success'=>true,'result'=>$data));
				else $result = json_encode(array('success'=>false));
				echo $result; 
			}

		elseif ($postjson['aksi'] == 'get_total'){
			$data = array();
			$query = mysqli_query($mysqli,"SELECT sum(Pu*Qte) AS Total FROM commande,client,produit WHERE commande.NumProd=produit.NumProd AND client.Numcli=commande.NumCli AND client.Numcli='$postjson[NumCli]' GROUP BY client.Numcli");

				while ($row= mysqli_fetch_array($query)){
					$data[]=array(
						'Total'=> $row['Total']
					);
					
				}

				if ($query) $result = json_encode(array('success'=>true,'result'=>$data));
				else $result = json_encode(array('success'=>false));
				echo $result; 
			}




		elseif ($postjson['aksi'] == 'get_facture'){
			$data = array();
			$query = mysqli_query($mysqli,"SELECT NumCli,Nom FROM client ORDER BY NumCli ASC");

				while ($row= mysqli_fetch_array($query)){
					$data[]=array(
						'NumCli'=> $row['NumCli'],
						'Nom'=> $row['Nom']
					);
				}

				if ($query) $result = json_encode(array('success'=>true,'result'=>$data));
				else $result = json_encode(array('success'=>false));
				echo $result; 
		}


		// elseif ($postjson['aksi'] == 'get_factresult'){
		// 	$data = array();
		// 	$query = mysqli_query($mysqli,"SELECT client.NumCli,Nom,Design,Pu,Qte,(Pu*Qte) AS Montant FROM client,produit,commande WHERE client.Numcli=commande.NumCli AND produit.NumProd=commande.NumProd  AND client.Numcli='$postjson[NumCli]'");

		// 		while ($row= mysqli_fetch_array($query)){
		// 			$data[]=array(
		// 				'NumCli'=> $row['NumCli'],
		// 				'Nom'=> $row['Nom'],
		// 				'Design'=> $row['Design'],
		// 				'Pu'=> $row['Pu'],
		// 				'Qte'=> $row['Qte'],
		// 				'Montant'=> $row['Montant']
		// 			);
		// 		}

		// 		if ($query) $result = json_encode(array('success'=>true,'result'=>$data));
		// 		else $result = json_encode(array('success'=>false));
		// 		echo $result; 
		// }
   elseif ($postjson['aksi'] == 'get_datasingle'){
			$data = array();
			$query = mysqli_query($mysqli,"SELECT * FROM client WHERE NumCli='$postjson[NumCli]'");

				while ($row= mysqli_fetch_array($query)){
					$data[]=array(
						'NumCli'=> $row['NumCli'],
						'Nom'=> $row['Nom']
					);
				}

				if ($query) $result = json_encode(array('success'=>true,'result'=>$data));
				else $result = json_encode(array('success'=>false));
				echo $result; 
		}
?>