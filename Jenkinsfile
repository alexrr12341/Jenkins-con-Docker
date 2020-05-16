pipeline {
  agent any
  stages {
    stage('Build') {
      steps {
	sh 'rm -r Jenkins-con-Docker'
	sh 'git clone --branch desarrollo https://github.com/alexrr12341/Jenkins-con-Docker'
        sh 'docker build -t pagina:test .'
      }
    }
    stage('Test') {
      steps {
        echo 'Testing...'
        sh 'docker run --rm --name appjenkins -d -p 80:80 pagina:test'
        sh '/bin/nc -vz localhost 80'
	sh '''
            #!/bin/bash
            CPU=`grep 'cpu ' /proc/stat | awk '{usage=($2+$4)*100/($2+$4+$5)} END {print usage ""}'`
	    if [ $CPU -gt 90 ];
	    then
		echo "Sobrepasa el uso de CPU!" > logfile.log
		exit 125
	    fi
         '''
        sh 'docker stop appjenkins'
      }
    }
  }
}
