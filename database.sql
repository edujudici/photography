CREATE TABLE company
(
  com_id serial NOT NULL,
  com_description character varying(75) NOT NULL,
  com_token character varying(16) NOT NULL,
  created_at timestamp without time zone,
  updated_at timestamp without time zone,
  CONSTRAINT com_id PRIMARY KEY (com_id)
);

CREATE TABLE image
(
  img_id serial NOT NULL,
  img_path character varying(255) NOT NULL,
  com_id integer NOT NULL,
  created_at timestamp without time zone,
  updated_at timestamp without time zone,
  CONSTRAINT img_id_pk PRIMARY KEY (img_id),
  CONSTRAINT company_image_fk FOREIGN KEY (com_id)
      REFERENCES company (com_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);