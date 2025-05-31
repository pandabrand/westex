require('dotenv').config()
const FtpDeploy = require('ftp-deploy')
const ftpDeploy = new FtpDeploy()

const config = {
    user: process.env.FTP_USER,
    password: process.env.FTP_PASS,
    host: process.env.FTP_HOST,
    port: process.env.FTP_PORT,
    localRoot: __dirname,
    remoteRoot: process.env.FTP_PATH,
    include: ['*', '**/*'],
    exclude: [
        '.budfiles/**',
        '.vscode/**',
        'node_modules/**',
        'node_modules/**/.*/**',
        'bud.config.mjs',
        '.editorconfig',
        '.env',
        '.git/**',
        '.gitignore',
        'deploy.js',
        'yarn.lock',
        'composer.lock',
        'vendor/squizlabs/**',
        'yarn-error.log',
    ],
    deleteRemote:false,
    forcePasv: true,
    sftp: true,
}

ftpDeploy
    .deploy(config)
    .then((res) => console.log('finished: ', res))
    .catch((err) => console.error(err))

ftpDeploy.on('uploading', (data) => {
    console.log(data.totalFilesCount)
    console.log(data.transferredFileCount)
    console.log(data.filename)
})
