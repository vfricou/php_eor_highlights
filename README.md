# EOR highlights interface

This software permit to insert highlights directly in EyesOfReport database to be automatically shipped into reports.

It directly connected to EyesOfReport database to retreive necessary components :

- Years
- Months
- Applications list from global source

## Configure connections

All configuration was stored in `conf/define.php`.

**Don’t use this password on your database grants for production grade !!!**

| Variable                   | Default value | Description                                                        |
| -------------------------- | ------------- | ------------------------------------------------------------------ |
| `db_host`                  | `127.0.0.1`   | EOR database host                                                  |
| `db_user`                  | `highlight`   | EOR database user with [minimal rights](#db-account-configuration) |
| `db_pass`                  | `highlight`   | EOR database password                                              |
| `db_port`                  | `3306`        | EOR database port                                                  |
| `db_name`                  | `eor_dwh`     | EOR database name                                                  |
| `sentry_dsn`               |               | Sentry URL connector                                               |
| `sentry_env`               |               | Sentry environment                                                 |
| `sentry_attach_stacktrace` | `true`        | Collect stack trace to upload to sentry on each Exceptions         |
| `sentry_trace_sample_rate` | `1.0`         | Trace collection frequency                                         |

## Run with docker

```shell
docker-compose up -d
```

When container are fully started, the application will be accessible on http://localhost:8080 (or IP of docker node)

## Run on webserver

Place all this repository into directory accessible by webserver.  
Launch composer to install all required modules :

```bash
composer install
```

## DB account configuration

**Don’t use this password on your database grants for production grade !!!**

```sql
GRANT SELECT ON eor_dwh.d_application TO 'highlight'@'%' IDENTIFIED BY 'highlight';
GRANT SELECT,INSERT,UPDATE,DELETE ON eor_dwh.d_contract_month_comment TO 'highlight'@'%' IDENTIFIED BY 'highlight';
GRANT SELECT,INSERT,UPDATE,DELETE ON eor_dwh.d_appli_contract_month_comment TO 'highlight'@'%' IDENTIFIED BY 'highlight';
GRANT SELECT ON eor_dwh.d_time_date TO 'highlight'@'%' IDENTIFIED BY 'highlight';
GRANT SELECT ON eor_dwh.d_time_date TO 'highlight'@'%' IDENTIFIED BY 'highlight';
GRANT CONNECT ON eor_dwh TO 'highlight'@'%' IDENTIFIED BY 'highlight';
```

