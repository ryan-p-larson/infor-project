DROP TABLE IF EXISTS members, pages, orgs, students, designs;

/* Create a table for the students,
	of which one student can belong to multiple orgs */
CREATE TABLE students (
	stuID INT NOT NULL PRIMARY KEY, /* Used as foreign key for members table */
	stuFirstName VARCHAR(32) NOT NULL,
	stuLastName VARCHAR(32) NOT NULL,
	stuPhone VARCHAR(16),
	stuEmail VARCHAR(32) NOT NULL,
	stuGrade INT,
	stuHashPass VARCHAR(64),
	stuLoggedIn INT NULL,
	stuAdmin INT NULL
);

/* This table defines the orginzation wide information,
	most of this information will be used in every page */
CREATE TABLE orgs (
	orgID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	orgName VARCHAR(128) NOT NULL,
	orgDesc VARCHAR(255) NOT NULL,
	orgAdmin INT NOT NULL, /* studentID of the person who creates the org */
	orgApproved INT NULL,

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

	FOREIGN KEY (orgAdmin) REFERENCES students(stuID),
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


CREATE TABLE designs (
	designID VARCHAR(32) NOT NULL, /* assign a human readable ID */
	designCSS VARCHAR(8191) NOT NULL,

	PRIMARY KEY (designID)
);

/* Pages,  */
CREATE TABLE pages (
	pageID INT NOT NULL AUTO_INCREMENT,
	orgID INT, /* NOT NULL,*/
	pageApproved INT NULL,

	designID VARCHAR(32) NOT NULL, /* Assign a pre-baked CSS file to page */

	urlTitle VARCHAR(32) NOT NULL, /* what word goes into the url that distinguishes this page from others */
	pageTitle VARCHAR(32) NOT NULL, /* title shown on bookmarks, tab, etc. */
	menuTitle VARCHAR(32) NOT NULL, /* title shown in menus */
	parentInt INT, /* parent page */
	bodyTitle VARCHAR(128) NOT NULL, /* title shown in the body of the page */
	body TEXT, /* content of the page (only text for now) */

  PRIMARY KEY (pageID),
	FOREIGN KEY (orgID) REFERENCES orgs(orgID),
	FOREIGN KEY (designID) REFERENCES designs(designID)
);






















/*    STUDENTS WITH EVERY FIELD    */
INSERT INTO students VALUES (1,"Matthew", "Carlin", 5632100369,"matthew-carlin@uiowa.edu", 4, "password", 0, 1); /* Carlin and Larson are admins */
INSERT INTO students VALUES (2,"John", "Smith", 4956978866,"john-smith@uiowa.edu", 3, "hockey", 0, 0);
INSERT INTO students VALUES (3,"Jessica", "Johnson", 5765647733,"jessica@uiowa.edu", 2, "password", 0, 0);
INSERT INTO students VALUES (4,"Jenny", "Rodriguez", 4654744477,"jenny-rodriguez@uiowa.edu", 1, "dsdsddds", 0, 0);
INSERT INTO students VALUES (5,"Robert", "Johnson", 3733744466,"robert-johnson@uiowa.edu", 4, "3JEcaay2x", 0, 0);
INSERT INTO students VALUES (6,"Max", "Okland", 5454443232,"mokland@uiowa.edu", 4, "turkey", 0, 0);
INSERT INTO students VALUES (7,"Alexis", "Texas", 4949494458,"alexis-texas@uiowa.edu", 4, "cheese", 0, 0);
INSERT INTO students VALUES (8,"Johnny", "Roberts", 4845734411,"johnny-roberts@uiowa.edu", 3, "hello", 0, 0);
INSERT INTO students VALUES (9,"Andre", "McDaniel", 5869503322,"andre-mcdaniel@uiowa.ed", 1, "computer", 0, 0);
INSERT INTO students VALUES (10,"Brandon", "Snyder", 5776885990,"brandon-snyder@uiowa.edu", 3, "safety", 0, 0);
INSERT INTO students VALUES (11,"Grace", "Parker", 4477867788,"grace-parker@uiowa.edu", 2, "grace", 0, 0);
INSERT INTO students VALUES (12,"Andrea", "Birch", 4775674466,"abirch@uiowa.edu", 4, "porcupine", 0, 0);
INSERT INTO students VALUES (13,"Craig", "Sager", 6969696969,"craig-sager@uiowa.edu", 4, "basketball", 0, 0);
INSERT INTO students VALUES (14,"Dillon", "Harper", 5553434455,"dillon-harper@uiowa.edu", 1, "blanket", 0, 0);
INSERT INTO students VALUES (15,"Drew", "Sandoval", 3195553344,"drew-sandoval@uiowa.edu", 1, "puppy", 0, 0);
INSERT INTO students VALUES (16,"Marvin", "McNutt", 7777777777,"marvin-mcnutt@uiowa.edu", 4, "hawkeyes", 0, 0);
INSERT INTO students VALUES (17,"Tom", "Ryan", 6887996090,"tom-ryan@uiowa.edu", 3, "ascension", 0, 0);
INSERT INTO students VALUES (18,"Dan", "Ryan", 5776887612,"dan-ryan@uiowa.edu", 3, "lockout", 0, 0);
INSERT INTO students VALUES (19,"David", "Walsh", 4887712200,"walshy@uiowa.edu", 1, "prisoner", 0, 0);
INSERT INTO students VALUES (20,"Lisa", "Ann", 4878987451,"lisa-ann@uiowa.edu", 4, "glasses", 0, 0);
INSERT INTO students VALUES (21,"Tony", "Colbert", 2886887990,"tony-colbert@uiowa.edu", 4, "friendship", 0, 0);
INSERT INTO students VALUES (22,"Parker", "James", 3190098899,"parker-james@uiowa.edu", 2, "love", 0, 0);
INSERT INTO students VALUES (23,"Annie", "Clark", 5633446990,"annie-clark@uiowa.edu", 2, "password", 0, 0);
INSERT INTO students VALUES (24,"Michael", "Johnson", 4455567990,"michael-johnson@uiowa.edu", 2, "skarmory", 0, 0);
INSERT INTO students VALUES (25,"Ash", "Ketchum", 6889009898,"ash-ketchum@uiowa.edu", 4, "heracross", 0, 0);
INSERT INTO students VALUES (26,"Ash", "Ketchum", 5556556677,"ash-p-ketchum@uiowa.edu", 3, "ampharos", 0, 0);
INSERT INTO students VALUES (27,"James", "Meredith", 5633206558,"james-meredith@uiowa.edu", 3, "jolteon", 0, 0);
INSERT INTO students VALUES (28,"Joseph", "Bush", 5633707185,"joseph-m-bush@uiowa.edu", 2, "vaporeon", 0, 0);
INSERT INTO students VALUES (29,"Rita", "Andrews", 6676676530,"rita-andrews@uiowa.edu", 4, "umbreon", 0, 0);
INSERT INTO students VALUES (30,"Ryan", "Coughlin", 5589989903,"ryan-coughlin@uiowa.edu", 4, "espeon", 0, 0);
INSERT INTO students VALUES (31,"Mia", "Khalifa", 5587787878,"mia-khalifa@uiowa.edu", 2, "flareon", 0, 0);
INSERT INTO students VALUES (32,"Annie", "Rafferty", 3098897788,"annie-rafferty@uiowa.edu", 2, "glaceon", 0, 0);
INSERT INTO students VALUES (33,"Brian", "Calhoun", 0123456789,"brian-calhoun@uiowa.edu", 4, "leafeon", 0, 0);
INSERT INTO students VALUES (34,"Erica", "Ericson", 7767879988,"erica-ericson@uiowa.edu", 4, "sylveon", 0, 0);
INSERT INTO students VALUES (35,"Nilrac", "Wehttam", 9630012365,"nilrac-wehttam@uiwoa.edu", 4, "drowssap", 0, 0);




/*     STUDENTS HAVE stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, and stuLoggedIn     */ 
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, stuLoggedIn) VALUES (36, "Brian", "James", "brian-james@uiowa.edu", "abra", 0);
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, stuLoggedIn) VALUES (37, "Abdul", "Muhammed", "abdul-muhammed@uiowa.edu", "kadabra", 0);
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, stuLoggedIn) VALUES (38, "Andrew", "White", "andrew-white@uiowa.edu","alakazam", 0);
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, stuLoggedIn) VALUES (39, "Abbey", "James", "abbey-james@uiowa.edu", "manectric", 0);
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, stuLoggedIn) VALUES (40, "Caterine", "Crawford", "caterine-crawford@uiowa.edu", "torchic", 0);
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, stuLoggedIn) VALUES (41, "Johnny", "Football", "johnny-football@uiowa.edu", "nidoking", 0);
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, stuLoggedIn) VALUES (42, "Grant", "Ryan", "grant-ryan@uiowa.edu", "nidoqueen", 0);
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, stuLoggedIn) VALUES (43, "Sheila", "Styles", "sheila-styles@uiowa.edu", "combusken", 0);
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, stuLoggedIn) VALUES (44, "Matthew", "Dalton", "matthew-dalton@uiowa.edu", "dratini", 0);
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, stuLoggedIn) VALUES (45, "Bart", "Johnson", "bart-johnson@uiowa.edu", "dragonair", 0);
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, stuLoggedIn) VALUES (46, "Lance", "Jacobsen", "lance-jacobsen@uiowa.edu", "dragonite", 0);
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, stuLoggedIn) VALUES (47, "Claire", "Jacobsen", "claire-jacobsen@uiowa.edu", "kindra", 0);
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, stuLoggedIn) VALUES (48, "Gary", "Blue", "gary-blue@uiowa.edu", "steelix", 0);
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, stuLoggedIn) VALUES (49, "Ash", "Red", "ash-red@uiowa.edu", "starmie", 0);
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, stuLoggedIn) VALUES (50, "Anthony", "Oak", "anthony-oak@uiowa.edu", "exeggutor", 0);
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, stuLoggedIn) VALUES (51, "Koga", "Jones", "koga-jones@uiowa.edu", "weezing", 0);
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, stuLoggedIn) VALUES (52, "Blaine", "Parker", "blaine-parker@uiowa.edu", "arcanine", 0);
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass, stuLoggedIn) VALUES (53, "Flannery", "O'Connor", "flannery-oconnor@uiowa.edu", "torkoal", 0);



/*     ONLY HAS THE NOT NULL FIELDS PRESENT   */
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail) VALUES (54, "Andrew", "Andrews", "andrew-andrews@uiowa.edu");
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail) VALUES (55, "Clark", "Kent", "clark-kent@uiowa.edu");
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail) VALUES (56, "Emily", "Ryan", "emily-ryan@testing.com");
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail) VALUES (57, "Michael", "Scott", "michael-scott@testing.com");
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail) VALUES (58, "Pablo", "Jones", "pablo-jones@testing.com");
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail) VALUES (59, "Katelyn", "Griffin", "katelyn-griffin@testing.com");
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail) VALUES (60, "Brock", "Pewter", "brock-pewter@testing.com");
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail) VALUES (61, "Misty", "Cerulean", "misty-cerulean@testing.com");
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail) VALUES (62, "Sabrina", "Saffron", "sabrina-saffron@testing.com");
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail) VALUES (63, "Giovanni", "Viridian", "giovanni-veridian@uiowa.edu");
INSERT INTO students (stuID, stuFirstName, stuLastName, stuEmail) VALUES (64, "Faulkner", "Newbark", "faulkner-newbark@testing.com");






	
/* HAS EVERYTHING EXCEPT FOR orgNational, orgMeeting, and orgLogo   */
INSERT INTO orgs (orgID,orgName,orgDesc,orgEmail,orgPhone,orgFB,orgTwitter,orgExtWeb,orgPresident,orgPR,orgTreasurer, orgApproved, orgAdmin) VALUES (1,"Knitting Club", "A club for knitting afficianodos!", "knitting@uiowa.edu", 4455567878, "https://www.facebook.com/", "https://twitter.com/", "https://en.wikipedia.org/wiki/Knitting_clubs", 1,2,3, 1, 1);
INSERT INTO orgs (orgID,orgName,orgDesc,orgEmail,orgPhone,orgFB,orgTwitter,orgExtWeb,orgPresident,orgPR,orgTreasurer, orgApproved, orgAdmin) VALUES (2,"Running Club", "We like running!", "running@uiowa.edu", 5545677766, "https://www.facebook.com/", "https://twitter.com/", "http://corridorrunning.com/", 4,5,6, 1, 4);
INSERT INTO orgs (orgID,orgName,orgDesc,orgEmail,orgPhone,orgFB,orgTwitter,orgExtWeb,orgPresident,orgPR,orgTreasurer, orgApproved, orgAdmin) VALUES (3,"Enery Drink Club", "You should only join if you like energy drinks.", "redbull@uiowa.edu", 4454456655, "https://www.facebook.com/", "https://twitter.com/", "https://en.wikipedia.org/wiki/Red_Bull", 7,8,9, 1, 7);
INSERT INTO orgs (orgID,orgName,orgDesc,orgEmail,orgPhone,orgFB,orgTwitter,orgExtWeb,orgPresident,orgPR,orgTreasurer, orgApproved, orgAdmin) VALUES (4,"Pokemon Club", "Gotta catch em all!", "pokemon@uiowa.edu", 4434456021, "https://www.facebook.com/", "https://twitter.com/", "http://play.pokemonshowdown.com/", 10,11,12, 1, 10);
INSERT INTO orgs (orgID,orgName,orgDesc,orgEmail,orgPhone,orgFB,orgTwitter,orgExtWeb,orgPresident,orgPR,orgTreasurer, orgApproved, orgAdmin) VALUES (5,"Basketball Club", "Ball is life", "basketball-club@uiowa.edu", 5541870902, "https://www.facebook.com/", "https://twitter.com/", "http://www.iowabasketballclub.com/", 13,14,15, 1, 13);
INSERT INTO orgs (orgID,orgName,orgDesc,orgEmail,orgPhone,orgFB,orgTwitter,orgExtWeb,orgPresident,orgPR,orgTreasurer, orgApproved, orgAdmin) VALUES (6,"Rugby Club", "We play rugby every week. So join if you want to play.", "rugby@uiowa.edu", 4323456600, "https://www.facebook.com/", "https://twitter.com/", "https://www.usarugby.org/find-a-club/", 16,17,18, 1, 16);
INSERT INTO orgs (orgID,orgName,orgDesc,orgEmail,orgPhone,orgFB,orgTwitter,orgExtWeb,orgPresident,orgPR,orgTreasurer, orgApproved, orgAdmin) VALUES (7,"Informatics Club", "If informatics is your thing, then you are in luck!", "informatics@uiowa.edu", 4455667678, "https://www.facebook.com/", "https://twitter.com/", "https://cs.uiowa.edu/undergraduate-programs/informatics", 19,20,21, 1, 19);
INSERT INTO orgs (orgID,orgName,orgDesc,orgEmail,orgPhone,orgFB,orgTwitter,orgExtWeb,orgPresident,orgPR,orgTreasurer, orgApproved, orgAdmin) VALUES (8,"Cooking Club", "We like cooking stuff", "cooking@uiowa.edu", 4455567876, "https://www.facebook.com/", "https://twitter.com/", "http://www.scout.com/home/cooking", 22,23,24, 1, 22);
INSERT INTO orgs (orgID,orgName,orgDesc,orgEmail,orgPhone,orgFB,orgTwitter,orgExtWeb,orgPresident,orgPR,orgTreasurer, orgApproved, orgAdmin) VALUES (9,"Future Farmers of America", "We are the next gen of farmers", "knitting@uiowa.edu", 6699984887, "https://www.facebook.com/", "https://twitter.com/", "https://www.ffa.org/home", 25,26,27, 1, 25);
INSERT INTO orgs (orgID,orgName,orgDesc,orgEmail,orgPhone,orgFB,orgTwitter,orgExtWeb,orgPresident,orgPR,orgTreasurer, orgApproved, orgAdmin) VALUES (10,"Birdwatchers Alliance", "Have you ever seen a dodo bird before? Neither have we.", "birdwatchers-of-iowa@uiowa.edu", 4455567873, "https://www.facebook.com/", "https://twitter.com/", "http://ashfordbirdwatchersclub.blogspot.com/", 28,29,30, 1, 31);
INSERT INTO orgs (orgID,orgName,orgDesc,orgEmail,orgPhone,orgFB,orgTwitter,orgExtWeb,orgPresident,orgPR,orgTreasurer, orgApproved, orgAdmin) VALUES (11,"Minecraft Club", "Are you a Minecraft player? We have the club for you.", "minecraft@uiowa.edu", 3446878865, "https://www.facebook.com/", "https://twitter.com/", "https://connectedcamps.com/minecraft-kid-club", 31,32,33, 1, 34);
INSERT INTO orgs (orgID,orgName,orgDesc,orgEmail,orgPhone,orgFB,orgTwitter,orgExtWeb,orgPresident,orgPR,orgTreasurer, orgApproved, orgAdmin) VALUES (12,"Skydiving Club", "If you are a thril-seeker, join this club.", "skydiving@uiowa.edu", 4455567212, "https://www.facebook.com/", "https://twitter.com/", "http://skydive.mit.edu/", 34,35,36, 1, 37);
INSERT INTO orgs (orgID,orgName,orgDesc,orgEmail,orgPhone,orgFB,orgTwitter,orgExtWeb,orgPresident,orgPR,orgTreasurer, orgApproved, orgAdmin) VALUES (13,"Movie Club", "A club for movie lovers.", "movie-club@uiowa.edu", 3345457801, "https://www.facebook.com/", "https://twitter.com/", "http://www.columbiahouse.com/", 37,38,39, 1, 40);
INSERT INTO orgs (orgID,orgName,orgDesc,orgEmail,orgPhone,orgFB,orgTwitter,orgExtWeb,orgPresident,orgPR,orgTreasurer, orgApproved, orgAdmin) VALUES (14,"Jogging Club", "Were the Running Club, but cooler.", "jogging@uiowa.edu", 4990897755, "https://www.facebook.com/", "https://twitter.com/", "http://www.joggers.co.nz/", 40,41,42, 1, 43);
INSERT INTO orgs (orgID,orgName,orgDesc,orgEmail,orgPhone,orgFB,orgTwitter,orgExtWeb,orgPresident,orgPR,orgTreasurer, orgApproved, orgAdmin) VALUES (15,"Fight Club", "I can't talk about it.", "fight-club@uiowa.edu", 5998997876, "https://www.facebook.com/", "https://twitter.com/", "https://en.wikipedia.org/wiki/Fight_Club", 43,44,45, 1, 46);
INSERT INTO orgs (orgID,orgName,orgDesc,orgEmail,orgPhone,orgFB,orgTwitter,orgExtWeb,orgPresident,orgPR,orgTreasurer, orgApproved, orgAdmin) VALUES (16,"Book Club", "If you love novels, join our club.", "book-club@uiowa.edu", 8857746655, "https://www.facebook.com/", "https://twitter.com/", "http://www.icpl.org/book-clubs/", 46,47,48, 1, 49);



/*orgID = 1 */
INSERT INTO members VALUES (1,1,1,"President",1);
INSERT INTO members VALUES (1,2,1,"PR",1);
INSERT INTO members VALUES (1,3,1,"Treasurer",1);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (1,64,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (1,63,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (1,62,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (1,61,0,0);

/*orgID = 2 */
INSERT INTO members VALUES (2,4,1,"President",1);
INSERT INTO members VALUES (2,5,1,"PR",1);
INSERT INTO members VALUES (2,6,1,"Treasurer",1);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (2,60,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (2,59,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (2,58,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (2,57,0,0);

/*orgID = 3 */
INSERT INTO members VALUES (3,7,1,"President",1);
INSERT INTO members VALUES (3,8,1,"PR",1);
INSERT INTO members VALUES (3,9,1,"Treasurer",1);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (3,60,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (3,19,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (3,58,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (3,12,0,0);

/*orgID = 4 */
INSERT INTO members VALUES (4,10,1,"President",1);
INSERT INTO members VALUES (4,11,1,"PR",1);
INSERT INTO members VALUES (4,12,1,"Treasurer",1);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (4,56,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (4,57,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (4,55,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (4,54,0,0);

/*orgID = 5 */
INSERT INTO members VALUES (5,13,1,"President",1);
INSERT INTO members VALUES (5,14,1,"PR",1);
INSERT INTO members VALUES (5,15,1,"Treasurer",1);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (5,53,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (5,52,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (5,51,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (5,50,0,0);

/*orgID = 6 */
INSERT INTO members VALUES (6,16,1,"President",1);
INSERT INTO members VALUES (6,17,1,"PR",1);
INSERT INTO members VALUES (6,18,1,"Treasurer",1);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (6,49,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (6,49,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (6,48,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (6,47,0,0);

/*orgID = 7 */
INSERT INTO members VALUES (7,19,1,"President",1);
INSERT INTO members VALUES (7,20,1,"PR",1);
INSERT INTO members VALUES (7,21,1,"Treasurer",1);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (7,49,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (7,49,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (7,48,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (7,47,0,0);

/*orgID = 8 */
INSERT INTO members VALUES (8,22,1,"President",1);
INSERT INTO members VALUES (8,23,1,"PR",1);
INSERT INTO members VALUES (8,24,1,"Treasurer",1);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (8,46,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (8,45,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (8,44,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (8,43,0,0);

/*orgID = 9 */
INSERT INTO members VALUES (9,25,1,"President",1);
INSERT INTO members VALUES (9,26,1,"PR",1);
INSERT INTO members VALUES (9,27,1,"Treasurer",1);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (9,42,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (9,41,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (9,40,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (9,39,0,0);

/*orgID = 10 */
INSERT INTO members VALUES (10,31,1,"President",1);
INSERT INTO members VALUES (10,32,1,"PR",1);
INSERT INTO members VALUES (10,33,1,"Treasurer",1);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (10,38,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (10,37,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (10,36,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (10,35,0,0);

/*orgID = 11 */
INSERT INTO members VALUES (11,34,1,"President",1);
INSERT INTO members VALUES (11,35,1,"PR",1);
INSERT INTO members VALUES (11,36,1,"Treasurer",1);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (11,55,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (11,1,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (11,12,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (11,44,0,0);

/*orgID = 12 */
INSERT INTO members VALUES (12,37,1,"President",1);
INSERT INTO members VALUES (12,38,1,"PR",1);
INSERT INTO members VALUES (12,39,1,"Treasurer",1);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (12,50,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (12,18,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (12,61,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (12,49,0,0);

/*orgID = 13 */
INSERT INTO members VALUES (13,40,1,"President",1);
INSERT INTO members VALUES (13,41,1,"PR",1);
INSERT INTO members VALUES (13,42,1,"Treasurer",1);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (13,37,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (13,33,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (13,64,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (13,2,0,0);

/*orgID = 14 */
INSERT INTO members VALUES (14,43,1,"President",1);
INSERT INTO members VALUES (14,44,1,"PR",1);
INSERT INTO members VALUES (14,45,1,"Treasurer",1);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (13,42,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (13,33,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (13,64,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (13,2,0,0);

/*orgID = 15 */
INSERT INTO members VALUES (15,46,1,"President",1);
INSERT INTO members VALUES (15,47,1,"PR",1);
INSERT INTO members VALUES (15,48,1,"Treasurer",1);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (13,21,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (13,62,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (13,6,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (13,18,0,0);

/*orgID = 16 */
INSERT INTO members VALUES (16,49,1,"President",1);
INSERT INTO members VALUES (16,50,1,"PR",1);
INSERT INTO members VALUES (16,51,1,"Treasurer",1);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (16,29,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (16,44,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (16,57,0,0);
INSERT INTO members (orgID,stuID,memLeader,memPermissions) VALUES (16,21,0,0);






/* bootswatch designs
1 = cerulean
2 = cosmo
3 = flatly
4 = journal
5 = sandstone
6 = slate
7 = superhero
*/
INSERT INTO designs VALUES ("cerulean","https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cerulean/bootstrap.min.css");
INSERT INTO designs VALUES ("cosmo","https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css");
INSERT INTO designs VALUES ("flatly","https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css");
INSERT INTO designs VALUES ("journal","https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/journal/bootstrap.min.css");
INSERT INTO designs VALUES ("sandstone","https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/sandstone/bootstrap.min.css");
INSERT INTO designs VALUES ("slate","https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/slate/bootstrap.min.css");
INSERT INTO designs VALUES ("superhero","https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/superhero/bootstrap.min.css");

























