<?php

return [

    'list' => [
        'header_title' => 'LIST PARTNERS',
    ],

    'statuses' => [
        'D' => 'Disable',
        'A' => 'Active'
    ],

    'add' => [
        'header_title' => 'ADD PARTNER',
        'header_btn_back' => 'Back',
        'header_btn_save' => 'Save',
        'header_tooltip' => 'Enter partner info and save',
        'btn_save_continue' => 'Save & continue',
        'btn_save_new' => 'Save & add new',
        'btn_save_exit' => 'Save & exit',

        'form' => [
            'header_general_info' => 'General Info',
            'header_contact_info' => 'Contact Info',
            'name' => 'Username',
            'nick_name' => 'Nickname',
            'com_name' => 'Company name',
            'email' => 'Email',
            'address' => 'Address',
            'phone' => 'Number phone',
            'com_site' => 'Website',
            'avatar' => 'Avatar',
            'avatar_change' => 'Change avatar',
            'avatar_cancel' => 'Cancel avatar',
            'allow_image_extension' => 'Allowed file types: png, jpg, jpeg.',
            'description' => 'Description',
            'status' => 'Status',
            'statuses' => [
                'D' => 'Disable',
                'A' => 'Active'
            ],

            'errors' => [
                'header' => 'Please input infos as require',
                'name' => 'Please input name',
                'email' => 'Please input email',
                'email_format' => 'Incorrect email format',
                'email_exists' => 'Email already exists',
                'com_name' => 'Please input company name',
                'address' => 'Please input address',
                'avatar' => 'Incorrect image mimetype'
            ],
            'success' => [
                'add' => 'Create new partner successfully!',
                'edit' => 'Update partner successfully!'
            ]
        ]
    ],

    'edit' => [
        'header_title' => 'UPDATE PARTNER',
        'header_overview' => 'Overview',
        'header_personal' => 'Personal Information',
        'sub_personal' => 'Update your personal informaiton',
        'header_btn_save' => 'Save Changes'
    ]
];
