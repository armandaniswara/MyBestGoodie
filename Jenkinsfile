pipeline {
    agent any
    stages {
        stage('Build') {
            steps {
                echo 'Sedang build aplikasi...'
                bat 'echo Build selesai'
            }
        }
        stage('Test') {
            steps {
                echo 'Sedang menjalankan test...'
                bat 'echo Semua test lolos'
            }
        }
        stage('Deploy') {
            steps {
                echo 'Sedang deploy ke server...'
                bat 'echo Deploy selesai'
            }
        }
    }
}
