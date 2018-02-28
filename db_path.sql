DROP TABLE IF EXISTS oc_manufacturer_description;

CREATE TABLE oc_manufacturer_description (
    `manufacturer_id` INT NOT NULL,
    `language_id` INT NOT NULL,
    `description` TEXT,
    FOREIGN KEY (manufacturer_id)
        REFERENCES oc_manufacturer(id)
        ON DELETE CASCADE,
    FOREIGN KEY (language_id)
        REFERENCES oc_language(id)
        ON DELETE CASCADE
)
ENGINE=MyISAM
CHARACTER SET utf8 COLLATE utf8_general_ci;