<html>
<head>
	<title>Cheque On-Line - Consulta Cheques</title>
</head>
<?
require "col_FormularioConsulta.php3";
require "col_Support.php3";
?>
<body bgcolor=#FFFFFF>
	<h1>Cheque On-Line</h1>
	<h3>Consulta Cheques</h3>
	<?
	$Cheque[emissao] = DateAsYYYYMMDD($Cheque[emissao]);
	$Cheque[vencimento] = DateAsYYYYMMDD($Cheque[vencimento]);
	if ($Cheque[emissao] == "" or $Cheque[vencimento] == "" or $Cheque[valor] < 1)
	{
		echo "Dados inv&aacute;lidos!";
	}
	if (! mysql_pconnect("localhost", "httpd", "teste"))
	{
		echo "N&atilde;o conectado!<br>";
	}
	elseif (! mysql_select_db("ChequeOnLine"))
	{
		echo "N&atilde;o selecionado!<br>";
	}
	elseif ($result = mysql_query($q = "insert into Cheques (associado, cliente, banco, agencia, conta, numero, valor, emissao, vencimento) values ($AssociadoEfetivo, $Cliente, $Cheque[banco], $Cheque[agencia], $Cheque[conta], $Cheque[numero], $Cheque[valor], $Cheque[emissao], $Cheque[vencimento])"))
	{
		echo "Cheque gravado!";
	}
	else
	{
		echo "Falha na execu&ccedil;&atilde;o de $q";
	}

	FormularioConsulta($Associado);
	?>
</body>
</html>
