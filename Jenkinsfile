node {

    def commit_id

    stage('Preperation'){
        checkout scm
        sh "git rev-parse --short HEAD > .git/commit-id"
        commit_id = readFile('.git/commit-id').trim()
    }

    stage('test'){
        def testContainer = docker.build('testcontainer','.')
        testContainer.inside{
            sh 'composer install'
            sh './vendor/bin/phpunit unit_test/CounterTest.php'
        }
    }

    stage('docker build/push'){
        docker.withRegistry('https://registry.hub.docker.com', '9e7d590c-1680-4a8a-b2c7-8c6befa97415') {

//         def customImage = docker.build("charbelay/jenkins-drop-php:${commit_id}",'.')

        def customImage = docker.build("charbelay/jenkins-drop-php:latest",'.')


        customImage.push()
        }
    }

    stage("publish"){
        sshagent(credentials:['86025583-ab83-4220-9b5f-a2ddee2faf9d']){
        sh 'ssh -o StrictHostKeyChecking=no -l ec2-user 13.48.42.8 uname -a'
        sh 'ssh -o StrictHostKeyChecking=no ec2-user@ec2-13-48-42-8.eu-north-1.compute.amazonaws.com "bash test.sh && sudo docker pull charbelay/jenkins-drop-php:latest && sudo docker run -d -p 8081:8080 --name testing_version charbelay/jenkins-drop-php:latest"'
        }
    }
}
