-- Active: 1752436556212@@127.0.0.1@3306@edu

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS admins;

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    f1 int NULL DEFAULT 0,
    f2 VARCHAR(250) DEFAULT NULL,
    f3 VARCHAR(250) DEFAULT NULL,
    f4 VARCHAR(50) DEFAULT NULL,
    f5 VARCHAR(50) DEFAULT NULL,
    f6 VARCHAR(50) DEFAULT NULL,
    f7 VARCHAR(50) DEFAULT NULL,
    f8 VARCHAR(50) DEFAULT NULL,
    f9 VARCHAR(50) DEFAULT NULL,
    f10 VARCHAR(50) DEFAULT NULL,
    f11 VARCHAR(50) DEFAULT NULL,
    f12 VARCHAR(50) DEFAULT NULL,
    f13 VARCHAR(50) DEFAULT NULL,
    f14 VARCHAR(50) DEFAULT NULL,
    f15 VARCHAR(50) DEFAULT NULL,
    f16 VARCHAR(50) DEFAULT NULL,
    img1 VARCHAR(250) DEFAULT NULL,
    created_by int NULL DEFAULT NULL,
    updated_by int NULL DEFAULT NULL,
    created_date datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_date datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
    status int NOT NULL DEFAULT 1,
    UNIQUE (f2)
);

INSERT INTO admins ( id, f1, f2, f3, f4, f5, f6, f7, f8, f9, f10, f11, f12, f13, f14, f15, f16, img1, created_by, created_date, updated_by, updated_date, status )VALUES 
(1, 1, 'superadmin', '$2y$10$MCq3kqg5TpP5rvviemVayuO4Hvfxh3/JJ4mylf6IsX7rhT3gagTee', NULL, NULL, 'Super Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-16 05:44:34', NULL, '2024-05-16 05:46:09', 1),
(2, 2, 'test', '$2y$10$3FfeUww3zO064Ow0XLGuG.daTbg6tgY8iiQ2VsQcLyWemIiLzmojS', NULL, NULL, 'test', NULL, '0770000000', 'test@gmail.com', 'test', NULL, NULL, NULL, NULL, NULL, NULL, '../uploads/admin/profile/2/17465536047600.png', NULL, '2025-05-06 17:14:30', NULL, '2025-05-06 17:14:58', 0),
(3, 3, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-06 17:15:48', NULL, '2025-05-06 17:16:01', 0);



DROP TABLE IF EXISTS  users ;

CREATE TABLE  users (
  id  int NOT NULL AUTO_INCREMENT,
  level int(11) NOT NULL DEFAULT '1',
  f1  varchar(250)   NULL DEFAULT NULL,
  f2  varchar(255)   NULL DEFAULT NULL,
  f3  varchar(255)   NULL DEFAULT NULL,
  f4  varchar(255)   NULL DEFAULT NULL,
  f5  varchar(255)   NULL DEFAULT NULL,
  f6  varchar(255)   NULL DEFAULT NULL,
  f7  varchar(255)   NULL DEFAULT NULL,
  f8  varchar(255)   NULL DEFAULT NULL,
  f9  varchar(255)   NULL DEFAULT NULL,
  f10  varchar(255)   NULL DEFAULT NULL,
  f11  varchar(255)   NULL DEFAULT NULL,
  f12  varchar(255)   NULL DEFAULT NULL,
  f13  varchar(255)   NULL DEFAULT NULL,
  f14  varchar(255)   NULL DEFAULT NULL,
  f15  varchar(255)   NULL DEFAULT NULL,
  f16  varchar(255)   NULL DEFAULT NULL,
  f17  varchar(255)   NULL DEFAULT NULL,
  f18  varchar(255)   NULL DEFAULT NULL,
  f19  varchar(255)   NULL DEFAULT NULL,
  f20  varchar(255)   NULL DEFAULT NULL,
  f21  varchar(255)   NULL DEFAULT NULL,
  f22  varchar(255)   NULL DEFAULT NULL,
  f23  varchar(255)   NULL DEFAULT NULL,
  f24  varchar(255)   NULL DEFAULT NULL,
  f25  varchar(255)   NULL DEFAULT NULL,
  f26  varchar(255)   NULL DEFAULT NULL,
  f27  varchar(255)   NULL DEFAULT NULL,
  f28  varchar(255)   NULL DEFAULT NULL,
  f29  varchar(255)   NULL DEFAULT NULL,
  f30  varchar(255)   NULL DEFAULT NULL,
  img1  text DEFAULT NULL,
  created_by  int NULL DEFAULT NULL,
  created_date  datetime   NULL,
  updated_by  int NULL DEFAULT NULL,
  updated_date  datetime   NULL,
  status  int DEFAULT 1,
  PRIMARY KEY ( id ) USING BTREE
)  ;

INSERT INTO `users` 
(`id`, `level`, `f1`, `f2`, `f3`, `f4`, `f5`, `f6`, `f7`, `f8`, `f9`, `f10`, `f11`, `f12`, `f13`, `f14`, `f15`, `f16`, `f17`, `f18`, `f19`, `f20`, `f21`, `f22`, `f23`, `f24`, `f25`, `f26`, `f27`, `f28`, `f29`, `f30`, `img1`, `created_by`, `created_date`, `updated_by`, `updated_date`, `status`) 
VALUES
(1, 1, 'don.gunasinha@gmail.com', '$2y$10$wsdHKxL5XlWbnaGg0FNqeuQs6S/4BjJXWi3FBTcRClOdG1MJOuyMS', '07399112107', 'DON', NULL, 'DON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '../uploads/user/profile/1/17422758426414.jpg', NULL, NULL, NULL, NULL, 1),
(2, 1, 'nawodhachathuraya123@gmail.com', '$2y$10$QWPYjU.TQbdVpXaKDBHE8.09eLV8hrr0rIGusuokFjCWU3J9P5odu', '0726756766', NULL, NULL, 'Nawodha', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 1, 'chandrasiri.manoj@gmail.com', '$2y$10$6CuA.lKqwLs9FXaw2B3caeVbboXkOvz7sNshIVD6AzJ7ITZt.h4aa', '07398130481', NULL, NULL, 'Manoj Mayabandara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4, 1, 'sachinitharindi2001@gmail.com', '$2y$10$T8fMyK7Ia3lW1c3E1e3wa.n3fhgOBk58PA2PPJh9lmqF/rdLYxoBm', '0112222222', NULL, NULL, 'Tharindi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);


DROP TABLE IF EXISTS countries;

CREATE TABLE countries (
    id int NOT NULL AUTO_INCREMENT,
    f1 varchar(255)  DEFAULT NULL,
    f2 LONGTEXT  DEFAULT NULL,
    f3 LONGTEXT  DEFAULT NULL,
    img1 varchar(255) DEFAULT NULL, 
    created_by int NULL DEFAULT NULL,
    created_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_by int NULL DEFAULT NULL,
    updated_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status int NULL DEFAULT 0,
    PRIMARY KEY (id) USING BTREE
) ;

INSERT INTO countries (f1, f2, f3, img1, created_by, created_date, updated_by, updated_date, status) VALUES
('Singapore ', 'The U.S. is a country of 50 states covering a vast swath of North America, with Alaska in the northwest and Hawaii extending the nation s presence into the Pacific Ocean. Major Atlantic Coast cities are New York, a global finance and culture center, and capital Washington, DC. Midwestern metropolis Chicago is known for influential architecture and on the west coast, Los Angeles Hollywood is famed for filmmaking', '<p>The U.S. is a country of 50 states covering a vast swath of North America, with Alaska in the northwest and Hawaii extending the nation’s presence into the Pacific Ocean. Major Atlantic Coast cities are New York, a global finance and culture center, and capital Washington, DC. Midwestern metropolis Chicago is known for influential architecture and on the west coast, Los Angeles Hollywood is famed for filmmaking</p><ul><li>Text</li><li>Text</li><li>Text</li></ul>', './uploads/countries/17386458749692.png', NULL, '2025-04-03 20:02:09', NULL, '2025-05-03 20:58:00', 1),
('Canada', 'Canada is a country in North America. Its ten provinces and three territories extend from the Atlantic Ocean to the Pacific Ocean and northward into the Arctic Ocean, making it the worlds second-largest country by total area, with the worlds longest coastline', '<p>Canada is a country in North America. Its ten provinces and three territories extend from the Atlantic Ocean to the Pacific Ocean and northward into the Arctic Ocean, making it the worlds second-largest country by total area, with the worlds longest coastline</p><ul><li>Text</li><li>Text</li></ul>', './uploads/countries/17386262625028.jpg', NULL, '2025-04-03 20:02:09', NULL, '2025-04-03 20:02:09', 1),
('Malaysia ', 'Mexico, officially the United Mexican States, is a country in North America. It borders the United States to the north, and Guatemala and Belize to the southeast; while having maritime boundaries with the Pacific Ocean to the west, the Caribbean Sea to the southeast, and the Gulf of Mexico to the east.', '<p>Mexico, officially the United Mexican States, is a country in North America. It borders the United States to the north, and Guatemala and Belize to the southeast; while having maritime boundaries with the Pacific Ocean to the west, the Caribbean Sea to the southeast, and the Gulf of Mexico to the east.</p><ul><li>Text</li><li>Text</li><li>Text</li></ul>', './uploads/countries/17386263581408.jpg', NULL, '2025-04-03 20:02:09', NULL, NULL, 1),
('Finland ', 'Brazil, officially the Federative Republic of Brazil, is the largest and easternmost country in South America. It is the worlds fifth-largest country by area and the seventh largest by population, with over 212 million people.', '<p>Brazil, officially the Federative Republic of Brazil, is the largest and easternmost country in South America. It is the worlds fifth-largest country by area and the seventh largest by population, with over 212 million people.</p><ul><li>Text</li><li>Text</li><li>Text</li></ul>', './uploads/countries/17386455877829.jpg', NULL, '2025-04-03 20:02:09', NULL, NULL, 1),
('New Zealand ', 'South America', '', './uploads/countries/17386466473438.png', NULL, '2025-04-03 20:02:09', NULL, '2025-05-03 21:03:18', 1),
('United Kingdom', '<h2 class=\"\"><b>Study in the UK</b></h2><h4 class=\"\">Course Levels you can apply to study in the UK</h4><ul><li>Foundation Certificate – Apply with G.C.E Ordinary Level</li><li>International year one -&nbsp; Apply with G.C.E A/L</li><li>Bachelor’s degree – Apply with 3 credit passes</li><li>Top up degree - Apply with Diploma, HND, or Advanced Diploma&nbsp;</li><li>Pre Masters - Apply with Bachelor\'s degree 50% Marks&nbsp;</li><li>Masters – Apply with Bachelors degree&nbsp;</li><li>Masters By Research – Apply with bachelors degree ( 2:2)&nbsp;</li><li>Doctoral Levels – Apply with Masters&nbsp;</li></ul><h3 class=\"\"><b>Why Apply for a UK Student Visa?&nbsp;</b></h3><ul><li>90 QS World Ranking Universities</li><li>96% Student visa success rate</li><li>Two years of post-study work visa</li><li><span style=\"font-size: 1rem;\">Tuition Fee £10,000 - £45,000&nbsp; per year</span></li><li><span style=\"font-size: 1rem;\">Scholarship of £ 1,000 up to £ 6,000 per year</span></li><li><span style=\"font-size: 1rem;\">Get a Visa in 3 to 6 weeks</span></li><li><span style=\"font-size: 1rem;\">IELTS Waiver Options</span></li></ul>', '<h2 data-start=\"376\" data-end=\"428\" class=\"\"><strong data-start=\"379\" data-end=\"428\">Study in the UK and Build a Successful Career</strong></h2>\r\n<p data-start=\"430\" data-end=\"745\" class=\"\">The United Kingdom is one of the most sought-after destinations for international students, welcoming over 600,000 students each year from around the globe. With world-renowned universities such as <strong data-start=\"628\" data-end=\"638\">Oxford and Cambridge, among many others</strong>, the UK offers internationally recognized degrees that open doors worldwide.</p>\r\n<p data-start=\"747\" data-end=\"1057\" class=\"\">Studying in the UK combines academic excellence with a culturally rich and inclusive environment. UK qualifications are highly respected by employers and academic institutions globally, and the shorter duration of degree programs often means lower tuition costs compared to countries like the USA or Australia.</p>\r\n<h3 data-start=\"1059\" data-end=\"1087\" class=\"\"><strong data-start=\"1063\" data-end=\"1087\">Why Study in the UK?</strong></h3>\r\n<ul data-start=\"1088\" data-end=\"1717\">\r\n<li data-start=\"1088\" data-end=\"1216\" class=\"\">\r\n<p data-start=\"1090\" data-end=\"1216\" class=\"\">Home to some of the <strong data-start=\"1110\" data-end=\"1137\">top-ranked universities</strong> in the world, many of which feature prominently in global university rankings.</p>\r\n</li>\r\n<li data-start=\"1217\" data-end=\"1320\" class=\"\">\r\n<p data-start=\"1219\" data-end=\"1320\" class=\"\">A rich educational heritage with centuries-old institutions known for innovation and academic rigour.</p>\r\n</li>\r\n<li data-start=\"1321\" data-end=\"1431\" class=\"\">\r\n<p data-start=\"1323\" data-end=\"1431\" class=\"\">Offers a wide range of <strong data-start=\"1346\" data-end=\"1366\">in-demand fields</strong> such as Engineering, Business, Management, Law, Art, and Design.</p>\r\n</li>\r\n<li data-start=\"1432\" data-end=\"1546\" class=\"\">\r\n<p data-start=\"1434\" data-end=\"1546\" class=\"\">Opportunities for <strong data-start=\"1452\" data-end=\"1487\">postgraduate study and research</strong>, often with the potential for <strong data-start=\"1518\" data-end=\"1545\">Tier 4 visa sponsorship</strong>.</p>\r\n</li>\r\n<li data-start=\"1547\" data-end=\"1622\" class=\"\">\r\n<p data-start=\"1549\" data-end=\"1622\" class=\"\">A diverse and welcoming society, ideal for students from all backgrounds.</p>\r\n</li>\r\n<li data-start=\"1623\" data-end=\"1717\" class=\"\">\r\n<p data-start=\"1625\" data-end=\"1717\" class=\"\">A UK degree enhances your employability and prepares you for a <strong data-start=\"1688\" data-end=\"1716\">successful global career</strong>.</p>\r\n</li>\r\n</ul>\r\n<p data-start=\"1719\" data-end=\"1991\" class=\"\">At <strong data-start=\"1722\" data-end=\"1778\">New Wings UK Consultants</strong>, we specialize in guiding students through every step of their journey—from selecting the right university and course, to <strong data-start=\"1901\" data-end=\"1939\">visa guidance, application support</strong>, and even <strong data-start=\"1950\" data-end=\"1990\">arrival and accommodation assistance</strong>.</p>\r\n<p data-start=\"1993\" data-end=\"2152\" class=\"\">Whether you\'re looking to pursue a bachelor\'s, master\'s, or doctoral degree in the UK, we\'re here to make your academic journey smooth, secure, and successful.</p>', './uploads/countries/17386263361071.jpg', NULL, '2025-04-03 20:02:09', NULL, '2025-04-25 04:42:10', 1),
('Germany', 'Europe', '', './uploads/countries/17386456076840.jpg', NULL, '2025-04-03 20:02:09', NULL, '2025-04-03 20:02:09', 1),
('France', 'Europe', '', './uploads/countries/17386456182753.jpeg', NULL, '2025-04-03 20:02:09', NULL, '2025-04-03 20:02:09', 1),
('Ireland ', 'Europe', '', './uploads/countries/17386456301118.jpg', NULL, '2025-04-03 20:02:09', NULL, NULL, 1),
('Australia', 'Europe', '', './uploads/countries/17386466711245.jpeg', NULL, '2025-04-03 20:02:09', NULL, NULL, 1),
('China', 'Asia', '', './uploads/countries/17386456767695.jpg', NULL, '2025-04-03 20:02:09', NULL, '2025-04-03 20:02:09', 1),
('India', 'Asia', '', './uploads/countries/17386457215633.jpg', NULL, '2025-04-03 20:02:09', NULL, '2025-04-03 20:02:09', 1),
('Japan', 'Asia', '', './uploads/countries/17386457413573.jpg', NULL, '2025-04-03 20:02:09', NULL, '2025-04-03 20:02:09', 1),
('South Korea', 'Asia', '', './uploads/countries/17386457808095.jpeg', NULL, '2025-04-03 20:02:09', NULL, '2025-04-03 20:02:09', 1),
('Russia', 'Europe/Asia', '', './uploads/countries/17386465956013.jpg', NULL, '2025-04-03 20:02:09', NULL, '2025-04-03 20:02:09', 1),
('Australia', 'Oceania', '', './uploads/countries/17386458127240.jpg', NULL, '2025-04-03 20:02:09', NULL, '2025-04-03 20:02:09', 1),
('New Zealand', 'Oceania', '', './uploads/countries/17386466078531.jpg', NULL, '2025-04-03 20:02:09', NULL, '2025-04-03 20:02:09', 1),
('South Africa', 'Africa', '', './uploads/countries/17386458322090.jpeg', NULL, '2025-04-03 20:02:09', NULL, '2025-04-03 20:02:09', 1);




DROP TABLE IF EXISTS universities;

CREATE TABLE universities (
    id INT NOT NULL AUTO_INCREMENT,
    f1 VARCHAR(255) DEFAULT NULL,
    f3 VARCHAR(255) DEFAULT NULL,
    f4 VARCHAR(255) DEFAULT NULL,
    f5 VARCHAR(255) DEFAULT NULL,
    f6 VARCHAR(255) DEFAULT NULL,
    img1 VARCHAR(255) DEFAULT NULL,
    country INT NOT NULL,
    created_by INT NULL DEFAULT NULL,
    created_date DATETIME(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_by INT NULL DEFAULT NULL,
    updated_date DATETIME(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status INT NULL DEFAULT 0,
    PRIMARY KEY (id) USING BTREE,
    CONSTRAINT fk_country_id FOREIGN KEY (country) REFERENCES countries(id) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE       
);

INSERT INTO universities (f1, country, f3, f4, f5, img1, status) VALUES
('Harvard University', 1, 'info@harvard.edu', 'https://www.harvard.edu', 1636, './uploads/universities/17386622055334.png', 1),
('University of Tokyo', 9, 'contact@u-tokyo.ac.jp', 'https://www.u-tokyo.ac.jp', 1877, './uploads/universities/17386622353893.png', 1),
('University of Melbourne', 10, 'info@unimelb.edu.au', 'https://www.unimelb.edu.au', 1853, './uploads/universities/17386627845539.png', 1),
('University of Toronto', 2, 'info@utoronto.ca', 'https://www.utoronto.ca', 1827, './uploads/universities/17386643434063.png', 1),
('Heidelberg University', 5, 'info@uni-heidelberg.de', 'https://www.uni-heidelberg.de', 1386, './uploads/universities/17386664663382.png', 1),
('Peking University', 7, 'info@pku.edu.cn', 'https://www.pku.edu.cn', 1898, './uploads/universities/17386639928758.png', 1),
('California Institute of Technology', 1, 'info@caltech.edu', 'https://www.caltech.edu', 1891, './uploads/universities/17386640104756.png', 1),
('Tsinghua University', 7, 'info@tsinghua.edu.cn', 'https://www.tsinghua.edu.cn', 1911, './uploads/universities/17386672956798.jpg', 1),
('Indian Institute of Technology Bombay', 8, 'contact@iitb.ac.in', 'https://www.iitb.ac.in', 1958, './uploads/universities/17386673824329.png', 1),
('University of Cape Town', 11, 'info@uct.ac.za', 'https://www.uct.ac.za', 1829, './uploads/universities/17386674377951.jpg', 1),
('University of São Paulo', 3, 'info@usp.br', 'https://www.usp.br', 1934, './uploads/universities/17386675562701.jpg', 1),
('University of Sydney', 10, 'info@sydney.edu.au', 'https://www.sydney.edu.au', 1850, './uploads/universities/17386676065205.png', 1);



DROP TABLE IF EXISTS courses;

CREATE TABLE courses (
    id INT NOT NULL AUTO_INCREMENT,
    f1 LONGTEXT DEFAULT NULL,
    f2 VARCHAR(255) DEFAULT NULL,
    f3 LONGTEXT DEFAULT NULL,
    f4 VARCHAR(255) DEFAULT NULL,
    f5 VARCHAR(255) DEFAULT NULL,
    f6 VARCHAR(255) DEFAULT NULL,
    university INT NOT NULL, 
    category INT NOT NULL, 
    created_by INT NULL DEFAULT NULL,
    created_date DATETIME(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_by INT NULL DEFAULT NULL,
    updated_date DATETIME(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status INT NULL DEFAULT 0,
    PRIMARY KEY (id) USING BTREE,
    CONSTRAINT fk_university_id FOREIGN KEY (university) REFERENCES universities(id),
    CONSTRAINT fk_category_id FOREIGN KEY (category) REFERENCES categories(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

INSERT INTO courses (id, f1, f2, f3, f4, f5, f6, university, category, created_by, created_date, updated_by, updated_date, status) VALUES
(1, 'ENG101ACC304anguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis,', 'Mechanical Engineering Basics', '4 yearszxzxzxzxzxzxzxzxzxzxzxzxz**Overview**Immerse yourself in global history, politics, language and culture. Understand the forces shaping how nations interact. Discover the role international relations plays in tackling the big issues facing society and the planet.On this BA (Hons) International Relations and Languages degree, you’ll explore topics such as global migration, terrorism, climate change, the rise and fall of major powers, and global protest movements – and learn the skills needed to help enact change, shape opinions, and tackle inequality.You’ll study a foreign language and spend a year abroad in a country and culture where your chosen language is spoken – and set yourself up for careers in international diplomacy, business, journalism, research and translation.**Course highlights**- Learn from staff at our Centre for European and International Studies Research (CEISR), whose research impacts government policy- Use our professional-grade conference interpreting suite and language labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis, the \'MeToo\' movement, the rise of terrorist organisations and the Arab Revolutions, as part of a simulated ‘academic conference’**Careers and opportunities**The language skills you’ll gain can open up a world of opportunities: they’ll help you to work globally, and open up job opportunities across borders and cultures.With technology continuing to develop at a frantic pace, there’s also an ever-increasing demand for graduates with the knowledge required to ensure new developments are ethical. The analytical skills you’ll develop are in demand, too – your ability to understand complex issues and find solutions to them means that roles across government agencies, NGOs, charities, think tanks and international organisations are all within your reach.When you finish the course, our Careers and Employability service can help you find a job that puts your skills and cultural experience to work. What can you do with an International Relations and Languages degree? Graduates from this degree have gone on to careers in the following sectors:- local and central government - embassies- non-governmental organisations (NGOs)- security services - international organisations, like the United Nations (UN) - international charities like Amnesty International or the Red Cross - policy research and think tanks- media and international business consultancy - political risk analysis - public relations - voluntary organisations - management - banking and financial services- tourism What jobs can you do with an International Relations and Languages degree?Recent graduates have gone on to roles including:- bilingual consultant - multilingual project coordinator - translator - political researcher, Houses of Parliament- civil servant, the Cabinet Office- senior policy advisor, Ministry of Housing, Communities and Local Government- communications officer, House of Commons- local government administrator, Government of Jersey- public affairs consultant - social researcher - information officer - conference producer After you leave the University, you can get help, advice and support for up to 5 years from our Careers and Employability service as you advance in your career.', 'Bachelor', '5000', '2025-03-01',  1,3, NULL, '2025-04-03 20:02:10', 1, '2025-04-04 09:58:37', 1),
(2, 'ACC305anguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis, the \'MeToo\' movement, the rise of terrorist organisations and the Arab Revolutions, as part of a simulated ‘academic conference’**Careers and opportunities**The language skills you’ll gain can open up a world of opportunities: they’ll help you to work globally, and open up job opportunities across borders and cultures.With technology continuing to develop at a frantic pace, there’s also an ever-increasing demand for graduates with the knowledge required to ensure new developments are ethical. The analytical skills you’ll develop are in demand, too – your ability to understand complex issues and find solutions to them means that roles across government agencies, NGOs, charities, think tanks and international organisations are all within your reach.When you finish the course, our Careers and Employability service can help you find a job that puts your skills and cultural experience to work. What can you do with an International Relations and Languages degree? Graduates from this degree have gone on to careers in the following sectors:- local and central government - embassies- non-governmental organisations (NGOs)- security services - international organisations, like the United Nations (UN) - international charities like&nbsp;', 'Management Accounting', '<b>3 yearsanguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis, the \'MeToo\' movement, the rise of terrorist organisations and the Arab Revolutions, as part of a simulated ‘academic conference’**Careers and opportunities**The language skills you’ll gain can open up a world of opportunities: they’ll help you to work globally, and open up job opportunities across borders and cultures.With technology continuing to develop at a frantic pace, there’s also an ever-increasing demand for graduates with the knowledge required to ensure new developments are ethical. The analytical skills you’ll develop are in demand, too – your ability to understand complex issues and find solutions to them means that roles across government agencies, NGOs, charities, think tanks and international organisations are all within your reach.When you finish the course, our Careers and Employability service can help you find a job that puts your skills and cultural experience to work. What can you do with an International Relations and Languages degree? Graduates from this degree have gone on to careers in the following sectors:- local and central government - embassies- non-governmental organisations (NGOs)- security services - international organisations, like the United Nations (UN) - international charities like&nbsp;</b>', 'Bachelor', '4600', '2025-03-06', 1,3, NULL, '2025-04-03 20:02:10', NULL, '2025-04-03 20:02:10', 1),
(3, 'ART202anguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis, the \'MeToo\' movement, the rise of terrorist organisations and the Arab Revolutions, as part of a simulated ‘academic conference’**Careers and opportunities**The language skills you’ll gain can open up a world of opportunities: they’ll help you to work globally, and open up job opportunities across borders and cultures.With technology continuing to develop at a frantic pace, there’s also an ever-increasing demand for graduates with the knowledge required to ensure new developments are ethical. The analytical skills you’ll develop are in demand, too – your ability to understand complex issues and find solutions to them means that roles across government agencies, NGOs, charities, think tanks and international organisations are all within your reach.When you finish the course, our Careers and Employability service can help you find a job that puts your skills and cultural experience to work. What can you do with an International Relations and Languages degree? Graduates from this degree have gone on to careers in the following sectors:- local and central government - embassies- non-governmental organisations (NGOs)- security services - international organisations, like the United Nations (UN) - international charities like&nbsp;', 'Graphic Design & Digital Media', '3 yearsanguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis, the \'MeToo\' movement, the rise of terrorist organisations and the Arab Revolutions, as part of a simulated ‘academic conference’**Careers and opportunities**The language skills you’ll gain can open up a world of opportunities: they’ll help you to work globally, and open up job opportunities across borders and cultures.With technology continuing to develop at a frantic pace, there’s also an ever-increasing demand for graduates with the knowledge required to ensure new developments are ethical. The analytical skills you’ll develop are in demand, too – your ability to understand complex issues and find solutions to them means that roles across government agencies, NGOs, charities, think tanks and international organisations are all within your reach.When you finish the course, our Careers and Employability service can help you find a job that puts your skills and cultural experience to work. What can you do with an International Relations and Languages degree? Graduates from this degree have gone on to careers in the following sectors:- local and central government - embassies- non-governmental organisations (NGOs)- security services - international organisations, like the United Nations (UN) - international charities like&nbsp;', 'Master', '4000', '2025-03-28', 1,1, NULL, '2025-04-03 20:02:10', NULL, '2025-04-03 20:02:10', 1),
(4, 'ACC304anguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis, the \'MeToo\' movement, the rise of terrorist organisations and the Arab Revolutions, as part of a simulated ‘academic conference’**Careers and opportunities**The language skills you’ll gain can open up a world of opportunities: they’ll help you to work globally, and open up job opportunities across borders and cultures.With technology continuing to develop at a frantic pace, there’s also an ever-increasing demand for graduates with the knowledge required to ensure new developments are ethical. The analytical skills you’ll develop are in demand, too – your ability to understand complex issues and find solutions to them means that roles across government agencies, NGOs, charities, think tanks and international organisations are all within your reach.When you finish the course, our Careers and Employability service can help you find a job that puts your skills and cultural experience to work. What can you do with an International Relations and Languages degree? Graduates from this degree have gone on to careers in the following sectors:- local and central government - embassies- non-governmental organisations (NGOs)- security services - international organisations, like the United Nations (UN) - international charities like&nbsp;</u></b>', 'Banking & Financial Services', '3 yearsanguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis, the \'MeToo\' movement, the rise of terrorist organisations and the Arab Revolutions, as part of a simulated ‘academic conference’**Careers and opportunities**The language skills you’ll gain can open up a world of opportunities: they’ll help you to work globally, and open up job opportunities across borders and cultures.With technology continuing to develop at a frantic pace, there’s also an ever-increasing demand for graduates with the knowledge required to ensure new developments are ethical. The analytical skills you’ll develop are in demand, too – your ability to understand complex issues and find solutions to them means that roles across government agencies, NGOs, charities, think tanks and international organisations are all within your reach.When you finish the course, our Careers and Employability service can help you find a job that puts your skills and cultural experience to work. What can you do with an International Relations and Languages degree? Graduates from this degree have gone on to careers in the following sectors:- local and central government - embassies- non-governmental organisations (NGOs)- security services - international organisations, like the United Nations (UN) - international charities like&nbsp;', 'phD', '4700', '2025-03-13',  4,2, NULL, '2025-04-03 20:02:10', 1, '2025-04-04 07:49:51', 1),
(5, 'ENG102ART203anguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken', 'Civil Engineering Fundamentals', '4 years', NULL, '5200', NULL, 15,2, NULL, '2025-04-03 20:02:10', NULL, '2025-04-03 20:02:10', 1),
(6, 'ENG104anguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis, the \'MeToo\' movement, the rise of terrorist organisations and the Arab Revolutions, as part of a simulated ‘academic conference’**Careers and opportunities**The language skills you’ll gain can open up a world of opportunities: they’ll help you to work globally, and open up job opportunities across borders and cultures.With technology continuing to develop at a frantic pace, there’s also an ever-increasing demand for graduates with the knowledge required to ensure new developments are ethical. The analytical skills you’ll develop are in demand, too – your ability to understand complex issues and find solutions to them means that roles across government agencies, NGOs, charities, think tanks and international organisations are all within your reach.When you finish the course, our Careers and Employability service can help you find a job that puts your skills and cultural experience to work. What can you do with an International Relations and Languages degree? Graduates from this degree have gone on to careers in the following sectors:- local and central government - embassies- non-governmental organisations (NGOs)- security services - international organisations, like the United Nations (UN) - international charities like&nbsp;', 'Computer Science & Engineering', '4 yearsanguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis, the \'MeToo\' movement, the rise of terrorist organisations and the Arab Revolutions, as part of a simulated ‘academic conference’**Careers and opportunities**The language skills you’ll gain can open up a world of opportunities: they’ll help you to work globally, and open up job opportunities across borders and cultures.With technology continuing to develop at a frantic pace, there’s also an ever-increasing demand for graduates with the knowledge required to ensure new developments are ethical. The analytical skills you’ll develop are in demand, too – your ability to understand complex issues and find solutions to them means that roles across government agencies, NGOs, charities, think tanks and international organisations are all within your reach.When you finish the course, our Careers and Employability service can help you find a job that puts your skills and cultural experience to work. What can you do with an International Relations and Languages degree? Graduates from this degree have gone on to careers in the following sectors:- local and central government - embassies- non-governmental organisations (NGOs)- security services - international organisations, like the United Nations (UN) - international charities like&nbsp;', 'phD', '6000', NULL,  10,3, NULL, '2025-04-03 20:02:10', NULL, '2025-04-03 20:02:10', 1),
(7, 'anguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis, the \'MeToo\' movement, the rise of terrorist organisations and the Arab Revolutions, as part of a simulated ‘academic conference’**Careers and opportunities**The language skills you’ll gain can open up a world of opportunities: they’ll help you to work globally, and open up job opportunities across borders and cultures.With technology continuing to develop at a frantic pace, there’s also an ever-increasing demand for graduates with the knowledge required to ensure new developments are ethical. The analytical skills you’ll develop are in demand, too – your ability to understand complex issues and find solutions to them means that roles across government agencies, NGOs, charities, think tanks and international organisations are all within your reach.When you finish the course, our Careers and Employability service can help you find a job that puts your skills and cultural experience to work. What can you do with an International Relations and Languages degree? Graduates from this degree have gone on to careers in the following sectors:- local and central government - embassies- non-governmental organisations (NGOs)- security services - international organisations, like the United Nations (UN) - international charities like&nbsp;ACC301', 'Financial Accounting', '3 yearsanguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis, the \'MeToo\' movement, the rise of terrorist organisations and the Arab Revolutions, as part of a simulated ‘academic conference’**Careers and opportunities**The language skills you’ll gain can open up a world of opportunities: they’ll help you to work globally, and open up job opportunities across borders and cultures.With technology continuing to develop at a frantic pace, there’s also an ever-increasing demand for graduates with the knowledge required to ensure new developments are ethical. The analytical skills you’ll develop are in demand, too – your ability to understand complex issues and find solutions to them means that roles across government agencies, NGOs, charities, think tanks and international organisations are all within your reach.When you finish the course, our Careers and Employability service can help you find a job that puts your skills and cultural experience to work. What can you do with an International Relations and Languages degree? Graduates from this degree have gone on to careers in the following sectors:- local and central government - embassies- non-governmental organisations (NGOs)- security services - international organisations, like the United Nations (UN) - international charities like&nbsp;', 'Master', '4500', '2025-02-28',  11,1, NULL, '2025-04-03 20:02:10', NULL, '2025-04-03 20:02:10', 1),
(8, 'ART201ART203anguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken', 'Fine Arts & Painting', '3 years', NULL, '3500', NULL,  10,1, NULL, '2025-04-03 20:02:10', NULL, '2025-04-03 20:02:10', 1),
(9, 'ENG103ART203anguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken', 'Electrical & Electronics Engineering', '4 years', NULL, '5400', NULL,  10,3, NULL, '2025-04-03 20:02:10', NULL, '2025-04-03 20:02:10', 1),
(10, 'ART203anguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis, the \'MeToo\' movement, the rise of terrorist organisations and the Arab Revolutions, as part of a simulated ‘academic conference’**Careers and opportunities**The language skills you’ll gain can open up a world of opportunities: they’ll help you to work globally, and open up job opportunities across borders and cultures.With technology continuing to develop at a frantic pace, there’s also an ever-increasing demand for graduates with the knowledge required to ensure new developments are ethical. The analytical skills you’ll develop are in demand, too – your ability to understand complex issues and find solutions to them means that roles across government agencies, NGOs, charities, think tanks and international organisations are all within your reach.When you finish the course, our Careers and Employability service can help you find a job that puts your skills and cultural experience to work. What can you do with an International Relations and Languages degree? Graduates from this degree have gone on to careers in the following sectors:- local and central government - embassies- non-governmental organisations (NGOs)- security services - international organisations, like the United Nations (UN) - international charities like&nbsp;', 'Music & Performing Arts', 'anguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis, the \'MeToo\' movement, the rise of terrorist organisations and the Arab Revolutions, as part of a simulated ‘academic conference’**Careers and opportunities**The language skills you’ll gain can open up a world of opportunities: they’ll help you to work globally, and open up job opportunities across borders and cultures.With technology continuing to develop at a frantic pace, there’s also an ever-increasing demand for graduates with the knowledge required to ensure new developments are ethical. The analytical skills you’ll develop are in demand, too – your ability to understand complex issues and find solutions to them means that roles across government agencies, NGOs, charities, think tanks and international organisations are all within your reach.When you finish the course, our Careers and Employability service can help you find a job that puts your skills and cultural experience to work. What can you do with an International Relations and Languages degree? Graduates from this degree have gone on to careers in the following sectors:- local and central government - embassies- non-governmental organisations (NGOs)- security services - international organisations, like the United Nations (UN) - international charities like&nbsp;3 years', 'Bachelor', '3800', '2025-03-07',  7,2, NULL, '2025-04-03 20:02:10', NULL, '2025-04-03 20:02:10', 1),
(11, 'ENG105anguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis, the \'MeToo\' movement, the rise of terrorist organisations and the Arab Revolutions, as part of a simulated ‘academic conference’**Careers and opportunities**The language skills you’ll gain can open up a world of opportunities: they’ll help you to work globally, and open up job opportunities across borders and cultures.With technology continuing to develop at a frantic pace, there’s also an ever-increasing demand for graduates with the knowledge required to ensure new developments are ethical. The analytical skills you’ll develop are in demand, too – your ability to understand complex issues and find solutions to them means that roles across government agencies, NGOs, charities, think tanks and international organisations are all within your reach.When you finish the course, our Careers and Employability service can help you find a job that puts your skills and cultural experience to work. What can you do with an International Relations and Languages degree? Graduates from this degree have gone on to careers in the following sectors:- local and central government - embassies- non-governmental organisations (NGOs)- security services - international organisations, like the United Nations (UN) - international charities like&nbsp;', 'Aeronautical Engineering', 'anguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis, the \'MeToo\' movement, the rise of terrorist organisations and the Arab Revolutions, as part of a simulated ‘academic conference’**Careers and opportunities**The language skills you’ll gain can open up a world of opportunities: they’ll help you to work globally, and open up job opportunities across borders and cultures.With technology continuing to develop at a frantic pace, there’s also an ever-increasing demand for graduates with the knowledge required to ensure new developments are ethical. The analytical skills you’ll develop are in demand, too – your ability to understand complex issues and find solutions to them means that roles across government agencies, NGOs, charities, think tanks and international organisations are all within your reach.When you finish the course, our Careers and Employability service can help you find a job that puts your skills and cultural experience to work. What can you do with an International Relations and Languages degree? Graduates from this degree have gone on to careers in the following sectors:- local and central government - embassies- non-governmental organisations (NGOs)- security services - international organisations, like the United Nations (UN) - international charities like&nbsp;4 years', NULL, '7000', '223332-03-23',  7,3, NULL, '2025-04-03 20:02:10', NULL, '2025-04-03 20:02:10', 1),
(12, 'anguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis, the \'MeToo\' movement, the rise of terrorist organisations and the Arab Revolutions, as part of a simulated ‘academic conference’**Careers and opportunities**The language skills you’ll gain can open up a world of opportunities: they’ll help you to work globally, and open up job opportunities across borders and cultures.With technology continuing to develop at a frantic pace, there’s also an ever-increasing demand for graduates with the knowledge required to ensure new developments are ethical. The analytical skills you’ll develop are in demand, too – your ability to understand complex issues and find solutions to them means that roles across government agencies, NGOs, charities, think tanks and international organisations are all within your reach.When you finish the course, our Careers and Employability service can help you find a job that puts your skills and cultural experience to work. What can you do with an International Relations and Languages degree? Graduates from this degree have gone on to careers in the following sectors:- local and central government - embassies- non-governmental organisations (NGOs)- security services - international organisations, like the United Nations (UN) - international charities like anguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis, the \'MeToo\' movement, the rise of terrorist organisations and the Arab Revolutions, as part of a simulated ‘academic conference’**Careers and opportunities**The language skills you’ll gain can open up a world of opportunities: they’ll help you to work globally, and open up job opportunities across borders and cultures.With technology continuing to develop at a frantic pace, there’s also an ever-increasing demand for graduates with the knowledge required to ensure new developments are ethical. The analytical skills you’ll develop are in demand, too – your ability to understand complex issues and find solutions to them means that roles across government agencies, NGOs, charities, think tanks and international organisations are all within your reach.When you finish the course, our Careers and Employability service can help you find a job that puts your skills and cultural experience to work. What can you do with an International Relations and Languages degree? Graduates from this degree have gone on to careers in the following sectors:- local and central government - embassies- non-governmental organisations (NGOs)- security services - international organisations, like the United Nations (UN) - international charities like&nbsp;ART204', 'Photography & Visual Arts', '<ol><li>3 yearsanguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken – in the classroom and on your work or study placement abroad in year 3 - Attend events and talks led by people working in NGOs, local, national and international government, and journalism- Have the opportunity to take part in a Model United Nations as part of your course- Go on field trips to locations such as the Houses of Parliament- Create policy briefing papers offering recommendations to practitioners on major recent international issues, such as the Ukraine Crisis, the \'MeToo\' movement, the rise of terrorist organisations and the Arab Revolutions, as part of a simulated ‘academic conference’**Careers and opportunities**The language skills you’ll gain can open up a world of opportunities: they’ll help you to work globally, and open up job opportunities across borders and cultures.With technology continuing to develop at a frantic pace, there’s also an ever-increasing demand for graduates with the knowledge required to ensure new developments are ethical. The analytical skills you’ll develop are in demand, too – your ability to understand complex issues and find solutions to them means that roles across government agencies, NGOs, charities, think tanks and international organisations are all within your reach.When you finish the course, our Careers and Employability service can help you find a job that puts your skills and cultural experience to work. What can you do with an International Relations and Languages degree? Graduates from this degree have gone on to careers in the following sectors:- local and central government - embassies- non-governmental organisations (NGOs)- security services - international organisations, like the United Nations (UN) - international charities like&nbsp;</li></ol>', 'phD', '3600', '2112-02-12',  12, 2, NULL, '2025-04-03 20:02:10', 1, '2025-04-04 09:52:48', 1),
(13, 'ACC303ART203anguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken', 'Taxation & Auditing', '3 years', NULL, '4800', NULL,  10,1, NULL, '2025-04-03 20:02:10', NULL, '2025-04-03 20:02:10', 1),
(14, 'ART205ART203anguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken', 'Creative Writing & Literature', '3 years', NULL, '3400', NULL,  10,1, NULL, '2025-04-03 20:02:10', NULL, '2025-04-03 20:02:10', 1),
(15, 'ACC302ART203anguage labs- Immerse yourself in the cultures of the country where your chosen language is spoken', 'Corporate Finance & Investment', '3 years', NULL, '5000', NULL, 1,2, NULL, '2025-04-03 20:02:10', 1, '2025-04-04 07:35:49', 1);


DROP TABLE IF EXISTS applications;

CREATE TABLE applications (
    id int NOT NULL AUTO_INCREMENT,
    user int DEFAULT 0,
    course int DEFAULT 0,
    value int DEFAULT 1,
    f1 varchar(255)  DEFAULT NULL,
    f2 varchar(255)  DEFAULT NULL,
    f3 varchar(255)  DEFAULT NULL,
    f4 varchar(255)  DEFAULT NULL,
    f5 longtext DEFAULT NULL,
    created_by int NULL DEFAULT NULL,
    created_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_by int NULL DEFAULT NULL,
    updated_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status int NULL DEFAULT 1,
    PRIMARY KEY (id) USING BTREE,
    CONSTRAINT fk_value_id FOREIGN KEY (value) REFERENCES application_status(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ;

INSERT INTO applications (user,course,value,created_date) VALUES
(1,9,2, '2025-03-18 01:30:53'),
(1,12,1, '2025-03-18 01:30:53'),
(1,4,1, '2025-03-18 01:30:53'),
(3,1,2, '2025-04-19 20:12:48');



DROP TABLE IF EXISTS slides;

CREATE TABLE slides (
    id int NOT NULL AUTO_INCREMENT,
    f1 varchar(255)  DEFAULT NULL,
    f2 varchar(255)  DEFAULT NULL,
    f3 varchar(255)  DEFAULT NULL,
    f4 varchar(255)  DEFAULT NULL,
    f5 longtext DEFAULT NULL,
    img1 varchar(255)  DEFAULT NULL,
    created_by int NULL DEFAULT NULL,
    created_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_by int NULL DEFAULT NULL,
    updated_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status int NULL DEFAULT 0,
    PRIMARY KEY (id) USING BTREE
) ;

INSERT INTO slides (f1,img1,status) VALUES
('singapore','./uploads/sliders/17383136017679.jpg',1),
('uk','./uploads/sliders/17383136524571.jpg',1),
('germany','./uploads/sliders/17383136687460.jpg',1),
('finland','./uploads/sliders/17383136814185.jpg',1);



DROP TABLE IF EXISTS settings;

CREATE TABLE settings (
    id int NOT NULL AUTO_INCREMENT,
    f1 varchar(255) DEFAULT NULL,
    f2 varchar(255) DEFAULT NULL,
    f3 varchar(255) DEFAULT NULL,
    f4 varchar(255) DEFAULT NULL,
    f5 varchar(255) DEFAULT NULL,
    f6 varchar(255) DEFAULT NULL,
    f7 varchar(255) DEFAULT NULL,
    f8 varchar(255) DEFAULT NULL,
    f9 varchar(255) DEFAULT NULL,
    f10 varchar(255) DEFAULT NULL,
    f11 varchar(255) DEFAULT NULL,
    f12 varchar(255) DEFAULT NULL,
    img1 varchar(255) DEFAULT NULL,
    img2 varchar(255) DEFAULT NULL,
    img3 varchar(255) DEFAULT NULL,
    img4 VARCHAR(255) DEFAULT NULL,
    img5 VARCHAR(255) DEFAULT NULL, 
    created_by int DEFAULT NULL,
    created_date datetime DEFAULT CURRENT_TIMESTAMP,
    updated_by int DEFAULT NULL,
    updated_date datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status int DEFAULT 0,
    PRIMARY KEY (id) USING BTREE
);

INSERT INTO settings (f1,f2,f3,f4,f5,f7,f9,f10,f11,f12,img2,img3,img4,img5,status) VALUES
('New Wings UK Consultants','New Wings UK','Admin New Wings UK Consultants','+447498830263','newwingsuk.pvt@gmail.com','Aztec West Business Part, Bristol, United Kingdom','Home,/,About Us,about,Courses,courses,Blogs,blogs,Events,events,Contact Us,contactus','https://www.facebook.com/new.wings.uk ','https://www.instagram.com/newwingsuk/','https://www.linkedin.com','./uploads/settings/17450928111057.jpg','./uploads/settings/17383186837929.png','./uploads/settings/17383186834429.png','./uploads/settings/17383186838228.png',1);



DROP TABLE IF EXISTS branches;

CREATE TABLE branches (
    id int NOT NULL AUTO_INCREMENT,
    f1 varchar(255)  DEFAULT NULL,
    f2 varchar(255)  DEFAULT NULL,
    f3 varchar(255)  DEFAULT NULL,
    f4 varchar(255)  DEFAULT NULL,
    f5 varchar(255) DEFAULT NULL,
    img1 varchar(255) DEFAULT NULL, 
    created_by int NULL DEFAULT NULL,
    created_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_by int NULL DEFAULT NULL,
    updated_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status int NULL DEFAULT 0,
    PRIMARY KEY (id) USING BTREE
) ;

INSERT INTO branches (f1,f2,f3,f4,f5,img1,status) VALUES
('Birmingham','United Kingdom','Address','21212121','bri@gmail.com','./uploads/branches/17388618442066.jpg',0),
('Bristol','United Kingdom','Address','21232556121','bristo@gmail.com','./uploads/branches/17388618838920.jpg',1),
('London','United Kingdom','Address','2434321','lond@gmail.com','./uploads/branches/17388619248010.jpg',0),
('Manchester','United Kingdom','Address','212125646121','bri@gmail.com','./uploads/branches/17388619696548.jpg',0),
('Colombo', 'Sri Lanka', 'NO 11/46 , ranashinghe Mw , Hiripitiya , Panipitiya', '+94777548249', 'colombo@newwingsuk.com', './uploads/branches/17450338969678.jpg', 1);



DROP TABLE IF EXISTS testimonials;

CREATE TABLE testimonials (
    id int NOT NULL AUTO_INCREMENT,
    f1 varchar(255)  DEFAULT NULL,
    f2 varchar(255)  DEFAULT NULL,
    f3 varchar(255)  DEFAULT NULL,
    img1 varchar(255)  DEFAULT NULL,
    created_by int NULL DEFAULT NULL,
    created_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_by int NULL DEFAULT NULL,
    updated_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status int NULL DEFAULT 0,
    PRIMARY KEY (id) USING BTREE
) ;

INSERT INTO testimonials (f1,f2,img1,status) VALUES
('Real Journeys Real Inspirations!','https:www.youtube.com/embed/example_video_1','./uploads/testimonials/17423134393920.jpg',1),
('Stories of Growth and Transformation','https:www.youtube.com/embed/example_video_1','./uploads/testimonials/17423134763477.jpeg',1),
('Success Speaks for Itself!','https:www.youtube.com/embed/example_video_1','./uploads/testimonials/17423135071824.jpg',1),
('Learn. Achieve. Inspire!','https:www.youtube.com/embed/example_video_1','./uploads/testimonials/17423135946555.jpg',1);



DROP TABLE IF EXISTS blogs;

CREATE TABLE blogs (
    id int NOT NULL AUTO_INCREMENT,
    f1 varchar(255)  DEFAULT NULL,
    f2 longtext  DEFAULT NULL,
    img1 varchar(255)  DEFAULT NULL,
    created_by int NULL DEFAULT NULL,
    created_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_by int NULL DEFAULT NULL,
    updated_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status int NULL DEFAULT 0,
    PRIMARY KEY (id) USING BTREE
) ;

INSERT INTO blogs (f1,img1,status) VALUES
('Blog 01','./uploads/blogs/17423100066391.jpg',1),
('Blog 02','./uploads/blogs/17423094895668.jpg',1),
('Blog 03','./uploads/blogs/17423103216546.jpg',1);



DROP TABLE IF EXISTS documents;

CREATE TABLE documents (
    id int NOT NULL AUTO_INCREMENT,
    user int DEFAULT 0,
    course int DEFAULT 0,
    f1 varchar(255)  DEFAULT NULL,
    f2 varchar(255)  DEFAULT NULL,
    created_by int NULL DEFAULT NULL,
    created_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_by int NULL DEFAULT NULL,
    updated_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status int NULL DEFAULT 1,
    PRIMARY KEY (id) USING BTREE
);

INSERT INTO documents(user,f1,f2) VALUES 
(1,'../uploads/profile/documents/1/aa.pdf', 'cv');


DROP TABLE IF EXISTS events;

CREATE TABLE events (
    id int NOT NULL AUTO_INCREMENT,
    f1 varchar(255)  DEFAULT NULL,
    f2 varchar(255)  DEFAULT NULL,
    f3 longtext  DEFAULT NULL,
    img1 varchar(255)  DEFAULT NULL,
    created_by int NULL DEFAULT NULL,
    created_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_by int NULL DEFAULT NULL,
    updated_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status int NULL DEFAULT 0,
    PRIMARY KEY (id) USING BTREE
) ;

INSERT INTO events (f1,f2,img1,status) VALUES
('ALE Advocacy for the Twin Transition Training','','./uploads/events/17423081534411.jpeg',1),
('World Education Fair 2025','Join us at World Education Fair 2025','./uploads/events/17423080966393.jpg',1);



DROP TABLE IF EXISTS abouts;

CREATE TABLE abouts (
    id int NOT NULL AUTO_INCREMENT,
    f1 longtext  DEFAULT NULL,
    f2 longtext  DEFAULT NULL,
    f3 longtext  DEFAULT NULL,
    f4 longtext  DEFAULT NULL,
    f5 longtext  DEFAULT NULL,
    f6 longtext  DEFAULT NULL,
    f7 varchar(255)  DEFAULT NULL,
    f8 varchar(255)  DEFAULT NULL,
    f9 varchar(255)  DEFAULT NULL,
    img1 varchar(255)  DEFAULT NULL,
    img2 varchar(255)  DEFAULT NULL,
    img3 varchar(255)  DEFAULT NULL,
    created_by int NULL DEFAULT NULL,
    created_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_by int NULL DEFAULT NULL,
    updated_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status int NULL DEFAULT 0,
    PRIMARY KEY (id) USING BTREE
) ;

INSERT INTO abouts (f1, f2, f3, f4, f5, f6, f7, f8, f9, img1, img2, img3, status) VALUES
(
    '<p><span style="color: rgb(55, 65, 81); font-family: ui-sans-serif, system-ui, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: medium; background-color: rgb(249, 250, 251);">At New Wings, we are committed to guiding students toward academic success and international opportunities. With years of expertise in career counseling, university admissions, and student placement services, we help aspiring students gain access to top universities across the UK, USA, Canada, Australia, and beyond.</span></p>',
    '<p><span style="color: rgb(55, 65, 81); font-family: ui-sans-serif, system-ui, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: medium; background-color: rgb(249, 250, 251);">Our team of experienced education consultants provides personalized support in course selection, scholarship guidance, visa processing, and career planning. We partner with prestigious institutions worldwide to offer students the best possible educational pathways tailored to their ambitions.</span></p>',
    '<p><span style="color: rgb(55, 65, 81); font-family: ui-sans-serif, system-ui, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: medium; background-color: rgb(249, 250, 251);">Whether you’re looking for undergraduate, postgraduate, or professional development programs, New Wings is here to ensure a seamless journey toward academic excellence. Start your education journey with confidence—your future begins with New Wings!</span></p>',
    '<p><span style="color: rgb(75, 85, 99); font-family: ui-sans-serif, system-ui, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: medium;">Our mission is to support and empower students with energetic and imaginative minds through world-class education, knowledge creation, and strong connections that help them thrive in the corporate world, contributing to both professional and organizational growth.</span></p>',
    '<p><span style="color: rgb(75, 85, 99); font-family: ui-sans-serif, system-ui, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: medium;">Our vision is to be a leading education consultancy that provides students with personalized guidance, helping them achieve their dream of studying abroad and securing rewarding career opportunities.</span></p>',
    '<p><span style="color: rgb(75, 85, 99); font-family: ui-sans-serif, system-ui, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: medium;">Join our community of students who have successfully pursued higher education worldwide. Explore our website, apply to your preferred universities, or consult our experts to begin your educational journey with confidence.</span></p>',
    'Welcome to New Wings',
    'Expert Guidance & Training',
    'Accredited & Certified',
    './uploads/about/17423812331957.jpg',
    './uploads/about/17423812337900.jpg',
    './uploads/about/17423812336648.jpg',
    1
);



DROP TABLE IF EXISTS application_status;

CREATE TABLE application_status (
    id int NOT NULL AUTO_INCREMENT,
    f1 varchar(255)  DEFAULT NULL, 
    f2 longtext  DEFAULT NULL, 
    created_by int NULL DEFAULT NULL,
    created_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_by int NULL DEFAULT NULL,
    updated_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status int NULL DEFAULT 0,
    PRIMARY KEY (id) USING BTREE
) ;
 
INSERT INTO application_status (f1,f2,status) VALUES
('PENDING DOCUMENT','The required documents have not yet been submitted or processed. Please ensure that all necessary paperwork is completed and submitted for verification. This step is crucial for proceeding to the next phase of the process. Missing or incomplete documents may delay further actions.',1),
('⁠WATING FOR OFFER LETTER','The application has been reviewed, and the process is currently awaiting the issuance of the offer letter. Please monitor your email or application portal for updates. This stage indicates that your request has been acknowledged, and the formal offer is being prepared',1),
('PENDING FIRST PAYMENT ','The initial payment required to proceed with the process has not yet been received. Please complete the payment to confirm your commitment and move forward. Delays in payment may impact the timelines or progression of the process.',1),
('PENDING VISA','The visa application process is underway, and approval is currently pending. Please ensure that all required documents have been submitted to the appropriate authorities and monitor for updates. Delays at this stage may depend on processing times or additional requirements from the issuing authority.',1);



DROP TABLE IF EXISTS faqs;

CREATE TABLE faqs (
    id int NOT NULL AUTO_INCREMENT,
    f1 LONGTEXT  DEFAULT NULL, 
    f2 LONGTEXT  DEFAULT NULL, 
    f3 varchar(255)  DEFAULT NULL, 
    f4 varchar(255) DEFAULT NULL, 
    f5 varchar(255) DEFAULT NULL, 
    f6 varchar(255) DEFAULT NULL, 
    f7 LONGTEXT  DEFAULT NULL, 
    created_by int NULL DEFAULT NULL,
    created_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_by int NULL DEFAULT NULL,
    updated_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status int NULL DEFAULT 0,
    PRIMARY KEY (id) USING BTREE
) ;
 
INSERT INTO faqs (f1,f2,f3,f4,f5,f6,f7,status) VALUES
('Why should we apply through New Wings?','<p>Applying through New Wings offers numerous advantages that can help you achieve your educational and career goals with ease. With direct access to top institutions, the platform ensures accurate and up-to-date information about courses and degree programs. New Wings streamlines the application process, reducing delays and offering faster processing times. Its exclusive partnerships with universities and colleges provide access to unique programs and scholarships that might not be available elsewhere. Personalized support, including tailored recommendations and document reviews, ensures your application stands out. With a transparent fee structure, a comprehensive database of opportunities, and student-centric tools like application tracking and dashboards, New Wings makes the process user-friendly and efficient. By leveraging its strong institutional connections and guidance services, New Wings enhances your chances of success while also opening doors to global opportunities. Additionally, the platform fosters a supportive community through resources, webinars, and workshops to help you thrive.</p>',NULL,NULL,NULL,NULL,NULL,1),
('Are the services provided by New Wings free of charge? ','The services provided by New Wings may include both free and paid options. Generally, basic services like browsing courses, exploring institutions, and general guidance might be free. However, personalized counseling, document reviews, or exclusive access to certain programs and scholarships may require a fee. For detailed information, its best to check their website or contact their support team.',NULL,NULL,NULL,NULL,NULL,1),
(NULL,NULL,'Gary Charles', 'garycharles@dominatingkeywords.com', '8054002077', 'DominatingKeywords', 'Let me demonstrate to you how you can get guaranteed thousands of clicks to your website without SEO and without Pay Per Click.\r\nYou will start getting keyword targeted traffic in less than 48 hours.\r\nJust send us your keywords and we\'ll tell you how much monthly clicks we can guarantee without paying for each click and waiting for SEO results.\r\nYou will get exclusive ownership of keywords you choose for flat fee (no Pay Per Click)...', 0),
(NULL,NULL,'Gary Charles', 'gary-charles@dominatingkeywords.com', '8054002077', 'DominatingKeywords.com', 'Let me demonstrate to you how you can get guaranteed thousands of clicks to your website without SEO and without Pay Per Click.\r\nYou will start getting keyword targeted traffic in less than 48 hours.\r\nJust send us your keywords and we\'ll tell you how much monthly clicks we can guarantee without paying for each click and waiting for SEO results.\r\nYou will get exclusive ownership of keywords you choose for flat fee (no Pay Per Click)...', 0),
(NULL,NULL,'ebraham', 'sachinitharindi2001@gmail.com', '0998988888', 'Computer science', 'can i know about..', 0);



DROP TABLE IF EXISTS branch_forms;

CREATE TABLE branch_forms (
    id int NOT NULL AUTO_INCREMENT,
    f1 varchar(255)  DEFAULT NULL, 
    f2 varchar(255)  DEFAULT NULL,
    f3 LONGTEXT  DEFAULT NULL, 
    branch INT NOT NULL, 
    created_by int NULL DEFAULT NULL,
    created_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_by int NULL DEFAULT NULL,
    updated_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status int NULL DEFAULT 1,
    PRIMARY KEY (id) USING BTREE,
    CONSTRAINT fk_branch_id FOREIGN KEY (branch) REFERENCES branches(id) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE  
) ;


 
DROP TABLE IF EXISTS categories;

CREATE TABLE categories (
    id int NOT NULL AUTO_INCREMENT,
    f1 varchar(255) DEFAULT NULL, 
    img1 varchar(255) DEFAULT NULL, 
    created_by int NULL DEFAULT NULL,
    created_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_by int NULL DEFAULT NULL,
    updated_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status int NULL DEFAULT 0,
    PRIMARY KEY (id) USING BTREE
) ;

INSERT INTO categories (f1,img1,status) VALUES
('Engineering','./uploads/categories/17465675496521.jpeg',1),
('Arts','./uploads/categories/17465675584213.jpeg',1),
('Accounting and Finance','./uploads/categories/17465675707895.jpeg',1);



DROP TABLE IF EXISTS coaches;

CREATE TABLE coaches (
    id int NOT NULL AUTO_INCREMENT,
    f1 varchar(255) DEFAULT NULL, 
    f2 varchar(255) DEFAULT NULL, 
    f3 varchar(255) DEFAULT NULL,
    f4 varchar(255) DEFAULT NULL, 
    course INT NOT NULL, 
    country INT NOT NULL, 
    created_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_by int NULL DEFAULT NULL,
    updated_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status int NULL DEFAULT 1,
    PRIMARY KEY (id) USING BTREE,
    CONSTRAINT coaches_fk_course FOREIGN KEY (course) REFERENCES courses(id),
    CONSTRAINT coaches_fk_country FOREIGN KEY (country) REFERENCES countries(id) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE  
);


DROP TABLE IF EXISTS document_types;

CREATE TABLE document_types (
    id int NOT NULL AUTO_INCREMENT,
    f1 varchar(255) DEFAULT NULL, 
    created_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_by int NULL DEFAULT NULL,
    updated_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status int NULL DEFAULT 1,
    PRIMARY KEY (id) USING BTREE
);




DROP TABLE IF EXISTS request_documents;

CREATE TABLE request_documents (
    id int NOT NULL AUTO_INCREMENT,
    f1 varchar(255) DEFAULT NULL, 
    f2 longtext DEFAULT NULL, 
    document_type int NOT NULL,
    user int NOT NULL,
    application int NOT NULL,
    created_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
    updated_by int NULL DEFAULT NULL,
    updated_date datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status int NULL DEFAULT 1,
    PRIMARY KEY (id) USING BTREE,
    CONSTRAINT fk_document_type_id FOREIGN KEY (document_type) REFERENCES document_types(id),
    CONSTRAINT fk_user_id FOREIGN KEY (user) REFERENCES users(id),
    CONSTRAINT fk_application_id FOREIGN KEY (application) REFERENCES applications(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);



DROP TABLE IF EXISTS notifications;


CREATE TABLE notifications (
    id INT NOT NULL AUTO_INCREMENT,
    f1 LONGTEXT DEFAULT NULL, 
    f2 LONGTEXT DEFAULT NULL,
    user INT NOT NULL, 
    created_by INT DEFAULT NULL,
    created_date DATETIME(0) DEFAULT CURRENT_TIMESTAMP(0),
    updated_by INT DEFAULT NULL,
    updated_date DATETIME(0) DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
    status INT DEFAULT 1,
    PRIMARY KEY (id) USING BTREE
);


DROP TABLE IF EXISTS policies;

CREATE TABLE policies (
    id int NOT NULL,
    f1 longtext DEFAULT NULL,
    created_by int DEFAULT NULL,
    created_date datetime DEFAULT CURRENT_TIMESTAMP,
    updated_by int DEFAULT NULL,
    updated_date datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status int DEFAULT 0,
    PRIMARY KEY (id) USING BTREE
);

