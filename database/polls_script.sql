CREATE TABLE users (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	username VARCHAR,
	name VARCHAR,
	email VARCHAR,
	password VARCHAR
);

INSERT INTO users VALUES (NULL, "teste", "teste", "teste_email", "123");


CREATE TABLE polls (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	title VARCHAR,
	description VARCHAR,
	public BOOLEAN,
	user_id INTEGER REFERENCES users(id)
);