<html>
<head>
	<title>Cheque On-Line - Consulta Cheques</title>
</head>
<?
require "col_FormularioConsulta.php3";
require "col_Support.php3";
?>
<body bgcolor=#FFFFFF>
	<?
	$Cheque[emissao] = DateAsYYYYMMDD($Cheque[emissao]);
	$Cheque[vencimento] = DateAsYYYYMMDD($Cheque[vencimento]);
	if ($Cheque[emissao] == "" or $Cheque[vencimento] == "" or $Cheque[valor] < 1)
	{
		echo "Dados inv&aacute;lidos!";
	}
	if ( IsValidSession($Operador) )
	{
		if ($result = mysql_query($q = "insert into Cheques (associado, cliente, banco, agencia, conta, numero, valor, emissao, vencimento) values ($Associado, $Cliente, $Cheque[banco], $Cheque[agencia], $Cheque[conta], $Cheque[numero], $Cheque[valor], $Cheque[emissao], $Cheque[vencimento])"))
		{
			echo "Cheque gravado!";
		}
		else
		{
			echo "Falha na execu&ccedil;&atilde;o de $q";
		}
	}
	?>
</body>
</html>
