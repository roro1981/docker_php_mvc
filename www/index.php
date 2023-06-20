<?php
require 'Model/Conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="resources/alertify/themes/alertify.core.css" />
    <link rel="stylesheet" href="resources/alertify/themes/alertify.default.css" />
    <link rel="stylesheet" href="index.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/5be9c2ac21.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="resources/alertify/lib/alertify.js"></script>
    <script type="text/javascript" src="index.js"></script>
  </head>
<body>
<h1 class="text-center p-3">Mantenedor de finanzas</h1>
<div class="container-fluid row">
<form class="col-4 p-3">
    <h3 class="text-center text-secondary">Registro de transacciones</h3>
    <div id="error_msg" style="display:none" class="p-3 text-primary-emphasis bg-danger-subtle border border-primary-subtle rounded-3">
        Todos los campos son obligatorios
    </div>
  <div class="mb-3">
    <label for="nomTx" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nomTx" id="nomTx">
  </div>
  <div class="mb-3">
    <label for="montoTx" class="form-label">Monto</label>
    <input type="number" class="form-control" id="montoTx" id="montoTx">
  </div>
  <div class="mb-3">
    <label for="tipoTx" class="form-label">Tipo</label>
    <select id="tipoTx" class="form-select" id="tipoTx">
      <option value="0"></option>
    <?php
        $query = 'SELECT * From tipo_transaccion';
        $result = mysqli_query($conn, $query);

        while($value = $result->fetch_array(MYSQLI_ASSOC)){ 
          echo "<option value=".$value['id_tipo_tx'].">".$value['nombre_tipo_tx']."</option>";
        } 
        ?>
    </select>    
  </div>
  <button type="button" class="btn btn-primary mt-4" value="ok" id="btnRegistrar">Registrar</button>

  <div class="card text-bg-success mt-3">
  <div class="card-header">Ganancias por mes</div>
  <div class="card-body">
    <table class="table">
      <thead>
      <tr>
        <th>Mes</th>
        <th>Ganancias</th>
      </tr>
      </thead>
      <tbody class="tablaGanancias">
        
      </tbody>  
    </table>
    </div>
  </div>

</form>
<div class="col-8 p-4">
<table class="table">
  <thead class="table-info">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre transacción</th>
      <th scope="col">Monto transacción</th>
      <th scope="col">Tipo transacción</th>
      <th scope="col">Fecha transacción</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody class="contenido">
    
  </tbody>
</table>
</div>
</div>

<!-- Modal -->
<div id="modal_editar" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Modificar transacción</h2>
        <input type="hidden" id="idTx">
      <label for="nombreTransaccionModal">Nombre transacción:</label>
      <input type="text" id="nombreTransaccionModal">
      
      <label for="montoTransaccionModal">Monto transacción:</label>
      <input type="number" id="montoTransaccionModal">
      
      <label for="tipoTransaccionModal">Tipo transacción:</label>
      <select id="tipoTransaccionModal">
        <option value="0"></option>
        <?php
        $query = 'SELECT * From tipo_transaccion';
        $result = mysqli_query($conn, $query);

        while($value = $result->fetch_array(MYSQLI_ASSOC)){ 
          echo "<option value=".$value['id_tipo_tx'].">".$value['nombre_tipo_tx']."</option>";
        } 
        ?>
      </select>
      <br>
      <button type="button" class="btn btn-primary" id="btnActualiza">Modificar</button>
  </div>
</div>
</body>
</html>
