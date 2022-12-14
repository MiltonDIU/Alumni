<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
//    'user' => [
//        'title'          => 'Users',
//        'title_singular' => 'User',
//        'fields'         => [
//            'id'                        => 'ID',
//            'id_helper'                 => ' ',
//            'name'                      => 'Name',
//            'name_helper'               => ' ',
//            'email'                     => 'Email',
//            'email_helper'              => ' ',
//            'mobile'                     => 'Mobile',
//            'mobile_helper'              => ' ',
//            'email_verified_at'         => 'Email verified at',
//            'email_verified_at_helper'  => ' ',
//            'password'                  => 'Password',
//            'password_helper'           => ' ',
//            'roles'                     => 'Roles',
//            'roles_helper'              => ' ',
//            'remember_token'            => 'Remember Token',
//            'remember_token_helper'     => ' ',
//            'created_at'                => 'Created at',
//            'created_at_helper'         => ' ',
//            'updated_at'                => 'Updated at',
//            'updated_at_helper'         => ' ',
//            'deleted_at'                => 'Deleted at',
//            'deleted_at_helper'         => ' ',
//            'approved'                  => 'Approved',
//            'approved_helper'           => ' ',
//            'verified'                  => 'Verified',
//            'verified_helper'           => ' ',
//            'verified_at'               => 'Verified at',
//            'verified_at_helper'        => ' ',
//            'verification_token'        => 'Verification token',
//            'verification_token_helper' => ' ',
//        ],
//    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'setting'          => [
        'title'          => 'Settings',
        'title_singular' => 'Setting',
        'fields'         => [
            'id'                              => 'ID',
            'id_helper'                       => ' ',
            'site_title'                      => 'Site Title',
            'site_title_helper'               => ' ',
            'favicon'                         => 'Favicon',
            'favicon_helper'                  => ' ',
            'logo'                            => 'Logo',
            'logo_helper'                     => ' ',
            'meta_description'                => 'Meta Description',
            'meta_description_helper'         => ' ',
            'meta_keywords'                   => 'Meta Keywords',
            'meta_keywords_helper'            => 'Meta Keywords',
            'banner_heading'                  => 'Banner Heading',
            'banner_heading_helper'           => 'BVCL Heading',
            'banner_sub_heading'              => 'Banner Sub Heading',
            'banner_sub_heading_helper'       => 'BVCL Sub Heading',
            'watermark'                       => 'Watermark',
            'watermark_helper'                => ' ',
            'watermark_image'                 => 'Watermark Image',
            'watermark_image_helper'          => ' ',
            'banner'                          => 'Banner',
            'banner_helper'                   => ' ',
            'site_email'                      => 'Site Email',
            'site_email_helper'               => ' ',
            'site_phone_number'               => 'Site Phone Number',
            'site_phone_number_helper'        => ' ',
            'address'                         => 'Address',
            'address_helper'                  => ' ',
            'google_analytics'                => 'Google Analytics',
            'google_analytics_helper'         => ' ',
            'maintenance_mode'                => 'Maintenance Mode',
            'maintenance_mode_helper'         => ' ',
            'admin_approval'                => 'Admin Approval for New User',
            'admin_approval_helper'         => ' ',
            'maintenance_mode_title'          => 'Maintenance Mode Title',
            'maintenance_mode_title_helper'   => ' ',
            'maintenance_mode_content'        => 'Maintenance Mode Content',
            'maintenance_mode_content_helper' => ' ',
            'homepage_background'             => 'Homepage Background',
            'homepage_background_helper'      => ' ',
            'copyright'                       => 'Copyright',
            'copyright_helper'                => ' ',
            'facebook'                        => 'Facebook',
            'facebook_helper'                 => 'https://www.facebook.com/',
            'facebook_icon'                   => 'Facebook Icon',
            'facebook_icon_helper'            => ' ',
            'twitter'                         => 'Twitter',
            'twitter_helper'                  => 'https://www.twitter.com/',
            'twitter_icon'                    => 'Twitter Icon',
            'twitter_icon_helper'             => 'Twitter Icon',
            'linkedin'                        => 'Linkedin',
            'linkedin_helper'                 => 'https://www.linkedin.com/',
            'linkedin_icon'                   => 'Linkedin Icon',
            'linkedin_icon_helper'            => ' ',
            'summary'                         => 'Summary',
            'summary_helper'                  => ' ',
            'about'                           => 'About',
            'about_helper'                    => ' ',
            'created_at'                      => 'Created at',
            'created_at_helper'               => ' ',
            'updated_at'                      => 'Updated at',
            'updated_at_helper'               => ' ',
            'deleted_at'                      => 'Deleted at',
            'deleted_at_helper'               => ' ',
        ],
    ],

    'social' => [
        'title'          => 'Socials',
        'title_singular' => 'Social',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'title'                  => 'Title',
            'title_helper'           => ' ',
            'url'                    => 'Url',
            'url_helper'             => ' ',
            'icon_class_name'        => 'Icon Class Name',
            'icon_class_name_helper' => ' ',
            'is_active'              => 'Is Active',
            'is_active_helper'       => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'last_name'                => 'Last Name',
            'last_name_helper'         => ' ',
            'mobile'                   => 'Mobile',
            'mobile_helper'            => ' ',
            'date_of_birth'            => 'Date Of Birth',
            'date_of_birth_helper'     => ' ',
            'avatar'                   => 'Avatar',
            'avatar_helper'            => ' ',
            'batch'                    => 'Batch',
            'batch_helper'             => ' ',
            'school'                   => 'School',
            'school_helper'            => ' ',
            'first_name'               => 'First Name',
            'first_name_helper'        => ' ',
            'gender'                   => 'Gender',
            'gender_helper'            => ' ',
        ],
    ],
    'batch' => [
        'title'          => 'Batches',
        'title_singular' => 'Batch',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'is_active'         => 'Is Active',
            'is_active_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'division' => [
        'title'          => 'Division',
        'title_singular' => 'Division',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => 'bn_name',
            'bn_name'           => 'Bn Name',
            'bn_name_helper'    => ' ',
            'url'               => 'Url',
            'url_helper'        => ' ',
            'is_active'         => 'Is Active',
            'is_active_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'district' => [
        'title'          => 'Districts',
        'title_singular' => 'District',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'division'          => 'Division',
            'division_helper'   => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'bn_name'           => 'Bn Name',
            'bn_name_helper'    => ' ',
            'lat'               => 'Lat',
            'lat_helper'        => ' ',
            'lot'               => 'Lot',
            'lot_helper'        => ' ',
            'url'               => 'Url',
            'url_helper'        => ' ',
            'is_active'         => 'Is Active',
            'is_active_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'upazila' => [
        'title'          => 'Upazila',
        'title_singular' => 'Upazila',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'district'          => 'District',
            'district_helper'   => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'bn_name'           => 'Bn Name',
            'bn_name_helper'    => ' ',
            'url'               => 'Url',
            'url_helper'        => ' ',
            'is_active'         => 'Is Active',
            'is_active_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'union' => [
        'title'          => 'Unions',
        'title_singular' => 'Union',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'upazila'           => 'Upazila',
            'upazila_helper'    => ' ',
            'name'              => 'Union Name/Words/Roads',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'bn_name'           => 'Bn Name',
            'bn_name_helper'    => ' ',
            'url'               => 'Url',
            'url_helper'        => ' ',
            'is_active'         => 'Is Active',
            'is_active_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'fieldOfWork' => [
        'title'          => 'Field Of Works',
        'title_singular' => 'Field Of Work',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'is_active'         => 'Is Active',
            'is_active_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'is_approve'        => 'Is Approve',
            'is_approve_helper' => ' ',
        ],
    ],
    'designation' => [
        'title'          => 'Designations',
        'title_singular' => 'Designation',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'is_active'         => 'Is Active',
            'is_active_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'is_approve'        => 'Is Approve',
            'is_approve_helper' => ' ',
        ],
    ],
    'organization' => [
        'title'          => 'Organizations',
        'title_singular' => 'Organization',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'is_active'         => 'Is Active',
            'is_active_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'is_approve'        => 'Is Approve',
            'is_approve_helper' => ' ',
        ],
    ],
    'school' => [
        'title'          => 'Schools',
        'title_singular' => 'School',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'name'                  => 'Name',
            'name_helper'           => ' ',
            'slug'                  => 'Slug',
            'slug_helper'           => ' ',
            'division'              => 'Division',
            'division_helper'       => ' ',
            'district'              => 'District',
            'district_helper'       => ' ',
            'upazila'               => 'Upazila',
            'upazila_helper'        => ' ',
            'union'                 => 'Union',
            'union_helper'          => ' ',
            'picture'               => 'Picture',
            'picture_helper'        => ' ',
            'email'                 => 'Email',
            'email_helper'          => ' ',
            'contact_number'        => 'Contact Number',
            'contact_number_helper' => ' ',
            'about'                 => 'About',
            'about_helper'          => ' ',
            'url'                   => 'Url',
            'url_helper'            => ' ',
            'is_active'             => 'Is Active',
            'is_active_helper'      => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'is_approve'            => 'Is Approve',
            'is_approve_helper'     => ' ',
        ],
    ],
    'work' => [
        'title'          => 'Works',
        'title_singular' => 'Work',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'field_of_work'           => 'Field Of Work',
            'field_of_work_helper'    => ' ',
            'organization'            => 'Organization',
            'organization_helper'     => ' ',
            'designation'             => 'Designation',
            'designation_helper'      => ' ',
            'joining_date'            => 'Joining Date',
            'joining_date_helper'     => ' ',
            'resign_date'             => 'Resign Date',
            'resign_date_helper'      => ' ',
            'is_current_job'          => 'Is Current Job',
            'is_current_job_helper'   => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'created_by'              => 'Created By',
            'created_by_helper'       => ' ',
            'view_on_publicly'        => 'View On Publicly',
            'view_on_publicly_helper' => ' ',
        ],
    ],
    'address' => [
        'title'          => 'Addresses',
        'title_singular' => 'Address',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'division'                => 'Division',
            'division_helper'         => ' ',
            'district'                => 'District',
            'district_helper'         => ' ',
            'upazila'                 => 'Upazila',
            'upazila_helper'          => ' ',
            'union'                   => 'Union',
            'union_helper'            => ' ',
            'area'                    => 'Area',
            'area_helper'             => ' ',
            'type_of_address'         => 'Type Of Address',
            'type_of_address_helper'  => ' ',
            'view_on_publicly'        => 'View On Publicly',
            'view_on_publicly_helper' => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'created_by'              => 'Created By',
            'created_by_helper'       => ' ',
        ],
    ],
    'eventCategory' => [
        'title'          => 'Event Categories',
        'title_singular' => 'Event Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'is_active'         => 'Is Active',
            'is_active_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'event' => [
        'title'          => 'Events',
        'title_singular' => 'Event',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'event_category'        => 'Event Category',
            'event_category_helper' => ' ',
            'district'              => 'District',
            'district_helper'       => ' ',
            'name'                  => 'Name',
            'name_helper'           => ' ',
            'upazila'               => 'Upazila/City',
            'upazila_helper'        => ' ',
            'union'                 => 'Union/Road/Words',
            'union_helper'          => ' ',
            'address'               => 'Address',
            'address_helper'        => ' ',
            'summary'               => 'Summary',
            'summary_helper'        => ' ',
            'details'               => 'Details',
            'details_helper'        => ' ',
            'picture'               => 'Picture',
            'picture_helper'        => ' ',
            'is_free'               => 'Is Free',
            'is_free_helper'        => ' ',
            'price'                 => 'Price',
            'price_helper'          => ' ',
            'batch'                 => 'Batch',
            'batch_helper'          => ' ',
            'school'                => 'School',
            'school_helper'         => ' ',
            'user'                  => 'User',
            'user_helper'           => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'created_by'            => 'Created By',
            'created_by_helper'     => ' ',
            'event_status'          => 'Event Status',
            'event_status_helper'   => ' ',
            'event_date'            => 'Event Date',
            'event_date_helper'     => ' ',
            'event_time'            => 'Event Time',
            'event_time_helper'     => ' ',
        ],
    ],
];
