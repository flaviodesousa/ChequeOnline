<html>
<head>
	<title>Cheque On-Line - Consulta Cheques</title>
</head>
<?
require "col_Support.php3";
?>
<body bgcolor=#FFFFFF>
	<?
	if ( IsValidSession($Operador) )
	{
		if ($result = mysql_query($q = "update Cheques set ".
			"devolucao_motivo=NULL,pago=1".
			" where cliente=$Cliente and numero=$Cheque"))
		{
			if (mysql_affected_rows($result) >= 1)
			{
				echo "Registrada baixa do cheque $Cheque!<br>";
			}
			else
			{
				echo "Cheque n&atilde;o encontrado!<br>";
			}
		}
		else
		{
			echo "Falha na execu&ccedil;&atilde;o de $q";
		}
	}
	?>
</body>
</html>
