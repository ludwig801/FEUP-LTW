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
	image VARCHAR,
	number_of_answers INTEGER
);

CREATE TABLE questions (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	description VARCHAR,
	poll_id INTEGER REFERENCES polls(id)
);

CREATE TABLE answers (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	description VARCHAR,
	question_id INTEGER REFERENCES questions(id)
);

CREATE TABLE poll_answers (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	user_id INTEGER REFERENCES user_id(id),
	poll_id INTEGER REFERENCES polls(id),
	question_id INTEGER REFERENCES questions(id),
	answer_id INTEGER REFERENCES answers(id)
);

/* Insert new poll */

INSERT INTO polls VALUES (NULL, 'Titulo pa', 1, 1, '', 0);

INSERT INTO questions VALUES (NULL, 'Le question', 1);

INSERT INTO answers VALUES (NULL, 'A tua mae e uma resposta', 1);
INSERT INTO answers VALUES (NULL, 'A tua mae e uma grande resposta', 1);