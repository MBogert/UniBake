.mode columns
.headers on
.nullvalue NULL
PRAGMA foreign_keys = ON;


create table UserLogin(
	userID integer unique primary key, 
	name text,
	phone text unique
);

create table Login(
	userID integer unique references UserLogin(userID) on update cascade on delete cascade,
	email text primary key,
	password text
);

create table School(
	schoolID integer unique primary key,
	name text,
	domain text unique
);

create table Attends(
	userID integer unique references UserLogin(userID) on update cascade on delete cascade,
	schoolID integer references School(schoolID) on update cascade on delete cascade
);

create table Recipe(
	filePath text unique primary key,
	bakeTime integer
);

create table Category(
	filePath text references Recipe(filePath) on update cascade on delete cascade,
	category text,
	primary key (filePath, category)
);

create table BakeRequest(
	userID integer unique primary key references UserLogin(userID) on update cascade on delete cascade,
	startTime time,
	endTime time check (endTime > startTime) 
);

create table RequestCategory(
	userID integer references UserLogin(userID) on update cascade on delete cascade,
	category text references Category(category) on update cascade on delete cascade,
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
	user1 integer unique references UserLogin(userID) on update cascade on delete cascade,
	user2 integer unique references UserLogin(userID) on update cascade on delete cascade,
	recipe text references Recipe(filePath) on update cascade on delete cascade,
	primary key (user1, user2)
);

