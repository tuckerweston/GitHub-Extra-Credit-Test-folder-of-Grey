/*
beers.sql

Beers table attributes

BeerID
Beer
Category - Craft vs Commercial
Styles - Brown Ale, Lager, Stout
Brewer - xxx
AlcoholContent
Appearance
Calories
Description

*/

drop table if exists Beers; 
CREATE TABLE `Beers` (
 `BeerID` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `Beer` varchar(255) DEFAULT NULL,
 `Cagegory` varchar(50) DEFAULT NULL,
 `Style` varchar(80) DEFAULT NULL,
 `Brewer` varchar(80) DEFAULT NULL,
 `Appearance` varchar(255) DEFAULT NULL,
 `Description` text DEFAULT NULL,
 `AlcoholContent` float(10,2),
 `Calories` int(10),
 PRIMARY KEY (`BeerID`) 
) ENGINE=MyISAM;

insert into Beers values (NULL,"Miller Lite","Commercial","Pilsner","SAB Miller","Light Yellow","Description goes here",4.5,110);