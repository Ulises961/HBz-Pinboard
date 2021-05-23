g\c postgres;
DROP database hbz;
CREATE database hbz;
\c hbz;

CREATE TABLE Users(
    id SERIAL PRIMARY KEY,
    name VARCHAR(25) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    prefix VARCHAR(10),
    number VARCHAR(20),
    mail VARCHAR(100) NOT NULL UNIQUE,
    password TEXT NOT NULL,
    questions_asked INTEGER NOT NULL,
    answers_given INTEGER NOT NULL,

    CONSTRAINT valid_mail CHECK (mail ~ '^(.+)@(.+)$'),
    CONSTRAINT valid_prefix CHECK (prefix ~ '^(\+)?(?:[0-9]?){1,4}'),
    CONSTRAINT valid_number CHECK (number ~ '^\d{4}(\s)?\d{6}')
);

CREATE TABLE Post(
    id SERIAL PRIMARY KEY,
    users INTEGER NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    title VARCHAR(255) NOT NULL,
    text TEXT NOT NULL,
    votes INTEGER NOT NULL,

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
        
    CONSTRAINT answer_must_belong_to_an_existing_question FOREIGN KEY(question_id)
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

    CONSTRAINT comment_must_belong_to_an_existing_user FOREIGN KEY(users)
        REFERENCES Users(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED,
    
    CONSTRAINT comment_must_belong_to_an_existing_post FOREIGN KEY(post)
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

    CONSTRAINT vote_must_belong_to_an_existing_user FOREIGN KEY(users)
        REFERENCES Users(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED,
    
    CONSTRAINT vote_must_belong_to_an_existing_post FOREIGN KEY(post)
        REFERENCES Post(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED
);

CREATE TABLE Tag(
    id SERIAL PRIMARY KEY,
    name VARCHAR(25) UNIQUE
);

CREATE TABLE HasTag(
    tag INTEGER NOT NULL,
    post INTEGER NOT NULL,
    
    PRIMARY KEY(tag, post),

    CONSTRAINT  tag_must_exist FOREIGN KEY(tag)
        REFERENCES Tag(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
        DEFERRABLE INITIALLY DEFERRED,
    
    CONSTRAINT  tag_must_belong_to_an_existing_post FOREIGN KEY(tag)
        REFERENCES Tag(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED
);

CREATE TYPE FILETYPE AS ENUM ('png', 'jpeg', 'jpg');

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


CREATE OR REPLACE FUNCTION update_vote_if_it_exists()
RETURNS TRIGGER AS $$
DECLARE vote RECORD;
BEGIN
    SELECT EXISTS( SELECT * FROM Vote WHERE users = NEW.users AND post = NEW.post) INTO vote;

    IF vote.exists THEN 
        SELECT * FROM Vote WHERE users = NEW.users AND post = NEW.post INTO vote;

        IF vote.value != NEW.value THEN
            UPDATE Vote
            SET value = NEW.value
            WHERE users = NEW.users AND post = NEW.post;
        END IF;

        RETURN NULL;
    ELSE
        RETURN NEW;
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION update_post_votes_on_insert()
RETURNS TRIGGER AS $$
BEGIN

    IF NEW.value THEN 
        UPDATE Post
        SET votes = votes + 1
        WHERE id = NEW.post;
    ELSE
        UPDATE Post
        SET votes = votes - 1
        WHERE id = NEW.post;
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION update_post_votes_on_update()
RETURNS TRIGGER AS $$
BEGIN

    IF NEW.value THEN 
        UPDATE Post
        SET votes = votes + 2
        WHERE id = NEW.post;
    ELSE
        UPDATE Post
        SET votes = votes - 2
        WHERE id = NEW.post;
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION update_vote_if_it_exists()
RETURNS TRIGGER AS $$
DECLARE vote RECORD;
BEGIN
    SELECT EXISTS( SELECT * FROM Vote WHERE users = NEW.users AND post = NEW.post) INTO vote;

    IF vote.exists THEN 
        SELECT * FROM Vote WHERE users = NEW.users AND post = NEW.post INTO vote;

        IF vote.value != NEW.value THEN
            UPDATE Vote
            SET value = NEW.value
            WHERE users = NEW.users AND post = NEW.post;
        END IF;

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

CREATE TRIGGER has_user_already_voted_update_vote
BEFORE INSERT ON Vote
FOR EACH ROW EXECUTE
PROCEDURE update_vote_if_it_exists();

CREATE TRIGGER change_post_votes_on_insert
AFTER INSERT ON Vote
FOR EACH ROW EXECUTE
PROCEDURE update_post_votes_on_insert();

CREATE TRIGGER change_post_votes_on_update
AFTER UPDATE ON Vote
FOR EACH ROW EXECUTE
PROCEDURE update_post_votes_on_update();



