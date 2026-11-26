
--Installationsfil för SQL


--Skapar tabellen för bucketlisten
CREATE TABLE bucketlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    priority TINYINT NOT NULL,
    completed BOOLEAN NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

