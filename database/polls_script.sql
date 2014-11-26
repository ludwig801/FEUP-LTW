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
	public INTEGER,
	user_id INTEGER REFERENCES users(id),
	image VARCHAR
);

CREATE TABLE answers (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	description VARCHAR,
	poll_id INTEGER REFERENCES polls(id)
);

CREATE TABLE poll_answers (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	user_id INTEGER REFERENCES user_id(id),
	poll_id INTEGER REFERENCES polls(id),
	answer_id INTEGER REFERENCES answers(id)
);