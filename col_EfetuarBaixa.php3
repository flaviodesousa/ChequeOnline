<html>
<head>
	<title>Cheque On-Line - Consulta Cheques</title>
</head>
</script>
<body bgcolor=#FFFFFF>
	<h1>Cheque On-Line</h1>
	<h3>Baixa de Cheques</h3>
	<?
	require "col_FormularioConsulta.php3";
	require "col_Support.php3";

	if (! mysql_pconnect("localhost", "httpd", "teste"))
	{
		echo "N&atilde;o conectado!<br>";
	}
	elseif (! mysql_select_db("ChequeOnLine"))
	{
		echo "N&atilde;o selecionado!<br>";
	}
	else
	{
		if ($tipo == "Pago")
		{
			if (! ($result = mysql_query($y = "update Cheques set pago=1 where numero=$Cheque and associado=$AssociadoEfetivo")))
			{
				echo "Falha na atualizacao<br>$y<br>";
			}
			else
			{
				echo "Pagamento do cheque $Cheque registrado<br>";
			}
		}
		else if ($tipo = "Devolvido")
		{
			if (! ($result = mysql_query($y = "update Cheques set pago=0,devolucao_motivo=$devolucao_motivo,devolucao_data=".(DateAsYYYYMMDD($devolucao_data))." where numero=$Cheque and associado=$AssociadoEfetivo")))
			{
				echo "Falha na atualizacao<br>$y<br>";
			}
			else
			{
				echo "Devolucao do cheque $Cheque registrada!<br>";
			}
		}
		FormularioConsulta($Associado);
	}
	?>
</body>
</html>
