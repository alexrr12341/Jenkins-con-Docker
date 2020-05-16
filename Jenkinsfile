pipeline {
  agent any
  stages {
    stage('Build') {
      steps {
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
            echo "hello world"
         '''
        sh 'docker stop appjenkins'
      }
    }
  }
}
