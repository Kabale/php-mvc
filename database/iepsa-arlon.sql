-- CREATE DATABSE
--DROP DATABASE iepsa_arlon;
CREATE DATABASE iepsa_arlon CHARACTER SET UTF8 COLLATE utf8_bin;

USE iepsa_arlon;

-- CREATE USER AND GRANT ACCESS TO DATABASE
CREATE USER 'iepsa_user'@'localhost' IDENTIFIED BY 'ZHeg5X0Ti12244Fk';
GRANT SELECT, INSERT, DELETE ON iepsa_arlon.* TO 'iepsa_user'@'localhost';
FLUSH PRIVILEGES;


-- CREATE TABLE
CREATE TABLE articles(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    content VARCHAR(2000),
    author VARCHAR(100),
    category VARCHAR(255),
    creationDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updateDate DATETIME ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(100),
    password VARCHAR(100),
    email VARCHAR(150),
    creationDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updateDate DATETIME ON UPDATE CURRENT_TIMESTAMP
);


-- INSERT SOME VALUES
INSERT INTO articles(title, content, author, category) VALUES("Lorem Ipsum", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at dapibus sapien. In hac habitasse platea dictumst. Praesent in mauris urna. Phasellus finibus fermentum vestibulum. Pellentesque tempus vitae justo eu egestas. Sed in consectetur lacus. Mauris condimentum, quam sed sagittis ornare, mi ligula posuere libero, ut facilisis nisl ex in leo. Maecenas tempus tellus vel purus facilisis vehicula. Mauris consectetur diam pulvinar ligula faucibus, ac tempus mauris congue. Donec pellentesque sem nibh, vitae bibendum diam rutrum a. Maecenas nec lorem non nisi tempor gravida. Vestibulum nec enim nibh. Etiam quis imperdiet risus.", "Jules César", "News");
INSERT INTO articles(title, content, author, category) VALUES("Donec a dui aliquam", "Vestibulum rutrum tincidunt dignissim. Suspendisse at tincidunt ex. Morbi non sapien magna. Donec sed quam eu erat fringilla interdum. Nam dui mi, elementum a vestibulum eu, malesuada quis nisl. Fusce egestas neque eget erat varius tincidunt. Donec eu justo at enim eleifend finibus. Nunc a velit faucibus, condimentum lectus pellentesque, finibus nulla. Etiam ultrices semper eros. Proin tempus euismod vestibulum. Etiam mattis ut ligula nec varius. Vivamus auctor dictum ex, eget euismod arcu. Nam interdum lacus id neque auctor convallis. Phasellus tristique dictum posuere. Maecenas cursus fringilla ipsum eget efficitur. Donec fermentum dapibus arcu, non tristique felis tincidunt ut.", "Livia Orestilla", "News");
INSERT INTO articles(title, content, author, category) VALUES("Pellentesque at justo ", "Morbi vel cursus dui, a lobortis lorem. Nam accumsan pharetra lacus in dictum. Pellentesque aliquam nec est eu molestie. Mauris porttitor nisl non dapibus molestie. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus id dignissim velit. Fusce ac sollicitudin mi. Donec varius lorem ultricies risus porta porta. Aliquam eget purus et enim vehicula pellentesque. In sed urna tellus. Pellentesque non ipsum ornare ex sollicitudin consequat. Aenean dapibus felis dignissim, pharetra elit vel, placerat nibh. In hac habitasse platea dictumst. Donec id nibh auctor, maximus arcu at, blandit nulla. Vivamus mattis molestie turpis ut aliquet.", "Jules César", "Article");
INSERT INTO articles(title, content, author, category) VALUES("Cras a leo interdum", "Sed finibus interdum volutpat. Aliquam quis molestie risus, id convallis ex. Ut ultricies nunc non nunc ultricies, eu dictum diam mollis. In hac habitasse platea dictumst. Phasellus consectetur cursus nulla eu placerat. Etiam vestibulum metus eget porta tempus. Curabitur sit amet nibh id ipsum condimentum tempor vel id massa. Proin porta vitae nibh eu pulvinar. Proin venenatis dignissim convallis. Phasellus mollis est eget fringilla egestas.", "Jules César", "News");
INSERT INTO articles(title, content, author, category) VALUES("Aenean in est ut ex rhoncus", "Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam laoreet risus quis metus dapibus, id vestibulum nisi dapibus. Maecenas eu euismod lorem. Suspendisse cursus felis in fringilla lacinia. Aenean mattis risus vestibulum, malesuada dolor in, sagittis nunc. Etiam purus justo, pharetra eget dui non, interdum varius mauris. Nunc eu metus enim. Etiam eleifend tellus vel nisl vestibulum tempor et id enim. Pellentesque varius efficitur mi ac interdum. Integer enim sapien, dapibus vel est eu, tincidunt fringilla orci.", "Tiberius Gemellus", "Synopsis");
INSERT INTO articles(title, content, author, category) VALUES("Maecenas porta odio non tellus finibus tempus", "Aenean dapibus scelerisque neque laoreet viverra. Duis ornare purus eu faucibus luctus. Ut posuere elementum enim, ut dictum massa iaculis nec. Curabitur at ex nec arcu porttitor convallis nec ut erat. Proin bibendum finibus lacus, nec placerat diam interdum vel. Morbi vitae ultricies lectus. Curabitur sollicitudin tellus nec lectus sollicitudin ullamcorper. Sed nunc tellus, hendrerit tristique mauris at, posuere vestibulum dolor. Phasellus eu viverra mi. Duis vitae elit at odio vestibulum ullamcorper nec eu ligula.", "Jules César", "News");
INSERT INTO articles(title, content, author, category) VALUES("Cras et odio in eros lobortis", "Pellentesque ultricies sodales tellus sit amet fringilla. Mauris odio tortor, iaculis eget volutpat eget, vehicula sed arcu. Nam pharetra accumsan ante, molestie dapibus erat vestibulum et. Aliquam eu urna tempus, pharetra neque vel, eleifend nulla. Curabitur lobortis tincidunt luctus. Suspendisse ac lorem mollis neque rhoncus porta euismod eu urna. Duis auctor, sapien id euismod aliquam, arcu lectus finibus elit, a interdum felis erat et tortor. Nunc tempor arcu vel ipsum luctus efficitur. Curabitur accumsan pretium nunc.", "Jules César", "Article");
INSERT INTO articles(title, content, author, category) VALUES("Nam a eros at tellus dapibus sagittis", "Sed fermentum porttitor auctor. Nunc ac viverra magna, eget fermentum massa. Sed vitae metus ac nisl blandit ultrices. Proin sodales sit amet velit nec efficitur. Nam feugiat pulvinar justo, vel suscipit eros vulputate euismod. Sed iaculis tortor vitae iaculis commodo. Nam ac euismod urna. Integer volutpat lorem at libero dictum, sit amet luctus nisi commodo. Nam elit massa, viverra quis euismod consequat, bibendum a leo. Phasellus hendrerit lectus eu quam finibus, a fringilla enim finibus. Quisque condimentum lorem vitae sapien molestie, eu gravida dolor placerat. Proin non iaculis leo. Etiam augue ligula, hendrerit id ullamcorper sed, luctus quis tortor.", "Tiberius Gemellus", "News");
INSERT INTO articles(title, content, author, category) VALUES("Etiam luctus ipsum nec nulla bibendumm", "Sed imperdiet metus at justo varius, et lobortis nunc pulvinar. Integer sit amet purus eu dui auctor efficitur. Sed rhoncus ultricies posuere. Fusce blandit ut eros et ultricies. Cras non nisi non lectus finibus ultrices id nec dolor. Morbi eu purus nec dui volutpat congue eu sit amet est. Praesent hendrerit dignissim finibus. Pellentesque neque tortor, cursus vitae vehicula eu, volutpat vitae ipsum. Donec bibendum ipsum in orci commodo, nec tincidunt nisl eleifend. Cras sed sem justo. Morbi vulputate dui sed arcu semper elementum. Morbi eu dignissim lorem.", "Jules César", "News");
INSERT INTO articles(title, content, author, category) VALUES("Phasellus id est iaculis", "Proin eleifend dui id posuere rutrum. Praesent eget laoreet risus, sed lobortis nunc. Integer finibus ipsum at pharetra bibendum. Suspendisse at orci vulputate, auctor massa a, hendrerit mi. Aliquam id condimentum massa. Vivamus tempus cursus urna, ultrices vestibulum eros. Maecenas vel justo egestas lacus dignissim lacinia eget non nunc. Nullam viverra nunc vel blandit pharetra. Morbi mattis euismod dignissim. Curabitur eleifend elementum ipsum, in ultrices ipsum congue id. Praesent sodales, justo eget molestie imperdiet, lacus felis scelerisque ligula, in dapibus nisl lectus efficitur purus. Vestibulum tempor tortor est, sit amet congue dui suscipit nec. Praesent sed mollis justo. Praesent sit amet vestibulum felis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec lacinia magna mi, et vestibulum purus vestibulum in.", "Jules César", "Synopsis");

INSERT INTO users(login, password, email) VALUES("Kabale",SHA2("Test1234", 512),"kabale@gmail.com");

UPDATE articles SET author = "Néron" WHERE id = 9
