<?php

use OhDear\PhpSdk\Requests\BrokenLinks\GetBrokenLinksRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->ohDear = ohDearMock();
});

it('can get broken links', function () {
    MockClient::global([
        GetBrokenLinksRequest::class => MockResponse::fixture('broken-links'),
    ]);

    $brokenLinks = $this->ohDear->brokenLinks(82060);

    foreach ($brokenLinks as $brokenLink) {
        expect($brokenLink->statusCode)->toBeInt();
        expect($brokenLink->crawledUrl)->toBeString();
        expect($brokenLink->relativeCrawledUrl)->toBeString();
        expect($brokenLink->foundOnUrl)->toBeString();
        expect($brokenLink->relativeFoundOnUrl)->toBeString();
        expect($brokenLink->linkText)->toBeString();
        expect($brokenLink->internal)->toBeBool();
    }
});
