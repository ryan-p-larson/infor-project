DROP TABLE IF EXISTS orgs, students, members, pages;

/* This table defines the orginzation wide information,
	most of this information will be used in every page */
CREATE TABLE orgs (
	orgID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	orgDesc VARCHAR(255) NOT NULL,	
	orgEmail VARCHAR(32) NOT NULL,
	orgPhone VARCHAR(16),
	orgFB VARCHAR(128),
	orgTwitter VARCHAR(128),
	orgNational VARCHAR(128),	/* Links to the national or overseeing body for an org */
	orgExtWeb VARCHAR(128),	/* Some orgs may have a self hosted site they have put up */
	
	orgPresident INT,			/* The int's for president/PR/Treasurer are the studentID's */
	orgPR INT,
	orgTreasurer INT,
	orgMeeting VARCHAR(128),
	orgLogo VARCHAR(128)
);

/* Create a table for the students,
	of which one student can belong to multiple orgs */
CREATE TABLE students (
	stuID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, /* Used as foreign key for members table */
	stuFirstName VARCHAR(32) NOT NULL,
	stuLastName VARCHAR(32) NOT NULL,
	stuPhone INT,
	stuEmail VARCHAR(32) NOT NULL,
	stuGrade INT,
	stuLoggedIn INT NULL
);

CREATE TABLE members (
	/* Two foriegn keys reference org and student, respectively */
	orgID INT NOT NULL,
	stuID INT NOT NULL,
	memLeader INT NOT NULL,
	memTitle VARCHAR(16),
	memPermissions INT NOT NULL,

	FOREIGN KEY (orgID) REFERENCES orgs(orgID),
	FOREIGN KEY (stuID) REFERENCES students(stuID)
);
