SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS transacciones(
    id_tx BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_tx VARCHAR(500),
    monto_tx DOUBLE,
    tipo_tx BIGINT,
    mes VARCHAR(100),
    fecha_tx DATETIME
);

CREATE TABLE IF NOT EXISTS tipo_transaccion(
    id_tipo_tx BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_tipo_tx VARCHAR(500)
);
