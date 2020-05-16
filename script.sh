#!/bin/bash
            CPU=`top -bn1 | grep "Cpu(s)" | sed "s/.*, *\([0-9.]*\)%* id.*/\1/" | awk '{print 100 - $1""}'`
	    max='90'
	    if [[ $(echo "if (${CPU} > ${max}) 1 else 0" | bc) -eq 1 ]];
	    then
		echo "Sobrepasa el uso de CPU!"
		exit 1
	    else
                echo "CPU correcta."
	    fi
