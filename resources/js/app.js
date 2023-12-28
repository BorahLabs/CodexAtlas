import './bootstrap';
import hljs from 'highlight.js';
import hljsBlade from 'highlightjs-blade';
import 'highlight.js/styles/atom-one-dark.css';
import docsearch from '@docsearch/js';

import '@docsearch/css';

hljs.registerLanguage("blade", hljsBlade);
hljs.initHighlightingOnLoad();

docsearch({
    container: '#docsearch',
    appId: 'QS32BJJNGP',
    indexName: 'system_component_index',
    apiKey: 'd9a24e62aecabeb04a967d92910ba3ba',
});
