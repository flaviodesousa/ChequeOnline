<html>
<head>
	<title>Cheque On-Line - Consulta Cheques</title>
</head>
<script language="JavaScript">
function openWindow(url, name)
{
	wndCadastrarCliente = window.open(url, name, 'scrollbars,menubar,resizable,width=400,height=400');
	window.name = 'opener';
}
</script>
<body bgcolor=#FFFFFF>
	<h1>Cheque On-Line</h1>
	<h3>Consulta Cheques</h3>
	<?
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
		#
		# Relacao de cheques em aberto
		#
		if ($result = mysql_query("select to_days(vencimento) - to_days(now()),valor from Cheques where cliente=$Cliente and pago <> 1"))
		if (mysql_num_rows($result))
		{
			$total = 0;
			while ($rowCheque = mysql_fetch_array($result))
			{
				if ($rowCheque[0] >= 0)
				{
					if ($rowCheque[0] < 31) $prazo = "30 dias";
					elseif ($rowCheque[0] < 61) $prazo = "60 dias";
					elseif ($rowCheque[0] < 91) $prazo = "90 dias";
					else $prazo = "Mais que 90 dias";
					$Cheques[$prazo][quantidade]++;
					$Cheques[$prazo][valor] += $rowCheque[valor];
					$total += $rowCheque[valor];
				}
			}
			?><table>
			<tr><th>Prazo</th><th>Quantidade</th><th>Valor</th></tr><?
			while ($Cheque = each($Cheques))
			{
				?>
				<tr>
					<td><? echo $Cheque[key] ?></td>
					<td align=right><? echo $Cheques[$Cheque[key]][quantidade] ?></td>
					<td align=right>R$<? echo number_format($Cheques[$Cheque[key]][valor], 2, ',', '.') ?></td>
				</tr>
				<?
			}
			?></table><?

			echo "Total: R\$" . number_format($total, 2, ',', '.') . "<br>";
		}
		mysql_free_result($result);

		#
		# Relação de cheques devolvidos
		#
		if ($result = mysql_query("select banco,agencia,numero,date_format(vencimento,'%d/%m/%Y') as vencimento,valor from Cheques where cliente=$Cliente and devolucao_motivo is not null"))
		if (mysql_num_rows($result) > 0)
		{
			$total = 0;
			?>
			Cheques devolvidos:
			<table>
			<tr><th>Banco</th><th>Ag&ecirc;ncia</th><th>N&uacute;mero</th><th>Vencimento</th><th align=right>Valor</th></tr>
			<?
			while ($row = mysql_fetch_array($result))
			{
				$total += $row[valor];
				?>
				<tr>
				<td align=right><? echo $row[banco] ?></td>
				<td align=right><? echo $row[agencia] ?></td>
				<td align=right><? echo $row[numero] ?></td>
				<td align=right><? echo $row[vencimento] ?></td>
				<td align=right><? echo number_format($row[valor], 2, ',', '.') ?></td>
				</tr>
				<?
			}
			echo "</table>Total de devolvidos: R$" . number_format($total, 2, ',', '.') . "<br>";
		}
	}

	$emissao = $vencimento = date("d/m/Y", time());
	?>
	<hr>
	<form action="col_CadastraCheque.php3" method=POST>
		<input type=hidden name=Associado value="<? echo $Associado ?>">
		<input type=hidden name=AssociadoEfetivo value="<? echo $AssociadoEfetivo ?>">
		<input type=hidden name=Operador value="<? echo $Operador ?>">
		<input type=hidden name=Cliente value="<? echo $Cliente ?>">
		<table>
			<tr><th colspan=2>Dados do cheque:</th></tr>
			<tr><td>CPF ou CGC</td><td><? echo $Cliente ?>
			<a href="javascript:openWindow('col_CadastraCliente.php3?Cliente=<? echo $Cliente ?>','Win')">atualizar dados</a></td></tr>
			<tr><td>Banco</td><td><input type=text name=Cheque[banco] size=4></td></tr>
			<tr><td>Ag&ecirc;ncia</td><td><input type=text name=Cheque[agencia] size=4></td></tr>
			<tr><td>Conta</td><td><input type=text name=Cheque[conta] size=10></td></tr>
			<tr><td>N&uacute;mero do cheque</td><td><input type=text name=Cheque[numero] size=10></td></tr>
			<tr><td>Valor</td><td>R$<input type=text name=Cheque[valor] size=16></td></tr>
			<tr><td>Data de emiss&atilde;o</td><td><input type=text name=Cheque[emissao] size=10 value="<? echo $emissao ?>"></td></tr>
			<tr><td>Data de vencimento</td><td><input type=text name=Cheque[vencimento] size=10 value="<? echo $vencimento ?>"></td></tr>
			<tr><td colspan=2><input type=submit value="Registrar cheque"></td></tr>
		</table>
	</form>
</body>
</html>
