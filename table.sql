--
-- Table structure for table `lastcallers`
--
CREATE TABLE `lastcallers` (
  `ip_id` bigint(20) UNSIGNED NOT NULL,
  `ip_call` text NOT NULL,
  `ip_flag` text NOT NULL,
  `ip_date` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for table `lastcallers`
--
ALTER TABLE `lastcallers`
  ADD UNIQUE KEY `ip_id` (`ip_id`);

--
-- AUTO_INCREMENT for table `lastcallers`
--
ALTER TABLE `lastcallers`
  MODIFY `ip_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- PROCEDURE for table `lastcallers`
--
DELIMITER $$
CREATE PROCEDURE `remove_last_ip`()
BEGIN
    DECLARE ip_count BIGINT;
    DECLARE ip_diff BIGINT;
 
    SET ip_count := (SELECT COUNT(ip_id) FROM lastcallers);
 
    IF (ip_count > 10) THEN
        SET ip_diff = ip_count - 10;
 
        DELETE
        FROM lastcallers
        ORDER BY ip_id ASC
        LIMIT ip_diff;
    END IF;
END$$
DELIMITER ;