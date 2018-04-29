CREATE TABLE 'ijiji_users' (
  'id' int(11) NOT NULL PRIMARY KEY,
  'identity' varchar(12) NOT NULL,
  'kra' varchar(15) NOT NULL,
  'name' varchar(100) NOT NULL,
  'phone' varchar(15) NOT NULL,
  'gender' varchar(1) NOT NULL,
  'avatar' varchar(200) NOT NULL,
  'county' varchar(50) NOT NULL,
  'city' varchar(50) NOT NULL,
  'type' varchar(50) NOT NULL,
  'password' varchar(100) NOT NULL,
  'status' int(1) NOT NULL,
  'authkey' varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;