Geneaology
==========

Example demonstrates the use &amp; normalization of genealogical data.

Tables
==========

<pre>
CREATE TABLE IF NOT EXISTS `person` (
  `person_id` int(11) NOT NULL AUTO_INCREMENT,
  `father_id` int(11) DEFAULT NULL,
  `mother_id` int(11) DEFAULT NULL,
  `person_name` varchar(50) DEFAULT NULL,
  `gender` varchar(7) NOT NULL,
  PRIMARY KEY (`person_id`),
  KEY `father_id` (`father_id`,`mother_id`),
  KEY `mother_id` (`mother_id`),
  KEY `father_id_2` (`father_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;


CREATE TABLE IF NOT EXISTS `marriage` (
  `marriage_id` int(11) NOT NULL AUTO_INCREMENT,
  `male_id` int(11) DEFAULT NULL,
  `female_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`marriage_id`),
  KEY `male_id` (`male_id`,`female_id`),
  KEY `male_id_2` (`male_id`),
  KEY `female_id` (`female_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;
</pre>
