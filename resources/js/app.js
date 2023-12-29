import './bootstrap';
import hljs from 'highlight.js';
import hljsBlade from 'highlightjs-blade';
import 'highlight.js/styles/atom-one-dark.css';
import docsearch from '@docsearch/js';

import '@docsearch/css';

hljs.registerLanguage("blade", hljsBlade);
hljs.initHighlightingOnLoad();

if(docSearchData){
    docsearch({
        container: docSearchData['container'] ?? '#docsearch',
        appId: docSearchData['appId'] ?? '',
        indexName: docSearchData['indexName'] ?? '',
        apiKey: docSearchData['apiKey'] ?? '',
    });
    window.docsearch = docsearch
}
