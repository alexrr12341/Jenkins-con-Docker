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
            CPU=`top -bn1 | grep "Cpu(s)" | sed "s/.*, *\([0-9.]*\)%* id.*/\1/" | awk '{print 100 - $1""}'`
            max='90'
            if [[ $(echo "if (${CPU} > ${max}) 1 else 0" | bc) -eq 1 ]];
            then
                echo "Sobrepasa el uso de CPU!"
                exit 1
            else
                echo "CPU correcta."
            fi
        '''
        sh 'docker stop appjenkins'
      }
    }
  }
}
