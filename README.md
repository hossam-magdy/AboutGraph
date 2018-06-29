# About Graph

## Initialization:
- Update `DATABASE_URL` in `.env`
- `bin/console doctrine:database:create`
- `bin/console doctrine:migration:migrate`

=======================

#### Next for OverblogGraphQLBundle
1. Define your schema, read documentation https://github.com/overblog/GraphQLBundle/blob/master/Resources/doc/definitions/index.md
2. If you want to see your dumped schema (really not necessary for bootstrap): run bin/console graphql:dump-schema
3. If you want to have GraphiQL to browse your API run: composer req --dev overblog/graphiql-bundle


