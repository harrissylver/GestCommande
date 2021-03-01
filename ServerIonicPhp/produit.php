<?php
	header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Content-Type: application/json; charset=utf-8"); 
      include "library/config.php";
		$postjson = json_decode(file_get_contents('php://input'), true);
		if ($postjson['aksi'] == 'add_prod'){
			$data = array();
			$query = mysqli_query($mysqli,"INSERT INTO produit SET NumProd='$postjson[NumProd]',Design='$postjson[Design]',Pu='$postjson[Pu]'");

				if ($query) $result = json_encode(array('success'=>true));
				else $result = json_encode(array('success'=>false));
				echo $result; 
		}





		elseif ($postjson['aksi'] == 'get_prod'){
			$data = array();
			$query = mysqli_query($mysqli,"SELECT * FROM produit ORDER BY NumProd DESC");

				while ($row= mysqli_fetch_array($query)){
					$data[]=array(
						'NumProd'=> $row['NumProd'],
						'Design'=> $row['Design'],
						'Pu'=> $row['Pu'],
					);
				}

				if ($query) $result = json_encode(array('success'=>true,'result'=>$data));
				else $result = json_encode(array('success'=>false));
				echo $result; 
		}


		elseif ($postjson['aksi'] == 'update_prod'){
			$query = mysqli_query($mysqli,"UPDATE produit SET 
				Design='$postjson[Design]',Pu='$postjson[Pu]' WHERE NumProd='$postjson[NumProd]'");

				if ($query) $result = json_encode(array('success'=>true));
				else $result = json_encode(array('success'=>false));
				echo $result; 
		}

		elseif ($postjson['aksi'] == 'delete_prod'){
			$query = mysqli_query($mysqli,"DELETE FROM produit WHERE NumProd='$postjson[NumProd]'");

				if ($query) $result = json_encode(array('success'=>true));
				else $result = json_encode(array('success'=>false));
				echo $result; 
		}