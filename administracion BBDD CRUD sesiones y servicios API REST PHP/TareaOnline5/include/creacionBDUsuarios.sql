/*SQL para crear la base de datos que alberga los usuarios disponibles para la zona de administrador*/

create DATABASE dwes;
use dwes;
 create table usuarios(
  usuario VARCHAR(30),
  contrasena VARCHAR(50)
 );
INSERT INTO `usuarios`(`usuario`, `contrasena`) VALUES ('dwes','aa40dfb19d3b6e647ff14ac6e85d5e3a')
