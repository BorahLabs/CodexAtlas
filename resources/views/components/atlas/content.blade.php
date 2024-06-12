<div class="prose prose-pre:p-0 break-words">
    @if (!str_starts_with(trim($content), '#'))
        <h1>{{ $title }}</h1>
    @endif
    {!! Str::markdown($content) !!}
</div>
