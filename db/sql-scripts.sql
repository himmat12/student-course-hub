-- update programme for admin dashboard
UPDATE
    programmes
SET
    ProgrammeName = 'BSc Advanced Agentic AI',
    LevelID = 1,
    ProgrammeLeaderID = 12,
    Description = 'A comprehensive degree focusing on cloud infrastructure, serverless computing, container technologies, and multi-cloud strategies.',
    Image = NULL,
	Status = 1
WHERE
    programmes.ProgrammeID = 13;

-- insert statement for programmes for admin dashboard
INSERT INTO programmes(
    ProgrammeName,
    LevelID,
    ProgrammeLeaderID,
    Description,
    Image,
STATUS
)
VALUES(
    'BSc Cloud Computing',
    1,
    14,
    'A specialized degree focusing on cloud architecture, virtualization, and distributed systems.',
    NULL,
    1
);

-- get list of programmes in admin dahsboard
SELECT
    p.ProgrammeID AS ProgramID,
    p.ProgrammeName AS ProgramName,
    p.Description AS Description,
    p.Image AS ImageUrl,
    s.Name AS ProgramLeader,
    p.LevelID AS LevelID,
    p.status AS `Status`
FROM
    programmes AS p
INNER JOIN staff AS s
ON
    p.ProgrammeLeaderID = s.StaffID WHERE p.ProgrammeName LIKE '%%';

-- update program status
UPDATE programmes SET Status=0 WHERE programmes.ProgrammeID=1;

-- get list of staffs with their id for admin panel forms
SELECT staff.StaffID AS StaffID, staff.Name FROM staff;

-- get all total statistics data for admin 

-- total programmes (returns the list of programmes level id from where you can filter the total UG and PG)
SELECT programmes.LevelID AS LevelID FROM programmes; 

-- total modules (returns the list of modules level id from where you can filter modules taught in UG and PG)
SELECT
    COUNT(levels.LevelID) AS Total
FROM
    levels
INNER JOIN programmes ON levels.LevelID = programmes.LevelID
INNER JOIN programmemodules ON programmemodules.ProgrammeID = programmes.ProgrammeID;

-- total staffs (returns the list of positions of all staff from where you can filter the positions based total staffs number)
SELECT staff.Position AS Position FROM staff;

-- total interested students counts
SELECT COUNT(interestedstudents.Email) AS Total FROM interestedstudents;

-- get module description based on module id
SELECT
    modules.ModuleID AS ModuleId,
    modules.ModuleName AS ModuleName,
    modules.Description AS Description,
    modules.Image AS ImgUrl,
    staff.Name AS ModuleLeader
FROM
    modules
INNER JOIN staff ON modules.ModuleLeaderID = staff.StaffID
WHERE
    modules.ModuleID = 2;

-- get list of programmes which shares a module based on id
SELECT
    -- modules.ModuleID AS ModuleID,
    -- modules.ModuleName AS ModuleName,
    programmes.ProgrammeID AS ProgrammeID,
    programmes.ProgrammeName AS ProgramName,
    programmes.Description AS Description,
    programmes.Image AS ImgUrl,
    staff.Name AS ProgramLeader
FROM
    programmes
INNER JOIN staff ON programmes.ProgrammeLeaderID = staff.StaffID
INNER JOIN programmemodules ON programmemodules.ProgrammeID = programmes.ProgrammeID
INNER JOIN modules ON programmemodules.ModuleID = modules.ModuleID
WHERE
    programmemodules.ModuleID = 1;

-- get program description detais
SELECT
    p.ProgrammeName AS ProgramName,
    p.Image AS ImgUrl,
    l.LevelName AS 'Level',
    s.Name AS ProgramLeader,
    p.Description AS Description
FROM
    programmes AS p
INNER JOIN levels AS l
ON
    p.LevelID = l.LevelID
INNER JOIN staff AS s
ON
    p.ProgrammeLeaderID = s.StaffID
WHERE
    p.ProgrammeID = 1;

-- get modules list based on program id 
SELECT
    programmemodules.ProgrammeModuleID AS ProgramModuleId,
    programmemodules.ProgrammeID AS ProgramId,
    modules.ModuleID AS ModuleId,
    modules.ModuleName AS ModuleName,
    modules.Description AS Description,
    modules.Image AS ImgUrl,
    programmemodules.Year AS 'Year'
FROM
    modules
INNER JOIN programmemodules ON modules.ModuleID = programmemodules.ModuleID
WHERE
    programmemodules.ProgrammeID = 1;

--  get total count of programmes
SELECT
    COUNT(p.ProgrammeName) AS Total
FROM
    programmes AS p;

--  get all modules name and module staff name
SELECT
    modules.ModuleName,
    staff.Name
FROM
    modules
    INNER JOIN staff ON modules.ModuleLeaderID = staff.StaffID;

--  get all modules and staff info
SELECT
    *
FROM
    modules
    INNER JOIN staff ON modules.ModuleLeaderID = staff.StaffID;

SELECT
    m.ModuleName,
    m.Description,
    m.Image,
    s.Name
FROM
    modules AS m
    INNER JOIN staff AS s ON m.ModuleLeaderID = s.StaffID;

--  get selected program modules list and module leaders
SELECT
    P.ProgrammeName AS Program,
    M.ModuleName AS Modules,
    S.Name AS `Module Leader`
FROM
    modules AS M
    INNER JOIN staff AS S ON M.ModuleLeaderID = S.StaffID
    INNER JOIN programmes AS P ON P.ProgrammeID = 2;

-- get all programme and programme leader (staff)
SELECT
    *
FROM
    programmes
    INNER JOIN staff ON programmes.ProgrammeLeaderID = staff.StaffID;

SELECT
    P.ProgrammeName,
    P.Description,
    P.Image,
    S.Name AS `Program Leader`
FROM
    programmes AS P
    INNER JOIN staff AS S ON P.ProgrammeLeaderID = S.StaffID;

--  get all list of programmes that are assigned to selected staff (staff ID)
SELECT
    *
FROM
    programmes AS P
    INNER JOIN staff AS S ON S.StaffID = 1;

SELECT
    S.Name,
    P.ProgrammeName,
    P.Description,
    P.Image
FROM
    programmes AS P
    INNER JOIN staff AS S ON S.StaffID = 1;

--  get all modules assigned to a staff (selected staff ID)
SELECT
    *
FROM
    modules
WHERE
    modules.ModuleLeaderID = 1;

--  get selected level (lvl 1 -> undergraduate, lvl 2 -> postgraduate) programmes
SELECT
    *
FROM
    programmes AS P
WHERE
    P.LevelID = 1;

--  get all registered interests list (list of students who have subscribed interest in particular programmes)
SELECT
    *
FROM
    interestedstudents;

SELECT
    I.InterestID,
    I.StudentName,
    I.Email,
    P.ProgrammeName,
    P.Description,
    P.Image,
    L.LevelName,
    S.Name AS `Program Leader`,
    I.RegisteredAt
FROM
    interestedstudents AS I
    INNER JOIN programmes AS P ON I.ProgrammeID = P.ProgrammeID
    INNER JOIN levels AS L ON P.LevelID = L.LevelID
    INNER JOIN staff AS S ON P.ProgrammeLeaderID = S.StaffID;

--  get list of interested students based on selected program (program ID)
SELECT
    I.InterestID,
    I.StudentName,
    I.Email,
    P.ProgrammeName,
    P.Description,
    P.Image,
    L.LevelName,
    S.Name AS `Program Leader`,
    I.RegisteredAt
FROM
    interestedstudents AS I
    INNER JOIN programmes AS P ON I.ProgrammeID = P.ProgrammeID
    INNER JOIN levels AS L ON P.LevelID = L.LevelID
    INNER JOIN staff AS S ON P.ProgrammeLeaderID = S.StaffID
WHERE
    P.ProgrammeID = 1;

--  this queries is for admin to clean the duplicate student registered interests
--  Remove existing duplicates (keeps only the most recent registration)
DELETE i1
FROM
    InterestedStudents i1
    INNER JOIN InterestedStudents i2
WHERE
    i1.InterestID < i2.InterestID
    AND i1.Email = i2.Email
    AND i1.ProgrammeID = i2.ProgrammeID;

--  this query is for user website when user tries to insert duplicate interest which is same course same person multiple attemp to register interest; it silently ignores the insertino and affects 0 rows 
--  INSERT IGNORE (silently ignores duplicates)
INSERT IGNORE INTO InterestedStudents (ProgrammeID, StudentName, Email)
VALUES
    (1, 'John Doe', 'john.doe@example.com');