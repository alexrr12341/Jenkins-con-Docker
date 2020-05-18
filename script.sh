#!/bin/bash
docker exec mariadb mysql -u wordpress -pwordpress wordpress -e "UPDATE wp_options SET option_value='http://jenkins' Where option_name='siteurl'"
docker exec mariadb mysql -u wordpress -pwordpress wordpress -e "UPDATE wp_options SET option_value='http://jenkins' Where option_name='home'"

