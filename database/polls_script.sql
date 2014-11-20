CREATE TABLE users (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	username VARCHAR,
	name VARCHAR,
	email VARCHAR,
	password VARCHAR
);

INSERT INTO users VALUES (NULL, "admin", "admin", "admin", "123");

CREATE TABLE polls (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	description VARCHAR,
	public BOOLEAN,
	user_id INTEGER REFERENCES users(id)
);

CREATE TABLE answers (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	description VARCHAR,
	poll_id INTEGER REFERENCES polls(id)
);