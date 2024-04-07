-- Access for everyone to create a login and ask questions or leave reviews, sets default as normal non-admin
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(256) NOT NULL UNIQUE,
    password VARCHAR(64) NOT NULL,
    access_type ENUM('normal', 'admin') NOT NULL DEFAULT 'normal'
);
-- Determines if user is admin and who gets admin key, (will be selected by website owner)
CREATE TABLE admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNIQUE,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);
-- After user is created, they can now leave comments or questions about website and of which admins will reply to answer questions
CREATE TABLE question_comment (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    question_id INT,
    comment_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY (question_id) REFERENCES question(question_id) ON DELETE CASCADE
);
-- Stores admin replies towards questions the user created in question_comment table
CREATE TABLE reply (
    reply_id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT,
    comment_id INT,
    reply_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES admin(admin_id) ON DELETE CASCADE,
    FOREIGN KEY (comment_id) REFERENCES question_comment(comment_id) ON DELETE CASCADE
);
-- Allows users to create a review of the website
    CREATE TABLE website_review (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    review_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);
    
