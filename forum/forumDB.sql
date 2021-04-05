CREATE TABLE Users(
    id SERIAL PRIMARY KEY,
    name VARCHAR(25) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    prefix VARCHAR(10),
    number VARCHAR(20),
    mail VARCHAR(100) NOT NULL UNIQUE,
    password TEXT NOT NULL,

    CONSTRAINT valid_mail CHECK (mail ~ '^(.+)@(.+)$'),
    CONSTRAINT valid_prefix CHECK (prefix ~ '^\+(?:[0-9]?){1,4}'),
    CONSTRAINT valid_number CHECK (number ~ '^\d{4}\s\d{6}')
);

CREATE TYPE FILETYPE AS ENUM ('png', 'jpeg', 'jpg');

CREATE TABLE Post(
    id SERIAL PRIMARY KEY,
    users INTEGER NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    title VARCHAR(255) NOT NULL,
    text TEXT NOT NULL,

    CONSTRAINT postBelongsToUser FOREIGN KEY(users)
        REFERENCES Users(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED
);

CREATE TABLE Question(
    id INTEGER PRIMARY KEY,

    CONSTRAINT question_is_a_Post FOREIGN KEY(id)
        REFERENCES Post(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED
);

CREATE TABLE Answer(
    id INTEGER PRIMARY KEY,
    question_id INTEGER,
    
    CONSTRAINT answer_is_a_Post FOREIGN KEY(id)
        REFERENCES Post(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED,
        
    CONSTRAINT questionid_IsFKInAnswer FOREIGN KEY(question_id)
        REFERENCES Question(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED
);

CREATE TABLE Article(
    id INTEGER PRIMARY KEY,
    validity DATE NOT NULL,
    price NUMERIC NOT NULL,

    CONSTRAINT article_is_a_Post FOREIGN KEY(id)
        REFERENCES Post(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED
);

CREATE TABLE Comment(
    id SERIAL PRIMARY KEY,
    date DATE NOT NULL,
    time TIME NOT NULL,
    text VARCHAR(255) NOT NULL,
    users INTEGER NOT NULL,
    post INTEGER NOT NULL,

    CONSTRAINT commentBelongsToUser FOREIGN KEY(users)
        REFERENCES Users(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED,
    
    CONSTRAINT commentIsPutOnPost FOREIGN KEY(post)
        REFERENCES Post(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED
);

CREATE TABLE Vote(
    id SERIAL PRIMARY KEY,
    date DATE NOT NULL,
    time TIME NOT NULL,
    value BOOLEAN NOT NULL,
    users INTEGER NOT NULL,
    post INTEGER NOT NULL,

    CONSTRAINT voteBelongsToUser FOREIGN KEY(users)
        REFERENCES Users(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED,
    
    CONSTRAINT voteIsPutOnPost FOREIGN KEY(post)
        REFERENCES Post(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED
);

CREATE TABLE Tag(
    id SERIAL PRIMARY KEY,
    name VARCHAR(25) NOT NULL
);

CREATE TABLE HasTag(
    tag INTEGER NOT NULL,
    post INTEGER NOT NULL,
    
    PRIMARY KEY(tag, post),

    CONSTRAINT  tag_is_FK_in_HasTag FOREIGN KEY(tag)
        REFERENCES Tag(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
        DEFERRABLE INITIALLY DEFERRED,
    
    CONSTRAINT  post_is_FK_in_HasTag FOREIGN KEY(tag)
        REFERENCES Tag(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED
);

CREATE TABLE Photo(
    id SERIAL PRIMARY KEY,
    description TEXT,
    url TEXT NOT NULL,
    extension FILETYPE NOT NULL,
    size NUMERIC NOT NULL,
    article INTEGER NOT NULL,

    CONSTRAINT photoBelongsToArticle FOREIGN KEY(article)
        REFERENCES Article(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED
);

CREATE TABLE Session(
    id SERIAL,
    date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME,
    users INTEGER,-- NOT NULL,
    
    CONSTRAINT SessionPKs PRIMARY KEY(id,users),
    CONSTRAINT userIsFK_inSession FOREIGN KEY(users) 
        REFERENCES Users(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED
);

-- STORED PROCEDURES

CREATE OR REPLACE FUNCTION is_post_a_question()
RETURNS TRIGGER AS $$
DECLARE question RECORD;
BEGIN
    SELECT EXISTS( SELECT * FROM Question WHERE id  = NEW.id) INTO question;

    IF question.exists THEN 
        RETURN NULL;
    ELSE
        RETURN NEW;
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION is_post_an_answer()
RETURNS TRIGGER AS $$
DECLARE answer RECORD;
BEGIN
    SELECT EXISTS( SELECT * FROM Answer WHERE id  = NEW.id) INTO answer;

    IF answer.exists THEN 
        RETURN NULL;
    ELSE
        RETURN NEW;
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION is_post_an_article()
RETURNS TRIGGER AS $$
DECLARE article RECORD;
BEGIN
    SELECT EXISTS( SELECT * FROM Article WHERE id  = NEW.id) INTO article;

    IF article.exists THEN 
        RETURN NULL;
    ELSE
        RETURN NEW;
    END IF;
END;
$$ LANGUAGE plpgsql;


-- TRIGGERS

CREATE TRIGGER check_if_article_is_a_question
BEFORE INSERT ON Article
FOR EACH ROW EXECUTE
PROCEDURE is_post_a_question();

CREATE TRIGGER check_if_article_is_an_answer
BEFORE INSERT ON Article
FOR EACH ROW EXECUTE
PROCEDURE is_post_an_answer();

CREATE TRIGGER check_if_question_is_an_article
BEFORE INSERT ON Question
FOR EACH ROW EXECUTE
PROCEDURE is_post_an_article();

CREATE TRIGGER check_if_question_is_an_answer
BEFORE INSERT ON Question
FOR EACH ROW EXECUTE
PROCEDURE is_post_an_answer();

CREATE TRIGGER check_if_answer_is_a_question
BEFORE INSERT ON Answer
FOR EACH ROW EXECUTE
PROCEDURE is_post_a_question();

CREATE TRIGGER check_if_answer_is_an_article
BEFORE INSERT ON Answer
FOR EACH ROW EXECUTE
PROCEDURE is_post_an_article();

-- INSERTS

INSERT INTO Users VALUES(default, 'bob', 'freeman', '+39', '1234 567890', 'bob@gmail.com', 'password');
INSERT INTO Users VALUES(default, 'Frank', 'Miller', '+39', '1234 567890', 'frank@gmail.com', 'password');


