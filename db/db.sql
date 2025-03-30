DROP DATABASE IF EXISTS student_course_hub;
CREATE DATABASE student_course_hub;
USE student_course_hub;

-- clearing batabase tables
DROP TABLE IF EXISTS interestedstudents;
DROP TABLE IF EXISTS programmemodules;
DROP TABLE IF EXISTS programmes;
DROP TABLE IF EXISTS modules;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS staff;
DROP TABLE IF EXISTS levels;

-- Recreate schema
CREATE TABLE levels (
    LevelID INTEGER PRIMARY KEY,
    LevelName TEXT NOT NULL
);

CREATE TABLE staff (
    StaffID INTEGER PRIMARY KEY,
    Name TEXT NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Department VARCHAR(100) NOT NULL,
    Position VARCHAR(100) NOT NULL,
    HireDate DATE NOT NULL,
    Phone VARCHAR(20)
);

CREATE TABLE modules (
    ModuleID INTEGER PRIMARY KEY,
    ModuleName TEXT NOT NULL,
    ModuleLeaderID INTEGER,
    Description TEXT,
    Image TEXT,
    FOREIGN KEY (ModuleLeaderID) REFERENCES staff(StaffID)
);

CREATE TABLE programmes (
    ProgrammeID INTEGER PRIMARY KEY AUTO_INCREMENT,
    ProgrammeName TEXT NOT NULL,
    LevelID INTEGER,
    ProgrammeLeaderID INTEGER,
    Description TEXT,
    Image TEXT,
    status BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (LevelID) REFERENCES levels(LevelID),
    FOREIGN KEY (ProgrammeLeaderID) REFERENCES staff(StaffID)
);

CREATE TABLE programmemodules (
    ProgrammeModuleID INTEGER PRIMARY KEY AUTO_INCREMENT,
    ProgrammeID INTEGER,
    ModuleID INTEGER,
    Year INTEGER,
    FOREIGN KEY (ProgrammeID) REFERENCES programmes(ProgrammeID),
    FOREIGN KEY (ModuleID) REFERENCES modules(ModuleID)
);

CREATE TABLE interestedstudents (
    InterestID INT AUTO_INCREMENT PRIMARY KEY,
    ProgrammeID INT NOT NULL,
    StudentName VARCHAR(100) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    RegisteredAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ProgrammeID) REFERENCES programmes(ProgrammeID) ON DELETE CASCADE
);

ALTER TABLE interestedstudents ADD UNIQUE INDEX(ProgrammeID, Email);

CREATE TABLE users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,  -- Storing hashed passwords
    UserType ENUM('admin', 'staff') NOT NULL,
    StaffID INT NULL,
    LastLogin TIMESTAMP NULL,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (StaffID) REFERENCES staff(StaffID) ON DELETE SET NULL,
    INDEX (Username)
);

-- Create a view for published programmes
CREATE VIEW published_programmes AS
SELECT * FROM programmes
WHERE status = TRUE;

-- Create a view for easier access to user information
CREATE VIEW UserDetails AS
SELECT 
    u.UserID,
    u.Username,
    u.UserType,
    s.StaffID,
    s.Name AS StaffName,
    s.Email,
    s.Department,
    s.Position,
    u.LastLogin,
    u.CreatedAt
FROM 
    users u
LEFT JOIN 
    staff s ON u.StaffID = s.StaffID;


-- Users and previlages 
DROP USER IF EXISTS 'admin'@'localhost';
DROP USER IF EXISTS 'staff'@'localhost';
DROP USER IF EXISTS 'web_app'@'localhost';

CREATE USER IF NOT EXISTS 'admin'@'localhost' IDENTIFIED BY 'admin';
GRANT ALL PRIVILEGES ON student_course_hub.* TO 'admin'@'localhost';

CREATE USER IF NOT EXISTS 'staff'@'localhost' IDENTIFIED BY 'staff';
GRANT SELECT ON student_course_hub.* TO 'staff'@'localhost';
GRANT UPDATE ON student_course_hub.users TO 'staff'@'localhost';

CREATE USER IF NOT EXISTS 'web_app'@'localhost' IDENTIFIED BY 'web_app';
GRANT SELECT ON `student_course_hub`.* TO `web_app`@`localhost`;
GRANT INSERT ON student_course_hub.interestedstudents TO 'web_app'@'localhost';

FLUSH PRIVILEGES;

SHOW GRANTS FOR 'admin'@'localhost';
SHOW GRANTS FOR 'staff'@'localhost';
SHOW GRANTS FOR 'web_app'@'localhost';

-- Seed data
-- levels
INSERT INTO levels (LevelID, LevelName) VALUES
(1, 'Undergraduate'),
(2, 'Postgraduate');

-- staff with expanded information
INSERT INTO staff (StaffID, Name, Email, Department, Position, HireDate, Phone) VALUES
(1, 'Dr. Alice Johnson', 'alice.johnson@university.edu', 'Computer Science', 'Professor', '2015-09-01', '555-1001'),
(2, 'Dr. Brian Lee', 'brian.lee@university.edu', 'Mathematics', 'Associate Professor', '2016-03-15', '555-1002'),
(3, 'Dr. Carol White', 'carol.white@university.edu', 'Computer Science', 'Assistant Professor', '2017-01-10', '555-1003'),
(4, 'Dr. David Green', 'david.green@university.edu', 'Information Systems', 'Senior Lecturer', '2014-08-20', '555-1004'),
(5, 'Dr. Emma Scott', 'emma.scott@university.edu', 'Software Engineering', 'Professor', '2013-09-05', '555-1005'),
(6, 'Dr. Frank Moore', 'frank.moore@university.edu', 'Computer Science', 'Associate Professor', '2016-11-01', '555-1006'),
(7, 'Dr. Grace Adams', 'grace.adams@university.edu', 'Cyber Security', 'Professor', '2014-07-15', '555-1007'),
(8, 'Dr. Henry Clark', 'henry.clark@university.edu', 'Artificial Intelligence', 'Professor', '2012-02-28', '555-1008'),
(9, 'Dr. Irene Hall', 'irene.hall@university.edu', 'Data Science', 'Associate Professor', '2015-05-12', '555-1009'),
(10, 'Dr. James Wright', 'james.wright@university.edu', 'Cyber Security', 'Assistant Professor', '2017-09-01', '555-1010'),
(11, 'Dr. Sophia Miller', 'sophia.miller@university.edu', 'Machine Learning', 'Professor', '2011-08-15', '555-1011'),
(12, 'Dr. Benjamin Carter', 'benjamin.carter@university.edu', 'Cyber Security', 'Professor', '2010-06-01', '555-1012'),
(13, 'Dr. Chloe Thompson', 'chloe.thompson@university.edu', 'Data Science', 'Professor', '2012-09-15', '555-1013'),
(14, 'Dr. Daniel Robinson', 'daniel.robinson@university.edu', 'Cloud Computing', 'Associate Professor', '2014-01-20', '555-1014'),
(15, 'Dr. Emily Davis', 'emily.davis@university.edu', 'Blockchain Technology', 'Assistant Professor', '2016-04-10', '555-1015'),
(16, 'Dr. Nathan Hughes', 'nathan.hughes@university.edu', 'Artificial Intelligence', 'Senior Lecturer', '2015-03-01', '555-1016'),
(17, 'Dr. Olivia Martin', 'olivia.martin@university.edu', 'Quantum Computing', 'Associate Professor', '2013-11-15', '555-1017'),
(18, 'Dr. Samuel Anderson', 'samuel.anderson@university.edu', 'Cyber Security', 'Professor', '2009-09-01', '555-1018'),
(19, 'Dr. Victoria Hall', 'victoria.hall@university.edu', 'Neural Networks', 'Professor', '2011-07-01', '555-1019'),
(20, 'Dr. William Scott', 'william.scott@university.edu', 'Human-Computer Interaction', 'Associate Professor', '2014-09-01', '555-1020');

-- Insert admin and staff users
INSERT INTO users (Username, Password, UserType, StaffID) VALUES
-- Admin users
('admin_main', SHA2('admin_secure123', 256), 'admin', 1),
('admin_systems', SHA2('systems_pass456', 256), 'admin', 5),
('admin_security', SHA2('security_strong789', 256), 'admin', 12),
('admin_data', SHA2('data_analytics101', 256), 'admin', 13),
('admin_tech', SHA2('tech_support202', 256), 'admin', 8),
-- staff users
('brian_staff', SHA2('brian_2023', 256), 'staff', 2),
('carol_staff', SHA2('carol_pass', 256), 'staff', 3),
('david_staff', SHA2('david_2024', 256), 'staff', 4),
('frank_staff', SHA2('frank_secure', 256), 'staff', 6),
('grace_staff', SHA2('grace_2023', 256), 'staff', 7),
('henry_staff', SHA2('henry_secure', 256), 'staff', 8),
('irene_staff', SHA2('irene_pass', 256), 'staff', 9),
('james_staff', SHA2('james_2024', 256), 'staff', 10),
('nathan_staff', SHA2('nathan_secure', 256), 'staff', 16),
('olivia_staff', SHA2('olivia_2023', 256), 'staff', 17);

-- modules
INSERT INTO modules (ModuleID, ModuleName, ModuleLeaderID, Description) VALUES
(1, 'Introduction to Programming', 1, 'Covers the fundamentals of programming using Python and Java.'),
(2, 'Mathematics for Computer Science', 2, 'Teaches discrete mathematics, linear algebra, and probability theory.'),
(3, 'Computer Systems & Architecture', 3, 'Explores CPU design, memory management, and assembly language.'),
(4, 'Databases', 4, 'Covers SQL, relational database design, and NoSQL systems.'),
(5, 'Software Engineering', 5, 'Focuses on agile development, design patterns, and project management.'),
(6, 'Algorithms & Data Structures', 6, 'Examines sorting, searching, graphs, and complexity analysis.'),
(7, 'Cyber Security Fundamentals', 7, 'Provides an introduction to network security, cryptography, and vulnerabilities.'),
(8, 'Artificial Intelligence', 8, 'Introduces AI concepts such as neural networks, expert systems, and robotics.'),
(9, 'Machine Learning', 9, 'Explores supervised and unsupervised learning, including decision trees and clustering.'),
(10, 'Ethical Hacking', 10, 'Covers penetration testing, security assessments, and cybersecurity laws.'),
(11, 'Computer Networks', 1, 'Teaches TCP/IP, network layers, and wireless communication.'),
(12, 'Software Testing & Quality Assurance', 2, 'Focuses on automated testing, debugging, and code reliability.'),
(13, 'Embedded Systems', 3, 'Examines microcontrollers, real-time OS, and IoT applications.'),
(14, 'Human-Computer Interaction', 4, 'Studies UI/UX design, usability testing, and accessibility.'),
(15, 'Blockchain Technologies', 5, 'Covers distributed ledgers, consensus mechanisms, and smart contracts.'),
(16, 'Cloud Computing', 6, 'Introduces cloud services, virtualization, and distributed systems.'),
(17, 'Digital Forensics', 7, 'Teaches forensic investigation techniques for cybercrime.'),
(18, 'Final Year Project', 8, 'A major independent project where students develop a software solution.'),
(19, 'Advanced Machine Learning', 11, 'Covers deep learning, reinforcement learning, and cutting-edge AI techniques.'),
(20, 'Cyber Threat Intelligence', 12, 'Focuses on cybersecurity risk analysis, malware detection, and threat mitigation.'),
(21, 'Big Data Analytics', 13, 'Explores data mining, distributed computing, and AI-driven insights.'),
(22, 'Cloud & Edge Computing', 14, 'Examines scalable cloud platforms, serverless computing, and edge networks.'),
(23, 'Blockchain & Cryptography', 15, 'Covers decentralized applications, consensus algorithms, and security measures.'),
(24, 'AI Ethics & Society', 16, 'Analyzes ethical dilemmas in AI, fairness, bias, and regulatory considerations.'),
(25, 'Quantum Computing', 17, 'Introduces quantum algorithms, qubits, and cryptographic applications.'),
(26, 'Cybersecurity Law & Policy', 18, 'Explores digital privacy, GDPR, and international cyber law.'),
(27, 'Neural Networks & Deep Learning', 19, 'Delves into convolutional networks, GANs, and AI advancements.'),
(28, 'Human-AI Interaction', 20, 'Studies AI usability, NLP systems, and social robotics.'),
(29, 'Autonomous Systems', 11, 'Focuses on self-driving technology, robotics, and intelligent agents.'),
(30, 'Digital Forensics & Incident Response', 12, 'Teaches forensic analysis, evidence gathering, and threat mitigation.'),
(31, 'Postgraduate Dissertation', 13, 'A major research project where students explore advanced topics in computing.');

-- programmes (now with status column set to TRUE by default for existing programmes)
INSERT INTO programmes (ProgrammeName, LevelID, ProgrammeLeaderID, Description, status) VALUES
('BSc Computer Science', 1, 1, 'A broad computer science degree covering programming, AI, cybersecurity, and software engineering.', TRUE),
('BSc Software Engineering', 1, 2, 'A specialized degree focusing on the development and lifecycle of software applications.', TRUE),
('BSc Artificial Intelligence', 1, 3, 'Focuses on machine learning, deep learning, and AI applications.', TRUE),
('BSc Cyber Security', 1, 4, 'Explores network security, ethical hacking, and digital forensics.', TRUE),
('BSc Data Science', 1, 5, 'Covers big data, machine learning, and statistical computing.', TRUE),
('MSc Machine Learning', 2, 11, 'A postgraduate degree focusing on deep learning, AI ethics, and neural networks.', TRUE),
('MSc Cyber Security', 2, 12, 'A specialized programme covering digital forensics, cyber threat intelligence, and security policy.', TRUE),
('MSc Data Science', 2, 13, 'Focuses on big data analytics, cloud computing, and AI-driven insights.', TRUE),
('MSc Artificial Intelligence', 2, 14, 'Explores autonomous systems, AI ethics, and deep learning technologies.', TRUE),
('MSc Software Engineering', 2, 15, 'Emphasizes software design, blockchain applications, and cutting-edge methodologies.', TRUE);

-- programmemodules (using ProgrammeID from AUTO_INCREMENT)
INSERT INTO programmemodules (ProgrammeID, ModuleID, Year) VALUES
-- Shared Year 1 (All UG programmes)
(1, 1, 1), (1, 2, 1), (1, 3, 1), (1, 4, 1),
(2, 1, 1), (2, 2, 1), (2, 3, 1), (2, 4, 1),
(3, 1, 1), (3, 2, 1), (3, 3, 1), (3, 4, 1),
(4, 1, 1), (4, 2, 1), (4, 3, 1), (4, 4, 1),
(5, 1, 1), (5, 2, 1), (5, 3, 1), (5, 4, 1),
-- Year 2 (Increasing Specialization)
(1, 5, 2), (1, 6, 2), (1, 7, 2), (1, 8, 2), -- BSc Computer Science
(2, 5, 2), (2, 6, 2), (2, 12, 2), (2, 14, 2), -- BSc Software Engineering
(3, 5, 2), (3, 9, 2), (3, 8, 2), (3, 10, 2), -- BSc Artificial Intelligence
(4, 7, 2), (4, 10, 2), (4, 11, 2), (4, 17, 2), -- BSc Cyber Security
(5, 5, 2), (5, 6, 2), (5, 9, 2), (5, 16, 2), -- BSc Data Science
-- Year 3 (Advanced Topics & Final Year Project with fixes)
(1, 11, 3), (1, 13, 3), (1, 15, 3), (1, 18, 3), -- BSc Computer Science
(2, 13, 3), (2, 15, 3), (2, 16, 3), (2, 18, 3), -- BSc Software Engineering (replaced 12, 14 with 13, 15)
(3, 13, 3), (3, 15, 3), (3, 16, 3), (3, 18, 3), -- BSc Artificial Intelligence (replaced 8, 9 with 13, 16)
(4, 15, 3), (4, 16, 3), (4, 17, 3), (4, 18, 3), -- BSc Cyber Security (replaced 10, 11 with 15, 16; kept 17)
(5, 9, 3), (5, 14, 3), (5, 16, 3), (5, 18, 3), -- BSc Data Science
-- Postgraduate (unchanged)
(6, 19, 1), (6, 24, 1), (6, 27, 1), (6, 29, 1), (6, 31, 1), -- MSc Machine Learning
(7, 20, 1), (7, 26, 1), (7, 30, 1), (7, 23, 1), (7, 31, 1), -- MSc Cyber Security
(8, 21, 1), (8, 22, 1), (8, 27, 1), (8, 28, 1), (8, 31, 1), -- MSc Data Science
(9, 19, 1), (9, 24, 1), (9, 28, 1), (9, 29, 1), (9, 31, 1), -- MSc Artificial Intelligence
(10, 23, 1), (10, 22, 1), (10, 25, 1), (10, 26, 1), (10, 31, 1); -- MSc Software Engineering

-- interestedstudents (sample data)
INSERT INTO interestedstudents (ProgrammeID, StudentName, Email) VALUES
(1, 'John Doe', 'john.doe@example.com'), -- BSc Computer Science
(4, 'Jane Smith', 'jane.smith@example.com'), -- BSc Cyber Security
(6, 'Alex Brown', 'alex.brown@example.com'), -- MSc Machine Learning
(9, 'Priya Patel', 'priya.patel@example.com'); -- MSc Artificial Intelligence

