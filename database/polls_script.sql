DROP TABLE poll_answers;
DROP TABLE answers;
DROP TABLE questions;
DROP TABLE polls;
DROP TABLE users;

pragma foreign_keys = true;

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
	user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
	image VARCHAR,
	number_of_answers INTEGER
);

CREATE TABLE questions (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	description VARCHAR,
	poll_id INTEGER REFERENCES polls(id) ON DELETE CASCADE
);

CREATE TABLE answers (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	description VARCHAR,
	question_id INTEGER REFERENCES questions(id) ON DELETE CASCADE
);

CREATE TABLE poll_answers (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
	poll_id INTEGER REFERENCES polls(id) ON DELETE CASCADE,
	question_id INTEGER REFERENCES questions(id) ON DELETE CASCADE,
	answer_id INTEGER REFERENCES answers(id) ON DELETE CASCADE
);

/* Insert new poll */

INSERT INTO polls VALUES (NULL, 'Titulo pa', 1, 1, '', 0);

INSERT INTO questions VALUES (NULL, 'Le question', 1);

INSERT INTO answers VALUES (NULL, 'resposta simpatica', 1);
INSERT INTO answers VALUES (NULL, 'resposta nao tao simpatica', 1);

INSERT INTO poll_answers VALUES (NULL, 1, 1, 1, 2);