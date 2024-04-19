<?php

function paymentIsWithSpark(): bool
{
    return config('codex.payment_mode') === 'spark';
}

function paymentIsWithAws(): bool
{
    return config('codex.payment_mode') === 'aws';
}
