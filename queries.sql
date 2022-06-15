CREATE TABLE `recipe-keeper`.`users`(
    `id` INT(255) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(55) NOT NULL,
    `email` VARCHAR(55) NOT NULL,
    `password` VARCHAR(55) NOT NULL,
    PRIMARY KEY(`id`),
    UNIQUE `username`(`username`),
    UNIQUE `email`(`email`)
) ENGINE = INNODB;

CREATE TABLE `recipe-keeper`.`recipe`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `recipeName` VARCHAR(55) NOT NULL,
    `recipeDescription` TEXT NOT NULL,
    `recipeIngredients` TEXT NOT NULL,
    `recipeInstructions` TEXT NOT NULL,
    `recipeCategory` VARCHAR NOT NULL,
    `recipeServings` INT NOT NULL,
    `recipePrepTime` INT NOT NULL,
    `recipeCookTime` INT NOT NULL,
    `recipeYield` INT NOT NULL,
    `recipeImage` LONGBLOB NOT NULL,
    `timeStamp` TIMESTAMP NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = INNODB;

ALTER TABLE `recipe` ADD `userNameCreated` VARCHAR(55) NOT NULL AFTER `id`;

ALTER TABLE
    `recipe` ADD `calories` INT NOT NULL AFTER `url`,
    ADD `carbs` INT NOT NULL AFTER `calories`,
    ADD `protein` INT NOT NULL AFTER `carbs`,
    ADD `fat` INT NOT NULL AFTER `protein`,
    ADD `sugar` INT NOT NULL AFTER `fat`,
    ADD `sodium` INT NOT NULL AFTER `sugar`,
    ADD `fiber` INT NOT NULL AFTER `sodium`,
    ADD `saturatedFat` INT NOT NULL AFTER `fiber`,
    ADD `cholesterol` INT NOT NULL AFTER `saturatedFat`;
    
ALTER TABLE `recipe` ADD `url` VARCHAR(10) NOT NULL AFTER `timeStamp`, ADD UNIQUE (`url`);

ALTER TABLE `recipe` ADD `ster` INT(10) NOT NULL AFTER `recipeName`, ADD `averageDifficulty` VARCHAR(55) NOT NULL AFTER `Rating`;


CREATE TABLE `id19101490_recipekeeper`.`recipe`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `recipeName` VARCHAR(55) NOT NULL,
    `recipeDescription` TEXT NOT NULL,
    `recipeIngredients` TEXT NOT NULL,
    `recipeInstructions` TEXT NOT NULL,
    `recipeCategory` VARCHAR NOT NULL,
    `recipeServingsrecipeServings` INT NOT NULL,
    `recipePrepTime` INT NOT NULL,
    `recipeCookTime` INT NOT NULL,
    `recipeYield` INT NOT NULL,
    `recipeImage` LONGBLOB NOT NULL,
    `timeStamp` TIMESTAMP NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = INNODB;