<?
function DateAsYYYYMMDD($Date)
{
	if (preg_match("/(\d{1,2})\/(\d{1,2})\/(\d{2,4})/", $Date, $DateComponents))
	{
		if ($DateComponents[3] < 70)
		{
			$DateComponents[3] += 2000;
		}
		elseif ($DateComponents[3] < 100)
		{
			$DateComponents[3] += 1900;
		}
		elseif ($DateComponents[3] < 1970)
		{
			return "";
		}
		return $DateComponents[3] * 10000 + $DateComponents[2] * 100 + $DateComponents[1];
	}
	else
	{
		return "";
	}
}

function IsValidSession($Operador)
{
	$IsIt = FALSE;
	global $Associado;

	if (! mysql_pconnect("localhost", "httpd", "teste"))
	{
		echo "N&atilde;o conectado!<br>";
	}
	elseif (! mysql_select_db("ChequeOnLine"))
	{
		echo "N&atilde;o selecionado!<br>";
	}
	elseif ($result = mysql_query("select * from Operadores where codigo=$Operador"))
	{
		if (mysql_num_rows($result) != 1)
		{
			echo "C&oacute;digo de usu&aacute;rio inv&aacute;lido!<br>";
		}
		else
		{
			$rowOperador = mysql_fetch_array($result);
			$Associado = $rowOperador[associado];
			$IsIt = TRUE;
		}
	}

	return $IsIt;
}
?>
