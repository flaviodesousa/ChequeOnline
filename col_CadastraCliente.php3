<html>
<head>
	<title>Cheque On-Line - Cadastro de Clientes</title>
</head>
<?
function ExibirFormulario()
{
	global $comando, $Cliente;

	if ($result = mysql_query("select * from Clientes where id=$Cliente"))
	{
		if (mysql_num_rows($result))
		{
			$rowCliente = mysql_fetch_array($result);
			$comando = "Atualizar";
		}
		else
		{
			$comando = "Cadastrar";
		}
	}
	else
	{
		echo "Nao foi possivel verificar o cadastro de $Cliente<br>";
	}

	?>
	<form action="col_CadastraCliente.php3" method=POST><input type=hidden name=comando value="<? echo $comando ?>">
	<table>
	<tr><td>CGC ou CPF:</td><td><? echo $Cliente ?><input type=hidden name=rowCliente[id] value="<? echo $Cliente ?>"></td></tr>
	<tr><td>Nome:</td><td><input type=text size=32 name=rowCliente[nome] value="<? echo $rowCliente[nome] ?>"></td></tr>
	<tr><td>Fantasia:</td><td><input type=text size=32 name=rowCliente[fantasia] value="<? echo $rowCliente[fantasia] ?>"></td></tr>
	<tr><td>Endere&ccedil;o:</td><td><input type=text size=64 name=rowCliente[endereco] value="<? echo $rowCliente[endereco] ?>"></td></tr>
	<tr><td>Bairro:</td><td><input type=text size=64 name=rowCliente[bairro] value="<? echo $rowCliente[bairro] ?>"></td></tr>
	<tr><td>Cidade:</td><td><input type=text size=64 name=rowCliente[cidade] value="<? echo $rowCliente[cidade] ?>"></td></tr>
	<tr><td>Estado:</td><td><input type=text size=2 name=rowCliente[estado] value="<? echo $rowCliente[estado] ?>"></td></tr>
	<tr><td>CEP:</td><td><input type=text size=9 name=rowCliente[cep] value="<? echo $rowCliente[cep] ?>"></td></tr>
	<tr><td>Fone:</td><td><input type=text size=64 name=rowCliente[fone] value="<? echo $rowCliente[fone] ?>"></td></tr>
	</table>
	Observa&ccedil;&otilde;es:
	<textarea name=rowCliente[observacoes] rows=5 cols=60><? echo $rowCliente[observacoes] ?></textarea>
	<input type=submit value="<? echo $comando ?>">
	</form>
	<?
}

function AtualizarDados($comando)
{
	global $rowCliente;

	if ($comando == "Cadastrar")
	{
		if (! mysql_query($q = "insert into Clientes (id, nome, fantasia, endereco, bairro, cidade, estado, cep, fone, observacoes) values " .
			"($rowCliente[id]," .
			"\"$rowCliente[nome]\"," .
			"\"$rowCliente[fantasia]\"," .
			"\"$rowCliente[endereco]\"," .
			"\"$rowCliente[bairro]\"," .
			"\"$rowCliente[cidade]\"," .
			"\"$rowCliente[estado]\"," .
			"\"$rowCliente[cep]\"," .
			"\"$rowCliente[fone]\"," .
			"\"$rowCliente[observacoes]\")"))
		{
			echo "Falha na execucao de $q<br>";
		}
		else
		{
			echo "Cadastro de $rowCliente[id] ($rowCliente[nome]), inclu&iacute;do com sucesso!<br>";
		}
	}
	else // Atualizar
	{
		if (! mysql_query($q = "update Clientes set " .
			"nome=\"$rowCliente[nome]\"," .
			"fantasia=\"$rowCliente[fantasia]\"," .
			"endereco=\"$rowCliente[endereco]\"," .
			"bairro=\"$rowCliente[bairro]\"," .
			"cidade=\"$rowCliente[cidade]\"," .
			"estado=\"$rowCliente[estado]\"," .
			"cep=\"$rowCliente[cep]\"," .
			"fone=\"$rowCliente[fone]\"," .
			"observacoes=\"$rowCliente[observacoes]\" " .
			"where id=$rowCliente[id]"))
		{
			echo "Falha na execucao de $q<br>";
		}
		else
		{
			echo "Cadastro de $rowCliente[id] ($rowCliente[nome]), alterado com sucesso!<br>";
		}
	}
}
?>
<body bgcolor=#FFFFFF>
	<h1>Cheque On-Line</h1>
	<h3>Cadastro de Clientes</h3>
	<?
	if (! mysql_pconnect("localhost", "httpd", "teste"))
	{
		echo "N&atilde;o conectado!<br>";
	}
	elseif (! mysql_select_db("ChequeOnLine"))
	{
		echo "N&atilde;o selecionado!<br>";
	}
	if (empty($comando))
	{
		ExibirFormulario();
	}
	else
	{
		AtualizarDados($comando);
	}
	?>
</body>
</html>
