CREATE SCHEMA ksms;

CREATE TABLE ksms.person (
	id bigserial PRIMARY KEY,
	name character varying NOT NULL,
	street character varying NOT NULL,
	town character varying NOT NULL,
	phone numeric(10,0)
);

CREATE TABLE ksms.student (
	person_id bigserial PRIMARY KEY,
	enroll_date timestamp with time zone NOT NULL,
	drop_date timestamp with time zone NOT NULL,
 	FOREIGN KEY (person_id) REFERENCES ksms.person (id)
);

CREATE TABLE ksms.payment_type (
	id serial PRIMARY KEY,
	description character varying NOT NULL
);

CREATE TABLE ksms.payment (
	person_id bigserial PRIMARY KEY,
	amount numeric(10,2) NOT NULL,
	payment_date timestamp with time zone NOT NULL,
	payment_type_id bigserial,
 	FOREIGN KEY (person_id) REFERENCES ksms.person (id),
	FOREIGN KEY (payment_type_id) REFERENCES ksms.payment_type (id)
);
