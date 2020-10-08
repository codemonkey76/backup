<?php

function frequencies() {
    return [
        'everyMinute',
        'everyTwoMinutes',
        'everyThreeMinutes',
        'everyFourMinutes',
        'everyFiveMinutes',
        'everyTenMinutes',
        'everyFifteenMinutes',
        'everyThirtyMinutes',
        'hourly',
        'everyTwoHours',
        'everyThreeHours',
        'everyFourHours',
        'everySixHours',
        'daily',
        'weekly',
        'monthly',
        'quarterly',
        'yearly'
    ];
}

function limits() {
    return ['weekdays',
        'weekends',
        'sundays',
        'mondays',
        'tuesdays',
        'wednesdays',
        'thursdays',
        'fridays',
        'saturdays',
        ];
}

function parseCamelCase($camelCaseString){
    $words_splited = preg_split('/(?=[A-Z])/',$camelCaseString);
    $words_capitalized = array_map("ucfirst", $words_splited);
    return implode(" ", $words_capitalized);
}
