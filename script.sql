create table device
(
    id         bigint unsigned auto_increment
        primary key,
    created_at timestamp null,
    updated_at timestamp null
)
    collate = utf8mb4_unicode_ci;

create table devices
(
    id                 bigint unsigned auto_increment
        primary key,
    uid                varchar(255)                 not null,
    appId              varchar(64)                  not null,
    language           varchar(32)                  not null,
    operation_system   varchar(12)                  not null,
    created_at         timestamp                    null,
    updated_at         timestamp                    null,
    api_token          varchar(512)                 not null,
    subscription_state varchar(10) default 'active' not null
)
    collate = utf8mb4_unicode_ci;

create index devices_id_index
    on devices (id);

create index devices_uid_index
    on devices (uid);

create table failed_jobs
(
    id         bigint unsigned auto_increment
        primary key,
    connection text                                not null,
    queue      text                                not null,
    payload    longtext                            not null,
    exception  longtext                            not null,
    failed_at  timestamp default CURRENT_TIMESTAMP not null
)
    collate = utf8mb4_unicode_ci;

create table migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(255) not null,
    batch     int          not null
)
    collate = utf8mb4_unicode_ci;

create table password_resets
(
    email      varchar(255) not null,
    token      varchar(255) not null,
    created_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create index password_resets_email_index
    on password_resets (email);

create table prov_devices
(
    id          bigint unsigned auto_increment
        primary key,
    device_name varchar(255) not null,
    device_host varchar(255) not null,
    created_at  timestamp    null,
    updated_at  timestamp    null
)
    collate = utf8mb4_unicode_ci;

create table purchases
(
    id          bigint unsigned auto_increment
        primary key,
    device_id   int          not null,
    status      varchar(12)  not null,
    expire_date datetime     not null,
    created_at  timestamp    null,
    updated_at  timestamp    null,
    app_id      int          not null,
    receipt     varchar(512) not null
)
    collate = utf8mb4_unicode_ci;

create table users
(
    id                bigint unsigned auto_increment
        primary key,
    name              varchar(255) not null,
    email             varchar(255) not null,
    email_verified_at timestamp    null,
    password          varchar(255) not null,
    remember_token    varchar(100) null,
    created_at        timestamp    null,
    updated_at        timestamp    null,
    constraint users_email_unique
        unique (email)
)
    collate = utf8mb4_unicode_ci;


