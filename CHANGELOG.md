# CHANGELOG

## 0.9.2 [18-07-2022]
- Feature: Improved landing page (v1.3)

## Release 0.9.1 [07-05-2022]
- Feature: Minor improvements to landing page

## Release 0.9.0 [07-05-2022]
- Feature: Improved landing page

## Release 0.8.0 [02-05-2022]
- Fix: Scope inventory by tenant id
- Feature: Get all products use case
- Fix: Add foreign key constraints of tenant

## Release 0.7.3 [01-05-2022]
- Fix: Use standard Tailwind styling for sign up button
- Feature: Improve success message after creating account

## Release 0.7.2 [01-05-2022]
- Fix: Add navigation components to mobile header

## Release 0.7.1 [01-05-2022]
- Fix: Use standard TailwindCSS classes instead of custom and embed TailwindCSS via CDN. CDN is needed for production to work, which doesn't include custom classes.

## Release 0.7.0 [01-05-2022]
- Feature: Improved landing page

## Release 0.6.3 [26-04-2022]
- Feature: Embed fathom analytics

## Release 0.6.2 [26-04-2022]
- Refactor: Use /v1/ as route
- Refactor: Remove API docs that are not included in MVP version

## Release 0.6.1 [26-04-2022]
- Fix: Correctly adjust stock when cancelling picklist

## Release 0.6.0 [26-04-2022]
- Feature: Pick all products from picklist
- Feature: Cancel picklist
- Feature: Mutate stock when picklist is created
- Refactor: Order is the aggregate root that contains picklists and backorders

## Release 0.5.1 [24-06-2022]
- Feature: Get order by reference
- Feature: Get picklists for order 
- Feature: Get backorders for order
- Feature: Get all backorders
- Feature: Get all picklists
- Feature: Process backorders and single backorder

## Release 0.4.1 [10-06-2022]
- Fix: docs route conflicting with docs.yaml 

## Release 0.4.0 [10-06-2022]
- Feature: Add more API documentation

## Release 0.3.2 [10-06-2022]
- Fix: Hash passwords of users

## Release 0.3.1 [10-06-2022]
- Fix: Correct route for creating tokens

## Release 0.3.0 [10-06-2022]
- Feature: Sign up for trial page
- Feature: Get picklists for order

## Release 0.2.0 [10-04-2022]
- Feature: Process order use case
- Feature: Create order use case
- Feature: Get all orders use case
- Feature: Get product stock use case
- Feature: Change product stock use case
- Feature: Use Laravel factories for domain objects
- Feature: Authentication of api routes
- Feature: Create product use case
- Feature: Eloquent Order Repository
- Feature: Eloquent Product Repository with stock mutations

## Release 0.1.0 [30-03-2022]
- Feature: Process order use case without real implementation
- Feature: Create order use case without real implementation
