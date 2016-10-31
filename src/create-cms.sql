DROP TABLE IF EXISTS orgs, students, members, pages, layouts, designs;

/* Create a table for the students,
	of which one student can belong to multiple orgs */
CREATE TABLE students (
	stuID INT NOT NULL PRIMARY KEY, /* Used as foreign key for members table */
	stuFirstName VARCHAR(32) NOT NULL,
	stuLastName VARCHAR(32) NOT NULL,
	stuPhone INT,
	stuEmail VARCHAR(32) NOT NULL,
	stuGrade INT,
	stuHashPass VARCHAR(64),
	stuLoggedIn INT NULL
);

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
	orgLogo VARCHAR(128),

	FOREIGN KEY (orgPresident) REFERENCES students(stuID),
	FOREIGN KEY (orgPR) REFERENCES students(stuID),
	FOREIGN KEY (orgTreasurer) REFERENCES students(stuID)
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

CREATE TABLE layouts (
	layoutID VARCHAR(32) NOT NULL, /* assign a human readable ID */
	layoutHTML VARCHAR(8191) NOT NULL, 

	PRIMARY KEY (layoutID)
);

CREATE TABLE designs (
	designID VARCHAR(32) NOT NULL, /* assign a human readable ID */
	designCSS VARCHAR(8191) NOT NULL, 

	PRIMARY KEY (designID)
);

/* Pages,  */
CREATE TABLE pages (
    pageID INT NOT NULL AUTO_INCREMENT,
	orgID INT, /* NOT NULL,*/

	layoutID VARCHAR(32) NOT NULL, /* Foreign key to assign HTML to page */
	designID VARCHAR(32) NOT NULL, /* Assign a pre-baked CSS file to page */

    urlTitle VARCHAR(32) NOT NULL, /* what word goes into the url that distinguishes this page from others */
    pageTitle VARCHAR(32) NOT NULL, /* title shown on bookmarks, tab, etc. */
    menuTitle VARCHAR(32) NOT NULL, /* title shown in menus */
    parent INT, /* parent page */
    bodyTitle VARCHAR(128) NOT NULL, /* title shown in the body of the page */
    body TEXT, /* content of the page (only text for now) */

    PRIMARY KEY (pageID),
	FOREIGN KEY (orgID) REFERENCES orgs(orgID),
	FOREIGN KEY (layoutID) REFERENCES layouts(layoutID),
	FOREIGN KEY (designID) REFERENCES designs(designID)
);

/* Add a test student, org, create membership */
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail) VALUES (1234, "Fake", "User", "test-email@testing.com"); 
INSERT INTO orgs (orgDesc, orgEmail, orgPresident) VALUES ("This is a fake orginization", "fake-org@testing.com", 1234);
INSERT INTO members (orgID, stuID, memLeader, memTitle, memPermissions) VALUES ((SELECT orgID FROM orgs WHERE orgid == 1), (SELECT student ID FROM students WHERE studentID == 1234), 1, "President", -1);
