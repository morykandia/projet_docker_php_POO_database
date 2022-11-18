CREATE TABLE User
(
   id        INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
   username  VARCHAR(255) NOT NULL,
  	password  VARCHAR(255) NOT NULL,
    email     VARCHAR(255) NOT NULL,
   firstName VARCHAR(255),
    lastName  VARCHAR(255),
    gender    CHAR(1),
    roles     JSON         NOT NULL
);

CREATE TABLE IF NOT EXISTS Post
(
    id      INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    content TEXT,
    author INT NOT NULL,
    commentId INT NOT NULL
   
    
);

CREATE TABLE IF NOT EXISTS Comment
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    content TEXT,
    author INT NOT NULL,
    postId INT NOT NULL
    
   
);

ALTER TABLE Post
    ADD CONSTRAINT FK_author_id FOREIGN KEY (author) REFERENCES User(id),
        CONSTRAINT FK_comment_id FOREIGN KEY (commentId) REFERENCES Comment(id);
    
ALTER TABLE Comment
    ADD CONSTRAINT FK_author_id FOREIGN KEY (author) REFERENCES User(id),
        CONSTRAINT FK_post_id FOREIGN KEY (postId) REFERENCES Post(id);




