# gw2arm-embeds

This is a Wordpress plugin to make it easier to use the [`GW2 armory embeds`](https://github.com/madou/armory-embeds).
Simply download the zip an install it in Wordpress-Plugin-Manager.

Be careful! Plugin is under development! Incompatibility could lead to a nonfunctional website!

# How it works

It adds the shortcodes `[gw2emb_amulets] [gw2emb_items] [gw2emb_skills] [gw2emb_specs] [gw2emb_traits] ` to wordpress. You have to add the needed options similar to the original GW2 Armory Embeddings
Supported parameters are:

main parameter  | value                                       | original
------------    |------------                                 |------------
id              |  ID(s) to be viewed (e.g. skill-IDs)        |  data-armory-ids
text            |  wiki / gw2spidy                            |  data-armory-inline-text
blank           |  any text                                   |  data-armory-blank-text
size            |  number (for custom icon size)              |  data-armory-size
style           |  inline (mods the embed to be viewed inline with text)                                          |  -none-
spec parameter  |  value                                      |  original
------------    |------------                                 |------------
traits          |  trait IDs (read multi-view instructions)   |  data-armory-\<id>-traits
item parameter  | value                                       |  original
------------    |------------                                 |------------
skin            |  skin ID                                    |  data-armory-\<id>-skin
stat            |  stat ID                                    |  data-armory-\<id>-stat
upgrade         |  upgrade IDs (for multiple upgrades add +count e.g. 24815+3)                                                      |  data-armory-\<id>-upgrades
infusions       |  infusion ID                                |  data-armory-\<id>-infusions


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
