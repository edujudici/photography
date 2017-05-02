CREATE TABLE empresa
(
  emp_id serial NOT NULL,
  emp_description character varying(75) NOT NULL,
  emp_token character varying(16) NOT NULL,
  created_at timestamp without time zone,
  updated_at timestamp without time zone,
  CONSTRAINT emp_id PRIMARY KEY (emp_id)
);

CREATE TABLE image
(
  img_id serial NOT NULL,
  img_path character varying(255) NOT NULL,
  emp_id integer NOT NULL,
  created_at timestamp without time zone,
  updated_at timestamp without time zone,
  CONSTRAINT img_id_pk PRIMARY KEY (img_id),
  CONSTRAINT empresa_image_fk FOREIGN KEY (emp_id)
      REFERENCES empresa (emp_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);