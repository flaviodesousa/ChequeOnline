<html>
<head>
	<title>Cheque On-Line - Consulta</title>
</head>
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
