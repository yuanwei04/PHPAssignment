CREATE DATABASE foodhelpcentre;

CREATE TABLE account (
    accountID CHAR(5) PRIMARY KEY,
    name VARCHAR(20),
    age INT,
    email VARCHAR(50),
    password VARCHAR(12),
    accountType VARCHAR(20)
);

CREATE TABLE foodbank (
    foodBankNo INT(8) PRIMARY KEY AUTO_INCREMENT,
    location VARCHAR(20),
    contactNum VARCHAR(20)
);

CREATE TABLE foodItem (
    foodItemID INT(6) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(20),
    description VARCHAR(50)
);

CREATE TABLE foodDonation (
    foodDonationID INT(8) PRIMARY KEY AUTO_INCREMENT,
    `date` DATE,
    `time` TIME,
    contactNum VARCHAR(20),
    itemDonate VARCHAR(50),
    address VARCHAR(50),
    city VARCHAR(30),
    postcode VARCHAR(10),
    state VARCHAR(20),
    foodBankNo INT(8),
    accountID CHAR(8),
    FOREIGN KEY (foodBankNo) REFERENCES foodbank(foodBankNo),
    FOREIGN KEY (accountID) REFERENCES account(accountID)
);

CREATE TABLE foodDonationItem (
    foodDonationID INT(8),
    foodItemID INT(8),
    quantity INT,
    status VARCHAR(20),
    PRIMARY KEY (foodDonationID, foodItemID),
    FOREIGN KEY (foodDonationID) REFERENCES fooddonation(foodDonationID),
    FOREIGN KEY (foodItemID) REFERENCES fooditem(foodItemID)
);

CREATE TABLE foodbankinventory (
    foodBankNo INT(4),
    foodItemID INT(8),
    quantity INT,
    PRIMARY KEY (foodBankNo, foodItemID),
    FOREIGN KEY (foodBankNo) REFERENCES foodbank(foodBankNo),
    FOREIGN KEY (foodItemID) REFERENCES fooditem(foodItemID)
);