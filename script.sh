#!/bin/bash
sleep 5
docker exec mariadb mysql -h mariadb -u wordpress -pwordpress wordpress -e "UPDATE wp_options SET option_value='http://jenkins' Where option_name='siteurl'"
docker exec mariadb mysql -h mariadb -u wordpress -pwordpress wordpress -e "UPDATE wp_options SET option_value='http://jenkins' Where option_name='home'"

