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
                url: 'https://demo.codedocumentation.app/docs/9af3f8fe-dc27-4fb6-8c8f-3416ee4b8e23/9af3fd29-d3bd-4fa9-9df2-cb52b1f8f5eb/9af3fd2e-60e2-4aba-84c1-c10871908666/readme',
                imageUrl: 'images/animatecss.png',
            ),
            DemoPlatform::make(
                name: 'Laravel',
                description: 'Laravel is a web application framework with expressive, elegant syntax.',
                url: 'https://demo.codedocumentation.app/docs/9af3f8fe-dc27-4fb6-8c8f-3416ee4b8e23/9af3fd2f-166e-42e3-b6c2-2ba91bd9d868/9af3fd33-a804-4d6b-92bd-3469830e3f6f/readme',
                imageUrl: 'images/laravel.png',
            ),
            DemoPlatform::make(
                name: 'LangChain',
                description: 'LangChain is a framework for developing applications powered by language models.',
                url: 'https://demo.codedocumentation.app/docs/9af3f8fe-dc27-4fb6-8c8f-3416ee4b8e23/9af3fd34-093f-4504-9d78-1e919814e9b8/9af3fd39-2cc9-4ed7-ac20-032e61474c05/readme',
                imageUrl: 'images/langchain.png',
            ),
            DemoPlatform::make(
                name: 'SwiftyJSON',
                description: 'SwiftyJSON makes it easy to deal with JSON data in Swift.',
                url: 'https://demo.codedocumentation.app/docs/9af3f8fe-dc27-4fb6-8c8f-3416ee4b8e23/9af3fd39-a0f6-4b71-8f71-7141cd72a2a8/9af3fd3d-f287-4878-b907-626e410e039a/readme',
                imageUrl: 'images/swiftyjson.png',
            ),
            DemoPlatform::make(
                name: 'LeakCanary',
                description: 'A memory leak detection library for Android.',
                url: 'https://demo.codedocumentation.app/docs/9af3f8fe-dc27-4fb6-8c8f-3416ee4b8e23/9af3fd3e-716b-4b7f-b498-a904fc6617b2/9af3fd42-baec-4862-9de6-fe7afe2c83b7/readme',
                imageUrl: 'images/leakcanary.png',
            ),
            DemoPlatform::make(
                name: 'FilamentPHP Demo',
                description: 'A collection of beautiful full-stack components to accelerate Laravel development.',
                url: 'https://demo.codedocumentation.app/docs/9af3f8fe-dc27-4fb6-8c8f-3416ee4b8e23/9af3fd43-2561-4751-af2c-3873ff5a21e8/9af3fd47-64c1-4bc0-be4f-61b50688e020/readme',
                imageUrl: 'images/filament.png',
            ),
            DemoPlatform::make(
                name: 'Focalboard',
                description: 'Open source project management for technical teams.',
                url: 'https://demo.codedocumentation.app/docs/9af3f8fe-dc27-4fb6-8c8f-3416ee4b8e23/9af3fd47-db68-4bf9-8c4b-aa80085e18a8/9af3fd4c-6c84-4f6a-b2cb-41444a7e244d/readme',
                imageUrl: 'images/focalboard.png',
            ),
            DemoPlatform::make(
                name: 'SiYuan',
                description: 'SiYuan is a privacy-first personal knowledge management system, support fine-grained block-level reference and Markdown WYSIWYG.',
                url: 'https://demo.codedocumentation.app/docs/9af3f8fe-dc27-4fb6-8c8f-3416ee4b8e23/9af3fd4c-d593-4fed-bed2-fbdf75983d8c/9af3fd51-32b8-40b9-97e3-ee2df2923fe2/readme',
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
