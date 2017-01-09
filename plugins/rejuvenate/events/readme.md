# Rejuvenate Events plugin

Manage events.

### Features
- Display all events,
- Display each event per page,
- Create slug,
- User's permission.

## Settings

In order to use Google Maps API in admin side, your have to provide key.

## Components

##### Events - display all events.

```
{% component 'events' %}
```


`Component properties` as follows:

Key | Description
- | -
upcomingEvents | Get only upcoming events (exclude `past events`).
orderBy | Order events by `title`, `created date` or `randomly`.
perPage | Number of events display on the page (e.g. `all`).
detailPage | Your event page name.

#####  Event - display each item per page

```
{% component 'event' %}
```

`Component properties` as follows:

Key | Description
- | -
slug | Create event slug


## Setup

##### 1. You can display all events on one page. 

```
{% component 'events' %}
```

... and if necessary create `events-details.htm` page for each testimonial:

```
{% component 'event' %}
```

## Events


## Schedules

N/A

## Form Widgets

N/A
