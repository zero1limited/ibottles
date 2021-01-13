date=$(date '+%Y-%m-%d')

ENDPOINT="https://api.mdoq.io/v1/job-queue/"

rm ibottlescouk-$date.sql ibottlescouk-$date.sql.gz

mysqldump -u ibottlMutC -p36e3eecd48782274nWm6BalFfQFZLSTE6oU= ibottlescouk > ibottlescouk-$date.sql
gzip ibottlescouk-$date.sql

/usr/local/bin/mdoq backups:push --file=ibottlescouk-$date.sql.gz --instance-id=10675 --backup-type=full-db-backup
