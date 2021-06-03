
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

CREATE TABLE Conversation(
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    last_change DATE,
    last_message VARCHAR(255) 
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

    SELECT EXISTS( SELECT * FROM PartecipatesInConversation WHERE users = NEW.users AND conversation = NEW.conversation) INTO participation;

    IF participation.exists THEN 
        RETURN NEW;     
    ELSE
        RAISE EXCEPTION 'THE USER IS NOT A PARTECIPANT OF THIS CONVERSATION';
        RETURN NULL;
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

    SELECT * FROM PrivateConversation WHERE id = NEW.conversation INTO privateConversation;

    IF privateConversation.blocked THEN 
        RAISE EXCEPTION 'The conversation has been blocked';
        RETURN NULL;         
    ELSE
        RETURN NEW;  
    END IF;
END;
$$ LANGUAGE plpgsql;


-- TRIGGERS

CREATE TRIGGER update_conversation
AFTER INSERT ON SendsMessageTo
FOR EACH ROW EXECUTE
PROCEDURE update_conversation();

CREATE TRIGGER update_privateConversation
AFTER INSERT ON PrivateMessageTo
FOR EACH ROW EXECUTE
PROCEDURE update_privateConversation();

CREATE TRIGGER is_user_part_of_conversation
BEFORE INSERT ON SendsMessageTo
FOR EACH ROW EXECUTE
PROCEDURE isUserPartOfConversation();

CREATE TRIGGER insert_sendsMessageTo
BEFORE INSERT ON SendsMessageTo
FOR EACH ROW EXECUTE
PROCEDURE insertSendsMessageTo();

CREATE TRIGGER is_user_blocked
BEFORE INSERT ON PrivateMessageTo
FOR EACH ROW EXECUTE
PROCEDURE block_message_if_conversation_is_blocked();

-- INSERTS

INSERT INTO Users VALUES(1,'Bob', 'Freeman', '+39', '3961 415473', 'bob@gmail.com', 'password');
INSERT INTO Users VALUES(2,'Frank', 'Miller', '+39', '3961 415473', 'frank@gmail.com', 'password');
INSERT INTO Users VALUES(3,'Markus', 'Zanker', '+39', '3961 415473','zanker@gmail.com', 'password');

INSERT INTO Conversation VALUES(1,'test_conversation');

INSERT INTO PartecipatesInConversation VALUES(1,1);
INSERT INTO PartecipatesInConversation VALUES(1,2);