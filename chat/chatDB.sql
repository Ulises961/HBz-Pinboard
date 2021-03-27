
CREATE TABLE Faculty(
    code SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL
    
); 
-- inclusion in program

CREATE TABLE Program(
    code SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    duration NUMERIC NOT NULL,
    faculty INTEGER,

    CONSTRAINT faculty_IsFKinProgram FOREIGN KEY(faculty)
        REFERENCES faculty(code)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
        DEFERRABLE INITIALLY DEFERRED
);

CREATE TABLE Subject(
    id SERIAL PRIMARY KEY,
    ECTs NUMERIC CHECK ( ECTs > 0 AND ECTs < 35),
    name VARCHAR(50)
);
--inclusion in Taught-in

CREATE TABLE Users(
    id SERIAL PRIMARY KEY,
    name VARCHAR(25) NOT NULL,
    surname VARCHAR(25) NOT NULL,
    prefix VARCHAR(20),
    number VARCHAR(20),
    mail VARCHAR(100) NOT NULL UNIQUE,
    password TEXT NOT NULL,

    CONSTRAINT valid_mail CHECK (mail ~ '^(.+)@(.+)$'),
    CONSTRAINT valid_prefix CHECK (prefix ~ '^\+(?:[0-9]?){1,4}'),
    CONSTRAINT valid_number CHECK (number ~ '^\d{4}\s\d{6}')
);

CREATE TABLE Professor(
    id INTEGER PRIMARY KEY,
    office_hours DATE,
    office VARCHAR(8),

    CONSTRAINT professor_is_a_user FOREIGN KEY(id)
        REFERENCES Users(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED
);

CREATE TABLE Taught_in(
    subject INTEGER,
    program INTEGER,
    
    CONSTRAINT PK_Taught_In PRIMARY KEY(subject, program),
    CONSTRAINT subject_IsPKInTaughtIn FOREIGN KEY(subject)
        REFERENCES subject(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
        DEFERRABLE INITIALLY DEFERRED
);
CREATE TABLE Teaches(
    professor INTEGER,
    subject INTEGER,

    CONSTRAINT PK_Teaches PRIMARY KEY(professor,subject),
    CONSTRAINT professor_is_fk_in_Teaches FOREIGN KEY(professor)
        REFERENCES Professor(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
        DEFERRABLE INITIALLY DEFERRED,

        CONSTRAINT subject_is_fk_in_Teaches FOREIGN KEY(subject)
        REFERENCES subject(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
        DEFERRABLE INITIALLY DEFERRED

);

CREATE TABLE Student(
    id INTEGER PRIMARY KEY,
    program INTEGER NOT NULL,
    
    CONSTRAINT student_is_a_user FOREIGN KEY(id)
        REFERENCES Users(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED,

    CONSTRAINT programIsInStudent FOREIGN KEY(program)
        REFERENCES Program(code)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
        DEFERRABLE INITIALLY DEFERRED
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

CREATE TABLE Conversation(
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE PartecipatesInConversation(
    conversation INTEGER NOT NULL,
    users INTEGER NOT NULL,
    
    PRIMARY KEY(conversation, users)
);

CREATE TABLE SendsMessageTo(
    id SERIAL PRIMARY KEY,
    date DATE NOT NULL,
    time TIME NOT NULL,
    text VARCHAR(255) NOT NULL,
    users INTEGER NOT NULL,
    conversation INTEGER NOT NULL,

    CONSTRAINT message_belongs_to_user FOREIGN KEY(users)
        REFERENCES Users(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED,
    
    CONSTRAINT message_is_sent_in_conversation FOREIGN KEY(conversation)
        REFERENCES Conversation(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED
);


-- TRIGGERS

CREATE OR REPLACE FUNCTION insertArticle()
RETURNS TRIGGER AS $$
DECLARE answer RECORD;
DECLARE question RECORD;
BEGIN
    SELECT EXISTS( SELECT * FROM Question WHERE id  = NEW.id) INTO question;
    SELECT EXISTS( SELECT * FROM Answer WHERE id  = NEW.id) INTO answer;

    IF question.exists OR answer.exists THEN 
        RETURN NULL;
    ELSE
        RETURN NEW;
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER insert_article
BEFORE INSERT ON Article
FOR EACH ROW EXECUTE
PROCEDURE insertArticle();

CREATE OR REPLACE FUNCTION insertAnswer()
RETURNS TRIGGER AS $$
DECLARE question RECORD;
DECLARE article RECORD;
BEGIN
    SELECT EXISTS( SELECT * FROM Question WHERE id  = NEW.id) INTO question;
    SELECT EXISTS( SELECT * FROM Article WHERE id  = NEW.id) INTO article;

    IF question.exists OR article.exists THEN 
        RETURN NULL;
    ELSE
        RETURN NEW;
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER insert_answer
BEFORE INSERT ON Answer
FOR EACH ROW EXECUTE
PROCEDURE insertAnswer();

CREATE OR REPLACE FUNCTION insertQuestion()
RETURNS TRIGGER AS $$
DECLARE answer RECORD;
DECLARE article RECORD;
BEGIN
    SELECT EXISTS( SELECT * FROM Answer WHERE id  = NEW.id) INTO answer;
    SELECT EXISTS( SELECT * FROM Article WHERE id  = NEW.id) INTO article;

    IF article.exists OR answer.exists THEN 
        RETURN NULL;
    ELSE
        RETURN NEW;
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER insert_question
BEFORE INSERT ON Question
FOR EACH ROW EXECUTE
PROCEDURE insertQuestion();

-- THE FOLLOWING ARE INSERTS USED TO TEST THE TRIGGERS

--  INSERT INTO Users VALUES(1,'bob', 'freeman', '+39', '3961415473', 'password', 'bob@gmail.com');

-- INSERT INTO Post VALUES(1, 1, '14.03.2021', '14:05:00', 'title', 'question');
-- INSERT INTO Question VALUES(1);  <== this should work

-- INSERT INTO Post VALUES(2, 1, '14.03.2021', '14:05:00', 'title', 'this is an answer');

-- INSERT INTO Answer VALUES(1,1); <== this should not work

-- INSERT INTO Answer VALUES(2,1); <== this should work
-- INSERT INTO Session VALUES(1,'14-02-2021', '15:15:00','16:00:00', NULL);

CREATE OR REPLACE FUNCTION insertProfessor()
RETURNS TRIGGER AS $$
DECLARE student RECORD;
BEGIN
    SELECT EXISTS( SELECT * FROM Student WHERE id  = NEW.id) INTO student;
  
    IF student.exists THEN
        RETURN NULL;
    ELSE
        RETURN NEW;
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER insert_professor
BEFORE INSERT ON Professor
FOR EACH ROW EXECUTE
PROCEDURE insertProfessor();


CREATE OR REPLACE FUNCTION insertStudent()
RETURNS TRIGGER AS $$
DECLARE professor RECORD;
BEGIN
    SELECT EXISTS( SELECT * FROM Professor WHERE id = NEW.id) INTO professor;

    IF professor.exists THEN 
        RETURN NULL;
    ELSE
        RETURN NEW;
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER insert_student
BEFORE INSERT ON Student
FOR EACH ROW EXECUTE
PROCEDURE insertStudent();

INSERT INTO Users VALUES(1,'Bob', 'Freeman', '+39', '3961 415473', 'bob@gmail.com', 'password');
INSERT INTO Users VALUES(2,'Frank', 'Miller', '+39', '3961 415473', 'frank@gmail.com', 'password');
INSERT INTO Users VALUES(3,'Markus', 'Zanker', '+39', '3961 415473','zanker@gmail.com', 'password');

INSERT INTO Conversation VALUES(1,'test_conversation');

INSERT INTO PartecipatesInConversation VALUES(1,1);
INSERT INTO PartecipatesInConversation VALUES(1,2);

id SERIAL PRIMARY KEY,
    date DATE NOT NULL,
    time TIME NOT NULL,
    text VARCHAR(255) NOT NULL,
    users INTEGER NOT NULL,
    conversation INTEGER NOT NULL,

INSERT INTO SendsMessageTo VALUES(default, '26/03/2021', '15:26:00', 'this should update', 3,1);

