# tareaaplicacionesweb

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    
    // Cálculo de sueldo bruto
    $bruto = ($_POST['hd'] * 675) + ($_POST['hv'] * 700) + ($_POST['hn'] * 956.23);

    // Escala salarial para porcentajes
    if ($bruto < 85000) {
        $p_ahorro = 0.001;  // 0.1%
        $p_seguro = 0.0015; // 0.15%
    } elseif ($bruto <= 150000) {
        $p_ahorro = 0.0015; // 0.15%
        $p_seguro = 0.002;  // 0.2%
    } else {
        $p_ahorro = 0.003;  // 0.3%
        $p_seguro = 0.0025; // 0.25%
    }

    // Deducciones y neto
    $desc_ahorro = $bruto * $p_ahorro;
    $desc_seguro = $bruto * $p_seguro;
    $neto = $bruto - $desc_ahorro - $desc_seguro;
}
?>

<!DOCTYPE html>
<html>
<head><title>Calculadora de Sueldo</title></head>
<body>

<h2>Ingreso de Datos</h2>
<form method="POST">
    Nombre: <input type="text" name="nombre" required><br><br>
    Cédula: <input type="text" name="cedula" required><br><br>
    Horas Diurnas: <input type="number" step="any" name="hd" value="0"><br><br>
    Horas Vespertinas: <input type="number" step="any" name="hv" value="0"><br><br>
    Horas Nocturnas: <input type="number" step="any" name="hn" value="0"><br><br>
    <button type="submit">Calcular</button>
</form>

<?php if (isset($bruto)): ?>
    <hr>
    <h2>Recibo de Pago</h2>
    <p><strong>Empleado:</strong> <?= $nombre ?> | <strong>Cédula:</strong> <?= $cedula ?></p>
    <p><strong>Sueldo Bruto:</strong> <?= number_format($bruto, 2) ?> Bs.</p>
    <p><strong>Descuento Ahorro Habitacional:</strong> <?= number_format($desc_ahorro, 2) ?> Bs.</p>
    <p><strong>Descuento Seguro Social:</strong> <?= number_format($desc_seguro, 2) ?> Bs.</p>
    <p><strong>SUELDO NETO A COBRAR:</strong> <?= number_format($neto, 2) ?> Bs.</p>
<?php endif; ?>

</body>
</html>
  
