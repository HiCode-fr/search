<?php
function rechercher($mystring,$bdd)
{
	$add_sql = "";
	$size_mystring = strlen($mystring);
	$sql_search = "SELECT * FROM table WHERE `index` LIKE '%".$mystring."%' ";
	try
	{
		$query_search = $bdd->query($sql_search);
	}
	catch(Exception $e)
	{
		$erreur = ("Erreur : " . $e->getMessage() );
		die($erreur);
	}
	if($query_search->rowCount() >= 1)
	{
		return $query_search;
	}

	for ($i=1; $i < ($size_mystring-1) ; $i++) { 
		$string_1 = substr($mystring , 0 , ($size_mystring - $i) ); 
		$string_2 = substr($mystring, $i , $size_mystring);
		$sql_search = "SELECT * FROM table  WHERE  (`index` LIKE '%".$string_1."%' OR `index` LIKE '%".$string_2."%' ".$ajout_sql." ) ";
		try
		{
			$query_search = $bdd->query($sql_search);
		}
		catch(Exception $e)
		{
			$erreur = ("Erreur : " . $e->getMessage() );
			die($erreur);
		}
		if($query_search->rowCount() >= 3)
		{
			return $query_search;
		}
		$add_sql .= " OR `index` LIKE '%".$string_1."%' OR `index` LIKE '%".$string_2."%' ";
	}

	return $query_search;
}
    ?>
