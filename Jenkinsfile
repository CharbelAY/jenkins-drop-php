node {
    checkout scm

    docker.withRegistry('https://registry.hub.docker.com', '9e7d590c-1680-4a8a-b2c7-8c6befa97415') {

        def customImage = docker.build("charbelay/jenkins-drop-php")

        customImage.push()
    }
}

pipeline {
    agent { docker { image 'basicphp' } }
    stages {
        stage('build') {
            steps {
                sh 'php --version'
            }
        }
    }
}