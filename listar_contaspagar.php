<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contas a pagar</title>
    <link rel="stylesheet" href="listar_contaspagar.css">
</head>
<body>
    <h1>Lista de contas a pagar</h1>
<?php

function listarContaspagar() {
  $conn = new mysqli('localhost', 'root', '', 'erpl');
  if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
  }

  $sql = "
    SELECT cp.*, f.nome AS fornecedor_nome, m.descricao AS compra_descricao
    FROM sis_contaspagar AS cp
    INNER JOIN sis_fornecedor AS f ON cp.fornecedor_id = f.id
    INNER JOIN mgt_compra AS m ON cp.compra_id = m.id;
    ";
    
    $result = $conn->query($sql);

    if ($result === false) {
      echo "<p>Erro ao executar a consulta: " . $conn->error . "</p>";
    } else {
        if ($result->num_rows > 0) {
          echo "<table>";
          echo "<tr>
          <th>ID</th>
          <th>UUID Contas a Pagar</th>
          <th>Vencimento</th>
          <th>Valor</th>
          <th>Valor Pago</th>
          <th>Emissão</th>
          <th>Nº Documento</th>
          <th>User Gerou</th>
          <th>Histórico</th>
          <th>Nº Parcelas</th>
          <th>Observação</th>
          <th>Parcela Atual</th>
          <th>Status</th>
          <th>Data_pg</th>
          <th>id_Fornecedor</th>
          <th>id_Compra</th>
          </tr>";

          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['uuid_contas_a_pagar']) . "</td>";
            echo "<td>" . htmlspecialchars($row['vencimento']) . "</td>";
            echo "<td>" . htmlspecialchars($row['valor']) . "</td>";
            echo "<td>" . htmlspecialchars($row['valor_pago']) . "</td>";
            echo "<td>" . htmlspecialchars($row['emissao']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nrdocumento']) . "</td>";
            echo "<td>" . htmlspecialchars($row['usergerou']) . "</td>";
            echo "<td>" . htmlspecialchars($row['historico']) . "</td>";
            echo "<td>" . htmlspecialchars($row['numparcelas']) . "</td>";
            echo "<td>" . htmlspecialchars($row['observacao']) . "</td>";
            echo "<td>" . htmlspecialchars($row['parcatual']) . "</td>";
            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
            echo "<td>" . htmlspecialchars($row['datapg']) . "</td>";
            echo "<td>" . htmlspecialchars($row['fornecedor_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['compra_id']) . "</td>";
            echo "</tr>";
          }
            echo "</table>";
        } else {
          echo "<p>Nenhuma informação encontrada.</p>";
        }
    }

    $conn->close();
}

listarContaspagar();
?>
</body>
</html>