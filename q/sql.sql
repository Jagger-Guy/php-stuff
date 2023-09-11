CREATE TABLE user (
    id int(11) PRIMARY KEY auto_increment,
    name varchar(255),
    email varchar(255),
    password_hash varchar(255),
    profile_status int(11),
    profile_ext varchar(255),
    video_num int(11),
    profile_desc varchar(255),
    profile_followers int(11)
);

CREATE TABLE post (
    id int(11) PRIMARY KEY auto_increment,
    uid int(11),
    posts varchar(500),
    date varchar(255)
);

CREATE TABLE video (
    user_id int(11),
    video_id int(11),
    video_title varchar(255),
    video_desc varchar(255),
    video_path varchar(255)
);