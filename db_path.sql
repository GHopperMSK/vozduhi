CREATE TABLE oc_manufacturer_description (
    `manufacturer_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `language_id` INT NOT NULL,
    `description` TEXT,
    FOREIGN KEY (language_id)
        REFERENCES oc_language(id)
        ON DELETE CASCADE
)
ENGINE=MyISAM
CHARACTER SET utf8 COLLATE utf8_general_ci;