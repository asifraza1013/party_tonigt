<?php

const GENDER = ['MALE' => 'm', 'FEMALE' => 'f'];
const POST_TYPE = ['TEXT' => 'text', 'IMAGE' => 'image', 'VIDEO' => 'video', 'AUDIO' => 'audio', 'GIF' => 'gif'];
const POST_ACTIVITY_TYPE = ['COMMENT' => 'comment', 'LIKE' => 'like', 'DISLIKE' => 'dislike', 'FOLLOW' => 'follow'];
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
    'POST_TYPE_TEXT' => POST_TYPE['TEXT'],
    'POST_TYPE_IMAGE' => POST_TYPE['IMAGE'],
    'POST_TYPE_VIDEO' => POST_TYPE['VIDEO'],
    'POST_ACTIVITY_LIKE' => POST_ACTIVITY_TYPE['LIKE'],
    'POST_ACTIVITY_DISLIKE' => POST_ACTIVITY_TYPE['DISLIKE'],
    'POST_ACTIVITY_COMMENT' => POST_ACTIVITY_TYPE['COMMENT'],
    'COMMENT_ACTIVITY_LIKE' => POST_ACTIVITY_TYPE['LIKE'],
    'COMMENT_ACTIVITY_DISLIKE' => POST_ACTIVITY_TYPE['DISLIKE'],
    'enums' => [
    'gender' => [GENDER['MALE'], GENDER['FEMALE']],
    'post_type' => [POST_TYPE['TEXT'], POST_TYPE['IMAGE'], POST_TYPE['VIDEO'], POST_TYPE['AUDIO'], POST_TYPE['GIF']],
    'post_activities' => [POST_ACTIVITY_TYPE['COMMENT'], POST_ACTIVITY_TYPE['LIKE'], POST_ACTIVITY_TYPE['DISLIKE']],
    'comment_activities' => [COMMENT_ACTIVITY_TYPE['LIKE'], COMMENT_ACTIVITY_TYPE['DISLIKE']],
    ],
    'paginate_per_page' => env('PAGINATE_PER_PAGE', 15),

    // helper center status
    'helper_center_status' => [
        'Pendding' => 'Pendding',
        'Proccessing' => 'Proccessing',
        'Entertained' => 'Entertained',
        'Closed' => 'Closed',
    ],

    'post_status' => [
        'Active' => 'Active',
        'Terminated' => 'Terminated',
    ],
    'report_type' => [
        'post' => 'post'
    ],
    'report_status' => [
        'Reported' => 'Reported',
        'Rejected' => 'Rejected',
        'Resolved' => 'Resolved',
    ],
    'report_reasons' => [
        1 => 'Sexual content',
        2 => 'Graphic voilance',
        3 => 'Abusive Content',
        4 => 'Harmful to device or data',
        5 => 'Other Objectives',
    ],
    'post_categories' => [
        1 => 'Music',
        2 => 'Photograph',
        3 => 'Tale',
        4 => 'Poem',
        5 => 'Visual Art',
        6 => 'Animales',
    ],
    'user_profile_type' => [
        'Music' => 'Musician',
        'Photograph' => 'Photographer',
        'Tale' => 'Writer',
        'Poem' => 'Poet',
        'Visual Art' => 'Artist',
        'Animales' => 'Animals Photographer',
    ],
    'post_categories_obj' => [
        (object) [
            'id' => 1,
            'name' => 'Music',
        ],
        (object) [
            'id' => 2,
            'name' => 'Photograph',
        ],
        (object) [
            'id' => 3,
            'name' => 'Tale',
        ],
        (object) [
            'id' => 4,
            'name' => 'Poem',
        ],
        (object) [
            'id' => 5,
            'name' => 'Visual Art',
        ],
        (object) [
            'id' => 6,
            'name' => 'Animales',
        ],
    ],
    'month_list' => [
        '01' => 'Jan',
        '02' => 'Feb',
        '03' => 'March',
        '04' => 'April',
        '05' => 'May',
        '06' => 'Jun',
        '07' => 'July',
        '08' => 'Agust',
        '09' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December',
    ]
];

?>
