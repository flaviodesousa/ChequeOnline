<html>
<head>
	<title>Cheque On-Line - Consulta Cheques</title>
</head>
<?
require "col_Support.php3";
?>
<body bgcolor=#FFFFFF>
	<h3>Consulta Cheques</h3>
	<?
	if (IsValidSession($Operador))
	{
		$NadaConsta = TRUE;
		#
		# Relacao de cheques em aberto
		#
		if ($result = mysql_query("select * from Clientes where id=$Cliente"))
		if (mysql_num_rows($result))
		{
			while ($rowCliente = mysql_fetch_array($result))
			{
				echo "<p>Cliente: <strong>$Cliente</strong> - <strong>$rowCliente[nome]</strong></p>";
			}
		}
		mysql_free_result($result);
		if ($result = mysql_query("select to_days(vencimento) - to_days(now()),valor from Cheques where cliente=$Cliente and pago <> 1"))
		if (mysql_num_rows($result))
		{
			$NadaConsta = FALSE;
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
			?><table border=0 cellpadding=0 cellspacing=0 width="100%">
  <tr>
    <th width="33%" align="left" bgcolor="#80FFFF"><!--mstheme--><font face="trebuchet ms, arial, helvetica"><strong><font face="Arial" color="#000080">DIAS</font></strong><!--mstheme--></font></td>
    <th width="33%" align="right" bgcolor="#80FFFF"><!--mstheme--><font face="trebuchet ms, arial, helvetica"><strong><font face="Arial" color="#000080">QUANTIDADE</font></strong><!--mstheme--></font></td>
    <th width="34%" align="right" bgcolor="#80FFFF"><!--mstheme--><font face="trebuchet ms, arial, helvetica"><strong><font face="Arial" color="#000080">VALOR (R$)</font></strong><!--mstheme--></font></td>
  </tr>
  <tr>
    <td width="33%" align=left><!--mstheme--><font face="trebuchet ms, arial, helvetica"><font face="Arial" color="#000080">Até 30 dias</font><!--mstheme--></font></td>
    <td width="33%" align=right><!--mstheme--><font face="trebuchet ms, arial, helvetica">&nbsp;<? echo $Cheques["30 dias"][quantidade] ?><!--mstheme--></font></td>
    <td width="34%" align=right><!--mstheme--><font face="trebuchet ms, arial, helvetica">&nbsp;<? echo number_format($Cheques["30 dias"][valor], 2, ",", ".") ?><!--mstheme--></font></td>
  </tr>
  <tr>
    <td width="33%" bgcolor="#80FFFF" align=left><!--mstheme--><font face="trebuchet ms, arial, helvetica"><font face="Arial" color="#000080">De 30 a 60 dias</font><!--mstheme--></font></td>
    <td width="33%" bgcolor="#80FFFF" align=right><!--mstheme--><font face="trebuchet ms, arial, helvetica">&nbsp;<? echo $Cheques["60 dias"][quantidade] ?><!--mstheme--></font></td>
    <td width="34%" bgcolor="#80FFFF" align=right><!--mstheme--><font face="trebuchet ms, arial, helvetica">&nbsp;<? echo number_format($Cheques["60 dias"][valor], 2, ",", ".") ?><!--mstheme--></font></td>
  </tr>
  <tr>
    <td width="33%" align=left><!--mstheme--><font face="trebuchet ms, arial, helvetica"><font face="Arial" color="#000080">De 60 a 90 dias</font><!--mstheme--></font></td>
    <td width="33%" align=right><!--mstheme--><font face="trebuchet ms, arial, helvetica">&nbsp;<? echo $Cheques["90 dias"][quantidade] ?><!--mstheme--></font></td>
    <td width="34%" align=right><!--mstheme--><font face="trebuchet ms, arial, helvetica">&nbsp;<? echo number_format($Cheques["90 dias"][valor], 2, ",", ".") ?><!--mstheme--></font></td>
  </tr>
  <tr>
    <td width="33%" bgcolor="#80FFFF" align=left><!--mstheme--><font face="trebuchet ms, arial, helvetica"><font face="Arial" color="#000080">Acima de 90 dias</font><!--mstheme--></font></td>
    <td width="33%" bgcolor="#80FFFF" align=right><!--mstheme--><font face="trebuchet ms, arial, helvetica">&nbsp;<? echo $Cheques["Mais que 90 dias"][quantidade] ?><!--mstheme--></font></td>
    <td width="34%" bgcolor="#80FFFF" align=right><!--mstheme--><font face="trebuchet ms, arial, helvetica">&nbsp;<? echo number_format($Cheques["Mais de 90 dias"][valor], 2, ",", ".") ?><!--mstheme--></font></td>
  </tr>
			<?
			echo "<tr><td colspan=2 align=right><b>Total<b></td><td align=right>R\$" . number_format($total, 2, ',', '.') . "</td></tr>";
			?></table><?
		}
		mysql_free_result($result);

		#
		# Relação de cheques devolvidos
		#
		if ($result = mysql_query("select banco,agencia,numero,date_format(vencimento,'%d/%m/%Y') as vencimento,valor from Cheques where cliente=$Cliente and devolucao_motivo is not null"))
		if (mysql_num_rows($result) > 0)
		{
			$NadaConsta = FALSE;
			$total = 0;
			?>
			Cheques devolvidos:
			<table border=1 cellpadding=0 cellspacing=0>
			<tr bgcolor=#80FFFF><th>Banco</th><th>Ag&ecirc;ncia</th><th>N&uacute;mero</th><th>Vencimento</th><th align=right>Valor</th></tr>
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
			echo "<tr><td colspan=4 align=right>Total de devolvidos</td><td align=right>R$" . number_format($total, 2, ',', '.') . "</td></tr></table>";
		}

		if ($NadaConsta == TRUE)
		{
			?>
				<p align="center"><font face="Arial Black" color="#FF0000">NADA CONSTA EM NOSSOS REGISTROS</font></p>
			<?
		}
	}

	$emissao = $vencimento = date("d/m/Y", time());
	?>
	<hr>
	<form action="col_CadastraCheque.php3" method=POST>
		<input type=hidden name=Operador value="<? echo $Operador ?>">
		<input type=hidden name=Cliente value="<? echo $Cliente ?>">



<p><small><em><font color="#000080" face="Arial Black"><strong>DADOS DO CHEQUE</strong></font></em></small></p>

<p><font face="Arial"><font color="#000080">Banco: </font><input type="text" name="Cheque[banco]" size="23"> <font color="#000080">Agência: </font><input type="text" name="Cheque[agencia]" size="5"><font color="#000080">C. Corrente: </font><input type="text" name="Cheque[conta]" size="19"></font></p>

<p><font face="Arial"><font color="#000080">N&uacute;mero do cheque: </font><input type="text" name="Cheque[numero]" size="23"></font></p>

<p><font face="Arial"><font color="#000080">Valor: </font><input type="text" name="Cheque[valor]" size="10"> <font color="#000080">Emissão: </font><input type="text" name="Cheque[emissao]" size="10" value="<? echo $emissao ?>"> <font color="#000080">Vencimento: </font><input type="text" name="Cheque[vencimento]" size="10" value="<? echo $vencimento ?>"></font><input type="submit" value="CADASTRAR" name="B1"></p>
	</form>
</body>
</html>
