<?php

const GENDER = ['MALE' => 'm', 'FEMALE' => 'f'];
// const POST_TYPE = ['TEXT' => 'text', 'IMAGE' => 'image', 'VIDEO' => 'video', 'AUDIO' => 'audio', 'GIF' => 'gif'];
// const POST_ACTIVITY_TYPE = ['COMMENT' => 'comment', 'LIKE' => 'like', 'DISLIKE' => 'dislike', 'FOLLOW' => 'follow'];
const COMMENT_ACTIVITY_TYPE = ['LIKE' => 'like', 'DISLIKE' => 'dislike'];

return [
    'appRole' => [
        1 => 'Customer',
    ],
    'status' => [
        1 => 'Active',
        2 => 'Terminated',
        3 => 'Unverified',
    ],
    'currency' => 'USD',

    // counts and db related constants.
    'MALE' => GENDER['MALE'],
    'FEMALE' => GENDER['FEMALE'],
];
