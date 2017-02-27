![php last caller](https://cloud.githubusercontent.com/assets/8536299/23369612/42bece38-fd12-11e6-85ad-d905ee1929ee.png)

### LastCallers
Module to display last 10 visitors country, IP is took, then geoloc with maxmind, and cut before insertion. It use one SQL procedure because you can't with a trigger due to deadlock. The procedure 'ecraze' old values to keep just the last 10 records in DB. The procedure must be called before insertion, simply ```  CALL remove_last_ip(); ```
