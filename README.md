# About GraphQL

Implement [GraphQL](https://graphql.org/) using relation-rich db scheme, MySQL & Laravel.


## Local installation:
- Clone, `cd` & `composer install`
- Update `DB_*` vars in `.env`
- Run (if required): `php artisan migrate:fresh && php artisan db:seed`
- Run: `php artisan serve`
- Explore: [http://localhost:8000/graphiql](http://localhost:8000/graphiql)


## Examples:
- `/graphiql?query={attribute(attribute_group_level:"image",name:"shop"){id,name,attribute_group{name}}}`
- `/graphiql?query={application(id:1002){id,name,url,logo_url,products(name:"s"){id,live,name,attributes{name}}}}`
- `/graphiql?query={attribute_group(id:550){id,name,count_attributes,attributes(name:"aa"){id,name,attribute_group{frontend_name}}}}`
- `/graphiql?query={attribute_group(id:550){id,name,count_attributes,attributes(name:%22aa%22){id,name,attribute_group{frontend_name,attributes(name:%22AB%22){name}}}}}`


## Endpoints:
- `/graphql`
- `/graphiql`


## Further Improvements:
- Use GraphQL::Deferred/Promised to [solve the "N+1" problem](https://github.com/webonyx/graphql-php/blob/master/docs/data-fetching.md#solving-n1-problem) (instead of "Eloquent::with()")
- Use explicit arguments/conditions (`name_includes`, `name_is`, ... instead of `name`)
- Use enum type for "attribute_group_level"
- Implement general arguments (`first`, `last`, `limit`, `offset`, ...etc)
- Create tests

## References:
- http://webonyx.github.io/graphql-php/data-fetching/#solving-n1-problem
- https://github.com/Folkloreatelier/laravel-graphql
- https://graphql.org/
