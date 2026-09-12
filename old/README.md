# Retired front-end

The Jaya Tennis theme that served the site until the 2026 redesign
(JTC_Desktop_Master_New.psd) replaced it. Kept because it is the only place
where the public pages were wired to the CMS — teams read from `event_teams`,
the draw and results from `event_matches`, the schedule from `event_schedule`,
and the registration form posted into the live event module.

The new theme under `resources/views/jtc/` is a slice: its content comes from
arrays in `app/Http/Controllers/Jtc.php`. When a section of it needs real data,
the queries to copy are in `controllers/Tennis.php`.

Nothing here is routed or served. `.htaccess` denies the whole directory.

    controllers/Tennis.php   the five public pages, CMS-wired
    views/tennis/            their Blade templates
    assets/tennis/           the stylesheet, script and imagery they used
