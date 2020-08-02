drop database kamelia_f;
create database kamelia_f;
use kamelia_f;

CREATE TABLE  user (
  id int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  nama varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  role tinyint(2) NOT NULL, -- 1: admin cabang/admin, 2: admin kom/subadmin
  CONSTRAINT Un_username UNIQUE (username),
  CONSTRAINT Un_email UNIQUE (email)
);

-- CREATE TABLE  admin_cabang (
--  id int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
--  user_id int(10) unsigned NOT NULL,
--  no varchar(100) NOT NULL,
--  CONSTRAINT fk_user_id_cab FOREIGN KEY (user_id) REFERENCES user (id)
-- );


-- CREATE TABLE  admin_kom (
--  id int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
--  user_id int(10) unsigned NOT NULL,
--  nama varchar(255) NOT NULL,
--  no varchar(100) NOT NULL,
--  CONSTRAINT fk_user_id_kom FOREIGN KEY (user_id) REFERENCES user (id)
-- );


CREATE TABLE  jenis (
 id int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
 nama varchar(255) NOT NULL
);


CREATE TABLE  kegiatan (
 id int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
 jenis_id int(10) unsigned,
 user_id int(10) unsigned,
 nama varchar(255) NOT NULL,
 deskripsi text NOT NULL,
 lokasi varchar(100) NOT NULL,
 pembicara varchar(100) NOT NULL,
 pj varchar(100) NOT NULL,
 catatan varchar(255) NOT NULL,
 waktu datetime NOT NULL,
 status tinyint(2) NOT NULL, -- 1: diajukan, 2: selesai, 3: gagal
 review text NULL,
 CONSTRAINT fk_jenis_id FOREIGN KEY (jenis_id) REFERENCES jenis (id) ON DELETE SET NULL,
 CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE SET NULL
);

CREATE TABLE  artikel (
 id int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
 user_id int(10) unsigned,
 judul varchar(255) NOT NULL,
 slug varchar(255) NOT NULL,
 isi text NOT NULL,
 thumbnail varchar(255) NOT NULL,
 dibuat TIMESTAMP DEFAULT CURRENT_TIMESTAMP
 CONSTRAINT fk_artikel_user_id FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE SET NULL
);

INSERT INTO jenis (nama)
VALUES
('training'),
('seminar');

INSERT INTO user (username, password, nama, email, role) 
VALUES
('sapphire', '$2y$10$ELFpOBaTTwV.Ev/6mbfAJeIWvW3xHH.zixPSF.lKuYz9iJ4nd566.','Cabang asik',  'sapphire@gmail.com', '1'),
('kamelia', '$2y$10$ELFpOBaTTwV.Ev/6mbfAJeIWvW3xHH.zixPSF.lKuYz9iJ4nd566.','Komisariat asik',  'kamelia@gmail.com', '2'),
('ismi', '$2y$10$ELFpOBaTTwV.Ev/6mbfAJeIWvW3xHH.zixPSF.lKuYz9iJ4nd566.','Komisariat asik',  'ismi@gmail.com', '2'),
('lori', '$2y$10$ELFpOBaTTwV.Ev/6mbfAJeIWvW3xHH.zixPSF.lKuYz9iJ4nd566.','Komisariat asik',  'lori@gmail.com', '2');

INSERT INTO kegiatan (jenis_id, user_id, nama, deskripsi, lokasi, pembicara, pj, catatan, waktu, status)
VALUES
(1, 2, 'LK1', 'Training awal', 'Ende', 'Putri', 'Mike', 'Harus bawa payung', '2020-04-02 07:16:19', 1),
(2, 3, 'LK2', 'Training tengah', 'Ende', 'Ismi', 'Lia', 'Harus bawa mantol', '2020-04-06 12:05:19', 1),
(2, 1, 'LK6', 'Training tengah', 'Ende', 'Ismi', 'Lia', 'Harus bawa mantol', '2020-04-09 05:05:19', 1),
(2, 3, 'LK8', 'Training tengah', 'Ende', 'Ismi', 'Lia', 'Harus bawa mantol', '2020-04-10 09:05:19', 1),
(2, 1, 'LK9', 'Training tengah', 'Ende', 'Ismi', 'Lia', 'Harus bawa mantol', '2020-04-23 10:05:19', 1),
(1, 2, 'LK3', 'Training akhir', 'Ende', 'Unta', 'Kamel', 'Harus bawa sampan', '2020-04-20 20:55:19', 1);