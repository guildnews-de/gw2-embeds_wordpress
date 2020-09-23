# gw2arm-embeds

This is a Wordpress plugin to make it easier to use the [GW2 armory embeds](https://github.com/madou/armory-embeds)
Simply download the zip an install it in Wordpress-Plugin-Manager.

Be careful! Plugin is under development! Incompatibility could lead to a nonfunctional website!

# How it works

It adds the shortcode `[gw2arm]` to wordpress. You have to add the needed options similar identical to the original. (I shorted 'specializations' to 'spec'!)
Supported parameters are:

parameter | value | original
------------|------------|------------
type  |  amulets/items/skills/spec/traits | data-armory-embed
id  |  amulet/item/skill/spec ID  | data-armory-ids
traits  |  trait IDs (read multi-view instructions)  |  data-armory-\<id>-traits
text  |  wiki / gw2spidy  |  data-armory-inline-text
blank  |  any text  |  data-armory-blank-text
size  |  number  |  data-armory-size
inline  |  1  |  -none-

Character view and item skin/stat/upgrade additions are not implemented yet.

# Example

You have to start with "gw2arm" followed by the options similar the original manual embeddings:
```
[gw2arm type='skills' id=5507 text=wiki inline=1]
```

# Multi-trait-view

To view multiple trait lines with selection only using one Code you have to use a special syntax.
You can fill in the trait-line-ids just as usual. But the selected traits have to be in the same string, seperated with an ';'. In the same order as the trait-line-ids.

Example:
```
[gw2arm type='spec' id='56,55' traits='2177,2061,2090;2071,2085,2143']
```

To clarify:
```
[gw2arm type=spec id='<line1-id> , <line2-id>' traits='<line1-select-ids with ','> ; <line2-select-ids with ','>']

```
