node {

    def commit_id

    stage('Preperation'){
        checkout scm
        sh "git rev-parse --short HEAD > .git/commit-id"
        commit_id = readFile('.git/commit-id').trim()
    }

    stage('test'){
//         def testContainer = docker.image('php:7.4')
//         testContainer.pull()
        def testContainer = docker.build('testcontainer','.')
        testContainer.inside{
            sh 'composer install'
            sh './vendor/bin/phpunit unit_test/CounterTest.php'
        }
    }

//     stage('docker build/push'){
//         docker.withRegistry('https://registry.hub.docker.com', '9e7d590c-1680-4a8a-b2c7-8c6befa97415') {
//
//         def customImage = docker.build("charbelay/jenkins-drop-php:${commit_id}",'.')
//
//         customImage.push()
//         }
//     }

    stage("publish"){
        sshagent(credentials:['86025583-ab83-4220-9b5f-a2ddee2faf9d']){
        sh 'ssh -o StrictHostKeyChecking=no -l ec2-user 172.31.35.104 uname -a && touch samira.txt'
        }
    }

}
