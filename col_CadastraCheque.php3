<html>
<head>
	<title>Cheque On-Line - Consulta Cheques</title>
</head>
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
	?>
	<form action="col_ConsultaCheques.php3" method=POST>
	<input type=hidden name="Associado" value="<? echo $Associado ?>">
	Operador: <input type=password name="Operador" size=5><br>
	<?
	if ($Associado)
	{
		?><input type=hidden name="AssociadoEfetivo" value="<? echo $Associado ?>"><?
	}
	else
	{
		?>Associado: <input type=text name="AssociadoEfetivo" size=5><br><?
	}
	?>
	<hr>
	CGC ou CPF: <input type=text name="Cliente" size=14><br>
	<input type=submit value="Pesquisar">
</body>
</html>
