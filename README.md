# Elevator

To install application you need to do the following:
```
cd <project_dir>
composer install
```

"composer" will ask a few params (DB Host/Name/, etc...). You don't need them all. Most of standalone ones (like DB or mail params) are not in use at all. I just didn't have a chance to do clean up. Below is example of params. Please note you have to have RabbitMQ installed to get application working.
```
# Basic RabbitMQ params
amqp_host: dev-amqp
amqp_port: 5672 
amqp_user: admin
amqp_password: secret

# Application specific RabbitMQ params (you can set any text value here)
amqp_queue_name: elevator
ampq_channel_all: elevator.commands.all
ampq_channel_elevator: elevator.commands.elevator

# Elevator specific params
elevator_total_floors: 9
elevator_speed: 1500000
elevator_doors_activity_time: 5
elevator_initial_floor: 1
elevator_waiting_internal_seconds: 15
```

Application has 3 parts: 
 * Server (elevator itself)
 * Floor buttons (command line application)
 * Elevator buttons (command line application)

At 1st, you need to launch server (keep the console to see some output): 
```
bin/console elevator:emulate
```

Then you can send commands:
```
# To simulate a button push on 5th floor
elevator:button:elevator 6

# To simulate a button push inside elelvator (e.g. you are requesting 3rd floor)
elevator:button:elevator 3
```
