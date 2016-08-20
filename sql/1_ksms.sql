CREATE SCHEMA ksms;

CREATE TABLE ksms.person (
	id bigserial PRIMARY KEY,
	name character varying NOT NULL,
	street character varying NOT NULL,
	town character varying NOT NULL,
	phone numeric(10,0),
	email_address character varying NOT NULL
);

CREATE TABLE ksms.belt (
	id serial PRIMARY KEY,
	description character varying NOT NULL
);

CREATE TABLE ksms.student (
	person_id bigserial PRIMARY KEY REFERENCES ksms.person (id),
	enroll_date timestamp with time zone NOT NULL,
	drop_date timestamp with time zone NOT NULL,
	grading_date timestamp with time zone,
	belt_id integer REFERENCES ksms.belt (id)
);

CREATE TABLE ksms.membership_hold (
	student_id bigserial REFERENCES ksms.student (person_id),
	start_date timestamp with time zone NOT NULL,
	end_ate timestamp with time zone NOT NULL
);

CREATE TABLE ksms.payment_type (
	id serial PRIMARY KEY,
	description character varying NOT NULL
);

CREATE TABLE ksms.payment (
	person_id bigserial PRIMARY KEY REFERENCES ksms.person (id),
	amount numeric(10,2) NOT NULL,
	payment_date timestamp with time zone NOT NULL,
	payment_type_id bigserial REFERENCES ksms.payment_type (id)
);

CREATE TABLE ksms.grading (
	id bigserial PRIMARY KEY,
	grading_date timestamp with time zone NOT NULL,
	cost numeric(10,2) NOT NULL
);

CREATE TABLE ksms.belt_attempt (
	student_id bigserial REFERENCES ksms.student (person_id),
	grading_id bigserial REFERENCES ksms.grading (id),
	belt_id bigserial,
	pass boolean NOT NULL,
	PRIMARY KEY (student_id, grading_id)
);

INSERT INTO ksms.payment_type (description) VALUES
	('VISA'),
	('MASTERCARD'),
	('PAYPAL'),
	('CASH');

INSERT INTO ksms.belt (description) VALUES
	('WHITE'),
	('YELLOW'),
	('BLUE'),
	('RED'),
	('BLACK');
