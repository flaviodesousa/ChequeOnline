<html>
<head>
	<title>Cheque On-Line - Consulta</title>
</head>
<?
require "col_FormularioConsulta.php3";
?>
<body bgcolor=#FFFFFF>
	<h1>Cheque On-Line</h1>
	<h3>Consulta</h3>
	<?
	if (! mysql_pconnect("localhost", "httpd", "teste"))
	{
		?>N&atilde;o conectado!<br><?
	}
	else
	{
		if (! mysql_select_db("ChequeOnLine"))
		{
			?>N&atilde;o selecionado!<br><?
		}
		else
		{
			$result = mysql_query("select * from Associados where codigo=$Associado");
			if ($result)
			{
				if ($rowAssociado = mysql_fetch_array($result));
				?>Associado:<br>
				<ul>
				<li>C&oacute;digo: <? echo $rowAssociado["codigo"]; ?>
				<li>Nome: <? echo $rowAssociado["nome"]; ?>
				</ul><?
			}
		}
	}
	FormularioConsulta($Associado);
	?>
</body>
</html>
