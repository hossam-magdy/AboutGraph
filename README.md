# About Graph


## Endpoint/Query Examples:
`/graphql?query={attribute(attribute_group_level:"image",name:"shop"){id,name,attribute_group{name}}}`
`/graphql?query={application(id:1002){id,name,url,logo_url,products(name:"s"){id,live,name,attributes{name}}}}`


## Further Improvements:
- Use GraphQL/Deferred to solve the "N+1" problem
- Use explicit arguments/conditions (name_includes, name_is, ... instead of name)
- Use enum type for "attribute_group_level"
