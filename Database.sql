
CREATE DATABASE ticket_tracking_system;

USE ticket_tracking_system;

CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(50) NOT NULL,
    UserType ENUM('user', 'maintenance', 'other') NOT NULL
);

CREATE TABLE Tickets (
    TicketID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(100) NOT NULL,
    Subject VARCHAR(255) NOT NULL,
    AuthorID INT NOT NULL,
    Status ENUM('new', 'in progress', 'completed') NOT NULL,
    CreationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CompletionDate TIMESTAMP NULL,
    FOREIGN KEY (AuthorID) REFERENCES Users(UserID)
);

CREATE TABLE Comments (
    CommentID INT AUTO_INCREMENT PRIMARY KEY,
    TicketID INT NOT NULL,
    AuthorID INT NOT NULL,
    CommentText TEXT NOT NULL,
    CommentDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (TicketID) REFERENCES Tickets(TicketID),
    FOREIGN KEY (AuthorID) REFERENCES Users(UserID)
);