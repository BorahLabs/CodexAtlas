<?php

namespace App\LLM\PromptRequests;

enum PromptRequestType: string
{
    case DOCUMENT_FILE = 'document_file';
    case TECH_STACK = 'tech_stack';
}
