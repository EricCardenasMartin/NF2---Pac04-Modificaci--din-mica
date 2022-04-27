CREATE SEQUENCE searches_id_seq;

CREATE TABLE searches (
	id integer NOT NULL PRIMARY KEY DEFAULT nextval('searches_id_seq'),
	paraula TEXT,
	total integer,
	ultimaVisita timestamp
);

ALTER SEQUENCE searches_id_seq
OWNED BY searches.id;