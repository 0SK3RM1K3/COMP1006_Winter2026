CREATE TABLE players (
  player_id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(100) NOT NULL,
  last_name  VARCHAR(100) NOT NULL,
  phone      VARCHAR(20)  NOT NULL,
  email      VARCHAR(150) NOT NULL,
  position  CHAR(2) NOT NULL,
  team_name  VARCHAR(100) NOT NULL,
);