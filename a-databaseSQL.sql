/*Account*/
CREATE TABLE account(
	accountID   CHAR(5) PRIMARY KEY,
	name        VARCHAR(20),
	age         INT(2),
	email       VARCHAR(50),
	password    VARCHAR(12),
	accountType VARCHAR(10)
  );

INSERT INTO  account 
VALUES  ("A1111" , "Ernest" , "19","admin1","admin1","admin"),
		("A2222" , "Khai Jun", "19", "admin2","admin2","admin"),
        ("00000" , "Keat Yee", "19", "00000","00000","superuser");


/*Foodbank*/
CREATE TABLE foodbank (
    foodBankNo CHAR(4) PRIMARY KEY ,
    location VARCHAR(20),
    contactNum VARCHAR(20)
  );

INSERT INTO  foodbank (foodbankNo, location, contactNum)
VALUES  ("FB01" , "Selangor" , "03-8736 0111"),
		("FB02" , "Wilayah Persekutuan" , "012-329 3256"),
		("FB03" , "Johor" , "03-9226 5500"),
		("FB04" , "Kedah" , "017-338 8462"),
		("FB05" , "Melaka" , "010-234 5677"),
		("FB06" , "Pulau Pinang" , "012-235 7777");

/*Fooditem*/
CREATE TABLE foodItem (
    foodItemID CHAR(5) PRIMARY KEY,
    name VARCHAR(20),
    description VARCHAR(50)
  );

INSERT INTO foodItem (foodItemID, name, description) 
VALUES  ('FI001', 'bread', 'A staple food made from flour.'),
		('FI002', 'rice', 'A grain that is a staple food in many cultures.'),
		('FI003', 'canned food', 'Food items that are preserved in cans.'),
		('FI004', 'cooking oil', 'Oil used for cooking and frying.'),
		('FI005', 'cereal', 'A breakfast food typically made from grains.');

/*Food Donation*/
CREATE TABLE foodDonation (
    foodDonationID INT(4) PRIMARY KEY AUTO_INCREMENT,
    `date` DATE,
    `time` TIME,
    contactNum VARCHAR(20),
    itemDonate VARCHAR(50),
    address VARCHAR(50),
    city VARCHAR(30),
    postcode VARCHAR(10),
    state VARCHAR(20),
    foodBankNo CHAR(4),
    accountID CHAR(8),
    FOREIGN KEY (foodBankNo) REFERENCES foodbank(foodBankNo),
    FOREIGN KEY (accountID) REFERENCES account(accountID)
  );

/*Food Donation Item*/
CREATE TABLE foodDonationItem (
    foodDonationID INT(4),
    foodItemID CHAR(5),
    quantity INT,
    status VARCHAR(20),
    PRIMARY KEY (foodDonationID, foodItemID),
    FOREIGN KEY (foodDonationID) REFERENCES foodDonation(foodDonationID),
    FOREIGN KEY (foodItemID) REFERENCES foodItem(foodItemID)
  );

/*Foodbank Inventory*/
CREATE TABLE foodBankInventory (
    foodBankNo CHAR(4),
    foodItemID CHAR(5),
    quantity INT,
    PRIMARY KEY (foodBankNo, foodItemID),
    FOREIGN KEY (foodBankNo) REFERENCES foodbank(foodBankNo),
    FOREIGN KEY (foodItemID) REFERENCES foodItem(foodItemID)
  );
