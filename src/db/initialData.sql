INSERT INTO roles (rol_id, rol_name) VALUES (1, 'Admin');
INSERT INTO roles (rol_id, rol_name) VALUES (2, 'User');

INSERT INTO users (rol_id, username, password, name, lastName, email) 
VALUES (1, 'root', '$10$W1W34l3YjTN5D6tF/DINBe8HKDB.hrZii6IGmhrUw1/C6gBsaJ642', 'root', 'root', 'root@root.dev')