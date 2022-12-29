/**Creación usuarios de BBDD*/
CREATE USER 'teis2_sat_admin'@'localhost' IDENTIFIED BY 'abc123.';
CREATE USER 'teis2_sat_conex'@'localhost' IDENTIFIED BY 'abc123.';
/**Permisos a usuarios de BBDD*/
GRANT SELECT, INSERT, UPDATE, DELETE ON teis2_satpanel.* TO 'teis2_sat_admin'@'localhost';
GRANT SELECT ON teis2_satpanel.* TO 'teis2_sat_conex'@'localhost';