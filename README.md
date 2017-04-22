Long Running Process
--

This project is an example of one means of implementing a Long Running Process (sometimes referred to as a "saga") in PHP using a basic event driven architecture. The concept is taken from Vaughn Vernon's book "Implementing Domain Driven Design" and has been built purely as a learning exercise and to use for future reference should I need to apply this pattern elsewhere.

The project uses the typical hexagonal architecture and while it currently dispatches and handles events synchronously (using Symfony's Event Dispatcher component), it could easily be changed to publish events to a queue to enable an asynchronous and enable horizontal scaling.

If you can make any use of this code for learning purposes, please feel free to do so.

Setup
---
make init

Running tests
---
make test