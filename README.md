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



#segundo ejercicio

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            margin: 40px;
        }

        .contenedor {
            background-color: white;
            padding: 25px;
            width: 380px;
            border-radius: 8px;
            border-top: 5px solid #2b6cb0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 25px;
        }

        h2 {
            color: #2b6cb0;
            margin-top: 0;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3182ce;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2b6cb0;
        }

        .factura {
            border-top-color: #38a169;
        }

        .factura h2 {
            color: #38a169;
        }

        .total {
            color: #2d3748;
            background-color: #e6fffa;
            padding: 10px;
            border-radius: 4px;
            border-left: 4px solid #38a169;
        }
    </style>
</head>
<body>

<div class="contenedor">

    <h2>Formulario de Compra</h2>

    <form method="POST" action="">

        <label><b>Artículo:</b></label>
        <input type="text" name="item" required>

        <label><b>Cantidad:</b></label>
        <input type="number" name="cant" min="1" required>

        <label><b>Precio Unitario ($):</b></label>
        <input type="number" step="0.01" name="precio" required>

        <input type="submit" name="calcular" value="Calcular Factura">

    </form>

</div>


<?php
if (isset($_POST['calcular'])) {

    $item = $_POST['item'];

    $cant = $_POST['cant'];

    $precio = $_POST['precio'];


    $subtotal = $cant * $precio;

    $iva = $subtotal * 0.12;

    $total_iva = $subtotal + $iva;


    if ($total_iva > 150) {

        $descuento = $total_iva * 0.15;

        $aplica = "SI (15%)";

    } else {

        $descuento = 0;

        $aplica = "NO";

    }


    $total_final = $total_iva - $descuento;
?>


<div class="contenedor factura">

    <h2>Detalle de la Factura</h2>

    <p><b>Producto:</b> <?php echo $item; ?></p>

    <p><b>Cantidad:</b> <?php echo $cant; ?></p>

    <p><b>Precio Unitario:</b> $<?php echo $precio; ?></p>

    <hr>

    <p><b>Subtotal:</b> $<?php echo $subtotal; ?></p>

    <p><b>IVA (12%):</b> $<?php echo $iva; ?></p>

    <p><b>Total con IVA:</b> $<?php echo $total_iva; ?></p>

    <p><b>Aplica Descuento:</b> <?php echo $aplica; ?></p>

    <p><b>Monto Descuento:</b> -$<?php echo $descuento; ?></p>

    <div class="total">
        <h3>Total a Pagar: $<?php echo $total_final; ?></h3>
    </div>

</div>


<?php
}
?>

</body>
</html>



  
