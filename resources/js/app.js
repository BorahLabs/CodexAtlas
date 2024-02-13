import './bootstrap';
import hljs from 'highlight.js';
import hljsBlade from 'highlightjs-blade';
import 'highlight.js/styles/atom-one-dark.css';

hljs.registerLanguage("blade", hljsBlade);
hljs.initHighlightingOnLoad();

window.onTurnstile = function (token) {
    window.dispatchEvent(new CustomEvent('turnstile', {detail: token}));
};
