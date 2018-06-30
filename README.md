# About GraphQL

## Local installation:
- Update `.env` file
- `php artisan migrate:fresh && php artisan db:seed`

## Endpoint/Query Examples:
`/graphql?query={attribute(attribute_group_level:"image",name:"shop"){id,name,attribute_group{name}}}`
`/graphql?query={application(id:1002){id,name,url,logo_url,products(name:"s"){id,live,name,attributes{name}}}}`
`/graphql?query={attribute_group(id:550){id,name,count_attributes,attributes(name:"aa"){id,name,attribute_group{frontend_name}}}}`
`/graphql?query={attribute_group(id:550){id,name,count_attributes,attributes(name:%22aa%22){id,name,attribute_group{frontend_name,attributes(name:%22AB%22){name}}}}}`


## Further Improvements:
- Use GraphQL/Deferred to solve the "N+1" problem
- Use explicit arguments/conditions (name_includes, name_is, ... instead of name)
- Use enum type for "attribute_group_level"
- Implement general arguments (`first`, `last`, `limit`, `offset`, ...etc)
