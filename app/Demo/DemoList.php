<?php

namespace App\Demo;

class DemoList
{
    private static ?DemoList $instance = null;

    public readonly array $demos;

    public function __construct()
    {
        $this->demos = [
            DemoPlatform::make(
                name: 'animate.css',
                description: 'Animate.css is a library of ready-to-use, cross-browser animations for use in your web projects. Great for emphasis, home pages, sliders, and attention-guiding hints.',
                url: 'https://demo-animatecss.codexatlas.app/',
                imageUrl: 'images/animatecss.png',
            ),
            DemoPlatform::make(
                name: 'Laravel',
                description: 'Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things.',
                url: 'https://demo-laravel.codexatlas.app/',
                imageUrl: 'images/laravel.png',
            ),
            DemoPlatform::make(
                name: 'LangChain',
                description: 'LangChain is a framework for developing applications powered by language models.',
                url: 'https://demo-langchain.codexatlas.app/',
                imageUrl: 'images/langchain.png',
            ),
            DemoPlatform::make(
                name: 'SwiftyJSON',
                description: 'SwiftyJSON makes it easy to deal with JSON data in Swift.',
                url: 'https://demo-swiftyjson.codexatlas.app/',
                imageUrl: 'images/swiftyjson.png',
            ),
            DemoPlatform::make(
                name: 'LeakCanary',
                description: 'A memory leak detection library for Android.',
                url: 'https://demo-leakcanary.codexatlas.app/',
                imageUrl: 'images/leakcanary.png',
            ),
            DemoPlatform::make(
                name: 'FilamentPHP Demo',
                description: 'A collection of beautiful full-stack components to accelerate Laravel development. The perfect starting point for your next app.',
                url: 'https://demo-filamentphp.codexatlas.app/',
                imageUrl: 'images/filament.png',
            ),
            DemoPlatform::make(
                name: 'Focalboard',
                description: 'Open source project management for technical teams. Open source alternative to Trello, Asana, and Notion.',
                url: 'https://demo-focalboard.codexatlas.app/',
                imageUrl: 'images/focalboard.png',
            ),
            DemoPlatform::make(
                name: 'SiYuan',
                description: 'SiYuan is a privacy-first personal knowledge management system, support fine-grained block-level reference and Markdown WYSIWYG.',
                url: 'https://demo-siyuan.codexatlas.app/',
                imageUrl: 'images/siyuan.png',
            ),
        ];
    }

    public static function get(): DemoList
    {
        if (self::$instance === null) {
            self::$instance = new DemoList();
        }

        return self::$instance;
    }

    public function demo(int $index): DemoPlatform
    {
        return $this->demos[$index];
    }
}
