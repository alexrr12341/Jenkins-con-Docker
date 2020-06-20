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
	sh 'docker stop wordjenkins'
        sh 'docker run --rm --name appjenkins --network jenkins -d -p 80:80 pagina:test'
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
      }
    }

    stage('Push') {
      steps {
	withCredentials([usernamePassword(credentialsId: 'github-credentials', passwordVariable: 'GITHUB_PASS', usernameVariable: 'GITHUB_USER')]) {
		sh 'rm -r Jenkins-con-Docker'
		sh 'git clone --branch produccion https://github.com/alexrr12341/Jenkins-con-Docker.git'
		sh 'rm -r Jenkins-con-Docker/wordpress && cp -r wordpress /opt && cp -r Dockerfile wordpress Jenkins-con-Docker && cd Jenkins-con-Docker && git add * && git commit -m "Jenkins Automatico" && git push https://${GITHUB_USER}:${GITHUB_PASS}@github.com/alexrr12341/Jenkins-con-Docker.git'
	}
        withDockerRegistry([ credentialsId: "dockerhub", url: "" ]) {
		sh 'docker tag pagina:test alexrr12341/pagina:stable'
		sh 'docker push alexrr12341/pagina:stable'
	}
      }
    }

    stage('Deploy') {
      steps {
	sh 'docker stop appjenkins'
	sh 'docker pull alexrr12341/pagina:stable'
	sh 'rm -r /opt/wordpress'
	sh 'docker run --rm --name wordjenkins --network jenkins -d -v /opt/wordpress:/var/www/html -p 80:80 alexrr12341/pagina:stable'
	sh 'docker stop mariadb && docker rm mariadb'
	sh 'cp bbdd_mariadb/wordpress/wp_options* /opt/bbdd_mariadb/wordpress'
	sh 'docker run -d --name mariadb --network jenkins -v /opt/bbdd_mariadb:/var/lib/mysql -e MYSQL_DATABASE=wordpress -e MYSQL_USER=wordpress -e MYSQL_PASSWORD=wordpress -e MYSQL_ROOT_PASSWORD=asdasd mariadb'
	sh './script.sh'
      }
    }
  }
}
