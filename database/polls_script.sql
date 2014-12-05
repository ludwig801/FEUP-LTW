/*
DROP TABLE poll_answers;
DROP TABLE answers;
DROP TABLE questions;
DROP TABLE polls;
DROP TABLE users;
*/

pragma foreign_keys = true;

CREATE TABLE users (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	username VARCHAR,
	name VARCHAR,
	email VARCHAR,
	password VARCHAR
);

INSERT INTO users VALUES (NULL, "admin", "admin", "admin@master.com", "123");
INSERT INTO users VALUES (NULL, "guest", "guest", "guest@master.com", "123");

CREATE TABLE polls (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	description VARCHAR,
	public INTEGER,
	user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
	image VARCHAR,
	number_of_answers INTEGER,
	token VARCHAR
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
	answer_id INTEGER REFERENCES answers(id) ON DELETE CASCADE
);

/* Insert new poll */
/*
INSERT INTO polls VALUES (NULL, 'Poll 1', 1, 1, '', 0, 0);
INSERT INTO questions VALUES (NULL, 'Le question', 1);
INSERT INTO answers VALUES (NULL, 'resposta simpatica', 1);
INSERT INTO answers VALUES (NULL, 'resposta nao tao simpatica', 1);

INSERT INTO polls VALUES (NULL, 'Poll 2', 0, 1, '', 0, 0);
INSERT INTO questions VALUES (NULL, 'Le question', 2);
INSERT INTO answers VALUES (NULL, 'resposta simpatica', 2);
INSERT INTO answers VALUES (NULL, 'resposta nao tao simpatica', 2);

INSERT INTO poll_answers VALUES (NULL, 1, 1, 1);
INSERT INTO poll_answers VALUES (NULL, 1, 2, 1);

SELECT id FROM polls WHERE user_id = 1 INTERSECT SELECT poll_id FROM poll_answers WHERE user_id = 1;
SELECT * FROM polls WHERE id IN (SELECT id FROM polls WHERE user_id = 1 INTERSECT SELECT poll_id FROM poll_answers WHERE user_id = 1);
*/
