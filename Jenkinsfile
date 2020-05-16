pipeline {
  agent any
  stages {
    stage('Build') {
      steps {
        sh 'docker build -t pagina:test .'
      }
    }

    stage('Test') {
      steps {
        echo 'Testing...'
        sh 'docker run --rm --name appjenkins -d -p 80:80 pagina:test'
        sh '/bin/nc -vz localhost 80'
	sh label: '', script: '''#!/bin/bash
            CPU=`top -bn1 | grep "Cpu(s)" | sed "s/.*, *\\([0-9.]*\\)%* id.*/\\1/" | awk \'{print 100 - $1""}\'`
            max=\'90\'
            if [[ $(echo "if (${CPU} > ${max}) 1 else 0" | bc) -eq 1 ]];
            then
                echo "Sobrepasa el uso de CPU!"
                exit 1
            else
                echo "CPU correcta."
	fi'''
	sh label: '', script: '''#!/bin/bash
	RamA=`free -m | grep \'Mem\' | awk {\'print $2\'}`
	RamU=`free -m | grep \'Mem\' | awk {\'print $3\'}`
	RamF=`echo "scale=1; $RamU / $RamA" | bc`
	RamPorcentaje=`echo "scale=1; $RamF * 100" | bc`
	max=\'90\'
	if [[ $(echo "if (${RamPorcentaje} > ${max}) 1 else 0" | bc) -eq 1 ]];
        then
                echo "Sobrepasa el uso de RAM! Esta usando el $RamPorcentaje por ciento"
                exit 1
        else
                echo "RAM correcta."
	fi'''
	sh 'ab -t 10 -c 200 http://localhost/index.php | grep Requests'
        sh 'docker stop appjenkins'
      }
    }

    stage('Deploy') {
      steps {
	withCredentials([usernamePassword(credentialsId: 'github', passwordVariable: 'pass', usernameVariable: 'user')]) {
		sh 'rm -r Jenkins-con-Docker'
		sh 'git clone --branch desarrollo https://github.com/alexrr12341/Jenkins-con-Docker.git'
		sh 'cd Jenkins-con-Docker && git checkout produccion && git merge desarrollo && git push -u origin produccion'
	}	
      }
    }
  }
}
