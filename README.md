# HW05 Multiple User Feed

## <First Name - Last Name>

### Initial Setup

* Run `composer install`.
* MySQL Host: 67.205.183.11
* MySQL Port: 3306
* MySQL Database Name: feed_<weber state username> 
* MySQL Username: <weber state username>
* MySQL Password: changeme

### Problem Statement

#### Vision Statement

The chat feed application provides a mechanism for multiple users to post
messages.  The application is very simple, one feed (same as a room) which
all users post to.

#### Data Model

##### Feed/Room

- Should be public.
- No registration required.
- All messages are plain text.

##### Chat Messages

- All messages are plain text.
- Each message log entry should have a timestamp and a source IP and username.
- Each message displayed should show the username.

#### User Interface

- Feed page have a section for the feed stream.
- The feed stream should **NOT** require a page refresh. (i.e. AJAX)
- Feed page should have a <POST> button which brings up the "Post Message"
  form.
- Post message form should have a field for the username.
- Post message form should have a field for the message.
- Post message form should have a <CANCEL> button.
- Post message form should have a <SEND> button.

#### Use Cases

- System - logs all activity on the feed
- System - records the user's IP
- System - records the username
- System - records the user's message/body
- System - remembers if a user has already visited
- User - sends a message to the public feed
- User - views the message feed

#### Project Tools

- Slim Framework
- GuzzleHTTP
- PHPUnit (50% code coverage)
