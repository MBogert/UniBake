.mode columns
.headers on
.nullvalue NULL
PRAGMA foreign_keys = ON;


create table UserLogin(
	userID integer unique primary key on update cascade on delete cascade, 
	name text,
	phone text unique
);

create table Login(
	userID integer unique references UserLogin(userID),
	email text primary key,
	password text
);

create table School(
	schoolID integer unique primary key on update cascade on delete cascade,
	name text,
	domain text unique
);

create table Attends(
	userID integer unique references UserLogin(userID),
	schoolID integer references School(schoolID)
);

create table Recipe(
	filePath text unique primary key on update cascade on delete cascade,
	bakeTime integer
);

create table Category(
	category text,
	filePath text references Recipe(filePath),
	primary key (category, filePath)
);

create table BakeRequest(
	userID integer unique primary key references UserLogin(userID),
	startTime time,
	endTime time check (endTime > startTime) 
);

create table RequestCategory(
	userID integer references UserLogin(userID),
	category text references Category(category),
	primary key (userID, category)
);

/*Ditching this relation, but keeping just in case
create table BakeRecipe(
	userID integer references UserLogin(userID) on update cascade on delete cascade check(userID in BakeRequest),
	recipe text references Recipe(filePath) on update cascade on delete cascade,
	primary key (userID, filePath)
);
*/

create table Pair(
	user1 integer unique references UserLogin(userID),
	user2 integer unique references UserLogin(userID),
	recipe text references Recipe(filePath),
	primary key (user1, user2)
);

