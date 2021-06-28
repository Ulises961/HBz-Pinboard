\c postgres;
DROP database hbz;
CREATE database hbz;
\c hbz;

CREATE TABLE Faculty(
    code SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
    
); 
-- inclusion in program

CREATE TABLE Program(
    code SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
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
    ECTs NUMERIC CHECK ( ECTs >= 0 AND ECTs <= 40 OR ECTs = -1),
    name VARCHAR(300) UNIQUE
);
--inclusion in Taught-in

CREATE TABLE Users(
    id SERIAL PRIMARY KEY,
    name VARCHAR(25) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    prefix VARCHAR(10),
    number VARCHAR(20),
    mail VARCHAR(100) NOT NULL UNIQUE,
    password TEXT NOT NULL,
    oneTimeCode NUMERIC,
    recoveryMode BOOLEAN UNIQUE,
    picture VARCHAR(200) DEFAULT 'images/user.png',

    CONSTRAINT valid_mail CHECK (mail ~ '^(.+)@(.+)$'),
    CONSTRAINT valid_prefix CHECK (prefix ~ '^(\+)?(?:[0-9]?){1,4}'),
    CONSTRAINT valid_number CHECK (number ~ '^\d{4}(\s)?\d{6}')
);

CREATE TABLE Professor(
    id INTEGER PRIMARY KEY,
    office_hours VARCHAR(200),
    office VARCHAR(35),

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
    name VARCHAR(255) NOT NULL,
    last_change DATE,
    last_message VARCHAR(255) 
);

CREATE TABLE PartecipatesInConversation(
    conversation INTEGER NOT NULL,
    users INTEGER NOT NULL,
    isAdmin BOOLEAN,
    
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

CREATE TABLE PrivateConversation(
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    last_change DATE,
    last_message VARCHAR(255),
    user_a INTEGER NOT NULL,
    user_b INTEGER NOT NULL,
    blocked BOOLEAN NOT NULL,
    wasBlockedBy INTEGER,
    
    CONSTRAINT there_can_be_only_one_privateConversation_between_users 
    UNIQUE (user_a, user_b),

    CONSTRAINT user_a__must_exist FOREIGN KEY(user_a)
        REFERENCES Users(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED,

    CONSTRAINT user_b__must_exist FOREIGN KEY(user_b)
        REFERENCES Users(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED
);

CREATE TABLE PrivateMessageTo(
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
    
    CONSTRAINT message_is_sent_in_privateConversation FOREIGN KEY(conversation)
        REFERENCES PrivateConversation(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
        DEFERRABLE INITIALLY DEFERRED
);


-- STORED PROCEDURES

CREATE OR REPLACE FUNCTION insertSendsMessageTo()
RETURNS TRIGGER AS $$
BEGIN

    IF NEW.time > LOCALTIME OR NEW.date > CURRENT_DATE OR NEW.date < CURRENT_DATE THEN 
        RAISE EXCEPTION 'INVALID TIME OR DATE!';
        RETURN NULL;
    ELSE
        RETURN NEW;
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION isUserPartOfConversation()
RETURNS TRIGGER AS $$
DECLARE participation RECORD;
BEGIN

    SELECT EXISTS(  SELECT users
                    FROM PartecipatesInConversation 
                    WHERE users = NEW.users AND conversation = NEW.conversation
                ) INTO participation;

    IF participation.exists THEN 
        RETURN NEW;     
    ELSE
        RAISE EXCEPTION 'THE USER IS NOT A PARTECIPANT OF THIS CONVERSATION';
        RETURN NULL;
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION is_post_a_question()
RETURNS TRIGGER AS $$
DECLARE question RECORD;
BEGIN
    SELECT EXISTS( SELECT id FROM Question WHERE id  = NEW.id) INTO question;

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
    SELECT EXISTS( SELECT id FROM Answer WHERE id  = NEW.id) INTO answer;

    IF answer.exists THEN 
        RETURN NULL;
    ELSE
        RETURN NEW;
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION update_conversation()
RETURNS TRIGGER AS $$
BEGIN
    UPDATE conversation
    SET last_change = NEW.date, last_message = NEW.text
    WHERE id = NEW.conversation;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION update_privateConversation()
RETURNS TRIGGER AS $$
BEGIN
    UPDATE PrivateConversation
    SET last_change = NEW.date, last_message = NEW.text
    WHERE id = NEW.conversation;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION block_message_if_conversation_is_blocked()
RETURNS TRIGGER AS $$
DECLARE privateConversation RECORD;
BEGIN

    SELECT blocked FROM PrivateConversation WHERE id = NEW.conversation INTO privateConversation;

    IF privateConversation.blocked THEN 
        RAISE EXCEPTION 'The conversation has been blocked';
        RETURN NULL;         
    ELSE
        RETURN NEW;  
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION is_user_logged_in()
RETURNS TRIGGER AS $$
DECLARE active_session RECORD;
BEGIN
    SELECT EXISTS(  SELECT id 
                    FROM Session 
                    WHERE users = NEW.users AND end_time ISNULL AND date = CURRENT_DATE
                ) INTO active_session;

    IF active_session.exists THEN 
        RETURN NEW;
    ELSE
        RAISE EXCEPTION 'You must be logged in to do the requested operation where user id is % and active session is %', user,active_session;
        RETURN NULL;
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION is_user_professor()
RETURNS TRIGGER AS $$
DECLARE professor RECORD;
BEGIN
    SELECT EXISTS( SELECT id FROM Professor WHERE id = NEW.id) INTO professor;

    IF professor.exists THEN 
        RETURN NULL;
    ELSE
        RETURN NEW;
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION is_user_student()
RETURNS TRIGGER AS $$
DECLARE student RECORD;
BEGIN
    SELECT EXISTS( SELECT id FROM Student WHERE id  = NEW.id) INTO student;
  
    IF student.exists THEN
        RETURN NULL;
    ELSE
        RETURN NEW;
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION checkExistingProfessor()
RETURNS TRIGGER AS $$
DECLARE possibleProfessor RECORD;
BEGIN
    SELECT EXISTS( SELECT Professor.id FROM Professor JOIN Users on Professor.id = Users.id WHERE Users.mail=New.mail ) INTO possibleProfessor;

    IF possibleProfessor.exists THEN 
        UPDATE Users SET password=NEW.password WHERE Users.mail = NEW.mail;
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
    SELECT EXISTS( SELECT users FROM Vote WHERE users = NEW.users AND post = NEW.post) INTO vote;

    IF vote.exists THEN

        UPDATE Vote
        SET value = NOT value
        WHERE users = NEW.users AND post = NEW.post;

        RETURN NULL;
    ELSE
        RETURN NEW;
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION update_post_votes()
RETURNS TRIGGER AS $$
DECLARE likes RECORD;
BEGIN

    SELECT count(id) FROM Vote WHERE post = NEW.post AND value = true INTO likes;

    UPDATE Post
    SET votes = likes.count
    WHERE id = NEW.post;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- TRIGGERS

CREATE TRIGGER insert_sendsMessageTo
BEFORE INSERT ON SendsMessageTo
FOR EACH ROW EXECUTE
PROCEDURE insertSendsMessageTo();

CREATE TRIGGER is_user_part_of_conversation
BEFORE INSERT ON SendsMessageTo
FOR EACH ROW EXECUTE
PROCEDURE isUserPartOfConversation();

CREATE TRIGGER is_user_blocked
BEFORE INSERT ON PrivateMessageTo
FOR EACH ROW EXECUTE
PROCEDURE block_message_if_conversation_is_blocked();

CREATE TRIGGER check_if_question_is_an_answer
BEFORE INSERT ON Question
FOR EACH ROW EXECUTE
PROCEDURE is_post_an_answer();

CREATE TRIGGER check_if_answer_is_a_question
BEFORE INSERT ON Answer
FOR EACH ROW EXECUTE
PROCEDURE is_post_a_question();

CREATE TRIGGER update_conversation
AFTER INSERT ON SendsMessageTo
FOR EACH ROW EXECUTE
PROCEDURE update_conversation();

CREATE TRIGGER update_privateConversation
AFTER INSERT ON PrivateMessageTo
FOR EACH ROW EXECUTE
PROCEDURE update_privateConversation();

CREATE TRIGGER insert_professor
BEFORE INSERT ON Professor
FOR EACH ROW EXECUTE
PROCEDURE is_user_student();

CREATE TRIGGER insert_student
BEFORE INSERT ON Student
FOR EACH ROW EXECUTE
PROCEDURE is_user_professor();

CREATE TRIGGER check_login_SendsMessageTo
BEFORE INSERT OR UPDATE OR DELETE ON SendsMessageTo
FOR EACH ROW EXECUTE PROCEDURE is_user_logged_in();

CREATE TRIGGER check_login_Comment
BEFORE INSERT OR UPDATE OR DELETE ON Comment
FOR EACH ROW EXECUTE PROCEDURE is_user_logged_in();

CREATE TRIGGER checkExistingProfessor
BEFORE INSERT  ON Users
FOR EACH ROW EXECUTE PROCEDURE checkExistingProfessor();

CREATE TRIGGER has_user_already_voted_update_vote
BEFORE INSERT ON Vote
FOR EACH ROW EXECUTE
PROCEDURE update_vote_if_it_exists();

CREATE TRIGGER change_post_votes_on_insert_and_update
AFTER INSERT OR UPDATE ON Vote
FOR EACH ROW EXECUTE
PROCEDURE update_post_votes();