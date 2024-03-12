import './bootstrap';
import hljs from 'highlight.js';
import hljsBlade from 'highlightjs-blade';
import 'highlight.js/styles/atom-one-dark.css';
import { tsParticles } from "@tsparticles/engine";
import '@tsparticles/preset-firefly';

hljs.registerLanguage("blade", hljsBlade);
hljs.initHighlightingOnLoad();

window.onTurnstile = function (token) {
    window.dispatchEvent(new CustomEvent('turnstile', {detail: token}));
};

window.addEventListener('load', function () {
    const particleElements = Array.prototype.slice.call(document.querySelectorAll('[data-particles]'));
    particleElements.forEach(function (element) {
        element.id = 'particles-' + Math.random().toString(36).substring(7);
        tsParticles.load({
            id: element.id,
            options: {
                autoPlay: true,
                fullScreen: false,
                preset: element.getAttribute('data-preset'),
            },
            // url: element.getAttribute('data-particles'),

        });

    });
});
