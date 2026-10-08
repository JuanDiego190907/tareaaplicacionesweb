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