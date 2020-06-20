<?php
require 'config.php';
require 'classes/carros.class.php';
require 'classes/reservas.class.php';
$reservas = new Reservas($pdo); //injeção de dependência 
?>

<h1>Reservas</h1>

<a href="reservar.php">Adicionar reserva</a> <br><br>

<form action="" method="get">
    <select name="ano" id="ano">
        <?php for ($q = date('Y'); $q >= 2015; $q--) : ?>
            <option><?php echo $q; ?></option>
        <?php endfor; ?>
    </select>

    <select name="mes" id="mes">
        <?php for ($q = 1; $q <= 12; $q++) : ?>
            <option><?php echo $q; ?></option>
        <?php endfor; ?>
    </select>

    <input type="submit" value="Mostrar">
</form>
<?php

if (empty($_GET['ano'])) {
    exit;
}

$data = $_GET['ano'] . '-' . $_GET['mes'];
$dia1 = date('w', strtotime($data . '-01')); //pega o primeiro dia
$dias = date('t', strtotime($data)); //pega a quantidade de dias
$linhas = ceil(($dia1 + $dias) / 7); //arredonda por linhas do calendário...
$dia1 = -$dia1;
$data_inicio = date('Y-m-d', strtotime($dia1 . ' days', strtotime($data)));
$data_fim = date('Y-m-d', strtotime((($dia1 + ($linhas * 7) - 1)) . ' days', strtotime($data)));

$lista = $reservas->getReservas($data_inicio, $data_fim);
// foreach ($lista as $item) {
//     $data1 = date('d/m/Y', strtotime($item['data_inicio']));
//     $data2 = date('d/m/Y', strtotime($item['data_fim']));
//     echo $item['pessoa'] . ' reservou o carro na data ' . $data1 . ' e ' . $data2 . '. <br>';
// }
// 
?>
<hr>

<?php require 'calendario.php'; ?>