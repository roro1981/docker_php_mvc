<?php
include '../Model/Conexion.php';
$opt = 0; if (isset($_POST['opt'])){ $opt=$_POST['opt']; }
        switch ($opt) {
            case 'traeTransacciones':
                $tr="";    
                $query = 'SELECT * from transacciones t inner join tipo_transaccion ti on t.tipo_tx=ti.id_tipo_tx order by id_tx';
                $result = mysqli_query($conn, $query);
                while($value = $result->fetch_array(MYSQLI_ASSOC)){ 
                $tr .= '<tr>
                    <td>'.$value['id_tx'].'</td>
                    <td>'.$value['nombre_tx'].'</td>
                    <td>'.$value['monto_tx'].'</td>
                    <td>'.$value['nombre_tipo_tx'].'</td>
                    <td>'.date("d-m-Y", strtotime($value['fecha_tx'])).'</td>
                    <td>
                        <a data-id="'.$value['id_tx'].'" class="editar btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a data-id="'.$value['id_tx'].'" class="eliminar btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>';
                }
                echo $tr;
            break;
            case 'grabaTransaccion':
                $nombre_tx = $_POST['nomTx'];
                $monto_tx  = $_POST['montoTx']; 
                $tipo_tx   = $_POST['tipoTx'];
                $fecha_tx  = date("Y-m-d H:i");
                $meses = array(
                    "January" => "ENERO",
                    "February" => "FEBRERO",
                    "March" => "MARZO",
                    "April" => "ABRIL",
                    "May" => "MAYO",
                    "June" => "JUNIO",
                    "July" => "JULIO",
                    "August" => "AGOSTO",
                    "September" => "SEPTIEMBRE",
                    "October" => "OCTUBRE",
                    "November" => "NOVIEMBRE",
                    "December" => "DICIEMBRE"
                );
                
                $mesIngles = date("F"); 
                $mesEspanol = $meses[$mesIngles];
                
                $query="insert into transacciones (nombre_tx,monto_tx,tipo_tx,mes,fecha_tx) values('".$nombre_tx."',".$monto_tx.",".$tipo_tx.",'".$mesEspanol."','".$fecha_tx."')";
                $result = mysqli_query($conn, $query);
                
                if($result==1){
                    echo "ok";
                }else{
                    echo "Error en grabacion";
                }
                
            break;

            case 'trae_info_transaccion':
                $id_tx = $_POST['id_tx'];
                $query = 'SELECT * from transacciones where id_tx='.$id_tx;
                $result = mysqli_query($conn, $query);
                $value = $result->fetch_array(MYSQLI_ASSOC);
                echo $value['nombre_tx'];
                echo "**";
                echo $value['monto_tx'];
                echo "**";
                echo $value['tipo_tx'];
            break;   
            
            case 'modificaTransaccion':
                $nombre_tx = $_POST['nomTx'];
                $monto_tx  = $_POST['montoTx']; 
                $tipo_tx   = $_POST['tipoTx'];
                $id_tx     = $_POST['idTx'];
                
                $query="update transacciones set nombre_tx='".$nombre_tx."',monto_tx=".$monto_tx.",tipo_tx=".$tipo_tx." where id_tx=".$id_tx;
                $result = mysqli_query($conn, $query);
                
                if($result==1){
                    echo "ok";
                }else{
                    echo "Error en modificación";
                }
                
            break;

            case 'eliminaTransaccion':
                $id_tx     = $_POST['idTx'];
                
                $query="delete from transacciones where id_tx=".$id_tx;
                $result = mysqli_query($conn, $query);
                
                if($result==1){
                    echo "ok";
                }else{
                    echo "Error en eliminación";
                }
                
            break;

            case 'traeGanancias':
                $tr="";    
                $query = 'SELECT
                            mes,
                            SUM(CASE WHEN tipo_tx = 1 THEN monto_tx ELSE -monto_tx END) AS ganancia
                        FROM transacciones
                        GROUP BY mes;';
                $result = mysqli_query($conn, $query);
                while($value = $result->fetch_array(MYSQLI_ASSOC)){ 
                   if($value['ganancia'] < 0){
                    $estilo="style='color: red;'";
                   }else{
                    $estilo="style='color: green;'";
                   } 
                $tr .= '<tr>
                    <td>'.$value['mes'].'</td>
                    <td '.$estilo.'>'.$value['ganancia'].'</td>
                </tr>';
                }
                echo $tr;
            break;
        }        

?>