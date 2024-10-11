#### Assalamualaikum


[DB Diagram](https://drawsql.app/teams/abu-barakah-delowar/diagrams/kahf-laravel-developer)

####
Why `area` field in `users` table are string rather than `area_id` from `areas` table. As `area ` name can be changed due to geo-political reason, if we issue a certificate upon vaccine receive, there will be mismatch with website data and printed vaccine certificate.

Same reason for `city` and `area` in `vaccine_centers` table.

#### SMS Notification

1. Create a Custom SMS Channel, i.e. `MyChannel`.
2. Modify `construct` and `send` method according to SMS gateway's documentation.
3. Call the custom channel from `via` method inside `NotifyVaccineTaker` notification and call the method `toMyChannel`'s custom method'.
4. Declare custom Method in `User` Model `routeNotificationForMyChannel`.


