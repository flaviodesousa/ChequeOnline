<html>
<head>
	<title>Cheque On-Line - Cadastro de Clientes</title>
</head>
<body>
<?
	require "col_Support.php3";

	if (IsValidSession($Operador))
	{
		if ($result = mysql_query("select * from Clientes where id=$Cliente"))
		{
			if (mysql_num_rows($result))
			{
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

	if ($comando == "Cadastrar")
	{
		if (! mysql_query($q = "insert into Clientes (id, nome, endereco, bairro, cidade, estado, cep, fone_residencial, fone_residencial_recados, fone_comercial, trabalho_local, trabalho_funcao, trabalho_tempo, trabalho_salario, trabalho_outras_rendas) values " .
			"($Cliente," .
			"\"$ClienteNome\"," .
			"\"$ClienteEndereco\"," .
			"\"$ClienteBairro\"," .
			"\"$ClienteCidade\"," .
			"\"$ClienteUF\"," .
			"\"$ClienteCEP\"," .
			"\"$ClienteFoneResidencial\"," .
			($ClienteFoneResidencialRecado ? 1 : 0) .
			",\"$ClienteFoneComercial\"," .
			"\"$ClienteLocalTrabalho\"," .
			"\"$ClienteFuncao\"," .
			($ClienteTempoTrabalho + 0) . "," .
			($ClienteSalario + 0.0) . "," .
			($ClienteOutrasRendas + 0.0) . ")"))
		{
			echo "Falha na execucao de $q<br>";
		}
		else
		{
			echo "Cadastro de $Cliente ($ClienteNome), inclu&iacute;do com sucesso!<br>";
		}
	}
	else // Atualizar
	{
		if (! mysql_query($q = "update Clientes set " .
			"nome=\"$ClienteNome\"," .
			"endereco=\"$ClienteEndereco\"," .
			"bairro=\"$ClienteBairro\"," .
			"cidade=\"$ClienteCidade\"," .
			"estado=\"$ClienteUF\"," .
			"cep=\"$ClienteCEP\"," .
			"fone_residencial=\"$ClienteFoneResidencial\"," .
			"fone_residencial_recados=" . ($ClienteFoneResidencialRecado ? 1 : 0) . "," .
			"fone_comercial=\"$ClienteFoneComercial\"," .
			"trabalho_local=\"$ClienteLocalTrabalho\"," .
			"trabalho_funcao=\"$ClienteFuncao\"," .
			"trabalho_tempo=" . ($ClienteTempoTrabalho + 0) . "," .
			"trabalho_salario=" . ($ClienteSalario + 0.0) . "," .
			"trabalho_outras_rendas=". ($ClienteOutrasRendas + 0.0) .
			" where id=$Cliente"))
		{
			echo "Falha na execucao de $q<br>";
		}
		else
		{
			echo "Cadastro de $Cliente ($ClienteNome), alterado com sucesso!<br>";
		}
	}
}
?>
</body>
</html>
