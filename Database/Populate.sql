--UserLogin
insert into UserLogin values(1, 'Matt Bogert', '360-689-7730');
insert into UserLogin values(2, 'Mark Gilbert', '111-111-1111');
insert into UserLogin values(3, 'Jessica Ugalde', '222-222-2222');
insert into UserLogin values(4, 'Daniel Rubin', '333-333-3333');
insert into UserLogin values(5, 'Ben Jensen', '444-444-4444');
insert into UserLogin values(6, 'Bob Smith', '555-555-5555');
insert into UserLogin values(7, 'Paula Dean', '666-666-6666');
insert into UserLogin values(8, 'Kendrick Lamar', '777-777-7777');
insert into UserLogin values(9, 'Mr. Miyagi', '888-888-8888');
insert into UserLogin values(10, 'Ben Test', '123-444-4444');
insert into UserLogin values(11, 'Bob Test', '123-555-5555');
insert into UserLogin values(12, 'Paula Test', '123-666-6666');
insert into UserLogin values(13, 'Kendrick Test', '123-777-7777');
insert into UserLogin values(14, 'Mr. Test', '123-888-8888');


--Login
insert into Login values(1, 'mbogert@pugetsound.edu', '$pIcy');
insert into Login values(2, 'mgilbert@pugetsound.edu', '$pIcy');
insert into Login values(3, 'jchanugalde@pugetsound.edu', '@$terix');
insert into Login values(4, 'drubin@pugetsound.edu', '%hash%');
insert into Login values(5, 'bjensen@uw.edu', 'BJ&mmin');
insert into Login values(6, 'bsmith@evergreen.edu', 'bobbeh');
insert into Login values(7, 'pdean@evergreen.edu', 'XXXbutterXXX');
insert into Login values(8, 'klamar@uw.edu', 'b@ck$eat');
insert into Login values(9, 'miyagi@uw.edu', 'kkidOG');
insert into Login values(10, 'btest@pugetsound.edu', 'BJ&mmin');
insert into Login values(11, 'btest2@pugetsound.edu', 'bobbeh');
insert into Login values(12, 'ptest@pugetsound.edu', 'XXXbutterXXX');
insert into Login values(13, 'kltest@pugetsound.edu', 'b@ck$eat');
insert into Login values(14, 'miytest@pugetsound.edu', 'kkidOG');


--School
insert into School values(1, 'University of Puget Sound', 'pugetsound.edu');
insert into School values(2, 'University of Washington Seattle', 'uw.edu');
insert into School values(3, 'Evergreen State College', 'evergreen.edu');


--Attends
insert into Attends values(1, 1);
insert into Attends values(2, 1);
insert into Attends values(3, 1);
insert into Attends values(4, 1);
insert into Attends values(5, 2);
insert into Attends values(6, 3);
insert into Attends values(7, 3);
insert into Attends values(8, 2);
insert into Attends values(9, 2);
insert into Attends values(10, 1);
insert into Attends values(11, 1);
insert into Attends values(12, 1);
insert into Attends values(13, 1);
insert into Attends values(14, 1);


--Recipe
insert into Recipe values('choc_chip_cookie.txt', 30);
insert into Recipe values('raw_cookie_dough.txt', 0);
insert into Recipe values('pecan_pie.txt', 90);
insert into Recipe values('vegan_choc_chip_cookie.txt', 30);
insert into Recipe values('mug_cake.txt', 15);
insert into Recipe values('brownies.txt', 20);
insert into Recipe values('v_good_brownies.txt', 420);
insert into Recipe values('pizooki.txt', 20);


--Category
insert into Category values('choc_chip_cookie.txt', 'Cookie');
insert into Category values('choc_chip_cookie.txt', 'Chocolate');
insert into Category values('choc_chip_cookie.txt', 'Gooey');
insert into Category values('raw_cookie_dough.txt', 'Cookie');
insert into Category values('raw_cookie_dough.txt', 'Chocolate');
insert into Category values('raw_cookie_dough.txt', 'Easy');
insert into Category values('raw_cookie_dough.txt', 'Salmonella');
insert into Category values('raw_cookie_dough.txt', 'Doughy');
insert into Category values('pecan_pie.txt', 'Pie');
insert into Category values('pecan_pie.txt', 'Nuts');
insert into Category values('pecan_pie.txt', 'Complex');
insert into Category values('pecan_pie.txt', 'Gooey');
insert into Category values('pecan_pie.txt', 'Savory');
insert into Category values('vegan_choc_chip_cookie.txt', 'Cookie');
insert into Category values('vegan_choc_chip_cookie.txt', 'Vegan');
insert into Category values('vegan_choc_chip_cookie.txt', 'Chocolate');
insert into Category values('mug_cake.txt', 'Easy');
insert into Category values('mug_cake.txt', 'Cake');
insert into Category values('mug_cake.txt', 'Small');
insert into Category values('brownies.txt', 'Chocolate');
insert into Category values('brownies.txt', 'Gooey');
insert into Category values('v_good_brownies.txt', 'Chocolate');
insert into Category values('v_good_brownies.txt', 'Gooey');
insert into Category values('v_good_brownies.txt', 'Dank');
insert into Category values('pizooki.txt', 'Easy');
insert into Category values('pizooki.txt', 'Pie');
insert into Category values('pizooki.txt', 'Gooey');


--BakeRequest
insert into BakeRequest values(1, '02:00', '03:00');
insert into BakeRequest values(2, '02:00', '03:00');
insert into BakeRequest values(4, '03:30', '07:00');
insert into BakeRequest values(5, '08:00', '12:00');
insert into BakeRequest values(6, '15:00', '22:00');
insert into BakeRequest values(8, '09:30', '13:30');
insert into BakeRequest values(9, '06:00', '12:00');
insert into BakeRequest values(10, '08:00', '12:00');
insert into BakeRequest values(11, '15:00', '22:00');
insert into BakeRequest values(12, '09:30', '13:30');
insert into BakeRequest values(13, '06:00', '12:00');
insert into BakeRequest values(14, '06:00', '12:00');



--RequestCategory
insert into RequestCategory values(1, 'Cookie');
insert into RequestCategory values(1, 'Gooey');
insert into RequestCategory values(1, 'Dank');
insert into RequestCategory values(2, 'Cookie');
insert into RequestCategory values(2, 'Pie');
insert into RequestCategory values(2, 'Cake');
insert into RequestCategory values(4, 'Vegan');
insert into RequestCategory values(4, 'Savory');
insert into RequestCategory values(4, 'Vegan');
insert into RequestCategory values(5, 'Dank');
insert into RequestCategory values(5, 'Easy');
insert into RequestCategory values(5, 'Salmonella');
insert into RequestCategory values(6, 'Gooey');
insert into RequestCategory values(6, 'Doughy');
insert into RequestCategory values(6, 'Chocolate');
insert into RequestCategory values(8, 'Pie');
insert into RequestCategory values(8, 'Cake');
insert into RequestCategory values(8, 'Small');
insert into RequestCategory values(9, 'Chocolate');
insert into RequestCategory values(9, 'Easy');
insert into RequestCategory values(9, 'Small');
insert into RequestCategory values(10, 'Cookie');
insert into RequestCategory values(10, 'Pie');
insert into RequestCategory values(10, 'Cake');
insert into RequestCategory values(11, 'Cookie');
insert into RequestCategory values(11, 'Pie');
insert into RequestCategory values(11, 'Cake');
insert into RequestCategory values(12, 'Cookie');
insert into RequestCategory values(12, 'Pie');
insert into RequestCategory values(12, 'Cake');
insert into RequestCategory values(13, 'Cookie');
insert into RequestCategory values(13, 'Pie');
insert into RequestCategory values(13, 'Cake');
insert into RequestCategory values(14, 'Cookie');
insert into RequestCategory values(14, 'Pie');
insert into RequestCategory values(14, 'Cake');


