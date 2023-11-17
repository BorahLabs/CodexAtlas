const fs = require('fs')
const path = require('path')
const { validateWrapper } = require('openai-tokens')
const { spawnSync } = require('child_process')

// Input folder path
const repositories = [
    'https://github.com/filamentphp/demo',
    'https://github.com/benjamincrozat/benjamincrozat.com',
    'https://github.com/RuliLG/Talkzy',
    'https://github.com/RuliLG/Metary-Dump-Indexing',
    'https://github.com/Metary/Metary_Front-End',
    'https://github.com/RuliLG/sabor-en-la-oficina-landing',
    'https://github.com/Healthness-Group/iqcure-front-app',
    'https://github.com/RuliLG/CodexAtlas',
    'https://github.com/devdetorres/app-detorres',
    'https://github.com/RuliLG/Viidio-TestWeb',
    'https://github.com/RuliLG/DataCleaner',
    'https://github.com/RuliLG/Metary-Embeddings-Api',
    'https://github.com/RuliLG/Litic',
    'https://github.com/azac/cobol-on-wheelchair',
    'https://github.com/IBM/cobol-is-fun',
    'https://github.com/EstesE/COBOL',
    'https://github.com/RuliLG/GCP-Backend-Nuevo',
    'https://github.com/nalexn/clean-architecture-swiftui',
    'https://github.com/kasketis/netfox',
    'https://github.com/onevcat/Kingfisher',
    'https://github.com/alibaba/HandyJSON',
    'https://github.com/square/cycler',
    'https://github.com/andremion/Theatre',
    'https://github.com/geniusforapp/fancyDialog',
    'https://github.com/wuyouzhuguli/SpringAll',
    'https://github.com/sqshq/piggymetrics',
    'https://github.com/vimeo/graph-explorer',
    'https://github.com/BoostIO/boostnote-mobile',
    'https://github.com/kiok46/duckduckgo',
];

// Whitelist of file extensions
const whitelist = {
    '.php': true,
    '.js': true,
    '.ts': true,
    '.tsx': true,
    '.scss': true,
    '.css': true,
    '.json': true,
    '.swift': true,
    '.java': true,
    '.cs': true,
    '.cbl': true,
    '.py': true,
    '.vue': true,
};

const totalTokens = {}

// Callback function to execute for each file
function processFile(repository, fileContent) {
    if (!totalTokens[repository]) {
        totalTokens[repository] = {
            tokens: 0,
        }
    }

    const models = [
        'gpt-3.5-turbo-16k',
        'gpt-4-32k',
    ]

    let addedTokens = false
    for (const model of models) {
        if (!totalTokens[repository][`cost-${model}`]) {
            totalTokens[repository][`cost-${model}`] = 0
        }
        const promptInfo = validateWrapper({
            model,
            messages: [{ role: 'user', content: fileContent }]
        })

        if (!addedTokens) {
            totalTokens[repository].tokens += promptInfo.tokenTotal
            addedTokens = true
        }

        totalTokens[repository][`cost-${model}`] += promptInfo.cost
    }
}

const filePathIsValid = (filePath) => {
    const disallowed = ['vendor', 'node_modules', '.next', 'public/', '.git', 'storage/', '.angular', 'Pods', '/obj/', '/bin/']
    for (const subpath of disallowed) {
        if (filePath.includes(subpath)) {
            return false
        }
    }

    return true
}

// Function to iterate through files in the folder
async function iterateFilesInFolder(folderPath, repository) {
    const files = fs.readdirSync(folderPath)

    for (const file of files) {
        const filePath = path.join(folderPath, file);
        if (!filePathIsValid(filePath)) {
            continue
        }

        const stats = fs.statSync(filePath)

        if (stats.isFile()) {
            // Check if the file extension is in the whitelist
            const fileExt = path.extname(filePath);
            if (whitelist[fileExt]) {
                const data = fs.readFileSync(filePath, 'utf8')
                processFile(repository, data);
            }
        } else if (stats.isDirectory()) {
            iterateFilesInFolder(filePath, repository);
        }
    }
}

const getLocalRepositoryPath = (repository) => {
    const baseFolder = '/Users/raullg/GitHub';
    const folderName = path.basename(repository)
    const repositoriesPath = path.join(__dirname, 'repositories')
    const absoluteFolder = path.join(baseFolder, folderName)
    if (fs.existsSync(absoluteFolder)) {
        return absoluteFolder
    } else {
        const absoluteGitFolder = path.join(repositoriesPath, folderName)
        console.log(`-> Cloning repository: ${repository} into ${absoluteGitFolder}...`);
        const cloneProcess = spawnSync('git', ['clone', repository, absoluteGitFolder]);

        if (cloneProcess.status === 0) {
            return absoluteGitFolder;
        } else {
            console.error(`Failed to clone repository: ${cloneProcess.stderr.toString()}`);
            return null;
        }
    }
}

if (fs.existsSync('repositories')) {
    fs.rmSync('repositories', { recursive: true, force: true})
}

if (!fs.existsSync('repositories')) {
    fs.mkdirSync('repositories')
}
for (const repository of repositories) {
    const path = getLocalRepositoryPath(repository)
    if (!path) {
        continue;
    }

    console.log(`Analyzing ${repository}...`)
    iterateFilesInFolder(path, repository)
}

fs.rmSync('repositories', { recursive: true, force: true})

console.table(totalTokens)

console.log('Total input tokens: ', Object.values(totalTokens).map(item => item.tokens).reduce((a, acc) => a + acc, 0))
console.log('Total input cost (GPT-3.5): ', Object.values(totalTokens).map(item => item['cost-gpt-3.5-turbo-16k']).reduce((a, acc) => a + acc, 0).toFixed(2) + '€')
console.log('Total input cost (GPT-4): ', Object.values(totalTokens).map(item => item['cost-gpt-4-32k']).reduce((a, acc) => a + acc, 0).toFixed(2) + '€')
