<?php

use Illuminate\Support\Str;

return [
    'baseUrl' => '',
    'production' => false,
    'siteName' => 'Monitor & Audit your Active Directory server.',
    'siteDescription' => 'Watchdog monitors all changes that occur to every object in your server.',

    // Algolia DocSearch credentials
    'docsearchApiKey' => '',
    'docsearchIndexName' => '',

    // navigation menu
    'navigation' => require_once('navigation.php'),

    // Thanks to: Caleb Porzio for these methods
    // https://github.com/livewire/docs
    'getNextPage' => function ($page, $navigation = 'navigation') {
        // Before: ['foo' => 'bar', 'baz' => ['children' => ['bob' => 'lob', 'law' => 'blog']]]
        $flattenedArrayOfPagesAndTheirLables = $page->{$navigation}->map(function ($value, $key) {
            $links = is_iterable($value) ? $value['children']->toArray() : [$key => $value];
            return collect($links)->map(function ($path, $label) {
                return ['path' => $path, 'label' => $label];
            });
        })
            ->flatten(1);
        // After: [['label' => 'foo', 'path' => 'bar'], ['label' => 'bob', 'path' => 'lob'], ['label' => 'law', 'path' => 'blog']]
        $pathsByIndex = $flattenedArrayOfPagesAndTheirLables->pluck('path');
        $currentIndex = $pathsByIndex->search(trimPath($page->getPath()));
        $nextIndex = $currentIndex + 1;
        return $flattenedArrayOfPagesAndTheirLables[$nextIndex] ?? null;
    },
    'getPreviousPage' => function ($page, $navigation = 'navigation') {
        // Before: ['foo' => 'bar', 'baz' => ['children' => ['bob' => 'lob', 'law' => 'blog']]]
        $flattenedArrayOfPagesAndTheirLables = $page->{$navigation}->map(function ($value, $key) {
            $links = is_iterable($value) ? $value['children']->toArray() : [$key => $value];
            return collect($links)->map(function ($path, $label) {
                return ['path' => $path, 'label' => $label];
            });
        })
            ->flatten(1);
        // After: [['label' => 'foo', 'path' => 'bar'], ['label' => 'bob', 'path' => 'lob'], ['label' => 'law', 'path' => 'blog']]
        $pathsByIndex = $flattenedArrayOfPagesAndTheirLables->pluck('path');
        $currentIndex = $pathsByIndex->search(trimPath($page->getPath()));
        $previousIndex = $currentIndex - 1;
        return $flattenedArrayOfPagesAndTheirLables[$previousIndex] ?? null;
    },
    'isActive' => function ($page, $path) {
        return Str::endsWith(trimPath($page->getPath()), trimPath($path));
    },
    'isActiveParent' => function ($page, $menuItem) {
        if (is_object($menuItem) && $menuItem->children) {
            return $menuItem->children->contains(function ($child) use ($page) {
                return trimPath($page->getPath()) == trimPath($child);
            });
        }
    },
    'url' => function ($page, $path) {
        return Str::startsWith($path, 'http') ? $path : '/' . trimPath($path);
    },
];
